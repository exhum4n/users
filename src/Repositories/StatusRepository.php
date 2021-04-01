<?php

declare(strict_types=1);

namespace Exhum4n\Users\Repositories;

use Exhum4n\Components\Repositories\AbstractRepository;
use Exhum4n\Users\Models\Status;

class StatusRepository extends AbstractRepository
{
    protected function getModel(): string
    {
        return Status::class;
    }
}
