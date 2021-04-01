<?php

declare(strict_types=1);

namespace Exhum4n\Users\Models;

use Exhum4n\Components\Models\AbstractModel;

/**
 * Class RequestStatus.
 *
 * @property int id
 * @property string name
 */
class Status extends AbstractModel
{
    public const ID_ACTIVE = 1;
    public const ID_BLOCKED = 2;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'users.statuses';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];
}
