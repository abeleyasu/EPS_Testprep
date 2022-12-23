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
            "employment_data.*.job_title" => "required",
            "employment_data.*.grade" => "required",
            "employment_data.*.location" => "required",
            "employment_data.*.honor_award" => "required",
            "significant_data.*.interest" => "required",
            "significant_data.*.grade" => "required",
            "significant_data.*.location" => "required",
            "significant_data.*.honor_award" => "required"
        ];
    }

    public function messages()
    {
        return [
            'employment_data.*.job_title.required' => 'Employment Data position is required',
            'employment_data.*.grade.required' => 'Employment Data achievement award is required',
            'employment_data.*.location.required' => 'Employment Data grade is required',
            'employment_data.*.honor_award.required' => 'Employment Data location is required',
            'significant_data.*.interest.required' => 'Significant Data interest is required',
            'significant_data.*.grade.required' => 'Significant Data grade is required',
            'significant_data.*.location.required' => 'Significant Data location is required',
            'significant_data.*.honor_award.required' => 'Significant Data honor award is required'
        ];
    }
}
