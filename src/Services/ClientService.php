<?php

declare(strict_types=1);

namespace Exhum4n\Users\Services;

use Exhum4n\Users\Events\ClientRegistered;
use Exhum4n\Users\Models\Role;
use Exhum4n\Users\Models\Status;
use Exhum4n\Users\Repositories\UserRepository;
use Exhum4n\Users\Models\User;
use Exhum4n\Components\Services\AbstractService;

class ClientService extends AbstractService
{
    /**
     * @var UserRepository
     */
    protected $repository;

    public function create(string $email, string $ip): User
    {
        $transaction = function () use ($email) {
            return $this->repository->create([
                'email' => $email,
                'status_id' => Status::ID_ACTIVE,
                'role_id' => Role::ID_CLIENT,
            ]);
        };

        $client = $this->repository->transactionWrapper($transaction);

        event(new ClientRegistered($client, $ip));

        return $client;
    }

    protected function getRepository(): string
    {
        return UserRepository::class;
    }
}
