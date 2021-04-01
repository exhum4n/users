<?php

declare(strict_types=1);

namespace Exhum4n\Users\Models;

use Exhum4n\Components\Models\AbstractModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Credentials.
 *
 * @property int id
 * @property int user_id
 * @property string username
 * @property string password
 * @property User user
 */
class Credentials extends AbstractModel
{
    /**
     * @var string
     */
    protected $table = 'users.credentials';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'username',
        'password',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
