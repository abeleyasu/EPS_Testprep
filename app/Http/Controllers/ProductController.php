<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    private $stripe;
    public function __construct() {
        $this->stripe = new \Stripe\StripeClient(config('stripe.api_keys.secret_key'));
    }
    public function index() {
        $product = Product::get();
        return view('admin.plan.product.list', ['products' => $product]);
    }

    public function show() {
        $product_category = ProductCategory::get();
        return view('admin.plan.product.create', ['categories' => $product_category]);
    }

    public function create(Request $request) {
        $rules = [
            'product_category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
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
        if ($create) {
            return redirect()->intended(route('admin.product.list'));
        }
    }

    public function editshow($id) {
        $product = Product::find($id);
        $product_category = ProductCategory::get();
        return view('admin.plan.product.edit', ['product' => $product, 'categories' => $product_category]);
    }

    public function edit(Request $request) {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'product_category_id' => 'required',
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
        return redirect()->intended(route('admin.product.list'));
    }

    public function deleteProduct(Request $request) {
        $product = Product::find($request->id);
        $this->stripe->products->delete($product->stripe_product_id, []);
        $product->delete();
        return "success";
    }
}
