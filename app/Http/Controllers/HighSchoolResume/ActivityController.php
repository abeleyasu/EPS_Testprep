<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\ActivityRequest;
use App\Models\HighSchoolResume\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        return view('user.admin-dashboard.high-school-resume.activities');
    }

    public function store(ActivityRequest $request)
    {
        $data = $request->validated();

        if(!empty($request->demonstrated_data)){
            $data['demonstrated_data'] = $request->demonstrated_data;
        }

        if(!empty($request->leadership_data)){
            $data['leadership_data'] = $request->leadership_data;
        }

        if(!empty($request->activities_data)){
            $data['activities_data'] = $request->activities_data;
        }

        if(!empty($request->athletics_data)){
            $data['athletics_data'] = $request->athletics_data;
        }
        
        if(!empty($request->community_service_data)){
            $data['community_service_data'] = $request->community_service_data;
        }

        if (!empty($data)) {
            Activity::create($data);
            return redirect()->route('admin-dashboard.highSchoolResume.employmentCertification');
        }
    }

    public function update(ActivityRequest $request, Activity $activity)
    {
        $data = $request->validated();

        if(!empty($request->demonstrated_data)){
            $data['demonstrated_data'] = $request->demonstrated_data;
        }

        if(!empty($request->leadership_data)){
            $data['leadership_data'] = $request->leadership_data;
        }

        if(!empty($request->activities_data)){
            $data['activities_data'] = $request->activities_data;
        }

        if(!empty($request->athletics_data)){
            $data['athletics_data'] = $request->athletics_data;
        }
        
        if(!empty($request->community_service_data)){
            $data['community_service_data'] = $request->community_service_data;
        }

        if (!empty($data)) {
            $activity->update($data);
            return redirect()->route('admin-dashboard.highSchoolResume.employmentCertification');
        }
    }
}
