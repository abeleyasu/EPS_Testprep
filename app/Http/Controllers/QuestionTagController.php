<?php

namespace App\Http\Controllers;

use App\Models\QuestionTag;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class QuestionTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = QuestionTag::all();
        return view('admin.quiz-management.questiontags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quiz-management.questiontags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question_tag_title' => 'required|unique:question_tags,title',
            'test_format' => 'required'
        ],[
            'question_tag_title.required' => 'This title field is required',
            'question_tag_title.unique' => 'The title must be unique',
            'test_format.required' => 'The test format is required'
        ]);

        QuestionTag::create([
            'title' => $request['question_tag_title'],
            'format' => $request['test_format']
        ]);

        return redirect()->route('questiontags.index');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = QuestionTag::find($id);
        return view('admin.quiz-management.questiontags.edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'question_tag_title' => 'required',
            Rule::unique('question_tags', 'title')->ignore($request->id),
            'test_format' => 'required'
        ],[
            'question_tag_title.required' => 'This title field is required',
            'question_tag_title.unique' => 'The title must be unique',
            'test_format.required' => 'The test format is required',
        ]);

        QuestionTag::find($id)->update([
            'title' => $request['question_tag_title'],
            'format' => $request['test_format']
        ]);

        return redirect()->route('questiontags.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = QuestionTag::find($id);
        $tag->delete();
        return redirect()->route('questiontags.index');
    }
}
