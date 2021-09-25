<?php


namespace Database\Seeders\Admin;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->insert(
            [
                'name' => 'dashboard_view',
                'guard_name' => 'sanctum',
                'group_name' => 'Dashboard',
                'created_at' => now(),
            ]
        );
        DB::table('permissions')->insert(
            [
                'name' => 'user_view',
                'guard_name' => 'sanctum',
                'group_name' => 'User',
                'created_at' => now(),
            ]
        );
        DB::table('permissions')->insert(
            [
                'name' => 'user_create',
                'guard_name' => 'sanctum',
                'group_name' => 'User',
                'created_at' => now(),
            ]
        );
        DB::table('permissions')->insert(
            [
                'name' => 'user_update',
                'guard_name' => 'sanctum',
                'group_name' => 'User',
                'created_at' => now(),
            ]
        );
        DB::table('permissions')->insert(
            [
                'name' => 'user_delete',
                'guard_name' => 'sanctum',
                'group_name' => 'User',
                'created_at' => now(),
            ]
        );
        DB::table('permissions')->insert(
            [
                'name' => 'employee_view',
                'guard_name' => 'sanctum',
                'group_name' => 'Employee',
                'created_at' => now(),
            ]
        );
        DB::table('permissions')->insert(
            [
                'name' => 'employee_create',
                'guard_name' => 'sanctum',
                'group_name' => 'Employee',
                'created_at' => now(),
            ]
        );
        DB::table('permissions')->insert(
            [
                'name' => 'employee_update',
                'guard_name' => 'sanctum',
                'group_name' => 'Employee',
                'created_at' => now(),
            ]
        );
        DB::table('permissions')->insert(
            [
                'name' => 'employee_delete',
                'guard_name' => 'sanctum',
                'group_name' => 'Employee',
                'created_at' => now(),
            ]
        );

    }
}
