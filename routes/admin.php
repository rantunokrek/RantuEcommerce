<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin-login', [App\Http\Controllers\Auth\loginController::class, 'adminLogin'])->name('admin.login');


Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin.home')
->middleware('is_admin');
