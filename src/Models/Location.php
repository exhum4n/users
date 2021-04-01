<?php

declare(strict_types=1);

namespace Exhum4n\Users\Models;

use Exhum4n\Components\Models\AbstractModel;

/**
 * Class Location.
 *
 * @property int id
 * @property string country
 * @property string city
 * @property string country_code
 * @property string timezone
 */
class Location extends AbstractModel
{
    protected $table = 'users.locations';

    protected $fillable = [
        'country',
        'city',
        'country_code',
        'timezone',
    ];

    protected $hidden = [
        'id',
    ];
}
