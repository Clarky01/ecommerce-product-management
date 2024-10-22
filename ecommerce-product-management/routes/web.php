<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;  // Import the ProductController

Route::get('/', function () {
    return view('welcome');
});

// I ADDED THE ROUTING HERE SINCE THE API.PHP IS NOT WORKING SINCE 

// // Add product route
// Route::post('/products', [ProductController::class, 'store']);

// // Edit product route
// Route::put('/products/{id}', [ProductController::class, 'update']);

// //Delete product route
// Route::delete('/products/{id}', [ProductController::class, 'destroy']);

// // Fetch a specific product by ID
// Route::get('/products/{id}', [ProductController::class, 'show']);