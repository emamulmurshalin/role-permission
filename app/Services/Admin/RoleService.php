<?php


namespace App\Services\Admin;


use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use function Symfony\Component\String\u;

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
    public function deleteRole($id)
    {
        $role = $this->model->findOrFail($id);
        if ($role->name == 'App Admin'){
            return [
                'status' => 200,
                'message' => 'Permission denied',
            ];
        }
        $dataDeleted = $role->delete();

        if ($dataDeleted){
            return [
                'status' => 200,
                'message' => 'Role deleted successfully',
            ];
        }
    }
}
