<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Controllers;

use Exhum4n\Components\Http\Controllers\AbstractController;
use Exhum4n\Users\Exceptions\UnauthorizedException;
use Exhum4n\Users\Exceptions\UserNotFoundException;
use Exhum4n\Users\Http\Presenters\AttemptChangePresenter;
use Exhum4n\Users\Http\Presenters\ConfirmPresenter;
use Exhum4n\Users\Http\Presenters\TokenPresenter;
use Exhum4n\Users\Http\Requests\ChangeEmailRequest;
use Exhum4n\Users\Http\Requests\ConfirmEmailChangeRequest;
use Exhum4n\Users\Http\Requests\VerifyEmailRequest;
use Exhum4n\Users\Services\EmailService;
use Illuminate\Http\JsonResponse;

class EmailController extends AbstractController
{
    /**
     * @var EmailService
     */
    protected $service;

    public function __construct(EmailService $service)
    {
        $this->service = $service;
    }

    /**
     * @param VerifyEmailRequest $request
     *
     * @return JsonResponse
     *
     * @throws UnauthorizedException
     * @throws UserNotFoundException
     */
    public function verify(VerifyEmailRequest $request): JsonResponse
    {
        $user = $this->service->verify($request->token);

        return app(TokenPresenter::class, [
            'user' => $user
        ])->present();
    }

    /**
     * @param ChangeEmailRequest $request
     *
     * @return JsonResponse
     */
    public function attemptChange(ChangeEmailRequest $request): JsonResponse
    {
        $this->service->attemptChange($request->email);

        return app(AttemptChangePresenter::class)
            ->present();
    }

    /**
     * @param ConfirmEmailChangeRequest $request
     *
     * @return JsonResponse
     *
     * @throws UnauthorizedException
     */
    public function confirmChange(ConfirmEmailChangeRequest $request): JsonResponse
    {
        $this->service->confirmChange(
            $request->user(),
            $request->email,
            $request->code
        );

        return app(ConfirmPresenter::class)
            ->present();
    }
}
