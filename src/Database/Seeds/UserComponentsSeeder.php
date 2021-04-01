<?php

namespace Exhum4n\Users\Database\Seeds;

use Common\Database\Seeds\BaseSeeder;

class UserComponentsSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->call([
            StatusesSeeder::class,
            RolesSeeder::class,
        ]);
    }
}
