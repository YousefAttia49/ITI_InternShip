<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Authenticated Routes (auth:sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'profile']);

    // Admin Only API Routes (auth:sanctum + admin)
    Route::middleware('admin')->group(function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('categories', CategoryController::class);
    });

    // Authenticated User API Routes (auth:sanctum)
    Route::apiResource('products', ProductController::class);
});
