<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CollegeInformation;
use App\Models\CollegeDetails;
use App\Models\CollegeList;
use App\Models\CollegeSearchAdd;
use App\Models\Reminder;
use App\Models\ReminderType;
use App\Models\CalendarEvent;
use App\Models\UserCalendar;
use Carbon\Carbon;
use App\Service\GoogleService;

use function PHPUnit\Framework\isJson;

class CollegeApplicationDeadlineController extends Controller
{
    protected $googleService;

    public function __construct(GoogleService $googleService)
    {
        $this->googleService = $googleService;
    }

    public function index()
    {
        $college_list_deadline = CollegeDetails::where('user_id', '=', Auth::id())->whereHas('college_details', function ($q) {
            $q->where('is_active', true);
        })->with(['college_details'])->get();
        $selectedCollegeId = $college_list_deadline->pluck('college_details.college_id')->toArray();
        $college_list = CollegeInformation::orderBy('name')->whereNotIn('college_id', $selectedCollegeId)->get();
        $college = CollegeList::where('user_id', Auth::id())->first();

        return view('user.admin-dashboard.college-application-deadline', [
            'applications' => config('constants.types_of_application'),
            'admision_option' => config('constants.admission_options'),
            'college_list_status' => config('constants.college_list_status'),
            'college_list_deadline' => $college_list_deadline,
            'college_list' => $college_list,
            'selected_college_id' => $selectedCollegeId,
            'college' => $college
        ]);
    }

    public function getApplicationDeadlineData()
    {
        try {
            $college_list_deadline = CollegeList::where('user_id', Auth::id())
                ->with(['college_list_details' => function ($detail) {
                    $detail->where('is_active', true)->orderBy('order_index')->with(['collegeDeadline']);
                }])->first();

            return [
                'success' => true,
                'data' => $college_list_deadline ? $college_list_deadline->college_list_details->toArray() : [],
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Oops! Something went wrong',
            ];
        }
    }

    // reset to inital value (admin / peterson data)
    public function resetApplicationDeadlineData(Request $request)
    {

        // validate the input data
        $request->validate([
            'id' => 'nullable|exists:college_search_adds,id',
        ], [
            'id.exists' => 'Data not found'
        ]);

        $collegDetailID = $request->id;

        try {

            if (!empty($collegDetailID)) {
                $collegeListData = CollegeList::where('user_id', Auth::id())
                    ->with(['college_list_details' => function ($detail) use ($collegDetailID) {
                        return $detail
                            ->where('is_active', true)
                            ->where('id', $collegDetailID)
                            ->orderBy('order_index')
                            ->with(['collegeDeadline', 'collegeInformation']);
                    }])
                    ->first();

                $collegeSearchAddsData = $collegeListData->college_list_details;
            } else {
                $collegeListData = CollegeList::where('user_id', Auth::id())
                    ->with(['college_list_details' => function ($detail) {
                        return $detail
                            ->where('is_active', true)
                            ->orderBy('order_index')
                            ->with(['collegeDeadline', 'collegeInformation']);
                    }])
                    ->first();

                $collegeSearchAddsData = $collegeListData->college_list_details;
            }

            // dd($collegeSearchAddsData);

            if ($collegeSearchAddsData) {
                foreach ($collegeSearchAddsData as $key => $value) {

                    // update college details data (collegeDeadline) || im also confused with this naming table and model -__-
                    $value->collegeDeadline->update([
                        'type_of_application' => '',
                        'admission_option' => '',
                        'admissions_deadline' => '',
                        'number_of_essaya' => $value->collegeInformation->number_of_essaya,
                        'ad_status' => 0,
                        'competitive_scholarship_deadline' => $value->collegeInformation->competitive_scholarship_deadline,
                        'csd_status' => 0,
                        'departmental_scholarship_deadline' => '',
                        'dsd_status' => 0,
                        'honors_college_deadline' => $value->collegeInformation->honors_college_deadline,
                        'hcd_status' => 0,
                        'fafsa_deadline' => $value->collegeInformation->fafsa_deadline,
                        'fafsa_status' => 0,
                        'css_profile_deadline' => $value->collegeInformation->css_profile_deadline,
                        'css_status' => 0,
                        'is_application_checklist' => 0,
                        'is_completed_application' => 0,
                        'is_request_pay' => 0,
                        'is_high_school_transcript' => 0,
                        'is_letter_of_recommedation' => 0,
                        'is_your_offical_high_school_transcripts' => 0,
                        'is_school_report_and_counselor' => 0,
                        'is_test_scores_sent' => 0,
                        'is_letters_of_recommendation_submitted' => 0,
                        'is_pay_application_fee' => 0,
                        'is_submit_application' => 0,
                    ]);
                }
            }

            return [
                'success' => true,
                'message' => 'Application deadline reset successfully',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Oops! Something went wrong',
            ];
        }
    }

