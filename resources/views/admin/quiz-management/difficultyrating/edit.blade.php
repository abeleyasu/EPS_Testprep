@extends('layouts.admin')

@section('title', 'Admin Dashboard : Difficulty Ratings')

@section('admin-content')
<main id="main-container">
    <form action="{{ route('diffratings.update',['diffrating' => $rating['id']]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="content content-boxed">
            <div class="row">
                <div class="col-xl-12">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Edit Difficulty Rating</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="container mt-5">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-md-12">
                                        <div class="tab" style="display: block;">
                                            <div class="row mb-4">
                                                <div class="col-md-12 mb-2">
                                                    <label class="form-label">Difficulty Rating Title:</label>
                                                    <input type="text" class="form-control required" placeholder="Enter Difficulty Rating Title" id="diff_rating_title" name="diff_rating_title" value="{{ $rating['title'] }}">
                                                </div>
                                                <span class="text-danger error"></span>
                                             </div>
                                            </div>
                                        </div>
                                        <div style="overflow:auto;" id="nextprevious">
                                            <div style="float:right;"> 
                                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
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
<script src="{{asset('assets/js/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('assets/js/plugins/Sortable.js')}}"></script>
<script>
</script>
@endsection