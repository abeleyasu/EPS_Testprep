<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\EducationRequest;
use App\Models\EducationCourse;
use App\Models\HighSchoolResume;
use App\Models\HighSchoolResume\Activity;
use App\Models\HighSchoolResume\Education;
use App\Models\HighSchoolResume\EmploymentCertification;
use App\Models\HighSchoolResume\FeaturedAttribute;
use App\Models\HighSchoolResume\Honor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class EducationController extends Controller
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
        }else{

            $user_id = Auth::id();
    
            $education = Education::whereUserId($user_id)->where('is_draft', 0)->first();
            $honor = Honor::whereUserId($user_id)->where('is_draft', 0)->first();
            $activity = Activity::whereUserId($user_id)->where('is_draft', 0)->first();
            $employmentCertification = EmploymentCertification::whereUserId($user_id)->where('is_draft', 0)->first();
            $featuredAttribute = FeaturedAttribute::whereUserId($user_id)->where('is_draft', 0)->first();
    
        }
        $courses_list = EducationCourse::all();

        $validations_rules = Config::get('validation.educations.rules');
        $validations_messages = Config::get('validation.educations.messages');
        // dd($validations_messages, $validations_rules);

        $details = 0;
        return view('user.admin-dashboard.high-school-resume.education-info', compact('education','honor','activity','employmentCertification','featuredAttribute', 'courses_list','details','resume_id', 'validations_rules', 'validations_messages'));
    }

    public function store(EducationRequest $request)
    {
        $data = $request->validated();

        if(!empty($request->course_data)){
            $data['course_data'] = array_values($request->course_data);
        }

        if(!empty($request->honor_course_data)){
            $data['honor_course_data'] = array_values($request->honor_course_data);
        }

        if(!empty($request->testing_data)){
            $data['testing_data'] = array_values($request->testing_data);
        }

        if(!empty($request->ib_courses)){
            $data['ib_courses'] = json_encode($request->ib_courses);
        }

        if(!empty($request->ap_courses)){
            $data['ap_courses'] = json_encode($request->ap_courses);
        }

        $data['user_id'] = Auth::id();

        if (!empty($data)) {
            Education::create($data);
            // return response()->json(['success' => true, 'data' => $data]);
            return redirect()->route('admin-dashboard.highSchoolResume.honors');
        }
    }

    public function update(EducationRequest $request, Education $education)
    {
        $data = $request->validated();
        
        if(!empty($request->course_data)){
            $data['course_data'] = array_values($request->course_data);
        }

        if(!empty($request->honor_course_data)){
            $data['honor_course_data'] = array_values($request->honor_course_data);
        }

        if(!empty($request->testing_data)){
            $data['testing_data'] = array_values($request->testing_data);
        }

        if(!empty($request->ib_courses)){
            $data['ib_courses'] = json_encode($request->ib_courses);
        }

        if(!empty($request->ap_courses)){
            $data['ap_courses'] = json_encode($request->ap_courses);
        }

        if (!empty($data)) {
            $education->update($data);
            // return response()->json(['success' => true, 'data' => $data]);
            return redirect()->route('admin-dashboard.highSchoolResume.honors');

        }
    }
}
