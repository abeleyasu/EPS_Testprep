<?php

namespace App\Http\Controllers\InitialCollegeList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HighSchoolResume\States;
use App\Models\CollegeList;
use App\Models\CollegeSearchAdd;
use App\Models\CollegeUserStatistics;
use App\Models\CostComparison;
use App\Models\CostComparisonDetail;
use App\Models\CostComparisonOtherScholarship;
use App\Models\CollegeDetails;
use App\Models\CollegeInformation;
use App\Models\CostTypes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Http;
use App\Models\CollegeMajorInformation;
use App\Models\FieldsOfStudy;
use App\Models\User;
use App\Models\UserCollgeScore;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use DB;

class InititalCollegeListController extends Controller
{
    public $search = [];
    public function step1(Request $request)
    {
        $createSearchList = CollegeList::where('user_id', auth()->user()->id)->first();
        if (!$createSearchList) {
            $createSearchList = CollegeList::create([
                'user_id' => auth()->user()->id,
                'active_step' => 1,
            ]);
        }
        if (count($request->all()) > 0) {
            $createSearchList->update([
                'last_search_string' => json_encode($request->all()),
                'active_step' => 2,
            ]);
            $route = route('admin-dashboard.initialCollegeList.step2');
            return redirect($route);
        }

        $data = CollegeMajorInformation::select('title', 'code')->get();

        $states = States::select('state_name', 'state_code')->get();
        return view('user.admin-dashboard.initial-college-list.step1', [
            'states' => $states,
            'college_major_data' => $data,
            'college_id' => $createSearchList ? $createSearchList->id : null
        ]);
    }

