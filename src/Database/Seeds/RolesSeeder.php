<?php

declare(strict_types=1);

namespace Exhum4n\Users\Database\Seeds;

use Exhum4n\Components\Database\Seeds\AbstractSeeder;
use Exhum4n\Users\Models\Role;
use Exhum4n\Users\Repositories\RoleRepository;

class RolesSeeder extends AbstractSeeder
{
    protected function getRecords(): array
    {
        return [
            [
                'id' => Role::ID_ADMIN,
                'name' => 'admin',
                'icon' => 'ServerIcon',
                'allow_admin_panel' => true,
            ],
            [
                'id' => Role::ID_CLIENT,
                'name' => 'client',
                'icon' => 'Edit2Icon',
                'allow_admin_panel' => false,
            ],
        ];
    }

    protected function getRepository(): string
    {
        return RoleRepository::class;
    }
}
