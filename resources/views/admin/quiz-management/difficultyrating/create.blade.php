@extends('layouts.admin')

@section('title', 'Admin Dashboard : Difficulty Ratings')

@section('admin-content')
<main id="main-container">
    <form action="{{ route('diffratings.store') }}" method="POST">
        @csrf
        <div class="content content-boxed">
            <div class="row">
                <div class="col-xl-12">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Add Difficulty Rating</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="container mt-5">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-md-12">
                                        <div class="tab" style="display: block;">
                                            <div class="row mb-4">
                                                <div class="col-md-12 mb-2">
                                                    <label class="form-label">Difficulty Rating Title:</label>
                                                    <input type="text" class="form-control category_type_title required" placeholder="Enter Difficulty Rating Title" id="diff_rating_title" name="diff_rating_title" value="{{ old('diff_rating_title') }}">
                                                </div>
                                                @error('diff_rating_title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </div>
                                            </div>
                                        </div>
                                        <div style="overflow:auto;" id="nextprevious">
                                            <div style="float:right;"> 
                                                <button type="submit" class="btn btn-sm btn-primary">Create</button>
                                            </div>				
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>
@endsection
@section('admin-script')

@endsection