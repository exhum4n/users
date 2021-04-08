<?php

declare(strict_types=1);

namespace Exhum4n\Users\Services;

use Exhum4n\Components\Jobs\SendEmailJob;
use Exhum4n\Components\Models\AuthEntity;
use Exhum4n\Users\Exceptions\AuthException;
use Exhum4n\Users\Exceptions\UnauthorizedException;
use Exhum4n\Users\Mails\AuthenticationCodeMail;
use Exhum4n\Users\Models\Status;
use Exhum4n\Users\Models\User;
use Exhum4n\Users\Repositories\AuthRepository;
use Exhum4n\Users\Traits\Credentials;
use Exhum4n\Users\Traits\Users;
use Exhum4n\Users\Emails\Emails;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    use Users;
    use Emails;
    use Credentials;
    use Dispatchable;

    /**
     * Maximum fail attempts before user will blocked.
     */
    private const MAX_FAIL_ATTEMPTS = 3;

    /**
     * @var AuthRepository
     */
    private $repository;

    /**
     * AuthService constructor.
     *
     * @param AuthRepository $repository
     */
    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $email
     * @param string $ip
     *
     * @return AuthEntity|User
     *
     * @throws AuthException
     */
    public function byEmail(string $email, string $ip): AuthEntity
    {
        $user = $this->getUserByEmail($email);
        if (is_null($user)) {
            $user = $this->createUser($email, $ip);

            $this->sendVerificationEmail($email);

            return $user;
        }

        if ($user->status_id === Status::ID_BLOCKED) {
            throw new AuthException('user_is_blocked');
        }

        if ($user->is_verified === false) {
            $this->sendVerificationEmail($email);

            throw new AuthException('email_verification_required', 403);
        }

        $this->sendCode($email);

        throw new AuthException('verification_code_sent', 203);
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return AuthEntity|User
     *
     * @throws UnauthorizedException
     */
    public function byUsername(string $username, string $password): AuthEntity
    {
        $credentials = $this->getUserCredentialsByUsername($username);
        if (is_null($credentials)) {
            throw new UnauthorizedException();
        }

        if (Hash::check($password, $credentials->password) === false) {
            throw new UnauthorizedException();
        }

        return $credentials->user;
    }

    /**
     * @param string $email
     */
    public function sendCode(string $email): void
    {
        $code = $this->createCode($email);

        $mail = new AuthenticationCodeMail($code);

        SendEmailJob::dispatch($email, $mail)
            ->onQueue(config('auth.queue'));
    }

    /**
     * @param string $email
     * @param int $code
     *
     * @return AuthEntity|User
     *
     * @throws UnauthorizedException
     */
    public function confirmCode(string $email, int $code): AuthEntity
    {
        $verificationCode = $this->repository->getCode($email);
        if (is_null($verificationCode)) {
            throw new UnauthorizedException('wrong_auth_code');
        }

        if ($code !== $verificationCode) {
            $this->handleFail($email);
        }

        $this->eraseAttempts($email);

        return $this->getUserByEmail($email);
    }

    /**
     * @param string $email
     *
     * @return int
     */
    private function createCode(string $email): int
    {
        $code = $this->repository->getCode($email);
        if (is_null($code)) {
            $code = rand(1000, 9999);
        }

        $this->repository->setCode($email, $code);

        return $code;
    }

    /**
     * @param string $email
     *
     * @throws UnauthorizedException
     */
    private function handleFail(string $email): void
    {
        $failAttempts = $this->repository->getFailsCount($email);

        $failAttempts++;

        if ($failAttempts >= config('auth.fail_attempts', self::MAX_FAIL_ATTEMPTS)) {
            $this->eraseAttempts($email);

            throw new UnauthorizedException();
        }

        $this->repository->setFailAttempts($email, $failAttempts);

        throw new UnauthorizedException();
    }

    /**
     * @param string $email
     */
    private function eraseAttempts(string $email): void
    {
        $this->repository->delete($email);
    }
}
