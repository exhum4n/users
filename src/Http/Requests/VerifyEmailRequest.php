<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Requests;

use Exhum4n\Components\Http\Requests\AbstractRequest;
use Exhum4n\Users\Models\User;

/**
 * Class VerifyEmailRequest.
 *
 * @property string token
 * @property string email
 */
class VerifyEmailRequest extends AbstractRequest
{
    /**
     * @param null $keys
     *
     * @return array
     */
    public function all($keys = null): array
    {
        $data = parent::all($keys);

        $data['token'] = $this->route('token');

        return $data;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'token' => [
                'required',
            ],
            'email' => [
                'required',
                'exists:' . User::class
            ]
        ];
    }
}
