<?php

declare(strict_types=1);

namespace Exhum4n\Users\Providers;

use Exhum4n\Components\Providers\AbstractProvider;
use Exhum4n\Users\Console\InstallUsers;
use Exhum4n\Users\Console\UninstallUsers;

class UsersServiceProvider extends AbstractProvider
{
    public function register(): void
    {
        $this->registerInstallCommands();
        $this->registerUninstallCommands();

        $this->commands('exhum4n.users.install');
        $this->commands('exhum4n.users.uninstall');
    }

    protected function registerInstallCommands(): void
    {
        $this->app->singleton('exhum4n.users.install', function () {
            return new InstallUsers();
        });
    }

    protected function registerUninstallCommands(): void
    {
        $this->app->singleton('exhum4n.users.uninstall', function () {
            return new UninstallUsers();
        });
    }
}
