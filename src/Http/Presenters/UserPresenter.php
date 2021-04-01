<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Presenters;

use Exhum4n\Components\Http\Presenters\SimplePresenter;
use Exhum4n\Users\Models\Role;
use Exhum4n\Users\Models\User;

class UserPresenter extends SimplePresenter
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var array
     */
    protected $rolePresenters = [
        Role::ID_ADMIN => AdminPresenter::class,
        Role::ID_CLIENT => ClientPresenter::class,
    ];

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

        $rolePresenter = $this->rolePresenters[$this->user->role_id];

        $presenter = new $rolePresenter($this->user);

        $presentationData = $presenter->getPresentationData();

        $commonInformation = [
            'id' => $user->id,
            'email' => $user->email,
            'timezone' => $user->timezone,
            'time' => now($user->timezone)->format('H:i:s'),
            'created_at' => $user->created_at->format('Y-m-d H:i:s'),
            'status' => $user->status,
            'role' => $user->role,
        ];

        $contacts = $user->contacts;
        if ($contacts->count() > 0) {
            $commonInformation['contacts'] = $contacts;
        }

        return array_merge($commonInformation, $presentationData);
    }
}
