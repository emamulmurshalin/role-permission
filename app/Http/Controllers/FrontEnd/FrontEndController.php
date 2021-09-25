<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function employeeListView()
    {
        return view('admin.employee.all-employee');
    }
    public function trashEmployeeListView()
    {
        return view('admin.employee.trash-employee');
    }
    public function userListView()
    {
        return view('admin.user.show-user');
    }
}
