@extends('layouts.admin')

@section('title', 'Admin Dashboard : Category Type')

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
    <form action="" method="POST">
        @csrf
        <div class="content content-boxed">
            <div class="row">
                <div class="col-xl-12">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Add Category Type</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="container mt-5">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-md-12">
                                        <div class="tab" style="display: block;">
                                            <div class="row mb-4">
                                                <div class="col-md-12 mb-2">
                                                    <label class="form-label">Category Type Title:</label>
                                                    <input type="text" class="form-control category_type_title required" placeholder="Enter Category Type Title" id="category_type_title" name="category_type_title" value="">
                                                </div>
                                                <div class="col-md-12 mb-2 mt-2">
                                                    <label class="form-label">Test Format:</label>
                                                    <select name="test_format" id="test_format" class="form-control js-select2 select">
                                                        <option value="">Select Test Format</option>
                                                        <option value="SAT">SAT</option>
                                                        <option value="PSAT">PSAT</option>
                                                        <option value="ACT">ACT</option>
                                                    </select>
                                                </div>
                                                <div class="mb-2 col-md-12 ptype mt-2">
                                                    <div>
                                                        <label class="form-label">Section Type:</label>
                                                        <select name="section_type" id="section_type" class="form-control js-select2 select" onchange="insertSuperCategory(this)" >
                                                            
                                                        </select>
                                                    </div>
                                                    @error('section_type')
                                                            <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-2 mt-2">
                                                    <label class="form-label">Super Category:</label>
                                                    <select name="super_category" id="super_category" class="form-control js-select2 select">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mb-2 mt-2">
                                                    <label for="category_type_description" class="form-label">Description:</label>
                                                    <textarea id="js-ckeditor-desc" name="category_type_description" class="form-control form-control-lg form-control-alt category_type_description"  name="category_type_description" placeholder="Description" ></textarea>
                                                </div>
                                                <div class="col-md-12 mb-2 mt-2">
                                                    <label for="category_type_lesson" class="form-label">Lesson:</label>
                                                    <textarea id="js-ckeditor-lesson" name="category_type_lesson" class="form-control form-control-lg form-control-alt category_type_lesson" name="category_type_lesson" placeholder="Enter lesson" ></textarea>
                                                </div>
                                                <div class="col-md-12 mb-2 mt-2">
                                                    <label for="category_type_strategies" class="form-label">Strategies:</label>
                                                    <textarea id="js-ckeditor-startegies" name="category_type_strategies" class="form-control form-control-lg form-control-alt category_type_strategies" name="category_type_strategies" placeholder="Enter Startegies" ></textarea>
                                                </div>
                                                <div class="col-md-12 mb-2 mt-2">
                                                    <label for="category_type_identification_methods" class="form-label">Identification Methods:</label>
                                                    <textarea id="js-ckeditor-methods" name="category_type_identification_methods" class="form-control form-control-lg form-control-alt category_type_identification_methods" name="category_type_identification_methods" placeholder="Enter identification methods" ></textarea>
                                                </div>
                                                <div class="col-md-12 mb-2 mt-2">
                                                    <label for="category_type_identification_activity" class="form-label">Identification Activity:</label>
                                                    <textarea id="js-ckeditor-activity" name="category_type_identification_activity" class="form-control form-control-lg form-control-alt category_type_identification_activity" name="category_type_identification_activity" placeholder="Enter identification activity" ></textarea>
                                                </div>
                                             </div>
                                            </div>
                                        </div>
                                        <div style="overflow:auto;" id="nextprevious">
                                            <div style="float:right;"> 
                                                <a href="javascript:;" class="btn btn-sm btn-primary" id="storecategorytype" >Submit</a>
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
    var allowedContent = true;
		CKEDITOR.replace( 'js-ckeditor-desc',{
			extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
			allowedContent
		});

        CKEDITOR.replace( 'js-ckeditor-lesson',{
			extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
			allowedContent
		});

        CKEDITOR.replace( 'js-ckeditor-startegies',{
			extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
			allowedContent
		});


        CKEDITOR.replace( 'js-ckeditor-methods',{
			extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
			allowedContent
		});

        CKEDITOR.replace( 'js-ckeditor-activity',{
			extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
			allowedContent
		});

        $(document).ready(() => {
            $('#test_format').select2({
                tags : true,
                placeholder : "Select Test Format",
            });
            $('#super_category').select2({
                tags : true,
                placeholder : "Select Super Category",
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

        function insertSuperCategory(data){
            let value = $('#test_format').val();
            let section_type = $('#section_type').val();
            $.ajax({
                    data:{
                        'format':value,
                        'section_type':section_type,
                        '_token': $('input[name="_token"]').val()
                    },
                    url: '{{route("findSuperCategory")}}',
                    method: 'post',
                    success: (res) => {
                        let result = res.superCategory;
                        $('#super_category').html('');
                        let option = '<option value=""></option>';
                        $.each(result, function(i,v){
                            option += `<option value="${result[i]['id']}">${result[i]['title']}</option>`;
                        });
                        $('#super_category').append(option);
                    }
            });
        }

    $('#storecategorytype').click(function() {
			var category_type_title = $('#category_type_title').val();
            var category_type_description = CKEDITOR.instances['js-ckeditor-desc'].getData();
            var category_type_lesson = CKEDITOR.instances['js-ckeditor-lesson'].getData();
            var category_type_strategies = CKEDITOR.instances['js-ckeditor-startegies'].getData();
            var category_type_identification_methods = CKEDITOR.instances['js-ckeditor-methods'].getData();
            var category_type_identification_activity = CKEDITOR.instances['js-ckeditor-activity'].getData();
            var format = $('#test_format').val();
            var super_category = $('#super_category').val();
            var section_type = $('#section_type').val();

            if(category_type_title != '' &&  category_type_description != '' && category_type_lesson != '' && category_type_strategies != '' && category_type_identification_methods != '' && category_type_identification_activity != '' && format != '' && super_category != '' && section_type !== '')
            {
                $.ajax({
                    data:{
                        'category_type_title': category_type_title,
                        'category_type_description': category_type_description,
                        'category_type_lesson': category_type_lesson,
                        
                        'category_type_strategies': category_type_strategies,
                        'category_type_identification_methods': category_type_identification_methods,
                        'category_type_identification_activity': category_type_identification_activity,
                        'format':format,
                        'super_category':super_category,
                        'section_type':section_type,
                        '_token': $('input[name="_token"]').val()
                    },
                    url: '{{route("storeCategoryType")}}',
                    method: 'post',
                    success: (res) => {
                        alert('Category Type Added');
                        
                        window.location.href = '{{route("indexCategoryType")}}';
                    }
                });
            }
            else
            {
                alert('All the fields are required!');
            }
			
		});
</script>
@endsection