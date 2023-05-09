<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\EducationRequest;
use App\Models\CollegeInformation;
use App\Models\EducationCourse;
use App\Models\HonorCourseNameList;
use App\Models\Grade;
use App\Models\HighSchoolResume;
use App\Models\HighSchoolResume\Activity;
use App\Models\HighSchoolResume\Education;
use App\Models\HighSchoolResume\EmploymentCertification;
use App\Models\HighSchoolResume\FeaturedAttribute;
use App\Models\HighSchoolResume\Honor;
use App\Models\HighSchoolResume\States;
use App\Models\HighSchoolResume\Cities;
use App\Models\IntendedCollegeList;
use App\Models\HighSchoolResume\GraduationDesignation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class EducationController extends Controller
{
    public function index(Request $request)
    {
        $resume_id = $request->resume_id;
        //$states = Config::get('constants.states');
		$states = States::select('id','state_name')->orderBY('state_name', 'asc')->get();
		$cities = array();
        $ib_courses = Config::get('constants.ib_courses');
        $ap_courses = Config::get('constants.ap_courses');

        // $graduation_designations = Config::get('constants.graduation_designation');
        $graduation_designations = GraduationDesignation::select('id','designation')->orderBY('designation', 'asc')->get();

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
            
            if(isset($education->high_school_state) && !empty($education->high_school_state)){
                $cities = Cities::from('cities as ct')
						->join('states as st', function ($join) use($education){
									$join->on('ct.state_id', '=', 'st.id')
										 ->where('st.state_name', '=',$education->high_school_state);
						})
						->select('ct.id', 'ct.city_name')
						->get();
            }
        } else {
            $user_id = Auth::id();
            $education = Education::whereUserId($user_id)->where('is_draft', 0)->first();
			if (!empty($education))
			{
				$cities = Cities::from('cities as ct')
						->join('states as st', function ($join) use($education){
									$join->on('ct.state_id', '=', 'st.id')
										 ->where('st.state_name', '=',$education->high_school_state)
										 ->where('ct.city_name', '=',$education->high_school_city);
						})
						->select('ct.id', 'ct.city_name')
						->get();
			}
            $honor = Honor::whereUserId($user_id)->where('is_draft', 0)->first();
            $activity = Activity::whereUserId($user_id)->where('is_draft', 0)->first();
            $employmentCertification = EmploymentCertification::whereUserId($user_id)->where('is_draft', 0)->first();
            $featuredAttribute = FeaturedAttribute::whereUserId($user_id)->where('is_draft', 0)->first();
        }

        $user = Auth::user();

        if($user->role == 1) {   
            $college_list = CollegeInformation::all();
            $courses_list = EducationCourse::all();
            $honors_course_list = HonorCourseNameList::all();
        } else {
            $colleges_list = CollegeInformation::whereNull('user_id')->orWhere('user_id' , Auth::id())->get();
            $courses_list = EducationCourse::whereNull('user_id')->orWhere('user_id' , Auth::id())->get();
            $honors_course_list = HonorCourseNameList::whereNull('user_id')->orWhere('user_id' , Auth::id())->get();
        }

        $validations_rules = Config::get('validation.educations.rules');
        $validations_messages = Config::get('validation.educations.messages');

        $grades = Grade::all();

        $intended_major = IntendedCollegeList::whereType('1')->orderBy('name','ASC')->get();
        $intended_minor = IntendedCollegeList::whereType('2')->orderBy('name','ASC')->get();

        $details = 0;
        return view('user.admin-dashboard.high-school-resume.education-info', compact('education', 'honor', 'activity', 'employmentCertification', 'featuredAttribute', 'courses_list', 'details', 'resume_id', 'validations_rules', 'validations_messages', 'colleges_list', 'grades', 'intended_major', 'intended_minor','honors_course_list' ,'states', 'graduation_designations','cities'));
    }

    public function store(EducationRequest $request)
    {
        $data = $request->validated();
        // echo 'store<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;

        $college_ids = CollegeInformation::pluck('id')->toArray();

        if(isset($data['course_data']) && !empty($data['course_data'])){
            foreach ($data['course_data'] as $key1 => $course_data) {
                if (isset($course_data['search_college_name']) && !empty($course_data['search_college_name'])) {
                    foreach ($course_data['search_college_name'] as $key => $college_name) {
                        if (!in_array($college_name, $college_ids)) {
                            $college_info = CollegeInformation::create(['name' => $college_name, 'user_id' => Auth::id()]);
                            $index = array_search($college_name, $course_data['search_college_name']);
                            $college_array = array_replace($course_data['search_college_name'], [$index => $college_info->id]);
                            $course_data['search_college_name'] = $college_array;
                        }
                    }
                }
                $data['course_data'][$key1] = $course_data;
            }
        }

        $honor_course_name_ids = HonorCourseNameList::pluck('id')->toArray();

        if(isset($data['honor_course_data']) && !empty($data['honor_course_data'])){
            foreach ($data['honor_course_data'] as $key1 => $course_name) {
                if(isset($course_name['course_data']) && !empty($course_name['course_data'])){
                    foreach($course_name['course_data'] as $key => $course){
                        if(!in_array($course ,$honor_course_name_ids)){
                            $course_name_info = HonorCourseNameList::create(['name' => $course, 'user_id' => Auth::id()]);
                            $index = array_search($course, $course_name['course_data']);
                            $course_name_array = array_replace($course_name['course_data'], [$index => $course_name_info->id]);
                            $course_name['course_data'] = $course_name_array;
                        }
                    }
                }
                $data['honor_course_data'][$key1] = $course_name;
            }
        }

        $education_courses_ids = EducationCourse::pluck('name')->toArray();

        if(isset($data['ib_courses']) && !empty($data['ib_courses'])){
            foreach($data['ib_courses'] as $ib_data){
                // if(!in_array($ib_data, $education_courses_ids)){
                //     $ib_info = EducationCourse::create(['name' => $ib_data , 'course_type' => 1 , 'user_id' => Auth::id()])  ;                
                //     $index = array_search($ib_data, $data['ib_courses']);
                //     $ib_array = array_replace($data['ib_courses'], [$index => $ib_info->id]);
                //     $data['ib_courses'] = $ib_array;
                // }
                if(isset($ib_data['name_of_ib_course']) && !empty($ib_data['name_of_ib_course'])){
                    if(!in_array($ib_data['name_of_ib_course'], $education_courses_ids)){
                        EducationCourse::create(['name' => $ib_data['name_of_ib_course'] , 'course_type' => 1 , 'user_id' => Auth::id()]);
                    }
                }
            }
        }

        if(isset($data['ap_courses']) && !empty($data['ap_courses'])){
            foreach($data['ap_courses'] as $ap_data){
                // if(!in_array($ap_data, $education_courses_ids)){
                //     $ap_info = EducationCourse::create(['name' => $ap_data , 'course_type' => 2 , 'user_id' => Auth::id()])  ;                
                //     $index = array_search($ap_data, $data['ap_courses']);
                //     $ap_array = array_replace($data['ap_courses'], [$index => $ap_info->id]);
                //     $data['ap_courses'] = $ap_array;
                // }
                if(isset($ap_data['name_of_ap_course']) && !empty($ap_data['name_of_ap_course'])){
                    if(!in_array($ap_data['name_of_ap_course'], $education_courses_ids)){
                        EducationCourse::create(['name' => $ap_data['name_of_ap_course'] , 'course_type' => 2 , 'user_id' => Auth::id()]);
                    }
                }
            }
        }

        $grade_ids = Grade::pluck('id')->toArray();
        
        $gpa_unweighted = sprintf("%.2f", $data['cumulative_gpa_unweighted']);
        $gpa_weighted = sprintf("%.2f", $data['cumulative_gpa_weighted']);
        
        if (isset($data['current_grade']) && !empty($data['current_grade'])) {
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
        
        if(isset($data['intended_college_major']) && !empty($data['intended_college_major'])){
            foreach ($data['intended_college_major'] as $major) {
                if (!in_array($major, $intended_major_ids)) {                
                    $major_info = IntendedCollegeList::create(['name' => $major,'type' => 1]);                
                    $index = array_search($major, $data['intended_college_major']);                
                    $major_array = array_replace($data['intended_college_major'], [$index => $major_info->id]);
                    $data['intended_college_major'] = $major_array;
                }
            }
        }

        if(isset($data['intended_college_minor']) && !empty($data['intended_college_minor'])){
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

        if (!empty($data['graduation_designation'])) {
            $data['graduation_designation'] = $data['graduation_designation'];
            $existingGraduations = GraduationDesignation::pluck('designation')->toArray();
            if (!in_array($data['graduation_designation'], $existingGraduations)) {
                GraduationDesignation::create(['designation' => $data['graduation_designation']]);
            }
        }

        if (isset($data['honor_course_data']) && !empty($data['honor_course_data'])) {
            $data['honor_course_data'] = array_values($data['honor_course_data']);
        }else{
            $data['honor_course_data'] = null;
        }

        
        if (!empty($request->is_tested)) {
            $data['test_taken_status'] = $request->is_tested;
        }

        if (!empty($request->testing_data)) {
            if (!empty($request->is_tested)) {
                if($request->is_tested == 0) {
                    $data['testing_data'] = array_values($request->testing_data);
                }
            }
            
        }

        if (isset($data['ib_courses']) && !empty($data['ib_courses'])) {
            // $data['ib_courses'] = json_encode($data['ib_courses']);
            $data['ib_courses'] = array_values($data['ib_courses']);
        }else{
            $data['ib_courses'] = null;
        }

        if (isset($data['ap_courses']) && !empty($data['ap_courses'])) {
            // $data['ap_courses'] = json_encode($data['ap_courses']);
            $data['ap_courses'] = array_values($data['ap_courses']);
        }else{
            $data['ap_courses'] = null;
        }


        if (!empty($data['course_data'])) {
            $data['course_data'] = array_values($data['course_data']);
        }

        $data['user_id'] = Auth::id();

        if (!empty($data)) {
			// Retrieve the city and state names based on their IDs
			$city = Cities::findOrFail($data['high_school_city']);
			$state = States::findOrFail($data['high_school_state']);

			// Update the city and state properties in the $data array with their respective names
			$data['high_school_city'] = $city->city_name;
			$data['high_school_state'] = $state->state_name;
            Education::create($data);
            return redirect()->route('admin-dashboard.highSchoolResume.honors');
        }
    }

    public function update(EducationRequest $request, Education $education)
    {
        $data = $request->validated();

        // echo 'update<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;

        $college_ids = CollegeInformation::pluck('id')->toArray();

        if(isset($data['course_data']) && !empty($data['course_data'])){
            foreach ($data['course_data'] as $key1 => $course_data) {
                if (isset($course_data['search_college_name']) && !empty($course_data['search_college_name'])) {
                    foreach($course_data['search_college_name'] as $key => $college_name){
                        if(!in_array($college_name, $college_ids)){
                            $college_info = CollegeInformation::create(['name' => $college_name , 'user_id' => Auth::id()]);
                            $index = array_search($college_name, $course_data['search_college_name']);
                            $college_array = array_replace($course_data['search_college_name'], [$index => $college_info->id]);
                            $course_data['search_college_name'] = $college_array;
                        }
                    }              
                }
                $data['course_data'][$key1] = $course_data;
            }
        }

        if (!empty($data['graduation_designation'])) {
            $data['graduation_designation'] = $data['graduation_designation'];
            $existingGraduations = GraduationDesignation::pluck('designation')->toArray();
            if (!in_array($data['graduation_designation'], $existingGraduations)) {
                GraduationDesignation::create(['designation' => $data['graduation_designation']]);
            }
        }

        $honor_course_name_ids = HonorCourseNameList::pluck('id')->toArray();

        if(isset($data['honor_course_data']) && !empty($data['honor_course_data'])){
            foreach ($data['honor_course_data'] as $key1 => $course_name) {
                if(isset($course_name['course_data']) && !empty($course_name['course_data'])){
                    foreach($course_name['course_data'] as $key => $course){
                        if(!in_array($course ,$honor_course_name_ids)){
                            $course_name_info = HonorCourseNameList::create(['name' => $course, 'user_id' => Auth::id()]);
                            $index = array_search($course, $course_name['course_data']);
                            $course_name_array = array_replace($course_name['course_data'], [$index => $course_name_info->id]);
                            $course_name['course_data'] = $course_name_array;
                        }
                    }
                }
                $data['honor_course_data'][$key1] = $course_name;
            }
        }

        $education_courses_ids = EducationCourse::pluck('name')->toArray();

        if(isset($data['ib_courses']) && !empty($data['ib_courses'])){
            foreach($data['ib_courses'] as $ib_data){
                // if(!in_array($ib_data, $education_courses_ids)){
                //     $ib_info = EducationCourse::create(['name' => $ib_data , 'course_type' => 1 , 'user_id' => Auth::id()])  ;                
                //     $index = array_search($ib_data, $data['ib_courses']);
                //     $ib_array = array_replace($data['ib_courses'], [$index => $ib_info->id]);
                //     $data['ib_courses'] = $ib_array;
                // }
                if(isset($ib_data['name_of_ib_course']) && !empty($ib_data['name_of_ib_course'])){
                    if(!in_array($ib_data['name_of_ib_course'], $education_courses_ids)){
                        EducationCourse::create(['name' => $ib_data['name_of_ib_course'] , 'course_type' => 1 , 'user_id' => Auth::id()]);
                    }
                }
            }
        }
        
        if(isset($data['ap_courses']) && !empty($data['ap_courses'])){
            foreach($data['ap_courses'] as $ap_data){
                // if(!in_array($ap_data, $education_courses_ids)){
                //     $ap_info = EducationCourse::create(['name' => $ap_data , 'course_type' => 2 , 'user_id' => Auth::id()])  ;                
                //     $index = array_search($ap_data, $data['ap_courses']);
                //     $ap_array = array_replace($data['ap_courses'], [$index => $ap_info->id]);
                //     $data['ap_courses'] = $ap_array;
                // }
                if(isset($ap_data['name_of_ap_course']) && !empty($ap_data['name_of_ap_course'])){
                    if(!in_array($ap_data['name_of_ap_course'], $education_courses_ids)){
                        EducationCourse::create(['name' => $ap_data['name_of_ap_course'] , 'course_type' => 2 , 'user_id' => Auth::id()]);
                    }
                }
            }
        }

        $gpa_unweighted = sprintf("%.2f", $data['cumulative_gpa_unweighted']);
        $gpa_weighted = sprintf("%.2f", $data['cumulative_gpa_weighted']);

        $grade_ids = Grade::pluck('id')->toArray();

        if(isset($data['current_grade']) && !empty($data['current_grade'])){
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
        if(isset($data['intended_college_major']) && !empty($data['intended_college_major'])){
            foreach ($data['intended_college_major'] as $major) {            
                if (!in_array($major, $intended_major_ids)) {                
                    $major_info = IntendedCollegeList::create(['name' => $major,'type' => 1]);                
                    $index = array_search($major, $data['intended_college_major']);                
                    $major_array = array_replace($data['intended_college_major'], [$index => $major_info->id]);                
                    $data['intended_college_major'] = $major_array;
                }
            }
        }
        if (isset($data['intended_college_minor']) && !empty($data['intended_college_minor'])) {
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

        if (isset($data['honor_course_data']) && !empty($data['honor_course_data'])) {
            $data['honor_course_data'] = array_values($data['honor_course_data']);
        }else{
            $data['honor_course_data'] = null;
        }

        // echo "is_tested = $request->is_tested";exit;
        if (!empty($request->is_tested)) {
            $data['test_taken_status'] = $request->is_tested;
        } else {
            $data['test_taken_status'] = 0;
        }

        if (!empty($request->testing_data)) {
            if($data['test_taken_status'] == 0) {
                $data['testing_data'] = array_values($request->testing_data);
            } else {
                $data['testing_data'] = NULL;
            }
        } else {
            $data['testing_data'] = NULL;
        }

        if (isset($data['ib_courses']) && !empty($data['ib_courses'])) {
            // $data['ib_courses'] = json_encode($data['ib_courses']);
            $data['ib_courses'] = array_values($data['ib_courses']);
        }else{
            $data['ib_courses'] = null;
        }

        if (isset($data['ap_courses']) &&!empty($data['ap_courses'])) {
            // $data['ap_courses'] = json_encode($data['ap_courses']);
            $data['ap_courses'] = array_values($data['ap_courses']);
        }else{
            $data['ap_courses'] = null;

        }
        
        if (!empty($data['course_data'])) {
            $data['course_data'] = array_values($data['course_data']);
        }

        if (!empty($data)) {
			// Retrieve the city and state names based on their IDs
			$city = Cities::findOrFail($data['high_school_city']);
			$state = States::findOrFail($data['high_school_state']);

			// Update the city and state properties in the $data array with their respective names
			$data['high_school_city'] = $city->city_name;
			$data['high_school_state'] = $state->state_name;
			
            $education->update($data);
            if ($resume_id != null) {
                return redirect("user/admin-dashboard/high-school-resume/honors?resume_id=" . $resume_id);
            } else {
                return redirect()->route('admin-dashboard.highSchoolResume.honors');
            }
        }
    }

    public function getEducationCourseNameList()
    {
        $user = Auth::user();
        if($user->role == 1) {
            $courses_list = EducationCourse::all();
        } else {
            $courses_list = EducationCourse::whereNull('user_id')->orWhere('user_id' , Auth::id())->get();
        }

        return response()->json(['success' => true, 'dropdown_list' => $courses_list]);
    }
    
}
