<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\ActivityRequest;
use App\Models\HighSchoolResume;
use App\Models\HighSchoolResume\Activity;
use App\Models\HighSchoolResume\EmploymentCertification;
use App\Models\HighSchoolResume\FeaturedAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $resume_id = $request->resume_id;
        if(isset($resume_id) && $resume_id != null) {   
            $resumedata = HighSchoolResume::where('id',$resume_id)->with([
                'personal_info', 
                'education',
                'honor',
                'activity',
                'employmentCertification',
                'featuredAttribute'
            ])->first();
            $personal_info = $resumedata->personal_info; 
            $education = $resumedata->education; 
            $honor = $resumedata->honor; 
            $activity = $resumedata->activity; 
            $employmentCertification = $resumedata->employmentCertification; 
            $featuredAttribute = $resumedata->featuredAttribute;
        } else {
            $user_id = Auth::id();

            $activity = Activity::whereUserId($user_id)->where('is_draft', 0)->first();
            $employmentCertification = EmploymentCertification::whereUserId($user_id)->where('is_draft', 0)->first();
            $featuredAttribute = FeaturedAttribute::whereUserId($user_id)->where('is_draft', 0)->first();
        }
        $details = 0;
        return view('user.admin-dashboard.high-school-resume.activities', compact('activity','employmentCertification','featuredAttribute','details','resume_id'));
    }

    public function store(ActivityRequest $request)
    {
        $data = $request->validated();

        if(!empty($request->demonstrated_data)){
            $data['demonstrated_data'] = array_values($request->demonstrated_data);
        }

        if(!empty($request->leadership_data)){
            $data['leadership_data'] = array_values($request->leadership_data);
        }

        if(!empty($request->activities_data)){
            $data['activities_data'] = array_values($request->activities_data);
        }

        if(!empty($request->athletics_data)){
            $data['athletics_data'] = array_values($request->athletics_data);
        }
        
        if(!empty($request->community_service_data)){
            $data['community_service_data'] = array_values($request->community_service_data);
        }

        $data['user_id'] = Auth::id();

        if (!empty($data)) {
            Activity::create($data);
            return response()->json(['success' => true, 'data' => $data]);
        }
    }

    public function update(ActivityRequest $request, Activity $activity)
    {
        $resume_id = isset($request->resume_id) ? $request->resume_id : null;
        $data = $request->validated();
        // dd($data);

        if(!empty($request->demonstrated_data)){
            $data['demonstrated_data'] = array_values($request->demonstrated_data);
        }

        if(!empty($request->leadership_data)){
            $data['leadership_data'] = array_values($request->leadership_data);
        }

        if(!empty($request->activities_data)){
            $data['activities_data'] = array_values($request->activities_data);
        }

        if(!empty($request->athletics_data)){
            $data['athletics_data'] = array_values($request->athletics_data);
        }
        
        if(!empty($request->community_service_data)){
            $data['community_service_data'] = array_values($request->community_service_data);
        }

        if (!empty($data)) {
            $activity->update($data);
            // if ($resume_id != null) {
            //     return redirect('user/admin-dashboard/high-school-resume/employment-certifications?resume_id='.$resume_id);
            // } else {
            //     return redirect()->route('admin-dashboard.highSchoolResume.employmentCertification');
            // }

            return response()->json(['success' => true, 'data' => $data]);
        }
    }
}
