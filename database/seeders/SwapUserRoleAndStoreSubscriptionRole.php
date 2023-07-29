<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Plan;

class SwapUserRoleAndStoreSubscriptionRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::get();
        foreach ($users as $user) {
            $active_subscription = $user->subscriptions()->active()->first();
            if ($active_subscription) {
                $plan = Plan::where('stripe_plan_id', $active_subscription->stripe_price)->with('product')->first();
                $product_id = $plan->product->stripe_product_id;
                $role = Role::where('name', $plan->product->stripe_product_id)->first();
                if ($role) {
                    $user->assignRole([$role->id]);
                }
            }
        }
    }
}
