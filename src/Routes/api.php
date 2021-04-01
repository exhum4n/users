<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('users')
    ->name('users.')
    ->namespace('User\Http\Controllers')
    ->group(function () {
        Route::get('auth', 'AuthController@auth')
            ->name('auth');

        Route::get('auth/{token}', 'AuthController@authByToken')
            ->name('auth.token');

        Route::post('auth/fast', 'AuthController@fastAuth')
            ->middleware('decrypt:advanced')
            ->name('auth.fast');

        Route::post('email/{code}', 'VerificationController@verifyEmail')
            ->name('email.confirm');

        Route::post('confirm', 'VerificationController@verifyCode')
            ->name('confirm');

        Route::prefix('subscription')
            ->name('subscription.')
            ->group(function () {
                Route::options('/', 'SubscriptionController@check')
                    ->middleware('decrypt:advanced')
                    ->name('check');

                Route::get('special', 'SubscriptionController@special')
                    ->name('special')
                    ->middleware('auth');

                Route::get('cancel', 'SubscriptionController@cancel')
                    ->middleware('auth')
                    ->name('cancel');
            });

        Route::middleware('auth')
            ->group(function () {
                Route::put('email', 'UserController@changeEmail')
                    ->name('email.change');

                Route::get('me', 'UserController@me')
                    ->name('me');
            });
    });
