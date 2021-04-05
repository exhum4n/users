<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('users')
    ->name('users.')
    ->namespace('Exhum4n\Users\Http\Controllers')
    ->group(function () {

        Route::get('email/{code}', 'ConfirmController@email')
            ->name('email.confirm');
    });
