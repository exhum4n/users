<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Controllers;

use Exhum4n\Users\Exceptions\ConfirmationException;
use Exhum4n\Users\Exceptions\UserNotFoundException;
use Exhum4n\Users\Http\Presenters\TokenPresenter;
use Exhum4n\Users\Http\Requests\ConfirmCodeRequest;
use Exhum4n\Users\Http\Requests\ConfirmEmailRequest;
use Exhum4n\Users\Services\ConfirmService;
use Exhum4n\Components\Http\Controllers\AbstractController;
use Illuminate\Http\JsonResponse;

class ConfirmController extends AbstractController
{
    /**
     * @var ConfirmService
     */
    protected $service;

    public function __construct(ConfirmService $service)
    {
        $this->service = $service;
    }

    /**
     * @param ConfirmEmailRequest $request
     *
     * @return JsonResponse
     *
     * @throws ConfirmationException
     * @throws UserNotFoundException
     */
    public function email(ConfirmEmailRequest $request): JsonResponse
    {
        $user = $this->service->confirmEmail($request->code);

        return (new TokenPresenter($user))
            ->present();
    }

    /**
     * @param ConfirmCodeRequest $request
     *
     * @return JsonResponse
     *
     * @throws ConfirmationException
     */
    public function code(ConfirmCodeRequest $request): JsonResponse
    {
        $user = $this->service->confirmCode($request->email, $request->code);

        return (new TokenPresenter($user))
            ->present();
    }
}
