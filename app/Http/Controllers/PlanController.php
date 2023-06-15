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
        // $plans = Plan::with('product')->get();
        return view('admin.plan.list');
    }

    public function displayRecords(Request $request) {
        $limit = isset($request->limit) ? $request->limit : 10;
        $search =  isset($request->search['value']) ? $request->search['value'] : ""; 
        $start = isset($request->start) ? $request->start : 0;

        $plans = Plan::with('product')->orderBy('order_index', 'asc');
        $totalPlanCount = Plan::get()->count();

        if (!empty($search)) {
            $plans = $plans->where(function ($plan) use ($search) {
                return $plan->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
            $totalPlanCount = $plans->count();
        }

        // $plans = $plans->skip($start)->take($limit);
        $plans = $plans->get()->toArray();

        $data = [];
        foreach ($plans as $plan) {
            $data[] = [
                'id' => $plan['id'],
                'plan_id' => $plan['stripe_plan_id'],
                'product' => $plan['product']['title'],
                'category' => $plan['product']['product_category']['title'],
                'interval' => $plan['interval'],
                'interval_count' => $plan['interval_count'],
                'currency' => $plan['currency'],
                'price' => $plan['amount'],
                'order_index' => $plan['order_index'] + 1,
                'action' => '<div class="btn-group">
                                <button type="button" class="btn btn-sm btn-alt-secondary delete-user" data-id="' . $plan['id'] . '" data-bs-toggle="tooltip" title="Delete Plan">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>'
            ];
        }
        $json_data = [
            "draw"            => intval( $request->draw ),   
            "recordsTotal"    => $totalPlanCount,  
            "recordsFiltered" => $totalPlanCount,
            "data"            => $data
        ];
        return response()->json($json_data);
    }

    public function changeOrder(Request $request) {
        $order_index = $request->data;
        foreach ($order_index as $key => $value) {
            $category = Plan::find($value['id'])->update(['order_index' => $value['order_index']]);
        }
        return "success";
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

    public function getProduct($productCategory) {
        return Product::select('id', 'title')->where('product_category_id', $productCategory)->get()->toArray();
    }

    public function show() {
        $plantypes = $this->planTypes();
        $productCategories = ProductCategory::get();
        return view('admin.plan.add', ['types' => $plantypes, 'product_categories' => $productCategories]);
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
        $lastOderIndex = Plan::max('order_index');
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
            'amount' => number_format($request->amount, 2, ".", ""),
            'display_amount' => number_format($request->amount, 2, ".", ""),
            'order_index' => $lastOderIndex + 1,
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
        // dd(Auth::user()->subscriptions()->active()->first()->stripe_price);
        $categories = $this->getPlanDataCategorywise();
        return view("user.plan", compact("categories"));
    }

    public function getPlanForNonUser() {
        $categories = $this->getPlanDataCategorywise();
        return view("pricing", compact("categories"));
    }

    public function getPlanDataCategorywise () {
        return ProductCategory::whereHas('products', function ($q) {
            $q->has('plans');
        })->with(['products', 'products.plans', 'products.inclusions'])->orderBy('order_index', 'asc')->get();
    }

    public function showPlan(Plan $plan, Request $request)
    {
        $user = Auth::user();
        // if ($user->subscribed('default')) {
        //     return redirect()->route('mysubscriptions.index');
        // }
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
            $user = Auth::user();
            if ($user->subscribed('default')) {
                $this->changeUserSubscription($plan, $paymentMethodId);
                return redirect()->route('mysubscriptions.index')->with('message', 'Your subscribed updated successfully');
            } else {
                $this->createSubscription($plan, $paymentMethodId);
                return redirect()->route('mysubscriptions.index')->with('message', 'Your plan subscribed successfully');
            }
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
            $user = Auth::user();
            if ($user->subscribed('default')) {
                $this->changeUserSubscription($plan, $paymentMethodId);
                return redirect()->route('mysubscriptions.index')->with('message', 'Your subscribed updated successfully');
            } else {
                $this->createSubscription($plan, $paymentMethodId);
                return redirect()->route('mysubscriptions.index')->with('message', 'Your plan subscribed successfully');
            }
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

    public function createSubscription($plan, $paymentMethodId) {
        $user = Auth::user();
        $user->newSubscription('default', $plan->stripe_plan_id)->create($paymentMethodId, [
            'setup_future_usage' => 'off_session',
            'default_payment_method' => $paymentMethodId,
            'default_source' => $paymentMethodId,
            'collection_method' => 'charge_automatically',
            'cancel_at' => now()->addMonth($plan->interval_count)->timestamp,
        ]);
        return true;
    }

    public function changeUserSubscription($plan, $paymentMethodId) {
        $user = Auth::user();
        $user->subscription('default')->swap($plan->stripe_plan_id);
        return true;
    }
}
