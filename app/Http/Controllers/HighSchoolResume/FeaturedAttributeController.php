<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\FeaturedAttributeRequest;
use Illuminate\Http\Request;

class FeaturedAttributeController extends Controller
{
    public function index()
    {
        return view('user.admin-dashboard.high-school-resume.features-attributes');
    }

    public function create()
    {
        //
    }

    public function store(FeaturedAttributeRequest $request)
    {
        $data = $request->validated();

        if (!empty($data)) {
            return redirect()->route('admin-dashboard.highSchoolResume.preview');
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
