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

        $college_scorecard_api_key = env('COLLEGE_SCORECARD_API_KEY');
        $collegeData = []; // Array to store all the college data
        $page = 0;
        $perPage = 100;
        $totalRecords = 0;

        Log::channel('fetchcollegeinfo')->info("Cronjob Started");
        try {
            do {
                $apiEndpoint = "https://api.data.gov/ed/collegescorecard/v1/schools?api_key=$college_scorecard_api_key&fields=id,school.name,school.city,school.state&page={$page}&per_page={$perPage}";
            
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
    
                        // Check if the college_id exists in the college_information table
                        $college = CollegeInformation::where('college_id', $collegeId)->first();
                        if ($college) {
                            $college->name = $name;
                            $college->city = $city;
                            $college->state = $state;
                            $college->save();
                        } else {
                            CollegeInformation::create([
                                'name' => $name,
                                'city' => $city,
                                'state' => $state,
                                'college_id' => $collegeId,
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
