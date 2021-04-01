<?php

/** @noinspection PhpIllegalPsrClassPathInspection */

use Exhum4n\Components\Database\Migrations\PostgresMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends PostgresMigration
{
    protected function getSchema(): string
    {
        return 'users';
    }

    protected function getTable(): string
    {
        return 'users';
    }

    protected function getBlueprint(): Closure
    {
        return function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->unsignedSmallInteger('status_id');
            $table->boolean('is_verified')->default(false);
            $table->string('email')->unique();
            $table->timestamps();

            $table->foreign('status_id')
                ->references('id')
                ->on('users.statuses');
        };
    }
}
