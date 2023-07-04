<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\UserSettings;

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

        $data = [
            'user_id' => $user->id,
        ];
        if (isset($request->is_verifed)) {
            $data['is_receive_sms'] = 1; 
        }
        UserSettings::create($data);

        if($user){
            $user->createOrGetStripeCustomer();
            Auth::login($user);
            $this->mailgun->sendEmailConfirmationCode();
            if ($user->role === 1) {
                return redirect()->intended(route('admin-dashboard'));
            } elseif ($user->role === 3) {
                return redirect()->intended(route('user-dashboard'));
            } else {
                return redirect()->intended('/login');
            }
        }

        return back()->withErrors("Unable to create your account")
        ->onlyInput('email', 'first_name', 'last_name', 'phone');
    }

    public function showSignIn(){
        if(Auth::guest()){
            return view('signin');
        }
    }

    public function userSignIn(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ],
		[
			'email.required' => 'Email is required',
			'email.email' => 'The email must be a valid email address.',
			'password.required' => 'Password is required',
			'password.min' => 'The password must be at least 6 characters',
		]);

        if(Auth::attempt($credentials, $request->remember)){
            $request->session()->regenerate();

            $user = Auth::user();
            $user->createOrGetStripeCustomer();
            if((int) $user->role == 1) {
                return redirect()->intended(route('admin-dashboard'));
            }    
            elseif((int) $user->role == 3) {
                return redirect()->intended(route('user-dashboard'));
            }
            else {
                return redirect()->intended('/login');
            }
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
        $request->validate([
				'email' => 'required|email|exists:users,email'
			],
			[
				'email.required' => 'Email is required',
				'email.email' => 'The email must be a valid email address.',
				'email.exists' => 'The email not exists',
			]);

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
