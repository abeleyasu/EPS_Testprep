<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Service\StripeService;

use Laravel\Cashier\Events\WebhookReceived;

class StripeEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(WebhookReceived $event): void
    {
        try {
            $data = $event->payload['data']['object'];
            $stripeService = new StripeService($data);
            Log::channel('stripewebhook')->info($data);
            $stripeService->handleWebhook($event->payload['type']);
        } catch (\Exception $e) {
            Log::channel('stripewebhook')->error($e->getMessage());
        }
    }
}
