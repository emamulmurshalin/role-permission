<?php


namespace Database\Seeders\Admin;


use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionTableSeeder extends Seeder
{
    public function run()
    {
//        $appAdmin = User::find(1);
//        $manager = User::find(2);
//        $agent = User::find(3);

        $appAdminRole = Role::where('name', 'App admin')->first();
        $managerRole = Role::where('name', 'Manager')->first();
        $agentRole = Role::where('name', 'Agent')->first();

        $appAdminPermission = Permission::pluck('name')->toArray();

        $appAdminRole->givePermissionTo($appAdminPermission);

        $managerRole->givePermissionTo([
            'dashboard_view',
            'user_view',
            'user_create',
            'user_update',
            'employee_view',
            'employee_create',
            'employee_update'
        ]);

        $agentRole->givePermissionTo([
            'dashboard_view',
            'user_view',
            'employee_view',
        ]);
    }
}
