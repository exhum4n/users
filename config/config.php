<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Maximum fail attempts
    |--------------------------------------------------------------------------
    |
    | Count of maximum fail attempts after user will blocked.
    |
    */

    'fail_attempts' => 3,

    /*
    |--------------------------------------------------------------------------
    | Authorization queue name
    |--------------------------------------------------------------------------
    |
    | Queue name.
    |
    */

    'queue' => 'default',

    /*
    |--------------------------------------------------------------------------
    | Frontend verification route
    |--------------------------------------------------------------------------
    |
    | This path will be used for email verification;
    |
    */

    'verification_callback_url' => config('app.url') . '/users/email/verify',
];
