<?php 

namespace App\Service;

use Illuminate\Support\ServiceProvider;
use Twilio\Rest\Client;
use Exception;
use App\Service\GoogleService;
use App\Models\CalendarEvent;
use App\Models\UserCalendar;
use App\Models\UserGoogleAccount;
use App\Models\Reminder;
use DB;
use Carbon\Carbon;

class CalendarEventService extends GoogleService {
    
    protected $calenderEventModal, $userCalendarModal, $reminderModal;

    protected $isAllDay = true;

    public function __construct(CalendarEvent $calenderEventModal, UserCalendar $userCalendarModal, Reminder $reminderModal , UserGoogleAccount $UserGoogleAccount) {
        parent::__construct($UserGoogleAccount);
        $this->calenderEventModal = $calenderEventModal;
        $this->userCalendarModal = $userCalendarModal;
        $this->reminderModal = $reminderModal;
    }

    public function findEvent($event_id) {
        return $this->calenderEventModal->where('id', $event_id)->first();
    }

    public function assignCalenderEvent($data, $optParams = []) {
        DB::beginTransaction();
        try {
            // dd($data);
            $payload = [
                'title' => $data['title'],
                'color' => $data['color'],
                'description' => $data['desc'],
                'event_time' => $data['time'],
            ];
            if (isset($payload['event_time']) && $payload['event_time']) {
                $time = strtotime($payload['event_time']);
                $event_time = date('H:i:s', $time);
                $start_date = Carbon::parse($data['start_date'])->format('Y-m-d');
                $start_date = $start_date . ' ' . $event_time;
                $payload['start_date'] = $start_date;
                $end_date = Carbon::parse($start_date)->addHour();
                $payload['end_date'] = $end_date->format('Y-m-d H:i:s');
            }
            $calenderEventId = null;
            $store_event_google = $this->insertEvent($payload, $optParams);
            if ($store_event_google) {
                $calenderEventId = $store_event_google->id;
            }
            $calender_event = $this->calenderEventModal->create([
                "user_id" => $this->user()->id,
                "title" => $data['title'],
                "color" => $data['color'],
                "description" => $data['desc'],
                "event_time" => $data['time'],
                "google_calendar_event_id" => $calenderEventId,
                "is_assigned" => 1
            ]);
            $user_calender = $this->userCalendarModal->create([
                "event_id" => $calender_event->id,
                "start_date" => $start_date,
                "end_date" => $payload['end_date']
            ]);
            DB::commit();
            return $calender_event;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function createCalenderEvent($data, $event_id, $optParams = []) {
        try {
            DB::beginTransaction();
            $calender_event = $this->findEvent($event_id);
            $start_date = $data['start_date'];
            if ($calender_event) {
                $calender_event_clone = $calender_event->toArray();
                $calender_event_clone['start_date'] = $start_date;
                $calenderEventId = null;
                $optParams = [
                    'is_all_day' => $this->isAllDay,
                ];
                $store_event_google = $this->insertEvent($calender_event_clone, $optParams);
                if ($store_event_google) {
                    $calenderEventId = $store_event_google->id;
                }
                $this->userCalendarModal->create([
                    "event_id" => $event_id,
                    "start_date" => $start_date
                ]);
                $this->calenderEventModal->whereId($event_id)->update([
                    "google_calendar_event_id" => $calenderEventId,
                    "is_assigned" => 1
                ]);
                DB::commit();
                return $this->findEvent($event_id);
            } else {
                DB::rollBack();
                throw new Exception("Event not found");
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function resizeEvent($data, $user_calender_id, $optParams = []) {
        DB::beginTransaction();
        try {
            $user_calender = $this->userCalendarModal->where('id', $user_calender_id)->first();
            if ($user_calender) {
                $calender_event = $user_calender->event;
                $optParams = [
                    'is_all_day' => $this->isAllDay,
                ];
                $payload = [
                    "start_date" => $data['start_date'],
                    "end_date" => $data['end_date']
                ];
                $update_event_google = $this->updateEvent($calender_event->google_calendar_event_id, $payload, $optParams);
                if ($update_event_google) {
                    $this->userCalendarModal->whereId($user_calender_id)->update([
                        "start_date" => $data['start_date'],
                        "end_date" => $data['end_date']
                    ]);
                    DB::commit();
                    return $user_calender;
                }
            } else {
                DB::rollBack();
                throw new Exception("User calender not found");
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function updateCalenderEvent($data, $calender_event_id, $optParams = []) {
        DB::beginTransaction();
        try {
            $calender_event = $this->findEvent($calender_event_id);
            if ($calender_event) {
                $user_calender = $calender_event->user_calendar;
                $payload = [
                    "title" => $data['title'],
                    "color" => $data['color'],
                    "description" => $data['desc'],
                    "event_time" => $data['time']
                ];
                $calender_event->update($payload);
                if (isset($payload['event_time']) && $payload['event_time']) {
                    $time = strtotime($payload['event_time']);
                    $event_time = date('H:i:s', $time);
                    $start_date = Carbon::parse($user_calender->start_date)->format('Y-m-d');
                    $start_date = $start_date . ' ' . $event_time;
                    $payload['start_date'] = $start_date;
                    if ($user_calender->end_date) {
                        $end_date = Carbon::parse($user_calender->end_date)->format('Y-m-d');
                        $end_date = $end_date . ' ' . $event_time;
                        $payload['end_date'] = $end_date;
                    } else {
                        $end_date = Carbon::parse($start_date)->addHour();
                        $end_date = $end_date->format('Y-m-d H:i:s');
                        $payload['end_date'] = $end_date;
                    }
                    $user_calender->update([
                        "start_date" => $start_date,
                        "end_date" => $end_date
                    ]);
                }
                $update_event_google = $this->updateEvent($calender_event->google_calendar_event_id, $payload, $optParams);
                if ($update_event_google) {
                    DB::commit();
                    return $calender_event;
                }
            } else {
                DB::rollBack();
                throw new Exception("Calender event not found");
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function deleteCalenderEvent($event_id) {
        DB::beginTransaction();
        try {
            $calender_event = $this->findEvent($event_id);
            if ($calender_event) {
                $this->deleteEvent($calender_event->google_calendar_event_id);
                $calender_event->google_calendar_event_id = null;
                $calender_event->is_assigned = 0;
                $calender_event->save();
                if ($calender_event->reminders_id > 0) {
                    $reminder = $this->reminderModal->where('id', $calender_event->reminders_id)->first();
                    if ($reminder) {
                        $reminder->update(['enabled' => 0]);
                    }
                }
                $this->userCalendarModal->where('event_id', $event_id)->delete();
                DB::commit();
                return $calender_event;
            } else {
                DB::rollBack();
                throw new Exception("Calender event not found");
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

}
?>