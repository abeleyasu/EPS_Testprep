<?php

namespace App\Http\Controllers\Cronjob;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use App\Models\CollegeInformation;
use Exception;
use Illuminate\Support\Facades\Log;

class FetchCollegeInformation extends Controller
{
    public function index(Request $request)
    {
        set_time_limit(1200);
        $collegeData = []; // Array to store all the college data
        $page = 0;
        $perPage = 100;
        $totalRecords = 0;

        Log::channel('fetchcollegeinfo')->info("Cronjob Started");
        try {
            do {
                // $apiEndpoint = "https://api.data.gov/ed/collegescorecard/v1/schools?api_key=$college_scorecard_api_key&page={$page}&per_page={$perPage}";
                // $apiEndpoint = $apiEndpoint . '&fields=id,school.name,school.city,school.state,latest.student.size,school.branches,school.locale,school.ownership,school.degrees_awarded.predominant,latest.academics.program_reporter.programs_offered,latest.cost.avg_net_price.overall,latest.completion.consumer_rate,latest.earnings.10_yrs_after_entry.median,latest.earnings.6_yrs_after_entry.percent_greater_than_25000,school.under_investigation,latest.completion.outcome_percentage_suppressed.all_students.8yr.award_pooled,latest.completion.rate_suppressed.four_year,latest.completion.rate_suppressed.lt_four_year_150percent,latest.programs.cip_4_digit';
            
                $apiEndpoint = env('COLLEGE_RECORD_API') . '?'.'api_key='. env('COLLEGE_RECORD_API_KEY').'&page='.$page . '&per_page='.$perPage . '&sort=latest.earnings.6_yrs_after_entry.gt_threshold_suppressed:desc';
                $apiEndpoint = $apiEndpoint . '&fields=id,school.name,school.city,school.state,latest.student.size,school.locale,school.ownership,latest.admissions.admission_rate.overall,latest.cost.avg_net_price.overall,latest.completion.consumer_rate,latest.earnings.10_yrs_after_entry.median';

                // Make the API request
                $guzzleClient = new GuzzleClient();
                $response = $guzzleClient->get($apiEndpoint);
                $data = json_decode($response->getBody()->getContents(), true);
    
                // Check if we received any records
                if (!empty($data['results'])) {
                    $totalRecords = $data['metadata']['total'];
                    // Process the retrieved college data
                    foreach ($data['results'] as $key => $record) {
                        $name = $record['school.name'];
                        $city = $record['school.city'];
                        $state = $record['school.state'];
                        $collegeId = $record['id'];
                        $local = $record['school.locale'];
                        $size = $record['latest.student.size'];
                        $ownership = $record['school.ownership'];
                        $avg_anual_cost = $record['latest.cost.avg_net_price.overall'] ? $record['latest.cost.avg_net_price.overall'] : null;
                        $consumer_rate = $record['latest.completion.consumer_rate'];
                        $earnings_median = $record['latest.earnings.10_yrs_after_entry.median'];
                        $admission_rate = $record['latest.admissions.admission_rate.overall'] ? $record['latest.admissions.admission_rate.overall'] : null;
    
                        // Check if the college_id exists in the college_information table
                        $college = CollegeInformation::where('college_id', $collegeId)->first();
                        if ($college) {
                            $college->name = $name;
                            $college->city = $city;
                            $college->state = $state;
                            $college->locale = $local;
                            $college->size = $size;
                            $college->ownership = $ownership;
                            $college->consumer_rate = $consumer_rate;
                            $college->earnings_median = $earnings_median;
                            $college->overall_admission_rate = $admission_rate;
                            $college->save();
                        } else {
                            CollegeInformation::create([
                                'name' => $name,
                                'city' => $city,
                                'state' => $state,
                                'college_id' => $collegeId,
                                'locale' => $local,
                                'size' => $size,
                                'ownership' => $ownership,
                                'consumer_rate' => $consumer_rate,
                                'earnings_median' => $earnings_median,
                                'overall_admission_rate' => $overall_admission_rate,
                            ]);
                        }
                    }
                }
                $page++; // Move to the next page
            } while (!empty($data['results']));
        } catch (\Exception $e) {
            Log::channel('fetchcollegeinfo')->info('Error fetching college data: ' . $e->getMessage());
        }
        Log::channel('fetchcollegeinfo')->info("$totalRecords college records processed");
        Log::channel('fetchcollegeinfo')->info("Cronjob Ended");
    }
}
