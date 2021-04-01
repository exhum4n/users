<?php

declare(strict_types=1);

namespace Exhum4n\Users\Traits;

use Exhum4n\Users\Models\User;
use Exhum4n\Users\Repositories\UserRepository;
use Exhum4n\Users\Services\UserService;
use Illuminate\Contracts\Auth\Authenticatable;

trait Users
{
    /**
     * @return User|Authenticatable|null
     */
    public function getCurrentUser(): ?User
    {
        return auth()->user();
    }

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
        app(UserService::class)->update($user, [
            'is_verified' => true,
        ]);
    }
}
