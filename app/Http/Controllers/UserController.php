<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseManagement\UserTaskStatus;
use App\Models\User;
use App\Models\Reminder;
use App\Models\ReminderType;
use App\Models\CalendarEvent;
use App\Models\UserCalendar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\HighSchoolResume\States;
use App\Models\HighSchoolResume\Cities;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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
		$userTaskStatus = UserTaskStatus::where('user_id', $userId)->orderBy('updated_at', 'DESC')->first();
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
		$id =  Auth::id();
		if (isset($request->id)) {
			$request->validate(
				[
					'first_name' => ['required', 'min:3'],
					'last_name' => ['required', 'min:3'],
					'phone' => ['required', 'numeric'],
					// 'password' => ['required', 'min:6'],
					'image' => 'image|mimes:jpeg,png,jpg|max:2048',
				],
				[
					'first_name.required' => 'First Name is required',
					'last_name.required' => 'Last Name is required',
					// 'email.required' => 'Email is required',
					// 'email.unique' => 'Email already exist',
					// 'password.required' => 'Password is required',
					// 'password.min' => 'The password must be at least 6 characters',
					'phone.required' => 'Phone is required',
					'phone.numeric' => 'Phone must be numeric',
				]
			);
			$image = '';
			if (isset($request->image)) {
				$image = time() . '.' . $request->image->extension();

				$request->image->move(public_path('profile_images'), $image);
			}
			$user = User::find($request->id);
			$user->name = $request->first_name . " " . $request->last_name;
			$user->first_name = $request->first_name;
			$user->last_name = $request->last_name;
			$user->phone = $request->phone;
			if ($image != '')
				$user->profile_pic = $image;
			// $user->password = Hash::make($request->password);
			$user->save();
			return redirect()->back()->with('success', 'Profile updated successfully');
		}
		$user = User::where('role', '!=', 1)->find($id);
		if ($user) {
		    return view('user.edit-profile', ['user' => $user]);
		}
		else
			return redirect(route('admin-user-list'));
	}

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
		$college_details = DB::table('college_details')
			->select('college_details.*', 'college_information.name as college_name')
			->join('college_information', 'college_details.college_id', '=', 'college_information.id')
			->get();
		return view('user.cost_comparison', ['college_details' => $college_details]);
	}

	
	public function getCity(Request $request, $state_id)
    {
        $cities = Cities::where('state_id', $state_id)->get();
        return $cities->toArray();
    }
    
    public function deleteCard(Request $request) {
		$this->stripe->paymentMethods->detach($request->id, []);
		return "success";
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
        return Redirect::back();
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
            $customer = $user->defaultPaymentMethod();
        }
        return view('user.billing-details', ['user' => $user, 'states' => $this->states, 'cities' => $this->cities, 'cards' => $cards, 'intent' => $intent->client_secret, 'customer' => $customer]);
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
    
    public function setAsDefaultCard($payment_id) {
		$user = Auth::user();
		$user->updateDefaultPaymentMethod($payment_id);
		return Redirect::back();
	}
    
    public function reminders(Request $request)
	{
		$id =  Auth::id();
		// $user = User::find($id);
		$user = User::where('role', '!=', 1)->find($id);
		if ($user) 
		{
			$reminders = Reminder::where('user_id', $id)->get();
			$reminderTypes = ReminderType::all();
			$reminders_frequency = Config::get('constants.reminders_frequency');
			$methods = ["Text", "Email", "Both"];

			return view('user.reminder', compact('reminders', 'reminderTypes', 'reminders_frequency', 'methods'));
		} 
		else {
			return redirect(route('admin-user-list'));
		}
	}

	public function store(Request $request)
	{
		$data = $request->all();

		$rules = [
			'reminder_name' => 'required',
			'reminder_type_id' => 'required',
			'frequency' => 'required',
			'method' => 'required',
			'when_time' => 'required',
			'start_date' => 'required',
			'end_date' => 'required'
		];

		$messages = [
			"reminder_name.required" => "Name is required",
			"reminder_type_id.required" => "Type is required",
			"frequency.required" => "Frequency is required",
			"method.required" => "Method is required",
			"when_time.required" => "When Time is required",
			"start_date.required" => "Start Date is required",
			"end_date.required" => "End Date is required",
		];
		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		$reminder_type_ids = ReminderType::pluck('id')->toArray();
		if(isset($data['reminder_type_id']) && !empty($data['reminder_type_id'])){
			if(!in_array($data['reminder_type_id'] ,$reminder_type_ids)){
				$reminder_type_info = ReminderType::create(['name' => $data['reminder_type_id']]);
				$data['reminder_type_id'] = $reminder_type_info->id;
			}
		}
		
		$data['user_id'] = Auth::id();
		$reminder = Reminder::create($data);

		if(isset($data['enabled']) && !empty($data['enabled'])){
			// Retrieve the last inserted ID
			$newReminderId = $reminder->id;

			//Create CalendarEvent
			$calendarEvent = CalendarEvent::create([
				"user_id" => Auth::id(),
				"reminders_id" => $newReminderId,
				"title" => $data['reminder_name'],
				"description" => '',
				"color" => 'info',
				"is_assigned" => 1,
				'event_time' => $data['when_time']
			]);

			//Create UserCalendar
			$startDate = Carbon::parse($data['start_date'])->startOfDay();;
			$endDate = Carbon::parse($data['end_date'])->endOfDay();
			$frequency = $data['frequency'];

			$date = $startDate->copy();

			while ($date->lte($endDate)) {
				UserCalendar::create([
					"event_id" => $calendarEvent->id,
					"start_date" => $date,
					// "end_date" => $endDate,
				]);

				if ($frequency === 'Daily') {
					$date->addDay();
				} elseif ($frequency === 'Weekly') {
					$date->addWeek();
				} elseif ($frequency === 'Monthly') {
					$date->addMonth();
				}
			}
		}
		
		return back()->with('success', 'Reminder created successfully.');
	}

	
	public function update(Request $request, $id) {
		$reminder = Reminder::findOrFail($id);

		$input = $request->all();

		foreach($input as $key => $value) {
			if($key != '_token') {
				$keyParts = explode('_', $key);
				$lastKeyPart = end($keyParts);
				break;
			}
		}

		$rules = [
			'reminder_name_'.$lastKeyPart => 'required',
			'reminder_type_id_'.$lastKeyPart => 'required',
			'frequency_'.$lastKeyPart => 'required',
			'method_'.$lastKeyPart => 'required',
			'when_time_'.$lastKeyPart => 'required',
			'start_date_'.$lastKeyPart => 'required',
			'end_date_'.$lastKeyPart => 'required'
		];

		$messages = [
			"reminder_name_$lastKeyPart.required" => "Name is required",
			"reminder_type_id_$lastKeyPart.required" => "Type is required",
			"frequency_$lastKeyPart.required" => "Frequency is required",
			"method_$lastKeyPart.required" => "Method is required",
			"when_time_$lastKeyPart.required" => "When Time is required",
			"start_date_$lastKeyPart.required" => "Start Date is required",
			"end_date_$lastKeyPart.required" => "End Date is required",
		];
		$reminder_frequency = $reminder->frequency;

		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		foreach ($input as $key => $value) {
			$parts = explode('_', $key);
			if (count($parts) > 1) {
				array_pop($parts);
				$newKey = implode('_', $parts);
				$input[$newKey] = $value;
				unset($input[$key]);
			}
		}

		$reminder_type_ids = ReminderType::pluck('id')->toArray();
		if(isset($input['reminder_type_id']) && !empty($input['reminder_type_id'])){
			if(!in_array($input['reminder_type_id'] ,$reminder_type_ids)){
				$reminder_type_info = ReminderType::create(['name' => $input['reminder_type_id']]);
				$input['reminder_type_id'] = $reminder_type_info->id;
			}
		}
		
		if(!isset($input['enabled'])){
			$input['enabled'] = 0;
		}
		
		$reminder->update($input);

		if($input['enabled']) {
			$event = CalendarEvent::where('reminders_id', $id)->first();

			if (!$event) {
				//Create CalendarEvent
				$calendarEvent = CalendarEvent::create([
						"user_id" => Auth::id(),
						"reminders_id" => $id,
						"title" => $input['reminder_name'],
						"description" => '',
						"color" => 'info',
						"is_assigned" => 1,
						'event_time' => $input['when_time']
					]);

				//Create UserCalendar
				$startDate = Carbon::parse($input['start_date'])->startOfDay();;
				$endDate = Carbon::parse($input['end_date'])->endOfDay();
				$frequency = $input['frequency'];

				$date = $startDate->copy();

				while ($date->lte($endDate)) {
					UserCalendar::create([
						"event_id" => $calendarEvent->id,
						"start_date" => $date,
						// "end_date" => $endDate,
					]);

					if ($frequency === 'Daily') {
						$date->addDay();
					} elseif ($frequency === 'Weekly') {
						$date->addWeek();
					} elseif ($frequency === 'Monthly') {
						$date->addMonth();
					}
				}
			}//if (!$event)
			else {
				if($event->is_assigned == 0){
					$event->update([
						'title' => $input['reminder_name'],
						'is_assigned' => 1
					]);

					$startDate = Carbon::parse($input['start_date'])->startOfDay();;
					$endDate = Carbon::parse($input['end_date'])->endOfDay();
					$frequency = $input['frequency'];
	
					$date = $startDate->copy();
	
					while ($date->lte($endDate)) {
						UserCalendar::create([
							"event_id" => $event->id,
							"start_date" => $date,
							// "end_date" => $endDate,
						]);
	
						if ($frequency === 'Daily') {
							$date->addDay();
						} elseif ($frequency === 'Weekly') {
							$date->addWeek();
						} elseif ($frequency === 'Monthly') {
							$date->addMonth();
						}
					}
				} else {
					$event->update([
						'title' => $input['reminder_name']
					]);
		
					if($reminder_frequency != $input['frequency']) {
						UserCalendar::where('event_id', $event->id)->delete();
		
						$startDate = Carbon::parse($input['start_date'])->startOfDay();;
						$endDate = Carbon::parse($input['end_date'])->endOfDay();
						$frequency = $input['frequency'];
		
						$date = $startDate->copy();
		
						while ($date->lte($endDate)) {
							UserCalendar::create([
								"event_id" => $event->id,
								"start_date" => $date,
								// "end_date" => $endDate,
							]);
		
							if ($frequency === 'Daily') {
								$date->addDay();
							} elseif ($frequency === 'Weekly') {
								$date->addWeek();
							} elseif ($frequency === 'Monthly') {
								$date->addMonth();
							}
						}
					}
				}//END if($reminder_frequency != $input['frequency'])
			}
		} else {
			$event = CalendarEvent::where('reminders_id', $id)->first();
			if ($event) {
				//Delete UserCalendar and CalendarEvent
				UserCalendar::where('event_id', $event->id)->delete();
				$event->delete();
			}
		}

		return back()->with('success', 'Reminder Updated successfully.');
	}

	public function delete($id) {
		$reminder = Reminder::find($id);
		$event = CalendarEvent::where('reminders_id', $id)->first();
		if ($event) {
			UserCalendar::where('event_id', $event->id)->delete();
			$event->delete();
		}
		$reminder->delete();
		return response()->json(['success' => true, 'id' => $id, 'message' => 'Reminder Deleted successfully']);
	}
}
