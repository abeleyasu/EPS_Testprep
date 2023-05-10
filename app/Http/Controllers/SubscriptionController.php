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
        $subscriptions = $user->subscriptions;
        $subscriptions->each(function ($subscription) {
            $subscription->plan = Plan::where('stripe_plan_id', $subscription->stripe_price)->first();
            $subscription->product_title = Product::where('id', $subscription->plan->product_id)->get();
        });
        return view('user.my_subscriptions', compact('subscriptions'));
    }


    public function cancelsubscriptions(Request $request)
    {
        $subscriptionName = $request->subscriptionName;
        if ($subscriptionName) {
            $user = auth()->user();
            $user->subscription($subscriptionName)->cancel();
            return "Subscription is cancelled";
        }
        // Retrieve the subscription
        // $user = Auth::user();
        // DB::table('subscriptions')->where('stripe_id', $request->id)->update(['stripe_status' => 'cancelled']);;
        // $subscription = $this->stripe->subscriptions->cancel($request->id);

        // // print_r($subscription);
        // // die();
        // // Cancel the subscription
        // // $subscription->cancel();

        // // Redirect back with success message
        // return back()->with('success', 'Subscription cancelled successfully.');
        // } catch (ApiErrorException $e) {
        //     // Handle any errors
        //     return back()->with('error', $e->getMessage());
        // }
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
