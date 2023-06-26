<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Service\TwilioService;

class SMSController extends Controller
{
    public function sendSMS(Request $request) {
        $rules = [
            'to_number' => 'required',
            'body' => 'required'
        ];

        $customMessage = [
            'required' => 'The :attribute field is required.'
        ];

        $validate = Validator::make($request->all(), $rules, $customMessage);
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors()->first(),
            ]);
        }

        $twilio = new TwilioService();
        $message = $twilio->sendSMSMessage($request->to_number, [
            'body' => $request->body
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'SMS sent successfully.',
            'data' => $message
        ]);
    }
}
