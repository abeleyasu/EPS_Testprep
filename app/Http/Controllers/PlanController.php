<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $plans = Plan::get();
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
        $display_amount = $request->amount;
        if ($request->interval === 'month') {
            $display_amount = $request->amount / $request->interval_count;
        }
        $create = Plan::create([
            'product_id' => $request->product_id,
            'stripe_plan_id' => $plan['id'],
            'interval_count' => $request->interval === 'month' ? $request->interval_count : 1,
            'interval' => $request->interval,
            'amount' => $request->amount,
            'display_amount' => number_format($display_amount, 2, ".", "")
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
        $rules = [
            'product_id' => 'required',
            'amount' => 'required|numeric',
            'interval' => 'required',
            'interval_count' => 'required_if:interval:month|numeric|digits_between:1,12'
        ];
        $customMessages = [
            'product_id.required' => 'Product is required',
        ];
        $request->validate($rules, $customMessages);
        $plan = Plan::find($request->id);
        $product = $this->stripe->products->update($plan->stripe_product_id, [
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->stripe_product_id = $product['id'];
        $plan->stripe_plan = $product['default_price'];
        $plan->price = $request->price;
        $plan->save();
        return redirect()->intended(route('admin.plan.plan_list'));
    }

    public function deletePlan(Request $request) {
        $plan = Plan::find($request->id)->delete();
        return "success";
    }

    public function getUserPlan() {
        // $plans = Plan::get();
        $products = Product::with('plans')->get();
        $intent = auth()->user()->createSetupIntent();
        // dd($plans);
        return view("user.plan", compact("products",'intent'));
    }

    public function showPlan(Plan $plan, Request $request)
    {
        $intent = auth()->user()->createSetupIntent();
        return view("user.subscription", compact("plan", "intent"));
    }


    public function subscription(Request $request)
    {
        $plan = Plan::find($request->plan);

        $subscription = $request->user()->newSubscription($request->plan, $plan->stripe_plan)
                        ->create($request->token);

        return view("subscription_success");
    }
}
