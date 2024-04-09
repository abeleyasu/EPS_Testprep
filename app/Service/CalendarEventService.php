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
use App\Models\UserCalendersList;
use DB;
use Carbon\Carbon;

class CalendarEventService extends GoogleService {
    
    protected $calenderEventModal, $userCalendarModal, $reminderModal, $userCalendersListModal;

    protected $isAllDay = true;

    public function __construct(CalendarEvent $calenderEventModal, UserCalendar $userCalendarModal, Reminder $reminderModal , UserCalendersList $userCalendersListModal, UserGoogleAccount $UserGoogleAccount) {
        parent::__construct($UserGoogleAccount);
        $this->calenderEventModal = $calenderEventModal;
        $this->userCalendarModal = $userCalendarModal;
        $this->reminderModal = $reminderModal;
        $this->userCalendersListModal = $userCalendersListModal;
    }

    public function findEvent($event_id) {
        return $this->calenderEventModal->where('id', $event_id)->first();
    }

    public function getAllEvent($data) {
        try {
            $user = $this->user();
            $user_calenders = $this->userCalendersListModal->where('user_id', $user->id)->get();
            if (count($user_calenders) > 0) {
                foreach ($user_calenders as $userCalendar) {
                    $getCalenderEvents = $this->getCalendarEvents($userCalendar->calender_id);
                    if (isset($getCalenderEvents['code']) && $getCalenderEvents['code'] === 404) {
                        $userCalendar->forceDelete();
                    } else {
                        $this->createOrUpdateEvent($getCalenderEvents, $userCalendar);
                    }
                }
            }
            $cps_calendar = $this->getCalendarEvents();
            if (isset($cps_calendar['code']) && $cps_calendar['code'] === 404) {
                // do something here (Pending)
            } else {
                if ($cps_calendar) {
                    $this->createOrUpdateEvent($cps_calendar);
                } else {
                    $calendar_events = CalendarEvent::where('user_id', $user->id)->where('google_calendar_event_id', '!=', null)->where('user_calender_id', null)->get();
                    foreach ($calendar_events as $calendar_event) {
                        $calendar_event->google_calendar_event_id = null;
                        $calendar_event->save();
                    }
                }
            }

            return $this->fetchAllEvents($data);

            // $all_events = UserCalendar::with(['event' => function ($query) use ($user) {
            //     $query->where('user_id', $user->id);
            // }])->whereBetween('start_date', [Carbon::parse($data['start'])->format('Y-m-d H:i:s'), Carbon::parse($data['end'])->format('Y-m-d H:i:s')])->get();
    
            // $final_arr = [];
    
            // foreach ($all_events as $event) {
            //     if (!empty($event->event)) {

            //         $final_end_date = null;
            //         if (isset($event->end_date)) {
            //             $event_end_date = Carbon::parse($event->end_date);
            //             $event_start_date = Carbon::parse($event->start_date);
            //             $final_end_date = $event_start_date->isSameDay($event_end_date) ? null : $event->end_date;
            //         }

            //         $event_arr['id'] = $event->id;
            //         $event_arr['title'] = $event->event->title;
            //         $event_arr['description'] = $event->event->description;
            //         $event_arr['time'] = $event->event->event_time;
            //         $event_arr['start'] = $event->start_date;
            //         $event_arr['color'] = $this->findColor($event->event->color);
            //         $event_arr['end'] = $final_end_date;
            //         $event_arr['allDay'] = date('H:i:s', strtotime($event->start_date)) == "00:00:00" ? true : false;
            //         array_push($final_arr, $event_arr);
            //     }
            // }
    
            // return $final_arr;
        } catch (\Exception $e) {
            dd($e);
            throw new Exception($e->getMessage());
        }
    }

    public function fetchAllEvents($data = []) {
        $user = $this->user();
        $all_events = UserCalendar::with(['event' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }]);

