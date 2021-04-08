<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Requests;

use Exhum4n\Users\Models\User;
use Exhum4n\Components\Http\Requests\IPRequest;

/**
 * Class ConfirmEmailChangeRequest.
 *
 * @property int $code
 * @property string $email
 */
class ConfirmEmailChangeRequest extends IPRequest
{
    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'code' => [
                'required',
                'integer'
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'unique:' . User::class,
            ],
        ];
    }
}