    public function step2(Request $request)
    {
        $pageNo = isset($request->page) ? $request->page : 1;
        $college = CollegeList::where('user_id', Auth::id())->first();
        $data = $this->getCollegeData($college->id, $pageNo);
        $selectedCollege = CollegeSearchAdd::where('college_lists_id', $college->id)->get()->map(function ($item) {
            return $item->college_id;
        })->toArray();

        $pagination = new Paginator($data['data'], $data['total'], config('constants.college_list_per_page'), $data['current_page'], [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);


        foreach ($data['data'] as $key => &$value) {
            $response = CollegeInformation::where('college_id', $value["id"])->first();
            $value["college_info"] = $response;
        }

        return view('user.admin-dashboard.initial-college-list.step2', [
            'college_id' => $college->id,
            'college_data' => $data['data'],
            'selected_college' => $selectedCollege,
            'pagination' => $pagination,
            'total' => $data['total']
        ]);
    }

    function getCollegeData($college_lists_id, $page_no)
    {
        $data = [];
        $searchstring = CollegeList::where('id', $college_lists_id)->select('last_search_string')->first();
        $searchstring = json_decode($searchstring->last_search_string);
        // dd($searchstring);
        if ($searchstring) {
            $perPage = config('constants.college_list_per_page');
            $page_no = $page_no - 1;
            $api = env('COLLEGE_RECORD_API') . '?' . 'api_key=' . env('COLLEGE_RECORD_API_KEY') . '&page=' . $page_no . '&per_page=' . $perPage . '&sort=latest.earnings.6_yrs_after_entry.gt_threshold_suppressed:desc';
            $api = $api . '&fields=id,school.name,school.city,school.state,latest.student.size,school.branches,school.locale,school.ownership,school.degrees_awarded.predominant,latest.academics.program_reporter.programs_offered,latest.cost.avg_net_price.overall,latest.completion.consumer_rate,latest.earnings.10_yrs_after_entry.median,latest.earnings.6_yrs_after_entry.percent_greater_than_25000,school.under_investigation,latest.completion.outcome_percentage_suppressed.all_students.8yr.award_pooled,latest.completion.rate_suppressed.four_year,latest.completion.rate_suppressed.lt_four_year_150percent,latest.programs.cip_4_digit,latest.admissions.admission_rate.overall';
            $api = $api . '&school.degrees_awarded.predominant__range=1..3&school.operating=1';

            if (isset($searchstring->search_college) && !empty($searchstring->search_college)) {
                $api = $api . '&school.search=' . $searchstring->search_college;
            } else {
                if (isset($searchstring->average_annual_cost) && $searchstring->average_annual_cost && $searchstring->average_annual_cost != '0') {
                    $api = $api . '&latest.cost.avg_net_price.overall__range=..' . $searchstring->average_annual_cost * 1000;
                }

                if (isset($searchstring->acceptance_rate) && $searchstring->acceptance_rate && $searchstring->acceptance_rate != '0') {
                    $api = $api . '&latest.admissions.admission_rate.consumer_rate__range=' . ($searchstring->acceptance_rate / 100) . '..1';
                }

                if (isset($searchstring->college_size_option) && count($searchstring->college_size_option) > 0) {
                    $api = $api . '&latest.student.size__range=' . Arr::join($searchstring->college_size_option, ',');
                } else {
                    $api = $api . '&latest.student.size__range=1..';
                }

                if (isset($searchstring->type_of_school) && count($searchstring->type_of_school) > 0) {
                    $api = $api . '&school.ownership=' . Arr::join($searchstring->type_of_school, ',');
                }

                if (isset($searchstring->urbanicity) && count($searchstring->urbanicity) > 0) {
                    $api = $api . '&school.locale=' . Arr::join($searchstring->urbanicity, ',');
                }

                if (isset($searchstring->degree) && count($searchstring->degree) > 0) {
                    $api = $api . '&latest.programs.cip_4_digit.credential.level=' . Arr::join($searchstring->degree, ',');
                }

                if (isset($searchstring->college_majors_options)) {
                    $api = $api . '&latest.programs.cip_4_digit.code=' . $searchstring->college_majors_options;
                }

                if (isset($searchstring->state) && count($searchstring->state) > 0) {
                    foreach ($searchstring->state as $option) {
                        $api = $api . '&school.state[]=' . $option;
                    }
                }

                if (isset($searchstring->sat_math) && $searchstring->sat_math && $searchstring->sat_math != '0') {
                    $api = $api . '&latest.admissions.sat_scores.midpoint.math__range=..' . $searchstring->sat_math;
                }

                if (isset($searchstring->sat_critical_reading) && $searchstring->sat_critical_reading && $searchstring->sat_critical_reading != '0') {
                    $api = $api . '&latest.admissions.sat_scores.midpoint.critical_reading__range=..' . $searchstring->sat_critical_reading;
                }

                if (isset($searchstring->act_score) && $searchstring->act_score && $searchstring->act_score != '0') {
                    $api = $api . '&latest.admissions.act_scores.midpoint.cumulative__range=..' . $searchstring->act_score;
                }

                if (isset($searchstring->specialized_mission) && !empty($searchstring->specialized_mission)) {
                    $api = $api . '&' . $searchstring->specialized_mission . '=1';
                }

                if (isset($searchstring->religious_affiliation) && !empty($searchstring->religious_affiliation)) {
                    $api = $api . '&school.religious_affiliation=' . $searchstring->religious_affiliation;
                }

                if (isset($searchstring->graduate_rate) && $searchstring->graduate_rate && $searchstring->graduate_rate != '0') {
                    $api = $api . '&latest.completion.consumer_rate__range=' . ($searchstring->graduate_rate / 100) . '..';
                }
            }

            // dd($api);

            $guzzleClient = new GuzzleClient();
            $response = $guzzleClient->get($api, [
                'timeout' => 0,
            ]);
            $data = json_decode($response->getBody()->getContents(), true);
            $totalRecords = $data['metadata']['total'];
            $data = $data['results'];

            if (!isset($searchstring->search_college)) {
                $college_ids = collect($data)->pluck('id')->toArray();
                $search_college_from_db = CollegeInformation::whereIn('college_id', $college_ids);
                if (isset($searchstring->average_annual_cost_of_attendance) && !empty($searchstring->average_annual_cost_of_attendance) && $searchstring->average_annual_cost_of_attendance !== 0) {
                    $search_college_from_db = $search_college_from_db->where('cost_of_attendance', '<=', $searchstring->average_annual_cost_of_attendance);
                }

                if (isset($searchstring->tution_and_fees) && !empty($searchstring->tution_and_fees) && $searchstring->tution_and_fees !== 0) {
                    $search_college_from_db = $search_college_from_db->where('tution_and_fess', '<=', $searchstring->tution_and_fees);
                }

                if (isset($searchstring->average_percent_of_need_met) && !empty($searchstring->average_percent_of_need_met) && $searchstring->average_percent_of_need_met !== 0) {
                    $search_college_from_db = $search_college_from_db->where('average_percent_of_need_met', '<=', $searchstring->average_percent_of_need_met);
                }

                if (isset($searchstring->average_gpa) && !empty($searchstring->average_gpa) && $searchstring->average_gpa !== 0) {
                    $search_college_from_db = $search_college_from_db->where('gpa_average', '<=', $searchstring->average_gpa);
                }

                if (isset($searchstring->entrance_difficulty) && count($searchstring->entrance_difficulty) > 0) {
                    $search_college_from_db = $search_college_from_db->whereIn('entrance_difficulty', $searchstring->entrance_difficulty);
                }

                $search_college_from_db = $search_college_from_db->get()->toArray();

                if (count($search_college_from_db) > 0) {
                    $college_ids = collect($search_college_from_db)->pluck('college_id')->toArray();
                    $data = collect($data)->whereIn('id', $college_ids)->all();
                } else {
                    $data = [];
                }
            }
        }
        return [
            'total' => $totalRecords,
            'data' => $data,
            'current_page' => $page_no + 1,
            'total_page' => ceil($totalRecords / $perPage),
        ];
    }

    public function saveCollege(Request $request)
    {
        $max_order_index = CollegeSearchAdd::where('college_lists_id', $request->school_lists_id)->max('order_index');
        $add_college = CollegeSearchAdd::create([
            'college_lists_id' => $request->school_lists_id,
            'college_id' => $request->school_id,
            'college_name' => $request->school_name,
            'size' => $request->size,
            'type_of_school' => $request->locale,
            'urbanicity' => $request->ownership,
            'college_acceptance_rate' => $request->college_acceptance_rate,
            'college_average_anual_cost' => $request->college_average_anual_cost,
            'college_median_earnings' => $request->college_median_earnings,
            'order_index' => $max_order_index ? $max_order_index + 1 : 1,
        ]);
        $this->createCollegeListAllData($add_college->id);
        if ($add_college) {
            return response()->json([
                'success' => true,
                'message' => 'College added successfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }

    public function removeCollge($id, $college_id)
    {
        $remove_college = CollegeSearchAdd::where('college_lists_id', $id)->where('college_id', $college_id)->first();
        if ($remove_college) {
            $this->deleteCollegeFromAllTable($remove_college->id);
            $remove_college->delete();
            if ($remove_college) {
                return response()->json([
                    'success' => true,
                    'message' => 'College removed successfully',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong',
                ]);
            }
        }
    }

    public function step3(Request $request)
    {
        $college = CollegeList::where('user_id', Auth::id())->first();
        if ($college) {
            CollegeList::where('id', $college->id)->update([
                'active_step' => 3,
            ]);
            $college_list_date = CollegeList::where('id', $college->id)->first();
            $test_type = config('constants.test_type');
            return view('user.admin-dashboard.initial-college-list.step3', [
                'test_type' => $test_type,
                'college_list_date' => $college_list_date,
            ]);
        }
    }

    public function saveAcademicStatistics(Request $request, $score, $id)
    {

        try {
            $rules = [];
            $customMessage = [];

            $commonrules = 'nullable|numeric|min:1|max:36';
            $actSactRules = 'nullable|numeric|min:200|max:800';

            switch ($score) {
                case 'highschool':
                    // if ($request->high_school_test_type == 'ACT') {
                    //     $rules['high_school_english_score'] = $commonrules;
                    //     $rules['high_school_science_score'] = $commonrules;
                    // }
                    // $rules['high_school_reading_score'] = $request->high_school_test_type == 'ACT' ? $commonrules: $actSactRules;
                    // $rules['high_school_math_score'] = $request->high_school_test_type == 'ACT' ? $commonrules: $actSactRules ;
                    // $rules['high_school_test_date'] = 'nullable|date';
                    $rules['unweighted_gpa'] = 'nullable|numeric|min:0|max:4';
                    $rules['weighted_gpa'] = 'nullable|numeric|min:0|max:8';
                    break;

                case 'goalscore';
                    if ($request->goal_test_type == 'ACT') {
                        $rules['goal_english_score'] = $commonrules;
                        $rules['goal_science_score'] = $commonrules;
                    }
                    $rules['goal_reading_score'] = $request->goal_test_type == 'ACT' ? $commonrules : $actSactRules;
                    $rules['goal_math_score'] = $request->goal_test_type == 'ACT' ? $commonrules : $actSactRules;
                    $rules['goal_test_date'] = 'nullable|date';
                    break;

                case 'finalscore':
                    if ($request->final_test_type == 'ACT') {
                        $rules['final_english_score'] = $commonrules;
                        $rules['final_science_score'] = $commonrules;
                    }
                    $rules['final_reading_score'] = $request->final_test_type == 'ACT' ? $commonrules : $actSactRules;
                    $rules['final_math_score'] = $request->final_test_type == 'ACT' ? $commonrules : $actSactRules;
                    $rules['final_test_date'] = 'nullable|date';
                    break;

                default:
                    return response()->json([
                        'success' => false,
                        'message' => 'Something went wrong',
                    ]);
                    break;
            }

            $customMessage = [
                'required' => 'The :attribute field is required.',
                'numeric' => 'The :attribute field must be numeric.',
                'min' => 'The :attribute field must be at least :min.',
                'max' => 'The :attribute field may not be greater than :max.',
                'date' => 'The :attribute field must be a date.',
            ];

            $validate = Validator::make($request->all(), $rules, $customMessage);
            if ($validate->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validate->errors()->first(),
                ]);
            }

            $college_list = CollegeList::where('id', $id)->first();
            $college_list->fill($request->all());
            $college_list->save();
            $findStatistisc = CollegeUserStatistics::where('college_lists_id', $id)->first();
            if (!$findStatistisc) {
                $findStatistisc = CollegeUserStatistics::create([
                    'college_lists_id' => $id
                ]);
            }

            if ($score == 'highschool') {
                $this->storeScore($request->unweighted_gpa, 'unweighted_gpa', $findStatistisc->id);
                $this->storeScore($request->weighted_gpa, 'weighted_gpa', $findStatistisc->id);
            }
            if ($score == 'goalscore' || $score == 'finalscore') {
                $this->storeFinalOrGoalScore($score, $college_list, $findStatistisc->id);
            }
            return response()->json([
                'success' => true,
                'message' => 'Academic Statistics saved successfully',
                'data' => $college_list
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }

    public function storeFinalOrGoalScore($score_type, $data, $db_field_id)
    {
        $field = '';
        $test_type = $score_type == 'goalscore' ? 'goal_test_type' : 'final_test_type';
        if ($score_type == 'goalscore') {
            CollegeUserStatistics::find($db_field_id)->update([
                'goal_act_score' => null,
                'goal_sat_score' => null,
                'goal_psat_score' => null,
            ]);
        } else {
            CollegeUserStatistics::find($db_field_id)->update([
                'final_act_score' => null,
                'final_sat_score' => null,
                'final_psat_score' => null,
            ]);
        }
        switch ($data[$test_type]) {
            case 'ACT':
                $field = $score_type == 'goalscore' ? 'goal_act_score' : 'final_act_score';
                break;

            case 'SAT':
                $field = $score_type == 'goalscore' ? 'goal_sat_score' : 'final_sat_score';
                break;

            case 'PSAT':
                $field = $score_type == 'goalscore' ? 'goal_psat_score' : 'final_psat_score';
                break;
        }
        if ($field != '') {
            $score = 0;
            if ($score_type == 'goalscore') {
                $score = $data->goal_composite_score;
            } else {
                $score = $data->final_composite_score;
            }
            $this->storeScore($score, $field, $db_field_id);
        }
    }

    public function storeScore($score, $field, $id)
    {
        CollegeUserStatistics::find($id)->update([
            $field => $score,
        ]);
    }

    public function step4(Request $request)
    {
        $college = CollegeList::where('user_id', Auth::id())->with(['userPastCurrentScore'])->first();
        if ($college) {
            $college->update([
                'active_step' => 4,
            ]);
            $college = $college->toArray();
            $actScore = collect($college['user_past_current_score'])->where('test_type', 'ACT')->sum('composite_score');
            $satScore = collect($college['user_past_current_score'])->where('test_type', 'SAT')->sum('composite_score');
            $psatScore = collect($college['user_past_current_score'])->where('test_type', 'PSAT')->sum('composite_score');
            $college['past_current_act_score'] = $actScore;
            $college['past_current_sat_score'] = $satScore;
            $college['past_current_psat_score'] = $psatScore;
            unset($college['user_past_current_score']);
            // dd($college);
            // $score = CollegeUserStatistics::where('college_lists_id', $college->id)->first();
            return view('user.admin-dashboard.initial-college-list.step4', [
                'score' => $college,
                'college' => $college['id'],
            ]);
        }
    }

    public function getSelectedCollegeList($college_id)
    {
        // dd('called');
        $college_list = CollegeSearchAdd::where('college_lists_id', $college_id)->where('is_active', true)->with(['collegeInformation'])->orderBy('order_index', 'asc')->get();
        return response()->json([
            'success' => true,
            'data' => $college_list,
        ]);
    }

    public function updateOrder(Request $request, $college_list_id)
    {
        foreach ($request->data as $data) {
            CollegeSearchAdd::find($data['id'])->update([
                'order_index' => $data['order_index'],
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Order updated successfully',
        ]);
    }

    function collegeList($college_id)
    {
        $data = $this->getCollegeData($college_id, 1);
        // dd($data['data']);
        $selectedCollege = CollegeSearchAdd::where('college_lists_id', $college_id)->get()->map(function ($item) {
            return $item->college_id;
        })->toArray();

        $data = collect($data['data'])->map(function ($item) use ($selectedCollege) {
            $item['selected'] = in_array($item['id'], $selectedCollege);
            return $item;
        })->all();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function storeSelection(Request $request, $id)
    {
        CollegeSearchAdd::find($id)->update([
            'option' => $request->option,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Option updated successfully',
        ]);
    }

    public function getSingleCollege($id)
    {
        $api = env('COLLEGE_RECORD_API') . '?' . 'api_key=' . env('COLLEGE_RECORD_API_KEY') . '&id=' . $id;
        $data = Http::get($api);
        $data = json_decode($data->body());
        if (count($data->results) > 0) {
            // error_log('DATA VALUE');
            // error_log(json_encode($data));
            $data = $data->results[0];
            $college_info = CollegeInformation::where('college_id', $data->id)->first();
            if ($college_info) {
                $data->latest->college_info = $college_info;
            }
        } else {
            $data = null;
        }
        error_log('Smack');
        return response()->json([
            'id' => $id,
            'success' => $data ? true : false,
            'data' => $data,
            'programmes' => FieldsOfStudy::where('college_information_id', $college_info->id)->get()
        ]);
    }

    public function saveCollegeList($id)
    {
        $college_list = CollegeList::where('id', $id)->update([
            'status' => 'completed',
        ]);
        // $this->createCollegeListData($id);
        return response()->json([
            'success' => true,
            'message' => 'College list saved successfully',
        ]);
    }

    public function createCollegeListAllData($college_list_id)
    {
        $userid = Auth::user()->id;
        CollegeDetails::create([
            'user_id' => $userid,
            'college_id' => $college_list_id,
        ]);
        $createcost = CostComparison::create([
            'user_id' => $userid,
            'college_list_id' => $college_list_id,
        ]);
        CostComparisonDetail::create([
            'cost_comparison_id' => $createcost->id,
        ]);
    }

    public function deleteCollegeFromAllTable($college_search_id)
    {
        $userid = Auth::user()->id;
        CollegeDetails::where('user_id', $userid)->where('college_id', $college_search_id)->delete();
        $costcomparison = CostComparison::where('user_id', $userid)->where('college_list_id', $college_search_id)->first();
        CostComparisonDetail::where('cost_comparison_id', $costcomparison->id)->delete();
        CostComparisonOtherScholarship::where('cost_comparison_id', $costcomparison->id)->delete();
        $costcomparison->delete();
    }

    public function viewCostComparisonPage()
    {
        $id = Auth::id();
        $user = User::where('role', '!=', 1)->find($id);

        $types = CostTypes::get();
        $college = CollegeList::where('user_id', Auth::id())->first();
        $states = States::select('id', 'state_name', 'state_code')->get();

        return view('user.admin-dashboard.cost-comparison', [
            'types' => $types,
            'college' => $college,
            'states' => $states,
            'user' => $user,
        ]);
    }

    public function getCostComparisonSummary(Request $request)
    {
        $userid = Auth::user()->id;
        $costcomparisonsummary = CollegeList::where('user_id', $userid)->select('id')->whereHas('college_list_details', function ($q) {
            $q->where('is_active', true);
        })->with(['college_list_details' => function ($query) {
            $query->where('is_active', true)->select('id', 'college_name', 'college_lists_id', 'college_id')->orderBy('order_index')->with(['costcomparison' => function ($costquery) {
                $costquery->with(['costcomparisondetail', 'costcomparisonotherscholarship']);
            }, 'collegeInformation']);
        }])->first();

        if ($costcomparisonsummary) {
            $costcomparisonsummary = $costcomparisonsummary->toArray();
        }
        $totalCount = 0;
        $data = [];
        if ($costcomparisonsummary) {
            foreach ($costcomparisonsummary['college_list_details'] as $college_data) {
                $college_information = $college_data['college_information'];
                $detailInformation = $college_data['costcomparison']['costcomparisondetail'];
                $total_direct_cost = 0;
                if ($college_information) {
                    $total_direct_cost = ($detailInformation['direct_tuition_free_year'] ? $detailInformation['direct_tuition_free_year'] : $college_information['tution_and_fess']) + ($detailInformation['direct_room_board_year'] ? $detailInformation['direct_room_board_year'] : $college_information['room_and_board']);
                }
                $total_cost_attendance = $total_direct_cost - $college_data['costcomparison']['total_cost_attendance'];
                $data[] = [
                    'id' => $college_data['id'],
                    'college_name' => $college_data['college_name'],
                    'total_direct_cost' => '$' . $total_direct_cost,
                    'total_merit_cost' => '$' . number_format($college_data['costcomparison']['total_merit_aid']),
                    'total_need_based_aid' => '$' . number_format($college_data['costcomparison']['total_need_based_aid']),
                    'total_outside_scholarship' => '$' . number_format($college_data['costcomparison']['total_outside_scholarship']),
                    'total_cost_attendance' => '$' . number_format($total_cost_attendance),
                ];

                $totalCount = $totalCount + count($costcomparisonsummary['college_list_details']);
            }
        }
        $json_data = [
            "draw"            => intval($request->draw),
            "recordsTotal"    => $totalCount,
            "recordsFiltered" => $totalCount,
            "data"            => $data
        ];
        return response()->json($json_data);
    }

    public function getCollegeWiseList()
    {
        try {
            $userid = Auth::user()->id;
            $costcomparisonsummary = CollegeList::where('user_id', $userid)->select('id')->whereHas('college_list_details', function ($q) {
                $q->where('is_active', true);
            })->with(['college_list_details' => function ($query) {
                $query->where('is_active', true)->select('id', 'college_name', 'college_lists_id', 'college_id')->with(['costcomparison' => function ($costquery) {
                    $costquery->with(['costcomparisondetail', 'costcomparisonotherscholarship']);
                }, 'collegeInformation'])->orderBy('order_index', 'asc');
            }])->first();

            if ($costcomparisonsummary) {
                $costcomparisonsummary = $costcomparisonsummary->toArray();
            } else {
                $costcomparisonsummary = [];
            }
            if (count($costcomparisonsummary) > 0) {

                foreach ($costcomparisonsummary['college_list_details'] as $key => $costcomparison) {
                    $college_information = $costcomparison['college_information'];
                    $detailInformation = $costcomparison['costcomparison']['costcomparisondetail'];

                    // Calculate total direct cost
                    $direct_tuition = $detailInformation['direct_tuition_free_year'] ?: $college_information['tution_and_fess'];
                    $direct_room_board = $detailInformation['direct_room_board_year'] ?: $college_information['room_and_board'];
                    $total_direct_cost = $direct_tuition + $direct_room_board;

                    // Calculate total cost of attendance
                    $total_cost_attendance = $total_direct_cost - $costcomparison['costcomparison']['total_cost_attendance'];

                    // Update the cost comparison summary
                    $costcomparisonsummary['college_list_details'][$key]['costcomparison']['total_direct_cost'] = $total_direct_cost;
                    $costcomparisonsummary['college_list_details'][$key]['costcomparison']['total_cost_attendance'] = $total_cost_attendance;
                    $costcomparisonsummary['college_list_details'][$key]['costcomparison']['costcomparisondetail']['direct_tuition_free_year'] = $direct_tuition;
                    $costcomparisonsummary['college_list_details'][$key]['costcomparison']['costcomparisondetail']['direct_room_board_year'] = $direct_room_board;

                    // Remove the college information from the cost comparison summary
                    unset($costcomparisonsummary[$key]['college_information']);
                }
            }

            // Check if $costcomparisonsummary exists and if it has any college list details
            $hasDetails = $costcomparisonsummary && count($costcomparisonsummary['college_list_details']) > 0;

            // Prepare the response data
            $responseData = [
                'success' => $hasDetails,
                'data' => $hasDetails ? $costcomparisonsummary['college_list_details'] : [],
            ];

            // Return the response as JSON
            return response()->json($responseData);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function resetCostComparisonData(Request $request)
    {
        try {
            DB::beginTransaction();
            $rules = [
                'isall' => 'required',
                'id' => 'required_if:isall,false',
            ];
            $validate = Validator::make($request->all(), $rules, [
                'required_if' => 'The :attribute field is required.',
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validate->errors()->first(),
                ]);
            }
            $cost_comparions = null;
            if ($request->isall == 'true') {
                $cost_comparions = CostComparison::where('user_id', Auth::id())->get();
            } else {
                $cost_comparions = CostComparison::where('id', $request->id)->get();
            }

            if (count($cost_comparions) > 0) {
                foreach ($cost_comparions as $key => $cost_comparions) {
                    if ($cost_comparions->user_id == Auth::id()) {

                        // find college search add by college list id
                        $collegeSearchAdd = CollegeSearchAdd::where('id', $cost_comparions->college_list_id)->first();

                        $collegeInformation = null;
                        if ($collegeSearchAdd) {
                            // get college information by college id
                            $collegeInformation = CollegeInformation::where('college_id', $collegeSearchAdd->college_id)->first();
                        }

                        # reset cost comparison detail
                        $cost_comparion_detail = CostComparisonDetail::where('cost_comparison_id', $cost_comparions->id)->first();

                        // $cost_comparion_detail->direct_tuition_free_year = null;
                        $cost_comparion_detail->direct_tuition_free_year = $collegeInformation?->tution_and_fess; // reset to system initial value
                        // $cost_comparion_detail->direct_room_board_year = null;
                        $cost_comparion_detail->direct_room_board_year = $collegeInformation?->room_and_board; // reset to system initial value

                        $cost_comparion_detail->institutional_academic_merit_aid = null;
                        $cost_comparion_detail->institutional_exchange_program_scho = null;
                        $cost_comparion_detail->institutional_honors_col_program = null;
                        $cost_comparion_detail->institutional_academic_department_scho = null;
                        $cost_comparion_detail->institutional_atheletic_scho = null;
                        $cost_comparion_detail->institutional_other_talent_scho = null;
                        $cost_comparion_detail->institutional_diversity_scho = null;
                        $cost_comparion_detail->institutional_legacy_scho = null;
                        $cost_comparion_detail->institutional_other_scho = null;
                        $cost_comparion_detail->need_base_federal_grants = null;
                        $cost_comparion_detail->need_base_institutional_grants = null;
                        $cost_comparion_detail->need_base_state_grants = null;
                        $cost_comparion_detail->need_base_work_study_grants = null;
                        $cost_comparion_detail->need_base_student_loans_grants = null;
                        $cost_comparion_detail->need_base_parent_plus_grants = null;
                        $cost_comparion_detail->need_base_other_grants = null;
                        $cost_comparion_detail->save();

                        // reset cost comparison
                        $cost_comparions->total_direct_cost = null;
                        $cost_comparions->total_merit_aid = null;
                        $cost_comparions->total_need_based_aid = null;
                        $cost_comparions->total_outside_scholarship = null;
                        $cost_comparions->total_cost_attendance = null;
                        $cost_comparions->save();

                        $cost_comparions->costcomparisonotherscholarship()->delete();
                    }
                }
                DB::commit();
            }
            return response()->json([
                'success' => true,
                'message' => 'Cost comparison reset successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => env('APP_DEBUG') ?  $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile() : null,
            ], 200);
        }
    }

    public function saveCollegeCost(Request $request)
    {
        $rules = [
            'amount' => 'required|numeric',
        ];

        if (!isset($request->id)) {
            $rules['name'] = 'required';
            $rules['cost_comparison_id'] = 'required';
        }

        $validate = Validator::make($request->all(), $rules, [
            'cost_comparison_id.required' => 'Cost comparison is required',
            'name.required' => 'Cost name is required',
            'amount.required' => 'Cost amount is required',
            'amount.numeric' => 'Cost amount must be numeric',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors()->first(),
            ]);
        }

        $data = [
            'amount' => $request->amount,
        ];

        if (isset($request->id)) {
            $details = CostComparisonOtherScholarship::where('id', $request->id)->first();
            $details->update($data);
            $request->request->add(['cost_comparison_id' => $details->cost_comparison_id]);
        } else {
            $data['cost_comparison_id'] = $request->cost_comparison_id;
            $data['name'] = $request->name;
            CostComparisonOtherScholarship::create($data);
        }

        $values = $this->calculateTotalCostOrAid($request->cost_comparison_id);
        return response()->json([
            'success' => true,
            'message' => 'Cost comparison saved successfully',
            'data' => $values,
        ]);
    }

    public function editCollegeDetails(Request $request, $id)
    {
        $isIdExist = CostComparisonDetail::where('cost_comparison_id', $id)->with(['cost_comparison' => function ($cost) {
            $cost->with(['college_search_add' => function ($college) {
                $college->with(['collegeInformation']);
            }]);
        }])->first();
        // dd($isIdExist->toArray());
        if (!$isIdExist) {
            return response()->json([
                'success' => false,
                'message' => 'Trying to access invalid resource',
            ]);
        }
        $isIdExist->update($request->all());
        $data = $this->calculateTotalCostOrAid($isIdExist->cost_comparison_id);
        return response()->json([
            'success' => true,
            'message' => 'Cost comparison saved successfully',
            'data' => $data,
        ]);
    }

    public function calculateTotalCostOrAid($costcomparisonid)
    {
        $data = CostComparisonDetail::where('cost_comparison_id', $costcomparisonid)->with(['cost_comparison' => function ($cost) {
            $cost->with(['college_search_add' => function ($college) {
                $college->with(['collegeInformation']);
            }]);
        }])->first()->toArray();

        $college_information = $data['cost_comparison']['college_search_add']['college_information'];

        $tution_and_fees = $data['direct_tuition_free_year'] ? $data['direct_tuition_free_year'] : $college_information['tution_and_fess'];
        $room_and_board = $data['direct_room_board_year'] ? $data['direct_room_board_year'] : $college_information['room_and_board'];

        $total_direct_cost = $tution_and_fees + $room_and_board;

        $total_merit_cost = $data['institutional_academic_merit_aid'] + $data['institutional_exchange_program_scho'] + $data['institutional_honors_col_program'] + $data['institutional_academic_department_scho'] + $data['institutional_atheletic_scho'] + $data['institutional_other_talent_scho'] + $data['institutional_diversity_scho'] + $data['institutional_legacy_scho'] + $data['institutional_other_scho'];
        $total_need_based_aid = $data['need_base_federal_grants'] + $data['need_base_institutional_grants'] + $data['need_base_state_grants'] + $data['need_base_work_study_grants'] + $data['need_base_student_loans_grants'] + $data['need_base_parent_plus_grants'] + $data['need_base_other_grants'];

        $otherscholarship = CostComparisonOtherScholarship::where('cost_comparison_id', $costcomparisonid)->get();
        $total_outside_scholarship = 0;
        foreach ($otherscholarship as $key => $value) {
            $total_outside_scholarship += $value->amount;
        }
        $total_cost_attendance = $total_merit_cost + $total_need_based_aid + $total_outside_scholarship;
        CostComparison::where('id', $costcomparisonid)->update([
            // 'total_direct_cost' => $total_direct_cost,
            'total_merit_aid' => $total_merit_cost,
            'total_need_based_aid' => $total_need_based_aid,
            'total_outside_scholarship' => $total_outside_scholarship,
            'total_cost_attendance' => $total_cost_attendance,
        ]);
        $total_cost_attendance = $total_direct_cost - $total_cost_attendance;
        return [
            'total_direct_cost' => $total_direct_cost,
            'total_merit_aid' => $total_merit_cost,
            'total_need_based_aid' => $total_need_based_aid,
            'total_outside_scholarship' => $total_outside_scholarship,
            'total_cost_attendance' => $total_cost_attendance,
        ];
    }

    public function collegeSave(Request $request)
    {
        $rules = [
            'college' => 'required',
        ];
        $customMessage = [
            'college.required' => 'Please select college',
        ];
        if ($request->ajax()) {
            $validate = Validator::make($request->all(), $rules, $customMessage);
            if ($validate->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validate->errors()->first(),
                ]);
            }
        } else {
            $request->validate($rules, $customMessage);
        }
        $college = CollegeInformation::where('college_id', $request->college)->first();
        $collegelist = CollegeList::where('user_id', auth()->user()->id)->first();
        if (!$collegelist) {
            $collegelist = CollegeList::create([
                'user_id' => auth()->user()->id,
                'active_step' => 1,
            ]);
        }
        $max_order_index = CollegeSearchAdd::where('college_lists_id', $collegelist->id)->max('order_index');
        $add_college = CollegeSearchAdd::create([
            'college_lists_id' => $collegelist->id,
            'college_id' => $request->college,
            'college_name' => $college->name,
            'order_index' => $max_order_index ? $max_order_index + 1 : 1,
        ]);
        $this->createCollegeListAllData($add_college->id);
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'College added successfully',
            ]);
        }
        return redirect()->back()->with('success', 'College added successfully');
    }

    public function deleteCollegeCost($id)
    {
        $data = CostComparisonOtherScholarship::where('id', $id)->first();
        $cid = $data->cost_comparison_id;
        $data->delete();
        $values = $this->calculateTotalCostOrAid($cid);
        return response()->json([
            'success' => true,
            'message' => 'Aid deleted successfully',
            'data' => $values,
        ]);
    }

    public function changeSearchCollegeAddStatus($id)
    {
        $data = CollegeSearchAdd::where('id', $id)->first();
        $data->update([
            'is_active' => $data->is_active ? false : true,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
        ]);
    }

    public function getHideCollege()
    {
        $data = CollegeList::where('user_id', Auth::user()->id)->select('id')->with(['college_list_details' => function ($query) {
            $query->where('is_active', false)->select('id', 'college_name', 'college_lists_id');
        }])->first();

        if ($data) {
            return response()->json([
                'success' => true,
                'data' => $data['college_list_details'],
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No data found',
            ]);
        }
    }

    public function getUserCollegeList()
    {
        // $college_list = CollegeSearchAdd::where('college_lists_id', $college_id)->where('is_active', true)->with(['collegeInformation'])->orderBy('order_index', 'asc')->get();
        try {
            $collegelist = CollegeList::where('user_id', Auth::id())->with(['college_list_details' => function ($query) {
                $query->where('is_active', true)->select('id', 'college_name', 'college_lists_id')->orderBy('order_index');
            }])->first();

            if ($collegelist) {
                $collegelist = $collegelist->toArray();
                return response()->json([
                    'success' => true,
                    'data' => $collegelist['college_list_details']
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'data' => []
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }

    public function getPastCurrentScore($id)
    {
        try {
            $data = UserCollgeScore::where('college_list_id', $id)->get();
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }

    public function getSinglePastCurrentScore($id)
    {
        try {
            $score = UserCollgeScore::where('id', $id)->first();
            if ($score) {
                return response()->json([
                    'success' => true,
                    'data' => $score,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Score not found',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }

    public function storePastCurrentScore(Request $request)
    {

        $scorerules = 'required_if:test_type,ACT|numeric|min:1|max:36';
        $otherules = 'required|numeric|min:1|max:36';

        if (isset($request->id)) {
            $score = UserCollgeScore::where('id', $request->id)->first();
            if (!$score) {
                return response()->json([
                    'success' => false,
                    'message' => 'Score not found',
                ]);
            }
        }

        if ($request->test_type != 'ACT') {
            $scorerules = 'required_if:test_type,ACT';
            $otherules = 'required|numeric|min:200|max:800';
        }

        $rules = [
            'test_type' => 'required|in:ACT,SAT,PSAT',
            'test_date' => 'required|date',
            'english_score' => $scorerules,
            'reading_score' => $otherules,
            'math_score' => $otherules,
            'science_score' => $scorerules,
        ];

        $validate = Validator::make($request->all(), $rules, [
            'test_date.required' => 'Test date is required',
            'test_date.date' => 'Test date is invalid',
            'test_type.required' => 'Test type is required',
            'test_type.in' => 'Test type is invalid',
            'english_score.required_if' => 'English score is required',
            'english_score.numeric' => 'English score must be numeric',
            'english_score.min' => 'English score must be greater than 0',
            'english_score.max' => 'English score must be less than 36',
            'reading_score.required' => 'Reading score is required',
            'reading_score.numeric' => 'Reading score must be numeric',
            'reading_score.min' => 'Reading score must be greater than 0',
            'reading_score.max' => 'Reading score must be less than 36',
            'math_score.required' => 'Math score is required',
            'math_score.numeric' => 'Math score must be numeric',
            'math_score.min' => 'Math score must be greater than 0',
            'math_score.max' => 'Math score must be less than 36',
            'science_score.required_if' => 'Science score is required',
            'science_score.numeric' => 'Science score must be numeric',
            'science_score.min' => 'Science score must be greater than 0',
            'science_score.max' => 'Science score must be less than 36',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors()->first(),
            ]);
        }
        $data = [
            'test_type' => $request->test_type,
            'test_date' => $request->test_date,
            'english_score' => $request->test_type = 'ACT' ? $request->english_score : null,
            'reading_score' => $request->reading_score,
            'math_score' => $request->math_score,
            'science_score' => $request->test_type = 'ACT' ? $request->science_score : null,
            'composite_score' => $request->composite_score,
        ];
        if (isset($request->id)) {
            UserCollgeScore::find($request->id)->update($data);
        } else {
            $data['college_list_id'] = $request->college_list_id;
            UserCollgeScore::create($data);
        }
        return response()->json([
            'success' => true,
            'message' => 'Score saved successfully',
        ]);
    }

    public function deletePastCurrentScore($id)
    {
        try {
            $score = UserCollgeScore::where('id', $id)->first();
            if ($score) {
                $score->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Score deleted successfully',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Score not found',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }

    public function deleteAllCollege()
    {
        try {
            $user = Auth::user();
            $colleges = CollegeList::where('user_id', $user->id)->with(['college_list_details' => function ($q) {
                $q->where('is_active', false);
            }])->first();
            if ($colleges && $colleges->user_id != $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'College not found',
                ]);
            }
            $colleges = $colleges->toArray();
            if (count($colleges['college_list_details']) == 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'College not found',
                ]);
            }
            foreach ($colleges['college_list_details'] as $college) {
                $this->deleteCollegeFromAllTable($college['id']);
                CollegeSearchAdd::where('id', $college['id'])->delete();
            }
            return response()->json([
                'success' => true,
                'message' => 'College deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }

    public function removeUserCollege($id)
    {
        try {
            $single_college = CollegeSearchAdd::where('id', $id)->first();
            if (!$single_college) {
                return response()->json([
                    'success' => false,
                    'message' => 'College not found',
                ]);
            }
            $college_list = $single_college->signle_college_information;
            if (Auth::id() != $college_list->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'College not found',
                ]);
            }
            $single_college->delete();
            return response()->json([
                'success' => true,
                'message' => 'College deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }
}
