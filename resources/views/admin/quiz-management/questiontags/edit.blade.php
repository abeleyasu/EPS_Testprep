@extends('layouts.admin')

@section('title', 'Admin Dashboard : Difficulty Ratings')

@section('page-style')
<style>
    .select2-container--default .select2-selection--single{
            display: block;
            width: 100%;
            padding: 18px 4px;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #334155;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #dfe3ea;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered{
            color: #334155;
            position: relative;
            top: -14px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 26px;
            position: absolute;
            top: 7px;
            right: 8px;
            width: 20px;
        }
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #6b757c;
        }
</style>
@endsection

@section('admin-content')
<main id="main-container">
    <form action="{{ route('questiontags.update',['questiontag' => $tag['id']]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="content content-boxed">
            <div class="row">
                <div class="col-xl-12">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Edit Question Tag</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="container mt-5">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-md-12">
                                        <div class="tab" style="display: block;">
                                            <div class="row mb-2">
                                                <div class="col-md-12 mb-2">
                                                    <label class="form-label">Question Tag Title:</label>
                                                    <input type="text" class="form-control required" placeholder="Enter Question Tag Title" id="question_tag_title" name="question_tag_title" value="{{ $tag['title'] }}">
                                                </div>
                                                @error('question_tag_title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <label class="form-label">Test Format:</label>
                                                <select name="test_format" id="test_format" class="form-control js-select2 select">
                                                    <option value="">Select Test Format</option>
                                                    <option value="SAT" @if ($tag->format == 'SAT') selected @endif >SAT</option>
                                                    <option value="PSAT" @if ($tag->format == 'PSAT') selected @endif >PSAT</option>
                                                    <option value="ACT" @if ($tag->format == 'ACT') selected @endif >ACT</option>
                                                </select>
                                                @error('test_format')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
    $(document).ready(function(){
        $('#test_format').select2({
            tags : true,
            placeholder : "Select Test Format",
        });
    });
</script>
@endsection