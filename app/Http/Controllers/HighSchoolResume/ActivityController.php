<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\ActivityRequest;
use App\Models\Grade;
use App\Models\HighSchoolResume;
use App\Models\HighSchoolResume\Activity;
use App\Models\HighSchoolResume\EmploymentCertification;
use App\Models\HighSchoolResume\FeaturedAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

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
        $grades = Grade::all();
        $validations_rules = Config::get('validation.activities.rules');
        $validations_messages = Config::get('validation.activities.messages');

        $details = 0;
        return view('user.admin-dashboard.high-school-resume.activities', compact('activity','employmentCertification','featuredAttribute','details','resume_id', 'validations_rules', 'validations_messages', 'grades'));
    }

    public function store(ActivityRequest $request)
    {
        $data = $request->validated();

        $grade_ids = Grade::pluck('id')->toArray();

        if(!empty($data['demonstrated_data'])) {
            foreach($data['demonstrated_data'] as $key => $value){
                if (!empty(array_filter($value))) {
                    foreach($value['grade'] as $grade){
                        if(!in_array($grade , $grade_ids)){
                            $grade_info = Grade::create(['name' => $grade]);
                            $index = array_search($grade, $data['demonstrated_data'][$key]['grade']);                    
                            $grade_array = array_replace($data['demonstrated_data'][$key]['grade'], [$index => $grade_info->id]);
                            $data['demonstrated_data'][$key]['grade'] = $grade_array;
                        }    
                    }  
                }
            }
            $data['demonstrated_data'] = array_values($data['demonstrated_data']);
        }

        if (!empty($data['leadership_data'])) {
            foreach($data['leadership_data'] as $key => $value){
                if (!empty(array_filter($value))) {
                    foreach($value['grade'] as $grade){
                        if(!in_array($grade , $grade_ids)){
                            $grade_info = Grade::create(['name' => $grade]);
                            $index = array_search($grade, $data['leadership_data'][$key]['grade']);                    
                            $grade_array = array_replace($data['leadership_data'][$key]['grade'], [$index => $grade_info->id]);
                            $data['leadership_data'][$key]['grade'] = $grade_array;
                        }    
                    }  
                }
            }
            $data['leadership_data'] = array_values($data['leadership_data']);
        }

        if (!empty($data['activities_data'])) {
            foreach ($data['activities_data'] as $key => $value) {
                if (!empty(array_filter($value))) {
                    foreach ($value['grade'] as $grade) {
                        if (!in_array($grade, $grade_ids)) {
                            $grade_info = Grade::create(['name' => $grade]);
                            $index = array_search($grade, $data['activities_data'][$key]['grade']);
                            $grade_array = array_replace($data['activities_data'][$key]['grade'], [$index => $grade_info->id]);
                            $data['activities_data'][$key]['grade'] = $grade_array;
                        }
                    }
                }
            }
            $data['activities_data'] = array_values($data['activities_data']);
        }

        if (!empty($data['athletics_data'])) {
            foreach($data['athletics_data'] as $key => $value){
                if (!empty(array_filter($value))) {
                    foreach($value['grade'] as $grade){
                        if(!in_array($grade , $grade_ids)){
                            $grade_info = Grade::create(['name' => $grade]);
                            $index = array_search($grade, $data['athletics_data'][$key]['grade']);                    
                            $grade_array = array_replace($data['athletics_data'][$key]['grade'], [$index => $grade_info->id]);
                            $data['athletics_data'][$key]['grade'] = $grade_array;
                        }    
                    }  
                }
            }
            $data['athletics_data'] = array_values($data['athletics_data']);
        }

        if (!empty($data['community_service_data'])) {
            foreach($data['community_service_data'] as $key => $value){
                if (!empty(array_filter($value))) {
                    foreach($value['grade'] as $grade){
                        if(!in_array($grade , $grade_ids)){
                            $grade_info = Grade::create(['name' => $grade]);
                            $index = array_search($grade, $data['community_service_data'][$key]['grade']);                    
                            $grade_array = array_replace($data['community_service_data'][$key]['grade'], [$index => $grade_info->id]);
                            $data['community_service_data'][$key]['grade'] = $grade_array;
                        }    
                    }  
                }
            }
            $data['community_service_data'] = array_values($data['community_service_data']);
        }

        $data['user_id'] = Auth::id();

        if (!empty($data)) {
            Activity::create($data);
            return redirect()->route('admin-dashboard.highSchoolResume.employmentCertification');

        }
    }

    public function update(ActivityRequest $request, Activity $activity)
    {
        $resume_id = isset($request->resume_id) ? $request->resume_id : null;
        $data = $request->validated();

        $grade_ids = Grade::pluck('id')->toArray();

        if(!empty($data['demonstrated_data'])) {
            foreach($data['demonstrated_data'] as $key => $value){
                if (!empty(array_filter($value))) {
                    foreach($value['grade'] as $grade){
                        if(!in_array($grade , $grade_ids)){
                            $grade_info = Grade::create(['name' => $grade]);
                            $index = array_search($grade, $data['demonstrated_data'][$key]['grade']);                    
                            $grade_array = array_replace($data['demonstrated_data'][$key]['grade'], [$index => $grade_info->id]);
                            $data['demonstrated_data'][$key]['grade'] = $grade_array;
                        }    
                    }  
                }
            }
            $data['demonstrated_data'] = array_values($data['demonstrated_data']);
        }

        if (!empty($data['leadership_data'])) {
            foreach($data['leadership_data'] as $key => $value){
                if (!empty(array_filter($value))) {
                    foreach($value['grade'] as $grade){
                        if(!in_array($grade , $grade_ids)){
                            $grade_info = Grade::create(['name' => $grade]);
                            $index = array_search($grade, $data['leadership_data'][$key]['grade']);                    
                            $grade_array = array_replace($data['leadership_data'][$key]['grade'], [$index => $grade_info->id]);
                            $data['leadership_data'][$key]['grade'] = $grade_array;
                        }    
                    }  
                }
            }
            $data['leadership_data'] = array_values($data['leadership_data']);
        }

        if (!empty($data['activities_data'])) {
            foreach ($data['activities_data'] as $key => $value) {
                if (!empty(array_filter($value))) {
                    foreach ($value['grade'] as $grade) {
                        if (!in_array($grade, $grade_ids)) {
                            $grade_info = Grade::create(['name' => $grade]);
                            $index = array_search($grade, $data['activities_data'][$key]['grade']);
                            $grade_array = array_replace($data['activities_data'][$key]['grade'], [$index => $grade_info->id]);
                            $data['activities_data'][$key]['grade'] = $grade_array;
                        }
                    }
                }
            }
            $data['activities_data'] = array_values($data['activities_data']);
        }

        if (!empty($data['athletics_data'])) {
            foreach($data['athletics_data'] as $key => $value){
                if (!empty(array_filter($value))) {
                    foreach($value['grade'] as $grade){
                        if(!in_array($grade , $grade_ids)){
                            $grade_info = Grade::create(['name' => $grade]);
                            $index = array_search($grade, $data['athletics_data'][$key]['grade']);                    
                            $grade_array = array_replace($data['athletics_data'][$key]['grade'], [$index => $grade_info->id]);
                            $data['athletics_data'][$key]['grade'] = $grade_array;
                        }    
                    }  
                }
            }
            $data['athletics_data'] = array_values($data['athletics_data']);
        }

        if (!empty($data['community_service_data'])) {
            foreach($data['community_service_data'] as $key => $value){
                if (!empty(array_filter($value))) {
                    foreach($value['grade'] as $grade){
                        if(!in_array($grade , $grade_ids)){
                            $grade_info = Grade::create(['name' => $grade]);
                            $index = array_search($grade, $data['community_service_data'][$key]['grade']);                    
                            $grade_array = array_replace($data['community_service_data'][$key]['grade'], [$index => $grade_info->id]);
                            $data['community_service_data'][$key]['grade'] = $grade_array;
                        }    
                    }  
                }
            }
            $data['community_service_data'] = array_values($data['community_service_data']);
        }

        if (!empty($data)) {
            $activity->update($data);
            if ($resume_id != null) {
                return redirect('user/admin-dashboard/high-school-resume/employment-certifications?resume_id='.$resume_id);
            } else {
                return redirect()->route('admin-dashboard.highSchoolResume.employmentCertification');
            }
        }
    }
}
