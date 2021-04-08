<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Presenters;

use Exhum4n\Components\Http\Presenters\SimplePresenter;

class ConfirmPresenter extends SimplePresenter
{
    /**
     * @return string[]
     */
    protected function getPresentationData(): array
    {
        return [
            'message' => 'Email was successfully changed.',
        ];
    }
}
