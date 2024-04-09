<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PermissionModule;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions_moduels = config('staticpermission.permissions');

        foreach($permissions_moduels as $key => $module) {
            $permission_module = PermissionModule::create([
                'name' => $module['name']
            ]);
            if (count($module['permissions']) > 0) {
                foreach ($module['permissions'] as $permission) {
                    Permission::create([
                        'name' => $permission,
                        'guard_name' => 'web',
                        'permision_module_id' => $permission_module->id
                    ]);
                }
            }
        }
    }
}
