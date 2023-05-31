<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use Stripe\Customer;
use DB;

class SubscriptionController extends Controller
{
    private $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(config('stripe.api_keys.secret_key'));
    }

    public function mysubscriptions()
    {
        $user = Auth::user();
        if (!$user->subscribed('default')) {
            return redirect('/user/plans');  
        }
        $subscription = $user->subscriptions->first();
        $currentPlan = Plan::where('stripe_plan_id', $subscription->stripe_price)->first();
        $card = $user->defaultPaymentMethod();
        return view('user.my_subscriptions', ['subscription' => $subscription, 'currentPlan' => $currentPlan, 'card' => $card]);
    }


    public function cancelsubscriptions(Request $request)
    {
        $user = Auth::user();
        $user->subscription('default')->cancelNow();
        return "success";
    }

    public function resumesubscriptions(Request $request)
    {
        $user = auth()->user();
        $subscriptionName = $request->subscriptionName;
        if ($subscriptionName) {
            $user->subscription($subscriptionName)->resume();
            return "Subscription is resumed";
        }
    }
}
