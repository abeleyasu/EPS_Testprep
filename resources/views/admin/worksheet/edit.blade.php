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
                <h3 class="block-title">Edit Worksheet</h3>
            </div>
            <div class="block-content block-content-full">
                <form action="{{route('admin.worksheet-management.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $worksheet->id }}">
                    <div class="mb-4">
                        <label for="name" class="form-label">Edit Title:</label>
                        <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" placeholder="title" value="{{ $worksheet->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">Edit Description:</label>
                        <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('description') ? 'is-invalid' : ''}}" id="description" name="description" placeholder="Description" value="{{ $worksheet->description }}">
                        @error('description')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="image">Edit Worksheet File:</label>
                        <input type="file" class="form-control {{$errors->has('file') ? 'is-invalid' : ''}}" id="file" name="file" placeholder="Worksheet File" accept=".csv" value="{{ $worksheet->sheet_name }}">
                        @error('file')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 col-xl-5">
                            <button type="submit" class="btn w-100 btn-alt-success">
                                <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Edit Worksheet
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
</script>
@endsection
