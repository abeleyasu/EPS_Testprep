<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;
use App\Models\UserPermission;

class UpdateUserRolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = UserRole::where('slug', '!=', 'super_admin')->get();
        $permissions = UserPermission::where('guard_name', 'user')->get();
        foreach ($roles as $role) {
            $existingPermission = $role->permissions->pluck('id')->toArray();
            if (count($existingPermission) > 0) {
                $role->permissions()->detach($existingPermission);
            }
            $role->permissions()->attach($permissions->pluck('id')->toArray());
        }
    }
}
