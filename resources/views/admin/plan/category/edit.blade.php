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
                <h3 class="block-title">Edit Cateory</h3>
            </div>
            <div class="block-content block-content-full">
                <form action="{{route('admin.category.category_edit')}}" method="POST">
                    @csrf
                    <input type="text" name="id" value="{{$category->id}}" hidden>
                    <div class="mb-4">
                        <label for="description" class="form-label">Category Name:</label>
                        <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('title') ? 'is-invalid' : ''}}" id="title" name="title" placeholder="Cateogry Name" value="{{$category->title}}">
                        @error('title')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">Description:</label>
                        <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('description') ? 'is-invalid' : ''}}" id="description" name="description" placeholder="Cateogry description" value="{{$category->description}}">
                        @error('description')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="from-label">Category Type:</label>
                        <select id="type" name="type" class="form-control form-control-lg form-control-alt {{$errors->has('type') ? 'is-invalid' : ''}}">
                            <option value="">Select Cateogry Type</option>
                            <option value="subscription" @if($category->type == 'subscription') selected @endif >Subscription</option>
                            <option value="one-time" @if($category->type == 'one-time') selected @endif>One Time</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6 col-xl-5">
                            <button type="submit" class="btn w-100 btn-alt-success">
                                <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Edit Cateory
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
