<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Controllers;

use Exhum4n\Users\Exceptions\AuthException;
use Exhum4n\Users\Exceptions\UnauthorizedException;
use Exhum4n\Users\Http\Presenters\TokenPresenter;
use Exhum4n\Users\Http\Requests\AuthRequest;
use Exhum4n\Users\Http\Requests\ConfirmAuthRequest;
use Exhum4n\Users\Services\AuthService;
use Exhum4n\Components\Http\Controllers\AbstractController;
use Exhum4n\Users\Traits\Users;
use Illuminate\Http\JsonResponse;

class AuthController extends AbstractController
{
    use Users;

    /**
     * @var AuthService
     */
    protected $service;

    /**
     * AuthController constructor.
     *
     * @param AuthService $service
     */
    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    /**
     * @param AuthRequest $request
     *
     * @return JsonResponse
     *
     * @throws AuthException
     */
    public function auth(AuthRequest $request): JsonResponse
    {
        return app(TokenPresenter::class, [
            'user' => $this->service->byEmail($request->email, $request->ip)
        ])->present();
    }

    /**
     * @param ConfirmAuthRequest $request
     *
     * @return JsonResponse
     *
     * @throws UnauthorizedException
     */
    public function confirm(ConfirmAuthRequest $request): JsonResponse
    {
        return app(TokenPresenter::class, [
            'user' => $this->service->confirmCode($request->email, $request->code),
        ])->present();
    }
}
