<?php


namespace App\Services\Admin;


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
}
