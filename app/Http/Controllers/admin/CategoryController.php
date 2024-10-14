<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\SlugHelper;
use Illuminate\Support\Facades\Auth; 

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

    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'read-category')) {
            abort(403, 'Unauthorized');
        }

        $query = Category::with('user')->orderBy('id', 'asc'); 

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
        $users = User::all();
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.category.create', compact('categories','users'));
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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $this->slugHelper->slug('categories', 'slug', $request->name);
        $category->status = $request->status;
        $category->parent_id = $request->parent_id;
        $category->user_id = Auth::id(); // Assign the authenticated user's ID

        $category->save();

        return response()->json([
            'status' => true,
            'message' => 'Category added successfully'
        ]);
    }

    public function edit($id)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'edit-category')) {
            abort(403, 'Unauthorized');
        }

        $users = User::all();
        $category = Category::findOrFail($id);
        $categories = Category::whereNull('parent_id')->get();
        
        return view('admin.category.edit', compact('category', 'categories','users'));
    }

    public function update(Request $request, $id)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'edit-category')) {
            abort(403, 'Unauthorized');
        }

        $category = Category::findOrFail($id);

        // Validate input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'user_id' => 'nullable|exists:users,id', // Optional user_id validation
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $category->name = $request->name;
        $category->slug = $this->slugHelper->slug('categories', 'slug', $request->name, $id);
        $category->status = $request->status;
        $category->parent_id = $request->parent_id;

        // Update user_id if provided in the request
        if ($request->has('user_id')) {
            $category->user_id = $request->user_id; // Assign new user ID from the request
        }

        $category->save();

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

        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['status' => true, 'message' => 'Category deleted successfully']);
    }
}
