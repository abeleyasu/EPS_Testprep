<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\EmploymentCertificationRequest;
use Illuminate\Http\Request;

class EmploymentCertificationController extends Controller
{
    public function index()
    {
        return view('user.admin-dashboard.high-school-resume.employment-certification');
    }

    public function create()
    {
        //
    }

    public function store(EmploymentCertificationRequest $request)
    {
        $data = $request->validated();

        if (!empty($data)) {
            return redirect()->route('admin-dashboard.highSchoolResume.featuresAttributes');
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
