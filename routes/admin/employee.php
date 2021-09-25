<?php

use App\Http\Controllers\Admin\Employee\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::resource('employee', EmployeeController::class);
Route::post('/employee-update/{id}', [EmployeeController::class, 'updateEmployee'])
    ->name('update.employee');
Route::get('/trash-employee', [EmployeeController::class, 'trashEmployee'])
    ->name('trash.employee');
