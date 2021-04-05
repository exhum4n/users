<?php

declare(strict_types=1);

namespace Exhum4n\Users\Traits;

use Exhum4n\Users\Models\User;
use Exhum4n\Users\Repositories\UserRepository;
use Exhum4n\Users\Services\UserService;

trait Users
{
    public function getUserById(int $userId): ?User
    {
        return app(UserRepository::class)
            ->getById($userId);
    }

    public function getUserByEmail(string $email): ?User
    {
        return app(UserRepository::class)
            ->getByEmail($email);
    }

    public function getUserByUsername(string $username): ?User
    {
        return app(UserRepository::class)
            ->getByUsername($username);
    }

    public function setUserIsVerified(User $user): void
    {
        app(UserRepository::class)->update($user, [
            'is_verified' => true,
        ]);
    }

    public function createUser(string $email, ?string $ip = null): User
    {
        return app(UserService::class)
            ->create($email, $ip);
    }
}
