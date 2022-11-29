<?php

namespace App\Http\Requests\HighSchoolResume;

use Illuminate\Foundation\Http\FormRequest;

class EmploymentCertificationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "employment_job_title" => "required",
            "employment_grade" => "required",
            "employment_location" => "required",
            "employment_honor_award" => "required",
            "responsibility_interest" => "required",
            "responsibility_grade" => "required",
            "responsibility_location" => "required",
            "responsibility_honor_award" => "required"
        ];
    }

    public function messages()
    {
        return [
            'employment_job_title.required' => 'Job Title field is required',
            'employment_grade.required' => 'Grade field is required',
            'employment_location.required' => 'Location field is required',
            'employment_honor_award.required' => 'Honor/Award field is required',
            'responsibility_interest.required' => 'Responsibility/Interest field is required',
            'responsibility_grade.required' => 'Grade field is required',
            'responsibility_location.required' => 'Location field is required',
            'responsibility_honor_award.required' => 'Honor/Award field is required',
        ];
    }
}
