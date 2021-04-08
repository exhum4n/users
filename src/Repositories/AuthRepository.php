<?php

declare(strict_types=1);

namespace Exhum4n\Users\Repositories;

use Exhum4n\Components\Repositories\RedisRepository;

class AuthRepository extends RedisRepository
{
    /**
     * @var int
     */
    protected $expirationTime = 600;

    /**
     * @param string $email
     * @param int $code
     */
    public function setCode(string $email, int $code): void
    {
        $this->code()->set($email, $code);
    }

    /**
     * @param string $email
     *
     * @return int|null
     */
    public function getCode(string $email): ?int
    {
        $code = $this->code()->get($email);

        return $code ? (int) $code : null;
    }

    /**
     * @param string $email
     */
    public function deleteCode(string $email): void
    {
        $this->code()->delete($email);
    }

    /**
     * @param string $email
     * @param int $count
     */
    public function setFailAttempts(string $email, int $count): void
    {
        $this->fails()->set($email, $count);
    }

    /**
     * @param string $email
     *
     * @return int|null
     */
    public function getFailsCount(string $email): ?int
    {
        $count = $this->fails()->get($email);

        return $count ?: (int) $count;
    }

    /**
     * @param string $email
     */
    public function deleteFailAttempts(string $email): void
    {
        $this->fails()->delete($email);
    }

    /**
     * @return $this
     */
    private function code(): AuthRepository
    {
        $this->setPrefix('auth_codes');

        return $this;
    }

    /**
     * @return $this
     */
    private function fails(): AuthRepository
    {
        $this->setPrefix('auth_fails');

        return $this;
    }
}
