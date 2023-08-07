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
                        <label class="from-label">Product Category:</label>
                        <select id="product_category" name="product_category" class="form-control form-control-lg form-control-alt {{$errors->has('product_category') ? 'is-invalid' : ''}}">
                            <option value="">Select Product Category</option>
                            @foreach($product_categories as $cateogry)
                                <option value="{{ $cateogry->id }}">{{ $cateogry->title }}</option>
                            @endforeach
                        </select>
                        @error('product_category')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="from-label">Select Product:</label>
                        <select id="product_id" name="product_id" class="form-control form-control-lg form-control-alt {{$errors->has('product_id') ? 'is-invalid' : ''}}">
                        </select>
                        @error('product_id')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">Cost per Interval:</label>
                        <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('amount') ? 'is-invalid' : ''}}" id="amount" name="amount" placeholder="Cost per Interval" value="{{old('amount')}}">
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
                        <label for="description" class="form-label">Interval Count:</label>
                        {{-- <select id="interval_count" name="interval_count"  class="form-control form-control-lg form-control-alt {{$errors->has('interval_count') ? 'is-invalid' : ''}}">
                            <option value="">Select Interval Type</option>
                        </select> --}}
                        <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('interval_count') ? 'is-invalid' : ''}}" id="interval_count" name="interval_count" placeholder="Interval Count" value="{{old('interval_count')}}">
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
<script>
    $(document).ready(function() {

        // $('#interval').on('change', function (e) {
        //     const interval = $(this).val();
        //     let intervalcount = 12;
        //     if (interval == 'hour') {
        //         intervalcount = 24;
        //     }
        //     $('#interval_count').html('');
        //     $('#interval_count').append(`<option value="">Select Interval Type</option>`);
        //     for (let i = 1; i <= intervalcount; i++) {
        //         $('#interval_count').append(`<option value="${i}">${i}</option>`);
        //     }
        // })

        $('#product_category').change(function() {
            var product_category_id = $(this).val();
            if(product_category_id) {
                var url = "{{ route('admin.plan.get_product', ':product_category_id') }}";
                $.ajax({
                    url: url.replace(':product_category_id', product_category_id),
                    type: "GET",
                    success:function(data) {
                        $('#product_id').empty();
                        $('#product_id').append('<option value="">Select Product</option>');
                        $.each(data, function(key, value) {
                            $('#product_id').append('<option value="'+ value.id +'">'+ value.title +'</option>');
                        });
                    }
                });
            } else {
                $('#product_id').empty();
                $('#product_id').append('<option value="">Select Product</option>');
            }
        });
    });
</script>
@endsection
