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
            "position" => "required|numeric",
            "interest" => "required",
            "grade" => "required",
            "location" => "required",
            "details" => "required",
            "status" => "required",
            "leadership_position" => "required|numeric",
            "organization" => "required",
            "leadership_location" => "required",
            "leadership_grade" => "required",
            "activity_position" => "required|numeric",
            "activity" => "required",
            "activity_grade" => "required",
            "activity_location" => "required",
            "honor_award" => "required",
            "athletics_positions" => "required|numeric",
            "athletics_activity" => "required",
            "athletics_grade" => "required",
            "athletics_location" => "required",
            "athletics_honor" => "required",
            "participation_level" => "required",
            "community_service" => "required",
            "community_grade" => "required",
            "community_location" => "required"
        ];
    }

    public function messages()
    {
        return [
            'position.required' => 'Position field is required',
            'position.numeric' => 'Position field should be numeric',
            'interest.required' => 'Interest field is required',
            'grade.required' => 'Grade field is required',
            'location.required' => 'Location field is required',
            'details.required' => 'Details field is required',
            'status.required' => 'Status field is required',
            'leadership_position.required' => 'Position field is required',
            'leadership_position.numeric' => 'Position field should be numeric',
            'organization.required' => 'Organization field is required',
            'leadership_location.required' => 'Location field is required',
            'leadership_grade.required' => 'Grade field is required',
            'activity_position.required' => 'Position field is required',
            'activity_position.numeric' => 'Position field should be numeric',
            'activity_grade.required' => 'Grade field is required',
            'activity_location.required' => 'Location field is required',
            'honor_award.required' => 'Honor/Award field is required',
            'athletics_positions.required' => 'Position field is required',
            'athletics_positions.numeric' => 'Position field should be numeric',
            'athletics_activity.required' => 'Activity field is required',
            'athletics_grade.required' => 'grade field is required',
            'athletics_location.required' => 'Location field is required',
            'athletics_honor.required' => 'Honor field is required',
            'participation_level.required' => 'Participation level field is required',
            'community_service.required' => 'Service field is required',
            'community_grade.required' => 'Grade field is required',
            'community_location.required' => 'Location field is required'
        ];
    }
}
