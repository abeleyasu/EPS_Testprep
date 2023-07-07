<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CalendarEvent;
use App\Models\UserCalendar;
use App\Models\Reminder;

class RemoveCustomReminder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reminder = Reminder::where('type', 'custom')->get()->toArray();
        if (count($reminder) > 0) {
            $reminder_id = array_column($reminder, 'id');
            Reminder::whereIn('id', $reminder_id)->delete();
        }
        $events = CalendarEvent::where('reminders_id', '!=', 0)->get()->toArray();
        if (count($events) > 0) {
            $event_id = array_column($events, 'id');
            UserCalendar::whereIn('event_id', $event_id)->delete();
            CalendarEvent::whereIn('id', $event_id)->delete();
        }
    }
}
