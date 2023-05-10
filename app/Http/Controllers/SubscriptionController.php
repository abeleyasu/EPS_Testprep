<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;

class SubscriptionController extends Controller
{
    private $stripe;
    public function __construct() {
        $this->stripe = new \Stripe\StripeClient(config('stripe.api_keys.secret_key'));
    }
    public function addSubsciption(Request $request)
    {
        $plan = Plan::find($request->plan);
        $user = Auth::user();
        $user->createOrGetStripeCustomer();
        $paymentmethod = NULL;
        if ($request->payment_method) {
            $paymentmethod = $user->addPaymentMethod($request->payment_method);
            $user->updateDefaultPaymentMethod($request->payment_method);
        }
        // dd($paymentmethod);
        if ($user->hasDefaultPaymentMethod()) {
            // plan_RandomNumerb
            $sub = $user->newSubscription('default', 'price_1N4I7rSJaQu22sp2YNFWMEks')->create($paymentmethod ? $paymentmethod->id : '');
            if ($user->subscribed('default')) {
                dd($sub);
            }
        }
        // $subscription_obj = $user->newSubscription('default','plan_NnmkXGjlQN5HQQ')
        //     ->checkout([
        //     'success_url' => route('plan.index'),
        //         'cancel_url'=>route('home')
        // ]);
//        dd($subscription_obj->url);
        // return redirect($subscription_obj->url);
    }
}
