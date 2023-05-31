<?php

namespace App\Http\Controllers\InitialCollegeList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HighSchoolResume\States;
use Illuminate\Support\Facades\Http;
use App\Models\CollegeList;
use App\Models\CollegeSearchAdd;
use App\Models\CollegeUserStatistics;
use Illuminate\Support\Arr;

class InititalCollegeListController extends Controller
{
    public $search = [];
    public function step1(Request $request)
    {
        if (count($request->all()) > 0) {
            $createSearchList = CollegeList::create([
                'user_id' => auth()->user()->id,
                'last_search_string' => json_encode($request->all()),
                'active_step' => 2,
            ]);
            $route = route('admin-dashboard.initialCollegeList.step2', ['college_lists_id' => $createSearchList->id]);
            return redirect($route);
        }

        $college_major_api = env('COLLEGE_RECORD_API') . '?'.'api_key='. env('COLLEGE_RECORD_API_KEY'). '&fields=programs.cip_4_digit.code,programs.cip_4_digit.title';

        $college_major_response = Http::get($college_major_api);
        $college_major_data = json_decode($college_major_response->body());

        $data = [];
        foreach ($college_major_data->results as $key => $value) {
            $data = array_merge($data, $value->{'latest.programs.cip_4_digit'});
        }
        $data = collect($data)->unique('code')->sortBy('title')->all();

        $states = States::select('state_name', 'state_code')->get();
        return view('user.admin-dashboard.initial-college-list.step1', [
            'states' => $states,
            'college_major_data' => $data,
        ]);
    }

