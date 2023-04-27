<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseManagement\UserTaskStatus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;

class UserController extends Controller
{
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

		if ($user)
			return view('user.edit-profile', ['user' => $user]);
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
		return view('user.cost_comparison');
	}
}
