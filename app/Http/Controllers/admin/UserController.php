<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Enums\CompanyStatusEnum;
use App\Enums\RequestStatusEnum;
use App\Enums\StatusEnum;
use App\Http\Requests\Users\AddUserRequest;
use App\Http\Requests\Users\DeleteUserRequest;
use App\Http\Requests\Users\EditUserRequest;
use App\Http\Resources\ResourceUser;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = getAuthUserModulePermissions();
        $user=auth()->user();
        if (!hasPermissions($permissions, 'read-user')) {
            abort(403, 'Unauthorized'); // Return a 403 Forbidden response if the role check fails
        }
        if (!$request->ajax()) {
            $active = 'users';
            $breadCrumbs = [
                [
                    'name' => 'Dashboard',
                    'url' => url('/')
                ],
                [
                    'name' => 'Users',
                    'url' => url('users'),
                    'active' => 'users',
                ]
            ];
            $statuses = StatusEnum::values();
            $roles = Role::where('status',StatusEnum::ACTIVE)->whereNotIn('id', [3,4])->orderBy('name','asc')->get();
            return view('users', compact(
                'active',
                'breadCrumbs',
                'permissions',
                'roles',
                'statuses'
            ));
        } else {
            $roleId = [3,4];

            $model = User::query()
                ->whereHas('role', function ($query) use ($roleId) {
                    $query->whereNotIn('role_id', $roleId);
                })
                ->with(['role'])
                ->get();
            if (auth()->user()->role != 'admin') {

                $model->where('created_by', $user->id)->where('updated_by', $user->id);
            }

            return DataTables::of($model)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d F, Y H:i');
                })
                ->editColumn('role_id', function ($data) {
                    return $data->role?->name;
                })
                ->addColumn('actions', function ($data) use ($permissions) {
                    $html = "";
                    if($data->id >= 3){

                        if (hasPermissions($permissions, 'edit-user')) {
                            $html .= "<a title='Edit User' class='btn btn-primary m-1 edit-record' href='javascript:void(0);' data-id='" . $data->id . "' data-data='" . json_encode($data->toArray()) . "'><i class='fas fa-edit'></i></a>";
                        }
                        if (hasPermissions($permissions, 'delete-user')) {
                            $html .= '<a title="Delete User" class="btn btn-danger m-1 delete-record" href="javascript:void(0);" data-id="' . $data->id . '" ><i class="fas fa-trash"></i></a>';
                        }

                    }
                    return $html;
                })->rawColumns(['actions'])->make(true);
        }

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddUserRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "New User created successfully!";
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['email_verified_at'] = date('Y-m-d H:i:s');
        $response['data'] = new ResourceUser(User::create($data));
        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EditUserRequest $request)
    {

        $response['status'] = true;
        $response['message'] = "User Updated successfully!";
        $data = $request->all();
        $user = User::where('id', $request->id)->first();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->company_name = $data['company_name'];
        $user->role_id = $data['role_id'];
        if(!empty($request->password)){
            $user->password = Hash::make($data['password']);
        }

        $user->save();
        $response['data'] = new ResourceUser($user);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteUserRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "User Deleted successfully!";
        $category = User::where('id', $request->id)->first();
        $category->delete();
        $response['data'] = new ResourceUser($category);
        return response()->json($response);
    }


}
