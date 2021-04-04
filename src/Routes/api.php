<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {

    Route::prefix('users')
        ->name('users.')
        ->namespace('Exhum4n\Users\Http\Controllers')
        ->group(function () {

            Route::get('auth', 'AuthController@auth');
            Route::get('auth/{token}', 'AuthController@authByToken');
            Route::get('email/{code}', 'VerificationController@verifyEmail');
            Route::post('confirm', 'VerificationController@verifyCode');

            Route::middleware('auth')
                ->group(function () {

                    Route::put('email', 'UserController@changeEmail')
                        ->name('email.change');

                    Route::get('me', 'UserController@me')
                        ->name('me');
                });
        });
});
