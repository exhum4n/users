<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Controllers;

use Exhum4n\Users\Http\Presenters\UserPresenter;
use Exhum4n\Users\Services\UserService;
use Exhum4n\Components\Http\Controllers\AbstractController;
use Exhum4n\Whois\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends AbstractController
{
    /**
     * @var UserService
     */
    protected $service;

    /**
     * UserController constructor.
     *
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function current(Request $request): JsonResponse
    {
        return app(UserPresenter::class, [
            'user' => $request->user()
        ])->present();
    }
}
