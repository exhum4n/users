<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Requests;

use Exhum4n\Components\Http\Requests\AbstractRequest;

/**
 * Class EmailConfirmRequest.
 *
 * @property string code
 */
class ConfirmEmailRequest extends AbstractRequest
{
    public function all($keys = null): array
    {
        $data = parent::all($keys);

        $data['code'] = $this->route('code');

        return $data;
    }

    public function rules(): array
    {
        return [
            'code' => 'required',
        ];
    }
}
