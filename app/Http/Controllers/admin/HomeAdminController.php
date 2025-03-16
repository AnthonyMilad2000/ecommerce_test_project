<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; // Correct import

class HomeAdminController extends Controller
{
    public function index() {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with('error', 'Please login first.');
        }
    
        $totalProducts = Product::count();
        $totalReviews = Review::count();
        $totalCategories = Category::count();
    
        return view("admin.dashboard", [
            'totalProducts' => $totalProducts,
            'totalReviews' => $totalReviews,
            'totalCategories' => $totalCategories,

        ]);
    }
    

    public function logout(Request $request) { // Inject Request instance
        Auth::guard('admin')->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
