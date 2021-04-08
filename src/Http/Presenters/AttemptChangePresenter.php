<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Presenters;

use Exhum4n\Components\Http\Presenters\SimplePresenter;

class AttemptChangePresenter extends SimplePresenter
{
    /**
     * @return array
     */
    protected function getPresentationData(): array
    {
        return [
            'message' => 'Email verification code was sent on your email.',
        ];
    }
}
