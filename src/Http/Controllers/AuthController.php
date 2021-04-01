<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Controllers;

use Exhum4n\Users\Exceptions\AuthorizationException;
use Exhum4n\Users\Exceptions\UnauthorizedException;
use Exhum4n\Users\Http\Presenters\TokenPresenter;
use Exhum4n\Users\Http\Requests\AuthorizeByTokenRequest;
use Exhum4n\Users\Http\Requests\AuthorizeRequest;
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

    /**
     * @param AuthService $service
     */
    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    /**
     * @param AuthorizeRequest $request
     *
     * @return JsonResponse
     *
     * @throws AuthorizationException
     */
    public function auth(AuthorizeRequest $request): JsonResponse
    {
        $user = $this->service->byEmail($request->email, $request->ip, $request->referrer_code);

        return (new TokenPresenter($user))
            ->present();
    }

    /**
     * @param AuthorizeByTokenRequest $request
     *
     * @return JsonResponse
     *
     * @throws UnauthorizedException
     */
    public function authByToken(AuthorizeByTokenRequest $request): JsonResponse
    {
        $user = $this->service->byToken($request->token);

        return (new TokenPresenter($user))
            ->present();
    }
}
