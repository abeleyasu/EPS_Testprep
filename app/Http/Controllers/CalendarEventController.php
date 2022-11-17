<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use App\Models\UserCalendar;
use Illuminate\Http\Request;

class CalendarEventController extends Controller
{
    public function index()
    {
        $events = CalendarEvent::where('is_assigned',0)->get();
        $all_events = UserCalendar::with('event')->get();

        $final_arr = [];
        
        foreach($all_events as $event) {
            $event_arr['id'] = $event->id;
            $event_arr['title'] = $event->event->title;
            $event_arr['start'] = $event->start_date;
            $event_arr['color'] = $this->findColor($event->event->color);
            $event_arr['end'] = isset($event->end_date) ? date('Y-m-d H:i:s', strtotime('+1 day', strtotime($event->end_date))) : null;
            $event_arr['allDay'] = date('H:i:s', strtotime($event->start_date)) == "00:00:00" ? true : false;
            array_push($final_arr, $event_arr);
        }

        return view('user.calendar', compact('events', 'final_arr'));
    }

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

    public function store(Request $request)
    {
        $title = $request->title;

        $event = CalendarEvent::create([
            "title" => $title,
            "color" => $this->randomHexColor()
        ]);

        return response()->json(["success" => true, "data" => $event, "message" => "Event saved successfully"]);
    }

    public function randomHexColor()
    {
        $colors = ["success", "danger", "warning", "info"];
        return $colors[array_rand($colors)];
    }

    public function destroy($id)
    {
        CalendarEvent::whereId($id)->delete();

        return response()->json(["success" => true, "data" => $id, "message" => "Event deleted successfully"]);
    }
}
