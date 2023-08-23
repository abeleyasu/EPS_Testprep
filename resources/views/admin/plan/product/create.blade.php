@extends('layouts.admin')

@section('title', 'Admin Dashboard : CPS')

@section('admin-content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Add Product</h3>
            </div>
            <div class="block-content block-content-full">
                <form action="{{route('admin.product.product_create')}}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="from-label">Category Type:</label>
                        <select id="product_category_id" name="product_category_id" class="form-control form-control-lg form-control-alt {{$errors->has('product_category_id') ? 'is-invalid' : ''}}">
                            <option value="">Select Cateogory</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('product_category_id')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">Product Name:</label>
                        <input type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" id="title" name="title" placeholder="Product Name" value="{{old('title')}}">
                        @error('title')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">Description:</label>
                        <input type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" id="description" name="description" placeholder="Product Description" value="{{old('description')}}">
                        @error('description')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    @include('admin.plan.product.inclusion')
                    <div class="row mb-4">
                        <div class="col-md-6 col-xl-5">
                            <button type="submit" class="btn w-100 btn-alt-success">
                                <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Product
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<!-- END Main Container -->
@endsection
