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
.input-check{
    position: relative;
    top: 13px;
    margin-left: 30px;
}
.input-check[type="checkbox"]{
    width: 30px;
    height: 30px;
    accent-color: #1f2937
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
    /* width: 100%; */
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
    width: 300px !important;
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
    max-width: 260px !important;
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

#mainSectionContainer .sortable-chosen{
    background-color: #fff !important;
    opacity: 50 !important;
    border: 1px solid #1f2937 !important;
    z-index: 999999999 !important;
}
#mainSectionContainer .sectionTypesFull{
    border: 2px solid transparent;
}

.rating-tag .select2-container{
    width: 100% !important;
}

.type-check[type="checkbox"]{
    width: 30px;
    height: 30px;
    margin-left: 10px;
    accent-color: #1f2937;
}
.preloader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999999;
    cursor: none;
}

.loader {
  border: 4px solid #f3f3f3;
  border-top: 4px solid #334155;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  animation: spin 1s linear infinite;
  margin: 0 auto;
  position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

input[type="time"]::-webkit-calendar-picker-indicator {
    display: none;
}

</style>
@endsection
@section('admin-content')
<!-- Main Container -->
<main id="main-container">
    <div class="preloader" style="display: none">
        <div class="loader" ></div>
    </div>
    <input type="hidden" id="section_type" value="">
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
                        <input type="hidden" class="testType">
						<div class="col-md-12 ptype">
							<label class="form-label">Test Type:</label>
							<select id="format" name="format" class="form-control js-select2 select">
								@foreach($testformats as $key=>$testformat)
								    <option value="{{$key}}" {{$practicetests->format == $key ? 'selected': '';}}>{{$testformat}}</option>
								@endforeach
							</select>
						</div>
                        <div class="col-md-12 ptype">
							<label class="form-label">Test Source:</label>
							<select id="source" name="source" class="form-control js-select2 select">
								@foreach($testsources as $key=>$testsource)
								    <option value="{{$key}}" {{$practicetests->test_source == $key ? 'selected': '';}}>{{$testsource}}</option>
								@endforeach
							</select>
						</div>
					</div>

                    <div class="mb-2">
                        <label class="form-label" for="status">Status</label>

                        <select name="status" class="form-control" id="status">
                            <option value="paid" @php if($practicetests->status == 'paid'){ echo 'selected';} @endphp>Paid</option>
                            <option value="unpaid" @php if($practicetests->status == 'unpaid'){ echo 'selected';} @endphp>Unpaid</option>
                        </select>
                    </div>

                    @include('admin.courses.components.product-dropdown', [
                        'product' => $practicetests->practice_tests_products()->pluck('product_id')->toArray(),
                        'status' => $practicetests->status
                    ])
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

					<div class="sectionTypesFull {{ isset($testsection->practice_test_type) && ($testsection->practice_test_type == "Math_no_calculator" || $testsection->practice_test_type == "Math_with_calculator") ? 'checkMathDiv' : '' }} section_{{ $testsection->id }}" data-id="{{ $testsection->id }}" id="sectionDisplay_{{ $testsection->id }}" >
					<div class="mb-2 mb-4">
						<div class="sectionTypesFullMutli"> </div>
						<div class="sectionTypesFullMutli firstRecord">
							<ul class="sectionListtype">
								<li>Type: &nbsp;<strong>{{ $testsection->format }}</strong></li>
								<li>Section Type:&nbsp;<span class="answerOption editedAnswerOption_{{$testsection->id}}"><strong>{{ $testsection->section_title }}</strong>
								<input type="hidden" name="selectedSecTxt" value="{{ ($testsection->practice_test_type == 'Math') ? 'Math_no_calculator' : $testsection->practice_test_type }}" class="selectedSecTxt selectedSection_{{$testsection->id}}" >
                                <input type="hidden" name="selectedQuesType" value="{{ $testsection->practice_test_type }}" class="selectedQuesType" >
                                </span>
								</li>
                                <li><p class="mb-0 d-flex">Order:</p> &nbsp;<input type="number" readonly class="form-control me-1" name="section_order" value="{{ $testsection->section_order }}" id="order_{{ $testsection->id }}"/><button type="button" class="input-group-text d-none" id="basic-addon2" onclick="openOrderDialog({{$testsection->id}})"><i class="fa-solid fa-check"></i></button></li>
                                <li class="edit-close-btn">
                                    <button type="button" class="btn btn-sm btn-alt-secondary editSection me-2" data-id="{{$testsection->id}}" onclick="editSection(this)" data-bs-toggle="tooltip" title="Edit Section">
                                        <i class="fa fa-fw fa-pencil-alt"></i></button>
                                    <button type="button" class="btn btn-sm btn-alt-secondary deleteSection" data-section_type="{{ $testsection->practice_test_type }}" data-id="{{ $testsection->id }}" onclick="deleteSection(this)"  data-bs-toggle="tooltip" title="Delete Section">
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
                                <ul class="sectionList singleQuest_{{ $practQuestion->id }}" data-id="{{ $practQuestion->id }}">
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

                        <button type="button"  data-id="{{ $testsection->id }}" class="btn w-25 btn-alt-success me-2 add_question_modal_multi"><i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Question</button>
                        <button type="button"  data-id="{{ $testsection->id }}" data-section_type="{{ $testsection->practice_test_type }}" data-test_id="{{ $testsection->testid }}" item-count="1" class="btn w-25 btn-alt-success {{ (in_array($testsection->format, ['DSAT','DPSAT'])) ? 'digi_add_score_btn ' : ' add_score_btn' }} " data-bs-dismiss="modal"><i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Score</button>
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

                                        <div class="mb-2 row">
                                            <div class="col-md-6">
                                                <label class="form-label" style="font-size: 13px;">Practice Test Section Type:</label>
                                                <select id="testSectionType" name="testSectionType" class="form-control js-select2 select" onchange="addClassScore(this)">

                                                </select>
                                                
                                            </div>
                                            <div class="col-md-6 for_digital_only">
                                                <label class="form-label" style="font-size: 13px;">Required Number Of Correct Answers:<span
                                                        class="text-danger">*</span></label>
                                                <input id="required_number_of_correct_answers" 
                                                    name="required_number_of_correct_answers" 
                                                    class="form-control" type="number"
                                                    
                                                    placeholder="Enter Required Number Of Correct Answers" >
                                            </div>
                                        </div>

                                        {{-- <div class="mb-2">
                                            <label class="form-label" style="font-size: 13px;">Regular Time</label>
                                            <input type="time" id="regular_time" name="regular_time" step="1" class="form-control">
                                        </div> --}}

                                        <div class="mb-2">
                                            <label class="form-label" style="font-size: 13px;">Regular Time</label>
                                            <div id="time-span" class="d-flex">
                                                <input type="number" id="regular_time_hour" step="1" class="form-control me-1" placeholder="Enter Hours"/><span style="font-weight: 700">:</span><input type="number" id="regular_time_minute" min="0" max="59" step="1"  class="form-control ms-1 me-1" placeholder="Enter Minutes" oninput="validateInput(this)"/><span style="font-weight: 700">:</span><input type="number" id="regular_time_second" min="0" max="59" step="1"  class="form-control ms-1" placeholder="Enter Seconds" oninput="validateInput(this)"/>
                                            </div>
                                        </div>

                                        {{-- <div class="mb-2">
                                            <label class="form-label" style="font-size: 13px;">50% Extended Time</label>
                                            <input type="time" id="50extended" name="50extended" step="1" class="form-control">
                                        </div> --}}

                                        <div class="mb-2">
                                            <label class="form-label" style="font-size: 13px;">50% Extended Time</label>
                                            <div id="time-span" class="d-flex">
                                                <input type="number" id="50extendedhour" step="1" class="form-control me-1" placeholder="Enter Hours"/><span style="font-weight: 700">:</span><input type="number" id="50extendedminute" min="0" max="59" step="1"  class="form-control ms-1 me-1" placeholder="Enter Minutes" oninput="validateInput(this)"/><span style="font-weight: 700">:</span><input type="number" id="50extendedsecond" min="0" max="59" step="1"  class="form-control ms-1" placeholder="Enter Seconds" oninput="validateInput(this)"/>
                                            </div>
                                        </div>

                                        {{-- <div class="mb-2">
                                            <label class="form-label" style="font-size: 13px;">100% Extended Time</label>
                                            <input type="time" id="100extended" name="100extended" step="1" class="form-control">
                                        </div> --}}

                                        <div class="mb-2">
                                            <label class="form-label" style="font-size: 13px;">100% Extended Time</label>
                                            <div id="time-span" class="d-flex">
                                                <input type="number" id="100extendedhour" step="1" class="form-control me-1" placeholder="Enter Hours"/><span style="font-weight: 700">:</span><input type="number" id="100extendedminute" min="0" max="59" step="1"  class="form-control ms-1 me-1" placeholder="Enter Minutes" oninput="validateInput(this)"/><span style="font-weight: 700">:</span><input type="number" id="100extendedsecond" min="0" max="59" step="1"  class="form-control ms-1" placeholder="Enter Seconds" oninput="validateInput(this)"/>
                                            </div>
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

                                        <!-- <div class="mb-2 col-12 select-type">
                                            <label class="form-label" style="font-size: 13px;">Practice Test Section Type:</label>
                                            <select id="editTestSectionType" name="testSectionType" class="form-control js-select2 select">

                                            </select>
                                        </div> -->

                                        <div class="mb-2 row">
                                            <div class="col-md-6 select-type">
                                                <label class="form-label" style="font-size: 13px;">Practice Test Section Type:<span
                                                        class="text-danger">*</span></label>
                                                <select id="editTestSectionType" name="testSectionType" class="form-control js-select2 select">
                                                    
                                                </select>
                                            </div>
                                            <div class="col-md-6 for_digital_only">
                                                <label class="form-label" style="font-size: 13px;">Required Number Of Correct Answers:<span
                                                        class="text-danger">*</span></label>
                                                <input id="edit_required_number_of_correct_answers" 
                                                    name="edit_required_number_of_correct_answers" 
                                                    class="form-control" type="number"
                                                    
                                                    placeholder="Enter Required Number Of Correct Answers" >
                                            </div>
                                        </div>

                                        {{-- <div class="mb-2">
                                            <label class="form-label" style="font-size: 13px;">Regular Time</label>
                                            <input type="time" id="edit_regular_time" name="edit_regular_time" step="1" class="form-control">
                                        </div> --}}

                                        <div class="mb-2">
                                            <label class="form-label" style="font-size: 13px;">Regular Time</label>
                                            <div id="time-span" class="d-flex">
                                                <input type="number" id="edit_regular_hour" step="1" class="form-control me-1" placeholder="Enter Hours"/><span style="font-weight: 700">:</span><input type="number" id="edit_regular_minute" min="0" max="59" step="1"  class="form-control ms-1 me-1" placeholder="Enter Minutes" oninput="validateInput(this)"/><span style="font-weight: 700">:</span><input type="number" id="edit_regular_second" min="0" max="59" step="1"  class="form-control ms-1" placeholder="Enter Seconds" oninput="validateInput(this)"/>
                                            </div>
                                        </div>

                                        {{-- <div class="mb-2">
                                            <label class="form-label" style="font-size: 13px;">50% Extended Time</label>
                                            <input type="time" id="edit50extended" name="edit50extended" step="1" class="form-control">
                                        </div>  --}}

                                        <div class="mb-2">
                                            <label class="form-label" style="font-size: 13px;">50% Extended Time</label>
                                            <div id="time-span" class="d-flex">
                                                <input type="number" id="edit50extendedhour" step="1" class="form-control me-1" placeholder="Enter Hours"/><span style="font-weight: 700">:</span><input type="number" id="edit50extendedminute" min="0" max="59" step="1"  class="form-control ms-1 me-1" placeholder="Enter Minutes" oninput="validateInput(this)"/><span style="font-weight: 700">:</span><input type="number" id="edit50extendedsecond" min="0" max="59" step="1"  class="form-control ms-1" placeholder="Enter Seconds" oninput="validateInput(this)"/>
                                            </div>
                                        </div>

                                        {{-- <div class="mb-2">
                                            <label class="form-label" style="font-size: 13px;">100% Extended Time</label>
                                            <input type="time" id="edit100extended" name="edit100extended" step="1" class="form-control">
                                        </div>  --}}

                                        <div class="mb-2">
                                            <label class="form-label" style="font-size: 13px;">100% Extended Time</label>
                                            <div id="time-span" class="d-flex">
                                                <input type="number" id="edit100extendedhour" step="1" class="form-control me-1" placeholder="Enter Hours"/><span style="font-weight: 700">:</span><input type="number" id="edit100extendedminute" min="0" max="59" step="1"  class="form-control ms-1 me-1" placeholder="Enter Minutes" oninput="validateInput(this)"/><span style="font-weight: 700">:</span><input type="number" id="edit100extendedsecond" min="0" max="59" step="1"  class="form-control ms-1" placeholder="Enter Seconds" oninput="validateInput(this)"/>
                                            </div>
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
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
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
                    <div class="col-12 d-flex justify-content-between">
                        <div class="mb-2 col-md-6 pe-3">
                            <label class="form-label" style="font-size: 13px;">Practice Test Section Type:</label>
                            <input id="testSectionTypeRead" readonly name="testSectionTypeRead" class="form-control">
                        </div>
                        <?php
                            $helper = new Helper;
                            $ratings = $helper->getAllDifficultyRating();
                        ?>
                        {{-- new for diff ratings  --}}
                        <div class="mb-2 col-md-6 ps-3 rating-tag">
                            <label class="form-label" style="font-size: 13px;">Difficulty Rating</label>
                            <select class="js-select2 select diffRating" id="diff_rating_edit" name="diff_rating_edit" onchange="insertDiffRating(this)" multiple>
                                @foreach ($ratings['ratings'] as $rating)
                                    <option value="{{ $rating['id'] }}">{{ $rating['title'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label" style="font-size: 13px;">Question:<span class="text-danger">*</span></label>
                        <textarea id="js-ckeditor-addQue" name="js-ckeditor-addQue" class="form-control form-control-lg form-control-alt addQuestion" placeholder="update Question" ></textarea>
                        <span class="text-danger" id="questionError"></span>
                    </div>
                    <?php
                        $helper = new Helper;
                        $tags = $helper->getAllQuestionTags();
                    ?>
                    <div class="row">
                        <div class="col-md-4 mb-2 rating-tag ">
                            <label class="form-label" for="tags">Question Tags<span class="text-danger">*</span></label>
                            <div class="d-flex input-field align-items-center">
                                <select class="js-select2 select questionTag" id="question_tags_edit" name="question_tags_edit" onchange="insertQuestionTag(this)" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag['id'] }}">{{ $tag['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="text-danger" id="tagError"></span>
                        </div>
                        <div class="col-md-4 for_digital_only">
                            <div class="mb-2 ">
                                <label class="form-label" for="diffValue">Diff Value<span
                                        class="text-danger">*</span></label>
                                        
                                <div class="d-flex align-items-center">
                                    <input class="form-control"
                                            placeholder="Diff Value" 
                                            min="1" max="100" type="number" 
                                            oninput="validateInput(this)"
                                            required
                                            id="diffValueEdit" name="diff_value_edit">
                                </div>
                                <span class="text-danger" id="diffValueError"></span>
                            </div>
                        </div>
                        <div class="col-md-4 for_digital_only">
                            <div class="mb-2 rating-tag ">
                                <label class="form-label" for="discValue">Disc Value<span
                                        class="text-danger">*</span></label>
                                        
                                <div class="d-flex align-items-center">
                                    <input class="form-control"
                                                placeholder="Disc Value" 
                                                min="1" max="100" type="number" 
                                                oninput="validateInput(this)"
                                                required
                                                type="number" id="discValueEdit" name="disc_value_edit">
                                </div>
                                <span class="text-danger" id="discValueError"></span>
                            </div>
                        </div>
                    </div>
                    {{-- new for the super category --}}
                    {{-- <div class="mb-2 rating-tag ">
                        <label class="form-label" for="superCategory">Super Category<span class="text-danger">*</span></label>
                       <div class="d-flex input-field align-items-center">
                        <select class="js-select2 select superCate" id="super_category_edit" name="super_category_edit" onchange="insertSuperCategory(this)" multiple>

                        </select>
                    </div>
                    <span class="text-danger" id="superCategoryError"></span>
                    </div> --}}

                    {{-- <div class="input-container" id="addNewTypes">
                        <div class="d-flex input-field align-items-center">

                            <div class="col-md-1">
                                <label class="form-label" for="edit_ct_checkbox">&ensp;</label>
                                <input type="checkbox" name="edit_ct_checkbox" id="edit_ct_checkbox_0">
                            </div>

                            <div class="col-md-4 mb-2 me-2 ">
                                <label class="form-label" for="superCategory">Super Category<span class="text-danger">*</span></label>
                                <div class="d-flex align-items-center">
                                    <select class="js-select2 select superCategory" id="edit_super_category_0" name="edit_super_category" data-id="0" onchange="insertSuperCategory(this)" multiple>
                                    </select>
                                </div>
                                <span class="text-danger" id="superCategoryError"></span>
                            </div>

                            <div class="col-md-3 mb-2 me-2">
                                <label for="category_type" class="form-label">Category Type<span class="text-danger">*</span></label>
                                <div class="d-flex align-items-center">
                                    <select class="js-select2 select categoryType" id="category_type_0" name="category_type" data-id="0" onchange="insertCategoryType(this)" multiple>
                                    </select>
                                </div>
                                <span class="text-danger" id="categoryTypeError"></span>
                            </div>

                            <div class="mb-2 col-md-3 add_question_type_select">
                                <label for="search-input" class="form-label">Question Type<span class="text-danger">*</span></label>
                               <div class="d-flex align-items-center">
                                    <select class="js-select2 select questionType" id="search-input_0" name="search-input" data-id="0" onchange="insertQuestionType(this)" multiple>
                                    </select>
                                </div>
                                <span class="text-danger" id="questionTypeError"></span>
                            </div>

                            <div class="col-md-1 add-position">
                                <button class="plus-button" data-id="1" onclick="addNewTypes(this,'null')"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                    </div> --}}

					<div class="row passage-container align-items-center">
                        <div class="mb-2 col-md-5">
                            <label for="passage_number" class="form-label">Passage No<span class="text-danger">*</span></label>
                            <select class="js-select2 select passNumber" id="passage_number" name="passage_number">
                                <option value="">Select Passage No</option>
                                @for ($i = 1; $i < 25; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <span class="text-danger" id="passNumberError"></span>
                        </div>
                        <div class="mb-2 col-md-5">
                            <label class="form-label" for="passagesType">Passages<span class="text-danger">*</span></label>
                            <select name="passagesType" id="passagesType" class="passagesType js-select2 select"></select>
                            <span class="text-danger" id="passageTypeError"></span>
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" id="passageRequired_2" name="passageRequired_2" class="input-check">
                            {{-- <label class="form-label mb-0 ms-2 " for="passageRequired_2">Is Passage Required</label> --}}
                        </div>
                    </div>
                    <input type="hidden" name="editSelectedAnswerType" id="editSelectedAnswerType">
                    <div class="mb-2" id="selectedLayoutQuestion">

                        <div class="choiceOneInFour_Odd"><input type="hidden" name="questionType" id="questionType" value="choiceOneInFour_Odd">
                            <ul class="answerOptionLsit">
                                <li class="choiceOneInFour_OddAnswer_0">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>A: </span><input type="radio" value="a" name="choiceOneInFour"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFourOdd_edit_guessing_value_A" name="oneInFourOdd_edit_guessing_value_A">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourOdd_edit_guessing_valueE_A"></span>
                                            </div>  
                                        </div>
                                    </div>

                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'A', 'disp_section' => 'oneInFourOdd_'])

                                    <textarea id="editChoiceOneInFour_OddAnswer_1" name="editChoiceOneInFourAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer A</label>
                                    <textarea id="editchoiceOneInFour_Odd_explanation_answer_1" name="editchoiceOneInFour_explanation_answer_1"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFour_OddAnswer_1">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="choiceOneInFour"></label>

                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFourOdd_edit_guessing_value_B" name="oneInFourOdd_edit_guessing_value_B">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourOdd_edit_guessing_valueE_B"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'B', 'disp_section' => 'oneInFourOdd_'])

                                    <textarea id="editChoiceOneInFour_OddAnswer_2" name="editChoiceOneInFourAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer B</label>
                                    <textarea id="editchoiceOneInFour_Odd_explanation_answer_2" name="editchoiceOneInFour_explanation_answer_2"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFour_OddAnswer_2">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>C:</span><input type="radio"  value="c" name="choiceOneInFour"></label>

                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFourOdd_edit_guessing_value_C" name="oneInFourOdd_edit_guessing_value_C">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourOdd_edit_guessing_valueE_C"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'C', 'disp_section' => 'oneInFourOdd_'])

                                    <textarea id="editChoiceOneInFour_OddAnswer_3" name="editChoiceOneInFourAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer C</label>
                                    <textarea id="editchoiceOneInFour_Odd_explanation_answer_3" name="editchoiceOneInFour_explanation_answer_3"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFour_OddAnswer_3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            
                                            <label class="form-label" style="font-size: 13px;"><span>D: </span><input type="radio"  value="d" name="choiceOneInFour"></label>

                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFourOdd_edit_guessing_value_D" name="oneInFourOdd_edit_guessing_value_D">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourOdd_edit_guessing_valueE_D"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'D', 'disp_section' => 'oneInFourOdd_'])

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
                                    <div class="row">
                                        <div class="col-md-4">
                                            
                                            <label class="form-label" style="font-size: 13px;"><span>F: </span><input type="radio" value="f" name="choiceOneInFour"></label>                                            
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFourEven_edit_guessing_value_F" name="oneInFourEven_edit_guessing_value_F">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourEven_edit_guessing_valueE_F"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'F', 'disp_section' => 'oneInFourEven_'])

                                    <textarea id="editChoiceOneInFour_EvenAnswer_1" name="editChoiceOneInFourAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer F</label>
                                    <textarea id="editchoiceOneInFour_Even_explanation_answer_1" name="editchoiceOneInFour_explanation_answer_1"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFour_EvenAnswer_1">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>G: </span><input type="radio"  value="g" name="choiceOneInFour"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFourEven_edit_guessing_value_G" name="oneInFourEven_edit_guessing_value_G">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourEven_edit_guessing_valueE_G"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'G', 'disp_section' => 'oneInFourEven_'])

                                    <textarea id="editChoiceOneInFour_EvenAnswer_2" name="editChoiceOneInFourAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer G</label>
                                    <textarea id="editchoiceOneInFour_Even_explanation_answer_2" name="editchoiceOneInFour_explanation_answer_2"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFour_EvenAnswer_2">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>H:</span><input type="radio"  value="h" name="choiceOneInFour"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFourEven_edit_guessing_value_H" name="oneInFourEven_edit_guessing_value_H">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourEven_edit_guessing_valueE_H"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'H', 'disp_section' => 'oneInFourEven_'])

                                    <textarea id="editChoiceOneInFour_EvenAnswer_3" name="editChoiceOneInFourAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer H</label>
                                    <textarea id="editchoiceOneInFour_Even_explanation_answer_3" name="editchoiceOneInFour_explanation_answer_3"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFour_EvenAnswer_3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>J: </span><input type="radio"  value="j" name="choiceOneInFour"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFourEven_edit_guessing_value_J" name="oneInFourEven_edit_guessing_value_J">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourEven_edit_guessing_valueE_J"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'J', 'disp_section' => 'oneInFourEven_'])

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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>A: </span><input type="radio" value="a" name="choiceOneInFive"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFiveOdd_edit_guessing_value_A" name="oneInFiveOdd_edit_guessing_value_A">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveOdd_edit_guessing_valueE_A"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'A', 'disp_section' => 'oneInFiveOdd_'])

                                    <textarea id="editChoiceOneInFive_OddAnswer_1" name="editChoiceOneInFiveAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer A</label>
                                    <textarea id="editchoiceOneInFive_Odd_explanation_answer_1" name="editchoiceOneInFive_explanation_answer_1"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFive_OddAnswer_1">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="choiceOneInFive"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFiveOdd_edit_guessing_value_B" name="oneInFiveOdd_edit_guessing_value_B">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveOdd_edit_guessing_valueE_B"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'B', 'disp_section' => 'oneInFiveOdd_'])

                                    <textarea id="editChoiceOneInFive_OddAnswer_2" name="editChoiceOneInFiveAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer B</label>
                                    <textarea id="editchoiceOneInFive_Odd_explanation_answer_2" name="editchoiceOneInFive_explanation_answer_2"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFive_OddAnswer_2">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>C:</span><input type="radio"  value="c" name="choiceOneInFive"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFiveOdd_edit_guessing_value_C" name="oneInFiveOdd_edit_guessing_value_C">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveOdd_edit_guessing_valueE_C"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'C', 'disp_section' => 'oneInFiveOdd_'])

                                    <textarea id="editChoiceOneInFive_OddAnswer_3" name="editChoiceOneInFiveAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer C</label>
                                    <textarea id="editchoiceOneInFive_Odd_explanation_answer_3" name="editchoiceOneInFive_explanation_answer_3"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFive_OddAnswer_3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>D: </span><input type="radio"  value="d" name="choiceOneInFive"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFiveOdd_edit_guessing_value_D" name="oneInFiveOdd_edit_guessing_value_D">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveOdd_edit_guessing_valueE_D"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'D', 'disp_section' => 'oneInFiveOdd_'])

                                    <textarea id="editChoiceOneInFive_OddAnswer_4" name="editChoiceOneInFiveAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer D</label>
                                    <textarea id="editchoiceOneInFive_Odd_explanation_answer_4" name="editchoiceOneInFive_explanation_answer_4"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFive_OddAnswer_4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>E: </span><input type="radio"  value="e" name="choiceOneInFive"></label>

                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFiveOdd_edit_guessing_value_E" name="oneInFiveOdd_edit_guessing_value_E">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveOdd_edit_guessing_valueE_E"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'E', 'disp_section' => 'oneInFiveOdd_'])

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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>F: </span><input type="radio" value="f" name="choiceOneInFive"></label>

                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFiveEven_edit_guessing_value_F" name="oneInFiveEven_edit_guessing_value_F">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveEven_edit_guessing_valueE_F"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'F', 'disp_section' => 'oneInFiveEven_'])

                                    <textarea id="editChoiceOneInFive_EvenAnswer_1" name="editChoiceOneInFiveAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer F</label>
                                    <textarea id="editchoiceOneInFive_Even_explanation_answer_1" name="editchoiceOneInFive_explanation_answer_1"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFive_EvenAnswer_1">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>G: </span><input type="radio"  value="g" name="choiceOneInFive"></label>

                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFiveEven_edit_guessing_value_G" name="oneInFiveEven_edit_guessing_value_G">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveEven_edit_guessing_valueE_G"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'G', 'disp_section' => 'oneInFiveEven_'])

                                    <textarea id="editChoiceOneInFive_EvenAnswer_2" name="editChoiceOneInFiveAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer G</label>
                                    <textarea id="editchoiceOneInFive_Even_explanation_answer_2" name="editchoiceOneInFive_explanation_answer_2"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFive_EvenAnswer_2">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>H:</span><input type="radio"  value="h" name="choiceOneInFive"></label>

                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFiveEven_edit_guessing_value_H" name="oneInFiveEven_edit_guessing_value_H">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveEven_edit_guessing_valueE_H"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'H', 'disp_section' => 'oneInFiveEven_'])

                                    <textarea id="editChoiceOneInFive_EvenAnswer_3" name="editChoiceOneInFiveAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer H</label>
                                    <textarea id="editchoiceOneInFive_Even_explanation_answer_3" name="editchoiceOneInFive_explanation_answer_3"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFive_EvenAnswer_3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>J: </span><input type="radio"  value="j" name="choiceOneInFive"></label>

                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFiveEven_edit_guessing_value_J" name="oneInFiveEven_edit_guessing_value_J">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveEven_edit_guessing_valueE_J"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'J', 'disp_section' => 'oneInFiveEven_'])

                                    <textarea id="editChoiceOneInFive_EvenAnswer_4" name="editChoiceOneInFiveAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer J</label>
                                    <textarea id="editchoiceOneInFive_Even_explanation_answer_4" name="editchoiceOneInFive_explanation_answer_4"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFive_EvenAnswer_4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>K: </span><input type="radio"  value="k" name="choiceOneInFive"></label>

                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFiveEven_edit_guessing_value_K" name="oneInFiveEven_edit_guessing_value_K">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveEven_edit_guessing_valueE_K"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'K', 'disp_section' => 'oneInFiveEven_'])

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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>A: </span><input type="radio" value="a" name="choiceOneInFourPass"></label>

                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="edit_guessing_value_A" name="edit_guessing_value_A">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="edit_guessing_valueE_A"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'A', 'disp_section' => ''])

                                    <textarea id="editChoiceOneInFourPass_OddAnswer_1" name="editChoiceOneInFourPassAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer A</label>
                                    <textarea id="editchoiceOneInFourPass_Odd_explanation_answer_1" name="editchoiceOneInFourPass_explanation_answer_1"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFourPass_OddAnswer_1">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="choiceOneInFourPass"></label>

                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="edit_guessing_value_B" name="edit_guessing_value_B">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="edit_guessing_valueE_B"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'B', 'disp_section' => ''])

                                    <textarea id="editChoiceOneInFourPass_OddAnswer_2" name="editChoiceOneInFourPassAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer B</label>
                                    <textarea id="editchoiceOneInFourPass_Odd_explanation_answer_2" name="editchoiceOneInFourPass_explanation_answer_2"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFourPass_OddAnswer_2">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>C: </span><input type="radio"  value="c" name="choiceOneInFourPass"></label>

                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="edit_guessing_value_C" name="edit_guessing_value_C">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="edit_guessing_valueE_C"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'C', 'disp_section' => ''])

                                    <textarea id="editChoiceOneInFourPass_OddAnswer_3" name="editChoiceOneInFourPassAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer c</label>
                                    <textarea id="editchoiceOneInFourPass_Odd_explanation_answer_3" name="editchoiceOneInFourPass_explanation_answer_3"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFourPass_OddAnswer_3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>D: </span><input type="radio"  value="d" name="choiceOneInFourPass"></label>

                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="edit_guessing_value_D" name="edit_guessing_value_D">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="edit_guessing_valueE_D"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'D', 'disp_section' => ''])

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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>F: </span><input type="radio" value="f" name="choiceOneInFourPass"></label>

                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFourPassEven_edit_guessing_value_F" name="oneInFourPassEven_edit_guessing_value_F">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourPassEven_edit_guessing_valueE_F"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'F', 'disp_section' => 'oneInFourPassEven_'])

                                    <textarea id="editChoiceOneInFourPass_EvenAnswer_1" name="editChoiceOneInFourPassAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer F</label>
                                    <textarea id="editchoiceOneInFourPass_Even_explanation_answer_1" name="editchoiceOneInFourPass_explanation_answer_1"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFourPass_EvenAnswer_1">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>G: </span><input type="radio"  value="g" name="choiceOneInFourPass"></label>

                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFourPassEven_edit_guessing_value_G" name="oneInFourPassEven_edit_guessing_value_G">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourPassEven_edit_guessing_valueE_G"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'G', 'disp_section' => 'oneInFourPassEven_'])

                                    <textarea id="editChoiceOneInFourPass_EvenAnswer_2" name="editChoiceOneInFourPassAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer G</label>
                                    <textarea id="editchoiceOneInFourPass_Even_explanation_answer_2" name="editchoiceOneInFourPass_explanation_answer_2"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFourPass_EvenAnswer_2">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>H: </span><input type="radio"  value="h" name="choiceOneInFourPass"></label>

                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFourPassEven_edit_guessing_value_H" name="oneInFourPassEven_edit_guessing_value_H">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourPassEven_edit_guessing_valueE_H"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'H', 'disp_section' => 'oneInFourPassEven_'])

                                    <textarea id="editChoiceOneInFourPass_EvenAnswer_3" name="editChoiceOneInFourPassAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer H</label>
                                    <textarea id="editchoiceOneInFourPass_Even_explanation_answer_3" name="editchoiceOneInFourPass_explanation_answer_3"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li class="choiceOneInFourPass_EvenAnswer_3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>J: </span><input type="radio"  value="j" name="choiceOneInFourPass"></label>

                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2  ">
                                                <label class="form-label" for="guessing-value">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" 
                                                        oninput="validateInput(this)"
                                                        required 
                                                        id="oneInFourPassEven_edit_guessing_value_J" name="oneInFourPassEven_edit_guessing_value_J">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourPassEven_edit_guessing_valueE_J"></span>
                                            </div>  
                                        </div>
                                    </div>
                                    
                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'J', 'disp_section' => 'oneInFourPassEven_'])

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
                                    <option value="">Select Choice</option>
                                    <option value="1">Multi-Choice</option>
                                    <option value="3">Multiple Choice</option>
                                    <option value="2">Fill Choice</option>
                                </select>
                            </label>

                            <div class="multi_field withOutFillOpt" style="display: none">
                                <ul class="answerOptionLsit">
                                    <li class="choiceMultInFourFillwithOutFillOpt_0">
                                        <div class="row">
                                            <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>A: </span> <input type="checkbox" value="a" name="choiceMultInFourFill[]"></label>
                                                </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2 ">
                                                    <label class="form-label" for="guessingValueError">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control edit_guessing_value" 
                                                            placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" oninput="validateInput(this)"
                                                            
                                                            id="cb_choiceMultInFourFill_edit_guessing_value_A" name="cb_choiceMultInFourFill_edit_guessing_value_A">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="cb_choiceMultInFourFill_edit_guessing_valueE_A"></span>
                                                </div>  
                                            </div>
                                        </div>

                                        @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'A', 'disp_section' => 'cb_choiceMultInFourFill_'])

                                        <textarea id="editChoiceMultInFourFillAnswer_1" name="editChoiceMultInFourFillAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer A</label>
                                        <textarea id="editchoiceMultInFourFill_explanation_answer_1" name="editchoiceMultInFourFill_explanation_answer_1"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceMultInFourFillwithOutFillOpt_1">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>B: </span><input type="checkbox"  value="b" name="choiceMultInFourFill[]"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2 ">
                                                    <label class="form-label" for="guessingValueError">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control  edit_guessing_value" 
                                                            placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" oninput="validateInput(this)"
                                                            
                                                            id="cb_choiceMultInFourFill_edit_guessing_value_B" name="cb_choiceMultInFourFill_edit_guessing_value_B">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="cb_choiceMultInFourFill_edit_guessing_valueE_B"></span>
                                                </div>  
                                            </div>
                                        </div>

                                        @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'B', 'disp_section' => 'cb_choiceMultInFourFill_'])

                                        <textarea id="editChoiceMultInFourFillAnswer_2" name="editChoiceMultInFourFillAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer B</label>
                                        <textarea id="editchoiceMultInFourFill_explanation_answer_2" name="editchoiceMultInFourFill_explanation_answer_2"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceMultInFourFillwithOutFillOpt_2">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>C: </span><input type="checkbox"  value="c" name="choiceMultInFourFill[]"></label>

                                                </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2 ">
                                                    <label class="form-label" for="guessingValueError">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control edit_guessing_value" 
                                                            placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" oninput="validateInput(this)"

                                                            id="cb_choiceMultInFourFill_edit_guessing_value_C" name="cb_choiceMultInFourFill_edit_guessing_value_C">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="cb_choiceMultInFourFill_edit_guessing_valueE_C"></span>
                                                </div>  
                                            </div>
                                        </div>

                                        @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'C', 'disp_section' => 'cb_choiceMultInFourFill_'])

                                        <textarea id="editChoiceMultInFourFillAnswer_3" name="editChoiceMultInFourFillAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer C</label>
                                        <textarea id="editchoiceMultInFourFill_explanation_answer_3" name="editchoiceMultInFourFill_explanation_answer_3"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceMultInFourFillwithOutFillOpt_3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>D:</span><input type="checkbox"  value="d" name="choiceMultInFourFill[]"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2 ">
                                                    <label class="form-label" for="guessingValueError">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control edit_guessing_value" 
                                                            placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" oninput="validateInput(this)"

                                                            id="cb_choiceMultInFourFill_edit_guessing_value_D" name="cb_choiceMultInFourFill_edit_guessing_value_D">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="cb_choiceMultInFourFill_edit_guessing_valueE_D"></span>
                                                </div>  
                                            </div>
                                        </div>

                                        @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'D', 'disp_section' => 'cb_choiceMultInFourFill_'])

                                        <textarea id="editChoiceMultInFourFillAnswer_4" name="editChoiceMultInFourFillAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer D</label>
                                        <textarea id="editchoiceMultInFourFill_explanation_answer_4" name="editchoiceMultInFourFill_explanation_answer_4"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                </ul>
                            </div>

                            <div class="multiChoice_field withOutFillOptChoice" style="display:none">
                                <ul class="answerOptionLsit">
                                    <li class="choiceMultInFourFillwithOutFillOptChoice_0">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>A: </span> <input type="radio" value="a" name="editChoiceMultiChoiceInFourFill"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2 ">
                                                    <label class="form-label" for="guessingValueError">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control edit_guessing_value" 
                                                            placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                            id="choiceMultInFourFill_edit_guessing_value_A" name="choiceMultInFourFill_edit_guessing_value_A">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="choiceMultInFourFill_edit_guessing_valueE_A"></span>
                                                </div>  
                                            </div>
                                        </div>

                                        @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'A', 'disp_section' => 'choiceMultInFourFill_'])

                                        <textarea id="editChoiceMultiChoiceInFourFill_1" name="editChoiceMultiChoiceInFourFill_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li>
                                    <li>
                                        <label class="form-label">Explanation Answer A</label>
                                        <textarea id="editchoiceMultiChoiceInFourFill_explanation_answer_1" name="editchoiceMultiChoiceInFourFill_explanation_answer_1"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceMultInFourFillwithOutFillOptChoice_1">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="editChoiceMultiChoiceInFourFill"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2 ">
                                                    <label class="form-label" for="guessingValueError">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control edit_guessing_value" 
                                                            placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"
                                                            
                                                            id="choiceMultInFourFill_edit_guessing_value_B" name="choiceMultInFourFill_edit_guessing_value_B">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="choiceMultInFourFill_edit_guessing_valueE_B"></span>
                                                </div>  
                                            </div>
                                        </div>

                                        @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'B', 'disp_section' => 'choiceMultInFourFill_'])

                                        <textarea id="editChoiceMultiChoiceInFourFill_2" name="editChoiceMultiChoiceInFourFill_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer B</label>
                                        <textarea id="editchoiceMultiChoiceInFourFill_explanation_answer_2" name="editchoiceMultiChoiceInFourFill_explanation_answer_2"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceMultInFourFillwithOutFillOptChoice_2">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>C: </span><input type="radio"  value="c" name="editChoiceMultiChoiceInFourFill"></label>

                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2 ">
                                                    <label class="form-label" for="guessingValueError">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control edit_guessing_value" 
                                                            placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"
                                                            
                                                            id="choiceMultInFourFill_edit_guessing_value_C" name="choiceMultInFourFill_edit_guessing_value_C">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="choiceMultInFourFill_edit_guessing_valueE_C"></span>
                                                </div>  
                                            </div>
                                        </div>

                                        @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'C', 'disp_section' => 'choiceMultInFourFill_'])

                                        <textarea id="editChoiceMultiChoiceInFourFill_3" name="editChoiceMultiChoiceInFourFill_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer C</label>
                                        <textarea id="editchoiceMultiChoiceInFourFill_explanation_answer_3" name="editchoiceMultiChoiceInFourFill_explanation_answer_3"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceMultInFourFillwithOutFillOptChoice_3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>D:</span><input type="radio"  value="d" name="editChoiceMultiChoiceInFourFill"></label>

                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2 ">
                                                    <label class="form-label" for="guessingValueError">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control edit_guessing_value" 
                                                            placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"
                                                            
                                                            id="choiceMultInFourFill_edit_guessing_value_D" name="choiceMultInFourFill_edit_guessing_value_D">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="choiceMultInFourFill_edit_guessing_valueE_D"></span>
                                                </div>  
                                            </div>
                                        </div>

                                        @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'D', 'disp_section' => 'choiceMultInFourFill_'])

                                        <textarea id="editChoiceMultiChoiceInFourFill_4" name="editChoiceMultiChoiceInFourFill_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer D</label>
                                        <textarea id="editchoiceMultiChoiceInFourFill_explanation_answer_4" name="editchoiceMultiChoiceInFourFill_explanation_answer_4"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                </ul>
                            </div>

                            <div class="fill_field withFillOpt " style="display:none">
                                <div class="withFillOptmb-2">
                                    <div class="mb-2">
                                        <label class="form-label" style="font-size: 13px;">Fill Type:</label><select name="addChoiceMultInFourFill_filltype"  class="form-control addChoiceMultInFourFill_filltype"><option value="">Select Type</option><option value="number">Number</option><option value="decimal">Decimal</option><option value="fraction">Fraction</option></select></div><div class="mb-2"><label class="form-label" style="font-size: 13px;">Fill:</label><input type="text" name="addChoiceMultInFourFill_fill[]"><label class="form-label extraFillOption" style="font-size: 13px;"></label><label class="form-label" style="font-size: 13px;"><a href="javascript:;" onClick="addMoreFillOption();" class="switchMulti">Add More Options</a></label>
                                    </div>
                                </div>

                                {{-- <div class="input-container" id="fc_addNewTypes_A">
                                    <div class="d-flex input-field align-items-center">
                                        <div class="col-md-1">
                                            <label class="form-label" for="fc_edit_ct_checkbox_A">&ensp;</label>
                                            <input type="checkbox" name="fc_edit_ct_checkbox_A" id="fc_edit_ct_checkbox_A_0">
                                        </div>

                                        <div class="col-md-3 mb-2 me-2 rating-tag">
                                            <label class="form-label" for="superCategory">Super Category<span class="text-danger">*</span></label>
                                            <div class="d-flex align-items-center">
                                                <select class="switchMulti superCategory" id="fc_edit_super_category_A_0" name="fc_edit_super_category_A" style="width: 100%">
                                                    <option value="">Select Super Category</option>
                                                </select>
                                            </div>
                                            <span class="text-danger" id="fc_superCategoryError_A"></span>
                                        </div>

                                        <div class="col-md-3 mb-2 me-2 category-custom">
                                            <label for="category_type" class="form-label">Category Type<span class="text-danger">*</span></label>
                                            <div class="d-flex align-items-center">
                                                <select class="switchMulti categoryType" id="fc_edit_category_type_A_0" name="fc_edit_category_type_A" style="width: 100%">
                                                    <option value="">Select Category Type</option>
                                                </select>
                                            </div>
                                            <span class="text-danger" id="fc_categoryTypeError_A"></span>
                                        </div>

                                        <div class="mb-2 col-md-3 add_question_type_select">
                                            <label for="search-input" class="form-label">Question Type<span class="text-danger">*</span></label>
                                           <div class="d-flex align-items-center">
                                                <select class="switchMulti questionType" id="fc_edit_search-input_A_0" name="fc_edit_search-input_A" style="width: 100%">
                                                    <option value="">Select Question Type</option>
                                                </select>
                                            </div>
                                            <span class="text-danger" id="fc_questionTypeError_A"></span>
                                        </div>

                                        <div class="col-md-2 add-position">
                                            <button class="plus-button" fc_ans_col='A' fc_data-id-A="1" onclick="addNewTypes('A', this,'null', 'fc_')"><i class="fa-solid fa-plus"></i></button>
                                        </div>

                                    </div>
                                </div> --}}

                                @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', ['ans_choices' => 'A', 'disp_section' => 'fc_'])
                                
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

