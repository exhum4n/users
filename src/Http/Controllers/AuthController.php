<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Controllers;

use Exhum4n\Users\Http\Presenters\TokenPresenter;
use Exhum4n\Users\Http\Requests\AuthRequest;
use Exhum4n\Users\Services\AuthService;
use Exhum4n\Components\Http\Controllers\AbstractController;
use Illuminate\Http\JsonResponse;

class AuthController extends AbstractController
{
    /**
     * @var AuthService
     */
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function auth(AuthRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $authMethod = key($validated);
        $key = $validated[$authMethod];

        $user = $this->service->$authMethod($key, $request->ip);

        return app(TokenPresenter::class, ['user' => $user])
            ->present();
    }
}
