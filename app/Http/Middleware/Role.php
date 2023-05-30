<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, String $role)
    {

        if(Auth::check()) {
            $user = Auth::user();
            $role_status = $user->role == 1 ? 'super_admin' : 'standard_user';
            if($role == $role_status) {
                return $next($request);	
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }
}
