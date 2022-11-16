<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use App\Models\UserCalendar;
use Illuminate\Http\Request;

class CalendarEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            $event_arr['end'] = date('Y-m-d', strtotime('+1 day', strtotime($event->end_date)));
            $event_arr['allDay'] = true;
            array_push($final_arr, $event_arr);
        }

        return view('user.calendar', compact('events', 'final_arr'));
    }

    public function findColor($color)
    {
        if($color == "info")
        {
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CalendarEvent  $calendarEvent
     * @return \Illuminate\Http\Response
     */
    public function show(CalendarEvent $calendarEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CalendarEvent  $calendarEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(CalendarEvent $calendarEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CalendarEvent  $calendarEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalendarEvent $calendarEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CalendarEvent  $calendarEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalendarEvent $calendarEvent)
    {
        //
    }
}
