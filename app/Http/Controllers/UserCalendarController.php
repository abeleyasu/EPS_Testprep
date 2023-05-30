<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use App\Models\UserCalendar;
use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $calendarEvent = CalendarEvent::create([
            "user_id" => Auth::id(),
            "title" => $title,
            "description" => $desc,
            "color" => $color,
            "is_assigned" => 1,
            'event_time' => $time
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

    /* Assign event to calendar */

    public function store(Request $request)
    {
        $event_id = $request->event_id;
        $start_date = $request->start_date;

        UserCalendar::create([
            "event_id" => $event_id,
            "start_date" => $start_date
        ]);

        CalendarEvent::whereId($event_id)->update([
            "is_assigned" => 1
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
        }

        return response()->json(["success" => true, "data" => $this->fetchAllEvents(), "message" => "Event updated successfully"]);
    }

    /* Delete Event Data */

    public function deleteEvent($id)
    {
        CalendarEvent::whereId($id)->update([
            "is_assigned" => 0
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
