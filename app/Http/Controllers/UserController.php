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
					'password' => ['required', 'min:6'],
					'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
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
				]
			);

			$image = time() . '.' . $request->image->extension();

			$request->image->move(public_path('profile_images'), $image);

			$user = User::find($request->id);
			$user->name = $request->first_name . " " . $request->last_name;
			$user->first_name = $request->first_name;
			$user->last_name = $request->last_name;
			$user->phone = $request->phone;
			$user->profile_pic = $image;
			$user->password = Hash::make($request->password);
			$user->save();
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
				[
					'password' => ['required', 'min:6'],
				],
				[
					'email.required' => 'Email is required',
					'email.unique' => 'Email already exist',
					'password.required' => 'Password is required',
					'password.min' => 'The password must be at least 6 characters',
				]
			);

			$user = User::find($request->id);
			$user->email = $request->email;
			$user->password = Hash::make($request->password);
			$user->save();
		}
		$user = User::where('role', '!=', 1)->find($id);

		if ($user)
			return view('user.settings', ['user' => $user]);
		else
			return redirect(route('admin-user-list'));
	}
}
