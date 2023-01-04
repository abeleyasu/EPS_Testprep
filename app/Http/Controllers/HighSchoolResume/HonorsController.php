<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\HonorsRequest;
use App\Models\Grade;
use App\Models\HighSchoolResume;
use App\Models\HighSchoolResume\Activity;
use App\Models\HighSchoolResume\EmploymentCertification;
use App\Models\HighSchoolResume\FeaturedAttribute;
use App\Models\HighSchoolResume\Honor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class HonorsController extends Controller
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
            $honor = Honor::whereUserId($user_id)->where('is_draft', 0)->first();
            $activity = Activity::whereUserId($user_id)->where('is_draft', 0)->first();
            $employmentCertification = EmploymentCertification::whereUserId($user_id)->where('is_draft', 0)->first();
            $featuredAttribute = FeaturedAttribute::whereUserId($user_id)->where('is_draft', 0)->first();
        }
        $validations_rules = Config::get('validation.honors.rules');
        $validations_messages = Config::get('validation.honors.messages');
        $grades = Grade::all();
        $details = 0;
        return view('user.admin-dashboard.high-school-resume.honors', compact('honor','activity','employmentCertification','featuredAttribute','details','resume_id', 'validations_rules', 'validations_messages', 'grades'));
    }

    public function store(HonorsRequest $request)
    {
        $data = $request->validated();

        $grade_ids = Grade::pluck('id')->toArray();

        if(isset($data['honors_data']) && !empty($data['honors_data'])){
            foreach($data['honors_data'] as $key => $value){
                if(isset($value['grade']) && !empty($value['grade'])){
                    foreach($value['grade'] as $grade){
                        if(!in_array($grade , $grade_ids)){
                            $grade_info = Grade::create(['name' => $grade]);
                            $index = array_search($grade, $data['honors_data'][$key]['grade']);                    
                            $grade_array = array_replace($data['honors_data'][$key]['grade'], [$index => $grade_info->id]);
                            $data['honors_data'][$key]['grade'] = $grade_array;
                        }    
                    }  
                }
            }
        }

        if(!empty($data['honors_data'])){
            $data['honors_data'] = array_values($data['honors_data']);
        }
        
        $data['user_id'] = Auth::id();

        if (!empty($data)) {
            Honor::create($data);
            return redirect()->route('admin-dashboard.highSchoolResume.activities');
        }
    }

    public function update(HonorsRequest $request, Honor $honor)
    {   
        $data = $request->validated();
        $resume_id = isset($request->resume_id) ? $request->resume_id : null;
        
        $grade_ids = Grade::pluck('id')->toArray();
        if(isset($data['honors_data']) && !empty($data['honors_data'])){
            foreach($data['honors_data'] as $key => $value){
                if (isset($value['grade']) && !empty($value['grade'])) {
                    foreach ($value['grade'] as $grade) {
                        if (!in_array($grade, $grade_ids)) {
                            $grade_info = Grade::create(['name' => $grade]);
                            $index = array_search($grade, $data['honors_data'][$key]['grade']);
                            $grade_array = array_replace($data['honors_data'][$key]['grade'], [$index => $grade_info->id]);
                            $data['honors_data'][$key]['grade'] = $grade_array;
                        }
                    }
                }
            }
        }
        if(!empty($data['honors_data'])){
            $data['honors_data'] = array_values($data['honors_data']);
        }

        
        if (!empty($data)) {
            $honor->update($data);
            if($resume_id != null)
            {
                return redirect("user/admin-dashboard/high-school-resume/activities?resume_id=".$resume_id);
            }else{
                return redirect()->route('admin-dashboard.highSchoolResume.activities');
            }

        }
    }
}