{{--start score model  --}}
<div class="modal fade" id="scoreModalMulti" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Score Conversion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-responsive">
                    <thead class="table-Light">
                      <tr>
                        <th scope="col">Actual Score</th>
                        <th scope="col">Converted Score</th>
                      </tr>
                    </thead>
                    <tbody class="table_body">

                    </tbody>
                  </table>
            </div>
            <div class="modal-footer">
                <input type="hidden" class="totalQuestion" value="" >
                <button type="button" class="btn btn-primary save_scores_btn">Save changes</button>
                <p id="errorMsg"></p>
            </div>
        </div>
    </div>
</div>
{{-- end score modal  --}}
<!-- start add  multiple question -->
{{-- start add question multi model  --}}
<div class="modal fade" id="addQuestionMultiModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
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
                    <div class="col-12 d-flex justify-content-between">
                        <div class="mb-2 col-md-6 pe-3">
                            <label class="form-label" style="font-size: 13px;">Practice Test Section Type:</label>
                            <input id="addTestSectionTypeRead" readonly name="addTestSectionTypeRead" class="form-control">
                        </div>
                        <?php
                            $helper = new Helper;
                            $ratings = $helper->getAllDifficultyRating();
                        ?>
                        {{-- new for diff ratings  --}}
                        <div class="mb-2 col-md-6 ps-3 rating-tag">
                            <label class="form-label" style="font-size: 13px;">Difficulty Rating</label>
                            <select class="js-select2 select diffRating" id="diff_rating_create" name="diff_rating_create" onchange="insertDiffRating(this)" multiple>
                                @foreach ($ratings['ratings'] as $rating)
                                    <option value="{{ $rating['id'] }}">{{ $rating['title'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size: 13px;">Question:<span class="text-danger">*</span></label>
                        <textarea id="js-ckeditor-add-addQue" name="js-ckeditor-add-addQue" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                        <span class="text-danger" id="questionError"></span>
                    </div>

                    {{-- <div class="mb-2">
                        <label class="form-label" for="addTag">Question Tags</label>
                        <input type="text" maxlength="30"
                            id="addTag"
                            placeholder="add tag" class="form-control" onkeypress="addTagFunc(event)"/>

                        <div class="row items-push mt-2 add-tag-div">

                        </div>
                    </div> --}}
                    <?php
                        $helper = new Helper;
                        $tags = $helper->getAllQuestionTags();
                    ?>
                    <div class="row">
                        <div class="col-md-4 mb-2 rating-tag ">
                            <label class="form-label" for="tags">Question Tags<span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center">
                                <select class="js-select2 select questionTag" id="question_tags_create" name="question_tags_create" onchange="insertQuestionTag(this)" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag['id'] }}">{{ $tag['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="text-danger" id="tagError"></span>
                        </div>
                        <div class="col-md-4 for_digital_only">
                            <div class="mb-2 ">
                                <label class="form-label" for="diff-value">Diff Value<span
                                        class="text-danger">*</span></label>
                                        
                                <div class="d-flex align-items-center">
                                    <input class="form-control"
                                            placeholder="Diff Value" 
                                            min="1" max="100" type="number" 
                                            oninput="validateInput(this)"
                                            required
                                            id="diffValue" name="diff_value">
                                </div>
                                <span class="text-danger" id="diffValueError"></span>
                            </div>
                        </div>
                        <div class="col-md-4 for_digital_only">
                            <div class="mb-2 rating-tag ">
                                <label class="form-label" for="disc-value">Disc Value<span
                                        class="text-danger">*</span></label>
                                        
                                <div class="d-flex align-items-center">
                                    <input class="form-control"
                                                placeholder="Disc Value" 
                                                min="1" max="100" type="number" 
                                                oninput="validateInput(this)"
                                                required
                                                type="number" id="discValue" name="disc_value">
                                </div>
                                <span class="text-danger" id="discValueError"></span>
                            </div>
                        </div>
                    </div>
                    {{-- new for the super category  --}}
                    {{-- <div class="mb-2 rating-tag ">
                        <label class="form-label" for="superCategory">Super Category<span class="text-danger">*</span></label>
                        <div class="d-flex align-items-center">
                            <select class="js-select2 select superCate" id="super_category_create" name="super_category_create" onchange="insertSuperCategory(this)" multiple>

                            </select>
                        </div>
                        <span class="text-danger" id="superCategoryError"></span>
                    </div> --}}

                    {{-- <div class="mb-2 mb-4">
                        <label for="new_question_type_select">Question type:</label>
                        <select class="form-control form-control-lg form-control-alt"  name="new_question_type_select" id="new_question_type_select">
                            <option value="">Select Question Type</option>
                            @foreach($getQuestionTypes as $singleQuestionTypes)
                            <option value="{{$singleQuestionTypes->id}}">{{$singleQuestionTypes->question_type_title}}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    {{-- <div class="input-container" id="add_New_Types">
                        <div class="d-flex input-field align-items-center">
                            <div class="col-md-1">
                                <label class="form-label" for="ct_checkbox">&ensp;</label>
                                <input type="checkbox" name="ct_checkbox" id="ct_checkbox_0">
                            </div>

                            <div class="col-md-4 mb-2 me-2 rating-tag">
                                <label class="form-label" for="superCategory">Super Category<span class="text-danger">*</span></label>
                                <div class="d-flex align-items-center">
                                    <select class="js-select2 select superCategory" id="super_category_create_0" name="super_category_create" data-id="0" onchange="insertSuperCategory(this)" multiple>
                                    </select>
                                </div>
                                <span class="text-danger" id="superCategoryError"></span>
                            </div>

                            <div class="col-md-3 mb-2 me-2 category-custom">
                                <label for="category_type" class="form-label">Category Type<span class="text-danger">*</span></label>
                                <div class="d-flex align-items-center">
                                    <select class="js-select2 select categoryType" id="add_category_type_0" name="add_category_type" data-id="0" onchange="insertCategoryType(this)" multiple>
                                    </select>
                                </div>
                                <span class="text-danger" id="categoryTypeError"></span>
                            </div>
                            <div class="mb-2 col-md-3 add_question_type_select">
                                <label for="search-input" class="form-label">Question Type<span class="text-danger">*</span></label>
                                <div class="d-flex align-items-center">
                                    <select class="js-select2 select questionType" id="add_search-input_0" name="add_search-input" data-id="0" onchange="insertQuestionType(this)" multiple>
                                    </select>
                                </div>
                                <span class="text-danger" id="questionTypeError"></span>
                            </div>
                            <div class="col-md-1 add-position">
                                <button class="plus-button add-plus-button" data-id="1" onclick="addNewType(this)"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                    </div> --}}

                    <div class="row passage-container align-items-center">
                        <div class="mb-2 col-md-5">
                            <label for="passage_number" class="form-label">Passage No<span class="text-danger">*</span></label>
                            <select class="js-select2 select addPassNumber" id="add_passage_number" name="passage_number">
                                <option value="">Select Passage No</option>
                                @for($i = 1; $i < 25; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <span class="text-danger" id="passNumberError"></span>
                        </div>
                        <div class="mb-2 col-md-5">
                            <label class="form-label">Passages<span class="text-danger">*</span></label>
                            <select name="addPassagesType" class="form-control addPassagesType js-select2 select"></select>
                            <span class="text-danger" id="passageTypeError"></span>
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" id="passageRequired_1" name="passageRequired_1" class="input-check">
                            {{-- <label class="form-label mb-0 ms-2 " for="passageRequired_1">Is Passage Required</label> --}}
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
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                        <label class="form-label" style="font-size: 13px;">
                                            <span>A: </span>
                                            <input type="radio" value="a" name="addChoiceOneInFour">
                                        </label>
                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFourOdd_add_guessing_value_A" name="oneInFourOdd_add_guessing_value_A">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFourOdd_add_guessing_valueE_A"></span>
                                        </div>  
                                    </div>
                                </div>

                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'A', 'disp_section' => 'oneInFourOdd_'])

                                <textarea id="choiceOneInFour_OddAnswer_1" name="choiceOneInFourAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer A</label>
                                <textarea id="choiceOneInFour_Odd_explanation_answer_1" name="choiceOneInFour_explanation_answer_1"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="addChoiceOneInFour"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFourOdd_add_guessing_value_B" name="oneInFourOdd_add_guessing_value_B">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFourOdd_add_guessing_valueE_B"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'B', 'disp_section' => 'oneInFourOdd_'])

                                <textarea id="choiceOneInFour_OddAnswer_2" name="choiceOneInFourAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                
                                <label class="form-label">Explanation Answer B</label>
                                <textarea id="choiceOneInFour_Odd_explanation_answer_2" name="choiceOneInFour_explanation_answer_2"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>C:</span>
                                        <input type="radio"  value="c" name="addChoiceOneInFour">
                                    </label>
                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFourOdd_add_guessing_value_C" name="oneInFourOdd_add_guessing_value_C">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFourOdd_add_guessing_valueE_C"></span>
                                        </div>  
                                    </div>
                                </div>
                                

                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'C', 'disp_section' => 'oneInFourOdd_'])

                                <textarea id="choiceOneInFour_OddAnswer_3" name="choiceOneInFourAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer C</label>
                                <textarea id="choiceOneInFour_Odd_explanation_answer_3" name="choiceOneInFour_explanation_answer_3"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>D: </span>
                                        <input type="radio"  value="d" name="addChoiceOneInFour">
                                    </label>
                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFourOdd_add_guessing_value_D" name="oneInFourOdd_add_guessing_value_D">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFourOdd_add_guessing_valueE_D"></span>
                                        </div>  
                                    </div>
                                </div>
                                

                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'D', 'disp_section' => 'oneInFourOdd_'])

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
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>F: </span><input type="radio" value="f" name="addChoiceOneInFour"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFourEven_add_guessing_value_F" name="oneInFourEven_add_guessing_value_F">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFourEven_add_guessing_valueE_F"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'F', 'disp_section' => 'oneInFourEven_'])

                                <textarea id="choiceOneInFour_EvenAnswer_1" name="choiceOneInFourAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer F</label>
                                <textarea id="choiceOneInFour_Even_explanation_answer_1" name="choiceOneInFour_explanation_answer_1"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                            <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>G: </span><input type="radio"  value="g" name="addChoiceOneInFour"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFourEven_add_guessing_value_G" name="oneInFourEven_add_guessing_value_G">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFourEven_add_guessing_valueE_G"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'G', 'disp_section' => 'oneInFourEven_'])

                                <textarea id="choiceOneInFour_EvenAnswer_2" name="choiceOneInFourAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer G</label>
                                <textarea id="choiceOneInFour_Even_explanation_answer_2" name="choiceOneInFour_explanation_answer_2"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                            <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>H:</span>
                                    <input type="radio"  value="h" name="addChoiceOneInFour">
                                </label>
                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFourEven_add_guessing_value_H" name="oneInFourEven_add_guessing_value_H">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFourEven_add_guessing_valueE_H"></span>
                                        </div>  
                                    </div>
                                </div>
                                

                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'H', 'disp_section' => 'oneInFourEven_'])

                                <textarea id="choiceOneInFour_EvenAnswer_3" name="choiceOneInFourAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer H</label>
                                <textarea id="choiceOneInFour_Even_explanation_answer_3" name="choiceOneInFour_explanation_answer_3"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                            <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>J: </span>
                                    <input type="radio"  value="j" name="addChoiceOneInFour">
                                </label>
                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFourEven_add_guessing_value_J" name="oneInFourEven_add_guessing_value_J">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFourEven_add_guessing_valueE_J"></span>
                                        </div>  
                                    </div>
                                </div>
                                

                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'J', 'disp_section' => 'oneInFourEven_'])

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
                            <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>A: </span><input type="radio" value="a" name="addChoiceOneInFive"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFiveOdd_add_guessing_value_A" name="oneInFiveOdd_add_guessing_value_A">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFiveOdd_add_guessing_valueE_A"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'A', 'disp_section' => 'oneInFiveOdd_'])

                                <textarea id="choiceOneInFive_OddAnswer_1" name="choiceOneInFiveAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer A</label>
                                <textarea id="choiceOneInFive_Odd_explanation_answer_1" name="choiceOneInFive_explanation_answer_1"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                            <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="addChoiceOneInFive"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFiveOdd_add_guessing_value_B" name="oneInFiveOdd_add_guessing_value_B">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFiveOdd_add_guessing_valueE_B"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'B', 'disp_section' => 'oneInFiveOdd_'])

                                <textarea id="choiceOneInFive_OddAnswer_2" name="choiceOneInFiveAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                            
                                <label class="form-label">Explanation Answer B</label>
                                <textarea id="choiceOneInFive_Odd_explanation_answer_2" name="choiceOneInFive_explanation_answer_2"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>C:</span><input type="radio"  value="c" name="addChoiceOneInFive"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFiveOdd_add_guessing_value_C" name="oneInFiveOdd_add_guessing_value_C">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFiveOdd_add_guessing_valueE_C"></span>
                                        </div>  
                                    </div>
                                </div>
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'C', 'disp_section' => 'oneInFiveOdd_'])

                                <textarea id="choiceOneInFive_OddAnswer_3" name="choiceOneInFiveAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                
                                <label class="form-label">Explanation Answer C</label>
                                <textarea id="choiceOneInFive_Odd_explanation_answer_3" name="choiceOneInFive_explanation_answer_3"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>D: </span><input type="radio"  value="d" name="addChoiceOneInFive"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFiveOdd_add_guessing_value_D" name="oneInFiveOdd_add_guessing_value_D">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFiveOdd_add_guessing_valueE_D"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'D', 'disp_section' => 'oneInFiveOdd_'])

                                <textarea id="choiceOneInFive_OddAnswer_4" name="choiceOneInFiveAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                
                                <label class="form-label">Explanation Answer D</label>
                                <textarea id="choiceOneInFive_Odd_explanation_answer_4" name="choiceOneInFive_explanation_answer_4"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                            <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>E: </span><input type="radio"  value="e" name="addChoiceOneInFive"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFiveOdd_add_guessing_value_E" name="oneInFiveOdd_add_guessing_value_E">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFiveOdd_add_guessing_valueE_E"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'E', 'disp_section' => 'oneInFiveOdd_'])

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
                            <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>F: </span><input type="radio" value="f" name="addChoiceOneInFive"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFiveEven_add_guessing_value_F" name="oneInFiveEven_add_guessing_value_F">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFiveEven_add_guessing_valueE_F"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'F', 'disp_section' => 'oneInFiveEven_'])

                                <textarea id="choiceOneInFive_EvenAnswer_1" name="choiceOneInFiveAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer F</label>
                                <textarea id="choiceOneInFive_Even_explanation_answer_1" name="choiceOneInFive_explanation_answer_1"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                            <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>G: </span><input type="radio"  value="g" name="addChoiceOneInFive"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value"
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFiveEven_add_guessing_value_G" name="oneInFiveEven_add_guessing_value_G">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFiveEven_add_guessing_valueE_G"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'G', 'disp_section' => 'oneInFiveEven_'])

                                <textarea id="choiceOneInFive_EvenAnswer_2" name="choiceOneInFiveAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer G</label>
                                <textarea id="choiceOneInFive_Even_explanation_answer_2" name="choiceOneInFive_explanation_answer_2"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                            <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>H:</span><input type="radio"  value="h" name="addChoiceOneInFive"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFiveEven_add_guessing_value_H" name="oneInFiveEven_add_guessing_value_H">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFiveEven_add_guessing_valueE_H"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'H', 'disp_section' => 'oneInFiveEven_'])

                                <textarea id="choiceOneInFive_EvenAnswer_3" name="choiceOneInFiveAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer H</label>
                                <textarea id="choiceOneInFive_Even_explanation_answer_3" name="choiceOneInFive_explanation_answer_3"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                            <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>J: </span><input type="radio"  value="j" name="addChoiceOneInFive"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value"
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFiveEven_add_guessing_value_J" name="oneInFiveEven_add_guessing_value_J">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFiveEven_add_guessing_valueE_J"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'J', 'disp_section' => 'oneInFiveEven_'])

                                <textarea id="choiceOneInFive_EvenAnswer_4" name="choiceOneInFiveAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer J</label>
                                <textarea id="choiceOneInFive_Even_explanation_answer_4" name="choiceOneInFive_explanation_answer_4"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                            <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>K: </span><input type="radio"  value="k" name="addChoiceOneInFive"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value"
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFiveEven_add_guessing_value_K" name="oneInFiveEven_add_guessing_value_K">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFiveEven_add_guessing_valueE_K"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'K', 'disp_section' => 'oneInFiveEven_'])

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
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>A: </span><input type="radio" value="a" name="addChoiceOneInFourPass"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="add_guessing_value_A" name="add_guessing_value_A">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="add_guessing_valueE_A"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'A', 'disp_section' => ''])

                                <textarea id="choiceOneInFourPass_OddAnswer_1" name="choiceOneInFourPassAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer A</label>
                                <textarea id="choiceOneInFourPass_Odd_explanation_answer_1" name="choiceOneInFourPass_explanation_answer_1"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="addChoiceOneInFourPass"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="add_guessing_value_B" name="add_guessing_value_B">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="add_guessing_valueE_B"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'B', 'disp_section' => ''])

                                <textarea id="choiceOneInFourPass_OddAnswer_2" name="choiceOneInFourPassAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer B</label>
                                <textarea id="choiceOneInFourPass_Odd_explanation_answer_2" name="choiceOneInFourPass_explanation_answer_2"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>C: </span><input type="radio"  value="c" name="addChoiceOneInFourPass"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="add_guessing_value_C" name="add_guessing_value_C">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="add_guessing_valueE_C"></span>
                                        </div>  
                                    </div>
                                </div>
                                

                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'C', 'disp_section' => ''])

                                <textarea id="choiceOneInFourPass_OddAnswer_3" name="choiceOneInFourPassAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer C</label>
                                <textarea id="choiceOneInFourPass_Odd_explanation_answer_3" name="choiceOneInFourPass_explanation_answer_3"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>D: </span><input type="radio"  value="d" name="addChoiceOneInFourPass"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="add_guessing_value_D" name="add_guessing_value_D">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="add_guessing_valueE_D"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'D', 'disp_section' => ''])

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
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>F: </span><input type="radio" value="f" name="addChoiceOneInFourPass"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFourPassEven_add_guessing_value_F" name="oneInFourPassEven_add_guessing_value_F">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFourPassEven_add_guessing_valueE_F"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'F', 'disp_section' => 'oneInFourPassEven_'])

                                <textarea id="choiceOneInFourPass_EvenAnswer_1" name="choiceOneInFourPassAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer F</label>
                                <textarea id="choiceOneInFourPass_Even_explanation_answer_1" name="choiceOneInFourPass_explanation_answer_1"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>G: </span><input type="radio"  value="g" name="addChoiceOneInFourPass"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value"
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFourPassEven_add_guessing_value_G" name="oneInFourPassEven_add_guessing_value_G">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFourPassEven_add_guessing_valueE_G"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'G', 'disp_section' => 'oneInFourPassEven_'])

                                <textarea id="choiceOneInFourPass_EvenAnswer_2" name="choiceOneInFourPassAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer G</label>
                                <textarea id="choiceOneInFourPass_Even_explanation_answer_2" name="choiceOneInFourPass_explanation_answer_2"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>H: </span><input type="radio"  value="h" name="addChoiceOneInFourPass"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFourPassEven_add_guessing_value_H" name="oneInFourPassEven_add_guessing_value_H">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFourPassEven_add_guessing_valueE_H"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'H', 'disp_section' => 'oneInFourPassEven_'])

                                <textarea id="choiceOneInFourPass_EvenAnswer_3" name="choiceOneInFourPassAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                            </li>
                            <li>
                                <label class="form-label">Explanation Answer H</label>
                                <textarea id="choiceOneInFourPass_Even_explanation_answer_3" name="choiceOneInFourPass_explanation_answer_3"
                                    class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-4">
                                    <label class="form-label" style="font-size: 13px;"><span>J: </span><input type="radio"  value="j" name="addChoiceOneInFourPass"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="oneInFourPassEven_add_guessing_value_J" name="oneInFourPassEven_add_guessing_value_J">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="oneInFourPassEven_add_guessing_valueE_J"></span>
                                        </div>  
                                    </div>
                                </div>
                                
                                @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'J', 'disp_section' => 'oneInFourPassEven_'])

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
                        </label>
                        <div class="multi_field" style="display: none">
                            <ul class="answerOptionLsit">
                                <li>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>A: </span> <input type="checkbox" value="a" name="addChoiceMultInFourFill[]"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="cb_choiceMultInFourFill_add_guessing_value_A" name="cb_choiceMultInFourFill_add_guessing_value_A">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="cb_choiceMultInFourFill_add_guessing_valueE_A"></span>
                                        </div>  
                                    </div>
                                </div>
                                    
                                    @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'A', 'disp_section' => 'cb_choiceMultInFourFill_'])

                                    <textarea id="choiceMultInFourFillAnswer_1" name="choiceMultInFourFillAnswer_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea></li>
                                <li>
                                    <label class="form-label">Explanation Answer A</label>
                                    <textarea id="choiceMultInFourFill_explanation_answer_1" name="choiceMultInFourFill_explanation_answer_1"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>B: </span><input type="checkbox"  value="b" name="addChoiceMultInFourFill[]"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="cb_choiceMultInFourFill_add_guessing_value_B" name="cb_choiceMultInFourFill_add_guessing_value_B">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="cb_choiceMultInFourFill_add_guessing_valueE_B"></span>
                                        </div>  
                                    </div>
                                </div>
                                    
                                    @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'B', 'disp_section' => 'cb_choiceMultInFourFill_'])

                                    <textarea id="choiceMultInFourFillAnswer_2" name="choiceMultInFourFillAnswer_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer B</label>
                                    <textarea id="choiceMultInFourFill_explanation_answer_2" name="choiceMultInFourFill_explanation_answer_2"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>C: </span><input type="checkbox"  value="c" name="addChoiceMultInFourFill[]"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="cb_choiceMultInFourFill_add_guessing_value_C" name="cb_choiceMultInFourFill_add_guessing_value_C">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="cb_choiceMultInFourFill_add_guessing_valueE_C"></span>
                                        </div>  
                                    </div>
                                </div>
                                    
                                    @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'C', 'disp_section' => 'cb_choiceMultInFourFill_'])

                                    <textarea id="choiceMultInFourFillAnswer_3" name="choiceMultInFourFillAnswer_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer C</label>
                                    <textarea id="choiceMultInFourFill_explanation_answer_3" name="choiceMultInFourFill_explanation_answer_3"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                        <label class="form-label" style="font-size: 13px;"><span>D:</span><input type="checkbox"  value="d" name="addChoiceMultInFourFill[]"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="cb_choiceMultInFourFill_add_guessing_value_D" name="cb_choiceMultInFourFill_add_guessing_value_D">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="cb_choiceMultInFourFill_add_guessing_valueE_D"></span>
                                        </div>  
                                    </div>
                                </div>
                                    
                                    @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'D', 'disp_section' => 'cb_choiceMultInFourFill_'])

                                    <textarea id="choiceMultInFourFillAnswer_4" name="choiceMultInFourFillAnswer_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer D</label>
                                    <textarea id="choiceMultInFourFill_explanation_answer_4" name="choiceMultInFourFill_explanation_answer_4"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                            </ul>
                        </div>
                        <div class="multiChoice_field" style="display:none">
                            <ul class="answerOptionLsit">
                                <li>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>A: </span> <input type="radio" value="a" name="addChoiceMultiChoiceInFourFill"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="choiceMultInFourFill_add_guessing_value_A" name="choiceMultInFourFill_add_guessing_value_A">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="choiceMultInFourFill_add_guessing_valueE_A"></span>
                                        </div>  
                                    </div>
                                </div>
                                    
                                    @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'A', 'disp_section' => 'choiceMultInFourFill_'])

                                    <textarea id="addChoiceMultiChoiceInFourFill_1" name="addChoiceMultiChoiceInFourFill_1" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer A</label>
                                    <textarea id="choiceMultiChoiceInFourFill_explanation_answer_1" name="choiceMultiChoiceInFourFill_explanation_answer_1"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>B: </span><input type="radio"  value="b" name="addChoiceMultiChoiceInFourFill"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="choiceMultInFourFill_add_guessing_value_B" name="choiceMultInFourFill_add_guessing_value_B">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="choiceMultInFourFill_add_guessing_valueE_B"></span>
                                        </div>  
                                    </div>
                                </div>
                                    
                                    @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'B', 'disp_section' => 'choiceMultInFourFill_'])

                                    <textarea id="addChoiceMultiChoiceInFourFill_2" name="addChoiceMultiChoiceInFourFill_2" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer B</label>
                                    <textarea id="choiceMultiChoiceInFourFill_explanation_answer_2" name="choiceMultiChoiceInFourFill_explanation_answer_2"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>C: </span><input type="radio"  value="c" name="addChoiceMultiChoiceInFourFill"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="choiceMultInFourFill_add_guessing_value_C" name="choiceMultInFourFill_add_guessing_value_C">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="choiceMultInFourFill_add_guessing_valueE_C"></span>
                                        </div>  
                                    </div>
                                </div>
                                    
                                    @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'C', 'disp_section' => 'choiceMultInFourFill_'])

                                    <textarea id="addChoiceMultiChoiceInFourFill_3" name="addChoiceMultiChoiceInFourFill_3" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer C</label>
                                    <textarea id="choiceMultiChoiceInFourFill_explanation_answer_3" name="choiceMultiChoiceInFourFill_explanation_answer_3"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                                <li>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    <label class="form-label" style="font-size: 13px;"><span>D:</span><input type="radio"  value="d" name="addChoiceMultiChoiceInFourFill"></label>

                                    </div>
                                    <div class="col-md-8 for_digital_only">
                                        <div class="mb-2 ">
                                            <label class="form-label" for="guessing-value">Guessing Value<span
                                                    class="text-danger">*</span>
                                                    
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                    min="1" max="100" type="number" oninput="validateInput(this)"
                                                    
                                                    id="choiceMultInFourFill_add_guessing_value_D" name="choiceMultInFourFill_add_guessing_value_D">
                                                </div>
                                            </label>
                                            <span class="text-danger" id="choiceMultInFourFill_add_guessing_valueE_D"></span>
                                        </div>  
                                    </div>
                                </div>

                                    @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'D', 'disp_section' => 'choiceMultInFourFill_'])

                                    <textarea id="addChoiceMultiChoiceInFourFill_4" name="addChoiceMultiChoiceInFourFill_4" class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content" ></textarea>
                                </li>
                                <li>
                                    <label class="form-label">Explanation Answer D</label>
                                    <textarea id="choiceMultiChoiceInFourFill_explanation_answer_4" name="choiceMultiChoiceInFourFill_explanation_answer_4"
                                        class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                </li>
                            </ul>
                        </div>
                        <div class="fill_field" style="display:none">
                            <div class="mb-2"><label class="form-label" style="font-size: 13px;">Fill Type:</label><select name="addChoiceMultInFourFill_filltype"  class="form-control addChoiceMultInFourFill_filltype"><option value="">Select Type</option><option value="number">Number</option><option value="decimal">Decimal</option><option value="fraction">Fraction</option></select></div>
                            <div class="mb-2"><label class="form-label" style="font-size: 13px;">Fill:</label><input type="text" name="addChoiceMultInFourFill_fill[]"><label class="form-label extraFillOption" style="font-size: 13px;"></label><label class="form-label" style="font-size: 13px;"><a href="javascript:;" onClick="addMoreFillOption();" class="switchMulti">Add More Options</a></label></div>

                            {{-- <div class="input-container" id="fc_add_New_Types_A">
                                <div class="d-flex input-field align-items-center">
                                    <div class="col-md-1">
                                        <label class="form-label" for="fc_ct_checkbox_A">&ensp;</label>
                                        <input type="checkbox" name="fc_ct_checkbox_A" id="fc_ct_checkbox_A_0">
                                    </div>

                                    <div class="col-md-3 mb-2 me-2 rating-tag">
                                        <label class="form-label" for="superCategory">Super Category<span class="text-danger">*</span></label>
                                        <div class="d-flex align-items-center">
                                            <select class="switchMulti superCategory" id="fc_super_category_create_A_0" name="fc_super_category_create_A" style="width: 100%">
                                                <option value="">Select Super Category</option>
                                            </select>
                                        </div>
                                        <span class="text-danger" id="fc_superCategoryError"></span>
                                    </div>

                                    <div class="col-md-3 mb-2 me-2 category-custom">
                                        <label for="category_type" class="form-label">Category Type<span class="text-danger">*</span></label>
                                        <div class="d-flex align-items-center">
                                            <select class="switchMulti categoryType" id="fc_add_category_type_A_0" name="fc_add_category_type_A" style="width: 100%">
                                                <option value="">Select Category Type</option>
                                            </select>
                                        </div>
                                        <span class="text-danger" id="fc_categoryTypeError"></span>
                                    </div>

                                    <div class="mb-2 col-md-3 add_question_type_select">
                                        <label for="search-input" class="form-label">Question Type<span class="text-danger">*</span></label>
                                        <div class="d-flex align-items-center">
                                            <select class="switchMulti questionType" id="fc_add_search-input_A_0" name="fc_add_search-input_A" style="width: 100%">
                                                <option value="">Select Question Type</option>
                                            </select>
                                        </div>
                                        <span class="text-danger" id="fc_questionTypeError"></span>
                                    </div>

                                    <div class="col-md-2 add-position">
                                        <button class="plus-button add-plus-button" ans_col='A' data-id="1" onclick="addNewType(this, 'fc_')"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                </div>
                            </div> --}}
                            @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', ['ans_choices' => 'A', 'disp_section' => 'fc_'])

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

