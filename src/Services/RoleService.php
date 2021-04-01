<?php

declare(strict_types=1);

namespace Exhum4n\Users\Services;

use Common\Services\BaseService;
use Components\User\Models\Role;
use Components\User\Repositories\RoleRepository;
use Illuminate\Support\Collection;

/**
 * Class RoleService.
 *
 * @method Collection|Role getAll()
 * @method Role|null getByName(string $name)
 */
class RoleService extends BaseService
{
    /**
     * @return string
     */
    protected function getRepository(): string
    {
        return RoleRepository::class;
    }
}
