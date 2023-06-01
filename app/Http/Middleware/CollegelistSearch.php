<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\CollegeList;

class CollegelistSearch
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
        if (isset($request->college_lists_id)) {
            $checkissameuser = CollegeList::where('id', $request->college_lists_id)->where('user_id', auth()->user()->id)->first();
            if ($checkissameuser) {
                if ($checkissameuser->status == 'completed') {
                    return redirect()->route('admin-dashboard.initialCollegeList.step1')->with('cmessage', 'You already completed your initial College List, Please start again. if you want to submit more.');
                } else {
                    return $next($request);
                }
            }
        }
        abort(404);
    }
}
