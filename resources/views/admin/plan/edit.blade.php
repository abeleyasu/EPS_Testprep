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
                <form action="{{route('admin.plan.plan_edit')}}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="from-label">Select Product:</label>
                        <select id="product_id" name="product_id" class="form-control form-control-lg form-control-alt {{$errors->has('plan_type') ? 'is-invalid' : ''}}">
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" @if($plan->product_id === $product->id) selected @endif>{{ $product->title }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">Amount:</label>
                        <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('price') ? 'is-invalid' : ''}}" id="amount" name="amount" placeholder="Amount" value="{{$plan->amount}}">
                        @error('amount')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="from-label">Interval Type:</label>
                        <select id="interval" name="interval" class="form-control form-control-lg form-control-alt {{$errors->has('interval') ? 'is-invalid' : ''}}">
                            <option value="">Select Interval Type</option>
                            @foreach($types as $type)
                                <option value="{{ $type->value }}" @if($type->value === $plan->interval) selected @endif>{{ $type->option }}</option>
                            @endforeach
                        </select>
                        @error('interval')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4" id="in-count-ele">
                        <label for="description" class="form-label">Interval Count (In Month):</label>
                        <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('price') ? 'is-invalid' : ''}}" id="interval_count" name="interval_count" placeholder="Interval Count" value="{{$plan->interval_count}}">
                        @error('interval_count')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4" id="pe_month_ele">
                        <label for="description" class="form-label">Per Month:</label>
                        <input type="text" disabled class="form-control form-control-lg form-control-alt {{$errors->has('price') ? 'is-invalid' : ''}}" id="p_month" value="{{$plan->display_amount}}"  placeholder="Per month">
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

        $(() => {
            const interval = "{{ $plan->interval }}"
            if (interval === 'year') {
                document.getElementById("in-count-ele").style.display = "none";
                document.getElementById("pe_month_ele").style.display = "none";
            } else {
                document.getElementById("in-count-ele").style.display = "block";
                document.getElementById("pe_month_ele").style.display = "block";
            }
        })

        $('#interval').on('change', function (e) {
            console.log(e.target.value)
            if (e.target.value === 'year') {
                document.getElementById("in-count-ele").style.display = "none";
                document.getElementById("pe_month_ele").style.display = "none";
            } else {
                document.getElementById("in-count-ele").style.display = "block";
                document.getElementById("pe_month_ele").style.display = "block";
            }
        })

        $('#interval_count').on('change', function (e) {
            calculatedisplayPrice()
        })

        $('#amount').on('change', function (e) {
            calculatedisplayPrice()
        })

        function calculatedisplayPrice() {
            const amount = Number($('#amount').val());
            const interval = $('#interval').val();
            const interval_count = Number($('#interval_count').val());
            if (interval === 'month') {
                if (amount === 0) {
                    $('#p_month').val(0)
                    return;
                }
                if (interval_count === 0) {
                    $('#p_month').val(amount)
                    return;
                }
                const calculate = (amount / interval_count).toFixed(2)
                $('#p_month').val(calculate)
            }
        }
    </script>
@endsection
