<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseManagement\UserTaskStatus;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Support\Facades\Crypt;

class VerifyEmailController extends Controller
{
    public function send(Request $request) {
        if ($request->user()) {
            if ($request->user()->hasVerifiedEmail()) {
                if ((int) $request->user()->role === 1) {
                    return redirect()->intended(route('admin-dashboard'));
                } elseif ((int) $request->user()->role === 3) {
                    return redirect()->intended(route('user-dashboard'));
                } else {
                    Auth::logout();
                    return redirect()->intended('/login');
                }
            }
        }
        return view('auth.verify-email');
    }

    public function resend(Request $request) {
        try {
            $user_id = Crypt::decryptString($request->id);
            $user = User::where('id', $user_id)->first();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong. Please try again later.'
                ]);
            }
            $mail = $this->mailgun->sendEmailConfirmationCode($user);
            if ($mail) {
                return response()->json([
                    'success' => true,
                    'message' => 'New verification code has been sent to your email address.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong. Please try again later.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ]);
        }
    }

    public function verfiy(Request $request) {
        $user = User::where('id', $request->id)->first();
        $user->email_verified_at = now();
        $user->referral_code = $this->commonService->referral_code(6);
        $user->save();
        $this->mailgun->sendMail([
            'to' => $user->email,
            'subject' => 'Welcome to College Prep System - Your Account is Ready!',
            'html' => view('email-template.welcome', [
                'name' => $user->first_name,
            ])->render()
        ]);
        UserSettings::create([ 'user_id' => $user->id ]);
        return redirect()->route('home')->with([
            'email_status' => 'success',
            'email_message' => 'Your account has been verified. You can now login.',
            'modal' => 'login'
        ]);
    }
}
