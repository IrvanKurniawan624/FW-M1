<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'layouts.master');
Route::resource('employees', EmployeeController::class);