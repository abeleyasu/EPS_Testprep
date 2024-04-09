<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EmailVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()) {
            if (!$request->user()->hasVerifiedEmail()) {
                // return redirect()->intended(route('home'))->with([
                //     'email_status' => 'error',
                //     'email_message' => 'Your email is not verified. Please verify your email.',
                //     'modal' => 'email-verification'
                // ]);
                // return response()->json([
                //     'message' => 'Your email is not verified. Please verify your email to login.',
                //     'modal' => 'email-verification'
                // ], 403);
                return $next($request);
            } else {
                return $next($request);
            }
        }
        // return $next($request);
    }
}
