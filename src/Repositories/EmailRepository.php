<?php

declare(strict_types=1);

namespace Exhum4n\Users\Repositories;

use Exhum4n\Components\Repositories\RedisRepository;

class EmailRepository extends RedisRepository
{
    /**
     * @var int
     */
    protected $expirationTime = 10080;

    /**
     * @return $this
     */
    public function token(): EmailRepository
    {
        $this->setPrefix('email_verification_tokens');

        return $this;
    }

    /**
     * @return $this
     */
    public function code(): EmailRepository
    {
        $this->setPrefix('email_change_codes');

        return $this;
    }

    /**
     * @param string $token
     * @param string $email
     */
    public function setVerificationToken(string $token, string $email): void
    {
        $this->token()->set($token, $email);
    }

    /**
     * @param string $token
     *
     * @return string|null
     */
    public function getByToken(string $token): ?string
    {
        return $this->token()->get($token);
    }

    /**
     * @param string $token)
     */
    public function deleteVerificationToken(string $token): void
    {
        $this->token()->delete($token);
    }

    /**
     * @param string $email
     * @param int $code
     */
    public function setChangeCode(string $email, int $code): void
    {
        $this->code()->set($email, $code);
    }

    /**
     * @param string $email
     *
     * @return int|null
     */
    public function getChangeCode(string $email): ?int
    {
        $code = $this->code()->get($email);

        return $code ? (int) $code : null;
    }

    /**
     * @param string $email
     */
    public function deleteChangeCode(string $email): void
    {
        $this->code()->delete($email);
    }
}
