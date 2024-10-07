<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Enums\StatusEnum;
use App\Http\Requests\Roles\AddRoleRequest;
use App\Http\Requests\Roles\DeleteRoleRequest;
use App\Http\Requests\Roles\EditRoleRequest;
use App\Http\Resources\ResourceRole;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'read-role')) {
            abort(403, 'Unauthorized'); // Return a 403 Forbidden response if the role check fails
        }
        if (!$request->ajax()) {
            $active = 'roles';
            $breadCrumbs = [
                [
                    'name' => 'Dashboard',
                    'url' => url('/')
                ],
                [
                    'name' => 'Roles',
                    'url' => url('admin/roles'),
                    'active' => 'roles',
                ]
            ];
            $statuses = StatusEnum::values();
            return view('roles', compact('active', 'breadCrumbs', 'permissions','statuses'));
        } else {
            $model = Role::query();

            return DataTables::of($model)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d F, Y H:i');
                })
                ->addColumn('actions', function ($data) use ($permissions) {
                    $html = "";
                    if ($data->id > 4) {
                        if (hasPermissions($permissions, 'assign-permission')) {
                            $html .= '<a title="Assign Permissions" class="btn btn-info m-1" href="'.route('roles.permissions',['roleId'=>$data->id]).'" ><i class="fas fa-key"></i></a>';
                        }
                        if (hasPermissions($permissions, 'edit-role')) {
                            $html .= "<a title='Edit Role' class='btn btn-primary m-1 edit-record' href='javascript:void(0);' data-id='" . $data->id . "' data-data='" . json_encode($data->toArray()) . "'><i class='fas fa-edit'></i></a>";
                        }
                        if (hasPermissions($permissions, 'delete-role')) {
                            $html .= '<a title="Delete Role" class="btn btn-danger m-1 delete-record" href="javascript:void(0);" data-id="' . $data->id . '" ><i class="fas fa-trash"></i></a>';
                        }
                    }
                    return $html;
                })->rawColumns(['actions'])->make(true);
        }

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddRoleRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "New role created successfully!";
        $data = $request->validated();
        $response['data'] = new ResourceRole(Role::create($data));
        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EditRoleRequest $request)
    {

        $response['status'] = true;
        $response['message'] = "Role Updated successfully!";
        $data = $request->validated();
        $role = Role::where('id', $request->id)->where('id','>',4)->first();
        $role->name = $data['name'];
        $role->status = $data['status'];
        $role->save();
        $response['data'] = new ResourceRole($role);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteRoleRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "Role Deleted successfully!";
        $role = Role::where('id', $request->id)->where('id','>',4)->first();
        $role->delete();
        $response['data'] = new ResourceRole($role);
        return response()->json($response);
    }

    public function permissions(Request $request, $roleId)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'assign-permission')) {
            abort(403, 'Unauthorized'); // Return a 403 Forbidden response if the role check fails
        }
        $role = Role::whereNotIn('id',[1,3,4])->where('id',$roleId)->first();
        if(!$role){
            return  redirect('admin/roles');
        }
        $active = 'roles';
        $breadCrumbs = [
            [
                'name' => 'Dashboard',
                'url' => url('/')
            ],
            [
                'name' => 'Roles',
                'url' => url('admin/roles'),
            ],
            [
                'name' => 'Role Permissions',
                'url' => url('admin/roles'),
                'active' => 'roles',
            ]
        ];
        $modules = Module::with(['permissions'])->get();
        $rolePermission = $role->permissions()->pluck('permission_id')->toArray();
        return view('permissions', compact('active', 'breadCrumbs', 'permissions','modules','role','rolePermission'));

    }

    public function assignPermissions(Request $request, $roleId)
    {
        $permissions = getAuthUserModulePermissions();
        if (!hasPermissions($permissions, 'assign-permission')) {
            abort(403, 'Unauthorized'); // Return a 403 Forbidden response if the role check fails
        }
        $role = Role::whereNotIn('id',[1,3,4])->where('id',$roleId)->first();
        if(!$role){
            return  redirect('admin/roles');
        }
        $data = $request->all();
        $now = Carbon::now()->toDateTimeString();
        $rolePermissions = [];
        if(isset($data['permissions']) && is_array($data['permissions']) && count($data['permissions'])){
            RolePermission::where('role_id',$roleId)->delete();

            foreach ($data['permissions'] as $permission){
                $permissionData = Permission::with(['module'])->where('id',$permission)->first();
                if($permissionData){
                    $rolePermissions[] = [
                        'role_id'=>$role->id,
                        'module_id'=>$permissionData->module->id,
                        'permission_id'=>$permissionData->id,
                        'module'=>$permissionData->module->slug,
                        'permission'=>$permissionData->slug,
                        'created_at'=>$now,
                        'updated_at'=>$now,
                    ];
                }
            }
        }
        RolePermission::insert($rolePermissions);
        return redirect()->route('roles.permissions',['roleId'=>$role->id])->with(['success'=>"Role Permissions Updated Successfully"]);

    }
}
