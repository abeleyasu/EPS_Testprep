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
            "employment_data.*.job_title" => "",
            "employment_data.*.grade" => "",
            "employment_data.*.location" => "",
            "employment_data.*.honor_award" => "",
            "significant_data.*.interest" => "",
            "significant_data.*.grade" => "",
            "significant_data.*.location" => "",
            "significant_data.*.honor_award" => ""
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
