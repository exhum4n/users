<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Requests;

use Exhum4n\Users\Models\User;
use Exhum4n\Components\Http\Requests\IPRequest;

/**
 * Class ChangeEmailRequest.
 *
 * @property string $email
 */
class ChangeEmailRequest extends IPRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email:rfc,dns',
                'unique:' . User::class,
            ],
        ];
    }
}
