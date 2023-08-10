<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Service\Interface\MailgunServiceInterface;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $mailgun, $stripe;

    public function __construct(MailgunServiceInterface $mailgun) {
        $this->mailgun = $mailgun;
        $this->stripe = new \Stripe\StripeClient(config('stripe.api_keys.secret_key'));
    }
}
