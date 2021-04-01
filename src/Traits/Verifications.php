<?php

declare(strict_types=1);

namespace Exhum4n\Users\Traits;

use Exhum4n\Users\Services\VerificationService;

trait Verifications
{
    public function sendVerificationCode(string $email)
    {
        return app(VerificationService::class)
            ->sendVerificationCode($email);
    }

    public function sendVerificationLink(string $email)
    {
        return app(VerificationService::class)
            ->sendAuthorizationLink($email);
    }
}
