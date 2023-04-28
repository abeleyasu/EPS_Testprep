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
                <h3 class="block-title">Edit Plan</h3>
            </div>
            <div class="block-content block-content-full">
                <form action="{{route('admin.plan.plan_edit')}}" method="POST">
                    @csrf
                    <input type="text" name="id" value="{{$plan->id}}" hidden>
                    <div class="mb-4">
                        <label for="description" class="form-label">Plan Name:</label>
                        <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" placeholder="Plan Name" value="{{$plan->name}}">
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">Description:</label>
                        <textarea name="description" class="form-control form-control-lg form-control-alt {{$errors->has('description') ? 'is-invalid' : ''}}" id="description" name="description" placeholder="Description">
                            {{$plan->description}}
                        </textarea>
                        @error('description')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="from-label">Plan Type:</label>
                        <select id="plan_type" name="plan_type" class="form-control form-control-lg form-control-alt {{$errors->has('plan_type') ? 'is-invalid' : ''}}">
                            <option value="">Select Plan Type</option>
                            @foreach($types as $type)
                                <option value="{{ $type->value }}" @if($plan->plan_type == $type->value) selected @endif >{{ $type->option }}</option>
                            @endforeach
                        </select>
                        @error('plan_type')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">Price:</label>
                        <input type="text" disabled class="form-control form-control-lg form-control-alt {{$errors->has('price') ? 'is-invalid' : ''}}" id="price" name="price" placeholder="Price" value="{{$plan->price}}">
                        @error('price')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6 col-xl-5">
                            <button type="submit" class="btn w-100 btn-alt-success">
                                <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Edit Plan
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
