<?php

namespace App\Http\Controllers\Cronjob;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reminder;
use App\Models\User;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use Twilio\Rest\Client;

class SendReminder extends Controller
{
    public function index(Request $request)
    {
        $reminders = Reminder::where('enabled', 1)
                    ->where('end_date', '>=', Carbon::now())
                    ->get();
        foreach ($reminders as $reminder) {
            Log::channel('reminder')->info("reminder = $reminder");

            $frequency = strtolower($reminder->frequency);
            $method = strtolower($reminder->method);
            $user_id = $reminder->user_id;
            $user = User::find($user_id);

            $startDate = Carbon::parse($reminder->start_date);
            $endDate = Carbon::parse($reminder->end_date);
            
            $currentDate = $startDate->copy();
            $currentTime = Carbon::createFromFormat('H:i:s', $reminder->when_time);

            while ($currentDate <= $endDate) {

                $currentDateTime = $currentDate->copy()->setTime($currentTime->hour, $currentTime->minute, 0);
                Log::channel('reminder')->info("currentDateTime = ".$currentDateTime->format('Y-m-d H:i'));
                Log::channel('reminder')->info("Carbon now = ".Carbon::now()->format('Y-m-d H:i'));
                //echo "currentDateTime = ".$currentDateTime->format('Y-m-d H:i')."<br />";
                //echo "Carbon now = ".Carbon::now()->format('Y-m-d H:i')."<br /><br />";

                if (Carbon::now()->format('Y-m-d H:i') === $currentDateTime->format('Y-m-d H:i')) {
                    if($method == 'text' || $method == 'both') {
                        $this->sendSmsReminder($reminder, $user);
                    }

                    if($method == 'email' || $method == 'both') {
                        $this->sendEmailReminder($reminder, $user);
                    }
                    break;
                }

                if ($frequency == 'daily') {
                    $currentDate->addDay();
                } elseif ($frequency == 'weekly') {
                    $currentDate->addWeek();
                } elseif ($frequency == 'monthly') {
                    $currentDate->addMonth();
                }
                #echo "<br/>";
            }
        }
    }

    private function sendEmailReminder($reminder, $user)
    {
        Log::channel('reminder')->info("sendEmailReminder function called");
        $date = date("m/d/Y");
        $time = date("h:i a", strtotime($reminder->when_time));
        $to_email = $user->email;
        //$to_email = 'khan06shahbaz@gmail.com';
        //$to_email = 'pocholo.hernandez@plumnetworks.com';
        Log::channel('reminder')->info("to_email = $to_email");
        $subject = "Important Reminder: Your Upcoming Deadlines and Activities";
        $body = "Dear $user->first_name,<br /><br />We hope you're doing well. This is your automated College Prep System Reminder, making sure you stay on top of your important deadlines and activities. Here's your reminder:<br /><br /><b>$reminder->reminder_name - $date at $time ET.</b><br /><br />Staying organized is important in order to achieve your admissions and test goals. We're here to help you stay on track. If you have any questions or need assistance, feel free to contact our support team.<br /><br />Best of luck with your upcoming activities!<br /><br />Sincerely,<br />College Prep System Team";
        
        $sent = Mail::send([], [], function ($message) use ($to_email, $subject, $body) {
            $message->to($to_email)->subject($subject)->html($body);
        });
    
        if ($sent) {
            Log::channel('reminder')->info("Email sent successfully to $to_email");
        } else {
            Log::channel('reminder')->error("Failed to send email to $to_email");
        }
    }

    private function sendSmsReminder($reminder, $user)
    {
        Log::channel('reminder')->info("sendSmsReminder function called");
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');

        Log::channel('reminder')->info("accountSid = $accountSid");
        Log::channel('reminder')->info("authToken = $authToken");
        Log::channel('reminder')->info("twilioPhoneNumber = $twilioPhoneNumber");

        $date = date("m/d/Y");
        $time = date("h:i a", strtotime($reminder->when_time));

        $toPhoneNumber = $user->phone;
        //$toPhoneNumber = '+919099542060';
        //$toPhoneNumber = '+639088753486';
        Log::channel('reminder')->info("toPhoneNumber = $toPhoneNumber");
        $text = "College Prep System Reminder: $reminder->reminder_name - $date at $time https://rb.gy/s139r";
        Log::channel('reminder')->info("text = $text");

        try {
            $twilio = new Client($accountSid, $authToken);
            $message = $twilio->messages
                        ->create($toPhoneNumber,
                        array(
                            "from" => $twilioPhoneNumber,
                            "body" => $text
                        )
                    );
            Log::channel('reminder')->info("message->sid = $message->sid");
            Log::channel('reminder')->info("SMS sent successfully to $toPhoneNumber");
        } catch (Exception $e) {
            Log::channel('reminder')->info("Failed to send SMS: ". $e->getMessage());
        }
    }
}
