<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('users')
    ->name('users.')
    ->namespace('Exhum4n\Users\Http\Controllers')
    ->group(function () {

        Route::middleware('auth')
            ->group(function () {
                Route::get('current', 'UserController@current')
                    ->name('current');
            });

        Route::prefix('auth')
            ->name('auth.')
            ->group(function () {
                Route::get('/', 'AuthController@auth');
                Route::post('confirm', 'AuthController@confirm')
                    ->name('confirm');
            });

        Route::prefix('email')
            ->name('email.')
            ->group(function () {
                Route::middleware('auth')
                    ->group(function () {
                        Route::patch('/', 'EmailController@attemptChange')
                            ->name('attempt.change');
                        Route::put('/', 'EmailController@confirmChange')
                            ->name('confirm.change');
                    });
            });
    });
