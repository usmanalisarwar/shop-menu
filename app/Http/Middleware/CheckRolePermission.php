<?php

namespace App\Http\Middleware;

use App\Models\RolePermission;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$module, $permission): Response
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect('admin/login'); // Redirect to the login page if not authenticated
        }
        $user = auth()->user();
        if(!$user->role_id){
            abort(403, 'Unauthorized'); // Return a 403 Forbidden response if the role check fails
        }
        if($user->role_id == 1){
            return $next($request); // User is super Admin
        }
        $userHasPermission = RolePermission::where('role_id',$user->role_id)
            ->where('module',$module)
            ->where('permission',$permission)
            ->first();
//        dd(RolePermission::where('permission','read-state')->get());
        if(!$userHasPermission){
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
