<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    
    // View the cart
    public function viewCart(Request $request)
    {
        // If user is authenticated, retrieve cart items
        $cartItems = Auth::check() 
            ? Cart::where('user_id', Auth::id())->get()
            : $request->session()->get('cart', []);

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return response()->json([
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
        ]);
    }

    // Add item to cart
    public function addToCart(Request $request)
    {
        $item = $request->all();

        if (Auth::check()) {
            // Persist cart item in the database for logged-in users
            $cartItem = Cart::updateOrCreate(
                ['user_id' => Auth::id(), 'product_name' => $item['product_name']],
                ['quantity' => \DB::raw('quantity + ' . $item['quantity']), 'price' => $item['price']]
            );
        } else {
            // Handle non-logged-in users by using session
            $cart = $request->session()->get('cart', []);
            // Add or update item in the session cart
            $found = false;
            foreach ($cart as &$cartItem) {
                if ($cartItem['product_name'] === $item['product_name']) {
                    $cartItem['quantity'] += $item['quantity'];
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $cart[] = $item;
            }
            $request->session()->put('cart', $cart);
        }

        return response()->json(['message' => 'Item added to cart']);
    }

    // Remove item from cart
    public function removeFromCart(Request $request, $id)
    {
        if (Auth::check()) {
            // Remove from database for logged-in users
            Cart::where('id', $id)->delete();
        } else {
            // Remove from session for non-logged-in users
            $cart = $request->session()->get('cart', []);
            $cart = array_filter($cart, fn($item) => $item['id'] != $id);
            $cart = array_values($cart);
            $request->session()->put('cart', $cart);
        }

        return response()->json(['message' => 'Item removed from cart']);
    }
    // Update cart item quantity
public function updateQuantity(Request $request, $id)
{
    $cartItem = Cart::find($id);
    $cartItem->quantity = $request->quantity;
    $cartItem->save();

    return response()->json(['message' => 'Quantity updated']);
}

public function checkout(Request $request)
{
    // Get cart items
    $cartItems = Auth::check() 
        ? Cart::where('user_id', Auth::id())->get()
        : $request->session()->get('cart', []);

    // Perform any checkout logic, like calculating totals, processing payment, etc.

    // Clear cart after checkout
    if (Auth::check()) {
        Cart::where('user_id', Auth::id())->delete();
    } else {
        $request->session()->forget('cart');
    }

    return response()->json(['message' => 'Checkout successful']);
}

public function applyDiscount(Request $request)
{
    $discountCode = $request->input('coupon_code');
    
    // Logic to verify the discount code (e.g., 10% off)
    $discount = 0;
    if ($discountCode == 'DISCOUNT10') {
        $discount = 0.10; // 10% discount
    }

    // Apply discount to the total price
    $totalPrice = $this->calculateTotalPrice();  // Calculate the total price from cart items
    $totalPrice -= $totalPrice * $discount;

    return response()->json(['discountedTotal' => $totalPrice]);
}

}


