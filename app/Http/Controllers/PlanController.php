<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Plan;
use Illuminate\Validation\Rule;
use App\Models\Product;

class PlanController extends Controller
{
    private $stripe;
    public function __construct() {
        $this->stripe = new \Stripe\StripeClient(config('stripe.api_keys.secret_key'));
    }
    public function index() {
        $plans = Plan::with('product')->get();
        return view('admin.plan.list', ['plans' => $plans]);
    }

    public function planTypes() {
        $data =  [
            [
                'option' => 'Month',
                'value' => 'month'
            ],
            [
                'option' => 'Year',
                'value' => 'year'
            ],
        ];
        return json_decode(json_encode($data));
    }

    public function show() {
        $plantypes = $this->planTypes();
        $products = Product::get();
        return view('admin.plan.add', ['types' => $plantypes, 'products' => $products]);
    }

    public function create(Request $request) {
        $rules = [
            'product_id' => 'required',
            'amount' => 'required|numeric',
            'interval' => 'required',
        ];
        if ($request->interval === 'month') {
            $rules['interval_count'] = 'required|numeric|digits_between:1,12';
        }
        $customMessages = [
            'product_id.required' => 'Product is required',
        ];
        $request->validate($rules, $customMessages);
        $product = Product::find($request->product_id);
        $plan = $this->stripe->plans->create([
            'amount' => $request->amount * 100,
            'currency' => config('stripe.api_keys.currency'),
            'interval' => $request->interval,
            'product' => $product->stripe_product_id,
            'interval_count' => $request->interval === 'month' ? $request->interval_count : 1
        ]);
        $create = Plan::create([
            'product_id' => $request->product_id,
            'stripe_plan_id' => $plan['id'],
            'interval_count' => $request->interval === 'month' ? $request->interval_count : 1,
            'interval' => $request->interval,
            'amount' => $request->amount,
            'display_amount' => number_format($request->amount, 2, ".", "")
        ]);

        if ($create) {
            return redirect()->intended(route('admin.plan.list'));
        }
        return back()->withErrors("Unable to create your account")
        ->onlyInput('name', 'description', 'price');

    }

    public function editshow($id) {
        $plan = Plan::find($id);
        $products = Product::get();
        $plantypes = $this->planTypes();
        return view('admin.plan.edit', ['plan' => $plan, 'types' => $plantypes, 'products' => $products]);
    }

    public function edit(Request $request) {
        // $rules = [
        //     'product_id' => 'required',
        //     'amount' => 'required|numeric',
        //     'interval' => 'required',
        //     'interval_count' => 'required_if:interval:month|numeric|digits_between:1,12'
        // ];
        // $customMessages = [
        //     'product_id.required' => 'Product is required',
        // ];
        // $request->validate($rules, $customMessages);
        // $plan = Plan::find($request->id);
        // $product = $this->stripe->products->update($plan->stripe_product_id, [
        //     'name' => $request->name,
        //     'description' => $request->description,
        // ]);
        // $plan->name = $request->name;
        // $plan->description = $request->description;
        // $plan->stripe_product_id = $product['id'];
        // $plan->stripe_plan = $product['default_price'];
        // $plan->price = $request->price;
        // $plan->save();
        return redirect()->intended(route('admin.plan.plan_list'));
    }

    public function deletePlan(Request $request) {
        $plan = Plan::find($request->id);
        $this->stripe->plans->update(
            $plan->stripe_plan_id
        );
        $plan->delete();
        return "success";
    }

    public function getUserPlan() {
        // $plans = Plan::get();
//        $products = Product::with(['plans', 'inclusions'])->get();
        $categories = ProductCategory::whereHas('products', function ($q) {
            $q->has('plans');
        })->with(['products', 'products.plans', 'products.inclusions'])->get();
        $intent = auth()->user()->createSetupIntent();
        // dd($plans);
        return view("user.plan", compact("categories",'intent'));
    }

    public function showPlan(Plan $plan, Request $request)
    {
        $user = Auth::user();
        $product_name = Product::find($plan->product_id);
        $plan['name'] = $product_name['title'];

        $intent = auth()->user()->createSetupIntent([
            'payment_method_types' => ['card'],
            'usage' => 'off_session',
        ]);
        if ($user->stripe_id) {
            $cards = $this->stripe->customers->allPaymentMethods($user->stripe_id);
            $customer = $user->defaultPaymentMethod();
        }
        return view("user.subscription", compact("plan", "intent", "cards", "customer"));
    }


    public function subscription(Request $request)
    {
        $plan = Plan::where('stripe_plan_id', $request->plan)->first();

        // Get the Payment Method ID from the Stripe Elements card input form
        $paymentMethodId = $request->payment_method;
        $customer = $request->user()->createOrGetStripeCustomer();
        try {

            // Create a new subscription with Cashier
            $user = $request->user();
            $user->newSubscription('default', $plan->stripe_plan_id)
                ->create($paymentMethodId, [
                    'setup_future_usage' => 'off_session',
                    'default_payment_method' => $paymentMethodId,
                    'default_source' => $paymentMethodId,
                    'collection_method' => 'charge_automatically',
                    'cancel_at' => now()->addMonth($plan->interval_count)->timestamp,
                ]);

            return redirect()->route('mysubscriptions.index')->with('message', 'Your plan subscribed successfully');
        } catch (\Stripe\Exception\CardException $e) {
            // Handle Setup Intent confirmation error, which may include a 3D Secure authentication flow
            if ($e->getStripeCode() === 'authentication_required') {
                $paymentIntentId = $e->getStripeParam('payment_intent');
                $paymentIntent = $this->stripe->paymentIntents->retrieve($paymentIntentId);
                return view('user.subscription', [
                    'client_secret' => $paymentIntent->client_secret,
                    'return_url' => route('plans.show'),
                ]);
            } else {
                // Handle other Setup Intent confirmation errors
                return redirect()->route('plan.index')->with('message', $e->getMessage());
            }
        }
    }

    public function subscriptioncreatewithexistingcard(Request $request) {
        $plan = Plan::where('stripe_plan_id', $request->plan)->first();
        $paymentMethodId = $request->user_card;
        try {

            // Create a new subscription with Cashier
            $user = $request->user();
            $user->newSubscription('default', $plan->stripe_plan_id)
                ->create($paymentMethodId, [
                    'setup_future_usage' => 'off_session',
                    'default_payment_method' => $paymentMethodId,
                    'default_source' => $paymentMethodId,
                    'collection_method' => 'charge_automatically',
                    'cancel_at' => now()->addMonth($plan->interval_count)->timestamp,
                ]);

            return redirect()->route('mysubscriptions.index')->with('message', 'Your plan subscribed successfully');
        } catch (\Stripe\Exception\CardException $e) {
            // Handle Setup Intent confirmation error, which may include a 3D Secure authentication flow
            if ($e->getStripeCode() === 'authentication_required') {
                $paymentIntentId = $e->getStripeParam('payment_intent');
                $paymentIntent = $this->stripe->paymentIntents->retrieve($paymentIntentId);
                return view('user.subscription', [
                    'client_secret' => $paymentIntent->client_secret,
                    'return_url' => route('plans.show'),
                ]);
            } else {
                // Handle other Setup Intent confirmation errors
                return redirect()->route('plan.index')->with('message', $e->getMessage());
            }
        }
    }
}
