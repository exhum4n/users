<?php

declare(strict_types=1);

namespace Exhum4n\Users\Repositories;

use Exhum4n\Users\Models\User;
use Exhum4n\Components\Repositories\AbstractRepository;
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
        return config('auth.providers.users.model');
    }
}
