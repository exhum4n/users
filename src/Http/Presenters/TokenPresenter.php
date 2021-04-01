<?php

namespace Exhum4n\Users\Http\Presenters;

use Exhum4n\Components\Http\Presenters\SimplePresenter;
use Exhum4n\Users\Facades\Auth;
use Exhum4n\Users\Models\User;

class TokenPresenter extends SimplePresenter
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    protected function getPresentationData(): array
    {
        return [
            'token' => Auth::fromUser($this->user),
        ];
    }
}
