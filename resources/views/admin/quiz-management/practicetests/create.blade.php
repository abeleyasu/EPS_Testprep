@extends('layouts.admin')

@section('title', 'Admin Dashboard : Test')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr/toastr.min.css') }}">
    <style>
        /* your CSS goes here*/
        body {
            background: #eee
        }

        .label-check {
            padding: 4px;
        }

        h1 {
            text-align: center
        }

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

        /* #addNewTypes .select2-container--default,.add_question_type_select .select2-container--default,.removeNewTypes .select2-container--default,.add_question_type_select .select2-container--default {
                                                                                                                                                            width: 305px !important;
                                                                                                                                                        }
                                                                                                                                                        .removeNewTypes .select2-search__field,.add_question_type_select .select2-search__field,#addNewTypes .select2-search__field,.add_question_type_select .select2-search__field{
                                                                                                                                                            height: 22px;
                                                                                                                                                            margin: 6px 10px 0;
                                                                                                                                                        } */
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

        .thanks-message {
            display: none
        }

        .container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }


        /* Hide the browser's default radio button */

        .container input[type="radio"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }


        /* Create a custom radio button */

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            border-radius: 50%;
        }


        /* On mouse-over, add a grey background color */

        .container:hover input~.checkmark {
            background-color: #ccc;
        }


        /* When the radio button is checked, add a blue background */

        .container input:checked~.checkmark {
            background-color: #2196F3;
        }


        /* Create the indicator (the dot/circle - hidden when not checked) */

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }


        /* Show the indicator (dot/circle) when checked */

        .container input:checked~.checkmark:after {
            display: block;
        }


        /* Style the indicator (dot/circle) */

        .container .checkmark:after {
            top: 9px;
            left: 9px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: white;
        }

        .sectionHeading {
            display: flex;
            width: 100%;
        }

        .sectionHeading li {
            /*display: flex;**/
            width: 16.5%;
            margin-right: 0px;
            list-style: none;
            font-size: 15px;
            font-weight: bold;
            text-align: center;
        }

        .sectionList {
            display: flex;
            width: 100%;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            padding: 10px 20px;
            line-height: 40px;
        }

        .sectionList li {
            /*display: flex;*/
            text-align: center;
            width: 17%;
            margin-right: 5px;
            list-style: none;
            font-size: 15px;
        }

        .sectionListtype {
            width: 100%;
            display: flex;
            border: 1px solid #ccc;
            padding: 10px 14px;
        }

        .sectionListtype li {
            display: flex;
            align-items: center;
            width: 30%;
            margin-right: 15px;
            list-style: none;
            font-size: 15px;
        }

        .sectionTypesFull {
            padding: 20px;
            /*box-shadow: rgb(0 0 0 / 50%) 0px 4px 30px;*/
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            margin-bottom: 18px;
        }

        .switchMulti {
            color: #000;
            background: #ccc;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 16px;
            padding: 5px 8px;
        }

        .extraFillOption {
            width: 100%;
            margin: 10px 0px;
        }

        .extraFillOption input {
            width: 100%;
            margin: 10px 0px;
        }

        ul.answerOptionLsit {
            padding: 0px;
            width: 100%;
        }

        ul.answerOptionLsit li {
            /* width: 100%; */
            list-style: none;
            padding-top: 14px;
        }

        ul.answerOptionLsit li label span {
            font-size: 15px;
        }

        ul.answerOptionLsit li label {
            width: 100%;
            display: flex;
            margin-bottom: 10px;
        }

        ul.answerOptionLsit li label input {
            width: auto !important;
            margin-left: 10px;
        }

        .ordermain {
            display: flex;
        }

        .opendialog {
            width: 25%;
            display: flex;
            margin-left: 25px;
        }

        .opendialog input {
            width: 250px;
        }

        .list-group-item button p {
            padding: 0px;
            margin: 0px;
        }

        /* .input-container {
                                                                                                                                                            margin-bottom: 10px;
                                                                                                                                                        } */



        .form-control {
            flex: 1;
            margin-right: 5px;
        }

        .plus-button,
        .minus-button {
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

        .minus-button:hover {
            background-color: #1f2937 !important;
        }

        .select2-container--default .select2-selection--single {
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

        .select2-container--default .select2-selection--single .select2-selection__rendered {
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

        .form-label {
            display: block;
            font-size: 16px;
        }

        #addNewType .select2-container--default {
            width: 300px !important;
        }

        .passage-container .select2-container--default {
            width: 300px !important;
        }

        .add-position {
            position: relative;
            top: 4px;
        }

        .add-minus-icon {
            position: relative;
            top: -7px
        }

        #sectionModal .select2-container--default {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid #dfe3ea;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            border: none !important;
            background-color: #e5e5e5 !important;
            color: #000 !important;
            font-weight: 400 !important;
            max-width: 260px !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #000 !important;
            border-right: none !important;
            padding: 0 7px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
            padding-left: 4px;
            padding-right: 9px;
        }

        .edit-close-btn {
            width: 60px !important;
        }

        .select-type .select2-container--default {
            width: 100% !important;
        }

        .input-check {
            position: relative;
            top: 13px;
            margin-left: 30px;
        }

        .input-check[type="checkbox"] {
            width: 30px;
            height: 30px;
            accent-color: #1f2937
        }

        #mainSectionContainer .sortable-chosen {
            background-color: #fff !important;
            opacity: 50 !important;
            border: 1px solid #1f2937 !important;
            z-index: 999999999 !important;
        }

        #mainSectionContainer .sectionTypesFull {
            border: 2px solid transparent;
        }

        .rating-tag .select2-container {
            width: 100% !important;
        }

        /* .rating-tag .select2-container--default .select2-selection--multiple{
                                                                                                                                                            padding: 5px !important;
                                                                                                                                                        } */
        .type-check[type="checkbox"] {
            width: 30px;
            height: 30px;
            accent-color: #1f2937;
            margin-left: 10px;
        }

        .select2-container .select2-selection--multiple {
            min-height: 38px !important;
        }

        .select2-container .select2-search--inline .select2-search__field {
            margin-top: 7px !important;
            height: 20px !important;
            padding: 0 4px;
        }

        .select2-container--default .select2-selection--multiple {
            border-color: #dfe3ea !important;
        }

        .add_question_type_select .select2-container,
        .category-custom .select2-container,
        .removeNewTypes .select2-container {
            width: 300px !important;
        }

        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /* background-color: rgb(125 125 125 / 100%); */
            /* background-color: transparent; */
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
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        input[type="time"]::-webkit-calendar-picker-indicator {
            display: none;
        }

        .half-row {
            width: 50%;
        }
    </style>
@endsection

