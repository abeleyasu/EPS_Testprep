@inject('products', 'App\Models\Product')

<div class="mb-2 product-options @if(isset($status) && $status != 'paid') d-none @endif">
    <label class="form-label" for="status">Select Product</label>
    <select name="products[]" class="form-control {{$errors->has('products') ? 'is-invalid' : ''}}" multiple="multiple">
        @if(isset($product) && count($product) > 0) 
            @foreach($product as $p)
                @php
                    $pro = $products->find($p);
                @endphp
                @if($pro)
                    <option value="{{$pro->id}}" selected>{{$pro->title}}</option>
                @endif
            @endforeach
        @endif
    </select>
    @error('products')
        <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>
@if($products->count() == 0)
<button id="add-product-btn" class="btn btn-alt-success w-100 @if(isset($status) && $status != 'paid') d-none @endif">Add Product</button>
@endif

