<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Requests;

use Exhum4n\Users\Models\User;
use Exhum4n\Components\Http\Requests\AbstractRequest;

/**
 * @property string email
 * @property int code
 */
class ConfirmAuthRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'exists:' . User::class,
            ],
            'code' => [
                'required',
                'integer',
                'min:1000',
                'max:9999',
            ]
        ];
    }
}
