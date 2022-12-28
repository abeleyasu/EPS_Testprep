<?php

namespace App\Http\Controllers;

use App\Models\CollegeInformation;
use Illuminate\Http\Request;

class CollegeInformationController extends Controller
{
    public function getCollegeList()
    {
        $colleges_list = CollegeInformation::all();

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
