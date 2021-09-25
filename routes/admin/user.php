<?php

use App\Http\Controllers\Admin\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/user/list/view', function () {
    return view('admin.user.show-user');
})->name('user.list_view');
Route::resource('users', UserController::class);
