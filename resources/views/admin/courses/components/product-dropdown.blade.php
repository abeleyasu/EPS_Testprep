@inject('products', 'App\Models\Product')

<div class="mb-2 product-options @if(isset($status) && $status != 'paid') d-none @endif">
    <label class="form-label" for="status">Select Product</label>
    <select name="product" class="form-control {{$errors->has('product') ? 'is-invalid' : ''}}">
        @if(isset($product) && !empty($product))
            @if($products->find($product))
                <option value="{{$product}}" selected="selected">{{ $products->find($product)->title }}</option>
            @endif
        @endif
    </select>
    @error('product')
        <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>
@if($products->count() == 0)
<button id="add-product-btn" class="btn btn-alt-success w-100 @if(isset($status) && $status != 'paid') d-none @endif">Add Product</button>
@endif