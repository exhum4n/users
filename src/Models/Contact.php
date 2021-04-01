<?php

declare(strict_types=1);

namespace Exhum4n\Users\Models;

use Exhum4n\Components\Models\AbstractModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Contact.
 *
 * @property int id
 * @property int user_id
 * @property string name
 * @property string value
 * @property string description
 * @property User user
 */
class Contact extends AbstractModel
{
    protected $table = 'users.contacts';

    protected $fillable = [
        'user_id',
        'name',
        'value',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
