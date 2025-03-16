<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id); // Retrieve product by ID
        return view("products.show", compact("product")); // Return the view with the product
    }
}
