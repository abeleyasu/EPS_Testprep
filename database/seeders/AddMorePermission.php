<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PermissionModule;
use Spatie\Permission\Models\Permission;
use App\Models\UserPermission;
use Illuminate\Support\Str;

class AddMorePermission extends Seeder
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
            $is_exist_module = PermissionModule::where([
                'name' => $module['name']
            ])->first();
            if (!$is_exist_module) {
                $is_exist_module = PermissionModule::create([
                    'name' => $module['name']
                ]);
            }

            if (count($module['permissions']) > 0) {
                foreach ($module['permissions'] as $permissions) {
                    if (gettype($permissions) == 'array') {
                        $permission_slug = Str::slug($permissions['name']);
                        $is_exist_user_permission = UserPermission::where('slug', $permission_slug)->first();
                        if (!$is_exist_user_permission) {
                            UserPermission::create([
                                'name' => $permissions['name'],
                                'slug' => $permission_slug,
                                'module_id' => $is_exist_module->id,
                                'protected_routes' => $permissions['protected_routes'] ? $permissions['protected_routes'] : NULL,
                                'redirect_route' => $permissions['redirect_route'] ? $permissions['redirect_route'] : NULL,
                            ]);
                        }

                        $is_exist_permission = Permission::where('permission_slug', $permission_slug)->first();
                        if (!$is_exist_permission) {
                            Permission::create([
                                'name' => $permissions['name'],
                                'guard_name' => 'web',
                                'permision_module_id' => $is_exist_module->id,
                                'permission_slug' => $permission_slug,
                                'protected_routes' => $permissions['protected_routes'] ? $permissions['protected_routes'] : NULL,
                                'redirect_route' => $permissions['redirect_route'] ? $permissions['redirect_route'] : NULL,
                            ]);
                        }
                    } else {
                        $permission_slug = Str::slug($permissions);
                        $is_exist_user_permission = UserPermission::where('slug', $permission_slug)->first();
                        if (!$is_exist_user_permission) {
                            UserPermission::create([
                                'name' => $permissions,
                                'slug' => $permission_slug,
                                'module_id' => $is_exist_module->id,
                                'protected_routes' => $module['protected_routes'],
                                'redirect_route' => $module['redirect_route'],
                            ]);
                        }

                        $is_exist_permission = Permission::where('permission_slug', $permission_slug)->first();
                        if (!$is_exist_permission) {
                            Permission::create([
                                'name' => $permissions,
                                'guard_name' => 'web',
                                'permision_module_id' => $is_exist_module->id,
                                'permission_slug' => $permission_slug,
                                'protected_routes' => $module['protected_routes'],
                                'redirect_route' => $module['redirect_route'],
                            ]);
                        }
                    }
                }
            }
        }
    }
}
