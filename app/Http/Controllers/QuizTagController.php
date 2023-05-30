<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizTagRequest;
use App\Models\QuizTag;
use Illuminate\Http\Request;

class QuizTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quiztags = QuizTag::all();
        return view('admin.quiztags.index', compact('quiztags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizTagRequest $request)
    {
        QuizTag::create(['name' => $request->quiztag]);

        return redirect()->route('quiztags.index')->with('success','Quiz Tag added successfully');
    }
    public function storeJson(QuizTagRequest $request)
    {
        $quiztag = QuizTag::create(['name' => $request->quiztag]);

        return response()->json([
            'quiztag' => $quiztag
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(QuizTag $quiztag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(QuizTag $quiztag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuizTag $quiztag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuizTag $quiztag)
    {
        $quiztag->delete();
        return redirect()->route('quiztags.index')->with('success','Quiz Tag deleted successfully');
    }
}
