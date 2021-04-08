<?php

declare(strict_types=1);

namespace Exhum4n\Users\Models;

use Exhum4n\Components\Models\AuthEntity;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends AuthEntity implements JWTSubject
{
    /**
     * @var string
     */
    protected $table = 'users.users';

    /**
     * @var string[]
     */
    protected $fillable = [
        'status_id',
        'is_verified',
        'email',
    ];
}