    public function step2(Request $request) {
        $data = [];
        $searchstring = CollegeList::where('id', $request->college_lists_id)->select('last_search_string')->first();
        $searchstring = json_decode($searchstring->last_search_string);
        if (count($request->all()) > 0) {
            $api = env('COLLEGE_RECORD_API') . '?'.'api_key='. env('COLLEGE_RECORD_API_KEY').'&page=0&sort=latest.earnings.6_yrs_after_entry.gt_threshold_suppressed:desc';
            $api = $api . '&fields=id,school.name,school.city,school.state,latest.student.size,school.branches,school.locale,school.ownership,school.degrees_awarded.predominant,latest.academics.program_reporter.programs_offered,latest.cost.avg_net_price.overall,latest.completion.consumer_rate,latest.earnings.10_yrs_after_entry.median,latest.earnings.6_yrs_after_entry.percent_greater_than_25000,school.under_investigation,latest.completion.outcome_percentage_suppressed.all_students.8yr.award_pooled,latest.completion.rate_suppressed.four_year,latest.completion.rate_suppressed.lt_four_year_150percent,latest.programs.cip_4_digit';
            if (isset($searchstring->average_annual_cost) && $searchstring->average_annual_cost) {
                $api = $api . '&latest.cost.avg_net_price.overall__range=' . $searchstring->average_annual_cost * 1000;
            }

            if (isset($searchstring->acceptance_rate) && $searchstring->acceptance_rate) {
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

            if (isset($searchstring->state) && count($request->state) > 0) {
                foreach ($request->state as $option) {
                    $api = $api . '&school.state[]=' . $option;
                }
            }

            if (isset($searchstring->sat_math) && $searchstring->sat_math) {
                $api = $api . '&latest.admissions.sat_scores.midpoint.math__range=..' . $searchstring->sat_math;
            }

            if (isset($searchstring->sat_critical_reading) && $searchstring->sat_critical_reading) {
                $api = $api . '&latest.admissions.sat_scores.midpoint.critical_reading__range=..' . $searchstring->sat_critical_reading;
            }

            if (isset($searchstring->act_score) && $searchstring->act_score) {
                $api = $api . '&latest.admissions.act_scores.midpoint.cumulative__range=..' . $searchstring->act_score;
            }

            if (isset($searchstring->search_college) && !empty($searchstring->search_college)) {
                $api = $api . '&school.search=' . $searchstring->search_college;
            }

            if (isset($searchstring->specialized_mission) && !empty($searchstring->specialized_mission)) {
                $api = $api . '&'.$searchstring->specialized_mission.'=1';
            }

            if (isset($searchstring->religious_affiliation) && !empty($searchstring->religious_affiliation)) {
                $api = $api . '&school.religious_affiliation=' . $searchstring->religious_affiliation;
            }

            // dd($api);

            $response = Http::get($api);
            $data = json_decode($response->body());
            $data = $data->results;
        }

        $selectedCollege = CollegeSearchAdd::where('college_lists_id', $request->college_lists_id)->get()->map(function($item) {
            return $item->college_id;
        })->toArray();

        return view('user.admin-dashboard.initial-college-list.step2', [
            'college_data' => $data,
            'selected_college' => $selectedCollege,
        ]);
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
        $remove_college = CollegeSearchAdd::where('college_lists_id', $id)->where('college_id', $college_id)->delete();
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
        $rules = [
            'high_school_test_type' => 'required',
            'high_school_test_date' => 'required',
            'high_school_english_score' => 'required',
            'high_school_math_score' => 'required',
            'high_school_reading_score' => 'required',
            'high_school_science_score' => 'required',
            'high_school_composite_score' => 'required',
            'past_current_test_type' => 'required',
            'past_current_test_date' => 'required',
            'past_current_english_score' => 'required',
            'past_current_math_score' => 'required',
            'past_current_reading_score' => 'required',
            'past_current_science_score' => 'required',
            'past_current_composite_score' => 'required',
            'goal_test_type' => 'required',
            'goal_test_date' => 'required',
            'goal_english_score' => 'required',
            'goal_math_score' => 'required',
            'goal_reading_score' => 'required',
            'goal_science_score' => 'required',
            'goal_composite_score' => 'required',
            'final_test_type' => 'required',
            'final_test_date' => 'required',
            'final_english_score' => 'required',
            'final_math_score' => 'required',
            'final_reading_score' => 'required',
            'final_science_score' => 'required',
            'final_composite_score' => 'required',
        ];
        $request->validate($rules, [
            'high_school_test_type.required' => 'High School Test Type is required',
            'high_school_test_date.required' => 'High School Test Date is required',
            'high_school_english_score.required' => 'High School English Score is required',
            'high_school_math_score.required' => 'High School Math Score is required',
            'high_school_reading_score.required' => 'High School Reading Score is required',
            'high_school_science_score.required' => 'High School Science Score is required',
            'high_school_composite_score.required' => 'High School Composite Score is required',
            'past_current_test_type.required' => 'Past Current Test Type is required',
            'past_current_test_date.required' => 'Past Current Test Date is required',
            'past_current_english_score.required' => 'Past Current English Score is required',
            'past_current_math_score.required' => 'Past Current Math Score is required',
            'past_current_reading_score.required' => 'Past Current Reading Score is required',
            'past_current_science_score.required' => 'Past Current Science Score is required',
            'past_current_composite_score.required' => 'Past Current Composite Score is required',
            'goal_test_type.required' => 'Goal Test Type is required',
            'goal_test_date.required' => 'Goal Test Date is required',
            'goal_english_score.required' => 'Goal English Score is required',
            'goal_math_score.required' => 'Goal Math Score is required',
            'goal_reading_score.required' => 'Goal Reading Score is required',
            'goal_science_score.required' => 'Goal Science Score is required',
            'goal_composite_score.required' => 'Goal Composite Score is required',
            'final_test_type.required' => 'Final Test Type is required',
            'final_test_date.required' => 'Final Test Date is required',
            'final_english_score.required' => 'Final English Score is required',
            'final_math_score.required' => 'Final Math Score is required',
            'final_reading_score.required' => 'Final Reading Score is required',
            'final_science_score.required' => 'Final Science Score is required',
            'final_composite_score.required' => 'Final Composite Score is required',
        ]);
        return redirect(route('admin-dashboard.initialCollegeList.step4', ['college_lists_id' => $request->college_lists_id]));
    }

    public function step4(Request $request) {
        CollegeList::where('id', $request->college_lists_id)->update([
            'active_step' => 4,
        ]);
        return view('user.admin-dashboard.initial-college-list.step4');
    }

    public function getSelectedCollegeList($college_id) {
        $college_list = CollegeSearchAdd::where('college_lists_id', $college_id)->orderBy('order_index', 'asc')->get();
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
}
