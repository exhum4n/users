<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Controllers;

use Exhum4n\Users\Exceptions\EmailVerificationException;
use Exhum4n\Users\Exceptions\VerificationException;
use Exhum4n\Users\Http\Presenters\TokenPresenter;
use Exhum4n\Users\Http\Requests\ConfirmRequest;
use Exhum4n\Users\Http\Requests\EmailConfirmRequest;
use Exhum4n\Users\Services\VerificationService;
use Exhum4n\Users\Traits\Users;
use Exhum4n\Components\Http\Controllers\AbstractController;
use Illuminate\Http\JsonResponse;

class VerificationController extends AbstractController
{
    use Users;

    /**
     * @var VerificationService
     */
    protected $service;

    /**
     * @param $service
     */
    public function __construct(VerificationService $service)
    {
        $this->service = $service;
    }

    /**
     * @param EmailConfirmRequest $request
     *
     * @return JsonResponse
     *
     * @throws EmailVerificationException
     */
    public function verifyEmail(EmailConfirmRequest $request): JsonResponse
    {
        $user = $this->service->confirmEmail($request->code);

        return (new TokenPresenter($user))
            ->present();
    }

    /**
     * @param ConfirmRequest $request
     *
     * @return JsonResponse
     *
     * @throws VerificationException
     */
    public function verifyCode(ConfirmRequest $request): JsonResponse
    {
        $user = $this->service->confirmCode($request->email, $request->code);

        return (new TokenPresenter($user))
            ->present();
    }
}
