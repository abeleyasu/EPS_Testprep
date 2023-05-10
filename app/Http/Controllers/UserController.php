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
use Illuminate\Support\Facades\Redirect;
use Laravel\Cashier\Cashier;

class UserController extends Controller
{
    public $states;
	private $stripe;
	public function __construct() {
        $this->stripe = new \Stripe\StripeClient(config('stripe.api_keys.secret_key'));
    }
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

    public function profile(Request $request) {
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
				$request->image->move(public_path('profile_images'), $image);
				$user = User::find($request->id);
				$user->name = $request->first_name . " " . $request->last_name;
				$user->first_name = $request->first_name;
				$user->last_name = $request->last_name;
				$user->phone = $request->phone;
				if ($image != '') {
					$user->profile_pic = $image;
					// $user->password = Hash::make($request->password);
					$user->save();
					return redirect()->back()->with('success', 'Profile updated successfully');
				}
		}
		// $user = User::where('role', '!=', 1)->find($id);

        //     $user = User::find($request->id);
        //     $user->name = $request->first_name . ' ' . $request->last_name;
        //     $user->first_name = $request->first_name;
        //     $user->last_name = $request->last_name;
        //     $user->phone = $request->phone;
        //     $user->password = Hash::make($request->password);
        //     $user->save();
        // }
        $user = User::where('role', '!=', 1)->find($id);
        if ($user) {
            return view('user.edit-profile', ['user' => $user]);
        } else {
            return redirect(route('admin-user-list'));
        }
    }

    public function studentBillingDetails(Request $request)
    {
		$user = Auth::user();
		if ($user->stripe_id) {
			$user->addPaymentMethod($request->stripeToken);
		} else {
			$user->createOrGetStripeCustomer();
			if ($request->stripeToken) {
				$user->addPaymentMethod($request->stripeToken);
			}
		}
//		$cards = $this->stripe->customers->allPaymentMethods(Auth::user()->stripe_id);
//		$intent = auth()->user()->createSetupIntent();
//		$this->states = States::get();
//		return view('user.edit-profile', ['user' => $user, 'states' => $this->states, 'cards' => $cards, 'intent' => $intent->client_secret]);
        return Redirect::back();
    }

	public function deleteCard(Request $request) {
		$this->stripe->paymentMethods->detach($request->id, []);
		return "success";
	}

    public function getCity(Request $request, $state_id)
    {
        $cities = Cities::where('state_id', $state_id)->get();
        return $cities->toArray();
    }
	// public function profile(Request $request)
	// {
	// 	$id =  Auth::id();
	// 	if (isset($request->id)) {
	// 		$request->validate(
	// 			[
	// 				'first_name' => ['required', 'min:3'],
	// 				'last_name' => ['required', 'min:3'],
	// 				'phone' => ['required', 'numeric'],
	// 				// 'password' => ['required', 'min:6'],
	// 				'image' => 'image|mimes:jpeg,png,jpg|max:2048',
	// 			],
	// 			[
	// 				'first_name.required' => 'First Name is required',
	// 				'last_name.required' => 'Last Name is required',
	// 				// 'email.required' => 'Email is required',
	// 				// 'email.unique' => 'Email already exist',
	// 				// 'password.required' => 'Password is required',
	// 				// 'password.min' => 'The password must be at least 6 characters',
	// 				'phone.required' => 'Phone is required',
	// 				'phone.numeric' => 'Phone must be numeric',
	// 			]
	// 		);
	// 		$image = '';
	// 		if (isset($request->image)) {
	// 			$image = time() . '.' . $request->image->extension();

	// 			$request->image->move(public_path('profile_images'), $image);
	// 		}
	// 		$user = User::find($request->id);
	// 		$user->name = $request->first_name . " " . $request->last_name;
	// 		$user->first_name = $request->first_name;
	// 		$user->last_name = $request->last_name;
	// 		$user->phone = $request->phone;
	// 		if ($image != '')
	// 			$user->profile_pic = $image;
	// 		// $user->password = Hash::make($request->password);
	// 		$user->save();
	// 	}
	// 	$user = User::where('role', '!=', 1)->find($id);

	// 	if ($user)
	// 		return view('user.edit-profile', ['user' => $user]);
	// 	else
	// 		return redirect(route('admin-user-list'));
	// }

	public function settings(Request $request)
	{
		$id =  Auth::id();
		if (isset($request->id)) {
			$request->validate(
				[],
				[
					'email.required' => 'Email is required',
					'email.unique' => 'Email already exist',
				]
			);

			$user = User::find($request->id);
			$user->email = $request->email;
			$user->save();
			return redirect()->back()->with('success', 'Email updated successfully');
		}
		$user = User::where('role', '!=', 1)->find($id);

		if ($user)
			return view('user.settings', ['user' => $user]);
		else
			return redirect(route('admin-user-list'));
	}

	public function settings_update(Request $request)
	{
		$id =  Auth::id();
		$user = User::find($request->id);
		if (isset($request->id)) {
			$request->validate([
				'password' => ['required', 'min:6', function ($attribute, $value, $fail) use ($user) {
					if (!Hash::check($value, $user->password)) {
						$fail(__('The current password is incorrect.'));
					}
				}],
				'new_password' => ['required', 'min:6', 'different:password'],
				'new_password_confirmation' => ['same:new_password'],
			], [
				'password.min' => 'The password must be at least 6 characters.',
				'new_password.required' => 'The new password field is required.',
				'new_password.different' => 'The new password must be different from the old password.',
				'new_password_confirmation.same' => 'The new password confirmation does not match.',
			]);


			$user->password = Hash::make($request->new_password);
			$user->save();
			return redirect()->back()->with('success', 'Password updated successfully');
		}
		$user = User::where('role', '!=', 1)->find($id);

		if ($user)
			return view('user.settings', ['user' => $user]);
		else
			return redirect(route('admin-user-list'));
	}

	public function cost_comparison()
	{
		return view('user.cost_comparison');
	}

	public function compare(Request $request)
	{
		$colleges = $request->input('colleges');
		$housingA = $request->input('housingA');
		$foodA = $request->input('foodA');
		$optionA1 = $request->input('optionA1');
		$optionA2 = $request->input('optionA2');
		$housingB = $request->input('housingB');
		$foodB = $request->input('foodB');
		$optionB1 = $request->input('optionB1');
		$optionB2 = $request->input('optionB2');
		$creditsA = $request->input('creditsA');
		$creditsB = $request->input('creditsB');

		$totalA = $housingA + $foodA + $optionA1 + $optionA2 - $creditsA;
		$totalB = $housingB + $foodB + $optionB1 + $optionB2 - $creditsB;

		if ($totalA == $totalB) {
			$result = "Both colleges cost the same.";
		} else if ($totalA < $totalB) {
			$result = $colleges['A'] . " is cheaper than " . $colleges['B'] . " by " . ($totalB - $totalA) . ".";
		} else {
			$result = $colleges['B'] . " is cheaper than " . $colleges['A'] . " by " . ($totalA - $totalB) . ".";
		}

		return view('user.cost_comparison', ['result' => $result]);
	}

	public function billing_details(Request $request) {
        $id = Auth::id();
        $user = User::where('role', '!=', 1)->find($id);
        $cards = [
            'data' => []
        ];
        $intent = auth()->user()->createSetupIntent();
        $this->states = States::get();
        $this->cities = [];
        if ($user->state_id) {
            $this->cities = Cities::where('state_id', $user->state_id)->get();
        }
        if (Auth::user()->stripe_id) {
            $cards = $this->stripe->customers->allPaymentMethods(Auth::user()->stripe_id);
        }
        return view('user.billing-details', ['user' => $user, 'states' => $this->states, 'cities' => $this->cities, 'cards' => $cards, 'intent' => $intent->client_secret]);
    }

	public function save_basic_details(Request $request) {
        $id = Auth::id();
        $request->validate(
            [
                'state_id' => ['required'],
                'city_id' => ['required'],
                'address_line_1' => ['required', 'min:5'],
                'address_line_2' => ['required', 'min:5'],
                'postal_code' => ['required', 'min:4'],
            ],
            [
                'state_id.required' => 'State is required',
                'city_id.required' => 'City is required',
                'address_line_1.required' => 'Address line 1 is required',
                'address_line_2.required' => 'Address line 2 is required',
                'postal_code.required' => 'Postal code is required',
                'address_line_1.min' => 'Address line 1 must be at least 5 characters',
                'address_line_2.min' => 'Address line 2 must be at least 5 characters',
                'postal_code.min' => 'Postal code must be at least 6 characters',

            ],
        );
        User::where('id', $id)->update([
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'postal_code' => $request->postal_code,
        ]);
        return Redirect::back();
    }
}
