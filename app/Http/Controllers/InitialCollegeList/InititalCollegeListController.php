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

class InititalCollegeListController extends Controller
{
    public $search = [];
    public function step1(Request $request)
    {
        if (count($request->all()) > 0) {
            $createSearchList = CollegeList::where('user_id', auth()->user()->id)->first();
            if (!$createSearchList) {
                $createSearchList = CollegeList::create([
                    'user_id' => auth()->user()->id,
                    'last_search_string' => json_encode($request->all()),
                    'active_step' => 2,
                ]);
            } else {
                $createSearchList->update([
                    'last_search_string' => json_encode($request->all()),
                    'active_step' => 2,
                ]);
            }
            $route = route('admin-dashboard.initialCollegeList.step2', ['college_lists_id' => $createSearchList->id]);
            return redirect($route);
        }

        $data = CollegeMajorInformation::select('title', 'code')->get();

        $states = States::select('state_name', 'state_code')->get();
        return view('user.admin-dashboard.initial-college-list.step1', [
            'states' => $states,
            'college_major_data' => $data,
        ]);
    }

    public function step2(Request $request) {
        $data = $this->getCollegeData($request->college_lists_id);
        $selectedCollege = CollegeSearchAdd::where('college_lists_id', $request->college_lists_id)->get()->map(function($item) {
            return $item->college_id;
        })->toArray();

        return view('user.admin-dashboard.initial-college-list.step2', [
            'college_data' => $data,
            'selected_college' => $selectedCollege,
        ]);
    }

