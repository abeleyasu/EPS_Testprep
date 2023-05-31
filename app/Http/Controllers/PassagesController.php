<?php

namespace App\Http\Controllers;

use App\Http\Requests\PassagesRequest;
use App\Models\Passage;
use Illuminate\Http\Request;

class PassagesController extends Controller
{
    use CRUD;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $passages = Passage::get();
        return view('admin.passages.index', compact('passages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.passages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PassagesRequest $request)
    {
        $this->createFromRequest(app('App\Models\Passage'), $request);
        return redirect()->route('passages.index')
            ->with('message','Passages created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContentCategory  $contentCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Passage $passage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContentCategory  $contentCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Passage $passage)
    {
        return view('admin.passages.edit', compact('passage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContentCategory  $contentCategory
     * @return \Illuminate\Http\Response
     */
    public function update(PassagesRequest $request, Passage $passage)
    {
        $this->updateFromRequest($passage, $request);
        return redirect()->route('passages.index')
            ->with('message','Passages updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContentCategory  $contentCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Passage $passage)
    {
        $passage->delete();
        return redirect()->route('passages.index')
            ->with('message','Passages deleted successfully');
    }

    public function preview($id)
    {
        $passage = Passage::findorfail($id);
        
        return view('admin.passages.preview', compact('passage'));
    }
}
