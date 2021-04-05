<?php

declare(strict_types=1);

namespace Exhum4n\Users\Models;

use Carbon\Carbon;
use Exhum4n\Components\Models\AuthEntity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User.
 *
 * @property int id
 * @property int status_id
 * @property bool is_verified
 * @property string email
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Status status
 * @property Credentials credentials
 */
class User extends AuthEntity implements JWTSubject
{
    public $timestamps = true;

    protected $table = 'users.users';

    protected $fillable = [
        'status_id',
        'is_verified',
        'email',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function credentials(): HasOne
    {
        return $this->hasOne(Credentials::class);
    }

    public function getJWTIdentifier(): int
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
