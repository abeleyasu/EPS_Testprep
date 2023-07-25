<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPermission;

class PermissionsController extends Controller
{
    public function index() {
        $permissions = UserPermission::where('guard_name', 'user')->with('module')->get();
        // dd($permissions->toArray());
        return view('admin.role-permission.permissions.list', [
            'permissions' => $permissions
        ]);
    }
}
