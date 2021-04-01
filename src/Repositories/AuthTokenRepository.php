<?php

declare(strict_types=1);

namespace Exhum4n\Users\Repositories;

use Exhum4n\Components\Repositories\RedisRepository;
use Illuminate\Support\Str;

class AuthTokenRepository extends RedisRepository
{
    public function create(string $email): string
    {
        $token = Str::random(64);

        $this->set($token, $email);

        return $token;
    }

    public function getEmailByToken(string $token): ?string
    {
        return $this->get($token);
    }

    public function remove(string $email): void
    {
        $this->delete($email);
    }

    protected $expirationTime = 60;

    public function __construct()
    {
        parent::__construct();

        $this->setPrefix('auth_tokens');
    }
}
