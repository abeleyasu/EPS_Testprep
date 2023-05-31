<?php

namespace App\Http\Controllers\QuizManagemet;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CRUD;
use App\Models\Passage;
use App\Models\PracticeQuestion;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class QuestionsController extends Controller
{
    use CRUD;
    public $format = ['MC'=>'Multiple Choice','TR'=>'Short Text Response'];

    public function __construct()
    {
        View::share('formats', $this->format);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $questions = PracticeQuestion::get();
        return view('admin.quiz-management.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $passages = Passage::get();
        return view('admin.quiz-management.questions.create', compact('passages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->createFromRequest(app('App\Models\PracticeQuestion'), $request);
        return redirect()->route('questions.index')->with('message','Question created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPassagesByFormat($format)
    {
        $passages = Passage::where('type', $format)->get();

        if(!empty($passages)) {
            return response()->json(['success' => true, 'passages' => $passages]);
        } else {
            return response()->json(['error' => true, 'message' => "Passages not found"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(PracticeQuestion $question)
    {
        $passages = Passage::get();
        return view('admin.quiz-management.questions.edit', compact('question', 'passages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PracticeQuestion $question)
    {
        $this->updateFromRequest($question, $request);
        return redirect()->route('questions.index')->with('message','Question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PracticeQuestion $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with('message','Question deleted successfully');
    }
}
