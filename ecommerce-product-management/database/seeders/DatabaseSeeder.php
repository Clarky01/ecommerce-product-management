<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Admin User',
            'email' => 'adminaccount@example.com', // Set the admin email
            'password' => Hash::make('adminpassword12345'), // Set the admin password
            'role' => 'admin',
        ]);

        // Generate random users
        User::factory(10)->create();

        // Generate random product data
        Product::factory()->count(10)->create();
        Product::factory()->outOfStock()->create();

        // Optional: Example of adding a specific user
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
