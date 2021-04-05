<?php

declare(strict_types=1);

namespace Exhum4n\Users\Events;

use Exhum4n\Users\Models\User;

class UserRegistered
{
    public $user;
    public $ip;

    public function __construct(User $user, ?string $ip = null)
    {
        $this->user = $user;
        $this->ip = $ip;
    }
}
