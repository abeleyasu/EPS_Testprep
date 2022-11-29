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
            "featured_skill" => "required",
            "featured_award" => "required",
            "featured_language" => "required",
            "languages_level" => "required"
        ];
    }

    public function messages()
    {
        return [
            'featured_skill.required' => 'Featured Skill field is required',
            'featured_award.required' => 'Featured Award field is required',
            'featured_language.required' => 'Language field is required',
            'languages_level.required' => 'Language Level field is required'
        ];
    }
}
