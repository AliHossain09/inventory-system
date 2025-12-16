<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index']);

Route::get('/create', [ProductController::class, 'create']);
Route::post('/store', [ProductController::class, 'store']);

Route::get('/edit/{id}', [ProductController::class, 'edit']);

Route::delete('/delete/{id}', [ProductController::class, 'destroy']);
