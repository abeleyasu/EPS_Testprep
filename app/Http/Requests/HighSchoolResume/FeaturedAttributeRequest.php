<?php

namespace App\Http\Requests\HighSchoolResume;

use Illuminate\Foundation\Http\FormRequest;

class FeaturedAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "featured_skills_data.*.skill" => "",
            "featured_awards_data.*.award" => "",
            "featured_languages_data.*.language" => "",
            "featured_languages_data.*.level" => ""
        ];
    }

    public function messages()
    {
        return [
            'featured_skills_data.*.skill.required' => 'Featured skills is required',
            'featured_awards_data.*.award.required' => 'Featured award is required',
            'featured_languages_data.*.language.required' => 'Featured language is required',
            'featured_languages_data.*.level.required' => 'Featured level is required'
        ];
    }
}
