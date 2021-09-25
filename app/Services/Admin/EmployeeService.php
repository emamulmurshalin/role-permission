<?php


namespace App\Services\Admin;


use App\Models\Admin\Employee;

class EmployeeService
{
    public function __construct(Employee $employee)
    {
        $this->model = $employee;
    }

    public function showEmployees()
    {
        return $this->model->paginate(10);
    }

    public function showTrashEmployees()
    {
        return $this->model->onlyTrashed()->paginate(10);
    }

    public function saveEmployee($inputData, $imageFile)
    {
        $imageFileName = time().'.'.$imageFile->getClientOriginalExtension();
        $destination_path= 'images';
        if ($imageFile){
            $inputData['image_path'] = $imageFile->storeAs($destination_path, $imageFileName, 'public');
            $dataSaved = $this->model->create($inputData);
            if ($dataSaved){
                return [
                    'status' => 200,
                    'message' => 'Employee created successfully',
                ];
            }
        }else{
            $dataSaved = $this->model->create($inputData);
            return [
                'status' => 404,
                'message' => 'File not uploaded',
            ];
        }
    }

    public function deleteEmployee($id)
    {
        $employee = $this->model->findOrFail($id);
        $dataDeleted = $employee->delete();

        if ($dataDeleted){
            return [
                'status' => 200,
                'message' => 'Employee deleted successfully',
            ];
        }
    }

    public function detailsEmployee($id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateEmployee($inputData, $id, $imageFile)
    {
        $employee = $this->model->findOrFail($id);

        $destination_path= 'images';
        $imageFileName = time().'.'.$imageFile->getClientOriginalExtension();
        if ($imageFile){
            $inputData['image_path'] = $imageFile->storeAs($destination_path, $imageFileName, 'public');
            $dataSaved = $employee->update($inputData);
            if ($dataSaved){
                return [
                    'status' => 200,
                    'message' => 'Employee updated successfully',
                ];
            }
        }else{
            $dataSaved = $employee->update($inputData);

            if ($dataSaved){
                return [
                    'status' => 404,
                    'message' => 'File not uploaded',
                ];
            }
        }

    }
}
