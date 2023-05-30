<?php

namespace App\Http\Controllers\InitialCollegeList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HighSchoolResume\States;
use Illuminate\Support\Facades\Http;

class InititalCollegeListController extends Controller
{
    public function step1(Request $request)
    {
        if (count($request->all()) > 0) {
            $route = route('admin-dashboard.initialCollegeList.step2', $request->all());
            return redirect($route);
        }
        $states = States::select('state_name', 'state_code')->get();
        return view('user.admin-dashboard.initial-college-list.step1', [
            'states' => $states,
        ]);
    }

    public function step2(Request $request) {
        $data = [];
        if (count($request->all()) > 0) {
            $api = env('COLLEGE_RECORD_API') . '?'.'api_key='. env('COLLEGE_RECORD_API_KEY').'&page=0&sort=latest.earnings.6_yrs_after_entry.gt_threshold_suppressed:desc';
            $api = $api . '&fields=id,school.name,school.city,school.state,latest.student.size,school.branches,school.locale,school.ownership,school.degrees_awarded.predominant,latest.academics.program_reporter.programs_offered,latest.cost.avg_net_price.overall,latest.completion.consumer_rate,latest.earnings.10_yrs_after_entry.median,latest.earnings.6_yrs_after_entry.percent_greater_than_25000,school.under_investigation,latest.completion.outcome_percentage_suppressed.all_students.8yr.award_pooled,latest.completion.rate_suppressed.four_year,latest.completion.rate_suppressed.lt_four_year_150percent,latest.programs.cip_4_digit';
            if ($request->average_annual_cost) {
                $api = $api . '&latest.cost.avg_net_price.overall__range=' . $request->average_annual_cost * 1000;
            }
            if ($request->acceptance_rate) {
                $api = $api . '&latest.admissions.admission_rate.consumer_rate__range=' . ($request->acceptance_rate / 100) . '..1';
            }   
            if (isset($request->college_size_option) && count($request->college_size_option) > 0) {
                $size = '';
                foreach ($request->college_size_option as $option) {
                    switch ($option) {
                        case 'Small':
                            $size .= '1..2000';
                            break;
                        case 'Medium':
                            $size .= ',2000..15000';
                            break;
                        case 'Large':
                            $size .= ',15001..';
                            break;
                        default:
                            $size = '1..';
                            break;
                    }
                }
                $api = $api . '&latest.student.size__range=' . $size;
            }
            if (isset($request->type_of_school) && count($request->type_of_school) > 0) {
                $type = '';
                foreach ($request->type_of_school as $option) {
                    switch ($option) {
                        case 'Public':
                            $type .= '1';
                            break;
                        case 'Private Nonprofit':
                            $type .= ',2';
                            break;
                        case 'Private For-Profit':
                            $type .= ',3';
                            break;
                    }
                }
                if ($type != '') {
                    $api = $api . '&school.ownership=' . $type;
                }
            }
            if (isset($request->urbanicity) && count($request->urbanicity) > 0) {
                $urban = '';
                foreach ($request->urbanicity as $option) {
                    switch ($option) {
                        case 'City':
                            $urban .= '11,12,13';
                            break;
                        case 'Suburban':
                            $urban .= ',21,22,23';
                            break;
                        case 'Town':
                            $urban .= ',31,32,33';
                            break;
                        case 'Rural':
                            $urban .= ',41,42,43';
                            break;
                    }
                }
                if ($urban != '') {
                    $api = $api . '&school.locale=' . $urban;
                }
            }

            if (isset($request->state) && count($request->state) > 0) {
                foreach ($request->state as $option) {
                    $api = $api . '&school.state[]=' . $option;
                }
            }

            if ($request->sat_math) {
                $api = $api . '&latest.admissions.sat_scores.midpoint.math__range=..' . $request->sat_math;
            }

            if ($request->sat_critical_reading) {
                $api = $api . '&latest.admissions.sat_scores.midpoint.critical_reading__range=..' . $request->sat_critical_reading;
            }

            if ($request->act_score) {
                $api = $api . '&latest.admissions.act_scores.midpoint.cumulative__range=..' . $request->act_score;
            }

            if (isset($request->search_college) && !empty($request->search_college)) {
                $api = $api . '&school.search=' . $request->search_college;
            }

            $response = Http::get($api);
            $data = json_decode($response->body());
            $data = $data->results;
        }

        return view('user.admin-dashboard.initial-college-list.step2', [
            'college_data' => $data,
        ]);
    }

    public function step3() {
        return view('user.admin-dashboard.initial-college-list.step3');
    }
}
