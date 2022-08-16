<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

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
            'password' => ['required', 'min:6'],
        ]);

        $user = User::find($request->id);
        $user->name = $request->first_name." ".$request->last_name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
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
		]);

        $user = User::create([
            'name' => $request->first_name." ".$request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return redirect(route('admin-user-list'));
    }

    public function deleteUser(Request $request){
        User::find($request->id)->delete();
        return "success";
    }
}
