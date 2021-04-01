<?php

declare(strict_types=1);

namespace Exhum4n\Users\Models;

use Exhum4n\Components\Models\AbstractModel;

/**
 * Class Client.
 *
 * @property int id
 * @property int user_id
 */
class Client extends AbstractModel
{
    protected $table = 'users.clients';

    protected $fillable = [
        'user_id',
    ];
}
