<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Presenters;

use Exhum4n\Components\Http\Presenters\SimplePresenter;

class ChangeEmailPresenter extends SimplePresenter
{
    /**
     * @return array
     */
    protected function getPresentationData(): array
    {
        return [
            'message' => 'Email was changed',
        ];
    }
}
