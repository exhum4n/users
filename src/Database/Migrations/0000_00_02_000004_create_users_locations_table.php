<?php

/** @noinspection PhpIllegalPsrClassPathInspection */

use Exhum4n\Components\Database\Migrations\PostgresMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersLocationsTable extends PostgresMigration
{
    protected function getSchema(): string
    {
        return 'users';
    }

    protected function getTable(): string
    {
        return 'users_locations';
    }

    protected function getBlueprint(): Closure
    {
        return function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('location_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users.users')
                ->onDelete('cascade');

            $table->foreign('location_id')
                ->references('id')
                ->on('users.locations');
        };
    }
}