    public function getSingleApplicationData($id)
    {
        try {
            $college_list_deadline = CollegeDetails::where('id', '=', $id)->first();
            if (!$college_list_deadline) {
                return response()->json([
                    'success' => false,
                    'message' => 'College not found',
                ]);
            }
            // return $college_list_deadline;
            $deadline_date = null;
            if ($college_list_deadline->college_details->collegeInformation) {
                // $deadline_date = $college_list_deadline->college_details->collegeInformation->regular_admission_deadline;
            }
            $college_list_deadline = $college_list_deadline->toArray();
            $college_list_deadline['admissions_deadline'] = $college_list_deadline['admissions_deadline'] ? $college_list_deadline['admissions_deadline'] : $deadline_date;
            return response()->json([
                'success' => true,
                'data' => $college_list_deadline,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Oops! Something went wrong',
            ]);
        }
    }

    public function list(Request $request)
    {
        $page = isset($request->page) ? $request->page : 1;
        $search = isset($request->search) ? $request->search : null;
        $limit = $page * 25;

        $college_list = CollegeInformation::orderBy('name');

        if (!isset($request->all)) {
            $college_list_deadline = CollegeList::where('user_id', Auth::id())->with(['college_list_details'])->first();
            if ($college_list_deadline) {
                $selectedCollegeId = $college_list_deadline->college_list_details->pluck('college_id')->toArray();
                $college_list = $college_list->whereNotIn('college_id', $selectedCollegeId);
            }
        }

        if (!empty($search)) {
            $college_list = $college_list->where(function ($list) use ($search) {
                return $list->where('name', 'LIKE', "%{$search}%");
            });
        }

        $college_list = $college_list->paginate($limit);

        $college_list = $college_list->toArray();

        return $college_list;
    }

    public function college_save(Request $request)
    {
        $id =  Auth::id();
        // Validate the input data
        $request->validate([
            'college' => 'required',
        ], [
            'college.required' => 'Please select college',
        ]);
        $data = [
            'user_id' => $id,
            'college_id' => $request->college,
        ];
        $college = CollegeDetails::create($data);
        return redirect()->back()->with('success', 'College added successfully');
    }

