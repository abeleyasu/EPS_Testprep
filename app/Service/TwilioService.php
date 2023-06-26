<?php 

namespace App\Service;

use Illuminate\Support\ServiceProvider;
use Twilio\Rest\Client;
use Exception;

class TwilioService
{
    protected $twilio;

    public function __construct() {
        $this->twilio = $this->setupTwilio();
    }

    public function accountSid() {
        return env('TWILIO_ACCOUNT_SID');
    }

    public function authToken() {
        return env('TWILIO_AUTH_TOKEN');
    }

    public function twilioPhoneNumber() {
        return env('TWILIO_PHONE_NUMBER');
    }

    public function setupTwilio() {
        return new Client($this->accountSid(), $this->authToken());
    }

    public function sendSMSMessage($to_number, $otherdata) {;
        $message = $this->twilio->messages->create($to_number, $this->makeData($otherdata)); 
        return $message;
    }

    public function makeData($payload) {
        $data = [];
        $data['body'] = $payload['body'];
        $data['from'] = $this->twilioPhoneNumber();
        return $data;
    }
}
?>