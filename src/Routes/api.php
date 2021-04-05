<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('users')
    ->name('users.')
    ->namespace('Exhum4n\Users\Http\Controllers')
    ->group(function () {

        Route::get('auth', 'AuthController@auth');
        Route::get('auth/{token}', 'AuthController@authByToken');
        Route::post('confirm', 'ConfirmController@verifyCode');

        Route::middleware('auth')
            ->group(function () {

                Route::patch('email', 'UserController@changeEmail');
                Route::get('current', 'UserController@current');
            });
    });
