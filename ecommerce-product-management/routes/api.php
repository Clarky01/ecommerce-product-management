<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// apiResource automatically generates all necessary routes for products
Route::apiResource('/products', ProductController::class);


// User routes
Route::get('/users', [UserController::class, 'index']); // Get all users
Route::post('/users', [UserController::class, 'store']); // Create a new user
Route::get('/users/{id}', [UserController::class, 'show']); // Get a specific user by ID
Route::put('/users/{id}', [UserController::class, 'update']); // Update a specific user by ID
Route::delete('/users/{id}', [UserController::class, 'destroy']); // Delete a specific user by ID
