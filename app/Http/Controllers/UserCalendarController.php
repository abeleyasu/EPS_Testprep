<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use App\Models\UserCalendar;
use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\GoogleCalendar\Event as GoogleCalendarEvent;
use Carbon\Carbon;

class UserCalendarController extends Controller
{
    /* Add Event and assign to calendar */

    public function addAssignEvent(Request $request)
    {
        $title = $request->title;
        $color = $request->color;
        $time = $request->time;
        $desc = $request->desc;
        $start_date = $request->start_date;

        //sbz change starts
        $event_start_date = strtotime($request->start_date);
        $event_time = strtotime($time);
        $start_date = date('Y-m-d', $event_start_date) . ' ' . date('H:i:s', $event_time);
        //sbz change ends

        $end_date = isset($request->end_date) ? $request->end_date : null;

        //Add Event on google calendar starts
        $startDateTime = Carbon::parse($start_date);
        $endDateTime = clone $startDateTime;
        $endDateTime->addMinutes(30);

        $google_calendar_event = new GoogleCalendarEvent;
        $google_calendar_event->name = $title;
        $google_calendar_event->description = $desc;
        $google_calendar_event->startDateTime = $startDateTime;
        $google_calendar_event->colorId = $this->google_calendar_findColor($color);
        $google_calendar_event->endDateTime = $endDateTime;
        $newEvent = $google_calendar_event->save();
        $lastInsertedGoogleCalenderEventId = $newEvent->id;
        //Add Event on google calendar ends


        $calendarEvent = CalendarEvent::create([
            "user_id" => Auth::id(),
            "title" => $title,
            "description" => $desc,
            "color" => $color,
            "is_assigned" => 1,
            'event_time' => $time,
            'google_calendar_event_id' => $lastInsertedGoogleCalenderEventId
        ]);

        UserCalendar::create([
            "event_id" => $calendarEvent->id,
            "start_date" => $start_date,
            "end_date" => $end_date,
        ]);

        return response()->json(["success" => true, "data" => $this->fetchAllEvents(), "message" => "Event assigned successfully"]);
    }

    /* Fetch all event and display in calendar */

