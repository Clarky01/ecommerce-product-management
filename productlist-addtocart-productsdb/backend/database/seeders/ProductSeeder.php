<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a specific product
        Product::create([
            'barcode' => '987654321001',
            'description' => 'High-quality wireless headphones.',
            'price' => 99.99,
            'quantity' => 50,
            'category' => 'Electronics',
        ]);

        // Generate 20 additional dummy products using a factory
        Product::factory(20)->create();
    }
}
