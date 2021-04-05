<?php

declare(strict_types=1);

namespace Exhum4n\Users\Traits;

use Exhum4n\Users\Repositories\CredentialsRepository;
use Exhum4n\Users\Models\Credentials as UserCredentials;

trait Credentials
{
    public function getUserCredentialsByUsername(string $username): ?UserCredentials
    {
        return app(CredentialsRepository::class)
            ->getByUsername($username);
    }
}
