<?php

namespace App\Http\Requests\CourseManagement;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
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
            'title' => 'required|max:220',
            'milestone_id' => 'required|exists:milestones,id',
            'user_type' => 'required|array',
            'products' => 'required_if:status,paid|array|min:1',
//            'description' => 'required'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages() {
        return [
            'title.required' => 'Module title is required',
            'title.max' => 'Module title should not be more than 220 characters',
            'milestone_id.required' => 'Milestone is required',
            'milestone_id.exists' => 'Milestone does not exists',
            'user_type.required' => 'User type is required',
            'user_type.array' => 'User type is required',
            'products.required_if' => 'Product is required',
            'products.min' => 'Product is required',
            'products.array' => 'Product is required',
        ];
    }
}
