<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // User biasa
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // Seed categories
        $this->call(CategorySeeder::class);

        // Create sample products
        $categories = Category::all();
        
        if ($categories->count() > 0) {
            Product::create([
                'name' => 'Parfum Elegant Rose',
                'description' => 'Parfum dengan aroma bunga rose yang elegan',
                'category_id' => $categories->where('name', 'Wanita')->first()->id ?? $categories->first()->id,
                'price' => 250000,
                'stock' => 50,
            ]);

            Product::create([
                'name' => 'Parfum Ocean Breeze',
                'description' => 'Parfum dengan aroma laut yang segar',
                'category_id' => $categories->where('name', 'Pria')->first()->id ?? $categories->first()->id,
                'price' => 300000,
                'stock' => 30,
            ]);

            Product::create([
                'name' => 'Parfum Citrus Fresh',
                'description' => 'Parfum dengan aroma citrus yang menyegarkan',
                'category_id' => $categories->where('name', 'Unisex')->first()->id ?? $categories->first()->id,
                'price' => 200000,
                'stock' => 75,
            ]);
        }
    }
}
