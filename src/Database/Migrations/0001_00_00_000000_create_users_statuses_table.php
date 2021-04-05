<?php

/** @noinspection PhpIllegalPsrClassPathInspection */

use Exhum4n\Components\Database\Migrations\PostgresMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersStatusesTable extends PostgresMigration
{
    protected function getSchema(): string
    {
        return 'users';
    }

    protected function getTable(): string
    {
        return 'statuses';
    }

    protected function getBlueprint(): Closure
    {
        return function (Blueprint $table): void {
            $table->smallIncrements('id');
            $table->string('name', 20);
        };
    }
}
