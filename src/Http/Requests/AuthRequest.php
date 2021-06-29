<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Requests;

use Exhum4n\Components\Http\Requests\IPRequest;

/**
 * Class AuthRequest
 *
 * @property string email
 */
class AuthRequest extends IPRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email:filter',
                'max:50',
            ],
        ];
    }
}
