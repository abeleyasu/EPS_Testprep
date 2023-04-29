<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;

class SubscriptionController extends Controller
{
    private $stripe;
    public function __construct() {
        $this->stripe = new \Stripe\StripeClient(config('stripe.api_keys.secret_key'));
    }
    public function addSubsciption()
    {
        $card = $this->stripe->customers->allPaymentMethods(Auth::user()->stripe_id)->first();

        $id = Auth::user()->id;

       $user = User::find($id);
        $customer = Cashier::findBillable(Auth::user()->stripe_id);

//        $token = $this->generateAccessToken($card);
//dd($user->asStripeCustomer());
        $subscription_obj = $user->newSubscription('primary','plan_Nnjo4zFX8rSxGy')->create($card->id);
        dd($subscription_obj);

    }

        private function generateAccessToken($card)
        {

            $client = new \GuzzleHttp\Client();
            $url = 'https://api.stripe.com/v1/tokens';
            $pubKey = env("STRIPE_SECRET");
            $postBody = [
                'key' => $pubKey,
                'payment_user_agent' => 'stripe.js/Fbebcbe6',
                'card' => [
                    'number' => $card['card_number'],
                    'cvc' => $card['card_cvc'],
                    'exp_month' => $card->card->exp_month,
                    'exp_year' => $card['exp_year'],
                    'name' => $card['name']
                ]
            ];
            dd([$card,$card->card->exp_month]);
            $response = $client->post($url, [
                'form_params' => $postBody
            ]);

            $response_obj = json_decode($response->getbody()->getContents());

            return $response_obj->id;
        }
}
