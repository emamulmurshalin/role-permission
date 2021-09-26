<?php

//Employee
use App\Http\Controllers\FrontEnd\FrontEndController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;


Route::middleware([Authenticate::class])->group(function () {
    Route::get('/employee/list/view', [FrontEndController::class, 'employeeListView'])
        ->name('employee.list_view');

    Route::get('/soft-delete-employees', [FrontEndController::class, 'trashEmployeeListView'])
        ->name('employee.trash_list_view');

//User
    Route::get('/user/list/view', [FrontEndController::class, 'userListView'])
        ->name('user.list_view');

//Roles
    Route::get('/role/list/view', [FrontEndController::class, 'roleListView'])
        ->name('role.list_view');
});

