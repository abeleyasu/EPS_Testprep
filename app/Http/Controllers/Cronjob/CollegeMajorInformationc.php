<?php

namespace App\Http\Controllers\Cronjob;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CollegeMajorInformation;
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
                $college_major_api = env('COLLEGE_RECORD_API') . '?'.'api_key='. env('COLLEGE_RECORD_API_KEY'). '&page='.$page . '&per_page='.$perPage . '&fields=programs.cip_4_digit.code,programs.cip_4_digit.title';
                
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
                            $data = array_merge($data, $value->{'latest.programs.cip_4_digit'});
                        }
                    }
                }
                $page++;
            } while (!empty($college_major_data->results) ||  $page <= $approxPage);
            $data = collect($data)->unique('code')->sortBy('title')->all();
            if (count($data) > 0) {
                foreach ($data as $key => $value) {
                    $payload = [
                        'title' => $value->title,
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
