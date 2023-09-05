<?php 

namespace App\Service;

use Illuminate\Support\ServiceProvider;
use Exception;
use App\Models\CourseManagement\Milestone;
use App\Models\Courses;
use Illuminate\Support\Facades\Auth;
use App\Models\Worksheet;
use Carbon\Carbon;
use App\Models\CollegeList;
use App\Models\PracticeTest;
use App\Models\TestScore;
use App\Models\CalendarEvent;
use App\Models\UserCalendar;
use App\Service\GoogleService;

class DashboardService extends GoogleService
{
    public function user() {
        return Auth::user();
    }

    public function milestones() {
        $user = $this->user();
        $courses = Courses::where('published', true)->whereHas('user_course_roles', function($query) use ($user) {
            $query->where('user_roles.id', $user->role);
        })->pluck('id')->toArray();

        $milestones = Milestone::getUserTypeWiseMilestones($courses)->orderBy('order')->where('is_addmission_lesson', true)->get();

        if (count($milestones) > 0) {
            foreach ($milestones as $mKey => $milestone) {
                $milestones[$mKey]['total_completed_task_per'] = $milestone->task_completed_per();
                $milestones[$mKey]['total_module'] = $milestone->modules()->count();
                $milestones[$mKey]['total_completed_module'] = $milestone->total_completed_module();
                $milestones[$mKey]['total_completed_module_per'] = $milestone->total_completed_module() > 0 ? floor(($milestone->total_completed_module() / $milestone->modules()->count()) * 100) : 0;
                unset($milestones[$mKey]['modules']);
            }
        }
        // dd($milestones->toArray());
        return $milestones;
    }

    public function worksheet_data() {
        return Worksheet::all();
    }

    public function college_list_deadline() {
        $user = $this->user();
        $college_list_deadline = CollegeList::where('user_id', $user->id)->with(['college_list_details' => function ($detail) {
            $detail->where('is_active', true)->orderBy('order_index')->with(['collegeDeadline', 'collegeInformation']);
        }])->first();
        if ($college_list_deadline) {
            $college_list_deadline = $college_list_deadline->toArray();
            $college_list_deadline = $college_list_deadline['college_list_details'];
            foreach ($college_list_deadline as $key => $deadline) {
                $college_information_deadline = $deadline['college_information']['regular_admission_deadline'];
                if ($college_information_deadline) {
                    $date = Carbon::createFromFormat('m-d-Y', $college_information_deadline);
                    $days = $date->diffInDays(Carbon::now());
                    $college_list_deadline[$key]['college_information']['regular_admission_deadline'] = $date->format('m-d-Y');
                    $college_list_deadline[$key]['college_deadline']['admissions_deadline_diff'] = 'Due in '. $days . ' days';
                }
            }
        } else {
            $college_list_deadline = [];
        }
        return $college_list_deadline;
    }

    public function get_all_practice_tests() {
        return PracticeTest::where('test_source', 0)->get();
    }

    public function get_official_practice_tests() {
        return PracticeTest::where('test_source', 1)->get();
    }

    public function get_test_scores() {
        $user = $this->user();
        return TestScore::where('user_id', $user->id)->first();
    }

    public function events() {
        $user = $this->user();
        return CalendarEvent::where('user_id', $user->id)->where('is_assigned', 0)->get();
    }

    public function google_calendar() {
        $user = $this->user();
        if ($user->googleAccount) {
            $getSingleCalender = $this->getSingleCalendar($user->googleAccount->google_calendar_id);
            return $getSingleCalender;
        } else {
            return null;
        }
    }

    public function all_events() {
        $user = $this->user();
        $all_events = UserCalendar::with(['event' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->get();

        $final_arr = [];

        foreach ($all_events as $event) {
            if (!empty($event->event)) {
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

        return $final_arr;
    }

    public function findColor($color) {
        if ($color == "info") {
            $c_code = "#0891b2";
        } else if ($color == "warning") {
            $c_code = "#e04f1a";
        } else if ($color == "success") {
            $c_code = "#82b54b";
        } else if ($color == "danger") {
            $c_code = "#dc2626";
        } else {
            $c_code = "#4c78dd";
        }

        return $c_code;
    }
}
?>