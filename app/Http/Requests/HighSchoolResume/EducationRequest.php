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
            "intended_college_major" => "required",
            "intended_college_minor" => "required",
            "course_data" => "required",
            "honor_course_data" => "required",
            "testing_data" => "required"
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
            "course_data.required" => "Course Data is required",
            "honor_course_data.required" => "Honor Course Data is required",
            "testing_data.required" => "Testing Data is required"
        ];
    }
}