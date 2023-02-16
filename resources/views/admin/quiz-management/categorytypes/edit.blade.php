@extends('layouts.admin')

@section('title', 'Admin Dashboard : Category Type')

@section('admin-content')
<main id="main-container">
    <form action="" method="POST">
        @csrf
        <div class="content content-boxed">
            <div class="row">
                <div class="col-xl-12">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Edit Category Type</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="container mt-5">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-md-12">
                                        <div class="tab" style="display: block;">
                                            <div class="row mb-4">
                                                <div class="col-md-12 mb-2">
                                                    <label class="form-label"></label>
                                                    <input type="hidden" class="form-control category_type_id required" id="category_type_id" name="category_type_id" value="{{$getcategoryDetails[0]->id}}">
                                                 </div>
                                                <div class="col-md-12 mb-2">

                                                    <label class="form-label">Category Type Title:</label>
                                                    <input type="text" class="form-control category_type_title required" placeholder="Enter Category Type Title" id="category_type_title" name="category_type_title" value="{{$getcategoryDetails[0]->category_type_title}}">

                                                    
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label for="category_type_description" class="form-label">Description:</label>
                                                    <textarea id="js-ckeditor-desc" name="category_type_description" class="form-control form-control-lg form-control-alt category_type_description"  name="category_type_description" placeholder="Description" >{{$getcategoryDetails[0]->category_type_description}}</textarea>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label for="category_type_lesson" class="form-label">Lesson:</label>
                                                    <textarea id="js-ckeditor-lesson" name="category_type_lesson" class="form-control form-control-lg form-control-alt category_type_lesson" name="category_type_lesson" placeholder="Enter lesson" >{{$getcategoryDetails[0]->category_type_lesson}}</textarea>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label for="category_type_strategies" class="form-label">Strategies:</label>
                                                    <textarea id="js-ckeditor-startegies" name="category_type_strategies" class="form-control form-control-lg form-control-alt category_type_strategies" name="category_type_strategies" placeholder="Enter Startegies" >{{$getcategoryDetails[0]->category_type_strategies}}</textarea>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label for="category_type_identification_methods" class="form-label">Identification Methods:</label>
                                                    <textarea id="js-ckeditor-methods" name="category_type_identification_methods" class="form-control form-control-lg form-control-alt category_type_identification_methods" name="category_type_identification_methods" placeholder="Enter identification methods" >{{$getcategoryDetails[0]->category_type_identification_methods}}</textarea>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label for="category_type_identification_activity" class="form-label">Identification Activity:</label>
                                                    <textarea id="js-ckeditor-activity" name="category_type_identification_activity" class="form-control form-control-lg form-control-alt category_type_identification_activity" name="category_type_identification_activity" placeholder="Enter identification activity" >{{$getcategoryDetails[0]->category_type_identification_activity}}</textarea>
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
    $('#storecategorytype').click(function() {
			var category_type_title = $('#category_type_title').val();
            var category_type_description = CKEDITOR.instances['js-ckeditor-desc'].getData();
            var category_type_lesson = CKEDITOR.instances['js-ckeditor-lesson'].getData();
            var category_type_strategies = CKEDITOR.instances['js-ckeditor-startegies'].getData();
            var category_type_identification_methods = CKEDITOR.instances['js-ckeditor-methods'].getData();
            var category_type_identification_activity = CKEDITOR.instances['js-ckeditor-activity'].getData();

            var category_type_id = $('#category_type_id').val();

            $.ajax({
                data:{
					'category_type_title': category_type_title,
					'category_type_description': category_type_description,
					'category_type_lesson': category_type_lesson,
                    'category_type_strategies': category_type_strategies,
					'category_type_identification_methods': category_type_identification_methods,
					'category_type_identification_activity': category_type_identification_activity,
                    'category_type_id':category_type_id,
                    '_token': $('input[name="_token"]').val()
				},
                url: '{{route("updateCategoryType")}}',
                method: 'post',
                success: (res) => {
					alert('Category Type Updated');
                    window.location.href = '{{route("indexCategoryType")}}';
                }
            });          
		});
        
</script>
@endsection