<?php

declare(strict_types=1);

namespace Exhum4n\Users\Services;

use Exhum4n\Components\Jobs\SendEmailJob;
use Exhum4n\Components\Services\AbstractService;
use Exhum4n\Users\Exceptions\UnauthorizedException;
use Exhum4n\Users\Exceptions\UserNotFoundException;
use Exhum4n\Users\Mails\EmailChangeMail;
use Exhum4n\Users\Mails\VerificationLinkMail;
use Exhum4n\Users\Models\User;
use Exhum4n\Users\Repositories\EmailRepository;
use Exhum4n\Users\Traits\Users;
use Illuminate\Support\Str;

class EmailService extends AbstractService
{
    use Users;

    /**
     * @var EmailRepository
     */
    protected $repository;

    /**
     * EmailService constructor.
     *
     * @param EmailRepository $repository
     */
    public function __construct(EmailRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * Attempt change email address.
     *
     * @param string $email
     */
    public function attemptChange(string $email)
    {
        $code = $this->createChangeCode($email);

        $this->repository->setChangeCode($email, $code);

        $mail = new EmailChangeMail($code);

        SendEmailJob::dispatch($email, $mail)
            ->onQueue(config('auth.queue'));
    }

    /**
     * Confirm email change.
     *
     * @param User $user
     * @param int $code
     * @param string $email
     *
     * @return User
     *
     * @throws UnauthorizedException
     */
    public function confirmChange(User $user, string $email, int $code): User
    {
        $changeCode = $this->repository->getChangeCode($email);
        if (is_null($code)) {
            throw new UnauthorizedException();
        }

        if ($code !== $changeCode) {
            throw new UnauthorizedException();
        }

        $this->updateUser($user, [
            'email' => $email,
        ]);

        return $user;
    }

    /**
     * Send email with verification link.
     *
     * @param string $email
     */
    public function sendVerification(string $email): void
    {
        $code = $this->createVerificationToken($email);

        $mail = new VerificationLinkMail($email, $code);

        SendEmailJob::dispatch($email, $mail)
            ->onQueue(config('auth.queue'));
    }

    /**
     * Conform email verification.
     *
     * @param string $token
     *
     * @return User|null
     *
     * @throws UnauthorizedException
     * @throws UserNotFoundException
     */
    public function verify(string $token): User
    {
        $email = $this->repository->getByToken($token);
        if (is_null($email)) {
            throw new UnauthorizedException('wrong_verification_token');
        }

        $user = $this->getUserByEmail($email);
        if (is_null($user)) {
            $this->eraseEmail($email);

            throw new UserNotFoundException();
        }

        $this->setUserIsVerified($user);

        $this->eraseEmail($email);

        return $user;
    }

    /**
     * Create token for email verification.
     *
     * @param string $email
     *
     * @return string
     */
    private function createVerificationToken(string $email): string
    {
        $token = Str::random(128);

        $this->repository->setVerificationToken($token, $email);

        return $token;
    }

    /**
     * Create code for email change confirmation.
     *
     * @param string $email
     *
     * @return int
     */
    private function createChangeCode(string $email): int
    {
        $code = rand(1000, 9999);

        $this->repository->setChangeCode($email, $code);

        return $code;
    }

    /**
     * @param string $email
     */
    private function eraseEmail(string $email): void
    {
        $this->repository->deleteVerificationToken($email);
        $this->repository->deleteChangeCode($email);
    }

    /**
     * @return string
     */
    protected function getRepository(): string
    {
        return EmailRepository::class;
    }
}
