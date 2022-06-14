<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use Auth;
use Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showSignUp(){
		$usersRoles = UserRole::where('slug','!=','super_admin')->get();
        return view('signup',compact('usersRoles'));
    }

    public function userSignUp(Request $request){
        $request->validate([
            'first_name' => ['required', 'min:3'],
            'last_name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'numeric'],
            'password' => ['required', 'confirmed', 'min:6'],
            'terms' => ['accepted'],
        ]);

        $user = User::create([
            'name' => $request->first_name." ".$request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if($user){
            return redirect()->intended(route('signin'));
        }

        return back()->withErrors("Unable to create your account")
        ->onlyInput('email', 'first_name', 'last_name', 'phone');
    }

    public function showSignIn(){
        return view('signin');
    }

    public function userSignIn(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        if(Auth::attempt($credentials, $request->remember)){
            $request->session()->regenerate();

            $user = Auth::user();
            if($user->role ==1)
                return redirect()->intended(route('admin-dashboard'));
            elseif($user->isUser())
                return redirect()->intended(route('user-dashboard'));
            else
                return redirect()->intended(route('signin'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function signOut(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('signin'));
    }

    public function showForgetPassword() {
        return view('auth.forgot-password');
    }

    public function postForgetPassword(Request $request) {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );


        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])->with('success','Email has been sent to reset the password. Please check mail')
            : back()->withErrors(['email' => __($status)])->with('error','Something went wrong while sending email');
    }

    public function resetPasswordView($token) {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(ResetPasswordRequest $request) {

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

//                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('signin')->with('status', __($status))->with('success','Please Login with new credentials')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
