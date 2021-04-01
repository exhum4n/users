<?php

declare(strict_types=1);

namespace Exhum4n\Users\Console;

use Exhum4n\Components\Console\AbstractCommand;
use Illuminate\Support\Facades\DB;

class UninstallUsers extends AbstractCommand
{
    public function handle(): void
    {
        $this->call('migrate:reset', ['--path' => migrations_path(static::class)]);

        DB::statement('DROP SCHEMA IF EXISTS users');
    }

    protected function getSignature(): string
    {
        return 'users:uninstall';
    }
}
