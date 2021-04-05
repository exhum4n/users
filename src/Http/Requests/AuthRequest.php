<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Requests;

use Exhum4n\Components\Http\Requests\IPRequest;
use Exhum4n\Users\Models\Credentials;
use Exhum4n\Users\Models\User;

class AuthRequest extends IPRequest
{
    public function rules(): array
    {
        return [
            'byEmail' => [
                'email:rfc',
                'max:50',
                'required_without_all:byUsername,byToken'
            ],
            'byUsername' => [
                'string',
                'exists:' . Credentials::class . ',username',
                'required_without_all:byEmail,byToken'
            ],
            'byToken' => [
                'string',
                'required_without_all:byEmail,byUsername'
            ]
        ];
    }
}
