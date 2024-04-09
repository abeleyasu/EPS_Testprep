<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\ActivityRequest;
use App\Models\Grade;
use App\Models\HighSchoolResume;
use App\Models\HighSchoolResume\Activity;
use App\Models\HighSchoolResume\EmploymentCertification;
use App\Models\HighSchoolResume\FeaturedAttribute;
use App\Models\HighSchoolResume\DemonstratedPositions;
use App\Models\HighSchoolResume\HonorsStatuses;
use App\Models\HighSchoolResume\LeadershipOrganization;
use App\Models\HighSchoolResume\Athletics_positions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Service\ResumeService;

class ActivityController extends Controller
{
    protected $resumeService;

    public function __construct(ResumeService $resumeService) {
        $this->resumeService = $resumeService;
    }

    public function index(Request $request)
    {
        $resume_id = $request->resume_id;
        // $demonstrated_positions = Config::get('constants.demonstrated_positions');
        $demonstrated_positions = DemonstratedPositions::select('position_name')->orderBY('position_name', 'asc')->get();
        $status = HonorsStatuses::select('id','status')->orderBY('status', 'asc')->get();

        if (isset($resume_id) && $resume_id != null) {
            $resumedata = HighSchoolResume::where('id', $resume_id)->with([
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
        $grades = $this->resumeService->getGradesForActivities();

        $validations_rules = Config::get('validation.activities.rules');
        $validations_messages = Config::get('validation.activities.messages');
        // $organizations = Config::get('constants.leadership_organization');
        $organizations = LeadershipOrganization::select('name')->get();
        // $athletics_positions = Config::get('constants.athletics_position');
        $athletics_positions = Athletics_positions::select('position')->get();

        $details = 0;
        return view('user.admin-dashboard.high-school-resume.activities', compact('activity', 'employmentCertification', 'featuredAttribute', 'details', 'resume_id', 'validations_rules', 'validations_messages', 'grades','demonstrated_positions','organizations','athletics_positions', 'status'));
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'demonstrated_data',
            'leadership_data',
            'activities_data',
            'athletics_data',
            'community_service_data',
        ]);
        
        $grade_ids = Grade::pluck('id')->toArray();

        if (isset($data['demonstrated_data']) && !empty($data['demonstrated_data'])) {
            foreach ($data['demonstrated_data'] as $key => $value) {

                if(isset($value['position']) && !empty($value['position'])){
                    $existingPosition = DemonstratedPositions::pluck('position_name')->toArray();
                    if (!in_array($value['position'], $existingPosition)) {
                        DemonstratedPositions::create(['position_name' => $value['position']]);
                    }
                }

                if (isset($value['grade']) && !empty(array_filter($value))) {
                    $data['demonstrated_data'][$key]['grade'] = $this->resumeService->createGrade($value['grade'], config('constants.grades_types.demonstrated_grades'));
                } else {
                    $data['demonstrated_data'][$key]['grade'] = [];
                }
            }
            $data['demonstrated_data'] = array_values($data['demonstrated_data']);
        }


        if (isset($data['leadership_data']) && !empty($data['leadership_data'])) {
            foreach ($data['leadership_data'] as $key => $value) {

                if(isset($value['status']) && !empty($value['status'])){
                    $existingStatus = HonorsStatuses::pluck('status')->toArray();
                    if (!in_array($value['status'], $existingStatus)) {
                        HonorsStatuses::create(['status' => $value['status']]);
                    }
                }

                if(isset($value['position']) && !empty($value['position'])){
                    $existingPosition = DemonstratedPositions::pluck('position_name')->toArray();
                    if (!in_array($value['position'], $existingPosition)) {
                        DemonstratedPositions::create(['position_name' => $value['position']]);
                    }
                }

                if(isset($value['organization']) && !empty($value['organization'])){
                    $existingLO = LeadershipOrganization::pluck('name')->toArray();
                    if (!in_array($value['organization'], $existingLO)) {
                        LeadershipOrganization::create(['name' => $value['organization']]);
                    }
                }
                
                if (isset($value['grade']) && !empty(array_filter($value))) {
                    $data['leadership_data'][$key]['grade'] = $this->resumeService->createGrade($value['grade'], config('constants.grades_types.leadership_grades'));
                } else {
                    $data['leadership_data'][$key]['grade'] = [];
                }
            }
            $data['leadership_data'] = array_values($data['leadership_data']);
        }

        if (isset($data['activities_data']) && !empty($data['activities_data'])) {
            foreach ($data['activities_data'] as $key => $value) {
                
                if(isset($value['position']) && !empty($value['position'])){
                    $existingPosition = DemonstratedPositions::pluck('position_name')->toArray();
                    if (!in_array($value['position'], $existingPosition)) {
                        DemonstratedPositions::create(['position_name' => $value['position']]);
                    }
                }

                if(isset($value['activity']) && !empty($value['activity'])){
                    $existingLO = LeadershipOrganization::pluck('name')->toArray();
                    if (!in_array($value['activity'], $existingLO)) {
                        LeadershipOrganization::create(['name' => $value['activity']]);
                    }
                }
                
                if (isset($value['grade']) && !empty(array_filter($value))) {
                    $data['activities_data'][$key]['grade'] = $this->resumeService->createGrade($value['grade'], config('constants.grades_types.activities_grades'));
                } else {
                    $data['activities_data'][$key]['grade'] = [];
                }
            }
            $data['activities_data'] = array_values($data['activities_data']);
        }

        if (isset($data['athletics_data']) && !empty($data['athletics_data'])) {
            foreach ($data['athletics_data'] as $key => $value) {
                
                if(isset($value['position']) && !empty($value['position'])){
                    $existingPosition = DemonstratedPositions::pluck('position_name')->toArray();
                    if (!in_array($value['position'], $existingPosition)) {
                        DemonstratedPositions::create(['position_name' => $value['position']]);
                    }
                }

                if(isset($value['activity']) && !empty($value['activity'])){
                    $existingAP = Athletics_positions::pluck('position')->toArray();
                    if (!in_array($value['activity'], $existingAP)) {
                        Athletics_positions::create(['position' => $value['activity']]);
                    }
                }
                
                if (isset($value['grade']) && !empty(array_filter($value))) {
                    $data['athletics_data'][$key]['grade'] = $this->resumeService->createGrade($value['grade'], config('constants.grades_types.athletics_grades'));
                } else {
                    $data['athletics_data'][$key]['grade'] = [];
                }
            }
            $data['athletics_data'] = array_values($data['athletics_data']);
        }

        if (isset($data['community_service_data']) && !empty($data['community_service_data'])) {
            foreach ($data['community_service_data'] as $key => $value) {
                
                if(isset($value['level']) && !empty($value['level'])){
                    $existingPosition = DemonstratedPositions::pluck('position_name')->toArray();
                    if (!in_array($value['level'], $existingPosition)) {
                        DemonstratedPositions::create(['position_name' => $value['level']]);
                    }
                }
                
                if (isset($value['grade']) && !empty(array_filter($value))) {
                    $data['community_service_data'][$key]['grade'] = $this->resumeService->createGrade($value['grade'], config('constants.grades_types.community_service_grades'));
                } else {
                    $data['community_service_data'][$key]['grade'] = [];
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

    public function update(Request $request, Activity $activity)
    {

        $data = $request->only([
            'demonstrated_data',
            'leadership_data',
            'activities_data',
            'athletics_data',
            'community_service_data',
        ]);
        $resume_id = isset($request->resume_id) ? $request->resume_id : null;
        $grade_ids = Grade::pluck('id')->toArray();

        if (isset($data['demonstrated_data']) && !empty($data['demonstrated_data'])) {
            foreach ($data['demonstrated_data'] as $key => $value) {

                if(isset($value['position']) && !empty($value['position'])){
                    $existingPosition = DemonstratedPositions::pluck('position_name')->toArray();
                    if (!in_array($value['position'], $existingPosition)) {
                        DemonstratedPositions::create(['position_name' => $value['position']]);
                    }
                }

                if (isset($value['grade']) && !empty(array_filter($value))) {
                    $data['demonstrated_data'][$key]['grade'] = $this->resumeService->createGrade($value['grade'], config('constants.grades_types.demonstrated_grades'));
                } else {
                    $data['demonstrated_data'][$key]['grade'] = [];
                }
            }
            $data['demonstrated_data'] = array_values($data['demonstrated_data']);
        }

        if (isset($data['leadership_data']) && !empty($data['leadership_data'])) {
            foreach ($data['leadership_data'] as $key => $value) {

                if(isset($value['status']) && !empty($value['status'])){
                    $existingStatus = HonorsStatuses::pluck('status')->toArray();
                    if (!in_array($value['status'], $existingStatus)) {
                        HonorsStatuses::create(['status' => $value['status']]);
                    }
                }

                if(isset($value['position']) && !empty($value['position'])){
                    $existingPosition = DemonstratedPositions::pluck('position_name')->toArray();
                    if (!in_array($value['position'], $existingPosition)) {
                        DemonstratedPositions::create(['position_name' => $value['position']]);
                    }
                }

                if(isset($value['organization']) && !empty($value['organization'])){
                    $existingLO = LeadershipOrganization::pluck('name')->toArray();
                    if (!in_array($value['organization'], $existingLO)) {
                        LeadershipOrganization::create(['name' => $value['organization']]);
                    }
                }

                if (isset($value['grade']) && !empty(array_filter($value))) {
                    $data['leadership_data'][$key]['grade'] = $this->resumeService->createGrade($value['grade'], config('constants.grades_types.leadership_grades'));
                } else {
                    $data['leadership_data'][$key]['grade'] = [];
                }
            }
            $data['leadership_data'] = array_values($data['leadership_data']);
        }

        if (isset($data['activities_data']) && !empty($data['activities_data'])) {
            foreach ($data['activities_data'] as $key => $value) {

                if(isset($value['position']) && !empty($value['position'])){
                    $existingPosition = DemonstratedPositions::pluck('position_name')->toArray();
                    if (!in_array($value['position'], $existingPosition)) {
                        DemonstratedPositions::create(['position_name' => $value['position']]);
                    }
                }

                if(isset($value['activity']) && !empty($value['activity'])){
                    $existingLO = LeadershipOrganization::pluck('name')->toArray();
                    if (!in_array($value['activity'], $existingLO)) {
                        LeadershipOrganization::create(['name' => $value['activity']]);
                    }
                }

                if (isset($value['grade']) && !empty(array_filter($value))) {
                    $data['activities_data'][$key]['grade'] = $this->resumeService->createGrade($value['grade'], config('constants.grades_types.activities_grades'));
                } else {
                    $data['activities_data'][$key]['grade'] = [];
                }
            }
            $data['activities_data'] = array_values($data['activities_data']);
        }

        if (isset($data['athletics_data']) && !empty($data['athletics_data'])) {
            foreach ($data['athletics_data'] as $key => $value) {

                if(isset($value['position']) && !empty($value['position'])){
                    $existingPosition = DemonstratedPositions::pluck('position_name')->toArray();
                    if (!in_array($value['position'], $existingPosition)) {
                        DemonstratedPositions::create(['position_name' => $value['position']]);
                    }
                }

                if(isset($value['activity']) && !empty($value['activity'])){
                    $existingAP = Athletics_positions::pluck('position')->toArray();
                    if (!in_array($value['activity'], $existingAP)) {
                        Athletics_positions::create(['position' => $value['activity']]);
                    }
                }
                
                if (isset($value['grade']) && !empty(array_filter($value))) {
                    $data['athletics_data'][$key]['grade'] = $this->resumeService->createGrade($value['grade'], config('constants.grades_types.athletics_grades'));
                } else {
                    $data['athletics_data'][$key]['grade'] = [];
                }
            }
            $data['athletics_data'] = array_values($data['athletics_data']);
        }

        if (isset($data['community_service_data']) && !empty($data['community_service_data'])) {
            foreach ($data['community_service_data'] as $key => $value) {

                if(isset($value['level']) && !empty($value['level'])){
                    $existingPosition = DemonstratedPositions::pluck('position_name')->toArray();
                    if (!in_array($value['level'], $existingPosition)) {
                        DemonstratedPositions::create(['position_name' => $value['level']]);
                    }
                }

                if (isset($value['grade']) && !empty(array_filter($value))) {
                    $data['community_service_data'][$key]['grade'] = $this->resumeService->createGrade($value['grade'], config('constants.grades_types.community_service_grades'));
                } else {
                    $data['community_service_data'][$key]['grade'] = [];
                }
            }
            $data['community_service_data'] = array_values($data['community_service_data']);
        }

        if (!empty($data)) {
            $activity->update($data);
            //SBZ starts here
            //old logic starts
            // if ($resume_id != null) {
            //     return redirect('user/admin-dashboard/high-school-resume/employment-certifications?resume_id=' . $resume_id);
            // } else {
            //     return redirect()->route('admin-dashboard.highSchoolResume.employmentCertification');
            // }
            //old logic ends

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
                else if (strpos($redirect_link, 'honors') !== false) {
                    if ($resume_id != null) {
                        return redirect("user/admin-dashboard/high-school-resume/honors?resume_id=" . $resume_id);
                    } else {
                        return redirect()->route('admin-dashboard.highSchoolResume.honors');
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
                else{
                    if ($resume_id != null) {
                        return redirect('user/admin-dashboard/high-school-resume/employment-certifications?resume_id=' . $resume_id);
                    } else {
                        return redirect()->route('admin-dashboard.highSchoolResume.employmentCertification');
                    }
                }
            }
            else {
                if ($resume_id != null) {
                    return redirect('user/admin-dashboard/high-school-resume/employment-certifications?resume_id=' . $resume_id);
                } else {
                    return redirect()->route('admin-dashboard.highSchoolResume.employmentCertification');
                }
            }
            // new logic ends
            //SBZ ends here
        }
    }
}
