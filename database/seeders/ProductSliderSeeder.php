<?php

namespace Database\Seeders;

use App\Models\ProductSlider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductSlider::create([
            'product_id' => 1,
            'title' => 'Product 1',
            'short_desc' => 'Short description for Product 1',
            'price' => 100.00,
        ]);
        ProductSlider::create([
            'product_id' => 3,
            'title' => 'Product 3 slider',
            'short_desc' => 'Short description for Product 3',
            'price' => 100.00,
        ]);
    }
}
