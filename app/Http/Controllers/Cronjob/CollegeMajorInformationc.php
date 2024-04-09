<?php

namespace App\Http\Controllers\Cronjob;

use App\Http\Controllers\Controller;
use App\Models\CollegeInformation;
use Illuminate\Http\Request;
use App\Models\CollegeMajorInformation;
use App\Models\FieldsOfStudy;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class CollegeMajorInformationc extends Controller
{
    public function index(Request $request)
    {
        set_time_limit(0);
        $page = 1;
        $perPage = 50;
        $totalRecords = 0;
        $approxPage = 0;
        $data = [];
        Log::channel('fetchcollegeinfo')->info("Cronjob Started");
        try {
            do {
                $college_major_api = env('COLLEGE_RECORD_API') . '?' . 'api_key=' . env('COLLEGE_RECORD_API_KEY') . '&page=' . $page . '&per_page=' . $perPage . '&fields=id,programs.cip_4_digit.code,programs.cip_4_digit.title,programs.cip_4_digit.description,programs.cip_4_digit.debt.parent_plus.all.all_inst.median,programs.cip_4_digit.earnings.highest.1_yr.overall_median_earnings';

                $college_major_response = Http::timeout(0)->get($college_major_api);
                $college_major_data = json_decode($college_major_response->body());

                if (!empty($college_major_data->results)) {
                    $totalRecords = $college_major_data->metadata->total;
                    if ($approxPage == 0) {
                        $approxPage = ceil($totalRecords / $perPage);
                        Log::channel('fetchcollegeinfo')->info('Total Page: ' . $approxPage);
                    }
                    foreach ($college_major_data->results as $key => $value) {
                        if (isset($value->{'latest.programs.cip_4_digit'})) {
                            $cip4Digits = $value->{'latest.programs.cip_4_digit'};
                            $data = array_merge($data, $cip4Digits);

                            $collegeInfo = CollegeInformation::where('college_id', $value->id)->first();
                            if ($collegeInfo) {
                                foreach ($cip4Digits as $cip4Digit) {
                                    FieldsOfStudy::firstOrCreate([
                                        'college_information_id' => $collegeInfo->id,
                                        'code' => $cip4Digit->{'code'},
                                    ], [
                                        'description' => isset($cip4Digit->{'description'}) ? $cip4Digit->{'description'} : '',
                                        'debt_after_graduation' => isset($cip4Digit->{'debt.parent_plus.all.all_inst.median'}) ? $cip4Digit->{'debt.parent_plus.all.all_inst.median'} : 0,
                                        'median_earning' => isset($cip4Digit->{'earnings->highest->1_yr->overall_median_earnings'}) ? $cip4Digit->{'earnings->highest->1_yr->overall_median_earnings'} : 0,
                                        'title' => isset($cip4Digit->{'title'}) ? $cip4Digit->{'title'} : 'No Title',
                                    ]);
                                }
                            }
                        }
                    }
                }
                $page++;
            } while (!empty($college_major_data->results) ||  $page <= $approxPage);
            $data = collect($data)->unique('code')->sortBy('title')->all();


            if (count($data) > 0) {
                foreach ($data as $key => $value) {
                    $payload = [
                        'title' => str_replace(".", "", $value->title),
                        'code' => $value->code,
                    ];

                    $existingData = CollegeMajorInformation::where('code', $value->code)->first();
                    if (empty($existingData)) {
                        CollegeMajorInformation::create($payload);
                    } else {
                        $existingData->update($payload);
                    }
                }
            }
        } catch (\Exception $e) {
            Log::channel('fetchcollegeinfo')->info('Error fetching college data: ' . $e->getMessage());
        }
        Log::channel('fetchcollegeinfo')->info("$totalRecords college major records processed");
        Log::channel('fetchcollegeinfo')->info("Cronjob Ended");
    }
}
