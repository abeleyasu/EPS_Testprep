<?php

namespace App\Http\Controllers;

use App\Models\CollegeInformation;
use App\Models\FieldsOfStudy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CollegeInformationController extends Controller
{
    public function getCollegeList()
    {
        $user = Auth::user();

        if ($user->role == 1) {
            $college_list = CollegeInformation::all();
        } else {
            $colleges_list = CollegeInformation::whereNull('user_id')->orWhere('user_id', Auth::id())->get();
        }
        return response()->json(['success' => true, 'dropdown_list' => $colleges_list]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $limit = isset($request->length) ? $request->length : 10;
            $search =  isset($request->search['value']) ? $request->search['value'] : "";
            $start = isset($request->start) ? $request->start : 0;

            $college_details = CollegeInformation::orderBy('name');
            $count = $college_details->count();
            if (!empty($search)) {
                $college_details = $college_details->where(function ($detail) use ($search) {
                    return $detail->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('state', 'LIKE', "%{$search}%")
                        ->orWhere('city', 'LIKE', "%{$search}%");
                });
                $count = $college_details->count();
            }

            $college_details = $college_details->skip($start)->take($limit);

            $college_details = $college_details->get()->toArray();

            $data = [];
            foreach ($college_details as $key => $college_detail) {
                $data[] = [
                    'id' => $college_detail['id'],
                    'name' => $college_detail['name'],
                    'city' => $college_detail['city'],
                    'state' => $college_detail['state'],
                    'action' =>  '<a href="' . route('admin.admission-management.college-information.edit', ['id' => $college_detail['id']]) . '" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>',
                ];
            }

            $response = [
                'draw' => $request->draw,
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $data,
            ];

            return response()->json($response);
        } else {
            return view('admin.college-information.list');
        }
    }


    // Connects College  with Peterson's ID & import all other Data
    public function import_csv(Request $request)
    {


        $file = $request->file('csv_file');
        $fileContents = file($file->getPathname());
        $indeces = null;

        $index = -1;

        foreach ($fileContents as $line) {
            $index++;
            $data = str_getcsv($line);

            if ($index == 0) {
                $indeces = $this->getColumnIndicesFromCSV(array('NAME', 'STATE_CODE', 'INUN_ID'), $data);
            } else {
                if (isset($indeces['NAME']) && isset($indeces['STATE_CODE']) && isset($indeces['INUN_ID'])) {
                    $collegeInfo = CollegeInformation::where('name', $data[$indeces['NAME']])
                        ->where('state', $data[$indeces['STATE_CODE']])
                        ->first();

                    if ($collegeInfo) {
                        $new_data = [
                            'petersons_id' => $data[$indeces['INUN_ID']],
                        ];
                        $collegeInfo->update($new_data);
                    }
                }
            }
        }

        $column_names = array(
            'TUIT_STATE_FT_D',
            'FEES_FT_D',
            'BOOKS_RES_D',
            'TRANSPORT_RES_D',
            'TUIT_NRES_FT_D',
            'TUIT_OVERALL_FT_D',
            'RM_BD_D',
            'MAIN_CALENDAR',
            'FRSH_GPA',
            'FRSH_GPA_WEIGHTED',
            'LIFE_SOR_NAT',
            'LIFE_SOR_LOCAL',
            'LIFE_FRAT_NAT',
            'LIFE_FRAT_LOCAL',
            'SORO_1ST_P',
            'FRAT_1ST_P',
            'CMPS_METRO_T',
            'HOUS_FRSH_POLICY',
            'HOUS_SPACES_OCCUP',
            'AP_RECD_1ST_N',
            'AD_DIFF_ALL',
            'AP_DL_EACT_MON',
            'AP_DL_EACT_DAY',
            'AP_DL_FRSH_MON',
            'AP_DL_FRSH_DAY',
            'AP_DL_EDEC_1_MON',
            'AP_DL_EDEC_1_DAY',
            'AP_DL_EDEC_2_DAY',
            'AP_DL_EDEC_2_MON',
            'ASSN_ATHL_NCAA',
            'ASSN_ATHL_NAIA',
            'ASSN_ATHL_NCCAA',
            'ASSN_ATHL_NJCAA',
            'ASSN_ATHL_CIAU'
        );

        $peterson_id_index = null;
        $file = $request->file('csv_file');
        $fileContents = file($file->getPathname());

        $index = -1;

        foreach ($fileContents as $line) {
            $index++;
            $data = str_getcsv($line);

            // Storing the indeces of Required Columns
            if ($index == 0) {
                $searchInColumn =  $this->getColumnIndicesFromCSV(array('INUN_ID'), $data);
                if (isset($searchInColumn['INUN_ID'])) {
                    $peterson_id_index = $searchInColumn['INUN_ID'];
                }
                $column_names = $this->getColumnIndicesFromCSV($column_names, $data);
                continue;
            }

            if ($peterson_id_index == null) {
                return redirect()->back()->with('error', 'Peterson ID (INUN_ID) cannot be empty in the CSV file.');
                // continue;
            }

            // dd($new_data);

            $collegeInfo = CollegeInformation::where('petersons_id', $data[$peterson_id_index])
                ->first();

            // dd($collegeInfo);

            if ($collegeInfo) {
                $new_data = $this->get_column_values($column_names, $data);
                // dd($new_data);

                $fees = isset($new_data['FEES_FT_D']) ? (float) $new_data['FEES_FT_D'] : 0;
                $books = isset($new_data['BOOKS_RES_D']) ? (float) $new_data['BOOKS_RES_D'] : 0;
                $transport = isset($new_data['TRANSPORT_RES_D']) ? (float) $new_data['TRANSPORT_RES_D'] : 0;
                $tuitionOverall = isset($new_data['TUIT_OVERALL_FT_D']) ? (float) $new_data['TUIT_OVERALL_FT_D'] : 0;
                $tuitionState = isset($new_data['TUIT_STATE_FT_D']) ? (float) $new_data['TUIT_STATE_FT_D'] : 0;
                $tuitionNonResident = isset($new_data['TUIT_NRES_FT_D']) ? (float) $new_data['TUIT_NRES_FT_D'] : 0;

                // if (isset($new_data['FEES_FT_D']) && isset($new_data['BOOKS_RES_D']) && isset($new_data['TRANSPORT_RES_D'])) {
                    if (isset($new_data['TUIT_OVERALL_FT_D'])) {
                        $new_data['pvt_coa'] = $tuitionOverall + $fees + $books + $transport;

                        // if ($collegeInfo->tution_and_fess == null || $collegeInfo->tution_and_fess == '') {
                            $new_data['tution_and_fess'] = $tuitionOverall + $fees;
                        // }
                    }

                    if (isset($new_data['TUIT_STATE_FT_D'])) {
                        $new_data['public_coa_in_state'] = $tuitionState + $fees + $books + $transport;

                        // if ($collegeInfo->tuition_and_fee_instate == null || $collegeInfo->tuition_and_fee_instate == '') {
                            $new_data['tuition_and_fee_instate'] = $tuitionState + $fees;
                        // }
                    }

                    if (isset($new_data['TUIT_NRES_FT_D'])) {
                        $new_data['public_coa_out_state'] = $tuitionNonResident + $fees + $books + $transport;

                        // if ($collegeInfo->tuition_and_fee_outstate == null || $collegeInfo->tuition_and_fee_outstate == '') {
                            $new_data['tuition_and_fee_outstate'] = $tuitionNonResident + $fees;
                        // }
                    }
                // }

                // if (isset($new_data['RM_BD_D']) && ($collegeInfo->room_and_board == null || $collegeInfo->room_and_board == '')) {
                if (isset($new_data['RM_BD_D'])) {
                    $new_data['room_and_board'] = $new_data['RM_BD_D'];
                }
                // if (isset($new_data['AP_DL_EACT_MON']) && ($collegeInfo->early_action_month == null || $collegeInfo->early_action_month == '')) {
                if (isset($new_data['AP_DL_EACT_MON'])) {
                    $new_data['early_action_month'] = $new_data['AP_DL_EACT_MON'];
                }
                // if (isset($new_data['AP_DL_EACT_DAY']) && ($collegeInfo->early_action_day == null || $collegeInfo->early_action_day == '')) {
                if (isset($new_data['AP_DL_EACT_DAY'])) {
                    $new_data['early_action_day'] = $new_data['AP_DL_EACT_DAY'];
                }
                // if (isset($new_data['AP_DL_FRSH_MON']) && ($collegeInfo->regular_decision_month == null || $collegeInfo->regular_decision_month == '')) {
                if (isset($new_data['AP_DL_FRSH_MON'])) {
                    $new_data['regular_decision_month'] = $new_data['AP_DL_FRSH_MON'];
                }
                // if (isset($new_data['AP_DL_FRSH_DAY']) && ($collegeInfo->regular_decision_day == null || $collegeInfo->regular_decision_day == '')) {
                if (isset($new_data['AP_DL_FRSH_DAY'])) {
                    $new_data['regular_decision_day'] = $new_data['AP_DL_FRSH_DAY'];
                }
                // if (isset($new_data['AP_DL_EDEC_1_MON']) && ($collegeInfo->early_decision_i_month == null || $collegeInfo->early_decision_i_month == '')) {
                if (isset($new_data['AP_DL_EDEC_1_MON'])) {
                    $new_data['early_decision_i_month'] = $new_data['AP_DL_EDEC_1_MON'];
                }
                // if (isset($new_data['AP_DL_EDEC_1_DAY']) && ($collegeInfo->early_decision_i_day == null || $collegeInfo->early_decision_i_day == '')) {
                if (isset($new_data['AP_DL_EDEC_1_DAY'])) {
                    $new_data['early_decision_i_day'] = $new_data['AP_DL_EDEC_1_DAY'];
                }
                // if (isset($new_data['AP_DL_EDEC_2_MON']) && ($collegeInfo->early_decision_ii_month == null || $collegeInfo->early_decision_ii_month == '')) {
                if (isset($new_data['AP_DL_EDEC_2_MON'])) {
                    $new_data['early_decision_ii_month'] = $new_data['AP_DL_EDEC_2_MON'];
                }
                // if (isset($new_data['AP_DL_EDEC_2_DAY']) && ($collegeInfo->early_decision_ii_day == null || $collegeInfo->early_decision_ii_day == '')) {
                if (isset($new_data['AP_DL_EDEC_2_DAY'])) {
                    $new_data['early_decision_ii_day'] = $new_data['AP_DL_EDEC_2_DAY'];
                }

                $collegeInfo->update($new_data);
            }
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }

    private function getColumnIndicesFromCSV($column_names, $csv_column_names)
    {

        $column_names_ass_arr = array();
        foreach ($column_names as $column_name) {
            $result = array_search($column_name, $csv_column_names);
            if ($result !== '' && $result !== false) {
                $column_names_ass_arr[$column_name] = $result;
            }
        }

        return ($column_names_ass_arr);
    }

    public function get_column_values($column_names, $data)
    {
        $new_data = [];
        foreach ($column_names as $column_name => $column_name_index) {
            $new_data[$column_name] = $data[$column_name_index] ?: null;
        }

        return $new_data;
    }

    public function import_ug_expense_asgns(Request $request)
    {

        $column_names = array(
            'TUIT_STATE_FT_D',
            'FEES_FT_D',
            'BOOKS_RES_D',
            'TRANSPORT_RES_D',
            'TUIT_NRES_FT_D',
            'TUIT_OVERALL_FT_D',
            'RM_BD_D',
        );
        $peterson_id_index = null;
        $file = $request->file('ug_expense_asgns');
        $fileContents = file($file->getPathname());

        $index = -1;
        foreach ($fileContents as $line) {
            $index++;
            $data = str_getcsv($line);
            // Storing the indeces of Required Columns
            if ($index == 0) {
                $peterson_id_index = $this->getColumnIndicesFromCSV(array('INUN_ID'), $data)['INUN_ID'];
                $column_names = $this->getColumnIndicesFromCSV($column_names, $data);
                continue;
            }
            $new_data = $this->get_column_values($column_names, $data);

            $fees = $new_data['FEES_FT_D'] ?? 0;
            $books = $new_data['BOOKS_RES_D'] ?? 0;
            $transport = $new_data['TRANSPORT_RES_D'] ?? 0;

            if (isset($new_data['TUIT_OVERALL_FT_D'])) {
                $tuitionOverall = $new_data['TUIT_OVERALL_FT_D'];
                $new_data['pvt_coa'] = $tuitionOverall + $fees + $books + $transport;
            }

            if (isset($new_data['TUIT_STATE_FT_D'])) {
                $tuitionState = $new_data['TUIT_STATE_FT_D'];
                $new_data['public_coa_in_state'] = $tuitionState + $fees + $books + $transport;
            }

            if (isset($new_data['TUIT_NRES_FT_D'])) {
                $tuitionNonResident = $new_data['TUIT_NRES_FT_D'];
                $new_data['public_coa_out_state'] = $tuitionNonResident + $fees + $books + $transport;
            }

            $collegeInfo = CollegeInformation::where('petersons_id', $data[$peterson_id_index])
                ->first();
            if ($collegeInfo) {
                $collegeInfo->update($new_data);
            }
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }
    public function import_ux_inst(Request $request)
    {

        $column_names = array(
            'MAIN_CALENDAR',
        );
        $peterson_id_index = null;
        $file = $request->file('ux_inst');
        $fileContents = file($file->getPathname());

        $index = -1;
        foreach ($fileContents as $line) {
            $index++;
            $data = str_getcsv($line);
            // Storing the indeces of Required Columns
            if ($index == 0) {
                $peterson_id_index = $this->getColumnIndicesFromCSV(array('INUN_ID'), $data)['INUN_ID'];
                $column_names = $this->getColumnIndicesFromCSV($column_names, $data);
                continue;
            }
            $new_data = $this->get_column_values($column_names, $data);
            $collegeInfo = CollegeInformation::where('petersons_id', $data[$peterson_id_index])
                ->first();
            if ($collegeInfo) {
                $collegeInfo->update($new_data);
            }
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }

    public function import_ug_enroll(Request $request)
    {

        $column_names = array(
            'FRSH_GPA',
            'FRSH_GPA_WEIGHTED'
        );
        $peterson_id_index = null;
        $file = $request->file('ug_enroll');
        $fileContents = file($file->getPathname());

        $index = -1;
        foreach ($fileContents as $line) {
            $index++;
            $data = str_getcsv($line);
            // Storing the indeces of Required Columns
            if ($index == 0) {
                $peterson_id_index = $this->getColumnIndicesFromCSV(array('INUN_ID'), $data)['INUN_ID'];
                $column_names = $this->getColumnIndicesFromCSV($column_names, $data);
                continue;
            }
            $new_data = $this->get_column_values($column_names, $data);
            $collegeInfo = CollegeInformation::where('petersons_id', $data[$peterson_id_index])
                ->first();
            if ($collegeInfo) {
                $collegeInfo->update($new_data);
            }
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }
    public function import_ug_campus(Request $request)
    {

        $column_names = array(
            'LIFE_SOR_NAT',
            'LIFE_SOR_LOCAL',
            'LIFE_FRAT_NAT',
            'LIFE_FRAT_LOCAL',
            'SORO_1ST_P',
            'FRAT_1ST_P',
            'CMPS_METRO_T',
            'HOUS_FRSH_POLICY',
            'HOUS_SPACES_OCCUP',

        );
        $peterson_id_index = null;
        $file = $request->file('ug_campus');
        $fileContents = file($file->getPathname());

        $index = -1;
        foreach ($fileContents as $line) {
            $index++;
            $data = str_getcsv($line);
            // Storing the indeces of Required Columns
            if ($index == 0) {
                $peterson_id_index = $this->getColumnIndicesFromCSV(array('INUN_ID'), $data)['INUN_ID'];
                $column_names = $this->getColumnIndicesFromCSV($column_names, $data);
                continue;
            }
            $new_data = $this->get_column_values($column_names, $data);
            $collegeInfo = CollegeInformation::where('petersons_id', $data[$peterson_id_index])
                ->first();
            if ($collegeInfo) {
                $collegeInfo->update($new_data);
            }
        }

        return redirect()->back()->with('success', 'UG Campus Data have been imported Successfully');
    }

    public function import_ug_admis(Request $request)
    {
        $column_names = array(
            'AP_RECD_1ST_N' => -1,
            'AD_DIFF_ALL' => -1,
            'AP_DL_EACT_MON' => -1,
            'AP_DL_EACT_DAY' => -1,
            'AP_DL_FRSH_MON' => -1,
            'AP_DL_FRSH_DAY' => -1,
            'AP_DL_EDEC_1_MON' => -1,
            'AP_DL_EDEC_1_DAY' => -1,
            'AP_DL_EDEC_2_DAY' => -1,
            'AP_DL_EDEC_2_MON' => -1,
        );

        $file = $request->file('ug_admis');
        $fileContents = file($file->getPathname());
        $index = -1;
        foreach ($fileContents as $line) {
            $index++;
            $data = str_getcsv($line);

            // Storing the indeces of Required Columns
            if ($index == 0) {
                $j = 0;
                foreach ($data as $column_name) {
                    if (array_key_exists($column_name, $column_names)) {
                        $column_names[$column_name] = $j;
                    }
                    // if(in_array($column_name, $column_names )){
                    //     array_push($indeces_of_columns, $j);
                    // }
                    $j++;
                }
                continue;
            }


            $new_data = array();

            $i = 0;
            foreach ($column_names as $column_name => $column_name_index) {
                if (!empty($data[$column_name_index])) {
                    $new_data[$column_name] = $data[$column_name_index];
                }
                $i++;
            }
            $collegeInfo = CollegeInformation::where('petersons_id', $data[2])
                ->first();

            if ($collegeInfo) {
                $collegeInfo->update($new_data);
            }
        }
        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }



    public function editView($id)
    {
        $college_detail = CollegeInformation::find($id);
        if (!$college_detail) {
            return redirect()->route('admin.admission-management.college-information.index');
        }
        $api = env('COLLEGE_RECORD_API') . '?' . 'api_key=' . env('COLLEGE_RECORD_API_KEY') . '&id=' . $college_detail->college_id;
        error_log($api);
        $data = Http::get($api);
        $data = json_decode($data->body());
        $apiData = null;
        if (count($data->results) > 0) {
            // error_log('DATA VALUE');
            // error_log(json_encode($data));
            $apiData = $data->results[0];
            $college_info = CollegeInformation::where('college_id', $apiData->id)->first();
            if ($college_info) {
                $apiData->latest->college_info = $college_info;
            }
        }

        if (!$apiData) {
            return response()->json([
                'success' => false,
                'message' => 'No data found',
            ]);
        }

        $programs = [];
        if (isset($apiData->latest->programs->cip_4_digit)) {
            $programs = $apiData->latest->programs->cip_4_digit;
        }

        if (isset($apiData->latest->cost)) {
            $cost = $apiData->latest->cost;
            $tuition = $cost->tuition;
            $roomboard = $cost->roomboard;

            if ($college_detail->tution_and_fess == null) {
                $college_detail->tution_and_fess = $tuition->program_year ?: null;
            }

            if ($college_detail->tuition_and_fee_instate == null) {
                $college_detail->tuition_and_fee_instate = $tuition->in_state ?: null;
            }

            if ($college_detail->tuition_and_fee_outstate == null) {
                $college_detail->tuition_and_fee_outstate = $tuition->out_of_state ?: null;
            }

            if ($college_detail->room_and_board == null) {
                $college_detail->room_and_board = $roomboard->oncampus ?: null;
            }
        }

        $fieldsOfStudy = array_reduce($programs, function ($carry, $item) {
            // Check if the ID already exists in the associative array
            if (!isset($carry[$item->code])) {
                // If the ID is not found, add the object to the result and mark the ID as seen
                $carry[$item->code] = $item;
            }
            return $carry;
        }, []);
        $programs_api_data = [];
        foreach ($fieldsOfStudy as $fieldOfStudy) {
            $fosTemp = [
                'code' => $fieldOfStudy->code,
                'description' => $fieldOfStudy->description ?? "",
                'debt_after_graduation' => $fieldOfStudy->debt->parent_plus->all->all_inst->median ?? 0,
                'median_earning' => $fieldOfStudy->earnings->highest->{'1_yr'}->overall_median_earnings ?? 0,
                'title' => $fieldOfStudy->title ?? "No Title"
            ];
            array_push($programs_api_data, $fosTemp);
        }

        $fieldsOfStudyLocal = FieldsOfStudy::where('college_information_id', $college_info->id)->get();

        if ($fieldsOfStudyLocal->count() < 1) {
            foreach ($fieldsOfStudy as $fieldOfStudy) {
                FieldsOfStudy::firstOrCreate([
                    'college_information_id' => $college_info->id,
                    'code' => $fieldOfStudy->code,
                ], [
                    'description' => $fieldOfStudy->description ?? "",
                    'debt_after_graduation' => $fieldOfStudy->debt->parent_plus->all->all_inst->median ?? 0,
                    'median_earning' => $fieldOfStudy->earnings->highest->{'1_yr'}->overall_median_earnings ?? 0,
                    'title' => $fieldOfStudy->title ?? "No Title"
                ]);
            }

            $fieldsOfStudyLocal = FieldsOfStudy::where('college_information_id', $college_info->id)->get();
        }

        if ($college_detail) {
            $admin_editable_date_inputs =
                array(
                    'regular_admission_deadline' => "Regular Admission Deadline",
                    'early_decision_1_deadline' => "Early Decision 1 Deadline",
                    'early_decision_2_deadline' => "Early Decision 2 Deadline"
                );

            $toggle_between_peterson_and_csv = array();
            return view('admin.college-information.edit', [
                'info' => $college_detail,
                'date_inputs' => $admin_editable_date_inputs,
                'programs_local_data' => $fieldsOfStudyLocal,
                'programs_api_data' => $programs_api_data,
                'apiData' => $apiData,
            ]);
        }
        return redirect()->route('admin.admission-management.college-information.index');
    }

    public function convert_on_off_to_boolean()
    {
    }

    public function update(Request $request)
    {
        $rules = [
            'entrance_difficulty' => 'nullable',
            'gpa_average' => 'nullable',
            'act_composite_average' => 'nullable',
            'sat_math_average' => 'nullable',
            'sat_reading_writing_average' => 'nullable',
            'sat_composite_score' => 'nullable',
            'cost_of_attendance' => 'numeric',
            'tution_and_fess' => 'nullable|numeric',
            'room_and_board' => 'nullable|numeric',
            'average_percent_of_need_met' => 'nullable',
            'average_freshman_award' => 'nullable|numeric',
            // 'early_action_offerd' => 'boolean',
            // 'early_decision_offerd' => 'boolean',
            // 'regular_admission_deadline' => 'nullable|date_format:m-d-Y',

            'rolling_admission_month' => [
                'nullable',
                'date_format:m' // 01-12
            ],
            'rolling_admission_day' => [
                'nullable',
                'date_format:d' // 01-31
            ],
            'regular_decision_month' => [
                'nullable',
                'date_format:m' // 01-12
            ],
            'regular_decision_day' => [
                'nullable',
                'date_format:d' // 01-31
            ],
            'early_decision_ii_month' => [
                'nullable',
                'date_format:m' // 01-12
            ],
            'early_decision_ii_day' => [
                'nullable',
                'date_format:d' // 01-31
            ],
            'early_decision_i_month' => [
                'nullable',
                'date_format:m' // 01-12
            ],
            'early_decision_i_day' => [
                'nullable',
                'date_format:d' // 01-31
            ],
            'early_action_month' => [
                'nullable',
                'date_format:m' // 01-12
            ],
            'early_action_day' => [
                'nullable',
                'date_format:d' // 01-31
            ],
        ];

        // dd($request->all());



        $boolean_params = array(
            'display_peterson_weighted_gpa',
            'display_peterson_unweighted_gpa',
            'display_peterson_pvt_coa',
            'display_peterson_public_coa',
            'common_app',
            'coalition_app',
            'universal_app',
            'college_system_app',
            'apply_directly',
        );

        foreach ($boolean_params as $bp) {
            if ($request[$bp] != 'on') {
                $request->merge([$bp => 0]);
            } else {
                $request->merge([$bp => 1]);
            }
        }





        $customMessages = [
            'entrance_difficulty.required' => 'The entrance difficulty field is required.',
            'gpa_average.required' => 'The average gpa field is required.',
            'act_composite_average.required' => 'The average act composite score field is required.',
            'sat_math_average.required' => 'The average sat math score field is required.',
            'sat_reading_writing_average.required' => 'The average sat reading/writing score field is required.',
            'sat_composite_score.required' => 'The average sat composite score field is required.',
            'cost_of_attendance.required' => 'The cost of attendance field is required.',
            'cost_of_attendance.numeric' => 'The cost of attendance field must be a number.',
            'tution_and_fess.required' => 'The tuition and fees field is required.',
            'tution_and_fess.numeric' => 'The tuition and fees field must be a number.',
            'room_and_board.required' => 'The room and board field is required.',
            'room_and_board.numeric' => 'The room and board field must be a number.',
            'average_percent_of_need_met.required' => 'The average percent of need met field is required.',
            'average_freshman_award.required' => 'The average freshman award field is required.',
            'average_freshman_award.numeric' => 'The average freshman award field must be a number.',
            // 'early_action_offerd.required' => 'The early action offered field is required.',
            // 'early_action_offerd.boolean' => 'The early action offered field must be true or false.',
            // 'early_decision_offerd.required' => 'The early decision offered field is required.',
            // 'early_decision_offerd.boolean' => 'The early decision offered field must be true or false.',
            // 'regular_admission_deadline.required' => 'The regular admission deadline field is required.',
            // 'regular_admission_deadline.date' => 'The regular admission deadline field must be a date.',

            'rolling_admission_month.date_format' => 'The rolling admission month field must be a valid month.',
            'rolling_admission_day.date_format' => 'The rolling admission day field must be a valid day.',
            'regular_decision_month.date_format' => 'The regular decision month field must be a valid month.',
            'regular_decision_day.date_format' => 'The regular decision day field must be a valid day.',
            'early_decision_ii_month.date_format' => 'The early decision II month field must be a valid month.',
            'early_decision_ii_day.date_format' => 'The early decision II day field must be a valid day.',
            'early_decision_i_month.date_format' => 'The early decision I month field must be a valid month.',
            'early_decision_i_day.date_format' => 'The early decision I day field must be a valid day.',
            'early_action_month.date_format' => 'The early action month field must be a valid month.',
            'early_action_day.date_format' => 'The early action day field must be a valid day.',
        ];
        // ddd($request->all());
        foreach ($request->field_of_study as $program) {
            $fos = FieldsOfStudy::find($program['id']);
            $fos->description = $program['description'] ?? "";
            $fos->debt_after_graduation = $program['median_debt_after_graduation'] ??  0;
            $fos->median_earning = $program['salary_after_completing'] ?? 0;
            $fos->save();
        }

        $request->validate($rules, $customMessages);
        $data = collect($request->all())->except(['_token', 'id', 'field_of_study'])->toArray();
        if (isset($data['college_icon'])) {
            $image = time() . '.' . $data['college_icon']->extension();
            $request->college_icon->move(public_path('college_icon'), $image);
            $data['college_icon'] = $image;
        } else {
            unset($data['college_icon']);
        }
        $college_detail = CollegeInformation::where('id', $request->id)->update($data);
        return redirect()->route('admin.admission-management.college-information.index')->with('success', 'College information updated successfully.');
    }
}
