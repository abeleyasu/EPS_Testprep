<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\HonorsRequest;
use App\Models\HighSchoolResume\Honor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HonorsController extends Controller
{
    public function index()
    {
        $honor  = Honor::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        return view('user.admin-dashboard.high-school-resume.honors', compact('honor'));
    }

    public function store(HonorsRequest $request)
    {
        $data = $request->validated();
        
        if(!empty($request->honors_data)){
            $data['honors_data'] = $request->honors_data;
        }

        $data['user_id'] = Auth::id();

        $data = array_filter($data);

        if (!empty($data)) {
            Honor::create($data);
            return redirect()->route('admin-dashboard.highSchoolResume.activities');
        }
    }

    public function update(HonorsRequest $request, Honor $honor)
    {
        $data = $request->validated();

        if(!empty($request->honors_data)){
            $data['honors_data'] = $request->honors_data;
        }

        $data = array_filter($data);

        if (!empty($data)) {
            $honor->update($data);
            return redirect()->route('admin-dashboard.highSchoolResume.activities');
        }
    }
}
