<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use App\Models\UserCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PracticeTest;
use App\Models\TestScore;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Service\DashboardService;

class DashboardController extends Controller
{
    public function __construct(DashboardService $dashboardService) {
        $this->dashboardService = $dashboardService;
    }

    public function dashboard()
	{
        return view('user.dashboard', [
            'getTestScores' => $this->dashboardService->get_test_scores(),
            'events' => $this->dashboardService->events(),
            'final_arr' => $this->dashboardService->all_events(),
            'milestones' => $this->dashboardService->milestones(),
            'college_list_deadline' => $this->dashboardService->college_list_deadline(),
        ]);
	}

    public function test_prep_dashboard() {
        return view('student.test-prep-dashboard.dashboard', [
            'getTestScores' => $this->dashboardService->get_test_scores(),
            'events' => $this->dashboardService->events(),
            'final_arr' => $this->dashboardService->all_events(),
            'milestones' => $this->dashboardService->milestones(),
            'getAllPracticeTests' => $this->dashboardService->get_all_practice_tests(),
            'getOfficialPracticeTests' => $this->dashboardService->get_official_practice_tests(),
        ]);
    }

    public function admission_dashboard() {
        return view('user.admin-dashboard.dashboard', [
            'college_list_deadline' => $this->dashboardService->college_list_deadline(),
            'worksheet_data' => $this->dashboardService->worksheet_data(),
            'milestones' => $this->dashboardService->milestones(),
        ]);
    }
}
