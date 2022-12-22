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
                                                    <label class="form-label">Description:</label>
                                                    <input type="text" class="form-control description required" placeholder="Enter description" id="question_type_description" name="question_type_description" value="{{$getquestionDetails[0]->question_type_description}}">
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label class="form-label">Lesson:</label>
                                                    <input type="text" class="form-control lesson required" placeholder="Enter lesson" id="question_type_lesson" name="question_type_lesson" value="{{$getquestionDetails[0]->question_type_lesson}}">
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label class="form-label">Strategies:</label>
                                                    <input type="text" class="form-control strategies required" placeholder="Enter lesson" 
                                                    id="question_type_strategies" name="question_type_strategies" value="{{$getquestionDetails[0]->question_type_strategies}}">
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label class="form-label">Identification Methods:</label>
                                                    <input type="text" class="form-control strategies required" placeholder="Enter identification methods" 
                                                    id="question_type_identification_methods" name="question_type_identification_methods" value="{{$getquestionDetails[0]->question_type_identification_methods}}">
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label class="form-label">Identification Activity:</label>
                                                    <input type="text" class="form-control strategies required" placeholder="Enter identification activity" 
                                                    id="question_type_identification_activity" name="question_type_identification_activity" value="{{$getquestionDetails[0]->question_type_identification_activity}}">
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
    $('#storequestiontype').click(function() {
			var question_type_title = $('#question_type_title').val();
            var question_type_description = $('#question_type_description').val();
            var question_type_lesson = $('#question_type_lesson').val();
            var question_type_strategies = $('#question_type_strategies').val();

            var question_type_identification_methods = $('#question_type_identification_methods').val();
            var question_type_identification_activity = $('#question_type_identification_activity').val();
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