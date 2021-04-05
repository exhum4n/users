<?php

/** @noinspection PhpIllegalPsrClassPathInspection */

use Exhum4n\Components\Database\Migrations\PostgresMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateCredentialsTable extends PostgresMigration
{
    protected function getSchema(): string
    {
        return 'users';
    }

    protected function getTable(): string
    {
        return 'credentials';
    }

    protected function getBlueprint(): Closure
    {
        return function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->string('username')->unique();
            $table->string('password');

            $table->foreign('user_id')
                ->references('id')
                ->on('users.users');
        };
    }
}
