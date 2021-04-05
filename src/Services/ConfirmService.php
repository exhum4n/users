<?php

declare(strict_types=1);

namespace Exhum4n\Users\Services;

use Exhum4n\Users\Exceptions\UserNotFoundException;
use Exhum4n\Users\Exceptions\ConfirmationException;
use Exhum4n\Users\Mails\VerificationCodeMail;
use Exhum4n\Users\Mails\VerificationLinkMail;
use Exhum4n\Users\Repositories\AuthCodeRepository;
use Exhum4n\Users\Repositories\AuthFailRepository;
use Exhum4n\Users\Repositories\EmailVerificationRepository;
use Exhum4n\Users\Traits\Users;
use Exhum4n\Users\Models\User;
use Exhum4n\Components\Jobs\SendEmailJob;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ConfirmService
{
    use DispatchesJobs;
    use Users;

    public const MAX_FAIL_ATTEMPTS = 3;

    protected const VERIFICATION_TOKEN_LENGTH = 128;

    /**
     * @var AuthFailRepository
     */
    protected $failRepository;

    /**
     * @var AuthCodeRepository
     */
    protected $authCodes;

    /**
     * @var EmailVerificationRepository
     */
    protected $emailVerifications;

    public function __construct()
    {
        $this->authCodes = app(AuthCodeRepository::class);
        $this->emailVerifications = app(EmailVerificationRepository::class);
        $this->failRepository = app(AuthFailRepository::class);
    }

    public function sendCode(string $email): void
    {
        $code = $this->createAuthCode($email);

        $mail = new VerificationCodeMail($code);

        $job = new SendEmailJob($email, $mail);

        $this->dispatch($job);
    }

    public function sendLink(string $email): void
    {
        $code = $this->createVerificationToken($email);

        $mail = new VerificationLinkMail($email, $code);

        $job = new SendEmailJob($email, $mail);

        $this->dispatch($job);
    }

    /**
     * @param string $email
     * @param int $code
     *
     * @return User
     *
     * @throws ConfirmationException
     */
    public function confirmCode(string $email, int $code): User
    {
        $verificationCode = $this->authCodes->getVerificationCode($email);
        if (is_null($verificationCode)) {
            throw new ConfirmationException(trans('auth.codeIsOutdated'), 404);
        }

        if ($code !== $verificationCode) {
            $this->handleVerificationFail($email);
        }

        $this->eraseVerificationData($email);

        return $this->getUserByEmail($email);
    }

    /**
     * @param string $code
     *
     * @return User|null
     *
     * @throws ConfirmationException
     * @throws UserNotFoundException
     */
    public function confirmEmail(string $code): User
    {
        $email = $this->emailVerifications->getVerificationEmail($code);
        if (is_null($email)) {
            throw new ConfirmationException(trans('auth.codeIsOutdated'));
        }

        $user = $this->getUserByEmail($email);
        if (is_null($user)) {
            throw new UserNotFoundException(trans('auth.userNotFound'));
        }

        $this->setUserIsVerified($user);

        $this->emailVerifications->deleteVerificationEmail($email);

        return $user;
    }

    /**
     * @param string $email
     *
     * @throws ConfirmationException
     */
    protected function handleVerificationFail(string $email): void
    {
        $failAttempts = $this->failRepository->getFailsCount($email);

        $failAttempts++;

        if ($failAttempts >= self::MAX_FAIL_ATTEMPTS) {
            $this->eraseVerificationData($email);

            throw new ConfirmationException(trans('auth.throttle'));
        }

        $this->failRepository->setFailCount($email, $failAttempts);

        throw new ConfirmationException(trans('auth.wrongCode'));
    }

    protected function createAuthCode(string $email): int
    {
        $code = $this->authCodes->getVerificationCode($email);
        if (is_null($code)) {
            $code = rand(1000, 9999);
        }

        $this->authCodes->setVerificationCode($email, $code);

        return $code;
    }

    protected function createVerificationToken(string $email): string
    {
        $str = Str::random(static::VERIFICATION_TOKEN_LENGTH);

        $code = base64_encode(Hash::make($str));

        $this->emailVerifications->setVerificationEmail($code, $email);

        return $code;
    }

    protected function eraseVerificationData(string $email): void
    {
        $this->authCodes->delete($email);
        $this->failRepository->delete($email);
    }
}
