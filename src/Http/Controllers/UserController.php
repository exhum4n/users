<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Controllers;

use Exhum4n\Users\Http\Presenters\ChangeEmailPresenter;
use Exhum4n\Users\Http\Presenters\UserPresenter;
use Exhum4n\Users\Http\Requests\ChangeEmailRequest;
use Exhum4n\Users\Services\UserService;
use Exhum4n\Users\Traits\Users;
use Exhum4n\Components\Http\Controllers\AbstractController;
use Illuminate\Http\JsonResponse;

class UserController extends AbstractController
{
    use Users;

    /**
     * @var UserService
     */
    protected $service;

    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $user = $this->service->getCurrentUser();

        return (new UserPresenter($user))
            ->present();
    }

    /**
     * @param ChangeEmailRequest $request
     *
     * @return JsonResponse
     */
    public function changeEmail(ChangeEmailRequest $request): JsonResponse
    {
        $user = $this->getCurrentUser();

        $this->service->changeEmail($user, $request->email);

        return (new ChangeEmailPresenter())
            ->present();
    }
}
