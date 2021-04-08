<?php

declare(strict_types=1);

namespace Exhum4n\Users\Providers;

use Exhum4n\Components\Providers\AbstractProvider;
use Exhum4n\Users\Console\InstallUsers;
use Exhum4n\Users\Console\UninstallUsers;

class UsersServiceProvider extends AbstractProvider
{
    /**
     * {@inheritDoc}
     */
    public function register(): void
    {
        $this->registerInstallCommands();
        $this->registerUninstallCommands();

        $this->registerViews('emails', 'emails');

        $this->mergeConfigs('auth');
    }

    /**
     * Register install command
     */
    private function registerInstallCommands(): void
    {
        $name = 'exhum4n.users.install';

        $this->registerCommand($name, InstallUsers::class);

        $this->commands($name);
    }

    /**
     * Register uninstall command
     */
    private function registerUninstallCommands(): void
    {
        $name = 'exhum4n.users.uninstall';

        $this->registerCommand($name, UninstallUsers::class);

        $this->commands($name);
    }
}
