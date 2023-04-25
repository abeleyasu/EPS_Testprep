<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseManagement\UserTaskStatus;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

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
        $request->user()->sendEmailVerificationNotification();
        return back()->with('resent', 'Verification link sent!');
    }

    public function verfiy(EmailVerificationRequest $request) {
        $request->fulfill();
        $user = $request->user();
        if ($user->hasVerifiedEmail()) {
            if ((int) $user->role === 1) {
                return redirect()->intended(route('admin-dashboard'));
            } elseif ((int) $user->role === 3) {
                return redirect()->intended(route('user-dashboard'));
            } else {
                Auth::logout();
                return redirect()->intended('/login');
            }
        }
        $user->email_verified_at = now();
        $user->save();
        if ((int) $user->role === 1) {
            return redirect()->intended(route('admin-dashboard'));
        } elseif ((int) $user->role === 3) {
            return redirect()->intended(route('user-dashboard'));
        } else {
            Auth::logout();
            return redirect()->intended('/login');
        }
    }
}
