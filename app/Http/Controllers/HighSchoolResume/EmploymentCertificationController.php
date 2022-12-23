<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\EmploymentCertificationRequest;
use App\Models\HighSchoolResume;
use App\Models\HighSchoolResume\EmploymentCertification;
use App\Models\HighSchoolResume\FeaturedAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmploymentCertificationController extends Controller
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
            $employmentCertification = EmploymentCertification::whereUserId($user_id)->where('is_draft', 0)->first();
            $featuredAttribute = FeaturedAttribute::whereUserId($user_id)->where('is_draft', 0)->first();
        } 
        $details = 0;
        return view('user.admin-dashboard.high-school-resume.employment-certification', compact('employmentCertification','featuredAttribute','details','resume_id'));
    }

    public function store(EmploymentCertificationRequest $request)
    {
        $data = $request->validated();

        if(!empty($request->employment_data)){
            $data['employment_data'] = array_values($request->employment_data);
        }

        if(!empty($request->significant_data)){
            $data['significant_data'] = array_values($request->significant_data);
        }

        $data['user_id'] = Auth::id();

        if (!empty($data)) {
            EmploymentCertification::create($data);
            return response()->json(['success' => true, 'data' => $data]);
        }
    }

    public function update(EmploymentCertificationRequest $request, EmploymentCertification $employmentCertification)
    {
        $data = $request->validated();

        if(!empty($request->employment_data)){
            $data['employment_data'] = array_values($request->employment_data);
        }

        if(!empty($request->significant_data)){
            $data['significant_data'] = array_values($request->significant_data);
        }

        if (!empty($data)) {
            $employmentCertification->update($data);
            return response()->json(['success' => true, 'data' => $data]);
        }
    }
}
