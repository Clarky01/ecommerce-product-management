<?php

use Illuminate\Support\Facades\Route;

// routes/web.php
use App\Http\Controllers\CheckoutController;

Route::prefix('api')->group(function () {
    Route::post('/checkout', [CheckoutController::class, 'checkout']);
});
