<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Service\ResumeService;

class GradesController extends Controller
{
    protected $resumeService;

    public function __construct(ResumeService $resumeService) {
        $this->resumeService = $resumeService;
    }


    public function getGradeList(Request $request)
    {
        $type = isset($request->type) ? config('constants.grades_types.'.$request->type.'_grades') : null;
        $grades_list = $this->resumeService->getGrades($type);

        return response()->json(['success' => true, 'dropdown_list' => $grades_list]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
