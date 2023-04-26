<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseManagement\UserTaskStatus;
use App\Models\User;
use App\Models\HighSchoolResume\States;
use App\Models\HighSchoolResume\Cities;
use App\Models\StudentBillingDetail;
use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public $states;

    public function dashboard()
    {
        return view('user/dashboard');
    }
    public function resume()
    {
        $userId = auth()->id();
        if ($userId) {
        }
        $userTaskStatus = UserTaskStatus::where('user_id', $userId)
            ->orderBy('updated_at', 'DESC')
            ->first();
        if ($userTaskStatus && $userTaskStatus->task_id) {
            return redirect('/user/tasks/' . $userTaskStatus->task_id . '/detail');
        } else {
            return redirect('/user/dashboard');
        }
    }

    public function clearCache()
    {
        \Artisan::call('optimize:clear');
        echo 'Cache Removed';
    }

    public function profile(Request $request)
    {
        $id = Auth::id();
        if (isset($request->id)) {
            $request->validate(
                [
                    'first_name' => ['required', 'min:3'],
                    'last_name' => ['required', 'min:3'],
                    'phone' => ['required', 'numeric'],
                    'password' => ['required', 'min:6'],
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
                ],
            );

            $user = User::find($request->id);
            $user->name = $request->first_name . ' ' . $request->last_name;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();
        }
        $user = User::where('role', '!=', 1)->find($id);
        $this->states = States::get();

        if ($user) {
            return view('user.edit-profile', ['user' => $user, 'states' => $this->states]);
        } else {
            return redirect(route('admin-user-list'));
        }
    }

    public function studentBillingDetails(Request $request)
    {
        $request->validate(
            [
                'billing_address' => ['required'],
                'billing_state' => ['required'],
                'billing_city' => ['required'],
                'billing_zip' => ['required'],
                'card_number' => ['required', 'numeric', 'digits:12'],
                'card_expiry_month' => ['required'],
                'card_expiry_year' => ['required'],
            ],
            [
                'billing_address.required' => 'Bilind address is required',
                'billing_state.required' => 'State is required',
                'billing_city.required' => 'City is required',
                'billing_zip.required' => 'Zipcode is required',
                'card_number.required' => 'Card Number is required',
                'card_number.numeric' => 'Card Number must be number',
                'card_number.digits' => 'Card Number must be 12 digit',
                'card_expiry_month.required' => 'Expiry month is required',
                'card_expiry_year.required' => 'Expiry year is required',
            ],
        );
        $billingDetail = StudentBillingDetail::where('user_id', Auth::user()->id)->first();
        if (!$billingDetail) {
            $billingDetail = new StudentBillingDetail();
        }
        $billingDetail->user_id = Auth::user()->id;
        $billingDetail->billing_address = $request->billing_address;
        $billingDetail->billing_state = $request->billing_state;
        $billingDetail->billing_city = $request->billing_city;
        $billingDetail->billing_zip = $request->billing_zip;
        $billingDetail->card_number = Crypt::encrypt($request->card_number);
        $billingDetail->card_expiry_month = $request->card_expiry_month;
        $billingDetail->card_expiry_year = $request->card_expiry_year;
        $billingDetail->save();

        $this->states = States::get();
        return view('user.edit-profile', ['user' => Auth::user(), 'states' => $this->states]);
    }

    public function getCity(Request $request, $state_id)
    {
        $cities = Cities::where('state_id', $state_id)->get();
        return $cities->toArray();
    }
}
