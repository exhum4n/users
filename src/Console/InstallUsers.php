<?php

declare(strict_types=1);

namespace Exhum4n\Users\Console;

use Exhum4n\Components\Console\Installer;
use Exhum4n\Users\Database\Seeds\RolesSeeder;
use Exhum4n\Users\Database\Seeds\StatusesSeeder;

class InstallUsers extends Installer
{
    protected $seeds = [
        StatusesSeeder::class,
        RolesSeeder::class,
    ];

    protected function getSignature(): string
    {
        return 'users:install';
    }
}
