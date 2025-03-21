<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\MenuItemImage;
use App\Models\PriceManagement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('front.index');
    }
    public function aboutUs()
    {
        return view('front.about-us');
    }
    public function menu()
    {
        $menus = Menu::all();
        $categories = Category::all();
        return view('front.menu', compact('categories', 'menus'));
    }

    // old meuitem start
    // public function menuItems(Request $request)
    // {
    //     $page = $request->input('page', 1);
    //     $categorySlug = $request->input('category', 'all');

    //     // Find the category by slug
    //     $category = Category::where('slug', $categorySlug)->first();
    //     // If the category doesn't exist, return an empty response
    //     if (!$category) {
    //         return response()->json(['html' => '']);
    //     }

    //     // Get menu items for the category
    //     $query = MenuItem::where('category_id', $category->id)->with(['images', 'details'])
    //         ->orderBy('id', 'desc');

    //     // Paginate results
    //     $menuItems = $query->paginate(5, ['*'], 'page', $page);
    //     if (!$menuItems) {
    //         return response()->json(['html' => '']);
    //     }
    //     foreach ($menuItems as $item) {
    //         // Get the first price detail or set default to 0
    //         $priceDetail = $item->details->first();
    //         $item->price = $priceDetail ? $priceDetail->price : 0;
    //     }
    //     // Render menu items into HTML
    //     $html = view('menu-items', compact('menuItems'))->render();

    //     return response()->json(['html' => $html]);
    // }
    //   old menuitem end

    // new menuitem start
    public function menuItems(Request $request)
    {
        $page = $request->input('page', 1);
        $categorySlug = $request->input('category', 'all');

        // If a specific category is selected, find it
        if ($categorySlug !== 'all') {
            $category = Category::where('slug', $categorySlug)->first();
            if (!$category) {
                return response()->json(['html' => '']);
            }
        }

        // Build query for menu items
        $query = MenuItem::with(['images', 'details'])->orderBy('id', 'desc');

        // If a category is selected, filter menu items by category
        if (isset($category)) {
            $query->where('category_id', $category->id);
        }

        // Paginate menu items (5 per page)
        $menuItems = $query->paginate(5, ['*'], 'page', $page);

        // If no menu items found, return empty response
        if ($menuItems->isEmpty()) {
            return response()->json(['html' => '']);
        }

        // Fetch price details for each item
        foreach ($menuItems as $item) {
            $priceDetail = $item->details->first();
            $item->price = $priceDetail ? $priceDetail->price : 0;
        }
        // Render the menu items HTML
        $html = view('menu-items', compact('menuItems'))->render();

        return response()->json(['html' => $html]);
    }
    // new menuitem end


    public function contactUs()
    {
        return view('front.contact-us');
    }
    public function service()
    {
        return view('front.service');
    }

    public function login()
    {
        return view('front.login');
    }
    // public function getCategories(Request $request)
    // {
    //     $pageNo = $request->input('pageno', 1);
    //     $category = $request->input('category', 'all');

    //     $query = Category::query();

    //     if ($category !== 'all') {
    //         $query->where('slug', $category);
    //     }

    //     $categories = $query->whereNull('parent_id')->orderBy('id', 'desc')->paginate(5, ['*'], 'page', $pageNo);

    //     return response()->json($categories);
    // }
    public function getCategories(Request $request)
{
    dd($request->all());
    $pageNo = $request->input('pageno', 1);
    $categorySlug = $request->input('category', 'all');

    // Fetch categories (only parent categories)
    $query = Category::whereNull('parent_id')->orderBy('id', 'desc');

    // If a specific category is selected, filter it
    if ($categorySlug !== 'all') {
        $query->where('slug', $categorySlug);
    }

    // Paginate categories (5 per page)
    $categories = $query->paginate(5, ['*'], 'page', $pageNo);

    return response()->json(['categories' => $categories]);
}

    public function getSubcategories(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $subcategories = Category::where('parent_id', $category->id)->get();

        return response()->json($subcategories);
    }


}
