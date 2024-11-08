<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PriceManagement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Enums\PriceTypeEnum;
use Illuminate\Validation\Rule;

class PriceManagementController extends Controller
{
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        
        if (!hasPermissions($permissions, 'read-price-management')) {
            abort(403, 'Unauthorized'); 
        }

        $query = PriceManagement::where('user_id', Auth::id())->latest();

        if ($keyword = $request->get('keyword')) {
            $query->where('title', 'like', '%' . $keyword . '%');
        }

        $priceManagements = $query->paginate(10);
        return view('admin.price-management.list', compact('priceManagements'));
    }

    public function create()
    {
        $permissions = getAuthUserModulePermissions();
        
        if (!hasPermissions($permissions, 'add-new-price-management')) {
            abort(403, 'Unauthorized');
        }

        return view('admin.price-management.create');
    }

    public function store(Request $request)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'add-new-price-management')) {
            abort(403, 'Unauthorized');
        }

        // Validate input data
        $validator = Validator::make($request->all(), [
            'label' => 'required|string|max:255',
            'price_type' => ['required', 'string', Rule::in(array_column(PriceTypeEnum::cases(), 'value'))],
            'description' => 'nullable|string|max:1000', // validate description
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        // Retrieve existing price management records for the current user
        $existingRecords = PriceManagement::where('user_id', Auth::id())->get();

        // Ensure price_data is an array, even if it's a JSON string
        $priceData = is_array($request->price_data) ? $request->price_data : json_decode($request->price_data, true);

        // Check for duplicate order_no in existing records
        foreach ($priceData as $newData) {
            foreach ($existingRecords as $record) {
                $existingData = json_decode($record->data, true);

                foreach ($existingData as $existingItem) {
                    if (isset($existingItem['order_no']) && $existingItem['order_no'] == $newData['order_no']) {
                        return response()->json([
                            'status' => false,
                            'message' => "Order No. {$newData['order_no']} is already stored in the database.",
                        ]);
                    }
                }
            }
        }

        // Store the new price management entry
        $priceManagement = new PriceManagement();
        $priceManagement->label = $request->label;
        $priceManagement->price_type = $request->price_type;
        $priceManagement->data = json_encode($priceData);  // Ensure price_data is stored as JSON
        $priceManagement->user_id = Auth::id();
        $priceManagement->description = $request->description; // Assign description
        $priceManagement->save();

        $request->session()->flash('success', 'Price Management added successfully');

        return response()->json([
            'status' => true,
            'message' => 'Price Management added successfully',
        ]);
    }


    public function edit($id)
    {
        $permissions = getAuthUserModulePermissions();
        
        if (!hasPermissions($permissions, 'edit-price-management')) {
            abort(403, 'Unauthorized');
        }

        $priceManagement = PriceManagement::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        return view('admin.price-management.edit', compact('priceManagement'));
    }

    public function update(Request $request, $id)
    {
        $permissions = getAuthUserModulePermissions();

        if (!hasPermissions($permissions, 'edit-price-management')) {
            abort(403, 'Unauthorized');
        }

        // Validate input data
        $validator = Validator::make($request->all(), [
            'label' => 'required|string|max:255',
            'price_type' => ['required', 'string', Rule::in(array_column(PriceTypeEnum::cases(), 'value'))],
            'description' => 'nullable|string|max:1000', // validate description
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        // Retrieve the PriceManagement record to be updated
        $priceManagement = PriceManagement::find($id);

        if (!$priceManagement) {
            return response()->json([
                'status' => false,
                'message' => 'Price Management record not found.',
            ]);
        }

        // Ensure the current user is the owner of this record
        if ($priceManagement->user_id != Auth::id()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized action on this record.',
            ]);
        }

        // Retrieve existing price management records for the current user
        $existingRecords = PriceManagement::where('user_id', Auth::id())->get();

        // Ensure price_data is an array, even if it's a JSON string
        $priceData = is_array($request->price_data) ? $request->price_data : json_decode($request->price_data, true);

        // Check for duplicate order_no in existing records
        foreach ($priceData as $newData) {
            foreach ($existingRecords as $record) {
                if ($record->id != $id) { // Avoid checking the record being updated
                    $existingData = json_decode($record->data, true);

                    foreach ($existingData as $existingItem) {
                        if (isset($existingItem['order_no']) && $existingItem['order_no'] == $newData['order_no']) {
                            return response()->json([
                                'status' => false,
                                'message' => "Order No. {$newData['order_no']} is already stored in the database.",
                            ]);
                        }
                    }
                }
            }
        }

        // Update the PriceManagement record
        $priceManagement->label = $request->label;
        $priceManagement->price_type = $request->price_type;
        $priceManagement->data = json_encode($priceData);  // Ensure price_data is stored as JSON
        $priceManagement->description = $request->description; // Update description
        $priceManagement->save();

        $request->session()->flash('success', 'Price Management updated successfully');

        return response()->json([
            'status' => true,
            'message' => 'Price Management updated successfully',
        ]);
    }




    public function destroy($id)
    {
        $permissions = getAuthUserModulePermissions();
        
        if (!hasPermissions($permissions, 'delete-price-management')) {
            abort(403, 'Unauthorized');
        }

        $priceManagement = PriceManagement::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$priceManagement) {
            return response()->json(['status' => false, 'message' => 'Price Management not found']);
        }

        $priceManagement->delete();

        return response()->json(['status' => true, 'message' => 'Price Management deleted successfully']);
    }

}
