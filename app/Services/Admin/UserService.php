<?php


namespace App\Services\Admin;


use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserService
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }
    public function showUsers()
    {
        return DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.name as role_name', 'roles.id as role_id')
            ->paginate();
    }
    public function saveUser($inputData)
    {
        $inputData['password'] = Hash::make('123456');
        $user = $this->model->create($inputData);
        $user->assignRole($inputData['role_id']);
        if ($user) {
            return [
                'status' => 200,
                'message' => 'User created successfully',
            ];
        }
    }
//    public function detailsUser($id)
//    {
//        return DB::table('users')
//            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
//            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
//            ->select('users.*', 'roles.name as role_name', 'roles.id as role_id')
//            ->where('users.id', '=', $id)
//            ->first();
//    }
    public function deleteUser($id)
    {
        $user = $this->model->findOrFail($id);
        $dataDeleted = $user->delete();

        if ($dataDeleted){
            return [
                'status' => 200,
                'message' => 'User deleted successfully',
            ];
        }
    }
    public function updateUser($inputData, $id)
    {
        $inputData['password'] = Hash::make('123456');
        $user = $this->model->findOrFail($id);
        $dataSaved = $user->update($inputData);
        $user->syncRoles([$inputData['role_id']]);
        if ($dataSaved){
            return [
                'status' => 200,
                'message' => 'User updated successfully',
            ];
        }

    }
}
