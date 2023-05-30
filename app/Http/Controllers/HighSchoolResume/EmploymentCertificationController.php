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

class EmploymentCertificationController extends Controller
{
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
            $grades = Grade::all();
            $validations_rules = Config::get('validation.employment_certifications.rules');
            $validations_messages = Config::get('validation.employment_certifications.messages');
            $demonstrated_positions = DemonstratedPositions::select('position_name')->orderBY('position_name', 'asc')->get();
            return view('user.admin-dashboard.high-school-resume.employment-certification', compact('employmentCertification', 'featuredAttribute', 'details', 'resume_id', 'grades', 'demonstrated_positions', 'validations_rules', 'validations_messages'));
        } catch (\Throwable $th) {
            Log::info($th);
        }
    }

    public function store(EmploymentCertificationRequest $request)
    {
        $data = $request->validated();

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
                    foreach ($value['grade'] as $grade) {
                        if (!in_array($grade, $grade_ids)) {
                            $grade_info = Grade::create(['name' => $grade]);
                            $index = array_search($grade, $data['employment_data'][$key]['grade']);
                            $grade_array = array_replace($data['employment_data'][$key]['grade'], [$index => $grade_info->id]);
                            $data['employment_data'][$key]['grade'] = $grade_array;
                        }
                    }
                }
            }
            $data['employment_data'] = array_values($data['employment_data']);
        }

        if (!empty($data['significant_data'])) {
            foreach ($data['significant_data'] as $key => $value) {
                if (isset($value['grade']) && !empty(array_filter($value))) {
                    foreach ($value['grade'] as $grade) {
                        if (!in_array($grade, $grade_ids)) {
                            $grade_info = Grade::create(['name' => $grade]);
                            $index = array_search($grade, $data['significant_data'][$key]['grade']);
                            $grade_array = array_replace($data['significant_data'][$key]['grade'], [$index => $grade_info->id]);
                            $data['significant_data'][$key]['grade'] = $grade_array;
                        }
                    }
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

    public function update(EmploymentCertificationRequest $request, EmploymentCertification $employmentCertification)
    {
        $data = $request->validated();
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
                    foreach ($value['grade'] as $grade) {
                        if (!in_array($grade, $grade_ids)) {
                            $grade_info = Grade::create(['name' => $grade]);
                            $index = array_search($grade, $data['employment_data'][$key]['grade']);
                            $grade_array = array_replace($data['employment_data'][$key]['grade'], [$index => $grade_info->id]);
                            $data['employment_data'][$key]['grade'] = $grade_array;
                        }
                    }
                }
            }
            $data['employment_data'] = array_values($data['employment_data']);
        }

        if (!empty($data['significant_data'])) {
            foreach ($data['significant_data'] as $key => $value) {
                if (isset($value['grade']) && !empty(array_filter($value))) {
                    foreach ($value['grade'] as $grade) {
                        if (!in_array($grade, $grade_ids)) {
                            $grade_info = Grade::create(['name' => $grade]);
                            $index = array_search($grade, $data['significant_data'][$key]['grade']);
                            $grade_array = array_replace($data['significant_data'][$key]['grade'], [$index => $grade_info->id]);
                            $data['significant_data'][$key]['grade'] = $grade_array;
                        }
                    }
                }
            }
            $data['significant_data'] = array_values($data['significant_data']);
        }

        if (!empty($data)) {
            $employmentCertification->update($data);
            if ($resume_id != null) {
                return redirect("user/admin-dashboard/high-school-resume/features-attributes?resume_id=" . $resume_id);
            } else {
                return redirect()->route('admin-dashboard.highSchoolResume.featuresAttributes');
            }
        }
    }
}
