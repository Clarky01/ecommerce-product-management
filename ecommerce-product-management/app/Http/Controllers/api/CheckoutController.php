<?php

// app/Http/Controllers/CheckoutController.php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;

class CheckoutController extends Controller
{
    // Checkout Function
    public function checkout(Request $request)
    {
        // Assuming order details are sent in request
        $cartItems = Cart::where('user_id', auth()->id())->get();

        // Create Order
        $order = Order::create([
            'user_id' => auth()->id(),
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->payment_method,
            'total' => $cartItems->sum(fn($item) => $item->product->price * $item->quantity),
        ]);

        // Reduce stock for each product and clear cart
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            $product->decrement('stock', $item->quantity);
            $item->delete(); // Clear cart items
        }

        return response()->json(['success' => true, 'orderId' => $order->id]);
    }
}
