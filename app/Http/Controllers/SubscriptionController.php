<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use Stripe\Customer;
use DB;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use App\Models\Subscription;
use App\Models\SubscriptionConsumedHours;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $limit = isset($request->limit) ? $request->limit : 10;
            $search =  isset($request->search['value']) ? $request->search['value'] : ""; 
            $start = isset($request->start) ? $request->start : 0;

            $subscriptions = Subscription::with(['plan' => function ($p) {
                $p->with('product');
            }, 'user'])->orderBy('id', 'desc');

            $count = $subscriptions->count();

            if (!empty($search)) {
                $subscriptions = $subscriptions->where(function ($subscription) use ($search) {
                    $subscription->whereHas('plan', function ($plan) use ($search) {
                        $plan->whereHas('product', function ($product) use ($search) {
                            $product->where('title', 'like', '%' . $search . '%');
                        });
                    })->orWhereHas('user', function ($user) use ($search) {
                        $user->where('name', 'like', '%' . $search . '%');
                    });
                });
            }

            $subscriptions = $subscriptions->skip($start)->take($limit);

            $subscriptions = $subscriptions->get()->toArray();

            $data = [];
            foreach ($subscriptions as $key => $subscription) {
                $classname = 'bg-success-light text-success';
                if ($subscription['stripe_status'] === 'failed') {
                    $classname = 'bg-danger-light text-danger';
                } else if ($subscription['stripe_status'] === 'canceled' ||  $subscription['stripe_status'] === 'consumed') {
                    $classname = 'bg-warning-light text-warning';
                }

                $action = '
                    <div class="btn-group">
                        <a href="'.route('admin.subscription.subscription-info', ['id' => $subscription['stripe_id']]).'" class="btn btn-sm btn-alt-primary view-information" data-id="'. $subscription['stripe_id'] .'" data-bs-toggle="tooltip" title="View Information">
                            <i class="fa fa-fw fa-eye"></i>
                        </a>
                ';

                // if ($subscription['plan_type'] == 'one-time' && $subscription['stripe_status'] != 'canceled') {
                //     $action .= '
                //     <button class="btn btn-sm btn-alt-danger consumed-hourly-plan" data-id="'. $subscription['stripe_id'] .'" data-bs-toggle="tooltip" title="Cancel Hourly Subscription">
                //         <i class="fa fa-fw fa-times"></i>
                //     </button>';
                // }

                $action .= '</div>';


                $data[] = [
                    'id' => $subscription['id'],
                    'subscription_product' => $subscription['plan']['product']['title'],
                    'subscription_id' => $subscription['stripe_id'],
                    'user_name' => $subscription['user']['name'],
                    'amount' => number_format($subscription['plan']['amount']),
                    'interval' => $subscription['plan']['interval_count'] . '  ' .$subscription['plan']['interval'],
                    'plan_type' => $subscription['plan_type'],
                    'status' => '
                        <div class="fs-sm fw-medium rounded text-center p-1 '.$classname.'">'. $subscription['stripe_status'] .' </div>
                    ',
                    'end_date' => $subscription['ends_at'] ? date('M d, Y', strtotime($subscription['ends_at'])) : '-',
                    'created_at' => date('M d, Y', strtotime($subscription['created_at'])),
                    'action' =>  $action,
                ];
            }

            $response = [
                'draw' => $request->draw,
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $data,
            ];

            return response()->json($response);

        }
        return view('admin.subscription.list');
    }

    public function getSubscriptionInfo($subscriptionId) {
        if (!$subscriptionId) {
            return redirect()->back()->with('error', 'Subscription not found');
        }
        $subscription = Subscription::where('stripe_id', $subscriptionId)->with(['plan' => function ($p) {
            $p->with('product');
        }, 'user'])->first();
        if (!$subscription) {
            return redirect()->back()->with('error', 'Subscription not found');
        }
        $subscription = $subscription->toArray();
        $paymentMethod = null;
        if ($subscription['plan_type'] == 'subscription') {
            $getSubscription = $this->stripe->subscriptions->retrieve(
                $subscription['stripe_id'],
                []
            );
            $paymentMethod = $getSubscription->default_payment_method;
            // dd($paymentMethod);
            $subscription['next_billing_date'] = Carbon::createFromTimestamp($getSubscription->current_period_end)->format('M d, Y');
            $subscription['is_auto_renewal'] = $getSubscription->cancel_at_period_end;
        } else if ($subscription['plan_type'] == 'one-time') {
            $paymentIntent = $this->stripe->paymentIntents->retrieve(
                $subscription['stripe_id'],
                []
            );
            $paymentMethod = $paymentIntent->payment_method;
        } 

        $card = null;
        if ($paymentMethod) {
            $card = $this->stripe->paymentMethods->retrieve(
                $paymentMethod,
                []
            );
        } else {
            $card = User::find($subscription['user_id'])->defaultPaymentMethod();
        }

        
        $subscription['ends_at'] = $subscription['ends_at'] ? Carbon::parse($subscription['ends_at'])->format('Y-m-d h:m:s') :
        $subscription['plan_end_date'] = $subscription['plan_end_date'] ? Carbon::parse($subscription['plan_end_date'])->format('Y-m-d h:m:s') : null;
        $subscription['created_at'] = Carbon::parse($subscription['created_at'])->format('Y-m-d h:m:s');
        $subscription['card'] = $card;

        return view('admin.subscription.card-info', [
            'subscription' => $subscription
        ]);
    }

    public function consumendUserSubscription(Request $request, $subscriptionId) {
        try {
            DB::beginTransaction();
            $subscription = Subscription::where([
                ['stripe_id', '=' ,$subscriptionId],
                ['plan_type', '=', 'one-time'],
            ])->first();
            if (!$subscription) {
                return response()->json([
                    'success' => false,
                    'message' => 'Subscription not found'
                ], 200);
            }
            $pending_hours = $subscription->pending_consumed_hours;
            if ($request->consumed_type == 'minute') {
                $pending_hours = $pending_hours * 60;
            }
            if (isset($request->id)) {
                $consumed_hours = SubscriptionConsumedHours::where('id', $request->id)->first();
                if (!$consumed_hours) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Consumed hours not found'
                    ], 200);
                }

                $pending_hours = $consumed_hours->hours + $pending_hours;

                switch ($consumed_hours->consumed_type) {
                    case 'hour':
                        $subscription->pending_consumed_hours = $subscription->pending_consumed_hours + $consumed_hours->hours;
                        break;
                    case 'minute':
                        $hours = number_format($consumed_hours->hours / 60, 1);
                        $subscription->pending_consumed_hours = $subscription->pending_consumed_hours + $hours;
                        break;
                }
            }
            $rules = [
                'hours' => 'required|numeric|between:1,'.$pending_hours,
                'date' => 'required|date_format:m-d-Y',
                'consumed_type' => 'required|in:hour,minute',
            ];
            $validate = Validator::make($request->all(), $rules, [
                'hours.required' => 'Please enter '. $request->consumed_type,
                'hours.numeric' => 'Please enter valid '. $request->consumed_type,
                'hours.between' => 'Please enter digit between 1 to '. $pending_hours,
                'date.required' => 'Please select date',
                'date.date_format' => 'Please select valid date',
                'consumed_type.required' => 'Please select consumed type',
                'consumed_type.in' => 'Please select valid consumed type',
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validate->errors()->first()
                ], 200);
            }
            $data = [
                'subscription_id' => $subscription->id,
                'hours' => $request->hours,
                'date' => $request->date,
                'note' => $request->notes,
                'consumed_type' => $request->consumed_type,
            ];
            $consumed_hours = null;
            if (isset($request->id)) {
                $consumed_hours = SubscriptionConsumedHours::where('id', $request->id)->update($data);
            } else {
                $consumed_hours = SubscriptionConsumedHours::create($data);
            }
            if ($consumed_hours) {
                switch ($request->consumed_type) {
                    case 'hour':
                        $subscription->pending_consumed_hours = $subscription->pending_consumed_hours - $request->hours;
                        break;
                    case 'minute':
                        $hours = number_format($request->hours / 60, 1);
                        $subscription->pending_consumed_hours = $subscription->pending_consumed_hours - $hours;
                        break;
                }
                $subscription->stripe_status = $subscription->pending_consumed_hours <= 0 ? 'consumed' : 'active';
                $subscription->save();
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Hours consumed successfully',
                    'data' => number_format($subscription->pending_consumed_hours, 1),
                ], 200);
            } else {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Hours not consumed'
                ], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 200);
        }
    }

    public function getConsumendUserSubscription(Request $request, $subscriptionId) {
        try {
            $limit = isset($request->limit) ? $request->limit : 10;
            $search =  isset($request->search['value']) ? $request->search['value'] : ""; 
            $start = isset($request->start) ? $request->start : 0;

            $consumer_details = SubscriptionConsumedHours::where('subscription_id', $subscriptionId);

            $count = $consumer_details->count();

            if (!empty($search)) {
                $consumer_details = $consumer_details->where(function ($query) use ($search) {
                    $query->where('hours', 'LIKE', "%{$search}%")
                        ->orWhere('date', 'LIKE', "%{$search}%")
                        ->orWhere('note', 'LIKE', "%{$search}%")
                        ->orWhere('consumed_type', 'LIKE', "%{$search}%");
                });
            }

            $consumer_details = $consumer_details->skip($start)->take($limit);

            $consumer_details = $consumer_details->get()->toArray();

            $data = [];

            foreach ($consumer_details as $key => $value) {
                $data[] = [
                    'id' => $value['id'],
                    'hours' => $value['hours'],
                    'date' => $value['date'],
                    'notes' => $value['note'],
                    'consumed_type' => $value['consumed_type'],
                    'action' => '<div class="btn-group">
                                    <buton class="btn btn-sm btn-alt-secondary edit-consumed-hours" data-id="'. $value['id'] .'" data-bs-toggle="tooltip" title="Edit Consumed Hours">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </buton>
                                    <button type="button" class="btn btn-sm btn-alt-secondary delete-consumed-hours" data-id="'. $value['id'] .'" data-bs-toggle="tooltip" title="Delete Consumed Hours">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                </div>'
                ];
            }

            $response = [
                'draw' => $request->draw,
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $data
            ];

            return response()->json($response, 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 200);
        }
    }

    public function getSingleConsumedDetails($consumedHourId) {
        try {
            $consumed_details = SubscriptionConsumedHours::where('id', $consumedHourId)->first();
            if (!$consumed_details) {
                return response()->json([
                    'success' => false,
                    'message' => 'Consumed details not found'
                ], 200);
            }
            return response()->json([
                'success' => true,
                'data' => $consumed_details
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Consumed details not found'
            ], 200);
        }
    }

    public function deleteConsumedHour($id) {
        try {
            DB::beginTransaction();
            $consumed_details = SubscriptionConsumedHours::where('id', $id)->first();
            if (!$consumed_details) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Consumed details not found'
                ], 200);
            }
            $subscription = Subscription::where('id', $consumed_details->subscription_id)->first();
            if (!$subscription) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Subscription not found'
                ], 200);
            }
            switch ($consumed_details->consumed_type) {
                case 'hour':
                    $subscription->pending_consumed_hours = $subscription->pending_consumed_hours + $consumed_details->hours;
                    break;
                case 'minute':
                    $hours = number_format($consumed_details->hours / 60, 1);
                    $subscription->pending_consumed_hours = $subscription->pending_consumed_hours + $hours;
                    break;
            }
            $subscription->save();
            $consumed_details->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Consumed details deleted successfully',
                'data' => number_format($subscription->pending_consumed_hours, 1)
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Consumed details not found'
            ], 200);
        }   
    }

    public function mysubscriptions()
    {
        $user = Auth::user();
        if (!$user->isUserSubscriptionToAnyPlan()) {
            return redirect('/user/plans');  
        }
        $subscriptions = $user->subscriptions()->active()->reorder('plan_type', 'desc')->orderBy('created_at', 'desc')->get();
        foreach ($subscriptions as $key => $subscription) {
            $paymentMethod = null;
            $is_auto_renewal = false;
            $invoice = null;
            if ($subscription->plan_type == 'subscription') {
                $getSubscription = $this->stripe->subscriptions->retrieve(
                    $subscription->stripe_id,
                    []
                );
                $paymentMethod = $getSubscription->default_payment_method;
                $subscriptions[$key]->next_billing_date = Carbon::createFromTimestamp($getSubscription->current_period_end)->format('M d, Y');
                $is_auto_renewal = $getSubscription->cancel_at_period_end;
                if ($is_auto_renewal) {
                    $subscriptions[$key]->canceled_at = Carbon::createFromTimestamp($getSubscription->current_period_end)->format('M d, Y');
                }
                $invoice = $getSubscription->latest_invoice;
            } else if ($subscription->plan_type == 'one-time') {
                $paymentIntent = $this->stripe->paymentIntents->retrieve(
                    $subscription->stripe_id,
                    []
                );
                $paymentMethod = $paymentIntent->payment_method;
            }

            $card = null;
            if ($paymentMethod) {
                $card = $this->stripe->paymentMethods->retrieve(
                    $paymentMethod,
                    []
                );
            } else {
                $card = $user->defaultPaymentMethod();
            }

            $subscriptions[$key]->card = $card;
            $subscriptions[$key]->is_auto_renewal = $is_auto_renewal;
            $subscriptions[$key]->invoice = $invoice;
            $subscriptions[$key]->plan = $subscription->plan;
            $subscriptions[$key]->invoice = $invoice;

        }

        return view('user.my_subscriptions', [
            'subscriptions' => $subscriptions
        ]);
    }


    public function cancelsubscriptions(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        $active_subscription = Subscription::where('stripe_id', $request->subscription_id)->first();
        // dd($active_subscription);
        $plan = Plan::where('stripe_plan_id', $active_subscription->stripe_price)->with('product')->first();
        $product_id = $plan->product->stripe_product_id;
        $role = Role::where('name', $plan->product->stripe_product_id)->first();
        if ($plan->interval == 'hour') {
            $this->cancelOneTimePlan($active_subscription);
            $user->removeRole($role->id);
            return response()->json([
                'success' => true,
                'message' => 'Subscription is canceled successfully',
                'type' => 'one-time'
            ], 200);
        } else {
            $this->cancelSubscription($active_subscription, $user);
            return response()->json([
                'success' => true,
                'message' => 'Subscription is canceled successfully',
                'type' => 'subscription'
            ], 200);
        }
    }

    public function cancelSubscription($active_subscription, $user) {
        $active_subscription->cancel();
        $mail = $this->mailgun->sendMail([
            'to' => $user->email,
            'subject' => 'Wishing You Success on Your College Journey - Your Subscription Cancellation Confirmation',
            'html' => view('email-template.subscription.cancel', [
                'name' => $user->first_name,
            ])->render()
        ]);
        if (!$user->isUserSubscriptionOnGracePeriod()) {
            $user->removeRole($role->id);
        }
    }

    public function cancelOneTimePlan($subscription) {
        if ($subscription && $subscription->stripe_status == 'active') {
            $subscription->stripe_status = 'canceled';
            $subscription->ends_at = date('Y-m-d H:i:s');
            $subscription->save();
        } 
    }

    public function resumesubscriptions(Request $request)
    {
        try {
            $user = auth()->user();
            $active_subscription = $user->getUserStripeSubscription();
            if ($active_subscription) {
                $active_subscription->resume();
                $plan = $active_subscription->plan;
                $role = Role::where('name', $plan->product->stripe_product_id)->first();
                $user->syncRoles($role->id);
                return response()->json([
                    'success' => true,
                    'message' => 'Subscription is resumed successfully'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Subscription is not found'
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 200);
        }
    }

    public function offSubscriptionAutoRenewval(Request $request) {
        try {
            $user = auth()->user();
            $active_subscription = $user->getUserStripeSubscription();
            if ($active_subscription) {
                $this->cancelSubscription($active_subscription, $user);
                return response()->json([
                    'success' => true,
                    'message' => 'Subscription is updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Subscription is not found'
                ], 200);
            }
        } catch (\Exception $e) { 
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 200);
        }
    }

    public function downloadUserInvoice(Request $request, string $invoiceId) {
        return $request->user()->downloadInvoice($invoiceId, [], 'invoice');
    }
}
