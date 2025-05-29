<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\CategoryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\SlugHelper;
use Illuminate\Support\Facades\Auth;
use App\Rules\ImageSize;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    protected $slugHelper;

    public function __construct(SlugHelper $slugHelper)
    {
        $this->slugHelper = $slugHelper;
    }

    public function getSubCategories(Request $request)
    {
        $parentId = $request->input('parent_id');
        $subCategories = Category::where('parent_id', $parentId)->get();

        return response()->json([
            'status' => true,
            'subCategories' => $subCategories
        ]);
    }
    // Fetch all category images by ID
    public function getCategoryImages($id)
    {
        $categoryImages = CategoryImage::where('category_id', $id)->get();
        return response()->json(['images' => $categoryImages]);
    }
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'read-category')) {
            abort(403, 'Unauthorized');
        }

        $userId = auth()->id();

        $query = Category::where(function ($q) use ($userId) {
            $q->where('user_id', $userId)
                ->orWhereNull('user_id');
        })->with('images')->latest();


        if ($keyword = $request->get('keyword')) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        $categories = $query->paginate(10);

        return view('admin.category.list', compact('categories', 'permissions'));
    }

    public function create()
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'add-new-category')) {
            abort(403, 'Unauthorized');
        }

        $categories = Category::whereNull('parent_id')->get();
        // $categories = Category::whereNull('parent_id')->whereNull('deleted_at')->get();

        return view('admin.category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'add-new-category')) {
            abort(403, 'Unauthorized');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'order_no' => 'required|integer|unique:categories,order_no',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
        // Check if the order_no already exists
        if (Category::where('order_no', $request->order_no)->exists()) {
            return response()->json([
                'status' => false,
                'errors' => ['order_no' => 'The order number has already been taken. Please choose another one.']
            ]);
        }
        // Validate image sizes for each image in the array

        if (isset($request->image_array)) {
            foreach ($request->image_array as $categoryImageId) {
                $categoryImage = CategoryImage::find($categoryImageId);

                if (!$categoryImage) {
                    continue; // Skip if image is not found
                }

                $imagePath = public_path('temp/' . $categoryImage->name);

                // Validate image size
                $imageSizeValidator = Validator::make(['image' => $imagePath], [
                    'image' => [new ImageSize()],
                ]);

                if ($imageSizeValidator->fails()) {
                    return response()->json([
                        'status' => false,
                        'errors' => ['image' => 'The image ' . $categoryImage->name . ' is not A4 size or smaller.'],
                    ]);
                }
            }
        }

        // $category = new Category();
        // $category->name = $request->name;
        // $category->slug = $this->slugHelper->slug('categories', 'slug', $request->name);
        // $category->status = $request->status;
        // $category->order_no = $request->order_no;
        // $category->parent_id = $request->parent_id;
        // $category->user_id = Auth::id();

        // $category->save();
        $category = new Category();
        $category->name = $request->name;
        $category->status = $request->status;
        $category->order_no = $request->order_no;
        $category->parent_id = $request->parent_id;
        $category->save();

        // Save the menu images
        if (isset($request->image_array)) {
            foreach ($request->image_array as $categoryImageId) {
                $categoryImage = CategoryImage::find($categoryImageId);

                if (!$categoryImage) {
                    continue; // Skip if image is not found
                }

                $ext = pathinfo($categoryImage->name, PATHINFO_EXTENSION);
                $newCategoryImage = new CategoryImage();
                $newCategoryImage->category_id = $category->id;
                $newCategoryImage->order_no = $categoryImage->order_no;
                $newCategoryImage->name = $categoryImage->name;
                $newCategoryImage->image = $categoryImage->image;
                $newCategoryImage->save();

                $imageName = $category->id . '-' . $newCategoryImage->id . '-' . time() . '.' . $ext;
                $sourcePath = public_path('temp/' . $categoryImage->name);
                $destinationPath = public_path('uploads/category/' . $imageName);

                File::copy($sourcePath, $destinationPath);
                $newCategoryImage->image = $imageName;
                $newCategoryImage->save();
            }
        }

        $request->session()->flash('success', 'Category added successfully');
        return response()->json([
            'status' => true,
            'message' => 'Category added successfully'
        ]);
    }

    public function edit(Category $category) //, $id)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'edit-category')) {
            abort(403, 'Unauthorized');
        }
    $categories = Category::whereNull('parent_id')->get();
    $categoryImages = CategoryImage::where('category_id', $category->id)->orderBy('order_no')->get();

        // $category = Category::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        // $categories = Category::whereNull('parent_id')->get();
        // $categoryImages = CategoryImage::where('category_id', $id)->orderBy('order_no')->get();

        return view('admin.category.edit', compact('category', 'categories', 'categoryImages'));
    }

    public function update(Request $request, $id)
    {
        
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'edit-category')) {
            abort(403, 'Unauthorized');
        }
        // $category = Category::where('id', $id)->where('user_id', Auth::id())->first();
        $authUser = Auth::user();
        $categoryQuery = Category::where('id', $id);

        // Apply user_id filter only if user has role 'user' or 'restaurant'
        if (in_array($authUser->role, ['user', 'restaurant'])) {
        $categoryQuery->where('user_id', $authUser->id);
        }

        $category = $categoryQuery->first();

        // Validate input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'user_id' => 'nullable|exists:users,id',
            // 'order_no' => 'required|integer|unique:categories,order_no',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
        // Check if the order_no already exists (except for the current category)
        if (Category::where('order_no', $request->order_no)->where('id', '!=', $id)->exists()) {
            return response()->json([
                'status' => false,
                'errors' => ['order_no' => 'The order number has already been taken. Please choose another one.']
            ]);
        }
        // $category = new Category;
        $category->name = $request->name;
        
        $category->slug = $this->slugHelper->slug('categories', 'slug', $request->name, $id);
        $category->status = $request->status;
        $category->order_no = $request->order_no;
        $category->parent_id = $request->parent_id;
        // Update user_id if provided in the request
        if ($request->has('user_id')) {
            $category->user_id = $request->user_id; // Assign new user ID from the request
        }

        $category->save();
        // Update the order numbers for images
        if (isset($request->image_array)) {
            foreach ($request->image_array as $order => $imageId) {
                $categoryImage = CategoryImage::find($imageId);
                if ($categoryImage) {
                    $categoryImage->order_no = $order + 1; // Update order number (starting from 1)
                    $categoryImage->save();
                }
            }
        }
        // foreach ($request->image_array as $order => $imageId) {
        //     $categoryImage = CategoryImage::find($imageId);
        //     if ($categoryImage) {
        //         $categoryImage->order_no = $order + 1; // Update order number (starting from 1)
        //         $categoryImage->save();
        //     }
        // }
        $request->session()->flash('success', 'Category updated successfully');

        return response()->json([
            'status' => true,
            'message' => 'Category updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'delete-category')) {
            abort(403, 'Unauthorized');
        }

        // $category = Category::where('id', $id)->where('user_id', Auth::id())->first();
        $authUser = Auth::user();
        $categoryQuery = Category::where('id', $id);

        // Apply user_id condition for 'user' or 'restaurant' roles
        if (in_array($authUser->role, ['user', 'restaurant'])) {
        $categoryQuery->where('user_id', $authUser->id);
        }

        $category = $categoryQuery->first();

        // Delete associated images
        $categoryImages = CategoryImage::where('category_id', $id)->get();
        foreach ($categoryImages as $image) {
            $imagePath = public_path('uploads/category/' . $image->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $image->delete();
        }
        $category->delete();

        return response()->json(['status' => true, 'message' => 'Category deleted successfully']);
    }
}
