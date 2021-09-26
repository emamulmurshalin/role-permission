<?php

use App\Http\Controllers\Admin\Role\RoleController;
use Illuminate\Support\Facades\Route;

Route::resource('roles', RoleController::class);
