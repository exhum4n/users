<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Presenters;

use Exhum4n\Components\Http\Presenters\SimplePresenter;
use Exhum4n\Users\Facades\Auth;
use Exhum4n\Users\Models\User;

class ConfirmPresenter extends SimplePresenter
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
     * @return string[]
     */
    protected function getPresentationData(): array
    {
        return [
            'message' => 'Email successfully verified',
            'token' => Auth::fromUser($this->user)
        ];
    }
}
