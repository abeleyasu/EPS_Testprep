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
                $peterson_id_index = $this->getColumnIndicesFromCSV(array('INUN_ID'), $data)['INUN_ID'];
                $column_names = $this->getColumnIndicesFromCSV($column_names, $data);
                continue;
            }
            $new_data = $this->get_column_values($column_names, $data);

            // if(isset($new_data['FEES_FT_D']) && isset($new_data['BOOKS_RES_D']) && isset($new_data['TRANSPORT_RES_D'])){
            //     if(isset($new_data['TUIT_OVERALL_FT_D'])){
            //         $new_data['pvt_coa'] = $new_data['TUIT_OVERALL_FT_D'] + $new_data['FEES_FT_D'] + $new_data['BOOKS_RES_D'] + $new_data['TRANSPORT_RES_D'];
            //     }
            //     if(isset($new_data['TUIT_STATE_FT_D'])){
            //         $new_data['public_coa_in_state'] = $new_data['TUIT_STATE_FT_D'] + $new_data['FEES_FT_D'] + $new_data['BOOKS_RES_D'] + $new_data['TRANSPORT_RES_D'];
            //     }
            //     if(isset($new_data['TUIT_NRES_FT_D'])){
            //         $new_data['public_coa_out_state'] = $new_data['TUIT_NRES_FT_D'] + $new_data['FEES_FT_D'] + $new_data['BOOKS_RES_D'] + $new_data['TRANSPORT_RES_D'];
            //     }
            // }

            // dd($new_data);

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

    private function getColumnIndicesFromCSV($column_names, $csv_column_names)
    {
        $column_names_ass_arr = array();

        foreach ($column_names as $column_name) {
            $result = array_search($column_name, $csv_column_names);
            $column_names_ass_arr[$column_name] = $result;
        }

        return ($column_names_ass_arr);
    }

    public function get_column_values($column_names, $data)
    {
        $i = 0;

        foreach ($column_names as $column_name => $column_name_index) {
            if (empty($data[$column_name_index])) {
                $new_data[$column_name] = null;
            }
            if ($data[$column_name_index] == 0 || !empty($data[$column_name_index])) {
                $new_data[$column_name] = $data[$column_name_index];
            }
            $i++;
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

            // if (isset($new_data['FEES_FT_D']) && isset($new_data['BOOKS_RES_D']) && isset($new_data['TRANSPORT_RES_D'])) {
            //     if (isset($new_data['TUIT_OVERALL_FT_D'])) {
            //         $new_data['pvt_coa'] = $new_data['TUIT_OVERALL_FT_D'] + $new_data['FEES_FT_D'] + $new_data['BOOKS_RES_D'] + $new_data['TRANSPORT_RES_D'];
            //     }
            //     if (isset($new_data['TUIT_STATE_FT_D'])) {
            //         $new_data['public_coa_in_state'] = $new_data['TUIT_STATE_FT_D'] + $new_data['FEES_FT_D'] + $new_data['BOOKS_RES_D'] + $new_data['TRANSPORT_RES_D'];
            //     }
            //     if (isset($new_data['TUIT_NRES_FT_D'])) {
            //         $new_data['public_coa_out_state'] = $new_data['TUIT_NRES_FT_D'] + $new_data['FEES_FT_D'] + $new_data['BOOKS_RES_D'] + $new_data['TRANSPORT_RES_D'];
            //     }
            // }

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
        $api = env('COLLEGE_RECORD_API') . '?' . 'api_key=' . env('COLLEGE_RECORD_API_KEY') . '&id=' . $college_detail->college_id;
        error_log($api);
        $data = Http::get($api);
        $data = json_decode($data->body());
        if (count($data->results) > 0) {
            error_log('DATA VALUE');
            error_log(json_encode($data));
            $data = $data->results[0];
            $college_info = CollegeInformation::where('college_id', $data->id)->first();
            if ($college_info) {
                $data->latest->college_info = $college_info;
            }
        } else {
            $data = null;
        }
        if (isset($data->latest->programs->cip_4_digit)) {
        }
        $programs = $data->latest->programs->cip_4_digit;

        $fieldsOfStudy = array_reduce($programs, function ($carry, $item) {
            // Check if the ID already exists in the associative array
            if (!isset($carry[$item->code])) {
                // If the ID is not found, add the object to the result and mark the ID as seen
                $carry[$item->code] = $item;
            }
            return $carry;
        }, []);
        $api_data = [];
        foreach ($fieldsOfStudy as $fieldOfStudy) {
            $data = [
                'code' => $fieldOfStudy->code,
                'description' => $fieldOfStudy->description ?? "",
                'debt_after_graduation' => $fieldOfStudy->debt->parent_plus->all->all_inst->median ?? 0,
                'median_earning' => $fieldOfStudy->earnings->highest->{'1_yr'}->overall_median_earnings ?? 0,
                'title' => $fieldOfStudy->title ?? "No Title"
            ];
            array_push($api_data, $data);
        }
        if ($college_detail->fieldsOfStudy()->count() < 1) {
            foreach ($fieldsOfStudy as $fieldOfStudy) {
                // ddd($fieldOfStudy);
                FieldsOfStudy::create([
                    'code' => $fieldOfStudy->code,
                    'description' => $fieldOfStudy->description ?? "",
                    'debt_after_graduation' => $fieldOfStudy->debt->parent_plus->all->all_inst->median ?? 0,
                    'median_earning' => $fieldOfStudy->earnings->highest->{'1_yr'}->overall_median_earnings ?? 0,
                    'college_information_id' => $college_detail->id,
                    'title' => $fieldOfStudy->title ?? "No Title"
                ]);
            }
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
                'data' => $college_detail->fieldsOfStudy,
                'api_data' => $api_data
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
            'early_action_offerd' => 'boolean',
            'early_decision_offerd' => 'boolean',
            // 'regular_admission_deadline' => 'nullable|date_format:m-d-Y',
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
            'early_action_offerd.required' => 'The early action offered field is required.',
            'early_action_offerd.boolean' => 'The early action offered field must be true or false.',
            'early_decision_offerd.required' => 'The early decision offered field is required.',
            'early_decision_offerd.boolean' => 'The early decision offered field must be true or false.',
            'regular_admission_deadline.required' => 'The regular admission deadline field is required.',
            'regular_admission_deadline.date' => 'The regular admission deadline field must be a date.',
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
