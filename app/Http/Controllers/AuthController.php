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
use App\Http\Requests\UserRegistration;
use App\Models\AdminSettings;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function showSignUp(){
		$usersRoles = UserRole::where([
            ['slug','!=','super_admin'],
            ['is_visible',1]
        ])->get();
        return view('signup',compact('usersRoles'));
    }

    public function userSignUp(UserRegistration $request){
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
            'is_receive_emails_newsletters' => isset($request->is_receive_emails_newsletters) ? Str::lower($request->is_receive_emails_newsletters) == 'on' ? 1 : 0 : 0,
            'is_receive_sms' => isset($request->is_receive_sms) ? Str::lower($request->is_receive_sms) == 'on' ? 1 : 0 : 0,
        ];
        UserSettings::create($data);

        if($user){
            $user->createOrGetStripeCustomer();
            $admin_settings = AdminSettings::first();
            if ($admin_settings) {
                if ($admin_settings->is_free_access) {
                    $trial_ends_at = Carbon::now();
                    switch ($admin_settings->free_access_interval) {
                        case 'day':
                            $trial_ends_at->addDays($admin_settings->free_access_interval_count);
                            break;
                        case 'week':
                            $trial_ends_at->addWeeks($admin_settings->free_access_interval_count);
                            break;
                        case 'month':
                            $trial_ends_at->addMonths($admin_settings->free_access_interval_count);
                            break;
                    }
                    $user->trial_ends_at = $trial_ends_at->format('Y-m-d');
                    $user->save();
                    $free_role = Role::where('name', config('constants.role_free_name'))->first();
                    $user->assignRole($free_role);
                }
            }
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

        $credentials['is_active'] = true;
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
