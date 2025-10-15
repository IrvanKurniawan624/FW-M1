<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

Route::get('/', function ()
{
    return Redirect::Route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::resource('employees', EmployeeController::class);