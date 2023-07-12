<?php 

namespace App\Service;

use Illuminate\Support\ServiceProvider;
use Twilio\Rest\Client;
use Exception;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Plan;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class StripeService
{
    protected $data;
    protected $stripe;

    public function __construct($data) {
        $this->data = $data;
        $this->stripe = $this->setupStripe();
    }

    public function setupStripe() {
        return new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }

    public function handleWebhook($type) {
        switch ($type) {
            case 'payment_intent.succeeded':
                $this->handlePaymentIntentSucceeded();
            break;
            case 'customer.subscription.updated':
                $this->hanldeCustomerSubscriptionUpdated();
            break;
            default:
            break;
        }
    }

    public function handlePaymentIntentSucceeded() {
        $subscription = Subscription::where('stripe_id', $this->data['id'])->where('plan_type', 'one-time')->first();
        if ($subscription) {
            $subscription->stripe_status = $this->data['status'] == 'succeeded' ? 'active' : 'failed';
            $subscription->plan_end_date = $this->data['metadata']['expires'];
            $subscription->save();
        }
    }

    public function hanldeCustomerSubscriptionUpdated() {
        $customer = $this->data['customer'];
        $user = User::where('stripe_id', $customer)->first();
        if ($user) {
            $subscription = Subscription::where('stripe_id', $this->data['id'])->first();
            if ($subscription) {
                $plan = Plan::where('stripe_plan_id', $active_subscription->stripe_price)->with('product')->first();
                $role = Role::where('name', $plan->product->stripe_product_id)->first();
                if ($role) { 
                    $user->removeRole($role->id);
                }
                $subscription->stripe_status = $this->data['status'];
                $subscription->save();
            }
        }
    }
}
?>