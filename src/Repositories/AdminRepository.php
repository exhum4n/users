<?php

declare(strict_types=1);

namespace Exhum4n\Users\Repositories;

use Exhum4n\Users\Models\Admin;
use Exhum4n\Components\Repositories\AbstractRepository;

/**
 * Class AdminRepository.
 *
 * @method Admin getById(int $id)
 * @method Admin create(array $data)
 * @method Admin update(Admin $model, array $data)
 */
class AdminRepository extends AbstractRepository
{
    /**
     * @return string
     */
    protected function getModel(): string
    {
        return Admin::class;
    }
}
