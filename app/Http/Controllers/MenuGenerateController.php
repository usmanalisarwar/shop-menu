<?php
namespace App\Http\Controllers;

use App\Models\Menu;
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

    // Method to show the book (PDF view)
    public function showBook($slug)
    {
        // Example: Find the book by slug from the database
        $menu = Menu::where('slug', $slug)->first();

        // Check if the book exists
        if (!$menu) {
            return abort(404, 'Menu not found');
        }
        $file = asset("{$menu->pdf_path}");
        return view('menu', compact('file','menu'));
    }
}
