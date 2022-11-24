<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\ActivityRequest;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        return view('user.admin-dashboard.high-school-resume.activities');
    }

    public function create()
    {
        //
    }

    public function store(ActivityRequest $request)
    {
        $data = $request->validated();

        if (!empty($data)) {
            return redirect()->route('admin-dashboard.highSchoolResume.employmentCertification');
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
