<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ProductFactory extends Factory
{
    // Define the corresponding model
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'barcode' => $this->faker->unique()->ean13, // Generates a unique barcode
            'description' => $this->faker->sentence, // Generates a random product description
            'price' => $this->faker->randomFloat(2, 5, 500), // Random price between 5 and 500
            'quantity' => $this->faker->numberBetween(1, 100), // Random quantity between 1 and 100
            'category' => $this->faker->word, // Random category
        ];
    }
}
