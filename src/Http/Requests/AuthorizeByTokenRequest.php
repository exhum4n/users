<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Requests;

use Exhum4n\Components\Http\Requests\IPRequest;

/**
 * Class AuthorizeByTokenRequest.
 *
 * @property string token
 */
class AuthorizeByTokenRequest extends IPRequest
{
    public function all($keys = null): array
    {
        $data = parent::all($keys);

        $data['token'] = $this->route('token');

        return $data;
    }

    public function rules(): array
    {
        return [
            'token' => 'required|string',
        ];
    }
}
