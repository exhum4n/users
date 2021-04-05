<?php

declare(strict_types=1);

namespace Exhum4n\Users\Traits;

use Exhum4n\Users\Services\ConfirmService;

trait Verifications
{
    public function sendVerificationCode(string $email)
    {
        return app(ConfirmService::class)
            ->sendCode($email);
    }

    public function sendVerificationLink(string $email)
    {
        return app(ConfirmService::class)
            ->sendLink($email);
    }
}
