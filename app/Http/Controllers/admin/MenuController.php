<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Helpers\SlugHelper;
use App\Rules\ImageSize; 

class MenuController extends Controller
{
    protected $slugHelper;

    public function __construct(SlugHelper $slugHelper)
    {
        $this->slugHelper = $slugHelper;
    }


    public function generatePdf($id)
    {

        $menu = Menu::with('images')->findOrFail($id);
        $user = Auth::user();

        // Configure Dompdf options
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        // Load the HTML view for the PDF
        $html = view('admin.menu.pdf', compact('menu', 'user'))->render();
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Define the storage path and file name
        $directoryPath = public_path('uploads/pdfs');
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        $fileName = 'menu-' . $menu->id . '.pdf';
        $filePath = $directoryPath . '/' . $fileName;

        // Save the PDF to the specified path
        file_put_contents($filePath, $dompdf->output());

        // Save the PDF path to the menu in the database
        $menu->pdf_path = 'uploads/pdfs/' . $fileName;
        $menu->save();

        // Stream the PDF file to the browser
        return $dompdf->stream('menu-' . $menu->id . '.pdf', ['Attachment' => true]);
    }



    // Fetch all menu images by ID
    public function getMenuImages($id)
    {
        $menuImages = MenuImage::where('menu_id', $id)->get();
        return response()->json(['images' => $menuImages]);
    }

    // List all menus with search functionality
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'read-menu')) {
            abort(403, 'Unauthorized'); // Return 403 Forbidden if the user lacks permission
        }
        $query = Menu::latest();

        if ($keyword = $request->get('keyword')) {
            $query->where('title', 'like', '%' . $keyword . '%');
        }

        $menus = $query->paginate(10);
        return view('admin.menu.list', compact('menus'));
    }

    // Create new menu form
    public function create()
    {
         $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'add-new-menu')) {
            abort(403, 'Unauthorized');
        }
        return view('admin.menu.create');
    }

    // Store a new menu
    public function store(Request $request)
    {
         $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'add-new-menu')) {
            abort(403, 'Unauthorized');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image_array' => 'required|array',
            'image_array.*' => 'exists:menu_images,id', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        // Check the size of each image
        foreach ($request->image_array as $menuImageId) {
            $menuImage = MenuImage::find($menuImageId);
            $imagePath = public_path('temp/' . $menuImage->name);
            
            // Validate image size
            $imageSizeValidator = Validator::make(['image' => $imagePath], [
                'image' => [new ImageSize()],
            ]);

            if ($imageSizeValidator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => ['image' => 'The image ' . $menuImage->name . ' is not A4 size or smaller.'],
                ]);
            }
        }

        $menu = new Menu();
        $menu->title = $request->title;
        $menu->slug = $this->slugHelper->slug('menus', 'slug', $request->title);
        $menu->save();

        // Save Menu images
        foreach ($request->image_array as $menuImageId) {
            $menuImage = MenuImage::find($menuImageId);
            $ext = pathinfo($menuImage->name, PATHINFO_EXTENSION);

            $newMenuImage = new MenuImage();
            $newMenuImage->menu_id = $menu->id;
            $newMenuImage->order_no = $menuImage->order_no;
            $newMenuImage->name = $menuImage->name;
            $newMenuImage->image = $menuImage->image;
            $newMenuImage->save();

            $imageName = $menu->id . '-' . $newMenuImage->id . '-' . time() . '.' . $ext;
            $sourcePath = public_path('temp/' . $menuImage->name);
            $destinationPath = public_path('uploads/menu/' . $imageName);

            File::copy($sourcePath, $destinationPath);
            $newMenuImage->image = $imageName;
            $newMenuImage->save();
        }

        $request->session()->flash('success', 'Menu added successfully');

        return response()->json([
            'status' => true,
            'message' => 'Menu added successfully',
        ]);
    }

    // Edit an existing menu
    public function edit($id)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'edit-menu')) {
            abort(403, 'Unauthorized');
        }
        $menu = Menu::findOrFail($id);
        $menuImages = MenuImage::where('menu_id', $id)->orderBy('order_no')->get();

        return view('admin.menu.edit', compact('menu', 'menuImages'));
    }

    public function update(Request $request, $id)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'edit-menu')) {
            abort(403, 'Unauthorized');
        }

        \Log::info('Update request received for Menu ID: ' . $id);

        // Validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'new_images' => 'nullable|array',
            'image_array.*' => 'exists:menu_images,id',
        ]);

        if ($validator->fails()) {
            \Log::warning('Validation errors: ', $validator->errors()->toArray());
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }

        // Find the existing menu
        $menu = Menu::find($id);
        if (!$menu) {
            \Log::error('Menu not found: ' . $id);
            return response()->json(['status' => false, 'errors' => ['menu' => 'Menu not found.']]);
        }

        $menu->title = $request->title;
        $menu->slug = $this->slugHelper->slug('menus', 'slug', $request->title, $id);
        $menu->save();;

        // Update the order numbers for images
        foreach ($request->image_array as $order => $imageId) {
            $menuImage = MenuImage::find($imageId);
            if ($menuImage) {
                $menuImage->order_no = $order + 1; // Update order number (starting from 1)
                $menuImage->save();
            }
        }

        \Log::info('Menu  updated successfully: ', $menu->toArray());

        return response()->json(['status' => true, 'message' => 'Menu updated successfully']);
    }

    // Delete a menu
    public function destroy($id)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'delete-menu')) {
            abort(403, 'Unauthorized');
        }

        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json(['status' => false, 'message' => 'Menu not found']);
        }

        // Delete associated images
        $menuImages = MenuItemImage::where('menu_id', $id)->get();
        foreach ($menuImages as $image) {
            $imagePath = public_path('uploads/menu/' . $image->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $image->delete();
        }

        $menu->delete();

        return response()->json(['status' => true, 'message' => 'Menu deleted successfully']);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home.login');
    }
}
