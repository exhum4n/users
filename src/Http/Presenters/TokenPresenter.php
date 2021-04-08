<?php

namespace Exhum4n\Users\Http\Presenters;

use Exhum4n\Components\Http\Presenters\SimplePresenter;
use Exhum4n\Components\Models\AuthEntity;
use Exhum4n\Users\Facades\Auth;
use Exhum4n\Users\Models\User;

class TokenPresenter extends SimplePresenter
{
    /**
     * @var AuthEntity|User
     */
    protected $user;

    /**
     * TokenPresenter constructor.
     *
     * @param AuthEntity $user
     */
    public function __construct(AuthEntity $user)
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    protected function getPresentationData(): array
    {
        return [
            'token' => Auth::fromUser($this->user),
        ];
    }
}
