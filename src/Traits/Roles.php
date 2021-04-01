<?php

declare(strict_types=1);

namespace Exhum4n\Users\Traits;

use Exhum4n\Users\Models\Role;
use Exhum4n\Users\Repositories\RoleRepository;
use Illuminate\Support\Collection;

trait Roles
{
    public function getRoleByName(string $name): ?Role
    {
        return app(RoleRepository::class)
            ->getByName($name);
    }

    public function getAllRoles(): Collection
    {
        return app(RoleRepository::class)
            ->getAll();
    }
}
