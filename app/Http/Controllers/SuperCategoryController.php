<?php

namespace App\Http\Controllers;

use App\Models\SuperCategory;
use Illuminate\Http\Request;

class SuperCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $super_categories = SuperCategory::all();
        return view('admin.quiz-management.super-category.index',compact('super_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quiz-management.super-category.create');
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
            'super_category_title' => 'required|unique:super_categories,title',
            'test_format' => 'required',
            'section_type' => 'required'
        ],[
            'super_category_title.required' => 'This title field is required',
            'super_category_title.unique' => 'The title must be unique',
            'test_format.required' => 'The test format is required',
            'section_type.required' => 'The section type is required'
        ]);
        
        SuperCategory::create([
            'title' => $request['super_category_title'],
            'format' => $request['test_format'],
            'section_type' => $request['section_type']
        ]);

        return redirect()->route('supercategories.index');
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
        $category = SuperCategory::find($id);
        return view('admin.quiz-management.super-category.edit',compact('category'));
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
            'super_category_title' => 'required|unique:super_categories,title,'.$id,
            'test_format' => 'required',
            'section_type' => 'required'
        ],[
            'super_category_title.required' => 'This title field is required',
            'super_category_title.unique' => 'The title must be unique',
            'test_format.required' => 'The test format is required',
            'section_type.required' => 'The section type is required'
        ]);
        
        SuperCategory::find($id)->update([
            'title' => $request['super_category_title'],
            'format' => $request['test_format'],
            'section_type' => $request['section_type']
        ]);

        return redirect()->route('supercategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = SuperCategory::find($id);
        $category->delete();

        return redirect()->route('supercategories.index');
    }

    public function addSelfMadeSuperCategory(Request $request){
        SuperCategory::where('id',$request['searchValue'])->update(['selfMade' => 1]);
    }

    public function removeSelfMadeSuperCategory(Request $request){
        SuperCategory::where('id',$request['searchValue'])->update(['selfMade' => 0]);
    }
}
