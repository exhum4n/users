<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('users')
    ->name('web.users.')
    ->namespace('Exhum4n\Users\Http\Controllers')
    ->group(function () {

        Route::get('email/verify', 'EmailController@verify')
            ->name('email.verify');
    });
