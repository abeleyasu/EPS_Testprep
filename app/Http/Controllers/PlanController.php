<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Plan;
use Illuminate\Validation\Rule;

class PlanController extends Controller
{
    private $stripe;
    public function __construct() {
        $this->stripe = new \Stripe\StripeClient(config('stripe.api_keys.secret_key'));
    }
    public function planList() {
        $plans = Plan::get();
        return view('admin.plan.list', ['plans' => $plans]);
    }

    public function planTypes() {
        $data =  [
            [
                'option' => 'Day',
                'value' => 'day'
            ],
            [
                'option' => 'Week',
                'value' => 'week'
            ],
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

    public function addPlanForm() {
        $plantypes = $this->planTypes();
        return view('admin.plan.add', ['types' => $plantypes]);
    }

    public function createPlan(Request $request) {
        $rules = [
            'name' => 'required|unique:plans,name',
            'description' => 'required',
            'price' => 'required|numeric',
            'plan_type' => 'required',
        ];
        $customMessages = [
            'name.required' => 'Plan name is required',
            'name.unique' => 'Plan name must be unique',
            'description.required' => 'Description is required',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price should be number only',
            'plan_type.required' => 'Plan type is required',
        ];
        $request->validate($rules, $customMessages);
        $product = $product = $this->createStripeProduct($request);
        $createProductPlan = $this->createStripePlan($request, $product['id']);
        $plan = plan::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'stripe_product_id' => $product['id'],
            'stripe_plan' => $createProductPlan['id'],
            'plan_type' => $request->plan_type,
            'price' => $request->price
        ]);

        if ($plan) {
            return redirect()->intended(route('admin.plan.plan_list'));
        }
        return back()->withErrors("Unable to create your account")
        ->onlyInput('name', 'description', 'price');
    }

    public function updatePlanShow($id) {
        $plan = Plan::find($id);
        $plantypes = $this->planTypes();
        return view('admin.plan.edit', ['plan' => $plan, 'types' => $plantypes]);
    }

    public function editplan(Request $request) {
        $rules = [
            'name' => ['required', Rule::unique('plans', 'name')->ignore($request->id)],
            'description' => 'required',
            'price' => 'required|numeric',
            'plan_type' => 'required',
        ];
        $customMessages = [
            'name.required' => 'Plan name is required',
            'name.unique' => 'Plan name must be unique',
            'description.required' => 'Description is required',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price should be number only',
            'plan_type.required' => 'Plan type is required',
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

    public function createStripeProduct($request) {
        return $this->stripe->products->create([
            'name' => $request->name,
            'description' => $request->description
        ]);
    }

    public function createStripePlan($request, $stripe_product_id) {
        return $this->stripe->plans->create([
            'amount' => $request->price * 100,
            'currency' => config('stripe.api_keys.currency'),
            'interval' => $request->plan_type,
            'product' => $stripe_product_id
        ]);
    }

    public function index()
    {
        $plans = Plan::get();
        $intent = auth()->user()->createSetupIntent();

        return view("user.plan", compact("plans",'intent'));
    }


    public function show(Plan $plan, Request $request)
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
