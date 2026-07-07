<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Protected Routes (Login Required)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Profile
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    /*
    |--------------------------------------------------------------------------
    | Admin Only
    |--------------------------------------------------------------------------
    */

    Route::middleware('admin')->group(function () {

        // List User + Search + Pagination + Sorting
        Route::get('/users', [UserController::class, 'index']);

        // Detail User
        Route::get('/users/{id}', [UserController::class, 'show']);

        // Tambah User
        Route::post('/users', [UserController::class, 'store']);

        // Update User
        Route::put('/users/{id}', [UserController::class, 'update']);

        // Hapus User
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
    });
});