<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use App\Models\UserCalendar;
use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\GoogleCalendar\Event as GoogleCalendarEvent;
use Carbon\Carbon;
use App\Service\CalendarEventService;
use App\Http\Requests\CalendarEventRequest;

class UserCalendarController extends Controller
{
    /* Add Event and assign to calendar */

    protected $calendarEventService;

    public function __construct(CalendarEventService $calendarEventService) {
        $this->calendarEventService = $calendarEventService;
    }

    public function getAllEvent(Request $request) {
        try {
            return $this->calendarEventService->getAllEvent($request->all());
        } catch (\Exception $e) {
            return response()->json(["success" => false, "data" => "", "message" => $e->getMessage()]);
        }
    }

    public function addAssignEvent(CalendarEventRequest $request) {
        try {
            $is_user_is_connected_with_google = $this->calendarEventService->googleAcount();
            if ($is_user_is_connected_with_google) {
                $is_calender = $this->calendarEventService->isCalenderExist();
                if (!$is_calender) {
                    return response()->json(["success" => false, "data" => "", "message" => "We could not find 'College Prep System' calendar in your google account. Please create a calendar first."]);
                }
            }
            $createEvent = $this->calendarEventService->assignCalenderEvent($request->all());
            if ($createEvent) {
                return response()->json(["success" => true, "data" => $this->fetchAllEvents(), "message" => "Event assigned successfully"]);
            } else {
                return response()->json(["success" => false, "data" => "", "message" => "Something went wrong"]);
            }
        } catch (\Exception $e) { 
            return response()->json(["success" => false, "data" => "", "message" => $e->getMessage()]);
        }
    }

    /* Fetch all event and display in calendar */

    public function fetchAllEvents()
    {
        $events = $this->calendarEventService->fetchAllEvents();
        // $all_events = UserCalendar::with(['event' => function($query){
        //     $query->where('user_id', Auth::id());
        // }])->get();

        // $final_arr = [];
        
        // foreach($all_events as $event) {
        //     if(!empty($event->event)) {

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
        //         $event_arr['end'] = isset($event->end_date) ? date('Y-m-d H:i:s', strtotime('+1 day', strtotime($event->end_date))) : null;
        //         $event_arr['allDay'] = date('H:i:s', strtotime($event->start_date)) == "00:00:00" ? true : false;
        //         array_push($final_arr, $event_arr);
        //     }
        // }

        return json_decode(json_encode($events), FALSE);
    }

    /* Find color by color class */

    public function findColor($color)
    {
        if($color == "info") {
            $c_code = "#0891b2";
        } else if($color == "warning") {
            $c_code = "#e04f1a";
        } else if($color == "success") {
            $c_code = "#82b54b";
        } else if($color == "danger") {
            $c_code = "#dc2626";
        } else {
            $c_code = "#4c78dd";
        }

        return $c_code;
    }
    
    /* Assign event to calendar */

    public function store(Request $request) {
        try {
            $is_user_is_connected_with_google = $this->calendarEventService->googleAcount();
            if ($is_user_is_connected_with_google) {
                $is_calender = $this->calendarEventService->isCalenderExist();
                if (!$is_calender) {
                    return response()->json(["success" => false, "data" => "", "message" => "We could not find 'College Prep System' calendar in your google account. Please create a calendar first."]);
                }
            }
            $event_id = $request->event_id;
            $createEvent = $this->calendarEventService->createCalenderEvent($request->all(), $event_id);
            if ($createEvent) {
                return response()->json(["success" => true, "data" => $this->fetchAllEvents(), "message" => "Event assigned successfully"]);
            } else {
                return response()->json(["success" => false, "data" => "", "message" => "Something went wrong"]);
            }
        } catch (\Exception $e) { 
            return response()->json(["success" => false, "data" => "", "message" => $e->getMessage()]);
        }
    }

    /* resize event data and update value */

    public function resizeEvent(Request $request)
    {
        $is_user_is_connected_with_google = $this->calendarEventService->googleAcount();
        if ($is_user_is_connected_with_google) {
            $is_calender = $this->calendarEventService->isCalenderExist();
            if (!$is_calender) {
                return response()->json(["success" => false, "data" => "", "message" => "We could not find 'College Prep System' calendar in your google account. Please create a calendar first."]);
            }
        }
        $id = $request->id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $resizeEvent = $this->calendarEventService->resizeEvent($request->all(), $id);
        if ($resizeEvent) {
            return response()->json(["success" => true, "data" => "", "message" => "Event date updated successfully"]);
        } else {
            return response()->json(["success" => false, "data" => "", "message" => "Something went wrong"]);
        }
    }

    /* Get event using ID */

    public function getEventById($id)
    {
        $userCalendar = UserCalendar::whereId($id)->with('event')->first();

        return response()->json(["success" => true, "data" => $userCalendar, "message" => ""]);
    }

    /* Update Event Data */

    public function updateEvent(Request $request, $id)
    {
        // dd($request->all());
        try {
            $is_user_is_connected_with_google = $this->calendarEventService->googleAcount();
            if ($is_user_is_connected_with_google) {
                $is_calender = $this->calendarEventService->isCalenderExist();
                if (!$is_calender) {
                    return response()->json(["success" => false, "data" => "", "message" => "We could not find 'College Prep System' calendar in your google account. Please create a calendar first."]);
                }
            }
            $updateEvent = $this->calendarEventService->updateCalenderEvent($request->all(), $id);
            if ($updateEvent) {
                return response()->json(["success" => true, "data" => $this->fetchAllEvents(), "message" => "Event updated successfully"]);
            } else {
                return response()->json(["success" => false, "data" => "", "message" => "Something went wrong"]);
            }
        } catch (\Exception $e) {
            return response()->json(["success" => false, "data" => "", "message" => $e->getMessage()]);
        }
    }

    /* Delete Event Data */

    public function deleteEvent($id) {
        try {
            $is_user_is_connected_with_google = $this->calendarEventService->googleAcount();
            if ($is_user_is_connected_with_google) {
                $is_calender = $this->calendarEventService->isCalenderExist();
                if (!$is_calender) {
                    return response()->json(["success" => false, "data" => "", "message" => "We could not find 'College Prep System' calendar in your google account. Please create a calendar first."]);
                }
            }
            $deleteEvent = $this->calendarEventService->deleteCalenderEvent($id);
            if ($deleteEvent) {
                $data['fetchAllEvents'] = $this->fetchAllEvents();
                $data['event'] = $deleteEvent;
                return response()->json(["success" => true, "data" => $data, "message" => "Event deleted successfully"]);
            } else {
                return response()->json(["success" => false, "data" => "", "message" => "Something went wrong"]);
            }
        } catch (\Exception $e) {
            return response()->json(["success" => false, "data" => "", "message" => $e->getMessage()]);
        }
    }
}
