<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'payment_method' => 'required|string',
        ]);

        // Mock cart data - replace with session or database cart later
        $cart = session()->get('cart', [
            ['product_id' => 1, 'name' => 'Product A', 'price' => 50, 'quantity' => 2],
            ['product_id' => 2, 'name' => 'Product B', 'price' => 30, 'quantity' => 1],
        ]);

        if (empty($cart)) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }

        // Calculate total amount
        $totalAmount = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        // Create the order
        $order = Order::create([
            'customer_name' => $validated['name'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'payment_method' => $validated['payment_method'],
            'total_amount' => $totalAmount,
        ]);

        // Add items to the order
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear the cart (in session for now)
        session()->forget('cart');

        return response()->json(['message' => 'Order placed successfully', 'order_id' => $order->id]);
    }
}
