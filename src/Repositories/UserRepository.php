<?php

declare(strict_types=1);

namespace Exhum4n\Users\Repositories;

use Exhum4n\Users\Models\User;
use Exhum4n\Components\Repositories\AbstractRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class UserRepository.
 *
 * @method User create(array $data)
 */
class UserRepository extends AbstractRepository
{
    /**
     * @param string $email
     *
     * @return User|Model|null
     */
    public function getByEmail(string $email)
    {
        return $this->getFirst(['email' => $email]);
    }

    /**
     * @param string $username
     *
     * @return User|Model|null
     */
    public function getByUsername(string $username): ?User
    {
        $query = $this->getQuery()
            ->join('users.credentials', 'user_id', '=', 'users.id')
            ->where('credentials.username', '=', $username)
            ->select('users.*');

        return $query->first();
    }

    /**
     * @param int|null $perPage
     * @param array|null $filters
     *
     * @return LengthAwarePaginator
     */
    public function getPaginated(?int $perPage = null, ?array $filters = null): LengthAwarePaginator
    {
        $query = $this->getQuery();

        if (isset($filters['email'])) {
            $query->where('email', 'LIKE', "%{$filters['email']}%");
        }

        if (isset($filters['role_id'])) {
            $query->where('role_id', '=', $filters['role_id']);
        }

        if (isset($filters['subscription_id'])) {
            $query->join('users.subscriptions', 'user_id', '=', 'users.id')
                ->where('subscriptions.subscription_id', '=', $filters['subscription_id']);
        }

        if (isset($filters['strategy_id'])) {
            $query->join('strategies.queues', 'user_id', '=', 'users.id')
                ->where('queues.strategy_id', '=', $filters['strategy_id']);
        }

        return $query->paginate($perPage);
    }

    /**
     * @param string $email
     * @param int|null $count
     *
     * @return Collection
     */
    public function findByEmail(string $email, ?int $count = null): Collection
    {
        $query = $this->getQuery()
            ->where('email', 'LIKE', "%{$email}%");

        if ($count) {
            $query->take($count);
        }

        return $query->get();
    }

    /**
     * @return string
     */
    protected function getModel(): string
    {
        return User::class;
    }
}
