<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\HonorsRequest;
use App\Models\HighSchoolResume\Activity;
use App\Models\HighSchoolResume\EmploymentCertification;
use App\Models\HighSchoolResume\FeaturedAttribute;
use App\Models\HighSchoolResume\Honor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HonorsController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();

        $honor = Honor::whereUserId($user_id)->where('is_draft', 0)->first();
        $activity = Activity::whereUserId($user_id)->where('is_draft', 0)->first();
        $employmentCertification = EmploymentCertification::whereUserId($user_id)->where('is_draft', 0)->first();
        $featuredAttribute = FeaturedAttribute::whereUserId($user_id)->where('is_draft', 0)->first();

        $details = 0;
        return view('user.admin-dashboard.high-school-resume.honors', compact('honor','activity','employmentCertification','featuredAttribute','details'));
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
        
        if($data['honors_data'] == "[]"){
            $data['honors_data'] = null;
        }
        

        if (!empty($data)) {
            $honor->update($data);
            return redirect()->route('admin-dashboard.highSchoolResume.activities');
        }
    }
}
