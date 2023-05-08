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
        $product = Product::get();
        return view('admin.plan.product.list', ['products' => $product]);
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
}
