<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Carbon\Carbon;
use App\Models\Subscription;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }
    
    public function userList(){
        $users = User::where('role','!=', 1)->get();
        return view('admin.user-list', ['users' => $users]);
    }
    
    public function showEditUser(Request $request, $id){
        $user = User::where('role','!=', 1)->find($id);

        if($user)
            return view('admin.edit-user', ['user' => $user]);
        else
            return redirect(route('admin-user-list'));
    }

    public function updateUser(Request $request){
        $request->validate([
            'first_name' => ['required', 'min:3'],
            'last_name' => ['required', 'min:3'],
            'phone' => ['required', 'numeric'],
            'password' => ['nullable', 'min:6'],
            'parent_phone' => ['nullable', 'numeric'],
        ],
		[
			'first_name.required' => 'First Name is required',
			'last_name.required' => 'Last Name is required',
			'email.required' => 'Email is required',
			'email.unique' => 'Email already exist',
			'password.required' => 'Password is required',
			'password.min' => 'The password must be at least 6 characters',
			'phone.required' => 'Phone is required',
			'phone.numeric' => 'Phone must be numeric',
            'parent_phone.numeric' => 'Parent Phone must be numeric',
		]);
        $user = User::find($request->id);
        $user->name = $request->first_name." ".$request->last_name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->parent_phone = $request->parent_phone;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect(route('admin-user-list'));
    }

    public function showCreateUser(){
        return view('admin.create-user');
    }

    public function createUser(Request $request){
        $request->validate([
            'first_name' => ['required', 'min:3'],
            'last_name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'numeric'],
            'parent_phone' => ['nullable', 'numeric'],
            'password' => ['required', 'min:6'],
        ],
		[
			'first_name.required' => 'First Name is required',
			'last_name.required' => 'Last Name is required',
			'email.required' => 'Email is required',
			'email.unique' => 'Email already exist',
			'email.email' => 'The email must be a valid email address.',
			'password.required' => 'Password is required',
			'password.min' => 'The password must be at least 6 characters',
			'phone.required' => 'Phone is required',
			'phone.numeric' => 'Phone must be numeric',
            'parent_phone.numeric' => 'Parent Phone must be numeric',
		]);

        $user = User::create([
            'name' => $request->first_name." ".$request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'parent_phone' => $request->parent_phone,
        ]);

        if ($user) {
            $this->mailgun->sendEmailConfirmationCode($user);
        }
        return redirect(route('admin-user-list'));
    }

    public function deleteUser(Request $request){
        User::find($request->id)->delete();
        return "success";
    }

    public function singleUserInfor($id) {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect(route('admin-user-list'))->with('error', 'User not found');
        }
        $user_active_subscription = $user->getUserStripeSubscription();
        if ($user_active_subscription) {
            $plan = $user_active_subscription->plan;
            $product = $plan->product;
            $user_active_subscription = $user_active_subscription->toArray();
            $user_active_subscription['product_title'] = $product->title . ' (' . $plan->interval_count . ' ' . $plan->interval . ')';
            $user_active_subscription['amount'] = number_format($plan->amount);
            $user_active_subscription['monthly_price'] = number_format($plan->display_amount);
            $user_active_subscription['card'] = null;
            $user_active_subscription['subscription_detail'] = null;
            $getSubscription = $this->stripe->subscriptions->retrieve(
                $user_active_subscription['stripe_id'],
                []
            );
            if ($getSubscription->default_payment_method) {
                $card = $this->stripe->paymentMethods->retrieve(
                    $getSubscription->default_payment_method,
                    []
                );
                $user_active_subscription['card'] = $card->card->toArray();
                $user_active_subscription['billing_details'] = $card->billing_details->toArray();
            }
            $user_active_subscription['created_at'] = Carbon::parse($user_active_subscription['created_at'])->format('m-d-Y H:i:s');
            $user_active_subscription['ends_at'] = $user_active_subscription['ends_at'] ? Carbon::parse($user_active_subscription['ends_at'])->format('m-d-Y H:i:s') : null;
            $user_active_subscription['next_billing_date'] = Carbon::createFromTimestamp($getSubscription->current_period_end)->format('m-d-Y H:i:s');
            $user_active_subscription['is_active_automatic_renewal'] = $getSubscription->cancel_at_period_end;
        }
        $cancel_failed_subscription = Subscription::where([
            ['user_id', $user->id],
            ['stripe_status', '!=', 'active'],
            ['plan_type', '=', 'subscription'],
        ])->get();
        $hourly_subscription = Subscription::where([
            ['user_id', $user->id],
            ['plan_type', '=', 'one-time'],
        ])->get();
        $cards = [];
        if ($user->stripe_id) {
            $cards = $this->stripe->customers->allPaymentMethods($user->stripe_id);
            if ($cards) {
                $cards = $cards->data;
            }
        }
        // dd($cards);
        return view('admin.user-info', [
            'user' => $user,
            'active_subscription' => $user_active_subscription,
            'cancel_failed_subscription' => $cancel_failed_subscription,
            'hourly_subscription' => $hourly_subscription,
            'cards' => $cards,
        ]);
    }

    public function updateUserStatus($id) {
        try {
            $user = User::where('id', $id)->first();
            if (!$user) {
                return respone()->json([
                    'success' => false,
                    'message' => 'User not found'
                ]);
            }
            $user->is_active = !$user->is_active;
            $user->save();
            return response()->json([
                'success' => true,
                'message' => 'User status updated successfully',
                'data' => $user->is_active
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
