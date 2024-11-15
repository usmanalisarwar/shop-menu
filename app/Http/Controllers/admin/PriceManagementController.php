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

        // Ensure price_data is present in the request
        $priceData = $request->price_data;

        if (!$priceData) {
            return response()->json([
                'status' => false,
                'message' => 'Price data is required.',
            ]);
        }

        // Ensure price_data is an array, even if it's a JSON string
        $priceData = is_array($priceData) ? $priceData : json_decode($priceData, true);

        // If the decoded price_data is not valid, return an error message
        if (!is_array($priceData)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or missing price data.',
            ]);
        }

        // Check for duplicate order_no in existing records
        foreach ($priceData as $newData) {
            foreach ($existingRecords as $record) {
                $existingData = json_decode($record->data, true);

                // Add a null check for $existingData
                if (is_array($existingData)) {
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

        // Store the new price management entry
        $priceManagement = new PriceManagement();
        $priceManagement->label = $request->label;
        $priceManagement->price_type = $request->price_type;
        $priceManagement->user_id = Auth::id();
        $priceManagement->description = $request->description; 
        $priceManagement->save();

        // Insert new price management details
        foreach ($priceData as $data) {
            \DB::table('price_management_details')->insert([
                'price_management_id' => $priceManagement->id,
                'label' => $data['label'],
                'order_no' => $data['order_no'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

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

        $priceManagement = PriceManagement::where('id', $id)
            ->where('user_id', Auth::id()) // Ensure the record belongs to the current user
            ->firstOrFail();

        // Get the associated details
        $details = $priceManagement->details;

        return view('admin.price-management.edit', compact('priceManagement', 'details'));
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

        // Retrieve the existing price management record
        $priceManagement = PriceManagement::where('id', $id)
            ->where('user_id', Auth::id()) // Ensure the record belongs to the current user
            ->first();

        if (!$priceManagement) {
            return response()->json([
                'status' => false,
                'message' => 'Price management record not found or unauthorized.',
            ]);
        }

        // Ensure price_data is present in the request
        $priceData = $request->price_data;

        if (!$priceData) {
            return response()->json([
                'status' => false,
                'message' => 'Price data is required.',
            ]);
        }

        // Ensure price_data is an array, even if it's a JSON string
        $priceData = is_array($priceData) ? $priceData : json_decode($priceData, true);

        // If the decoded price_data is not valid, return an error message
        if (!is_array($priceData)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or missing price data.',
            ]);
        }

        // Retrieve existing price management details for duplicate check
        $existingRecords = PriceManagement::where('user_id', Auth::id())->get();

        // Check for duplicate order_no in existing records
        foreach ($priceData as $newData) {
            foreach ($existingRecords as $record) {
                $existingData = json_decode($record->data, true);

                // Add a null check for $existingData
                if (is_array($existingData)) {
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

        // Update the existing price management record
        $priceManagement->label = $request->label;
        $priceManagement->price_type = $request->price_type;
        $priceManagement->description = $request->description;
        $priceManagement->save();

        // Clear the old details and insert updated ones
        \DB::table('price_management_details')
            ->where('price_management_id', $priceManagement->id)
            ->delete(); // Delete old details

        foreach ($priceData as $data) {
            \DB::table('price_management_details')->insert([
                'price_management_id' => $priceManagement->id,
                'label' => $data['label'],
                'order_no' => $data['order_no'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

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
