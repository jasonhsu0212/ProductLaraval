<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/', \App\Http\Controllers\ProductController::class);
Route::resource('/products', \App\Http\Controllers\ProductController::class);


