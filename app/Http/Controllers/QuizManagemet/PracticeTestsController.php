<?php

namespace App\Http\Controllers\QuizManagemet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CRUD;
use App\Models\PracticeTest;
use App\Models\PracticeQuestion;
use App\Models\PracticeTestSection;
use App\Models\Passage;
use Illuminate\Support\Facades\View;

class PracticeTestsController extends Controller
{
    use CRUD;
	public $testformat = ['SAT'=>'SAT PRACTICE TEST','ACT'=>'ACT PRACTICE TEST', 'PSAT' => 'PSAT PRACTICE TEST'];
	public $questionformat = ['ACT'=> 'ACT Question', 'SAT'=>'SAT Question', 'PSAT'=>'PSAT Question'];
	public function __construct(){
		View::share('testformats', $this->testformat);
		View::share('questionformats', $this->questionformat);
        View::share('passages', Passage::get());
    }
	
	public function index()
    {
        $tests = PracticeTest::get();
        return view('admin.quiz-management.practicetests.index', compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
		$tests = PracticeTest::get();
        return view('admin.quiz-management.practicetests.create', compact('tests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
		$practice = new PracticeTest();
		$practice->title = $request->title;
		$practice->format = $request->format;
		$practice->description = $request->description;
        
		$practice->save();
		
		$sections = PracticeTestSection::where('testid', 0)->get();
		foreach($sections as $section) {
			$section->testid = $practice->id;
			$section->save();
		}
		
        return redirect()->route('practicetests.index')->with('message','Test created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
		$practicetests = PracticeTest::find($id);
		$tests = PracticeTest::get();
		//$testQuestions = PracticeQuestion::where('section_id', $id)->get();
		$testQuestions = PracticeTestSection::find($id)->getPracticeQuestions();
		$testsections = PracticeTestSection::orderBy('section_order')->where('testid', $id)->get();
        return view('admin.quiz-management.practicetests.edit', compact('practicetests', 'tests', 'testQuestions', 'testsections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PracticeTest $practicetests)
    {
        $tags = '';
        if(is_array($request->tags)){
            $tags = implode(",", $request->tags);
        }
		$practice = PracticeTest::find($request->id);
		$practice->title = $request->title;
		/*$practice->format = $request->format;*/
		$practice->description = $request->description;
        $practice->tags = $tags;
		$practice->save();
        return redirect()->route('practicetests.index')->with('message','Question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PracticeTest $practicetests, $id)
    {
		// dd($id);
		$practicetests = PracticeTest::find($id);
        $practicetests->delete();
        return redirect()->route('practicetests.index')->with('message','Question deleted successfully');
    }
}