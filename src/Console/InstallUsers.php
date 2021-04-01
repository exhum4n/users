<?php

declare(strict_types=1);

namespace Exhum4n\Users\Console;

use Exhum4n\Components\Console\AbstractCommand;
use Exhum4n\Users\Database\Seeds\UserComponentsSeeder;

class InstallUsers extends AbstractCommand
{
    public function handle(): void
    {
        $this->call('migrate', ['--path' => migrations_path(static::class)]);
        $this->call('db:seed', ['--class' => UserComponentsSeeder::class]);
    }

    protected function getSignature(): string
    {
        return 'users:install';
    }
}
