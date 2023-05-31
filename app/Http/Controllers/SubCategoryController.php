<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use CRUD;

    public function index()
    {
        $sub_categories = SubCategory::all();
        return view('admin.categories.index', compact('sub_categories'));
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
    public function store(SubCategoryRequest $request)
    {
        SubCategory::create([
            'name' => $request->name,
            'time' => $request->time,
            'c_id' => $request->c_id
        ]);

        return redirect()->route('categories.index')->with('success','Sub Category added successfully');
    }
    public function storeJson(SubCategoryRequest $request)
    {
        $sub_category = SubCategory::create([
            'name' => $request->name,
            'time' => $request->time,
            'c_id' => $request->c_id
        ]);

        return response()->json([
            'sub_category' => $sub_category
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subcategory)
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
    public function update(Request $request, SubCategory $sub_category)
    {
        //dd($sub_category);
        $this->updateFromRequest($sub_category, $request);
        return redirect()->route('categories.index')
            ->with('message','Categories updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $sub_category)
    {
        $sub_category->delete();
        return redirect()->route('categories.index')->with('success','Sub Category deleted successfully');
    }
}
