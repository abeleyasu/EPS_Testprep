<?php

namespace App\Http\Controllers\Cronjob;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Subscription;

class OneTimeSubscription extends Controller
{
    private $stripe;
    public function __construct() {
        $this->stripe = new \Stripe\StripeClient(config('stripe.api_keys.secret_key'));
    }

    public function index(Request $request) {
        try {
            $subscriptions = Subscription::where([
                ['plan_type', 'one-time'],
                ['stripe_status', 'active'],
                ['plan_end_date', '<=', date('Y-m-d H:i')]
            ])->get();
            if (count($subscriptions) > 0) {
                foreach ($subscriptions as $key => $subscription) {
                    $userSubscription = Subscription::where('stripe_id', $subscription->stripe_id)->first();
                    if ($userSubscription && $userSubscription->stripe_status == 'active') {
                        $userSubscription->stripe_status = 'canceled';
                        $userSubscription->ends_at = date('Y-m-d H:i:s');
                        $userSubscription->save();
                    } 
                }
            }
        } catch (\Exception $e) {
            Log::channel('stripewebhook')->error($e->getMessage());
        }
    }
}
