<?php

declare(strict_types=1);

namespace Exhum4n\Users\Events;

use Exhum4n\Components\Models\AuthEntity;
use Exhum4n\Users\Models\User;

class UserRegistered
{
    /**
     * @var AuthEntity|User
     */
    public $user;

    /**
     * @var string|null
     */
    public $ip;

    /**
     * UserRegistered constructor
     *.
     * @param AuthEntity $user
     * @param string $ip
     */
    public function __construct(AuthEntity $user, string $ip = '127.0.0.1')
    {
        $this->user = $user;
        $this->ip = $ip;
    }
}
