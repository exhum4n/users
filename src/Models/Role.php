<?php

declare(strict_types=1);

namespace Exhum4n\Users\Models;

use Exhum4n\Components\Models\AbstractModel;

/**
 * Class Entity.
 *
 * @property int id
 * @property string name
 * @property string icon
 * @property bool allow_admin_panel
 */
class Role extends AbstractModel
{
    public const ID_ADMIN = 1;
    public const ID_CLIENT = 2;

    protected $table = 'users.roles';

    protected $fillable = [
        'name',
        'icon',
        'allow_admin_panel',
    ];

    protected $hidden = [
        'allow_admin_panel',
    ];
}
