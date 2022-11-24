<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\HonorsRequest;
use Illuminate\Http\Request;

class HonorsController extends Controller
{
    public function index()
    {
        return view('user.admin-dashboard.high-school-resume.honors');
    }

    public function create()
    {
        //
    }

    public function store(HonorsRequest $request)
    {
        $data = $request->validated();

        if (!empty($data)) {
            return redirect()->route('admin-dashboard.highSchoolResume.activities');
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
