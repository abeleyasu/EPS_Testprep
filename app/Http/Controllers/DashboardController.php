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
    private $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function dashboard()
    {
        // dd($this->dashboardService->college_list_deadline());
        $college_list_deadlines = $this->dashboardService->college_list_deadline();

        foreach ($college_list_deadlines as $key => $college_list_deadline) {
            $college_list_deadlines[$key]['deadline_date'] = $this->__getDeadlineDate($college_list_deadline);
        }

        return view('user.dashboard', [
            'getTestScores' => $this->dashboardService->get_test_scores(),
            'events' => $this->dashboardService->events(),
            'final_arr' => $this->dashboardService->all_events(),
            'milestones' => $this->dashboardService->milestones(),
            'college_list_deadline' => $college_list_deadlines,
            'google_calendar' => $this->dashboardService->google_calendar(),
        ]);
    }

    private function __getDeadlineDate($deadline)
    {
        $deadlineDate = null;

        if (
            isset($deadline['college_deadline']['admissions_deadline']) &&
            !empty($deadline['college_deadline']['admissions_deadline'])
        ) {
            $deadlineDate = $deadline['college_deadline']['admissions_deadline']; // month-day-year
            // convert to Y-m-d
            // $dateExplode = explode('-', $deadlineDate);
            // $deadlineDate = $dateExplode[2] . '-' . $dateExplode[0] . '-' . $dateExplode[1];

            try {
                $date = Carbon::createFromFormat("m-d-Y", $deadlineDate);
            } catch (\Throwable $th) {
                $date = Carbon::createFromFormat("Y-m-d", $deadlineDate);
            }

            $deadlineDate = $date->format('Y-m-d');

            // echo '0--> '. $deadlineDate . '<br>';
        } else {
            $adminissionOptionSelected = $deadline['college_deadline']['admission_option']; // Early Action, Early Decision 1, Early Decision 2, Regular Decision, Rolling Admission

            if (!empty($adminissionOptionSelected)) {
                // admission deadline:
                // Early Action: AP_DL_EACT_DAY, AP_DL_EACT_MON
                // Early Decision 1: AP_DL_EDEC_1_DAY, AP_DL_EDEC_1_MON
                // Early Decision 2: AP_DL_EDEC_2_DAY, AP_DL_EDEC_2_MON
                // Regular Decision: AP_DL_FRSH_DAY, AP_DL_FRSH_MON
                // Rolling Admission: No

                $collegeInformation = $deadline['college_information'];

                $deadlineDay = 0;
                $deadlineMonth = 0;

                if ($adminissionOptionSelected == 'Early Action') {
                    $deadlineDay = $collegeInformation['early_action_day'] ?: $collegeInformation['AP_DL_EACT_DAY'];
                    $deadlineMonth = $collegeInformation['early_action_month'] ?: $collegeInformation['AP_DL_EACT_MON'];
                } elseif ($adminissionOptionSelected == 'Early Decision 1') {
                    $deadlineDay =
                        $collegeInformation['early_decision_i_day'] ?: $collegeInformation['AP_DL_EDEC_1_DAY'];
                    $deadlineMonth =
                        $collegeInformation['early_decision_i_month'] ?: $collegeInformation['AP_DL_EDEC_1_MON'];
                } elseif ($adminissionOptionSelected == 'Early Decision 2') {
                    $deadlineDay =
                        $collegeInformation['early_decision_ii_day'] ?: $collegeInformation['AP_DL_EDEC_2_DAY'];
                    $deadlineMonth =
                        $collegeInformation['early_decision_ii_month'] ?: $collegeInformation['AP_DL_EDEC_2_MON'];
                } elseif ($adminissionOptionSelected == 'Regular Decision') {
                    $deadlineDay =
                        $collegeInformation['regular_decision_day'] ?: $collegeInformation['AP_DL_FRSH_DAY'];
                    $deadlineMonth =
                        $collegeInformation['regular_decision_month'] ?: $collegeInformation['AP_DL_FRSH_MON'];
                } elseif ($adminissionOptionSelected == 'Rolling Admission') {
                    //
                }

                if ($deadlineDay && $deadlineMonth) {
                    $year = date('Y');
                    $date = strtotime($year . '-' . $deadlineMonth . '-' . $deadlineDay);
                    if ($date < time()) {
                        $deadlineDate = $deadlineMonth . '-' . $deadlineDay . '-' . ($year + 1);
                    } else {
                        $deadlineDate = $deadlineMonth . '-' . $deadlineDay . '-' . $year;
                    }
                } else {
                    $deadlineDate = isset($collegeInformation['regular_admission_deadline'])
                        ? $collegeInformation['regular_admission_deadline']
                        : '';

                    if (!empty($deadlineDate)) {
                        $deadlineDate = date('Y-m-d', strtotime($deadlineDate));
                    }
                }
            }
        }


        $deadlineDateDiff = 0; // + or -
        $deadlineDateDiffLabel = ''; // Due in 123 days (dynamic)
        if (!empty($deadlineDate)) {
            // echo '1--> '. $deadlineDate . '<br>';
            $deadlineDateDiff = strtotime($deadlineDate) - time();

            if ($deadlineDateDiff > 0) {
                $deadlineDateDiffLabel = 'Due in ' . floor($deadlineDateDiff / (60 * 60 * 24)) . ' days';
            } else {

                // add 1 years from deadlineDate
                // $deadlineDate = date('Y-m-d', strtotime('+1 year', strtotime($deadlineDate)));
                // echo '2 --> '. $deadlineDate . '<br>';
                // $deadlineDateDiff = strtotime($deadlineDate) - time();
                // $deadlineDateDiffLabel = 'Due in ' . floor($deadlineDateDiff / (60 * 60 * 24)) . ' days';

                // set past due label
                $dueCountDay = floor(abs($deadlineDateDiff) / (60 * 60 * 24));
                $deadlineDateDiffLabel = 'Past due ' . $dueCountDay . ' days';
            }
        }

        if (!empty($deadlineDate)) {
            return [
                'date' => $deadlineDate,
                'dateInput' => date('m-d-Y', strtotime($deadlineDate)),
                'dateLabel' => date('F d, Y', strtotime($deadlineDate)),
                'diff' => $deadlineDateDiff,
                'diffLabel' => $deadlineDateDiffLabel,
            ];
        }

        return [
            'date' => '',
            'dateInput' => '',
            'dateLabel' => '',
            'diff' => '',
            'diffLabel' => '',
        ];
    }

    public function test_prep_dashboard()
    {
        return view('student.test-prep-dashboard.dashboard', [
            'getTestScores' => $this->dashboardService->get_test_scores(),
            'events' => $this->dashboardService->events(),
            'final_arr' => $this->dashboardService->all_events(),
            'milestones' => $this->dashboardService->milestones(),
            'getAllPracticeTests' => $this->dashboardService->get_all_practice_tests(),
            'getOfficialPracticeTests' => $this->dashboardService->get_official_practice_tests(),
            'google_calendar' => $this->dashboardService->google_calendar(),
        ]);
    }

    public function admission_dashboard()
    {
        $college_list_deadlines = $this->dashboardService->college_list_deadline();

        foreach ($college_list_deadlines as $key => $college_list_deadline) {
            $college_list_deadlines[$key]['deadline_date'] = $this->__getDeadlineDate($college_list_deadline);
        }

        return view('user.admin-dashboard.dashboard', [
            'college_list_deadline' => $college_list_deadlines,
            'worksheet_data' => $this->dashboardService->worksheet_data(),
            'milestones' => $this->dashboardService->milestones(),
        ]);
    }
}
