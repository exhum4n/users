<?php

declare(strict_types=1);

namespace Exhum4n\Users\Services;

use Exhum4n\Users\Exceptions\AuthorizationException;
use Exhum4n\Users\Exceptions\UnauthorizedException;
use Exhum4n\Users\Models\Status;
use Exhum4n\Users\Models\User;
use Exhum4n\Users\Repositories\AuthTokenRepository;
use Exhum4n\Users\Traits\Clients;
use Exhum4n\Users\Traits\Users;

/**
 * Class AuthService.
 *
 * @method void setVerificationCode(string $email, int $code)
 * @method string getVerificationCode(string $email)
 * @method void deleteVerificationCode(string $email)
 */
class AuthService
{
    use Clients;
    use Users;

    /**
     * @var VerificationService
     */
    public $verifications;

    /**
     * @var AuthTokenRepository
     */
    protected $tokens;

    /**
     * @param VerificationService $verifications
     * @param AuthTokenRepository $tokens
     */
    public function __construct(VerificationService $verifications, AuthTokenRepository $tokens)
    {
        $this->verifications = $verifications;
        $this->tokens = $tokens;
    }

    /**
     * @param string $email
     * @param string $ip
     * @param string|null $code
     *
     * @return User
     *
     * @throws AuthorizationException
     */
    public function byEmail(string $email, string $ip, ?string $code = null): User
    {
        $user = $this->getUserByEmail($email);
        if (is_null($user)) {
            $user = $this->createClient($email, $ip, $code);

            $this->verifications->sendAuthorizationLink($email);

            return $user;
        }

        if ($user->status_id === Status::ID_BLOCKED) {
            throw new AuthorizationException(trans('auth.blocked'), 403);
        }

        $this->verifications->sendVerificationCode($email);

        throw new AuthorizationException(trans('auth.need_confirmation'));
    }

    /**
     * @param string $token
     *
     * @return User
     *
     * @throws UnauthorizedException
     */
    public function byToken(string $token): User
    {
        $email = $this->tokens->getEmailByToken($token);
        if (is_null($email)) {
            throw new UnauthorizedException('Token was expired');
        }

        return $this->getUserByEmail($email);
    }
}
