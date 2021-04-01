<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Presenters;

use Exhum4n\Components\Http\Presenters\SimplePresenter;
use Exhum4n\Users\Models\User;

class AdminPresenter extends SimplePresenter
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    protected function getPresentationData(): array
    {
        $user = $this->user;

        return [
            'username' => $user->credentials->username,
        ];
    }
}
