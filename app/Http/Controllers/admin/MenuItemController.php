<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\MenuItemImage;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Rules\ImageSize;

class MenuItemController extends Controller
{
    // List all menus with search functionality
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        
        if (!hasPermissions($permissions, 'read-menu-item')) {
            abort(403, 'Unauthorized'); // Return 403 Forbidden if the user lacks permission
        }

        $query = MenuItem::latest();

        if ($keyword = $request->get('keyword')) {
            $query->where('title', 'like', '%' . $keyword . '%');
        }

        $menuItems = $query->paginate(10);
        return view('admin.menu-item.list', compact('menuItems'));
    }

    // Create new menu form
    public function create()
    {
        $permissions = getAuthUserModulePermissions();
        
        if (!hasPermissions($permissions, 'add-new-menu-item')) {
            abort(403, 'Unauthorized');
        }

        $categories = Category::all();
        return view('admin.menu-item.create', compact('categories'));
    }

    // Store a new menu
    public function store(Request $request)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'add-new-menu-item')) {
            abort(403, 'Unauthorized');
        }

        // Validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'image_array' => 'required|array',
            'image_array.*' => 'exists:menu_item_images,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        // Validate image sizes for each image in the array
        foreach ($request->image_array as $menuItemImageId) {
            $menuItemImage = MenuItemImage::find($menuItemImageId);

            if (!$menuItemImage) {
                continue; // Skip if image is not found
            }

            $imagePath = public_path('temp/' . $menuItemImage->name);

            // Validate image size
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

        // Create the new menu item
        $menuItem = new MenuItem();
        $menuItem->category_id  = $request->category_id;
        $menuItem->title = $request->title;
        $menuItem->price = $request->price;
        $menuItem->save();

        // Save the menu images
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

        $request->session()->flash('success', 'Menu Item added successfully');

        return response()->json([
            'status' => true,
            'message' => 'Menu added successfully',
        ]);
    }

    // Edit an existing menu
    public function edit($id)
    {
        $permissions = getAuthUserModulePermissions();
        
        if (!hasPermissions($permissions, 'edit-menu-item')) {
            abort(403, 'Unauthorized');
        }

        $menuItem = MenuItem::findOrFail($id);
        $menuItemImages = MenuItemImage::where('menu_item_id', $id)->orderBy('order_no')->get();
        $categories = Category::all();

        return view('admin.menu-item.edit', compact('menuItem', 'menuItemImages', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'edit-menu-item')) {
            abort(403, 'Unauthorized');
        }

        \Log::info('Update request received for Menu Item ID: ' . $id);

        // Validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'image_array' => 'required|array',
            'image_array.*' => 'exists:menu_item_images,id',
        ]);

        if ($validator->fails()) {
            \Log::warning('Validation errors: ', $validator->errors()->toArray());
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }

        // Find the existing menu item
        $menuItem = MenuItem::find($id);
        if (!$menuItem) {
            \Log::error('Menu Item not found: ' . $id);
            return response()->json(['status' => false, 'errors' => ['menu_item' => 'Menu item not found.']]);
        }

        // Update the menu item fields
        $menuItem->category_id = $request->category_id;
        $menuItem->title = $request->title;
        $menuItem->price = $request->price;
        $menuItem->save();

        // Update the order numbers for images
        foreach ($request->image_array as $order => $imageId) {
            $menuItemImage = MenuItemImage::find($imageId);
            if ($menuItemImage) {
                $menuItemImage->order_no = $order + 1; // Update order number (starting from 1)
                $menuItemImage->save();
            }
        }

        \Log::info('Menu Item updated successfully: ', $menuItem->toArray());

        return response()->json(['status' => true, 'message' => 'Menu updated successfully']);
    }

    // Delete a menu
    public function destroy($id)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'delete-menu-item')) {
            abort(403, 'Unauthorized');
        }

        $menuItem = MenuItem::find($id);

        if (!$menuItem) {
            return response()->json(['status' => false, 'message' => 'Menu Item not found']);
        }

        // Delete associated images
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
}
