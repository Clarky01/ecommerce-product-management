<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;

// Register API routes for the application

// Example of a general route to check if API is working
Route::get('/health-check', function () {
    return response()->json(['message' => 'API is working!']);
});

// Route for checkout
Route::post('/checkout', [CheckoutController::class, 'checkout']);
