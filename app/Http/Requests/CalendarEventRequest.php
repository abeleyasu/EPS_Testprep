<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendarEventRequest extends FormRequest
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
            'title' => 'required',
            'color' => 'required',
            'start_date' => 'required',
            'start_time' => 'required_if:is_all_day,false',
            'end_date' => 'required',
            'end_time' => 'required_if:is_all_day,false',
            'is_all_day' => 'nullable',
            'description' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Event Title',
            'color' => 'Event Color',
            'start_date' => 'Start Date',
            'start_time' => 'Start Time',
            'end_date' => 'End Date',
            'end_time' => 'End Time',
            'is_all_day' => 'All Day',
            'description' => 'Event Description'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Event Title is required',
            'color.required' => 'Event Color is required',
            'start_date.required' => 'Start Date is required',
            'start_time.required_if' => 'Start Time is required',
            'end_date.required' => 'End Date is required',
            'end_time.required_if' => 'End Time is required',
            'description.required' => 'Event Description is required'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator) {
        $response = response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ], 200);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
