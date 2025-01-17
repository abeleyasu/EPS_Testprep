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
use App\Http\Requests\SignInRequest;
use App\Models\AdminSettings;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    public function showSignUp(){
		$usersRoles = UserRole::where([
            ['slug','!=','super_admin'],
            ['is_visible',1]
        ])->get();
        return view('signup');
    }

    public function checkEmail(Request $request) {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        return response()->json(!$user, 200);
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
            'login_count' => 1,
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
            $this->mailgun->sendEmailConfirmationCode($user);
            
            $data = [
                'id' => Crypt::encryptString($user->id),
            ];
            return response()->json([
                'success' => true,
                'message' => 'User Registration Successfully. Please check your email to verify your account.',
                'data' => $data,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Unable to create your account',
        ], 200);
    }

    public function showSignIn(){
        if(Auth::guest()){
            return view('signin');
        }
    }

    public function userSignIn(SignInRequest $request){
        try {
            $credentials = $request->only('email', 'password');
            $credentials['is_active'] = true;
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'The provided credentials do not match our records.',
                ], 200);
            }

            if (!$user->hasVerifiedEmail()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please verify your email address.',
                    'data' => [
                        'id' => Crypt::encryptString($user->id),
                    ]
                ], 200);
            }
            if(Auth::attempt($credentials, $request->remember)){
                $request->session()->regenerate();
                $user->createOrGetStripeCustomer();
                if((int) $user->role == 1) {
                    $route = route('admin-dashboard');
                    return response()->json([
                        'success' => true,
                        'message' => 'Login successfully',
                        'redirect_url' => $route,
                    ], 200);
                } else {
                    $route = route('user-dashboard');
                    if ($user->login_count == 1){
                        $route = route('survey-form');
                        $user->login_count++;
                        $user->save();
                    }
                    return response()->json([
                        'success' => true,
                        'message' => 'Login successfully',
                        'redirect_url' => $route,
                    ], 200);
                }
            }
            return response()->json([
                'success' => false,
                'message' => 'The provided credentials do not match our records.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 200);
        }
    }

    public function signOut(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('home'));
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
