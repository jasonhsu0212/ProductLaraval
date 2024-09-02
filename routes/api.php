<?php

use App\Http\Controllers\AuthController;
use App\Models\Department;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:api')->group(function(){
//     Route::apiResource('employee', 'EmployeeController');
// });


Route::prefix('api')->group(function () {
  Route::get('/products', [ProductController::class, 'index']);
  Route::post('/products', [ProductController::class, 'add']);
  Route::put('/products/{product}', [ProductController::class, 'update']);
  Route::delete('/products/{product}', [ProductController::class, 'destroy']);
});

Route::prefix('api')->group(function () {
  Route::get('/employees', [EmployeeController::class, 'index']);
  Route::post('/employees', [EmployeeController::class, 'createEmployee']);
  Route::put('/employees/{employee}', [EmployeeController::class, 'updateEmployee']);
});

route::controller(AuthController::class)->group(function () {
  route::post('/login', [AuthController::class, 'login']);
  route::post('/register', [AuthController::class, 'register']);
});
