<?php

namespace App\Http\Requests\HighSchoolResume;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "current_grade" => "required",
            "month" => "required",
            "year" => "required",
            "high_school_name" => "required",
            "high_school_city" => "required",
            "high_school_state" => "required",
            "high_school_district" => "required",
            "grade_level" => "required",
            "college_name" => "required",
            "college_city" => "required",
            "college_state" => "required",
            "cumulative_gpa_unweighted" => "required",
            "cumulative_gpa_weighted" => "required",
            "class_rank" => "required",
            "total_no_of_student" => "required",
            "ib_courses" => "required",
            "ap_courses" => "required",
            "course_name" => "required",
            "college_id" => "required",
            "honors_course_name" => "required",
            "name_of_test" => "required",
            "results_score" => "required",
            "date" => "required",
            "intended_college_major" => "required",
            "intended_college_minor" => "required",
        ];
    }

    public function messages()
    {
        return [
            "current_grade.required" => "current grade field is required",
            "month.required" => "month field is required",
            "year.required" => "year field is required",
            "high_school_name.required" => "high school name field is required",
            "high_school_city.required" => "high school city field is required",
            "high_school_state.required" => "high school state field is required",
            "high_school_district.required" => "high school district field is required",
            "grade_level.required" => "grade level field is required",
            "college_name.required" => "college name field is required",
            "college_city.required" => "college city field is required",
            "college_state.required" => "college state field is required",
            "cumulative_gpa_unweighted.required" => "cumulative gpa unweighted field is required",
            "cumulative_gpa_weighted.required" => "cumulative gpa weighted field is required",
            "class_rank.required" => "class rank field is required",
            "total_no_of_student.required" => "total no of student field is required",
            "ib_courses.required" => "ib courses field is required",
            "ap_courses.required" => "ap courses field is required",
            "course_name.required" => "course name field is required",
            "college_id.required" => "college field is required",
            "honors_course_name.required" => "honors course name field is required",
            "name_of_test.required" => "no of test field is required",
            "results_score.required" => "result score field is required",
            "date.required" => "date field is required",
            "intended_college_major.required" => "intended college major field is required",
            "intended_college_minor.required" => "intended college minor field is required",
        ];
    }
}
