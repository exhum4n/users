<?php

/** @noinspection PhpIllegalPsrClassPathInspection */

use Exhum4n\Components\Database\Migrations\PostgresMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationsTable extends PostgresMigration
{
    protected function getSchema(): string
    {
        return 'users';
    }

    protected function getTable(): string
    {
        return 'locations';
    }

    protected function getBlueprint(): Closure
    {
        return function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->string('city', 50);
            $table->string('country', 50);
            $table->string('timezone', 50);
            $table->string('country_code', 10)->unique();
        };
    }
}
