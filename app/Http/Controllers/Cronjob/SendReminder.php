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
use App\Models\UserSettings;
use App\Models\CollegeSearchAdd;
use App\Service\TwilioService;

class SendReminder extends Controller
{
    public function index(Request $request)
    {
        try {
            $reminders = Reminder::where('enabled', 1)->get();
            foreach ($reminders as $reminder) {
                $user_settings = UserSettings::where('user_id', $reminder->user_id)->first();
                if ($user_settings->application_deadline_notification == 1 && $reminder->type == 'application_deadline' && $reminder->is_send == 0) {
                    $college = CollegeSearchAdd::where('id', $reminder->college_id)->first();
                    if ($college->is_active == 1) {
                        Log::channel('reminder')->info("Application deadline notification");
                        $this->sendOneTimeNotification($reminder);
                    }
                } else if ($reminder->type == 'custom') {
                    $this->createReminder($reminder, $user_settings);
                }
            }
        } catch (\Exception $e) {
            Log::channel('reminder')->error("Error: " . $e->getMessage());
        }
    }

    public function getUserTimeZoneTime($user_settings) {
        $currentTimeInUserTimezone = Carbon::now()->setTimezone($user_settings->timezone);
        Log::channel('reminder')->info("Current User Timezone Time = ".$currentTimeInUserTimezone->format('Y-m-d H:i'));
        return $currentTimeInUserTimezone;
    }

    public function getReminderStartDateWithTime($reminder, $user_settings) {
        $startTime = Carbon::parse($reminder->start_date)->setTimezone($user_settings->timezone);
        $time = Carbon::createFromFormat('H:i:s', $reminder->when_time);
        $startTime->setTime($time->hour, $time->minute, 0);
        Log::channel('reminder')->info("Reminder Start Date With Time = ".$startTime->format('Y-m-d H:i'));
        return $startTime;
    }

    public function getReminderEndDate($reminder, $user_settings) {
        $endTime = Carbon::parse($reminder->end_date)->setTimezone($user_settings->timezone);
        $time = Carbon::createFromFormat('H:i:s', $reminder->when_time);
        $endTime->setTime($time->hour, $time->minute, 0);
        Log::channel('reminder')->info("Reminder End Date = ".$endTime->format('Y-m-d H:i'));
        return $endTime;
    }

