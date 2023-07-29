<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules() {
        return [
            'frequency' => 'required',
            'when' => 'required',
        ];
    }

    public function messages() {
        return [
            'frequency.required' => 'Frequency is required',
            'when.required' => 'When is required',
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
