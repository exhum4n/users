<?php

declare(strict_types=1);

namespace Exhum4n\Users\Models;

use Exhum4n\Components\Models\AbstractModel;

/**
 * Class Admin.
 *
 * @property int id
 * @property int user_id
 */
class Admin extends AbstractModel
{
    protected $table = 'users.admins';

    protected $fillable = [
        'user_id',
    ];
}
