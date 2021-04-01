<?php

declare(strict_types=1);

namespace Exhum4n\Users\Repositories;

use Exhum4n\Components\Repositories\RedisRepository;

class EmailVerificationRepository extends RedisRepository
{
    protected $expirationTime = 10080;

    public function __construct()
    {
        parent::__construct();

        $this->setPrefix('email_verification_codes');
    }

    public function setVerificationEmail(string $code, string $email): void
    {
        $this->set($code, $email);
    }

    public function getVerificationEmail(string $code): ?string
    {
        return $this->get($code);
    }

    public function deleteVerificationEmail(string $code): void
    {
        $this->delete($code);
    }
}
