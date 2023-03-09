@extends('layouts.admin')

@section('title', 'Admin Dashboard : Edit Practice Tests')
@section('page-style')
<link rel="stylesheet" href="{{ asset('css/tagify.css') }}">
<link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
<style>

input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa
}

input.invalid {
    background-color: #ffdddd;
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
    align-items: center;
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
.form-label{
    display: block
}
#addNewTypes .select2-container--default{
    width: 300px !important;
}
#add_New_Types .select2-container--default{
    width: 300px !important;
}
.passage-container .select2-container--default{
    width: 360px !important;
}
.add-position{
    position: relative;
    top: 4px;
}
.add-minus-icon{
    position: relative;
    top: -7px
}
#sectionModal .select2-container--default{
    width: 100% !important;
}
.plus-button {
    margin-left: 17px;
    background-color: #1f2937;
    color: #fff;
    text-align: center;
    border-radius: 50%;
    height: 35px !important;
    line-height: 22px;
    font-size: 15px;
    padding: 8px;
    width: 35px;
    position: relative;
    top: 6px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice{
    border: none !important;
    background-color: #e5e5e5 !important;
    color: #000 !important;
    font-weight: 400 !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
    color: #000 !important;
    border-right: none !important;
    padding: 0 7px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__display{
    padding-left: 4px;
    padding-right: 9px;
}
.select2-container .select2-selection--multiple{
    min-height: 38px !important;
}
.select2-container .select2-search--inline .select2-search__field {
    margin-top: 7px !important;
    height: 20px !important;
    padding: 0 4px;
}
.select2-container--default .select2-selection--multiple{
    border-color: #dfe3ea !important;
}
.add_question_type_select .select2-container,.category-custom .select2-container,.removeNewTypes .select2-container{
    width: 300px !important;
}
.edit-close-btn{
    width: 60px !important;
}
.select-type .select2-container--default{
    width: 100% !important;
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
                        <input type="hidden" value="{{ $practicetests->id}}" name="get_question_id"
                                                        id="get_question_id">
						<div class="col-md-12 mb-2">
							<label class="form-label">Name:</label>
							<input type="text" class="form-control test_title required" placeholder="Enter practice test name" name="title" value="{{$practicetests->title}}"/>
						</div>
						<div class="col-md-12 ptype">
							<label class="form-label">Test Type:</label>
							<select id="format" name="format" class="form-control js-select2 select">
								@foreach($testformats as $key=>$testformat)
								    <option value="{{$key}}" {{$practicetests->format == $key ? 'selected': '';}}>{{$testformat}}</option>
								@endforeach
							</select>
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
                    {{-- <div class="mb-2 mb-4">
						<label for="category_type" class="form-label">Category type:</label>
                        <input type="text" value="{{$practicetests->category_type}}" name="category_type" id="category_type" placeholder="Category Type" class="form-control form-control-lg form-control-alt" >
					</div> --}}

					<div class="sectionContainerList" id="mainSectionContainer" data-id="">	
                    <input type="hidden" name="sectionAddId" id="sectionAddId" value="0">   
					@foreach($testsections as $key=>$testsection)	
                    		
					<div class="sectionTypesFull section_{{ $testsection->id }}" data-id="{{ $testsection->id }}" id="sectionDisplay_{{ $testsection->id }}" >
					<div class="mb-2 mb-4">
						<div class="sectionTypesFullMutli"> </div> 
						<div class="sectionTypesFullMutli firstRecord">
							<ul class="sectionListtype">
								<li>Type: &nbsp;<strong>{{ $testsection->format }}</strong></li>
								<li>Section Type:&nbsp;<span class="answerOption editedAnswerOption_{{$testsection->id}}"><strong>{{ $testsection->practice_test_type }}</strong>
								<input type="hidden" name="selectedSecTxt" value="{{ $testsection->practice_test_type }}" class="selectedSecTxt selectedSection_{{$testsection->id}}" >
                                <input type="hidden" name="selectedQuesType" value="{{ $testsection->practice_test_type }}" class="selectedQuesType" >
                                </span>
								</li>
                                <li><p class="mb-0 d-flex">Order:</p> &nbsp;<input type="number" readonly class="form-control me-1" name="section_order" value="{{ $testsection->section_order }}" id="order_{{ $testsection->id }}"/><button type="button" class="input-group-text d-none" id="basic-addon2" onclick="openOrderDialog({{$testsection->id}})"><i class="fa-solid fa-check"></i></button></li>
                                <li class="edit-close-btn">
                                    <button type="button" class="btn btn-sm btn-alt-secondary editSection me-2" data-id="{{$testsection->id}}" onclick="editSection(this)" data-bs-toggle="tooltip" title="Edit Section">
                                        <i class="fa fa-fw fa-pencil-alt"></i></button>
                                    <button type="button" class="btn btn-sm btn-alt-secondary deleteSection" data-id="{{ $testsection->id }}" onclick="deleteSection(this)"  data-bs-toggle="tooltip" title="Delete Section"> 
                                        <i class="fa fa-fw fa-times"></i></button>    
                                </li>
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
                                    <li class="answerValUpdate_{{ $practQuestion->id }}">{{ $practQuestion->answer }}</li>
                                    <li>{{ isset($practQuestion->getpassage->title) ? $practQuestion->getpassage->title : ''}}</li>
                                    <li>{{ $practQuestion->passage_number  }}</li>
                                    <li>{{ $practQuestion->fill  }}</li>
                                    <li class="orderValUpdate_{{ $practQuestion->id }}">{{ $practQuestion->question_order  }}</li>
                                    <li>
                                        <button type="button"
                                                class="btn btn-sm btn-alt-secondary edit-section"
                                                data-id="{{$practQuestion->id}}"
                                                data-bs-toggle="tooltip"
                                                title="Edit Question"
                                                onclick="practQuestioEdit({{ $practQuestion->id }})"
                                        >
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button"
                                                class="btn btn-sm btn-alt-secondary delete-section"
                                                data-id="{{$practQuestion->id}}"
                                                data-bs-toggle="tooltip"
                                                title="Delete Question"
                                                onclick="practQuestioDel({{ $practQuestion->id }})"
                                        >
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    </li>
                                </ul>
							@endforeach
						</div>
					</div>
					<div class="mb-2 mb-4  partTestOrder">

                        <button type="button"  data-id="{{ $testsection->id }}" class="btn w-25 btn-alt-success add_question_modal_multi"><i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Question</button>
                        <div class="part_order">
                            <input type="number" readonly class="form-control" name="section_order" value="{{ $testsection->section_order }}" id="order_{{ $testsection->id }}"/><button type="button" class="input-group-text" id="basic-addon2" onclick="openOrderQuesDialog({{$testsection->id}})"><i class="fa-solid fa-check"></i></button>
                        </div>

                    </div>				
					</div>
					@endforeach                        
                    </div>
                    <div class="col-md-12 col-xl-12 mb-4">
                        <button type="button" data-id="0" class="btn w-25 btn-alt-success add_section_modal_btn">
                            <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Practice Test Section
                        </button>
                    </div>  
                    <div class="modal fade" id="sectionModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Practice Test Section</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="mb-2">
                                            <label class="form-label validError" style="font-size: 13px; color: red;"></label>
                                        </div>
                
                                        <div class="mb-2">
                                            <label class="form-label" style="font-size: 13px;">Practice Test Section Title:</label>
                                            <input id="testSectiontitle" value="" name="testSectiontitle"
                                                placeholder="Enter Practice Section Title" class="form-control">
                                        </div>
                
                                        <div class="mb-2 col-12">
                                            <label class="form-label" style="font-size: 13px;">Practice Test Section Type:</label>
                                            <select id="testSectionType" name="testSectionType" class="form-control js-select2 select">
                
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

                    {{-- modal new for edit section  --}}
                    <div class="modal fade" id="editSectionModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Practice Test Section</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="mb-2">
                                            <label class="form-label validError" style="font-size: 13px; color: red;"></label>
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label" style="font-size: 13px;">Practice Test Section Title:</label>
                                            <input id="editTestSectionTitle" value="" name="testSectiontitle"
                                                placeholder="Enter Practice Section Title" class="form-control">
                                        </div>

                                        <div class="mb-2 col-12 select-type">
                                            <label class="form-label" style="font-size: 13px;">Practice Test Section Type:</label>
                                            <select id="editTestSectionType" name="testSectionType" class="form-control js-select2 select">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {{-- <input type="hidden" name="whichModel" value="section" class="whichModel"> --}}
                                    <input type="hidden" value="0" id="currentSectionId">
                                    <button type="button" class="btn btn-primary save_edited_change">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

					<!--<div class="col-md-12 col-xl-12 mb-4">
						<button type="button" class="btn w-25 btn-alt-success add_question_modal_btn">
							<i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Question
						</button>
					</div>-->
                    {{-- @if(isset($testQuestions) && !empty($testQuestions))
					<div class="col-md-6">
						<ul class="list-group">
                        @foreach($testQuestions as $key => $question)
							<li class="list-group-item question_{{$question->id}}"><span style="width: 84%; float: left;">Question {{($key+1)}}</span> <span style="width: 15%; float: right;"><i class="fa fa-fw fa-pencil-alt edit_question" data-id="{{$question->id}}" style="margin-right: 4px;"></i><i class="fa fa-fw fa-times delete_question" data-id="{{$question->id}}"></i></span></li>
						@endforeach
						</ul>
					</div>
                    @endif --}}
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

{{-- start update question modal  --}}
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
                        <input name="tags" placeholder="add tags" class="form-control"/>
                    </div>
                    <div class="input-container" id="addNewTypes">
                        <div class="d-flex input-field align-items-center">
                            <div class="col-md-5 mb-2 me-2">
                                <label for="category_type" class="form-label">Category Type</label>
                                <select class="js-select2 select categoryType" id="category_type_0" name="category_type" onchange="insertCategoryType(this)" multiple>
                                    @foreach ($getCategoryTypes as $categoryType)
                                        <option value="{{ $categoryType->id }}">{{ $categoryType->category_type_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2 col-md-5 add_question_type_select">
                                <label for="search-input" class="form-label">Question Type</label>
                                <select class="js-select2 select questionType" id="search-input_0" name="search-input" onchange="insertQuestionType(this)" multiple>
                                    @foreach ($getQuestionTypes as $questionType)
                                        <option value="{{ $questionType->id }}">{{ $questionType->question_type_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 add-position">
                                <button class="plus-button" data-id="1" onclick="addNewTypes(this,'null')"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

					<div class="row passage-container">
                        <div class="mb-2 col-md-6">
                            <label for="passage_number" class="form-label">Passage No</label>
                            <select class="js-select2 select passNumber" id="passage_number" name="passage_number">
                                <option value="">Select Passage No</option>
                                @for ($i = 1; $i < 25; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-2 col-md-6">
                            <label class="form-label" for="passagesType">Passages</label>
                            <select name="passagesType" id="passagesType" class="passagesType js-select2 select"></select>
                        </div>
                    </div>
                    <input type="hidden" name="editSelectedAnswerType" id="editSelectedAnswerType">
                    <div class="mb-2" id="selectedLayoutQuestion">
                       
                        <div class="choiceOneInFour_Odd"><input type="hidden" name="questionType" id="questionType" value="choiceOneInFour_Odd">
                            <ul class="answerOptionLsit">
                                <li class="choiceOneInFour_OddAnswer_0">
                                    <label class="form-label" style="font-size: 13px;"><span>A: </span><input type="radio" value="a" name="choiceOneInFour"></label>
                                    <textarea id="editChoiceOneInFour_OddAnswer_1" name="editChoiceOneInFourAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer A</label>
                                    <textarea id="editchoiceOneInFour_Odd_explanation_answer_1" name="editchoiceOneInFour_explanation_answer_1"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFour_OddAnswer_1">
                                    <label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="choiceOneInFour"></label>
                                    <textarea id="editChoiceOneInFour_OddAnswer_2" name="editChoiceOneInFourAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer B</label>
                                    <textarea id="editchoiceOneInFour_Odd_explanation_answer_2" name="editchoiceOneInFour_explanation_answer_2"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFour_OddAnswer_2">
                                    <label class="form-label" style="font-size: 13px;"><span>C:</span><input type="radio"  value="c" name="choiceOneInFour"></label>
                                    <textarea id="editChoiceOneInFour_OddAnswer_3" name="editChoiceOneInFourAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer C</label>
                                    <textarea id="editchoiceOneInFour_Odd_explanation_answer_3" name="editchoiceOneInFour_explanation_answer_3"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFour_OddAnswer_3">
                                    <label class="form-label" style="font-size: 13px;"><span>D: </span><input type="radio"  value="d" name="choiceOneInFour"></label>
                                    <textarea id="editChoiceOneInFour_OddAnswer_4" name="editChoiceOneInFourAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer D</label>
                                    <textarea id="editchoiceOneInFour_Odd_explanation_answer_4" name="editchoiceOneInFour_explanation_answer_4"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                            </ul>
                        </div>

                        {{-- new  --}}
                        <div class="choiceOneInFour_Even"><input type="hidden" name="questionType" id="questionType" value="choiceOneInFour_Even">
                            <ul class="answerOptionLsit">
                                <li class="choiceOneInFour_EvenAnswer_0">
                                    <label class="form-label" style="font-size: 13px;"><span>F: </span><input type="radio" value="f" name="choiceOneInFour"></label>
                                    <textarea id="editChoiceOneInFour_EvenAnswer_1" name="editChoiceOneInFourAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer F</label>
                                    <textarea id="editchoiceOneInFour_Even_explanation_answer_1" name="editchoiceOneInFour_explanation_answer_1"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFour_EvenAnswer_1">
                                    <label class="form-label" style="font-size: 13px;"><span>G: </span><input type="radio"  value="g" name="choiceOneInFour"></label>
                                    <textarea id="editChoiceOneInFour_EvenAnswer_2" name="editChoiceOneInFourAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer G</label>
                                    <textarea id="editchoiceOneInFour_Even_explanation_answer_2" name="editchoiceOneInFour_explanation_answer_2"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFour_EvenAnswer_2">
                                    <label class="form-label" style="font-size: 13px;"><span>H:</span><input type="radio"  value="h" name="choiceOneInFour"></label>
                                    <textarea id="editChoiceOneInFour_EvenAnswer_3" name="editChoiceOneInFourAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer H</label>
                                    <textarea id="editchoiceOneInFour_Even_explanation_answer_3" name="editchoiceOneInFour_explanation_answer_3"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFour_EvenAnswer_3">
                                    <label class="form-label" style="font-size: 13px;"><span>J: </span><input type="radio"  value="j" name="choiceOneInFour"></label>
                                    <textarea id="editChoiceOneInFour_EvenAnswer_4" name="editChoiceOneInFourAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer J</label>
                                    <textarea id="editchoiceOneInFour_Even_explanation_answer_4" name="editchoiceOneInFour_explanation_answer_4"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                            </ul>
                        </div>
                    
                        <div class="choiceOneInFive_Odd"><input type="hidden" name="questionType" id="questionType" value="choiceOneInFive_Odd">
                            <ul class="answerOptionLsit">
                                <li class="choiceOneInFive_OddAnswer_0">
                                    <label class="form-label" style="font-size: 13px;"><span>A: </span><input type="radio" value="a" name="choiceOneInFive"></label>
                                    <textarea id="editChoiceOneInFive_OddAnswer_1" name="editChoiceOneInFiveAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer A</label>
                                    <textarea id="editchoiceOneInFive_Odd_explanation_answer_1" name="editchoiceOneInFive_explanation_answer_1"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFive_OddAnswer_1">
                                    <label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="choiceOneInFive"></label>
                                    <textarea id="editChoiceOneInFive_OddAnswer_2" name="editChoiceOneInFiveAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer B</label>
                                    <textarea id="editchoiceOneInFive_Odd_explanation_answer_2" name="editchoiceOneInFive_explanation_answer_2"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFive_OddAnswer_2">
                                    <label class="form-label" style="font-size: 13px;"><span>C:</span><input type="radio"  value="c" name="choiceOneInFive"></label>
                                    <textarea id="editChoiceOneInFive_OddAnswer_3" name="editChoiceOneInFiveAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer C</label>
                                    <textarea id="editchoiceOneInFive_Odd_explanation_answer_3" name="editchoiceOneInFive_explanation_answer_3"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFive_OddAnswer_3">
                                    <label class="form-label" style="font-size: 13px;"><span>D: </span><input type="radio"  value="d" name="choiceOneInFive"></label>
                                    <textarea id="editChoiceOneInFive_OddAnswer_4" name="editChoiceOneInFiveAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer D</label>
                                    <textarea id="editchoiceOneInFive_Odd_explanation_answer_4" name="editchoiceOneInFive_explanation_answer_4"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFive_OddAnswer_4">
                                    <label class="form-label" style="font-size: 13px;"><span>E: </span><input type="radio"  value="e" name="choiceOneInFive"></label>
                                    <textarea id="editChoiceOneInFive_OddAnswer_5" name="editChoiceOneInFiveAnswer_5" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer E</label>
                                    <textarea id="editchoiceOneInFive_Odd_explanation_answer_5" name="editchoiceOneInFive_explanation_answer_5"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                            </ul>
                        </div>

                        {{-- new  --}}
                        <div class="choiceOneInFive_Even"><input type="hidden" name="questionType" id="questionType" value="choiceOneInFive_Even">
                            <ul class="answerOptionLsit">
                                <li class="choiceOneInFive_EvenAnswer_0">
                                    <label class="form-label" style="font-size: 13px;"><span>F: </span><input type="radio" value="f" name="choiceOneInFive"></label>
                                    <textarea id="editChoiceOneInFive_EvenAnswer_1" name="editChoiceOneInFiveAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer F</label>
                                    <textarea id="editchoiceOneInFive_Even_explanation_answer_1" name="editchoiceOneInFive_explanation_answer_1"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFive_EvenAnswer_1">
                                    <label class="form-label" style="font-size: 13px;"><span>G: </span><input type="radio"  value="g" name="choiceOneInFive"></label>
                                    <textarea id="editChoiceOneInFive_EvenAnswer_2" name="editChoiceOneInFiveAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer G</label>
                                    <textarea id="editchoiceOneInFive_Even_explanation_answer_2" name="editchoiceOneInFive_explanation_answer_2"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFive_EvenAnswer_2">
                                    <label class="form-label" style="font-size: 13px;"><span>H:</span><input type="radio"  value="h" name="choiceOneInFive"></label>
                                    <textarea id="editChoiceOneInFive_EvenAnswer_3" name="editChoiceOneInFiveAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer H</label>
                                    <textarea id="editchoiceOneInFive_Even_explanation_answer_3" name="editchoiceOneInFive_explanation_answer_3"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFive_EvenAnswer_3">
                                    <label class="form-label" style="font-size: 13px;"><span>J: </span><input type="radio"  value="j" name="choiceOneInFive"></label>
                                    <textarea id="editChoiceOneInFive_EvenAnswer_4" name="editChoiceOneInFiveAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer J</label>
                                    <textarea id="editchoiceOneInFive_Even_explanation_answer_4" name="editchoiceOneInFive_explanation_answer_4"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFive_EvenAnswer_4">
                                    <label class="form-label" style="font-size: 13px;"><span>K: </span><input type="radio"  value="k" name="choiceOneInFive"></label>
                                    <textarea id="editChoiceOneInFive_EvenAnswer_5" name="editChoiceOneInFiveAnswer_5" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer K</label>
                                    <textarea id="editchoiceOneInFive_Even_explanation_answer_5" name="editchoiceOneInFive_explanation_answer_5"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                            </ul>
                        </div>

                        <div class="choiceOneInFourPass_Odd">
                            <input type="hidden" name="addQuestionType" id="questionType" value="choiceOneInFourPass_Odd">
                            <ul class="answerOptionLsit">
                                <li class="choiceOneInFourPass_OddAnswer_0">
                                    <label class="form-label" style="font-size: 13px;"><span>A: </span><input type="radio" value="a" name="choiceOneInFourPass"></label>
                                    <textarea id="editChoiceOneInFourPass_OddAnswer_1" name="editChoiceOneInFourPassAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer A</label>
                                    <textarea id="editchoiceOneInFourPass_Odd_explanation_answer_1" name="editchoiceOneInFourPass_explanation_answer_1"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFourPass_OddAnswer_1">
                                    <label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="choiceOneInFourPass"></label>
                                    <textarea id="editChoiceOneInFourPass_OddAnswer_2" name="editChoiceOneInFourPassAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer B</label>
                                    <textarea id="editchoiceOneInFourPass_Odd_explanation_answer_2" name="editchoiceOneInFourPass_explanation_answer_2"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFourPass_OddAnswer_2">
                                    <label class="form-label" style="font-size: 13px;"><span>C: </span><input type="radio"  value="c" name="choiceOneInFourPass"></label>
                                    <textarea id="editChoiceOneInFourPass_OddAnswer_3" name="editChoiceOneInFourPassAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer c</label>
                                    <textarea id="editchoiceOneInFourPass_Odd_explanation_answer_3" name="editchoiceOneInFourPass_explanation_answer_3"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFourPass_OddAnswer_3">
                                    <label class="form-label" style="font-size: 13px;"><span>D: </span><input type="radio"  value="d" name="choiceOneInFourPass"></label>
                                    <textarea id="editChoiceOneInFourPass_OddAnswer_4" name="editChoiceOneInFourPassAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer D</label>
                                    <textarea id="editchoiceOneInFourPass_Odd_explanation_answer_4" name="editchoiceOneInFourPass_explanation_answer_4"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                            </ul>
                        </div>

                        {{-- new  --}}
                        <div class="choiceOneInFourPass_Even">
                            <input type="hidden" name="addQuestionType" id="questionType" value="choiceOneInFourPass_Even">
                            <ul class="answerOptionLsit">
                                <li class="choiceOneInFourPass_EvenAnswer_0">
                                    <label class="form-label" style="font-size: 13px;"><span>F: </span><input type="radio" value="f" name="choiceOneInFourPass"></label>
                                    <textarea id="editChoiceOneInFourPass_EvenAnswer_1" name="editChoiceOneInFourPassAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer F</label>
                                    <textarea id="editchoiceOneInFourPass_Even_explanation_answer_1" name="editchoiceOneInFourPass_explanation_answer_1"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFourPass_EvenAnswer_1">
                                    <label class="form-label" style="font-size: 13px;"><span>G: </span><input type="radio"  value="g" name="choiceOneInFourPass"></label>
                                    <textarea id="editChoiceOneInFourPass_EvenAnswer_2" name="editChoiceOneInFourPassAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer G</label>
                                    <textarea id="editchoiceOneInFourPass_Even_explanation_answer_2" name="editchoiceOneInFourPass_explanation_answer_2"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFourPass_EvenAnswer_2">
                                    <label class="form-label" style="font-size: 13px;"><span>H: </span><input type="radio"  value="h" name="choiceOneInFourPass"></label>
                                    <textarea id="editChoiceOneInFourPass_EvenAnswer_3" name="editChoiceOneInFourPassAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer H</label>
                                    <textarea id="editchoiceOneInFourPass_Even_explanation_answer_3" name="editchoiceOneInFourPass_explanation_answer_3"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFourPass_EvenAnswer_3">
                                    <label class="form-label" style="font-size: 13px;"><span>J: </span><input type="radio"  value="j" name="choiceOneInFourPass"></label>
                                    <textarea id="editChoiceOneInFourPass_EvenAnswer_4" name="editChoiceOneInFourPassAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer J</label>
                                    <textarea id="editchoiceOneInFourPass_Even_explanation_answer_4" name="editchoiceOneInFourPass_explanation_answer_4"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                            </ul>
                        </div>

                        <div class="choiceMultInFourFill">
                            <input type="hidden" name="questionType" id="questionType" value="choiceMultInFourFill">
                            
                            <label class="form-label">
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
                                    <li class="choiceMultInFourFillwithOutFillOpt_0"><label class="form-label" style="font-size: 13px;"><span>A: </span> <input type="checkbox" value="a" name="choiceMultInFourFill[]"></label><textarea id="editChoiceMultInFourFillAnswer_1" name="editChoiceMultInFourFillAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li>
                                    <li>
                                        <label class="form-label">Explanation Answer A</label>
                                        <textarea id="editchoiceMultInFourFill_explanation_answer_1" name="editchoiceMultInFourFill_explanation_answer_1"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceMultInFourFillwithOutFillOpt_1"><label class="form-label" style="font-size: 13px;"><span>B: </span><input type="checkbox"  value="b" name="choiceMultInFourFill[]"></label><textarea id="editChoiceMultInFourFillAnswer_2" name="editChoiceMultInFourFillAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea></li>
                                    <li>
                                        <label class="form-label">Explanation Answer B</label>
                                        <textarea id="editchoiceMultInFourFill_explanation_answer_2" name="editchoiceMultInFourFill_explanation_answer_2"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceMultInFourFillwithOutFillOpt_2"><label class="form-label" style="font-size: 13px;"><span>C: </span><input type="checkbox"  value="c" name="choiceMultInFourFill[]"></label><textarea id="editChoiceMultInFourFillAnswer_3" name="editChoiceMultInFourFillAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li>
                                    <li>
                                        <label class="form-label">Explanation Answer C</label>
                                        <textarea id="editchoiceMultInFourFill_explanation_answer_3" name="editchoiceMultInFourFill_explanation_answer_3"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceMultInFourFillwithOutFillOpt_3"><label class="form-label" style="font-size: 13px;"><span>D:</span><input type="checkbox"  value="d" name="choiceMultInFourFill[]"></label><textarea id="editChoiceMultInFourFillAnswer_4" name="editChoiceMultInFourFillAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li>
                                    <li>
                                        <label class="form-label">Explanation Answer D</label>
                                        <textarea id="editchoiceMultInFourFill_explanation_answer_4" name="editchoiceMultInFourFill_explanation_answer_4"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                </ul>  
                            </div>
                            
                            <div class="multiChoice_field withOutFillOptChoice" style="display:none">
                                <ul class="answerOptionLsit">
                                    <li class="choiceMultInFourFillwithOutFillOptChoice_0"><label class="form-label" style="font-size: 13px;"><span>A: </span> <input type="radio" value="a" name="editChoiceMultiChoiceInFourFill"></label><textarea id="editChoiceMultiChoiceInFourFill_1" name="editChoiceMultiChoiceInFourFill_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li>
                                    <li>
                                        <label class="form-label">Explanation Answer A</label>
                                        <textarea id="editchoiceMultiChoiceInFourFill_explanation_answer_1" name="editchoiceMultiChoiceInFourFill_explanation_answer_1"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceMultInFourFillwithOutFillOptChoice_1"><label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="editChoiceMultiChoiceInFourFill"></label><textarea id="editChoiceMultiChoiceInFourFill_2" name="editChoiceMultiChoiceInFourFill_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea></li>
                                    <li>
                                        <label class="form-label">Explanation Answer B</label>
                                        <textarea id="editchoiceMultiChoiceInFourFill_explanation_answer_2" name="editchoiceMultiChoiceInFourFill_explanation_answer_2"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceMultInFourFillwithOutFillOptChoice_2"><label class="form-label" style="font-size: 13px;"><span>C: </span><input type="radio"  value="c" name="editChoiceMultiChoiceInFourFill"></label><textarea id="editChoiceMultiChoiceInFourFill_3" name="editChoiceMultiChoiceInFourFill_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li>
                                    <li>
                                        <label class="form-label">Explanation Answer C</label>
                                        <textarea id="editchoiceMultiChoiceInFourFill_explanation_answer_3" name="editchoiceMultiChoiceInFourFill_explanation_answer_3"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceMultInFourFillwithOutFillOptChoice_3"><label class="form-label" style="font-size: 13px;"><span>D:</span><input type="radio"  value="d" name="editChoiceMultiChoiceInFourFill"></label><textarea id="editChoiceMultiChoiceInFourFill_4" name="editChoiceMultiChoiceInFourFill_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li>
                                    <li>
                                        <label class="form-label">Explanation Answer D</label>
                                        <textarea id="editchoiceMultiChoiceInFourFill_explanation_answer_4" name="editchoiceMultiChoiceInFourFill_explanation_answer_4"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
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
                <input type="hidden" name="editQuestionOrder" value="0" id="editQuestionOrder">
                <input type="hidden" name="currentModelQueId" value="0" id="currentModelQueId">
                <input type="hidden" name="sectionAddId" value="0" class="sectionAddId">
                <button type="button" class="btn btn-primary update_question_section">Update changes</button>
            </div>
        </div>        
    </div>
</div>
<!-- Modal -->

<!-- start add  multiple question -->

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

                    {{-- <div class="mb-2">
                        <label class="form-label" for="addTag">Question Tags</label>
                        <input type="text" maxlength="30"
                            id="addTag"
                            placeholder="add tag" class="form-control" onkeypress="addTagFunc(event)"/>

                        <div class="row items-push mt-2 add-tag-div">                                  
                           
                        </div>
                    </div> --}}
                    <div class="mb-2">
                        <label class="form-label" for="tags">Question Tags</label>
                        <input name="tags" id="questionTags" placeholder="add tags" class="form-control"/>
                    </div>

                    {{-- <div class="mb-2 mb-4"> 
                        <label for="new_question_type_select">Question type:</label>
                        <select class="form-control form-control-lg form-control-alt"  name="new_question_type_select" id="new_question_type_select">
                            <option value="">Select Question Type</option>
                            @foreach($getQuestionTypes as $singleQuestionTypes)
                            <option value="{{$singleQuestionTypes->id}}">{{$singleQuestionTypes->question_type_title}}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="input-container" id="add_New_Types">
                        <div class="d-flex input-field align-items-center">
                            <div class="col-md-5 mb-2 me-2 category-custom">
                                <label for="category_type" class="form-label">Category Type</label>
                                <select class="js-select2 select categoryType" id="add_category_type_0" name="add_category_type" onchange="insertCategoryType(this)" multiple>
                                    @foreach ($getCategoryTypes as $categoryType)
                                        <option value="{{ $categoryType->id }}">{{ $categoryType->category_type_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2 col-md-5 add_question_type_select">
                                <label for="search-input" class="form-label">Question Type</label>
                                <select class="js-select2 select questionType" id="add_search-input_0" name="add_search-input" onchange="insertQuestionType(this)" multiple>
                                    @foreach ($getQuestionTypes as $questionType)
                                        <option value="{{ $questionType->id }}">{{ $questionType->question_type_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 add-position">
                                <button class="plus-button add-plus-button" data-id="1" onclick="addNewType(this)"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row passage-container">
                        <div class="mb-2 col-md-6">
                            <label for="passage_number" class="form-label">Passage No</label>
                            <select class="js-select2 select addPassNumber" id="add_passage_number" name="passage_number">
                                <option value="">Select Passage No</option>
                                @for($i = 1; $i < 25; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-2 col-md-6">
                            <label class="form-label">Passages</label>
                            <select name="addPassagesType" class="form-control addPassagesType js-select2 select"></select>
                        </div>
                    </div>
                    {{-- <div class="mb-2">
                        <label class="form-label" style="font-size: 13px;">Passages:</label>
                        <select name="addPassagesType" class="form-control addPassagesType">
                            <option value="">Select Passages</option>
                            
                        </select>
                    </div> --}}
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
                    
                    {{-- <div class="mb-2">
                        <label class="form-label" style="font-size: 13px;">Passage Number:</label>
                        <select class="addPassNumber">
                            <option value="">Select Passages Number</option>
                            @for($i=1;$i<25;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div> --}}
                    <input type="hidden" name="selectedAnswerType" id="selectedAnswerType">
                    <div class="mb-2" id="addSelectedLayoutQuestion">
                    <div class="addchoiceOneInFour_Odd">
                        <input type="hidden" name="addQuestionType" id="addQuestionType" value="choiceOneInFour_Odd">
                        <ul class="answerOptionLsit">
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>A: </span><input type="radio" value="a" name="addChoiceOneInFour"></label>
                                <textarea id="choiceOneInFour_OddAnswer_1" name="choiceOneInFourAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer A</label>
                                <textarea id="choiceOneInFour_Odd_explanation_answer_1" name="choiceOneInFour_explanation_answer_1"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="addChoiceOneInFour"></label>
                                <textarea id="choiceOneInFour_OddAnswer_2" name="choiceOneInFourAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer B</label>
                                <textarea id="choiceOneInFour_Odd_explanation_answer_2" name="choiceOneInFour_explanation_answer_2"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>C:</span>
                                    <input type="radio"  value="c" name="addChoiceOneInFour">
                                </label>
                                <textarea id="choiceOneInFour_OddAnswer_3" name="choiceOneInFourAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer C</label>
                                <textarea id="choiceOneInFour_Odd_explanation_answer_3" name="choiceOneInFour_explanation_answer_3"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>D: </span>
                                    <input type="radio"  value="d" name="addChoiceOneInFour">
                                </label>    
                                <textarea id="choiceOneInFour_OddAnswer_4" name="choiceOneInFourAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer D</label>
                                <textarea id="choiceOneInFour_Odd_explanation_answer_4" name="choiceOneInFour_explanation_answer_4"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                        </ul>
                    </div>

                    {{-- new  --}}
                    <div class="addchoiceOneInFour_Even">
                        <input type="hidden" name="addQuestionType" id="addQuestionType" value="choiceOneInFour_Even">
                        <ul class="answerOptionLsit">
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>F: </span><input type="radio" value="f" name="addChoiceOneInFour"></label>
                                <textarea id="choiceOneInFour_EvenAnswer_1" name="choiceOneInFourAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer F</label>
                                <textarea id="choiceOneInFour_Even_explanation_answer_1" name="choiceOneInFour_explanation_answer_1"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>G: </span><input type="radio"  value="g" name="addChoiceOneInFour"></label>
                                <textarea id="choiceOneInFour_EvenAnswer_2" name="choiceOneInFourAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer G</label>
                                <textarea id="choiceOneInFour_Even_explanation_answer_2" name="choiceOneInFour_explanation_answer_2"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>H:</span>
                                    <input type="radio"  value="h" name="addChoiceOneInFour">
                                </label>
                                <textarea id="choiceOneInFour_EvenAnswer_3" name="choiceOneInFourAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer H</label>
                                <textarea id="choiceOneInFour_Even_explanation_answer_3" name="choiceOneInFour_explanation_answer_3"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>J: </span>
                                    <input type="radio"  value="j" name="addChoiceOneInFour">
                                </label>    
                                <textarea id="choiceOneInFour_EvenAnswer_4" name="choiceOneInFourAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer J</label>
                                <textarea id="choiceOneInFour_Even_explanation_answer_4" name="choiceOneInFour_explanation_answer_4"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                        </ul>
                    </div>

                    <div class="addchoiceOneInFive_Odd">
                        <input type="hidden" name="addQuestionType" id="addQuestionType" value="choiceOneInFive_Odd">
                        <ul class="answerOptionLsit">
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>A: </span><input type="radio" value="a" name="addChoiceOneInFive"></label>
                                <textarea id="choiceOneInFive_OddAnswer_1" name="choiceOneInFiveAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer A</label>
                                <textarea id="choiceOneInFive_Odd_explanation_answer_1" name="choiceOneInFive_explanation_answer_1"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="addChoiceOneInFive"></label>
                                <textarea id="choiceOneInFive_OddAnswer_2" name="choiceOneInFiveAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer B</label>
                                <textarea id="choiceOneInFive_Odd_explanation_answer_2" name="choiceOneInFive_explanation_answer_2"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>C:</span><input type="radio"  value="c" name="addChoiceOneInFive"></label>
                                <textarea id="choiceOneInFive_OddAnswer_3" name="choiceOneInFiveAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer C</label>
                                <textarea id="choiceOneInFive_Odd_explanation_answer_3" name="choiceOneInFive_explanation_answer_3"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>D: </span><input type="radio"  value="d" name="addChoiceOneInFive"></label>
                                <textarea id="choiceOneInFive_OddAnswer_4" name="choiceOneInFiveAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer D</label>
                                <textarea id="choiceOneInFive_Odd_explanation_answer_4" name="choiceOneInFive_explanation_answer_4"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>E: </span><input type="radio"  value="e" name="addChoiceOneInFive"></label>
                                <textarea id="choiceOneInFive_OddAnswer_5" name="choiceOneInFiveAnswer_5" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer E</label>
                                <textarea id="choiceOneInFive_Odd_explanation_answer_5" name="choiceOneInFive_explanation_answer_5"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                        </ul>
                    </div>

                    {{-- new  --}}
                    <div class="addchoiceOneInFive_Even">
                        <input type="hidden" name="addQuestionType" id="addQuestionType" value="choiceOneInFive_Even">
                        <ul class="answerOptionLsit">
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>F: </span><input type="radio" value="f" name="addChoiceOneInFive"></label>
                                <textarea id="choiceOneInFive_EvenAnswer_1" name="choiceOneInFiveAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer F</label>
                                <textarea id="choiceOneInFive_Even_explanation_answer_1" name="choiceOneInFive_explanation_answer_1"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>G: </span><input type="radio"  value="g" name="addChoiceOneInFive"></label>
                                <textarea id="choiceOneInFive_EvenAnswer_2" name="choiceOneInFiveAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer G</label>
                                <textarea id="choiceOneInFive_Even_explanation_answer_2" name="choiceOneInFive_explanation_answer_2"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>H:</span><input type="radio"  value="h" name="addChoiceOneInFive"></label>
                                <textarea id="choiceOneInFive_EvenAnswer_3" name="choiceOneInFiveAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer H</label>
                                <textarea id="choiceOneInFive_Even_explanation_answer_3" name="choiceOneInFive_explanation_answer_3"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>J: </span><input type="radio"  value="j" name="addChoiceOneInFive"></label>
                                <textarea id="choiceOneInFive_EvenAnswer_4" name="choiceOneInFiveAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer J</label>
                                <textarea id="choiceOneInFive_Even_explanation_answer_4" name="choiceOneInFive_explanation_answer_4"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>K: </span><input type="radio"  value="k" name="addChoiceOneInFive"></label>
                                <textarea id="choiceOneInFive_EvenAnswer_5" name="choiceOneInFiveAnswer_5" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer K</label>
                                <textarea id="choiceOneInFive_Even_explanation_answer_5" name="choiceOneInFive_explanation_answer_5"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                        </ul>
                    </div>

                    <div class="addchoiceOneInFourPass_Odd">
                        <input type="hidden" name="addQuestionType" id="addQuestionType" value="choiceOneInFourPass_Odd">
                        <ul class="answerOptionLsit">
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>A: </span><input type="radio" value="a" name="addChoiceOneInFourPass"></label>
                                <textarea id="choiceOneInFourPass_OddAnswer_1" name="choiceOneInFourPassAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer A</label>
                                <textarea id="choiceOneInFourPass_Odd_explanation_answer_1" name="choiceOneInFourPass_explanation_answer_1"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="addChoiceOneInFourPass"></label>
                                <textarea id="choiceOneInFourPass_OddAnswer_2" name="choiceOneInFourPassAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer B</label>
                                <textarea id="choiceOneInFourPass_Odd_explanation_answer_2" name="choiceOneInFourPass_explanation_answer_2"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>C: </span><input type="radio"  value="c" name="addChoiceOneInFourPass"></label>
                                <textarea id="choiceOneInFourPass_OddAnswer_3" name="choiceOneInFourPassAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer C</label>
                                <textarea id="choiceOneInFourPass_Odd_explanation_answer_3" name="choiceOneInFourPass_explanation_answer_3"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>D: </span><input type="radio"  value="d" name="addChoiceOneInFourPass"></label>
                                <textarea id="choiceOneInFourPass_OddAnswer_4" name="choiceOneInFourPassAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer D</label>
                                <textarea id="choiceOneInFourPass_Odd_explanation_answer_4" name="choiceOneInFourPass_explanation_answer_4"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                        </ul>
                    </div>

                    <div class="addchoiceOneInFourPass_Even">
                        <input type="hidden" name="addQuestionType" id="addQuestionType" value="choiceOneInFourPass_Even">
                        <ul class="answerOptionLsit">
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>F: </span><input type="radio" value="f" name="addChoiceOneInFourPass"></label>
                                <textarea id="choiceOneInFourPass_EvenAnswer_1" name="choiceOneInFourPassAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer F</label>
                                <textarea id="choiceOneInFourPass_Even_explanation_answer_1" name="choiceOneInFourPass_explanation_answer_1"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>G: </span><input type="radio"  value="g" name="addChoiceOneInFourPass"></label>
                                <textarea id="choiceOneInFourPass_EvenAnswer_2" name="choiceOneInFourPassAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer G</label>
                                <textarea id="choiceOneInFourPass_Even_explanation_answer_2" name="choiceOneInFourPass_explanation_answer_2"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>H: </span><input type="radio"  value="h" name="addChoiceOneInFourPass"></label>
                                <textarea id="choiceOneInFourPass_EvenAnswer_3" name="choiceOneInFourPassAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer H</label>
                                <textarea id="choiceOneInFourPass_Even_explanation_answer_3" name="choiceOneInFourPass_explanation_answer_3"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <label class="form-label" style="font-size: 13px;"><span>J: </span><input type="radio"  value="j" name="addChoiceOneInFourPass"></label>
                                <textarea id="choiceOneInFourPass_EvenAnswer_4" name="choiceOneInFourPassAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer J</label>
                                <textarea id="choiceOneInFourPass_Even_explanation_answer_4" name="choiceOneInFourPass_explanation_answer_4"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                        </ul>
                    </div>

                    <div class="addchoiceMultInFourFill">
                        <input type="hidden" name="addQuestionType" id="addQuestionType" value="choiceMultInFourFill">
                        <label class="form-label" style="font-size: 13px;">
                            <select class="switchMulti getFilterChoice addMultiChoice" onChange="addMultiChoice(this.value);">
                                    <option value="">Select Choice</option>
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
                        <ul class="answerOptionLsit">
                            <li><label class="form-label" style="font-size: 13px;"><span>A: </span> <input type="checkbox" value="a" name="addChoiceMultInFourFill[]"></label><textarea id="choiceMultInFourFillAnswer_1" name="choiceMultInFourFillAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li>
                            <li>
                                <label class="form-label">Explanation Answer A</label>
                                <textarea id="choiceMultInFourFill_explanation_answer_1" name="choiceMultInFourFill_explanation_answer_1"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li><label class="form-label" style="font-size: 13px;"><span>B: </span><input type="checkbox"  value="b" name="addChoiceMultInFourFill[]"></label><textarea id="choiceMultInFourFillAnswer_2" name="choiceMultInFourFillAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea></li>
                            <li>
                                <label class="form-label">Explanation Answer B</label>
                                <textarea id="choiceMultInFourFill_explanation_answer_2" name="choiceMultInFourFill_explanation_answer_2"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li><label class="form-label" style="font-size: 13px;"><span>C: </span><input type="checkbox"  value="c" name="addChoiceMultInFourFill[]"></label><textarea id="choiceMultInFourFillAnswer_3" name="choiceMultInFourFillAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li>
                            <li>
                                <label class="form-label">Explanation Answer C</label>
                                <textarea id="choiceMultInFourFill_explanation_answer_3" name="choiceMultInFourFill_explanation_answer_3"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li><label class="form-label" style="font-size: 13px;"><span>D:</span><input type="checkbox"  value="d" name="addChoiceMultInFourFill[]"></label><textarea id="choiceMultInFourFillAnswer_4" name="choiceMultInFourFillAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li>
                            <li>
                                <label class="form-label">Explanation Answer D</label>
                                <textarea id="choiceMultInFourFill_explanation_answer_4" name="choiceMultInFourFill_explanation_answer_4"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                        </ul>    

                        </div>
                        <div class="multiChoice_field" style="display:none">
                            <ul class="answerOptionLsit">
                                <li><label class="form-label" style="font-size: 13px;"><span>A: </span> <input type="radio" value="a" name="addChoiceMultiChoiceInFourFill"></label><textarea id="addChoiceMultiChoiceInFourFill_1" name="addChoiceMultiChoiceInFourFill_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li>
                                <li>
                                    <label class="form-label">Explanation Answer A</label>
                                    <textarea id="choiceMultiChoiceInFourFill_explanation_answer_1" name="choiceMultiChoiceInFourFill_explanation_answer_1"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li><label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="addChoiceMultiChoiceInFourFill"></label><textarea id="addChoiceMultiChoiceInFourFill_2" name="addChoiceMultiChoiceInFourFill_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea></li>
                                <li>
                                    <label class="form-label">Explanation Answer B</label>
                                    <textarea id="choiceMultiChoiceInFourFill_explanation_answer_2" name="choiceMultiChoiceInFourFill_explanation_answer_2"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li><label class="form-label" style="font-size: 13px;"><span>C: </span><input type="radio"  value="c" name="addChoiceMultiChoiceInFourFill"></label><textarea id="addChoiceMultiChoiceInFourFill_3" name="addChoiceMultiChoiceInFourFill_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li>
                                <li>
                                    <label class="form-label">Explanation Answer C</label>
                                    <textarea id="choiceMultiChoiceInFourFill_explanation_answer_3" name="choiceMultiChoiceInFourFill_explanation_answer_3"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li><label class="form-label" style="font-size: 13px;"><span>D:</span><input type="radio"  value="d" name="addChoiceMultiChoiceInFourFill"></label><textarea id="addChoiceMultiChoiceInFourFill_4" name="addChoiceMultiChoiceInFourFill_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li>
                                <li>
                                    <label class="form-label">Explanation Answer D</label>
                                    <textarea id="choiceMultiChoiceInFourFill_explanation_answer_4" name="choiceMultiChoiceInFourFill_explanation_answer_4"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
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
{{-- end modal  --}}

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
                            <div class="list-group-item sectionsaprat_{{ $testsection->id }} quesBasedSecList questionaprat_{{ $practQuestion->id }}" data-section_id="{{ $testsection->id }}" data-order="{{ $practQuestion->question_order }}" data-id="{{ $practQuestion->id }}" style="display:none;">
                                <span class="glyphicon question-glyphicon-move" aria-hidden="true">
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
    <script src="{{ asset('js/tagify.min.js') }}"></script>
    <script src="{{ asset('js/tagify.polyfills.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr/toastr.min.js')}}"></script>
    <script>
        var questionCount = $('.sectionList').length + 1;
        var questionOrder = 0;
        var sectionOrder = $(`.sectionContainerList .sectionTypesFull`).length;

        function insertCategoryType(data) {
            let category_type = $(data).val();
                category_type = category_type.join(" ");
            if(category_type != '' && !containsOnlyNumbers(category_type)) {
                $.ajax({
                    type: 'post',
                    url: '{{ route("addPracticeCategoryType") }}',
                    data:{
                        searchValue: category_type,
                        '_token': $('input[name="_token"]').val()
                    },
                    success: function(res){
                        if(res.success) {
                            $(".categoryType").append('<option value=' + res.id + '>' + res.category_type_title + '</option>');
                        }
                    }
                });
            }
        }

        function containsOnlyNumbers(str) {
            return /^\d+$/.test(str);
        }

        function insertQuestionType(data){
            let question_type = $(data).val();
                question_type = question_type.join(" ");
            if(question_type != '' && !containsOnlyNumbers(question_type)) {
                $.ajax({
                    type: 'post',
                    url: '{{ route("addPracticeQuestionType") }}',
                    data:{
                        searchValue: question_type,
                        '_token': $('input[name="_token"]').val()
                    },
                    success: function(res){
                        if(res.success) {
                            $(".questionType").append('<option value=' + res.id + '>' + res.question_type_title + '</option>');
                        }
                    }
                });
            }
        }

        function dropdown_lists(url)
        {
            let site_url = $('#site_url').val();
            let option = ``;
            return $.ajax({
                url: `${site_url}${url}`,
                type: "GET",
                async: true,
                dataType: "JSON",
            }).then((resp) => {
                if (resp.success) {
                    $(resp.dropdown_list).each((index,value) => {
                        if(resp.type == 'category_type') {
                            option += `<option value="${value.id}">`;
                            option += `${value.category_type_title}`;
                            option += `</option>`;
                        } 

                        if(resp.type == 'question_type') {
                            option += `<option value="${value.id}">`;
                            option += `${value.question_type_title}`;
                            option += `</option>`;
                        }
                    });
                    return option;
                } else {
                    return option;
                }
            });
        }

        async function addNewTypes(data, type) {
            let key = null;
            if(type != 'null' && type == 'repet') {
                key = parseInt(data);
            } else {
                key = $(data).attr('data-id');
                key = parseInt(key);

                let category_type = $(`#category_type_${key - 1}`).val();

                let question_type = $(`#search-input_${key - 1}`).val();
    
                if(category_type == '') {
                    toastr.error('Please select a category type!');
                    return false;
                }
    
                if(question_type == '') {
                    toastr.error('Please select a question type!');
                    return false;
                }
            }

            let html = ``;
                html += `<div class="d-flex input-field align-items-center removeNewTypes">`;
                html += `<div class="mb-2 col-md-5 me-2">`;                
                html += `<select class="js-select2 select categoryType" id="category_type_${key}" name="category_type" onchange="insertCategoryType(this)" multiple>`;                              
                html += await dropdown_lists(`/admin/getPracticeCategoryType`);                         
                html += `</select>`;                
                html += `</div>`;                
                html += `<div class="mb-2 col-md-5 add_question_type_select">`;                
                html += `<select class="js-select2 select questionType" id="search-input_${key}" name="search-input" onchange="insertQuestionType(this)" multiple>`;                             
                html += await dropdown_lists(`/admin/getPracticeQuestionType`);            
                html += `</select>`;                
                html += `</div>`; 
                html += `<div class="col-md-2 add-minus-icon">`;                
                html += `<button class="plus-button" onclick="removeNewTypes(this)"><i class="fa-solid fa-minus"></i></button>`;                
                html += `</div>`;
                html += `</div>`;         

            $('#addNewTypes').append(html);

            $(`#search-input_${key}`).select2({
                dropdownParent: $('#questionMultiModal'),
                tags : true,
                placeholder : "Select Question type",
                maximumSelectionLength: 1
            });

            $(`#category_type_${key}`).select2({
                dropdownParent: $('#questionMultiModal'),
                tags : true,
                placeholder : "Select Category type",
                maximumSelectionLength: 1
            });

            if(type !== 'repet') {
                $(data).attr('data-id', key + 1);
            }
        }

        //new function for add category and question types
        async function addNewType(data) {
            let key = $(data).attr('data-id');
                key = parseInt(key);
                

            let category_type = $(`#add_category_type_${key - 1}`).val();
            let question_type = $(`#add_search-input_${key - 1}`).val();
          
            if(category_type == '') {
                toastr.error('Please select a category type!');
                return false;
            }

            if(question_type == '') {
                toastr.error('Please select a question type!');
                return false;
            }

            let html = ``;
                html += `<div class="d-flex input-field align-items-center removeNewType">`;
                html += `<div class="mb-2 col-md-5 me-2">`;                
                html += `<select class="js-select2 select categoryType" id="add_category_type_${key}" name="add_category_type" onchange="insertCategoryType(this)" multiple>`;                              
                html += await dropdown_lists(`/admin/getPracticeCategoryType`);                         
                html += `</select>`;                
                html += `</div>`;                
                html += `<div class="mb-2 col-md-5 add_question_type_select">`;                
                html += `<select class="js-select2 select questionType" id="add_search-input_${key}" name="add_search-input" onchange="insertQuestionType(this)" multiple>`;                             
                html += await dropdown_lists(`/admin/getPracticeQuestionType`);            
                html += `</select>`;                
                html += `</div>`; 
                html += `<div class="col-md-2 add-minus-icon">`;                
                html += `<button class="plus-button" onclick="removeNewType(this)"><i class="fa-solid fa-minus"></i></button>`;                
                html += `</div>`;
                html += `</div>`;         

            $('#add_New_Types').append(html);

            $(`#add_search-input_${key}`).select2({
                dropdownParent: $('#addQuestionMultiModal'),
                tags : true,
                placeholder : "Select Question type",
                maximumSelectionLength: 1
            });

            $(`#add_category_type_${key}`).select2({
                dropdownParent: $('#addQuestionMultiModal'),
                tags : true,
                placeholder : "Select Category type",
                maximumSelectionLength: 1
            });
            console.log("key",key);
            $(data).attr('data-id', key + 1);
        }

        function removeNewTypes(data) {
            $(data).parents('.removeNewTypes').remove();
            let count = $('.plus-button').attr('data-id');
            $('.plus-button').attr('data-id', count - 1);
        }

        function removeNewType(data) {
            $(data).parents('.removeNewType').remove();
            let count = $('.add-plus-button').attr('data-id');
            $('.add-plus-button').attr('data-id', `${count - 1 == 0 ? 1 : count - 1}`);
        }

    $(document).ready(function() {
        $( '#questionMultiModal' ).modal( {
                focus: false
        } );

        $( '#addQuestionMultiModal' ).modal( {
            focus: false
        } );

        $('input[name=tags]').tagify();

        $(`#format`).select2({
            // minimumResultsForSearch: -1,
            placeholder : "Select test type"
        });

        $(`#search-input_0`).select2({
            dropdownParent: $('#questionMultiModal'),
            tags : true,
            placeholder : "Select Question type",
            maximumSelectionLength: 1
        });

        $(`#category_type_0`).select2({
            dropdownParent: $('#questionMultiModal'),
            tags: true,
            placeholder : "Select Category type",
            maximumSelectionLength: 1
        });

        $(`#passage_number`).select2({
            dropdownParent: $('#questionMultiModal'),
            placeholder : "Select Passage No",
        });

        $(`.passagesType`).select2({
            dropdownParent: $('#questionMultiModal'),
            placeholder : "Select Passages",
        });

        $(`#testSectionType`).select2({
            dropdownParent: $('#sectionModal'),
            placeholder : "Select Section Type",
        });

        $(`#editTestSectionType`).select2({
            dropdownParent: $('#editSectionModal'),
            placeholder : "Select Section Type",
        });

        //new
        $(`#add_category_type_0`).select2({
            dropdownParent: $('#addQuestionMultiModal'),
            tags: true,
            placeholder : "Select Category type",
            maximumSelectionLength: 1
        });

        $(`#add_search-input_0`).select2({
            dropdownParent: $('#addQuestionMultiModal'),
            tags: true,
            placeholder : "Select Category type",
            maximumSelectionLength: 1
        });

        $(`#add_passage_number`).select2({
            dropdownParent: $('#addQuestionMultiModal'),
            placeholder : "Select Passage No",
        });

        $(`.addPassagesType`).select2({
                dropdownParent: $('#addQuestionMultiModal'),
                placeholder : "Select Passages",
        });
    });

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
		
        CKEDITOR.replace( 'choiceOneInFour_OddAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFour_OddAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFour_OddAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFour_OddAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        // new 
        CKEDITOR.replace( 'choiceOneInFour_EvenAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFour_EvenAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFour_EvenAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFour_EvenAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        CKEDITOR.replace( 'choiceOneInFour_Odd_explanation_answer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });CKEDITOR.replace( 'choiceOneInFour_Odd_explanation_answer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });CKEDITOR.replace( 'choiceOneInFour_Odd_explanation_answer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });CKEDITOR.replace( 'choiceOneInFour_Odd_explanation_answer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        // new 
        CKEDITOR.replace( 'choiceOneInFour_Even_explanation_answer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });CKEDITOR.replace( 'choiceOneInFour_Even_explanation_answer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });CKEDITOR.replace( 'choiceOneInFour_Even_explanation_answer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });CKEDITOR.replace( 'choiceOneInFour_Even_explanation_answer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        
        CKEDITOR.replace( 'choiceOneInFive_OddAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFive_OddAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFive_OddAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFive_OddAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFive_OddAnswer_5',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        //new
        CKEDITOR.replace( 'choiceOneInFive_EvenAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFive_EvenAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFive_EvenAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFive_EvenAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFive_EvenAnswer_5',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        
        CKEDITOR.replace( 'choiceOneInFive_Odd_explanation_answer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFive_Odd_explanation_answer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFive_Odd_explanation_answer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFive_Odd_explanation_answer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFive_Odd_explanation_answer_5',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        //new
        CKEDITOR.replace( 'choiceOneInFive_Even_explanation_answer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFive_Even_explanation_answer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFive_Even_explanation_answer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFive_Even_explanation_answer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFive_Even_explanation_answer_5',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });


        CKEDITOR.replace( 'choiceOneInFourPass_OddAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFourPass_OddAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFourPass_OddAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFourPass_OddAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        //new
        CKEDITOR.replace( 'choiceOneInFourPass_EvenAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFourPass_EvenAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFourPass_EvenAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFourPass_EvenAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        CKEDITOR.replace( 'choiceOneInFourPass_Odd_explanation_answer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFourPass_Odd_explanation_answer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFourPass_Odd_explanation_answer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFourPass_Odd_explanation_answer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        // new 
        CKEDITOR.replace( 'choiceOneInFourPass_Even_explanation_answer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFourPass_Even_explanation_answer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFourPass_Even_explanation_answer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceOneInFourPass_Even_explanation_answer_4',{
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

        
        CKEDITOR.replace( 'choiceMultInFourFill_explanation_answer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceMultInFourFill_explanation_answer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceMultInFourFill_explanation_answer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceMultInFourFill_explanation_answer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });


        //edit section started from here
        CKEDITOR.replace( 'editChoiceOneInFour_OddAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFour_OddAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFour_OddAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFour_OddAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        // new 
        CKEDITOR.replace( 'editChoiceOneInFour_EvenAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFour_EvenAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFour_EvenAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFour_EvenAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        CKEDITOR.replace( 'editchoiceOneInFour_Odd_explanation_answer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFour_Odd_explanation_answer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFour_Odd_explanation_answer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFour_Odd_explanation_answer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        // new 
        CKEDITOR.replace( 'editchoiceOneInFour_Even_explanation_answer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFour_Even_explanation_answer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFour_Even_explanation_answer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFour_Even_explanation_answer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        
        CKEDITOR.replace( 'editChoiceOneInFive_OddAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFive_OddAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFive_OddAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFive_OddAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFive_OddAnswer_5',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        //new 
        CKEDITOR.replace( 'editChoiceOneInFive_EvenAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFive_EvenAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFive_EvenAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFive_EvenAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFive_EvenAnswer_5',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        CKEDITOR.replace( 'editchoiceOneInFive_Odd_explanation_answer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFive_Odd_explanation_answer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFive_Odd_explanation_answer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFive_Odd_explanation_answer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFive_Odd_explanation_answer_5',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        // new 
        CKEDITOR.replace( 'editchoiceOneInFive_Even_explanation_answer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFive_Even_explanation_answer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFive_Even_explanation_answer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFive_Even_explanation_answer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFive_Even_explanation_answer_5',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });


        CKEDITOR.replace( 'editChoiceOneInFourPass_OddAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFourPass_OddAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFourPass_OddAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFourPass_OddAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        //new
        CKEDITOR.replace( 'editChoiceOneInFourPass_EvenAnswer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFourPass_EvenAnswer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFourPass_EvenAnswer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editChoiceOneInFourPass_EvenAnswer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        
        CKEDITOR.replace( 'editchoiceOneInFourPass_Odd_explanation_answer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFourPass_Odd_explanation_answer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFourPass_Odd_explanation_answer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFourPass_Odd_explanation_answer_4',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        //new
        CKEDITOR.replace( 'editchoiceOneInFourPass_Even_explanation_answer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFourPass_Even_explanation_answer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFourPass_Even_explanation_answer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceOneInFourPass_Even_explanation_answer_4',{
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

        
        CKEDITOR.replace( 'editchoiceMultInFourFill_explanation_answer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceMultInFourFill_explanation_answer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceMultInFourFill_explanation_answer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceMultInFourFill_explanation_answer_4',{
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

        
        CKEDITOR.replace( 'choiceMultiChoiceInFourFill_explanation_answer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceMultiChoiceInFourFill_explanation_answer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceMultiChoiceInFourFill_explanation_answer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'choiceMultiChoiceInFourFill_explanation_answer_4',{
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

        CKEDITOR.replace( 'editchoiceMultiChoiceInFourFill_explanation_answer_1',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceMultiChoiceInFourFill_explanation_answer_2',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceMultiChoiceInFourFill_explanation_answer_3',{
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace( 'editchoiceMultiChoiceInFourFill_explanation_answer_4',{
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

		$('.update_question_section').click(function() {

            $('.sectionTypesFull').show();
            var currentModelQueId = $('#currentModelQueId').val();
            var format = $('#quesFormat').val();
            var fill = 'N/A';
            var fillType = 'N/A';
            var answerType ='N/A';
            var fillVals =[];
            var multiChoice = '';
            var tags = $('input[name="tags"]').val();
                            
            var testSectionType = $('#testSectionTypeRead').val();
            var get_category_type_values = $('select[name=category_type]').map(function(i,v) {
                var category_type_arr = [];
                let category_type_val = $(v).val();
                category_type_arr.push(category_type_val);
                return category_type_arr;
            }).get();

            var get_question_type_values = $('select[name=search-input]').map(function(i,v) {
                var question_type_arr = [];
                let question_type_val = $(v).val();
                question_type_arr.push(question_type_val);
                return question_type_arr;
            }).get();

            var question = CKEDITOR.instances['js-ckeditor-addQue'].getData();
            var activeAnswerType = '.'+$('#editSelectedAnswerType').val();
            var questionType = $('#questionMultiModal '+activeAnswerType+' #questionType').val();
            // var pass = ''; //CKEDITOR.instances['js-ckeditor-passquestion'].getData();
            var pass = $('select[name="passagesType"] :selected').text();
            var passNumber = $('#questionMultiModal .passNumber').val();
			var passagesType = $('#passagesType').val();
            var passagesTypeTxt = $("#passagesType option:selected").text();

            if(format =='' || testSectionType =='' || question =='' || questionType ==''){
                $('#questionMultiModal .validError').text('Below fields are required!');
                return false;
            }else{
                $('#questionMultiModal .validError').text('');
            }
				
                if(questionType =='choiceOneInFourPass_Odd'){                

                    answerType = $('#questionMultiModal '+activeAnswerType+' input[name="choiceOneInFourPass"]:checked').val();

                } else if(questionType =='choiceOneInFourPass_Even'){

                    answerType = $('#questionMultiModal '+activeAnswerType+' input[name="choiceOneInFourPass"]:checked').val();

                } else if(questionType =='choiceOneInFive_Odd'){

                    answerType = $('#questionMultiModal '+activeAnswerType+' input[name="choiceOneInFive"]:checked').val();

                } else if(questionType =='choiceOneInFive_Even'){

                    answerType = $('#questionMultiModal '+activeAnswerType+' input[name="choiceOneInFive"]:checked').val();

                } else if(questionType =='choiceOneInFour_Odd'){

                    answerType = $('#questionMultiModal '+activeAnswerType+' input[name="choiceOneInFour"]:checked').val();

                } else if(questionType =='choiceOneInFour_Even'){

                    answerType = $('#questionMultiModal '+activeAnswerType+' input[name="choiceOneInFour"]:checked').val();

                }else if(questionType =='choiceMultInFourFill'){

                     fillVals = $('#questionMultiModal '+activeAnswerType+' input[name="choiceMultInFourFill_fill[]"]').map(function(){return $(this).val();}).get();

                    if(typeof fillVals !== 'undefined' && fillVals.length !== 0){
                        fill = fillVals.join();    
                    }
	                if($('#questionMultiModal #selectedLayoutQuestion .choiceMultInFourFill_filltype').val() !=''){
	                    fillType = $('#questionMultiModal #selectedLayoutQuestion .choiceMultInFourFill_filltype').val();  
                        multiChoice = $('.editMultipleChoice option:selected').val();
	                }
	                

                    var singleChoM = $('#questionMultiModal '+activeAnswerType+' input[name="editChoiceMultiChoiceInFourFill"]:checked').val();

                    if(typeof singleChoM !== 'undefined' && singleChoM != null){
                        
                        answerType = $('#questionMultiModal '+activeAnswerType+' input[name="editChoiceMultiChoiceInFourFill"]:checked').val();
                        multiChoice = $('.editMultipleChoice option:selected').val();

                    } else{
                        // multiChoice = 'multiChoice';
                        multiChoice = $('.editMultipleChoice option:selected').val();
                        var answerMap ='';
                        var checkIDs = $('#questionMultiModal '+activeAnswerType+' input[name="choiceMultInFourFill[]"]:checked').map(function(){       
                          answerMap += $(this).val()+', ';  
                          return $(this).val();
                        });
                        if(answerMap !=''){
                            answerType = answerMap.substring(0, answerMap.length - 2);
                        }
                    }	                
	                
	            } else if(questionType == 'choiceOneInFive'){
                    answerType = $('#questionMultiModal '+activeAnswerType+' input[name="choiceOneInFive"]:checked').val();

                } else {
	                answerType = $('#questionMultiModal  '+activeAnswerType+' input[name="'+questionType+'"]:checked').val();
	            }
                var answerContentJson = getEditAnswerContent(questionType, fill);
				var answerExpContentJson = getEditAnswerExpContent(questionType, fill);

                $('#questionMultiModal').modal('hide');
                $('#questionMultiModal').modal('hide');
                
				var section_id = $('.sectionAddId').val(); 
                var questionOrderUpdated = $('#editQuestionOrder').val(); 
				$.ajax({
					data:{
						'id': currentModelQueId,
						'format': format,
						'testSectionType': testSectionType,
						'question': question,
                        'question_order': questionOrderUpdated,
						'question_type': questionType,
						'passages': pass,
						'passage_number': passNumber,
						'passages_id': passagesType,
						'answer': answerType,
                        'answer_content': answerContentJson,
                        'answer_exp' : answerExpContentJson,
						'fill': fill,
                        'fillType': fillType,
						'multiChoice':multiChoice,
                        'section_id':section_id,
                        'tags':tags,
                        'get_question_type_values':get_question_type_values,
                        'get_category_type_values':get_category_type_values,
						'_token': $('input[name="_token"]').val()
					},
					url: '{{route("updatePracticeQuestion")}}',
					method: 'post',
					success: (res) => {
                        var btn = '<button type="button" class="btn btn-sm btn-alt-secondary edit-section" data-id="'+res.question_id+'" data-bs-toggle="tooltip" title="Edit Question" onclick="practQuestioEdit('+res.question_id+')" ><i class="fa fa-fw fa-pencil-alt"></i>  </button> <button type="button"   class="btn btn-sm btn-alt-secondary delete-section" data-id="'+res.question_id+'" data-bs-toggle="tooltip"  title="Delete Section"  onclick="practQuestioDel('+res.question_id+')" > <i class="fa fa-fw fa-times"></i>  </button>';

                        $('.singleQuest_'+currentModelQueId).html('<li>'+question+'</li><li class="answerValUpadte_'+res.question_id+'">'+answerType+'</li><li>'+passagesTypeTxt+'</li><li>'+passNumber+'</li><li>'+fill+'</li><li class="orderValUpdate_'+res.question_id+'">'+res.question_order+'</li><li>'+btn+'</li>');
						$('.addQuestion').val('');
							$('.validError').text('');
                        $('.questionaprat_'+currentModelQueId).remove();    
                        $('#listWithHandleQuestion').append('<div class="list-group-item sectionsaprat_'+section_id+' quesBasedSecList questionaprat_'+currentModelQueId+'" data-section_id="'+section_id+'" data-id="'+currentModelQueId+'" style="display:none;">\n' +
                        '<span class="glyphicon question-glyphicon-move" aria-hidden="true">\n' +
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
            clearModel();
            // count++;
            let section_id = $(this).parents('.sectionTypesFull').attr('data-id');

            if($(`.section_${section_id} .firstRecord .sectionList`).length >= 0){
                questionOrder = $(`.section_${section_id} .firstRecord .sectionList`).length;
            } else {
                questionOrder = 0;
            }

            $('.addSectionAddId').val(section_id);
            var dataId = $(this).attr("data-id");
            var format = $('#format').val();
            var AnuserOpts = $('#sectionDisplay_'+dataId+' .firstRecord ul li span .selectedSecTxt').val();
            
            $('#addTestSectionTypeRead').val(AnuserOpts);
            $('#addCurrentModelQueId').val(dataId);
            // $('.addSectionAddId').val(dataId);
            appendAnswerOption(AnuserOpts,format);
            getPassages(format);
            $(".addchoiceMultInFourFill input[type=checkbox]").each(function(){
                $(this).attr('checked', false);
            });
            
            $('#addQuestionMultiModal').modal('show');
        });

        $('.save_section').click(function() {

            var whichModel = $(this).parent().find('.whichModel').val();
            $('.sectionTypesFull').show();
            var format = $('#format').val();
            var currentModelQueId = $('#addCurrentModelQueId').val();

            var testSectionTitle = $('#testSectiontitle').val();
            var testSectionType = $('#testSectionType').val();
            var tags = $('input[name="tags"]').val();
            
            var fill = 'N/A';
            var fillType = 'N/A';
            var answerType ='N/A';
            var fillVals= [];
            var multiChoice = '';

            if (whichModel == 'section') {

                if (format == '' || testSectionType == '' || testSectionTitle == '') {
                    $('#sectionModal .validError').text('Below fields are required!');
                    return false;
                } else {
                    $('#sectionModal .validError').text('');
                }
                var get_test_id = jQuery('#get_question_id').val();
                $('#sectionModal').modal('hide');
                $('#questionMultiModal').modal('hide');
                var sectionSelectedTxt = testSectionType.replaceAll('_', ' ');
                var currentModelId = $('#currentModelId').val();
                sectionOrder++;
                questionOrder = 0;

                $.ajax({
                    data: {
                        'format': format,
                        'testSectionTitle': testSectionTitle,
                        'testSectionType': testSectionType,
                        'get_test_id': get_test_id,
                        'order': sectionOrder,
                        '_token': $('input[name="_token"]').val()
                    },
                    url: '{{ route('addPracticeTestSection') }}',
                    method: 'post',
                    success: (res) => {
                        $('.sectionContainerList').append(
                            '<div class="sectionTypesFull section_'+res+'" data-id="'+res+'" id="sectionDisplay_' + currentModelId +
                            '" ><div class="mb-2 mb-4"><div class="sectionTypesFullMutli"> </div> <div class="sectionTypesFullMutli firstRecord"><ul class="sectionListtype"><li>Type: &nbsp;<strong>' +
                            format +
                            '</strong></li><li>Section Type:&nbsp;<span class="answerOption editedAnswerOption_'+res+'"><strong>' +
                            capitalizeFirstLetter(sectionSelectedTxt) +
                            '</strong><input type="hidden" name="selectedSecTxt" value="' +
                            testSectionType +
                            '" class="selectedSecTxt selectedSection_'+res+'" ></span></li><li>Order: &nbsp;<input type="number" readonly class="form-control" name="order" value="'+sectionOrder+'" id="order_' +
                            res +
                            '"/><button type="button" class="input-group-text d-none" id="basic-addon2" onclick="openOrderDialog()"><i class="fa-solid fa-check"></i></button></li><li><button type="button" class="btn btn-sm btn-alt-secondary editSection" data-id="'+res+'" onclick="editSection(this)" data-bs-toggle="tooltip" title="Edit Question"><i class="fa fa-fw fa-pencil-alt"></i></button><button type="button" class="btn btn-sm btn-alt-secondary deleteSection" data-id="'+res+'" onclick="deleteSection(this)" data-bs-toggle="tooltip" title="Delete Section"><i class="fa fa-fw fa-times"></i></button></li></ul><ul class="sectionHeading"><li>Question</li><li>Answer</li> <li>Passage</li><li>Passage Number</li><li>Fill Answer</li><li class="' +
                            res +
                            '">Order</li><li>Action</li></ul></div></div><div class="mb-2 mb-4 partTestOrder"><button type="button" data-id="' +
                            currentModelId +
                            '" class="btn w-25 btn-alt-success add_question_modal_multi"><i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Question</button><div class="part_order"><input type="number" readonly class="form-control" name="question_order" value="0" id="order_' +
                            res +
                            '"/><button type="button" class="input-group-text" id="basic-addon2" onclick="openQuestionDialog(' +
                            res + ')"><i class="fa-solid fa-check"></i></button></div></div></div>');

                        $('.addQuestion').val('');
                        $('.validError').text('');
                        $('.sectionAddId').val(res);

                        $('#listWithHandle').append('<div class="list-group-item">\n' +
                            '<span class="glyphicon glyphicon-move" aria-hidden="true">\n' +
                            '<i class="fa-solid fa-grip-vertical"></i>\n' +
                            '</span>\n' +
                            '<button class="btn btn-primary" value="' + res + '">' + res + ':- ' +
                            format + ' ' + testSectionType + '</button>\n' +
                            '</div>');

                    }
                });


            } else {
                
                var testSectionType = $('#addTestSectionTypeRead').val();
                var new_question_type_select = $(this).parent().parent().find('#new_question_type_select').val();
                
                var question = CKEDITOR.instances['js-ckeditor-add-addQue'].getData();
                var activeAnswerType = '.add'+ $('#selectedAnswerType').val();
                var questionType = $('#addQuestionMultiModal '+activeAnswerType+' #addQuestionType').val();
                // var pass = ''; //CKEDITOR.instances['js-ckeditor-passquestion'].getData();
                var pass = $('select[name="addPassagesType"] :selected').text();
                var passNumber = $('#addQuestionMultiModal .addPassNumber').val();
                var passagesType = $('.addPassagesType').val();
                var passagesTypeTxt = $(".addPassagesType option:selected").text();
                var tags = $('#questionTags').val();

                var get_category_type_values = $('select[name=add_category_type]').map(function(i,v) {
                    var category_type_arr = [];
                    let category_type_val = $(v).val();
                    category_type_arr.push(category_type_val);
                    return category_type_arr;
                }).get();

                var get_question_type_values = $('select[name=add_search-input]').map(function(i,v) {
                    var question_type_arr = [];
                    let question_type_val = $(v).val();
                    question_type_arr.push(question_type_val);
                    return question_type_arr;
                }).get();

                if(format =='' || testSectionType =='' || question =='' || questionType ==''){
                    $('#addQuestionMultiModal .validError').text('Below fields are required!');
                    return false;
                }else{
                    $('#addQuestionMultiModal .validError').text('');
                }
                
                if(questionType =='choiceOneInFourPass_Odd'){ 

                    answerType = $('#addQuestionMultiModal '+activeAnswerType+' input[name="addChoiceOneInFourPass"]:checked').val();

                } else if(questionType =='choiceOneInFourPass_Even'){

                    answerType = $('#addQuestionMultiModal '+activeAnswerType+' input[name="addChoiceOneInFourPass"]:checked').val();

                } else if(questionType =='choiceOneInFive_Odd'){

                    answerType = $('#addQuestionMultiModal '+activeAnswerType+' input[name="addChoiceOneInFive"]:checked').val();

                } else if(questionType =='choiceOneInFive_Even'){

                    answerType = $('#addQuestionMultiModal '+activeAnswerType+' input[name="addChoiceOneInFive"]:checked').val();

                }else if(questionType == 'choiceOneInFour_Odd') {

                    answerType = $('#addQuestionMultiModal '+activeAnswerType+' input[name="addChoiceOneInFour"]:checked').val();

                } else if(questionType == 'choiceOneInFour_Even'){

                    answerType = $('#addQuestionMultiModal '+activeAnswerType+' input[name="addChoiceOneInFour"]:checked').val(); 

                } else if(questionType =='choiceMultInFourFill'){
                    fillVals = $('#addQuestionMultiModal '+activeAnswerType+' input[name="addChoiceMultInFourFill_fill[]"]').map(function(){return $(this).val();}).get();
                    

                    if(typeof fillVals !== 'undefined' && fillVals.length !== 0){
                        fill = fillVals.join();    
                    }
                    
                    if($('#addQuestionMultiModal #addSelectedLayoutQuestion '+activeAnswerType+' .addChoiceMultInFourFill_filltype').val() !=''){
                        fillType = $('#addQuestionMultiModal #addSelectedLayoutQuestion '+activeAnswerType+' .addChoiceMultInFourFill_filltype').val();  
                        multiChoice = $('.addMultiChoice option:selected').val();
                    }

                    var singleChoM = $('#addQuestionMultiModal '+activeAnswerType+' input[name="addChoiceMultiChoiceInFourFill"]:checked').val();

                    if(typeof singleChoM !== 'undefined' && singleChoM != null){
                        
                        answerType = $('#addQuestionMultiModal '+activeAnswerType+' input[name="addChoiceMultiChoiceInFourFill"]:checked').val();
                        multiChoice = $('.addMultiChoice option:selected').val();

                    } else{ 
                        // multiChoice = 'multiChoice';
                        multiChoice = $('.addMultiChoice option:selected').val();
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
                    answerType = $('#addQuestionMultiModal  '+activeAnswerType+' input[name="'+questionType+'"]:checked').val();
                }
                
                var answerContentJson =getAnswerContent(questionType, fill);
                var answerExpJson = getAnswerExpContent(questionType, fill);

                $('#addQuestionMultiModal').modal('hide');
                $('#addQuestionMultiModal').modal('hide');

                questionOrder++;
                var section_id = $('.addSectionAddId').val();  
                $.ajax({
                    data:{
                        'format': format,
                        'testSectionType': testSectionType,
                        'question': question,
                        'question_order': questionOrder,
                        'question_type': questionType,
                        'passages': pass,
                        'passage_number': passNumber,
                        'passages_id': passagesType,
                        'answer': answerType,
                        'answer_content': answerContentJson,
                        'answer_exp' : answerExpJson,
                        'fill': fill,
                        'fillType': fillType,
                        'multiChoice': multiChoice,
                        'section_id':section_id,
                        'tags':tags,
                        'get_category_type_values':get_category_type_values,
                        'new_question_type_select':new_question_type_select,
                        'get_question_type_values': get_question_type_values,
                        '_token': $('input[name="_token"]').val()
                    },
                    url: '{{route("addPracticeQuestion")}}',
                    method: 'post',
                    success: (res) => {
                    $('.addQuestion').val('');
                    $('.validError').text('');

                    $('#sectionDisplay_' + currentModelQueId + ' .firstRecord').append('<ul class="sectionList singleQuest_'+res.question_id+'"><li>'+question+'</li><li class="answerValUpdate_'+res.question_id+'">'+answerType+'</li><li>'+passagesTypeTxt+'</li><li>'+passNumber+'</li><li>'+fill+'</li><li class="orderValUpdate_'+res.question_id+'">'+questionOrder+'</li><li><button type="button" class="btn btn-sm btn-alt-secondary edit-section" data-id="'+res.question_id+'" data-bs-toggle="tooltip" title="Edit Question" onclick="practQuestioEdit('+res.question_id+')"> <i class="fa fa-fw fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-alt-secondary delete-section" data-id="'+res.question_id+'" data-bs-toggle="tooltip" title="Delete Section"   onclick="practQuestioDel('+res.question_id+')">  <i class="fa fa-fw fa-times"></i></button> </li></ul>');

                    
                    $('#listWithHandleQuestion').append('<div class="list-group-item sectionsaprat_'+section_id+' quesBasedSecList questionaprat_'+res.question_id+'" data-section_id="'+section_id+'" data-id="'+res.question_id+'" style="display:none;">\n' +
                    '<span class="glyphicon question-glyphicon-move" aria-hidden="true">\n' +
                    '<i class="fa-solid fa-grip-vertical"></i>\n' +
                    '</span>\n' +
                    '<button class="btn btn-primary" value="'+res.question_id+'">'+question+'</button>\n' +
                    '</div>');  
                    questionCount++;
                    } 
                }); 
        }
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

// function nextPrev(n) {
//     var x = document.getElementsByClassName("tab");
//     if (n == 1 && !validateForm()) return false;
//     x[currentTab].style.display = "none";
//     currentTab = currentTab + n;
//     if (currentTab >= x.length) {
//         document.getElementById("regForm").submit();
//         // return false;
//         //alert("sdf");
		
//         document.getElementById("nextprevious").style.display = "none";
//         document.getElementById("all-steps").style.display = "none";
//         document.getElementById("register").style.display = "none";
//         document.getElementById("text-message").style.display = "block";




//     }
//     showTab(currentTab);
// }

function nextPrev(n) {
    var x = document.getElementsByClassName("tab");

    var test_title_val = jQuery(".test_title").val();
    var test_format_type_val = jQuery('#format').val();
    var get_test_id = jQuery('#get_question_id').val();

    if (test_title_val != '') {
        $('.testvalidError').text('');
        $.ajax({
            data: {
                'format': test_format_type_val,
                'title': test_title_val,
                'get_test_id': get_test_id,
                '_token': $('input[name="_token"]').val()
            },
            url: '{{ route('addPracticeTest') }}',
            method: 'post',
            success: (res) => {
                jQuery("#get_question_id").val(res);
            }
        });
    } else if (test_title_val == '') {
        $('.testvalidError').text('Below fields are required!');
        return false;
    }

    if (n == 1 && !validateForm()) return false;
    x[currentTab].style.display = "none";
    currentTab = currentTab + n;
    if (currentTab >= x.length) {


        document.getElementById("regForm").submit();
        return false;

        document.getElementById("nextprevious").style.display = "none";
        document.getElementById("all-steps").style.display = "none";
        document.getElementById("register").style.display = "none";
        document.getElementById("text-message").style.display = "block";
    }
    showTab(currentTab);
    clearModel();
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
    questionCount--;
    questionOrder--;
    $(`#listWithHandleQuestion .questionaprat_${id}`).remove();
    $.ajax({
            data:{
            'id': id,
            '_token': $('input[name="_token"]').val()
        },
        url: '{{route("deletePracticeQuestionById")}}',
        method: 'post',
        success: (res) => {
            $.each(res.question_ids,function(key,val){
                $(`.orderValUpdate_${key}`).text(val.question_order);
                $(`.answerValUpdate_${key}`).text(val.answer);
                $('.editSelectedAnswerType').val(val.type);
            });
            $('.singleQuest_'+id).remove();
        }
    });
}

function clearModel() {
    $('input[name=tags]').val('');
    $('#passage_number').val(null).trigger("change");
    $('#add_category_type_0').val(null).trigger("change");
    $('#add_search-input_0').val(null).trigger("change");
    $(`.removeNewTypes, .removeNewType`).remove();
    $('#passagesType').val(null).trigger("change");
    $('#passagesType').html('');
    $('#js-ckeditor-add-addQue').val(null).trigger("change");
    $('#add_passage_number').val(null).trigger("change");
}


function practQuestioEdit(id){
    clearModel();
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
                let categorytypeArr = JSON.parse(result.category_type);
                let questiontypeArr = JSON.parse(result.question_type_id);
                $('#editQuestionOrder').val(result.question_order);
                $('#currentModelQueId').val(result.id);
                $('#quesFormat').val(result.format);
                $('.sectionAddId').val(result.practice_test_sections_id);
                $('#testSectionTypeRead').val(result.type);
                $('#new_question_type_select').val(result.question_type_id);
                $('#category_type').val(result.category_type);
                CKEDITOR.instances['js-ckeditor-addQue'].setData(result.title);
                var tagsString = result.tags;
                  
                $('input[name=tags]').val(tagsString);
                $(".passNumber").val(result.passage_number).change();
                $('#passagesType').val(result.passages_id).change();
                for (let index = 1; index < categorytypeArr.length; index++) {
                    addNewTypes(index,'repet');
                }

                $('.plus-button').attr('data-id', categorytypeArr && categorytypeArr.length ? categorytypeArr.length : 0);

                setTimeout(function(){ 
                    $(categorytypeArr).each((i,v) => {
                        $(`#category_type_${i}`).val(v);
                        $(`#category_type_${i}`).trigger('change');
                    });
    
                    $(questiontypeArr).each((i,v) => {
                        $(`#search-input_${i}`).val(v);
                        $(`#search-input_${i}`).trigger('change');
                    });
                }, 1000);

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
                            opt +='<option value="'+val.id+'">'+val.title+'</option>';                      
                        });
                        $('#passagesType').html(opt);
                        $("select[name=passagesType]").val(result.passages_id).trigger('change');
                    }
                });
                getAnswerOption(result.type, result.answer, result.fill, result.fillType, result.answer_content, result.answer_exp, result.multiChoice );
            }
            $('#questionMultiModal').modal('show');
            $(`.editMultipleChoice option[value="${parseInt(result.multiChoice)}"]`).prop('selected', true);
            
        } 
    }); 
}

function getAnswerOption(answerOpt, selectedOpt, fill, fillType, answer_content, answer_exp, multiChoice){
        answer_exp = JSON.parse(answer_exp);
        if(answerOpt == 'choiceOneInFour_Odd'){
            $('#editSelectedAnswerType').val('choiceOneInFour_Odd');
            $('.choiceOneInFour_Odd').show();
            $('.choiceOneInFour_Even').hide();
            $('.choiceOneInFive_Odd').hide();
            $('.choiceOneInFive_Even').hide();
            $('.choiceOneInFourPass_Odd').hide();
            $('.choiceOneInFourPass_Even').hide();
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
        		  $('.choiceOneInFour_Odd ul li.choiceOneInFour_OddAnswer_'+arrIndex+' input ').prop("checked", true);
                }
                if(jsonConvert.length>0){
                    var anwserInd = Number(i)-1;
                    var dynIds = 'editChoiceOneInFour_OddAnswer_'+i;
                    CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]); 
                }
        	}
            if(answer_exp && answer_exp.length != null) {
                for (let index = 0; index < answer_exp.length; index++) {
                    let count = index + 1;
                    const answer_id = `editchoiceOneInFour_Odd_explanation_answer_${count}`;
                    CKEDITOR.instances[answer_id].setData(answer_exp[index]); 
                }
            }
            
            
        } 
        // new 
        if(answerOpt == 'choiceOneInFour_Even'){
            $('#editSelectedAnswerType').val('choiceOneInFour_Even');
            $('.choiceOneInFour_Odd').hide();
            $('.choiceOneInFour_Even').show();
            $('.choiceOneInFive_Odd').hide();
            $('.choiceOneInFive_Even').hide();
            $('.choiceOneInFourPass_Odd').hide();
            $('.choiceOneInFourPass_Even').hide();
            $('.choiceMultInFourFill').hide();
        	var optObj = ['f','g','h','j'];
            var jsonConvert = [];
            if(isJson(answer_content)){
                jsonConvert = $.parseJSON(answer_content);
            } 
        	var selHml='';
        	for(var i=1; i<= optObj.length; i++){
                var arrIndex = Number(i)-1;
                var editInd = Number(i)+1;
        		if(optObj[arrIndex] == selectedOpt){
        		  $('.choiceOneInFour_Even ul li.choiceOneInFour_EvenAnswer_'+arrIndex+' input ').prop("checked", true);
                }
                if(jsonConvert.length>0){
                    var anwserInd = Number(i)-1;
                    var dynIds = 'editChoiceOneInFour_EvenAnswer_'+i;
                    CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]); 
                }
        	}
            if(answer_exp && answer_exp.length != null) {
                for (let index = 0; index < answer_exp.length; index++) {
                    let count = index + 1;
                    const answer_id = `editchoiceOneInFour_Even_explanation_answer_${count}`;
                    CKEDITOR.instances[answer_id].setData(answer_exp[index]); 
                }
            }
            
            
        } 
        if(answerOpt =='choiceOneInFive_Odd'){
            $('#editSelectedAnswerType').val('choiceOneInFive_Odd');
            $('.choiceOneInFour_Odd').hide();
            $('.choiceOneInFour_Even').hide();
            $('.choiceOneInFive_Odd').show();
            $('.choiceOneInFive_Even').hide();
            $('.choiceOneInFourPass_Odd').hide();
            $('.choiceOneInFourPass_Even').hide();
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
        			$('.choiceOneInFive_Odd ul li.choiceOneInFive_OddAnswer_'+arrIndex+' input ').prop("checked", true);
        		} 
                if(jsonConvert.length>0){
                    var anwserInd = Number(i)-1;
                    var dynIds = 'editChoiceOneInFive_OddAnswer_'+i;
                    CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]); 
                }
        	}
            if(answer_exp && answer_exp.length != null) {
                for (let index = 0; index < answer_exp.length; index++) {
                    let count = index + 1;
                    const answer_id = `editchoiceOneInFive_Odd_explanation_answer_${count}`;
                    CKEDITOR.instances[answer_id].setData(answer_exp[index]); 
                }
            }

        }
        //new
        if(answerOpt =='choiceOneInFive_Even'){
            $('#editSelectedAnswerType').val('choiceOneInFive_Even');
            $('.choiceOneInFour_Odd').hide();
            $('.choiceOneInFour_Even').hide();
            $('.choiceOneInFive_Odd').hide();
            $('.choiceOneInFive_Even').show();
            $('.choiceOneInFourPass_Odd').hide();
            $('.choiceOneInFourPass_Even').hide();
            $('.choiceMultInFourFill').hide();
        	var optObj = ['f','g','h','j','k'];
        	var selHml='';
            var jsonConvert = [];
            if(isJson(answer_content)){
                jsonConvert = $.parseJSON(answer_content);
            }
        	for(var i=1; i<= optObj.length; i++){
                var arrIndex = Number(i)-1;
                var editInd = Number(i)+1;
        		if(optObj[arrIndex] == selectedOpt){
        			$('.choiceOneInFive_Even ul li.choiceOneInFive_EvenAnswer_'+arrIndex+' input ').prop("checked", true);
        		} 
                if(jsonConvert.length>0){
                    var anwserInd = Number(i)-1;
                    var dynIds = 'editChoiceOneInFive_EvenAnswer_'+i;
                    CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]); 
                }
        	}
            if(answer_exp && answer_exp.length != null) {
                for (let index = 0; index < answer_exp.length; index++) {
                    let count = index + 1;
                    const answer_id = `editchoiceOneInFive_Even_explanation_answer_${count}`;
                    CKEDITOR.instances[answer_id].setData(answer_exp[index]); 
                }
            }

        } 
        if(answerOpt =='choiceOneInFourPass_Odd'){
            $('#editSelectedAnswerType').val('choiceOneInFourPass_Odd');
            $('.choiceOneInFour_Odd').hide();
            $('.choiceOneInFour_Even').hide();
            $('.choiceOneInFive_Odd').hide();
            $('.choiceOneInFive_Even').hide();
            $('.choiceOneInFourPass_Odd').show();
            $('.choiceOneInFourPass_Even').hide();
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
        			$('.choiceOneInFourPass_Odd ul li.choiceOneInFourPass_OddAnswer_'+arrIndex+' input').prop("checked", true);
        		}
                if(jsonConvert.length>0){
                    var anwserInd = Number(i)-1;
                    var dynIds = 'editChoiceOneInFourPass_OddAnswer_'+i;
                    CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]); 
                }
        	}
            if(answer_exp && answer_exp.length != null) {
                for (let index = 0; index < answer_exp.length; index++) {
                    let count = index + 1;
                    const answer_id = `editchoiceOneInFourPass_Odd_explanation_answer_${count}`;
                    CKEDITOR.instances[answer_id].setData(answer_exp[index]); 
                }
            }
            

        }
        // new 
        if(answerOpt =='choiceOneInFourPass_Even'){
            $('#editSelectedAnswerType').val('choiceOneInFourPass_Even');
            $('.choiceOneInFour_Odd').hide();
            $('.choiceOneInFour_Even').hide();
            $('.choiceOneInFive_Odd').hide();
            $('.choiceOneInFive_Even').hide();
            $('.choiceOneInFourPass_Odd').hide();
            $('.choiceOneInFourPass_Even').show();
            $('.choiceMultInFourFill').hide();
        	var optObj = ['f','g','h','j'];
        	var selHml='';
            var jsonConvert = [];
            if(isJson(answer_content)){
                jsonConvert = $.parseJSON(answer_content);
            }            
            
        	for(var i=1; i<= optObj.length; i++){
                var arrIndex = Number(i)-1;
                var editInd = Number(i)+1;
        		if(optObj[arrIndex] == selectedOpt){
        			$('.choiceOneInFourPass_Even ul li.choiceOneInFourPass_EvenAnswer_'+arrIndex+' input').prop("checked", true);
        		}
                if(jsonConvert.length>0){
                    var anwserInd = Number(i)-1;
                    var dynIds = 'editChoiceOneInFourPass_EvenAnswer_'+i;
                    CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]); 
                }
        	}
            if(answer_exp && answer_exp.length != null) {
                for (let index = 0; index < answer_exp.length; index++) {
                    let count = index + 1;
                    const answer_id = `editchoiceOneInFourPass_Even_explanation_answer_${count}`;
                    CKEDITOR.instances[answer_id].setData(answer_exp[index]); 
                }
            }
            

        } 
        if(answerOpt == 'choiceMultInFourFill'){

            $('#editSelectedAnswerType').val('choiceMultInFourFill');
            $('.choiceOneInFour_Odd').hide();
            $('.choiceOneInFour_Even').hide();
            $('.choiceOneInFive_Odd').hide();
            $('.choiceOneInFive_Even').hide();
            $('.choiceOneInFourPass_Odd').hide();
            $('.choiceOneInFourPass_Even').hide();
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

            if(multiChoice == 1){
                for(var i=1; i<= optObj.length; i++){
                    var arrIndex = Number(i)-1;
                    var editInd = Number(i)+1;
                    if(multiChecked.includes(optObj[arrIndex])){
                        
                        $('.choiceMultInFourFill .withOutFillOpt ul li.choiceMultInFourFillwithOutFillOpt_'+arrIndex+' input').prop("checked", true);

                    }
                    if(jsonConvert.length>0){
                        var anwserInd = Number(i)-1;
                        var dynIds = 'editChoiceMultInFourFillAnswer_'+i;
                        CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]); 
                    } 
                }
                if(answer_exp && answer_exp.length != null) {
                    for (let index = 0; index < answer_exp.length; index++) {
                        let count = index + 1;
                        const answer_id = `editchoiceMultInFourFill_explanation_answer_${count}`;
                        CKEDITOR.instances[answer_id].setData(answer_exp[index]); 
                    }
                }
            }else{

                for(var i=1; i<= optObj.length; i++){
                    var arrIndex = Number(i)-1;
                    var editInd = Number(i)+1;
                    if(selectedOpt == optObj[arrIndex]){
                        
                        $('.choiceMultInFourFill .withOutFillOptChoice ul li.choiceMultInFourFillwithOutFillOptChoice_'+arrIndex+' input').prop("checked", true);

                    }
                    if(jsonConvert.length>0){
                        var anwserInd = Number(i)-1;
                        var dynIds = 'editChoiceMultiChoiceInFourFill_'+i;
                        CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]); 
                    } 
                }
                if(answer_exp && answer_exp.length != null) {
                    for (let index = 0; index < answer_exp.length; index++) {
                        let count = index + 1;
                        const answer_id = `editchoiceMultiChoiceInFourFill_explanation_answer_${count}`;
                        CKEDITOR.instances[answer_id].setData(answer_exp[index]); 
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
                if(multiChoice == 1){
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
    CKEDITOR.instances['choiceOneInFour_OddAnswer_1'].setData('');
    CKEDITOR.instances['choiceOneInFour_OddAnswer_2'].setData('');
    CKEDITOR.instances['choiceOneInFour_OddAnswer_3'].setData('');
    CKEDITOR.instances['choiceOneInFour_OddAnswer_4'].setData('');

    // new 
    CKEDITOR.instances['choiceOneInFour_EvenAnswer_1'].setData('');
    CKEDITOR.instances['choiceOneInFour_EvenAnswer_2'].setData('');
    CKEDITOR.instances['choiceOneInFour_EvenAnswer_3'].setData('');
    CKEDITOR.instances['choiceOneInFour_EvenAnswer_4'].setData('');

    CKEDITOR.instances['choiceOneInFour_Odd_explanation_answer_1'].setData('');
    CKEDITOR.instances['choiceOneInFour_Odd_explanation_answer_2'].setData('');
    CKEDITOR.instances['choiceOneInFour_Odd_explanation_answer_3'].setData('');
    CKEDITOR.instances['choiceOneInFour_Odd_explanation_answer_4'].setData('');

    // new 
    CKEDITOR.instances['choiceOneInFour_Even_explanation_answer_1'].setData('');
    CKEDITOR.instances['choiceOneInFour_Even_explanation_answer_2'].setData('');
    CKEDITOR.instances['choiceOneInFour_Even_explanation_answer_3'].setData('');
    CKEDITOR.instances['choiceOneInFour_Even_explanation_answer_4'].setData('');

    CKEDITOR.instances['choiceOneInFive_OddAnswer_1'].setData('');
    CKEDITOR.instances['choiceOneInFive_OddAnswer_2'].setData('');
    CKEDITOR.instances['choiceOneInFive_OddAnswer_3'].setData('');
    CKEDITOR.instances['choiceOneInFive_OddAnswer_4'].setData('');
    CKEDITOR.instances['choiceOneInFive_OddAnswer_5'].setData('');

    // new 
    CKEDITOR.instances['choiceOneInFive_EvenAnswer_1'].setData('');
    CKEDITOR.instances['choiceOneInFive_EvenAnswer_2'].setData('');
    CKEDITOR.instances['choiceOneInFive_EvenAnswer_3'].setData('');
    CKEDITOR.instances['choiceOneInFive_EvenAnswer_4'].setData('');
    CKEDITOR.instances['choiceOneInFive_EvenAnswer_5'].setData('');

    CKEDITOR.instances['choiceOneInFive_Odd_explanation_answer_1'].setData('');
    CKEDITOR.instances['choiceOneInFive_Odd_explanation_answer_2'].setData('');
    CKEDITOR.instances['choiceOneInFive_Odd_explanation_answer_3'].setData('');
    CKEDITOR.instances['choiceOneInFive_Odd_explanation_answer_4'].setData('');
    CKEDITOR.instances['choiceOneInFive_Odd_explanation_answer_5'].setData('');

    // new 
    CKEDITOR.instances['choiceOneInFive_Even_explanation_answer_1'].setData('');
    CKEDITOR.instances['choiceOneInFive_Even_explanation_answer_2'].setData('');
    CKEDITOR.instances['choiceOneInFive_Even_explanation_answer_3'].setData('');
    CKEDITOR.instances['choiceOneInFive_Even_explanation_answer_4'].setData('');
    CKEDITOR.instances['choiceOneInFive_Even_explanation_answer_5'].setData('');

    CKEDITOR.instances['choiceOneInFourPass_OddAnswer_1'].setData('');
    CKEDITOR.instances['choiceOneInFourPass_OddAnswer_2'].setData('');
    CKEDITOR.instances['choiceOneInFourPass_OddAnswer_3'].setData('');
    CKEDITOR.instances['choiceOneInFourPass_OddAnswer_4'].setData('');

    //new
    CKEDITOR.instances['choiceOneInFourPass_EvenAnswer_1'].setData('');
    CKEDITOR.instances['choiceOneInFourPass_EvenAnswer_2'].setData('');
    CKEDITOR.instances['choiceOneInFourPass_EvenAnswer_3'].setData('');
    CKEDITOR.instances['choiceOneInFourPass_EvenAnswer_4'].setData('');
    
    CKEDITOR.instances['choiceOneInFourPass_Odd_explanation_answer_1'].setData('');
    CKEDITOR.instances['choiceOneInFourPass_Odd_explanation_answer_2'].setData('');
    CKEDITOR.instances['choiceOneInFourPass_Odd_explanation_answer_3'].setData('');
    CKEDITOR.instances['choiceOneInFourPass_Odd_explanation_answer_4'].setData('');

    //new
    CKEDITOR.instances['choiceOneInFourPass_Even_explanation_answer_1'].setData('');
    CKEDITOR.instances['choiceOneInFourPass_Even_explanation_answer_2'].setData('');
    CKEDITOR.instances['choiceOneInFourPass_Even_explanation_answer_3'].setData('');
    CKEDITOR.instances['choiceOneInFourPass_Even_explanation_answer_4'].setData('');

    CKEDITOR.instances['choiceMultInFourFillAnswer_1'].setData('');
    CKEDITOR.instances['choiceMultInFourFillAnswer_2'].setData('');
    CKEDITOR.instances['choiceMultInFourFillAnswer_3'].setData('');
    CKEDITOR.instances['choiceMultInFourFillAnswer_4'].setData('');

    
    CKEDITOR.instances['choiceMultInFourFill_explanation_answer_1'].setData('');
    CKEDITOR.instances['choiceMultInFourFill_explanation_answer_2'].setData('');
    CKEDITOR.instances['choiceMultInFourFill_explanation_answer_3'].setData('');
    CKEDITOR.instances['choiceMultInFourFill_explanation_answer_4'].setData('');


    /***********For Edit Options****************/

    CKEDITOR.instances['editChoiceOneInFour_OddAnswer_1'].setData('');
    CKEDITOR.instances['editChoiceOneInFour_OddAnswer_2'].setData('');
    CKEDITOR.instances['editChoiceOneInFour_OddAnswer_3'].setData('');
    CKEDITOR.instances['editChoiceOneInFour_OddAnswer_4'].setData('');

    // new 
    CKEDITOR.instances['editChoiceOneInFour_EvenAnswer_1'].setData('');
    CKEDITOR.instances['editChoiceOneInFour_EvenAnswer_2'].setData('');
    CKEDITOR.instances['editChoiceOneInFour_EvenAnswer_3'].setData('');
    CKEDITOR.instances['editChoiceOneInFour_EvenAnswer_4'].setData('');

    CKEDITOR.instances['editchoiceOneInFour_Odd_explanation_answer_1'].setData('');
    CKEDITOR.instances['editchoiceOneInFour_Odd_explanation_answer_2'].setData('');
    CKEDITOR.instances['editchoiceOneInFour_Odd_explanation_answer_3'].setData('');
    CKEDITOR.instances['editchoiceOneInFour_Odd_explanation_answer_4'].setData('');

    // new 
    CKEDITOR.instances['editchoiceOneInFour_Even_explanation_answer_1'].setData('');
    CKEDITOR.instances['editchoiceOneInFour_Even_explanation_answer_2'].setData('');
    CKEDITOR.instances['editchoiceOneInFour_Even_explanation_answer_3'].setData('');
    CKEDITOR.instances['editchoiceOneInFour_Even_explanation_answer_4'].setData('');

    CKEDITOR.instances['editChoiceOneInFive_OddAnswer_1'].setData('');
    CKEDITOR.instances['editChoiceOneInFive_OddAnswer_2'].setData('');
    CKEDITOR.instances['editChoiceOneInFive_OddAnswer_3'].setData('');
    CKEDITOR.instances['editChoiceOneInFive_OddAnswer_4'].setData('');
    CKEDITOR.instances['editChoiceOneInFive_OddAnswer_5'].setData('');

    // new 
    CKEDITOR.instances['editChoiceOneInFive_EvenAnswer_1'].setData('');
    CKEDITOR.instances['editChoiceOneInFive_EvenAnswer_2'].setData('');
    CKEDITOR.instances['editChoiceOneInFive_EvenAnswer_3'].setData('');
    CKEDITOR.instances['editChoiceOneInFive_EvenAnswer_4'].setData('');
    CKEDITOR.instances['editChoiceOneInFive_EvenAnswer_5'].setData('');
    
    CKEDITOR.instances['editchoiceOneInFive_Odd_explanation_answer_1'].setData('');
    CKEDITOR.instances['editchoiceOneInFive_Odd_explanation_answer_2'].setData('');
    CKEDITOR.instances['editchoiceOneInFive_Odd_explanation_answer_3'].setData('');
    CKEDITOR.instances['editchoiceOneInFive_Odd_explanation_answer_4'].setData('');
    CKEDITOR.instances['editchoiceOneInFive_Odd_explanation_answer_5'].setData('');

    // new 
    CKEDITOR.instances['editchoiceOneInFive_Even_explanation_answer_1'].setData('');
    CKEDITOR.instances['editchoiceOneInFive_Even_explanation_answer_2'].setData('');
    CKEDITOR.instances['editchoiceOneInFive_Even_explanation_answer_3'].setData('');
    CKEDITOR.instances['editchoiceOneInFive_Even_explanation_answer_4'].setData('');
    CKEDITOR.instances['editchoiceOneInFive_Even_explanation_answer_5'].setData('');

    CKEDITOR.instances['editChoiceOneInFourPass_OddAnswer_1'].setData('');
    CKEDITOR.instances['editChoiceOneInFourPass_OddAnswer_2'].setData('');
    CKEDITOR.instances['editChoiceOneInFourPass_OddAnswer_3'].setData('');
    CKEDITOR.instances['editChoiceOneInFourPass_OddAnswer_4'].setData('');

    // new 
    CKEDITOR.instances['editChoiceOneInFourPass_EvenAnswer_1'].setData('');
    CKEDITOR.instances['editChoiceOneInFourPass_EvenAnswer_2'].setData('');
    CKEDITOR.instances['editChoiceOneInFourPass_EvenAnswer_3'].setData('');
    CKEDITOR.instances['editChoiceOneInFourPass_EvenAnswer_4'].setData('');

    CKEDITOR.instances['editchoiceOneInFourPass_Odd_explanation_answer_1'].setData('');
    CKEDITOR.instances['editchoiceOneInFourPass_Odd_explanation_answer_2'].setData('');
    CKEDITOR.instances['editchoiceOneInFourPass_Odd_explanation_answer_3'].setData('');
    CKEDITOR.instances['editchoiceOneInFourPass_Odd_explanation_answer_4'].setData('');

    // new 
    CKEDITOR.instances['editchoiceOneInFourPass_Even_explanation_answer_1'].setData('');
    CKEDITOR.instances['editchoiceOneInFourPass_Even_explanation_answer_2'].setData('');
    CKEDITOR.instances['editchoiceOneInFourPass_Even_explanation_answer_3'].setData('');
    CKEDITOR.instances['editchoiceOneInFourPass_Even_explanation_answer_4'].setData('');

    CKEDITOR.instances['editChoiceMultInFourFillAnswer_1'].setData('');
    CKEDITOR.instances['editChoiceMultInFourFillAnswer_2'].setData('');
    CKEDITOR.instances['editChoiceMultInFourFillAnswer_3'].setData('');
    CKEDITOR.instances['editChoiceMultInFourFillAnswer_4'].setData('');

    CKEDITOR.instances['editchoiceMultInFourFill_explanation_answer_1'].setData('');
    CKEDITOR.instances['editchoiceMultInFourFill_explanation_answer_2'].setData('');
    CKEDITOR.instances['editchoiceMultInFourFill_explanation_answer_3'].setData('');
    CKEDITOR.instances['editchoiceMultInFourFill_explanation_answer_4'].setData('');


    CKEDITOR.instances['addChoiceMultiChoiceInFourFill_1'].setData('');
    CKEDITOR.instances['addChoiceMultiChoiceInFourFill_2'].setData('');
    CKEDITOR.instances['addChoiceMultiChoiceInFourFill_3'].setData('');
    CKEDITOR.instances['addChoiceMultiChoiceInFourFill_4'].setData('');

    
    CKEDITOR.instances['choiceMultiChoiceInFourFill_explanation_answer_1'].setData('');
    CKEDITOR.instances['choiceMultiChoiceInFourFill_explanation_answer_2'].setData('');
    CKEDITOR.instances['choiceMultiChoiceInFourFill_explanation_answer_3'].setData('');
    CKEDITOR.instances['choiceMultiChoiceInFourFill_explanation_answer_4'].setData('');

    CKEDITOR.instances['editChoiceMultiChoiceInFourFill_1'].setData('');
    CKEDITOR.instances['editChoiceMultiChoiceInFourFill_2'].setData('');
    CKEDITOR.instances['editChoiceMultiChoiceInFourFill_3'].setData('');
    CKEDITOR.instances['editChoiceMultiChoiceInFourFill_4'].setData('');
    
    CKEDITOR.instances['editchoiceMultiChoiceInFourFill_explanation_answer_1'].setData('');
    CKEDITOR.instances['editchoiceMultiChoiceInFourFill_explanation_answer_2'].setData('');
    CKEDITOR.instances['editchoiceMultiChoiceInFourFill_explanation_answer_3'].setData('');
    CKEDITOR.instances['editchoiceMultiChoiceInFourFill_explanation_answer_4'].setData('');

	}  
    function appendAnswerOption(answerOpt,format){
            
            var questionAnsComb = 
            {
                English:'choiceOneInFourPass',
                Math:'choiceOneInFive',
                Reading:'choiceOneInFourPass',
                Writing:'choiceOneInFourPass',
                Science:'choiceOneInFour',
                Math_no_calculator:'choiceMultInFourFill',
                Math_with_calculator:'choiceMultInFourFill'

            };
            $.each(questionAnsComb, function(ind,val){
                
                if(ind == answerOpt){
                    
                    if(val == 'choiceOneInFour'){
                        if(questionCount % 2 != 0){
                            $('#selectedAnswerType').val('choiceOneInFour_Odd');
                            $('.addchoiceOneInFour_Odd').show();
                            $('.addchoiceOneInFour_Even').hide();
                            $('.addchoiceOneInFive_Odd').hide();
                            $('.addchoiceOneInFive_Even').hide();
                            $('.addchoiceOneInFourPass_Odd').hide();
                            $('.addchoiceOneInFourPass_Even').hide();
                            $('.addchoiceMultInFourFill').hide();
                        } else {
                            $('#selectedAnswerType').val('choiceOneInFour_Even');
                            $('.addchoiceOneInFour_Odd').hide();
                            $('.addchoiceOneInFour_Even').show();
                            $('.addchoiceOneInFive_Odd').hide();
                            $('.addchoiceOneInFive_Even').hide();
                            $('.addchoiceOneInFourPass_Odd').hide();
                            $('.addchoiceOneInFourPass_Even').hide();
                            $('.addchoiceMultInFourFill').hide();
                        }
                    } else if(val == 'choiceOneInFive'){
                        if(questionCount % 2 != 0 && format == 'ACT'){
                            $('#selectedAnswerType').val('choiceOneInFive_Odd');
                            $('.addchoiceOneInFour_Odd').hide();
                            $('.addchoiceOneInFour_Even').hide();
                            $('.addchoiceOneInFive_Odd').show();
                            $('.addchoiceOneInFive_Even').hide();
                            $('.addchoiceOneInFourPass_Odd').hide();
                            $('.addchoiceOneInFourPass_Even').hide();
                            $('.addchoiceMultInFourFill').hide();
                        } else if(questionCount % 2 == 0 && format == 'ACT') {
                            $('#selectedAnswerType').val('choiceOneInFive_Even');
                            $('.addchoiceOneInFour_Odd').hide();
                            $('.addchoiceOneInFour_Even').hide();
                            $('.addchoiceOneInFive_Odd').hide();
                            $('.addchoiceOneInFive_Even').show();
                            $('.addchoiceOneInFourPass_Odd').hide();
                            $('.addchoiceOneInFourPass_Even').hide();
                            $('.addchoiceMultInFourFill').hide();
                        } else {
                            $('#selectedAnswerType').val('choiceOneInFive_Odd');
                            $('.addchoiceOneInFour_Odd').hide();
                            $('.addchoiceOneInFour_Even').hide();
                            $('.addchoiceOneInFive_Odd').show();
                            $('.addchoiceOneInFive_Even').hide();
                            $('.addchoiceOneInFourPass_Odd').hide();
                            $('.addchoiceOneInFourPass_Even').hide();
                            $('.addchoiceMultInFourFill').hide();
                        }
                    } else if(val == 'choiceOneInFourPass'){
                        if(questionCount % 2 != 0 && format == 'ACT'){
                            $('#selectedAnswerType').val('choiceOneInFourPass_Odd');
                            $('.addchoiceOneInFour_Odd').hide();
                            $('.addchoiceOneInFour_Even').hide();
                            $('.addchoiceOneInFive_Odd').hide();
                            $('.addchoiceOneInFive_Even').hide();
                            $('.addchoiceOneInFourPass_Odd').show();
                            $('.addchoiceOneInFourPass_Even').hide();
                            $('.addchoiceMultInFourFill').hide();
                        } else if(questionCount % 2 == 0 && format == 'ACT') {
                            $('#selectedAnswerType').val('choiceOneInFourPass_Even');
                            $('.addchoiceOneInFour_Odd').hide();
                            $('.addchoiceOneInFour_Even').hide();
                            $('.addchoiceOneInFive_Odd').hide();
                            $('.addchoiceOneInFive_Even').hide();
                            $('.addchoiceOneInFourPass_Odd').hide();
                            $('.addchoiceOneInFourPass_Even').show();
                            $('.addchoiceMultInFourFill').hide();
                        } else {
                            $('#selectedAnswerType').val('choiceOneInFourPass_Odd');
                            $('.addchoiceOneInFour_Odd').hide();
                            $('.addchoiceOneInFour_Even').hide();
                            $('.addchoiceOneInFive_Odd').hide();
                            $('.addchoiceOneInFive_Even').hide();
                            $('.addchoiceOneInFourPass_Odd').show();
                            $('.addchoiceOneInFourPass_Even').hide();
                            $('.addchoiceMultInFourFill').hide();
                        }
                    } else if(val == 'choiceMultInFourFill'){
                        $('#selectedAnswerType').val('choiceMultInFourFill');
                        $('.addchoiceOneInFour_Odd').hide();
                        $('.addchoiceOneInFour_Even').hide();
                        $('.addchoiceOneInFive_Odd').hide();
                        $('.addchoiceOneInFive_Even').hide();
                        $('.addchoiceOneInFourPass_Odd').hide();
                        $('.addchoiceOneInFourPass_Even').hide();
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
            opt += '<option value="">Select Passages</option>';
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
        $('input[name="choiceMultInFourFill_fill[]"]').remove();
        $('#selectedLayoutQuestion .multiChoice_field').hide();
    } else if(arg == 3){
        $('#selectedLayoutQuestion .multi_field').hide();
        $('#selectedLayoutQuestion .multiChoice_field').show();
        $('#selectedLayoutQuestion .fill_field').hide();
        $('input[name="choiceMultInFourFill_fill[]"]').remove();
    }else{
        $('#selectedLayoutQuestion .multi_field').hide();
        $('input[name="choiceMultInFourFill[]"]').prop("checked",false);
        $('#selectedLayoutQuestion .multiChoice_field').hide();
        $('input[name="editChoiceMultiChoiceInFourFill"]').prop("checked",false);
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
            if(answerOpt=='choiceOneInFive_Odd'){
                for(var i=1; i<6;i++){
                    var dynamicId = answerOpt+'Answer_'+i;
                    answerContenArr.push(CKEDITOR.instances[dynamicId].getData());
                }               

            } else if(answerOpt=='choiceOneInFive_Even'){
                for(var i=1; i<6;i++){
                    var dynamicId = answerOpt+'Answer_'+i;
                    answerContenArr.push(CKEDITOR.instances[dynamicId].getData());
                }

            }else {
                if(fill == '' || fill =='N/A'){

                    var choiceSel = $('.addMultiChoice').val();
                    if(choiceSel == 3){
                        for(var i=1; i<5;i++){
                            var dynamicId ='addChoiceMultiChoiceInFourFill_' + i;
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
//start new 
function getAnswerExpContent(answerOpt, fill) {
            var answerExpArr = [];
            if (answerOpt == 'choiceOneInFive_Odd') {
                for (var i = 1; i < 6; i++) {
                    var dynamicId = answerOpt + '_explanation_answer_' + i;
                    answerExpArr.push(CKEDITOR.instances[dynamicId].getData());
                }

            } else if(answerOpt == 'choiceOneInFive_Even'){
                for (var i = 1; i < 6; i++) {
                    var dynamicId = answerOpt + '_explanation_answer_' + i;
                    answerExpArr.push(CKEDITOR.instances[dynamicId].getData());
                }
                
            } else {
                if (fill == '' || fill == 'N/A') {
                    var choiceSel = $('.getFilterChoice').val();
                    if (choiceSel == 3) {
                        for (var i = 1; i < 5; i++) {
                            var dynamicId = 'choiceMultiChoiceInFourFill_explanation_answer_' + i;
                            answerExpArr.push(CKEDITOR.instances[dynamicId].getData());
                        }
                    } else {
                        for (var i = 1; i < 5; i++) {
                            var dynamicId = answerOpt + '_explanation_answer_' + i;
                            answerExpArr.push(CKEDITOR.instances[dynamicId].getData());
                        }
                    }
                }

            }
            if (answerExpArr.length > 0) {
                return JSON.stringify(answerExpArr);
            }
            return '';
        }

function getEditAnswerContent(answerOpt, fill){
            var answerContenArr = [];
            if(answerOpt=='choiceOneInFive_Odd'){
                for(var i=1; i<6;i++){
                    var dynamicId = 'edit'+capitalizeFirstLetter(answerOpt)+'Answer_'+i;
                    answerContenArr.push(CKEDITOR.instances[dynamicId].getData());
                }               

            } else if(answerOpt=='choiceOneInFive_Even'){
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

function getEditAnswerExpContent(answerOpt, fill){
            var answerExpArr = [];
            if(answerOpt=='choiceOneInFive_Odd'){
                for(var i=1; i<6;i++){
                    var dynamicId = 'edit'+answerOpt+'_explanation_answer_' + i;
                    answerExpArr.push(CKEDITOR.instances[dynamicId].getData());
                }               

            } else if(answerOpt=='choiceOneInFive_Even'){
                for(var i=1; i<6;i++){
                    var dynamicId = 'edit'+answerOpt+'_explanation_answer_' + i;
                    answerExpArr.push(CKEDITOR.instances[dynamicId].getData());
                }

            }else {
                if(fill == '' || fill =='N/A'){

                    var choiceSel = $('.editMultipleChoice').val();
                    if(choiceSel == 3){
                        for(var i=1; i<5;i++){
                            var dynamicId ='editchoiceMultiChoiceInFourFill' + '_explanation_answer_' +i;
                            answerExpArr.push(CKEDITOR.instances[dynamicId].getData());
                        }
                    }else{
                        for(var i=1; i<5;i++){
                            var dynamicId = 'edit'+answerOpt+'_explanation_answer_'+i;
                            answerExpArr.push(CKEDITOR.instances[dynamicId].getData());
                        } 
                    }                     
                }
                
            }
        if(answerExpArr.length>0){
            return JSON.stringify(answerExpArr);
        }
        return '';
}

function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
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

    $('.quesBasedSecList').hide();
    $('.sectionsaprat_'+secId).show();
    myQuestionModal.show();
}
function questionModal() {
    //$('#sectionAddId').val(0);
    myQuestionModal.hide();
}
Sortable.create(mainSectionContainer, {
    handle: '.sectionTypesFull',
    animation: 150,
    onEnd: function(evt) {
        $('.sectionContainerList .sectionTypesFull').each((index,v) => {
            let section_id = $(v).attr('data-id');
            let section_order = index + 1;
            $(`#order_${section_id}`).val(section_order);
            $.ajax({
                data:{
                    'section_order': section_order,
                    'section_id': section_id,
                    '_token': $('input[name="_token"]').val()
                },
                url: '{{route("sectionOrder")}}',
                method: 'post',
                success: (res) => {
                }
            });
        });
    }
},); 

$('.add_section_modal_btn').click(function() {
    var optionObj = [];
    var modelCount = $('.sectionTypesFull').length;
    $('#currentModelId').val(modelCount);
    $('#add_question_modal_multi').attr('data-id', modelCount);
    optionObj['ACT'] = ['English', 'Math', 'Reading', 'Science'];
    optionObj['SAT'] = ['Reading', 'Writing', 'Math (no calculator)', 'Math (with calculator)'];
    optionObj['PSAT'] = ['Reading', 'Writing', 'Math (no calculator)', 'Math (with calculator)'];
    var format = $('.ptype #format').val();

    $('#testSectionType').html('');
    var opt = '<option value="">Select Section Type</option>';
    for (var i = 0; i < optionObj[format].length; i++) {
        var typeVal = optionObj[format][i].replace(/\s/g, '_');
        typeVallev = typeVal.replace(')', '');
        typeVallev2 = typeVallev.replace('(', '');
        opt += '<option value="' + typeVallev2 + '">' + optionObj[format][i] + '</option>';
    }
    $('#testSectionType').append(opt);
    $('#sectionModal').modal('show');
});

// new 

$(document).ready(function(){
    var optionObj = [];
    var format = $('.ptype #format').val();
    optionObj['ACT'] = ['English', 'Math', 'Reading', 'Science'];
    optionObj['SAT'] = ['Reading', 'Writing', 'Math (no calculator)', 'Math (with calculator)'];
    optionObj['PSAT'] = ['Reading', 'Writing', 'Math (no calculator)', 'Math (with calculator)'];
    $('#editTestSectionType').html('');
    var opt = '<option value="">Select Section Type</option>';
    for (var i = 0; i < optionObj[format].length; i++) {
        var typeVal = optionObj[format][i].replace(/\s/g, '_');
        typeVallev = typeVal.replace(')', '');
        typeVallev2 = typeVallev.replace('(', '');
        opt += '<option value="' + typeVallev2 + '">' + optionObj[format][i] + '</option>';
    }
    $('#editTestSectionType').append(opt);
});


Sortable.create(listWithHandleQuestion, {
        handle: '.question-glyphicon-move',
        animation: 150,
        onEnd: function(evt) {
            var dataSet = evt.clone.dataset;
            var section_id = dataSet.section_id;

            $(`#listWithHandleQuestion .sectionsaprat_${section_id}`).each((index,v) => {
                var new_question_id =  $(v).attr('data-id');
                var new_question_id_order = index + 1;
                var orderId = '#orderRearnge_' + new_question_id;
                $(orderId).val(new_question_id_order);
                $('.orderValUpdate_' + new_question_id).text(new_question_id_order);
                $.ajax({
                    data: {
                        'question_order': new_question_id_order,
                        'question_id': new_question_id,
                        '_token': $('input[name="_token"]').val()
                    },
                    url: '{{ route("questionOrder") }}',
                    method: 'post',
                    success: (res) => {
                        $('#sectionDisplay_'+res.question['practice_test_sections_id']+' .firstRecord .singleQuest_'+res.question['id']).remove();
                        $('#sectionDisplay_'+res.question['practice_test_sections_id']+' .firstRecord').append('<ul class="sectionList singleQuest_'+res.question['id']+'"><li>'+res.question['title']+'</li><li>'+res.question['answer']+'</li><li>'+res.question['passages']+'</li><li>'+res.question['passage_number']+'</li><li>'+res.question['fill']+'</li><li class="orderValUpdate_'+res.question['id']+'">'+new_question_id_order+'</li><li><button type="button" class="btn btn-sm btn-alt-secondary edit-section" data-id="'+res.question['id']+'" data-bs-toggle="tooltip" title="Edit Question" onclick="practQuestioEdit('+res.question['id']+')"> <i class="fa fa-fw fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-alt-secondary delete-section" data-id="'+res.question['id']+'" data-bs-toggle="tooltip" title="Delete Section"   onclick="practQuestioDel('+res.question['id']+')">  <i class="fa fa-fw fa-times"></i></button> </li></ul>');
                    }
                });
            })
        }
    }, );

    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    function editSection(data) {
        let id = $(data).attr('data-id');
        
        $.ajax({
            data: {
                'sectionId': id ,
                '_token': $('input[name="_token"]').val()
            },
            url: '{{ route("edit_section") }}',
            method: 'post',
            success: (res) => {
                let optionObj = [];
                    optionObj['ACT'] = ['English', 'Math', 'Reading', 'Science'];
                    optionObj['SAT'] = ['Reading', 'Writing', 'Math (no calculator)', 'Math (with calculator)'];
                    optionObj['PSAT'] = ['Reading', 'Writing', 'Math (no calculator)', 'Math (with calculator)'];
                let opt = '<option value="">Select Section Type</option>';
                for (let i = 0; i < optionObj[res.sectionDetails.format].length; i++) {
                    let typeVal = optionObj[res.sectionDetails.format][i].replace(/\s/g, '_');
                        typeVallev = typeVal.replace(')', '');
                        typeVallev2 = typeVallev.replace('(', '');
                    opt += `<option value="${typeVallev2}" ${ typeVallev2 == res.sectionDetails.practice_test_type ? 'selected' : '' }>${optionObj[res.sectionDetails.format][i]}</option>`;
                }
                $('#editTestSectionType').html(opt);
                $('#editTestSectionTitle').val(`${res.sectionDetails.section_title}`);
                $('#currentSectionId').val(`${res.sectionDetails.id}`);
            }
        });
        $('#editSectionModal').modal('show');
    }

    $('.save_edited_change').click(function(){
        let id = $('#currentSectionId').val();
        let testSectionTitle = $('#editTestSectionTitle').val();
        let testSectionType = $('#editTestSectionType').val();

        $.ajax({
            data: {
                'sectionId': id ,
                'sectionTitle': testSectionTitle,
                'sectionType': testSectionType, 
                '_token': $('input[name="_token"]').val()
            },
            url: '{{ route("update_section") }}',
            method: 'post',
            success: (res) => {
                $(`.editedAnswerOption_${id}`).find('strong').text(res.updatedSection.practice_test_type);
                $(`.selectedSection_${id}`).val(`${res.updatedSection.practice_test_type}`);
                
            }
        });
        $('#editSectionModal').modal('hide');
    });

    function deleteSection(data) {
        let id = $(data).attr('data-id');
        var result = confirm("Are you sure to remove section ?");
        if(!result){
            return false;
        }
        sectionOrder--;
        $(`.section_${id}`).remove();

        $.ajax({
            data: {
                'sectionId': id ,
                '_token': $('input[name="_token"]').val()
            },
            url: '{{ route("delete_section") }}',
            method: 'post',
            success: (res) => {
                
            }
        });       
    }

    
</script>
    
@endsection