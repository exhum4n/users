<?php

/** @noinspection PhpIllegalPsrClassPathInspection */

use Exhum4n\Components\Database\Migrations\PostgresMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminsTable extends PostgresMigration
{
    protected function getSchema(): string
    {
        return 'users';
    }

    protected function getTable(): string
    {
        return 'admins';
    }

    protected function getBlueprint(): Closure
    {
        return function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users.users')
                ->onDelete('cascade');
        };
    }
}
