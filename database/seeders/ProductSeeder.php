<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Generate 10 product records using the factory
        Product::factory()
            ->count(10)
            ->create();
    }
}
