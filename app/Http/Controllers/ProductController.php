<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Get Featured Products
        $products = Product::where('status', 1)
            ->latest()
            ->paginate(12);
    
        
        // Start product query
        
    
        // Filter by search query
        if (!empty($request->get('search'))) {
            $products->where('name', 'like', '%' . $request->get('search') . '%');
        }
    
        
        
    
        return view("products.index", compact("products"));
    }
    
    

    
        public function show($id)
        {
            $product = Product::findOrFail($id); // Retrieve product by ID
            return view("products.show", compact("product")); // Return the view with the product
        }
    
        public function submitReview(Request $request, $id) {
            // Validate the request
            $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'required|string|max:1000',
            ]);
        
            // Check if product exists
            $product = Product::findOrFail($id);
        
            // Create a new review
            Review::create([
                'user_id' => auth()->id(), // Ensure user is logged in
                'product_id' => $id,
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
        
            return redirect()->back()->with('success', 'Review submitted successfully!');
        }
        
       
       
       
        public function saveRating($id, Request $request)
{
    // Get the authenticated user
    $user = auth()->user();
    
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'comment' => 'required',
        'rating' => 'required|numeric|min:1|max:5', // Adding rating validation for numeric values between 1 and 5
    ]);
    
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }

    // Create a new review and save the user's rating for the product
    $productRating = new Review;
    $productRating->product_id = $id;
    $productRating->user_id = $user->id; // Use authenticated user's ID
    $productRating->comment = $request->comment;
    $productRating->rating = $request->rating;
    $productRating->status = 0; // Assuming '0' is the default status for the review (can be changed as needed)
    
    $productRating->save();

    // Flash success message
    session()->flash('success', 'Thanks for your rating.');

    // Return success response
    return response()->json([
        'status' => true,
        'message' => 'Thanks for your rating.'
    ]);
}

        
}
