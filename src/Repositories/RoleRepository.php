<?php

declare(strict_types=1);

namespace Exhum4n\Users\Repositories;

use Exhum4n\Users\Models\Role;
use Exhum4n\Components\Repositories\AbstractRepository;

/**
 * Class RoleRepository.
 *
 * @method Role|null getFirst(array $where)
 * @method Role|null getById(int $id)
 */
class RoleRepository extends AbstractRepository
{
    /**
     * @param string $name
     *
     * @return Role|null
     */
    public function getByName(string $name): ?Role
    {
        return $this->getFirst(['name' => $name]);
    }

    /**
     * @return string
     */
    protected function getModel(): string
    {
        return Role::class;
    }
}
