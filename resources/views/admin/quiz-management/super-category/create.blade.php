@extends('layouts.admin')

@section('title', 'Admin Dashboard : Super Category')

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
    <form action="{{ route('supercategories.store') }}" method="POST">
        @csrf
        <div class="content content-boxed">
            <div class="row">
                <div class="col-xl-12">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Add Super Category</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="container mt-5">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-md-12">
                                        <div class="tab" style="display: block;">
                                            <div class="row mb-2">
                                                <div class="col-md-12">
                                                    <label class="form-label">Super Category Title:</label>
                                                    <input type="text" class="form-control category_type_title required" placeholder="Enter Super Category Title" id="super_category_title" name="super_category_title" value="{{ old('question_tag_title') }}">
                                                </div>
                                                @error('super_category_title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 ptype mt-2 mb-2">
                                                    <label class="form-label">Test Format:</label>
                                                    <select name="test_format" id="test_format" class="form-control js-select2 select">
                                                        <option value="">Select Test Format</option>
                                                        <option value="SAT">SAT</option>
                                                        <option value="PSAT">PSAT</option>
                                                        <option value="ACT">ACT</option>
                                                        <option value="DSAT">Digital SAT</option>
                                                        <option value="DPSAT">Digital PSAT</option>
                                                    </select>
                                                </div>
                                                @error('test_format')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-12 ptype mt-2">
                                                    <label class="form-label">Section Type:</label>
                                                    <select name="section_type" id="section_type" class="form-control js-select2 select">
                                                        
                                                    </select>
                                                </div>
                                                @error('section_type')
                                                        <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
<script>
    $(document).ready(() => {
        $('#test_format').select2({
            tags : true,
            placeholder : "Select Test Format",
        });
        $('#section_type').select2({
            tags : true,
            placeholder : "Select Section Type",
        });
    });
    $(document).on('change','#test_format',function(){
        $('#section_type').html('');
        let sat_array = ['Reading','Writing','Math_no_calculator','Math_with_calculator'];
        let act_array = ['English','Math','Reading','Science'];
        let html = ``;
        html += `<option value="">Select Section Type</option>`;
        if($(this).val() == 'SAT' || $(this).val() == 'PSAT'){
            $.each(sat_array,function(i,v){
                html += `<option value="${v}">${v}</option>`;
            });
        } 
        if($(this).val() == 'ACT'){
            $.each(act_array,function(i,v){
                html += `<option value="${v}">${v}</option>`;
            });
        } 
        $('#section_type').append(html);
    });
</script>
@endsection