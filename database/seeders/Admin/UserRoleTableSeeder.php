<?php


namespace Database\Seeders\Admin;


use App\Models\User;
use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    public function run()
    {
        $user = User::query()->find(1);
        $user->assignRole('App Admin');
        // manager
        $user = User::query()->find(2);
        $user->assignRole('Manager');
        //agent
        $user = User::query()->find(3);
        $user->assignRole('Agent');

    }
}
