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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(CollegeInformation $collegeInformation)
    {
        //
    }

    public function edit(CollegeInformation $collegeInformation)
    {
        //
    }

    public function update(Request $request, CollegeInformation $collegeInformation)
    {
        //
    }

    public function destroy(CollegeInformation $collegeInformation)
    {
        //
    }
}