    public function fetchAllEvents()
    {
        $all_events = UserCalendar::with(['event' => function($query){
            $query->where('user_id', Auth::id());
        }])->get();

        $final_arr = [];
        
        foreach($all_events as $event) {
            if(!empty($event->event)) {
                $event_arr['id'] = $event->id;
                $event_arr['title'] = $event->event->title;
                $event_arr['description'] = $event->event->description;
                $event_arr['time'] = $event->event->event_time;
                $event_arr['start'] = $event->start_date;
                $event_arr['color'] = $this->findColor($event->event->color);
                $event_arr['end'] = isset($event->end_date) ? date('Y-m-d H:i:s', strtotime('+1 day', strtotime($event->end_date))) : null;
                $event_arr['allDay'] = date('H:i:s', strtotime($event->start_date)) == "00:00:00" ? true : false;
                array_push($final_arr, $event_arr);
            }
        }

        return json_decode(json_encode($final_arr), FALSE);
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

    /* Assign event to calendar */

    public function store(Request $request)
    {
        $event_id = $request->event_id;
        $start_date = $request->start_date;

        $calendarEvent = CalendarEvent::whereId($event_id)->first();
        $lastInsertedGoogleCalenderEventId = "";
        if (!empty($calendarEvent)) {
            //Add Event on google calendar starts
            $startDateTime = Carbon::parse($start_date);
            $endDateTime = clone $startDateTime;
            $endDateTime->addMinutes(30);

            $event = new GoogleCalendarEvent;
            $event->name = $calendarEvent->title;
            $event->description = $calendarEvent->description;
            $event->startDateTime = $startDateTime;
            $event->colorId = $this->google_calendar_findColor($calendarEvent->color);
            $event->endDateTime = $endDateTime;
            $newEvent = $event->save();
            $lastInsertedGoogleCalenderEventId = $newEvent->id;
            //Add Event on google calendar ends
        }

        UserCalendar::create([
            "event_id" => $event_id,
            "start_date" => $start_date
        ]);


        CalendarEvent::whereId($event_id)->update([
            "is_assigned" => 1,
            "google_calendar_event_id" => $lastInsertedGoogleCalenderEventId
        ]);

        return response()->json(["success" => true, "data" => $this->fetchAllEvents(), "message" => "Event assigned successfully"]);
    }

    /* resize event data and update value */

    public function resizeEvent(Request $request)
    {
        $id = $request->id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        UserCalendar::whereId($id)->update([
            "start_date" => $start_date,
            "end_date" => $end_date
        ]);

        return response()->json(["success" => true, "data" => "", "message" => "Event edited successfully"]);
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
        $title = $request->title;
        $color = $request->color;
        $time = $request->time;
        $desc = $request->desc;

        CalendarEvent::whereId($id)->update([
            "title" => $title,
            "color" => $color,
            "description" => $desc,
            "event_time" => $time
        ]);

        $userCalendar = UserCalendar::where('event_id', $id)->first();
        if ($userCalendar) {
            $event_start_date = strtotime($userCalendar->start_date);
            $event_time = strtotime($time);
            $start_date = date('Y-m-d', $event_start_date) . ' ' . date('H:i:s', $event_time);
            // Update the start_date time of the UserCalendar record
            $userCalendar->start_date = $start_date;
            $userCalendar->save();

            $startDateTime = Carbon::parse($start_date);
            $endDateTime = clone $startDateTime;
            $endDateTime->addMinutes(30);

            //Update in google calendar
            $googleCalendarEventId = CalendarEvent::find($id)->google_calendar_event_id;
            if(isset($googleCalendarEventId) && $googleCalendarEventId != null) {   
                $google_calendar_event = GoogleCalendarEvent::find($googleCalendarEventId);

                $google_calendar_event->update([
                    'name' => $title,
                    "description" => $desc,
                    "startDateTime" => $startDateTime,
                    "colorId" => $this->google_calendar_findColor($color),
                    "endDateTime" => $endDateTime,
                ]);
            } 
            else {
                //Add Event on google calendar starts
                $google_calendar_event = new GoogleCalendarEvent;
                $google_calendar_event->name = $title;
                $google_calendar_event->description = $desc;
                $google_calendar_event->startDateTime = $startDateTime;
                $google_calendar_event->colorId = $this->google_calendar_findColor($color);
                $google_calendar_event->endDateTime = $endDateTime;
                $newEvent = $google_calendar_event->save();
                $lastInsertedGoogleCalenderEventId = $newEvent->id;
                //Add Event on google calendar ends
                CalendarEvent::whereId($id)->update([
                    "google_calendar_event_id" => $lastInsertedGoogleCalenderEventId
                ]);
            }
        }


        return response()->json(["success" => true, "data" => $this->fetchAllEvents(), "message" => "Event updated successfully"]);
    }

    /* Delete Event Data */

    public function deleteEvent($id)
    {
        $googleCalendarEventId = CalendarEvent::find($id)->google_calendar_event_id;
        $google_calendar_event = GoogleCalendarEvent::find($googleCalendarEventId);
        $google_calendar_event->delete();

        CalendarEvent::whereId($id)->update([
            "is_assigned" => 0,
            "google_calendar_event_id" => ""
        ]);

        $calendarEvent = CalendarEvent::whereId($id)->first();

        if($calendarEvent->reminders_id > 0) {
            $reminder = Reminder::findOrFail($calendarEvent->reminders_id);
            $reminder->update(['enabled' => 0]);


        }

        UserCalendar::where('event_id', $id)->delete();

        $data['fetchAllEvents'] = $this->fetchAllEvents();
        $data['event'] = $calendarEvent;

        return response()->json(["success" => true, "data" => $data, "message" => "Event deleted successfully"]);
    }
}
