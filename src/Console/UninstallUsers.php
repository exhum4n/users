<?php

declare(strict_types=1);

namespace Exhum4n\Users\Console;

use Exhum4n\Components\Console\Uninstaller;

class UninstallUsers extends Uninstaller
{
    protected function getSignature(): string
    {
        return 'users:uninstall';
    }
}
