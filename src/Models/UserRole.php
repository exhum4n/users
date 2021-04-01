<?php

declare(strict_types=1);

namespace Exhum4n\Users\Models;

use Exhum4n\Components\Models\AbstractModel;

/**
 * Class UserRole.
 *
 * @property int id
 * @property int user_id
 * @property int role_id
 */
class UserRole extends AbstractModel
{
    protected $table = 'users.users_roles';

    protected $fillable = [
        'user_id',
        'role_id',
    ];
}
