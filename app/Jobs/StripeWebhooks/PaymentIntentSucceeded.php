<?php

namespace App\Jobs\StripeWebhooks;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\WebhookClient\Models\WebhookCall;
use Illuminate\Support\Facades\Log;
use App\Models\Subscription;

class PaymentIntentSucceeded implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

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
            $subscription = Subscription::where('stripe_id', $data['id'])->where('plan_type', 'one-time')->first();
            if ($subscription) {
                $subscription->stripe_status = $data['status'] == 'succeeded' ? 'active' : 'failed';
                $subscription->plan_end_date = $data['metadata']['expires'];
                $subscription->save();
            }
        } catch (\Exception $e) {
            Log::channel('stripewebhook')->error($e->getMessage());
        }
    }
}
