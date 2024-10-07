<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\SlugHelper;

class RoleController extends Controller
{
    protected $slugHelper;

    public function __construct(SlugHelper $slugHelper)
    {
        $this->slugHelper = $slugHelper;
    }

    /**
     * Display a listing of the roles.
     */
    public function index(Request $request)
    {
        $query = Role::orderBy('id', 'asc');

        if ($keyword = $request->get('keyword')) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        $roles = $query->paginate(10);

        return view('admin.role.list', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:roles,name',
            'status' => 'required|boolean',
        ]);

        if ($validator->passes()) {
            $role = new Role();
            $role->name = $request->name;
            $role->slug = $this->slugHelper->slug('roles', 'slug', $request->name);
            $role->status = $request->status;

            $role->save();

            $request->session()->flash('success', 'Role added successfully');

            return response()->json([
                'status' => true,
                'message' => 'Role added successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role.edit', compact('role'));
    }

    /**
     * Update the specified role in storage.
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:roles,name,' . $id,
            'status' => 'required|boolean',
        ]);

        if ($validator->passes()) {
            $role->name = $request->name;
            $role->slug = $this->slugHelper->slug('roles', 'slug', $request->name, $id);
            $role->status = $request->status;

            $role->save();

            $request->session()->flash('success', 'Role updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Role updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json(['status' => true, 'message' => 'Role deleted successfully']);
    }
}
