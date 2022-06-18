@extends('layouts.admin')

@section('title', 'Admin Dashboard : Passages')

@section('page-style')
    <style>
        .label-check{
            padding:4px;
        }
    </style>
@endsection
@section('admin-content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Add Passages</h3>
            </div>
            <div class="block-content block-content-full">
                <form action="{{route('passages.store')}}" method="POST" >
                    @csrf
                    <div class="row py-3">
                    <div class="col-md-12">

                        <div class="mb-2">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('title') ? 'is-invalid' : ''}}"
                             id="title" name="title" placeholder="Title" value="{{old('title')}}" required>
                            @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="description" class="form-label">Description:</label>


                            <textarea id="js-ckeditor" name="description" class="form-control form-control-lg form-control-alt
                            {{$errors->has('description') ? 'is-invalid' : ''}}" id="description" name="description"
                                      placeholder="Description"
                                      >
                            {{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>


                    </div>

                    </div>

                    <div class="col-md-6 col-xl-5 mb-4">
                        <button type="submit" class="btn w-100 btn-alt-success">
                            <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Passages
                        </button>
                    </div>

                </form>
                <!-- END Edit User Form -->
            </div>
        </div>
    </div>
</main>




@endsection
@section('admin-script')

    <script src="{{asset('assets/js/plugins/ckeditor/ckeditor.js')}}"></script>



    <script>

        One.helpersOnLoad(['js-ckeditor']);


    </script>
@endsection
