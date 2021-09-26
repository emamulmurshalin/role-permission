<?php


namespace Database\Seeders\Admin;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $permissionSeedData = [
            ['name' => 'dashboard_view', 'guard_name' => 'sanctum', 'group_name' => 'Dashboard', 'created_at' => now()],
            ['name' => 'user_view', 'guard_name' => 'sanctum', 'group_name' => 'User', 'created_at' => now()],
            ['name' => 'user_create', 'guard_name' => 'sanctum', 'group_name' => 'User', 'created_at' => now()],
            ['name' => 'user_update', 'guard_name' => 'sanctum', 'group_name' => 'User', 'created_at' => now()],
            ['name' => 'user_delete', 'guard_name' => 'sanctum', 'group_name' => 'User', 'created_at' => now()],
            ['name' => 'role_view', 'guard_name' => 'sanctum', 'group_name' => 'Role', 'created_at' => now()],
            ['name' => 'role_create', 'guard_name' => 'sanctum', 'group_name' => 'Role', 'created_at' => now()],
            ['name' => 'role_update', 'guard_name' => 'sanctum', 'group_name' => 'Role', 'created_at' => now()],
            ['name' => 'role_delete', 'guard_name' => 'sanctum', 'group_name' => 'Role', 'created_at' => now()],
            ['name' => 'employee_view', 'guard_name' => 'sanctum', 'group_name' => 'Employee', 'created_at' => now()],
            ['name' => 'employee_create', 'guard_name' => 'sanctum', 'group_name' => 'Employee', 'created_at' => now()],
            ['name' => 'employee_update', 'guard_name' => 'sanctum', 'group_name' => 'Employee', 'created_at' => now()],
            ['name' => 'employee_delete', 'guard_name' => 'sanctum', 'group_name' => 'Employee', 'created_at' => now()]
        ];
        Permission::query()->insert(
            $permissionSeedData
        );

    }
}
