<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;
use App\Models\PermissionModule;
use App\Models\UserPermission;
use App\Models\UserRolehHasPermission;
use Illuminate\Support\Str;

class UpdateUserRolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions_moduels = config('staticpermission.permissions');
        foreach ($permissions_moduels as $module) {
            $permission_module = PermissionModule::where([
                'name' => $module['name']
            ])->first();

            if (count($module['permissions']) > 0) {
                foreach ($module['permissions'] as $permission) {
                    UserPermission::create([
                        'name' => $permission,
                        'slug' => Str::slug($permission),
                        'module_id' => $permission_module->id,
                        'protected_routes' => $module['protected_routes'],
                        'redirect_route' => $module['redirect_route'],
                    ]);
                }
            }
        }

        $roles = UserRole::where('slug', '!=', 'super_admin')->get();
        $permissions = UserPermission::where('guard_name', 'user')->get();
        foreach ($roles as $role) {
            $role->permissions()->attach($permissions->pluck('id')->toArray());
        }
    }
}
