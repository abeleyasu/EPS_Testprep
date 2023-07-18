<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CollegeDetails;
use App\Models\CollegeList;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdmissionDashBoard extends Controller
{
    public function index() {
        $user = Auth::user();
        $college_list_deadline = CollegeList::where('user_id', Auth::id())->with(['college_list_details' => function ($detail) {
            $detail->where('is_active', true)->orderBy('order_index')->with(['collegeDeadline', 'collegeInformation']);
        }])->first();
        if ($college_list_deadline) {
            $college_list_deadline = $college_list_deadline->toArray();
            $college_list_deadline = $college_list_deadline['college_list_details'];
            foreach ($college_list_deadline as $key => $deadline) {
                if ($college_list_deadline[$key]['college_deadline']['admissions_deadline']) {
                    $college_list_deadline[$key]['college_deadline']['admissions_deadline'] = Carbon::parse($deadline['college_deadline']['admissions_deadline'])->format('m/d/Y');
                    $create_date = Carbon::parse($deadline['college_deadline']['admissions_deadline']);
                    $college_list_deadline[$key]['college_deadline']['admissions_deadline_diff'] = 'Due in '. $create_date->diffInDays(Carbon::now()) . ' days';
                }
            }
        } else {
            $college_list_deadline = [];
        }
        // dd($college_list_deadline);
        return view('user.admin-dashboard.dashboard', [
            'college_list_deadline' => $college_list_deadline,
            'count' => count($college_list_deadline),
        ]);
    }
}
