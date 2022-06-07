<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentCategoryRequest;
use App\Models\ContentCategory;
use Illuminate\Http\Request;

class ContentCategoryController extends Controller
{
    use CRUD;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = ContentCategory::get();
        return view('admin.content-category.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContentCategoryRequest $request)
    {
        $this->createFromRequest(app('App\Models\ContentCategory'), $request);
        return redirect()->route('content-categories.index')
            ->with('message','Content Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContentCategory  $contentCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ContentCategory $contentCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContentCategory  $contentCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ContentCategory $contentCategory)
    {
        return view('admin.content-category.edit', compact('contentCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContentCategory  $contentCategory
     * @return \Illuminate\Http\Response
     */
    public function update(ContentCategoryRequest $request, ContentCategory $contentCategory)
    {
        $this->updateFromRequest($contentCategory, $request);
        return redirect()->route('content-categories.index')
            ->with('message','Content Category updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContentCategory  $contentCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContentCategory $contentCategory)
    {
        $contentCategory->delete();
        return redirect()->route('content-categories.index')
            ->with('message','Content Category deleted successfully');
    }
}
