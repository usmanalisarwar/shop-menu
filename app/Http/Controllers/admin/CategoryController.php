<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\SlugHelper;

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

        $query = Category::orderBy('id', 'asc');

        if ($keyword = $request->get('keyword')) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        $categories = $query->paginate(10);

        return view('admin.category.list', compact('categories', 'permissions'));
    }

    public function create()
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'create-category')) {
            abort(403, 'Unauthorized');
        }

        $categories = Category::whereNull('parent_id')->get();
        return view('admin.category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'create-category')) {
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

        $category = Category::findOrFail($id);
        $categories = Category::whereNull('parent_id')->get();
        
        return view('admin.category.edit', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'edit-category')) {
            abort(403, 'Unauthorized');
        }

        $category = Category::findOrFail($id);

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

        $category->name = $request->name;
        $category->slug = $this->slugHelper->slug('categories', 'slug', $request->name, $id);
        $category->status = $request->status;
        $category->parent_id = $request->parent_id;

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
