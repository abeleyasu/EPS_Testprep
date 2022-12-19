<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\FeaturedAttributeRequest;
use App\Models\HighSchoolResume\FeaturedAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeaturedAttributeController extends Controller
{
    public function index()
    {
        $featuredAttribute = FeaturedAttribute::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        $details =0;
        return view('user.admin-dashboard.high-school-resume.features-attributes', compact('featuredAttribute','details'));
    }

    public function store(FeaturedAttributeRequest $request)
    {
        $data = $request->validated();

        if(!empty($request->featured_skills_data)){
            $data['featured_skills_data'] = $request->featured_skills_data;
        }

        if(!empty($request->featured_awards_data)){
            $data['featured_awards_data'] = $request->featured_awards_data;
        }

        if(!empty($request->featured_languages_data)){
            $data['featured_languages_data'] = $request->featured_languages_data;
        }

        $data['user_id'] = Auth::id();

        $data = array_filter($data);

        if (!empty($data)) {
            FeaturedAttribute::create($data);
            return redirect()->route('admin-dashboard.highSchoolResume.preview');
        }
    }

    public function update(FeaturedAttributeRequest $request, FeaturedAttribute $featuredAttribute)
    {
        $data = $request->validated();

        if(!empty($request->featured_skills_data)){
            $data['featured_skills_data'] = $request->featured_skills_data;
        }

        if(!empty($request->featured_awards_data)){
            $data['featured_awards_data'] = $request->featured_awards_data;
        }

        if(!empty($request->featured_languages_data)){
            $data['featured_languages_data'] = $request->featured_languages_data;
        }

        $data = array_filter($data);

        if($data['featured_skills_data'] == "[]"){
            $data['featured_skills_data'] = null;
        } 
        
        if($data['featured_awards_data'] == "[]"){
            $data['featured_awards_data'] = null;
        } 

        if($data['featured_languages_data'] == "[]"){
            $data['featured_languages_data'] = null;
        } 
        if (!empty($data)) {
            $featuredAttribute->update($data);
            return redirect()->route('admin-dashboard.highSchoolResume.preview');
        }
    }
}
