<?php

use App\Models\Department;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/docs', 'scribe.index')->name('scribe');
Route::view('/admin/docs', 'scribe_admin.index')->name('scribe-admin');

