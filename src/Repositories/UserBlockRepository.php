<?php

namespace Exhum4n\Users\Repositories;

use Exhum4n\Components\Repositories\RedisRepository;

class UserBlockRepository extends RedisRepository
{
    public function __construct()
    {
        parent::__construct();

        $this->setPrefix('users_blocks');
    }
}
