<?php

use App\Http\Controllers\Admin\Role\PermissionController;
use App\Http\Controllers\Admin\Role\RoleController;
use Illuminate\Support\Facades\Route;

Route::resource('roles', RoleController::class);

Route::get('/all-permissions', [PermissionController::class, 'getAllPermissionByUser'])
    ->name('permission.show');
