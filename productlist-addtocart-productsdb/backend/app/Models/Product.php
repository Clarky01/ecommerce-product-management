<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // If the table name is not the plural form of the model name (products for Product model), you can define it here
    protected $table = 'products';

    // Define the fillable fields to allow mass assignment
    protected $fillable = [
        'barcode',      // Item barcode
        'description',  // Product description
        'price',        // Price
        'quantity',     // Available quantity
        'category',     // Category
    ];
}
