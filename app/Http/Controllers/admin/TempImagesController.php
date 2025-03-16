<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image; // Import Intervention Image
use Illuminate\Support\Facades\Validator;

class TempImagesController extends Controller
{
    public function create(Request $request)
    {
        // Validate Image Before Processing
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // 2MB max
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid image format or size',
                'errors' => $validator->errors()
            ], 422);
        }

        // Store Image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $newName = time() . '.' . $ext;

            // Save Image Record
            $tempImage = new TempImage();
            $tempImage->name = $newName;
            $tempImage->save();

            // Move Image to Temp Folder
            $image->move(public_path('/temp'), $newName);

            // Create Thumbnail
            $sourcePath = public_path('/temp/' . $newName);
            $thumbPath = public_path('/temp/thumb/');

            if (!file_exists($thumbPath)) {
                mkdir($thumbPath, 0777, true); // Ensure thumbnail folder exists
            }

            $thumbDestPath = $thumbPath . $newName;
            $image = Image::make($sourcePath)->fit(300, 275);
            $image->save($thumbDestPath);

            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
                'ImagePath' => asset('/temp/thumb/' . $newName),
                'message' => 'Image uploaded successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Image upload failed'
        ], 500);
    }
}
