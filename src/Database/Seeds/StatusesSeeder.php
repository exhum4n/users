<?php

declare(strict_types=1);

namespace Exhum4n\Users\Database\Seeds;

use Exhum4n\Users\Models\Status;
use Exhum4n\Users\Repositories\StatusRepository;
use Exhum4n\Components\Database\Seeds\AbstractSeeder;

class StatusesSeeder extends AbstractSeeder
{
    protected function getRecords(): array
    {
        return [
            [
                'id' => Status::ID_ACTIVE,
                'name' => 'active',
            ],
            [
                'id' => Status::ID_BLOCKED,
                'name' => 'blocked',
            ],
        ];
    }

    protected function getRepository(): string
    {
        return StatusRepository::class;
    }
}
