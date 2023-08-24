<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SurveyRequest;
use App\Models\UserSurvey;
use App\Models\UserSurveyEmails;
use DB;

class UserSurveyController extends Controller
{

    public function index(Request $request) {
        try {
            if ($request->ajax()) {
                $limit = isset($request->limit) ? $request->limit : 10;
                $search =  isset($request->search['value']) ? $request->search['value'] : ""; 
                $start = isset($request->start) ? $request->start : 0;

                $surveys = UserSurvey::with(['user' => function ($u) {
                    $u->select('id', 'name');
                }]);

                $total = $surveys->count();

                if (!empty($search)) {
                    $surveys = $surveys->where(function ($survey) use ($search) {
                        $survey->where('id', 'LIKE', '%' . $search . '%')
                            ->orWhere('survay_type', 'LIKE', '%' . $search . '%')
                            ->orWhere('high_school_year', 'LIKE', '%' . $search . '%')
                            ->orWhere('reference_path', 'LIKE', '%' . $search . '%')
                            ->orWhere('specific_path', 'LIKE', '%' . $search . '%')
                            ->orWhere('specific_path_other_detail', 'LIKE', '%' . $search . '%')
                            ->orWhere('found_other_website_link', 'LIKE', '%' . $search . '%')
                            ->orWhereHas('user', function ($user) use ($search) {
                                $user->where('name', 'LIKE', '%' . $search . '%');
                            });
                    });
                }

                $surveys = $surveys->skip($start)->take($limit);

                $surveys = $surveys->get()->toArray();

                $data = [];
                foreach ($surveys as $survey) {
                    $data[] = [
                        'id' => $survey['id'],
                        'user_name' => $survey['user']['name'],
                        'survey_type' => $survey['survay_type'],
                        'high_school_year' => $survey['high_school_year'],
                        'reference_path' => $survey['reference_path'],
                        'specific_path' => $survey['specific_path'],
                        'created_at' => date('d-m-Y', strtotime($survey['created_at'])),
                        'action' => '<a href="' . route('admin.survey.survey-info', ['id' => $survey['id']]) . '" class="btn btn-sm btn-alt-primary" data-bs-toggle="tooltip" title="View">
                                        <i class="fa fa-fw fa-eye"></i>
                                    </a>'
                    ];
                }

                return response()->json([
                    'draw' => $request->draw,
                    'recordsTotal' => $total,
                    'recordsFiltered' => $total,
                    'data' => $data
                ]);
            }
            return view('admin.survey.list');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function getSurveyInfo($id) {
        try {
            $servey = UserSurvey::where('id', $id)->with(['user' => function ($u) {
                $u->select('id', 'name');
            }, 'parent_student_info', 'friends'])->first();
            if (!$servey) {
                return redirect()->back()->with('error', 'Survey not found.');
            }
            return view('admin.survey.info', [
                'survey' => $servey,
            ]);
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function surveyForm() {
        $user = auth()->user();
        if ($user->userSurvey) {
            return redirect()->route('user-dashboard')->with('success', 'You have already taken the survey.');
        }
        $high_school_year = [
            'K-8th',
            '9th (Graduate in 2027)',
            '10th (Graduate in 2026)',
            '11th (Graduate in 2025)',
            '12th(Graduate in 2024)'
        ];
        $reference_options = [
            'Google',
            'YouTube',
            'Reddit',
            'TikTok',
            'Friend/Family',
            'School/Counselor/Teacher',
            'Tutor or College Advisor'
        ];
        $specific_brought = [
            'Preparing my college applications',
            'Searching for a potential career',
            'Understanding financial aid and finding scholarships',
            'Preparing for the SAT/ACT/PSAT',
            'Other'
        ];
        return view('user.survey.form', [
            'high_school_year' => $high_school_year,
            'reference_options' => $reference_options,
            'specific_brought' => $specific_brought
        ]);
    }

    public function saveSurvey(SurveyRequest $request) {
        DB::beginTransaction();
        try {
            $user = auth()->user();
            $userSurvey = UserSurvey::create([
                'user_id' => $user->id,
                'survay_type' => $request->survay_type,
                'high_school_year' => $request->high_school_year,
                'reference_path' => $request->reference_path,
                'specific_path' => $request->specific_path,
                'specific_path_other_detail' => isset($request->specific_path_other_detail) ? $request->specific_path_other_detail : null,
                'found_other_website_link' => $request->found_other_website_link,
            ]);
            if ($userSurvey) {
                foreach($request->parent_student_emails as $email) {
                    UserSurveyEmails::create([
                        'user_surveys_id' => $userSurvey->id,
                        'email' => $email,
                        'email_type' => 'parent_student'
                    ]);
                }
                foreach($request->friends as $email) {
                    UserSurveyEmails::create([
                        'user_surveys_id' => $userSurvey->id,
                        'email' => $email,
                        'email_type' => 'friend'
                    ]);
                }
                DB::commit();
                return redirect()->route('user-dashboard')->with('success', 'Thank you for taking the survey.');
            }
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.')->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.')->withInput();
        }
    }
}
