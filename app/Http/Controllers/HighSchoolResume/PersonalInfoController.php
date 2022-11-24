<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\PersonalInfoRequest;
use Illuminate\Http\Request;

class PersonalInfoController extends Controller
{
    public function index()
    {
        return view('user.admin-dashboard.high-school-resume.personal-info');
    }

    public function create()
    {
        //
    }

    public function store(PersonalInfoRequest $request)
    {
        $data = $request->validated();

        if (!empty($data)) {
            return redirect()->route('admin-dashboard.highSchoolResume.honors');
        }
    }

    public function show($id)
    {
        //
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
