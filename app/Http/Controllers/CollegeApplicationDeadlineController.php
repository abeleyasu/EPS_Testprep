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

class CollegeApplicationDeadlineController extends Controller
{
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

    public function getApplicationDeadlineData() {
        try {
            $college_list_deadline = CollegeList::where('user_id', Auth::id())->with(['college_list_details' => function ($detail) {
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

    public function getSingleApplicationData($id) {
        try {
            $college_list_deadline = CollegeDetails::where('id', '=', $id)->first();
            if (!$college_list_deadline) {
                return response()->json([
                    'success' => false,
                    'message' => 'College not found',
                ]);
            }
            $deadline_date = null;
            if ($college_list_deadline->college_details->collegeInformation) {
                $deadline_date = $college_list_deadline->college_details->collegeInformation->regular_admission_deadline;
            }
            $college_list_deadline = $college_list_deadline->toArray();
            $college_list_deadline['admissions_deadline'] = $deadline_date;
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

    public function list(Request $request) {
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

    public function create($request) {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $college = CollegeDetails::create($data);
        $this->setReminderAndAddIntoCalendor($data);
    }

    public function edit($request) {
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

        // dd($data);
        $college = CollegeDetails::where('id', $request->college_detail_id)->update($data);

        $this->setReminderAndAddIntoCalendor($request->college_detail_id);
    }

    public function college_application_save(Request $request)
    {
        if ($request->college_detail_id) {
            $this->edit($request);
        } else {
            $this->create($request);
        }
        return [
            'success' => true,
            'message' => 'College application deadline saved successfully',
        ];
    }

    public function set_application_completed(Request $request) {
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

    public function modify($str) {
        return ucwords(str_replace("_", " ", $str));
    }

    public function setReminderAndAddIntoCalendor($collegeAddId) {
        $college = CollegeDetails::where('id', $collegeAddId)->with(['college_details'])->first();
        $fields = ['admissions_deadline', 'competitive_scholarship_deadline', 'departmental_scholarship_deadline', 'honors_college_deadline', 'fafsa_deadline', 'css_profile_deadline'];
        if ($college) {
            $college = $college->toArray();
            foreach ($fields as $key => $field) {
                if ($college[$field] && !empty($college[$field])) {
                    $reminder = Reminder::where('college_id', $college['college_details']['id'])->where('field', $field)->first();
                    $date = Carbon::parse($college[$field]);
                    $time = $date->format('H:i:s');
                    $type= ucwords(str_replace("_", " ", $field));
                    $data = [
                        'user_id' => Auth::id(),
                        'reminder_name' => $type. ' - ' .$college['college_details']['college_name'],
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

    public function setCalendarEvent($reminder, $date) {
        $event = CalendarEvent::where('reminders_id', $reminder->id)->first();
        if ($event) {
            $event->update([
                'title' => $reminder->reminder_name,
                'event_time' => $reminder->when_time
            ]);
            $userCalendar = UserCalendar::where('event_id', $event->id)->first();
            $userCalendar->update([
                "start_date" => $date,
                "end_date" => $date,
            ]);
        } else {
            $calendarEvent = CalendarEvent::create([
				"user_id" => Auth::id(),
				"reminders_id" => $reminder->id,
				"title" => $reminder->reminder_name,
				"description" => '',
				"color" => 'info',
				"is_assigned" => 1,
				'event_time' => $reminder->when_time
			]);
            UserCalendar::create([
                "event_id" => $calendarEvent->id,
                "start_date" => $date,
                "end_date" => $date,
            ]);
        }
    }
}
