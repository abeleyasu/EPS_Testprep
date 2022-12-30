<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\EducationRequest;
use App\Models\CollegeInformation;
use App\Models\EducationCourse;
use App\Models\Grade;
use App\Models\HighSchoolResume;
use App\Models\HighSchoolResume\Activity;
use App\Models\HighSchoolResume\Education;
use App\Models\HighSchoolResume\EmploymentCertification;
use App\Models\HighSchoolResume\FeaturedAttribute;
use App\Models\HighSchoolResume\Honor;
use App\Models\IntendedCollegeList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class EducationController extends Controller
{
    public function index(Request $request)
    {
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
            $education = Education::whereUserId($user_id)->where('is_draft', 0)->first();
            $honor = Honor::whereUserId($user_id)->where('is_draft', 0)->first();
            $activity = Activity::whereUserId($user_id)->where('is_draft', 0)->first();
            $employmentCertification = EmploymentCertification::whereUserId($user_id)->where('is_draft', 0)->first();
            $featuredAttribute = FeaturedAttribute::whereUserId($user_id)->where('is_draft', 0)->first();
        }
        $courses_list = EducationCourse::all();
        $colleges_list = CollegeInformation::all();

        $validations_rules = Config::get('validation.educations.rules');
        $validations_messages = Config::get('validation.educations.messages');

        $grades = Grade::all();

        $intended_major = IntendedCollegeList::whereType('1')->get();
        $intended_minor = IntendedCollegeList::whereType('2')->get();

        $details = 0;
        return view('user.admin-dashboard.high-school-resume.education-info', compact('education', 'honor', 'activity', 'employmentCertification', 'featuredAttribute', 'courses_list', 'details', 'resume_id', 'validations_rules', 'validations_messages', 'colleges_list', 'grades', 'intended_major', 'intended_minor'));
    }

    public function store(EducationRequest $request)
    {
        $data = $request->validated();
        $grade_ids = Grade::pluck('id')->toArray();

        $gpa_unweighted = sprintf("%.2f", $data['cumulative_gpa_unweighted']);
        $gpa_weighted = sprintf("%.2f", $data['cumulative_gpa_weighted']);

        if (!empty($data['current_grade'])) {
            foreach ($data['current_grade'] as $grade) {
                if (!in_array($grade, $grade_ids)) {
                    $grade_info = Grade::create(['name' => $grade]);
                    $index = array_search($grade, $data['current_grade']);
                    $grade_array = array_replace($data['current_grade'], [$index => $grade_info->id]);
                    $data['current_grade'] = $grade_array;
                }
            }
        }

        $intended_major_ids = IntendedCollegeList::whereType('1')->pluck('id')->toArray();
        $intended_minor_ids = IntendedCollegeList::whereType('2')->pluck('id')->toArray();
        
        if(!empty($data['intended_college_major'])){
            foreach ($data['intended_college_major'] as $major) {
                if (!in_array($major, $intended_major_ids)) {                
                    $major_info = IntendedCollegeList::create(['name' => $major,'type' => 1]);                
                    $index = array_search($major, $data['intended_college_major']);                
                    $major_array = array_replace($data['intended_college_major'], [$index => $major_info->id]);
                    $data['intended_college_major'] = $major_array;
                }
            }
        }

        if(!empty($data['intended_college_minor'])){
            foreach ($data['intended_college_minor'] as $minor) {            
                if (!in_array($minor, $intended_minor_ids)) {                
                    $minor_info = IntendedCollegeList::create(['name' => $minor,'type' => 2]);                
                    $index = array_search($minor, $data['intended_college_minor']);                
                    $minor_array = array_replace($data['intended_college_minor'], [$index => $minor_info->id]);                
                    $data['intended_college_minor'] = $minor_array;
                }
            }
        }
        
        if (!empty($data['cumulative_gpa_unweighted'])) {
            $data['cumulative_gpa_unweighted'] = $gpa_unweighted;
        }

        if (!empty($data['cumulative_gpa_weighted'])) {
            $data['cumulative_gpa_weighted'] = $gpa_weighted;
        }

        if (!empty($data['intended_college_major'])) {
            $data['intended_college_major'] = json_encode($data['intended_college_major']);
        }

        if (!empty($data['intended_college_minor'])) {
            $data['intended_college_minor'] = json_encode($data['intended_college_minor']);
        }

        if (!empty($data['current_grade'])) {
            $data['current_grade'] = json_encode($data['current_grade']);
        }

        if (!empty($request->honor_course_data)) {
            $data['honor_course_data'] = array_values($request->honor_course_data);
        }

        if (!empty($request->testing_data)) {
            $data['testing_data'] = array_values($request->testing_data);
        }

        if (!empty($request->ib_courses)) {
            $data['ib_courses'] = json_encode($request->ib_courses);
        }

        if (!empty($request->ap_courses)) {
            $data['ap_courses'] = json_encode($request->ap_courses);
        }

        if (!empty($request->course_data)) {
            $data['course_data'] = array_values($request->course_data);
        }
        $data['user_id'] = Auth::id();

        if (!empty($data)) {
            Education::create($data);
            return redirect()->route('admin-dashboard.highSchoolResume.honors');
        }
    }

    public function update(EducationRequest $request, Education $education)
    {
        $data = $request->validated();

        $gpa_unweighted = sprintf("%.2f", $data['cumulative_gpa_unweighted']);
        $gpa_weighted = sprintf("%.2f", $data['cumulative_gpa_weighted']);

        $grade_ids = Grade::pluck('id')->toArray();

        if(!empty($data['current_grade'])){
            foreach ($data['current_grade'] as $grade) {
                if (!in_array($grade, $grade_ids)) {
                    $grade_info = Grade::create(['name' => $grade]);
                    $index = array_search($grade, $data['current_grade']);
                    $grade_array = array_replace($data['current_grade'], [$index => $grade_info->id]);
                    $data['current_grade'] = $grade_array;
                }
            }
        }
        $intended_major_ids = IntendedCollegeList::whereType('1')->pluck('id')->toArray();
        $intended_minor_ids = IntendedCollegeList::whereType('2')->pluck('id')->toArray();
        if(!empty($data['intended_college_major'])){
            foreach ($data['intended_college_major'] as $major) {            
                if (!in_array($major, $intended_major_ids)) {                
                    $major_info = IntendedCollegeList::create(['name' => $major,'type' => 1]);                
                    $index = array_search($major, $data['intended_college_major']);                
                    $major_array = array_replace($data['intended_college_major'], [$index => $major_info->id]);                
                    $data['intended_college_major'] = $major_array;
                }
            }
        }
        if (!empty(['intended_college_minor'])) {
            foreach ($data['intended_college_minor'] as $minor) {
                if (!in_array($minor, $intended_minor_ids)) {
                    $minor_info = IntendedCollegeList::create(['name' => $minor, 'type' => 2]);
                    $index = array_search($minor, $data['intended_college_minor']);
                    $minor_array = array_replace($data['intended_college_minor'], [$index => $minor_info->id]);
                    $data['intended_college_minor'] = $minor_array;
                }
            }
        }

        $resume_id = isset($request->resume_id) ? $request->resume_id : null;

        if (!empty($data['cumulative_gpa_unweighted'])) {
            $data['cumulative_gpa_unweighted'] = $gpa_unweighted;
        }

        if (!empty($data['cumulative_gpa_weighted'])) {
            $data['cumulative_gpa_weighted'] = $gpa_weighted;
        }

        if (!empty($data['intended_college_major'])) {
            $data['intended_college_major'] = json_encode($data['intended_college_major']);
        }


        if (!empty($data['intended_college_minor'])) {
            $data['intended_college_minor'] = json_encode($data['intended_college_minor']);
        }

        if (!empty($data['current_grade'])) {
            $data['current_grade'] = json_encode($data['current_grade']);
        }

        if (!empty($request->honor_course_data)) {
            $data['honor_course_data'] = array_values($request->honor_course_data);
        }

        if (!empty($request->testing_data)) {
            $data['testing_data'] = array_values($request->testing_data);
        }

        if (!empty($request->ib_courses)) {
            $data['ib_courses'] = json_encode($request->ib_courses);
        }

        if (!empty($request->ap_courses)) {
            $data['ap_courses'] = json_encode($request->ap_courses);
        }

        if (!empty($request->course_data)) {
            $data['course_data'] = array_values($request->course_data);
        }
        if (!empty($data)) {
            $education->update($data);
            if ($resume_id != null) {
                return redirect("user/admin-dashboard/high-school-resume/honors?resume_id=" . $resume_id);
            } else {
                return redirect()->route('admin-dashboard.highSchoolResume.honors');
            }
        }
    }
}
