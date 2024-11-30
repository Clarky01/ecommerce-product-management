<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


Route::post('register', function (Request $request) {
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return response()->json(['message' => 'User registered successfully']);
});

Route::post('login', function (Request $request) {
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $user = Auth::user();
        return response()->json(['token' => $user->createToken('YourApp')->plainTextToken]);
    }

    return response()->json(['message' => 'Unauthorized'], 401);
});

Route::get('cart', [CartController::class, 'viewCart']); // View the cart
Route::post('cart', [CartController::class, 'addToCart']); // Add item to cart
Route::delete('cart/{id}', [CartController::class, 'removeFromCart']); // Remove item from cart
Route::put('cart/{id}', [CartController::class, 'updateQuantity']);
Route::post('checkout', [CartController::class, 'checkout']);
Route::middleware('auth:sanctum')->get('cart', [CartController::class, 'viewCart']);
Route::middleware('auth:sanctum')->post('cart', [CartController::class, 'addToCart']);
Route::middleware('auth:sanctum')->delete('cart/{id}', [CartController::class, 'removeFromCart']);
Route::post('cart/discount', [CartController::class, 'applyDiscount']);

