<?php

namespace App\Http\Requests\HighSchoolResume;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "demonstrated_data" => "",
            "leadership_data" => "",
            "activities_data" => "",
            "athletics_data" => "",
            "community_service_data" => ""
        ];
    }
}
