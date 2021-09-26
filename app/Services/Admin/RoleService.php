<?php


namespace App\Services\Admin;


use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleService
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }
    public function showRoles()
    {
        return $this->model->paginate(10);
    }
    public function saveRole($inputData)
    {
        $role = $this->model->create($inputData);
        if ($inputData['permissions']){
            $role->givePermissionTo($inputData['permissions']);
            return [
                'status' => 200,
                'message' => 'Role created successfully',
            ];
        }else{
            return [
                'status' => 200,
                'message' => 'Role created without permission',
            ];
        }
    }
    public function detailsRole($id)
    {
//        return DB::table('roles')
//            ->join('role_has_permissions', 'role_has_permissions.role_id', '=', 'roles.id')
//            ->join('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
//            ->select('roles.*', 'permissions.id', 'permissions.name')
//            ->where('roles.id', '=', $id)
//            ->groupByRaw('permissions.name')
//            ->get();
    }
}
