<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSettings;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductCategory;

class HomeController extends Controller
{
    public function index(Request $request) {
        $categories = ProductCategory::whereHas('products', function ($q) {
            $q->has('plans');
        })->with(['products', 'products.plans', 'products.inclusions'])->orderBy('order_index', 'asc')->get();
        return view('landing', [
            'categories' => $categories
        ]);
    }
}
