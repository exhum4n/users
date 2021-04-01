<?php

declare(strict_types=1);

namespace Exhum4n\Users\Traits;

use Exhum4n\Users\Services\ClientService;
use Exhum4n\Users\Models\User;

trait Clients
{
    public function createClient(string $email, string $ip, ?string $code = null): User
    {
        return app(ClientService::class)
            ->create($email, $ip, $code);
    }
}
