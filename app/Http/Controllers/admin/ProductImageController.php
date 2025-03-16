<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;

class ProductImageController extends Controller
{
    public function update(Request $request)
    {
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $sourcePath = $image->getPathName();

        // Create new ProductImage entry
        $productImage = new ProductImage();
        $productImage->product_id = $request->product_id;
        $productImage->image = 'NULL'; // Placeholder
        $productImage->save();

        $imageName = $request->product_id . '-' . $productImage->id . '-' . time() . '.' . $ext;
        $productImage->image = $imageName;
        $productImage->save();

        // Ensure directories exist and are writable
        $largePath = public_path('uploads/product/large');
        $smallPath = public_path('uploads/product/small');

        if (!File::exists($largePath)) {
            File::makeDirectory($largePath, 0755, true);
        }

        if (!File::exists($smallPath)) {
            File::makeDirectory($smallPath, 0755, true);
        }

        // Paths for the large and small images
        $destPathLarge = public_path('uploads/product/large/' . $imageName);
        $destPathSmall = public_path('uploads/product/small/' . $imageName);

        try {
            // Process and save the large image
            $image = Image::make($sourcePath);
            $image->resize(1400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save($destPathLarge);

            // Process and save the small image
            $image->fit(300, 300);
            $image->save($destPathSmall);

            Log::info('Images saved successfully for product ' . $request->product_id);
        } catch (\Exception $e) {
            Log::error('Error processing image for product ' . $request->product_id . ': ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'Image processing failed']);
        }

        return response()->json([
            'status' => true,
            'image_id' => $productImage->id,
            'ImagePath' => asset('uploads/product/small/' . $productImage->image),
            'message' => 'Image saved successfully'
        ]);
    }

    public function destroy(Request $request)
    {
        $productImage = ProductImage::find($request->id);
        if (empty($productImage)) {
            return response()->json([
                'status' => false,
                'message' => 'Image not found'
            ]);
        }

        // Delete images from folders
        File::delete(public_path('uploads/product/large/' . $productImage->image));
        File::delete(public_path('uploads/product/small/' . $productImage->image));

        // Delete the ProductImage entry
        $productImage->delete();

        return response()->json([
            'status' => true,
            'message' => 'Image deleted successfully'
        ]);
    }
}
