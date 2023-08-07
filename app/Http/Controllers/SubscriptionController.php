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
        $is_auto_renewal = false;
        $invoice = null;
        if ($subscription->plan_type == 'subscription') { 
            $getSubscription = $this->stripe->subscriptions->retrieve(
                $subscription->stripe_id,
                []
            );
            $paymentMethod = $getSubscription->default_payment_method;
            $subscription->next_billing_date = Carbon::createFromTimestamp($getSubscription->current_period_end)->format('M d, Y');
            $is_auto_renewal = $getSubscription->cancel_at_period_end;
            if ($is_auto_renewal) {
                $subscription->canceled_at = Carbon::createFromTimestamp($getSubscription->current_period_end)->format('M d, Y');
            }
            $invoice = $getSubscription->latest_invoice;
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
        return view('user.my_subscriptions', [
            'subscription' => $subscription, 
            'currentPlan' => $currentPlan, 
            'card' => $card,
            'is_auto_renewal' => $is_auto_renewal,
            'invoice' => $invoice
        ]);
    }


    public function cancelsubscriptions(Request $request)
    {
        $user = Auth::user();
        $active_subscription = $user->subscriptions->first();
        $plan = Plan::where('stripe_plan_id', $active_subscription->stripe_price)->with('product')->first();
        $product_id = $plan->product->stripe_product_id;
        $role = Role::where('name', $plan->product->stripe_product_id)->first();
        if ($plan->interval == 'hour') {
            $this->cancelOneTimePlan($active_subscription);
            $user->removeRole($role->id);
            return response()->json([
                'success' => true,
                'message' => 'Subscription is canceled successfully',
                'type' => 'one-time'
            ], 200);
        } else {
            $user->subscription('default')->cancel();
            if (!auth()->user()->subscription('default')->onGracePeriod()) {
                $user->removeRole($role->id);
            }
            return response()->json([
                'success' => true,
                'message' => 'Subscription is canceled successfully',
                'type' => 'subscription'
            ], 200);
        }
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
        try {
            $user = auth()->user();
            $user->subscription('default')->resume();
            $active_subscription = $user->subscriptions->first();
            $plan = Plan::where('stripe_plan_id', $active_subscription->stripe_price)->with('product')->first();
            $product_id = $plan->product->stripe_product_id;
            $role = Role::where('name', $plan->product->stripe_product_id)->first();
            $user->syncRoles($role->id);
            return response()->json([
                'success' => true,
                'message' => 'Subscription is resumed successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 200);
        }
    }

    public function offSubscriptionAutoRenewval(Request $request) {
        try {
            $is_auto_renewal = $request->is_auto_renewal == 'false' ? true : false;
            $updateSubscription = $this->stripe->subscriptions->update(
                $request->subscription_id,
                [
                    'cancel_at_period_end' => $is_auto_renewal
                ]
            );
            return response()->json([
                'success' => true,
                'message' => 'Subscription is updated successfully'
            ], 200);
        } catch (\Exception $e) { 
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 200);
        }
    }

    public function downloadUserInvoice(Request $request, string $invoiceId) {
        return $request->user()->downloadInvoice($invoiceId, [], 'invoice');
    }
}
