<?php

declare(strict_types=1);

namespace Exhum4n\Users\Traits;

use Exhum4n\Users\Services\EmailService;

trait Verifications
{
    public function sendVerificationCode(string $email)
    {
        return app(EmailService::class)
            ->sendCode($email);
    }

    public function sendVerificationLink(string $email)
    {
        return app(EmailService::class)
            ->sendLink($email);
    }
}
