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
use App\Models\HighSchoolResume\HonorsStatuses;
use App\Models\HighSchoolResume\HonorsAchievementAwards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Service\ResumeService;

class HonorsController extends Controller
{

    protected $resumeService;

    public function __construct(ResumeService $resumeService) {
        $this->resumeService = $resumeService;
    }

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
        // $status = Config::get('constants.status');
        $status = HonorsStatuses::select('id','status')->orderBY('status', 'asc')->get();
        // $awards = Config::get('constants.honor_achievement_awards');
        $awards = HonorsAchievementAwards::select('id','award')->orderBY('award', 'asc')->get();
        $grades = Grade::where('user_id', Auth::id())->get();
        $details = 0;
        return view('user.admin-dashboard.high-school-resume.honors', compact('honor','activity','employmentCertification','featuredAttribute','details','resume_id', 'validations_rules', 'validations_messages', 'grades','status','awards'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $grade_ids = Grade::pluck('id')->toArray();

        if(isset($data['honors_data']) && !empty($data['honors_data'])){
            foreach($data['honors_data'] as $key => $value){

                if(isset($value['position']) && !empty($value['position'])){
                    $existingStatus = HonorsStatuses::pluck('status')->toArray();
                    if (!in_array($value['position'], $existingStatus)) {
                        HonorsStatuses::create(['status' => $value['position']]);
                    }
                }

                if(isset($value['honor_achievement_award']) && !empty($value['honor_achievement_award'])){
                    $existingAward = HonorsAchievementAwards::pluck('award')->toArray();
                    if (!in_array($value['honor_achievement_award'], $existingAward)) {
                        HonorsAchievementAwards::create(['award' => $value['honor_achievement_award']]);
                    }
                }

                if(isset($value['grade']) && !empty($value['grade'])){
                    // foreach($value['grade'] as $grade){
                    //     if(!in_array($grade , $grade_ids)){
                    //         $grade_info = Grade::create([
                    //             'name' => $grade,
                    //             'user_id' => Auth::id()
                    //         ]);
                    //         $index = array_search($grade, $data['honors_data'][$key]['grade']);                    
                    //         $grade_array = array_replace($data['honors_data'][$key]['grade'], [$index => $grade_info->id]);
                    //         $data['honors_data'][$key]['grade'] = $grade_array;
                    //     }
                    // }  
                    $data['honors_data'][$key]['grade'] = $this->resumeService->createGrade($value['grade']);
                } else {
                    $data['honors_data'][$key]['grade'] = [];
                }
            }
        }

        if(!empty($data['honors_data'])){
            $data['honors_data'] = array_values($data['honors_data']);
        }
        
        $data['user_id'] = Auth::id();

        // dd($data);

        
        if (!empty($data)) {
            unset($data['honor']);
            unset($data['redirect_link']);
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
                
                if(isset($value['position']) && !empty($value['position'])){
                    $existingStatus = HonorsStatuses::pluck('status')->toArray();
                    if (!in_array($value['position'], $existingStatus)) {
                        HonorsStatuses::create(['status' => $value['position']]);
                    }
                }

                if(isset($value['honor_achievement_award']) && !empty($value['honor_achievement_award'])){
                    $existingAward = HonorsAchievementAwards::pluck('award')->toArray();
                    if (!in_array($value['honor_achievement_award'], $existingAward)) {
                        HonorsAchievementAwards::create(['award' => $value['honor_achievement_award']]);
                    }
                }

                if (isset($value['grade']) && !empty($value['grade'])) {
                    // foreach ($value['grade'] as $grade) {
                    //     if (!in_array($grade, $grade_ids)) {
                    //         $grade_info = Grade::create([
                    //             'name' => $grade,
                    //             'user_id' => Auth::id()
                    //         ]);
                    //         $index = array_search($grade, $data['honors_data'][$key]['grade']);
                    //         $grade_array = array_replace($data['honors_data'][$key]['grade'], [$index => $grade_info->id]);
                    //         $data['honors_data'][$key]['grade'] = $grade_array;
                    //     }
                    // }
                    $data['honors_data'][$key]['grade'] = $this->resumeService->createGrade($value['grade']);
                }
            }
        }
        if(!empty($data['honors_data'])){
            $data['honors_data'] = array_values($data['honors_data']);
        }

        
        if (!empty($data)) {
            $honor->update($data);

            //SBZ starts here
            //old logic starts
            // if($resume_id != null)
            // {
            //     return redirect("user/admin-dashboard/high-school-resume/activities?resume_id=".$resume_id);
            // }else{
            //     return redirect()->route('admin-dashboard.highSchoolResume.activities');
            // }
            //old logic Ends

            // new logic starts
            $redirect_link = $request->redirect_link;
            // echo "redirect_link = $redirect_link";
            // exit;
            if(!empty($redirect_link)){
                if (strpos($redirect_link, 'personal') !== false) {
                    if ($resume_id != null) {
                        return redirect("user/admin-dashboard/high-school-resume/personal-info?resume_id=" . $resume_id);
                    } else {
                        return redirect()->route('admin-dashboard.highSchoolResume.personalInfo');
                    }
                }
                else if (strpos($redirect_link, 'education') !== false) {
                    if($resume_id != null) {
                        return redirect("user/admin-dashboard/high-school-resume/education-info?resume_id=".$resume_id);
                    } else {
                        return redirect()->route('admin-dashboard.highSchoolResume.educationInfo');
                    }
                }
                else if (strpos($redirect_link, 'activities') !== false) {
                    if($resume_id != null)
                    {
                        return redirect("user/admin-dashboard/high-school-resume/activities?resume_id=".$resume_id);
                    }else{
                        return redirect()->route('admin-dashboard.highSchoolResume.activities');
                    }
                }
                else if (strpos($redirect_link, 'employment') !== false) {
                    if ($resume_id != null) {
                        return redirect('user/admin-dashboard/high-school-resume/employment-certifications?resume_id=' . $resume_id);
                    } else {
                        return redirect()->route('admin-dashboard.highSchoolResume.employmentCertification');
                    }
                }
                else if (strpos($redirect_link, 'features') !== false) {
                    if ($resume_id != null) {
                        return redirect("user/admin-dashboard/high-school-resume/features-attributes?resume_id=" . $resume_id);
                    } else {
                        return redirect()->route('admin-dashboard.highSchoolResume.featuresAttributes');
                    }
                } 
                else if (strpos($redirect_link, 'preview') !== false) {
                    if($resume_id != null) {
                        return redirect("user/admin-dashboard/high-school-resume/preview?resume_id=".$resume_id);
                    } else{
                        return redirect()->route('admin-dashboard.highSchoolResume.preview');
                    }
                }
                else {
                    if($resume_id != null) {
                        return redirect("user/admin-dashboard/high-school-resume/activities?resume_id=".$resume_id);
                    } else {
                        return redirect()->route('admin-dashboard.highSchoolResume.activities');
                    }
                }
            } else {
                if($resume_id != null) {
                    return redirect("user/admin-dashboard/high-school-resume/activities?resume_id=".$resume_id);
                } else {
                    return redirect()->route('admin-dashboard.highSchoolResume.activities');
                }
            }
            // new logic Ends
            //SBZ Ends here
        }
    }
}
