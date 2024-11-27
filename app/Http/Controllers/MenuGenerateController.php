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

        // Retrieve the selected category from the request (if exists)
        $categoryId = $request->input('category_id');
        
        // Find the associated MenuItems for the menu, filter by category if provided
        $menuItemsQuery = MenuItem::with(['images', 'details']);

        if ($categoryId) {
            // Filter the menu items by category if a category ID is selected
            $menuItemsQuery->where('category_id', $categoryId);
        }

        // Paginate the results
        $menuItems = $menuItemsQuery->paginate(8);

        // Retrieve all categories for the filter
        $categories = Category::all();

        // PDF file path for menu
        $file = asset("{$menu->pdf_path}");

        // Pass data to the view
        return view('menu', compact('file', 'menu', 'menuItems', 'categories', 'categoryId'));
    }

}