{{-- modal for new addad section questions  --}}
<div class="modal fade" id="addDragModalQuestion" tabindex="-1" aria-labelledby="staticBackdropLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Question list Order</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="addListWithHandleQuestion" class="list-group">

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="saveQuestion()">Save changes</button>
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
    <script src="{{ asset('js/admin/course.js') }}"></script>
    <script>
        var questionCount = $('.sectionList').length + 1;
        var questionOrder = 0;
        var sectionOrder = $(`.sectionContainerList .sectionTypesFull`).length;
        getMathDiv();
        var preGetPracticeCategoryType = "";
        var preGetPracticeQuestionType = "";
        var preGetSuperCategory = "";
        var is_edit = false;
        $('.for_digital_only').hide();

        var newSectionOrder = '{{ count($testsections) }}';

        

        function getMathDiv(){
            return $('.checkMathDiv').find('.firstRecord .sectionList');
        }

        $("#passageRequired_1").click(function() {
            if ($(this).is(":checked")) {
                $("#add_passage_number").prop("disabled", false);
                $("select[name='addPassagesType']").prop("disabled", false);
            } else {
                $("#add_passage_number").prop("disabled", true);
                $("select[name='addPassagesType']").prop("disabled", true);
            }
        });

        $("#passageRequired_2").click(function() {
            if ($(this).is(":checked")) {
                $("#passage_number").prop("disabled", false);
                $("select[name='passagesType']").prop("disabled", false);
            } else {
                $("#passage_number").prop("disabled", true);
                $("select[name='passagesType']").prop("disabled", true);
            }
        });

        function insertSuperCategory(data) {
            // console.log(data);

            let super_category_type = $(data).val();
                super_category_type = super_category_type.join(" ");
            let section_type = $('#section_type').val();
            let format = $('#format').val();
            if(super_category_type != '' && !containsOnlyNumbers(super_category_type)) {
                $.ajax({
                    type: 'post',
                    url: '{{ route("addSuperCategory") }}',
                    data:{
                        searchValue: super_category_type,
                        format:format,
                        section_type:section_type,
                        '_token': $('input[name="_token"]').val()
                    },
                    success: function(res){
                        if(res.success) {
                            $(".superCate").append('<option value=' + res.id + '>' + res.super_category_title + '</option>');
                        }
                    }
                });
            }
        }

        function insertCategoryType(data) {
            let category_type = $(data).val();
                category_type = category_type.join(" ");
            let section_type = $('#section_type').val();
            let format = $('#format').val();
            let super_category = '';
            // if(is_edit == true){
            //     super_category = $('#questionMultiModal select[name="super_category_edit"]').val();
            // } else {
            //     super_category = $('#addQuestionMultiModal select[name="super_category_create"]').val();
            // }
            let closestSuperCategory = $(data).closest('.category-custom').prev('.rating-tag').find('select.superCategory');
            if (closestSuperCategory.length > 0) {
                super_category = closestSuperCategory.val();
            }

            if(category_type != '' && !containsOnlyNumbers(category_type)) {
                $.ajax({
                    type: 'post',
                    url: '{{ route("addPracticeCategoryType") }}',
                    data:{
                        searchValue: category_type,
                        format:format,
                        section_type:section_type,
                        super_category:super_category,
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

        //new
        function insertDiffRating(data){
            let diff_rating = $(data).val();
            if(diff_rating != '' && !containsOnlyNumbers(diff_rating)){
                $.ajax({
                    type: 'post',
                    url: '{{ route("addDiffRating") }}',
                    data:{
                        searchValue: diff_rating,
                        '_token': $('input[name="_token"]').val()
                    },
                    success: function(res){
                        if(res.success) {
                            $(".diffRating").append('<option value=' + res.id + '>' + res.diff_rating_title + '</option>');
                        }
                    }
                });
            }
        }

        function insertQuestionTag(data){
            let question_tag = $(data).val();
            let format = $('#format').val();
            if(question_tag != '' && !containsOnlyNumbers(question_tag)){
                $.ajax({
                    type: 'post',
                    url: '{{ route("addQuestionTag") }}',
                    data:{
                        searchValue: question_tag,
                        format:format,
                        '_token': $('input[name="_token"]').val()
                    },
                    success: function(res){
                        if(res.success) {
                            $(".questionTag").append('<option value=' + res.id + '>' + res.question_tag + '</option>');
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
            let section_type = $('#section_type').val();
            let format = $('#format').val();
            let id = $(data).attr('data-id');
            let super_category = '';
            let category = '';
            // if(is_edit == true){
            //     // super_category = $('#questionMultiModal select[name="super_category_edit"]').val();
            //     super_category = $(`#questionMultiModal #edit_super_category_${id}`).val();
            //     category = $(`#questionMultiModal #category_type_${id}`).val();
            // } else {
            //     // super_category = $('#addQuestionMultiModal select[name="super_category_create"]').val();
            //     super_category = $(`#addQuestionMultiModal #super_category_create_${id}`).val();
            //     category = $(`#addQuestionMultiModal #add_category_type_${id}`).val();
            // }
            super_category = $(data).closest('.add_question_type_select').siblings('.rating-tag').find('select.superCategory').first().val();
            category = $(data).closest('.add_question_type_select').siblings('.category-custom').find('select.categoryType').first().val();
            if(question_type != '' && !containsOnlyNumbers(question_type)) {
                $.ajax({
                    type: 'post',
                    url: '{{ route("addPracticeQuestionType") }}',
                    data:{
                        searchValue: question_type,
                        format:format,
                        section_type:section_type,
                        super_category:super_category,
                        category:category,
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

                        if(resp.type == 'super_categories') {
                            option += `<option value="${value.id}">`;
                            option += `${value.title}`;
                            option += `</option>`;
                        }
                    });
                    return option;
                } else {
                    return option;
                }
            });
        }

        async function addNewTypes(ans_col, data, type, disp_option = '', super_cat_option = '', cat_type_option = '', question_type_option = '') {
            let key = null;
            // console.log('yes here');
            if(type != 'null' && type == 'repet') {
                key = parseInt(data);
            } else {
                key = $(data).attr(`${disp_option}data-id-${ans_col}`);
                key = parseInt(key);

                let super_category = $(`#${disp_option}edit_super_category_${ans_col}_${key - 1}`).val();
                let category_type = $(`#${disp_option}edit_category_type_${ans_col}_${key - 1}`).val();
                let question_type = $(`#${disp_option}edit_search-input_${ans_col}_${key - 1}`).val();

                if(super_category == '') {
                    toastr.error('Please select a Super Category!');
                    return false;
                }

                if(category_type == '') {
                    toastr.error('Please select a category type!');
                    return false;
                }

                if(question_type == '') {
                    toastr.error('Please select a question type!');
                    return false;
                }
            }

            let testType = $('#format').val();
            if(super_cat_option == '') {
                super_cat_option = await dropdown_lists(`/admin/getSuperCategory?testType=${testType}`);
            }
            if(cat_type_option == '') {
                cat_type_option = await dropdown_lists(`/admin/getPracticeCategoryType?testType=${testType}`);
            }
            if(question_type_option == '') {
                question_type_option = await dropdown_lists(`/admin/getPracticeQuestionType?testType=${testType}`);
            }

            let html = ``;
                html += `<div class="d-flex input-field align-items-center removeNewTypes">`;

                html += `<div class="col-md-2 align-self-start">`;
                html += `<input type="checkbox" name="${disp_option}edit_ct_checkbox_${ans_col}" id="${disp_option}edit_ct_checkbox_${ans_col}_${key}">`;
                html += `</div>`;

                html += `<div class="col-md-3 mb-2 me-2 rating-tag">`;
                html += `<div class="d-flex align-items-center">`;
                html += `<select class="js-select2 select superCategory" id="${disp_option}edit_super_category_${ans_col}_${key}" name="${disp_option}edit_super_category_${ans_col}" onchange="insertSuperCategory(this)" multiple>`;
                // html += preGetSuperCategory;
                html += super_cat_option;
                html += `</select>`;
                html += `</div>`;
                html += `</div>`;

                html += `<div class="mb-2 col-md-3 me-2 category-custom">`;
                html += `<div class="d-flex align-items-center">`;
                html += `<select class="js-select2 select categoryType" id="${disp_option}edit_category_type_${ans_col}_${key}" name="${disp_option}edit_category_type_${ans_col}" data-id="${key}" onchange="insertCategoryType(this)" multiple>`;
                // html += preGetPracticeCategoryType;
                html += cat_type_option;
                html += `</select>`;
                html += `</div>`;
                html += `</div>`;
                html += `<div class="mb-2 col-md-3 add_question_type_select">`;
                html += `<div class="d-flex align-items-center">`;
                html += `<select class="js-select2 select questionType" id="${disp_option}edit_search-input_${ans_col}_${key}" name="${disp_option}edit_search-input_${ans_col}" data-id="${key}" onchange="insertQuestionType(this)" multiple>`;
                // html += preGetPracticeQuestionType;
                html += question_type_option;
                html += `</select>`;
                html += `</div>`;
                html += `</div>`;
                html += `<div class="col-md-1 add-minus-icon">`;
                html += `<button class="plus-button" onclick="removeNewTypes(this)"><i class="fa-solid fa-minus"></i></button>`;
                html += `</div>`;
                html += `</div>`;

            $(`#${disp_option}addNewTypes_${ans_col}`).append(html);

            $(`#${disp_option}edit_search-input_${ans_col}_${key}`).select2({
                dropdownParent: $('#questionMultiModal'),
                tags : true,
                placeholder : "Select Question type",
                maximumSelectionLength: 1
            });

            $(`#${disp_option}edit_super_category_${ans_col}_${key}`).select2({
                dropdownParent: $('#questionMultiModal'),
                tags : true,
                placeholder : "Select Super Category",
                maximumSelectionLength: 1
            });

            $(`#${disp_option}edit_category_type_${ans_col}_${key}`).select2({
                dropdownParent: $('#questionMultiModal'),
                tags : true,
                placeholder : "Select Category type",
                maximumSelectionLength: 1
            });

            if(type !== 'repet') {
                $(data).attr(`${disp_option}data-id-${ans_col}`, key + 1);
            } else {
                var button = document.querySelector(`button[${disp_option}ans_col="${ans_col}"]`);
                button.setAttribute(`${disp_option}data-id-${ans_col}`, key + 1);
            }
        }
        
        //new function for add category and question types
        async function addNewType(data, disp_option = '') {
            let button = $(data);
            button.attr('disabled', true);

            let key = $(data).attr('data-id');
                key = parseInt(key);

            let ans_col = $(data).attr('ans_col');

            let testType = $('#format').val();
            let super_category = $(`#${disp_option}super_category_create_${ans_col}_${key - 1}`).val();
            let category_type = $(`#${disp_option}add_category_type_${ans_col}_${key - 1}`).val();
            let question_type = $(`#${disp_option}add_search-input_${ans_col}_${key - 1}`).val();

            if(super_category == '') {
                toastr.error('Please select a Super category!');
                button.attr('disabled', false);
                return false;
            }

            if(category_type == '') {
                toastr.error('Please select a category type!');
                button.attr('disabled', false);
                return false;
            }

            if(question_type == '') {
                toastr.error('Please select a question type!');
                button.attr('disabled', false);
                return false;
            }

            preGetPracticeCategoryType = await dropdown_lists(`/admin/getPracticeCategoryType?testType=${testType}`);
            preGetPracticeQuestionType = await dropdown_lists(`/admin/getPracticeQuestionType?testType=${testType}`);
            preGetSuperCategory = await dropdown_lists(`/admin/getSuperCategory?testType=${testType}`);

            let html = ``;
                html += `<div class="d-flex input-field align-items-center removeNewType">`;

                html += `<div class="col-md-2 align-self-start">`;
                html += `<input type="checkbox" name="${disp_option}ct_checkbox_${ans_col}" id="${disp_option}ct_checkbox_${ans_col}_${key}">`;
                html += `</div>`;

                html += `<div class="col-md-3 mb-2 me-2 rating-tag">`;
                html += `<div class="d-flex align-items-center">`;
                html += `<select class="js-select2 select superCategory" id="${disp_option}super_category_create_${ans_col}_${key}" name="${disp_option}super_category_create_${ans_col}" data-id="${key}" onchange="insertSuperCategory(this)" multiple>`;
                html += preGetSuperCategory;
                html += `</select>`;
                html += `</div>`;
                html += `</div>`;

                html += `<div class="col-md-3 mb-2 me-2 category-custom">`;
                html += `<div class="d-flex align-items-center">`;
                html += `<select class="js-select2 select categoryType" id="${disp_option}add_category_type_${ans_col}_${key}" name="${disp_option}add_category_type_${ans_col}" data-id="${key}" onchange="insertCategoryType(this)" multiple>`;
                html +=  preGetPracticeCategoryType;
                html += `</select>`;
                html += `</div>`;
                html += `</div>`;

                html += `<div class="mb-2 col-md-3 add_question_type_select">`;
                html += `<div class="d-flex align-items-center">`;
                html += `<select class="js-select2 select questionType" id="${disp_option}add_search-input_${ans_col}_${key}" name="${disp_option}add_search-input_${ans_col}" data-id="${key}" onchange="insertQuestionType(this)" multiple>`;
                html +=  preGetPracticeQuestionType;
                html += `</select>`;
                html += `</div>`;
                html += `</div>`;

                html += `<div class="col-md-1 add-minus-icon">`;
                html += `<button class="plus-button" onclick="removeNewType(this)"><i class="fa-solid fa-minus"></i></button>`;
                html += `</div>`;
                html += `</div>`;

            $(`#${disp_option}add_New_Types_${ans_col}`).append(html);
            
            $(`#${disp_option}super_category_create_${ans_col}_${key}`).select2();
            $(`#${disp_option}add_category_type_${ans_col}_${key}`).select2();
            $(`#${disp_option}add_search-input_${ans_col}_${key}`).select2();
            
            $(`#${disp_option}super_category_create_${ans_col}_${key}`).select2({
                dropdownParent: $('#addQuestionMultiModal'),
                tags : true,
                placeholder : "Select Super Category",
                maximumSelectionLength: 1
            });

            $(`#${disp_option}add_category_type_${ans_col}_${key}`).select2({
                dropdownParent: $('#addQuestionMultiModal'),
                tags : true,
                placeholder : "Select Category type",
                maximumSelectionLength: 1
            });

            $(`#${disp_option}add_search-input_${ans_col}_${key}`).select2({
                dropdownParent: $('#addQuestionMultiModal'),
                tags : true,
                placeholder : "Select Question type",
                maximumSelectionLength: 1
            });
            button.attr('disabled', false);

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

    $(document).ready(async function() {
        $( '#questionMultiModal' ).modal( {
                focus: false
        } );

        $( '#addQuestionMultiModal' ).modal( {
            focus: false
        } );

        // $('input[name=tags]').tagify();

        $(`#question_tags_create`).select2({
            dropdownParent: $('#addQuestionMultiModal'),
            tags : true,
            placeholder : "Select Question Tag",
            maximumSelectionLength: 1
        });

        // $(`#super_category_edit`).select2({
        //     dropdownParent: $('#questionMultiModal'),
        //     tags : true,
        //     placeholder : "Select Super Category",
        //     maximumSelectionLength: 1
        // });

        // $(`#super_category_create`).select2({
        //     dropdownParent: $('#addQuestionMultiModal'),
        //     tags : true,
        //     placeholder : "Select Super Category",
        //     maximumSelectionLength: 1
        // });

        $(`#question_tags_edit`).select2({
            dropdownParent: $('#questionMultiModal'),
            tags : true,
            placeholder : "Select Question Tag",
            maximumSelectionLength: 1
        });

        $(`#format`).select2({
            // minimumResultsForSearch: -1,
            placeholder : "Select test type"
        });

        $(`#source`).select2({
            // minimumResultsForSearch: -1,
            placeholder : "Select test source"
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

        $(`#edit_super_category_0`).select2({
            dropdownParent: $('#questionMultiModal'),
            tags: true,
            placeholder : "Select Super Category",
            maximumSelectionLength: 1
        });


        $(`#diff_rating_edit`).select2({
            dropdownParent: $('#questionMultiModal'),
            tags: true,
            placeholder : "Select Difficulty Rating",
            maximumSelectionLength: 1
        });

        $(`#diff_rating_create`).select2({
            dropdownParent: $('#addQuestionMultiModal'),
            tags: true,
            placeholder : "Select Difficulty Rating",
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
        const disp_sections = ['', 'oneInFiveOdd_', 'oneInFiveEven_', 'oneInFourOdd_', 'oneInFourEven_', 'oneInFourPassEven_', 'choiceMultInFourFill_', 'cb_choiceMultInFourFill_'];
        const ans_choices = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K'];
        disp_sections.forEach(disp_section => {
            ans_choices.forEach(ans_choice => {
                $(`#${disp_section}super_category_create_${ans_choice}_0`).select2({
                    dropdownParent: $('#addQuestionMultiModal'),
                    tags: true,
                    placeholder : "Select Super Category",
                    maximumSelectionLength: 1
                });

                $(`#${disp_section}add_category_type_${ans_choice}_0`).select2({
                    dropdownParent: $('#addQuestionMultiModal'),
                    tags: true,
                    placeholder : "Select Category type",
                    maximumSelectionLength: 1
                });

                $(`#${disp_section}add_search-input_${ans_choice}_0`).select2({
                    dropdownParent: $('#addQuestionMultiModal'),
                    tags: true,
                    placeholder : "Select Question type",
                    maximumSelectionLength: 1
                });

                $(`#${disp_section}edit_super_category_${ans_choice}_0`).select2({
                    dropdownParent: $('#questionMultiModal'),
                    tags: true,
                    placeholder : "Select Super Category",
                    maximumSelectionLength: 1
                });

                $(`#${disp_section}edit_category_type_${ans_choice}_0`).select2({
                    dropdownParent: $('#questionMultiModal'),
                    tags: true,
                    placeholder : "Select Category type",
                    maximumSelectionLength: 1
                });

                $(`#${disp_section}edit_search-input_${ans_choice}_0`).select2({
                    dropdownParent: $('#questionMultiModal'),
                    tags: true,
                    placeholder : "Select Question type",
                    maximumSelectionLength: 1
                });
            });
        });

        $(`#add_passage_number`).select2({
            dropdownParent: $('#addQuestionMultiModal'),
            placeholder : "Select Passage No",
        });

        $(`.addPassagesType`).select2({
                dropdownParent: $('#addQuestionMultiModal'),
                placeholder : "Select Passages",
        });
        preGetPracticeCategoryType = await dropdown_lists(`/admin/getPracticeCategoryType`);
        preGetPracticeQuestionType = await dropdown_lists(`/admin/getPracticeQuestionType`);
        preGetSuperCategory = await dropdown_lists(`/admin/getSuperCategory?testType`);
    });

    var myModal = new bootstrap.Modal(document.getElementById('dragModal'), {
            keyboard: false
        });
    var myQuestionModal = new bootstrap.Modal(document.getElementById('dragModalQuestion'), {
            keyboard: false
        });
    var addQuestionModal = new bootstrap.Modal(document.getElementById('addDragModalQuestion'), {
            keyboard: false
        });
		let ckeditorFull = document.querySelector('#js-ckeditor-desc:not(.js-ckeditor-enabled)');
		var allowedContent = true;

        ckeditorFull.classList.add('js-ckeditor-enabled');

        $('.add_question_modal_btn').click(function() {
			$('.save_question').show();
			$('#questionModal').modal('show');
		});

        //new
        $('.preloader').css('display', 'block');
        $('textarea').each(function() {
            let textAreaId = $(this).attr('id');
            CKEDITOR.replace(textAreaId, {
                extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
                allowedContent: true,
                on: {
                instanceReady: function(event) {
                    if (textAreaId === $('textarea:last').attr('id')) {
                        $('.preloader').css('display', 'none');
                    }
                }
                }
            });
        });

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
            var test_source = $('#source option:selected').val();
            var currentModelQueId = $('#currentModelQueId').val();
            var difficulty = $('#diff_rating_edit').val();
            var format = $('#quesFormat').val();
            var fill = 'N/A';
            var fillType = 'N/A';
            var answerType ='N/A';
            var fillVals =[];
            var multiChoice = '';

            var diffValue = $('#diffValueEdit').val();
            var discValue =  $('#discValueEdit').val();

            var tags = $('#question_tags_edit').val();
            // var super_category = $('#super_category_edit').val();

            var activeAnswerType = '.'+$('#editSelectedAnswerType').val();
            var questionType = $('#questionMultiModal '+activeAnswerType+' #questionType').val();

            multiChoice = $('.editMultipleChoice option:selected').val();
            let ans_choices;
            let disp_section;
            if(questionType == 'choiceOneInFive_Odd') {
                ans_choices = ['A', 'B', 'C', 'D', 'E'];
                disp_section = 'oneInFiveOdd_';
            } else if(questionType == 'choiceOneInFourPass_Odd') {
                ans_choices = ['A', 'B', 'C', 'D'];
                disp_section = '';
            } else if(questionType == 'choiceOneInFour_Odd') {
                ans_choices = ['A', 'B', 'C', 'D'];
                disp_section = 'oneInFourOdd_';
            } else if(questionType == 'choiceOneInFour_Even') {
                ans_choices = ['F', 'G', 'H', 'J'];
                disp_section = 'oneInFourEven_';
            } else if (questionType == 'choiceOneInFive_Even') {
                ans_choices = ['F', 'G', 'H', 'J', 'K'];
                disp_section = 'oneInFiveEven_';
            } else if (questionType == 'choiceOneInFourPass_Even') {
                ans_choices = ['F', 'G', 'H', 'J'];
                disp_section = 'oneInFourPassEven_';
            } else if(questionType == 'choiceMultInFourFill') {

                // ans_choices = ['A', 'B', 'C', 'D'];
                // if(multiChoice == '1') {
                //     disp_section = 'cb_choiceMultInFourFill_';
                // } else if(multiChoice == '3') {
                //     disp_section = 'choiceMultInFourFill_';
                // }

                if (multiChoice == '1') {
                    ans_choices = ['A', 'B', 'C', 'D'];
                    disp_section = 'cb_choiceMultInFourFill_';
                } else if (multiChoice == '3') {
                    ans_choices = ['A', 'B', 'C', 'D'];
                    disp_section = 'choiceMultInFourFill_';
                } else if (multiChoice == '2') {
                    ans_choices = ['A'];
                    disp_section = 'fc_'; 
                }
            } else {
                ans_choices = ['A', 'B', 'C', 'D'];
                disp_section = '';
            }

            //For checkbox
            const checkboxValues = {};
            ans_choices.forEach(ans_choice => {
                checkboxValues[ans_choice] = $(`input[name="${disp_section}edit_ct_checkbox_${ans_choice}"]`)
                .map(function(i, v) {
                    return $(v).is(':checked') ? 1 : 0;
                })
                .get();
            });

            //For Guessing Values
            const guessingValue = {};
            ans_choices.forEach(ans_choice => {
                const selectElements = $(`input[name="${disp_section}edit_guessing_value_${ans_choice}"]`);
                // console.log(disp_section+'edit_guessing_value_'+ans_choice);
                // console.log(selectElements);
                const values = selectElements.map(function() {
                    const edit_guessing_value = $(this).val();
                    return (edit_guessing_value !== '') ? edit_guessing_value : null;
                }).get().filter(value => value !== null);
                guessingValue[ans_choice] = values;
            });

            //For super category
            const superCategoryValues = {};
            ans_choices.forEach(ans_choice => {
                const selectElements = $(`select[name="${disp_section}edit_super_category_${ans_choice}"]`);
                const values = selectElements.map(function() {
                    const super_category_val = $(this).val();
                    return super_category_val.length > 0 ? super_category_val : null;
                }).get().filter(value => value !== null);
                superCategoryValues[ans_choice] = values;
            });

            //For category type
            const getCategoryTypeValues = {};
            ans_choices.forEach(ans_choice => {
                const selectElements = $(`select[name="${disp_section}edit_category_type_${ans_choice}"]`);
                const values = selectElements.map(function() {
                    const category_type_val = $(this).val();
                    return category_type_val.length > 0 ? category_type_val : null;
                }).get().filter(value => value !== null);
                getCategoryTypeValues[ans_choice] = values;
            });

            //For question type
            const getQuestionTypeValues = {};
            ans_choices.forEach(ans_choice => {
                const selectElements = $(`select[name="${disp_section}edit_search-input_${ans_choice}"]`);
                const values = selectElements.map(function() {
                    const question_type_val = $(this).val();
                    return question_type_val.length > 0 ? question_type_val : null;
                }).get().filter(value => value !== null);
                getQuestionTypeValues[ans_choice] = values;
            });

            var testSectionType = $('#testSectionTypeRead').val();
            var question = CKEDITOR.instances['js-ckeditor-addQue'].getData();
            // var pass = ''; //CKEDITOR.instances['js-ckeditor-passquestion'].getData();
            var pass = $('select[name="passagesType"] :selected').text();
            var passNumber = $('#questionMultiModal .passNumber').val();
			var passagesType = $('#questionMultiModal #passagesType').val();
            var passagesTypeTxt = $("#passagesType option:selected").text();
            var ifFillChoice = $('.editMultipleChoice').val();
            // console.log(ifFillChoice);

            var questTypeArr = ['ACT','SAT','PSAT'];

            if((jQuery.inArray(format, questTypeArr) != -1) || (ifFillChoice == 2)) {
                if($('#passageRequired_2').is(':checked')) {
                    if(
                        question == '' ||
                        tags.length == 0 ||
                        jQuery.type(passNumber) == "null" ||
                        passagesType == '' ||
                        format == '' ||
                        testSectionType == '' ||
                        ans_choices.some(choice => {
                            const super_category_values = superCategoryValues[choice];
                            const get_category_type_values = getCategoryTypeValues[choice];
                            const get_question_type_values = getQuestionTypeValues[choice];

                            return (
                                super_category_values.length === 0 ||
                                get_category_type_values.length === 0 ||
                                get_question_type_values.length === 0
                            );
                        })
                    ) {
                        // console.log('here 3');
                        // if(format =='' || testSectionType =='' || question =='' || questionType =='' || passagesType =='' || passNumber ==''){
                        // $('#questionMultiModal .validError').text('Below fields are required!');
                        $('#questionMultiModal #questionError').text(question == '' ? 'Question is required!' : '');
                        $('#js-ckeditor-addQue').focus();
                        $('#questionMultiModal #tagError').text(tags == '' ? 'Tag is required!' : '');
                        $('#editQuestionTag').focus();

                        $('#questionMultiModal #passNumberError').text(passNumber =='' ? 'Passage Number is required!' : '');
                        $('#passage_number').focus();
                        $('#questionMultiModal #passageTypeError').text(jQuery.type(passagesType) =='null' ? 'Passage Type is required!' : '');
                        $('#passagesType').focus();

                        ans_choices.forEach(choice => {
                            const super_category_values = superCategoryValues[choice];
                            const get_category_type_values = getCategoryTypeValues[choice];
                            const get_question_type_values = getQuestionTypeValues[choice];

                            $(`#questionMultiModal #${disp_section}superCategoryError_${choice}`).text(super_category_values.length == 0 ? 'Super Category is required!' : '');
                            $(`#questionMultiModal #${disp_section}categoryTypeError_${choice}`).text(get_category_type_values.length == 0 ? 'Category type is required!' : '');
                            $(`#questionMultiModal #${disp_section}questionTypeError_${choice}`).text(get_question_type_values.length == 0 ? 'Question type is required!' : '');
                            $(`#questionMultiModal #${disp_section}questionTypeError_${choice}`).text(get_question_type_values.length == 0 ? 'Question type is required!' : '');
                        
                        });

                        return false;
                    }else{
                        // console.log('here 4');
                        // $('#questionMultiModal .validError').text('');
                        $('#questionMultiModal #questionError').text('');
                        $('#questionMultiModal #tagError').text('');
                        $('#questionMultiModal #passNumberError').text('');
                        $('#questionMultiModal #passageTypeError').text('');

                        ans_choices.forEach(ans_choice => {
                            $(`#questionMultiModal #${disp_section}superCategoryError_${ans_choice}`).text('');
                            $(`#questionMultiModal #${disp_section}categoryTypeError_${ans_choice}`).text('');
                            $(`#questionMultiModal #${disp_section}questionTypeError_${ans_choice}`).text('');
                            // $(`#questionMultiModal #${disp_section}edit_guessing_valueE_${ans_choice}`).text('');
                        });
                    }

                } else {
                    // console.log('here 5');
                    if(question =='' ||
                        tags ==0 ||
                        format =='' ||
                        testSectionType =='' ||
                        ans_choices.some(choice => {
                            const super_category_values = superCategoryValues[choice];
                            const get_category_type_values = getCategoryTypeValues[choice];
                            const get_question_type_values = getQuestionTypeValues[choice];
                            // const get_guess_values = guessingValue[choice];
                            return (
                                (super_category_values && super_category_values?.length) === 0 ||
                                get_category_type_values.length === 0 ||
                                // get_guess_values.length === 0 ||
                                get_question_type_values.length === 0
                            );
                        })
                    ){
                        // console.log('here 6');
                        // if(format =='' || testSectionType =='' || question =='' || questionType ==''){
                        // $('#questionMultiModal .validError').text('Below fields are required!');
                        $('#questionMultiModal #questionError').text(question =='' ? 'Question is required!' : '');
                        $('#js-ckeditor-addQue').focus();
                        $('#questionMultiModal #tagError').text(tags =='' ? 'Tag is required!' : '');
                        $('#editQuestionTag').focus();

                        ans_choices.forEach(choice => {
                            const super_category_values = superCategoryValues[choice];
                            const get_category_type_values = getCategoryTypeValues[choice];
                            const get_question_type_values = getQuestionTypeValues[choice];
                            // var super_category_values = eval(`super_category_values_${choice}`);
                            // var get_category_type_values = eval(`get_category_type_values_${choice}`);
                            // var get_question_type_values = eval(`get_question_type_values_${choice}`);

                            // var get_guess_values = guessingValue[choice];

                            $(`#questionMultiModal #${disp_section}superCategoryError_${choice}`).text(super_category_values.length == 0 ? 'Super Category is required!' : '');
                            $(`#questionMultiModal #${disp_section}categoryTypeError_${choice}`).text(get_category_type_values.length == 0 ? 'Category type is required!' : '');
                            $(`#questionMultiModal #${disp_section}questionTypeError_${choice}`).text(get_question_type_values.length == 0 ? 'Question type is required!' : '');
                            // $(`#questionMultiModal #${disp_section}edit_guessing_valueE_${choice}`).text(get_guess_values.length == 0 ? 'Guessing Value is required!' : '');
                        
                        });

                        return false;
                    }else{
                        // console.log('here 7');
                        // $('#questionMultiModal .validError').text('');
                        $('#questionMultiModal #questionError').text('');
                        $('#questionMultiModal #tagError').text('');

                        ans_choices.forEach(ans_choice => {
                            $(`#questionMultiModal #${disp_section}superCategoryError_${ans_choice}`).text('');
                            $(`#questionMultiModal #${disp_section}categoryTypeError_${ans_choice}`).text('');
                            $(`#questionMultiModal #${disp_section}questionTypeError_${ans_choice}`).text('');
                            // $(`#questionMultiModal #${disp_section}edit_guessing_valueE_${ans_choice}`).text('');
                        
                        });
                    }
                }
            }else{
                if($('#passageRequired_2').is(':checked')) {
                    if(
                        question == '' ||
                        tags.length == 0 ||
                        jQuery.type(passNumber) == "null" ||
                        diffValue == '' ||
                        discValue == '' ||
                        passagesType == '' ||
                        format == '' ||
                        testSectionType == '' ||
                        ans_choices.some(choice => {
                            const super_category_values = superCategoryValues[choice];
                            const get_category_type_values = getCategoryTypeValues[choice];
                            const get_question_type_values = getQuestionTypeValues[choice];
                            const get_guess_values = guessingValue[choice];

                            return (
                                super_category_values.length === 0 ||
                                get_category_type_values.length === 0 ||
                                get_guess_values.length === 0 ||
                                get_question_type_values.length === 0
                            );
                        })
                    ) {
                        // console.log('here 3');
                        // if(format =='' || testSectionType =='' || question =='' || questionType =='' || passagesType =='' || passNumber ==''){
                        // $('#questionMultiModal .validError').text('Below fields are required!');
                        $('#questionMultiModal #questionError').text(question == '' ? 'Question is required!' : '');
                        $('#js-ckeditor-addQue').focus();
                        $('#questionMultiModal #tagError').text(tags == '' ? 'Tag is required!' : '');
                        $('#editQuestionTag').focus();
                         
                        $('#questionMultiModal #diffValueError').text(diffValue == '' ? 'Diff value is required!' : '');
                        $('#diffValueEdit').focus();
                        $('#questionMultiModal #discValueError').text(discValue == '' ? 'Disc value is required!' : '');
                        $('#discValueEdit').focus();

                        $('#questionMultiModal #passNumberError').text(passNumber =='' ? 'Passage Number is required!' : '');
                        $('#passage_number').focus();
                        $('#questionMultiModal #passageTypeError').text(jQuery.type(passagesType) =='null' ? 'Passage Type is required!' : '');
                        $('#passagesType').focus();

                        ans_choices.forEach(choice => {
                            const super_category_values = superCategoryValues[choice];
                            const get_category_type_values = getCategoryTypeValues[choice];
                            const get_question_type_values = getQuestionTypeValues[choice];
                            const get_guess_values = guessingValue[choice];

                            $(`#questionMultiModal #${disp_section}superCategoryError_${choice}`).text(super_category_values.length == 0 ? 'Super Category is required!' : '');
                            $(`#questionMultiModal #${disp_section}categoryTypeError_${choice}`).text(get_category_type_values.length == 0 ? 'Category type is required!' : '');
                            $(`#questionMultiModal #${disp_section}questionTypeError_${choice}`).text(get_question_type_values.length == 0 ? 'Question type is required!' : '');
                            $(`#questionMultiModal #${disp_section}questionTypeError_${choice}`).text(get_question_type_values.length == 0 ? 'Question type is required!' : '');
                            $(`#questionMultiModal #${disp_section}edit_guessing_valueE_${choice}`).text(get_guess_values.length == 0 ? 'Guessing Value is required!' : '');
                        
                        });

                        return false;
                    }else{
                        // console.log('here 4');
                        // $('#questionMultiModal .validError').text('');
                        $('#questionMultiModal #questionError').text('');
                        $('#questionMultiModal #tagError').text('');
                        $('#questionMultiModal #passNumberError').text('');
                        $('#questionMultiModal #passageTypeError').text('');

                        $('#questionMultiModal #diffValueError').text('');
                        $('#questionMultiModal #discValueError').text('');

                        ans_choices.forEach(ans_choice => {
                            $(`#questionMultiModal #${disp_section}superCategoryError_${ans_choice}`).text('');
                            $(`#questionMultiModal #${disp_section}categoryTypeError_${ans_choice}`).text('');
                            $(`#questionMultiModal #${disp_section}questionTypeError_${ans_choice}`).text('');
                            $(`#questionMultiModal #${disp_section}edit_guessing_valueE_${ans_choice}`).text('');
                        });
                    }

                } else {
                    // console.log('here 5');
                    if(question =='' ||
                        tags ==0 ||
                        format =='' ||
                        diffValue == '' ||
                        discValue == '' ||
                        testSectionType =='' ||
                        ans_choices.some(choice => {
                            const super_category_values = superCategoryValues[choice];
                            const get_category_type_values = getCategoryTypeValues[choice];
                            const get_question_type_values = getQuestionTypeValues[choice];
                            const get_guess_values = guessingValue[choice];
                            return (
                                (super_category_values && super_category_values?.length) === 0 ||
                                get_category_type_values.length === 0 ||
                                get_guess_values.length === 0 ||
                                get_question_type_values.length === 0
                            );
                        })
                    ){
                        // console.log('here 6');
                        // if(format =='' || testSectionType =='' || question =='' || questionType ==''){
                        // $('#questionMultiModal .validError').text('Below fields are required!');
                        $('#questionMultiModal #questionError').text(question =='' ? 'Question is required!' : '');
                        $('#js-ckeditor-addQue').focus();
                        $('#questionMultiModal #tagError').text(tags =='' ? 'Tag is required!' : '');
                        $('#editQuestionTag').focus();

                        $('#questionMultiModal #diffValueError').text(diffValue == '' ? 'Diff value is required!' : '');
                        $('#diffValueEdit').focus();
                        $('#questionMultiModal #discValueError').text(discValue == '' ? 'Disc value is required!' : '');
                        $('#discValueEdit').focus();

                        ans_choices.forEach(choice => {
                            const super_category_values = superCategoryValues[choice];
                            const get_category_type_values = getCategoryTypeValues[choice];
                            const get_question_type_values = getQuestionTypeValues[choice];
                            // var super_category_values = eval(`super_category_values_${choice}`);
                            // var get_category_type_values = eval(`get_category_type_values_${choice}`);
                            // var get_question_type_values = eval(`get_question_type_values_${choice}`);

                            var get_guess_values = guessingValue[choice];

                            $(`#questionMultiModal #${disp_section}superCategoryError_${choice}`).text(super_category_values.length == 0 ? 'Super Category is required!' : '');
                            $(`#questionMultiModal #${disp_section}categoryTypeError_${choice}`).text(get_category_type_values.length == 0 ? 'Category type is required!' : '');
                            $(`#questionMultiModal #${disp_section}questionTypeError_${choice}`).text(get_question_type_values.length == 0 ? 'Question type is required!' : '');
                            $(`#questionMultiModal #${disp_section}edit_guessing_valueE_${choice}`).text(get_guess_values.length == 0 ? 'Guessing Value is required!' : '');
                        
                        });

                        return false;
                    }else{
                        // console.log('here 7');
                        // $('#questionMultiModal .validError').text('');
                        $('#questionMultiModal #questionError').text('');
                        $('#questionMultiModal #tagError').text('');

                        $('#questionMultiModal #diffValueError').text('');
                        $('#questionMultiModal #discValueError').text('');

                        ans_choices.forEach(ans_choice => {
                            $(`#questionMultiModal #${disp_section}superCategoryError_${ans_choice}`).text('');
                            $(`#questionMultiModal #${disp_section}categoryTypeError_${ans_choice}`).text('');
                            $(`#questionMultiModal #${disp_section}questionTypeError_${ans_choice}`).text('');
                            $(`#questionMultiModal #${disp_section}edit_guessing_valueE_${ans_choice}`).text('');
                        
                        });
                    }
                }
            }
            

            // console.log('here 8');
            if($('#passageRequired_2').is(':checked')){
                var pass = $('select[name="passagesType"] :selected').text();
                var passNumber = $('#questionMultiModal .passNumber').val();
			    var passagesType = $('#passagesType').val();
                var passagesTypeTxt = $("#passagesType option:selected").text();
            } else {
                var pass = '';
                var passNumber = '';
			    var passagesType = '';
                var passagesTypeTxt = '';
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
                        answerType = fill;
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
                // console.log('at ajax');
				$.ajax({
					data:{
						'id': currentModelQueId,
						'format': format,
                        'test_source':test_source,
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
                        'diff_rating': difficulty,
                        'diff_value': diffValue,
                        'disc_value': discValue,
                        'guessingValue': guessingValue,
						'multiChoice':multiChoice,
                        'section_id':section_id,
                        'tags':tags,
                        'ct_checkbox_values' : checkboxValues,
                        'super_category_values' : superCategoryValues,
                        'get_category_type_values' : getCategoryTypeValues,
                        'get_question_type_values' : getQuestionTypeValues,
						'_token': $('input[name="_token"]').val()
					},
					url: '{{route("updatePracticeQuestion")}}',
					method: 'post',
					success: (res) => {
                        var btn = '<button type="button" class="btn btn-sm btn-alt-secondary edit-section" data-id="'+res.question_id+'" data-bs-toggle="tooltip" title="Edit Question" onclick="practQuestioEdit('+res.question_id+')" ><i class="fa fa-fw fa-pencil-alt"></i>  </button> <button type="button"   class="btn btn-sm btn-alt-secondary delete-section" data-id="'+res.question_id+'" data-bs-toggle="tooltip"  title="Delete Section"  onclick="practQuestioDel('+res.question_id+')" > <i class="fa fa-fw fa-times"></i>  </button>';

                        let pHtml = ``;
                            pHtml += `<li>${question}</li>`;
                            pHtml += `<li class="answerValUpdate_${res.question_id}">${answerType}</li>`;
                            pHtml += `<li>${passagesTypeTxt}</li>`;
                            pHtml += `<li>${passNumber}</li>`;
                            pHtml += `<li>${fill}</li>`;
                            pHtml += `<li class="orderValUpdate_${res.question_id}">${res.question_order}</li>`;
                            pHtml += `<li>${btn}</li>`;

                        $('.singleQuest_'+currentModelQueId).html(pHtml);
                        MathJax.Hub.Queue(["Typeset",MathJax.Hub,'p']);


						$('.addQuestion').val('');
						$('.validError').text('');

                        let html = '';
                            html += `<span class="glyphicon question-glyphicon-move" aria-hidden="true">\n`;
                            html += `<i class="fa-solid fa-grip-vertical"></i>\n`;
                            html += `</span>\n`;
                            html += `<button class="btn btn-primary" value="${currentModelQueId}">${question}</button>\n`;

                        $(`#listWithHandleQuestion .questionaprat_${res.question_id}`).html(html);
                        // $('.questionaprat_'+currentModelQueId).remove();
                        // $('#listWithHandleQuestion').append('<div class="list-group-item sectionsaprat_'+section_id+' quesBasedSecList questionaprat_'+currentModelQueId+'" data-section_id="'+section_id+'" data-id="'+currentModelQueId+'" style="display:none;">\n' +
                        // '<span class="glyphicon question-glyphicon-move" aria-hidden="true">\n' +
                        // '<i class="fa-solid fa-grip-vertical"></i>\n' +
                        // '</span>\n' +
                        // '<button class="btn btn-primary" value="'+currentModelQueId+'">'+question+'</button>\n' +
                        // '</div>');
                        MathJax.Hub.Queue(["Typeset",MathJax.Hub,'p']);
					}
				});
            setEmptyValue(questionType);
            return false;

        });

        function clearError(){
            $('#addQuestionMultiModal #questionError').text('');
            $('#addQuestionMultiModal #tagError').text('');
            $('#addQuestionMultiModal #categoryTypeError').text('');
            $('#addQuestionMultiModal #questionTypeError').text('');
            $('#addQuestionMultiModal #passNumberError').text('');
            $('#addQuestionMultiModal #passageTypeError').text('');
            $('#addQuestionMultiModal #superCategoryError').text('');
        }

        $(document).on('click','.add_question_modal_multi',function(){
            is_edit = false;

            clearModel();
            clearError();
            // console.log('yes 1');

            $("input[name=diff_value]"). val("");
            $("input[name=disc_value]"). val("");
            $("input[name=guessing_value]"). val("");
            $('input[name="addChoiceMultInFourFill_fill[]"]').val('');
            $('.addChoiceMultInFourFill_filltype').val('');
            $('.addMultiChoice').val('');
            $('.add_guessing_value').val('');

            // count++;
            // $(".getFilterChoice").val('').trigger('change');

            $('#passageRequired_1').prop('checked',true);
            $('#add_passage_number').prop('disabled',false);
            $('select[name="addPassagesType"]').prop('disabled',false);
            $('#addQuestionMultiModal #diff_rating_create').val('').trigger('change');
            $('#addQuestionMultiModal #question_tags_create').val('').trigger('change');
            $('#addQuestionMultiModal #super_category_create').val('').trigger('change');

            let section_id = $(this).parents('.sectionTypesFull').attr('data-id');
            let section_type = $(`.selectedSection_${section_id}`).val();

            $('#section_type').val(section_type);

            if($(`.section_${section_id} .firstRecord .sectionList`).length >= 0) {
                questionOrder = $(`.section_${section_id} .firstRecord .sectionList`).length;
            } else {
                questionOrder = 0;
            }

            questionCount = $(`.section_${section_id} .sectionList`).length + 1;
            $('.addSectionAddId').val(section_id);
            var dataId = $(this).attr("data-id");
            var format = $('#format').val();
            var AnuserOpts = $('#sectionDisplay_'+dataId+' .firstRecord ul li span .selectedSecTxt').val();

            $('#addTestSectionTypeRead').val(AnuserOpts);
            $('#addCurrentModelQueId').val(dataId);
            // $('.addSectionAddId').val(dataId);
            $(".addchoiceMultInFourFill input[type=checkbox]").each(function() {
                $(this).attr('checked', false);
            });
            // console.log(AnuserOpts);
            // console.log(format);
            appendAnswerOption(AnuserOpts,format);
            getPassages(format);

            whichModel = 'question';
            removeMoreFillOption();

            // addMultiChoice();
            // editMultiChoice();
            $('#addQuestionMultiModal').modal('show');
        });

        function addClassScore(data){
            let checkIsmath = $(data).find('option:selected').attr('data-ismath');

            if(checkIsmath == "true") {
                $('#sectionModal .save_section').attr('data-class', 'checkMathDiv');
            } else {
                $('#sectionModal .save_section').attr('data-class', '');
            }
        }

        //new
        $(document).on('click','.add_score_btn', function(){
            $('.table_body').empty();
            $("input[name=actualScore]").val("");
            $("input[name=convertedScore]").val("");
            let formatVal = $('#format').val();
            let section_id = $(this).attr('data-id');
            let section_types = $(this).attr('data-section_type');
            let test_ids = $(this).attr('data-test_id');
            let total_question = $(`.section_${section_id} .sectionTypesFullMutli .sectionList`);
            // if(total_question.length > 0){
                $.ajax({
                    type: 'POST',
                    url: '{{route("check_score")}}',
                    data: {
                        section_id: section_id,
                        '_token': $('input[name="_token"]').val()
                    },
                    success: function(res) {
                        var result = res.records;
                        if(result.length > 0){
                            // var section_type = result[0]['section_type'];
                            // var test_id = result[0]['test_id'];
                            // if(section_type === 'Math_no_calculator' || section_type === 'Math_with_calculator'){
                            //     $.ajax({
                            //     type: 'POST',
                            //     url: '{{route("check_section_type")}}',
                            //     data: {
                            //         section_id: section_id,
                            //         'test_id': test_id,
                            //         '_token': $('input[name="_token"]').val()
                            //     },
                            //     success: function(res) {
                            //             result1 = res.records;
                            //             for (var i = 0; i < result1.length; i++) {
                            //                 $('.table_body').append(`<tr id="score_${result1[i]['section_id']}_${i}" data-section_id="${result1[i]['section_id']}" data-question_id="${result1[i]['question_id']}" data-section_type="${result1[i]['section_type']}" data-test_id="${result1[i]['test_id']}" ><td><input type="number" placeholder="Actual Score" id="actualScore_${i}" name="actualScore" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control" value="${result1[i]['actual_score'] != null ? result1[i]['actual_score'] : ''}"></td><td><input type="number" placeholder="Converted Score" id="convertedScore_${i}" name="convertedScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  value="${result1[i]['converted_score'] != null ? result1[i]['converted_score'] : ''}"></td></tr>`);
                            //             }
                            //         }
                            //     });
                            // } else {
                                if(section_types == 'Math_no_calculator' || section_types == 'Math_with_calculator'){
                                    let mathDivs = getMathDiv();
                                    for (var i = 0; i < mathDivs.length+1; i++) {
                                        if(i < result.length){
                                            $('.table_body').append(`<tr id="score_${result[i]['section_id']}_${i}" data-section_id="${result[i]['section_id']}" data-question_id="${result[i]['question_id']}" data-section_type="${result[i]['section_type']}" data-test_id="${result[i]['test_id']}" ><td><input type="number" placeholder="Actual Score" id="actualScore_${result[i]['question_id']}" name="actualScore" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control" value="${result[i]['actual_score'] != null ? result[i]['actual_score'] : ''}"></td><td><input type="number" placeholder="Converted Score" id="convertedScore_${result[i]['question_id']}" name="convertedScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  value="${result[i]['converted_score'] != null ? result[i]['converted_score'] : ''}"></td></tr>`);
                                        } else {
                                            $('.table_body').append(`<tr id="score_${section_id}_${i}" data-section_id="${section_id}" data-question_id="${i}" data-section_type="${section_types}" data-test_id="${test_ids}" ><td><input type="number" placeholder="Actual Score" id="actualScore_${i}" name="actualScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value=""></td><td><input type="number" placeholder="Converted Score" id="convertedScore_${i}" name="convertedScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value=""></td></tr>`);
                                        }
                                    }
                                } else {
                                    for (var i = 0; i < total_question.length + 1; i++) {
                                        if(i < result.length){
                                            $('.table_body').append(`<tr id="score_${result[i]['section_id']}_${i}" data-section_id="${result[i]['section_id']}" data-question_id="${result[i]['question_id']}" data-section_type="${result[i]['section_type']}" data-test_id="${result[i]['test_id']}" ><td><input type="number" placeholder="Actual Score" id="actualScore_${result[i]['question_id']}" name="actualScore" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control" value="${result[i]['actual_score'] != null ? result[i]['actual_score'] : ''}"></td><td><input type="number" placeholder="Converted Score" id="convertedScore_${result[i]['question_id']}" name="convertedScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  value="${result[i]['converted_score'] != null ? result[i]['converted_score'] : ''}"></td></tr>`);
                                        } else {
                                            $('.table_body').append(`<tr id="score_${section_id}_${i}" data-section_id="${section_id}" data-question_id="${i}" data-section_type="${section_types}" data-test_id="${test_ids}" ><td><input type="number" placeholder="Actual Score" id="actualScore_${i}" name="actualScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value=""></td><td><input type="number" placeholder="Converted Score" id="convertedScore_${i}" name="convertedScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value=""></td></tr>`);
                                        }
                                    }
                                }
                            // }
                        } else {
                            if(section_types == 'Math_no_calculator' || section_types == 'Math_with_calculator'){
                                let mathDivs = getMathDiv();
                                for (var i = 0; i < mathDivs.length + 1; i++) {
                                    let element = mathDivs[i];
                                    let questionId = $(element).attr('data-id');
                                    $('.table_body').append(`<tr id="score_${section_id}_${i}" data-section_id="${section_id}" data-question_id="${i}" data-section_type="${section_types}" data-test_id="${test_ids}" ><td><input type="number" placeholder="Actual Score" id="actualScore_${i}" name="actualScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value="" ></td><td><input type="number" placeholder="Converted Score" id="convertedScore_${i}" name="convertedScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value=""></td></tr>`);
                                }
                            } else {
                                for (var i = 0; i < total_question.length + 1; i++) {
                                    let element = total_question[i];
                                    let questionId = $(element).attr('data-id');
                                    $('.table_body').append(`<tr id="score_${section_id}_${i}" data-section_id="${section_id}" data-question_id="${i}" data-section_type="${section_types}" data-test_id="${test_ids}" ><td><input type="number" placeholder="Actual Score" id="actualScore_${i}" name="actualScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value=""></td><td><input type="number" placeholder="Converted Score" id="convertedScore_${i}" name="convertedScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value=""></td></tr>`);
                                }
                            }
                        }
                        // $("input[name=actualScore]").val("");
                        // $("input[name=convertedScore]").val("");
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            // }
            $('#scoreModalMulti').modal('show');
        });

        // for DSAT, DPSAT
        $(document).on('click','.digi_add_score_btn', function(){
            let test_id = $(this).attr('data-test_id');
            let section_type = $(this).attr('data-section_type');
            console.log(section_type);
            console.log(test_id);
            $.ajax({
                type: 'POST',
                url: '{{route("digi_check_score")}}',
                data: {
                    test_id: test_id,
                    section_type: section_type,
                    '_token': $('input[name="_token"]').val()
                },
                dataType: "html",
                success: function(result) {
                    $('.table_body').html(result);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
            $('#scoreModalMulti').modal('show');
        });

        var closeModal = document.getElementById("scoreModalMulti");
        closeModal.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                let scores = [];
                $('.table_body tr').each(function() {
                    let questionId = $(this).attr('data-question_id');
                    let sectionId = $(this).attr('data-section_id');
                    let sectionType = $(this).attr('data-section_type');
                    let testId = $(this).attr('data-test_id');
                    let actualScore = $('#actualScore_'+questionId).val();
                    let convertedScore = $('#convertedScore_'+questionId).val();

                    let scoreObj = {
                        'sectionId': sectionId,
                        'questionId': questionId,
                        'actualScore': actualScore,
                        'convertedScore': convertedScore,
                        'sectionType': sectionType,
                        'testId': testId
                    };
                    scores.push(scoreObj);
                });
                $.ajax({
                    type: 'POST',
                    url: '{{route("score_save")}}',
                    data: {
                        'scores': scores,
                        '_token': $('input[name="_token"]').val()
                    },
                    success: function(response) {

                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
                $('#scoreModalMulti').modal('hide')
            }
        });


        $(document).on('click', '.save_scores_btn', function() {
            let scores = [];
            $('.table_body tr').each(function() {
                let questionId = $(this).attr('data-question_id');
                let sectionId = $(this).attr('data-section_id');
                let sectionType = $(this).attr('data-section_type');
                let testId = $(this).attr('data-test_id');
                let actualScore = $('#actualScore_'+questionId).val();
                let convertedScore = $('#convertedScore_'+questionId).val();

                let scoreObj = {
                    'sectionId': sectionId,
                    'questionId': questionId,
                    'actualScore': actualScore,
                    'convertedScore': convertedScore,
                    'sectionType': sectionType,
                    'testId': testId
                };
                scores.push(scoreObj);
            });
            // console.log(scores);
            // die;
            $.ajax({
                type: 'POST',
                url: '{{route("score_save")}}',
                data: {
                    'scores': scores,
                    '_token': $('input[name="_token"]').val()
                },
                success: function(response) {

                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
            $('#scoreModalMulti').modal('hide');
        });

        function emptyError(modal, disp_section, choice) {
            $(`#${modal} #${disp_section}superCategoryError_${choice}`).text('');
            $(`#${modal} #${disp_section}categoryTypeError_${choice}`).text('');
            $(`#${modal} #${disp_section}questionTypeError_${choice}`).text('');
        };


        $('.save_section').click(function() {
            var rHour = $('#regular_time_hour').val();
            var rMinute = $('#regular_time_minute').val();
            var rSecond = $('#regular_time_second').val();
            var fiftyHour = $('#50extendedhour').val();
            var fiftyMinute = $('#50extendedminute').val();
            var fiftySecond = $('#50extendedsecond').val();
            var hundredHour = $('#100extendedhour').val();
            var hundredMinute = $('#100extendedminute').val();
            var hundredSecond = $('#100extendedsecond').val();

            var regularTime = ("0" + rHour).slice(-2) + ":" + ("0" + rMinute).slice(-2) + ":" + ("0" + rSecond).slice(-2);
            var fiftyExtended = ("0" + fiftyHour).slice(-2) + ":" + ("0" + fiftyMinute).slice(-2) + ":" + ("0" + fiftySecond).slice(-2);
            var hundredExtended = ("0" + hundredHour).slice(-2) + ":" + ("0" + hundredMinute).slice(-2) + ":" + ("0" + hundredSecond).slice(-2);

            var whichModel = $(this).parent().find('.whichModel').val();
            let scoreClass = $(this).attr('data-class');
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
            var question_type = $('#format').val();

            var diffValue = $('input[name="diff_value"]').val();
            var discValue = $('input[name="disc_value"]').val();

            let formatVal = $('#format').val();
            var myarray = ['DSAT','DPSAT'];
            var add_score_button_class = 'add_score_btn';
            if(jQuery.inArray(formatVal, myarray) != -1) {
                add_score_button_class = 'digi_add_score_btn';
            }

            if (whichModel == 'section') {
                if (format == '' || testSectionType == '' || testSectionTitle == '' || regularTime == '0:0:0') {
                    $('#sectionModal .validError').text('Below fields are required!');
                    return false;
                } else {
                    $('#sectionModal .validError').text('');
                }
                var get_test_id = jQuery('#get_question_id').val();
                var required_number_of_correct_answers = jQuery('#required_number_of_correct_answers').val();
                $('#sectionModal').modal('hide');
                $('#questionMultiModal').modal('hide');
                var sectionSelectedTxt = testSectionType.replaceAll('_', ' ');
                var currentModelId = $('#currentModelId').val();
                sectionOrder++;
                questionOrder = 0;
                newSectionOrder++;

                $.ajax({
                    data: {
                        'format': format,
                        'testSectionTitle': testSectionTitle,
                        'testSectionType': testSectionType,
                        'get_test_id': get_test_id,
                        'required_number_of_correct_answers': required_number_of_correct_answers,
                        // 'order': sectionOrder,
                        'order': newSectionOrder,
                        'regular': regularTime,
                        'fifty': fiftyExtended,
                        'hundred': hundredExtended,
                        'question_type': question_type,
                        '_token': $('input[name="_token"]').val()
                    },
                    url: "{{ route('addPracticeTestSection') }}",
                    method: 'post',
                    success: (result) => {
                        // console.log(result);
                        $.each(result, function (i, v) {
                            $.each(v, function (key, value) {
                                let res = value['id'];
                                newSectionOrder = value['order'];
                                let section = value['section'];
                                section = section.replaceAll('_', ' ');
                                // sectionOrder = currentModelId = key;
                                sectionOrder = currentModelId = newSectionOrder;
                                // sectionOrder++;

                                if ((testSectionType == 'Math') && (key == 0) ) {
                                    testSectionType = 'Math_no_calculator';
                                }else if ((testSectionType == 'Math') && (key == 1) ) {
                                    testSectionType = 'Math_no_calculator';
                                }else if((testSectionType == 'Math') && (key == 2)) {
                                    testSectionType = 'Math_with_calculator';
                                }else{
                                    // nothing, it'll be same.
                                }

                                let ScoreClass = `${testSectionType == 'Math_no_calculator' || testSectionType == 'Math_with_calculator' ? scoreClass : '' }`;
                                $('.sectionContainerList').append(
                                    '<div class="sectionTypesFull ' + scoreClass + ' section_' + res +
                                    '" data-id=' + res + ' id="sectionDisplay_' + currentModelId +
                                    '" ><div class="mb-2 mb-4"><div class="sectionTypesFullMutli"> </div> <div class="sectionTypesFullMutli firstRecord"><ul class="sectionListtype"><li>Type: &nbsp;<strong>' +
                                    format +
                                    '</strong></li><li>Section Type:&nbsp;<span class="answerOption editedAnswerOption_' +
                                    res + '"><strong>' +
                                    capitalizeFirstLetter(section) +
                                    '</strong><input type="hidden" name="selectedSecTxt" value="' +
                                    testSectionType +
                                    '" class="selectedSecTxt selectedSection_' + res +
                                    '" ></span></li><li><p class="mb-0 d-flex">Order:</p>&nbsp;<input type="number" readonly class="form-control" name="order" value="'+
                                    newSectionOrder + '" id="order_' +
                                    res +
                                    '"/><button type="button" class="input-group-text d-none" id="basic-addon2" onclick="openOrderDialog()"><i class="fa-solid fa-check"></i></button></li><li class="edit-close-btn"><button type="button" class="btn btn-sm btn-alt-secondary editSection me-2" data-id="' +
                                    res +
                                    '" data-bs-toggle="tooltip" onclick="editSection(this)" title="Edit Section"><i class="fa fa-fw fa-pencil-alt"></i></button><button type="button" class="btn btn-sm btn-alt-secondary deleteSection" data-id="' +
                                    res + '" data-section_type="' + testSectionType +
                                    '" onclick="deleteSection(this)" data-bs-toggle="tooltip" title="Delete Section"><i class="fa fa-fw fa-times"></i></button></li></ul><ul class="sectionHeading"><li>Question</li><li>Answer</li> <li>Passage</li><li>Passage Number</li><li>Fill Answer</li><li class="' +
                                    res +
                                    '">Order</li><li>Action</li></ul></div></div><div class="mb-2 mb-4 partTestOrder"><button type="button" data-id="' +
                                    currentModelId +
                                    '" class="btn w-25 btn-alt-success me-2 add_question_modal_multi"><i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Question</button><button type="button" data-id="' +
                                    res + '" data-section_type="' + testSectionType + '" data-test_id="' +
                                    get_test_id +
                                    '" class="btn w-25 btn-alt-success '+add_score_button_class+'"><i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Score</button><div class="part_order"><input type="number" readonly class="form-control" name="question_order" value="'+newSectionOrder+'" id="order_' +
                                    res +
                                    '"/><button type="button" class="input-group-text" id="basic-addon2" onclick="openQuestionDialog(' +
                                    
                                    res + ')"><i class="fa-solid fa-check"></i></button></div></div></div>');

                                /*
                                    '"/><button type="button" class="input-group-text d-none" id="basic-addon2" onclick="openOrderDialog()"><i class="fa-solid fa-check"></i></button></li><li class="edit-close-btn"><button type="button" class="btn btn-sm btn-alt-secondary editSection" data-id="'+res+'" onclick="editSection(this)" data-bs-toggle="tooltip" title="Edit Section"><i class="fa fa-fw fa-pencil-alt"></i></button><button type="button" class="btn btn-sm btn-alt-secondary deleteSection" data-section_type="'+testSectionType+'" data-id="'+res+'" onclick="deleteSection(this)" data-bs-toggle="tooltip" title="Delete Section"><i class="fa fa-fw fa-times"></i></button></li></ul><ul class="sectionHeading"><li>Question</li><li>Answer</li> <li>Passage</li><li>Passage Number</li><li>Fill Answer</li><li class="' +
                                    res +
                                    '">Order</li><li>Action</li></ul></div></div><div class="mb-2 mb-4 partTestOrder"><button type="button" data-id="' +
                                    currentModelId +
                                    '" class="btn w-25 btn-alt-success me-2 add_question_modal_multi"><i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Question</button><button type="button" data-id='+
                                    res+' data-section_type="'+testSectionType+'" data-test_id="'+get_test_id+
                                    '" class="btn w-25 btn-alt-success add_score_btn"><i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Score</button><div class="part_order"><input type="number" readonly class="form-control" name="question_order" value="0" id="order_' +
                                    res +
                                    '"/><button type="button" class="input-group-text" id="basic-addon2" onclick="openQuestionDialog(' +
                                    res + ')"><i class="fa-solid fa-check"></i></button></div></div></div>');
                                    */
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
                            });
                        });
                    }
                });
                /*
                let  ScoreClass = `${testSectionType == 'Math_no_calculator' || testSectionType == 'Math_with_calculator' ? scoreClass : '' }`;
                $('.sectionContainerList').append(
                    '<div class="sectionTypesFull '+ScoreClass+' section_'+res+' " data-id="'+res+'" id="sectionDisplay_' + currentModelId +
                    '" ><div class="mb-2 mb-4"><div class="sectionTypesFullMutli"> </div> <div class="sectionTypesFullMutli firstRecord"><ul class="sectionListtype"><li>Type: &nbsp;<strong>' +
                    format +
                    '</strong></li><li>Section Type:&nbsp;<span class="answerOption editedAnswerOption_'+res+'"><strong>' +
                    capitalizeFirstLetter(sectionSelectedTxt) +
                    '</strong><input type="hidden" name="selectedSecTxt" value="' +
                    testSectionType +
                    '" class="selectedSecTxt selectedSection_'+res+'" ></span></li><li><p class="mb-0 d-flex">Order:</p>&nbsp;<input type="number" readonly class="form-control" name="order" value="'+sectionOrder+'" id="order_' +
                    res +
                    '"/><button type="button" class="input-group-text d-none" id="basic-addon2" onclick="openOrderDialog()"><i class="fa-solid fa-check"></i></button></li><li class="edit-close-btn"><button type="button" class="btn btn-sm btn-alt-secondary editSection" data-id="'+res+'" onclick="editSection(this)" data-bs-toggle="tooltip" title="Edit Section"><i class="fa fa-fw fa-pencil-alt"></i></button><button type="button" class="btn btn-sm btn-alt-secondary deleteSection" data-section_type="'+testSectionType+'" data-id="'+res+'" onclick="deleteSection(this)" data-bs-toggle="tooltip" title="Delete Section"><i class="fa fa-fw fa-times"></i></button></li></ul><ul class="sectionHeading"><li>Question</li><li>Answer</li> <li>Passage</li><li>Passage Number</li><li>Fill Answer</li><li class="' +
                    res +
                    '">Order</li><li>Action</li></ul></div></div><div class="mb-2 mb-4 partTestOrder"><button type="button" data-id="' +
                    currentModelId +
                    '" class="btn w-25 btn-alt-success me-2 add_question_modal_multi"><i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Question</button><button type="button" data-id='+res+' data-section_type="'+testSectionType+'" data-test_id="'+get_test_id+'" class="btn w-25 btn-alt-success add_score_btn"><i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Score</button><div class="part_order"><input type="number" readonly class="form-control" name="question_order" value="0" id="order_' +
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
                */
            } else {
                var test_source = $('#source option:selected').val();
                var testSectionType = $('#addTestSectionTypeRead').val();
                var new_question_type_select = $(this).parent().parent().find('#new_question_type_select').val();
                var difficulty = $('#diff_rating_create').val();
                var question = CKEDITOR.instances['js-ckeditor-add-addQue'].getData();
                var activeAnswerType = '.add'+ $('#selectedAnswerType').val();
                var questionType = $('#addQuestionMultiModal '+activeAnswerType+' #addQuestionType').val();
                // var pass = ''; //CKEDITOR.instances['js-ckeditor-passquestion'].getData();
                var pass = $('select[name="addPassagesType"] :selected').text();
                var passNumber = $('#addQuestionMultiModal .addPassNumber').val();
                var passagesType = $('.addPassagesType').val();
                var passagesTypeTxt = $(".addPassagesType option:selected").text();
                var tags = $('#question_tags_create').val();
                // var super_category = $('#super_category_create').val();

                multiChoice = $('.addMultiChoice option:selected').val();

                let ans_choices;
                let disp_section;
                if(questionType == 'choiceOneInFive_Odd') {
                    ans_choices = ['A', 'B', 'C', 'D', 'E'];
                    disp_section = 'oneInFiveOdd_';
                } else if(questionType == 'choiceOneInFourPass_Odd') {
                    ans_choices = ['A', 'B', 'C', 'D'];
                    disp_section = '';
                } else if(questionType == 'choiceOneInFour_Odd') {
                    ans_choices = ['A', 'B', 'C', 'D'];
                    disp_section = 'oneInFourOdd_';
                } else if(questionType == 'choiceOneInFour_Even') {
                    ans_choices = ['F', 'G', 'H', 'J'];
                    disp_section = 'oneInFourEven_';
                } else if (questionType == 'choiceOneInFive_Even') {
                    ans_choices = ['F', 'G', 'H', 'J', 'K'];
                    disp_section = 'oneInFiveEven_';
                } else if (questionType == 'choiceOneInFourPass_Even') {
                    ans_choices = ['F', 'G', 'H', 'J'];
                    disp_section = 'oneInFourPassEven_';
                } else if (questionType == 'choiceMultInFourFill') {
                    // ans_choices = ['A', 'B', 'C', 'D'];
                    if(multiChoice == '1') {
                        ans_choices = ['A', 'B', 'C', 'D'];
                        disp_section = 'cb_choiceMultInFourFill_';
                    } else if(multiChoice == '3') {
                        ans_choices = ['A', 'B', 'C', 'D'];
                        disp_section = 'choiceMultInFourFill_';
                    } else if(multiChoice == '2') {
                        ans_choices = ['A'];
                        disp_section = 'fc_';
                    }
                } else {
                    ans_choices = ['A', 'B', 'C', 'D'];
                    disp_section = '';
                }

                const checkboxValues = {};
                ans_choices.forEach(ans_choice => {
                checkboxValues[ans_choice] = $(`input[name="${disp_section}ct_checkbox_${ans_choice}"]`)
                    .map((i, v) => $(v).is(':checked') ? 1 : 0)
                    .get();
                });

                //For Guessing Values
                const addGuessingValue = {};
                ans_choices.forEach(ans_choice => {
                    const selectElements = $(`input[name="${disp_section}add_guessing_value_${ans_choice}"]`);
                    const values = selectElements.map(function() {
                        const add_guessing_value = $(this).val();
                        return (add_guessing_value !== '') ? add_guessing_value : null;
                    }).get().filter(value => value !== null);
                    addGuessingValue[ans_choice] = values;
                });
                // console.log(addGuessingValue);

                const superCategoryValues = {};
                ans_choices.forEach(ans_choice => {
                superCategoryValues[ans_choice] = $(`select[name="${disp_section}super_category_create_${ans_choice}"]`)
                    .map((i, v) => {
                        const super_category_val = $(v).val();
                        return super_category_val.length > 0 ? super_category_val : null;
                    })
                    .get()
                    .filter(value => value !== null);
                });

                const getCategoryTypeValues = {};
                ans_choices.forEach(ans_choice => {
                    getCategoryTypeValues[ans_choice] = $(`select[name="${disp_section}add_category_type_${ans_choice}"]`)
                    .map((i, v) => {
                        const category_type_val = $(v).val();
                        return category_type_val.length > 0 ? category_type_val : null;
                    })
                    .get()
                    .filter(value => value !== null);
                });

                const getQuestionTypeValues = {};
                ans_choices.forEach(ans_choice => {
                    getQuestionTypeValues[ans_choice] = $(`select[name="${disp_section}add_search-input_${ans_choice}"]`)
                    .map((i, v) => {
                        const question_type_val = $(v).val();
                        return question_type_val.length > 0 ? question_type_val : null;
                    })
                    .get()
                    .filter(value => value !== null);
                });

                const labels = ['superCategoryError', 'categoryTypeError', 'questionTypeError'];

                var get_question_type_values = $('select[name=add_search-input]').map(function(i,v) {
                    var question_type_arr = [];
                    let question_type_val = $(v).val();
                    if(question_type_val.length > 0){
                        question_type_arr.push(question_type_val);
                    }
                    return question_type_arr;
                }).get();

                var ifFillChoice = $('.getFilterChoice').val();

                var questTypeArr = ['ACT','SAT','PSAT'];
                if((jQuery.inArray(format, questTypeArr) != -1) || (ifFillChoice == 2)) {
                    if($('#passageRequired_1').is(':checked')){
                        if(
                            question =='' ||
                            tags ==0 ||
                            passNumber == '' ||
                            passagesType =='' ||
                            format =='' ||
                            testSectionType =='' ||
                            ans_choices.some(choice => {
                                const super_category_values = superCategoryValues[choice];
                                const get_category_type_values = getCategoryTypeValues[choice];
                                const get_question_type_values = getQuestionTypeValues[choice];
                                // const get_addGuessingValue = addGuessingValue[choice];
                                return (
                                    super_category_values.length === 0 || 
                                    get_category_type_values.length === 0 || 
                                    // get_addGuessingValue.length === 0 || 
                                    get_question_type_values.length === 0
                                );
                            })
                        ) {
                            $('#addQuestionMultiModal #questionError').text(question =='' ? 'Question is required!' : '');
                            $('#js-ckeditor-add-addQue').focus();
                            $('#addQuestionMultiModal #tagError').text(tags =='' ? 'Tag is required!' : '');
                            $('#questionTags').focus();
                            $('#super_category_create').focus();
                            $('#add_category_type_0').focus();
                            $('#add_search-input_0').focus();
                            $('#addQuestionMultiModal #passNumberError').text(passNumber =='' ? 'Passage Number is required!' : '');
                            $('#add_passage_number').focus();
                            $('#addQuestionMultiModal #passageTypeError').text(passagesType == '' ? 'Passage Type is required!' : '');
                            $('.addPassagesType').focus();

                            ans_choices.forEach(choice => {
                                const super_category_values = superCategoryValues[choice];
                                const get_category_type_values = getCategoryTypeValues[choice];
                                const get_question_type_values = getQuestionTypeValues[choice];
                                // const get_addGuessingValue = addGuessingValue[choice];

                                $(`#addQuestionMultiModal #${disp_section}superCategoryError_${choice}`).text(super_category_values.length == 0 ? 'Super Category is required!' : '');
                                $(`#addQuestionMultiModal #${disp_section}categoryTypeError_${choice}`).text(get_category_type_values.length == 0 ? 'Category type is required!' : '');
                                $(`#addQuestionMultiModal #${disp_section}questionTypeError_${choice}`).text(get_question_type_values.length == 0 ? 'Question type is required!' : '');
                                // $(`#addQuestionMultiModal #${disp_section}add_guessing_valueE_${choice}`).text(get_addGuessingValue.length == 0 ? 'Guessing Value is required!' : '');
                            });
                            return false;
                        }
                        else{
                            // $('#addQuestionMultiModal .validError').text('');
                            $('#addQuestionMultiModal #questionError').text('');
                            $('#addQuestionMultiModal #tagError').text('');
                            $('#addQuestionMultiModal #passNumberError').text('');
                            $('#addQuestionMultiModal #passageTypeError').text('');
                            $('#addQuestionMultiModal #passageTypeError').text('');

                            ans_choices.forEach(choice => {
                                emptyError('addQuestionMultiModal', disp_section, choice);
                                $(`#addQuestionMultiModal #${disp_section}add_guessing_valueE_${choice}`).text('');
                            });
                        }
                    } else {
                        if(question =='' ||
                            tags.length ==0 ||
                            format =='' ||
                            testSectionType =='' ||
                            ans_choices.some(choice => {
                                const super_category_values = superCategoryValues[choice];
                                const get_category_type_values = getCategoryTypeValues[choice];
                                const get_question_type_values = getQuestionTypeValues[choice];
                                // const get_addGuessingValue = addGuessingValue[choice];

                                return (
                                    super_category_values.length === 0 ||
                                    get_category_type_values.length === 0 ||
                                    // get_addGuessingValue.length === 0 ||
                                    get_question_type_values.length === 0
                                );
                            })
                        ){
                            // $('#addQuestionMultiModal .validError').text('Below fields are required!');
                            $('#addQuestionMultiModal #questionError').text(question =='' ? 'Question is required!' : '');
                            $('#js-ckeditor-add-addQue').focus();
                            $('#addQuestionMultiModal #tagError').text(tags =='' ? 'Tag is required!' : '');
                            $('#questionTags').focus();

                            ans_choices.forEach(choice => {
                                // var super_category_values = eval(`super_category_values_${choice}`);
                                // var get_category_type_values = eval(`get_category_type_values_${choice}`);
                                // var get_question_type_values = eval(`get_question_type_values_${choice}`);

                                var super_category_values = superCategoryValues[choice];
                                var get_category_type_values = getCategoryTypeValues[choice];
                                var get_question_type_values = getQuestionTypeValues[choice];
                                // var get_addGuessingValue = addGuessingValue[choice];

                                $(`#addQuestionMultiModal #${disp_section}superCategoryError_${choice}`).text(super_category_values.length == 0 ? 'Super Category is required!' : '');
                                $(`#addQuestionMultiModal #${disp_section}categoryTypeError_${choice}`).text(get_category_type_values.length == 0 ? 'Category type is required!' : '');
                                $(`#addQuestionMultiModal #${disp_section}questionTypeError_${choice}`).text(get_question_type_values.length == 0 ? 'Question type is required!' : '');
                                // $(`#addQuestionMultiModal #${disp_section}add_guessing_valueE_${choice}`).text(get_addGuessingValue.length == 0 ? 'Guessing Value is required!' : '');

                            });
                            return false;
                        }else{
                            $('#addQuestionMultiModal #questionError').text('');
                            $('#addQuestionMultiModal #tagError').text('');

                            ans_choices.forEach(choice => {
                                emptyError('addQuestionMultiModal', disp_section, choice);
                                $(`#addQuestionMultiModal #${disp_section}add_guessing_valueE_${choice}`).text('');
                            });
                        }
                    }
                } else {
                    if($('#passageRequired_1').is(':checked')){
                        if(
                            question =='' ||
                            tags ==0 ||
                            passNumber == '' ||
                            diffValue == '' ||
                            discValue == '' ||
                            passagesType =='' ||
                            format =='' ||
                            testSectionType =='' ||
                            ans_choices.some(choice => {
                                const super_category_values = superCategoryValues[choice];
                                const get_category_type_values = getCategoryTypeValues[choice];
                                const get_question_type_values = getQuestionTypeValues[choice];
                                const get_addGuessingValue = addGuessingValue[choice];
                                return (
                                    super_category_values.length === 0 || 
                                    get_category_type_values.length === 0 || 
                                    get_addGuessingValue.length === 0 || 
                                    get_question_type_values.length === 0
                                );
                            })
                        ) {
                                $('#addQuestionMultiModal #questionError').text(question =='' ? 'Question is required!' : '');
                                $('#js-ckeditor-add-addQue').focus();
                                $('#addQuestionMultiModal #tagError').text(tags =='' ? 'Tag is required!' : '');
                                $('#questionTags').focus();
                                $('#super_category_create').focus();
                                $('#add_category_type_0').focus();
                                $('#add_search-input_0').focus();
                                $('#addQuestionMultiModal #passNumberError').text(passNumber =='' ? 'Passage Number is required!' : '');
                                $('#add_passage_number').focus();
                                $('#addQuestionMultiModal #passageTypeError').text(passagesType == '' ? 'Passage Type is required!' : '');
                                $('.addPassagesType').focus();

                                $('#addQuestionMultiModal #diffValueError').text(diffValue == '' ? 'Diff value is required!' : '');
                                $('#diffValue').focus();
                                $('#addQuestionMultiModal #discValueError').text(discValue == '' ? 'Disc value is required!' : '');
                                $('#discValue').focus();

                                ans_choices.forEach(choice => {
                                    const super_category_values = superCategoryValues[choice];
                                    const get_category_type_values = getCategoryTypeValues[choice];
                                    const get_question_type_values = getQuestionTypeValues[choice];
                                    const get_addGuessingValue = addGuessingValue[choice];

                                    $(`#addQuestionMultiModal #${disp_section}superCategoryError_${choice}`).text(super_category_values.length == 0 ? 'Super Category is required!' : '');
                                    $(`#addQuestionMultiModal #${disp_section}categoryTypeError_${choice}`).text(get_category_type_values.length == 0 ? 'Category type is required!' : '');
                                    $(`#addQuestionMultiModal #${disp_section}questionTypeError_${choice}`).text(get_question_type_values.length == 0 ? 'Question type is required!' : '');
                                    $(`#addQuestionMultiModal #${disp_section}add_guessing_valueE_${choice}`).text(get_addGuessingValue.length == 0 ? 'Guessing Value is required!' : '');
                                });
                            return false;
                        }
                        else{
                            // $('#addQuestionMultiModal .validError').text('');
                            $('#addQuestionMultiModal #questionError').text('');
                            $('#addQuestionMultiModal #tagError').text('');
                            $('#addQuestionMultiModal #passNumberError').text('');
                            $('#addQuestionMultiModal #passageTypeError').text('');
                            $('#addQuestionMultiModal #passageTypeError').text('');

                            $('#addQuestionMultiModal #diffValueError').text('');
                            $('#addQuestionMultiModal #discValueError').text('');
                            
                            ans_choices.forEach(choice => {
                                emptyError('addQuestionMultiModal', disp_section, choice);
                                $(`#addQuestionMultiModal #${disp_section}add_guessing_valueE_${choice}`).text('');
                            });
                        }
                    } else {
                        if(question =='' ||
                            tags.length ==0 ||
                            format =='' ||
                            diffValue == '' ||
                            discValue == '' ||
                            testSectionType =='' ||
                            ans_choices.some(choice => {
                                const super_category_values = superCategoryValues[choice];
                                const get_category_type_values = getCategoryTypeValues[choice];
                                const get_question_type_values = getQuestionTypeValues[choice];
                                const get_addGuessingValue = addGuessingValue[choice];

                                return (
                                    super_category_values.length === 0 ||
                                    get_category_type_values.length === 0 ||
                                    get_addGuessingValue.length === 0 ||
                                    get_question_type_values.length === 0
                                );
                            })
                        ){
                            // $('#addQuestionMultiModal .validError').text('Below fields are required!');
                            $('#addQuestionMultiModal #questionError').text(question =='' ? 'Question is required!' : '');
                            $('#js-ckeditor-add-addQue').focus();
                            $('#addQuestionMultiModal #tagError').text(tags =='' ? 'Tag is required!' : '');
                            $('#questionTags').focus();

                            $('#addQuestionMultiModal #diffValueError').text(diffValue == '' ? 'Diff value is required!' : '');
                            $('#diffValue').focus();
                            $('#addQuestionMultiModal #discValueError').text(discValue == '' ? 'Disc value is required!' : '');
                            $('#discValue').focus();

                            ans_choices.forEach(choice => {
                                // var super_category_values = eval(`super_category_values_${choice}`);
                                // var get_category_type_values = eval(`get_category_type_values_${choice}`);
                                // var get_question_type_values = eval(`get_question_type_values_${choice}`);

                                var super_category_values = superCategoryValues[choice];
                                var get_category_type_values = getCategoryTypeValues[choice];
                                var get_question_type_values = getQuestionTypeValues[choice];
                                var get_addGuessingValue = addGuessingValue[choice];

                                $(`#addQuestionMultiModal #${disp_section}superCategoryError_${choice}`).text(super_category_values.length == 0 ? 'Super Category is required!' : '');
                                $(`#addQuestionMultiModal #${disp_section}categoryTypeError_${choice}`).text(get_category_type_values.length == 0 ? 'Category type is required!' : '');
                                $(`#addQuestionMultiModal #${disp_section}questionTypeError_${choice}`).text(get_question_type_values.length == 0 ? 'Question type is required!' : '');
                                $(`#addQuestionMultiModal #${disp_section}add_guessing_valueE_${choice}`).text(get_addGuessingValue.length == 0 ? 'Guessing Value is required!' : '');

                            });
                            return false;
                        }else{
                            $('#addQuestionMultiModal #questionError').text('');
                            $('#addQuestionMultiModal #tagError').text('');
                            $('#addQuestionMultiModal #diffValueError').text('');
                            $('#addQuestionMultiModal #discValueError').text('');

                            ans_choices.forEach(choice => {
                                emptyError('addQuestionMultiModal', disp_section, choice);
                                $(`#addQuestionMultiModal #${disp_section}add_guessing_valueE_${choice}`).text('');
                            });
                        }
                    }
                }

                if($('#passageRequired_1').is(':checked')){
                    var pass = $('select[name="addPassagesType"] :selected').text();
                    var passNumber = $('#addQuestionMultiModal .addPassNumber').val();
                    var passagesType = $('.addPassagesType').val();
                    var passagesTypeTxt = $(".addPassagesType option:selected").text();
                } else {
                    var pass = '';
                    var passNumber = '';
                    var passagesType = '';
                    var passagesTypeTxt = '';
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
                        answerType = fill;
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
                        'test_source':test_source,
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
                        'diffValue': diffValue,
                        'discValue': discValue,
                        'guessing_value': addGuessingValue,
                        'fillType': fillType,
                        'multiChoice': multiChoice,
                        'section_id':section_id,
                        'tags':tags,
                        'diff_rating':difficulty,
                        'ct_checkbox_values' : checkboxValues,
                        'super_category_values' : superCategoryValues,
                        'get_category_type_values' : getCategoryTypeValues,
                        'get_question_type_values' : getQuestionTypeValues,
                        'new_question_type_select':new_question_type_select,
                        '_token': $('input[name="_token"]').val()
                    },
                    url: '{{route("addPracticeQuestion")}}',
                    method: 'post',
                    success: (res) => {
                        $('.addQuestion').val('');
                        $('.validError').text('');

                        $('#sectionDisplay_' + currentModelQueId + ' .firstRecord').append('<ul class="sectionList singleQuest_'+res.question_id+'" data-id="'+res.question_id+'" ><li>'+question+'</li><li class="answerValUpdate_'+res.question_id+'">'+answerType+'</li><li>'+passagesTypeTxt+'</li><li>'+passNumber+'</li><li>'+fill+'</li><li class="orderValUpdate_'+res.question_id+'">'+questionOrder+'</li><li><button type="button" class="btn btn-sm btn-alt-secondary edit-section" data-id="'+res.question_id+'" data-bs-toggle="tooltip" title="Edit Question" onclick="practQuestioEdit('+res.question_id+')"> <i class="fa fa-fw fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-alt-secondary delete-section" data-id="'+res.question_id+'" data-bs-toggle="tooltip" title="Delete Question"   onclick="practQuestioDel('+res.question_id+')">  <i class="fa fa-fw fa-times"></i></button> </li></ul>');
                        MathJax.Hub.Queue(["Typeset",MathJax.Hub,'p']);

                        $('#listWithHandleQuestion').append('<div class="list-group-item sectionsaprat_'+section_id+' quesBasedSecList questionaprat_'+res.question_id+'" data-section_id="'+section_id+'" data-id="'+res.question_id+'" style="display:none;">\n' +
                        '<span class="glyphicon question-glyphicon-move" aria-hidden="true">\n' +
                        '<i class="fa-solid fa-grip-vertical"></i>\n' +
                        '</span>\n' +
                        '<button class="btn btn-primary" value="'+res.question_id+'">'+question+'</button>\n' +
                        '</div>');

                        $('#addListWithHandleQuestion').append('<div class="list-group-item sectionsaprat_'+section_id+' quesBasedSecList questionaprat_'+res.question_id+'" data-section_id="'+section_id+'" data-id="'+res.question_id+'" style="display:none;">\n' +
                        '<span class="glyphicon question-glyphicon-move" aria-hidden="true">\n' +
                        '<i class="fa-solid fa-grip-vertical"></i>\n' +
                        '</span>\n' +
                        '<button class="btn btn-primary" value="'+res.question_id+'">'+question+'</button>\n' +
                        '</div>');

                        MathJax.Hub.Queue(["Typeset",MathJax.Hub,'p']);
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

async function nextPrev(n) {
    var x = document.getElementsByClassName("tab");

    var test_title_val = jQuery(".test_title").val();
    var test_format_type_val = jQuery('#format').val();
    var test_source = jQuery('#source').val();
    var get_test_id = jQuery('#get_question_id').val();
    const status = jQuery('select[name="status"]').val();
    const products = jQuery('select[name="products[]"]').val();
    $('.testType').val(test_format_type_val);

    var test_type = $('#format').val();
    if (test_type == 'DSAT'){
        $('.for_digital_only').show();
    }else if(test_type == 'DPSAT'){
        $('.for_digital_only').show();
    }else{
        $('.for_digital_only').hide();
    }

    preGetPracticeCategoryType = await dropdown_lists(`/admin/getPracticeCategoryType?testType=${test_format_type_val}`);
    preGetPracticeQuestionType = await dropdown_lists(`/admin/getPracticeQuestionType?testType=${test_format_type_val}`);
    preGetSuperCategory = await dropdown_lists(`/admin/getSuperCategory?testType=${test_format_type_val}`);

    if (test_title_val == '' || status == '' || (status == 'paid' && products == 0)) {
        $('.testvalidError').text('Below fields are required!');
        return false;
    }

    if (test_title_val != '') {
        $('.testvalidError').text('');
        $.ajax({
            data: {
                'format': test_format_type_val,
                'title': test_title_val,
                'source': test_source,
                'get_test_id': get_test_id,
                'status': status,
                'products': products,
                '_token': $('input[name="_token"]').val()
            },
            url: "{{ route('addPracticeTest') }}",
            method: 'post',
        }).done((response) => {
            if (response.success) {
                jQuery("#get_question_id").val(response.test_id);
                $.ajax({
                    data: {
                        'format': test_format_type_val,
                        '_token': $('input[name="_token"]').val()
                    },
                    url: "{{ route('addDropdownOption') }}",
                    method: 'post',
                    success: (res) => {

                        let super_option = ``;
                        $.each(res.super,function(i,v){
                            super_option += `<option value=${v['id']}>${v['title']}</option>`;
                        });

                        let category_option = ``;
                        $.each(res.category,function(i,v){
                            category_option += `<option value=${v['id']}>${v['category_type_title']}</option>`;
                        });
                        $('select[name="category_type"').append(category_option);
                        $('select[name="add_category_type"').append(category_option);

                        let questionType_option = ``;
                        $.each(res.questionType,function(i,v){
                            questionType_option += `<option value=${v['id']}>${v['question_type_title']}</option>`;
                        });
                        $('select[name="search-input"').append(questionType_option);
                        $('select[name="add_search-input"').append(questionType_option);

                        const disp_sections = ['', 'oneInFiveOdd_', 'oneInFiveEven_', 'oneInFourOdd_', 'oneInFourEven_', 'oneInFourPassEven_', 'choiceMultInFourFill_', 'cb_choiceMultInFourFill_']
                        const ans_choices = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K' ];
                        disp_sections.forEach(disp_section => {
                            ans_choices.forEach(ans_choice => {
                                $(`select[name="${disp_section}add_category_type_${ans_choice}"`).html('');
                                $(`select[name="${disp_section}super_category_create_${ans_choice}"`).html('');
                                $(`select[name="${disp_section}add_search-input_A${ans_choice}"`).html('');

                                $(`select[name="${disp_section}super_category_create_${ans_choice}"`).append(super_option);
                                // $(`select[name="${disp_section}edit_super_category_${ans_choice}"`).append(super_option);

                                $(`select[name="${disp_section}add_category_type_${ans_choice}"`).append(category_option);
                                // $(`select[name="${disp_section}edit_category_type_${ans_choice}"`).append(category_option);

                                $(`select[name="${disp_section}add_search-input_${ans_choice}"`).append(questionType_option);
                                // $(`select[name="${disp_section}edit_search-input_${ans_choice}"`).append(questionType_option);
                            });
                        });

                        $('select[name="fc_super_category_create_A"').html('');
                        $('select[name="fc_add_category_type_A"').html('');
                        $('select[name="fc_add_search-input_A"').html('');

                        $('select[name="fc_super_category_create_A"').append(super_option);
                        $('select[name="fc_add_category_type_A"').append(category_option);
                        $('select[name="fc_add_search-input_A"').append(questionType_option);

                        $('select[name="fc_edit_super_category_A"').html('');
                        $('select[name="fc_edit_category_type_A"').html('');
                        $('select[name="fc_edit_search-input_A"').html('');

                        $(`select[name="fc_edit_super_category_A"`).append(super_option);
                        $(`select[name="fc_edit_category_type_A"`).append(category_option);
                        $(`select[name="fc_edit_search-input_A"`).append(questionType_option);
                    }
                });

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

            } else {
                toastr.error(response.message);
                return false
            }
        })
    }
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
    // console.log('yes');
    $('input[name=tags]').val('');
    $('#passage_number').val(null).trigger("change");
    // $('#add_category_type_0').val(null).trigger("change");
    // $('#add_search-input_0').val(null).trigger("change");

    const ans_choices = ['A', 'B', 'C', 'D'];
    ans_choices.forEach(ans_choice => {
        $(`#super_category_create_${ans_choice}_0`).val(null).trigger("change");
        $(`#add_category_type_${ans_choice}_0`).val(null).trigger("change");
        $(`#add_search-input_${ans_choice}_0`).val(null).trigger("change");
    });
    $(`.removeNewTypes, .removeNewType`).remove();
    $('#passagesType').val(null).trigger("change");
    // $('#passagesType').html('');
    CKEDITOR.instances['js-ckeditor-add-addQue'].setData('');
    $('#add_passage_number').val(null).trigger("change");


    $(".getFilterChoice").val('').trigger('change');

    $(".superCategory").val("");
    $(".superCategory").trigger("change");

    $(".categoryType").val("");
    $(".categoryType").trigger("change");

    $(".questionType").val("");
    $(".questionType").trigger("change");

    $("#fc_add_category_type_A_0").val("");
    $("#fc_add_category_type_A_0").trigger("change");

    $("#fc_super_category_create_A_0").val("");
    $("#fc_super_category_create_A_0").trigger("change");

    $("#fc_add_search-input_A_0").val("");
    $("#fc_add_search-input_A_0").trigger("change");

    $('#fc_super_category_create_A_0').select2({
        dropdownParent: $('#addQuestionMultiModal'),
        tags: true,
        placeholder : "Select Super Category",
        maximumSelectionLength: 1
    });

    $('#fc_add_category_type_A_0').select2({
        dropdownParent: $('#addQuestionMultiModal'),
        tags: true,
        placeholder : "Select Category type",
        maximumSelectionLength: 1
    });

    $('#fc_add_search-input_A_0').select2({
        dropdownParent: $('#addQuestionMultiModal'),
        tags: true,
        placeholder : "Select Question type",
        maximumSelectionLength: 1
    });

    $('#fc_edit_super_category_A_0').select2({
        dropdownParent: $('#addQuestionMultiModal'),
        tags: true,
        placeholder : "Select Super Category",
        maximumSelectionLength: 1
    });

    $('#fc_edit_category_type_A_0').select2({
        dropdownParent: $('#addQuestionMultiModal'),
        tags: true,
        placeholder : "Select Category type",
        maximumSelectionLength: 1
    });

    $('#fc_edit_search-input_A_0').select2({
        dropdownParent: $('#addQuestionMultiModal'),
        tags: true,
        placeholder : "Select Question type",
        maximumSelectionLength: 1
    });
    $(".editMultipleChoice").trigger("change");
}


function practQuestioEdit(id){
    
    is_edit = true;
    clearModel();

    var test_format_type_val = jQuery('#format').val();
    $.ajax({
        data: {
            'format': test_format_type_val,
            '_token': $('input[name="_token"]').val()
        },
        url: "{{ route('addDropdownOption') }}",
        method: 'post',
        success: (res) => {
            let super_cat_option = ``;
            $.each(res.super,function(i,v){
                super_cat_option += `<option value=${v['id']}>${v['title']}</option>`;
            });

            let cat_type_option = ``;
            $.each(res.category,function(i,v){
                cat_type_option += `<option value=${v['id']}>${v['category_type_title']}</option>`;
            });

            let question_type_option = ``;
            $.each(res.questionType,function(i,v){
                question_type_option += `<option value=${v['id']}>${v['question_type_title']}</option>`;
            });

            const sections = ['', 'oneInFiveOdd_', 'oneInFiveEven_', 'oneInFourOdd_', 'oneInFourEven_', 'oneInFourPassEven_', 'choiceMultInFourFill_', 'cb_choiceMultInFourFill_']
            const answers = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K' ];
            sections.forEach(section => {
                answers.forEach(answer => {
                    $(`select[name="${section}edit_category_type_${answer}"`).html('');
                    $(`select[name="${section}edit_super_category_${answer}"`).html('');
                    $(`select[name="${section}edit_search-input_${answer}"`).html('');

                    $(`select[name="${section}edit_super_category_${answer}"`).append(super_cat_option);
                    $(`select[name="${section}edit_category_type_${answer}"`).append(cat_type_option);
                    $(`select[name="${section}edit_search-input_${answer}"`).append(question_type_option);
                });
            });

            // re initlize here.
            // $('#fc_edit_super_category_A_0').select2({
            //     dropdownParent: $('#questionMultiModal'),
            //     tags: true,
            //     placeholder : "Select Super Category",
            //     maximumSelectionLength: 1
            // });

            // $('#fc_edit_category_type_A_0').select2({
            //     dropdownParent: $('#questionMultiModal'),
            //     tags: true,
            //     placeholder : "Select Category type",
            //     maximumSelectionLength: 1
            // });

            // $('#fc_edit_search-input_A_0').select2({
            //     dropdownParent: $('#questionMultiModal'),
            //     tags: true,
            //     placeholder : "Select Question type",
            //     maximumSelectionLength: 1
            // });

            $.ajax({
                data:{
                    'question_id':id,
                    '_token': $('input[name="_token"]').val()
                },
                url: '{{route("getPracticeQuestionById")}}',
                method: 'post',
                async: false,
                success: (res) => {
                    // console.log(res);
                    if(res.question.length>0){
                        var result = res.question[0];
                        // console.log(result);
                        // console.log(result.answer);
                        // document.cookie = "format = " + result.format;
                        // let categorytypeArr = JSON.parse(result.category_type);
                        // let questiontypeArr = JSON.parse(result.question_type_id);

                        // let super_categoryArr = JSON.parse(result.super_category);
                        // let is_category_checkedArr = JSON.parse(result.is_category_checked);
                        let questionType = result.type;
                        let disp_section;
                        if(questionType == 'choiceOneInFive_Odd') {
                            disp_section = 'oneInFiveOdd_';
                        } else if(questionType == 'choiceOneInFourPass_Odd') {
                            disp_section = '';
                        } else if(questionType == 'choiceOneInFour_Odd') {
                            disp_section = 'oneInFourOdd_';
                        } else if(questionType == 'choiceOneInFour_Even') {
                            disp_section = 'oneInFourEven_';
                        } else if(questionType == 'choiceOneInFive_Even') {
                            disp_section = 'oneInFiveEven_';
                        } else if(questionType == 'choiceOneInFourPass_Even') {
                            disp_section = 'oneInFourPassEven_';
                        }  else if (questionType == 'choiceMultInFourFill') {
                            ans_choices = ['A', 'B', 'C', 'D'];
                            if(result.multiChoice == '1') {
                                disp_section = 'cb_choiceMultInFourFill_';
                            } else if(result.multiChoice == '3') {
                                disp_section = 'choiceMultInFourFill_';
                            } else if(result.multiChoice == '2') {
                                disp_section = 'fc_';
                            }
                        }

                        let checkbox_values_Arr = JSON.parse(result.checkbox_values);
                        let super_category_values_Arr = JSON.parse(result.super_category_values);
                        let category_type_values_Arr = JSON.parse(result.category_type_values);
                        let question_type_values_Arr = JSON.parse(result.question_type_values);

                        for (let key in super_category_values_Arr) {
                            if (super_category_values_Arr.hasOwnProperty(key)) {
                                let values = super_category_values_Arr[key];
                                for (let index = 1; index < super_category_values_Arr[key].length; index++) {
                                    addNewTypes(key, index,'repet', disp_section, super_cat_option, cat_type_option, question_type_option);
                                }
                            }
                        }

                        // let checkedValuesArr = is_category_checkedArr.map(item => item.checked);
                        $('#editQuestionOrder').val(result.question_order);
                        $('#currentModelQueId').val(result.id);

                        $('#diffValueEdit').val(result.diff_value);
                        $('#discValueEdit').val(result.disc_value);

                        $('#quesFormat').val(result.format);
                        $('.sectionAddId').val(result.practice_test_sections_id);
                        $('#testSectionTypeRead').val(result.type);
                        $('#new_question_type_select').val(result.question_type_id);
                        $('#category_type').val(result.category_type);
                        $('#diff_rating_edit').val(result.diff_rating).trigger('change');
                        // $('#super_category_edit').val(result.super_category).trigger('change');
                        CKEDITOR.instances['js-ckeditor-addQue'].setData(result.title);
                        let section_type = $(`.selectedSection_${result.practice_test_sections_id}`).val();
                        $('#section_type').val(section_type);

                        $('#question_tags_edit').val(result.tags).trigger('change');
                        // $('#question_tags_edit').val(result.tags).trigger('change');

                        $(".passNumber").val(result.passage_number).change();
                        $('#passagesType').val(result.passages_id).change();
                        
                        // for (let index = 1; index < categorytypeArr.length; index++) {
                        //     addNewTypes(index,'repet');
                        // }

                        //new
                        if(result.passages_id != null) {
                            $('#passageRequired_2').prop('checked', true);
                            $('#passage_number').prop('disabled',false);
                            $('select[name="passagesType"]').prop('disabled',false);
                        } else {
                            $('#passageRequired_2').prop('checked', false);
                            $('#passage_number').prop('disabled',true);
                            $('select[name="passagesType"]').prop('disabled',true);
                        }

                        // $('.plus-button').attr('data-id', categorytypeArr && categorytypeArr.length ? categorytypeArr.length : 0);
                        // setTimeout(function(){

                            //For checkbox
                            for (let key in checkbox_values_Arr) {
                                if (checkbox_values_Arr.hasOwnProperty(key)) {
                                    $(checkbox_values_Arr[key]).each((i,v) => {
                                        $(`#${disp_section}edit_ct_checkbox_${key}_${i}`).prop('checked', v==1);
                                    });
                                }
                            }

                            // edit_guessing_value_
                            // guessing_value
                            // guessing_value_arr
                            //For guessing value
                            $('.edit_guessing_value').val('');
                            // if(guessing_value) {
                                let guessing_value_arr = JSON.parse(result.guessing_value);
                                for (let key in guessing_value_arr) {
                                    if (guessing_value_arr.hasOwnProperty(key)) {
                                        $(guessing_value_arr[key]).each((i,v) => {
                                            $(`#${disp_section}edit_guessing_value_${key}`).val(v);
                                        });
                                    }
                                }
                            // }


                            //For super category
                            for (let key in super_category_values_Arr) {
                                if (super_category_values_Arr.hasOwnProperty(key)) {
                                    $(super_category_values_Arr[key]).each((i,v) => {
                                        $(`#${disp_section}edit_super_category_${key}_${i}`).val(v);
                                        $(`#${disp_section}edit_super_category_${key}_${i}`).trigger('change');
                                    });
                                }
                            }

                            //For Category type
                            for (let key in category_type_values_Arr) {
                                if (category_type_values_Arr.hasOwnProperty(key)) {
                                    $(category_type_values_Arr[key]).each((i,v) => {
                                        $(`#${disp_section}edit_category_type_${key}_${i}`).val(v);
                                        $(`#${disp_section}edit_category_type_${key}_${i}`).trigger('change');
                                    });
                                }
                            }

                            //For Question Type
                            for (let key in question_type_values_Arr) {
                                if (question_type_values_Arr.hasOwnProperty(key)) {
                                    $(question_type_values_Arr[key]).each((i,v) => {
                                        $(`#${disp_section}edit_search-input_${key}_${i}`).val(v);
                                        $(`#${disp_section}edit_search-input_${key}_${i}`).trigger('change');
                                    });
                                }
                            }

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
                        getAnswerOption(result.type, result.answer, result.fill, result.fillType, result.answer_content, result.answer_exp, result.multiChoice, result.checkbox_values, result.super_category_values, result.category_type_values, result.question_type_values );
                    }
                    // setTimeout(() => {
                        $('#questionMultiModal').modal('show');
                    // }, 1000);
                    $(`.editMultipleChoice option[value="${parseInt(result.multiChoice)}"]`).prop('selected', true);
                    $(".editMultipleChoice").trigger("change");
                }
            });
        }
    });
}

async function getAnswerOption(answerOpt, selectedOpt, fill, fillType, answer_content, answer_exp, multiChoice, checkbox_values, super_category_values, category_type_values, question_type_values){
    // console.log(answerOpt);
    // console.log(selectedOpt);
    // console.log(multiChoice);
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
        		  $('.choiceOneInFour_Odd ul li.choiceOneInFour_OddAnswer_'+arrIndex+' input[type="radio"] ').prop("checked", true);
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
        		  $('.choiceOneInFour_Even ul li.choiceOneInFour_EvenAnswer_'+arrIndex+' input[type="radio"] ').prop("checked", true);
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
        			$('.choiceOneInFive_Odd ul li.choiceOneInFive_OddAnswer_'+arrIndex+' input[type="radio"] ').prop("checked", true);
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
                    $('.choiceOneInFive_Even ul li.choiceOneInFive_EvenAnswer_'+arrIndex+' input[type="radio"] ').prop("checked", true);
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
        			$('.choiceOneInFourPass_Odd ul li.choiceOneInFourPass_OddAnswer_'+arrIndex+' input[type="radio"]').prop("checked", true);
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
        			$('.choiceOneInFourPass_Even ul li.choiceOneInFourPass_EvenAnswer_'+arrIndex+' input[type="radio"]').prop("checked", true);
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
            
            if(selectedOpt) {
                selectedOpt = selectedOpt;
            }else{
                selectedOpt = 'a';
            }
            // console.log(selectedOpt);
            var trimStr = selectedOpt.replace(/ /g,'');
            var multiChecked = trimStr.split(",");
        	
        	var selHml='';
            var jsonConvert = [];

            if(answer_content != null && isJson(answer_content)){
                jsonConvert = $.parseJSON(answer_content);
            }

            var fillHtl = '<input type="text" name="choiceMultInFourFill_fill[]" value="">';
            // console.log(multiChecked);
            if(multiChoice == 1){
                // console.log('here multicheked 1');
                for(var i=1; i<= optObj.length; i++) {
                    var arrIndex = Number(i)-1;
                    var editInd = Number(i)+1;
                    if(multiChecked.includes(optObj[arrIndex])){
                        // console.log(selectedOpt);
                        $('.choiceMultInFourFill .withOutFillOpt ul li.choiceMultInFourFillwithOutFillOpt_'+arrIndex+' input[type="checkbox"][value="'+optObj[arrIndex]+'"]').prop("checked", true);

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
                // console.log('here multicheked else');
                for(var i=1; i<= optObj.length; i++){
                    var arrIndex = Number(i)-1;
                    var editInd = Number(i)+1;
                    if(selectedOpt == optObj[arrIndex]){
                        // console.log(selectedOpt);
                        $('.choiceMultInFourFill .withOutFillOptChoice ul li.choiceMultInFourFillwithOutFillOptChoice_'+arrIndex+' input[type="radio"]').prop("checked", true);

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
            // console.log('here at last');
            var seletedLayout = '<div class="mb-2"><label class="form-label" style="font-size: 13px;">Fill Type:</label><select name="choiceMultInFourFill_filltype"  class="form-control choiceMultInFourFill_filltype">'+optType+'</select> </div><div class="mb-2"> <label class="form-label" style="font-size: 13px;">Fill:</label> <label class="form-label editExtraFillOption" style="font-size: 13px;">'+fillHtl+'</label><label class="form-label" style="font-size: 13px;"><a href="javascript:;" onClick="editMoreFillOption();" class="switchMulti">Add More Options</a></label></div>';
            
            // let checkbox_values_Arr = JSON.parse(checkbox_values);
            // let super_category_values_Arr = JSON.parse(super_category_values);
            // let category_type_values_Arr = JSON.parse(category_type_values);
            // let question_type_values_Arr = JSON.parse(question_type_values);

            // var test_format_type_val = jQuery('#format').val();
            // preGetPracticeCategoryType = await dropdown_lists(`/admin/getPracticeCategoryType?testType=${test_format_type_val}`);
            // preGetPracticeQuestionType = await dropdown_lists(`/admin/getPracticeQuestionType?testType=${test_format_type_val}`);
            // preGetSuperCategory = await dropdown_lists(`/admin/getSuperCategory?testType=${test_format_type_val}`);

            // for (let key in super_category_values_Arr) {
            //     if (super_category_values_Arr.hasOwnProperty(key)) {
            //         seletedLayout += '<div class="input-container" id="fc_addNewTypes_A">';

            //         for (let index = 0; index < super_category_values_Arr[key].length; index++) {
            //             seletedLayout += '<div class="d-flex input-field align-items-center">';
            //                 seletedLayout += '<div class="col-md-1"><label class="form-label" for="fc_edit_ct_checkbox_A">&ensp;</label><input type="checkbox" name="fc_edit_ct_checkbox_A" id="fc_edit_ct_checkbox_A_'+key+'"></div>';

            //                 seletedLayout += '<div class="col-md-3 mb-2 me-2 rating-tag"><label class="form-label" for="superCategory">Super Category<span class="text-danger">*</span></label><div class="d-flex align-items-center"><select class="switchMulti superCategory" id="fc_edit_super_category_A_'+key+'" name="fc_edit_super_category_A" style="width: 100%"><option value="">Select Super Category</option>'+preGetSuperCategory+'</select></div><span class="text-danger" id="fc_superCategoryError_A"></span></div>';

            //                 seletedLayout += '<div class="col-md-3 mb-2 me-2 category-custom"><label for="category_type" class="form-label">Category Type<span class="text-danger">*</span></label><div class="d-flex align-items-center"><select class="switchMulti categoryType" id="fc_edit_category_type_A_'+key+'" name="fc_edit_category_type_A" style="width: 100%"><option value="">Select Category Type</option>'+preGetPracticeCategoryType+'</select></div><span class="text-danger" id="fc_categoryTypeError_A"></span></div>';

            //                 seletedLayout += '<div class="mb-2 col-md-3 add_question_type_select"><label for="search-input" class="form-label">Question Type<span class="text-danger">*</span></label><div class="d-flex align-items-center"><select class="switchMulti questionType" id="fc_edit_search-input_A_'+key+'" name="fc_edit_search-input_A" style="width: 100%"><option value="">Select Question Type</option>'+preGetPracticeQuestionType+'</select></div><span class="text-danger" id="fc_questionTypeError_A"></span></div>';

            //                 seletedLayout += '<div class="col-md-2 add-position">';
            //                 if(index == 0) {
            //                     // seletedLayout += '<button class="plus-button" fc_ans_col="A" fc_data-id-A="1" onclick="addNewTypes("A", this,"null", "fc_")"><i class="fa-solid fa-plus"></i></button>';
            //                 } else {
            //                     // seletedLayout += '<button class="plus-button" onclick="removeNewTypes(this)"><i class="fa-solid fa-minus"></i></button>';
            //                 }
            //                 seletedLayout += '</div>';
            //             seletedLayout += '</div>';
            //         }
            //         seletedLayout += '</div>';
            //     }
            // }

            $('.withFillOptmb-2').html(seletedLayout);

            // re initlize here.
            $('#fc_edit_super_category_A_0').select2({
                dropdownParent: $('#questionMultiModal'),
                tags: true,
                placeholder : "Select Super Category",
                maximumSelectionLength: 1
            });

            $('#fc_edit_category_type_A_0').select2({
                dropdownParent: $('#questionMultiModal'),
                tags: true,
                placeholder : "Select Category type",
                maximumSelectionLength: 1
            });

            $('#fc_edit_search-input_A_0').select2({
                dropdownParent: $('#questionMultiModal'),
                tags: true,
                placeholder : "Select Question type",
                maximumSelectionLength: 1
            });

            // for (let key in checkbox_values_Arr) {
            //     if (checkbox_values_Arr.hasOwnProperty(key)) {
            //         $(checkbox_values_Arr[key]).each((i,v) => {
            //             console.log(`#fc_edit_ct_checkbox_${key}_${i}`);
            //             // $(`#fc_edit_ct_checkbox_${key}_${i}`).prop('checked', v==1);
            //         });
            //     }
            // }


            // //For super category
            // for (let key in super_category_values_Arr) {
            //     if (super_category_values_Arr.hasOwnProperty(key)) {
            //         $(super_category_values_Arr[key]).each((i,v) => {
            //             console.log(`#fc_edit_super_category_${key}_${i}`);
            //             $(`#fc_edit_super_category_${key}_${i}`).val(v);
            //             // $(`#$fc_edit_super_category_${key}_${i}`).trigger('change');
            //         });
            //     }
            // }

            // //For Category type
            // for (let key in category_type_values_Arr) {
            //     if (category_type_values_Arr.hasOwnProperty(key)) {
            //         $(category_type_values_Arr[key]).each((i,v) => {
            //             console.log(`#fc_edit_category_type_${key}_${i}`);
            //             $(`#fc_edit_category_type_${key}_${i}`).val(v);
            //             // $(`#fc_edit_category_type_${key}_${i}`).trigger('change');
            //         });
            //     }
            // }

            // //For Question Type
            // for (let key in question_type_values_Arr) {
            //     if (question_type_values_Arr.hasOwnProperty(key)) {
            //         $(question_type_values_Arr[key]).each((i,v) => {
            //             $(`#fc_edit_search-input_${key}_${i}`).val(v);
            //             $(`#fc_edit_search-input_${key}_${i}`).trigger('change');
            //         });
            //     }
            // }
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
                // Math:'choiceOneInFive',
                Math:'choiceMultInFourFill',
                Reading:'choiceOneInFourPass',
                Reading_And_Writing:'choiceOneInFourPass',
                Easy_Reading_And_Writing:'choiceOneInFourPass',
                Hard_Reading_And_Writing:'choiceOneInFourPass',
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
        $('input[name="addChoiceMultInFourFill_fill[]"]').remove();
    } else if(arg == 3){
        $('#addSelectedLayoutQuestion .multi_field').hide();
        $('#addSelectedLayoutQuestion .multiChoice_field').show();
        $('#addSelectedLayoutQuestion .fill_field').hide();
        $('input[name="addChoiceMultInFourFill_fill[]"]').remove();
    } else if(arg == 2) {
        $('#addSelectedLayoutQuestion .multi_field').hide();
        $('input[name="addChoiceMultInFourFill[]"]').prop("checked",false);
        $('#addSelectedLayoutQuestion .multiChoice_field').hide();
        $('input[name="addChoiceMultiChoiceInFourFill"]').prop("checked",false);
        $('#addSelectedLayoutQuestion .fill_field').show();
    } else {
        $('#addSelectedLayoutQuestion .multi_field').hide();
        $('input[name="addChoiceMultInFourFill[]"]').prop("checked",false);
        $('#addSelectedLayoutQuestion .multiChoice_field').hide();
        $('input[name="addChoiceMultiChoiceInFourFill"]').prop("checked",false);
        $('#addSelectedLayoutQuestion .fill_field').hide();
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
    }else if(arg == 2) {
        $('#selectedLayoutQuestion .multi_field').hide();
        $('input[name="choiceMultInFourFill[]"]').prop("checked",false);
        $('#selectedLayoutQuestion .multiChoice_field').hide();
        $('input[name="editChoiceMultiChoiceInFourFill"]').prop("checked",false);
        $('#selectedLayoutQuestion .fill_field').show();
    } else {
        $('#selectedLayoutQuestion .multi_field').hide();
        $('input[name="choiceMultInFourFill[]"]').prop("checked",false);
        $('#selectedLayoutQuestion .multiChoice_field').hide();
        $('input[name="editChoiceMultiChoiceInFourFill"]').prop("checked",false);
        $('#selectedLayoutQuestion .fill_field').hide();
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
//new
function openQuestionDialog(sectionId) {
    $.ajax({
        data: {
            'sectionId': sectionId,
            '_token': $('input[name="_token"]').val()
        },
        url: '{{ route('getSectionQuestions') }}',
        method: 'post',
        success: (res) => {
            $("#addListWithHandleQuestion").empty();
            $.each(res, function(index, value) {
                $('#addListWithHandleQuestion').append('<div class="list-group-item" data-id="' +
                    value.question_id + '">\n' +
                    '<span class="glyphicon question-glyphicon-move" aria-hidden="true">\n' +
                    '<i class="fa-solid fa-grip-vertical"></i>\n' +
                    '</span>\n' +
                    '<button class="btn btn-primary" value="' + value.question_id + '">' +
                    value.question_title + '</button>\n' +
                    '</div>');
                MathJax.Hub.Queue(["Typeset",MathJax.Hub,'p']);
            });

        }
    });
    addQuestionModal.show();
}
function saveQuestion() {

    addQuestionModal.hide();
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
    $("input[name=required_number_of_correct_answers]").val("");
    var optionObj = [];
    var modelCount = $('.sectionTypesFull').length;
    $('#currentModelId').val(modelCount);
    $('#add_question_modal_multi').attr('data-id', modelCount);
    optionObj['ACT'] = ['English', 'Math', 'Reading', 'Science'];
    optionObj['SAT'] = ['Reading', 'Writing', 'Math (no calculator)', 'Math (with calculator)'];
    optionObj['PSAT'] = ['Reading', 'Writing', 'Math (no calculator)', 'Math (with calculator)'];
    optionObj['DSAT'] = ['Reading And Writing', 'Math'];
    optionObj['DPSAT'] = ['Reading And Writing', 'Math'];
    var format = $('.ptype #format').val();

    $('#testSectionType').html('');
    var opt = '<option value="">Select Section Type</option>';
    for (var i = 0; i < optionObj[format].length; i++) {
        var typeVal = optionObj[format][i].replace(/\s/g, '_');
        typeVallev = typeVal.replace(')', '');
        typeVallev2 = typeVallev.replace('(', '');
        opt += `<option value="${typeVallev2}" data-isMath="${ typeVallev2 == 'Math_no_calculator' || typeVallev2 == 'Math_with_calculator' ? true : false }">${optionObj[format][i]}</option>`;
    }
    $('#testSectionType').append(opt);
    $('#testSectiontitle').val('');
    $('#regular_time_hour, #regular_time_minute, #regular_time_second, #50extendedhour, #50extendedminute, #50extendedsecond, #100extendedhour, #100extendedminute, #100extendedsecond').val('');
    $('#sectionModal').modal('show');
});

// new

$(document).ready(function(){
    var optionObj = [];
    var format = $('.ptype #format').val();
    optionObj['ACT'] = ['English', 'Math', 'Reading', 'Science'];
    optionObj['SAT'] = ['Reading', 'Writing', 'Math (no calculator)', 'Math (with calculator)'];
    optionObj['PSAT'] = ['Reading', 'Writing', 'Math (no calculator)', 'Math (with calculator)'];
    optionObj['DSAT'] = ['Reading And Writing', 'Math'];
    optionObj['DPSAT'] = ['Reading And Writing', 'Math'];
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

        var promises = $(`#listWithHandleQuestion .sectionsaprat_${section_id}`).map((index, v) => {
            var new_question_id =  $(v).attr('data-id');
            var new_question_id_order = index + 1;
            var orderId = '#orderRearnge_' + new_question_id;
            $(orderId).val(new_question_id_order);
            $('.orderValUpdate_' + new_question_id).text(new_question_id_order);
            return $.ajax({
                data: {
                    'question_order': new_question_id_order,
                    'question_id': new_question_id,
                    '_token': $('input[name="_token"]').val(),
                },
                url: '{{ route("questionOrder") }}',
                method: 'post',
                success: function(res){
                //     $('#sectionDisplay_'+section_id+' .firstRecord .singleQuest_'+new_question_id).remove();
                //     $('#sectionDisplay_'+section_id+' .firstRecord').append('<ul class="sectionList singleQuest_'+new_question_id+'"><li>'+res.question['title']+'</li><li>'+res.question['answer']+'</li><li>'+res.question['passages']+'</li><li>'+res.question['passage_number']+'</li><li>'+res.question['fill']+'</li><li class="orderValUpdate_'+new_question_id+'">'+new_question_id_order+'</li><li><button type="button" class="btn btn-sm btn-alt-secondary edit-section" data-id="'+new_question_id+'" data-bs-toggle="tooltip" title="Edit Question" onclick="practQuestioEdit('+new_question_id+')"> <i class="fa fa-fw fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-alt-secondary delete-section" data-id="'+new_question_id+'" data-bs-toggle="tooltip" title="Delete Section"   onclick="practQuestioDel('+new_question_id+')">  <i class="fa fa-fw fa-times"></i></button> </li></ul>');
                }
            });
        });
        Promise.all(promises).then(function(results) {
            $.each(results, function(index,val){
                $('#sectionDisplay_'+val.question['practice_test_sections_id']+' .firstRecord .singleQuest_'+val.question['id']).remove();
                let html = '';
                    html += `<ul class="sectionList singleQuest_${val.question['id']}" data-id="${val.question['id']}">`;
                    html += `<li>${val.question['title']}</li>`;
                    html += `<li class="answerValUpdate_${val.question['id']}">${val.question['answer']}</li>`;
                    html += `<li>${val.question['passages'] ? val.question['passages'] : ''}</li>`;
                    html += `<li>${val.question['passage_number'] ? val.question['passage_number'] : ''}</li>`;
                    html += `<li>${val.question['fill']}</li>`;
                    html += `<li class="orderValUpdate_${val.question['id']}">${val.question['question_order']}</li>`;
                    html += `<li>`;
                    html += `<button type="button" class="btn btn-sm btn-alt-secondary edit-section" data-id="${val.question['id']}" data-bs-toggle="tooltip" title="Edit Question" onclick="practQuestioEdit(${val.question['id']})">`;
                    html += `<i class="fa fa-fw fa-pencil-alt"></i>`;
                    html += `</button>`;
                    html += `<button type="button" class="btn btn-sm btn-alt-secondary delete-section" data-id="${val.question['id']}" data-bs-toggle="tooltip" title="Delete Question"   onclick="practQuestioDel(${val.question['id']})">`;
                    html += `<i class="fa fa-fw fa-times"></i>`;
                    html += `</button>`;
                    html += `</li>`;
                    html += `</ul>`;
                $(`#sectionDisplay_${val.question['practice_test_sections_id']} .firstRecord`).append(html);
                MathJax.Hub.Queue(["Typeset",MathJax.Hub,'p']);
            });
        });
    }
});

//new function for new add question reorder
var test = Sortable.create(addListWithHandleQuestion, {
            handle: '.question-glyphicon-move',
            animation: 150,
            onEnd: function(evt) {
                var dataSet = evt.clone.dataset;
                var section_id = dataSet.section_id;
                /*let data = {
                    new_index: evt.newIndex+1,
                    old_index: evt.oldIndex+1,
                    item: evt.item.children[1].value,
                    currentMileId: 1
                };*/
                var indices = test.toArray();
                var promises =  $(indices).map(function(index, value) {
                    var new_question_id = value;
                    var new_question_id_order = index + 1;
                    var orderId = '#orderRearnge_' + new_question_id;
                    $(orderId).val(new_question_id_order);
                    $('.orderRearnge_' + new_question_id).text(new_question_id_order);
                    return $.ajax({
                        data: {
                            'question_order': new_question_id_order,
                            'question_id': new_question_id,
                            '_token': $('input[name="_token"]').val()
                        },
                        url: '{{ route("questionOrder") }}',
                        method: 'post',
                        success: (res) => {
                            // $('.sectionTypesFull .firstRecord .singleQuest_'+res.question['id']+'').remove();
                        }
                    });
                });
                Promise.all(promises).then(function(results) {
                    $.each(results, function(index,val){
                        $('.section_'+val.question['practice_test_sections_id']+' .firstRecord .singleQuest_'+val.question['id']+'').remove();
                        let html = '';
                            html += `<ul class="sectionList singleQuest_${val.question['id']}" data-id="${val.question['id']}">`;
                            html += `<li>${val.question['title']}</li>`;
                            html += `<li class="answerValUpdate_${val.question['id']}">${val.question['answer']}</li>`;
                            html += `<li>${val.question['passages'] ? val.question['passages'] : ''}</li>`;
                            html += `<li>${val.question['passage_number'] ? val.question['passage_number'] : ''}</li>`;
                            html += `<li>${val.question['fill']}</li>`;
                            html += `<li class="orderValUpdate_${val.question['id']}">${val.question['question_order']}</li>`;
                            html += `<li>`;
                            html += `<button type="button" class="btn btn-sm btn-alt-secondary edit-section" data-id="${val.question['id']}"
                                    data-bs-toggle="tooltip" title="Edit Question" onclick="practQuestioEdit(${val.question['id']})">`;
                            html += `<i class="fa fa-fw fa-pencil-alt"></i>`;
                            html += `</button>`;
                            html += `<button type="button" class="btn btn-sm btn-alt-secondary delete-section" data-id="${val.question['id']}" data-bs-toggle="tooltip" title="Delete Question" onclick="practQuestioDel(${val.question['id']})">`;
                            html += `<i class="fa fa-fw fa-times"></i>`;
                            html += `</button>`;
                            html += `</li>`;
                            html += `</ul>`;
                        $(`.section_${val.question['practice_test_sections_id']} .firstRecord`).append(html);
                        MathJax.Hub.Queue(["Typeset",MathJax.Hub,'p']);
                    });
                });
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
                    optionObj['DSAT'] = ['Reading And Writing', 'Math'];
                    optionObj['DPSAT'] = ['Reading And Writing', 'Math'];

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

                let regularTime = res.sectionDetails.regular_time.split(':');
                let fiftyTime = res.sectionDetails.fifty_per_extended.split(':');
                let hundredTime = res.sectionDetails.hundred_per_extended.split(':');

                $('#edit_regular_hour').val(regularTime[0]);
                $('#edit_regular_minute').val(regularTime[1]);
                $('#edit_regular_second').val(regularTime[2]);

                $('#edit50extendedhour').val(fiftyTime[0]);
                $('#edit50extendedminute').val(fiftyTime[1]);
                $('#edit50extendedsecond').val(fiftyTime[2]);
                $('#edit_required_number_of_correct_answers').val(res.sectionDetails.required_number_of_correct_answers);

                required_number_of_correct_answers

                $('#edit100extendedhour').val(hundredTime[0]);
                $('#edit100extendedminute').val(hundredTime[1]);
                $('#edit100extendedsecond').val(hundredTime[2]);
            }
        });
        $('#editSectionModal').modal('show');
    }

    $('.save_edited_change').click(function(){
        let id = $('#currentSectionId').val();
        let testSectionTitle = $('#editTestSectionTitle').val();
        let testSectionType = $('#editTestSectionType').val();
        let rHour = $('#edit_regular_hour').val();
        let rMinute = $('#edit_regular_minute').val();
        let rSecond = $('#edit_regular_second').val();
        let fiftyHour = $('#edit50extendedhour').val();
        let fiftyMinute = $('#edit50extendedminute').val();
        let fiftySecond = $('#edit50extendedsecond').val();
        let hundredHour = $('#edit100extendedhour').val();
        let hundredMinute = $('#edit100extendedminute').val();
        let hundredSecond = $('#edit100extendedsecond').val();

        let edit_required_number_of_correct_answers = $('#edit_required_number_of_correct_answers').val();

        var regularTime = ("0" + rHour).slice(-2) + ":" + ("0" + rMinute).slice(-2) + ":" + ("0" + rSecond).slice(-2);
        var fiftyExtended = ("0" + fiftyHour).slice(-2) + ":" + ("0" + fiftyMinute).slice(-2) + ":" + ("0" + fiftySecond).slice(-2);
        var hundredExtended = ("0" + hundredHour).slice(-2) + ":" + ("0" + hundredMinute).slice(-2) + ":" + ("0" + hundredSecond).slice(-2);

        $.ajax({
            data: {
                'sectionId': id ,
                'sectionTitle': testSectionTitle,
                'sectionType': testSectionType,
                'regular': regularTime,
                'fifty': fiftyExtended,
                'hundred': hundredExtended,
                'required_number_of_correct_answers': edit_required_number_of_correct_answers,
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

    function validateInput(input) {
        
        var value = parseInt(input.value);
            value = Math.round(value);
        if (value < 0) {
            value = Math.abs( value );
            input.value = input.min;
        }else if (value == 0) {
            value = Math.abs( value );
            input.value = input.min;
        }else if (value > parseInt(input.max)) {
            input.value = input.max;
        }else{
            input.value = value;
        }
    }

    function deleteSection(data) {
        let id = $(data).attr('data-id');
        let type = $(data).attr('data-section_type');
        var result = confirm("Are you sure to remove section ?");
        if(!result){
            return false;
        }
        sectionOrder--;

        $.ajax({
            data: {
                'sectionId': id ,
                'sectionType': type,
                '_token': $('input[name="_token"]').val()
            },
            url: '{{ route("delete_section") }}',
            method: 'post',
            success: (res) => {
                $(`.section_${id}`).remove();
            }
        });
    }


</script>

@endsection
