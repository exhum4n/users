<?php

declare(strict_types=1);

namespace Exhum4n\Users\Services;

use Exhum4n\Components\Models\AuthEntity;
use Exhum4n\Users\Events\UserRegistered;
use Exhum4n\Users\Models\Status;
use Exhum4n\Users\Repositories\UserRepository;
use Exhum4n\Users\Emails\Emails;
use Exhum4n\Users\Models\User;
use Exhum4n\Components\Services\AbstractService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class UserService.
 *
 * @method AuthEntity|User|null getById(int $userId)
 * @method AuthEntity|User|null getByEmail(string $email)
 * @method AuthEntity|User|null getByUsername(string $username)
 * @method AuthEntity|User[]|Collection getAll()
 * @method void update(User $user, array $data)
 */
class UserService extends AbstractService
{
    use Emails;

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @param string $email
     * @param string|null $ip
     *
     * @return AuthEntity|User
     */
    public function create(string $email, ?string $ip = null): AuthEntity
    {
        $user = $this->repository->create([
            'email' => $email,
            'status_id' => Status::ID_ACTIVE,
        ]);

        event(new UserRegistered($user, $ip));

        return $user;
    }

    /**
     * @param User $user
     *
     * @return AuthEntity|User|Model
     */
    public function setVerified(User $user): User
    {
        return $this->repository->update($user, [
            'is_verified' => true,
        ]);
    }

    /**
     * @return string
     */
    protected function getRepository(): string
    {
        return UserRepository::class;
    }
}
