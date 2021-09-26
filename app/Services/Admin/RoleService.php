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
}
