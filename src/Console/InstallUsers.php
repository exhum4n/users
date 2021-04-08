<?php

declare(strict_types=1);

namespace Exhum4n\Users\Console;

use Exhum4n\Components\Console\Installer;
use Exhum4n\Users\Database\Seeds\StatusesSeeder;
use Exhum4n\Users\Providers\UsersServiceProvider;

class InstallUsers extends Installer
{
    /**
     * {@inheritDoc}
     */
    public function handle(): void
    {
        parent::handle();

        $this->call('vendor:publish', [
            '--provider' => UsersServiceProvider::class
        ]);
    }

    /**
     * @var string[]
     */
    protected $seeds = [
        StatusesSeeder::class,
    ];

    /**
     * @return string
     */
    protected function getSignature(): string
    {
        return 'users:install';
    }
}
