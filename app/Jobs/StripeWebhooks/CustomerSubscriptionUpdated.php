<?php

namespace App\Jobs\StripeWebhooks;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookClient\Models\WebhookCall;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Subscription;

class CustomerSubscriptionUpdated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        try {
            $data = $this->webhookCall->payload['data']['object'];
            Log::channel('stripewebhook')->info($data);
            $customer = $data['customer'];
            $user = User::where('stripe_id', $customer)->first();
            if ($user) {
                $subscription = Subscription::where('stripe_id', $data['id'])->first();
                if ($subscription) {
                    $plan = Plan::where('stripe_plan_id', $active_subscription->stripe_price)->with('product')->first();
                    $role = Role::where('name', $plan->product->stripe_product_id)->first();
                    if ($role) { 
                        $user->removeRole($role->id);
                    }
                    $subscription->stripe_status = $data['status'];
                    $subscription->save();
                }
            }
        } catch (\Exception $e) {
            Log::channel('stripewebhook')->error($e->getMessage());
        }
    }
}
