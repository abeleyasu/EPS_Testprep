<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CollegeInformation;
use App\Models\CollegeDetails;

class CollegeApplicationDeadlineController extends Controller
{
    public function index()
    {
        $colleges = CollegeInformation::all();
        $collegeDetails = [];
        foreach ($colleges as $college) {
            $row = CollegeDetails::where('college_id', '=', $college->id)->first();
            $collegeDetails[$college->id] = $row;
        }
        //print_r($collegeDetails);

        //print_r($colleges);

        return view('user.admin-dashboard.college-application-deadline', ['colleges' => $colleges, 'collegeDetails' => $collegeDetails]);
    }

    public function college_save(Request $request)
    {
        $id =  Auth::id();
        // Validate the input data
        $request->validate([
            'name' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255'
        ]);

        // Create a new college object and save it to the database
        $college = new CollegeInformation;
        $college->user_id = $id;
        $college->name = $request->name;
        $college->city = $request->city;
        $college->state = $request->state;
        $college->save();

        return redirect()->back()->with('success', 'College added successfully');
    }

    public function college_application_save(Request $request)
    {
        $id =  Auth::id();
        // Validate the input data
        $request->validate([
            'type_of_application' => 'required',
            'admission_option' => 'required',
            'number_of_essaya' => 'required',
            'admissions_deadline' => 'required',
            'ad_status' => 'required',
            'competitive_scholarship_deadline' => 'required',
            'csd_status' => 'required',
            'departmental_scholarship_deadline' => 'required',
            'dsd_status' => 'required',
            'honors_college_deadline' => 'required',
            'hcd_status' => 'required',
            'fafsa_deadline' => 'required',
            'fafsa_status' => 'required',
            'css_profile_deadline' => 'required',
            'css_status' => 'required'
        ]);
        $message = 'Details Added Successfully';
        // print_r($_REQUEST);
        // die();
        $college = new CollegeDetails;
        if ($request->rec_id > 0) {
            $college = CollegeDetails::findOrFail($request->rec_id);
        }
        $college->college_id = $request->college_id;
        $college->type_of_application = $request->type_of_application;
        $college->admission_option = $request->admission_option;
        $college->number_of_essaya = $request->number_of_essaya;
        $college->admissions_deadline = $request->admissions_deadline;
        $college->ad_status = $request->ad_status;
        $college->competitive_scholarship_deadline = $request->competitive_scholarship_deadline;
        $college->csd_status = $request->csd_status;
        $college->departmental_scholarship_deadline = $request->departmental_scholarship_deadline;
        $college->dsd_status = $request->dsd_status;
        $college->honors_college_deadline = $request->honors_college_deadline;
        $college->hcd_status = $request->hcd_status;
        $college->fafsa_deadline = $request->fafsa_deadline;
        $college->fafsa_status = $request->fafsa_status;
        $college->css_profile_deadline = $request->css_profile_deadline;
        $college->css_status = $request->css_status;
        $college->application_checklist = implode(",", $request->application_checklist);
        if ($request->rec_id > 0) {
            $college->id = $request->rec_id;
            $college->update();
            $message = 'Details Updated Successfully';
        } else
            $college->save();
        return redirect()->back()->with('success', $message);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
