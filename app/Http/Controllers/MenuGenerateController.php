<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Category;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

    public function showBook($slug)
    {
        // Find the menu by slug
        $menu = Menu::where('slug', $slug)->first();

        // Check if the menu exists
        if (!$menu) {
            return abort(404, 'Menu not found');
        }

        // Find the associated MenuItems for the menu
        $menuItems = MenuItem::with(['images', 'details'])->get();
        $categories = Category::where('status', 1)->get();
        // PDF file path for menu
        $file = asset("{$menu->pdf_path}");

        // Pass data to the view
        return view('menu', compact('file', 'menu', 'menuItems','categories'));
    }



}
