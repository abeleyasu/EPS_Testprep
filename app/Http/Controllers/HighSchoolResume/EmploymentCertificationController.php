<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\EmploymentCertificationRequest;
use App\Models\Grade;
use App\Models\HighSchoolResume;
use App\Models\HighSchoolResume\EmploymentCertification;
use App\Models\HighSchoolResume\FeaturedAttribute;
use App\Models\HighSchoolResume\DemonstratedPositions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use App\Service\ResumeService;

class EmploymentCertificationController extends Controller
{
    protected $resumeService;

    public function __construct(ResumeService $resumeService) {
        $this->resumeService = $resumeService;
    }

    public function index(Request $request)
    {
        try {
            $resume_id = $request->resume_id;
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
                $employmentCertification = EmploymentCertification::whereUserId($user_id)->where('is_draft', 0)->first();
                $featuredAttribute = FeaturedAttribute::whereUserId($user_id)->where('is_draft', 0)->first();
            }
            $details = 0;
            $grades = $this->resumeService->getEmploymentCertification();
            $validations_rules = Config::get('validation.employment_certifications.rules');
            $validations_messages = Config::get('validation.employment_certifications.messages');
            $demonstrated_positions = DemonstratedPositions::select('position_name')->orderBY('position_name', 'asc')->get();
            return view('user.admin-dashboard.high-school-resume.employment-certification', compact('employmentCertification', 'featuredAttribute', 'details', 'resume_id', 'grades', 'demonstrated_positions', 'validations_rules', 'validations_messages'));
        } catch (\Throwable $th) {
            Log::info($th);
        }
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'employment_data',
            'significant_data',
        ]);

        $grade_ids = Grade::pluck('id')->toArray();

        if (!empty($data['employment_data'])) {
            foreach ($data['employment_data'] as $key => $value) {
                if(isset($value['job_title']) && !empty($value['job_title'])){
                    $existingPosition = DemonstratedPositions::pluck('position_name')->toArray();
                    if (!in_array($value['job_title'], $existingPosition)) {
                        DemonstratedPositions::create(['position_name' => $value['job_title']]);
                    }
                }
                if (isset($value['grade']) && !empty(array_filter($value))) {
                    $data['employment_data'][$key]['grade'] = $this->resumeService->createGrade($value['grade'], config('constants.grades_types.employment_grades'));
                } else {
                    $data['employment_data'][$key]['grade'] = [];
                }
            }
            $data['employment_data'] = array_values($data['employment_data']);
        }

        if (!empty($data['significant_data'])) {
            foreach ($data['significant_data'] as $key => $value) {
                if (isset($value['grade']) && !empty(array_filter($value))) {
                    $data['significant_data'][$key]['grade'] = $this->resumeService->createGrade($value['grade'], config('constants.grades_types.other_significant_grades'));
                } else {
                    $data['significant_data'][$key]['grade'] = [];
                }
            }
            $data['significant_data'] = array_values($data['significant_data']);
        }

        $data['user_id'] = Auth::id();

        if (!empty($data)) {
            EmploymentCertification::create($data);
            return redirect()->route('admin-dashboard.highSchoolResume.featuresAttributes');
        }
    }

    public function update(Request $request, EmploymentCertification $employmentCertification)
    {
        $data = $request->only([
            'employment_data',
            'significant_data',
        ]);
        $resume_id = isset($request->resume_id) ? $request->resume_id : null;

        $grade_ids = Grade::pluck('id')->toArray();

        if (!empty($data['employment_data'])) {
            foreach ($data['employment_data'] as $key => $value) {
                if(isset($value['job_title']) && !empty($value['job_title'])){
                    $existingPosition = DemonstratedPositions::pluck('position_name')->toArray();
                    if (!in_array($value['job_title'], $existingPosition)) {
                        DemonstratedPositions::create(['position_name' => $value['job_title']]);
                    }
                }
                if (isset($value['grade']) && !empty(array_filter($value))) {
                    $data['employment_data'][$key]['grade'] = $this->resumeService->createGrade($value['grade'], config('constants.grades_types.employment_grades'));
                } else {
                    $data['employment_data'][$key]['grade'] = [];
                }
            }
            $data['employment_data'] = array_values($data['employment_data']);
        }

        if (!empty($data['significant_data'])) {
            foreach ($data['significant_data'] as $key => $value) {
                if (isset($value['grade']) && !empty(array_filter($value))) {
                    $data['significant_data'][$key]['grade'] = $this->resumeService->createGrade($value['grade'], config('constants.grades_types.other_significant_grades'));
                } else {
                    $data['significant_data'][$key]['grade'] = [];
                }
            }
            $data['significant_data'] = array_values($data['significant_data']);
        }

        if (!empty($data)) {
            $employmentCertification->update($data);
            //SBZ starts here
            //old logic starts
            // if ($resume_id != null) {
            //     return redirect("user/admin-dashboard/high-school-resume/features-attributes?resume_id=" . $resume_id);
            // } else {
            //     return redirect()->route('admin-dashboard.highSchoolResume.featuresAttributes');
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
                else if (strpos($redirect_link, 'activities') !== false) {
                    if($resume_id != null) {
                        return redirect("user/admin-dashboard/high-school-resume/activities?resume_id=".$resume_id);
                    } else {
                        return redirect()->route('admin-dashboard.highSchoolResume.activities');
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
                    if ($resume_id != null) {
                        return redirect("user/admin-dashboard/high-school-resume/features-attributes?resume_id=" . $resume_id);
                    } else {
                        return redirect()->route('admin-dashboard.highSchoolResume.featuresAttributes');
                    }
                }
            }
            else {
                if ($resume_id != null) {
                    return redirect("user/admin-dashboard/high-school-resume/features-attributes?resume_id=" . $resume_id);
                } else {
                    return redirect()->route('admin-dashboard.highSchoolResume.featuresAttributes');
                }
            }
            // new logic ends
            //SBZ ends here
        }
    }
}
