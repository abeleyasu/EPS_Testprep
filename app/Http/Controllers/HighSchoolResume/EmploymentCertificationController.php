<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\EmploymentCertificationRequest;
use App\Models\HighSchoolResume\EmploymentCertification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmploymentCertificationController extends Controller
{
    public function index()
    {
        $employmentCertification = EmploymentCertification::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        return view('user.admin-dashboard.high-school-resume.employment-certification', compact('employmentCertification'));
    }

    public function store(EmploymentCertificationRequest $request)
    {
        $data = $request->validated();

        if(!empty($request->employment_data)){
            $data['employment_data'] = $request->employment_data;
        }

        if(!empty($request->significant_data)){
            $data['significant_data'] = $request->significant_data;
        }

        $data['user_id'] = Auth::id();

        $data = array_filter($data);

        if (!empty($data)) {
            EmploymentCertification::create($data);
            return redirect()->route('admin-dashboard.highSchoolResume.featuresAttributes');
        }
    }

    public function update(EmploymentCertificationRequest $request, EmploymentCertification $employmentCertification)
    {
        $data = $request->validated();

        if(!empty($request->employment_data)){
            $data['employment_data'] = $request->employment_data;
        }

        if(!empty($request->significant_data)){
            $data['significant_data'] = $request->significant_data;
        }

        $data = array_filter($data);

        if (!empty($data)) {
            $employmentCertification->update($data);
            return redirect()->route('admin-dashboard.highSchoolResume.featuresAttributes');
        }
    }
}
