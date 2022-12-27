@extends('layouts.admin')

@section('title', 'Admin Dashboard : Questions Type')

@section('admin-content')
<main id="main-container">
    <form action="" method="POST">
        @csrf
        <div class="content content-boxed">
            <div class="row">
                <div class="col-xl-12">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Edit Question Type</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="container mt-5">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-md-12">
                                        <div class="tab" style="display: block;">
                                            <div class="row mb-4">
                                                <div class="col-md-12 mb-2">
                                                    <label class="form-label"></label>
                                                    <input type="hidden" class="form-control question_type_id required" id="question_type_id" name="question_type_id" value="{{$getquestionDetails[0]->id}}">
                                                 </div>
                                                <div class="col-md-12 mb-2">

                                                    <label class="form-label">Question Type Title:</label>
                                                    <input type="text" class="form-control question_type_title required" placeholder="Enter Question Type Title" id="question_type_title" name="question_type_title" value="{{$getquestionDetails[0]->question_type_title}}">

                                                    
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <!-- <label class="form-label">Description:</label>
                                                    <input type="text" class="form-control description required" placeholder="Enter description" id="question_type_description" name="question_type_description" value="{{$getquestionDetails[0]->question_type_description}}"> -->

                                                    <label for="question_type_description" class="form-label">Description:</label>
                                                    <textarea id="js-ckeditor-desc" name="question_type_description" class="form-control form-control-lg form-control-alt question_type_description"  name="question_type_description" placeholder="Description" >{{$getquestionDetails[0]->question_type_description}}</textarea>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <!-- <label class="form-label">Lesson:</label>
                                                    <input type="text" class="form-control lesson required" placeholder="Enter lesson" id="question_type_lesson" name="question_type_lesson" value="{{$getquestionDetails[0]->question_type_lesson}}"> -->

                                                    <label for="question_type_lesson" class="form-label">Lesson:</label>
                                                    <textarea id="js-ckeditor-lesson" name="question_type_lesson" class="form-control form-control-lg form-control-alt question_type_lesson" name="question_type_lesson" placeholder="Enter lesson" >{{$getquestionDetails[0]->question_type_lesson}}</textarea>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <!-- <label class="form-label">Strategies:</label>
                                                    <input type="text" class="form-control strategies required" placeholder="Enter lesson" 
                                                    id="question_type_strategies" name="question_type_strategies" value="{{$getquestionDetails[0]->question_type_strategies}}"> -->

                                                    <label for="question_type_strategies" class="form-label">Strategies:</label>
                                                    <textarea id="js-ckeditor-startegies" name="question_type_strategies" class="form-control form-control-lg form-control-alt question_type_strategies" name="question_type_strategies" placeholder="Enter Startegies" >{{$getquestionDetails[0]->question_type_strategies}}</textarea>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <!-- <label class="form-label">Identification Methods:</label>
                                                    <input type="text" class="form-control strategies required" placeholder="Enter identification methods" 
                                                    id="question_type_identification_methods" name="question_type_identification_methods" value="{{$getquestionDetails[0]->question_type_identification_methods}}"> -->

                                                    <label for="question_type_identification_methods" class="form-label">Identification Methods:</label>
                                                    <textarea id="js-ckeditor-methods" name="question_type_identification_methods" class="form-control form-control-lg form-control-alt question_type_identification_methods" name="question_type_identification_methods" placeholder="Enter identification methods" >{{$getquestionDetails[0]->question_type_identification_methods}}</textarea>


                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <!-- <label class="form-label">Identification Activity:</label>
                                                    <input type="text" class="form-control strategies required" placeholder="Enter identification activity" 
                                                    id="question_type_identification_activity" name="question_type_identification_activity" value="{{$getquestionDetails[0]->question_type_identification_activity}}"> -->

                                                    <label for="question_type_identification_activity" class="form-label">Identification Activity:</label>
                                                    <textarea id="js-ckeditor-activity" name="question_type_identification_activity" class="form-control form-control-lg form-control-alt question_type_identification_activity" name="question_type_identification_activity" placeholder="Enter identification activity" >{{$getquestionDetails[0]->question_type_identification_activity}}</textarea>
                                                </div>
                                             </div>
                                            </div>
                                        </div>
                                        <div style="overflow:auto;" id="nextprevious">
                                            <div style="float:right;"> 
                                                <a href="javascript:;" class="btn btn-sm btn-primary" id="storequestiontype" >Submit</a>
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
    $('#storequestiontype').click(function() {
			var question_type_title = $('#question_type_title').val();
            var question_type_description = CKEDITOR.instances['js-ckeditor-desc'].getData();
            var question_type_lesson = CKEDITOR.instances['js-ckeditor-lesson'].getData();
            var question_type_strategies = CKEDITOR.instances['js-ckeditor-startegies'].getData();
            var question_type_identification_methods = CKEDITOR.instances['js-ckeditor-methods'].getData();
            var question_type_identification_activity = CKEDITOR.instances['js-ckeditor-activity'].getData();

            var question_type_id = $('#question_type_id').val();

            $.ajax({
                data:{
					'question_type_title': question_type_title,
					'question_type_description': question_type_description,
					'question_type_lesson': question_type_lesson,
                    'question_type_strategies': question_type_strategies,
					'question_type_identification_methods': question_type_identification_methods,
					'question_type_identification_activity': question_type_identification_activity,
                    'question_type_id':question_type_id,
                    '_token': $('input[name="_token"]').val()
				},
                url: '{{route("updateQuestionType")}}',
                method: 'post',
                success: (res) => {
					alert('Question Type Updated');
                    window.location.href = '{{route("indexQuestionType")}}';
                }
            });          
		});
        
</script>
@endsection