@section('admin-content')
    <!-- Main Container -->
    <main id="main-container">
        <div class="preloader" style="display: none">
            <div class="loader"></div>
        </div>
        <input type="hidden" id="section_type" value="">
        <!-- Page Content -->
        <form action="{{ route('practicetests.store') }}" method="POST" id="regForm">
            @csrf
            <div class="content content-boxed">
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Dynamic Table Full -->
                        <div class="block block-rounded">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Add Practice Tests</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <!----------------->

                                <div class="container">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col-md-12">
                                            <div class="all-steps" id="all-steps" style="display: none;"> <span
                                                    class="step"></span> <span class="step"></span> <span
                                                    class="step"></span> <span class="step"></span> </div>
                                            <div class="tab">
                                                <div class="row mb-4">

                                                    <input type="hidden" value="" name="get_question_id"
                                                        id="get_question_id">

                                                    <div class="mb-2">
                                                        <label class="form-label testvalidError"
                                                            style="font-size: 13px; color: red;"></label>
                                                    </div>
                                                    <div class="col-md-12 mb-2">
                                                        <label class="form-label">Title:</label>
                                                        <input type="text" class="form-control test_title required"
                                                            placeholder="Enter Practice Test Title" name="title"
                                                            value="" />
                                                    </div>
                                                    <div class="col-md-12 ptype">
                                                        <label class="form-label">Test Type:</label>
                                                        <select id="format" name="format"
                                                            class="form-control js-select2 select">
                                                            <option value="">Select test type</option>
                                                            @foreach ($testformats as $key => $testformat)
                                                                <option value="{{ $key }}">{{ $testformat }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 ptype mt-2">
                                                        <label class="form-label">Test Source:</label>
                                                        <select id="source" name="source"
                                                            class="form-control js-select2 select">
                                                            <option value="">Select test type</option>
                                                            <option value="0">College Prep System Practice Test
                                                            </option>
                                                            <option value="1">Official Released Practice Test</option>
                                                            <option value="2">Quiz Questions</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-2">
                                                        <label class="form-label" for="status">Status</label>

                                                        <select name="status" class="form-control" id="status">
                                                            <option value="paid">Paid</option>
                                                            <option value="unpaid">Unpaid</option>
                                                        </select>
                                                    </div>

                                                    @include('admin.courses.components.product-dropdown')
                                                </div>
                                            </div>
                                            <div class="tab">
                                                <div class="mb-2 mb-4">
                                                    <label for="testdescription" class="form-label">Description:</label>
                                                    <textarea id="js-ckeditor-desc" name="description" class="form-control form-control-lg form-control-alt"
                                                        id="description" name="description" placeholder="Description"></textarea>
                                                    @error('description')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="sectionContainerList" id="mainSectionContainer">
                                                </div>
                                                <div class="col-md-12 col-xl-12 mb-4">
                                                    <button type="button" data-id="0"
                                                        class="btn w-25 btn-alt-success add_section_modal_btn">
                                                        <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Practice Test
                                                        Section</button>
                                                </div>
                                            </div>
                                            
                                            <div style="overflow:auto;" id="nextprevious">
                                                <div style="float:right;">
                                                    <a href="javascript:;" class="btn btn-sm btn-primary" id="prevBtn"
                                                        onclick="nextPrev(-1)" style="display: inline-block !important;">
                                                        Previous
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-sm btn-primary" id="nextBtn"
                                                        onclick="nextPrev(1)">
                                                        <i class="fa fa-plus"></i> Next
                                                    </a>
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
                            <label class="form-label" style="font-size: 13px;">Practice Test Section Title:<span
                                    class="text-danger">*</span></label>
                            <input id="testSectiontitle" value="" name="testSectiontitle"
                                placeholder="Enter Practice Section Title" class="form-control">
                        </div>
                        <div class="mb-2 row">
                            <div class="col-md-6">
                                <label class="form-label" style="font-size: 13px;">Practice Test Section Type:<span
                                        class="text-danger">*</span></label>
                                <select id="testSectionType" name="testSectionType" class="form-control js-select2 select"
                                    onchange="addClassScore(this)">

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
                            <label class="form-label" style="font-size: 13px;">Regular Time<span
                                    class="text-danger">*</span></label>
                            <div id="time-span" class="d-flex">
                                <input type="number" id="regular_time_hour" step="1" class="form-control me-1"
                                    placeholder="Enter Hours" /><span style="font-weight: 700">:</span><input
                                    type="number" id="regular_time_minute" min="0" max="59"
                                    step="1" class="form-control ms-1 me-1" placeholder="Enter Minutes"
                                    oninput="validateInput(this)" /><span style="font-weight: 700">:</span><input
                                    type="number" id="regular_time_second" min="0" max="59"
                                    step="1" class="form-control ms-1" placeholder="Enter Seconds"
                                    oninput="validateInput(this)" />
                            </div>
                        </div>

                        {{-- <div class="mb-2">
                            <label class="form-label" style="font-size: 13px;">50% Extended Time</label>
                            <input type="time" id="50extended" name="50extended" step="1" class="form-control">
                        </div> --}}

                        <div class="mb-2">
                            <label class="form-label" style="font-size: 13px;">50% Extended Time</label>
                            <div id="time-span" class="d-flex">
                                <input type="number" id="50extendedhour" step="1" class="form-control me-1"
                                    placeholder="Enter Hours" /><span style="font-weight: 700">:</span><input
                                    type="number" id="50extendedminute" min="0" max="59" step="1"
                                    class="form-control ms-1 me-1" placeholder="Enter Minutes"
                                    oninput="validateInput(this)" /><span style="font-weight: 700">:</span><input
                                    type="number" id="50extendedsecond" min="0" max="59" step="1"
                                    class="form-control ms-1" placeholder="Enter Seconds"
                                    oninput="validateInput(this)" />
                            </div>
                        </div>

                        {{-- <div class="mb-2">
                            <label class="form-label" style="font-size: 13px;">100% Extended Time</label>
                            <input type="time" id="100extended" name="100extended" step="1" class="form-control">
                        </div>  --}}

                        <div class="mb-2">
                            <label class="form-label" style="font-size: 13px;">100% Extended Time</label>
                            <div id="time-span" class="d-flex">
                                <input type="number" id="100extendedhour" step="1" class="form-control me-1"
                                    placeholder="Enter Hours" /><span style="font-weight: 700">:</span><input
                                    type="number" id="100extendedminute" min="0" max="59" step="1"
                                    class="form-control ms-1 me-1" placeholder="Enter Minutes"
                                    oninput="validateInput(this)" /><span style="font-weight: 700">:</span><input
                                    type="number" id="100extendedsecond" min="0" max="59" step="1"
                                    class="form-control ms-1" placeholder="Enter Seconds"
                                    oninput="validateInput(this)" />
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

    {{-- modal for edit section  --}}
    <div class="modal fade" id="editSectionModal" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
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
                            <label class="form-label" style="font-size: 13px;">Practice Test Section Title:<span
                                    class="text-danger">*</span></label>
                            <input id="editTestSectionTitle" value="" name="testSectiontitle"
                                placeholder="Enter Practice Section Title" class="form-control">
                        </div>

                        <div class="mb-2 row col-12">
                            <div class="col-md-6 select-type">
                                <label class="form-label" style="font-size: 13px;">Practice Test Section Type:<span
                                        class="text-danger">*</span></label>
                                <select id="editTestSectionType" name="testSectionType"
                                    class="form-control js-select2 select">

                                </select>
                            </div>
                            <div class="col-md-6 for_digital_only">
                                <label class="form-label" style="font-size: 13px;">Required Number Of Correct Answers:<span
                                        class="text-danger">*</span></label>
                                <input id="edit_required_number_of_correct_answers" 
                                    name="required_number_of_correct_answers" 
                                    class="form-control" type="number"
                                    placeholder="Enter Required Number Of Correct Answers" >
                            </div>
                        </div>

                        

                        {{-- <div class="mb-2">
                            <label class="form-label" style="font-size: 13px;">Regular Time</label>
                            <input type="time" id="edit_regular_time" name="edit_regular_time" step="1" class="form-control">
                        </div> --}}

                        <div class="mb-2">
                            <label class="form-label" style="font-size: 13px;">Regular Time<span
                                    class="text-danger">*</span></label>
                            <div id="time-span" class="d-flex">
                                <input type="number" id="edit_regular_hour" step="1" class="form-control me-1"
                                    placeholder="Enter Hours" /><span style="font-weight: 700">:</span><input
                                    type="number" id="edit_regular_minute" min="0" max="59"
                                    step="1" class="form-control ms-1 me-1" placeholder="Enter Minutes"
                                    oninput="validateInput(this)" /><span style="font-weight: 700">:</span><input
                                    type="number" id="edit_regular_second" min="0" max="59"
                                    step="1" class="form-control ms-1" placeholder="Enter Seconds"
                                    oninput="validateInput(this)" />
                            </div>
                        </div>

                        {{-- <div class="mb-2">
                            <label class="form-label" style="font-size: 13px;">50% Extended Time</label>
                            <input type="time" id="edit50extended" name="edit50extended" step="1" class="form-control">
                        </div>  --}}

                        <div class="mb-2">
                            <label class="form-label" style="font-size: 13px;">50% Extended Time</label>
                            <div id="time-span" class="d-flex">
                                <input type="number" id="edit50extendedhour" step="1" class="form-control me-1"
                                    placeholder="Enter Hours" /><span style="font-weight: 700">:</span><input
                                    type="number" id="edit50extendedminute" min="0" max="59"
                                    step="1" class="form-control ms-1 me-1" placeholder="Enter Minutes"
                                    oninput="validateInput(this)" /><span style="font-weight: 700">:</span><input
                                    type="number" id="edit50extendedsecond" min="0" max="59"
                                    step="1" class="form-control ms-1" placeholder="Enter Seconds"
                                    oninput="validateInput(this)" />
                            </div>
                        </div>

                        {{-- <div class="mb-2">
                            <label class="form-label" style="font-size: 13px;">100% Extended Time</label>
                            <input type="time" id="edit100extended" name="edit100extended" step="1" class="form-control">
                        </div> --}}

                        <div class="mb-2">
                            <label class="form-label" style="font-size: 13px;">100% Extended Time</label>
                            <div id="time-span" class="d-flex">
                                <input type="number" id="edit100extendedhour" step="1" class="form-control me-1"
                                    placeholder="Enter Hours" /><span style="font-weight: 700">:</span><input
                                    type="number" id="edit100extendedminute" min="0" max="59"
                                    step="1" class="form-control ms-1 me-1" placeholder="Enter Minutes"
                                    oninput="validateInput(this)" /><span style="font-weight: 700">:</span><input
                                    type="number" id="edit100extendedsecond" min="0" max="59"
                                    step="1" class="form-control ms-1" placeholder="Enter Seconds"
                                    oninput="validateInput(this)" />
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
    {{-- start add question multi model  --}}
    <div class="modal fade" id="questionMultiModal" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-2">
                            <label class="form-label validError" style="font-size: 13px; color: red;"></label>
                        </div>
                        <div class=" d-flex justify-content-between">
                            <div class="mb-2 col-md-6 pe-3">
                                <label class="form-label" style="font-size: 13px;">Practice Test Section Type:</label>
                                <input id="testSectionTypeRead" readonly name="testSectionTypeRead" class="form-control">
                            </div>
                            {{-- new for diff ratings  --}}
                            <?php
                            $helper = new Helper();
                            $ratings = $helper->getAllDifficultyRating();
                            ?>
                            <div class="mb-2 col-md-6 ps-3 rating-tag">
                                <label class="form-label" style="font-size: 13px;">Difficulty Rating</label>
                                <select class="js-select2 select diffRating" id="diff_rating_create"
                                    name="diff_rating_create" onchange="insertDiffRating(this)" multiple>
                                    @foreach ($ratings['ratings'] as $rating)
                                        <option value="{{ $rating['id'] }}">{{ $rating['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="font-size: 13px;">Question:<span
                                    class="text-danger">*</span></label>
                            <textarea id="js-ckeditor-addQue" name="js-ckeditor-addQue"
                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                            <span class="text-danger" id="questionError"></span>
                        </div>
                        <?php
                        $helper = new Helper();
                        $tags = $helper->getAllQuestionTags();
                        ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-2 rating-tag ">
                                    <label class="form-label" for="tags">Question Tags<span
                                            class="text-danger">*</span></label>
                                            
                                    <div class="d-flex align-items-center">
                                        <select class="js-select2 select questionTag" id="question_tags_create"
                                            name="question_tags_create" onchange="insertQuestionTag(this)" multiple>
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag['id'] }}">{{ $tag['title'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="text-danger" id="tagError"></span>
                                </div>
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
                                <select class="js-select2 select superCategory" id="super_category_create" name="super_category_create" onchange="insertSuperCategory(this)" multiple>

                                </select>
                            </div>
                            <span class="text-danger" id="superCategoryError"></span>
                        </div> --}}
                        {{-- <div class="input-container" id="addNewType">
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
                                        <select class="js-select2 select categoryType w-100" id="category_type_0" name="category_type" data-id="0" onchange="insertCategoryType(this)" multiple>
                                        </select>
                                    </div>
                                    <span class="text-danger" id="categoryTypeError"></span>
                                </div>
                                <div class="col-md-3 mb-2 add_question_type_select">
                                    <label for="search-input" class="form-label">Question Type<span class="text-danger">*</span></label>
                                   <div class="d-flex align-items-center">
                                    <select class="js-select2 select questionType" id="search-input_0" name="search-input" data-id="0" onchange="insertQuestionType(this)" multiple>
                                    </select>
                                </div>
                                <span class="text-danger" id="questionTypeError"></span>
                                </div>
                                <div class="col-md-1 add-position">
                                    <button class="plus-button" data-id="1" onclick="addNewType(this)"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row passage-container align-items-center">
                            <div class="mb-2 col-md-5">
                                <label for="passage_number" class="form-label">Passage No<span
                                        class="text-danger">*</span></label>
                                <select class="js-select2 select passNumber" id="passage_number" name="passage_number">
                                    @for ($i = 1; $i < 25; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <span class="text-danger" id="passNumberError"></span>
                            </div>
                            <div class="mb-2 col-md-5">
                                <label class="form-label">Passages<span class="text-danger">*</span></label>
                                <select name="passagesType" id="passagesType"
                                    class="form-control passagesType js-select2 select"></select>
                                <span class="text-danger" id="passageTypeError"></span>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" id="passageRequired_1" name="passageRequired_1"
                                    class="input-check" />
                                {{-- <label class="form-label mb-0 ms-2 " for="passageRequired_1">Is Passage Required</label> --}}
                            </div>
                        </div>
                        <input type="hidden" name="passages" class="passages">
                        <input type="hidden" name="selectedAnswerType" id="selectedAnswerType">

                        <div class="mb-2" id="selectedLayoutQuestion">
                            <div class="choiceOneInFour_Odd"><input type="hidden" name="questionType" id="questionType"
                                    value="choiceOneInFour_Odd">
                                <ul class="answerOptionLsit">
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>A: </span><input
                                                        type="radio" value="a" name="choiceOneInFour"></label>
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
                                        @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', [
                                            'ans_choices' => 'A',
                                            'disp_section' => 'oneInFourOdd_',
                                        ])

                                        <textarea id="choiceOneInFour_OddAnswer_1" name="choiceOneInFourAnswer_1"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer A</label>
                                        <textarea id="choiceOneInFour_Odd_explanation_answer_1" name="choiceOneInFour_explanation_answer_1"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>B: </span><input
                                                    type="radio" value="b" name="choiceOneInFour"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2 ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" 
                                                                placeholder="Guessing Value" 
                                                                min="1" max="100" type="number" 
                                                                oninput="validateInput(this)"
                                                                required
                                                                id="oneInFourOdd_add_guessing_value_B" name="oneInFourOdd_add_guessing_value_B">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFourOdd_add_guessing_valueE_B"></span>
                                                </div>  
                                            </div>
                                        </div>

                                        @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', [
                                            'ans_choices' => 'B',
                                            'disp_section' => 'oneInFourOdd_',
                                        ])

                                        <textarea id="choiceOneInFour_OddAnswer_2" name="choiceOneInFourAnswer_2"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer B</label>
                                        <textarea id="choiceOneInFour_Odd_explanation_answer_2" name="choiceOneInFour_explanation_answer_2"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>C:</span><input
                                                type="radio" value="c" name="choiceOneInFour"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2  ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number add_guessing_value" 
                                                            oninput="validateInput(this)"
                                                            required 
                                                            id="oneInFourOdd_add_guessing_value_C" name="oneInFourOdd_add_guessing_value_C">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFourOdd_add_guessing_valueE_C"></span>
                                                </div>  
                                            </div>
                                        </div>

                                        @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', [
                                            'ans_choices' => 'C',
                                            'disp_section' => 'oneInFourOdd_',
                                        ])

                                        <textarea id="choiceOneInFour_OddAnswer_3" name="choiceOneInFourAnswer_3"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer C</label>
                                        <textarea id="choiceOneInFour_Odd_explanation_answer_3" name="choiceOneInFour_explanation_answer_3"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>D:</span><input
                                                type="radio" value="d" name="choiceOneInFour"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2 ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                             min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required 
                                                            id="oneInFourOdd_add_guessing_value_D" name="oneInFourOdd_add_guessing_value_D">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFourOdd_add_guessing_valueE_D"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', [
                                            'ans_choices' => 'D',
                                            'disp_section' => 'oneInFourOdd_',
                                        ])

                                        <textarea id="choiceOneInFour_OddAnswer_4" name="choiceOneInFourAnswer_4"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer D</label>
                                        <textarea id="choiceOneInFour_Odd_explanation_answer_4" name="choiceOneInFour_explanation_answer_4"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                </ul>
                            </div>

                            {{-- new  --}}
                            <div class="choiceOneInFour_Even"><input type="hidden" name="questionType"
                                    id="questionType" value="choiceOneInFour_Even">
                                <ul class="answerOptionLsit">
                                    <li>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>F: </span><input
                                                type="radio" value="f" name="choiceOneInFour"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2 ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required  
                                                            id="oneInFourEven_add_guessing_value_F" name="oneInFourEven_add_guessing_value_F">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="guessinoneInFourEven_add_guessing_valueE_Fg_valueError"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', [
                                            'ans_choices' => 'F',
                                            'disp_section' => 'oneInFourEven_',
                                        ])

                                        <textarea id="choiceOneInFour_EvenAnswer_1" name="choiceOneInFourAnswer_1"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer F</label>
                                        <textarea id="choiceOneInFour_Even_explanation_answer_1" name="choiceOneInFour_explanation_answer_1"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>G: </span><input
                                                type="radio" value="g" name="choiceOneInFour"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2 rating-tag ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required 
                                                            id="oneInFourEven_add_guessing_value_G" name="oneInFourEven_add_guessing_value_G">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFourEven_add_guessing_valueE_G"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        
                                        @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', [
                                            'ans_choices' => 'G',
                                            'disp_section' => 'oneInFourEven_',
                                        ])

                                        <textarea id="choiceOneInFour_EvenAnswer_2" name="choiceOneInFourAnswer_2"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer G</label>
                                        <textarea id="choiceOneInFour_Even_explanation_answer_2" name="choiceOneInFour_explanation_answer_2"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>H:</span><input
                                                type="radio" value="h" name="choiceOneInFour"></label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="mb-2  ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required  
                                                            id="oneInFourEven_add_guessing_value_H" name="oneInFourEven_add_guessing_value_H">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFourEven_add_guessing_valueE_H"></span>
                                                </div>  
                                            </div>
                                        </div>

                                        @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', [
                                            'ans_choices' => 'H',
                                            'disp_section' => 'oneInFourEven_',
                                        ])

                                        <textarea id="choiceOneInFour_EvenAnswer_3" name="choiceOneInFourAnswer_3"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer H</label>
                                        <textarea id="choiceOneInFour_Even_explanation_answer_3" name="choiceOneInFour_explanation_answer_3"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>J: </span><input
                                                type="radio" value="j" name="choiceOneInFour">
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2 ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required 
                                                            id="oneInFourEven_add_guessing_value_J" name="oneInFourEven_add_guessing_value_J">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFourEven_add_guessing_valueE_J"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        

                                            @include(
                                                'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                                ['ans_choices' => 'J', 'disp_section' => 'oneInFourEven_']
                                            )

                                            <textarea id="choiceOneInFour_EvenAnswer_4" name="choiceOneInFourAnswer_4"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer J</label>
                                        <textarea id="choiceOneInFour_Even_explanation_answer_4" name="choiceOneInFour_explanation_answer_4"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                </ul>
                            </div>

                            <div class="choiceOneInFive_Odd"><input type="hidden" name="questionType" id="questionType"
                                    value="choiceOneInFive_Odd">
                                <ul class="answerOptionLsit">
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>A: </span><input
                                                type="radio" value="a" name="choiceOneInFive"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2  ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required  
                                                            id="oneInFiveOdd_add_guessing_value_A" name="oneInFiveOdd_add_guessing_value_A">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFiveOdd_add_guessing_valueE_A"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        

                                        @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', [
                                            'ans_choices' => 'A',
                                            'disp_section' => 'oneInFiveOdd_',
                                        ])

                                        <textarea id="choiceOneInFive_Odd_Answer_1" name="choiceOneInFiveAnswer_1"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer A</label>
                                        <textarea id="choiceOneInFive_Odd_explanation_answer_odd1" name="choiceOneInFive_explanation_answer_1"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>B:</span><input
                                                type="radio" value="b" name="choiceOneInFive"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2  ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required  
                                                            id="oneInFiveOdd_add_guessing_value_B" name="oneInFiveOdd_add_guessing_value_B">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFiveOdd_add_guessing_valueE_B"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        

                                        @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', [
                                            'ans_choices' => 'B',
                                            'disp_section' => 'oneInFiveOdd_',
                                        ])

                                        <textarea id="choiceOneInFive_Odd_Answer_2" name="choiceOneInFiveAnswer_2"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer B</label>
                                        <textarea id="choiceOneInFive_Odd_explanation_answer_odd2" name="choiceOneInFive_explanation_answer_2"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>C: </span><input
                                                type="radio" value="c" name="choiceOneInFive"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2  ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required  
                                                            id="oneInFiveOdd_add_guessing_value_C" name="oneInFiveOdd_add_guessing_value_C">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFiveOdd_add_guessing_valueE_C"></span>
                                                </div>  
                                            </div>
                                        </div>

                                        @include(
                                            'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                            ['ans_choices' => 'C', 'disp_section' => 'oneInFiveOdd_']
                                        )

                                        <textarea id="choiceOneInFive_Odd_Answer_3" name="choiceOneInFiveAnswer_3"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer C</label>
                                        <textarea id="choiceOneInFive_Odd_explanation_answer_odd3" name="choiceOneInFive_explanation_answer_3"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>D: </span><input
                                                type="radio" value="d" name="choiceOneInFive"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2 ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required  
                                                            id="oneInFiveOdd_add_guessing_value_D" name="oneInFiveOdd_add_guessing_value_D">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFiveOdd_add_guessing_valueE_D"></span>
                                                </div>  
                                            </div>
                                        </div>

                                        @include(
                                            'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                            ['ans_choices' => 'D', 'disp_section' => 'oneInFiveOdd_']
                                        )

                                        <textarea id="choiceOneInFive_Odd_Answer_4" name="choiceOneInFiveAnswer_4"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer D</label>
                                        <textarea id="choiceOneInFive_Odd_explanation_answer_odd4" name="choiceOneInFive_explanation_answer_4"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>E: </span><input
                                                type="radio" value="e" name="choiceOneInFive"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2  ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required  
                                                            id="oneInFiveOdd_add_guessing_value_E" name="oneInFiveOdd_add_guessing_value_E">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFiveOdd_add_guessing_valueE_E"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                            ['ans_choices' => 'E', 'disp_section' => 'oneInFiveOdd_']
                                        )

                                        <textarea id="choiceOneInFive_Odd_Answer_5" name="choiceOneInFiveAnswer_5"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer E</label>
                                        <textarea id="choiceOneInFive_Odd_explanation_answer_odd5" name="choiceOneInFive_explanation_answer_5"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                </ul>
                            </div>

                            {{-- new --}}
                            <div class="choiceOneInFive_Even"><input type="hidden" name="questionType"
                                    id="questionType" value="choiceOneInFive_Even">
                                <ul class="answerOptionLsit">
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>F: </span><input
                                                type="radio" value="f" name="choiceOneInFive"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2 ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required 
                                                            id="oneInFiveEven_add_guessing_value_F" name="oneInFiveEven_add_guessing_value_F">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFiveEven_add_guessing_valueE_F"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                            ['ans_choices' => 'F', 'disp_section' => 'oneInFiveEven_']
                                        )

                                        <textarea id="choiceOneInFive_Even_Answer_1" name="choiceOneInFiveAnswer_1"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer F</label>
                                        <textarea id="choiceOneInFive_Even_explanation_answer_even1" name="choiceOneInFive_explanation_answer_1"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>G:</span><input
                                                type="radio" value="g" name="choiceOneInFive"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2  ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required  
                                                            id="oneInFiveEven_add_guessing_value_G" name="oneInFiveEven_add_guessing_value_G">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFiveEven_add_guessing_valueE_G"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                            ['ans_choices' => 'G', 'disp_section' => 'oneInFiveEven_']
                                        )

                                        <textarea id="choiceOneInFive_Even_Answer_2" name="choiceOneInFiveAnswer_2"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer G</label>
                                        <textarea id="choiceOneInFive_Even_explanation_answer_even2" name="choiceOneInFive_explanation_answer_2"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>H: </span><input
                                                type="radio" value="h" name="choiceOneInFive"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2  ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required 
                                                             id="oneInFiveEven_add_guessing_value_H" name="oneInFiveEven_add_guessing_value_H">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFiveEven_add_guessing_valueE_H"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                            ['ans_choices' => 'H', 'disp_section' => 'oneInFiveEven_']
                                        )

                                        <textarea id="choiceOneInFive_Even_Answer_3" name="choiceOneInFiveAnswer_3"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer H</label>
                                        <textarea id="choiceOneInFive_Even_explanation_answer_even3" name="choiceOneInFive_explanation_answer_3"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>J: </span><input
                                                type="radio" value="j" name="choiceOneInFive"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2  ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" 
                                                            placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required 
                                                             id="oneInFiveEven_add_guessing_value_J" name="oneInFiveEven_add_guessing_value_J">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFiveEven_add_guessing_valueE_J"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                            ['ans_choices' => 'J', 'disp_section' => 'oneInFiveEven_']
                                        )

                                        <textarea id="choiceOneInFive_Even_Answer_4" name="choiceOneInFiveAnswer_4"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer J</label>
                                        <textarea id="choiceOneInFive_Even_explanation_answer_even4" name="choiceOneInFive_explanation_answer_4"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>K: </span><input
                                                type="radio" value="k" name="choiceOneInFive"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2  ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required 
                                                            id="oneInFiveEven_add_guessing_value_K" name="oneInFiveEven_add_guessing_value_K">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFiveEven_add_guessing_valueE_K"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                            ['ans_choices' => 'K', 'disp_section' => 'oneInFiveEven_']
                                        )

                                        <textarea id="choiceOneInFive_Even_Answer_5" name="choiceOneInFiveAnswer_5"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer K</label>
                                        <textarea id="choiceOneInFive_Even_explanation_answer_even5" name="choiceOneInFive_explanation_answer_5"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                </ul>
                            </div>

                            <div class="choiceOneInFourPass_Odd"><input type="hidden" name="questionType"
                                    id="questionType" value="choiceOneInFourPass_Odd">
                                <ul class="answerOptionLsit">
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>A: </span><input
                                                type="radio" value="a" name="choiceOneInFourPass"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2  ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required 
                                                            id="add_guessing_value_A" name="add_guessing_value_A">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="add_guessing_valueE_A"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                            ['ans_choices' => 'A', 'disp_section' => '']
                                        )

                                        <textarea id="choiceOneInFourPass_OddAnswer_1" name="choiceOneInFourPassAnswer_1"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer A</label>
                                        <textarea id="choiceOneInFourPass_Odd_explanation_answer_1" name="choiceOneInFourPass_explanation_answer_1"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>B: </span><input
                                                type="radio" value="b" name="choiceOneInFourPass"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2  ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required 
                                                            id="add_guessing_value_B" name="add_guessing_value_B">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="add_guessing_valueE_B"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                            ['ans_choices' => 'B', 'disp_section' => '']
                                        )

                                        <textarea id="choiceOneInFourPass_OddAnswer_2" name="choiceOneInFourPassAnswer_2"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer B</label>
                                        <textarea id="choiceOneInFourPass_Odd_explanation_answer_2" name="choiceOneInFourPass_explanation_answer_2"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>C: </span><input
                                                type="radio" value="c" name="choiceOneInFourPass"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2  ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required  
                                                            id="add_guessing_value_C" name="add_guessing_value_C">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="add_guessing_valueE_C"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                            ['ans_choices' => 'C', 'disp_section' => '']
                                        )

                                        <textarea id="choiceOneInFourPass_OddAnswer_3" name="choiceOneInFourPassAnswer_3"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer C</label>
                                        <textarea id="choiceOneInFourPass_Odd_explanation_answer_3" name="choiceOneInFourPass_explanation_answer_3"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>D: </span>
                                                <input type="radio" value="d" name="choiceOneInFourPass"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2  ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required 
                                                            id="add_guessing_value_D" name="add_guessing_value_D">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="add_guessing_valueE_D"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                            ['ans_choices' => 'D', 'disp_section' => '']
                                        )

                                        <textarea id="choiceOneInFourPass_OddAnswer_4" name="choiceOneInFourPassAnswer_4"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer D</label>
                                        <textarea id="choiceOneInFourPass_Odd_explanation_answer_4" name="choiceOneInFourPass_explanation_answer_4"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                </ul>
                            </div>

                            {{-- new  --}}
                            <div class="choiceOneInFourPass_Even"><input type="hidden" name="questionType"
                                    id="questionType" value="choiceOneInFourPass_Even">
                                <ul class="answerOptionLsit">
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>F: </span><input
                                                type="radio" value="f" name="choiceOneInFourPass"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2  ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required 
                                                            id="oneInFourPassEven_add_guessing_value_F" name="oneInFourPassEven_add_guessing_value_F">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFourPassEven_add_guessing_valueE_F"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                            ['ans_choices' => 'F', 'disp_section' => 'oneInFourPassEven_']
                                        )

                                        <textarea id="choiceOneInFourPass_EvenAnswer_1" name="choiceOneInFourPassAnswer_1"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer F</label>
                                        <textarea id="choiceOneInFourPass_Even_explanation_answer_1" name="choiceOneInFourPass_explanation_answer_1"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>G: </span><input
                                                type="radio" value="g" name="choiceOneInFourPass"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2  ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required 
                                                            id="oneInFourPassEven_add_guessing_value_G" name="oneInFourPassEven_add_guessing_value_G">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFourPassEven_add_guessing_valueE_G"></span>
                                                </div>  
                                            </div>
                                        </div>

                                        @include(
                                            'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                            ['ans_choices' => 'G', 'disp_section' => 'oneInFourPassEven_']
                                        )

                                        <textarea id="choiceOneInFourPass_EvenAnswer_2" name="choiceOneInFourPassAnswer_2"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer G</label>
                                        <textarea id="choiceOneInFourPass_Even_explanation_answer_2" name="choiceOneInFourPass_explanation_answer_2"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>H: </span><input
                                                type="radio" value="h" name="choiceOneInFourPass"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2  ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required  
                                                            id="oneInFourPassEven_add_guessing_value_H" name="oneInFourPassEven_add_guessing_value_H">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFourPassEven_add_guessing_valueE_H"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                            ['ans_choices' => 'H', 'disp_section' => 'oneInFourPassEven_']
                                        )

                                        <textarea id="choiceOneInFourPass_EvenAnswer_3" name="choiceOneInFourPassAnswer_3"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer H</label>
                                        <textarea id="choiceOneInFourPass_Even_explanation_answer_3" name="choiceOneInFourPass_explanation_answer_3"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>J: </span><input
                                                type="radio" value="j" name="choiceOneInFourPass"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2  ">
                                                    <label class="form-label" for="guessing-value">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                            min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required  
                                                            id="oneInFourPassEven_add_guessing_value_J" name="oneInFourPassEven_add_guessing_value_J">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFourPassEven_add_guessing_valueE_J"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        
                                        @include(
                                            'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                            ['ans_choices' => 'J', 'disp_section' => 'oneInFourPassEven_']
                                        )

                                        <textarea id="choiceOneInFourPass_EvenAnswer_4" name="choiceOneInFourPassAnswer_4"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer J</label>
                                        <textarea id="choiceOneInFourPass_Even_explanation_answer_4" name="choiceOneInFourPass_explanation_answer_4"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                </ul>
                            </div>


                            <div class="choiceMultInFourFill"><input type="hidden" name="questionType"
                                    id="questionType" value="choiceMultInFourFill">

                                <label class="form-label" style="font-size: 13px;">
                                    <select class="switchMulti getFilterChoice" onChange="multiChoice(this.value);">
                                        <option value="">Select Choice</option>
                                        <option value="1">Multi-Choice</option>
                                        <option value="3">Multiple Choice</option>
                                        <option value="2">Fill Choice</option>
                                    </select>
                                    <!--<a href="javascript:;" onClick="multiChoice(1);" class="switchMulti">Multi Choice</a></label><label class="form-label" style="font-size: 13px;"><a href="javascript:;" onClick="multiChoice(2);" class="switchMulti">Fill Choice</a>-->
                                </label>


                                <div class="multi_field" style="display: none">
                                    <ul class="answerOptionLsit">
                                        <li>
                                            <div class="row">
                                                <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>A: </span> <input
                                                    type="checkbox" value="a" name="choiceMultInFourFill[]"></label>
                                                </div>
                                                <div class="col-md-8 for_digital_only">
                                                    <div class="mb-2  ">
                                                        <label class="form-label" for="guessing-value">Guessing Value<span
                                                                class="text-danger">*</span>
                                                                
                                                            <div class="d-flex align-items-center">
                                                                <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                                min="1" max="100" type="number" 
                                                                oninput="validateInput(this)"
                                                                required  
                                                                id="cb_choiceMultInFourFill_add_guessing_value_A" name="cb_choiceMultInFourFill_add_guessing_value_A">
                                                            </div>
                                                        </label>
                                                        <span class="text-danger" id="cb_choiceMultInFourFill_add_guessing_valueE_A"></span>
                                                    </div>  
                                                </div>
                                            </div>
                                            

                                            @include(
                                                'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                                [
                                                    'ans_choices' => 'A',
                                                    'disp_section' => 'cb_choiceMultInFourFill_',
                                                ]
                                            )

                                            <textarea id="choiceMultInFourFillAnswer_1" name="choiceMultInFourFillAnswer_1"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li>
                                            <label class="form-label">Explanation Answer A</label>
                                            <textarea id="choiceMultInFourFill_explanation_answer_1" name="choiceMultInFourFill_explanation_answer_1"
                                                class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="form-label" style="font-size: 13px;"><span>B: </span><input
                                                    type="checkbox" value="b" name="choiceMultInFourFill[]"></label>
                                                </div>
                                                <div class="col-md-8 for_digital_only">
                                                    <div class="mb-2 ">
                                                        <label class="form-label" for="guessing-value">Guessing Value<span
                                                                class="text-danger">*</span>
                                                                
                                                            <div class="d-flex align-items-center">
                                                                <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                                min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required  
                                                                id="cb_choiceMultInFourFill_add_guessing_value_B" name="cb_choiceMultInFourFill_add_guessing_value_B">
                                                            </div>
                                                        </label>
                                                        <span class="text-danger" id="cb_choiceMultInFourFill_add_guessing_valueE_B"></span>
                                                    </div>  
                                                </div>
                                            </div>

                                            @include(
                                                'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                                [
                                                    'ans_choices' => 'B',
                                                    'disp_section' => 'cb_choiceMultInFourFill_',
                                                ]
                                            )

                                            <textarea id="choiceMultInFourFillAnswer_2" name="choiceMultInFourFillAnswer_2"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li>
                                            <label class="form-label">Explanation Answer B</label>
                                            <textarea id="choiceMultInFourFill_explanation_answer_2" name="choiceMultInFourFill_explanation_answer_2"
                                                class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="form-label" style="font-size: 13px;"><span>C: </span><input
                                                    type="checkbox" value="c" name="choiceMultInFourFill[]"></label>
                                                </div>
                                                <div class="col-md-8 for_digital_only">
                                                    <div class="mb-2 ">
                                                        <label class="form-label" for="guessing-value">Guessing Value<span
                                                                class="text-danger">*</span>
                                                                
                                                            <div class="d-flex align-items-center">
                                                                <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                                min="1" max="100" type="number" 
                                                                oninput="validateInput(this)"
                                                                required  
                                                                id="cb_choiceMultInFourFill_add_guessing_value_C" name="cb_choiceMultInFourFill_add_guessing_value_C">
                                                            </div>
                                                        </label>
                                                        <span class="text-danger" id="cb_choiceMultInFourFill_add_guessing_valueE_C"></span>
                                                    </div>  
                                                </div>
                                            </div>
                                            

                                            @include(
                                                'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                                [
                                                    'ans_choices' => 'C',
                                                    'disp_section' => 'cb_choiceMultInFourFill_',
                                                ]
                                            )

                                            <textarea id="choiceMultInFourFillAnswer_3" name="choiceMultInFourFillAnswer_3"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li>
                                            <label class="form-label">Explanation Answer C</label>
                                            <textarea id="choiceMultInFourFill_explanation_answer_3" name="choiceMultInFourFill_explanation_answer_3"
                                                class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="form-label" style="font-size: 13px;"><span>D:</span><input
                                                    type="checkbox" value="d" name="choiceMultInFourFill[]"></label>
                                                </div>
                                                <div class="col-md-8 for_digital_only">
                                                    <div class="mb-2  ">
                                                        <label class="form-label" for="guessing-value">Guessing Value<span
                                                                class="text-danger">*</span>
                                                                
                                                            <div class="d-flex align-items-center">
                                                                <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                                min="1" max="100" type="number" 
                                                                oninput="validateInput(this)"
                                                                required  
                                                                id="cb_choiceMultInFourFill_add_guessing_value_D" name="cb_choiceMultInFourFill_add_guessing_value_D">
                                                            </div>
                                                        </label>
                                                        <span class="text-danger" id="cb_choiceMultInFourFill_add_guessing_valueE_D"></span>
                                                    </div>  
                                                </div>
                                            </div>
                                            

                                            @include(
                                                'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                                [
                                                    'ans_choices' => 'D',
                                                    'disp_section' => 'cb_choiceMultInFourFill_',
                                                ]
                                            )

                                            <textarea id="choiceMultInFourFillAnswer_4" name="choiceMultInFourFillAnswer_4"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li>
                                            <label class="form-label">Explanation Answer D</label>
                                            <textarea id="choiceMultInFourFill_explanation_answer_4" name="choiceMultInFourFill_explanation_answer_4"
                                                class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                        </li>
                                    </ul>
                                </div>
                                <div class="multiChoice_field" style="display: none">
                                    <ul class="answerOptionLsit">
                                        <li>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="form-label" style="font-size: 13px;"><span>A: </span> <input
                                                    type="radio" value="a"
                                                    name="choiceMultiChoiceInFourFill"></label>
                                                </div>
                                                <div class="col-md-8 for_digital_only">
                                                    <div class="mb-2 ">
                                                        <label class="form-label" for="guessing-value">Guessing Value<span
                                                                class="text-danger">*</span>
                                                                
                                                            <div class="d-flex align-items-center">
                                                                <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                                min="1" max="100" type="number" 
                                                                oninput="validateInput(this)"
                                                                required  
                                                                id="choiceMultInFourFill_add_guessing_value_A" name="choiceMultInFourFill_add_guessing_value_A">
                                                            </div>
                                                        </label>
                                                        <span class="text-danger" id="choiceMultInFourFill_add_guessing_valueE_A"></span>
                                                    </div>  
                                                </div>
                                            </div>
                                            

                                            @include(
                                                'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                                ['ans_choices' => 'A', 'disp_section' => 'choiceMultInFourFill_']
                                            )

                                            <textarea id="choiceMultiChoiceInFourFill_1" name="choiceMultiChoiceInFourFill_1"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li>
                                            <label class="form-label">Explanation Answer A</label>
                                            <textarea id="choiceMultiChoiceInFourFill_explanation_answer_1"
                                                name="choiceMultiChoiceInFourFill_explanation_answer_1" class="form-control form-control-lg form-control-alt"
                                                placeholder="add explanation"></textarea>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="form-label" style="font-size: 13px;"><span>B: </span><input
                                                    type="radio" value="b"
                                                    name="choiceMultiChoiceInFourFill"></label>
                                                </div>
                                                <div class="col-md-8 for_digital_only">
                                                    <div class="mb-2  ">
                                                        <label class="form-label" for="guessing-value">Guessing Value<span
                                                                class="text-danger">*</span>
                                                                
                                                            <div class="d-flex align-items-center">
                                                                <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                                min="1" max="100" type="number" 
                                                                oninput="validateInput(this)"
                                                                required 
                                                                id="choiceMultInFourFill_add_guessing_value_B" name="choiceMultInFourFill_add_guessing_value_B">
                                                            </div>
                                                        </label>
                                                        <span class="text-danger" id="choiceMultInFourFill_add_guessing_valueE_B"></span>
                                                    </div>  
                                                </div>
                                            </div>
                                            

                                            @include(
                                                'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                                ['ans_choices' => 'B', 'disp_section' => 'choiceMultInFourFill_']
                                            )

                                            <textarea id="choiceMultiChoiceInFourFill_2" name="choiceMultiChoiceInFourFill_2"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li>
                                            <label class="form-label">Explanation Answer B</label>
                                            <textarea id="choiceMultiChoiceInFourFill_explanation_answer_2"
                                                name="choiceMultiChoiceInFourFill_explanation_answer_2" class="form-control form-control-lg form-control-alt"
                                                placeholder="add explanation"></textarea>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="form-label" style="font-size: 13px;"><span>C: </span><input
                                                    type="radio" value="c"
                                                    name="choiceMultiChoiceInFourFill"></label>
                                                </div>
                                                <div class="col-md-8 for_digital_only">
                                                    <div class="mb-2  ">
                                                        <label class="form-label" for="guessing-value">Guessing Value<span
                                                                class="text-danger">*</span>
                                                                
                                                            <div class="d-flex align-items-center">
                                                                <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                                min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required 
                                                                id="choiceMultInFourFill_add_guessing_value_C" name="choiceMultInFourFill_add_guessing_value_C">
                                                            </div>
                                                        </label>
                                                        <span class="text-danger" id="choiceMultInFourFill_add_guessing_valueE_C"></span>
                                                    </div>  
                                                </div>
                                            </div>
                                            

                                            @include(
                                                'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                                ['ans_choices' => 'C', 'disp_section' => 'choiceMultInFourFill_']
                                            )

                                            <textarea id="choiceMultiChoiceInFourFill_3" name="choiceMultiChoiceInFourFill_3"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li>
                                            <label class="form-label">Explanation Answer C</label>
                                            <textarea id="choiceMultiChoiceInFourFill_explanation_answer_3"
                                                name="choiceMultiChoiceInFourFill_explanation_answer_3" class="form-control form-control-lg form-control-alt"
                                                placeholder="add explanation"></textarea>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="form-label" style="font-size: 13px;"><span>D:</span><input
                                                    type="radio" value="d"
                                                    name="choiceMultiChoiceInFourFill"></label>
                                                </div>
                                                <div class="col-md-8 for_digital_only">
                                                    <div class="mb-2 ">
                                                        <label class="form-label " for="guessing-value">Guessing Value<span
                                                                class="text-danger">*</span>
                                                                
                                                            <div class="d-flex align-items-center">
                                                                <input class="form-control add_guessing_value" placeholder="Guessing Value" 
                                                                min="1" max="100" type="number" 
                                                            oninput="validateInput(this)"
                                                            required 
                                                                id="choiceMultInFourFill_add_guessing_value_D" name="choiceMultInFourFill_add_guessing_value_D">
                                                            </div>
                                                        </label>
                                                        <span class="text-danger" id="choiceMultInFourFill_add_guessing_valueE_D"></span>
                                                    </div>  
                                                </div>
                                            </div>
                                            

                                            @include(
                                                'admin.quiz-management.practicetests.add-sc-ct-qt-block',
                                                ['ans_choices' => 'D', 'disp_section' => 'choiceMultInFourFill_']
                                            )

                                            <textarea id="choiceMultiChoiceInFourFill_4" name="choiceMultiChoiceInFourFill_4"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li>
                                            <label class="form-label">Explanation Answer D</label>
                                            <textarea id="choiceMultiChoiceInFourFill_explanation_answer_4"
                                                name="choiceMultiChoiceInFourFill_explanation_answer_4" class="form-control form-control-lg form-control-alt"
                                                placeholder="add explanation"></textarea>
                                        </li>
                                    </ul>
                                </div>
                                <div class="fill_field" style="display:none">
                                    <div class="mb-2"><label class="form-label" style="font-size: 13px;">Fill
                                            Type:</label><select name="choiceMultInFourFill_filltype"
                                            class="form-control choiceMultInFourFill_filltype">
                                            <option value="">Select Type</option>
                                            <option value="number">Number</option>
                                            <option value="decimal">Decimal</option>
                                            <option value="fraction">Fraction</option>
                                        </select></div>
                                    <div class="mb-2"><label class="form-label"
                                            style="font-size: 13px;">Fill:</label><input type="text"
                                            name="choiceMultInFourFill_fill[]"><label class="form-label extraFillOption"
                                            style="font-size: 13px;"></label><label class="form-label"
                                            style="font-size: 13px;"><a href="javascript:;"
                                                onClick="addMoreFillOption();" class="switchMulti">Add More
                                                Options</a></label></div>

                                    @include('admin.quiz-management.practicetests.add-sc-ct-qt-block', [
                                        'ans_choices' => 'A',
                                        'disp_section' => 'fc_',
                                    ])
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="sectionAddId" value="0" class="sectionAddId">
                    <input type="hidden" name="whichModel" value="question" class="whichModel">
                    <input type="hidden" name="currentModelQueId" value="0" id="currentModelQueId">
                    <input type="hidden" name="questionAddId" value="0" id="questionAddId"
                        class="questionAddId">
                    <button type="button" class="btn btn-primary save_section">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    {{-- start model  --}}
    <div class="modal fade" id="scoreModalMulti" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Score Modal</h5>
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
                    <input type="hidden" class="totalQuestion" value="">
                    <button type="button" class="btn btn-primary save_scores_btn">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end model  --}}

    {{-- start update question modal  --}}
    <div class="modal fade" id="editQuestionMultiModal" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Question</h5>
                    <input type="hidden" name="quesFormat" id="quesFormat">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-2">
                            <label class="form-label validError" style="font-size: 13px; color: red;"></label>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="mb-2 col-md-6 pe-3">
                                <label class="form-label" style="font-size: 13px;">Practice Test Section Type:</label>
                                <input id="edittestSectionTypeRead" readonly name="testSectionTypeRead"
                                    class="form-control">
                            </div>
                            <?php
                            $helper = new Helper();
                            $ratings = $helper->getAllDifficultyRating();
                            ?>
                            {{-- new for the diff rating  --}}
                            <div class="mb-2 col-md-6 pr-3 rating-tag">
                                <label class="form-label" style="font-size: 13px;">Difficulty Rating</label>
                                <select class="js-select2 select diffRating" id="diff_rating_edit"
                                    name="diff_rating_edit" onchange="insertDiffRating(this)" multiple>
                                    @foreach ($ratings['ratings'] as $rating)
                                        <option value="{{ $rating['id'] }}">{{ $rating['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="font-size: 13px;">Question:<span
                                    class="text-danger">*</span></label>
                            <textarea id="js-ckeditor-edit-addQue" name="js-ckeditor-edit-addQue"
                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="update Question"></textarea>
                            <span class="text-danger" id="questionError"></span>
                        </div>

                        <?php
                        $helper = new Helper();
                        $tags = $helper->getAllQuestionTags();
                        ?>
                        <div class="row">
                            <div class=" col-md-4 mb-2 rating-tag ">
                                <label class="form-label" for="tags">Question Tags<span
                                        class="text-danger">*</span></label>
                                <div class="d-flex align-items-center">
                                    <select class="js-select2 select questionTag" id="question_tags_edit"
                                        name="question_tags_edit" onchange="insertQuestionTag(this)" multiple>
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

                        {{-- new for the super category  --}}
                        {{-- <div class="mb-2 rating-tag ">
                            <label class="form-label" for="superCategory">Super Category<span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center">
                                <select class="js-select2 select superCategory" id="super_category_edit" name="super_category_edit" onchange="insertSuperCategory(this)" multiple>

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

                                <div class="col-md-4 mb-2 me-2 rating-tag">
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
                                        <select class="js-select2 select categoryType" id="edit_category_type_0" name="edit_category_type" data-id="0" onchange="insertCategoryType(this)" multiple>
                                        </select>
                                    </div>
                                    <span class="text-danger" id="categoryTypeError"></span>
                                </div>
                                <div class="mb-2 col-md-3 add_question_type_select">
                                    <label for="search-input" class="form-label">Question Type<span class="text-danger">*</span></label>
                                    <div class="d-flex align-items-center">
                                        <select class="js-select2 select questionType" id="edit_search-input_0" name="edit_search-input" data-id="0" onchange="insertQuestionType(this)" multiple>
                                        </select>
                                    </div>
                                    <span class="text-danger" id="questionTypeError"></span>
                                </div>
                                <div class="col-md-1 add-position">
                                    <button class="plus-button edit-plus-button" data-id="1" onclick="addNewTypes(this,'null')"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div> --}}

                        <div class="row passage-container align-items-center">
                            <div class="mb-2 col-md-5">
                                <label for="passage_number" class="form-label">Passage No<span
                                        class="text-danger">*</span></label>
                                <select class="js-select2 select passNumber" id="edit_passage_number"
                                    name="passage_number">
                                    @for ($i = 1; $i < 25; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <span class="text-danger" id="passNumberError"></span>
                            </div>
                            <div class="mb-2 col-md-5">
                                <label class="form-label">Passages<span class="text-danger">*</span></label>
                                <select name="editPassagesType" id="edit_passage_type"
                                    class="form-control editPassagesType js-select2 select"></select>
                                <span class="text-danger" id="passageTypeError"></span>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" id="passageRequired_2" name="passageRequired_2"
                                    class="input-check">
                                {{-- <label class="form-label mb-0 ms-2" for="passageRequired_2">Is Passage Required</label> --}}
                            </div>
                        </div>
                        <input type="hidden" name="editSelectedAnswerType" id="editSelectedAnswerType">
                        <div class="mb-2" id="EditSelectedLayoutQuestion">

                            <div class="choiceOneInFour_Odd">
                                <input type="hidden" name="editQuestionType" id="editQuestionType"
                                    value="choiceOneInFour_Odd">
                                <ul class="answerOptionLsit">
                                    <li class="choiceOneInFour_OddAnswer_0">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>A: </span><input
                                                type="radio" value="a" name="choiceOneInFour"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"
                                                        
                                                        id="oneInFourOdd_edit_guessing_value_A" name="oneInFourOdd_edit_guessing_value_A">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourOdd_edit_guessing_valueE_A"></span>
                                            </div>  
                                        </div>
                                    </div>

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'A', 'disp_section' => 'oneInFourOdd_']
                                        )

                                        <textarea id="editChoiceOneInFour_OddAnswer_1" name="editChoiceOneInFourAnswer_1"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer A</label>
                                        <textarea id="editchoiceOneInFour_Odd_explanation_answer_1" name="editchoiceOneInFour_explanation_answer_1"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFour_OddAnswer_1">
                                    <div class="row">  

                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>B: </span><input
                                                type="radio" value="b" name="choiceOneInFour"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value"
                                                        min="1" max="100" type="number" oninput="validateInput(this)"
                                                         
                                                        id="oneInFourOdd_edit_guessing_value_B" name="oneInFourOdd_edit_guessing_value_B">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourOdd_edit_guessing_valueE_B"></span>
                                            </div>  
                                        </div>
                                        </div>

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'B', 'disp_section' => 'oneInFourOdd_']
                                        )

                                        <textarea id="editChoiceOneInFour_OddAnswer_2" name="editChoiceOneInFourAnswer_2"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer B</label>
                                        <textarea id="editchoiceOneInFour_Odd_explanation_answer_2" name="editchoiceOneInFour_explanation_answer_2"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFour_OddAnswer_2">
                                    <div class="row">  


                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>C:</span><input
                                                type="radio" value="c" name="choiceOneInFour"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value"
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="oneInFourOdd_edit_guessing_value_C" name="oneInFourOdd_edit_guessing_value_C">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourOdd_edit_guessing_valueE_C"></span>
                                            </div>  
                                        </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'C', 'disp_section' => 'oneInFourOdd_']
                                        )

                                        <textarea id="editChoiceOneInFour_OddAnswer_3" name="editChoiceOneInFourAnswer_3"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer C</label>
                                        <textarea id="editchoiceOneInFour_Odd_explanation_answer_3" name="editchoiceOneInFour_explanation_answer_3"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFour_OddAnswer_3">
                                    <div class="row">  

                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>D: </span>
                                                <input type="radio" value="d" name="choiceOneInFour">
                                            </label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value"
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="oneInFourOdd_edit_guessing_value_D" name="oneInFourOdd_edit_guessing_value_D">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourOdd_edit_guessing_valueE_D"></span>
                                            </div>  
                                        </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'D', 'disp_section' => 'oneInFourOdd_']
                                        )

                                        <textarea id="editChoiceOneInFour_OddAnswer_4" name="editChoiceOneInFourAnswer_4"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer D</label>
                                        <textarea id="editchoiceOneInFour_Odd_explanation_answer_4" name="editchoiceOneInFour_explanation_answer_4"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                </ul>
                            </div>

                            {{-- new  --}}
                            <div class="choiceOneInFour_Even">
                                <input type="hidden" name="editQuestionType" id="editQuestionType"
                                    value="choiceOneInFour_Even">
                                <ul class="answerOptionLsit">
                                    <li class="choiceOneInFour_EvenAnswer_0">
                                    <div class="row">  

                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>F: </span><input
                                                type="radio" value="f" name="choiceOneInFour"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="oneInFourEven_edit_guessing_value_F" name="oneInFourEven_edit_guessing_value_F">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourEven_edit_guessing_valueE_F"></span>
                                            </div>  
                                        </div>
                                        </div>
                                        
                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'F', 'disp_section' => 'oneInFourEven_']
                                        )

                                        <textarea id="editChoiceOneInFour_EvenAnswer_1" name="editChoiceOneInFourAnswer_1"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer F</label>
                                        <textarea id="editchoiceOneInFour_Even_explanation_answer_1" name="editchoiceOneInFour_explanation_answer_1"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFour_EvenAnswer_1">
                                    <div class="row">  

                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>G: </span><input
                                                type="radio" value="g" name="choiceOneInFour"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="oneInFourEven_edit_guessing_value_G" name="oneInFourEven_edit_guessing_value_G">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourEven_edit_guessing_valueE_G"></span>
                                            </div>  
                                        </div>
                                        </div>

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'G', 'disp_section' => 'oneInFourEven_']
                                        )

                                        <textarea id="editChoiceOneInFour_EvenAnswer_2" name="editChoiceOneInFourAnswer_2"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer G</label>
                                        <textarea id="editchoiceOneInFour_Even_explanation_answer_2" name="editchoiceOneInFour_explanation_answer_2"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFour_EvenAnswer_2">
                                    <div class="row">  

                                        <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px;"><span>H:</span><input
                                                type="radio" value="h" name="choiceOneInFour"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="oneInFourEven_edit_guessing_value_H" name="oneInFourEven_edit_guessing_value_H">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourEven_edit_guessing_valueE_H"></span>
                                            </div>  
                                        </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'H', 'disp_section' => 'oneInFourEven_']
                                        )

                                        <textarea id="editChoiceOneInFour_EvenAnswer_3" name="editChoiceOneInFourAnswer_3"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer H</label>
                                        <textarea id="editchoiceOneInFour_Even_explanation_answer_3" name="editchoiceOneInFour_explanation_answer_3"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFour_EvenAnswer_3">
                                    <div class="row">  

                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>J: </span><input
                                                type="radio" value="j" name="choiceOneInFour"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="oneInFourEven_edit_guessing_value_J" name="oneInFourEven_edit_guessing_value_J">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourEven_edit_guessing_valueE_J"></span>
                                            </div>  
                                        </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'J', 'disp_section' => 'oneInFourEven_']
                                        )

                                        <textarea id="editChoiceOneInFour_EvenAnswer_4" name="editChoiceOneInFourAnswer_4"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer J</label>
                                        <textarea id="editchoiceOneInFour_Even_explanation_answer_4" name="editchoiceOneInFour_explanation_answer_4"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                </ul>
                            </div>

                            <div class="choiceOneInFive_Odd">
                                <input type="hidden" name="editQuestionType" id="editQuestionType"
                                    value="choiceOneInFive_Odd">
                                <ul class="answerOptionLsit">
                                    <li class="choiceOneInFive_OddAnswer_0">
                                    <div class="row">  

                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>A: </span><input
                                                type="radio" value="a" name="choiceOneInFive"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="oneInFiveOdd_edit_guessing_value_A" name="oneInFiveOdd_edit_guessing_value_A">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveOdd_edit_guessing_valueE_A"></span>
                                            </div>  
                                        </div>
                                        </div>

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'A', 'disp_section' => 'oneInFiveOdd_']
                                        )

                                        <textarea id="editChoiceOneInFive_Odd_Answer_1" name="editChoiceOneInFiveAnswer_1"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer A</label>
                                        <textarea id="editchoiceOneInFive_Odd_explanation_answer_odd1" name="editchoiceOneInFive_explanation_answer_1"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFive_OddAnswer_1">
                                    <div class="row">  

                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>B: </span><input
                                                type="radio" value="b" name="choiceOneInFive"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="oneInFiveOdd_edit_guessing_value_B" name="oneInFiveOdd_edit_guessing_value_B">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveOdd_edit_guessing_valueE_B"></span>
                                            </div>  
                                        </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'B', 'disp_section' => 'oneInFiveOdd_']
                                        )

                                        <textarea id="editChoiceOneInFive_Odd_Answer_2" name="editChoiceOneInFiveAnswer_2"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer B</label>
                                        <textarea id="editchoiceOneInFive_Odd_explanation_answer_odd2" name="editchoiceOneInFive_explanation_answer_2"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFive_OddAnswer_2">
                                    <div class="row">  

                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>C:</span><input
                                                type="radio" value="c" name="choiceOneInFive"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="oneInFiveOdd_edit_guessing_value_C" name="oneInFiveOdd_edit_guessing_value_C">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveOdd_edit_guessing_valueE_C"></span>
                                            </div>  
                                        </div>
                                        </div>


                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'C', 'disp_section' => 'oneInFiveOdd_']
                                        )

                                        <textarea id="editChoiceOneInFive_Odd_Answer_3" name="editChoiceOneInFiveAnswer_3"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer C</label>
                                        <textarea id="editchoiceOneInFive_Odd_explanation_answer_odd3" name="editchoiceOneInFive_explanation_answer_3"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFive_OddAnswer_3">
                                    <div class="row">  

                                        <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px;"><span>D: </span><input
                                                type="radio" value="d" name="choiceOneInFive"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="oneInFiveOdd_edit_guessing_value_D" name="oneInFiveOdd_edit_guessing_value_D">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveOdd_edit_guessing_valueE_D"></span>
                                            </div>  
                                        </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'D', 'disp_section' => 'oneInFiveOdd_']
                                        )

                                        <textarea id="editChoiceOneInFive_Odd_Answer_4" name="editChoiceOneInFiveAnswer_4"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer D</label>
                                        <textarea id="editchoiceOneInFive_Odd_explanation_answer_odd4" name="editchoiceOneInFive_explanation_answer_4"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFive_OddAnswer_4">
                                    <div class="row">  

                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>E: </span><input
                                                type="radio" value="e" name="choiceOneInFive"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="oneInFiveOdd_edit_guessing_value_E" name="oneInFiveOdd_edit_guessing_value_E">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveOdd_edit_guessing_valueE_E"></span>
                                            </div>  
                                        </div>
                                        </div>

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'E', 'disp_section' => 'oneInFiveOdd_']
                                        )

                                        <textarea id="editChoiceOneInFive_Odd_Answer_5" name="editChoiceOneInFiveAnswer_5"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer E</label>
                                        <textarea id="editchoiceOneInFive_Odd_explanation_answer_odd5" name="editchoiceOneInFive_explanation_answer_5"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                </ul>
                            </div>

                            {{-- new  --}}
                            <div class="choiceOneInFive_Even">
                                <input type="hidden" name="editQuestionType" id="editQuestionType"
                                    value="choiceOneInFive_Even">
                                <ul class="answerOptionLsit">
                                    <li class="choiceOneInFive_EvenAnswer_0">
                                    <div class="row">  

                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>F: </span><input
                                                type="radio" value="f" name="choiceOneInFive"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="oneInFiveEven_edit_guessing_value_F" name="oneInFiveEven_edit_guessing_value_F">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveEven_edit_guessing_valueE_F"></span>
                                            </div>  
                                        </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'F', 'disp_section' => 'oneInFiveEven_']
                                        )

                                        <textarea id="editChoiceOneInFive_Even_Answer_1" name="editChoiceOneInFiveAnswer_1"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer F</label>
                                        <textarea id="editchoiceOneInFive_Even_explanation_answer_even1" name="editchoiceOneInFive_explanation_answer_1"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFive_EvenAnswer_1">
                                        <div class="row">  

                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>G: </span><input
                                                type="radio" value="g" name="choiceOneInFive"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="oneInFiveEven_edit_guessing_value_G" name="oneInFiveEven_edit_guessing_value_G">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveEven_edit_guessing_valueE_G"></span>
                                            </div>  
                                        </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'G', 'disp_section' => 'oneInFiveEven_']
                                        )

                                        <textarea id="editChoiceOneInFive_Even_Answer_2" name="editChoiceOneInFiveAnswer_2"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer G</label>
                                        <textarea id="editchoiceOneInFive_Even_explanation_answer_even2" name="editchoiceOneInFive_explanation_answer_2"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFive_EvenAnswer_2">
                                    <div class="row">  


                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>H:</span><input
                                                type="radio" value="h" name="choiceOneInFive"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="oneInFiveEven_edit_guessing_value_H" name="oneInFiveEven_edit_guessing_value_H">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveEven_edit_guessing_valueE_H"></span>
                                            </div>  
                                        </div>
                                        </div>

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'H', 'disp_section' => 'oneInFiveEven_']
                                        )

                                        <textarea id="editChoiceOneInFive_Even_Answer_3" name="editChoiceOneInFiveAnswer_3"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer H</label>
                                        <textarea id="editchoiceOneInFive_Even_explanation_answer_even3" name="editchoiceOneInFive_explanation_answer_3"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFive_EvenAnswer_3">
                                        <div class="row">  
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>J: </span><input
                                                type="radio" value="j" name="choiceOneInFive"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"
                                                        
                                                        id="oneInFiveEven_edit_guessing_value_J" name="oneInFiveEven_edit_guessing_value_J">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveEven_edit_guessing_valueE_J"></span>
                                            </div>  
                                        </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'J', 'disp_section' => 'oneInFiveEven_']
                                        )

                                        <textarea id="editChoiceOneInFive_Even_Answer_4" name="editChoiceOneInFiveAnswer_4"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer J</label>
                                        <textarea id="editchoiceOneInFive_Even_explanation_answer_even4" name="editchoiceOneInFive_explanation_answer_4"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFive_EvenAnswer_4">
                                        <div class="row">  
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>K: </span><input
                                                type="radio" value="k" name="choiceOneInFive"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"
                                                        
                                                        id="oneInFiveEven_edit_guessing_value_K" name="oneInFiveEven_edit_guessing_value_K">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFiveEven_edit_guessing_valueE_K"></span>
                                            </div>  
                                        </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'K', 'disp_section' => 'oneInFiveEven_']
                                        )

                                        <textarea id="editChoiceOneInFive_Even_Answer_5" name="editChoiceOneInFiveAnswer_5"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer K</label>
                                        <textarea id="editchoiceOneInFive_Even_explanation_answer_even5" name="editchoiceOneInFive_explanation_answer_5"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                </ul>
                            </div>

                            <div class="choiceOneInFourPass_Odd">
                                <input type="hidden" name="editQuestionType" id="editQuestionType"
                                    value="choiceOneInFourPass_Odd">
                                <ul class="answerOptionLsit">
                                    <li class="choiceOneInFourPass_OddAnswer_0">
                                        <div class="row">  
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>A: </span><input
                                                type="radio" value="a" name="choiceOneInFourPass"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="edit_guessing_value_A" name="edit_guessing_value_A">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="edit_guessing_valueE_A"></span>
                                            </div>  
                                        </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'A', 'disp_section' => '']
                                        )

                                        <textarea id="editChoiceOneInFourPass_OddAnswer_1" name="editChoiceOneInFourPassAnswer_1"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer A</label>
                                        <textarea id="editchoiceOneInFourPass_Odd_explanation_answer_1" name="editchoiceOneInFourPass_explanation_answer_1"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFourPass_OddAnswer_1">
                                        <div class="row">     
                                        <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>B: </span><input
                                                type="radio" value="b" name="choiceOneInFourPass"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="edit_guessing_value_B" name="edit_guessing_value_B">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="edit_guessing_valueE_B"></span>
                                            </div>  
                                        </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'B', 'disp_section' => '']
                                        )

                                        <textarea id="editChoiceOneInFourPass_OddAnswer_2" name="editChoiceOneInFourPassAnswer_2"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer B</label>
                                        <textarea id="editchoiceOneInFourPass_Odd_explanation_answer_2" name="editchoiceOneInFourPass_explanation_answer_2"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFourPass_OddAnswer_2">
                                    <div class="row">      
                                    <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>C: </span><input
                                                type="radio" value="c" name="choiceOneInFourPass"></label>  
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="edit_guessing_value_C" name="edit_guessing_value_C">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="edit_guessing_valueE_C"></span>
                                            </div>  
                                        </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'C', 'disp_section' => '']
                                        )

                                        <textarea id="editChoiceOneInFourPass_OddAnswer_3" name="editChoiceOneInFourPassAnswer_3"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer c</label>
                                        <textarea id="editchoiceOneInFourPass_Odd_explanation_answer_3" name="editchoiceOneInFourPass_explanation_answer_3"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFourPass_OddAnswer_3">
                                    <div class="row">        
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px;"><span>D: </span><input
                                                type="radio" value="d" name="choiceOneInFourPass"></label>  
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="edit_guessing_value_D" name="edit_guessing_value_D">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="edit_guessing_valueE_D"></span>
                                            </div>  
                                        </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'D', 'disp_section' => '']
                                        )

                                        <textarea id="editChoiceOneInFourPass_OddAnswer_4" name="editChoiceOneInFourPassAnswer_4"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
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
                                <input type="hidden" name="editQuestionType" id="editQuestionType"
                                    value="choiceOneInFourPass_Even">
                                <ul class="answerOptionLsit">
                                    <li class="choiceOneInFourPass_EvenAnswer_0">
                                    <div class="row">    
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px;"><span>F: </span><input
                                                type="radio" value="f" name="choiceOneInFourPass"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="oneInFourPassEven_edit_guessing_value_F" name="oneInFourPassEven_edit_guessing_value_F">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourPassEven_edit_guessing_valueE_F"></span>
                                            </div>  
                                        </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'F', 'disp_section' => 'oneInFourPassEven_']
                                        )

                                        <textarea id="editChoiceOneInFourPass_EvenAnswer_1" name="editChoiceOneInFourPassAnswer_1"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer F</label>
                                        <textarea id="editchoiceOneInFourPass_Even_explanation_answer_1" name="editchoiceOneInFourPass_explanation_answer_1"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFourPass_EvenAnswer_1">
                                        <div class="row">
                                            <div class="col-md-4">
                                            <label class="form-label" style="font-size: 13px;"><span>G: </span><input
                                                    type="radio" value="g" name="choiceOneInFourPass"></label>
                                            </div>
                                            <div class="col-md-8 for_digital_only">
                                                <div class="mb-2 ">
                                                    <label class="form-label" for="guessingValueError">Guessing Value<span
                                                            class="text-danger">*</span>
                                                            
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-control edit_guessing_value" 
                                                            placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                            id="oneInFourPassEven_edit_guessing_value_G" name="oneInFourPassEven_edit_guessing_value_G">
                                                        </div>
                                                    </label>
                                                    <span class="text-danger" id="oneInFourPassEven_edit_guessing_valueE_G"></span>
                                                </div>  
                                            </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'G', 'disp_section' => 'oneInFourPassEven_']
                                        )

                                        <textarea id="editChoiceOneInFourPass_EvenAnswer_2" name="editChoiceOneInFourPassAnswer_2"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer G</label>
                                        <textarea id="editchoiceOneInFourPass_Even_explanation_answer_2" name="editchoiceOneInFourPass_explanation_answer_2"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFourPass_EvenAnswer_2">
                                    <div class="row">
                                        <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px;"><span>H: </span><input
                                                type="radio" value="h" name="choiceOneInFourPass"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="oneInFourPassEven_edit_guessing_value_H" name="oneInFourPassEven_edit_guessing_value_H">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourPassEven_edit_guessing_valueE_H"></span>
                                            </div>  
                                        </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'H', 'disp_section' => 'oneInFourPassEven_']
                                        )

                                        <textarea id="editChoiceOneInFourPass_EvenAnswer_3" name="editChoiceOneInFourPassAnswer_3"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer H</label>
                                        <textarea id="editchoiceOneInFourPass_Even_explanation_answer_3" name="editchoiceOneInFourPass_explanation_answer_3"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                    <li class="choiceOneInFourPass_EvenAnswer_3 ">
                                    <div class="row">
                                        <div class="col-md-4">
                                        <label class="form-label" style="font-size: 13px;"><span>J: </span><input
                                                type="radio" value="j" name="choiceOneInFourPass"></label>
                                        </div>
                                        <div class="col-md-8 for_digital_only">
                                            <div class="mb-2 ">
                                                <label class="form-label" for="guessingValueError">Guessing Value<span
                                                        class="text-danger">*</span>
                                                        
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control edit_guessing_value" 
                                                        placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                        id="oneInFourPassEven_edit_guessing_value_J" name="oneInFourPassEven_edit_guessing_value_J">
                                                    </div>
                                                </label>
                                                <span class="text-danger" id="oneInFourPassEven_edit_guessing_valueE_J"></span>
                                            </div>  
                                        </div>
                                        </div>
                                        

                                        @include(
                                            'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                            ['ans_choices' => 'J', 'disp_section' => 'oneInFourPassEven_']
                                        )

                                        <textarea id="editChoiceOneInFourPass_EvenAnswer_4" name="editChoiceOneInFourPassAnswer_4"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li>
                                        <label class="form-label">Explanation Answer J</label>
                                        <textarea id="editchoiceOneInFourPass_Even_explanation_answer_4" name="editchoiceOneInFourPass_explanation_answer_4"
                                            class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                    </li>
                                </ul>
                            </div>

                            <div class="choiceMultInFourFill">
                                <input type="hidden" name="editQuestionType" id="editQuestionType"
                                    value="choiceMultInFourFill">

                                <label class="form-label">
                                    <select class="switchMulti editMultipleChoice"
                                        onChange="editMultiChoice(this.value);">
                                        <option value="1">Multi-Choice</option>
                                        <option value="3">Multiple Choice</option>
                                        <option value="2">Fill Choice</option>
                                    </select>
                                    <!--<a href="javascript:;" onClick="editMultiChoice(1);" class="switchMulti">Multi Choice</a>
                                                                                                                                                                                </label>
                                                                                                                                                                                <label class="form-label" style="font-size: 13px;">
                                                                                                                                                                                    <a href="javascript:;" onClick="editMultiChoice(2);" class="switchMulti">Fill Choice</a>-->
                                </label>

                                <div class="multi_field withOutFillOpt" style="display: none">
                                    <ul class="answerOptionLsit">
                                        <li class="choiceMultInFourFillwithOutFillOptAnswer_0">
                                            
                                            <div class="row">
                                                <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>A: </span> <input
                                                    type="checkbox" value="a"
                                                    name="choiceMultInFourFill[]"></label>
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

                                            @include(
                                                'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                                [
                                                    'ans_choices' => 'A',
                                                    'disp_section' => 'cb_choiceMultInFourFill_',
                                                ]
                                            )

                                            <textarea id="editChoiceMultInFourFillAnswer_1" name="editChoiceMultInFourFillAnswer_1"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li>
                                            <label class="form-label">Explanation Answer A</label>
                                            <textarea id="editchoiceMultInFourFill_explanation_answer_1" name="editchoiceMultInFourFill_explanation_answer_1"
                                                class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                        </li>
                                        <li class="choiceMultInFourFillwithOutFillOptAnswer_1">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="form-label" style="font-size: 13px;"><span>B: </span><input
                                                    type="checkbox" value="b"
                                                    name="choiceMultInFourFill[]"></label>
                                                </div>
                                                <div class="col-md-8 for_digital_only">
                                                    <div class="mb-2 ">
                                                        <label class="form-label" for="guessingValueError">Guessing Value<span
                                                                class="text-danger">*</span>
                                                                
                                                            <div class="d-flex align-items-center">
                                                                <input class="form-control edit_guessing_value" 
                                                                placeholder="Guessing Value" 
                                                        min="1" max="100" type="number" oninput="validateInput(this)"

                                                                id="cb_choiceMultInFourFill_edit_guessing_value_B" name="cb_choiceMultInFourFill_edit_guessing_value_B">
                                                            </div>
                                                        </label>
                                                        <span class="text-danger" id="cb_choiceMultInFourFill_edit_guessing_valueE_B"></span>
                                                    </div>  
                                                </div>
                                            </div>
                                            
                                            @include(
                                                'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                                [
                                                    'ans_choices' => 'B',
                                                    'disp_section' => 'cb_choiceMultInFourFill_',
                                                ]
                                            )

                                            <textarea id="editChoiceMultInFourFillAnswer_2" name="editChoiceMultInFourFillAnswer_2"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li>
                                            <label class="form-label">Explanation Answer B</label>
                                            <textarea id="editchoiceMultInFourFill_explanation_answer_2" name="editchoiceMultInFourFill_explanation_answer_2"
                                                class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                        </li>
                                        <li class="choiceMultInFourFillwithOutFillOptAnswer_2">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="form-label" style="font-size: 13px;"><span>C: </span><input
                                                    type="checkbox" value="c"
                                                    name="choiceMultInFourFill[]"></label>
                                                </div>
                                                <div class="col-md-8 for_digital_only">
                                                    <div class="mb-2 ">
                                                        <label class="form-label" for="guessingValueError">Guessing Value<span
                                                                class="text-danger">*</span>
                                                                
                                                            <div class="d-flex align-items-center">
                                                                <input class="form-control edit_guessing_value" 
                                                                placeholder="Guessing Value" min="1" max="100" type="number" oninput="validateInput(this)"
                                                                id="cb_choiceMultInFourFill_edit_guessing_value_C" name="cb_choiceMultInFourFill_edit_guessing_value_C">
                                                            </div>
                                                        </label>
                                                        <span class="text-danger" id="cb_choiceMultInFourFill_edit_guessing_valueE_C"></span>
                                                    </div>  
                                                </div>
                                            </div>
                                            

                                            @include(
                                                'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                                [
                                                    'ans_choices' => 'C',
                                                    'disp_section' => 'cb_choiceMultInFourFill_',
                                                ]
                                            )

                                            <textarea id="editChoiceMultInFourFillAnswer_3" name="editChoiceMultInFourFillAnswer_3"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li>
                                            <label class="form-label">Explanation Answer C</label>
                                            <textarea id="editchoiceMultInFourFill_explanation_answer_3" name="editchoiceMultInFourFill_explanation_answer_3"
                                                class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                        </li>
                                        <li class="choiceMultInFourFillwithOutFillOptAnswer_3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>D:</span><input
                                                    type="checkbox" value="d"
                                                    name="choiceMultInFourFill[]"></label>
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
                                            

                                            @include(
                                                'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                                [
                                                    'ans_choices' => 'D',
                                                    'disp_section' => 'cb_choiceMultInFourFill_',
                                                ]
                                            )

                                            <textarea id="editChoiceMultInFourFillAnswer_4" name="editChoiceMultInFourFillAnswer_4"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
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
                                        <li class="choiceMultInFourFillwithOutFillOptChoiceAnswer_0">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="form-label" style="font-size: 13px;"><span>A: </span> <input
                                                    type="radio" value="a"
                                                    name="editChoiceMultiChoiceInFourFill"></label>
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
                                            
                                            @include(
                                                'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                                ['ans_choices' => 'A', 'disp_section' => 'choiceMultInFourFill_']
                                            )

                                            <textarea id="editChoiceMultiChoiceInFourFill_1" name="editChoiceMultiChoiceInFourFill_1"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li>
                                            <label class="form-label">Explanation Answer A</label>
                                            <textarea id="editchoiceMultiChoiceInFourFill_explanation_answer_1"
                                                name="editchoiceMultiChoiceInFourFill_explanation_answer_1"
                                                class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                        </li>
                                        <li class="choiceMultInFourFillwithOutFillOptChoiceAnswer_1">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="form-label" style="font-size: 13px;"><span>B: </span><input
                                                    type="radio" value="b"
                                                    name="editChoiceMultiChoiceInFourFill"></label>
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
                                            

                                            @include(
                                                'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                                ['ans_choices' => 'B', 'disp_section' => 'choiceMultInFourFill_']
                                            )

                                            <textarea id="editChoiceMultiChoiceInFourFill_2" name="editChoiceMultiChoiceInFourFill_2"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li>
                                            <label class="form-label">Explanation Answer B</label>
                                            <textarea id="editchoiceMultiChoiceInFourFill_explanation_answer_2"
                                                name="editchoiceMultiChoiceInFourFill_explanation_answer_2"
                                                class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                        </li>
                                        <li class="choiceMultInFourFillwithOutFillOptChoiceAnswer_2">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>C: </span><input
                                                    type="radio" value="c"
                                                    name="editChoiceMultiChoiceInFourFill"></label>
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

                                            @include(
                                                'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                                ['ans_choices' => 'C', 'disp_section' => 'choiceMultInFourFill_']
                                            )

                                            <textarea id="editChoiceMultiChoiceInFourFill_3" name="editChoiceMultiChoiceInFourFill_3"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li>
                                            <label class="form-label">Explanation Answer C</label>
                                            <textarea id="editchoiceMultiChoiceInFourFill_explanation_answer_3"
                                                name="editchoiceMultiChoiceInFourFill_explanation_answer_3"
                                                class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                        </li>
                                        <li class="choiceMultInFourFillwithOutFillOptChoiceAnswer_3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label" style="font-size: 13px;"><span>D:</span><input
                                                    type="radio" value="d"
                                                    name="editChoiceMultiChoiceInFourFill"></label>
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
                                            

                                            @include(
                                                'admin.quiz-management.practicetests.edit-sc-ct-qt-block',
                                                ['ans_choices' => 'D', 'disp_section' => 'choiceMultInFourFill_']
                                            )

                                            <textarea id="editChoiceMultiChoiceInFourFill_4" name="editChoiceMultiChoiceInFourFill_4"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li>
                                            <label class="form-label">Explanation Answer D</label>
                                            <textarea id="editchoiceMultiChoiceInFourFill_explanation_answer_4"
                                                name="editchoiceMultiChoiceInFourFill_explanation_answer_4"
                                                class="form-control form-control-lg form-control-alt" placeholder="add explanation"></textarea>
                                        </li>
                                    </ul>
                                </div>
                                <div class="fill_field withFillOpt " style="display:none">
                                    <div class="withFillOptmb-2">
                                    <div class="mb-2">
                                        <label class="form-label" style="font-size: 13px;">Fill Type:</label><select
                                            name="addChoiceMultInFourFill_filltype"
                                            class="form-control addChoiceMultInFourFill_filltype">
                                            <option value="">Select Type</option>
                                            <option value="number">Number</option>
                                            <option value="decimal">Decimal</option>
                                            <option value="fraction">Fraction</option>
                                        </select>
                                    </div>
                                    <div class="mb-2"><label class="form-label"
                                            style="font-size: 13px;">Fill:</label><input type="text"
                                            name="addChoiceMultInFourFill_fill[]"><label
                                            class="form-label extraFillOption" style="font-size: 13px;"></label><label
                                            class="form-label" style="font-size: 13px;"><a href="javascript:;"
                                                onClick="addMoreFillOption();" class="switchMulti">Add More
                                                Options</a></label>
                                    </div>
                                    </div>

                                    @include('admin.quiz-management.practicetests.edit-sc-ct-qt-block', [
                                        'ans_choices' => 'A',
                                        'disp_section' => 'fc_',
                                    ])
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="editQuestionOrder" value="0" id="editQuestionOrder">
                    <input type="hidden" name="editCurrentModelQueId" value="0" id="editCurrentModelQueId">
                    <input type="hidden" name="sectionAddId" value="0" class="sectionAddId">
                    <button type="button" class="btn btn-primary update_question_section">Update changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->


    <div class="modal fade" id="dragModal" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Section list Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="listWithHandle" class="list-group">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveOrder()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <div class="modal fade" id="dragModalQuestion" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Question list Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="listWithHandleQuestion" class="list-group">

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

    <script src="{{ asset('assets/js/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/Sortable.js') }}"></script>
    <script src="{{ asset('js/tagify.min.js') }}"></script>
    <script src="{{ asset('js/tagify.polyfills.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/admin/course.js') }}"></script>

    <script>
        let is_edit = false;

        var questionCount = 1;
        var questionOrder = 0;
        var sectionOrder = 0;
        var newSectionOrder = 0;

        var preGetPracticeCategoryType = "";
        var preGetPracticeQuestionType = "";
        var preGetSuperCategory = "";

        $('.for_digital_only').hide();

        $("#passageRequired_1").click(function() { 
            if ($(this).is(":checked")) {
                $("#passage_number").prop("disabled", false);
                $("select[name='passagesType']").prop("disabled", false);
            } else {
                $("#passage_number").prop("disabled", true);
                $("select[name='passagesType']").prop("disabled", true);
            }
        });

        $("#passageRequired_2").click(function() {
            if ($(this).is(":checked")) {
                $("#edit_passage_number").prop("disabled", false);
                $("select[name='editPassagesType']").prop("disabled", false);
            } else {
                $("#edit_passage_number").prop("disabled", true);
                $("select[name='editPassagesType']").prop("disabled", true);
            }
        });

        function insertSuperCategory(data) {
            // console.log(data);
            let super_category_type = $(data).val();
            super_category_type = super_category_type.join(" ");
            let section_type = $('#section_type').val();
            let format = $('#format').val();
            if (super_category_type != '' && !containsOnlyNumbers(super_category_type)) {
                $.ajax({
                    type: 'post',
                    url: '{{ route('addSuperCategory') }}',
                    data: {
                        searchValue: super_category_type,
                        format: format,
                        section_type: section_type,
                        '_token': $('input[name="_token"]').val()
                    },
                    success: function(res) {
                        if (res.success) {
                            $(".superCategory").append('<option value=' + res.id + '>' + res
                                .super_category_title + '</option>');
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
            //     super_category = $('#editQuestionMultiModal select[name="super_category_edit"]').val();
            // } else {
            //     super_category = $('#questionMultiModal select[name="super_category_create"]').val();
            // }
            let closestSuperCategory = $(data).closest('.category-custom').prev('.rating-tag').find('select.superCategory');
            if (closestSuperCategory.length > 0) {
                super_category = closestSuperCategory.val();
            }
            if (category_type != '' && !containsOnlyNumbers(category_type)) {
                $.ajax({
                    type: 'post',
                    url: '{{ route('addPracticeCategoryType') }}',
                    data: {
                        searchValue: category_type,
                        format: format,
                        section_type: section_type,
                        super_category: super_category,
                        '_token': $('input[name="_token"]').val()
                    },
                    success: function(res) {
                        if (res.success) {
                            $(".categoryType").append('<option value=' + res.id + '>' + res
                                .category_type_title + '</option>');
                        }
                    }
                });
            }
        }

        function insertDiffRating(data) {
            let diff_rating = $(data).val();
            if (diff_rating != '' && !containsOnlyNumbers(diff_rating)) {
                $.ajax({
                    type: 'post',
                    url: '{{ route('addDiffRating') }}',
                    data: {
                        searchValue: diff_rating,
                        '_token': $('input[name="_token"]').val()
                    },
                    success: function(res) {
                        if (res.success) {
                            $(".diffRating").append('<option value=' + res.id + '>' + res.diff_rating_title +
                                '</option>');
                        }
                    }
                });
            }
        }

        function insertQuestionTag(data) {
            let question_tag = $(data).val();
            let format = $('#format').val();
            if (question_tag != '' && !containsOnlyNumbers(question_tag)) {
                $.ajax({
                    type: 'post',
                    url: '{{ route('addQuestionTag') }}',
                    data: {
                        searchValue: question_tag,
                        format: format,
                        '_token': $('input[name="_token"]').val()
                    },
                    success: function(res) {
                        if (res.success) {
                            $(".questionTag").append('<option value=' + res.id + '>' + res.question_tag +
                                '</option>');
                        }
                    }
                });
            }
        }

        function containsOnlyNumbers(str) {
            return /^\d+$/.test(str);
        }

        function insertQuestionType(data) {
            let question_type = $(data).val();
            question_type = question_type.join(" ");
            let section_type = $('#section_type').val();
            let format = $('#format').val();
            let id = $(data).attr('data-id');
            let super_category = '';
            let category = '';

            super_category = $(data).closest('.add_question_type_select').siblings('.rating-tag').find(
                'select.superCategory').first().val();
            category = $(data).closest('.add_question_type_select').siblings('.category-custom').find('select.categoryType')
                .first().val();
            if (question_type != '' && !containsOnlyNumbers(question_type)) {
                $.ajax({
                    type: 'post',
                    url: '{{ route('addPracticeQuestionType') }}',
                    data: {
                        searchValue: question_type,
                        format: format,
                        section_type: section_type,
                        super_category: super_category,
                        category: category,
                        '_token': $('input[name="_token"]').val()
                    },
                    success: function(res) {
                        if (res.success) {
                            $(".questionType").append('<option value=' + res.id + '>' + res
                                .question_type_title + '</option>');
                        }
                    }
                });
            }
        }

        //start new function for edit
        async function addNewTypes(ans_col, data, type, disp_option = '', super_cat_option = '', cat_type_option = '',
            question_type_option = '') {
            let key = null;
            if (type != 'null' && type == 'repet') {
                key = parseInt(data);
            } else {
                key = $(data).attr(`${disp_option}data-id-${ans_col}`);
                key = parseInt(key);

                let super_category = $(`#${disp_option}edit_super_category_${ans_col}_${key - 1}`).val();
                let category_type  = $(`#${disp_option}edit_category_type_${ans_col}_${key - 1}`).val();
                let question_type  = $(`#${disp_option}edit_search-input_${ans_col}_${key - 1}`).val();

                if (super_category == '') {
                    toastr.error('Please select a Super Category!');
                    return false;
                }

                if (category_type == '') {
                    toastr.error('Please select a category type!');
                    return false;
                }

                if (question_type == '') {
                    toastr.error('Please select a question type!');
                    return false;
                }
            }

            let testType = $('#format').val();
            if (super_cat_option == '') {
                super_cat_option = await dropdown_lists(`/admin/getSuperCategory?testType=${testType}`);
            }
            if (cat_type_option == '') {
                cat_type_option = await dropdown_lists(`/admin/getPracticeCategoryType?testType=${testType}`);
            }
            if (question_type_option == '') {
                question_type_option = await dropdown_lists(`/admin/getPracticeQuestionType?testType=${testType}`);
            }

            let html = ``;
            html += `<div class="d-flex input-field align-items-center removeNewTypes">`;

            html += `<div class="col-md-2 align-self-start">`;
            html +=
                `<input type="checkbox" name="${disp_option}edit_ct_checkbox_${ans_col}" id="${disp_option}edit_ct_checkbox_${ans_col}_${key}">`;
            html += `</div>`;

            html += `<div class="col-md-3 mb-2 me-2 rating-tag">`;
            html += `<div class="d-flex align-items-center">`;
            html +=
                `<select class="js-select2 select superCategory" id="${disp_option}edit_super_category_${ans_col}_${key}" name="${disp_option}edit_super_category_${ans_col}" onchange="insertSuperCategory(this)" multiple>`;
            // html += preGetSuperCategory;

            html += super_cat_option;
            html += `</select>`;
            html += `</div>`;
            html += `</div>`;

            html += `<div class="mb-2 col-md-3 me-2 category-custom">`;
            html += `<div class="d-flex align-items-center">`;
            html +=
                `<select class="js-select2 select categoryType" id="${disp_option}edit_category_type_${ans_col}_${key}" name="${disp_option}edit_category_type_${ans_col}" data-id="${key}" onchange="insertCategoryType(this)" multiple>`;
            // html += preGetPracticeCategoryType;

            html += cat_type_option;
            html += `</select>`;
            html += `</div>`;
            html += `</div>`;
            html += `<div class="mb-2 col-md-3 add_question_type_select">`;
            html += `<div class="d-flex align-items-center">`;
            html +=
                `<select class="js-select2 select questionType" id="${disp_option}edit_search-input_${ans_col}_${key}" name="${disp_option}edit_search-input_${ans_col}" data-id="${key}" onchange="insertQuestionType(this)" multiple>`;
            // html += preGetPracticeQuestionType;

            html += question_type_option;
            html += `</select>`;
            html += `</div>`;
            html += `</div>`;
            html += `<div class="col-md-1 add-minus-icon">`;
            html +=
                `<button class="plus-button" onclick="removeNewTypes(this)"><i class="fa-solid fa-minus"></i></button>`;
            html += `</div>`;
            html += `</div>`;

            $(`#${disp_option}addNewTypes_${ans_col}`).append(html);

            $(`#${disp_option}edit_search-input_${ans_col}_${key}`).select2({
                dropdownParent: $('#editQuestionMultiModal'),
                tags: true,
                placeholder: "Select Question type",
                maximumSelectionLength: 1
            });

            $(`#${disp_option}edit_super_category_${ans_col}_${key}`).select2({
                dropdownParent: $('#editQuestionMultiModal'),
                tags: true,
                placeholder: "Select Super Category",
                maximumSelectionLength: 1
            });

            $(`#${disp_option}edit_category_type_${ans_col}_${key}`).select2({
                dropdownParent: $('#editQuestionMultiModal'),
                tags: true,
                placeholder: "Select Category type",
                maximumSelectionLength: 1
            });

            if (type !== 'repet') {
                $(data).attr(`${disp_option}data-id-${ans_col}`, key + 1);
            } else {
                var button = document.querySelector(`button[${disp_option}ans_col="${ans_col}"]`);
                button.setAttribute(`${disp_option}data-id-${ans_col}`, key + 1);
            }
        }

        async function addNewType(data, disp_option = '') {
            let button = $(data);
            button.attr('disabled', true);

            // console.log($(data).parent().parent().parent().find(".d-flex.input-field.align-items-center").length)
            // const key = $(data).parent().parent().parent().find(".d-flex.input-field.align-items-center").length;

            let key = $(data).attr('data-id');
            key = parseInt(key);
            key += 1;
            let ans_col = $(data).attr('ans_col');

            // console.log(ans_col, key);
            let testType = $('#format').val();
            let super_category = $(`#${disp_option}super_category_create_${ans_col}_${key - 1}`).val();
            let category_type = $(`#${disp_option}add_category_type_${ans_col}_${key - 1}`).val();
            let question_type = $(`#${disp_option}add_search-input_${ans_col}_${key - 1}`).val();

            if (super_category == '') {
                toastr.error('Please select a Super category!');
                button.attr('disabled', false);
                return false;
            }

            if (category_type == '') {
                toastr.error('Please select a category type!');
                button.attr('disabled', false);
                return false;
            }

            if (question_type == '') {
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
            html +=
                `<input type="checkbox" name="${disp_option}ct_checkbox_${ans_col}" id="${disp_option}ct_checkbox_${ans_col}_${key}">`;
            html += `</div>`;

            html += `<div class="col-md-3 mb-2 me-2 rating-tag">`;
            html += `<div class="d-flex align-items-center">`;
            html +=
                `<select class="js-select2 select superCategory" id="${disp_option}super_category_create_${ans_col}_${key}" name="${disp_option}super_category_create_${ans_col}" data-id="${key}" onchange="insertSuperCategory(this)" multiple>`;
            html += preGetSuperCategory;
            html += `</select>`;
            html += `</div>`;
            html += `</div>`;

            html += `<div class="col-md-3 mb-2 me-2 category-custom">`;
            html += `<div class="d-flex align-items-center">`;
            html +=
                `<select class="js-select2 select categoryType" id="${disp_option}add_category_type_${ans_col}_${key}" name="${disp_option}add_category_type_${ans_col}" data-id="${key}" onchange="insertCategoryType(this)" multiple>`;
            html += preGetPracticeCategoryType;
            html += `</select>`;
            html += `</div>`;
            html += `</div>`;

            html += `<div class="mb-2 col-md-3 add_question_type_select">`;
            html += `<div class="d-flex align-items-center">`;
            html +=
                `<select class="js-select2 select questionType" id="${disp_option}add_search-input_${ans_col}_${key}" name="${disp_option}add_search-input_${ans_col}" data-id="${key}" onchange="insertQuestionType(this)" multiple>`;
            html += preGetPracticeQuestionType;
            html += `</select>`;
            html += `</div>`;
            html += `</div>`;

            html += `<div class="col-md-1 add-minus-icon">`;
            html +=
                `<button class="plus-button" onclick="removeNewType(this)"><i class="fa-solid fa-minus"></i></button>`;
            html += `</div>`;
            html += `</div>`;

            $(`#${disp_option}add_New_Types_${ans_col}`).append(html);

            $(`#${disp_option}super_category_create_${ans_col}_${key}`).select2({
                dropdownParent: $('#questionMultiModal'),
                tags: true,
                placeholder: "Select Super Category",
                maximumSelectionLength: 1
            });

            $(`#${disp_option}add_category_type_${ans_col}_${key}`).select2({
                dropdownParent: $('#questionMultiModal'),
                tags: true,
                placeholder: "Select Category type",
                maximumSelectionLength: 1
            });

            $(`#${disp_option}add_search-input_${ans_col}_${key}`).select2({
                dropdownParent: $('#questionMultiModal'),
                tags: true,
                placeholder: "Select Question type",
                maximumSelectionLength: 1
            });

            button.attr('disabled', false);
            $(data).attr('data-id', key);
        }

        function dropdown_lists(url) {
            let site_url = $('#site_url').val();
            let option = ``;

            return $.ajax({
                url: `${site_url}${url}`,
                type: "GET",
                async: true,
                dataType: "JSON",
            }).then((resp) => {
                if (resp.success) {
                    $(resp.dropdown_list).each((index, value) => {
                        if (resp.type == 'category_type') {
                            option += `<option value="${value.id}">`;
                            option += `${value.category_type_title}`;
                            option += `</option>`;
                        }

                        if (resp.type == 'question_type') {
                            option += `<option value="${value.id}">`;
                            option += `${value.question_type_title}`;
                            option += `</option>`;
                        }

                        if (resp.type == 'super_categories') {
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

        function removeNewType(data) {
            // console.log($(data).parent().parent().parent());
            const addPlusButton = $(data).parent().parent().parent().find(
                "button.add-plus-button");
            $(data).parents('.removeNewType').remove();
            // let count = addPlusButton.attr("data-id");
            // count = parseInt(count);
            // addPlusButton.attr('data-id', `${count - 1 == 0 ? 1 : count - 1}`);
        }

        function removeNewTypes(data) {
            $(data).parents('.removeNewTypes').remove();
            let count = $('.edit-plus-button').attr('data-id');
            // $('.plus-button').attr('data-id', `${count - 1 == 0 ? 1 : count - 1}`);
            $('.edit-plus-button').attr('data-id', count - 1);
        }

        $(document).ready(async function() {
            $('#questionMultiModal').modal({
                focus: false
            });

            $('#editQuestionMultiModal').modal({
                focus: false
            });

            // $('input[name=tags]').tagify();
            $(`#question_tags_create`).select2({
                dropdownParent: $('#questionMultiModal'),
                tags: true,
                placeholder: "Select Question Tag",
                maximumSelectionLength: 1
            });

            // $(`#super_category_create_0`).select2({
            //     dropdownParent: $('#questionMultiModal'),
            //     tags: true,
            //     placeholder : "Select Super Category",
            //     maximumSelectionLength: 1
            // });

            // $(`#super_category_edit`).select2({
            //     dropdownParent: $('#editQuestionMultiModal'),
            //     tags: true,
            //     placeholder : "Select Super Category",
            //     maximumSelectionLength: 1
            // });

            $(`#question_tags_edit`).select2({
                dropdownParent: $('#editQuestionMultiModal'),
                tags: true,
                placeholder: "Select Question Tag",
                maximumSelectionLength: 1
            });

            $(`#format`).select2({
                // minimumResultsForSearch: -1,
                placeholder: "Select test type"
            });

            $(`#source`).select2({
                // minimumResultsForSearch: -1,
                placeholder: "Select test source"
            });

            // $(`#search-input_0`).select2({
            //     dropdownParent: $('#questionMultiModal'),
            //     tags: true,
            //     placeholder : "Select Question type",
            //     maximumSelectionLength: 1
            // });

            // $(`#category_type_0`).select2({
            //     dropdownParent: $('#questionMultiModal'),
            //     tags : true,
            //     placeholder : "Select Category type",
            //     maximumSelectionLength: 1
            // });

            $(`#diff_rating_create`).select2({
                dropdownParent: $('#questionMultiModal'),
                tags: true,
                placeholder: "Select Difficulty Rating",
                maximumSelectionLength: 1
            });

            $(`#diff_rating_edit`).select2({
                dropdownParent: $('#editQuestionMultiModal'),
                tags: true,
                placeholder: "Select Difficulty Rating",
                maximumSelectionLength: 1
            });

            $(`#passage_number`).select2({
                dropdownParent: $('#questionMultiModal'),
                placeholder: "Select Passage No",
            });

            $(`.passagesType`).select2({
                dropdownParent: $('#questionMultiModal'),
                placeholder: "Select Passages",
            });

            $(`#testSectionType`).select2({
                dropdownParent: $('#sectionModal'),
                placeholder: "Select Section Type",
            });

            $(`#editTestSectionType`).select2({
                dropdownParent: $('#editSectionModal'),
                placeholder: "Select Section Type",
            });

            //new for edit
            $('input[name=questionTags]').tagify();

            $(`#edit_super_category_0`).select2({
                dropdownParent: $('#editQuestionMultiModal'),
                tags: true,
                placeholder: "Select Super Category",
                maximumSelectionLength: 1
            });

            $(`#edit_category_type_0`).select2({
                dropdownParent: $('#editQuestionMultiModal'),
                tags: true,
                placeholder: "Select Category type",
                maximumSelectionLength: 1
            });

            $(`#edit_search-input_0`).select2({
                dropdownParent: $('#editQuestionMultiModal'),
                tags: true,
                placeholder: "Select Category type",
                maximumSelectionLength: 1
            });

            $(`#edit_passage_number`).select2({
                dropdownParent: $('#editQuestionMultiModal'),
                placeholder: "Select Passage No",
            });

            $(`.editPassagesType`).select2({
                dropdownParent: $('#editQuestionMultiModal'),
                placeholder: "Select Passages",
            });

            //new
            const disp_sections = ['', 'oneInFiveOdd_', 'oneInFiveEven_', 'oneInFourOdd_', 'oneInFourEven_',
                'oneInFourPassEven_', 'choiceMultInFourFill_', 'cb_choiceMultInFourFill_'
            ];

            const ans_choices = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K'];
            disp_sections.forEach(disp_section => {
                ans_choices.forEach(ans_choice => {
                    $(`#${disp_section}super_category_create_${ans_choice}_0`).select2({
                        dropdownParent: $('#questionMultiModal'),
                        tags: true,
                        placeholder: "Select Super Category",
                        maximumSelectionLength: 1
                    });

                    $(`#${disp_section}add_category_type_${ans_choice}_0`).select2({
                        dropdownParent: $('#questionMultiModal'),
                        tags: true,
                        placeholder: "Select Category type",
                        maximumSelectionLength: 1
                    });

                    $(`#${disp_section}add_search-input_${ans_choice}_0`).select2({
                        dropdownParent: $('#questionMultiModal'),
                        tags: true,
                        placeholder: "Select Question type",
                        maximumSelectionLength: 1
                    });

                    $(`#${disp_section}edit_super_category_${ans_choice}_0`).select2({
                        dropdownParent: $('#editQuestionMultiModal'),
                        tags: true,
                        placeholder: "Select Super Category",
                        maximumSelectionLength: 1
                    });

                    $(`#${disp_section}edit_category_type_${ans_choice}_0`).select2({
                        dropdownParent: $('#editQuestionMultiModal'),
                        tags: true,
                        placeholder: "Select Category type",
                        maximumSelectionLength: 1
                    });

                    $(`#${disp_section}edit_search-input_${ans_choice}_0`).select2({
                        dropdownParent: $('#editQuestionMultiModal'),
                        tags: true,
                        placeholder: "Select Question type",
                        maximumSelectionLength: 1
                    });
                });
            });

            preGetPracticeCategoryType = await dropdown_lists(`/admin/getPracticeCategoryType`);
            preGetPracticeQuestionType = await dropdown_lists(`/admin/getPracticeQuestionType`);
            preGetSuperCategory = await dropdown_lists(`/admin/getSuperCategory?testType`);

        });

        var myModal = new bootstrap.Modal(document.getElementById('dragModal'), {
            keyboard: false
        });

        var questionModal = new bootstrap.Modal(document.getElementById('dragModalQuestion'), {
            keyboard: false
        });

        var allowedContent = true; 

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

        $('.edit_question').click(function() {
            var id = $(this).data('id');
            $.ajax({
                data: {
                    'id': id,
                    '_token': $('input[name="_token"]').val()
                },
                url: '{{ route('getPracticeQuestionById') }}',
                method: 'post',
                success: (res) => {
                    var id = $('.question_id').val(res['id']);
                    var formate = res['format'];
                    var testid = res['testid'];

                    $('#format option[value="' + formate + '"]').attr("selected", "selected");
                    $('#practicetestid option[value="' + testid + '"]').attr("selected", "selected");
                    CKEDITOR.instances['js-ckeditor-que-desc'].setData(res['description']);
                    $('#questionModal').modal('show');
                }
            });
        });


        $('.add_question_modal_btn').click(function() {
            var title = $('.test_title').val();
            if ($("#practicetestid option[value=0]").length > 0) {
                $("#practicetestid option[value=0]").remove();
            }
            $('#practicetestid').append('<option value="0" selected>' + title + '</option>');
            $('#questionModal').modal('show');
        });

        $('.add_section_modal_btn').click(function() {
            $("input[name=required_number_of_correct_answers]").val("");
            whichModel = "section";
            $('#testSectiontitle').val('');
            $('#regular_time_hour, #regular_time_minute, #regular_time_second, #50extendedhour, #50extendedminute, #50extendedsecond, #100extendedhour, #100extendedminute, #100extendedsecond')
                .val('');
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
            $('#editTestSectionType').html('');
            var opt = '<option value="">Select Section Type</option>';
            for (var i = 0; i < optionObj[format].length; i++) {
                var typeVal = optionObj[format][i].replace(/\s/g, '_');
                typeVallev = typeVal.replace(')', '');
                typeVallev2 = typeVallev.replace('(', '');
                opt +=
                    `<option value="${typeVallev2}" data-isMath="${typeVallev2 == 'Math_no_calculator' || typeVallev2 == 'Math_with_calculator' ? true : false }" >${optionObj[format][i]}</option>`;
            }

            $('#testSectionType').html(opt);
            $('#sectionModal').modal('show');
        });

        function clearModel() {
            // console.log('yes 1');
            $('input[name=tags]').val('');
            $('#passage_number').val(null).trigger("change");

            const disp_sections = ['', 'oneInFiveOdd_', 'oneInFiveEven_', 'oneInFourOdd_', 'oneInFourEven_',
                'oneInFourPassEven_', 'choiceMultInFourFill_', 'cb_choiceMultInFourFill_', 'fc_'
            ];
            const ans_choices = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K'];
            disp_sections.forEach(disp_section => {
                ans_choices.forEach(ans_choice => {
                    $(`#${disp_section}super_category_create_${ans_choice}_0`).val(null).trigger("change");
                    $(`#${disp_section}add_category_type_${ans_choice}_0`).val(null).trigger("change");
                    $(`#${disp_section}add_search-input_${ans_choice}_0`).val(null).trigger("change");
                });
            });

            $(`.removeNewTypes`).remove();
            $(`.removeNewType`).remove();
            $('input[name=passagesType]').val(null).trigger("change");
            $('select[name=editPassagesType]').val(null).trigger("change");
            $('.getFilterChoice').val(null).trigger("change");
            $('.choiceMultInFourFill_filltype').val(null).trigger("change");
            $('input[name="choiceMultInFourFill_fill[]"]').val('');

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
                dropdownParent: $('#questionMultiModal'),
                tags: true,
                placeholder : "Select Super Category",
                maximumSelectionLength: 1
            });

            $('#fc_add_category_type_A_0').select2({
                dropdownParent: $('#questionMultiModal'),
                tags: true,
                placeholder : "Select Category type",
                maximumSelectionLength: 1
            });

            $('#fc_add_search-input_A_0').select2({
                dropdownParent: $('#questionMultiModal'),
                tags: true,
                placeholder : "Select Question type",
                maximumSelectionLength: 1
            });

            $('#fc_super_category_create_A_0').select2({
                dropdownParent: $('#questionMultiModal'),
                tags: true,
                placeholder : "Select Super Category",
                maximumSelectionLength: 1
            });

            $('#fc_add_category_type_A_0').select2({
                dropdownParent: $('#questionMultiModal'),
                tags: true,
                placeholder : "Select Category type",
                maximumSelectionLength: 1
            });

            $('#fc_add_search-input_A_0').select2({
                dropdownParent: $('#questionMultiModal'),
                tags: true,
                placeholder : "Select Question type",
                maximumSelectionLength: 1
            });
            
            

            $(".editMultipleChoice").trigger("change");
        }

        function clearError() {
            $('#questionMultiModal #questionError').text('');
            $('#questionMultiModal #tagError').text('');
            $('#questionMultiModal #categoryTypeError').text('');
            $('#questionMultiModal #questionTypeError').text('');
            $('#questionMultiModal #passNumberError').text('');
            $('#questionMultiModal #passageTypeError').text('');
            $('#questionMultiModal #superCategoryError').text('');


            const disp_sections = ['', 'oneInFiveOdd_', 'oneInFiveEven_', 'oneInFourOdd_', 'oneInFourEven_',
                'oneInFourPassEven_', 'choiceMultInFourFill_', 'cb_choiceMultInFourFill_', 'fc_'
            ];
            const ans_choices = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K'];
            disp_sections.forEach(disp_section => {
                ans_choices.forEach(ans_choice => {
                    emptyError('questionMultiModal', disp_section, ans_choice);
                });
            });
        }

        $(document).on('click', '.add_question_modal_multi', function() {
            is_edit = false;
            clearModel();
            clearError();
            // console.log('yes');
            $(".getFilterChoice").val('').trigger('change');
            $("input[name=diff_value]"). val("");
            $("input[name=disc_value]"). val("");
            $("input[name=guessing_value]"). val("");
            $('.add_guessing_value').val('');

            $('#passageRequired_1').prop('checked', true);
            $('#passage_number').prop('disabled', false);
            $('select[name="passagesType"]').prop('disabled', false);
            $('#questionMultiModal #diff_rating_create').val('').trigger('change');
            $('#questionMultiModal #question_tags_create').val('').trigger('change');
            $('#questionMultiModal #super_category_create').val('').trigger('change');
            let section_id = $(this).parents('.sectionTypesFull').attr('data-id');
            let section_type = $(`.selectedSection_${section_id}`).val();
            $('#section_type').val(section_type);
            if ($(`.section_${section_id} .firstRecord .sectionList`).length >= 0) {
                questionOrder = $(`.section_${section_id} .firstRecord .sectionList`).length;
            } else {
                questionOrder = 0;
            }
            $('.sectionAddId').val(section_id);
            questionCount = $(`.section_${section_id} .sectionList`).length + 1;
            // count++;
            var dataId = $(this).attr("data-id");
            var AnuserOpts = $('#sectionDisplay_' + dataId + ' .firstRecord ul li span .selectedSecTxt').val();

            var format = $('#format').val();
            /*$('#questionMultiModal #addQuestion').val('');
            $('#questionMultiModal #passages').prop('selectedIndex',0);
            $('#questionMultiModal #passNumber').prop('selectedIndex',0);*/
            $(".choiceMultInFourFill input[type=checkbox]").each(function() {
                $(this).attr('checked', false);
            });
            $('#testSectionTypeRead').val(AnuserOpts);
            $('#currentModelQueId').val(dataId);
            getAnswerOption(AnuserOpts, format);
            getPassages(format);
            whichModel = 'question';
            removeMoreFillOption();
            $('#questionMultiModal').modal('show');
            // clearModel();

            
        });

        // $(document).on('click','.add_score_btn',function(){
        //     $('.table_body').empty();
        //     let section_id = $(this).attr('data-id');
        //     let total_question = $(`.section_${section_id} .sectionTypesFullMutli .sectionList`);
        //     if(total_question.length > 0){
        //         for (var i = 0; i < total_question.length + 1; i++) {
        //             let element = total_question[i];
        //             let questionId = $(element).attr('data-id');
        //             // $(`.table_body #score_${section_id}_${questionId}`).remove();
        //             $('.table_body').append('<tr id="score_'+questionId+'" data-section_id="'+section_id+'" data-question_id="'+questionId+'" ><td><input type="number" placeholder="Actual score" id="actualScore_'+questionId+'" class="form-control"></td><td><input type="number" placeholder="Converted Score" id="convertedScore_'+questionId+'" class="form-control"></td></tr>');
        //         }
        //     }
        //     $('#scoreModalMulti').modal('show');
        // });

        function addClassScore(data) {
            let checkIsmath = $(data).find('option:selected').attr('data-ismath');

            if (checkIsmath == "true") {
                $('#sectionModal .save_section').attr('data-class', 'checkMathDiv');
            } else {
                $('#sectionModal .save_section').attr('data-class', '');
            }
        }

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

        //new
        $(document).on('click', '.add_score_btn', function() {
            $('.table_body').empty();
            $("input[name=actualScore]"). val("");
            $("input[name=convertedScore]"). val("");
            let section_id = $(this).attr('data-id');
            let section_types = $(this).attr('data-section_type');
            let test_ids = $(this).attr('data-test_id');
            let total_question = $(`.section_${section_id} .sectionTypesFullMutli .sectionList`);
            // if(total_question.length > 0){
            $.ajax({
                type: 'POST',
                url: '{{ route('check_score') }}',
                data: {
                    section_id: section_id,
                    '_token': $('input[name="_token"]').val()
                },
                success: function(res) {
                    var result = res.records;
                    if (result.length > 0) {
                        // for (var i = 0; i < result.length; i++) {
                        //     $('.table_body').append(`<tr id="score_${result[i]['section_id']}_${i}" data-section_id="${result[i]['section_id']}" data-question_id="${result[i]['question_id']}" data-section_type="${result[i]['section_type']}" data-test_id="${result[i]['test_id']}" ><td><input type="number" placeholder="Actual Score" id="actualScore_${result[i]['question_id']}" name="actualScore" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control" value="${result[i]['actual_score'] != null ? result[i]['actual_score'] : ''}"></td><td><input type="number" placeholder="Converted Score" id="convertedScore_${result[i]['question_id']}" name="convertedScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  value="${result[i]['converted_score'] != null ? result[i]['converted_score'] : ''}"></td></tr>`);
                        // }
                        if (section_types == 'Math_no_calculator' || section_types ==
                            'Math_with_calculator') {
                            let mathDivs = $('.checkMathDiv').find('.firstRecord .sectionList');
                            for (var i = 0; i < mathDivs.length + 1; i++) {
                                if (i < result.length) {
                                    $('.table_body').append(
                                        `<tr id="score_${result[i]['section_id']}_${i}" data-section_id="${result[i]['section_id']}" data-question_id="${result[i]['question_id']}" data-section_type="${result[i]['section_type']}" data-test_id="${result[i]['test_id']}" ><td><input type="number" placeholder="Actual Score" id="actualScore_${result[i]['question_id']}" name="actualScore" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control" value="${result[i]['actual_score'] != null ? result[i]['actual_score'] : ''}"></td><td><input type="number" placeholder="Converted Score" id="convertedScore_${result[i]['question_id']}" name="convertedScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  value="${result[i]['converted_score'] != null ? result[i]['converted_score'] : ''}"></td></tr>`
                                    );
                                } else {
                                    $('.table_body').append(
                                        `<tr id="score_${section_id}_${i}" data-section_id="${section_id}" data-question_id="${i}" data-section_type="${section_types}" data-test_id="${test_ids}" ><td><input type="number" placeholder="Actual Score" id="actualScore_${i}" name="actualScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value=""></td><td><input type="number" placeholder="Converted Score" id="convertedScore_${i}" name="convertedScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value=""></td></tr>`
                                    );
                                }
                            }
                        } else {
                            for (var i = 0; i < total_question.length + 1; i++) {
                                if (i < result.length) {
                                    $('.table_body').append(
                                        `<tr id="score_${result[i]['section_id']}_${i}" data-section_id="${result[i]['section_id']}" data-question_id="${result[i]['question_id']}" data-section_type="${result[i]['section_type']}" data-test_id="${result[i]['test_id']}" ><td><input type="number" placeholder="Actual Score" id="actualScore_${result[i]['question_id']}" name="actualScore" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control" value="${result[i]['actual_score'] != null ? result[i]['actual_score'] : ''}"></td><td><input type="number" placeholder="Converted Score" id="convertedScore_${result[i]['question_id']}" name="convertedScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  value="${result[i]['converted_score'] != null ? result[i]['converted_score'] : ''}"></td></tr>`
                                    );
                                } else {
                                    $('.table_body').append(
                                        `<tr id="score_${section_id}_${i}" data-section_id="${section_id}" data-question_id="${i}" data-section_type="${section_types}" data-test_id="${test_ids}" ><td><input type="number" placeholder="Actual Score" id="actualScore_${i}" name="actualScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value=""></td><td><input type="number" placeholder="Converted Score" id="convertedScore_${i}" name="convertedScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value=""></td></tr>`
                                    );
                                }
                            }
                        }
                    } else {
                        if (section_types == 'Math_no_calculator' || section_types ==
                            'Math_with_calculator') {
                            let mathDivs = $('.checkMathDiv').find('.firstRecord .sectionList');
                            for (var i = 0; i < mathDivs.length + 1; i++) {
                                let element = mathDivs[i];
                                let questionId = $(element).attr('data-id');
                                $('.table_body').append(
                                    `<tr id="score_${section_id}_${i}" data-section_id="${section_id}" data-question_id="${i}" data-section_type="${section_types}" data-test_id="${test_ids}" ><td><input type="number" placeholder="Actual Score" id="actualScore_${i}" name="actualScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value=""></td><td><input type="number" placeholder="Converted Score" id="convertedScore_${i}" name="convertedScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value=""></td></tr>`
                                );
                            }
                        } else {
                            for (var i = 0; i < total_question.length + 1; i++) {
                                let element = total_question[i];
                                let questionId = $(element).attr('data-id');
                                $('.table_body').append(
                                    `<tr id="score_${section_id}_${i}" data-section_id="${section_id}" data-question_id="${i}" data-section_type="${section_types}" data-test_id="${test_ids}" ><td><input type="number" placeholder="Actual Score" id="actualScore_${i}" name="actualScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value=""></td><td><input type="number" placeholder="Converted Score" id="convertedScore_${i}" name="convertedScore" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value=""></td></tr>`
                                );
                            }
                        }
                    }
                    $("input[name=actualScore]"). val("");
                        $("input[name=convertedScore]"). val("");
                },
                error: function(xhr, status, error) {

                }
            });
            // }
            $('#scoreModalMulti').modal('show');
        });

        // $(document).on('click', '.save_scores_btn', function() {
        //         let scores = [];
        //         $('.table_body tr').each(function() {
        //             let questionId = $(this).attr('data-question_id');
        //             let sectionId = $(this).attr('data-section_id');
        //             let actualScore = $('#actualScore_'+questionId).val();
        //             let convertedScore = $('#convertedScore_'+questionId).val();
        //             let scoreObj = {
        //                 'sectionId': sectionId,
        //                 'questionId': questionId,
        //                 'actualScore': actualScore,
        //                 'convertedScore': convertedScore
        //             };
        //         scores.push(scoreObj);
        //         });
        //     $.ajax({
        //         type: 'POST',
        //         url: '{{ route('score_save') }}',
        //         data: {
        //             'scores': scores,
        //             '_token': $('input[name="_token"]').val()
        //         },
        //         success: function(response) {
        //             console.log(response);
        //         },
        //         error: function(xhr, status, error) {
        //             console.log(xhr.responseText);
        //         }
        //     });
        //     $('#scoreModalMulti').modal('hide');
        // });

        //new
        var closeModal = document.getElementById("scoreModalMulti");
        closeModal.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                let scores = [];
                $('.table_body tr').each(function() {
                    let questionId = $(this).attr('data-question_id');
                    let sectionId = $(this).attr('data-section_id');
                    let sectionType = $(this).attr('data-section_type');
                    let testId = $(this).attr('data-test_id');
                    let actualScore = $('#actualScore_' + questionId).val();
                    let convertedScore = $('#convertedScore_' + questionId).val();

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
                    url: '{{ route('score_save') }}',
                    data: {
                        'scores': scores,
                        '_token': $('input[name="_token"]').val()
                    },
                    success: function(response) {

                    },
                    error: function(xhr, status, error) {}
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
                let actualScore = $('#actualScore_' + questionId).val();
                let convertedScore = $('#convertedScore_' + questionId).val();

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
                url: '{{ route('score_save') }}',
                data: {
                    'scores': scores,
                    '_token': $('input[name="_token"]').val()
                },
                success: function(response) {

                },
                error: function(xhr, status, error) {}
            });
            $('#scoreModalMulti').modal('hide');
        });

        $('.save_question').click(function() {
            var format = $('#format').val();
            var practicetestid = $('#practicetestid').val();
            var description = CKEDITOR.instances['js-ckeditor-que-desc'].getData();
            $.ajax({
                data: {
                    'format': format,
                    'practicetestid': practicetestid,
                    'description': description,
                    '_token': $('input[name="_token"]').val()
                },
                url: '{{ route('addPracticeQuestion') }}',
                method: 'post',
                success: (res) => {
                    alert('Question Added');
                }
            });
        });

        function emptyError(modal, disp_section, choice) {
            $(`#${modal} #${disp_section}superCategoryError_${choice}`).text('');
            $(`#${modal} #${disp_section}categoryTypeError_${choice}`).text('');
            $(`#${modal} #${disp_section}questionTypeError_${choice}`).text('');
        };

        // valudation test for all the number validation.
        function testWholeNumber(number){
            var regex = /^[0-9]+$/;
            if (number.trim() === "") {
                return false;
            } else if (regex.test(number)) {
               return true;
            } else {
                return false;
            }
        }

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

            var regularTime = ("0" + rHour).slice(-2) + ":" + ("0" + rMinute).slice(-2) + ":" + ("0" + rSecond)
                .slice(-2);
            var fiftyExtended = ("0" + fiftyHour).slice(-2) + ":" + ("0" + fiftyMinute).slice(-2) + ":" + ("0" +
                fiftySecond).slice(-2);
            var hundredExtended = ("0" + hundredHour).slice(-2) + ":" + ("0" + hundredMinute).slice(-2) + ":" + (
                "0" + hundredSecond).slice(-2); 

            var whichModel = $(this).parent().find('.whichModel').val();
            let scoreClass = $(this).attr('data-class');
            $('.sectionTypesFull').show();
            var format = $('.ptype #format').val();
            var currentModelId = $('#currentModelId').val();
            var currentModelQueId = $('#currentModelQueId').val();

            var testSectionTitle = $('#testSectiontitle').val();
            var testSectionType = $('#testSectionType').val();

            var diffValue = $('input[name="diff_value"]').val();
            var discValue = $('input[name="disc_value"]').val();
            var guessingValue = $('input[name="guessing_value"]').val();

            var diffValue = $("#diffValue").val();
            var discValue = $("#discValue").val();

            var tags = $('input[name="tags"]').val();

            var fill = 'N/A';
            var fillType = 'N/A';
            var answerType = 'N/A';
            var multiChoice = '';
            var fillVals = [];

            var question_type = $('#format').val();
            if (whichModel == 'section') {
                var test_type = $('#format').val();
                if ((test_type == 'DSAT') || (test_type == 'DPSAT') ) {
                    // this field is required - required_number_of_correct_answers
                    var numberOfCorrectAnswers = $('#required_number_of_correct_answers').val();
                    if (format == '' || testSectionType == '' || testSectionTitle == '' || regularTime == '0:0:0' || numberOfCorrectAnswers == '') {                   
                        $('#sectionModal .validError').text('Below fields are required!');
                        return false;
                    }

                    if(testWholeNumber(numberOfCorrectAnswers) == false) {
                        $('#sectionModal .validError').text('Only whole numbers are allowed.');
                        return false;
                    }
                }else{
                    if (format == '' || testSectionType == '' || testSectionTitle == '' || regularTime == '0:0:0') {
                        $('#sectionModal .validError').text('Below fields are required!');
                        return false;
                    } else {
                        $('#sectionModal .validError').text('');
                    }
                }
                
                var get_test_id = jQuery('#get_question_id').val();
                var required_number_of_correct_answers = jQuery('#required_number_of_correct_answers').val();
                $('#sectionModal').modal('hide');
                $('#questionMultiModal').modal('hide');
                
                var sectionSelectedTxt = testSectionType.replaceAll('_', ' ');
                sectionOrder++;
                newSectionOrder++;
                
                questionOrder = 0;
                questionCount = 1;
                // choiceMultInFourFill 
                $.ajax({
                    data: {
                        'format': format,
                        'testSectionTitle': testSectionTitle,
                        'testSectionType': testSectionType,
                        'required_number_of_correct_answers': required_number_of_correct_answers,
                        'get_test_id': get_test_id,
                        // 'order': sectionOrder,
                        'order': newSectionOrder,
                        'regular': regularTime,
                        'fifty': fiftyExtended,
                        'hundred': hundredExtended,
                        'question_type': question_type,
                        '_token': $('input[name="_token"]').val()
                    },
                    url: '{{ route('addPracticeTestSection') }}',
                    method: 'post',
                    success: (result) => {
                        // console.log(result);
                        $.each(result, function (i, v) {
                            $.each(v, function (key, value) {
                                // console.log(value);
                                let res = value['id'];
                                newSectionOrder = value['order'];

                                let testFormatType = $('#format').val();
                                var myarray = ['DSAT','DPSAT'];
                                var add_score_button_class = 'add_score_btn';
                                if(jQuery.inArray(testFormatType, myarray) != -1) {
                                    add_score_button_class = 'digi_add_score_btn';
                                }
                                
                                let section = value['section'];
                                section = section.replaceAll('_', ' ');
                                // sectionOrder = currentModelId = key;
                                sectionOrder = currentModelId = newSectionOrder;
                                // sectionOrder++;

                                if ((testSectionType == 'Math') && (key == 0) ) {
                                    testSectionType = 'Math_no_calculator';
                                }else if ((testSectionType == 'Math') && (key == 1) ) {
                                    testSectionType = 'Math_no_calculator';
                                }else if((testSectionType == 'Math') && (key == 2)){
                                    testSectionType = 'Math_with_calculator';
                                }else{
                                    // nothing, it'll be same.
                                }

                                let ScoreClass =
                                `${testSectionType == 'Math_no_calculator' || testSectionType == 'Math_with_calculator' ? scoreClass : '' }`;
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
                                    '" ></span></li><li>Order: &nbsp;<input type="number" readonly class="form-control" name="order" value="' +
                                    // sectionOrder + '" id="order_' +
                                    newSectionOrder + '" id="order_' +
                                    res +
                                    '"/><button type="button" class="input-field-text d-none" id="basic-addon2" onclick="openOrderDialog()"><i class="fa-solid fa-check"></i></button></li><li class="edit-close-btn"><button type="button" class="btn btn-sm btn-alt-secondary editSection me-2" data-id="' +
                                    res +
                                    '" data-bs-toggle="tooltip" onclick="editSection(this)" title="Edit Section"><i class="fa fa-fw fa-pencil-alt"></i></button><button type="button" class="btn btn-sm btn-alt-secondary deleteSection" data-id="' +
                                    res + '" data-section_type="' + testSectionType +
                                    '" onclick="deleteSection(this)" data-bs-toggle="tooltip" title="Delete Section"><i class="fa fa-fw fa-times"></i></button></li></ul><ul class="sectionHeading"><li>Question</li><li>Answer</li> <li>Passage</li><li>Passage Number</li><li>Fill Answer</li><li class="' +
                                    res +
                                    '">Order</li><li>Action</li></ul></div></div><div class="mb-2 mb-4 ordermain"><button type="button" data-id="' +
                                    currentModelId +
                                    '" class="btn w-25 btn-alt-success me-2 add_question_modal_multi"><i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Question</button><button type="button" data-id="' +
                                    res + '" data-section_type="' + testSectionType + '" data-test_id="' +
                                    get_test_id +
                                    '" class="btn w-25 btn-alt-success '+add_score_button_class+'"><i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Score</button><div class="opendialog"><input type="number" readonly class="form-control" name="question_order" value="'+newSectionOrder+'" id="order_' +
                                    res +
                                    '"/><button type="button" class="input-field-text" id="basic-addon2" onclick="openQuestionDialog(' +
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
                                    
                            });
                        });
                        
                        /*
                        let ScoreClass =
                            `${testSectionType == 'Math_no_calculator' || testSectionType == 'Math_with_calculator' ? scoreClass : '' }`;
                        $('.sectionContainerList').append(
                            '<div class="sectionTypesFull ' + scoreClass + ' section_' + res +
                            '" data-id=' + res + ' id="sectionDisplay_' + currentModelId +
                            '" ><div class="mb-2 mb-4"><div class="sectionTypesFullMutli"> </div> <div class="sectionTypesFullMutli firstRecord"><ul class="sectionListtype"><li>Type: &nbsp;<strong>' +
                            format +
                            '</strong></li><li>Section Type:&nbsp;<span class="answerOption editedAnswerOption_' +
                            res + '"><strong>' +
                            capitalizeFirstLetter(sectionSelectedTxt) +
                            '</strong><input type="hidden" name="selectedSecTxt" value="' +
                            testSectionType +
                            '" class="selectedSecTxt selectedSection_' + res +
                            '" ></span></li><li>Order: &nbsp;<input type="number" readonly class="form-control" name="order" value="' +
                            sectionOrder + '" id="order_' +
                            res +
                            '"/><button type="button" class="input-field-text d-none" id="basic-addon2" onclick="openOrderDialog()"><i class="fa-solid fa-check"></i></button></li><li class="edit-close-btn"><button type="button" class="btn btn-sm btn-alt-secondary editSection me-2" data-id="' +
                            res +
                            '" data-bs-toggle="tooltip" onclick="editSection(this)" title="Edit Section"><i class="fa fa-fw fa-pencil-alt"></i></button><button type="button" class="btn btn-sm btn-alt-secondary deleteSection" data-id="' +
                            res + '" data-section_type="' + testSectionType +
                            '" onclick="deleteSection(this)" data-bs-toggle="tooltip" title="Delete Section"><i class="fa fa-fw fa-times"></i></button></li></ul><ul class="sectionHeading"><li>Question</li><li>Answer</li> <li>Passage</li><li>Passage Number</li><li>Fill Answer</li><li class="' +
                            res +
                            '">Order</li><li>Action</li></ul></div></div><div class="mb-2 mb-4 ordermain"><button type="button" data-id="' +
                            currentModelId +
                            '" class="btn w-25 btn-alt-success me-2 add_question_modal_multi"><i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Question</button><button type="button" data-id="' +
                            res + '" data-section_type="' + testSectionType + '" data-test_id="' +
                            get_test_id +
                            '" class="btn w-25 btn-alt-success add_score_btn"><i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Score</button><div class="opendialog"><input type="number" readonly class="form-control" name="question_order" value="0" id="order_' +
                            res +
                            '"/><button type="button" class="input-field-text" id="basic-addon2" onclick="openQuestionDialog(' +
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
                    }
                });

            } else {
                var test_source = $('#source option:selected').val();
                var testSectionType = $('#testSectionTypeRead').val();
                var question = CKEDITOR.instances['js-ckeditor-addQue'].getData();
                var activeAnswerType = '.' + $('#selectedAnswerType').val();
                //var new_question_type = $('#new_question_type').val();
                var new_question_type_select = $('#new_question_type_select').val();
                var difficulty = $('#diff_rating_create').val();
                var tags = $('#question_tags_create').val();
                // var super_category = $('#super_category_create').val();
                var question_category_type_value = $('#category_type').val();

                // console.log(activeAnswerType);
                // var questionType = $('#questionMultiModal ' + activeAnswerType + ' #questionType').val();
                var questionType = $('#questionMultiModal ' + activeAnswerType + ' #questionType').val();
                multiChoice = $('.getFilterChoice option:selected').val();

                let ans_choices;
                let disp_section;
                if (questionType == 'choiceOneInFive_Odd') {
                    ans_choices = ['A', 'B', 'C', 'D', 'E'];
                    disp_section = 'oneInFiveOdd_';
                } else if (questionType == 'choiceOneInFourPass_Odd') {
                    ans_choices = ['A', 'B', 'C', 'D'];
                    disp_section = '';
                } else if (questionType == 'choiceOneInFour_Odd') {
                    ans_choices = ['A', 'B', 'C', 'D'];
                    disp_section = 'oneInFourOdd_';
                } else if (questionType == 'choiceOneInFour_Even') {
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

                const checkboxValues = {};
                ans_choices.forEach(ans_choice => {
                    checkboxValues[ans_choice] = $(`input[name="${disp_section}ct_checkbox_${ans_choice}"]`)
                        .map((i, v) => $(v).is(':checked') ? 1 : 0)
                        .get();
                });

                // const guessingValues = {};
                // ans_choices.forEach(ans_choice => {
                //     guessingValues[ans_choice] = $(`input[name="${disp_section}ct_checkbox_${ans_choice}"]`)
                //         .map((i, v) => {
                //             const val = $(v).val();
                //             return val ? val : null;
                //         }).get();
                // });

                const superCategoryValues = {};
                ans_choices.forEach(ans_choice => {
                    superCategoryValues[ans_choice] = $(
                            `select[name="${disp_section}super_category_create_${ans_choice}"]`)
                        .map((i, v) => {
                            const super_category_val = $(v).val();
                            return super_category_val.length > 0 ? super_category_val : null;
                        })
                        .get()
                        .filter(value => value !== null);
                });

                const getCategoryTypeValues = {};
                ans_choices.forEach(ans_choice => {
                    getCategoryTypeValues[ans_choice] = $(
                            `select[name="${disp_section}add_category_type_${ans_choice}"]`)
                        .map((i, v) => {
                            const category_type_val = $(v).val();
                            return category_type_val.length > 0 ? category_type_val : null;
                        })
                        .get()
                        .filter(value => value !== null);
                });

                const getQuestionTypeValues = {};
                ans_choices.forEach(ans_choice => {
                    getQuestionTypeValues[ans_choice] = $(
                            `select[name="${disp_section}add_search-input_${ans_choice}"]`)
                        .map((i, v) => {
                            const question_type_val = $(v).val();
                            return question_type_val.length > 0 ? question_type_val : null;
                        })
                        .get()
                        .filter(value => value !== null);
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
                
                var pass = $('select[name="passagesType"] :selected').text();
                var passNumber = $('#questionMultiModal .passNumber').val();
                var passagesType = $('.passagesType').val();
                var passagesTypeTxt = $(".passagesType option:selected").text();
                // getFilterChoice editMultipleChoice
                var ifFillChoice = $('.getFilterChoice').val();

                var questTypeArr = ['ACT','SAT','PSAT'];
                if((jQuery.inArray(format, questTypeArr) != -1) || (ifFillChoice == 2)) {

                    if ($('#passageRequired_1').is(':checked')) {
                        if (
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
                                // const get_addGuessingValue = addGuessingValue[choice];

                                return (
                                    super_category_values.length === 0 ||
                                    get_category_type_values.length === 0 ||
                                    // get_addGuessingValue.length === 0 || 
                                    get_question_type_values.length === 0
                                );
                            })
                        ) {
                            $('#questionMultiModal #questionError').text(question == '' ? 'Question is required!' : '');
                            $('#js-ckeditor-addQue').focus();
                            
                            // $('#diff-value #diffValueError').text(diffValue == '' ? 'Diff Value is required!' : '');
                            // $('#addTag').focus();

                            // $('#disc-value #disc-valueError').text(discValue == '' ? 'Disc Value is required!' : '');
                            // $('#addTag').focus();

                            $('#questionMultiModal #tagError').text(tags.length == 0 ? 'Tag is required!' : '');
                            $('#addTag').focus();

                            $('#questionMultiModal #passNumberError').text(jQuery.type(passNumber) == "null" ?
                                'Passage Number is required!' : '');
                            $('#passage_number').focus();
                            $('#questionMultiModal #passageTypeError').text(passagesType == '' ?
                                'Passage Type is required!' : '');
                            $('#passagesType').focus();

                            ans_choices.forEach(choice => {
                                const super_category_values = superCategoryValues[choice];
                                const get_category_type_values = getCategoryTypeValues[choice];
                                const get_question_type_values = getQuestionTypeValues[choice];
                                // const get_addGuessingValue = addGuessingValue[choice];

                                $(`#questionMultiModal #${disp_section}superCategoryError_${choice}`).text(
                                    super_category_values.length == 0 ? 'Super Category is required!' : '');
                                $(`#questionMultiModal #${disp_section}categoryTypeError_${choice}`).text(
                                    get_category_type_values.length == 0 ? 'Category type is required!' : ''
                                );
                                $(`#questionMultiModal #${disp_section}questionTypeError_${choice}`).text(
                                    get_question_type_values.length == 0 ? 'Question type is required!' : ''
                                );
                                // $(`#questionMultiModal #${disp_section}add_guessing_valueE_${choice}`).text(get_addGuessingValue.length == 0 ? 'Guessing Value is required!' : '');
                                
                            });

                            return false;
                        } else {
                            $('#questionMultiModal #questionError').text('');
                            $('#questionMultiModal #tagError').text('');
                            // $('#questionMultiModal #categoryTypeError').text('');
                            // $('#questionMultiModal #questionTypeError').text('');
                            $('#questionMultiModal #passNumberError').text('');
                            $('#questionMultiModal #passageTypeError').text('');
                            // $('#questionMultiModal #superCategoryError').text('');

                            ans_choices.forEach(choice => {
                                emptyError('questionMultiModal', disp_section, choice);
                                // $(`#questionMultiModal #${disp_section}add_guessing_valueE_${choice}`).text('');
                            });
                        }
                    } else {
                        if (question == '' ||
                            tags.length == 0 ||
                            // diffValue == '' ||
                            // discValue == '' ||
                            format == '' ||
                            testSectionType == '' ||
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
                            $('#questionMultiModal #questionError').text(question == '' ? 'Question is required!' : '');
                            $('#js-ckeditor-addQue').focus();
                            $('#questionMultiModal #tagError').text(tags.length == 0 ? 'Tag is required!' : '');
                            $('#addTag').focus();

                            // $('#diff-value #diffValueError').text(diffValue == '' ? 'Diff Value is required!' : '');
                            // $('#addTag').focus();

                            // $('#disc-value #disc-valueError').text(discValue == '' ? 'Disc Value is required!' : '');
                            // $('#addTag').focus();

                            ans_choices.forEach(choice => {
                                const super_category_values = superCategoryValues[choice];
                                const get_category_type_values = getCategoryTypeValues[choice];
                                const get_question_type_values = getQuestionTypeValues[choice];
                                // const get_addGuessingValue = addGuessingValue[choice];

                                $(`#questionMultiModal #${disp_section}superCategoryError_${choice}`).text(
                                    super_category_values.length == 0 ? 'Super Category is required!' : '');
                                $(`#questionMultiModal #${disp_section}categoryTypeError_${choice}`).text(
                                    get_category_type_values.length == 0 ? 'Category type is required!' : ''
                                );
                                $(`#questionMultiModal #${disp_section}questionTypeError_${choice}`).text(
                                    get_question_type_values.length == 0 ? 'Question type is required!' : ''
                                );
                                // $(`#questionMultiModal #${disp_section}add_guessing_valueE_${choice}`).text(get_addGuessingValue.length == 0 ? 'Guessing Value is required!' : '');

                            });

                            return false;
                        } else {
                            $('#questionMultiModal #questionError').text('');
                            $('#questionMultiModal #tagError').text('');

                            ans_choices.forEach(choice => {
                                emptyError('questionMultiModal', disp_section, choice); 
                                // $(`#questionMultiModal #${disp_section}add_guessing_valueE_${choice}`).text('');
                            });
                        }
                    }
                }else{
                    if ($('#passageRequired_1').is(':checked')) {
                        if (
                            question == '' ||
                            tags.length == 0 ||
                            diffValue == '' ||
                            discValue == '' ||
                            jQuery.type(passNumber) == "null" ||
                            passagesType == '' ||
                            format == '' ||
                            testSectionType == '' ||
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
                            $('#questionMultiModal #questionError').text(question == '' ? 'Question is required!' : '');
                            $('#js-ckeditor-addQue').focus();

                            $('#questionMultiModal #diffValueError').text(diffValue == '' ? 'Diff value is required!' : '');
                            $('#diffValue').focus();
                            $('#questionMultiModal #discValueError').text(discValue == '' ? 'Disc value is required!' : '');
                            $('#discValue').focus();

                            $('#questionMultiModal #tagError').text(tags.length == 0 ? 'Tag is required!' : '');
                            $('#addTag').focus();

                            $('#questionMultiModal #passNumberError').text(jQuery.type(passNumber) == "null" ?
                                'Passage Number is required!' : '');
                            $('#passage_number').focus();
                            $('#questionMultiModal #passageTypeError').text(passagesType == '' ?
                                'Passage Type is required!' : '');
                            $('#passagesType').focus();

                            ans_choices.forEach(choice => {
                                const super_category_values = superCategoryValues[choice];
                                const get_category_type_values = getCategoryTypeValues[choice];
                                const get_question_type_values = getQuestionTypeValues[choice];
                                const get_addGuessingValue = addGuessingValue[choice];

                                $(`#questionMultiModal #${disp_section}superCategoryError_${choice}`).text(
                                    super_category_values.length == 0 ? 'Super Category is required!' : '');
                                $(`#questionMultiModal #${disp_section}categoryTypeError_${choice}`).text(
                                    get_category_type_values.length == 0 ? 'Category type is required!' : ''
                                );
                                $(`#questionMultiModal #${disp_section}questionTypeError_${choice}`).text(
                                    get_question_type_values.length == 0 ? 'Question type is required!' : ''
                                );
                                $(`#questionMultiModal #${disp_section}add_guessing_valueE_${choice}`).text(get_addGuessingValue.length == 0 ? 'Guessing Value is required!' : '');
                                
                            });

                            return false;
                        } else {
                            $('#questionMultiModal #questionError').text('');
                            $('#questionMultiModal #tagError').text('');
                            // $('#questionMultiModal #categoryTypeError').text('');
                            // $('#questionMultiModal #questionTypeError').text('');
                            $('#questionMultiModal #passNumberError').text('');
                            $('#questionMultiModal #passageTypeError').text('');
                            // $('#questionMultiModal #superCategoryError').text('');

                            $('#questionMultiModal #diffValueError').text('');
                            $('#questionMultiModal #discValueError').text('');


                            ans_choices.forEach(choice => {
                                emptyError('questionMultiModal', disp_section, choice);
                                $(`#questionMultiModal #${disp_section}add_guessing_valueE_${choice}`).text('');
                            });
                        }
                    } else {
                        if (question == '' ||
                            tags.length == 0 ||
                            diffValue == '' ||
                            discValue == '' ||
                            format == '' ||
                            testSectionType == '' ||
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
                            $('#questionMultiModal #questionError').text(question == '' ? 'Question is required!' : '');
                            $('#js-ckeditor-addQue').focus();
                            $('#questionMultiModal #tagError').text(tags.length == 0 ? 'Tag is required!' : '');
                            $('#addTag').focus();

                            $('#questionMultiModal #diffValueError').text(diffValue == '' ? 'Diff value is required!' : '');
                            $('#diffValue').focus();
                            $('#questionMultiModal #discValueError').text(discValue == '' ? 'Disc value is required!' : '');
                            $('#discValue').focus();

                            ans_choices.forEach(choice => {
                                const super_category_values = superCategoryValues[choice];
                                const get_category_type_values = getCategoryTypeValues[choice];
                                const get_question_type_values = getQuestionTypeValues[choice];
                                const get_addGuessingValue = addGuessingValue[choice];

                                $(`#questionMultiModal #${disp_section}superCategoryError_${choice}`).text(
                                    super_category_values.length == 0 ? 'Super Category is required!' : '');
                                $(`#questionMultiModal #${disp_section}categoryTypeError_${choice}`).text(
                                    get_category_type_values.length == 0 ? 'Category type is required!' : ''
                                );
                                $(`#questionMultiModal #${disp_section}questionTypeError_${choice}`).text(
                                    get_question_type_values.length == 0 ? 'Question type is required!' : ''
                                );
                                $(`#questionMultiModal #${disp_section}add_guessing_valueE_${choice}`).text(get_addGuessingValue.length == 0 ? 'Guessing Value is required!' : '');

                            });

                            return false;
                        } else {
                            $('#questionMultiModal #questionError').text('');
                            $('#questionMultiModal #tagError').text('');

                            $('#questionMultiModal #diffValueError').text('');
                            $('#questionMultiModal #discValueError').text('');

                            ans_choices.forEach(choice => {
                                emptyError('questionMultiModal', disp_section, choice); 
                                $(`#questionMultiModal #${disp_section}add_guessing_valueE_${choice}`).text('');
                            });
                        }
                    }
                }

                if ($('#passageRequired_1').is(':checked')) {
                    var pass = $('select[name="passagesType"] :selected').text();
                    var passNumber = $('#questionMultiModal .passNumber').val();
                    var passagesType = $('.passagesType').val();
                    var passagesTypeTxt = $(".passagesType option:selected").text();
                } else {
                    var pass = '';
                    var passNumber = '';
                    var passagesType = '';
                    var passagesTypeTxt = '';
                }

                if (questionType == 'choiceOneInFourPass_Odd') {
                    answerType = $('#questionMultiModal ' + activeAnswerType +
                        ' input[name="choiceOneInFourPass"]:checked').val();

                } else if (questionType == 'choiceOneInFourPass_Even') {
                    answerType = $('#questionMultiModal ' + activeAnswerType +
                        ' input[name="choiceOneInFourPass"]:checked').val();

                } else if (questionType == 'choiceOneInFour_Odd') {
                    answerType = $('#questionMultiModal ' + activeAnswerType +
                        ' input[name="choiceOneInFour"]:checked').val();

                } else if (questionType == 'choiceOneInFour_Even') {
                    answerType = $('#questionMultiModal ' + activeAnswerType +
                        ' input[name="choiceOneInFour"]:checked').val();

                } else if (questionType == 'choiceOneInFive_Odd') {
                    answerType = $('#questionMultiModal ' + activeAnswerType +
                        ' input[name="choiceOneInFive"]:checked').val();

                } else if (questionType == 'choiceOneInFive_Even') {
                    answerType = $('#questionMultiModal ' + activeAnswerType +
                        ' input[name="choiceOneInFive"]:checked').val();

                } else if (questionType == 'choiceMultInFourFill') {
                    fillVals = $('#questionMultiModal ' + activeAnswerType +
                        '  input[name="choiceMultInFourFill_fill[]"]').map(function() {
                        return $(this).val();
                    }).get();

                    if (typeof fillVals !== 'undefined' && fillVals.length !== 0) {
                        fill = fillVals.join();
                        answerType = fill;
                    }
                    if ($('#questionMultiModal #selectedLayoutQuestion ' + activeAnswerType +
                            ' .choiceMultInFourFill_filltype').val() != '') {
                        fillType = $('#questionMultiModal #selectedLayoutQuestion ' + activeAnswerType +
                            ' .choiceMultInFourFill_filltype').val();
                        multiChoice = $('.getFilterChoice option:selected').val();
                    }

                    var singleChoM = $('#questionMultiModal ' + activeAnswerType +
                        ' input[name="choiceMultiChoiceInFourFill"]:checked').val();

                    if (typeof singleChoM !== 'undefined' && singleChoM != null) {
                        answerType = $('#questionMultiModal ' + activeAnswerType +
                            ' input[name="choiceMultiChoiceInFourFill"]:checked').val();
                        multiChoice = $('.getFilterChoice option:selected').val();

                    } else {
                        // multiChoice = 'multiChoice';
                        multiChoice = $('.getFilterChoice option:selected').val();
                        var answerMap = '';
                        var checkIDs = $('#questionMultiModal  ' + activeAnswerType +
                            ' input[name="choiceMultInFourFill[]"]:checked').map(function() {
                            answerMap += $(this).val() + ', ';
                            return $(this).val();
                        });
                        if (answerMap != '') {
                            answerType = answerMap.substring(0, answerMap.length - 2);
                        }
                    }
                } else {
                    answerType = $('#questionMultiModal ' + activeAnswerType + ' input[name="' + questionType +
                        '"]:checked').val();
                }

                /*answerContent = $('#questionMultiModal '+activeAnswerType+' input[name="answerContentOption[]"]').map(function(){return $(this).val();}).get();*/
                var answerContentJson = getAnswerContent(questionType, fill);
                var answerExpJson = getAnswerExpContent(questionType, fill);

                $('#questionMultiModal').modal('hide');
                $('#questionMultiModal').modal('hide');

                questionOrder++;
                var section_id = $('.sectionAddId').val();

                // adding validations here.



                $.ajax({
                    data: {
                        'format': format,
                        'test_source': test_source,
                        'testSectionType': testSectionType,
                        'question': question,
                        'question_order': questionOrder,
                        'question_type': questionType,
                        'passages': pass,
                        'passage_number': passNumber,
                        'passages_id': passagesType,
                        'answer': answerType,
                        'answer_content': answerContentJson,
                        'answer_exp': answerExpJson,
                        'fill': fill,
                        'fillType': fillType,
                        'diff_rating': difficulty,
                        'multiChoice': multiChoice,
                        'tags': tags,
                        'diffValue': diffValue,
                        'discValue': discValue,
                        'guessing_value': addGuessingValue,
                        'section_id': section_id,
                        'ct_checkbox_values': checkboxValues,
                        'super_category_values': superCategoryValues,
                        'get_category_type_values': getCategoryTypeValues,
                        'get_question_type_values': getQuestionTypeValues,
                        'new_question_type_select': new_question_type_select,
                        '_token': $('input[name="_token"]').val()
                    },
                    url: '{{ route('addPracticeQuestion') }}',
                    method: 'post',
                    success: (res) => {
                        // $('#sectionDisplay_' + currentModelQueId + ' .firstRecord').append(
                        //     '<ul class="sectionList"><li>' + question + '</li><li>' + answerType +
                        //     '</li><li>' + passagesTypeTxt + '</li><li>' + passNumber + '</li><li>' +
                        //     fill + '</li><li class="orderRearnge_' + res.question_id + '">' + res
                        //     .question_order + '</li><li><button type="button" class="btn btn-sm btn-alt-secondary edit-section" data-id="'+res.question_id+'" data-bs-toggle="tooltip" title="Edit Question" onclick="practQuestioEdit('+res.question_id+')"> <i class="fa fa-fw fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-alt-secondary delete-section" data-id="'+res.question_id+'" data-bs-toggle="tooltip" title="Delete Section"   onclick="practQuestioDel('+res.question_id+')">  <i class="fa fa-fw fa-times"></i></button></li></ul>');

                        // $('.addQuestion').val('');
                        // $('.validError').text('');
                        // $('.questionAddId').val(res.question_id);
                        // $('#listWithHandleQuestion').append('<div class="list-group-item" data-id="' +
                        //     res.question_id + '">\n' +
                        //     '<span class="glyphicon glyphicon-move" aria-hidden="true">\n' +
                        //     '<i class="fa-solid fa-grip-vertical"></i>\n' +
                        //     '</span>\n' +
                        //     '<button class="btn btn-primary" value="' + res.question_id + '">' +
                        //     question + '</button>\n' +
                        //     '</div>');
                        $('.addQuestion').val('');
                        $('.validError').text('');

                        $('#sectionDisplay_' + currentModelQueId + ' .firstRecord').append(
                            '<ul class="sectionList singleQuest_' + res.question_id +
                            '" data-id="' + res.question_id + '"><li>' + question +
                            '</li><li class="answerValUpdate_' + res.question_id + '">' +
                            answerType + '</li><li>' + passagesTypeTxt + '</li><li>' + passNumber +
                            '</li><li>' + fill + '</li><li class="orderValUpdate_' + res
                            .question_id + '">' + res.question_order +
                            '</li><li><button type="button" class="btn btn-sm btn-alt-secondary edit-section" data-id="' +
                            res.question_id +
                            '" data-bs-toggle="tooltip" title="Edit Question" onclick="practQuestioEdit(' +
                            res.question_id +
                            ')"> <i class="fa fa-fw fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-alt-secondary delete-section" data-id="' +
                            res.question_id +
                            '" data-bs-toggle="tooltip" title="Delete Question"   onclick="practQuestioDel(' +
                            res.question_id +
                            ')">  <i class="fa fa-fw fa-times"></i></button> </li></ul>');
                        MathJax.Hub.Queue(["Typeset", MathJax.Hub, 'p']);

                        $('#listWithHandleQuestion').append(
                            '<div class="list-group-item sectionsaprat_' + section_id +
                            ' quesBasedSecList questionaprat_' + res.question_id + '" data-id="' +
                            res.question_id + '" data-section_id="' + section_id +
                            '" style="display:none;">\n' +
                            '<span class="glyphicon glyphicon-move" aria-hidden="true">\n' +
                            '<i class="fa-solid fa-grip-vertical"></i>\n' +
                            '</span>\n' +
                            '<button class="btn btn-primary" value="' + res.question_id + '">' + 
                            question + '</button>\n' +
                            '</div>');
                        MathJax.Hub.Queue(["Typeset", MathJax.Hub, 'p']);
                        questionCount++;
                    }
                });
            }
            setEmptyValue(questionType);

            var sectionCount = $('.sectionListtype').length;

            if (sectionCount > 1) {
                var optionCount = '<option value="">Select</option>';
                for (var k = 1; k <= sectionCount; k++) {
                    optionCount += '<option value="' + k + '">' + k + '</option>';
                }
                setTimeout(function() {
                    $(".sectionOrder").html(optionCount);
                }, 1000);
            }

            return false;

        });

        jQuery(document).on('change', '.sectionOrder', function() {
            var section_id = $('.sectionAddId').val();
            var order_num = $(this).val();
            if (order_num == '' && order_num < 1) {
                order_num = 1;
            }
            $.ajax({
                data: {
                    'section_order': order_num,
                    'section_id': section_id,
                    '_token': $('input[name="_token"]').val()
                },
                url: '{{ route('sectionOrder') }}',
                method: 'post',
                success: (res) => {}
            });
        });

        //new function for edit
        function practQuestioDel(id) {
            var result = confirm('Are you sure to remove ?');
            if (!result) {
                return false;
            }
            questionCount--;
            questionOrder--;
            $.ajax({
                data: {
                    'id': id,
                    '_token': $('input[name="_token"]').val()
                },
                url: '{{ route('deletePracticeQuestionById') }}',
                method: 'post',
                success: (res) => {
                    $.each(res.question_ids, function(key, val) {
                        $(`.orderValUpdate_${key}`).text(val.question_order);
                        $(`.answerValUpdate_${key}`).text(val.answer);
                        $('.editSelectedAnswerType').val(val.type);
                    });
                    $('.singleQuest_' + id).remove();
                }
            });
        }

        function handleEval(val) {
            try {
                return eval(val);
            } catch (error) {
                return '';
            }
        }

        function practQuestioEdit(id) {
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
                    $.each(res.super, function(i, v) {
                        super_cat_option += `<option value=${v['id']}>${v['title']}</option>`;
                    });

                    let cat_type_option = ``;
                    $.each(res.category, function(i, v) {
                        cat_type_option +=
                            `<option value=${v['id']}>${v['category_type_title']}</option>`;
                    });

                    let question_type_option = ``;
                    $.each(res.questionType, function(i, v) {
                        question_type_option +=
                            `<option value=${v['id']}>${v['question_type_title']}</option>`;
                    });

                    const sections = ['', 'oneInFiveOdd_', 'oneInFiveEven_', 'oneInFourOdd_', 'oneInFourEven_',
                        'oneInFourPassEven_', 'choiceMultInFourFill_', 'cb_choiceMultInFourFill_'
                    ]
                    const answers = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K'];
                    sections.forEach(section => {
                        answers.forEach(answer => {
                            $(`select[name="${section}edit_category_type_${answer}"`).html('');
                            $(`select[name="${section}edit_super_category_${answer}"`).html('');
                            $(`select[name="${section}edit_search-input_${answer}"`).html('');

                            $(`select[name="${section}edit_super_category_${answer}"`).append(
                                super_cat_option);
                            $(`select[name="${section}edit_category_type_${answer}"`).append(
                                cat_type_option);
                            $(`select[name="${section}edit_search-input_${answer}"`).append(
                                question_type_option);
                        });
                    });

                    //
                    $.ajax({
                        data: {
                            'question_id': id,
                            '_token': $('input[name="_token"]').val()
                        },
                        url: '{{ route('getPracticeQuestionById') }}',
                        method: 'post',
                        success: (res) => {
                            if (res.question.length > 0) {
                                var result = res.question[0];

                                let questionType = result.type;
                                let disp_section;
                                if (questionType == 'choiceOneInFive_Odd') {
                                    disp_section = 'oneInFiveOdd_';
                                } else if (questionType == 'choiceOneInFourPass_Odd') {
                                    disp_section = '';
                                } else if (questionType == 'choiceOneInFour_Odd') {
                                    disp_section = 'oneInFourOdd_';
                                } else if (questionType == 'choiceOneInFour_Even') {
                                    disp_section = 'oneInFourEven_';
                                } else if (questionType == 'choiceOneInFive_Even') {
                                    disp_section = 'oneInFiveEven_';
                                } else if (questionType == 'choiceOneInFourPass_Even') {
                                    disp_section = 'oneInFourPassEven_';
                                } else if (questionType == 'choiceMultInFourFill') {
                                    ans_choices = ['A', 'B', 'C', 'D'];
                                    if (result.multiChoice == '1') {
                                        disp_section = 'cb_choiceMultInFourFill_';
                                    } else if (result.multiChoice == '3') {
                                        disp_section = 'choiceMultInFourFill_';
                                    } else if (result.multiChoice == '2') {
                                        disp_section = 'fc_';
                                    }
                                }

                                let checkbox_values_Arr = JSON.parse(result.checkbox_values);
                                let super_category_values_Arr = JSON.parse(result
                                    .super_category_values);
                                let category_type_values_Arr = JSON.parse(result
                                    .category_type_values);
                                let question_type_values_Arr = JSON.parse(result
                                    .question_type_values);

                                for (let key in super_category_values_Arr) {
                                    if (super_category_values_Arr.hasOwnProperty(key)) {
                                        let values = super_category_values_Arr[key];
                                        for (let index = 1; index < super_category_values_Arr[key]
                                            .length; index++) {
                                            addNewTypes(key, index, 'repet', disp_section,
                                                super_cat_option, cat_type_option,
                                                question_type_option);
                                        }
                                    }
                                }

                                $('.edit_guessing_value').val('');
                                let guessing_value_arr = JSON.parse(result.guessing_value);
                                for (let key in guessing_value_arr) {
                                    if (guessing_value_arr.hasOwnProperty(key)) {
                                        $(guessing_value_arr[key]).each((i,v) => {
                                            $(`#${disp_section}edit_guessing_value_${key}`).val(v);
                                        });
                                    }
                                }
                            
                                
                                $('#diffValueEdit').val(result.diff_value);
                                $('#discValueEdit').val(result.disc_value);

                                $('#editQuestionOrder').val(result.question_order);
                                $('#editCurrentModelQueId').val(result.id);

                                $('#diffValue').val(result.diff_value);
                                $('#discValue').val(result.disc_value);

                                $('#quesFormat').val(result.format);
                                $('.sectionAddId').val(result.practice_test_sections_id);
                                $('#edittestSectionTypeRead').val(result.type);
                                $('#new_question_type_select').val(result.question_type_id);
                                $('#category_type').val(result.category_type);
                                $('#editSelectedAnswerType').val(result.type);
                                $('#diff_rating_edit').val(result.diff_rating).trigger('change');
                                // $('#super_category_edit').val(result.super_category).trigger('change');
                                $('#question_tags_edit').val(result.tags).trigger('change');
                                CKEDITOR.instances['js-ckeditor-edit-addQue'].setData(result.title);
                                let section_type = $(
                                        `.selectedSection_${result.practice_test_sections_id}`)
                                    .val();
                                $('#section_type').val(section_type);
                                // $('#question_tags_edit').val(result.tags).trigger('change');
                                $(".passNumber").val(result.passage_number).change();
                                // for (let index = 1; index < categorytypeArr.length; index++) {
                                //     addNewTypes(index,'repet');
                                // }
                                //new
                                if (result.passages_id != null) {
                                    $('input[name="passageRequired_2"]').prop('checked', true);
                                    $('#edit_passage_number').prop("disabled", false);
                                    $('select[name="editPassagesType"]').prop("disabled", false);
                                } else {
                                    $('input[name="passageRequired_2"]').prop('checked', false);
                                    $('#edit_passage_number').prop("disabled", true);
                                    $('select[name="editPassagesType"]').prop("disabled", true);
                                }

                                // setTimeout(function(){ 
                                //For checkbox
                                for (let key in checkbox_values_Arr) {
                                    if (checkbox_values_Arr.hasOwnProperty(key)) {
                                        $(checkbox_values_Arr[key]).each((i, v) => {
                                            $(`#${disp_section}edit_ct_checkbox_${key}_${i}`)
                                                .prop('checked', v == 1);
                                        });
                                    }
                                }


                                //For guessing value
                                for (let key in checkbox_values_Arr) {
                                    if (checkbox_values_Arr.hasOwnProperty(key)) {
                                        $(checkbox_values_Arr[key]).each((i,v) => {
                                            $(`#${disp_section}edit_ct_checkbox_${key}_${i}`).prop('checked', v==1);
                                        });
                                    }
                                }


                                //For super category
                                for (let key in super_category_values_Arr) {
                                    if (super_category_values_Arr.hasOwnProperty(key)) {
                                        $(super_category_values_Arr[key]).each((i, v) => {
                                            $(`#${disp_section}edit_super_category_${key}_${i}`)
                                                .val(v);
                                            $(`#${disp_section}edit_super_category_${key}_${i}`)
                                                .trigger('change');
                                        });
                                    }
                                }

                                //For Category type
                                for (let key in category_type_values_Arr) {
                                    if (category_type_values_Arr.hasOwnProperty(key)) {
                                        $(category_type_values_Arr[key]).each((i, v) => {
                                            $(`#${disp_section}edit_category_type_${key}_${i}`)
                                                .val(v);
                                            $(`#${disp_section}edit_category_type_${key}_${i}`)
                                                .trigger('change');
                                        });
                                    }
                                }

                                //For Question Type
                                for (let key in question_type_values_Arr) {
                                    if (question_type_values_Arr.hasOwnProperty(key)) {
                                        $(question_type_values_Arr[key]).each((i, v) => {
                                            $(`#${disp_section}edit_search-input_${key}_${i}`)
                                                .val(v);
                                            $(`#${disp_section}edit_search-input_${key}_${i}`)
                                                .trigger('change');
                                        });
                                    }
                                }
                                // }, 1000);

                                // $('.edit-plus-button').attr('data-id', categorytypeArr && categorytypeArr.length ? categorytypeArr.length : 0);


                                $.ajax({
                                    data: {
                                        'format': result.format,
                                        '_token': $('input[name="_token"]').val()
                                    },
                                    url: '{{ route('getPracticePassage') }}',
                                    method: 'post',
                                    success: (passRes) => {
                                        var opt = '';
                                        $.each(passRes, function(key, val) {
                                            if (val.id == passRes.passages_id) {
                                                opt += '<option value="' + val
                                                    .id +
                                                    '" selected="selected">' +
                                                    val.title + '</option>';
                                            } else {
                                                opt += '<option value="' + val
                                                    .id + '">' + val.title +
                                                    '</option>';
                                            }
                                        });
                                        $('.editPassagesType').html(opt);
                                        $("select[name=editPassagesType]").val(result
                                            .passages_id).trigger('change');
                                    }
                                });
                                getAnswerOptions(result.type, result.answer, result.fill, result
                                    .fillType, result.answer_content, result.answer_exp, result
                                    .format, result.multiChoice);
                            }
                            $('#editQuestionMultiModal').modal('show');
                            $(`.editMultipleChoice option[value="${parseInt(result.multiChoice)}"]`)
                                .prop('selected', true);
                            $(".editMultipleChoice").trigger("change");
                        }
                    });
                }
            });
        }

        function getAnswerOptions(answerOpt, selectedOpt, fill, fillType, answer_content, answer_exp, format, multiChoice) {
            answer_exp = JSON.parse(answer_exp);
            if (answerOpt == 'choiceOneInFour_Odd') {

                $('#editSelectedAnswerType').val('choiceOneInFour_Odd');
                $('.choiceOneInFour_Odd').show();
                $('.choiceOneInFour_Even').hide();
                $('.choiceOneInFive_Odd').hide();
                $('.choiceOneInFive_Even').hide();
                $('.choiceOneInFourPass_Odd').hide();
                $('.choiceOneInFourPass_Even').hide();
                $('.choiceMultInFourFill').hide(); 

                var optObj = ['a', 'b', 'c', 'd'];
                var jsonConvert = [];
                // if(isJson(answer_content)){
                jsonConvert = JSON.parse(answer_content);
                // }
                var selHml = '';
                for (var i = 1; i <= optObj.length; i++) {
                    var arrIndex = Number(i) - 1;
                    var editInd = Number(i) + 1;
                    if (optObj[arrIndex] == selectedOpt) {
                        $('.choiceOneInFour_Odd ul li.choiceOneInFour_OddAnswer_' + arrIndex + ' input[type="radio"] ')
                            .prop("checked", true);
                    }
                    if (jsonConvert.length > 0) {
                        var anwserInd = Number(i) - 1;
                        var dynIds = 'editChoiceOneInFour_OddAnswer_' + i;
                        CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]);
                    }
                }
                if (answer_exp && answer_exp.length != null) {
                    for (let index = 0; index < answer_exp.length; index++) {
                        let count = index + 1;
                        const answer_id = `editchoiceOneInFour_Odd_explanation_answer_${count}`;
                        CKEDITOR.instances[answer_id].setData(answer_exp[index]);
                    }
                }
            }

            // new
            if (answerOpt == 'choiceOneInFour_Even') {
                $('#editSelectedAnswerType').val('choiceOneInFour_Even');
                $('.choiceOneInFour_Odd').hide();
                $('.choiceOneInFour_Even').show();
                $('.choiceOneInFive_Odd').hide();
                $('.choiceOneInFive_Even').hide();
                $('.choiceOneInFourPass_Odd').hide();
                $('.choiceOneInFourPass_Even').hide();
                $('.choiceMultInFourFill').hide();

                var optObj = ['f', 'g', 'h', 'j'];
                var jsonConvert = [];
                // if(isJson(answer_content)){
                jsonConvert = JSON.parse(answer_content);
                // }
                var selHml = '';
                for (var i = 1; i <= optObj.length; i++) {
                    var arrIndex = Number(i) - 1;
                    var editInd = Number(i) + 1;
                    if (optObj[arrIndex] == selectedOpt) {
                        $('.choiceOneInFour_Even ul li.choiceOneInFour_EvenAnswer_' + arrIndex + ' input[type="radio"] ')
                            .prop("checked", true);
                    }
                    if (jsonConvert.length > 0) {
                        var anwserInd = Number(i) - 1;
                        var dynIds = 'editChoiceOneInFour_EvenAnswer_' + i;
                        CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]);
                    }
                }
                if (answer_exp && answer_exp.length != null) {
                    for (let index = 0; index < answer_exp.length; index++) {
                        let count = index + 1;
                        const answer_id = `editchoiceOneInFour_Even_explanation_answer_${count}`;
                        CKEDITOR.instances[answer_id].setData(answer_exp[index]);
                    }
                }
            }

            if (answerOpt == 'choiceOneInFive_Odd') {
                $('#editSelectedAnswerType').val('choiceOneInFive_Odd');
                $('.choiceOneInFour_Odd').hide();
                $('.choiceOneInFour_Even').hide();
                $('.choiceOneInFive_Odd').show();
                $('.choiceOneInFive_Even').hide();
                $('.choiceOneInFourPass_Odd').hide();
                $('.choiceOneInFourPass_Even').hide();
                $('.choiceMultInFourFill').hide();

                var optObj = ['a', 'b', 'c', 'd', 'e'];
                var selHml = '';
                var jsonConvert = [];
                // if(isJson(answer_content)){
                jsonConvert = JSON.parse(answer_content);
                // }
                for (var i = 1; i <= optObj.length; i++) {
                    var arrIndex = Number(i) - 1;
                    var editInd = Number(i) + 1;
                    if (optObj[arrIndex] == selectedOpt) {
                        $('.choiceOneInFive_Odd ul li.choiceOneInFive_Odd_Answer_' + arrIndex + ' input[type="radio"] ')
                            .prop("checked", true);
                    }
                    if (jsonConvert.length > 0) {
                        var anwserInd = Number(i) - 1;
                        var dynIds = 'editChoiceOneInFive_Odd_Answer_' + i;
                        CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]);
                    }
                }
                if (answer_exp && answer_exp.length != null) {
                    for (let index = 0; index < answer_exp.length; index++) {
                        let count = index + 1;
                        const answer_id = `editchoiceOneInFive_Odd_explanation_answer_odd${count}`;
                        CKEDITOR.instances[answer_id].setData(answer_exp[index]);
                    }
                }
            }

            // new
            if (answerOpt == 'choiceOneInFive_Even') {
                $('#editSelectedAnswerType').val('choiceOneInFive_Even');
                $('.choiceOneInFour_Odd').hide();
                $('.choiceOneInFour_Even').hide();
                $('.choiceOneInFive_Odd').hide();
                $('.choiceOneInFive_Even').show();
                $('.choiceOneInFourPass_Odd').hide();
                $('.choiceOneInFourPass_Even').hide();
                $('.choiceMultInFourFill').hide();

                var optObj = ['f', 'g', 'h', 'j', 'k'];
                var selHml = '';
                var jsonConvert = [];
                // if(isJson(answer_content)){
                jsonConvert = JSON.parse(answer_content);
                // }
                for (var i = 1; i <= optObj.length; i++) {
                    var arrIndex = Number(i) - 1;
                    var editInd = Number(i) + 1;
                    if (optObj[arrIndex] == selectedOpt) {
                        $('.choiceOneInFive_Even ul li.choiceOneInFive_Even_Answer_' + arrIndex + ' input[type="radio"] ')
                            .prop("checked", true);
                    }
                    if (jsonConvert.length > 0) {
                        var anwserInd = Number(i) - 1;
                        var dynIds = 'editChoiceOneInFive_Even_Answer_' + i;
                        CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]);
                    }
                }
                if (answer_exp && answer_exp.length != null) {
                    for (let index = 0; index < answer_exp.length; index++) {
                        let count = index + 1;
                        const answer_id = `editchoiceOneInFive_Even_explanation_answer_even${count}`;
                        CKEDITOR.instances[answer_id].setData(answer_exp[index]);
                    }
                }
            }

            if (answerOpt == 'choiceOneInFourPass_Odd') {
                $('#editSelectedAnswerType').val('choiceOneInFourPass_Odd');
                $('.choiceOneInFour_Odd').hide();
                $('.choiceOneInFour_Even').hide();
                $('.choiceOneInFive_Odd').hide();
                $('.choiceOneInFive_Even').hide();
                $('.choiceOneInFourPass_Odd').show();
                $('.choiceOneInFourPass_Even').hide();
                $('.choiceMultInFourFill').hide();

                var optObj = ['a', 'b', 'c', 'd'];
                var selHml = '';
                var jsonConvert = [];
                // if(isJson(answer_content)){
                jsonConvert = JSON.parse(answer_content);
                // }

                for (var i = 1; i <= optObj.length; i++) {
                    var arrIndex = Number(i) - 1;
                    var editInd = Number(i) + 1;
                    if (optObj[arrIndex] == selectedOpt) {
                        $('.choiceOneInFourPass_Odd ul li.choiceOneInFourPass_OddAnswer_' + arrIndex +
                            ' input[type="radio"]').prop("checked", true);
                    }
                    if (jsonConvert.length > 0) {
                        var anwserInd = Number(i) - 1;
                        var dynIds = 'editChoiceOneInFourPass_OddAnswer_' + i;
                        CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]);
                    }
                }
                if (answer_exp && answer_exp.length != null) {
                    for (let index = 0; index < answer_exp.length; index++) {
                        let count = index + 1;
                        const answer_id = `editchoiceOneInFourPass_Odd_explanation_answer_${count}`;
                        CKEDITOR.instances[answer_id].setData(answer_exp[index]);
                    }
                }
            }

            // new
            if (answerOpt == 'choiceOneInFourPass_Even') {
                $('#editSelectedAnswerType').val('choiceOneInFourPass_Even');
                $('.choiceOneInFour_Odd').hide();
                $('.choiceOneInFour_Even').hide();
                $('.choiceOneInFive_Odd').hide();
                $('.choiceOneInFive_Even').hide();
                $('.choiceOneInFourPass_Odd').hide();
                $('.choiceOneInFourPass_Even').show();
                $('.choiceMultInFourFill').hide();

                var optObj = ['f', 'g', 'h', 'j'];
                var selHml = '';
                var jsonConvert = [];
                // if(isJson(answer_content)){
                jsonConvert = JSON.parse(answer_content);
                // }

                for (var i = 1; i <= optObj.length; i++) {
                    var arrIndex = Number(i) - 1;
                    var editInd = Number(i) + 1;
                    if (optObj[arrIndex] == selectedOpt) {
                        $('.choiceOneInFourPass_Even ul li.choiceOneInFourPass_EvenAnswer_' + arrIndex +
                            ' input[type="radio"]').prop("checked", true);
                    }
                    if (jsonConvert.length > 0) {
                        var anwserInd = Number(i) - 1;
                        var dynIds = 'editChoiceOneInFourPass_EvenAnswer_' + i;
                        CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]);
                    }
                }
                if (answer_exp && answer_exp.length != null) {
                    for (let index = 0; index < answer_exp.length; index++) {
                        let count = index + 1;
                        const answer_id = `editchoiceOneInFourPass_Even_explanation_answer_${count}`;
                        CKEDITOR.instances[answer_id].setData(answer_exp[index]);
                    }
                }
            }

            if (answerOpt == 'choiceMultInFourFill') {
                $('#editSelectedAnswerType').val('choiceMultInFourFill');
                $('.choiceOneInFour_Odd').hide();
                $('.choiceOneInFour_Even').hide();
                $('.choiceOneInFive_Odd').hide();
                $('.choiceOneInFive_Even').hide();
                $('.choiceOneInFourPass_Odd').hide();
                $('.choiceOneInFourPass_Even').hide();
                $('.choiceMultInFourFill').show();

                var optObj = ['a', 'b', 'c', 'd'];
                var trimStr = selectedOpt.replace(/ /g, '');
                var multiChecked = trimStr.split(",");
                var selHml = '';
                var jsonConvert = [];

                if (answer_content != null) {
                    jsonConvert = JSON.parse(answer_content);
                }

                var fillHtl = '<input type="text" name="choiceMultInFourFill_fill[]" value="">';

                if (multiChoice == 1) {
                    for (var i = 1; i <= optObj.length; i++) {
                        var arrIndex = Number(i) - 1;
                        var editInd = Number(i) + 1;
                        if (multiChecked.includes(optObj[arrIndex])) {

                            $('.choiceMultInFourFill .withOutFillOpt ul li.choiceMultInFourFillwithOutFillOptAnswer_' +
                                arrIndex + ' input[type="radio"]').prop("checked", true);
                        }
                        if (jsonConvert.length > 0) {
                            var anwserInd = Number(i) - 1;
                            var dynIds = 'editChoiceMultInFourFillAnswer_' + i;
                            CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]);
                        }
                    }
                    if (answer_exp && answer_exp.length != null) {
                        for (let index = 0; index < answer_exp.length; index++) {
                            let count = index + 1;
                            const answer_id = `editchoiceMultInFourFill_explanation_answer_${count}`;
                            CKEDITOR.instances[answer_id].setData(answer_exp[index]);
                        }
                    }
                } else {

                    for (var i = 1; i <= optObj.length; i++) {
                        var arrIndex = Number(i) - 1;
                        var editInd = Number(i) + 1;
                        if (selectedOpt == optObj[arrIndex]) {

                            $('.choiceMultInFourFill .withOutFillOptChoice ul li.choiceMultInFourFillwithOutFillOptChoiceAnswer_' +
                                arrIndex + ' input[type="radio"]').prop("checked", true);
                        }
                        if (jsonConvert.length > 0) {
                            var anwserInd = Number(i) - 1;
                            var dynIds = 'editChoiceMultiChoiceInFourFill_' + i;
                            CKEDITOR.instances[dynIds].setData(jsonConvert[anwserInd]);
                        }
                    }
                    if (answer_exp && answer_exp.length != null) {
                        for (let index = 0; index < answer_exp.length; index++) {
                            let count = index + 1;
                            const answer_id = `editchoiceMultiChoiceInFourFill_explanation_answer_${count}`;
                            CKEDITOR.instances[answer_id].setData(answer_exp[index]);
                        }
                    }
                }

                var arrFillType = ['number', 'decimal', 'fraction'];
                var optType = '';

                for (var j = 0; j < arrFillType.length; j++) {
                    if (arrFillType[j] == arrFillType) {
                        optType += '<option value="' + arrFillType[j] + '" selected="selected">' + arrFillType[j]
                            .toUpperCase() + '</option>';
                    } else {
                        optType += '<option value="' + arrFillType[j] + '">' + arrFillType[j].toUpperCase() + '</option>';
                    }
                }

                var fillDiv = '';
                var fillTypeDiv = 'none';

                if (fill != null && fill != '' && fill != 'N/A') {
                    var objFill = fill.split(',');

                    if (typeof objFill !== 'undefined' && objFill.length !== 0) {
                        fillHtl = '';
                        for (var j = 0; j < objFill.length; j++) {
                            fillHtl += '<input type="text" name="choiceMultInFourFill_fill[]" value="' + objFill[j] + '">';
                        }
                    }
                    $('.withOutFillOpt').hide();
                    $('.withOutFillOptChoice').hide();
                    $('.withFillOpt').show();
                } else {
                    if (multiChoice == 1) {
                        $('.withOutFillOpt').show();
                        $('.withOutFillOptChoice').hide();
                        $('.withFillOpt').hide();
                    } else {
                        $('.editMultipleChoice').val(3);
                        $('.withOutFillOpt').hide();
                        $('.withOutFillOptChoice').show();
                        $('.withFillOpt').hide();
                    }
                }
                var seletedLayout =
                    '<div class="mb-2"><label class="form-label" style="font-size: 13px;">Fill Type:</label><select name="choiceMultInFourFill_filltype"  class="form-control choiceMultInFourFill_filltype">' +
                    optType +
                    '</select> </div><div class="mb-2"> <label class="form-label" style="font-size: 13px;">Fill:</label> <label class="form-label editExtraFillOption" style="font-size: 13px;">' +
                    fillHtl +
                    '</label><label class="form-label" style="font-size: 13px;"><a href="javascript:;" onClick="editMoreFillOption();" class="switchMulti">Add More Options</a></label></div>';
                $('.withFillOptmb2').html(seletedLayout);

                $('#fc_edit_super_category_A_0').select2({
                    dropdownParent: $('#editQuestionMultiModal'),
                    tags: true,
                    placeholder : "Select Super Category",
                    maximumSelectionLength: 1
                });

                $('#fc_edit_category_type_A_0').select2({
                    dropdownParent: $('#editQuestionMultiModal'),
                    tags: true,
                    placeholder : "Select Category type",
                    maximumSelectionLength: 1
                });

                $('#fc_edit_search-input_A_0').select2({
                    dropdownParent: $('#editQuestionMultiModal'),
                    tags: true,
                    placeholder : "Select Question type",
                    maximumSelectionLength: 1
                });
            }
        }

        $('.update_question_section').click(function() {
            $('.sectionTypesFull').show();
            var test_source = $('#source option:selected').val();
            var currentModelQueId = $('#editCurrentModelQueId').val();
            var format = $('#quesFormat').val();
            var fill = 'N/A';
            var fillType = 'N/A';
            var answerType = 'N/A';
            var fillVals = [];
            var multiChoice = '';
            // var tags = $('input[name="tags"]').val();
            var tags = $("#question_tags_edit").val();
            var difficulty = $('#diff_rating_edit').val();

            var activeAnswerType = '.' + $('#editSelectedAnswerType').val();
            // console.log('activeAnswerType>>'+activeAnswerType);
            var questionType = $('#editQuestionMultiModal ' + activeAnswerType + ' #editQuestionType').val();
            // console.log('questionType>>'+questionType);

            var diffValue = $('#diffValueEdit').val();
            var discValue =  $('#discValueEdit').val();

            multiChoice = $('.editMultipleChoice option:selected').val();

            let ans_choices;
            let disp_section = '';
            if (questionType == 'choiceOneInFive_Odd') {
                ans_choices = ['A', 'B', 'C', 'D', 'E'];
                disp_section = 'oneInFiveOdd_';
            } else if (questionType == 'choiceOneInFourPass_Odd') {
                ans_choices = ['A', 'B', 'C', 'D'];
                disp_section = '';
            } else if (questionType == 'choiceOneInFour_Odd') {
                ans_choices = ['A', 'B', 'C', 'D'];
                disp_section = 'oneInFourOdd_';
            } else if (questionType == 'choiceOneInFour_Even') {
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
                // if (multiChoice == '1') {
                //     disp_section = 'cb_choiceMultInFourFill_';
                // } else if (multiChoice == '3') {
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
                checkboxValues[ans_choice] = $(
                        `input[name="${disp_section}edit_ct_checkbox_${ans_choice}"]`)
                    .map(function(i, v) {
                        return $(v).is(':checked') ? 1 : 0;
                    })
                    .get();
            });


            //For Guessing Values
            const guessingValue = {};
            ans_choices.forEach(ans_choice => {
                const selectElements = $(`input[name="${disp_section}edit_guessing_value_${ans_choice}"]`);
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

            var question = CKEDITOR.instances['js-ckeditor-edit-addQue'].getData();
            var activeAnswerType = '.' + $('#editSelectedAnswerType').val();
            var questionType = $('#editQuestionMultiModal ' + activeAnswerType + ' #editQuestionType').val();
            // var pass = ''; //CKEDITOR.instances['js-ckeditor-passquestion'].getData();
            var pass = $('select[name="editPassagesType"] :selected').text();
            var passNumber = $('#editQuestionMultiModal .passNumber').val();
            var passagesType = $('.editPassagesType').val();
            var passagesTypeTxt = $(".editPassagesType option:selected").text();
            var testSectionType = $('#testSectionTypeRead').val();

            var ifFillChoice = $('.editMultipleChoice').val();
            var questTypeArr = ['ACT','SAT','PSAT'];
            if((jQuery.inArray(format, questTypeArr) != -1) || (ifFillChoice == 2)) {
                if ($('#passageRequired_2').is(':checked')) {
                    // console.log('checked 1');
                    if (
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
                            // const get_guessingValue = guessingValue[choice];

                            return (
                                (super_category_values && super_category_values?.length) === 0 ||
                                get_category_type_values.length === 0 ||
                                // get_guessingValue.length === 0 ||
                                get_question_type_values.length === 0
                            );
                        })
                    ) {
                        // console.log('checked 2');
                        $('#editQuestionMultiModal #questionError').text(question == '' ? 'Question is required!' : '');
                        $('#js-ckeditor-edit-addQue').focus();
                        $('#editQuestionMultiModal #tagError').text(tags == '' ? 'Tag is required!' : '');
                        $('#questionTag').focus();
                        $('#editQuestionMultiModal #passNumberError').text(jQuery.type(passNumber) == 'null' ?
                            'Passage Number is required!' : '');
                        $('#edit_passage_number').focus();
                        $('#editQuestionMultiModal #passageTypeError').text(jQuery.type(passagesType) == 'null' ?
                            'Passage Type is required!' : '');
                        $('#edit_passage_type').focus();

                        ans_choices.forEach(choice => {
                            const super_category_values = superCategoryValues[choice];
                            const get_category_type_values = getCategoryTypeValues[choice];
                            const get_question_type_values = getQuestionTypeValues[choice];
                            // const get_guessingValue = guessingValue[choice];

                            $(`#editQuestionMultiModal #${disp_section}superCategoryError_${choice}`).text(
                                !super_category_values || super_category_values.length == 0 ?
                                'Super Category is required!' : '');
                            $(`#editQuestionMultiModal #${disp_section}categoryTypeError_${choice}`).text(
                                get_category_type_values.length == 0 ? 'Category type is required!' : '');
                            $(`#editQuestionMultiModal #${disp_section}questionTypeError_${choice}`).text(
                                get_question_type_values.length == 0 ? 'Question type is required!' : '');

                            // $(`#editQuestionMultiModal #${disp_section}edit_guessing_valueE_${choice}`).text(
                            //     get_guessingValue.length == 0 ? 'Guessing Value is required!' : '');
                        
                        });

                        return false;
                    } else {
                        // console.log('checked 3');
                        $('#editQuestionMultiModal #questionError').text('');
                        $('#editQuestionMultiModal #tagError').text('');
                        $('#editQuestionMultiModal #passNumberError').text('');
                        $('#editQuestionMultiModal #passageTypeError').text('');

                        ans_choices.forEach(ans_choice => {
                            $(`#editQuestionMultiModal #${disp_section}superCategoryError_${ans_choice}`).text(
                                '');
                            $(`#editQuestionMultiModal #${disp_section}categoryTypeError_${ans_choice}`).text(
                                '');
                            $(`#editQuestionMultiModal #${disp_section}questionTypeError_${ans_choice}`).text(
                                '');
                            // $(`#editQuestionMultiModal #${disp_section}edit_guessing_valueE_${ans_choice}`).text('');
                        });
                    }
                } else {
                    // console.log('checked 4');
                    if (question == '' ||
                        tags == 0 ||
                        format == '' ||
                        testSectionType == '' ||
                        ans_choices.some(choice => {
                            const super_category_values = superCategoryValues[choice];
                            const get_category_type_values = getCategoryTypeValues[choice];
                            const get_question_type_values = getQuestionTypeValues[choice];
                            // const get_guessingValue = guessingValue[choice];

                            return (
                                (super_category_values && super_category_values?.length) === 0 ||
                                get_category_type_values.length === 0 ||
                                // get_guessingValue.length === 0 ||
                                get_question_type_values.length === 0
                            );
                        })
                    ) {
                        $('#editQuestionMultiModal #questionError').text(question == '' ? 'Question is required!' : '');
                        $('#js-ckeditor-edit-addQue').focus();
                        $('#editQuestionMultiModal #tagError').text(tags == '' ? 'Tag is required!' : '');
                        $('#questionTag').focus();

                        ans_choices.forEach(choice => {
                            const super_category_values = superCategoryValues[choice];
                            const get_category_type_values = getCategoryTypeValues[choice];
                            const get_question_type_values = getQuestionTypeValues[choice];
                            // const get_guessingValue = guessingValue[choice];

                            $(`#editQuestionMultiModal #${disp_section}superCategoryError_${choice}`).text(
                                !super_category_values || super_category_values.length == 0 ?
                                'Super Category is required!' : '');
                            $(`#editQuestionMultiModal #${disp_section}categoryTypeError_${choice}`).text(
                                get_category_type_values.length == 0 ? 'Category type is required!' : '');
                            $(`#editQuestionMultiModal #${disp_section}questionTypeError_${choice}`).text(
                                get_question_type_values.length == 0 ? 'Question type is required!' : '');
                            
                            // $(`#editQuestionMultiModal #${disp_section}edit_guessing_valueE_${choice}`).text(
                            //     get_guessingValue.length == 0 ? 'Guessing Value is required!' : '');
                            
                        });
                        return false;
                    } else {

                        // console.log('checked 5');
                        $('#editQuestionMultiModal #questionError').text('');
                        $('#editQuestionMultiModal #tagError').text('');

                        ans_choices.forEach(ans_choice => {
                            $(`#editQuestionMultiModal #${disp_section}superCategoryError_${ans_choice}`).text(
                                '');
                            $(`#editQuestionMultiModal #${disp_section}categoryTypeError_${ans_choice}`).text(
                                '');
                            $(`#editQuestionMultiModal #${disp_section}questionTypeError_${ans_choice}`).text(
                                '');
                            // $(`#editQuestionMultiModal #${disp_section}edit_guessing_valueE_${ans_choice}`).text('');
                        });
                    }
                }
            }else{
                if ($('#passageRequired_2').is(':checked')) {
                    // console.log('checked 1 not fill choice');
                    if (
                        question == '' ||
                        tags.length == 0 ||
                        jQuery.type(passNumber) == "null" ||
                        passagesType == '' ||
                        diffValue == '' ||
                        discValue == '' ||
                        format == '' ||
                        testSectionType == '' ||
                        ans_choices.some(choice => {
                            const super_category_values = superCategoryValues[choice];
                            const get_category_type_values = getCategoryTypeValues[choice];
                            const get_question_type_values = getQuestionTypeValues[choice];
                            const get_guessingValue = guessingValue[choice];

                            return (
                                (super_category_values && super_category_values?.length) === 0 ||
                                get_category_type_values.length === 0 ||
                                get_guessingValue.length === 0 ||
                                get_question_type_values.length === 0
                            );
                        })
                    ) {
                        $('#editQuestionMultiModal #questionError').text(question == '' ? 'Question is required!' : '');
                        $('#js-ckeditor-edit-addQue').focus();
                        $('#editQuestionMultiModal #tagError').text(tags == '' ? 'Tag is required!' : '');
                        $('#questionTag').focus();
                        $('#editQuestionMultiModal #passNumberError').text(jQuery.type(passNumber) == 'null' ?
                            'Passage Number is required!' : '');
                        $('#edit_passage_number').focus();
                        $('#editQuestionMultiModal #passageTypeError').text(jQuery.type(passagesType) == 'null' ?
                            'Passage Type is required!' : '');
                        $('#edit_passage_type').focus();

                        $('#editQuestionMultiModal #diffValueError').text(diffValue == '' ? 'Diff value is required!' : '');
                        $('#diffValueEdit').focus();
                        $('#editQuestionMultiModal #discValueError').text(discValue == '' ? 'Disc value is required!' : '');
                        $('#discValueEdit').focus();

                        ans_choices.forEach(choice => {
                            const super_category_values = superCategoryValues[choice];
                            const get_category_type_values = getCategoryTypeValues[choice];
                            const get_question_type_values = getQuestionTypeValues[choice];
                            const get_guessingValue = guessingValue[choice];

                            $(`#editQuestionMultiModal #${disp_section}superCategoryError_${choice}`).text(
                                !super_category_values || super_category_values.length == 0 ?
                                'Super Category is required!' : '');
                            $(`#editQuestionMultiModal #${disp_section}categoryTypeError_${choice}`).text(
                                get_category_type_values.length == 0 ? 'Category type is required!' : '');
                            $(`#editQuestionMultiModal #${disp_section}questionTypeError_${choice}`).text(
                                get_question_type_values.length == 0 ? 'Question type is required!' : '');

                            $(`#editQuestionMultiModal #${disp_section}edit_guessing_valueE_${choice}`).text(
                                get_guessingValue.length == 0 ? 'Guessing Value is required!' : '');
                        
                        });

                        return false;
                    } else {
                        $('#editQuestionMultiModal #questionError').text('');
                        $('#editQuestionMultiModal #tagError').text('');
                        $('#editQuestionMultiModal #passNumberError').text('');
                        $('#editQuestionMultiModal #passageTypeError').text('');

                        $('#editQuestionMultiModal #diffValueError').text('');
                        $('#editQuestionMultiModal #discValueError').text('');

                        ans_choices.forEach(ans_choice => {
                            $(`#editQuestionMultiModal #${disp_section}superCategoryError_${ans_choice}`).text(
                                '');
                            $(`#editQuestionMultiModal #${disp_section}categoryTypeError_${ans_choice}`).text(
                                '');
                            $(`#editQuestionMultiModal #${disp_section}questionTypeError_${ans_choice}`).text(
                                '');
                            $(`#editQuestionMultiModal #${disp_section}edit_guessing_valueE_${ans_choice}`).text('');
                        });
                    }
                } else {
                    if (question == '' ||
                        tags == 0 ||
                        format == '' ||
                        diffValue == '' ||
                        discValue == '' ||
                        testSectionType == '' ||
                        ans_choices.some(choice => {
                            const super_category_values = superCategoryValues[choice];
                            const get_category_type_values = getCategoryTypeValues[choice];
                            const get_question_type_values = getQuestionTypeValues[choice];
                            const get_guessingValue = guessingValue[choice];

                            return (
                                (super_category_values && super_category_values?.length) === 0 ||
                                get_category_type_values.length === 0 ||
                                get_guessingValue.length === 0 ||
                                get_question_type_values.length === 0
                            );
                        })
                    ) {
                        $('#editQuestionMultiModal #questionError').text(question == '' ? 'Question is required!' : '');
                        $('#js-ckeditor-edit-addQue').focus();
                        $('#editQuestionMultiModal #tagError').text(tags == '' ? 'Tag is required!' : '');
                        $('#questionTag').focus();

                        $('#editQuestionMultiModal #diffValueError').text(diffValue == '' ? 'Diff value is required!' : '');
                        $('#diffValueEdit').focus();
                        $('#editQuestionMultiModal #discValueError').text(discValue == '' ? 'Disc value is required!' : '');
                        $('#discValueEdit').focus();

                        ans_choices.forEach(choice => {
                            const super_category_values = superCategoryValues[choice];
                            const get_category_type_values = getCategoryTypeValues[choice];
                            const get_question_type_values = getQuestionTypeValues[choice];
                            const get_guessingValue = guessingValue[choice];

                            $(`#editQuestionMultiModal #${disp_section}superCategoryError_${choice}`).text(
                                !super_category_values || super_category_values.length == 0 ?
                                'Super Category is required!' : '');
                            $(`#editQuestionMultiModal #${disp_section}categoryTypeError_${choice}`).text(
                                get_category_type_values.length == 0 ? 'Category type is required!' : '');
                            $(`#editQuestionMultiModal #${disp_section}questionTypeError_${choice}`).text(
                                get_question_type_values.length == 0 ? 'Question type is required!' : '');
                            
                            $(`#editQuestionMultiModal #${disp_section}edit_guessing_valueE_${choice}`).text(
                                get_guessingValue.length == 0 ? 'Guessing Value is required!' : '');
                            
                        });
                        return false;
                    } else {
                        $('#editQuestionMultiModal #questionError').text('');
                        $('#editQuestionMultiModal #tagError').text('');

                        $('#editQuestionMultiModal #diffValueError').text('');
                        $('#editQuestionMultiModal #discValueError').text('');

                        ans_choices.forEach(ans_choice => {
                            $(`#editQuestionMultiModal #${disp_section}superCategoryError_${ans_choice}`).text(
                                '');
                            $(`#editQuestionMultiModal #${disp_section}categoryTypeError_${ans_choice}`).text(
                                '');
                            $(`#editQuestionMultiModal #${disp_section}questionTypeError_${ans_choice}`).text(
                                '');
                            $(`#editQuestionMultiModal #${disp_section}edit_guessing_valueE_${ans_choice}`).text('');
                        });
                    }
                }
            }

            if ($('#passageRequired_2').is(':checked')) {
                var pass = $('select[name="editPassagesType"] :selected').text();
                var passNumber = $('#editQuestionMultiModal .passNumber').val();
                var passagesType = $('.editPassagesType').val();
                var passagesTypeTxt = $(".editPassagesType option:selected").text();
            } else {
                var pass = '';
                var passNumber = '';
                var passagesType = '';
                var passagesTypeTxt = '';
            }

            if (questionType == 'choiceOneInFourPass_Odd') {

                answerType = $('#editQuestionMultiModal ' + activeAnswerType +
                    ' input[name="choiceOneInFourPass"]:checked').val();

            } else if (questionType == 'choiceOneInFourPass_Even') {

                answerType = $('#editQuestionMultiModal ' + activeAnswerType +
                    ' input[name="choiceOneInFourPass"]:checked').val();

            } else if (questionType == 'choiceOneInFour_Odd') {

                answerType = $('#editQuestionMultiModal ' + activeAnswerType +
                    ' input[name="choiceOneInFour"]:checked').val();

            } else if (questionType == 'choiceOneInFour_Even') {

                answerType = $('#editQuestionMultiModal ' + activeAnswerType +
                    ' input[name="choiceOneInFour"]:checked').val();

            } else if (questionType == 'choiceOneInFive_Odd') {

                answerType = $('#editQuestionMultiModal ' + activeAnswerType +
                    ' input[name="choiceOneInFive"]:checked').val();

            } else if (questionType == 'choiceOneInFive_Even') {

                answerType = $('#editQuestionMultiModal ' + activeAnswerType +
                    ' input[name="choiceOneInFive"]:checked').val();

            } else if (questionType == 'choiceMultInFourFill') {

                fillVals = $('#editQuestionMultiModal ' + activeAnswerType +
                    ' input[name="choiceMultInFourFill_fill[]"]').map(function() {
                    return $(this).val();
                }).get();

                if (typeof fillVals !== 'undefined' && fillVals.length !== 0) {
                    fill = fillVals.join();
                    answerType = fill;
                }
                if ($('#editQuestionMultiModal #EditSelectedLayoutQuestion .choiceMultInFourFill_filltype').val() !=
                    '') {
                    fillType = $(
                            '#editQuestionMultiModal #EditSelectedLayoutQuestion .choiceMultInFourFill_filltype')
                        .val();
                    multiChoice = $('.editMultipleChoice option:selected').val();
                }

                var singleChoM = $('#editQuestionMultiModal ' + activeAnswerType +
                    ' input[name="editChoiceMultiChoiceInFourFill"]:checked').val();

                if (typeof singleChoM !== 'undefined' && singleChoM != null) {

                    answerType = $('#editQuestionMultiModal ' + activeAnswerType +
                        ' input[name="editChoiceMultiChoiceInFourFill"]:checked').val();
                    multiChoice = $('.editMultipleChoice option:selected').val();;

                } else {
                    // multiChoice = 'multiChoice';
                    multiChoice = $('.editMultipleChoice option:selected').val();
                    var answerMap = '';
                    var checkIDs = $('#editQuestionMultiModal ' + activeAnswerType +
                        ' input[name="choiceMultInFourFill[]"]:checked').map(function() {
                        answerMap += $(this).val() + ', ';
                        return $(this).val();
                    });
                    if (answerMap != '') {
                        answerType = answerMap.substring(0, answerMap.length - 2);
                    }
                }

            } else if (questionType == 'choiceOneInFive') {
                answerType = $('#editQuestionMultiModal ' + activeAnswerType +
                    ' input[name="choiceOneInFive"]:checked').val();

            } else {
                answerType = $('#editQuestionMultiModal  ' + activeAnswerType + ' input[name="' + questionType +
                    '"]:checked').val();
            }

            var answerContentJson = getEditAnswerContent(questionType, fill);
            var answerExpContentJson = getEditAnswerExpContent(questionType, fill);

            $('#editQuestionMultiModal').modal('hide');
            $('#editQuestionMultiModal').modal('hide');
            var questionOrderUpdated = $('#editQuestionOrder').val();
            var section_id = $('.sectionAddId').val();

            var diff_value = $('#diff_value_edit').val();
            var disc_value = $('#disc_value_edit').val();

            var diffValue = $('#diffValueEdit').val();
            var discValue =  $('#discValueEdit').val();

            $.ajax({
                data: {
                    'id': currentModelQueId,
                    'format': format,
                    'test_source': test_source,
                    'testSectionType': testSectionType,
                    'question': question,
                    'question_order': questionOrderUpdated,
                    'question_type': questionType,
                    'passages': pass,
                    'passage_number': passNumber,
                    'passages_id': passagesType,
                    'answer': answerType,
                    'answer_content': answerContentJson,
                    'answer_exp': answerExpContentJson,
                    'fill': fill,
                    'fillType': fillType,
                    'diff_rating': difficulty,
                    'diff_value': diffValue,
                    'disc_value': discValue,
                    'guessingValue': guessingValue,
                    'multiChoice': multiChoice,
                    'section_id': section_id,
                    'tags': tags,
                    'ct_checkbox_values': checkboxValues,
                    'super_category_values': superCategoryValues,
                    'get_category_type_values': getCategoryTypeValues,
                    'get_question_type_values': getQuestionTypeValues,
                    '_token': $('input[name="_token"]').val()
                },
                url: '{{ route('updatePracticeQuestion') }}',
                method: 'post',
                success: (res) => {
                    var btn =
                        '<button type="button" class="btn btn-sm btn-alt-secondary edit-section" data-id="' +
                        res.question_id +
                        '" data-bs-toggle="tooltip" title="Edit Question" onclick="practQuestioEdit(' +
                        res.question_id +
                        ')" ><i class="fa fa-fw fa-pencil-alt"></i>  </button> <button type="button"   class="btn btn-sm btn-alt-secondary delete-section" data-id="' +
                        res.question_id +
                        '" data-bs-toggle="tooltip"  title="Delete Question"  onclick="practQuestioDel(' +
                        res.question_id + ')" > <i class="fa fa-fw fa-times"></i>  </button>';

                    $('.singleQuest_' + currentModelQueId).html('<li>' + question +
                        '</li><li class="answerValUpdate_' + res.question_id + '">' + answerType +
                        '</li><li>' + passagesTypeTxt + '</li><li>' + passNumber + '</li><li>' +
                        fill + '</li><li class="orderValUpdate_' + res.question_id + '">' + res
                        .question_order + '</li><li>' + btn + '</li>');
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub, 'p']);
                    $('.addQuestion').val('');
                    $('.validError').text('');
                    $('.questionaprat_' + currentModelQueId).remove();
                    $('#listWithHandleQuestion').append('<div class="list-group-item sectionsaprat_' +
                        section_id + ' quesBasedSecList questionaprat_' + currentModelQueId +
                        '" data-id="' + currentModelQueId + '" data-section_id="' + section_id +
                        '" style="display:none;">\n' +
                        '<span class="glyphicon glyphicon-move" aria-hidden="true">\n' +
                        '<i class="fa-solid fa-grip-vertical"></i>\n' +
                        '</span>\n' +
                        '<button class="btn btn-primary" value="' + currentModelQueId + '">' +
                        question + '</button>\n' +
                        '</div>');
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub, 'p']);
                }
            });

            setEmptyValue(questionType);

            return false;
        });



        function getAnswerOption(answerOpt, format) {
            var questionAnsComb = {
                English: 'choiceOneInFourPass',
                Math: 'choiceMultInFourFill',
                // Math: 'choiceOneInFive',
                Reading: 'choiceOneInFourPass',
                Reading_And_Writing: 'choiceOneInFourPass',
                Reading_And_Writing:'choiceOneInFourPass',
                Easy_Reading_And_Writing:'choiceOneInFourPass',
                Hard_Reading_And_Writing:'choiceOneInFourPass',
                Writing: 'choiceOneInFourPass',
                Science: 'choiceOneInFour',
                Math_no_calculator: 'choiceMultInFourFill',
                Math_with_calculator: 'choiceMultInFourFill'
            };
            $.each(questionAnsComb, function(ind, val) {

                if (ind == answerOpt) {

                    if (val == 'choiceOneInFour') {
                        if (questionCount % 2 != 0) {
                            $('#selectedAnswerType').val('choiceOneInFour_Odd');
                            $('.choiceOneInFour_Odd').show();
                            $('.choiceOneInFour_Even').hide();
                            $('.choiceOneInFive_Odd').hide();
                            $('.choiceOneInFive_Even').hide();
                            $('.choiceOneInFourPass_Odd').hide();
                            $('.choiceOneInFourPass_Even').hide();
                            $('.choiceMultInFourFill').hide();
                        } else {
                            $('#selectedAnswerType').val('choiceOneInFour_Even');
                            $('.choiceOneInFour_Odd').hide();
                            $('.choiceOneInFour_Even').show();
                            $('.choiceOneInFive_Odd').hide();
                            $('.choiceOneInFive_Even').hide();
                            $('.choiceOneInFourPass_Odd').hide();
                            $('.choiceOneInFourPass_Even').hide();
                            $('.choiceMultInFourFill').hide();
                        }

                    } else if (val == 'choiceOneInFive') {
                        if (questionCount % 2 != 0 && format == 'ACT') {
                            $('#selectedAnswerType').val('choiceOneInFive_Odd');
                            $('.choiceOneInFour_Odd').hide();
                            $('.choiceOneInFour_Even').hide();
                            $('.choiceOneInFive_Odd').show();
                            $('.choiceOneInFive_Even').hide();
                            $('.choiceOneInFourPass_Odd').hide();
                            $('.choiceOneInFourPass_Even').hide();
                            $('.choiceMultInFourFill').hide();
                        } else if (questionCount % 2 == 0 && format == 'ACT') {
                            $('#selectedAnswerType').val('choiceOneInFive_Even');
                            $('.choiceOneInFour_Odd').hide();
                            $('.choiceOneInFour_Even').hide();
                            $('.choiceOneInFive_Odd').hide();
                            $('.choiceOneInFive_Even').show();
                            $('.choiceOneInFourPass_Odd').hide();
                            $('.choiceOneInFourPass_Even').hide();
                            $('.choiceMultInFourFill').hide();
                        } else {
                            $('#selectedAnswerType').val('choiceOneInFive_Odd');
                            $('.choiceOneInFour_Odd').hide();
                            $('.choiceOneInFour_Even').hide();
                            $('.choiceOneInFive_Odd').show();
                            $('.choiceOneInFive_Even').hide();
                            $('.choiceOneInFourPass_Odd').hide();
                            $('.choiceOneInFourPass_Even').hide();
                            $('.choiceMultInFourFill').hide();
                        }
                    } else if (val == 'choiceOneInFourPass') {
                        if (questionCount % 2 != 0 && format == 'ACT') {
                            $('#selectedAnswerType').val('choiceOneInFourPass_Odd');
                            $('.choiceOneInFour_Odd').hide();
                            $('.choiceOneInFour_Even').hide();
                            $('.choiceOneInFive_Odd').hide();
                            $('.choiceOneInFive_Even').hide();
                            $('.choiceOneInFourPass_Odd').show();
                            $('.choiceOneInFourPass_Even').hide();
                            $('.choiceMultInFourFill').hide();
                        } else if (questionCount % 2 == 0 && format == 'ACT') {
                            $('#selectedAnswerType').val('choiceOneInFourPass_Even');
                            $('.choiceOneInFour_Odd').hide();
                            $('.choiceOneInFour_Even').hide();
                            $('.choiceOneInFive_Odd').hide();
                            $('.choiceOneInFive_Even').hide();
                            $('.choiceOneInFourPass_Odd').hide();
                            $('.choiceOneInFourPass_Even').show();
                            $('.choiceMultInFourFill').hide();
                        } else {
                            $('#selectedAnswerType').val('choiceOneInFourPass_Odd');
                            $('.choiceOneInFour_Odd').hide();
                            $('.choiceOneInFour_Even').hide();
                            $('.choiceOneInFive_Odd').hide();
                            $('.choiceOneInFive_Even').hide();
                            $('.choiceOneInFourPass_Odd').show();
                            $('.choiceOneInFourPass_Even').hide();
                            $('.choiceMultInFourFill').hide();
                        }
                    } else if (val == 'choiceMultInFourFill') {
                        $('#selectedAnswerType').val('choiceMultInFourFill');
                        $('.choiceOneInFour_Odd').hide();
                        $('.choiceOneInFour_Even').hide();
                        $('.choiceOneInFive_Odd').hide();
                        $('.choiceOneInFive_Even').hide();
                        $('.choiceOneInFourPass_Odd').hide();
                        $('.choiceOneInFourPass_Even').hide();
                        $('.choiceMultInFourFill').show();
                    }
                }
            });

        }
    </script>
    <script>
        //your javascript goes here
        var currentTab = 0;
        document.addEventListener("DOMContentLoaded", function(event) {

            showTab(currentTab);

        });

        function getPassages(format) {
            $.ajax({
                data: {
                    'format': format,
                    '_token': $('input[name="_token"]').val()
                },
                url: '{{ route('getPracticePassage') }}',
                method: 'post',
                success: (res) => {
                    let opt = '';
                    opt += `<option value="">Select Passages</option>`;
                    $.each(res, function(key, val) {
                        opt += '<option value="' + val.id + '">' + val.title + '</option>';
                    });
                    $('.passagesType').html(opt);
                }
            });
        }

        function showTab(n) {
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline-block";
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

            var test_type = $('#format').val();
            if (test_type == 'DSAT'){
                $('.for_digital_only').show();
            }else if(test_type == 'DPSAT'){
                $('.for_digital_only').show();
            }else{
                $('.for_digital_only').hide();
            }


            preGetPracticeCategoryType = await dropdown_lists(
                `/admin/getPracticeCategoryType?testType=${test_format_type_val}`);
            preGetPracticeQuestionType = await dropdown_lists(
                `/admin/getPracticeQuestionType?testType=${test_format_type_val}`);
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
                                $.each(res.super, function(i, v) {
                                    super_option += `<option value=${v['id']}>${v['title']}</option>`;
                                });


                                let category_option = ``;
                                $.each(res.category, function(i, v) {
                                    category_option +=
                                        `<option value=${v['id']}>${v['category_type_title']}</option>`;
                                });


                                let questionType_option = ``;
                                $.each(res.questionType, function(i, v) {
                                    questionType_option +=
                                        `<option value=${v['id']}>${v['question_type_title']}</option>`;
                                });

                                const disp_sections = ['', 'oneInFiveOdd_', 'oneInFiveEven_', 'oneInFourOdd_',
                                    'oneInFourEven_', 'oneInFourPassEven_', 'choiceMultInFourFill_',
                                    'cb_choiceMultInFourFill_'
                                ]
                                const ans_choices = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K'];
                                disp_sections.forEach(disp_section => {
                                    ans_choices.forEach(ans_choice => {
                                        $(`select[name="${disp_section}add_category_type_${ans_choice}"`)
                                            .html('');
                                        $(`select[name="${disp_section}super_category_create_${ans_choice}"`)
                                            .html('');
                                        $(`select[name="${disp_section}add_search-input_A${ans_choice}"`)
                                            .html('');

                                        $(`select[name="${disp_section}super_category_create_${ans_choice}"`)
                                            .append(super_option);
                                        // $(`select[name="${disp_section}edit_super_category_${ans_choice}"`).append(super_option);

                                        $(`select[name="${disp_section}add_category_type_${ans_choice}"`)
                                            .append(category_option);
                                        // $(`select[name="${disp_section}edit_category_type_${ans_choice}"`).append(category_option);

                                        $(`select[name="${disp_section}add_search-input_${ans_choice}"`)
                                            .append(questionType_option);
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
                        return false;
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
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid;
        }

        function fixStepIndicator(n) {
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            x[n].className += " active";
        }

        function multiChoice(arg) {
            if (arg == 1) {
                $('#selectedLayoutQuestion .multi_field').show();
                $('#selectedLayoutQuestion .fill_field').hide();
                $('#selectedLayoutQuestion .multiChoice_field').hide();
            } else if (arg == 3) {
                $('#selectedLayoutQuestion .multi_field').hide();
                $('#selectedLayoutQuestion .multiChoice_field').show();
                $('#selectedLayoutQuestion .fill_field').hide();
            } else if (arg == 2) {
                $('#selectedLayoutQuestion .multi_field').hide();
                $('#selectedLayoutQuestion .multiChoice_field').hide();
                $('#selectedLayoutQuestion .fill_field').show();
            } else {
                $('#selectedLayoutQuestion .multi_field').hide();
                $('#selectedLayoutQuestion .multiChoice_field').hide();
                $('#selectedLayoutQuestion .fill_field').hide();
            }
        }
        //new
        function editMultiChoice(arg) {
            if (arg == 1) {
                $('#EditSelectedLayoutQuestion .multi_field').show();
                $('#EditSelectedLayoutQuestion .fill_field').hide();
                $('input[name="choiceMultInFourFill_fill[]"]').remove();
                $('#EditSelectedLayoutQuestion .multiChoice_field').hide();
            } else if (arg == 3) {
                $('#EditSelectedLayoutQuestion .multi_field').hide();
                $('#EditSelectedLayoutQuestion .multiChoice_field').show();
                $('#EditSelectedLayoutQuestion .fill_field').hide();
                $('input[name="choiceMultInFourFill_fill[]"]').remove();
            } else if (arg == 2) {
                $('#EditSelectedLayoutQuestion .multi_field').hide();
                $('input[name="choiceMultInFourFill[]"').prop("checked", false);
                $('#EditSelectedLayoutQuestion .multiChoice_field').hide();
                $('input[name="editChoiceMultiChoiceInFourFill"').prop("checked", false);
                $('#EditSelectedLayoutQuestion .fill_field').show();
            } else {
                $('#EditSelectedLayoutQuestion .multi_field').hide();
                $('input[name="choiceMultInFourFill[]"').prop("checked", false);
                $('#EditSelectedLayoutQuestion .multiChoice_field').hide();
                $('input[name="editChoiceMultiChoiceInFourFill"').prop("checked", false);
                $('#EditSelectedLayoutQuestion .fill_field').hide();
            }
        }

        function setEmptyValue(qType) {
            CKEDITOR.instances['js-ckeditor-addQue'].setData('');
            /*CKEDITOR.instances['js-ckeditor-passquestion'].setData('');*/
            $(".passNumber option[value='']").attr('selected', true);
            $('#questionMultiModal .passNumber').prop('selectedIndex', 0);
            $('input[name="' + qType + '"]').attr('checked', false);
            $('input[type="radio"]').prop('checked', false);
            $('input[type="checkbox"]').prop('checked', false);

            CKEDITOR.instances['choiceOneInFour_OddAnswer_1'].setData('');
            CKEDITOR.instances['choiceOneInFour_OddAnswer_2'].setData('');
            CKEDITOR.instances['choiceOneInFour_OddAnswer_3'].setData('');
            CKEDITOR.instances['choiceOneInFour_OddAnswer_4'].setData('');

            //new
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

            CKEDITOR.instances['choiceOneInFive_Odd_Answer_1'].setData('');
            CKEDITOR.instances['choiceOneInFive_Odd_Answer_2'].setData('');
            CKEDITOR.instances['choiceOneInFive_Odd_Answer_3'].setData('');
            CKEDITOR.instances['choiceOneInFive_Odd_Answer_4'].setData('');
            CKEDITOR.instances['choiceOneInFive_Odd_Answer_5'].setData('');

            // new
            CKEDITOR.instances['choiceOneInFive_Even_Answer_1'].setData('');
            CKEDITOR.instances['choiceOneInFive_Even_Answer_2'].setData('');
            CKEDITOR.instances['choiceOneInFive_Even_Answer_3'].setData('');
            CKEDITOR.instances['choiceOneInFive_Even_Answer_4'].setData('');
            CKEDITOR.instances['choiceOneInFive_Even_Answer_5'].setData('');

            CKEDITOR.instances['choiceOneInFive_Odd_explanation_answer_odd1'].setData('');
            CKEDITOR.instances['choiceOneInFive_Odd_explanation_answer_odd2'].setData('');
            CKEDITOR.instances['choiceOneInFive_Odd_explanation_answer_odd3'].setData('');
            CKEDITOR.instances['choiceOneInFive_Odd_explanation_answer_odd4'].setData('');
            CKEDITOR.instances['choiceOneInFive_Odd_explanation_answer_odd5'].setData('');

            // new
            CKEDITOR.instances['choiceOneInFive_Even_explanation_answer_even1'].setData('');
            CKEDITOR.instances['choiceOneInFive_Even_explanation_answer_even2'].setData('');
            CKEDITOR.instances['choiceOneInFive_Even_explanation_answer_even3'].setData('');
            CKEDITOR.instances['choiceOneInFive_Even_explanation_answer_even4'].setData('');
            CKEDITOR.instances['choiceOneInFive_Even_explanation_answer_even5'].setData('');

            CKEDITOR.instances['choiceOneInFourPass_OddAnswer_1'].setData('');
            CKEDITOR.instances['choiceOneInFourPass_OddAnswer_2'].setData('');
            CKEDITOR.instances['choiceOneInFourPass_OddAnswer_3'].setData('');
            CKEDITOR.instances['choiceOneInFourPass_OddAnswer_4'].setData('');

            // new
            CKEDITOR.instances['choiceOneInFourPass_EvenAnswer_1'].setData('');
            CKEDITOR.instances['choiceOneInFourPass_EvenAnswer_2'].setData('');
            CKEDITOR.instances['choiceOneInFourPass_EvenAnswer_3'].setData('');
            CKEDITOR.instances['choiceOneInFourPass_EvenAnswer_4'].setData('');

            CKEDITOR.instances['choiceOneInFourPass_Odd_explanation_answer_1'].setData('');
            CKEDITOR.instances['choiceOneInFourPass_Odd_explanation_answer_2'].setData('');
            CKEDITOR.instances['choiceOneInFourPass_Odd_explanation_answer_3'].setData('');
            CKEDITOR.instances['choiceOneInFourPass_Odd_explanation_answer_4'].setData('');

            // new
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


            CKEDITOR.instances['choiceMultiChoiceInFourFill_1'].setData('');
            CKEDITOR.instances['choiceMultiChoiceInFourFill_2'].setData('');
            CKEDITOR.instances['choiceMultiChoiceInFourFill_3'].setData('');
            CKEDITOR.instances['choiceMultiChoiceInFourFill_4'].setData('');


            CKEDITOR.instances['choiceMultiChoiceInFourFill_explanation_answer_1'].setData('');
            CKEDITOR.instances['choiceMultiChoiceInFourFill_explanation_answer_2'].setData('');
            CKEDITOR.instances['choiceMultiChoiceInFourFill_explanation_answer_3'].setData('');
            CKEDITOR.instances['choiceMultiChoiceInFourFill_explanation_answer_4'].setData('');

            //for edit functionality set empty values
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

            CKEDITOR.instances['editChoiceOneInFive_Odd_Answer_1'].setData('');
            CKEDITOR.instances['editChoiceOneInFive_Odd_Answer_2'].setData('');
            CKEDITOR.instances['editChoiceOneInFive_Odd_Answer_3'].setData('');
            CKEDITOR.instances['editChoiceOneInFive_Odd_Answer_4'].setData('');
            CKEDITOR.instances['editChoiceOneInFive_Odd_Answer_5'].setData('');

            // new
            CKEDITOR.instances['editChoiceOneInFive_Even_Answer_1'].setData('');
            CKEDITOR.instances['editChoiceOneInFive_Even_Answer_2'].setData('');
            CKEDITOR.instances['editChoiceOneInFive_Even_Answer_3'].setData('');
            CKEDITOR.instances['editChoiceOneInFive_Even_Answer_4'].setData('');
            CKEDITOR.instances['editChoiceOneInFive_Even_Answer_5'].setData('');

            CKEDITOR.instances['editchoiceOneInFive_Odd_explanation_answer_odd1'].setData('');
            CKEDITOR.instances['editchoiceOneInFive_Odd_explanation_answer_odd2'].setData('');
            CKEDITOR.instances['editchoiceOneInFive_Odd_explanation_answer_odd3'].setData('');
            CKEDITOR.instances['editchoiceOneInFive_Odd_explanation_answer_odd4'].setData('');
            CKEDITOR.instances['editchoiceOneInFive_Odd_explanation_answer_odd5'].setData('');

            // new
            CKEDITOR.instances['editchoiceOneInFive_Even_explanation_answer_even1'].setData('');
            CKEDITOR.instances['editchoiceOneInFive_Even_explanation_answer_even2'].setData('');
            CKEDITOR.instances['editchoiceOneInFive_Even_explanation_answer_even3'].setData('');
            CKEDITOR.instances['editchoiceOneInFive_Even_explanation_answer_even4'].setData('');
            CKEDITOR.instances['editchoiceOneInFive_Even_explanation_answer_even5'].setData('');

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

            CKEDITOR.instances['editChoiceMultiChoiceInFourFill_1'].setData('');
            CKEDITOR.instances['editChoiceMultiChoiceInFourFill_2'].setData('');
            CKEDITOR.instances['editChoiceMultiChoiceInFourFill_3'].setData('');
            CKEDITOR.instances['editChoiceMultiChoiceInFourFill_4'].setData('');

            CKEDITOR.instances['editchoiceMultiChoiceInFourFill_explanation_answer_1'].setData('');
            CKEDITOR.instances['editchoiceMultiChoiceInFourFill_explanation_answer_2'].setData('');
            CKEDITOR.instances['editchoiceMultiChoiceInFourFill_explanation_answer_3'].setData('');
            CKEDITOR.instances['editchoiceMultiChoiceInFourFill_explanation_answer_4'].setData('');

        }

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function addMoreFillOption() {
            $('.extraFillOption').append('<input type="text" name="choiceMultInFourFill_fill[]">');
        }

        function removeMoreFillOption() {
            $('.extraFillOption').html('');
        }

        function editMoreFillOption() {
            $('.editExtraFillOption').append('<input type="text" name="choiceMultInFourFill_fill[]">');
        }

        function getAnswerContent(answerOpt, fill) {
            var answerContenArr = [];
            if (answerOpt == 'choiceOneInFive_Odd') {
                for (var i = 1; i < 6; i++) {
                    var dynamicId = answerOpt + '_Answer_' + i;
                    answerContenArr.push(CKEDITOR.instances[dynamicId].getData());
                }

            } else if (answerOpt == 'choiceOneInFive_Even') {
                for (var i = 1; i < 6; i++) {
                    var dynamicId = answerOpt + '_Answer_' + i;
                    answerContenArr.push(CKEDITOR.instances[dynamicId].getData());
                }
            } else {
                if (fill == '' || fill == 'N/A') {
                    var choiceSel = $('.getFilterChoice').val();
                    if (choiceSel == 3) {
                        for (var i = 1; i < 5; i++) {
                            var dynamicId = 'choiceMultiChoiceInFourFill_' + i;
                            answerContenArr.push(CKEDITOR.instances[dynamicId].getData());
                        }
                    } else {
                        for (var i = 1; i < 5; i++) {
                            var dynamicId = answerOpt + 'Answer_' + i;
                            answerContenArr.push(CKEDITOR.instances[dynamicId].getData());
                        }
                    }
                }

            }
            if (answerContenArr.length > 0) {
                return JSON.stringify(answerContenArr);
            }
            return '';
        }

        //new start
        function getAnswerExpContent(answerOpt, fill) {
            var answerExpArr = [];
            if (answerOpt == 'choiceOneInFive_Odd') {
                for (var i = 1; i < 6; i++) {
                    var dynamicId = answerOpt + '_explanation_answer_odd' + i;
                    answerExpArr.push(CKEDITOR.instances[dynamicId].getData());
                }

            } else if (answerOpt == 'choiceOneInFive_Even') {
                for (var i = 1; i < 6; i++) {
                    var dynamicId = answerOpt + '_explanation_answer_even' + i;
                    answerExpArr.push(CKEDITOR.instances[dynamicId].getData());
                }

            } else {
                if (fill == '' || fill == 'N/A') {
                    var choiceSel = $('.getFilterChoice').val();
                    if (choiceSel == 3) {
                        for (var i = 1; i < 5; i++) {
                            var dynamicId = 'choiceMultiChoiceInFourFill' + '_explanation_answer_' + i;
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
        //for edit functionality
        function getEditAnswerContent(answerOpt, fill) {
            var answerContenArr = [];
            if (answerOpt == 'choiceOneInFive_Odd') {
                for (var i = 1; i < 6; i++) {
                    var dynamicId = 'edit' + capitalizeFirstLetter(answerOpt) + 'Answer_' + i;
                    answerContenArr.push(CKEDITOR.instances[dynamicId].getData());
                }

            } else if (answerOpt == 'choiceOneInFive_Even') {
                for (var i = 1; i < 6; i++) {
                    var dynamicId = 'edit' + capitalizeFirstLetter(answerOpt) + 'Answer_' + i;
                    answerContenArr.push(CKEDITOR.instances[dynamicId].getData());
                }

            } else {
                if (fill == '' || fill == 'N/A') {

                    var choiceSel = $('.editMultipleChoice').val();
                    if (choiceSel == 3) {
                        for (var i = 1; i < 5; i++) {
                            var dynamicId = 'editChoiceMultiChoiceInFourFill_' + i;
                            answerContenArr.push(CKEDITOR.instances[dynamicId].getData());
                        }
                    } else {
                        for (var i = 1; i < 5; i++) {
                            var dynamicId = 'edit' + capitalizeFirstLetter(answerOpt) + 'Answer_' + i;
                            answerContenArr.push(CKEDITOR.instances[dynamicId].getData());
                        }
                    }
                }

            }
            if (answerContenArr.length > 0) {
                return JSON.stringify(answerContenArr);
            }
            return '';
        }

        function getEditAnswerExpContent(answerOpt, fill) {
            var answerExpArr = [];
            if (answerOpt == 'choiceOneInFive_Odd') {
                for (var i = 1; i < 6; i++) {
                    var dynamicId = 'edit' + answerOpt + '_explanation_answer_' + i;
                    answerExpArr.push(CKEDITOR.instances[dynamicId].getData());
                }

            } else if (answerOpt == 'choiceOneInFive_Even') {
                for (var i = 1; i < 6; i++) {
                    var dynamicId = 'edit' + answerOpt + '_explanation_answer_' + i;
                    answerExpArr.push(CKEDITOR.instances[dynamicId].getData());
                }
            } else {
                if (fill == '' || fill == 'N/A') {

                    var choiceSel = $('.editMultipleChoice').val();
                    if (choiceSel == 3) {
                        for (var i = 1; i < 5; i++) {
                            var dynamicId = 'editchoiceMultiChoiceInFourFill' + '_explanation_answer_' + i;
                            answerExpArr.push(CKEDITOR.instances[dynamicId].getData());
                        }
                    } else {
                        for (var i = 1; i < 5; i++) {
                            var dynamicId = 'edit' + answerOpt + '_explanation_answer_' + i;
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

        function openOrderDialog() {

            myModal.show();
        }

        function openQuestionDialog(sectionId) {
            $.ajax({
                data: {
                    'sectionId': sectionId,
                    '_token': $('input[name="_token"]').val()
                },
                url: '{{ route('getSectionQuestions') }}',
                method: 'post',
                success: (res) => {
                    $("#listWithHandleQuestion").empty();
                    $.each(res, function(index, value) {
                        $('#listWithHandleQuestion').append('<div class="list-group-item" data-id="' +
                            value.question_id + '">\n' +
                            '<span class="glyphicon glyphicon-move" aria-hidden="true">\n' +
                            '<i class="fa-solid fa-grip-vertical"></i>\n' +
                            '</span>\n' +
                            '<button class="btn btn-primary" value="' + value.question_id + '">' +
                            value.question_title + '</button>\n' +
                            '</div>');
                        MathJax.Hub.Queue(["Typeset", MathJax.Hub, 'p']);
                    });

                }
            });
            questionModal.show();
        }

        function saveOrder() {

            myModal.hide();
        }

        function saveQuestion() {

            questionModal.hide();
        }
        // List with handle
        Sortable.create(mainSectionContainer, {
            handle: '.sectionTypesFull',
            animation: 150,
            onEnd: function(evt) {
                $('.sectionContainerList .sectionTypesFull').each((index, v) => {
                    let section_id = $(v).attr('data-id');
                    let section_order = index + 1;
                    $(`#order_${section_id}`).val(section_order);
                    $.ajax({
                        data: {
                            'section_order': section_order,
                            'section_id': section_id,
                            '_token': $('input[name="_token"]').val()
                        },
                        url: '{{ route('sectionOrder') }}',
                        method: 'post',
                        success: (res) => {}
                    });
                });
            }
        }, );
        // List with handle
        var test = Sortable.create(listWithHandleQuestion, {
            handle: '.glyphicon-move',
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
                var promises = $(indices).map(function(index, value) {
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
                        url: '{{ route('questionOrder') }}',
                        method: 'post',
                        success: (res) => {
                            // $('.sectionTypesFull .firstRecord .singleQuest_'+res.question['id']+'').remove();
                            // $('.section_'+res.question['practice_test_sections_id']+' .firstRecord').append('<ul class="sectionList singleQuest_'+res.question['id']+'"><li>'+res.question['title']+'</li><li class="answerValUpdate_'+res.question['id']+'">'+res.question['answer']+'</li><li>'+res.question['passages']+'</li><li>'+res.question['passage_number']+'</li><li>'+res.question['fill']+'</li><li class="orderValUpdate_'+res.question['id']+'">'+new_question_id_order+'</li><li><button type="button" class="btn btn-sm btn-alt-secondary edit-section" data-id="'+res.question['id']+'" data-bs-toggle="tooltip" title="Edit Question" onclick="practQuestioEdit('+res.question['id']+')"> <i class="fa fa-fw fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-alt-secondary delete-section" data-id="'+res.question['id']+'" data-bs-toggle="tooltip" title="Delete Section"   onclick="practQuestioDel('+res.question['id']+')">  <i class="fa fa-fw fa-times"></i></button> </li></ul>');
                        }
                    });
                });
                Promise.all(promises).then(function(results) {
                    $.each(results, function(index, val) {
                        $('.section_' + val.question['practice_test_sections_id'] +
                                ' .firstRecord .singleQuest_' + val.question['id'] + '')
                            .remove();
                        let html = '';
                        html +=
                            `<ul class="sectionList singleQuest_${val.question['id']}" data-id="${val.question['id']}">`;
                        html += `<li>${val.question['title']}</li>`;
                        html +=
                            `<li class="answerValUpdate_${val.question['id']}">${val.question['answer']}</li>`;
                        html +=
                            `<li>${val.question['passages'] ? val.question['passages'] : ''}</li>`;
                        html +=
                            `<li>${val.question['passage_number'] ? val.question['passage_number'] : ''}</li>`;
                        html += `<li>${val.question['fill']}</li>`;
                        html +=
                            `<li class="orderValUpdate_${val.question['id']}">${val.question['question_order']}</li>`;
                        html += `<li>`;
                        html +=
                            `<button type="button" class="btn btn-sm btn-alt-secondary edit-section" data-id="${val.question['id']}"
                                    data-bs-toggle="tooltip" title="Edit Question" onclick="practQuestioEdit(${val.question['id']})">`;
                        html += `<i class="fa fa-fw fa-pencil-alt"></i>`;
                        html += `</button>`;
                        html +=
                            `<button type="button" class="btn btn-sm btn-alt-secondary delete-section" data-id="${val.question['id']}" data-bs-toggle="tooltip" title="Delete Question" onclick="practQuestioDel(${val.question['id']})">`;
                        html += `<i class="fa fa-fw fa-times"></i>`;
                        html += `</button>`;
                        html += `</li>`;
                        html += `</ul>`;
                        $(`.section_${val.question['practice_test_sections_id']} .firstRecord`)
                            .append(html);
                        MathJax.Hub.Queue(["Typeset", MathJax.Hub, 'p']);
                    });
                });
            }
        }, );

        var indices = test.toArray();

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
                    'sectionId': id,
                    '_token': $('input[name="_token"]').val()
                },
                url: '{{ route('edit_section') }}',
                method: 'post',
                success: (res) => {
                    let optionObj = [];
                    optionObj['ACT'] = ['English', 'Math', 'Reading', 'Science'];
                    optionObj['SAT'] = ['Reading', 'Writing', 'Math (no calculator)', 'Math (with calculator)'];
                    optionObj['PSAT'] = ['Reading', 'Writing', 'Math (no calculator)',
                        'Math (with calculator)'
                    ];
                    optionObj['DSAT'] = ['Reading And Writing', 'Math'];
                    optionObj['DPSAT'] = ['Reading And Writing', 'Math'];

                    let opt = '<option value="">Select Section Type</option>';
                    for (let i = 0; i < optionObj[res.sectionDetails.format].length; i++) {
                        let typeVal = optionObj[res.sectionDetails.format][i].replace(/\s/g, '_');
                        typeVallev = typeVal.replace(')', '');
                        typeVallev2 = typeVallev.replace('(', '');
                        opt +=
                            `<option value="${typeVallev2}" ${ typeVallev2 == res.sectionDetails.practice_test_type ? 'selected' : '' }>${optionObj[res.sectionDetails.format][i]}</option>`;
                    }
                    $('#editTestSectionType').html(opt);
                    $('#editTestSectionTitle').val(`${res.sectionDetails.section_title}`);
                    $('#currentSectionId').val(`${res.sectionDetails.id}`);

                    let regularTime = res.sectionDetails.regular_time.split(':');
                    let fiftyTime = res.sectionDetails.fifty_per_extended.split(':');
                    let hundredTime = res.sectionDetails.hundred_per_extended.split(':');
                    
                    $('#edit_required_number_of_correct_answers').val(res.sectionDetails.required_number_of_correct_answers);
                    $('#edit_regular_hour').val(regularTime[0]);
                    $('#edit_regular_minute').val(regularTime[1]);
                    $('#edit_regular_second').val(regularTime[2]);

                    $('#edit50extendedhour').val(fiftyTime[0]);
                    $('#edit50extendedminute').val(fiftyTime[1]);
                    $('#edit50extendedsecond').val(fiftyTime[2]);

                    $('#edit100extendedhour').val(hundredTime[0]);
                    $('#edit100extendedminute').val(hundredTime[1]);
                    $('#edit100extendedsecond').val(hundredTime[2]);
                }
            });
            $('#editSectionModal').modal('show');
        }

        $('.save_edited_change').click(function() {
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

            var regularTime = ("0" + rHour).slice(-2) + ":" + ("0" + rMinute).slice(-2) + ":" + ("0" + rSecond)
                .slice(-2);
            var fiftyExtended = ("0" + fiftyHour).slice(-2) + ":" + ("0" + fiftyMinute).slice(-2) + ":" + ("0" +
                fiftySecond).slice(-2);
            var hundredExtended = ("0" + hundredHour).slice(-2) + ":" + ("0" + hundredMinute).slice(-2) + ":" + (
                "0" + hundredSecond).slice(-2);

            var test_type = $('#format').val();
            if ((test_type == 'DSAT') || (test_type == 'DPSAT') ){
                // this field is required - required_number_of_correct_answers
                var numberOfCorrectAnswers = $('#edit_required_number_of_correct_answers').val();
                if (testSectionType == '' || testSectionTitle == '' || regularTime == '0:0:0' || numberOfCorrectAnswers == '') {                   
                    $('#editSectionModal .validError').text('Below fields are required!');
                    return false;
                }

                if(testWholeNumber(numberOfCorrectAnswers) == false) {
                    $('#editSectionModal .validError').text('Only whole numbers are allowed.');
                    return false;
                }
            }else{
                if (testSectionType == '' || testSectionTitle == '' || regularTime == '0:0:0') {
                    $('#editSectionModal .validError').text('Below fields are required!');
                    return false;
                } else {
                    $('#editSectionModal .validError').text('');
                }
            }

            // if (testSectionType == '' || testSectionTitle == '' || regularTime == '0:0:0') {
            //     $('#editSectionModal .validError').text('Below fields are required!');
            //     return false;
            // } else {
            //     $('#editSectionModal .validError').text('');
            // }

            $.ajax({
                data: {
                    'sectionId': id,
                    'sectionTitle': testSectionTitle,
                    'sectionType': testSectionType,
                    'regular': regularTime,
                    'fifty': fiftyExtended,
                    'hundred': hundredExtended,
                    'required_number_of_correct_answers': edit_required_number_of_correct_answers,
                    '_token': $('input[name="_token"]').val()
                },
                url: '{{ route('update_section') }}',
                method: 'post',
                success: (res) => {
                    $(`.editedAnswerOption_${id}`).find('strong').text(res.updatedSection
                        .practice_test_type);
                    // $('#questionMultiModal #testSectionTypeRead').val(`${res.updatedSection.practice_test_type}`);
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
            if (!result) {
                return false;
            }
            sectionOrder--;
            $(`.section_${id}`).remove();

            $.ajax({
                data: {
                    'sectionId': id,
                    'sectionType': type,
                    '_token': $('input[name="_token"]').val()
                },
                url: '{{ route('delete_section') }}',
                method: 'post',
                success: (res) => {

                }
            });

        }
    </script>
@endsection
