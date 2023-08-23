<?php

namespace App\Http\Controllers;

use App\Models\CollegeInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollegeInformationController extends Controller
{
    public function getCollegeList()
    {
        $user = Auth::user();

        if($user->role == 1) {   
            $college_list = CollegeInformation::all();
        } else {
            $colleges_list = CollegeInformation::whereNull('user_id')->orWhere('user_id' , Auth::id())->get();
        }
        return response()->json(['success' => true, 'dropdown_list' => $colleges_list]);
    }

    public function index(Request $request) {
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
                    'action' =>  '<a href="'. route('admin.admission-management.college-information.edit', ['id' => $college_detail['id']]) .'" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>',
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

    public function editView($id) {
        $college_detail = CollegeInformation::find($id);
        if ($college_detail) {
            // dd($college_detail);
            return view('admin.college-information.edit', [
                'info' => $college_detail,
            ]);
        } 
        return redirect()->route('admin.admission-management.college-information.index');
    }

    public function update(Request $request) {
        $rules = [
            'entrance_difficulty' => 'required',
            'gpa_average' => 'required',
            'act_composite_average' => 'required',
            'sat_math_average' => 'required',
            'sat_reading_writing_average' => 'required',
            'sat_composite_score' => 'required',
            'cost_of_attendance' => 'required|numeric',
            'tution_and_fess' => 'required|numeric',
            'room_and_board' => 'required|numeric',
            'average_percent_of_need_met' => 'required',
            'average_freshman_award' => 'required|numeric',
            'early_action_offerd' => 'required|boolean',
            'early_decision_offerd' => 'required|boolean',
            'regular_admission_deadline' => 'required|date_format:m-d-Y',
        ];

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

        $request->validate($rules, $customMessages);
        $data = collect($request->all())->except(['_token', 'id'])->toArray();
        if (isset($data['college_icon'])) {
            $image = time().'.'.$data['college_icon']->extension();
            $request->college_icon->move(public_path('college_icon'), $image);
            $data['college_icon'] = $image;
        } else {
            unset($data['college_icon']);
        }
        $college_detail = CollegeInformation::where('id', $request->id)->update($data);
        return redirect()->route('admin.admission-management.college-information.index')->with('success', 'College information updated successfully.');
    }
}
