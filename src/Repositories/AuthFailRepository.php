<?php

namespace Exhum4n\Users\Repositories;

use Exhum4n\Components\Repositories\RedisRepository;

class AuthFailRepository extends RedisRepository
{
    public function __construct()
    {
        parent::__construct();

        $this->setPrefix('authentication_fails');
    }
}
