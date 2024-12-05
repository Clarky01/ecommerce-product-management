<?php

// app/Http/Controllers/CartController.php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    // View Cart
    public function viewCart()
    {
        // Get cart data for the user (use session or a cart table)
        $cartItems = Cart::where('user_id', auth()->id())->get(); // Assuming there's a user-specific cart

        return response()->json([
            'items' => $cartItems,
            'grandTotal' => $cartItems->sum(fn($item) => $item->product->price * $item->quantity),
        ]);
    }

    // Update Cart Quantity
    public function updateCart($productId, Request $request)
    {
        $cartItem = Cart::where('user_id', auth()->id())
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => $request->quantity]);
        }

        return response()->json(['success' => true]);
    }

    // Remove Item from Cart
    public function removeFromCart($productId)
    {
        Cart::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->delete();

        return response()->json(['success' => true]);
    }
}