    function getCollegeData($college_lists_id) {
        $data = [];
        $searchstring = CollegeList::where('id', $college_lists_id)->select('last_search_string')->first();
        $searchstring = json_decode($searchstring->last_search_string);
        // dd($searchstring);
        if ($searchstring) {
            $api = env('COLLEGE_RECORD_API') . '?'.'api_key='. env('COLLEGE_RECORD_API_KEY').'&page=0&per_page=50&sort=latest.earnings.6_yrs_after_entry.gt_threshold_suppressed:desc';
            $api = $api . '&fields=id,school.name,school.city,school.state,latest.student.size,school.branches,school.locale,school.ownership,school.degrees_awarded.predominant,latest.academics.program_reporter.programs_offered,latest.cost.avg_net_price.overall,latest.completion.consumer_rate,latest.earnings.10_yrs_after_entry.median,latest.earnings.6_yrs_after_entry.percent_greater_than_25000,school.under_investigation,latest.completion.outcome_percentage_suppressed.all_students.8yr.award_pooled,latest.completion.rate_suppressed.four_year,latest.completion.rate_suppressed.lt_four_year_150percent,latest.programs.cip_4_digit,latest.admissions.admission_rate.overall';

            if (isset($searchstring->search_college) && !empty($searchstring->search_college)) {
                $api = $api . '&school.search=' . $searchstring->search_college;
            } else {
                if (isset($searchstring->average_annual_cost) && $searchstring->average_annual_cost && $searchstring->average_annual_cost != '0') {
                    $api = $api . '&latest.cost.avg_net_price.overall__range=' . $searchstring->average_annual_cost * 1000;
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
                    $api = $api . '&'.$searchstring->specialized_mission.'=1';
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
            $response = $guzzleClient->get($api);
            $data = json_decode($response->getBody()->getContents(), true);
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
        return $data;
    }

    public function saveCollege(Request $request) {
        $max_order_index = CollegeSearchAdd::where('college_lists_id', $request->school_lists_id)->max('order_index');
        $add_college = CollegeSearchAdd:: create([
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

    public function removeCollge($id, $college_id) {
        $remove_college = CollegeSearchAdd::where('college_lists_id', $id)->where('college_id', $college_id)->first();
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

    public function step3(Request $request) {
        CollegeList::where('id', $request->college_lists_id)->update([
            'active_step' => 3,
        ]);
        $college_list_date = CollegeList::where('id', $request->college_lists_id)->first();
        $test_type = config('constants.test_type');
        return view('user.admin-dashboard.initial-college-list.step3', [
            'test_type' => $test_type,
            'college_list_date' => $college_list_date,
        ]);
    }

    public function saveAcademicStatistics(Request $request, $id) {
        $college_list = CollegeList::where('id', $id)->first();
        $college_list->fill($request->all());
        $college_list->save();
        return "success";
    }

    public function submitForm(Request $request) {

        $writeScoreMinAndMaxValidationForSat = '|numeric|min:1|max:44';
        $readingScoreMinAndMaxValidationForSat = '|numeric|min:1|max:52';
        $mathWithCalculator = '|numeric|min:1|max:38';
        $mathWithNoCalculator = '|numeric|min:1|max:20';

        $writeScoreMinAndMaxValidationForPSAT = '|numeric|min:1|max:44';
        $readingScoreMinAndMaxValidationForPSAT = '|numeric|min:1|max:47';
        $mathWithCalculatorPSAT = '|numeric|min:1|max:31';
        $mathWithNoCalculatorPSAT = '|numeric|min:1|max:17';

        $readingScoreForACT = '|min:1|max:40';
        $readingScoreForSAT = '|min:1|max:52';
        $readingScoreForPSAT = '|min:1|max:52';

        $rules = [
            // high school
            'high_school_test_type' => 'required',
            'high_school_test_date' => 'required',
            'high_school_english_score' => 'required_if:high_school_test_type,ACT'. ($request->high_school_test_type == 'ACT' ? '|min:1|max:75|numeric' : ''),
            'high_school_math_score' => 'required_if:high_school_test_type,ACT'. ($request->high_school_test_type == 'ACT' ? '|min:1|max:60|numeric' : ''),
            'high_school_science_score' => 'required_if:high_school_test_type,ACT'. ($request->high_school_test_type == 'ACT' ? '|min:1|max:40|numeric' : ''),
            'high_school_reading_score' => 'required|numeric'. ($request->high_school_test_type == 'ACT' ? $readingScoreForACT : ($request->high_school_test_type == 'SAT' ? $readingScoreForSAT : $readingScoreForPSAT)) ,
            'high_school_write_score' => 'required_if:high_school_test_type,SAT,PSAT'. ($request->high_school_test_type == 'ACT' ? '' : ($request->high_school_test_type == 'SAT' ? $writeScoreMinAndMaxValidationForSat : $writeScoreMinAndMaxValidationForPSAT)),
            'high_school_math_with_no_calculator_score' => 'required_if:high_school_test_type,SAT,PSAT'. ($request->high_school_test_type == 'ACT' ? '' : ($request->high_school_test_type == 'SAT' ? $mathWithNoCalculator : $mathWithNoCalculatorPSAT)),
            'high_school_math_with_calculator_score' => 'required_if:high_school_test_type,SAT,PSAT'. ($request->high_school_test_type == 'ACT' ? '' : ($request->high_school_test_type == 'SAT' ? $mathWithCalculator : $mathWithCalculatorPSAT)),

            // past current
            'past_current_test_type' => 'required',
            'past_current_test_date' => 'required',
            'past_current_english_score' => 'required_if:past_current_test_type,ACT'. ($request->past_current_test_type == 'ACT' ? '|min:1|max:75|numeric' : ''),
            'past_current_math_score' => 'required_if:past_current_test_type,ACT'. ($request->past_current_test_type == 'ACT' ? '|min:1|max:60|numeric' : ''),
            'past_current_science_score' => 'required_if:past_current_test_type,ACT'. ($request->past_current_test_type == 'ACT' ? '|min:1|max:40|numeric' : ''),
            'past_current_reading_score' => 'required|numeric'. ($request->past_current_test_type == 'ACT' ? $readingScoreForACT : ($request->past_current_test_type == 'SAT' ? $readingScoreForSAT : $readingScoreForPSAT)),
            'past_current_write_score' => 'required_if:high_schopast_current_test_typeol_test_type,SAT,PSAT'. ($request->past_current_test_type == 'ACT' ? '' : ($request->past_current_test_type == 'SAT' ? $writeScoreMinAndMaxValidationForSat : $writeScoreMinAndMaxValidationForPSAT)),
            'past_current_math_with_no_calculator_score' => 'required_if:past_current_test_type,SAT,PSAT'. ($request->past_current_test_type == 'ACT' ? '' : ($request->past_current_test_type == 'SAT' ? $mathWithNoCalculator : $mathWithNoCalculatorPSAT)),
            'past_current_math_with_calculator_score' => 'required_if:past_current_test_type,SAT,PSAT'. ($request->past_current_test_type == 'ACT' ? '' :  ($request->past_current_test_type == 'SAT' ? $mathWithCalculator : $mathWithCalculatorPSAT)),
            // goal
            'goal_test_type' => 'required',
            'goal_test_date' => 'required',
            'goal_english_score' => 'required_if:goal_test_type,ACT'. ($request->goal_test_type == 'ACT' ? '|min:1|max:75|numeric' : ''),
            'goal_math_score' => 'required_if:goal_test_type,ACT'. ($request->goal_test_type == 'ACT' ? '|min:1|max:60|numeric' : ''),
            'goal_science_score' => 'required_if:goal_test_type,ACT'. ($request->goal_test_type == 'ACT' ? '|min:1|max:40|numeric' : ''),
            'goal_reading_score' => 'required|numeric'. ($request->goal_test_type == 'ACT' ? $readingScoreForACT : ($request->goal_test_type == 'SAT' ? $readingScoreForSAT : $readingScoreForPSAT)),
            'goal_write_score' => 'required_if:goal_test_type,SAT,PSAT'. ($request->goal_test_type == 'ACT' ? '' : ($request->goal_test_type == 'SAT' ? $writeScoreMinAndMaxValidationForSat : $writeScoreMinAndMaxValidationForPSAT)),
            'goal_math_with_no_calculator_score' => 'required_if:goal_test_type,SAT,PSAT'. ($request->goal_test_type == 'ACT' ? '' : ($request->goal_test_type == 'SAT' ? $mathWithNoCalculator : $mathWithNoCalculatorPSAT)),
            'goal_math_with_calculator_score' => 'required_if:goal_test_type,SAT,PSAT'. ($request->goal_test_type == 'ACT' ? '' : ($request->goal_test_type == 'SAT' ? $mathWithCalculator : $mathWithCalculatorPSAT)),
            // final
            'final_test_type' => 'required',
            'final_test_date' => 'required',
            'final_english_score' => 'required_if:final_test_type,ACT'. ($request->final_test_type == 'ACT' ? '|min:1|max:75|numeric' : ''),
            'final_math_score' => 'required_if:final_test_type,ACT'. ($request->final_test_type == 'ACT' ? '|min:1|max:60|numeric' : ''),
            'final_science_score' => 'required_if:final_test_type,ACT'. ($request->final_test_type == 'ACT' ? '|min:1|max:40|numeric' : ''),
            'final_reading_score' => 'required|numeric'. ($request->final_test_type == 'ACT' ? $readingScoreForACT : ($request->final_test_type == 'SAT' ? $readingScoreForSAT : $readingScoreForPSAT)),
            'final_write_score' => 'required_if:final_test_type,SAT,PSAT'. ($request->final_test_type == 'ACT' ? '' : ($request->final_test_type == 'SAT' ? $writeScoreMinAndMaxValidationForSat : $writeScoreMinAndMaxValidationForPSAT)),
            'final_math_with_no_calculator_score' => 'required_if:final_test_type,SAT,PSAT'. ($request->final_test_type == 'ACT' ? '' : ($request->final_test_type == 'SAT' ? $mathWithNoCalculator : $mathWithNoCalculatorPSAT)),
            'final_math_with_calculator_score' => 'required_if:final_test_type,SAT,PSAT'. ($request->final_test_type == 'ACT' ? '' : ($request->final_test_type == 'SAT' ? $mathWithCalculator : $mathWithCalculatorPSAT)),
        ];
        $request->validate($rules, [
            'high_school_test_type.required' => 'High School Test Type is required',
            'high_school_test_date.required' => 'High School Test Date is required',
            'high_school_english_score.required_if' => 'High School English Score is required',
            'high_school_math_score.required_if' => 'High School Math Score is required',
            'high_school_science_score.required_if' => 'High School Science Score is required',
            'high_school_reading_score.required' => 'High School Reading Score is required',
            'high_school_write_score.required_if' => 'High School Write Score is required',
            'high_school_math_with_no_calculator_score.required_if' => 'High School Math With No Calculator Score is required',
            'high_school_math_with_calculator_score.required_if' => 'High School Math With Calculator Score is required',
            'high_school_math_with_no_calculator_score.min' => 'High School Math With No Calculator Score must be at least 1',
            'high_school_math_with_no_calculator_score.max' => 'High School Math With No Calculator Score may not be greater than '. ($request->high_school_test_type == 'SAT' ? 20 : 17),
            'high_school_math_with_calculator_score.min' => 'High School Math With Calculator Score must be at least 1',
            'high_school_math_with_calculator_score.max' => 'High School Math With Calculator Score may not be greater than '. ($request->high_school_test_type == 'SAT' ? 38 : 31),
            'high_school_write_score.min' => 'High School Write Score must be at least 1',
            'high_school_write_score.max' => 'High School Write Score may not be greater than'. ($request->high_school_test_type == 'SAT' ? 44 : 44),
            'high_school_reading_score.min' => 'High School Reading Score must be at least 1',
            'high_school_reading_score.max' => 'High School Reading Score may not be greater than '. ($request->high_school_test_type == 'SAT' ? 52 : ($request->high_school_test_type == 'ACT' ? 40 : 47)),
            'high_school_english_score.min' => 'High School English Score must be at least 1',
            'high_school_english_score.max' => 'High School English Score may not be greater than 75',
            'high_school_math_score.min' => 'High School Math Score must be at least 1',
            'high_school_math_score.max' => 'High School Math Score may not be greater than 60',
            'high_school_science_score.min' => 'High School Science Score must be at least 1',
            'high_school_science_score.max' => 'High School Science Score may not be greater than 40',
            

            'past_current_test_type.required' => 'Past Current Test Type is required',
            'past_current_test_date.required' => 'Past Current Test Date is required',
            'past_current_english_score.required_if' => 'Past Current English Score is required',
            'past_current_math_score.required_if' => 'Past Current Math Score is required',
            'past_current_science_score.required_if' => 'Past Current Science Score is required',
            'past_current_reading_score.required' => 'Past Current Reading Score is required',
            'past_current_write_score.required_if' => 'Past Current Write Score is required',
            'past_current_math_with_no_calculator_score.required_if' => 'Past Current Math With No Calculator Score is required',
            'past_current_math_with_calculator_score.required_if' => 'Past Current Math With Calculator Score is required',
            'past_current_math_with_no_calculator_score.min' => 'Past Current Math With No Calculator Score must be at least 1',
            'past_current_math_with_no_calculator_score.max' => 'Past Current Math With No Calculator Score may not be greater than '. ($request->past_current_test_type == 'SAT' ? 20 : 17),
            'past_current_math_with_calculator_score.min' => 'Past Current Math With Calculator Score must be at least 1',
            'past_current_math_with_calculator_score.max' => 'Past Current Math With Calculator Score may not be greater than '. ($request->past_current_test_type == 'SAT' ? 38 : 31),
            'past_current_write_score.min' => 'Past Current Write Score must be at least 1',
            'past_current_write_score.max' => 'Past Current Write Score may not be greater than '. ($request->past_current_test_type == 'SAT' ? 44 : 44),
            'past_current_reading_score.min' => 'Past Current Reading Score must be at least 1',
            'past_current_reading_score.max' => 'Past Current Reading Score may not be greater than '. ($request->past_current_test_type == 'SAT' ? 52 : ($request->past_current_test_type == 'ACT' ? 40 : 47)),
            'past_current_english_score.min' => 'Past Current English Score must be at least 1',
            'past_current_english_score.max' => 'Past Current English Score may not be greater than 75',
            'past_current_math_score.min' => 'Past Current Math Score must be at least 1',
            'past_current_math_score.max' => 'Past Current Math Score may not be greater than 60',
            'past_current_science_score.min' => 'Past Current Science Score must be at least 1',
            'past_current_science_score.max' => 'Past Current Science Score may not be greater than 40',

            'goal_test_type.required' => 'Goal Test Type is required',
            'goal_test_date.required' => 'Goal Test Date is required',
            'goal_english_score.required_if' => 'Goal English Score is required',
            'goal_math_score.required_if' => 'Goal Math Score is required',
            'goal_science_score.required_if' => 'Goal Science Score is required',
            'goal_reading_score.required' => 'Goal Reading Score is required',
            'goal_write_score.required_if' => 'Goal Write Score is required',
            'goal_math_with_no_calculator_score.required_if' => 'Goal Math With No Calculator Score is required',
            'goal_math_with_calculator_score.required_if' => 'Goal Math With Calculator Score is required',
            'goal_math_with_no_calculator_score.min' => 'Goal Math With No Calculator Score must be at least 1',
            'goal_math_with_no_calculator_score.max' => 'Goal Math With No Calculator Score may not be greater than '. ($request->goal_test_type == 'SAT' ? 20 : 17),
            'goal_math_with_calculator_score.min' => 'Goal Math With Calculator Score must be at least 1',
            'goal_math_with_calculator_score.max' => 'Goal Math With Calculator Score may not be greater than '. ($request->goal_test_type == 'SAT' ? 38 : 31),
            'goal_write_score.min' => 'Goal Write Score must be at least 1',
            'goal_write_score.max' => 'Goal Write Score may not be greater than '. ($request->goal_test_type == 'SAT' ? 44 : 44),
            'goal_reading_score.min' => 'Goal Reading Score must be at least 1',
            'goal_reading_score.max' => 'Goal Reading Score may not be greater than '. ($request->goal_test_type == 'SAT' ? 52 : ($request->goal_test_type == 'ACT' ? 40 : 47)),
            'goal_english_score.min' => 'Goal English Score must be at least 1',
            'goal_english_score.max' => 'Goal English Score may not be greater than 75',
            'goal_math_score.min' => 'Goal Math Score must be at least 1',
            'goal_math_score.max' => 'Goal Math Score may not be greater than 60',
            'goal_science_score.min' => 'Goal Science Score must be at least 1',
            'goal_science_score.max' => 'Goal Science Score may not be greater than 40',

            'final_test_type.required' => 'Final Test Type is required',
            'final_test_date.required' => 'Final Test Date is required',
            'final_english_score.required_if' => 'Final English Score is required',
            'final_math_score.required_if' => 'Final Math Score is required',
            'final_science_score.required_if' => 'Final Science Score is required',
            'final_reading_score.required' => 'Final Reading Score is required',
            'final_write_score.required_if' => 'Final Write Score is required',
            'final_math_with_no_calculator_score.required_if' => 'Final Math With No Calculator Score is required',
            'final_math_with_calculator_score.required_if' => 'Final Math With Calculator Score is required',
            'final_math_with_no_calculator_score.min' => 'Final Math With No Calculator Score must be at least 1',
            'final_math_with_no_calculator_score.max' => 'Final Math With No Calculator Score may not be greater than '. ($request->final_test_type == 'SAT' ? 20 : 17),
            'final_math_with_calculator_score.min' => 'Final Math With Calculator Score must be at least 1',
            'final_math_with_calculator_score.max' => 'Final Math With Calculator Score may not be greater than '. ($request->final_test_type == 'SAT' ? 38 : 31),
            'final_write_score.min' => 'Final Write Score must be at least 1',
            'final_write_score.max' => 'Final Write Score may not be greater than '. ($request->final_test_type == 'SAT' ? 44 : 44),
            'final_reading_score.min' => 'Final Reading Score must be at least 1',
            'final_reading_score.max' => 'Final Reading Score may not be greater than '. ($request->final_test_type == 'SAT' ? 52 : ($request->final_test_type == 'ACT' ? 40 : 47)),
            'final_english_score.min' => 'Final English Score must be at least 1',
            'final_english_score.max' => 'Final English Score may not be greater than 75',
            'final_math_score.min' => 'Final Math Score must be at least 1',
            'final_math_score.max' => 'Final Math Score may not be greater than 60',
            'final_science_score.min' => 'Final Science Score must be at least 1',
            'final_science_score.max' => 'Final Science Score may not be greater than 40',
        ]);
        $findStatistisc = CollegeUserStatistics::where('college_lists_id', $request->college_lists_id)->first();
        if (!$findStatistisc) {
            $findStatistisc = CollegeUserStatistics::create([
                'college_lists_id' => $request->college_lists_id
            ]);
        }
        $this->calculateScoreForGoalField($request, $findStatistisc->id);
        $this->calculateScoreForFinalField($request, $findStatistisc->id);
        return redirect(route('admin-dashboard.initialCollegeList.step4', ['college_lists_id' => $request->college_lists_id]));
    }

    public function calculateScoreForGoalField($data, $db_field_id) {
        switch ($data->goal_test_type) {
            case 'ACT': 
                $data = [
                    'english' => $data->goal_english_score,
                    'math' => $data->goal_math_score,
                    'reading' => $data->goal_reading_score,
                    'science' => $data->goal_science_score, 
                ];
                $score = $this->calculateACTScore($data);
                $this->storeScore($score, 'goal_act_score', $db_field_id);
            break;

            case 'SAT': 
                $data = [
                    'reading' => $data->goal_reading_score,
                    'writing' => $data->goal_write_score,
                    'math_with_cal' => $data->goal_math_with_calculator_score,
                    'math_without_cal' => $data->goal_math_with_no_calculator_score,
                ];
                $score = $this->calculateSATScore($data);
                $this->storeScore($score, 'goal_sat_score', $db_field_id);
            break;

            case 'PSAT':
                $data = [
                    'reading' => $data->goal_reading_score,
                    'writing' => $data->goal_write_score,
                    'math_with_cal' => $data->goal_math_with_calculator_score,
                    'math_without_cal' => $data->goal_math_with_no_calculator_score,
                ];
                $score = $this->calculateSATScore($data);
                $this->storeScore($score, 'goal_psat_score', $db_field_id);
            break;
        }
    }

    public function calculateScoreForFinalField($data, $db_field_id) {
        switch ($data->final_test_type) {
            case 'ACT': 
                $data = [
                    'english' => $data->final_english_score,
                    'math' => $data->final_math_score,
                    'reading' => $data->final_reading_score,
                    'science' => $data->final_science_score, 
                ];
                $score = $this->calculateACTScore($data);
                $this->storeScore($score, 'final_act_score', $db_field_id);
            break;

            case 'SAT':
                $data = [
                    'reading' => $data->final_reading_score,
                    'writing' => $data->final_write_score,
                    'math_with_cal' => $data->final_math_with_calculator_score,
                    'math_without_cal' => $data->final_math_with_no_calculator_score,
                ];
                $score = $this->calculateSATScore($data);
                $this->storeScore($score, 'final_sat_score', $db_field_id);
            break;

            case 'PSAT':
                // pending
            break;
        }
    }

    public function calculateSATScore($data) {
        $math = $data['math_with_cal'] + $data['math_without_cal'];
        $read_write_score = (config('constants.SAT_Score_table.reading'. $data['reading']) + config('constants.SAT_Score_table.reading.'. $data['writing'])) * 10;
        $math_score = config('constants.SAT_Score_table.math.'. $math);
        return $math_score + $read_write_score;
    }

    public function calculatePSATScore($data) {
        $math = $data['math_with_cal'] + $data['math_without_cal'];
        $read_write_score = (config('constants.PSAT_Score_table.reading'. $data['reading']) + config('constants.PSAT_Score_table.reading.'. $data['writing'])) * 10;
        $math_score = config('constants.PSAT_Score_table.math.'. $math);
        return $math_score + $read_write_score;
    }

    public function calculateACTScore($data) {
        $score = $data['english'] + $data['math'] + $data['reading'] + $data['science'];
        return number_format($score / 4, 0);
    }

    public function storeScore($score, $field, $id) {
        CollegeUserStatistics::find($id)->update([
            $field => $score,
        ]);
    }

    public function step4(Request $request) {
        CollegeList::where('id', $request->college_lists_id)->update([
            'active_step' => 4,
        ]);

        $score = CollegeUserStatistics::where('college_lists_id', $request->college_lists_id)->first();
        return view('user.admin-dashboard.initial-college-list.step4', [
            'score' => $score
        ]);
    }

    public function getSelectedCollegeList($college_id) {
        // dd('called');
        $college_list = CollegeSearchAdd::where('college_lists_id', $college_id)->where('is_active', true)->with(['collegeInformation'])->orderBy('order_index', 'asc')->get();
        return response()->json([
            'success' => true,
            'data' => $college_list,
        ]);
    }

    public function updateOrder(Request $request, $college_list_id) {
        foreach($request->data as $data) {
            CollegeSearchAdd::find($data['id'])->update([
                'order_index' => $data['order_index'],
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Order updated successfully',
        ]);
    }

    function collegeList($college_id) {
        $data = $this->getCollegeData($college_id);
        $selectedCollege = CollegeSearchAdd::where('college_lists_id', $college_id)->get()->map(function($item) {
            return $item->college_id;
        })->toArray();

        $data = collect($data)->map(function($item) use ($selectedCollege) {
            $item['selected'] = in_array($item['id'], $selectedCollege);
            return $item;
        })->all();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function storeSelection(Request $request, $id) {
        CollegeSearchAdd::find($id)->update([
            'option' => $request->option,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Option updated successfully',
        ]);
    }

    public function getSingleCollege($id) {
        $api = env('COLLEGE_RECORD_API') . '?'.'api_key='. env('COLLEGE_RECORD_API_KEY').'&id='.$id;
        $data = Http::get($api);
        $data = json_decode($data->body());
        if (count($data->results) > 0) {
            $data = $data->results[0];
            $college_info = CollegeInformation::where('college_id', $data->id)->first();
            if ($college_info) {
                $data->latest->college_info = $college_info;
            }
        } else {
            $data = null;
        }
        return response()->json([
            'success' => $data ? true : false,
            'data' => $data,
        ]);
    }

    public function saveCollegeList($id) {
        $college_list = CollegeList::where('id', $id)->update([
            'status' => 'completed',
        ]);
        // $this->createCollegeListData($id);
        return response()->json([
            'success' => true,
            'message' => 'College list saved successfully',
        ]);
    }

    public function createCollegeListAllData($college_list_id) {
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

    public function deleteCollegeFromAllTable($college_search_id) {
        $userid = Auth::user()->id;
        CollegeDetails::where('user_id', $userid)->where('college_id', $college_search_id)->delete();
        $costcomparison = CostComparison::where('user_id', $userid)->where('college_list_id', $college_search_id)->first();
        CostComparisonDetail::where('cost_comparison_id', $costcomparison->id)->delete();
        CostComparisonOtherScholarship::where('cost_comparison_id', $costcomparison->id)->delete();
        $costcomparison->delete();
    }

    public function viewCostComparisonPage() {
        $types = CostTypes::get();
        return view('user.admin-dashboard.cost-comparison', [
            'types' => $types,
        ]);
    }

    public function getCostComparisonSummary(Request $request) {
        $userid = Auth::user()->id;
        $costcomparisonsummary = CollegeList::where('user_id', $userid)->select('id')->whereHas('college_list_details', function ($q) { 
            $q->where('is_active', true); 
        })->with(['college_list_details' => function ($query) {
            $query->where('is_active', true)->select('id', 'college_name', 'college_lists_id')->with(['costcomparison']);
        }])->first();

        $totalCount = 0;
        $data = [];
        if ($costcomparisonsummary) {
            foreach ($costcomparisonsummary['college_list_details'] as $college_data) {
                $data[] = [
                    'id' => $college_data['id'],
                    'college_name' => $college_data['college_name'],
                    'total_direct_cost' => '$'.number_format($college_data['costcomparison']['total_direct_cost']),
                    'total_merit_cost' => '$'.number_format($college_data['costcomparison']['total_merit_aid']),
                    'total_need_based_aid' => '$'.number_format($college_data['costcomparison']['total_need_based_aid']),
                    'total_outside_scholarship' => '$'.number_format($college_data['costcomparison']['total_outside_scholarship']),
                    'total_cost_attendance' => '$'.number_format($college_data['costcomparison']['total_cost_attendance']),
                ];
    
                $totalCount = $totalCount + count($costcomparisonsummary['college_list_details']);
            }
        }
        $json_data = [
            "draw"            => intval( $request->draw ),   
            "recordsTotal"    => $totalCount,  
            "recordsFiltered" => $totalCount,
            "data"            => $data
        ];
        return response()->json($json_data);
    }

    public function getCollegeWiseList() {
        $userid = Auth::user()->id;
        $costcomparisonsummary = CollegeList::where('user_id', $userid)->select('id')->whereHas('college_list_details', function ($q) { 
            $q->where('is_active', true); 
        })->with(['college_list_details' => function ($query) {
            $query->where('is_active', true)->select('id', 'college_name', 'college_lists_id')->with(['costcomparison' => function ($costquery) {
                $costquery->with(['costcomparisondetail', 'costcomparisonotherscholarship']);
            }]);
        }])->first()->toArray();

        return response()->json([
            'success' => count($costcomparisonsummary['college_list_details']) > 0 ? true : false,
            'data' => $costcomparisonsummary['college_list_details'],
        ]);
    }

    public function saveCollegeCost(Request $request) {
        $rules = [
            'amount' => 'required|numeric',
        ];

        if (!isset($request->id)) {
            $rules['name'] = 'required';
            $rules['cost_comparison_id'] = 'required';
        }

        $validate = Validator::make($request->all(), $rules,[
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

    public function editCollegeDetails(Request $request, $id) {
        $isIdExist = CostComparisonDetail::where('cost_comparison_id', $id)->first();
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

    public function calculateTotalCostOrAid($costcomparisonid) {
        $data = CostComparisonDetail::where('cost_comparison_id', $costcomparisonid)->first()->toArray();
        $total_direct_cost = $data['direct_tuition_free_year'] + $data['direct_room_board_year'];
        $total_merit_cost = $data['institutional_academic_merit_aid'] + $data['institutional_exchange_program_scho'] + $data['institutional_honors_col_program'] + $data['institutional_academic_department_scho'] + $data['institutional_atheletic_scho'] + $data['institutional_other_talent_scho'] + $data['institutional_diversity_scho'] + $data['institutional_legacy_scho'] + $data['institutional_other_scho'];
        $total_need_based_aid = $data['need_base_federal_grants'] + $data['need_base_institutional_grants'] + $data['need_base_state_grants'] + $data['need_base_work_study_grants'] + $data['need_base_student_loans_grants'] + $data['need_base_parent_plus_grants'] + $data['need_base_other_grants'];

        $otherscholarship = CostComparisonOtherScholarship::where('cost_comparison_id', $costcomparisonid)->get();
        $total_outside_scholarship = 0;
        foreach ($otherscholarship as $key => $value) {
            $total_outside_scholarship += $value->amount;
        }
        $total_cost_attendance = $total_direct_cost - ($total_merit_cost + $total_need_based_aid + $total_outside_scholarship);
        CostComparison::where('id', $costcomparisonid)->update([
            'total_direct_cost' => $total_direct_cost,
            'total_merit_aid' => $total_merit_cost,
            'total_need_based_aid' => $total_need_based_aid,
            'total_outside_scholarship' => $total_outside_scholarship,
            'total_cost_attendance' => $total_cost_attendance,
        ]);
        return [
            'total_direct_cost' => $total_direct_cost,
            'total_merit_aid' => $total_merit_cost,
            'total_need_based_aid' => $total_need_based_aid,
            'total_outside_scholarship' => $total_outside_scholarship,
            'total_cost_attendance' => $total_cost_attendance,
        ];
    }

    public function collegeSave(Request $request) {
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
        $max_order_index = CollegeSearchAdd::where('college_lists_id', $collegelist->id)->max('order_index');
        $add_college = CollegeSearchAdd:: create([
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

    public function deleteCollegeCost($id) {
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

    public function changeSearchCollegeAddStatus($id) {
        $data = CollegeSearchAdd::where('id', $id)->first();
        $data->update([
            'is_active' => $data->is_active ? false : true,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
        ]);
    }

    public function getHideCollege() {
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
}
