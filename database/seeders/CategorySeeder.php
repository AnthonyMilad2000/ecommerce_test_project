<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Create some example categories
        Category::create(["name" => "Electronics"]);
        Category::create(["name" => "Books"]);
        Category::create(["name" => "Clothing"]);
        // Add more categories as needed
    }
}