    public function create($request)
    {

        $request->validate([
            'admissions_deadline' => 'nullable|date_format:m-d-Y',
            'competitive_scholarship_deadline' => 'nullable|date_format:m-d-Y',
            'departmental_scholarship_deadline' => 'nullable|date_format:m-d-Y',
            'honors_college_deadline' => 'nullable|date_format:m-d-Y',
            'fafsa_deadline' => 'nullable|date_format:m-d-Y',
            'css_profile_deadline' => 'nullable|date_format:m-d-Y',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();


        if ($request->admissions_deadline) {
            $deadline = $request->admissions_deadline;
            try {
                $date = Carbon::createFromFormat("m-d-Y", $deadline);
            } catch (\Throwable $th) {
                $date = Carbon::createFromFormat("Y-m-d", $deadline);
            }
            if ($date->isPast()) {
                $date->addYear();
            }
            $data['admissions_deadline'] = $date->format('m-d-Y');
            $request->admissions_deadline = $data['admissions_deadline'];
        } else {
            $data['admissions_deadline'] = null;
        }

        $college = CollegeDetails::create($data);
        $this->setReminderAndAddIntoCalendor($data);
    }

    public function edit($request)
    {

        $data = [
            'type_of_application' => $request->type_of_application,
            'admission_option' => $request->admission_option,
            'number_of_essaya' => $request->number_of_essaya,
            'admissions_deadline' => $request->admissions_deadline,
            'ad_status' => $request->ad_status,
            'competitive_scholarship_deadline' => $request->competitive_scholarship_deadline,
            'csd_status' => $request->csd_status,
            'departmental_scholarship_deadline' => $request->departmental_scholarship_deadline,
            'dsd_status' => $request->dsd_status,
            'honors_college_deadline' => $request->honors_college_deadline,
            'hcd_status' => $request->hcd_status,
            'fafsa_deadline' => $request->fafsa_deadline,
            'fafsa_status' => $request->fafsa_status,
            'css_profile_deadline' => $request->css_profile_deadline,
            'css_status' => $request->css_status,
            'is_application_checklist' => $request->is_application_checklist ? $request->is_application_checklist : 0,
            'is_completed_application' => $request->is_completed_application ? $request->is_completed_application : 0,
            'is_request_pay' => $request->is_request_pay ? $request->is_request_pay : 0,
            'is_high_school_transcript' => $request->is_high_school_transcript ? $request->is_high_school_transcript : 0,
            'is_letter_of_recommedation' => $request->is_letter_of_recommedation ? $request->is_letter_of_recommedation : 0,
            'is_your_offical_high_school_transcripts' => $request->is_your_offical_high_school_transcripts ? $request->is_your_offical_high_school_transcripts : 0,
            'is_school_report_and_counselor' => $request->is_school_report_and_counselor ? $request->is_school_report_and_counselor : 0,
            'is_test_scores_sent' => $request->is_test_scores_sent ? $request->is_test_scores_sent : 0,
            'is_letters_of_recommendation_submitted' => $request->is_letters_of_recommendation_submitted ? $request->is_letters_of_recommendation_submitted : 0,
            'is_pay_application_fee' => $request->is_pay_application_fee ? $request->is_pay_application_fee : 0,
            'is_submit_application' => $request->is_submit_application ? $request->is_submit_application : 0,
            'is_received_application' => $request->is_received_application ? $request->is_received_application : 0,
            'is_complete_application_type' => $request->is_complete_application_type ? $request->is_complete_application_type : 0,
            'is_complete_admission_open' => $request->is_complete_admission_open ? $request->is_complete_admission_open : 0,
            'is_complete_number_of_essays' => $request->is_complete_number_of_essays ? $request->is_complete_number_of_essays : 0,
            'is_complete_admission_deadline' => $request->is_complete_admission_deadline ? $request->is_complete_admission_deadline : 0,
            'is_complete_competitive_scholarship_deadline' => $request->is_complete_competitive_scholarship_deadline ? $request->is_complete_competitive_scholarship_deadline : 0,
            'is_complete_scholarship_deadline' => $request->is_complete_scholarship_deadline ? $request->is_complete_scholarship_deadline : 0,
            'is_completed_honors_college_deadline' => $request->is_completed_honors_college_deadline ? $request->is_completed_honors_college_deadline : 0,
            'is_completed_fafsa_deadline' => $request->is_completed_fafsa_deadline ? $request->is_completed_fafsa_deadline : 0,
            'is_completed_css_profile_deadline' => $request->is_completed_css_profile_deadline ? $request->is_completed_css_profile_deadline : 0,
            'is_completed_final_admissions_decision' => $request->is_completed_final_admissions_decision ? $request->is_completed_final_admissions_decision : 0,
            'is_completed_all_process' => $request->is_completed_all_process ? $request->is_completed_all_process : 0,
        ];

        $request->validate([
            'admissions_deadline' => 'nullable|date_format:m-d-Y',
            'competitive_scholarship_deadline' => 'nullable|date_format:m-d-Y',
            'departmental_scholarship_deadline' => 'nullable|date_format:m-d-Y',
            'honors_college_deadline' => 'nullable|date_format:m-d-Y',
            'fafsa_deadline' => 'nullable|date_format:m-d-Y',
            'css_profile_deadline' => 'nullable|date_format:m-d-Y',
        ]);

        $collegeDetail = CollegeDetails::where('id', $request->college_detail_id)->first();

        // $appOrganizerData = isJson($request->app_organizer_json) ? json_decode($request->app_organizer_json, true) : [];

        // $collegeInfoTemp = isset($appOrganizerData['college_details']['college_information']) ? $appOrganizerData['college_details']['college_information'] : null;
        // if (!empty($collegeInfoTemp)) {
        //     $collegeInformation = CollegeInformation::where('id', $collegeInfoTemp['id'])->first();
        // } else {
        //     $collegeInformation = $collegeDetail->college_details->collegeInformation;
        // }
        $collegeInformation = $collegeDetail->college_details->collegeInformation;

        // dd($collegeInformation);

        // check if $request->admissions_deadline is already passed, then set to +1 year
        if ($request->admissions_deadline) {
            $deadline = $request->admissions_deadline;
            try {
                $date = Carbon::createFromFormat("m-d-Y", $deadline);
            } catch (\Throwable $th) {
                $date = Carbon::createFromFormat("Y-m-d", $deadline);
            }
            if ($date->isPast()) {
                $date->addYear();
            }

            $data['is_admission_deadline_from_user'] = false;

            $deadlineFromSystem = $this->__getDeadlineDate([
                'request_data' => $request->all(),
                'college_detail' => $collegeDetail,
                'college_information' => $collegeInformation
            ]);

            // check if admissions_deadline same as system
            // if (isset($deadlineFromSystem['date']) && $deadlineFromSystem['date'] == $data['admissions_deadline']) {
            //     $data['is_admission_deadline_from_user'] = false;
            //     $data['admissions_deadline'] = $deadlineFromSystem['date'];
            // } else {
            //     $data['admissions_deadline'] = $date->format('m-d-Y');
            //     $data['is_admission_deadline_from_user'] = true;
            // }

            if ($collegeDetail->admission_option == $request->admission_option) {
                // echo 'same option';
                if ($deadlineFromSystem['date'] == $data['admissions_deadline']) {
                    $data['is_admission_deadline_from_user'] = false;
                    $data['admissions_deadline'] = $deadlineFromSystem['date'];
                } else {
                    $data['admissions_deadline'] = $date->format('m-d-Y');
                    $data['is_admission_deadline_from_user'] = true;
                }
            } else if ($collegeDetail->admission_option != $request->admission_option) {
                // echo 'diff option';
                // dd($data['admissions_deadline'], $deadlineFromSystem['date']);

                if ($deadlineFromSystem['date'] == $data['admissions_deadline']) {
                    $data['is_admission_deadline_from_user'] = false;
                    $data['admissions_deadline'] = $deadlineFromSystem['date'];
                } else {
                    $data['is_admission_deadline_from_user'] = true;
                    $data['admissions_deadline'] = $date->format('m-d-Y');
                }
            }


        } else {
            $data['admissions_deadline'] = null;
            $data['is_admission_deadline_from_user'] = false;
        }

        // die;

        // dd($data);
        $college = $collegeDetail->update($data);

        $this->setReminderAndAddIntoCalendor($request->college_detail_id);
    }

    private function __getDeadlineDate($data)
    {
        $deadlineDate = null;

        $adminissionOptionSelected = $data['request_data']['admission_option']; // Early Action, Early Decision 1, Early Decision 2, Regular Decision, Rolling Admission

        if (!empty($adminissionOptionSelected)) {
            // admission deadline:
            // Early Action: AP_DL_EACT_DAY, AP_DL_EACT_MON
            // Early Decision 1: AP_DL_EDEC_1_DAY, AP_DL_EDEC_1_MON
            // Early Decision 2: AP_DL_EDEC_2_DAY, AP_DL_EDEC_2_MON
            // Regular Decision: AP_DL_FRSH_DAY, AP_DL_FRSH_MON
            // Rolling Admission: No

            $collegeInformation = $data['college_information'];

            $deadlineDay = 0;
            $deadlineMonth = 0;

            if ($adminissionOptionSelected == 'Early Action') {
                $deadlineDay = $collegeInformation['early_action_day'] ?: $collegeInformation['AP_DL_EACT_DAY'];
                $deadlineMonth = $collegeInformation['early_action_month'] ?: $collegeInformation['AP_DL_EACT_MON'];
            } elseif ($adminissionOptionSelected == 'Early Decision' || $adminissionOptionSelected == 'Early Decision 1') {
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

            // echo 'adminissionOptionSelected -> ' . $adminissionOptionSelected;
            // echo $deadlineDay . ' -> ' . $deadlineMonth;

            if ($deadlineDay && $deadlineMonth) {
                $year = date('Y');
                $date = strtotime($year . '-' . $deadlineMonth . '-' . $deadlineDay);
                if ($date < time()) {
                    $deadlineDate = $deadlineMonth . '-' . $deadlineDay . '-' . ($year + 1);
                } else {
                    $deadlineDate = $deadlineMonth . '-' . $deadlineDay . '-' . $year;
                }
            } else {
                // $deadlineDate = isset($collegeInformation['regular_admission_deadline'])
                //     ? $collegeInformation['regular_admission_deadline']
                //     : '';

                // if (!empty($deadlineDate)) {
                //     $deadlineDate = date('Y-m-d', strtotime($deadlineDate));
                // }
            }
        }

        if (!empty($deadlineDate)) {
            // convert deadlineDate to M-d-Y

            try {
                $deadlineDate = Carbon::createFromFormat("m-d-Y", $deadlineDate);
            } catch (\Throwable $th) {
                $deadlineDate = Carbon::createFromFormat("Y-m-d", $deadlineDate);
            }

            $deadlineDate = $deadlineDate->format('m-d-Y');
            return [
                'date' => $deadlineDate,
            ];
        }

        return [
            'date' => '',
        ];
    }


    public function college_application_save(Request $request)
    {

        if ($request->college_detail_id) {
            $this->edit($request);
        } else {
            $this->create($request);
        }
        $days = "";
        $date = "";
        if ($request->admissions_deadline) {
            $deadline = $request->admissions_deadline;
            try {
                $date = Carbon::createFromFormat("m-d-Y", $deadline);
            } catch (\Throwable $th) {
                $date = Carbon::createFromFormat("Y-m-d", $deadline);
            }
            $days = 'Due in ' . $date->diffInDays(Carbon::now()) . ' days';
        }
        return [
            'success' => true,
            'message' => 'College application deadline saved successfully',
            'daysleft' => $days,
            'date' => $date ? $date->format('m-d-Y') : '',
            'dateLabel' => $date ? date('F d, Y', strtotime($date)) : '',
        ];
    }

    public function set_application_completed(Request $request)
    {
        $data = [
            'is_completed_all_process' => $request->is_completed_all_process,
            'is_complete_application_type' => $request->is_completed_all_process,
            'is_complete_admission_open' => $request->is_completed_all_process,
            'is_complete_number_of_essays' => $request->is_completed_all_process,
            'is_complete_admission_deadline' => $request->is_completed_all_process,
            'is_complete_competitive_scholarship_deadline' => $request->is_completed_all_process,
            'is_complete_scholarship_deadline' => $request->is_completed_all_process,
            'is_completed_honors_college_deadline' => $request->is_completed_all_process,
            'is_completed_fafsa_deadline' => $request->is_completed_all_process,
            'is_completed_css_profile_deadline' => $request->is_completed_all_process,
        ];
        $college = CollegeDetails::where('id', $request->college_detail_id)->update($data);
        return "success";
    }

    public function modify($str)
    {
        return ucwords(str_replace("_", " ", $str));
    }

    public function setReminderAndAddIntoCalendor($collegeAddId)
    {
        $college = CollegeDetails::where('id', $collegeAddId)->with(['college_details'])->first();
        $fields = ['admissions_deadline', 'competitive_scholarship_deadline', 'departmental_scholarship_deadline', 'honors_college_deadline', 'fafsa_deadline', 'css_profile_deadline'];
        if ($college) {
            $college = $college->toArray();
            foreach ($fields as $key => $field) {
                if ($college[$field] && !empty($college[$field])) {
                    $reminder = Reminder::where('college_id', $college['college_details']['id'])->where('field', $field)->first();
                    $date = Carbon::createFromFormat('m-d-Y', $college[$field]);
                    $time = $date->format('H:i:s');
                    $type = ucwords(str_replace("_", " ", $field));
                    $data = [
                        'user_id' => Auth::id(),
                        'reminder_name' => $type . ' - ' . $college['college_details']['college_name'],
                        'frequency' => 'Once',
                        'method' => 'both',
                        'when_time' => $time,
                        'start_date' => $date,
                        'end_date' => $date,
                        'enabled' => 1,
                        'type' => 'application_deadline'
                    ];
                    if ($reminder) {
                        $reminder->update($data);
                        $this->setCalendarEvent($reminder, $date);
                    } else {
                        $data['field'] = $field;
                        $data['college_id'] = $college['college_details']['id'];
                        $reminder = Reminder::create($data);
                        $this->setCalendarEvent($reminder, $date);
                    }
                }
            }
        }
    }

    public function setCalendarEvent($reminder, $date)
    {
        $event = CalendarEvent::where('reminders_id', $reminder->id)->first();
        if ($event) {
            $data = [
                'title' => $reminder->reminder_name,
                'event_time' => $reminder->when_time
            ];
            if (isset($data['event_time']) && $data['event_time']) {
                $time = strtotime($data['event_time']);
                $event_time = date('H:i:s', $time);
                $start_date = Carbon::parse($date)->format('Y-m-d');
                $start_date = $start_date . ' ' . $event_time;
                $data['start_date'] = $start_date;
                $end_date = Carbon::parse($start_date)->addHour();
                $data['end_date'] = $end_date->format('Y-m-d H:i:s');
            }
            $this->googleService->updateEvent($event->google_calendar_event_id, $data);
            $event->update($data);
            $userCalendar = UserCalendar::where('event_id', $event->id)->first();
            $userCalendar->update([
                "start_date" => $date,
                "end_date" => $date,
            ]);
        } else {
            $data = [
                "user_id" => Auth::id(),
                "reminders_id" => $reminder->id,
                "title" => $reminder->reminder_name,
                "description" => '',
                "color" => 'info',
                "is_assigned" => 1,
                'event_time' => $reminder->when_time,
            ];
            if (isset($data['event_time']) && $data['event_time']) {
                $time = strtotime($data['event_time']);
                $event_time = date('H:i:s', $time);
                $start_date = Carbon::parse($date)->format('Y-m-d');
                $start_date = $start_date . ' ' . $event_time;
                $data['start_date'] = $start_date;
                $end_date = Carbon::parse($start_date)->addHour();
                $data['end_date'] = $end_date->format('Y-m-d H:i:s');
            }
            $createevent = $this->googleService->insertEvent($data);
            if ($createevent) {
                $data['google_calendar_event_id'] = $createevent->id;
            }
            $calendarEvent = CalendarEvent::create($data);
            UserCalendar::create([
                "event_id" => $calendarEvent->id,
                "start_date" => $date,
                "end_date" => $date,
            ]);
        }
    }
}
