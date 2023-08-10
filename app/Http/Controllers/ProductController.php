<?php

namespace App\Http\Controllers;

use App\Models\ProductInclusion;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\PermissionModule;
use App\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;
use App\Http\Requests\AjaxProductInsertRequest;

class ProductController extends Controller
{
    public function index()
    {
        // $product = Product::with('productCategory')->get();
        return view('admin.plan.product.list');
    }

    public function displayRecords(Request $request) {
        $limit = isset($request->limit) ? $request->limit : 10;
        $search =  isset($request->search['value']) ? $request->search['value'] : ""; 
        $start = isset($request->start) ? $request->start : 0;

        $products = Product::with('productCategory')->orderBy('order_index', 'asc');
        $totalProductCount = Product::get()->count();

        if (!empty($search)) {
            $products = $products->where(function ($product) use ($search) {
                return $product->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
            $totalProductCount = $products->count();
        }

        // $products = $products->skip($start)->take($limit);
        $products = $products->get()->toArray();
        
        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'id' => $product['id'],
                'title' => $product['title'],
                'category' => $product['product_category']['title'],
                'description' => $product['description'],
                'product_key' => $product['stripe_product_id'],
                'order_index' => $product['order_index'] + 1,
                'action' => '<div class="btn-group">
                                <a href="' . route('admin.product.productPermission', ['id' => $product['id']]) . '" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Attach Permission">
                                    <i class="fa fa-fw fa-file-lines"></i>
                                </a>
                                <a href="' . route('admin.product.edit', ['id' => $product['id']]) . '" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit Product">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-alt-secondary delete-user" data-id="' . $product['id'] . '" data-bs-toggle="tooltip" title="Delete Product">
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
            'inclusion.*' => 'required|alpha_num|string',
        ];
        $customMessage = [
            'product_category_id.required' => 'Category is required'
        ];
        $request->validate($rules, $customMessage);
        $product = $this->stripe->products->create([
            'name' => $request->title,
            'description' => $request->description
        ]);
        $lastOrderIndex = Product::max('order_index');
        $create = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'product_category_id' => $request->product_category_id,
            'stripe_product_id' => $product['id'],
            'order_index' => $lastOrderIndex + 1
        ]);
        if ($create ) {
            $role = Role::create([
                'name' => $product['id'],
                'guard_name' => 'web'
            ]);
            if ($role) {
                $permissions = Permission::get();
                $role->syncPermissions($permissions);
            }
            $inclusions = array_map(function ($item) use ($create) {
                $inclusion = strip_tags($item);
                if (!empty($inclusion)) {
                    return ['product_id' => $create->id, 'inclusion' => $item];
                }
            }, $request->inclusion);
            ProductInclusion::insert($inclusions);
            return redirect()->intended(route('admin.product.list'))->with('success', 'Product created successfully');
        }
        return redirect()->intended(route('admin.product.list'))->with('error', 'Product creation failed');
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
            'inclusion.*' => 'required|string',
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
                $inclusion = strip_tags($request->inclusion[$key]);
                if (!empty($inclusion)) {
                    ProductInclusion::where('id', $oldInc['id'])->update(['inclusion' => $inclusion]);
                }
            } else {
                array_push($deleteId, $oldInc['id']);
            }
        }

        for ($i = $oldLength; $i < $newLength; $i++) {
            $inclusion = strip_tags($request->inclusion[$i]);
            if (!empty($inclusion)) {
                array_push($newInsert, ['product_id' => $request->id, 'inclusion' => $inclusion]);
            }
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
        try {
            $product = Product::find($request->id);
            $this->stripe->products->delete($product->stripe_product_id, []);
            Role::where('name', $product->stripe_product_id)->delete();
            $product->inclusions()->delete();
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function changeOrder(Request $request) {
        $order_index = $request->data;
        foreach ($order_index as $key => $value) {
            $category = Product::find($value['id'])->update(['order_index' => $value['order_index']]);
        }
        return "success";
    }

    public function permissions() {
        $permissions = Permission::with('modules')->get()->toArray();

        return view('admin.plan.permissions.list', [
            'permissions' => $permissions
        ]);
    }

    public function productPermission($productId) {
        $product = Product::where('id', $productId)->first();
        if (!$product) {
            return redirect()->intended(route('admin.product.list'))->with('error', 'Product not found');
        }
        $role = Role::where('name', $product->stripe_product_id)->first();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        $permissions_module = PermissionModule::with('permission')->get()->toArray();
        return view('admin.plan.product.attach-permission', [
            'product' => $product,
            'permissions_module' => $permissions_module,
            'attach_permission' => $rolePermissions
        ]);
    }

    public function attachPermission(Request $request) {
        if (!$request->permission || count($request->permission) == 0) {
            return back()->with('error', 'Please select at least one permission');
        }
        $product = Product::where('id', $request->product_id)->first();
        if (!$product) {
            return redirect()->intended(route('admin.product.list'))->with('error', 'Product not found');
        }
        $role = Role::where('name', $product->stripe_product_id)->first();
        if (count($request->permission) > 0) {
            $role->revokePermissionTo($role->permissions);
            $role->syncPermissions($request->permission);
        }
        return redirect()->intended(route('admin.product.list'))->with('success', 'Permission attached successfully');
    }

    public function ajaxProducts(Request $request) {
        $page = isset($request->page) ? $request->page : 1;
        $search = isset($request->search) ? $request->search : null;
        $limit = $page * 25;
        $products = Product::whereHas('plans', function ($q) {
            $q->where('interval', '!=', 'hour');
        })->orderBy('order_index', 'asc')->select('id', 'title as text');
        if (!empty($search)) {
            $products = $products->where(function ($product) use ($search) {
                return $product->where('title', 'LIKE', "%{$search}%");
            });
        }
        $products = $products->paginate($limit);
        $products = $products->toArray();
        return response()->json([
            'data' => $products['data'],
            'total' => $products['total']
        ]);
    }

    public function ajaxCreate(AjaxProductInsertRequest $request) {
        DB::beginTransaction();
        try {
            $product = $this->stripe->products->create([
                'name' => $request->title,
                'description' => $request->description
            ]);
            $lastOrderIndex = Product::max('order_index');
            $create = Product::create([
                'title' => $request->title,
                'description' => $request->description,
                'product_category_id' => $request->category,
                'stripe_product_id' => $product['id'],
                'order_index' => $lastOrderIndex + 1
            ]);
            if ($create ) {
                $role = Role::create([
                    'name' => $product['id'],
                    'guard_name' => 'web'
                ]);
                if ($role) {
                    $permissions = Permission::get();
                    $role->syncPermissions($permissions);
                }
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Product created successfully'
                ]);
            } else {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Product creation failed'
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
