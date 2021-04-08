<?php

declare(strict_types=1);

namespace Exhum4n\Users\Emails;

use Exhum4n\Users\Services\EmailService;

trait Emails
{
    /**
     * @param string $email
     */
    public function sendVerificationEmail(string $email)
    {
        return app(EmailService::class)
            ->sendVerification($email);
    }
}
