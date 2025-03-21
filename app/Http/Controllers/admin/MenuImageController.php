<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuImage;
use App\Models\MenuItemImage;
use App\Models\CategoryImage;
use Illuminate\Support\Facades\Response;

class MenuImageController extends Controller
{
     public function index()
    {
        return view('admin.dashboard');
        
    }
   
   public function create(Request $request)
    {
        $image = $request->file('image');
        if ($image) {
            $ext = $image->getClientOriginalExtension();
            $newName = time().'.'.$ext;

            $menuImage = new MenuImage();
            $menuImage->name = $newName;
            $menuImage->save();

            $image->move(public_path('temp'), $newName);
            
            return response()->json([
                'status' => true,
                'image_id' => $menuImage->id,
                'ImagePath' => asset('temp/'.$newName),
                'message' => 'Image uploaded successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'No image uploaded'
        ]);
    }

    public function menuItemCreate(Request $request)
    {
        $image = $request->file('image');
        if ($image) {
            $ext = $image->getClientOriginalExtension();
            $newName = time().'.'.$ext;

            $menuItemImage = new MenuItemImage();
            $menuItemImage->name = $newName;
            $menuItemImage->save();

            $image->move(public_path('temp'), $newName);
            return response()->json([
                'status' => true,
                'image_id' => $menuItemImage->id,
                'ImagePath' => asset('temp/'.$newName),
                'message' => 'Image uploaded successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'No image uploaded'
        ]);
    }

    public function categoryCreate(Request $request)
    {
        $image = $request->file('image');

        if ($image) {
            $ext = $image->getClientOriginalExtension();
            $newName = time().'.'.$ext;

            $categoryImage = new CategoryImage();
            $categoryImage->name = $newName;
            $categoryImage->save();

            $image->move(public_path('temp'), $newName);
            
            return response()->json([
                'status' => true,
                'image_id' => $categoryImage->id,
                'ImagePath' => asset('temp/'.$newName),
                'message' => 'Image uploaded successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'No image uploaded'
        ]);
    }

}
