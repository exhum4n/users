<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Presenters;

use Exhum4n\Components\Http\Presenters\SimplePresenter;
use Exhum4n\Users\Models\User;

class UserPresenter extends SimplePresenter
{
    /**
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    protected function getPresentationData(): array
    {
        return [
            'id' => $this->user->id,
            'status' => $this->user->status->name,
        ];
    }
}
