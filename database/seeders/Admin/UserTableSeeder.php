<?php


namespace Database\Seeders\Admin;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'Joune',
                'email' => 'admin@demo.com',
                'password' => Hash::make('123456'),
                'created_at' => now(),
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'General',
                'email' => 'general@demo.com',
                'password' => Hash::make('123456'),
                'created_at' => now(),
            ]
        );

    }
}
