<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\PermissionModule;
use App\Models\User;
use App\Models\UserRole;

class RolesController extends Controller
{
    public function index() {
        $roles = UserRole::where('slug','!=','super_admin')->get();
        return view('admin.role-permission.roles.list', compact('roles'));
    }

    public function permissionList($id) {
        $permissions_module = PermissionModule::with(['userPermission' => function ($q) {
            $q->where('guard_name', 'user');
        }])->get()->toArray();
        $role = UserRole::where('id', $id)->first();
        $attach_permission = [];
        if ($role) {
            $attach_permission = $role->permissions->pluck('id')->toArray();
        }
        return view('admin.role-permission.roles.permission-list', compact('permissions_module', 'attach_permission', 'role'));
    }

    public function attachPermission(Request $request) {
        $role = UserRole::where('id', $request->role_id)->first();
        if ($role) {
            $existingPermission = $role->permissions->pluck('id')->toArray();
            if (count($existingPermission) > 0) {
                $role->permissions()->detach($existingPermission);
            }
            $role->permissions()->attach($request->permission);
            return redirect()->route('admin.roles.index')->with('success', 'Permission attached successfully');
        }
        return redirect()->route('admin.roles.index')->with('error', 'Role not found');
    }

    public function ajaxRoles(Request $request) {
        $page = isset($request->page) ? $request->page : 1;
        $search = isset($request->search) ? $request->search : null;
        $limit = $page * 25;
        $roles = UserRole::where('slug','!=','super_admin')->select('id', 'name as text');
        if (!empty($search)) {
            $roles = $roles->where(function ($role) use ($search) {
                $role->where('name', 'like', '%' . $search . '%');
            });
        }
        $roles = $roles->paginate($limit);
        $roles = $roles->toArray();
        return response()->json([
            'data' => $roles['data'],
            'total' => $roles['total']
        ]);
    }
}
