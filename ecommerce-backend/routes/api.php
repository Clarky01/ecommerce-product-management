<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::middleware('auth:sanctum')->post('/cart/add', [CartController::class, 'addToCart']);
