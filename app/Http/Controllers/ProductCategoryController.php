<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Validation\Rule;

class ProductCategoryController extends Controller
{
    public function index(Request $request) {
        return view('admin.plan.category.list');

    }

    public function displayRecords(Request $request) {
        $limit = isset($request->limit) ? $request->limit : 10;
        $search =  isset($request->search['value']) ? $request->search['value'] : ""; 
        $start = isset($request->start) ? $request->start : 0;

        $categories = ProductCategory::orderBy('order_index', 'asc');
        $totalCustomerRecords = ProductCategory::get()->count();

        if (!empty($search)) {
            $categories = $categories->where(function ($category) use ($search) {
                return $category->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
            $totalCustomerRecords = $categories->count();
        }

        // $categories = $categories->skip($start)->take($limit);
        $categories = $categories->get();


        $data = [];
        foreach ($categories as $category) {
            $data[] = [
                'id' => $category['id'],
                'title' => $category['title'],
                'description' => $category['description'],
                'order_index' => $category['order_index'] + 1,
                'action' => '<div class="btn-group">
                                <a href="' . route('admin.category.edit', ['id' => $category['id']]) . '" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit Category">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-alt-secondary delete-user" data-id="' . $category['id'] . '" data-bs-toggle="tooltip" title="Delete Category">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>'
            ];
        }
        $json_data = [
            "draw"            => intval( $request->draw ),   
            "recordsTotal"    => $totalCustomerRecords,  
            "recordsFiltered" => $totalCustomerRecords,
            "data"            => $data
        ];
        return response()->json($json_data);
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
        $lastOrderIndex = ProductCategory::max('order_index');
        $create = ProductCategory::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'order_index' => $lastOrderIndex + 1
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

    public function changeOrder(Request $request) {
        $order_index = $request->data;
        foreach ($order_index as $key => $value) {
            $category = ProductCategory::find($value['id'])->update(['order_index' => $value['order_index']]);
        }
        return "success";
    }

    public function ajaxCategories(Request $request) {
        $page = isset($request->page) ? $request->page : 1;
        $search = isset($request->search) ? $request->search : null;
        $limit = $page * 25;

        $categories = ProductCategory::orderBy('id', 'asc')->select('id', 'title as text');

        if (!empty($search)) {
            $categories = $categories->where(function ($category) use ($search) {
                return $category->where('title', 'LIKE', "%{$search}%");
            });
        }

        $categories = $categories->paginate($limit);
        $categories = $categories->toArray();
        return response()->json([
            'data' => $categories['data'],
            'total' => $categories['total']
        ]);
    }
}
