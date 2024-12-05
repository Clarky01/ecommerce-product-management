<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CartController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// apiResource automatically generates all necessary routes for products
Route::apiResource('/products', ProductController::class);
Route::apiResource('/users', AuthController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register']);

Route::get('cart', [CartController::class, 'viewCart']); // View the cart
Route::post('cart', [CartController::class, 'addToCart']); // Add item to cart
Route::delete('cart/{id}', [CartController::class, 'removeFromCart']); // Remove item from cart
Route::put('cart/{id}', [CartController::class, 'updateQuantity']);
Route::post('checkout', [CartController::class, 'checkout']);
Route::middleware('auth:sanctum')->get('cart', [CartController::class, 'viewCart']);
Route::middleware('auth:sanctum')->post('cart', [CartController::class, 'addToCart']);
Route::middleware('auth:sanctum')->delete('cart/{id}', [CartController::class, 'removeFromCart']);
Route::post('cart/discount', [CartController::class, 'applyDiscount']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