        if (isset($data['start']) && isset($data['end'])) {
            $all_events = $all_events->whereBetween('start_date', [Carbon::parse($data['start'])->format('Y-m-d H:i:s'), Carbon::parse($data['end'])->format('Y-m-d H:i:s')]);
        }

        $all_events = $all_events->get();

        $final_arr = [];

        foreach ($all_events as $event) {
            if (!empty($event->event)) {

                $final_end_date = null;
                if (isset($event->end_date)) {
                    $event_end_date = Carbon::parse($event->end_date);
                    $event_start_date = Carbon::parse($event->start_date);
                    $final_end_date = $event_start_date->isSameDay($event_end_date) ? null : $event->end_date;
                }

                $event_arr['id'] = $event->id;
                $event_arr['title'] = $event->event->title;
                $event_arr['description'] = $event->event->description;
                $event_arr['time'] = $event->event->event_time;
                $event_arr['start'] = $event->start_date;
                $event_arr['color'] = $this->findColor($event->event->color);
                $event_arr['end'] = $final_end_date;
                $event_arr['allDay'] = date('H:i:s', strtotime($event->start_date)) == "00:00:00" ? true : false;
                array_push($final_arr, $event_arr);
            }
        }

        return $final_arr;
    }

    public function createOrUpdateEvent($events, $usercalendar = null) {
        $events = collect($events);
        $eventsIds = $events->pluck('id')->toArray();
        foreach ($events as $event_key => $event) {
            $orgnizer = $event['organizer']['email'];
            $user_calendar = $this->userCalendersListModal->where([
                ['calender_id', '=', $orgnizer],
                ['user_id', '=', auth()->user()->id], 
            ])->first();
            $calendar_event = CalendarEvent::where('google_calendar_event_id', $event['id'])->first();
            $data = [
                'title' => $event['summary'] ? $event['summary'] : 'No Title',
                'description' => $event['description'],
                'event_time' => Carbon::parse($event['start']['dateTime'])->format('H:i:s'),
                'color' => $this->getColor($event['colorId']) ?? '#4c78dd',
                'is_assigned' => 1,
                'user_calender_id' => $user_calendar ? $user_calendar->id : null,
            ];
            $date_data = [];
            if ($event['start']['date']) {
                $date_data['start_date'] = Carbon::parse($event['start']['date'])->format('Y-m-d' . ' 00:00:00');
                $date_data['end_date'] = Carbon::parse($event['end']['date'])->format('Y-m-d' . ' 00:00:00');
            } else if ($event['start']['dateTime']) {
                $date_data['start_date'] = Carbon::parse($event['start']['dateTime'])->format('Y-m-d H:i:s');
                $date_data['end_date'] = Carbon::parse($event['end']['dateTime'])->format('Y-m-d H:i:s');
            }
            if ($calendar_event) {
                $calendar_event->update($data);
                $user_calender = UserCalendar::where('event_id', $calendar_event->id)->first();
                if ($user_calender) {
                    $user_calender->update($date_data);
                } else {
                    $date_data['event_id'] = $calendar_event->id;
                    $user_calender = UserCalendar::create($date_data);
                }
            } else {
                $data['user_id'] = $this->user()->id;
                $data['google_calendar_event_id'] = $event['id'];
                $calendar_event = CalendarEvent::create($data);
                $date_data['event_id'] = $calendar_event->id;
                $user_calender = UserCalendar::create($date_data);
            }
        }
        $delete_events = CalendarEvent::where('user_id', auth()->user()->id);
        if ($usercalendar) {
            $delete_events = $delete_events->where('user_calender_id', $usercalendar->id);
        } else {
            if ($this->googleAcount()) {
                $delete_events = $delete_events->where('user_calender_id', null)->where('google_calendar_event_id', '!=', null);
            } else {
                $delete_events = $delete_events->where('google_calendar_event_id', '!=', null);
            }
        }
        $delete_events = $delete_events->whereNotIn('google_calendar_event_id', $eventsIds)->get();
        
        foreach ($delete_events as $delete_event) {
            $user_calender = UserCalendar::where('event_id', $delete_event->id)->first();
            if ($user_calender) {
                $user_calender->delete();
                $delete_event->delete();
            }
        }
    }

    public function deleteSpecificCalendeEvent($calender_id) {

    }

    public function assignCalenderEvent($data, $optParams = []) {
        DB::beginTransaction();
        try {
            $payload = [
                'title' => $data['title'],
                'color' => $data['color'],
                'description' => $data['description'],
            ];

            if (isset($data['is_all_day'])) {
                $payload['start_date'] = $data['start_date'];
                $payload['end_date'] = $data['end_date'];    
                $payload['is_all_day'] = true;
            } else {
                $payload['is_all_day'] = false;
                $payload['start_date'] = $data['start_date'] . ' ' . $data['start_time'];
                $payload['end_date'] = $data['end_date'] . ' ' . $data['end_time'];
            }

            $optParams = [
                'is_all_day' => $payload['is_all_day'],
            ];

            $calenderEventId = null;
            $store_event_google = $this->insertEvent($payload, null, $optParams);
            if ($store_event_google) {
                $calenderEventId = $store_event_google->id;
            }
            $calender_event = $this->calenderEventModal->create([
                "user_id" => $this->user()->id,
                "title" => $data['title'],
                "color" => $data['color'],
                "description" => $data['description'],
                "event_time" => $data['time'] ?? null,
                "google_calendar_event_id" => $calenderEventId,
                "is_assigned" => 1
            ]);
            $user_calender = $this->userCalendarModal->create([
                "event_id" => $calender_event->id,
                "start_date" => Carbon::parse($payload['start_date'])->format('Y-m-d H:i:s'),
                "end_date" => Carbon::parse($payload['end_date'])->format('Y-m-d H:i:s')
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
            $end_date = $data['end_date'];
            if ($calender_event) {
                $calender_event_clone = $calender_event->toArray();
                $calender_event_clone['start_date'] = $start_date;
                $calenderEventId = null;
                $optParams = [
                    'is_all_day' => $this->isAllDay,
                ];
                $store_event_google = $this->insertEvent($calender_event_clone, null, $optParams);
                if ($store_event_google) {
                    $calenderEventId = $store_event_google->id;
                }
                $this->userCalendarModal->create([
                    "event_id" => $event_id,
                    "start_date" => $start_date,
                    "end_date" => $end_date
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
                $calendatId = null;
                if ($calender_event->user_calender_id) {
                    $calendatId = $calender_event->get_calender_from_list->calender_id;
                }
                $optParams = [
                    'is_all_day' => $this->isAllDay,
                ];
                $payload = [
                    "start_date" => $data['start_date'],
                    "end_date" => $data['end_date']
                ];
                $update_event_google = $this->updateEvent($calender_event->google_calendar_event_id, $payload, $calendatId, $optParams);
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
                    "description" => $data['description'],
                ];
                $calender_event->update($payload);
                if (isset($data['is_all_day'])) {
                    $payload['start_date'] = $data['start_date'];
                    $payload['end_date'] = $data['end_date'];    
                    $payload['is_all_day'] = true;
                } else {
                    $payload['is_all_day'] = false;
                    $payload['start_date'] = $data['start_date'] . ' ' . $data['start_time'];
                    $payload['end_date'] = $data['end_date'] . ' ' . $data['end_time'];
                }

                $optParams = [
                    'is_all_day' => $payload['is_all_day'],
                ];

                $user_calender->update([
                    "start_date" => Carbon::parse($payload['start_date'])->format('Y-m-d H:i:s'),
                    "end_date" => Carbon::parse($payload['end_date'])->format('Y-m-d H:i:s')
                ]);

                $calendarId = null;
                if ($calender_event->user_calender_id) {
                    $calendarId = $calender_event->get_calender_from_list->calender_id;
                }

                $this->updateEvent($calender_event->google_calendar_event_id, $payload, $calendarId, $optParams);
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