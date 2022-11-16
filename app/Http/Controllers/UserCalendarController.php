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

        $userCalendar = UserCalendar::create([
            "event_id" => $event_id,
            "start_date" => $start_date
        ]);

        CalendarEvent::whereId($event_id)->update([
            "is_assigned" => 1
        ]);

        return response()->json(["success" => true, "data" => $userCalendar, "message" => "Event assign successfully"]);
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
    public function show(UserCalendar $userCalendar)
    {
        //
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
    public function updateEvent(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserCalendar  $userCalendar
     * @return \Illuminate\Http\Response
     */
    public function deleteEvent($id)
    {
        UserCalendar::whereId($id)->delete();

        return response()->json(["success" => true, "data" => $id, "message" => "Event deleted successfully"]);
    }
}
