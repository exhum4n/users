<?php

declare(strict_types=1);

namespace Exhum4n\Users\Services;

use Exhum4n\Users\Repositories\UserRepository;
use Exhum4n\Users\Traits\Roles;
use Exhum4n\Users\Traits\Verifications;
use Exhum4n\Users\Models\User;
use Exhum4n\Components\Services\AbstractService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class UserService.
 *
 * @method User|null getById(int $userId)
 * @method User|null getByEmail(string $email)
 * @method User|null getByUsername(string $username)
 * @method Collection findByEmail(string $email, ?int $count = null)
 * @method User[]|Collection getAll()
 * @method void update(User $user, array $data)
 * @method LengthAwarePaginator getPaginated(?int $perPage = null, ?array $filters = null)
 */
class UserService extends AbstractService
{
    use Verifications;
    use Roles;

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @param User $user
     *
     * @return User|Model
     */
    public function setVerified(User $user): User
    {
        return $this->repository->update($user, [
            'is_verified' => true,
        ]);
    }

    /**
     * @return User|Authenticatable
     */
    public function getCurrentUser(): User
    {
        return auth()->user();
    }

    public function changeEmail(User $user, string $email): User
    {
        if ($user->is_verified) {
            return $user;
        }

        $this->update($user, [
            'email' => $email,
        ]);

        $this->sendVerificationLink($email);

        return $user;
    }

    protected function getRepository(): string
    {
        return UserRepository::class;
    }
}
