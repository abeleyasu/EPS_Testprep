<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjaxProductInsertRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules() {
        return [
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
        ];
    }

    public function messages() {
        return [
            'category.required' => 'Product category is required',
            'title.required' => 'Product name is required',
            'description.required' => 'Product description is required',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ], 200);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
