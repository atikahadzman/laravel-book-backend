<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookmarkController;

Route::apiResource('users', UsersController::class);
Route::apiResource('book', BookController::class);
Route::apiResource('bookmark', BookmarkController::class);