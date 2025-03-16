<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Review;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Image;

class AdminProductController extends Controller
{
    public function index(Request $request){
        $products = Product::latest('id')->with('product_images');
        if($request->get('keyword')!=""){
            $products = $products->where('title','like','%'.$request->keyword.'%');
        }
        $products =$products->paginate();
        $data['products']=$products;
        return view('admin.products.list', compact('products'));
        
    }
    public function create(){
        $data = [];
        $categories = Category::orderBy('name','ASC')->get();
        $data['categories'] = $categories;

        return view('admin.products.create',$data);
    }

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'category_id' => 'required|numeric',
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required|string',
            'is_featured' => 'required|in:Yes,No',
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        // If validation passes
        if ($validator->passes()) {
            // Create new product
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock = $request->stock;
            // $product->status = $request->status;
            $product->category_id = $request->category_id;
            $product->is_featured = $request->is_featured;
            $product->save();
    
            // Ensure directories exist and are writable
            $largePath = public_path('uploads/product/large');
            $smallPath = public_path('uploads/product/small');
    
            if (!File::exists($largePath)) {
                File::makeDirectory($largePath, 0755, true);
            }
    
            if (!File::exists($smallPath)) {
                File::makeDirectory($smallPath, 0755, true);
            }
    
            // Save Gallery Pics
            if (!empty($request->image_array)) {
                foreach ($request->image_array as $temp_image_id) {
                    $tempImageInfo = TempImage::find($temp_image_id);
    
                    // Check if temp image exists
                    if (!$tempImageInfo) {
                        Log::error('Temp image not found: ' . $temp_image_id);
                        continue;
                    }
    
                    // Extract image extension
                    $extArray = explode('.', $tempImageInfo->name);
                    $ext = last($extArray); // like jpg, gif, png etc.
    
                    // Create new ProductImage entry
                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image = 'NULL'; // Placeholder
                    $productImage->save();
    
                    $imageName = $product->id . '-' . $productImage->id . '-' . time() . '.' . $ext;
                    $productImage->image = $imageName;
                    $productImage->save();
    
                    // Path for temporary image
                    $sourcePath = public_path('temp/' . $tempImageInfo->name);
    
                    // Check if the source image exists
                    if (!File::exists($sourcePath)) {
                        Log::error('Source image not found: ' . $sourcePath);
                        continue;
                    }
    
                    // Large image path
                    $destPathLarge = public_path('uploads/product/large/' . $imageName);
                    $destPathSmall = public_path('uploads/product/small/' . $imageName);
    
                    try {
                        // Process large image
                        $image = Image::make($sourcePath);
                        $image->resize(1400, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        $image->save($destPathLarge);
    
                        // Process small image
                        $image->fit(300, 300);
                        $image->save($destPathSmall);
    
                        Log::info('Large and small images saved successfully for ' . $imageName);
                    } catch (\Exception $e) {
                        Log::error('Error processing image: ' . $e->getMessage());
                    }
                }
            }
    
            // Flash success message and return response
            $request->session()->flash('success', 'Product added successfully');
    
            return response()->json([
                'status' => true,
                'message' => 'Product added successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    
    public function edit($id, Request $request){

        $product = Product::find($id);

        if(empty($product)){
           // $request->session()->flash('error','Product not found');
            return redirect()->route('products.list')->with('error','Product not found');
        }
        // Fetch product Images

        $productImages = ProductImage::where('product_id',$product->id)->get();
        

        $data = [];
        $categories = Category::orderBy('name','ASC')->get();
        $data['categories'] = $categories;
        $data['product'] = $product;
        $data['productImages'] = $productImages;

        return  view('admin.products.edit',$data);
    }

    public function update($id,Request $request){
        $product = Product::find($id);

        $rules =[
            'category_id' =>'required|numeric',
            'name' =>'required',
            'price' =>'required|numeric',
            'stock'=>'required|numeric',
            'description'=>'required|string',
            'is_featured' =>'required|in:Yes,No',
        ];
        $validator = Validator:: make($request->all(), $rules);
        if ($validator->passes()) {


                $product->name = $request->name;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->stock = $request->stock;

                // $product->status = $request->status;
                $product->category_id = $request->category_id;
                $product->is_featured = $request->is_featured;
                $product->save();

                //Save Gallery Pics
               
                $request->session()->flash('success','Product updated successfully');

                return response()->json([
                    'status' => true,
                    'message' => 'Product updated successfully'
                    ]);
        } else {
            return response()->json([
            'status' => false,
            'errors' => $validator->errors()
            ]);
        }
    }


    public function destroy($id, Request $request) {
        $product = Product::find($id);
        if (empty($product)) {
       $request->session()->flash('error','Product not Found');

            
        return response()->json([
        'status' => false,
        'notFound' => true
        ]);
        }
        $productImages = ProductImage::where('product_id', $id)->get();
        if (!empty($productImages)) {
        foreach ($productImages as $productImage) {
        File::delete(public_path('uploads/product/large/'.$productImage->image));
        File::delete(public_path('uploads/product/small/'.$productImage->image));
        }
        ProductImage::where('product_id',$id)->delete();
    }

        $product->delete();

        $request->session()->flash('success','Product deleted successfully');
        
        return response()->json([
        'status' => true,
        'message' => "Product deleted successfully"
        ]);
            
    }
    public function getProducts(Request $request){
        $tempProduct = [];
        if ($request->term != "") {
        $products = Product::where('title', 'like','%'.$request->term.'%')->get();
        if ($products != null) {
        foreach ($products as $product) {
        $tempProduct[] = array('id' => $product->id, 'text' => $product->title);
        }
        }
        }
        
            return response()->json([
                'tags' => $tempProduct,
                'status' => true
            ]);
        }
        public function productRatings(Request $request)
{
    // Start the query to get the ratings
    $ratings = Review::select('reviews.*', 'products.name as productTitle', 'users.name as username') // Select the 'username' from the 'users' table
        ->orderBy('reviews.created_at', 'DESC');
    
    // Join with the products table to get product name
    $ratings = $ratings->leftJoin('products', 'products.id', '=', 'reviews.product_id');

    // Join with the users table to get the username based on user_id
    $ratings = $ratings->leftJoin('users', 'users.id', '=', 'reviews.user_id'); // Join with the 'users' table
    
    // Apply keyword search if provided
    if ($request->get('keyword') != "") {
        $ratings = $ratings->where('products.name', 'like', '%' . $request->keyword . '%')
            ->orWhere('users.name', 'like', '%' . $request->keyword . '%'); // Search in 'users.username' instead of 'reviews.username'
    }

    // Paginate the results
    $ratings = $ratings->paginate(10);

    // Return the view with the ratings
    return view('admin.products.ratings', [
        'ratings' => $ratings
    ]);
}


        public function changeRatingStatus(Request $request){
            $productRating = Review::find($request->id);
            $productRating->status = $request->status;
            $productRating->save();
            session()->flash('success', 'Status changed successfully.');
            return response()->json([
            'status' => true
            ]);
        }
        public function updateStatus($id, $status)
        {
            $product = Product::findOrFail($id);
            $product->status = $status;
            $product->status_updated_at = Carbon::now();
            $product->save();
    
            return response()->json([
                'message' => 'Product status updated successfully',
                'status' => $product->status,
                'status_updated_at' => $product->status_updated_at
            ]);
        }
}
