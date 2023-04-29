<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Validation\Rule;

class ProductCategoryController extends Controller
{
    public function index() {
        $category = ProductCategory::get();
        return view('admin.plan.category.list', ['categories' => $category]);
    }

    public function show() {
        return view('admin.plan.category.create');
    }

    public function create(Request $request) {
        $rules = [
            'title' => 'required',
            'description' => 'required'
        ];
        $request->validate($rules);
        $create = ProductCategory::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description
        ]);
        if ($create) {
            return redirect()->intended(route('admin.category.list'));
        }
    }

    public function editshow($id) {
        $category = ProductCategory::find($id);
        return view('admin.plan.category.edit', ['category' => $category]);
    }

    public function edit(Request $request) {
        $rules = [
            'title' => 'required',
            'description' => 'required'
        ];
        $request->validate($rules);
        $category = ProductCategory::find($request->id);
        $category->title = $request->title;
        $category->description = $request->description;
        $category->save();
        return redirect()->intended(route('admin.category.list'));
    }

    public function deleyeCateogry(Request $request) {
        $category = ProductCategory::find($request->id)->delete();
        return "success";
    }
}
