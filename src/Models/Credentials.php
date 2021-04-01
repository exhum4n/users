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
    protected $table = 'users.credentials';

    protected $fillable = [
        'user_id',
        'username',
        'password',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
