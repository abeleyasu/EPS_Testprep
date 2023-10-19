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
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use App\Models\Subscription;
use App\Models\SubscriptionItem;
use App\Models\UserRewards;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    public function index() {
        // $plans = Plan::with('product')->get();
        return view('admin.plan.list');
    }

    public function displayRecords(Request $request) {
        $limit = isset($request->limit) ? $request->limit : 10;
        $search =  isset($request->search['value']) ? $request->search['value'] : ""; 
        $start = isset($request->start) ? $request->start : 0;

        $plans = Plan::with('product')->orderBy('order_index', 'asc')->orderBy('status','Desc');
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
            $check  =  '<div class="form-check form-switch"><input onclick="updateStatus(this.dataset.id)" class="form-check-input" type="checkbox" data-id="'.$plan['id'].'"'. ($plan['status'] == 1 ? "checked": "" ). "></div>";
            $data[] = [
                'id' => $plan['id'],
                'plan_id' => $plan['stripe_plan_id'],
                'plan_status' => $check,
                'plan_created' => $plan['created_at'] ? Carbon::parse($plan['created_at'])->format('Y-m-d') : '',
                'plan_inactivated' => $plan['inactive_at'] ? Carbon::parse($plan['inactive_at'])->format('Y-m-d') : '',
                'product' => $plan['product']['title'],
                'category' => $plan['product']['product_category']['title'],
                'interval' => $plan['interval'],
                'interval_count' => $plan['interval_count'],
                'currency' => $plan['currency'],
                'price' => number_format($plan['amount']),
                'amount' => number_format($plan['display_amount']),
                'order_index' => $plan['order_index'] + 1,
                'action' => '<div class="btn-group">
                                <button type="button" class="btn btn-sm btn-alt-secondary update-plan-status" data-id="' . $plan['id'] . '" data-bs-toggle="tooltip" title="Delete Plan">
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
            [
                'option' => 'Hourly',
                'value' => 'hour'
            ]
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
            'product_category' => 'required|exists:product_category,id',
            'product_id' => 'required|exists:product,id',
            'amount' => 'required|numeric|max:10000',
            'interval' => 'required',
            'interval_count' => 'required|numeric|integer|between:1,100',
        ];
        $customMessages = [
            'product_category.required' => 'Product category is required',
            'product_category.exists' => 'Product category is not exists',
            'product_id.required' => 'Product is required',
            'product_id.exists' => 'Product is not exists',
            'amount.required' => 'Cost per Interval is required',
            'amount.numeric' => 'Cost per Interval must be numeric',
            'amount.max' => 'Cost per Interval must be less than 10000',
            'interval.required' => 'Interval is required',
            'interval_count.required' => 'Interval count is required',
            'interval_count.numeric' => 'Interval count must be numeric',
            'interval_count.integer' => 'Interval count must be integer',
            'interval_count.between' => 'Interval count must be between 1 to 100',
        ];
        $request->validate($rules, $customMessages);
        $lastOderIndex = Plan::max('order_index');
        $product = Product::find($request->product_id);
        $planid = null;
        $amount = $request->amount * $request->interval_count;
        if ($request->interval == 'hour') {
            $amount = $request->amount;
        }
        if ($request->interval == 'hour') {
            $price = $this->stripe->prices->create([
                'unit_amount' => $amount * 100,
                'currency' => 'usd',
                'product' => $product->stripe_product_id,
            ]);
            $planid = $price['id'];
        } else {
            $plan = $this->stripe->plans->create([
                'amount' => $amount * 100,
                'currency' => config('stripe.api_keys.currency'),
                'interval' => $request->interval,
                'product' => $product->stripe_product_id,
                'interval_count' => $request->interval_count,
            ]);
            $planid = $plan['id'];
        }
        $create = Plan::create([
            'product_id' => $request->product_id,
            'stripe_plan_id' => $planid,
            'interval_count' => $request->interval_count,
            'interval' => $request->interval,
            'amount' => number_format($amount, 2, ".", ""),
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
        try {
            $plan = Plan::find($request->id);
            if ($plan->interval == 'hour') {
                $this->stripe->prices->update($plan->stripe_plan_id, [
                    'active' => false,
                ]);
            } else {
                $this->stripe->plans->delete(
                    $plan->stripe_plan_id
                );
            }
            $plan->delete();
            return response()->json([
                'success' => true, 
                'message' => 'Plan deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => $e->getMessage()
            ]);
        }
    }
    
    public function changePlanStatus(Request $request) {
        $plan = Plan::find($request->id);
        if(Plan::where('id',$request->id)->update([
            "status" => $plan->status ? 0 : 1,
            'inactive_at' => $plan->status ? now() : null
        ])):
            return response()->json([
                'success' => true, 
                'message' => 'Plan deleted successfully'
            ]);
        else:
            return response()->json([
                'success' => false, 
                'message' => $e->getMessage()
            ]);
        endif;
    }

    public function getUserPlan() {
        // $user = Auth::user();
        // if ($user->subscribed('default')) {
        //     return redirect()->route('mysubscriptions.index');
        // }
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
        $intent = auth()->user()->createSetupIntent([
            'payment_method_types' => ['card'],
            'usage' => 'off_session',
        ]);
        $plan['name'] = $product_name['title'];
        if ($user->stripe_id) {
            $cards = $this->stripe->customers->allPaymentMethods($user->stripe_id);
            $customer = $user->defaultPaymentMethod();
        }
        return view("user.subscription", compact("plan", "intent", "cards", "customer"));
    }


    public function subscription(Request $request)
    {
        $plan = Plan::where('stripe_plan_id', $request->plan)->with('product')->first();
        $paymentMethodId = $request->payment_method;
        $customer = $request->user()->createOrGetStripeCustomer();
        $referral_code = null;
        if (isset($request->referral_code)) {
            $referral_code = $request->referral_code;
        }
        try {
            $user = Auth::user();
            if ($user->isSubscribeToSubscriptions() && $plan->interval != 'hour') {
                $this->changeUserSubscription($plan, $paymentMethodId, $referral_code);
                return redirect()->route('mysubscriptions.index')->with('message', 'Your subscription updated successfully');
            } else {
                if ($plan->interval == 'hour') {
                    $this->subscribeUserToHourlyPlan($plan, $paymentMethodId);
                    return redirect()->route('mysubscriptions.index')->with('message', 'Your subscription updated successfully');
                } else {
                    $this->createSubscription($plan, $paymentMethodId, $referral_code);
                    return redirect()->route('mysubscriptions.index')->with('message', 'Your plan subscribed successfully');
                }
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
        $referral_code = null;
        if (isset($request->referral_code)) {
            $referral_code = $request->referral_code;
        }
        try {
            $user = Auth::user();
            if ($user->isSubscribeToSubscriptions() && $plan->interval != 'hour') {
                $this->changeUserSubscription($plan, $paymentMethodId, $referral_code);
                return redirect()->route('mysubscriptions.index')->with('message', 'Your subscription updated successfully');
            } else {
                if ($plan->interval == 'hour') {
                    $this->subscribeUserToHourlyPlan($plan, $paymentMethodId);
                    return redirect()->route('mysubscriptions.index')->with('message', 'Your subscription updated successfully');
                } else {
                    $this->createSubscription($plan, $paymentMethodId, $referral_code);
                    return redirect()->route('mysubscriptions.index')->with('message', 'Your plan subscribed successfully');
                }
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

    public function subscribeUserToHourlyPlan($plan, $paymentMethodId, $existing_subscription = null) {
        $user = Auth::user();
        $paymentMethod = $user->paymentMethods();
        $checkPaymentMethodsIsExistOrNot = $paymentMethod->where('id', $paymentMethodId)->first();
        if (!$checkPaymentMethodsIsExistOrNot) {
            $user->addPaymentMethod($paymentMethodId);
        }
        $user->updateDefaultPaymentMethod($paymentMethodId);
        $end_date = $this->getOneTimePlanEndDate($plan);
        $intent = $user->payWith(
            ($plan->amount * 100), ['card'], [
                'currency' => 'usd',
                'payment_method' => $paymentMethodId,
                'confirm' => true,
                'metadata' => [
                    'expires' => $end_date->format('Y-m-d H:i:s'),
                ]
            ]
        );
        if ($intent) {
            // if ($existing_subscription) {
            //     $this->updateOneTimeSubscriptionData($user, $plan, $intent, $existing_subscription);
            // } else {
            // }
            $this->createOneTimeSubscriptionData($user, $plan, $intent);
            $this->mailgun->sendMail([
                'to' => $user->email,
                'subject' => 'Welcome to College Prep System - Your College Journey Begins Today',
                'html' => view('email-template.subscription.new', [
                    'name' => $user->first_name,
                    'plan_name' => $plan->product->title
                ])->render()
            ]);
            // $this->setUserRole($plan, $user);
        }
        return true;
    }

    public function createSubscription($plan, $paymentMethodId, $referral_code) {
        $user = Auth::user();
        $payload = [
            'default_payment_method' => $paymentMethodId,
            'collection_method' => 'charge_automatically',
        ];
        $user->newSubscription('default', $plan->stripe_plan_id)->create($paymentMethodId, [],$payload);
        if ($referral_code) {
            if ($referral_code) {
                $this->addReferralCount($referral_code, $user);
            }
        }
        $this->mailgun->sendMail([
            'to' => $user->email,
            'subject' => 'Welcome to College Prep System - Your College Journey Begins Today',
            'html' => view('email-template.subscription.new', [
                'name' => $user->first_name,
                'plan_name' => $plan->product->title
            ])->render()
        ]);
        $this->setUserRole($plan, $user);
        return true;
    }

    public function addReferralCount($referral_code, $user) {
        $referral_code_user = User::where('referral_code', $referral_code)->first();
        if ($referral_code_user) {
            $createRewards = UserRewards::create([
                'user_id' => $user->id,
                'referred_user_id' => $referral_code_user->id,
            ]);
            if ($createRewards) {
                $referral_code_user->update([
                    'referred_rewards_points' => $referral_code_user->referred_rewards_points + 1,
                ]);
            }
        }
    }

    public function changeUserSubscription($plan, $paymentMethodId, $referral_code) {
        $user = Auth::user();
        $active_subscription = $user->getUserStripeSubscription();
        $active_subscription->swap($plan->stripe_plan_id);
        if ($referral_code) {
            $this->addReferralCount($referral_code, $user);
        }
        $this->setUserRole($plan, $user);
        return true;
    }

    public function setUserRole($plan, $user) {
        $role = Role::where('name', $plan->product->stripe_product_id)->first();
        if ($role) {
            $user->syncRoles([$role->id]);
        }
    }

    public function getOneTimePlanEndDate($plan) {
        $end_date = Carbon::now()->addHour($plan->interval_count);
        $get_end_date_minutes = $end_date->format('i');
        $get_end_date_hours = $end_date->format('H');
        if ($get_end_date_minutes % 15 !== 0) {
            $get_end_date_minutes = round($get_end_date_minutes / 15) * 15;
        }
        $end_date->setTime($get_end_date_hours, $get_end_date_minutes, 0);
        return $end_date;
    }

    public function createOneTimeSubscriptionData($user, $plan, $intent) {
        $subscription = Subscription::create([
            'user_id' => $user->id,
            'name' => 'default',
            'stripe_id' => $intent->id,
            'stripe_status' => $intent->status == 'succeeded' ? 'active' : 'failed',
            'stripe_price' => $plan->stripe_plan_id,
            'quantity' => 1,
            'trial_ends_at' => null,
            'ends_at' => null,
            'plan_type' => 'one-time',
            'pending_consumed_hours' => $plan->interval_count,
        ]);
        if ($subscription) {
            SubscriptionItem::create([
                'subscription_id' => $subscription->id,
                'stripe_id' => $intent->latest_charge,
                'stripe_product' => $plan->product->stripe_product_id,
                'stripe_price' => $plan->stripe_plan_id,
                'quantity' => 1,
            ]);
        }
    }

    public function validateReferralCode(Request $request) {
        $validation = Validator::make($request->all(), [
            'referral_code' => 'required|exists:users,referral_code',
        ], [
            'referral_code.required' => 'Referral code is required',
            'referral_code.exists' => 'Referral code is not exists',
        ]);
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validation->errors()->first(),
            ], 200);
        }
        $referral_code_user = User::where('referral_code', $request->referral_code)->first();
        if ($referral_code_user->id == auth()->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'You can not use your own referral code',
            ], 200);
        }

        $is_user_already_used_referral_code = UserRewards::where('user_id', auth()->user()->id)->where('referred_user_id', $referral_code_user->id)->first();

        if ($is_user_already_used_referral_code) {
            return response()->json([
                'success' => false,
                'message' => 'You have already used this referral code',
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'Referral code is valid',
        ], 200);
    }
}
