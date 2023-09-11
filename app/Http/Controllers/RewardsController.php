<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RewardsRequest;
use App\Service\TwilioService;
use Illuminate\Support\Str;

class RewardsController extends Controller
{
    public function index() {
        return view('user.rewards.index');
    }

    public function getCode($code) {
        return redirect()->route('plan.index', [
            'code' => $code,
        ]);
    }

    public function sendReferralNotification(RewardsRequest $request) {
        try {
            if ($request->type == 'phone') {
                $twilio = new TwilioService();
                $message = $twilio->sendSMSMessage($request->phone, [
                    'body' => 'Your referral code is: ' . auth()->user()->referral_code
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Referral code sent successfully',
                ], 200);
            } else {
                $emails = str_replace(' ', '', $request->emails);
                $emails = explode(',', $emails);

                foreach ($emails as $email) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $this->mailgun->sendMail([
                            'to' => $email,
                            'subject' => 'Referral code',
                            'text' => 'Referral code: ' . auth()->user()->referral_code,
                        ]);
                    }
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Referral code sent successfully',
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 200);
        }
    }
}
