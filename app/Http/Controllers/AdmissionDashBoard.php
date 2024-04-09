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
use App\Service\DashboardService;

class AdmissionDashBoard extends Controller
{

    public function __construct(DashboardService $dashboardService) {
        $this->dashboardService = $dashboardService;
    }

    public function index() {
        return view('user.admin-dashboard.dashboard', [
            'college_list_deadline' => $this->dashboardService->college_list_deadline(),
            'worksheet_data' => $this->dashboardService->worksheet_data(),
            'milestones' => $this->dashboardService->milestones(),
        ]);
    }
}
