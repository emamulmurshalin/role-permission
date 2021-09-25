<?php

namespace Database\Seeders;

use Database\Seeders\Admin\PermissionTableSeeder;
use Database\Seeders\Admin\RoleHasPermissionTableSeeder;
use Database\Seeders\Admin\RoleTableSeeder;
use Database\Seeders\Admin\UserRoleTableSeeder;
use Database\Seeders\Admin\UserTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(RoleHasPermissionTableSeeder::class);
    }
}
