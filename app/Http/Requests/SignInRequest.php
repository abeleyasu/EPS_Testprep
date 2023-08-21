<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function messages() {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'The email must be a valid email address.',
            'password.required' => 'Password is required',
            'remember_me.boolean' => 'Remember me must be boolean',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator) {
        if ($this->ajax()) {
            $response = response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 200);
    
            throw new \Illuminate\Validation\ValidationException($validator, $response);
        } else {
            throw new \Illuminate\Validation\ValidationException($validator);
        }
    }

}
