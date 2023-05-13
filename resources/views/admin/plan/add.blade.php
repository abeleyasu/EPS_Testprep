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
                <h3 class="block-title">Add Plan</h3>
            </div>
            <div class="block-content block-content-full">
                <form action="{{route('admin.plan.plan_create')}}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="from-label">Select Product:</label>
                        <select id="product_id" name="product_id" class="form-control form-control-lg form-control-alt {{$errors->has('plan_type') ? 'is-invalid' : ''}}">
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">Amount:</label>
                        <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('price') ? 'is-invalid' : ''}}" id="amount" name="amount" placeholder="Amount" value="{{old('amount')}}">
                        @error('amount')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="from-label">Interval Type:</label>
                        <select id="interval" name="interval" class="form-control form-control-lg form-control-alt {{$errors->has('interval') ? 'is-invalid' : ''}}">
                            <option value="">Select Interval Type</option>
                            @foreach($types as $type)
                                <option value="{{ $type->value }}">{{ $type->option }}</option>
                            @endforeach
                        </select>
                        @error('interval')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4" id="in-count-ele">
                        <label for="description" class="form-label">Interval Count (In Month):</label>
                        <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('price') ? 'is-invalid' : ''}}" id="interval_count" name="interval_count" placeholder="Interval Count" value="{{old('interval_count')}}">
                        @error('interval_count')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6 col-xl-5">
                            <button type="submit" class="btn w-100 btn-alt-success">
                                <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Plan
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

@section('admin-script')
@endsection
