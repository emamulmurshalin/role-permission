<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Services\Admin\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(EmployeeService $employeeService)
    {
        $this->service = $employeeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->service->showEmployees();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email',
            'gender' => 'required',
            'image' => 'required|file',
            'skills' => 'required',
        ]);

        if($imageFile = $request->file('image')){
            //$name =  $file->getClientOriginalName();
            $imageFileName = time().'.'.$imageFile->getClientOriginalExtension();
            $request['image_path'] = 'image_'.$imageFileName;
        }
        return $this->service->saveEmployee($request->all(), $imageFile);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->service->detailsEmployee($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->service->deleteEmployee($id);
    }

    public function updateEmployee(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email',
            'gender' => 'required',
            'image' => 'required|file',
            'skills' => 'required',
        ]);

        if($imageFile = $request->file('image')){
            //$name =  $file->getClientOriginalName();
            $imageFileName = time().'.'.$imageFile->getClientOriginalExtension();
            $request['image_path'] = $imageFileName;
        }
        return $this->service->updateEmployee($request->all(), $id, $imageFile);
    }

    public function trashEmployee()
    {
        return $this->service->showTrashEmployees();
    }
}
