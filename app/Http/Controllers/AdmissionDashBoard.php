<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CollegeDetails;
use App\Models\CollegeList;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Worksheet;
use App\Models\CourseManagement\Milestone;
use App\Models\Courses;

class AdmissionDashBoard extends Controller
{
    public function index() {
        $user = Auth::user();
        $college_list_deadline = CollegeList::where('user_id', Auth::id())->with(['college_list_details' => function ($detail) {
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
        $worksheet_data = Worksheet::all();

        $courses = Courses::where('published', true)->whereHas('user_course_roles', function($query) use ($user) {
            $query->where('user_roles.id', $user->role);
        })->pluck('id')->toArray();

        $milestones = Milestone::getUserTypeWiseMilestones($courses)->orderBy('order')->get();

        return view('user.admin-dashboard.dashboard', [
            'college_list_deadline' => $college_list_deadline,
            'worksheet_data' => $worksheet_data,
            'milestones' => $milestones,
        ]);
    }
}
