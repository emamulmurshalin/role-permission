<?php


namespace Database\Seeders\Admin;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert(
            [
                'name' => 'App Admin',
                'guard_name' => 'sanctum',
                'created_at' => now(),
            ]
        );
        DB::table('roles')->insert(
            [
                'name' => 'Manager',
                'guard_name' => 'sanctum',
                'created_at' => now(),
            ]
        );
        DB::table('roles')->insert(
            [
                'name' => 'Agent',
                'guard_name' => 'sanctum',
                'created_at' => now(),
            ]
        );

    }
}
