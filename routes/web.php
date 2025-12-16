<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index']);

Route::get('/create', [ProductController::class, 'create']);

Route::get('/edit/{id}', [ProductController::class, 'edit']);
