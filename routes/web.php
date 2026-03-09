<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BookController;

// Route::get('/users', [UsersController::class, 'index']);
Route::apiResource('users', UsersController::class);
Route::apiResource('book', BookController::class);