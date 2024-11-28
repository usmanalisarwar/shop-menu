<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Category;
use App\Models\PriceManagement;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class MenuGenerateController extends Controller
{
    // Method to generate QR code for the book URL
    public function generateQRCode($slug)
    {
        // Example: Find the book by slug from the database
        $menu = Menu::where('slug', $slug)->first();
        $menuImage = $menu->images[0];

        // Check if the book exists
        if (!$menu) {
            return abort(404, 'Menu not found');
        }
        // Generate the book URL using the slug
        $bookUrl = route('book.show', $slug);
        $qrCode = QrCode::size(350)->generate($bookUrl);
        // Generate QR code and return it as a response
        return view('qrcode', compact('qrCode','menu','menuImage'));
    }

 
public function showBook($slug, Request $request)
{
    // Find the menu by slug
    $menu = Menu::where('slug', $slug)->first();

    // Check if the menu exists
    if (!$menu) {
        return abort(404, 'Menu not found');
    }

    // Retrieve category_id and subcategory_slug from the request
    $categoryId = $request->input('category_id');
    $subcategorySlug = $request->input('subcategory_slug'); // Capture the subcategory slug
    
    // Find the category or subcategory
    $category = null;
    if ($subcategorySlug) {
        $category = Category::where('slug', $subcategorySlug)->first();
        if ($category) {
            $categoryId = $category->id; // Update the category ID based on subcategory
        }
    }

    // Query MenuItems
    $menuItemsQuery = MenuItem::with(['images', 'details']);

    if ($categoryId) {
        $menuItemsQuery->where('category_id', $categoryId);
    }

    // Paginate the results
    $menuItems = $menuItemsQuery->paginate(8);

    // Retrieve all categories and their subcategories
    $categories = Category::with('children')->get();

    // PDF file path for menu
    $file = asset("{$menu->pdf_path}");

    // Pass data to the view
    return view('menu', compact('file', 'menu', 'menuItems', 'categories', 'categoryId', 'subcategorySlug'));
}


}