<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSlider;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ProductDetails;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Category::factory(10)->create();
        Brand::factory(10)->create();
        Product::factory(100)->has(ProductSlider::factory())->has(ProductDetails::factory())->create();
        
    }
}
