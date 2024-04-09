<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Product;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Schema;
use DB;

class ConvertPlanToRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        $permissions = Permission::get();
        $freeRole = Role::create([
            'name' => config('constants.role_free_name')
        ]);
        if (count($permissions) > 0) {
            $freeRole->syncPermissions($permissions);
        }
        $products = Product::get();
        foreach ($products as $key => $product) {
            $role = Role::create([
                'name' => $product->stripe_product_id
            ]);
            if (count($permissions) > 0) {
                $role->syncPermissions($permissions);
            }
        }
        Schema::enableForeignKeyConstraints();
    }
}
