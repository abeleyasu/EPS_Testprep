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
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use App\Models\Subscription;

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
        $paymentMethod = null;
        if ($subscription->plan_type == 'subscription') { 
            $getSubscription = $this->stripe->subscriptions->retrieve(
                $subscription->stripe_id,
                []
            );
            $paymentMethod = $getSubscription->default_payment_method;
            $subscription->next_billing_date = Carbon::createFromTimestamp($getSubscription->current_period_end)->format('M d, Y');
        } else if ($subscription->plan_type == 'one-time') {
            $paymentIntent = $this->stripe->paymentIntents->retrieve(
                $subscription->stripe_id,
                []
            );
            $paymentMethod = $paymentIntent->payment_method;
        }
        if ($subscription->plan_end_date) {
            $subscription->plan_end_date = Carbon::parse($subscription->plan_end_date)->diffForHumans();
        }
        $currentPlan = Plan::where('stripe_plan_id', $subscription->stripe_price)->first();
        $card = null;
        if ($paymentMethod) {
            $card = $this->stripe->paymentMethods->retrieve(
                $paymentMethod,
                []
            );
        } else {
            $card = $user->defaultPaymentMethod();
        }
        return view('user.my_subscriptions', ['subscription' => $subscription, 'currentPlan' => $currentPlan, 'card' => $card]);
    }


    public function cancelsubscriptions(Request $request)
    {
        $user = Auth::user();
        $active_subscription = $user->subscriptions->first();
        $plan = Plan::where('stripe_plan_id', $active_subscription->stripe_price)->with('product')->first();
        $product_id = $plan->product->stripe_product_id;
        $role = Role::where('name', $plan->product->stripe_product_id)->first();
        if ($role) {
            $user->removeRole($role->id);
        }
        if ($plan->interval == 'hour') {
            $this->cancelOneTimePlan($active_subscription);
        } else {
            $user->subscription('default')->cancelNow();
        }
        return "success";
    }

    public function cancelOneTimePlan($subscription) {
        $userSubscription = Subscription::where('stripe_id', $subscription->stripe_id)->first();
        if ($userSubscription && $userSubscription->stripe_status == 'active') {
            $userSubscription->stripe_status = 'canceled';
            $userSubscription->ends_at = date('Y-m-d H:i:s');
            $userSubscription->save();
        } 
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
