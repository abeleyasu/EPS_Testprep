<?php 

namespace App\Service;

use Illuminate\Support\ServiceProvider;
use Exception;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Google_Service_Calendar_EventAttendee;
use Google_Service_Oauth2;
use App\Models\User;
use App\Models\UserGoogleAccount;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;

class GoogleService {

    public $client;
    protected $token;
    public $oauth;
    protected $user;
    protected $UserGoogleAccountModal;

    protected $calender_name = 'College Prep System';

    public function __construct(UserGoogleAccount $UserGoogleAccount) {
        $this->client = $this->client();
        $this->UserGoogleAccountModal = $UserGoogleAccount;
    }

    public function client() {
        $client = new Google_Client();
        $client->setClientId(config('google-laravel.GOOGLE_CLIENT_ID'));
        $client->setClientSecret(config('google-laravel.GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(config('google-laravel.GOOGLE_REDIRECT_URL'));
        $client->setScopes(config('google-laravel.GOOGLE_SCOPES'));
        $client->setApprovalPrompt(env('GOOGLE_APPROVAL_PROMPT'));
        $client->setAccessType(env('GOOGLE_ACCESS_TYPE'));

        return $client;
    }

    public function user() {
        return Auth::user();
    }

    public function googleAcount() {
        return $this->user()->googleAccount;
    }

    public function googleCalendarId() {
        if ($this->googleAcount()) {
            return $this->googleAcount()->google_calendar_id;
        }
        return null;
    }

    public function userTimeZone() {
        return $this->user()->userSetting->timezone;
    }

    public function defaultCalendarId() {
        return $this->user()->email;
    }

    public function storeUserAccessToken($data) {
        $object = [
            'google_access_token' => $data['access_token'],
            'google_refresh_token' => $data['refresh_token'],
            'google_token_type' => $data['token_type'],
            'google_expires_in' => $data['expires_in'],
            'google_id_token' => $data['id_token'],
            'google_token_created' => Carbon::now(),
        ];
        if ($this->googleAcount()) {
            UserGoogleAccount::where('user_id', $this->user()->id)->update($object);
        } else {
            $object['user_id'] = $this->user()->id;
            $object['google_id'] = $this->oauth_user()->id;
            UserGoogleAccount::create($object);
        }
    }

    public function isValidAccessToken() {
        $google_account = $this->googleAcount();
        if (!$google_account) return false;
        $token_created_date_time = Carbon::parse($google_account->google_token_created);
        $token_created_date_time = $token_created_date_time->addSeconds($google_account->google_expires_in);
        return $token_created_date_time->gte(Carbon::now());
    }

    public function setupTokenFirstTime() {
        $this->token = $this->client->getAccessToken();
        $this->client->setAccessToken($this->token);
        $this->storeUserAccessToken($this->token);
        $this->createOrGetCalender();
        return $this->token;
    }

    public function setOrGetAccessToken() {
        $is_valid_access_token = $this->isValidAccessToken();
        if($is_valid_access_token) {
            $token = $this->googleAcount()->google_access_token;
            $this->client->setAccessToken($token);
            return $token;
        } else {
            $google_account = $this->googleAcount();
            if ($google_account) {
                $refresh_token = $this->user()->googleAccount->google_refresh_token;
                if ($refresh_token) {
                    $this->client->refreshToken($refresh_token);
                    $this->token = $this->client->getAccessToken();
                    $this->client->setAccessToken($this->token);
                    $this->storeUserAccessToken($this->token);
                    return $this->token;
                } else {
                    UserGoogleAccount::where('user_id', $this->user()->id)->delete();
                    throw new Exception("Refresh token not found");
                }
            } else {
                throw new Exception("Google account not connected.");
            }
            
        }
    }

    public function createOrGetCalender() {
        $service = new Google_Service_Calendar($this->client);
        $calenders = $service->calendarList->listCalendarList();
        $calenders = $calenders->getItems();
        foreach ($calenders as $calender) {
            if ($calender->getSummary() == $this->calender_name) {
                $this->UserGoogleAccountModal->where('user_id', $this->user()->id)->update(['google_calendar_id' => $calender->getId()]);
                return $calender->toSimpleObject();
            }
        }
        return $this->createCalender();
    }

    public function createCalender($service) {
        $calendar = new Google_Service_Calendar_Calendar();
        $calendar->setSummary($this->calender_name);
        $calendar->setTimeZone($this->userTimeZone());
        $createdCalendar = $service->calendars->insert($calendar);
        $calendar_id = $createdCalendar->getId();
        $this->UserGoogleAccountModal->where('user_id', $this->user()->id)->update(['google_calendar_id' => $calendar_id]);
        return $calendar->toSimpleObject();
    }

    public function oauth_user() {
        $this->oauth = new Google_Service_Oauth2($this->client);
        return $this->oauth->userinfo->get();
    }

    public function getAuthUrl() {
        return $this->client->createAuthUrl();
    }

    public function disconnect() {
        $this->client->revokeToken();
        UserGoogleAccount::where('user_id', $this->user()->id)->delete();
    }

    public function service() {
        // if (!$this->client) {
        //     $this->client = $this->client();
        // }
        $this->setOrGetAccessToken();
        return new Google_Service_Calendar($this->client);
    }

    public function calendars() {
        if (!$this->googleAcount()) {
            throw new Exception("Google account not connected.");
        }
        $service = $this->service();
        $calendarList = $service->calendarList->listCalendarList();
        $calendars = [];
        foreach ($calendarList->getItems() as $calendarListEntry) {
            $calendars[] = $calendarListEntry;
        }
        return $calendars;
    }

    public function getCalendarId($calendarId = null) {
        if (!$calendarId) {
            $calendarId = $this->defaultCalendarId();
        }
        return $calendarId;
    }

    public function getSingleCalendar() {
        if (!$this->googleCalendarId()) {
            return null;
        }
        $service = $this->service();
        $service = new Google_Service_Calendar($this->client);
        try {
            $calendar = $service->calendarList->get($this->googleCalendarId());
            return $calendar->toSimpleObject();
        } catch (\Exception $e) {
            if ($e->getCode() == 404) {
                $this->UserGoogleAccountModal->where('user_id', $this->user()->id)->update(['google_calendar_id' => null]);
                return null;
            }
            throw new Exception($e->getMessage());
        }
    }

    public function isCalenderExist() {
        if ($this->googleCalendarId()) {
            return !is_null($this->getSingleCalendar());    
        }
        return false;
    }

    public function storeUserCalender($calendar_id) {
        return $this->UserGoogleAccountModal->where('user_id', $this->user()->id)->update(['google_calendar_id' => $calendar_id]);
    }

    public function google_calendar_findColor($color)
    {
        //Google calendar color code 
        // 1 = blue / 2 = green / 3 = purple / 4 = red / 5 = yellow / 6 = orange / 7 = turquoise / 8 = gray / 9 = bold blue / 10 = bold green / 11 = bold red
        if($color == "info") {
            $c_code = 1; // Blue
        } else if($color == "warning") {
            $c_code = 6; // Orange
        } else if($color == "success") {
            $c_code = 2; // Green
        } else if($color == "danger") {
            $c_code = 4; // Red
        } else {
            $c_code = 3; //purple
        }
        return $c_code;
    }

    public function setStartEndDate($payload, $isAllDay) {
        $start_date = Carbon::parse($payload['start_date']);
        $end_date = isset($payload['end_date']) ? Carbon::parse($payload['end_date']) : null;
        if ($isAllDay) {
            $date = $start_date->format('Y-m-d');
            $payload['start'] = [
                'date' => $date,
                'timeZone' => $this->userTimeZone(),
            ];
            $payload['end'] = [
                'date' => $date,
                'timeZone' => $this->userTimeZone(),
            ];
        } else {
            $start_date = Carbon::parse($payload['start_date'])->shiftTimezone($this->userTimeZone());
            $end_date = isset($payload['end_date']) ? Carbon::parse($payload['end_date'])->shiftTimezone($this->userTimeZone()) : null;
            $payload['start'] = array(
                'dateTime' => $start_date->format('Y-m-d\TH:i:sP'),
                // 'timeZone' => $this->userTimeZone(),
            );
            $payload['end'] = array(
                'dateTime' => $end_date ? $end_date->format('Y-m-d\TH:i:sP') : $start_date->format('Y-m-d\TH:i:sP'),
                // 'timeZone' => $this->userTimeZone(),
            );
        }
        unset($payload['start_date']);
        unset($payload['end_date']);
        return $payload;
    }

    public function isEventExist($calender_event_id) {
        try {
            $service = $this->service();
            $get_event = $service->events->get($this->googleCalendarId(), $calender_event_id);
            return true;
        } catch (\Exception $e) { 
            if ($e->getCode() == 404) {
                return false;
            }
            throw new Exception($e->getMessage());
        }
    }

    public function insertEvent($data, $optParams = []) {
        if (!$this->isCalenderExist()) return null;  
        $payload = [
            'summary' => $data['title'] ?? null,
            'location' => $data['location'] ?? null,
            'description' => $data['description'] ?? null,
            'colorId' => $this->google_calendar_findColor($data['color']),
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
        ];
        $payload = $this->setStartEndDate($payload, isset($optParams['is_all_day']) && $optParams['is_all_day']);
        $event = new Google_Service_Calendar_Event($payload);
        $service = $this->service();
        $event = $service->events->insert($this->googleCalendarId(), $event);
        return $event->toSimpleObject();
    }

    public function updateEvent($calender_event_id, $data, $optParams = []) {
        if (!$this->isCalenderExist()) return null;
        if (!$this->isEventExist($calender_event_id)) {
            return $this->insertEvent($data, $optParams);
        }
        $service = $this->service();
        $get_event = $service->events->get($this->googleCalendarId(), $calender_event_id);
        if ($get_event) {
            $payload = [
                'summary' => $data['title'] ?? $get_event->getSummary(),
                'location' => $data['location'] ?? $get_event->getLocation(),
                'description' => $data['description'] ?? $get_event->getDescription(),
                'colorId' => isset($data['color']) ? $this->google_calendar_findColor($data['color']) : $get_event->getColorId(),
                'start_date' => $data['start_date'] ?? null,
                'end_date' => $data['end_date'] ?? null,
            ];
            $payload = $this->setStartEndDate($payload, isset($optParams['is_all_day']) && $optParams['is_all_day']);
            $event = new Google_Service_Calendar_Event($payload);
            $updatedEvent = $service->events->update($this->googleCalendarId(), $get_event->getId(), $event);
            return $updatedEvent->toSimpleObject();
        }
    }

    public function deleteEvent($calender_event_id) {
        if (!$this->isCalenderExist()) return null;
        $service = $this->service();
        $service->events->delete($this->googleCalendarId(), $calender_event_id);
        return true;
    }

}

?>