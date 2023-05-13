<?php

namespace App\Http\Controllers;

use App\Models\ProductInclusion;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    private $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(config('stripe.api_keys.secret_key'));
    }

    public function index()
    {
        // $product = Product::with('productCategory')->get();
        return view('admin.plan.product.list');
    }

    public function displayRecords(Request $request) {
        $limit = isset($request->limit) ? $request->limit : 10;
        $search =  isset($request->search['value']) ? $request->search['value'] : ""; 


        $products = Product::with('productCategory')->orderBy('order_index', 'asc');
        $totalProductCount = Product::get()->count();

        if (!empty($search)) {
            $products = $products->where(function ($product) use ($search) {
                return $product->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
            $totalProductCount = $products->count();
        }

        $products = $products->paginate($limit);
        $products = $products->toArray();


        $data = [];
        foreach ($products['data'] as $product) {
            $data[] = [
                'id' => $product['id'],
                'title' => $product['title'],
                'category' => $product['product_category']['title'],
                'description' => $product['description'],
                'product_key' => $product['stripe_product_id'],
                'order_index' => $product['order_index'],
                'action' => '<div class="btn-group">
                                <a href="' . route('admin.product.edit', ['id' => $product['id']]) . '" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit Category">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-alt-secondary delete-user" data-id="' . $product['id'] . '" data-bs-toggle="tooltip" title="Delete Category">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>'
            ];
        }
        $json_data = [
            "draw"            => intval( $request->draw ),   
            "recordsTotal"    => $totalProductCount,  
            "recordsFiltered" => $totalProductCount,
            "data"            => $data
        ];
        return response()->json($json_data);
    }

    public function show()
    {
        $product_category = ProductCategory::get();
        return view('admin.plan.product.create', ['categories' => $product_category]);
    }

    public function create(Request $request)
    {
        $rules = [
            'product_category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'inclusion' => 'required',
        ];
        $customMessage = [
            'product_category_id.required' => 'Category is required'
        ];
        $request->validate($rules, $customMessage);
        $product = $this->stripe->products->create([
            'name' => $request->title,
            'description' => $request->description
        ]);
        $create = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'product_category_id' => $request->product_category_id,
            'stripe_product_id' => $product['id']
        ]);
        $inclusions = array_map(function ($item) use ($create) {
            return ['product_id' => $create->id, 'inclusion' => $item];
        }, $request->inclusion);
        ProductInclusion::insert($inclusions);
        if ($create) {
            return redirect()->intended(route('admin.product.list'));
        }
    }

    public function editshow($id)
    {
        $product = Product::where(['id' => $id])->with('inclusions')->first();
        $product_category = ProductCategory::get();
        return view('admin.plan.product.edit', ['product' => $product, 'categories' => $product_category]);
    }

    public function edit(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'product_category_id' => 'required',
            'inclusion' => 'required',
        ];
        $customMessage = [
            'product_category_id.required' => 'Category is required'
        ];
        $request->validate($rules, $customMessage);
        $product = Product::find($request->id);
        $stripe_product = $this->stripe->products->update($product->stripe_product_id, [
            'name' => $request->title,
            'description' => $request->description
        ]);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->product_category_id = $request->product_category_id;
        $product->save();


        $oldIncs = ProductInclusion::where('product_id', $request->id)->get()->toArray();
        $oldLength = count($oldIncs);
        $newLength = count($request->inclusion);

        $newInsert = [];
        $deleteId = [];

        foreach ($oldIncs as $key => $oldInc) {
            if (isset($request->inclusion[$key])) {
                ProductInclusion::where('id', $oldInc['id'])->update(['inclusion' => $request->inclusion[$key]]);
            } else {
                array_push($deleteId, $oldInc['id']);
            }
        }

        for ($i = $oldLength; $i < $newLength; $i++) {
            array_push($newInsert, ['product_id' => $request->id, 'inclusion' => $request->inclusion[$i]]);
        }

        if (count($newInsert) > 0) {
            ProductInclusion::insert($newInsert);
        }

        if (count($deleteId) > 0) {
            ProductInclusion::whereIn('id', $deleteId)->delete();
        }


        return redirect()->intended(route('admin.product.list'));
    }

    public function deleteProduct(Request $request)
    {
        $product = Product::find($request->id);
        $this->stripe->products->delete($product->stripe_product_id, []);
        $product->delete();
        return "success";
    }

    public function changeOrder(Request $request) {
        $order_index = $request->data;
        foreach ($order_index as $key => $value) {
            $category = Product::find($value['id'])->update(['order_index' => $value['order_index']]);
        }
        return "success";
    }
}
