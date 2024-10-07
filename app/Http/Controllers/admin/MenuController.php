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

    public function generatePdfAll()
    {
        $menus = Menu::with('images')->get();
        $user = Auth::user();

        // Configure Dompdf options
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        // Load the HTML view for the PDF
        $html = view('admin.menu.pdf-all', compact('menus', 'user'))->render();
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Define the storage path and file name
        $directoryPath = public_path('uploads/pdfs');
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        $fileName = 'menus.pdf';
        $filePath = $directoryPath . '/' . $fileName;

        // Save the PDF to the specified path
        file_put_contents($filePath, $dompdf->output());

        // If needed, you can loop through the menus and update their pdf_path
        foreach ($menus as $menu) {
            $menu->pdf_path = 'uploads/pdfs/' . $fileName;
            $menu->save();
        }

        // Stream the PDF file to the browser
        return $dompdf->stream($fileName, ['Attachment' => true]);
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
        return view('admin.menu.create');
    }

    // Store a new menu
    public function store(Request $request)
    {
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
        $menu = Menu::findOrFail($id);
        $menuImages = MenuImage::where('menu_id', $id)->orderBy('order_no')->get();

        return view('admin.menu.edit', compact('menu', 'menuImages'));
    }

    // Update an existing menu
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'new_images' => 'nullable|array',
            'image_array.*' => 'exists:menu_images,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $menu->title = $request->title;
        $menu->slug = $this->slugHelper->slug('menus', 'slug', $request->title, $id);
        $menu->save();

        // Handle deleted images
        if ($request->has('deleted_images')) {
            $this->handleDeletedImages($request->input('deleted_images'));
        }

        // Handle new images
        if ($request->has('new_images')) {
            $this->handleNewImages($request->new_images, $menu->id);
        }

        // Update the order_no based on updated_order
        if ($request->has('updated_order')) {
            $this->updateImageOrder($request->input('updated_order'));
        }

        $request->session()->flash('success', 'Menu updated successfully');

        return response()->json([
            'status' => true,
            'message' => 'Menu updated successfully',
        ]);
    }

    // Handle deleted images
    protected function handleDeletedImages($deletedImages)
    {
        $deletedImages = json_decode($deletedImages, true);
        foreach ($deletedImages as $imageId) {
            $image = MenuImage::find($imageId);
            if ($image) {
                $imagePath = public_path('uploads/menu/' . $image->image);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
                $image->delete();
            }
        }
    }

    // Handle new images
    protected function handleNewImages(array $newImages, $menuId)
    {
        foreach ($newImages as $menuImageId) {
            $menuImage = MenuImage::find($menuImageId);
            if ($menuImage) {
                $ext = pathinfo($menuImage->name, PATHINFO_EXTENSION);
                $newMenuImage = new MenuImage();
                $newMenuImage->menu_id = $menuId;
                $newMenuImage->order_no = $menuImage->order_no;
                $newMenuImage->name = $menuImage->name;
                $newMenuImage->image = $menuImage->image;
                $newMenuImage->save();

                $imageName = $menuId . '-' . $newMenuImage->id . '-' . time() . '.' . $ext;
                $sourcePath = public_path('temp/' . $menuImage->name);
                $destinationPath = public_path('uploads/menu/' . $imageName);

                File::copy($sourcePath, $destinationPath);
                $newMenuImage->image = $imageName;
                $newMenuImage->save();

                // Optionally delete the temp image
                File::delete($sourcePath);
            }
        }
    }

    // Update the order_no based on updated_order
    protected function updateImageOrder($updatedOrder)
    {
        $updatedOrder = json_decode($updatedOrder, true);
        foreach ($updatedOrder as $order) {
            $menuImage = MenuImage::find($order['id']);
            if ($menuImage) {
                $menuImage->order_no = $order['order_no'];
                $menuImage->save();
            }
        }
    }

    // Delete a menu
    public function destroy($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json(['status' => false, 'message' => 'Menu not found']);
        }

        foreach ($menu->images as $image) {
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
        return redirect()->route('login');
    }
}
