<?php

declare(strict_types=1);

namespace Exhum4n\Users\Services;

use Exhum4n\Users\Exceptions\AuthException;
use Exhum4n\Users\Exceptions\UnauthorizedException;
use Exhum4n\Users\Models\Status;
use Exhum4n\Users\Models\User;
use Exhum4n\Users\Traits\Clients;
use Exhum4n\Users\Traits\Credentials;
use Exhum4n\Users\Traits\Users;
use Exhum4n\Users\Traits\Verifications;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    use Clients;
    use Users;
    use Verifications;
    use Credentials;

    /**
     * @param string $email
     * @param string $ip
     * @param string|null $code
     *
     * @return User
     *
     * @throws AuthException
     */
    public function byEmail(string $email, string $ip, ?string $code = null): User
    {
        $user = $this->getUserByEmail($email);
        if (is_null($user)) {
            $user = $this->createClient($email, $ip, $code);

            $this->sendVerificationLink($email);

            return $user;
        }

        if ($user->status_id === Status::ID_BLOCKED) {
            throw new AuthException('user_is_blocked');
        }

        $this->sendVerificationCode($email);

        throw new AuthException('send_verification_code', 203);
    }

    public function ByToken(string $token): User
    {
        //
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return User
     *
     * @throws UnauthorizedException
     */
    public function byUsername(string $username, string $password): User
    {
        $credentials = $this->getUserCredentialsByUsername($username);
        if (is_null($credentials)) {
            throw new UnauthorizedException();
        }

        if (Hash::check($password, $credentials->password) === false) {
            throw new UnauthorizedException();
        }

        return $credentials->user;
    }
}
