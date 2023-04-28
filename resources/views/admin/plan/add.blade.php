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
                        <label for="description" class="form-label">Plan Name:</label>
                        <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" placeholder="Plan Name" value="{{old('name')}}">
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">Description:</label>
                        <textarea id="js-ckeditor" name="description" class="form-control form-control-lg form-control-alt {{$errors->has('description') ? 'is-invalid' : ''}}" id="description" name="description" placeholder="Description">
                            {{ old('description') }}
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
                                <option value="{{ $type->value }}">{{ $type->option }}</option>
                            @endforeach
                        </select>
                        @error('plan_type')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">Price:</label>
                        <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('price') ? 'is-invalid' : ''}}" id="price" name="price" placeholder="Price" value="{{old('price')}}">
                        @error('price')
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
