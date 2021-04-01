<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Controllers;

use Exhum4n\Users\Http\Presenters\TokenPresenter;
use Exhum4n\Users\Http\Requests\AuthRequest;
use Exhum4n\Users\Services\AuthService;
use Exhum4n\Users\Traits\Users;
use Exhum4n\Components\Http\Controllers\AbstractController;
use Illuminate\Http\JsonResponse;

class AuthController extends AbstractController
{
    use Users;

    /**
     * @var AuthService
     */
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    /**
     * @param AuthRequest $request
     *
     * @return JsonResponse
     */
    public function auth(AuthRequest $request): JsonResponse
    {
        $request->validated();

        $authMethod = $request->auth_method;

        $user = $this->service->$authMethod($request->key);

        return (new TokenPresenter($user))
            ->present();
    }
}
