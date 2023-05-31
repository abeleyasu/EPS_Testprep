<?php

namespace App\Http\Controllers;

use App\Models\DiffRating;
use Illuminate\Http\Request;

class DiffRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ratings = DiffRating::all();
        return view('admin.quiz-management.difficultyrating.index',compact('ratings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quiz-management.difficultyrating.create');
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
            'diff_rating_title' => 'required|unique:diff_ratings,title'
        ],[
            'diff_rating_title.required' => 'This title field is required',
            'diff_rating_title.unique' => 'This title must be unique'
        ]);

        DiffRating::create([
            'title' => $request['diff_rating_title']
        ]);

        return redirect()->route('diffratings.index');

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
        $rating = DiffRating::find($id);
        return view('admin.quiz-management.difficultyrating.edit',compact('rating'));
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
            'diff_rating_title' => 'required|unique:diff_ratings,title'
        ],[
            'diff_rating_title.required' => 'The title field is required',
            'diff_rating_title.unique' => 'The title must be unique',
        ]);

        DiffRating::find($id)->update([
            'title' => $request['diff_rating_title']
        ]);

        return redirect()->route('diffratings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rating = DiffRating::find($id);
        $rating->delete();

        return redirect()->route('diffratings.index');
    }
}
