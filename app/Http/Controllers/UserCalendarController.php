<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use App\Models\UserCalendar;
use Illuminate\Http\Request;

class UserCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function fetchAllEvents()
    {
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

        return json_decode(json_encode($final_arr), FALSE);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCalendar  $userCalendar
     * @return \Illuminate\Http\Response
     */
    public function getEventById($id)
    {
        $userCalendar = UserCalendar::whereId($id)->with('event')->first();

        return response()->json(["success" => true, "data" => $userCalendar, "message" => ""]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserCalendar  $userCalendar
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCalendar $userCalendar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserCalendar  $userCalendar
     * @return \Illuminate\Http\Response
     */
    public function updateEvent(Request $request, $id)
    {
        $title = $request->title;
        $color = $request->color;

        CalendarEvent::whereId($id)->update([
            "title" => $title,
            "color" => $color
        ]);

        return response()->json(["success" => true, "data" => $this->fetchAllEvents(), "message" => "Event updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserCalendar  $userCalendar
     * @return \Illuminate\Http\Response
     */
    public function deleteEvent($id)
    {
        CalendarEvent::whereId($id)->update([
            "is_assigned" => 0
        ]);

        $calendarEvent = CalendarEvent::whereId($id)->first();

        UserCalendar::where('event_id', $id)->delete();

        $data['fetchAllEvents'] = $this->fetchAllEvents();
        $data['event'] = $calendarEvent;

        return response()->json(["success" => true, "data" => $data, "message" => "Event deleted successfully"]);
    }
}
