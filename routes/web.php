<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AdminProductController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\HomeAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\ProductImageController;
use App\Http\Controllers\admin\TempImagesController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

Route::group(['prefix' => 'account', 'middleware' => ['web']], function () {  
    Route::group(['middleware' => 'guest'], function () {  
        // Login  
        Route::get('/login', [AuthController::class, 'login'])->name('login');  
        Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');  

        // Register  
        Route::get('/register', [AuthController::class, 'register'])->name('register');  
        Route::post('/process-register', [AuthController::class, 'processRegister'])->name('processRegister');  
    });  

    // Logout (for authenticated users only)  
    Route::group(['middleware' => 'auth'], function () {  
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');  
    });  
});








Route::get("/", [HomeController::class, "index"])->name('home');
Route::get("/products/{id}", [ProductController::class, "show"])->name("products.show");

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products/{id}/review', [ProductController::class, 'submitReview'])->middleware('auth');
Route::get('/product/{id}',[ProductController::class,'product'])->name('prdocut.details');

Route::prefix('admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');  
        Route::get('/dashboard', [HomeAdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout',[HomeAdminController::class, 'logout'])->name('admin.logout');
        //Category route
        Route::get('/categories',[CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create',[CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories',[CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit',[CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}',[CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}',[CategoryController::class, 'destroy'])->name('categories.delete');
        

        //Product Routes
        Route::get('/products',[AdminProductController::class, 'index'])->name('products.list');
        Route::get('/products/create',[AdminProductController::class, 'create'])->name('products.create');
        Route::post('/products',[AdminProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit',[AdminProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}',[AdminProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}',[AdminProductController::class, 'destroy'])->name('products.delete');
        Route::get('/get-products',[AdminProductController::class,'getProducts'])->name('products.getProducts');
        Route::get('/ratings',[AdminProductController::class, 'productRatings'])->name('products.productRatings');
        Route::get('/change-rating-status',[AdminProductController::class, 'changeRatingStatus'])->name('products.changeRatingStatus');
        Route::post('/product-images/update',[ProductImageController::class, 'update'])->name('product-images.update');
        Route::delete('/product-images',[ProductImageController::class, 'destroy'])->name('product-images.destroy');

        
            
        //temp-images.create
        Route::post('/upload-temp-image',[TempImagesController::class, 'create'])->name('temp-images.create');

        // Status update (eg: http://127.0.0.1:8000/admin/products/8/status/1)
        Route::get('/products/{id}/status/{status}', [AdminProductController::class, 'updateStatus'])
        ->name('products.updateStatus');
        
        // For Slug
        Route::get('/generate-slug', [CategoryController::class, 'generateSlug'])->name('generate.slug');
        Route::get('/getSlug',function(Request $request){
            $slug = '';
            if(!empty($request->title)){
                $slug = Str::slug($request->title);
            }
            return response()->json([
                'status' => true,
                'slug' => $slug
            ]);
        })->name('getSlug');

});
