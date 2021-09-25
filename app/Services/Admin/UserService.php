<?php


namespace App\Services\Admin;


use App\Models\User;
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
        return $this->model->paginate(10);
    }
    public function saveUser($inputData)
    {
        $inputData['password'] = Hash::make('123456');
        $dataSaved = $this->model->create($inputData);
        if ($dataSaved) {
            return [
                'status' => 200,
                'message' => 'User created successfully',
            ];
        }
    }
    public function detailsUser($id)
    {
        return $this->model->findOrFail($id);
    }
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
        if ($dataSaved){
            return [
                'status' => 200,
                'message' => 'User updated successfully',
            ];
        }

    }
}
