<?php

use Illuminate\Support\Facades\Route;  // Import Route facade
use App\Http\Controllers\ProductController;  // Import the ProductController

// Add product route
Route::post('/products', [ProductController::class, 'store']);

// Edit product route
Route::put('/products/{id}', [ProductController::class, 'update']);
