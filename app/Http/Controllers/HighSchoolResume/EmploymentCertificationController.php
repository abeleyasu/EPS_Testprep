<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\EmploymentCertificationRequest;
use App\Models\HighSchoolResume\EmploymentCertification;
use App\Models\HighSchoolResume\FeaturedAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmploymentCertificationController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $employmentCertification = EmploymentCertification::whereUserId($user_id)->where('is_draft', 0)->first();
        $featuredAttribute = FeaturedAttribute::whereUserId($user_id)->where('is_draft', 0)->first();
        
        $details = 0;
        return view('user.admin-dashboard.high-school-resume.employment-certification', compact('employmentCertification','featuredAttribute','details'));
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

        if($data['employment_data'] == "[]"){
            $data['employment_data'] = null;
        } 
        if($data['significant_data'] == "[]"){
            $data['significant_data'] = null;
        } 
        

        if (!empty($data)) {
            $employmentCertification->update($data);
            return redirect()->route('admin-dashboard.highSchoolResume.featuresAttributes');
        }
    }
}
