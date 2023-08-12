<?php

namespace App\Http\Requests\CourseManagement;

use Illuminate\Foundation\Http\FormRequest;

class MilestoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:220',
            'user_type' => 'required|array',
            'product' => 'required_if:status,==,paid',
            'is_addmission_lesson' => 'boolean',
//            'description' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages() {
        return [
            'name.required' => 'Milestone name is required',
            'user_type.required' => 'User type is required',
            'user_type.array' => 'User type is required',
            'product.required_if' => 'Product is required',
            'is_addmission_lesson.boolean' => 'checkbox must be boolean',
        ];
    }
}
