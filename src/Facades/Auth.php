<?php

namespace Exhum4n\Users\Facades;

use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * @method static string fromUser(UserContract $user)
 */
class Auth extends JWTAuth
{
}
