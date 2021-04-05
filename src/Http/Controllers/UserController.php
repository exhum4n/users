<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Controllers;

use Exhum4n\Users\Http\Presenters\ChangeEmailPresenter;
use Exhum4n\Users\Http\Presenters\UserPresenter;
use Exhum4n\Users\Http\Requests\ChangeEmailRequest;
use Exhum4n\Users\Services\UserService;
use Exhum4n\Components\Http\Controllers\AbstractController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends AbstractController
{
    /**
     * @var UserService
     */
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function current(Request $request): JsonResponse
    {
        auth()->user();

        $user = $request->user();

        return app(UserPresenter::class, ['user' => $user])
            ->present();
    }

    public function changeEmail(ChangeEmailRequest $request): JsonResponse
    {
        $this->service->changeEmail(
            $request->user(),
            $request->email
        );

        return app(ChangeEmailPresenter::class)
            ->present();
    }
}
