<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\PermissionModule;
use App\Models\Permission;
use App\Models\AdminSettings;

class AdminSettingsController extends Controller
{
    public function index() {
        $free_user_role = Role::where('name', config('constants.role_free_name'))->first();
        $permissions_module = PermissionModule::with('permission')->get()->toArray();
        $attached_permissions = $free_user_role->permissions()->pluck('id')->toArray();
        $admin_settings = AdminSettings::first();
        return view('admin.settings.index', [
            'permissions_module' => $permissions_module,
            'attached_permissions' => $attached_permissions,
            'role' => $free_user_role,
            'settings' => $admin_settings
        ]);
    }

    public function subscriptionSetting(Request $request) {
        $free_user_role = Role::where('name', config('constants.role_free_name'))->first();
        $admin_settings = AdminSettings::first();
        if ($admin_settings) {
            $admin_settings->is_free_access = isset($request->is_free_access) && $request->is_free_access == 'on' ? 1 : 0;
            $admin_settings->free_access_interval_count = $request->free_access_interval_count;
            $admin_settings->free_access_interval = $request->free_access_interval_type;
            $admin_settings->save();
            $free_user_role->syncPermissions($request->permission);
        }
        return redirect()->back()->with('success', 'Subscription setting updated successfully.');
    }
}
