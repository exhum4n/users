<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Requests;

use Exhum4n\Components\Http\Requests\IPRequest;

/**
 * Class AuthorizeRequest.
 *
 * @property string email
 */
class AuthorizeRequest extends IPRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email:rfc|max:50',
        ];
    }
}
