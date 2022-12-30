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
            "is_graduate" => "",
            "grade_level" => "",
            "college_name" => "",
            "college_city" => "",
            "college_state" => "",
            "cumulative_gpa_unweighted" => "",
            "cumulative_gpa_weighted" => "",
            "class_rank" => "",
            "total_no_of_student" => "",
            "ib_courses" => "required",
            "ap_courses" => "required",
            "intended_college_major" => "",
            "intended_college_minor" => "",
            "course_data.*.course_name" => "required",
            "course_data.*.search_college_name" => "required",
            "honor_course_data.*.course_data"=>"required",
            "testing_data.*.name_of_test" => "",
            "testing_data.*.results_score" => "",
            "testing_data.*.date" => ""
        ];
    }

    public function messages()
    {
        return [
            "current_grade.required" => "Current Grade field is required",
            "month.required" => "Month field is required",
            "year.required" => "Year field is required",
            "high_school_name.required" => "High School Name field is required",
            "high_school_city.required" => "High School City field is required",
            "high_school_state.required" => "High School State field is required",
            "high_school_district.required" => "High school District field is required",
            "grade_level.required" => "grade Level field is required",
            "college_name.required" => "College Name field is required",
            "college_city.required" => "College City field is required",
            "college_state.required" => "College State field is required",
            "cumulative_gpa_unweighted.required" => "Cumulative GPA UnWeighted field is required",
            "cumulative_gpa_weighted.required" => "Cumulative GPA Weighted field is required",
            "class_rank.required" => "Class Rank field is required",
            "total_no_of_student.required" => "Total No Of Student field is required",
            "ib_courses.required" => "IB Courses field is required",
            "ap_courses.required" => "AP Courses field is required",
            "intended_college_major.required" => "Intended College Major field is required",
            "intended_college_minor.required" => "Intended College Minor field is required",
            "course_data.*.course_name.required" => "Course name is required",
            "course_data.*.search_college_name.required" => "search college name is required",
            "honor_course_data.*.course_data.required" => "Honor Course Data is required",
            "testing_data.*.name_of_test.required" => "name of test is required",
            "testing_data.*.results_score.required" => "results score is required",
            "testing_data.*.date.required" => "date is required"
        ];
    }
}
