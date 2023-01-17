@extends('layouts.admin')

@section('title', 'Admin Dashboard : Edit Practice Tests')
@section('page-style')

<style>

input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa
}

input.invalid {
    background-color: #ffdddd
}

.tab {
    display: none
}

button {
    background-color: #4CAF50;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer
}

button:hover {
    opacity: 0.8
}

#prevBtn {
    background-color: #bbbbbb
}

.step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5
}

.step.active {
    opacity: 1
}

.step.finish {
    background-color: #4CAF50
}

.all-steps {
    text-align: center;
    margin-top: 30px;
    margin-bottom: 30px
}
.sectionHeading{
    display: flex;
    width: 100%;
}
.sectionHeading li{
        /*display: flex;*/
    text-align: center;
    width: 19%;
    margin-right: 0px;
    list-style: none;
    font-size: 15px;
    font-weight: bold;
}
.sectionList{
    display: flex;
    width: 100%;
    /*box-shadow: rgb(0 0 0 / 50%) 0px 4px 15px;*/
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    padding: 10px 20px;
    line-height: 40px;
}
.sectionList li{
    /*display: flex;*/
    text-align: center;
    width: 20%;
    margin-right: 5px;
    list-style: none;
    font-size: 15px;
}
.sectionListtype{
    width: 100%;
    display: flex;
    border: 1px solid #ccc;
    padding: 10px 14px;
}
.sectionListtype li{
    display: flex;
    width: 30%;
    margin-right: 15px;
    list-style: none;
    font-size: 15px;
}
.sectionTypesFull{
    padding: 20px;
    /*box-shadow: rgb(0 0 0 / 50%) 0px 4px 30px;*/
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    margin-bottom: 18px;
}
.switchMulti{
	color: #000;
    background: #ccc;
    border: 1px solid #ccc;
    border-radius: 4px;
    text-decoration: none;
    margin-right: 16px;
    padding: 5px 8px;
} 
.btn-alt-secondary{
	height: 30px;
margin-right: 10px;
}
.extraFillOption{
    width: 100%;
    margin: 10px 0px;
}
.extraFillOption input{
    width: 100%;
    margin: 10px 0px;
}
.editExtraFillOption{
    width: 100%;
    margin: 10px 0px;
}
.editExtraFillOption input{
    width: 100%;
    margin: 10px 0px;
}
.switchMulti{
    color: #000;
    background: #ccc;
    border: 1px solid #ccc;
    border-radius: 4px;
    text-decoration: none;
    margin-right: 16px;
    padding: 5px 8px;
}
.extraFillOption{
    width: 100%;
    margin: 10px 0px;
}
.extraFillOption input{
    width: 100%;
    margin: 10px 0px;
}
ul.answerOptionLsit{
    width: 100%;
    padding: 0px;
}
ul.answerOptionLsit li{
    width: 100%;
    list-style: none;
    padding-top: 14px;
}
ul.answerOptionLsit li label{
    width: 100%;
    display: flex;
    margin-bottom: 10px;
}
ul.answerOptionLsit li label span{
    font-size: 15px;
}
ul.answerOptionLsit li label input{
    width: auto !important;
    margin-left: 10px;
}
.tagDelete{
    position: relative;
    left: 0px;
    background: #4c78dd;
    color: #fff;
    padding: 3px 7px;
    border-radius: 100%;
}
.partTestOrder{
    display: flex;
}
.part_order {
  width: 31%;
  display: flex;
  margin-left: 20px;
}
.list-group-item button p{
    padding: 0px;
    margin: 0px;
}
</style>
@endsection
@section('admin-content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <form action="{{route('practicetests.update', $practicetests->id)}}" method="POST" id="regForm">
        @method('PUT')
        @csrf
		<input type="hidden" name="id" value="{{$practicetests->id}}">
        <div class="content content-boxed">
            <!-- Dynamic Table Full -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Edit Practice Tests</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <!----------------->
							
							<div class="container mt-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-12">
                <div class="all-steps" id="all-steps" style="display: none;"> <span class="step"></span> <span class="step"></span> <span class="step"></span> <span class="step"></span> </div>
                <div class="tab">
                    <div class="row mb-4">
						<div class="col-md-12 mb-2">
							<label class="form-label">Name:</label>
							<input type="text" class="form-control test_title required" placeholder="Enter practice test name" name="title" value="{{$practicetests->title}}"/>
						</div>
						<div class="col-md-12">
							<label class="form-label">Test Type:</label>
							<input type="text" value="{{$practicetests->format}}" readonly style="opacity: 0.4;" class="required">
							<!--<select id="format" name="format" class="form-control">
								@foreach($testformats as $key=>$testformat)
								<option value="{{$key}}" {{$practicetests->format == $key ? 'selected': '';}}>{{$testformat}}</option>
								@endforeach
							</select>-->
						</div>
					</div>
                </div>
                <div class="tab">
                    <div class="mb-2 mb-4">
						<label for="description" class="form-label">Description:</label>
						<textarea id="js-ckeditor-desc" name="description" class="form-control form-control-lg form-control-alt" id="description" name="description" placeholder="Description" >{{$practicetests->description}}</textarea>
						@error('description')
							<div class="invalid-feedback">{{$message}}</div>
						@enderror
					</div>
                    <!-- <div class="mb-2 mb-4">
						<label for="category_type" class="form-label">Category type:</label>
                        <input type="text" value="{{$practicetests->category_type}}" name="category_type" id="category_type" placeholder="Category Type" class="form-control form-control-lg form-control-alt" >
					</div> -->

					<div class="sectionContainerList">	
                    <input type="hidden" name="sectionAddId" id="sectionAddId" value="0">				
					@foreach($testsections as $key=>$testsection)	
                    		
					<div class="sectionTypesFull" id="sectionDisplay_{{ $testsection->id }}" >
					<div class="mb-2 mb-4">
						<div class="sectionTypesFullMutli"> </div> 
						<div class="sectionTypesFullMutli firstRecord">
							<ul class="sectionListtype">
								<li>Type: &nbsp;<strong>{{ $testsection->format }}</strong></li>
								<li>Section Type:&nbsp;<span class="answerOption"><strong>{{ $testsection->practice_test_type }}</strong>
								<input type="hidden" name="selectedSecTxt" value="{{ $testsection->practice_test_type }}" class="selectedSecTxt" >
                                <input type="hidden" name="selectedQuesType" value="{{ $testsection->practice_test_type }}" class="selectedQuesType" >
                                </span>
								</li>
                                <li>Order: &nbsp;<input type="number" readonly class="form-control" name="section_order" value="{{ $testsection->section_order }}" id="order_{{ $testsection->id }}"/><button type="button" class="input-group-text" id="basic-addon2" onclick="openOrderDialog({{$testsection->id}})"><i class="fa-solid fa-check"></i></button></li>
                                <!--<li>Order: &nbsp;
                                    <select name="sectionOrder" class="sectionOrder">
                                        <option value="">Select</option>
                                        @php for($j=1;$j<=count($testsections); $j++){ @endphp
                                        <option value="@php echo $j; @endphp" @php if($testsection->section_order == $j){ echo 'selected="selected"';} @endphp>@php echo $j; @endphp </option>
                                        @php } @endphp
                                    </select>
                                </li>-->
							</ul>
							<ul class="sectionHeading">
								<li>Question</li>
								<li>Answer</li> 
								<li>Passage</li>
								<li>Passage Number</li>
								<li>Fill Answer</li>
                                <li>Order</li>
								<li>Action</li>
							</ul>
							@foreach($testsection->getPracticeQuestions as $practQuestion)
                            <ul class="sectionList singleQuest_{{ $practQuestion->id }}">
								<li>{!! $practQuestion->title !!}</li>
								<li>{{ $practQuestion->answer }}</li>
								<li>{{ $practQuestion->getpassage->title }}</li>
								<li>{{ $practQuestion->passage_number  }}</li>
								<li>{{ $practQuestion->fill  }}</li>
                                <li class="orderValUpdate_{{ $practQuestion->id }}">{{ $practQuestion->question_order  }}</li>
								<li>
                                    <button type="button"
                                            class="btn btn-sm btn-alt-secondary edit-section"
                                            data-id="{{$practQuestion->id}}"
                                            data-bs-toggle="tooltip"
                                            title="Edit Section"
                                            onclick="practQuestioEdit({{ $practQuestion->id }})"
                                    >
                                       <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button>
                                    <button type="button"
                                            class="btn btn-sm btn-alt-secondary delete-section"
                                            data-id="{{$practQuestion->id}}"
                                            data-bs-toggle="tooltip"
                                            title="Delete Section"
                                            onclick="practQuestioDel({{ $practQuestion->id }})"
                                    >
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
								</li>
							</ul>
							@endforeach
						</div>
					</div>
					<div class="mb-2 mb-4  partTestOrder" style="display:none;">

                        <button type="button"  data-id="{{ $testsection->id }}" class="btn w-25 btn-alt-success add_question_modal_multi"><i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Question</button>
                        <div class="part_order">
                            <input type="number" readonly class="form-control" name="section_order" value="{{ $testsection->section_order }}" id="order_{{ $testsection->id }}"/><button type="button" class="input-group-text" id="basic-addon2" onclick="openOrderQuesDialog({{$testsection->id}})"><i class="fa-solid fa-check"></i></button>
                        </div>

                    </div>				
					</div>
					@endforeach                        
                    </div>
                    <div class="col-md-12 col-xl-12 mb-4" style="display:none;">
                        <button type="button" data-id="0" class="btn w-25 btn-alt-success add_section_modal_btn">
                            <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Practice Test Section
                        </button>
                    </div>  
					<!--<div class="col-md-12 col-xl-12 mb-4">
						<button type="button" class="btn w-25 btn-alt-success add_question_modal_btn">
							<i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Question
						</button>
					</div>-->
					<div class="col-md-6">
						<ul class="list-group">
                        @foreach($testQuestions as $key => $question)
							<li class="list-group-item question_{{$question->id}}"><span style="width: 84%; float: left;">Question {{($key+1)}}</span> <span style="width: 15%; float: right;"><i class="fa fa-fw fa-pencil-alt edit_question" data-id="{{$question->id}}" style="margin-right: 4px;"></i><i class="fa fa-fw fa-times delete_question" data-id="{{$question->id}}"></i></span></li>
						@endforeach
						</ul>
					</div>
                </div>
                <div style="overflow:auto;" id="nextprevious">
                    <div style="float:right;"> <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button> <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button> </div>
                </div>
        </div>
    </div>
</div>
                            <!----------------->
							
                        </div>
                    </div>
                </div>
             </div>
         </div>
    </form>
</main>

<!-- END Main Container -->
<div class="modal fade" id="questionModal"

     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Update Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
				<div class="row">
					<div class="mb-2">
						<label class="form-label" style="font-size: 13px;">Question Type:</label>
						<select id="format" name="format" class="form-control">
							@foreach($questionformats as $key=>$questionformat)
							<option value="{{$key}}" {{$practicetests->questionformat == $key ? 'selected': '';}}>{{$questionformat}}</option>
							@endforeach
						</select>
					</div>
					<div class="mb-2">
						<label class="form-label" style="font-size: 13px;">Update question to:</label>
						<select id="practicetestid" name="testid" class="form-control">
							@foreach($tests as $key=>$test)
							<option value="{{$test->id}}" {{$practicetests->questionformat == $test->id ? 'selected': '';}}>{{$test->title}}</option>
							@endforeach
						</select>
					</div>
					<div class="mb-2 mb-4">
						<label for="description" class="form-label" style="font-size: 13px;">Description:</label>
						<textarea id="js-ckeditor-que-desc" name="description" class="form-control form-control-lg form-control-alt" id="description" name="description" placeholder="Description" >{{$practicetests->questiondescription}}</textarea>
					</div>
				</div>
            </div>
            <div class="modal-footer">
				<input type="hidden" class="question_id" value="" />
                <button type="button" class="btn btn-primary save_question">Save changes</button>
                <button type="button" class="btn btn-primary update_question">Update changes</button>
            </div>
        </div>
    </div>
</div>

<!--start section Modal -->
<div class="modal fade" id="sectionModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Add Practice Test Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-2">
                        <label class="form-label validError" style="font-size: 13px; color: red;"></label>
                    </div>
                    <div class="mb-2">
                        <label class="form-label" style="font-size: 13px;">Practice Test Section Type:</label>
                        <select id="testSectionType" name="testSectionType" class="form-control">
                            
                        </select>
                    </div>                    
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="whichModel" value="section" class="whichModel">
                <input type="hidden" name="currentModelId" value="0" id="currentModelId">
                <button type="button" class="btn btn-primary save_section">Save changes</button>
            </div>
        </div>        
    </div>
</div>
<!-- Modal -->

<div class="modal fade" id="questionMultiModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Update Question</h5>
                <input type="hidden" name="quesFormat" id="quesFormat">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-2">
                        <label class="form-label validError" style="font-size: 13px; color: red;"></label>
                    </div>
                    <div class="mb-2">
                        <label class="form-label" style="font-size: 13px;">Practice Test Section Type:</label>
                        <input id="testSectionTypeRead" readonly name="testSectionTypeRead" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" style="font-size: 13px;">Question:</label>
                        <textarea id="js-ckeditor-addQue" name="js-ckeditor-addQue" class="form-control form-control-lg form-control-alt addQuestion" placeholder="update Question" ></textarea>
						
                    </div>

                    <div class="mb-2">
                        <label class="form-label" for="tags">Question Tags</label>
                        <input type="text" maxlength="30"
                            id="tag"
                            placeholder="add tag" class="form-control" onkeypress="addTag(event)"/>

                        <div class="row items-push mt-2 tag-div">                                  
                            
                        </div>
                    </div>
                    
                    <?php if (!$testQuestions->isEmpty()) { ?>
                    <div class="mb-2 mb-4"> 
                        <label for="new_question_type_select">Question type:</label>
                        <select class="form-control form-control-lg form-control-alt"  name="new_question_type_select" id="new_question_type_select">
                            <option value="">Select Question Type</option>

                            @foreach($getQuestionTypes as $singleQuestionTypes)
                            <option value="{{$singleQuestionTypes->id}}" {{$testQuestions[0]->question_type_id == $singleQuestionTypes->id ? 'selected': '';}}>{{$singleQuestionTypes->question_type_title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <?php } ?>

                    <div class="mb-2 mb-4">
						<label for="category_type" class="form-label">Category type:</label>
                        <input type="text" value="" name="category_type" id="category_type" placeholder="Category Type" class="form-control form-control-lg form-control-alt" >
					</div>
                    

					<div class="mb-2">
                        <label class="form-label" style="font-size: 13px;">Passages:</label>
						<select name="passagesType" class="form-control passagesType">
                            <option value="">Select Passages</option>
                            
                        </select>
                    </div>
                    
                    <div class="mb-2">
                        <label class="form-label" style="font-size: 13px;">Passage Number:</label>
                        <select class="passNumber">
                            <option value="">Select Passages Number</option>
                            @for($i=1;$i<25;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <input type="hidden" name="editSelectedAnswerType" id="editSelectedAnswerType">
                    <div class="mb-2" id="selectedLayoutQuestion">
                       
                        <div class="choiceOneInFour"><input type="hidden" name="questionType" id="questionType" value="choiceOneInFour">
                            <ul class="answerOptionLsit">
                                <li>
                                    <label class="form-label" style="font-size: 13px;"><span>A: </span><input type="radio" value="a" name="choiceOneInFour"></label><textarea id="editChoiceOneInFourAnswer_1" name="editChoiceOneInFourAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea></li>
                                <li><label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="choiceOneInFour"></label><textarea id="editChoiceOneInFourAnswer_2" name="editChoiceOneInFourAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li><label class="form-label" style="font-size: 13px;"><span>C:</span><input type="radio"  value="c" name="choiceOneInFour"></label><textarea id="editChoiceOneInFourAnswer_3" name="editChoiceOneInFourAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label" style="font-size: 13px;"><span>D: </span>
                                        <input type="radio"  value="d" name="choiceOneInFour">
                                    </label>
                                    <textarea id="editChoiceOneInFourAnswer_4" name="editChoiceOneInFourAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                            </ul>
                        </div>
                    
                        <div class="choiceOneInFive"><input type="hidden" name="questionType" id="questionType" value="choiceOneInFive">
                            <ul class="answerOptionLsit">
                                <li>
                                    <label class="form-label" style="font-size: 13px;"><span>A: </span><input type="radio" value="a" name="choiceOneInFive"></label><textarea id="editChoiceOneInFiveAnswer_1" name="editChoiceOneInFiveAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea></li>
                                <li><label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="choiceOneInFive"></label><textarea id="editChoiceOneInFiveAnswer_2" name="editChoiceOneInFiveAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li><label class="form-label" style="font-size: 13px;"><span>C:</span><input type="radio"  value="c" name="choiceOneInFive"></label><textarea id="editChoiceOneInFiveAnswer_3" name="editChoiceOneInFiveAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li><label class="form-label" style="font-size: 13px;"><span>D: </span><input type="radio"  value="d" name="choiceOneInFive"><textarea id="editChoiceOneInFiveAnswer_4" name="editChoiceOneInFiveAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label" style="font-size: 13px;"><span>E: </span>
                                    <input type="radio"  value="e" name="choiceOneInFive">
                                    </label>
                                    <textarea id="editChoiceOneInFiveAnswer_5" name="editChoiceOneInFiveAnswer_5" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                            </ul>
                        </div>

                        <div class="choiceOneInFourPass">
                            <input type="hidden" name="addQuestionType" id="questionType" value="choiceOneInFourPass">
                            <ul class="answerOptionLsit">
                                <li><label class="form-label" style="font-size: 13px;"><span>A: </span><input type="radio" value="a" name="choiceOneInFourPass"></label><textarea id="editChoiceOneInFourPassAnswer_1" name="editChoiceOneInFourPassAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li><label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="choiceOneInFourPass"></label><textarea id="editChoiceOneInFourPassAnswer_2" name="editChoiceOneInFourPassAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label" style="font-size: 13px;"><span>C: </span><input type="radio"  value="c" name="choiceOneInFourPass"></label><textarea id="editChoiceOneInFourPassAnswer_3" name="editChoiceOneInFourPassAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label" style="font-size: 13px;"><span>D: </span><input type="radio"  value="d" name="choiceOneInFourPass"></label><textarea id="editChoiceOneInFourPassAnswer_4" name="editChoiceOneInFourPassAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                            </ul>
                        </div>

                        <div class="choiceMultInFourFill">
                            <input type="hidden" name="questionType" id="questionType" value="choiceMultInFourFill">
                            
                            <label class="form-label" style="font-size: 13px;">
                                <select class="switchMulti editMultipleChoice" onChange="editMultiChoice(this.value);">
                                    <option value="1">Multi-Choice</option>
                                    <option value="3">Multiple Choice</option>
                                    <option value="2">Fill Choice</option>
                                </select>
                                <!--<a href="javascript:;" onClick="editMultiChoice(1);" class="switchMulti">Multi Choice</a>
                            </label>
                            <label class="form-label" style="font-size: 13px;">
                                <a href="javascript:;" onClick="editMultiChoice(2);" class="switchMulti">Fill Choice</a>-->
                            </label>

                            <div class="multi_field withOutFillOpt">
                                <ul class="answerOptionLsit">
                                    <li><label class="form-label" style="font-size: 13px;"><span>A: </span> <input type="checkbox" value="a" name="choiceMultInFourFill[]"></label><textarea id="editChoiceMultInFourFillAnswer_1" name="editChoiceMultInFourFillAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li><li><label class="form-label" style="font-size: 13px;"><span>B: </span><input type="checkbox"  value="b" name="choiceMultInFourFill[]"></label><textarea id="editChoiceMultInFourFillAnswer_2" name="editChoiceMultInFourFillAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea></li><li><label class="form-label" style="font-size: 13px;"><span>C: </span><input type="checkbox"  value="c" name="choiceMultInFourFill[]"></label><textarea id="editChoiceMultInFourFillAnswer_3" name="editChoiceMultInFourFillAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li><li><label class="form-label" style="font-size: 13px;"><span>D:</span><input type="checkbox"  value="d" name="choiceMultInFourFill[]"></label><textarea id="editChoiceMultInFourFillAnswer_4" name="editChoiceMultInFourFillAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li>
                                </ul>  
                            </div>
                            
                            <div class="multiChoice_field withOutFillOptChoice" style="display:none">
                                <ul class="answerOptionLsit"><li><label class="form-label" style="font-size: 13px;"><span>A: </span> <input type="radio" value="a" name="editChoiceMultiChoiceInFourFill"></label><textarea id="editChoiceMultiChoiceInFourFill_1" name="editChoiceMultiChoiceInFourFill_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li><li><label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="editChoiceMultiChoiceInFourFill"></label><textarea id="editChoiceMultiChoiceInFourFill_2" name="editChoiceMultiChoiceInFourFill_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea></li><li><label class="form-label" style="font-size: 13px;"><span>C: </span><input type="radio"  value="c" name="editChoiceMultiChoiceInFourFill"></label><textarea id="editChoiceMultiChoiceInFourFill_3" name="editChoiceMultiChoiceInFourFill_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li><li><label class="form-label" style="font-size: 13px;"><span>D:</span><input type="radio"  value="d" name="editChoiceMultiChoiceInFourFill"></label><textarea id="editChoiceMultiChoiceInFourFill_4" name="editChoiceMultiChoiceInFourFill_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li>
                                </ul> 
                            </div>
                            <div class="fill_field withFillOpt " style="display:none">
                                <div class="mb-2">
                                    <label class="form-label" style="font-size: 13px;">Fill Type:</label><select name="addChoiceMultInFourFill_filltype"  class="form-control addChoiceMultInFourFill_filltype"><option value="">Select Type</option><option value="number">Number</option><option value="decimal">Decimal</option><option value="fraction">Fraction</option></select></div><div class="mb-2"><label class="form-label" style="font-size: 13px;">Fill:</label><input type="text" name="addChoiceMultInFourFill_fill[]"><label class="form-label extraFillOption" style="font-size: 13px;"></label><label class="form-label" style="font-size: 13px;"><a href="javascript:;" onClick="addMoreFillOption();" class="switchMulti">Add More Options</a></label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="currentModelQueId" value="0" id="currentModelQueId">
                <input type="hidden" name="sectionAddId" value="0" class="sectionAddId">
                <button type="button" class="btn btn-primary update_question_section">Update changes</button>
            </div>
        </div>        
    </div>
</div>
<!-- Modal -->

<!-- start multiple question -->

<div class="modal fade" id="addQuestionMultiModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Add Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-2">
                        <label class="form-label validError" style="font-size: 13px; color: red;"></label>
                    </div>
                    <div class="mb-2">
                        <label class="form-label" style="font-size: 13px;">Practice Test Section Type:</label>
                        <input id="addTestSectionTypeRead" readonly name="addTestSectionTypeRead" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" style="font-size: 13px;">Question:</label>
                        <textarea id="js-ckeditor-add-addQue" name="js-ckeditor-add-addQue" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                        
                    </div>

                    <div class="mb-2">
                        <label class="form-label" for="addTag">Question Tags</label>
                        <input type="text" maxlength="30"
                            id="addTag"
                            placeholder="add tag" class="form-control" onkeypress="addTagFunc(event)"/>

                        <div class="row items-push mt-2 add-tag-div">                                  
                           
                        </div>
                    </div>

                    <div class="mb-2 mb-4"> 
                        <label for="new_question_type_select">Question type:</label>
                        <select class="form-control form-control-lg form-control-alt"  name="new_question_type_select" id="new_question_type_select">
                            <option value="">Select Question Type</option>
                            @foreach($getQuestionTypes as $singleQuestionTypes)
                            <option value="{{$singleQuestionTypes->id}}">{{$singleQuestionTypes->question_type_title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size: 13px;">Passages:</label>
                        <select name="addPassagesType" class="form-control addPassagesType">
                            <option value="">Select Passages</option>
                            
                        </select>
                    </div>
                    <input type="hidden" name="addPassages" class="addPassages">
                    <!--<div class="mb-2">
                        <label class="form-label" style="font-size: 13px;">Passages Description:</label>
                        <textarea id="js-ckeditor-passquestion" name="js-ckeditor-passquestion"" class="form-control form-control-lg form-control-alt passages " placeholder="Passages" ></textarea>
                        <select name="passages" class="form-control passages">
                            <option value="">Select Passages</option>
                            @foreach($passages as $key=>$passage)
                            <option value="{{$passage->id}}">{{$passage->title}}</option>
                            @endforeach
                        </select>
                    </div>-->
                    
                    <div class="mb-2">
                        <label class="form-label" style="font-size: 13px;">Passage Number:</label>
                        <select class="addPassNumber">
                            <option value="">Select Passages Number</option>
                            @for($i=1;$i<25;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <input type="hidden" name="selectedAnswerType" id="selectedAnswerType">
                    <div class="mb-2" id="addSelectedLayoutQuestion">
                       <div class="addchoiceOneInFour"><input type="hidden" name="addQuestionType" id="addQuestionType" value="choiceOneInFour">
                        <ul class="answerOptionLsit">
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>A: </span><input type="radio" value="a" name="addChoiceOneInFour"></label>
                                <textarea id="choiceOneInFourAnswer_1" name="choiceOneInFourAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li><label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="addChoiceOneInFour"></label><textarea id="choiceOneInFourAnswer_2" name="choiceOneInFourAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>C:</span>
                                    <input type="radio"  value="c" name="addChoiceOneInFour">
                                </label>
                                <textarea id="choiceOneInFourAnswer_3" name="choiceOneInFourAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>D: </span>
                                    <input type="radio"  value="d" name="addChoiceOneInFour">
                                </label>    
                                <textarea id="choiceOneInFourAnswer_4" name="choiceOneInFourAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                        </ul>
                    </div>

                    <div class="addchoiceOneInFive"><input type="hidden" name="addQuestionType" id="addQuestionType" value="choiceOneInFour">
                        <ul class="answerOptionLsit">
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>A: </span><input type="radio" value="a" name="addChoiceOneInFive"></label><textarea id="choiceOneInFiveAnswer_1" name="choiceOneInFiveAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea></li>
                            <li><label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="addChoiceOneInFive"></label><textarea id="choiceOneInFiveAnswer_2" name="choiceOneInFiveAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li><label class="form-label" style="font-size: 13px;"><span>C:</span><input type="radio"  value="c" name="addChoiceOneInFive"></label><textarea id="choiceOneInFiveAnswer_3" name="choiceOneInFiveAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li><label class="form-label" style="font-size: 13px;"><span>D: </span><input type="radio"  value="d" name="addChoiceOneInFive"><textarea id="choiceOneInFiveAnswer_4" name="choiceOneInFiveAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>E: </span><input type="radio"  value="e" name="addChoiceOneInFive">
                                </label>    
                                <textarea id="choiceOneInFiveAnswer_5" name="choiceOneInFiveAnswer_5" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                        </ul>
                    </div>

                    <div class="addchoiceOneInFourPass">
                        <input type="hidden" name="addQuestionType" id="addQuestionType" value="choiceOneInFourPass">
                        <ul class="answerOptionLsit">
                            <li><label class="form-label" style="font-size: 13px;"><span>A: </span><input type="radio" value="a" name="addChoiceOneInFourPass"></label><textarea id="choiceOneInFourPassAnswer_1" name="choiceOneInFourPassAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                            </li>
                            <li><label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="addChoiceOneInFourPass"></label><textarea id="choiceOneInFourPassAnswer_2" name="choiceOneInFourPassAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                            </li>
                            <li><label class="form-label" style="font-size: 13px;"><span>C: </span><input type="radio"  value="c" name="addChoiceOneInFourPass"></label><textarea id="choiceOneInFourPassAnswer_3" name="choiceOneInFourPassAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li><li><label class="form-label" style="font-size: 13px;"><span>D: </span><input type="radio"  value="d" name="addChoiceOneInFourPass"></label><textarea id="choiceOneInFourPassAnswer_4" name="choiceOneInFourPassAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li>
                        </ul>
                    </div>

                    <div class="addchoiceMultInFourFill">
                        <input type="hidden" name="addQuestionType" id="addQuestionType" value="choiceMultInFourFill">
                        <label class="form-label" style="font-size: 13px;">
                            <select class="switchMulti addMultiChoice" onChange="addMultiChoice(this.value);">
                                    <option value="1">Multi-Choice</option>
                                    <option value="3">Multiple Choice</option>
                                    <option value="2">Fill Choice</option>
                                </select>
                            <!--<a href="javascript:;" onClick="addMultiChoice(1);" class="switchMulti">Multi Choice</a>
                        </label>
                        <label class="form-label" style="font-size: 13px;">
                            <a href="javascript:;" onClick="addMultiChoice(2);" class="switchMulti">Fill Choice</a>-->
                        </label>
                        <div class="multi_field">
                        <ul class="answerOptionLsit"><li><label class="form-label" style="font-size: 13px;"><span>A: </span> <input type="checkbox" value="a" name="addChoiceMultInFourFill[]"></label><textarea id="choiceMultInFourFillAnswer_1" name="choiceMultInFourFillAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li><li><label class="form-label" style="font-size: 13px;"><span>B: </span><input type="checkbox"  value="b" name="addChoiceMultInFourFill[]"></label><textarea id="choiceMultInFourFillAnswer_2" name="choiceMultInFourFillAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea></li><li><label class="form-label" style="font-size: 13px;"><span>C: </span><input type="checkbox"  value="c" name="addChoiceMultInFourFill[]"></label><textarea id="choiceMultInFourFillAnswer_3" name="choiceMultInFourFillAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li><li><label class="form-label" style="font-size: 13px;"><span>D:</span><input type="checkbox"  value="d" name="addChoiceMultInFourFill[]"></label><textarea id="choiceMultInFourFillAnswer_4" name="choiceMultInFourFillAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li></ul>    

                        </div>
                        <div class="multiChoice_field" style="display:none">
                            <ul class="answerOptionLsit"><li><label class="form-label" style="font-size: 13px;"><span>A: </span> <input type="radio" value="a" name="addChoiceMultiChoiceInFourFill"></label><textarea id="addChoiceMultiChoiceInFourFill_1" name="addChoiceMultiChoiceInFourFill_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li><li><label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="addChoiceMultiChoiceInFourFill"></label><textarea id="addChoiceMultiChoiceInFourFill_2" name="addChoiceMultiChoiceInFourFill_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea></li><li><label class="form-label" style="font-size: 13px;"><span>C: </span><input type="radio"  value="c" name="addChoiceMultiChoiceInFourFill"></label><textarea id="addChoiceMultiChoiceInFourFill_3" name="addChoiceMultiChoiceInFourFill_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li><li><label class="form-label" style="font-size: 13px;"><span>D:</span><input type="radio"  value="d" name="addChoiceMultiChoiceInFourFill"></label><textarea id="addChoiceMultiChoiceInFourFill_4" name="addChoiceMultiChoiceInFourFill_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li>
                            </ul> 
                        </div>
                        <div class="fill_field" style="display:none">
                            <div class="mb-2"><label class="form-label" style="font-size: 13px;">Fill Type:</label><select name="addChoiceMultInFourFill_filltype"  class="form-control addChoiceMultInFourFill_filltype"><option value="">Select Type</option><option value="number">Number</option><option value="decimal">Decimal</option><option value="fraction">Fraction</option></select></div><div class="mb-2"><label class="form-label" style="font-size: 13px;">Fill:</label><input type="text" name="addChoiceMultInFourFill_fill[]"><label class="form-label extraFillOption" style="font-size: 13px;"></label><label class="form-label" style="font-size: 13px;"><a href="javascript:;" onClick="addMoreFillOption();" class="switchMulti">Add More Options</a></label></div></div>
                    </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="addSectionAddId" value="0" class="addSectionAddId">
                <input type="hidden" name="addWhichModel" value="question" class="addWhichModel">
                <input type="hidden" name="addCurrentModelQueId" value="0" id="addCurrentModelQueId">
                <button type="button" class="btn btn-primary save_section">Save changes</button>
            </div>
        </div>        
    </div>
</div>
<div class="modal fade" id="dragModal"

     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Section list Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="listWithHandle" class="list-group">
                    @foreach($testsections as $key=>$testsection)
                        <div class="list-group-item">
                            <span class="glyphicon glyphicon-move" aria-hidden="true">
                            <i class="fa-solid fa-grip-vertical"></i>
                            </span>
                            <button class="btn btn-primary" value="{{ $testsection->id }}">{{ $testsection->id }} :- {{ $testsection->format }} {{ $testsection->practice_test_type }}</button>
                        </div>
                    @endforeach   
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveOrder()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<div class="modal fade" id="dragModalQuestion"

     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Question list Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="listWithHandleQuestion" class="list-group">
                    @foreach($testsections as $key=>$testsection)
                        @foreach($testsection->getPracticeQuestions as $practQuestion)
                            <div class="list-group-item sectionsaprat_{{ $testsection->id }} quesBasedSecList questionaprat_{{ $practQuestion->id }}" data-id="{{ $practQuestion->id }}" style="display:none;">
                                <span class="glyphicon glyphicon-move" aria-hidden="true">
                                <i class="fa-solid fa-grip-vertical"></i>
                                </span>
                                <button class="btn btn-primary" value="{{ $practQuestion->id }}">{!! $practQuestion->title !!}</button>
                            </div>
                        @endforeach                    
                    @endforeach 
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="questionModal()">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('admin-script')

    <script src="{{asset('assets/js/plugins/ckeditor/ckeditor.js')}}"></script>

    <script src="{{asset('assets/js/plugins/Sortable.js')}}"></script>
<script>
    var myModal = new bootstrap.Modal(document.getElementById('dragModal'), {
            keyboard: false
        });
    var myQuestionModal = new bootstrap.Modal(document.getElementById('dragModalQuestion'), {
            keyboard: false
        });

		let ckeditorFull = document.querySelector('#js-ckeditor-desc:not(.js-ckeditor-enabled)');
		var allowedContent = true;
		CKEDITOR.replace( 'js-ckeditor-desc',{
			extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
			allowedContent
		});
		ckeditorFull.classList.add('js-ckeditor-enabled');
		CKEDITOR.replace( 'js-ckeditor-que-desc',{
			extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
			allowedContent
		});
        CKEDITOR.replace( 'js-ckeditor-addQue',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'js-ckeditor-add-addQue',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
		$('.add_question_modal_btn').click(function() {
			$('.save_question').show();
			$('#questionModal').modal('show');
		});
		
        CKEDITOR.replace( 'choiceOneInFourAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFourAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFourAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFourAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        
        CKEDITOR.replace( 'choiceOneInFiveAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFiveAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFiveAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFiveAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFiveAnswer_5',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });


        CKEDITOR.replace( 'choiceOneInFourPassAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFourPassAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFourPassAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFourPassAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        CKEDITOR.replace( 'choiceMultInFourFillAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceMultInFourFillAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceMultInFourFillAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceMultInFourFillAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        CKEDITOR.replace( 'editChoiceOneInFourAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFourAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFourAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFourAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        
        CKEDITOR.replace( 'editChoiceOneInFiveAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFiveAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFiveAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFiveAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFiveAnswer_5',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });


        CKEDITOR.replace( 'editChoiceOneInFourPassAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFourPassAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFourPassAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFourPassAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        CKEDITOR.replace( 'editChoiceMultInFourFillAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceMultInFourFillAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceMultInFourFillAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceMultInFourFillAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        CKEDITOR.replace( 'addChoiceMultiChoiceInFourFill_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'addChoiceMultiChoiceInFourFill_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'addChoiceMultiChoiceInFourFill_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'addChoiceMultiChoiceInFourFill_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        CKEDITOR.replace( 'editChoiceMultiChoiceInFourFill_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceMultiChoiceInFourFill_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceMultiChoiceInFourFill_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceMultiChoiceInFourFill_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        /**for edit*/

		/*$('.delete_question').click(function() {
			var result = confirm('Are you sure to remove ?');
			if(!result) {
				return false;
			}
			var id = $(this).data('id');
			$.ajax({
                 data:{
					'id': id,
					'_token': $('input[name="_token"]').val()
				},
                url: '{{route("deletePracticeQuestionById")}}',
                method: 'post',
                success: (res) => {
					$('.question_'+id).remove();
                }
            });
		});*/

        jQuery(document).on('change', '.sectionOrder', function(){
            var section_id = $('.add_question_modal_multi').attr("data-id"); 
            var order_num = $(this).val(); 
            if(order_num =='' && order_num<1){
                order_num = 1;
            }
            $.ajax({
                data:{
                    'section_order': order_num,
                    'section_id': section_id,
                    '_token': $('input[name="_token"]').val()
                },
                url: '{{route("sectionOrder")}}',
                method: 'post',
                success: (res) => {
                   console.log(res);
                }
            });
        });
		
		$('.edit_question').click(function() {
			var id = $(this).data('id');
			$.ajax({
                data:{
					'id': id,
					'_token': $('input[name="_token"]').val()
				},
                url: '{{route("getPracticeQuestionById")}}',
                method: 'post',
                success: (res) => {
					console.log(res['description']);
					var id = $('.question_id').val(res['id']);
					var formate = res['format'];
					var testid = res['testid'];
					
					$('#format option[value="'+formate+'"]').attr("selected", "selected");
					$('#practicetestid option[value="'+testid+'"]').attr("selected", "selected");
					CKEDITOR.instances['js-ckeditor-que-desc'].setData(res['description']);
					$('#questionModal').modal('show');
                }
            });
		});
		
		$('.save_question').click(function() {
			var format = $('#format').val();
			var practicetestid = $('#practicetestid').val();
			var description = CKEDITOR.instances['js-ckeditor-que-desc'].getData();
			$.ajax({
                data:{
					'format': format,
					'practicetestid': practicetestid,
					'description': description,
					'_token': $('input[name="_token"]').val()
				},
                url: '{{route("addPracticeQuestion")}}',
                method: 'post',
                success: (res) => {
					alert('Question Added');
                }
            });
		});
		/*$('.update_question').click(function() {
			var id = $('.question_id').val();
			var format = $('#format').val();
			var practicetestid = $('#practicetestid').val();
			var description = CKEDITOR.instances['js-ckeditor-que-desc'].getData();
			$.ajax({
                data:{
					'id': id,
					'format': format,
					'practicetestid': practicetestid,
					'description': description,
					'_token': $('input[name="_token"]').val()
				},
                url: '{{route("updatePracticeQuestion")}}',
                method: 'post',
                success: (res) => {
					alert('Question Updated');
                }
            });
		});*/

		$('.update_question_section').click(function() {

            $('.sectionTypesFull').show();
            var currentModelQueId = $('#currentModelQueId').val();
            var format = $('#quesFormat').val();
            var fill = 'N/A';
            var fillType = 'N/A';
            var answerType ='N/A';
            var fillVals =[];
            var multiChoice = '';
            var tags='';
            var QuesTags = $('.tag-div input[name="tags[]"]').map(function(){return $(this).val();}).get();
                 
            if(typeof QuesTags !== 'undefined' && QuesTags.length !== 0){
                tags = QuesTags.join(); 
            }
                            
            var testSectionType = $('#testSectionTypeRead').val();
            //var new_question_type_select = $('#new_question_type_select').val();
            var new_question_type_select = $(this).parent().parent().find('#new_question_type_select').val();

            var new_question_category_type_value = $(this).parent().parent().find('#category_type').val();

            console.log(new_question_category_type_value);
            

            var question = CKEDITOR.instances['js-ckeditor-addQue'].getData();
            var activeAnswerType = '.'+$('#editSelectedAnswerType').val();
            var questionType = $('#questionMultiModal '+activeAnswerType+' #questionType').val();
            var pass = ''; //CKEDITOR.instances['js-ckeditor-passquestion'].getData();
            var passNumber = $('#questionMultiModal .passNumber').val();
			var passagesType = $('.passagesType').val();
            var passagesTypeTxt = $(".passagesType option:selected").text();

            if(format =='' || testSectionType =='' || question =='' || questionType =='' || passagesType =='' || passNumber ==''){
                $('#questionMultiModal .validError').text('Below fields are required!');
                return false;
            }else{
                $('#questionMultiModal .validError').text('');
            }
				
                if(questionType =='choiceOneInFourPass'){                

                    answerType = $('#questionMultiModal '+activeAnswerType+' input[name="choiceOneInFourPass"]:checked').val();

                } else if(questionType =='choiceMultInFourFill'){

                     fillVals = $('#questionMultiModal '+activeAnswerType+' input[name="choiceMultInFourFill_fill[]"]').map(function(){return $(this).val();}).get();

                    if(typeof fillVals !== 'undefined' && fillVals.length !== 0){
                        fill = fillVals.join();    
                    }
	                if($('#questionMultiModal #selectedLayoutQuestion .choiceMultInFourFill_filltype').val() !=''){
	                    fillType = $('#questionMultiModal #selectedLayoutQuestion .choiceMultInFourFill_filltype').val();  
	                }
	                

                    var singleChoM = $('#questionMultiModal '+activeAnswerType+' input[name="editChoiceMultiChoiceInFourFill"]:checked').val();

                    if(typeof singleChoM !== 'undefined' && singleChoM != null){
                        
                        answerType = $('#questionMultiModal '+activeAnswerType+' input[name="editChoiceMultiChoiceInFourFill"]:checked').val();

                    } else{
                        multiChoice = 'multiChoice';
                        var answerMap ='';
                        var checkIDs = $('#questionMultiModal '+activeAnswerType+' input[name="choiceMultInFourFill[]"]:checked').map(function(){       
                          answerMap += $(this).val()+', ';  
                          return $(this).val();
                        });
                        if(answerMap !=''){
                            answerType = answerMap.substring(0, answerMap.length - 2);
                        }
                    }	                
	                
	            } else {
	                answerType = $('#questionMultiModal  '+activeAnswerType+' input[name="'+questionType+'"]').val();
	            }
                var answerContentJson = getEditAnswerContent(questionType, fill);
				 
                $('#questionMultiModal').modal('hide');
                $('#questionMultiModal').modal('hide');

                
				var section_id = $('.sectionAddId').val();  
				$.ajax({
					data:{
						'id': currentModelQueId,
						'format': format,
						'testSectionType': testSectionType,
						'question': question,
						'question_type': questionType,
						'passages': pass,
						'passage_number': passNumber,
						'passages_id': passagesType,
						'answer': answerType,
                        'answer_content': answerContentJson,
						'fill': fill,
                        'fillType': fillType,
						'multiChoice':multiChoice,
                        'section_id':section_id,
                        'tags':tags,
                        'new_question_type_select':new_question_type_select,
                        'new_question_category_type_value':new_question_category_type_value,
						'_token': $('input[name="_token"]').val()
					},
					url: '{{route("updatePracticeQuestion")}}',
					method: 'post',
					success: (res) => {
                        var btn = '<button type="button" class="btn btn-sm btn-alt-secondary edit-section" data-id="'+res+'" data-bs-toggle="tooltip" title="Edit Section" onclick="practQuestioEdit('+res+')" ><i class="fa fa-fw fa-pencil-alt"></i>  </button> <button type="button"   class="btn btn-sm btn-alt-secondary delete-section" data-id="'+res+'" data-bs-toggle="tooltip"  title="Delete Section"  onclick="practQuestioDel('+res+')" > <i class="fa fa-fw fa-times"></i>  </button>';

                        $('.singleQuest_'+currentModelQueId).html('<li>'+question+'</li><li>'+answerType+'</li><li>'+passagesTypeTxt+'</li><li>'+passNumber+'</li><li>'+fill+'</li><li class="orderValUpdate_'+res+'">0</li><li>'+btn+'</li>');
						$('.addQuestion').val('');
							$('.validError').text('');
                        $('.questionaprat_'+currentModelQueId).remove();    
                        $('#listWithHandleQuestion').append('<div class="list-group-item sectionsaprat_'+section_id+' quesBasedSecList questionaprat_'+currentModelQueId+'" data-id="'+currentModelQueId+'" style="display:none;">\n' +
                        '<span class="glyphicon glyphicon-move" aria-hidden="true">\n' +
                        '<i class="fa-solid fa-grip-vertical"></i>\n' +
                        '</span>\n' +
                        '<button class="btn btn-primary" value="'+currentModelQueId+'">'+question+'</button>\n' +
                        '</div>');    

					} 
				});	
            
            setEmptyValue(questionType);
            return false;
        
        });

        $(document).on('click','.add_question_modal_multi',function(){
            var dataId = $(this).attr("data-id");
            var format = $('#format').val();
            var AnuserOpts = $('#sectionDisplay_'+dataId+' .firstRecord ul li span .selectedSecTxt').val();
            
            $('#addTestSectionTypeRead').val(AnuserOpts);
            $('#addCurrentModelQueId').val(dataId);
            $('.addSectionAddId').val(dataId);
            appendAnswerOption(AnuserOpts);
            getPassages(format);
            $(".addchoiceMultInFourFill input[type=checkbox]").each(function(){
                $(this).attr('checked', false);
            });
            
            $('#addQuestionMultiModal').modal('show');
        });

         $('.save_section').click(function() {

            var format = $('#format').val();
            var currentModelQueId = $('#addCurrentModelQueId').val();
            
            var fill = 'N/A';
            var fillType = 'N/A';
            var answerType ='N/A';
            var fillVals= [];
            var multiChoice = '';
                
            var testSectionType = $('#addTestSectionTypeRead').val();
            var new_question_type_select = $(this).parent().parent().find('#new_question_type_select').val();
            
            var question = CKEDITOR.instances['js-ckeditor-add-addQue'].getData();
            var activeAnswerType = '.add'+ $('#selectedAnswerType').val();
            var questionType = $('#addQuestionMultiModal '+activeAnswerType+' #addQuestionType').val();
            var pass = ''; //CKEDITOR.instances['js-ckeditor-passquestion'].getData();
            var passNumber = $('#addQuestionMultiModal .addPassNumber').val();
            var passagesType = $('.addPassagesType').val();
            var passagesTypeTxt = $(".addPassagesType option:selected").text();

            var tags='';
            var QuesTags = $('.add-tag-div input[name="addTags[]"]').map(function(){return $(this).val();}).get();
                 
            if(typeof QuesTags !== 'undefined' && QuesTags.length !== 0){
                tags = QuesTags.join(); 
            }

            if(format =='' || testSectionType =='' || question =='' || questionType =='' || passagesType ==''){
                $('#addQuestionMultiModal .validError').text('Below fields are required!');
                return false;
            }else{
                $('#addQuestionMultiModal .validError').text('');
            }
            
            if(questionType =='choiceOneInFourPass'){                
                answerType = $('#addQuestionMultiModal '+activeAnswerType+' input[name="addChoiceOneInFourPass"]:checked').val();
            } else if(questionType =='choiceMultInFourFill'){
                fillVals = $('#addQuestionMultiModal '+activeAnswerType+' input[name="addChoiceMultInFourFill_fill[]"]').map(function(){return $(this).val();}).get();
                

                if(typeof fillVals !== 'undefined' && fillVals.length === 0){
                    fill = fillVals.join();    
                }
                
                if($('#addQuestionMultiModal #addSelectedLayoutQuestion '+activeAnswerType+' .addChoiceMultInFourFill_filltype').val() !=''){
                    fillType = $('#addQuestionMultiModal #addSelectedLayoutQuestion '+activeAnswerType+' .addChoiceMultInFourFill_filltype').val();  
                }

                var singleChoM = $('#questionMultiModal '+activeAnswerType+' input[name="addChoiceMultiChoiceInFourFill"]:checked').val();

                if(typeof singleChoM !== 'undefined' && singleChoM != null){
                    
                    answerType = $('#questionMultiModal '+activeAnswerType+' input[name="addChoiceMultiChoiceInFourFill"]:checked').val();

                } else{ 
                    multiChoice = 'multiChoice';
                    var answerMap ='';
                    var checkIDs = $('#addQuestionMultiModal '+activeAnswerType+' input[name="addChoiceMultInFourFill[]"]:checked').map(function(){       
                      answerMap += $(this).val()+', ';  
                      return $(this).val();
                    });
                    if(answerMap !=''){
                        answerType = answerMap.substring(0, answerMap.length - 2);
                    }                       

                }                    
                
            } else {
                answerType = $('#addQuestionMultiModal  '+activeAnswerType+' input[name="'+questionType+'"]').val();
            }
            
            var answerContentJson =getAnswerContent(questionType, fill);

            $('#addQuestionMultiModal').modal('hide');
            $('#addQuestionMultiModal').modal('hide');

            
            var section_id = $('.addSectionAddId').val();  
            $.ajax({
                data:{
                    'format': format,
                    'testSectionType': testSectionType,
                    'question': question,
                    'question_type': questionType,
                    'passages': pass,
                    'passage_number': passNumber,
                    'passages_id': passagesType,
                    'answer': answerType,
                    'answer_content': answerContentJson,
                    'fill': fill,
                    'fillType': fillType,
                    'multiChoice': multiChoice,
                    'section_id':section_id,
                    'tags':tags,
                    'new_question_type_select':new_question_type_select,
                    '_token': $('input[name="_token"]').val()
                },
                url: '{{route("addPracticeQuestion")}}',
                method: 'post',
                success: (res) => {
                    $('.addQuestion').val('');
                        $('.validError').text('');

                $('#sectionDisplay_'+currentModelQueId+' .firstRecord').append('<ul class="sectionList singleQuest_'+res+'"><li>'+question+'</li><li>'+answerType+'</li><li>'+passagesTypeTxt+'</li><li>'+passNumber+'</li><li>'+fill+'</li><li class="orderValUpdate_'+res+'">0</li><li><button type="button" class="btn btn-sm btn-alt-secondary edit-section" data-id="'+res+'" data-bs-toggle="tooltip" title="Edit Section" onclick="practQuestioEdit('+res+')"> <i class="fa fa-fw fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-alt-secondary delete-section" data-id="'+res+'" data-bs-toggle="tooltip" title="Delete Section"   onclick="practQuestioDel('+res+')">  <i class="fa fa-fw fa-times"></i></button> </li></ul>');

                   
                $('#listWithHandleQuestion').append('<div class="list-group-item sectionsaprat_'+section_id+' quesBasedSecList questionaprat_'+res+'" data-id="'+res+'" style="display:none;">\n' +
                '<span class="glyphicon glyphicon-move" aria-hidden="true">\n' +
                '<i class="fa-solid fa-grip-vertical"></i>\n' +
                '</span>\n' +
                '<button class="btn btn-primary" value="'+res+'">'+question+'</button>\n' +
                '</div>');  
                } 
            }); 
            
            setEmptyValue(questionType);
            return false;
        
        });
	</script>
<script>
	//your javascript goes here
var currentTab = 0;
document.addEventListener("DOMContentLoaded", function(event) {


    showTab(currentTab);

});

function showTab(n) {
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";

		//$('#nextBtn').prop('type', 'submit');
    } else {
		document.getElementById("nextBtn").innerHTML = "Next";
        //$('#nextBtn').prop('type', 'button');
    }
    fixStepIndicator(n)
}

function nextPrev(n) {
    var x = document.getElementsByClassName("tab");
    if (n == 1 && !validateForm()) return false;
    x[currentTab].style.display = "none";
    currentTab = currentTab + n;
    if (currentTab >= x.length) {
        document.getElementById("regForm").submit();
        // return false;
        //alert("sdf");
		
        document.getElementById("nextprevious").style.display = "none";
        document.getElementById("all-steps").style.display = "none";
        document.getElementById("register").style.display = "none";
        document.getElementById("text-message").style.display = "block";




    }
    showTab(currentTab);
}

function validateForm() {
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input.required");
    for (i = 0; i < y.length; i++) {
        if (y[i].value == "") {
            y[i].className += " invalid";
            valid = false;
        }
    }
    if (valid) { document.getElementsByClassName("step")[currentTab].className += " finish"; }
    return valid;
}

function fixStepIndicator(n) {
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) { x[i].className = x[i].className.replace(" active", ""); }
    x[n].className += " active";
}
function practQuestioDel(id){
    var result = confirm('Are you sure to remove ?');
            if(!result) {
                return false;
            }

            $.ajax({
                 data:{
                    'id': id,
                    '_token': $('input[name="_token"]').val()
                },
                url: '{{route("deletePracticeQuestionById")}}',
                method: 'post',
                success: (res) => {
                    $('.singleQuest_'+id).remove();
                }
            });

}
function practQuestioEdit(id){

    $.ajax({
        data:{
            'question_id':id,
            '_token': $('input[name="_token"]').val()
        },
        url: '{{route("getPracticeQuestionById")}}',
        method: 'post',
        success: (res) => {
            if(res.length>0){
                var result = res[0];
                $('#currentModelQueId').val(result.id);
                $('#quesFormat').val(result.format);
                $('.sectionAddId').val(result.practice_test_sections_id);
                $('#testSectionTypeRead').val(result.type);
                $('#new_question_type_select').val(result.question_type_id);
                $('#category_type').val(result.category_type);
                CKEDITOR.instances['js-ckeditor-addQue'].setData(result.title);
                var tagsString = result.tags;
                var tags = '';
                var tagtxt = '';
                if(tagsString != ''){
                    var tags = tagsString.split(',');
                }
                
                for(var i=0; i<tags.length; i++){
                    tagtxt +='<div class="col"><a href="javascript:;" class="tagDelete" onClick="deleteTag(this)">X</a> <div class="form-check form-block">   <input class="form-check-input" type="checkbox" value="'+tags[i]+'" name="tags[]" checked="checked"> <label class="form-check-label label-check" for="example-checkbox-block1">    <span class="d-block fs-sm text-muted">'+tags[i]+'</span>  </label> </div></div>';
                }
                  
                $('.tag-div').html(tagtxt);
                $(".passNumber").val(result.passage_number).change();
                
                $.ajax({
                    data:{
                        'format': result.format,
                        '_token': $('input[name="_token"]').val()
                    },
                    url: '{{route("getPracticePassage")}}',
                    method: 'post',
                    success: (passRes) => {
                        var opt = '';
                        $.each(passRes, function( key, val){
                            if(val.id == passRes.passages_id){
                                opt +='<option value="'+val.id+'" selected="selected">'+val.title+'</option>';
                            }else{
                                opt +='<option value="'+val.id+'">'+val.title+'</option>';
                            }                        
                        });
                        $('.passagesType').html(opt);
                    }
                });
                getAnswerOption(result.type, result.answer, result.fill, result.fillType, result.answer_content );
            }
            
        } 
    }); 
	$('#questionMultiModal').modal('show');
}

function getAnswerOption(answerOpt, selectedOpt, fill, fillType, answer_content){
            
        console.log(answerOpt);
        if(answerOpt == 'choiceOneInFour'){
            $('#editSelectedAnswerType').val('choiceOneInFour');
            $('.choiceOneInFour').show();
            $('.choiceOneInFive').hide();
            $('.choiceOneInFourPass').hide();
            $('.choiceMultInFourFill').hide();
        	var optObj = ['a','b','c','d'];
            var jsonConvert = [];
            if(isJson(answer_content)){
                jsonConvert = $.parseJSON(answer_content);
            } 
        	var selHml='';
        	for(var i=1; i<= optObj.length; i++){
                var arrIndex = Number(i)-1;
                var editInd = Number(i)+1;
        		if(optObj[arrIndex] == selectedOpt){
        		  $('.choiceOneInFour ul li:eq('+arrIndex+') input ').prop("checked", true);
                }
                if(jsonConvert.length>0){
                    var anwserInd = Number(i)-1;
                    var dynIds = 'editChoiceOneInFourAnswer_'+i;
                    CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]); 
                }
        	}
            

        } 
        if(answerOpt =='choiceOneInFive'){
            $('#editSelectedAnswerType').val('choiceOneInFive');
            $('.choiceOneInFour').hide();
            $('.choiceOneInFive').show();
            $('.choiceOneInFourPass').hide();
            $('.choiceMultInFourFill').hide();
        	var optObj = ['a','b','c','d','e'];
        	var selHml='';
            var jsonConvert = [];
            if(isJson(answer_content)){
                jsonConvert = $.parseJSON(answer_content);
            }
        	for(var i=1; i<= optObj.length; i++){
                var arrIndex = Number(i)-1;
                var editInd = Number(i)+1;
        		if(optObj[arrIndex] == selectedOpt){
        			$('.choiceOneInFive ul li:eq('+arrIndex+') input ').prop("checked", true);
        		} 
                if(jsonConvert.length>0){
                    var anwserInd = Number(i)-1;
                    var dynIds = 'editChoiceOneInFiveAnswer_'+i;
                    CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]); 
                }
        	}

        } 
        if(answerOpt =='choiceOneInFourPass'){
            console.log('yesy');
            $('#editSelectedAnswerType').val('choiceOneInFourPass');
            console.log($('#editSelectedAnswerType').val());
            $('.choiceOneInFour').hide();
            $('.choiceOneInFive').hide();
            $('.choiceOneInFourPass').show();
            $('.choiceMultInFourFill').hide();
        	var optObj = ['a','b','c','d'];
        	var selHml='';
            var jsonConvert = [];
            if(isJson(answer_content)){
                jsonConvert = $.parseJSON(answer_content);
            }            
            
        	for(var i=1; i<= optObj.length; i++){
                var arrIndex = Number(i)-1;
                var editInd = Number(i)+1;
        		if(optObj[arrIndex] == selectedOpt){
        			$('.choiceOneInFourPass ul li:eq('+arrIndex+') input').prop("checked", true);
        		}
                if(jsonConvert.length>0){
                    var anwserInd = Number(i)-1;
                    var dynIds = 'editChoiceOneInFourPassAnswer_'+i;
                    CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]); 
                }
        	}
            

        } 
        if(answerOpt == 'choiceMultInFourFill'){

            $('#editSelectedAnswerType').val('choiceMultInFourFill');
            $('.choiceOneInFour').hide();
            $('.choiceOneInFive').hide();
            $('.choiceOneInFourPass').hide();
            $('.choiceMultInFourFill').show();
        	var optObj = ['a','b','c','d'];
            var trimStr = selectedOpt.replace(/ /g,'');
        	var multiChecked = trimStr.split(",");
        	var selHml='';
            var jsonConvert = [];
            
            if(answer_content != null && isJson(answer_content)){
                jsonConvert = $.parseJSON(answer_content);
            }
            
            var fillHtl = '<input type="text" name="choiceMultInFourFill_fill[]" value="">';

            if(multiChoice == 'multiChoice'){
                for(var i=1; i<= optObj.length; i++){
                    var arrIndex = Number(i)-1;
                    var editInd = Number(i)+1;
                    if(multiChecked.includes(optObj[arrIndex])){
                        
                        $('.choiceMultInFourFill .withOutFillOpt ul li:eq('+arrIndex+') input').prop("checked", true);

                    }
                    if(jsonConvert.length>0){
                        var anwserInd = Number(i)-1;
                        var dynIds = 'editChoiceMultInFourFillAnswer_'+i;
                        CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]); 
                    } 
                }
            }else{

                for(var i=1; i<= optObj.length; i++){
                    var arrIndex = Number(i)-1;
                    var editInd = Number(i)+1;
                    if(selectedOpt == optObj[arrIndex]){
                        
                        $('.choiceMultInFourFill .withOutFillOptChoice ul li:eq('+arrIndex+') input').prop("checked", true);

                    }
                    if(jsonConvert.length>0){
                        var anwserInd = Number(i)-1;
                        var dynIds = 'editChoiceMultiChoiceInFourFill_'+i;
                        CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]); 
                    } 
                }

            }

        	var arrFillType = ['number','decimal','fraction'];
        	var optType = '';

        	for(var j=0; j<arrFillType.length; j++){
        		if(arrFillType[j] == arrFillType){
        			optType +='<option value="'+arrFillType[j]+'" selected="selected">'+arrFillType[j].toUpperCase()+'</option>';
        		} else {
        			optType +='<option value="'+arrFillType[j]+'">'+arrFillType[j].toUpperCase()+'</option>';
        		}                    		
        	}

        	var fillDiv ='';
        	var fillTypeDiv ='none';

        	if(fill != null && fill !='' && fill != 'N/A'){
                 var objFill = fill.split(',');
                 
                 if(typeof objFill !== 'undefined' && objFill.length !== 0){
                    fillHtl = '';
                    for(var j=0; j<objFill.length; j++){
                        fillHtl += '<input type="text" name="choiceMultInFourFill_fill[]" value="'+objFill[j]+'">';
                    }
                 }
        		$('.withOutFillOpt').hide();
                $('.withOutFillOptChoice').hide();
                $('.withFillOpt').show();        	    
        	} else{
                if(multiChoice == 'multiChoice'){
                    $('.withOutFillOpt').show();
                    $('.withOutFillOptChoice').hide();
                    $('.withFillOpt').hide();
                } else{
                    $('.editMultipleChoice').val(3);
                    $('.withOutFillOpt').hide();
                    $('.withOutFillOptChoice').show();
                    $('.withFillOpt').hide();
                }
            }
            var seletedLayout = '<div class="mb-2"><label class="form-label" style="font-size: 13px;">Fill Type:</label><select name="choiceMultInFourFill_filltype"  class="form-control choiceMultInFourFill_filltype">'+optType+'</select> </div><div class="mb-2"> <label class="form-label" style="font-size: 13px;">Fill:</label> <label class="form-label editExtraFillOption" style="font-size: 13px;">'+fillHtl+'</label><label class="form-label" style="font-size: 13px;"><a href="javascript:;" onClick="editMoreFillOption();" class="switchMulti">Add More Options</a></label></div>';
            $('.withFillOpt').html(seletedLayout);
        }            
        
    }
    function setEmptyValue(qType){
		CKEDITOR.instances['js-ckeditor-addQue'].setData('');
		/*CKEDITOR.instances['js-ckeditor-passquestion'].setData('');*/
		$(".passNumber option[value='']").attr('selected', true);
		$('#questionMultiModal .passNumber').prop('selectedIndex',0);
		$('input[name="'+qType+'"]').attr('checked', false);
        $('input[type="radio"]').prop('checked', false);
    $('input[type="checkbox"]').prop('checked', false);
    CKEDITOR.instances['choiceOneInFourAnswer_1'].setData('');
    CKEDITOR.instances['choiceOneInFourAnswer_2'].setData('');
    CKEDITOR.instances['choiceOneInFourAnswer_3'].setData('');
    CKEDITOR.instances['choiceOneInFourAnswer_4'].setData('');

    CKEDITOR.instances['choiceOneInFiveAnswer_1'].setData('');
    CKEDITOR.instances['choiceOneInFiveAnswer_2'].setData('');
    CKEDITOR.instances['choiceOneInFiveAnswer_3'].setData('');
    CKEDITOR.instances['choiceOneInFiveAnswer_4'].setData('');
    CKEDITOR.instances['choiceOneInFiveAnswer_5'].setData('');

    CKEDITOR.instances['choiceOneInFourPassAnswer_1'].setData('');
    CKEDITOR.instances['choiceOneInFourPassAnswer_2'].setData('');
    CKEDITOR.instances['choiceOneInFourPassAnswer_3'].setData('');
    CKEDITOR.instances['choiceOneInFourPassAnswer_4'].setData('');

    CKEDITOR.instances['choiceMultInFourFillAnswer_1'].setData('');
    CKEDITOR.instances['choiceMultInFourFillAnswer_2'].setData('');
    CKEDITOR.instances['choiceMultInFourFillAnswer_3'].setData('');
    CKEDITOR.instances['choiceMultInFourFillAnswer_4'].setData('');

    /***********For Edit Options****************/

    CKEDITOR.instances['editChoiceOneInFourAnswer_1'].setData('');
    CKEDITOR.instances['editChoiceOneInFourAnswer_2'].setData('');
    CKEDITOR.instances['editChoiceOneInFourAnswer_3'].setData('');
    CKEDITOR.instances['editChoiceOneInFourAnswer_4'].setData('');

    CKEDITOR.instances['editChoiceOneInFiveAnswer_1'].setData('');
    CKEDITOR.instances['editChoiceOneInFiveAnswer_2'].setData('');
    CKEDITOR.instances['editChoiceOneInFiveAnswer_3'].setData('');
    CKEDITOR.instances['editChoiceOneInFiveAnswer_4'].setData('');
    CKEDITOR.instances['editChoiceOneInFiveAnswer_5'].setData('');

    CKEDITOR.instances['editChoiceOneInFourPassAnswer_1'].setData('');
    CKEDITOR.instances['editChoiceOneInFourPassAnswer_2'].setData('');
    CKEDITOR.instances['editChoiceOneInFourPassAnswer_3'].setData('');
    CKEDITOR.instances['editChoiceOneInFourPassAnswer_4'].setData('');

    CKEDITOR.instances['editChoiceMultInFourFillAnswer_1'].setData('');
    CKEDITOR.instances['editChoiceMultInFourFillAnswer_2'].setData('');
    CKEDITOR.instances['editChoiceMultInFourFillAnswer_3'].setData('');
    CKEDITOR.instances['editChoiceMultInFourFillAnswer_4'].setData('');

    CKEDITOR.instances['addChoiceMultiChoiceInFourFill_1'].setData('');
    CKEDITOR.instances['addChoiceMultiChoiceInFourFill_2'].setData('');
    CKEDITOR.instances['addChoiceMultiChoiceInFourFill_3'].setData('');
    CKEDITOR.instances['addChoiceMultiChoiceInFourFill_4'].setData('');

    CKEDITOR.instances['editChoiceMultiChoiceInFourFill_1'].setData('');
    CKEDITOR.instances['editChoiceMultiChoiceInFourFill_2'].setData('');
    CKEDITOR.instances['editChoiceMultiChoiceInFourFill_3'].setData('');
    CKEDITOR.instances['editChoiceMultiChoiceInFourFill_4'].setData('');
	}  
    function appendAnswerOption(answerOpt){
            
            var questionAnsComb = {English:'choiceOneInFourPass',Math:'choiceOneInFive',Reading:'choiceOneInFourPass',Writing:'choiceOneInFourPass',Science:'choiceOneInFour',Math_no_calculator:'choiceMultInFourFill',Math_with_calculator:'choiceMultInFourFill'};
            $.each(questionAnsComb, function(ind,val){
                
                if(ind == answerOpt){
                    
                    if(val == 'choiceOneInFour'){
                        $('#selectedAnswerType').val('choiceOneInFour');
                        $('.addchoiceOneInFour').show();
                        $('.addchoiceOneInFive').hide();
                        $('.addchoiceOneInFourPass').hide();
                        $('.addchoiceMultInFourFill').hide();
                    } else if(val == 'choiceOneInFive'){
                        $('#selectedAnswerType').val('choiceOneInFive');
                        $('.addchoiceOneInFour').hide();
                        $('.addchoiceOneInFive').show();
                        $('.addchoiceOneInFourPass').hide();
                        $('.addchoiceMultInFourFill').hide();
                    } else if(val == 'choiceOneInFourPass'){
                        $('#selectedAnswerType').val('choiceOneInFourPass');
                        $('.addchoiceOneInFour').hide();
                        $('.addchoiceOneInFive').hide();
                        $('.addchoiceOneInFourPass').show();
                        $('.addchoiceMultInFourFill').hide();
                    } else if(val == 'choiceMultInFourFill'){
                        $('#selectedAnswerType').val('choiceMultInFourFill');
                        $('.addchoiceOneInFour').hide();
                        $('.addchoiceOneInFive').hide();
                        $('.addchoiceOneInFourPass').hide();
                        $('.addchoiceMultInFourFill').show();
                    }                                     
                }
            });
        
        } 
    function getPassages(format){
    $.ajax({
        data:{
            'format': format,
            '_token': $('input[name="_token"]').val()
        },
        url: '{{route("getPracticePassage")}}',
        method: 'post',
        success: (res) => {
            var opt = '';
            //opt += '<option value="0">No Passage</option>';
            $.each(res, function( key, val){
                opt +='<option value="'+val.id+'">'+val.title+'</option>';
            });
            $('.addPassagesType').html(opt);
        }
    });
}  
function multiChoice(arg){
    if(arg == 1){
        $('.multi_field').show();
        $('.fill_field').hide();
    } else{
        $('.multi_field').hide();
        $('.fill_field').show();
    }

}
function addMultiChoice(arg){
    if(arg == 1){
        $('#addSelectedLayoutQuestion .multi_field').show();
        $('#addSelectedLayoutQuestion .multiChoice_field').hide();
        $('#addSelectedLayoutQuestion .fill_field').hide();
    } else if(arg == 3){
        $('#addSelectedLayoutQuestion .multi_field').hide();
        $('#addSelectedLayoutQuestion .multiChoice_field').show();
        $('#addSelectedLayoutQuestion .fill_field').hide();
    } else{
        $('#addSelectedLayoutQuestion .multi_field').hide();
        $('#addSelectedLayoutQuestion .multiChoice_field').hide();
        $('#addSelectedLayoutQuestion .fill_field').show();
    }
}  
function editMultiChoice(arg){
    if(arg == 1){
        $('#selectedLayoutQuestion .multi_field').show();
        $('#selectedLayoutQuestion .fill_field').hide();
        $('#selectedLayoutQuestion .multiChoice_field').hide();
    } else if(arg == 3){
        $('#selectedLayoutQuestion .multi_field').hide();
        $('#selectedLayoutQuestion .multiChoice_field').show();
        $('#selectedLayoutQuestion .fill_field').hide();
    }else{
        $('#selectedLayoutQuestion .multi_field').hide();
        $('#selectedLayoutQuestion .multiChoice_field').hide();
        $('#selectedLayoutQuestion .fill_field').show();
    }
}   
function addMoreFillOption(){
    $('.extraFillOption').append('<input type="text" name="addChoiceMultInFourFill_fill[]">');
}
function removeMoreFillOption(){
    $('.extraFillOption').html('');
} 
function editMoreFillOption(){
    $('.editExtraFillOption').append('<input type="text" name="choiceMultInFourFill_fill[]">');
}

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
function getAnswerContent(answerOpt, fill){
            var answerContenArr = [];
            if(answerOpt=='choiceOneInFive'){
                for(var i=1; i<6;i++){
                    var dynamicId = answerOpt+'Answer_'+i;
                    answerContenArr.push(CKEDITOR.instances[dynamicId].getData());
                }               

            }else {
                if(fill == '' || fill =='N/A'){

                    var choiceSel = $('.addMultiChoice').val();
                    if(choiceSel == 3){
                        for(var i=1; i<5;i++){
                            var dynamicId ='addChoiceMultiChoiceInFourFill_'+i;
                            answerContenArr.push(CKEDITOR.instances[dynamicId].getData());
                        }
                    }else{
                        for(var i=1; i<5;i++){
                            var dynamicId = answerOpt+'Answer_'+i;
                            answerContenArr.push(CKEDITOR.instances[dynamicId].getData());
                        }
                    } 
                }
                
            }
        if(answerContenArr.length>0){
            return JSON.stringify(answerContenArr);
        }
        return '';
}
function getEditAnswerContent(answerOpt, fill){
            var answerContenArr = [];
            if(answerOpt=='choiceOneInFive'){
                for(var i=1; i<6;i++){
                    var dynamicId = 'edit'+capitalizeFirstLetter(answerOpt)+'Answer_'+i;
                    answerContenArr.push(CKEDITOR.instances[dynamicId].getData());
                }               

            }else {
                if(fill == '' || fill =='N/A'){

                    var choiceSel = $('.editMultipleChoice').val();
                    if(choiceSel == 3){
                        for(var i=1; i<5;i++){
                            var dynamicId ='editChoiceMultiChoiceInFourFill_'+i;
                            answerContenArr.push(CKEDITOR.instances[dynamicId].getData());
                        }
                    }else{
                        for(var i=1; i<5;i++){
                            var dynamicId = 'edit'+capitalizeFirstLetter(answerOpt)+'Answer_'+i;
                            answerContenArr.push(CKEDITOR.instances[dynamicId].getData());
                        } 
                    }                     
                }
                
            }
        if(answerContenArr.length>0){
            return JSON.stringify(answerContenArr);
        }
        return '';
}
function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}
function addTag(evt){
        let tag = $("#tag").val();
        if (evt.keyCode == 13){
            evt.preventDefault();

            $('.tag-div').append('<div class="col"><div class="form-check form-block"><input class="form-check-input" type="checkbox" value="'+tag+'" id="example-checkbox-block1" name="tags[]" checked="checked"><label class="form-check-label label-check" for="example-checkbox-block1"><span class="d-block fs-sm text-muted">'+tag+'</span></label></div></div>');
            $("#tag").val('');
            
        }
}
function addTagFunc(evt){
        let tag = $("#addTag").val();
        if (evt.keyCode == 13){
            evt.preventDefault();

            $('.add-tag-div').append('<div class="col"><div class="form-check form-block"><input class="form-check-input" type="checkbox" value="'+tag+'" id="example-checkbox-block1" name="addTags[]" checked="checked"><label class="form-check-label label-check" for="example-checkbox-block1"><span class="d-block fs-sm text-muted">'+tag+'</span></label></div></div>');
            $("#addTag").val('');
            
        }
}
function deleteTag(evt){
    $(evt).parent().remove();
        
}
function openOrderDialog(secId) {
    $('#sectionAddId').val(secId);
    myModal.show();
}
function saveOrder() {
    $('#sectionAddId').val(0);
    myModal.hide();
}
function openOrderQuesDialog (secId) {
    console.log(secId);
    console.log('.sectionsaprat_'+secId);

    $('.quesBasedSecList').hide();
    $('.sectionsaprat_'+secId).show();
    myQuestionModal.show();
}
function questionModal() {
    //$('#sectionAddId').val(0);
    myQuestionModal.hide();
}
Sortable.create(listWithHandle, {
    handle: '.glyphicon-move',
    animation: 150,
    onEnd: function(evt) {
        console.log(evt);
        /*let data = {
            new_index: evt.newIndex+1,
            old_index: evt.oldIndex+1,
            item: evt.item.children[1].value,
            currentMileId: 1
        };*/
        var section_id = $('#sectionAddId').val();
        var orderId = '#order_'+section_id;
        $(orderId).val(evt.newIndex+1);
        
        $.ajax({
            data:{
                'section_order': evt.newIndex+1,
                'section_id': section_id,
                '_token': $('input[name="_token"]').val()
            },
            url: '{{route("sectionOrder")}}',
            method: 'post',
            success: (res) => {
               console.log(res);
            }
        });
    }
},);  


// List with handle
Sortable.create(listWithHandleQuestion, {
    handle: '.glyphicon-move',
    animation: 150,
    onEnd: function(evt) {
        var dataSet = evt.clone.dataset;
        
        /*let data = {
            new_index: evt.newIndex+1,
            old_index: evt.oldIndex+1,
            item: evt.item.children[1].value,
            currentMileId: 1
        };*/
        var question_id = dataSet.id;  
        $('.orderValUpdate_'+question_id).text(evt.newIndex+1);      
        $.ajax({
            data:{
                'question_order': evt.newIndex+1,
                'question_id': question_id,
                '_token': $('input[name="_token"]').val()
            },
            url: '{{route("questionOrder")}}',
            method: 'post',
            success: (res) => {
               console.log(res);
            }
        });
    }
},); 
</script>
    
@endsection
