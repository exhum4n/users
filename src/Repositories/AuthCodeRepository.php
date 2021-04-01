<?php

declare(strict_types=1);

namespace Exhum4n\Users\Repositories;

use Exhum4n\Components\Repositories\RedisRepository;

class AuthCodeRepository extends RedisRepository
{
    /**
     * @var int
     */
    protected $expirationTime = 600;

    public function __construct()
    {
        parent::__construct();

        $this->setPrefix('auth_code');
    }

    /**
     * @param string $email
     * @param int $code
     */
    public function setVerificationCode(string $email, int $code): void
    {
        $this->set($email, $code);
    }

    /**
     * @param string $email
     *
     * @return int|null
     */
    public function getVerificationCode(string $email): ?int
    {
        $code = $this->get($email);

        return $code ? (int) $code : null;
    }

    /**
     * @param string $email
     */
    public function deleteVerificationCode(string $email): void
    {
        $this->delete($email);
    }
}