    public function createReminder($reminder, $user_settings) {
        Log::channel('reminder')->info("reminder = $reminder");

        $currentTimeInUserTimezone = $this->getUserTimeZoneTime($user_settings);
        $startDate = $this->getReminderStartDateWithTime($reminder, $user_settings);
        $endDate = $this->getReminderEndDate($reminder, $user_settings);

        $frequency = strtolower($reminder->frequency);
        $method = strtolower($reminder->method);
        $user = User::find($reminder->user_id);

        $currentDate = $startDate->copy();

        while ($currentDate->format('Y-m-d') <= $endDate->format('Y-m-d')) {
            $currentDateTime = $currentDate->copy();
            Log::channel('reminder')->info("currentDateTime = ".$currentDateTime->format('Y-m-d H:i'));
            Log::channel('reminder')->info("Carbon now = ".$currentTimeInUserTimezone->format('Y-m-d H:i'));
            
            if ($currentTimeInUserTimezone->format('Y-m-d H:i') === $currentDateTime->format('Y-m-d H:i')) {
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
        }
        
        // if ($currentTimeInUserTimezone->format('Y-m-d H:i') >= $startDate->format('Y-m-d H:i') && $currentTimeInUserTimezone->format('Y-m-d H:i') <= $endDate->format('Y-m-d H:i')) {
        //     if (!$reminder->next_cron_job_run_date_time) {
        //         $reminder->next_cron_job_run_date_time = $currentTimeInUserTimezone->format('Y-m-d H:i');
        //         $reminder->save();
        //     }
        //     $nextCronJob = Carbon::parse($reminder->next_cron_job_run_date_time);
        //     if ($currentTimeInUserTimezone->format('Y-m-d H:i') == $nextCronJob->format('Y-m-d H:i')) {
        //         if ($method == 'text' || $method == 'both') {
        //             $this->sendSmsReminder($reminder, $user);
        //         }
        //         if ($method == 'email' || $method == 'both') {
        //             $this->sendEmailReminder($reminder, $user);
        //         }
        //         if ($frequency == 'daily') {
        //             $currentTimeInUserTimezone->addDay();
        //         } elseif ($frequency == 'weekly') {
        //             $currentTimeInUserTimezone->addWeek();
        //         } elseif ($frequency == 'monthly') {
        //             $currentTimeInUserTimezone->addMonth();
        //         }
        //         $reminder->next_cron_job_run_date_time = $currentTimeInUserTimezone->format('Y-m-d H:i');
        //         $reminder->save();
        //     }
        // }
    }

    public function sendOneTimeNotification($reminder, $user_settings) {
        Log::channel('reminder')->info("reminder = $reminder");
        $user = User::find( $reminder->user_id);
        $method = strtolower($reminder->method);
        $currentTimeInUserTimezone = $this->getUserTimeZoneTime($user_settings);
        $startDate = $this->getReminderStartDateWithTime($reminder, $user_settings);
        if ($startDate->format('Y-m-d') == $currentTimeInUserTimezone->format('Y-m-d')) {  
            if($method == 'text' || $method == 'both') {
                $this->sendSmsReminder($reminder, $user);
            }
    
            if($method == 'email' || $method == 'both') {
                $this->sendEmailReminder($reminder, $user);
            }
            $reminder->is_send = 1;
            $reminder->save();
        }
    }

    private function sendEmailReminder($reminder, $user)
    {
        Log::channel('reminder')->info("sendEmailReminder function called");
        $date = date("m/d/Y");
        $time = date("h:i A", strtotime($reminder->when_time));
        $to_email = $user->email;
        Log::channel('reminder')->info("to_email = $to_email");
        $subject = "Important Reminder: Your Upcoming Deadlines and Activities";
        try {
            $sent = $this->mailgun->sendMail([
                'to' => $to_email,
                'subject' => $subject,
                'html' => view('email-template.reminder', [
                    'name' => $user->first_name,
                    'reminder_name' => $reminder->reminder_name,
                    'date' => $date,
                    'time' => $time
                ])->render()
            ]);
            
            if ($sent) {
                Log::channel('reminder')->info("Email sent successfully to $to_email");
            } else {
                Log::channel('reminder')->error("Failed to send email to $to_email");
            }
        } catch (\Exception $e) {
            Log::channel('reminder')->error("An error occurred while sending email to $to_email: " . $e->getMessage());
        }
    }

    private function sendSmsReminder($reminder, $user)
    {
        Log::channel('reminder')->info("sendSmsReminder function called");
        $date = date("m/d/Y");
        $time = date("h:i A", strtotime($reminder->when_time));

        $toPhoneNumber = $user->phone;
        //$toPhoneNumber = '+919099542060';
        //$toPhoneNumber = '+639088753486';
        Log::channel('reminder')->info("toPhoneNumber = $toPhoneNumber");
        $text = "College Prep System Reminder: $reminder->reminder_name - $date at $time Reply STOP to unsubscribe";
        Log::channel('reminder')->info("text = $text");

        try {
            $twilio = new TwilioService();
            $message = $twilio->sendSMSMessage($toPhoneNumber, [
                'body' => $text
            ]);
            Log::channel('reminder')->info("message->sid = $message->sid");
            Log::channel('reminder')->info("Twilio Response:\n" . json_encode($message, JSON_PRETTY_PRINT));
            Log::channel('reminder')->info("SMS sent successfully to $toPhoneNumber");
        } catch (Exception $e) {
            Log::channel('reminder')->info("Failed to send SMS: ". $e->getMessage());
        }
    }
}
