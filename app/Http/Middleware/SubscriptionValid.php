<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Str;
use App\Models\UserRole;


class SubscriptionValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, String $permission_name)
    {
        // first check User role and permission is valid or not;

        $role = UserRole::where('slug','!=' ,'super_admin')->where('id', auth()->user()->role)->first();
        if ($role) {
            $permissions = $role->permissions->where('guard_name', 'user')->pluck('slug')->toArray();
            if (!in_array($permission_name, $permissions)) {
                return redirect()->route('plan.index');
            }
        }
        // check subscription is valid or not
        $permission = Permission::where('permission_slug', $permission_name)->first();
        if ($permission) {
            $splitString = explode("|", $permission->protected_routes);
            $checkpermission = auth()->user()->hasPermissionTo($permission->name);
            if (in_array($request->route()->getName(), $splitString)) {
                if (!$checkpermission) {
                    return redirect()->route($permission->redirect_route);
                }
            }
        }       
        return $next($request);
    }
}
