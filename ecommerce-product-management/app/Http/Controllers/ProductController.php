<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Import the Product model

class ProductController extends Controller
{
    // Add Product (store)
    public function store(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'barcode' => 'required|unique:products|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required'
        ]);

        // Create new product
        $product = new Product();
        $product->barcode = $validatedData['barcode'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->quantity = $validatedData['quantity'];
        $product->category = $validatedData['category'];

        $product->save();

        return response()->json(['message' => 'Product added successfully', 'product' => $product], 201);
    }

    // Edit Product (update)
    public function update(Request $request, $id)
    {
        // Find product by ID
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Validate incoming data (except barcode if it’s not being updated)
        $validatedData = $request->validate([
            'barcode' => 'required|max:255|unique:products,barcode,' . $id,
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required'
        ]);

        // Update product information
        $product->barcode = $validatedData['barcode'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->quantity = $validatedData['quantity'];
        $product->category = $validatedData['category'];

        $product->save();

        return response()->json(['message' => 'Product updated successfully', 'product' => $product], 200);
    }


    //DELETE API
    public function destroy($id)
    {

        $product = Product::find($id);


        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }


        $product->delete();


        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

}
