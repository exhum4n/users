<?php

declare(strict_types=1);

namespace Exhum4n\Users\Traits;

use Exhum4n\Components\Models\AuthEntity;
use Exhum4n\Users\Models\User;
use Exhum4n\Users\Repositories\UserRepository;
use Exhum4n\Users\Services\UserService;

trait Users
{
    /**
     * @param int $userId
     *
     * @return AuthEntity|User|null
     */
    public function getUserById(int $userId): ?AuthEntity
    {
        return app(UserRepository::class)
            ->getById($userId);
    }

    /**
     * @param string $email
     *
     * @return AuthEntity|User|null
     */
    public function getUserByEmail(string $email): ?AuthEntity
    {
        return app(UserRepository::class)
            ->getByEmail($email);
    }

    /**
     * @param User $user
     */
    public function setUserIsVerified(User $user): void
    {
        app(UserRepository::class)->update($user, [
            'is_verified' => true,
        ]);
    }

    /**
     * @param string $email
     * @param string|null $ip
     *
     * @return AuthEntity|User
     */
    public function createUser(string $email, ?string $ip = null): AuthEntity
    {
        return app(UserService::class)
            ->create($email, $ip);
    }

    /**
     * @param User $user
     * @param array $data
     *
     * @return User
     */
    public function updateUser(User $user, array $data): User
    {
        return app(UserRepository::class)
            ->update($user, $data);
    }
}
