<?php

namespace App\Http\Requests\CourseManagement;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
            'product' => 'required_if:status,==,paid',
            'user_type' => 'required|array',
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
            'title.required' => 'Section title is required',
            'product.required_if' => 'Product is required',
            'user_type.required' => 'User type is required',
            'user_type.array' => 'User type is required',
        ];
    }
}
