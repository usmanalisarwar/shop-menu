<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\MenuItemImage;
use App\Models\Category;
use App\Models\User;
use App\Models\PriceManagement;
use App\Models\PriceManagementDetail;
use App\Models\menuItemDetail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Rules\ImageSize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MenuItemController extends Controller
{
    // List all menus with search functionality
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        
        if (!hasPermissions($permissions, 'read-menu-item')) {
            abort(403, 'Unauthorized'); // Return 403 Forbidden if the user lacks permission
        }

        $query = MenuItem::where('user_id', Auth::id())->latest();

        if ($keyword = $request->get('keyword')) {
            $query->where('title', 'like', '%' . $keyword . '%');
        }

        $menuItems = $query->paginate(10);
        return view('admin.menu-item.list', compact('menuItems'));
    }

    // Create new menuitem form
    public function create()
    {
        $permissions = getAuthUserModulePermissions();
        
        if (!hasPermissions($permissions, 'add-new-menu-item')) {
            abort(403, 'Unauthorized');
        }

        $categories = Category::all();
        $labels = PriceManagement::all();
        return view('admin.menu-item.create', compact('categories','labels'));
    }

    // Store a new menuitem
    public function store(Request $request)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'add-new-menu-item')) {
            abort(403, 'Unauthorized');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|max:65535', 

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        // Validate image sizes for each image in the array
        if(isset($request->image_array) && !is_array($request->image_array)) {
            foreach ($request->image_array as $menuItemImageId) {
                $menuItemImage = MenuItemImage::find($menuItemImageId);
    
                if (!$menuItemImage) {
                    continue; // Skip if image is not found
                }
    
                $imagePath = public_path('temp/' . $menuItemImage->name);
    
                $imageSizeValidator = Validator::make(['image' => $imagePath], [
                    'image' => [new ImageSize()],
                ]);
    
                if ($imageSizeValidator->fails()) {
                    return response()->json([
                        'status' => false,
                        'errors' => ['image' => 'The image ' . $menuItemImage->name . ' is not A4 size or smaller.'],
                    ]);
                }
            }
        }
        // foreach ($request->image_array as $menuItemImageId) {
        //     $menuItemImage = MenuItemImage::find($menuItemImageId);

        //     if (!$menuItemImage) {
        //         continue; // Skip if image is not found
        //     }

        //     $imagePath = public_path('temp/' . $menuItemImage->name);

        //     $imageSizeValidator = Validator::make(['image' => $imagePath], [
        //         'image' => [new ImageSize()],
        //     ]);

        //     if ($imageSizeValidator->fails()) {
        //         return response()->json([
        //             'status' => false,
        //             'errors' => ['image' => 'The image ' . $menuItemImage->name . ' is not A4 size or smaller.'],
        //         ]);
        //     }
        // }

        // Create the new menu item
        $menuItem = new MenuItem();
        $menuItem->category_id  = $request->category_id;
        $menuItem->title = $request->title;
        $menuItem->description = $request->description;
        $menuItem->label = $request->label;
        $menuItem->user_id = Auth::id();
        $menuItem->save();

        // Save the menu images
        if($request->has('image_array')) {
            foreach ($request->image_array as $menuItemImageId) {
                $menuItemImage = MenuItemImage::find($menuItemImageId);
    
                if (!$menuItemImage) {
                    continue; // Skip if image is not found
                }
    
                $ext = pathinfo($menuItemImage->name, PATHINFO_EXTENSION);
                $newMenuItemImage = new MenuItemImage(); 
                $newMenuItemImage->menu_item_id = $menuItem->id;
                $newMenuItemImage->order_no = $menuItemImage->order_no;
                $newMenuItemImage->name = $menuItemImage->name;
                $newMenuItemImage->image = $menuItemImage->image;
                $newMenuItemImage->save();
    
                $imageName = $menuItem->id . '-' . $newMenuItemImage->id . '-' . time() . '.' . $ext;
                $sourcePath = public_path('temp/' . $menuItemImage->name);
                $destinationPath = public_path('uploads/menuItem/' . $imageName);
    
                File::copy($sourcePath, $destinationPath);
                $newMenuItemImage->image = $imageName;
                $newMenuItemImage->save();
            }
        }
        // foreach ($request->image_array as $menuItemImageId) {
        //     $menuItemImage = MenuItemImage::find($menuItemImageId);

        //     if (!$menuItemImage) {
        //         continue; // Skip if image is not found
        //     }

        //     $ext = pathinfo($menuItemImage->name, PATHINFO_EXTENSION);
        //     $newMenuItemImage = new MenuItemImage(); 
        //     $newMenuItemImage->menu_item_id = $menuItem->id;
        //     $newMenuItemImage->order_no = $menuItemImage->order_no;
        //     $newMenuItemImage->name = $menuItemImage->name;
        //     $newMenuItemImage->image = $menuItemImage->image;
        //     $newMenuItemImage->save();

        //     $imageName = $menuItem->id . '-' . $newMenuItemImage->id . '-' . time() . '.' . $ext;
        //     $sourcePath = public_path('temp/' . $menuItemImage->name);
        //     $destinationPath = public_path('uploads/menuItem/' . $imageName);

        //     File::copy($sourcePath, $destinationPath);
        //     $newMenuItemImage->image = $imageName;
        //     $newMenuItemImage->save();
        // }
        // Save menu item details (label and price)
            if ($request->label && $request->price) {
                DB::table('menu_item_details')->insert([
                    'menu_item_id' => $menuItem->id,
                    'label' => $request->label,
                    'price' => $request->price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        $request->session()->flash('success', 'Menu Item added successfully');

        return response()->json([
            'status' => true,
            'message' => 'Menu Item added successfully',
        ]);
    }

    // Edit an existing menu
    public function edit($id)
    {
        $permissions = getAuthUserModulePermissions();
        
        if (!hasPermissions($permissions, 'edit-menu-item')) {
            abort(403, 'Unauthorized');
        }

        $menuItem = MenuItem::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $menuItemImages = MenuItemImage::where('menu_item_id', $id)->orderBy('order_no')->get();
        $categories = Category::all();
        $labels = PriceManagement::all();
        $menuItemDetails = DB::table('menu_item_details')
        ->where('menu_item_id', $id)
        ->first();
        if ($menuItemDetails && $menuItemDetails->label) {
        $labelName = PriceManagement::find($menuItemDetails->label)->label;
        } else {
            $labelName = null;
        }
        return view('admin.menu-item.edit', compact('menuItem', 'menuItemImages', 'categories','labels','menuItemDetails','labelName'));
    }

    public function update(Request $request, $id)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'edit-menu-item')) {
            abort(403, 'Unauthorized');
        }

        \Log::info('Update request received for Menu Item ID: ' . $id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|max:65535',

        ]);

        if ($validator->fails()) {
            \Log::warning('Validation errors: ', $validator->errors()->toArray());
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }

        $menuItem = MenuItem::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$menuItem) {
            \Log::error('Menu Item not found: ' . $id);
            return response()->json(['status' => false, 'errors' => ['menu_item' => 'Menu item not found.']]);
        }
    
        // Update the menu item fields
        // $menuItem->category_id = $request->category_id;
        // $menuItem->title = $request->title;
        // $menuItem->description = $request->description; 
        // $menuItem->label = $request->label;
        // $menuItem->save();

        $menuItem = MenuItem::findOrFail($id); // Find the existing MenuItem

        // Update menu item fields
        $menuItem->category_id = $request->category_id;
        $menuItem->title = $request->title;
        $menuItem->description = $request->description;
        $menuItem->label = $request->label;
        $menuItem->user_id = Auth::id();
        $menuItem->save();
    
        // Handle menu images update
        if ($request->has('image_array')) {
            // Remove old images if needed (optional)
            MenuItemImage::where('menu_item_id', $menuItem->id)->delete();
    
            foreach ($request->image_array as $menuItemImageId) {
                $menuItemImage = MenuItemImage::find($menuItemImageId);
                if (!$menuItemImage) {
                    continue; // Skip if image is not found
                }
    
                $ext = pathinfo($menuItemImage->name, PATHINFO_EXTENSION);
                $newMenuItemImage = new MenuItemImage(); 
                $newMenuItemImage->menu_item_id = $menuItem->id;
                $newMenuItemImage->order_no = $menuItemImage->order_no;
                $newMenuItemImage->name = $menuItemImage->name;
                $newMenuItemImage->image = $menuItemImage->image;
                $newMenuItemImage->save();
    
                $imageName = $menuItem->id . '-' . $newMenuItemImage->id . '-' . time() . '.' . $ext;
                $sourcePath = public_path('temp/' . $menuItemImage->name);
                $destinationPath = public_path('uploads/menuItem/' . $imageName);
    
                File::copy($sourcePath, $destinationPath);
                $newMenuItemImage->image = $imageName;
                $newMenuItemImage->save();
            }
        }
    
        // Update or insert menu item details (label and price)
        DB::table('menu_item_details')
            ->updateOrInsert(
                ['menu_item_id' => $menuItem->id],
                [
                    'label' => $request->label,
                    'price' => $request->price,
                    'updated_at' => now(),
                ]
            );

        // Update the order numbers for images
        if($request->image_array) {
        foreach ($request->image_array as $order => $imageId) {
            $menuItemImage = MenuItemImage::find($imageId);
            if ($menuItemImage) {
                $menuItemImage->order_no = $order + 1; 
                $menuItemImage->save();
            }
        }
    }

        \Log::info('Menu Item updated successfully: ', $menuItem->toArray());
        // Update menu item details (label and price)
        if ($request->label && $request->price) {
            DB::table('menu_item_details')
                ->updateOrInsert(
                    ['menu_item_id' => $menuItem->id],
                    [
                        'label' => $request->label,
                        'price' => $request->price,
                        'updated_at' => now(),
                    ]
                );
        }
        
        // $request->session()->flash('success', 'Menu Item updated successfully');


        return response()->json(['status' => true, 'message' => 'Menu Item updated successfully']);
    }

    // Delete a menu
    public function destroy($id)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'delete-menu-item')) {
            abort(403, 'Unauthorized');
        }

        $menuItem = MenuItem::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$menuItem) {
            return response()->json(['status' => false, 'message' => 'Menu Item not found']);
        }

        $menuItemImages = MenuItemImage::where('menu_item_id', $id)->get();
        foreach ($menuItemImages as $image) {
            $imagePath = public_path('uploads/menuItem/' . $image->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $image->delete();
        }

        $menuItem->delete();

        return response()->json(['status' => true, 'message' => 'Menu Item deleted successfully']);
    }

     public function getPriceDetail($id)
    {
        $priceDetails = PriceManagement::with('details')->find($id);

        if (!$priceDetails) {
            return response()->json(['status' => false, 'message' => 'Price details not found']);
        }

        $detail = $priceDetails->details->first();

        return response()->json([
            'status' => true,
            'priceDetails' => $detail ? $detail : null,
        ]);
    }


}
