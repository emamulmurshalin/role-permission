<?php

use App\Http\Controllers\Admin\Employee\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/employee/list/view', function () {
    return view('admin.employee.all-employee');
})->name('employee');

Route::get('/soft-delete-employees', function () {
    return view('admin.employee.trash-employee');
})->name('employee');

Route::resource('employee', EmployeeController::class);
Route::post('/employee-update/{id}', [EmployeeController::class, 'updateEmployee'])
    ->name('update.employee');
Route::get('/trash-employee', [EmployeeController::class, 'trashEmployee'])
    ->name('trash.employee');
