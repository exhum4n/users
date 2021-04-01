<?php

declare(strict_types=1);

namespace Exhum4n\Users\Repositories;

use Components\User\Models\Credentials;
use Exhum4n\Components\Repositories\AbstractRepository;

class CredentialsRepository extends AbstractRepository
{
    protected function getModel(): string
    {
        return Credentials::class;
    }
}
