<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
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
        $parent_id = $request->input('parent_id');
        $subCategories = Category::where('parent_id', $parent_id)->get();

        return response()->json([
            'status' => true,
            'subCategories' => $subCategories
        ]);
    }

    public function index(Request $request)
    {
        $query = Category::orderBy('id', 'asc'); 

        if ($keyword = $request->get('keyword')) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        $categories = $query->paginate(10);

        return view('admin.category.list', compact('categories'));
    }


    public function create()
    {
        $categories = Category::whereNull('parent_id')->get(); 
        return view('admin.category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required|boolean',
        ]);

        if ($validator->passes()) {
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $this->slugHelper->slug('categories', 'slug', $request->name);
            $category->status = $request->status;
            $category->parent_id = $request->parent_id;

            $category->save();

            $request->session()->flash('success', 'Category added successfully');

            return response()->json([
                'status' => true,
                'message' => 'Category added successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::whereNull('parent_id')->get(); 
        return view('admin.category.edit', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required|boolean',
        ]);

        if ($validator->passes()) {
            $category->name = $request->name;
            $category->slug = $this->slugHelper->slug('categories', 'slug', $request->name, $id); 
            $category->status = $request->status;
            $category->parent_id = $request->parent_id;

            $category->save();

            $request->session()->flash('success', 'Category updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Category updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return response()->json(['status' => true, 'message' => 'Category deleted successfully']);
    }


}
