@extends('layouts.admin')

@section('title', 'Admin Dashboard : Test')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/tagify.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
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
            width: 100%;
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
        .select2-container--default .select2-selection--multiple{
            border: 1px solid #dfe3ea;
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
    </style>
@endsection

@section('admin-content')
    <!-- Main Container -->
    <main id="main-container">
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

                                <div class="container mt-5">
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
                                                        <select id="format" name="format" class="form-control js-select2 select">
                                                            <option value="">Select test type</option>
                                                            @foreach ($testformats as $key => $testformat)
                                                                <option value="{{ $key }}">{{ $testformat }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
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
                                                <div class="sectionContainerList">
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

    <div class="modal fade" id="questionMultiModal" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
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
                        <div class="mb-2">
                            <label class="form-label" style="font-size: 13px;">Practice Test Section Type:</label>
                            <input id="testSectionTypeRead" readonly name="testSectionTypeRead" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="font-size: 13px;">Question:</label>
                            <textarea id="js-ckeditor-addQue" name="js-ckeditor-addQue"
                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>

                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="tags">Question Tags</label>
                            <input name="tags" placeholder="add tags" class="form-control"/>
                        </div>
                        <div class="input-container" id="addNewTypes">
                            <div class="d-flex input-field align-items-center">
                                {{-- start  --}}
                                <div class="col-md-5 mb-2 me-2 category-custom">
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
                                    <button class="plus-button" data-id="1" onclick="addNewTypes(this)"><i class="fa-solid fa-plus"></i></button>
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
                                <label class="form-label">Passages:</label>
                                <select name="passagesType" class="form-control passagesType js-select2 select"></select>
                            </div>
                        </div>
                        <input type="hidden" name="passages" class="passages">
                        <input type="hidden" name="selectedAnswerType" id="selectedAnswerType">
                        <div class="mb-2" id="selectedLayoutQuestion">
                            <div class="choiceOneInFour"><input type="hidden" name="questionType" id="questionType"
                                    value="choiceOneInFour">
                                <ul class="answerOptionLsit">
                                    <li><label class="form-label" style="font-size: 13px;"><span>A: </span><input
                                                type="radio" value="a" name="choiceOneInFour"></label>
                                        <textarea id="choiceOneInFourAnswer_1" name="choiceOneInFourAnswer_1"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li><label class="form-label" style="font-size: 13px;"><span>B: </span><input
                                                type="radio" value="b" name="choiceOneInFour"></label>
                                        <textarea id="choiceOneInFourAnswer_2" name="choiceOneInFourAnswer_2"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li><label class="form-label" style="font-size: 13px;"><span>C:</span><input
                                                type="radio" value="c" name="choiceOneInFour"></label>
                                        <textarea id="choiceOneInFourAnswer_3" name="choiceOneInFourAnswer_3"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                    <li><label class="form-label" style="font-size: 13px;"><span>D: </span><input
                                                type="radio" value="d" name="choiceOneInFour">
                                            <textarea id="choiceOneInFourAnswer_4" name="choiceOneInFourAnswer_4"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="add Question"></textarea>
                                    </li>
                                </ul>
                            </div>

                            <div class="choiceOneInFive"><input type="hidden" name="questionType" id="questionType"
                                    value="choiceOneInFive">
                                <ul class="answerOptionLsit">
                                    <li><label class="form-label" style="font-size: 13px;"><span>A: </span><input
                                                type="radio" value="a" name="choiceOneInFive"></label>
                                        <textarea id="choiceOneInFiveAnswer_1" name="choiceOneInFiveAnswer_1"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li><label class="form-label" style="font-size: 13px;"><span>B:</span><input
                                                type="radio" value="b" name="choiceOneInFive"></label>
                                        <textarea id="choiceOneInFiveAnswer_2" name="choiceOneInFiveAnswer_2"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li><label class="form-label" style="font-size: 13px;"><span>C: </span><input
                                                type="radio" value="c" name="choiceOneInFive"></label>
                                        <textarea id="choiceOneInFiveAnswer_3" name="choiceOneInFiveAnswer_3"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li><label class="form-label" style="font-size: 13px;"><span>D: </span><input
                                                type="radio" value="d" name="choiceOneInFive"></label>
                                        <textarea id="choiceOneInFiveAnswer_4" name="choiceOneInFiveAnswer_4"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li><label class="form-label" style="font-size: 13px;"><span>E: </span><input
                                                type="radio" value="e" name="choiceOneInFive"></label>
                                        <textarea id="choiceOneInFiveAnswer_5" name="choiceOneInFiveAnswer_5"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                </ul>
                            </div>

                            <div class="choiceOneInFourPass"><input type="hidden" name="questionType" id="questionType"
                                    value="choiceOneInFourPass">
                                <ul class="answerOptionLsit">
                                    <li><label class="form-label" style="font-size: 13px;"><span>A: </span><input
                                                type="radio" value="a" name="choiceOneInFourPass"></label>
                                        <textarea id="choiceOneInFourPassAnswer_1" name="choiceOneInFourPassAnswer_1"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li><label class="form-label" style="font-size: 13px;"><span>B: </span><input
                                                type="radio" value="b" name="choiceOneInFourPass"></label>
                                        <textarea id="choiceOneInFourPassAnswer_2" name="choiceOneInFourPassAnswer_2"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li><label class="form-label" style="font-size: 13px;"><span>C: </span><input
                                                type="radio" value="c" name="choiceOneInFourPass"></label>
                                        <textarea id="choiceOneInFourPassAnswer_3" name="choiceOneInFourPassAnswer_3"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                    <li><label class="form-label" style="font-size: 13px;"><span>D: </span><input
                                                type="radio" value="d" name="choiceOneInFourPass"></label>
                                        <textarea id="choiceOneInFourPassAnswer_4" name="choiceOneInFourPassAnswer_4"
                                            class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                    </li>
                                </ul>
                            </div>


                            <div class="choiceMultInFourFill"><input type="hidden" name="questionType"
                                    id="questionType" value="choiceMultInFourFill">

                                <label class="form-label" style="font-size: 13px;">
                                    <select class="switchMulti getFilterChoice" onChange="multiChoice(this.value);">
                                        <option value="1">Multi-Choice</option>
                                        <option value="3">Multiple Choice</option>
                                        <option value="2">Fill Choice</option>
                                    </select>
                                    <!--<a href="javascript:;" onClick="multiChoice(1);" class="switchMulti">Multi Choice</a></label><label class="form-label" style="font-size: 13px;"><a href="javascript:;" onClick="multiChoice(2);" class="switchMulti">Fill Choice</a>-->
                                </label>


                                <div class="multi_field">
                                    <ul class="answerOptionLsit">
                                        <li><label class="form-label" style="font-size: 13px;"><span>A: </span> <input
                                                    type="checkbox" value="a" name="choiceMultInFourFill[]"></label>
                                            <textarea id="choiceMultInFourFillAnswer_1" name="choiceMultInFourFillAnswer_1"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li><label class="form-label" style="font-size: 13px;"><span>B: </span><input
                                                    type="checkbox" value="b" name="choiceMultInFourFill[]"></label>
                                            <textarea id="choiceMultInFourFillAnswer_2" name="choiceMultInFourFillAnswer_2"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li><label class="form-label" style="font-size: 13px;"><span>C: </span><input
                                                    type="checkbox" value="c" name="choiceMultInFourFill[]"></label>
                                            <textarea id="choiceMultInFourFillAnswer_3" name="choiceMultInFourFillAnswer_3"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li><label class="form-label" style="font-size: 13px;"><span>D:</span><input
                                                    type="checkbox" value="d" name="choiceMultInFourFill[]"></label>
                                            <textarea id="choiceMultInFourFillAnswer_4" name="choiceMultInFourFillAnswer_4"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                    </ul>
                                </div>
                                <div class="multiChoice_field">
                                    <ul class="answerOptionLsit">
                                        <li><label class="form-label" style="font-size: 13px;"><span>A: </span> <input
                                                    type="radio" value="a"
                                                    name="choiceMultiChoiceInFourFill"></label>
                                            <textarea id="choiceMultiChoiceInFourFill_1" name="choiceMultiChoiceInFourFill_1"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li><label class="form-label" style="font-size: 13px;"><span>B: </span><input
                                                    type="radio" value="b"
                                                    name="choiceMultiChoiceInFourFill"></label>
                                            <textarea id="choiceMultiChoiceInFourFill_2" name="choiceMultiChoiceInFourFill_2"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li><label class="form-label" style="font-size: 13px;"><span>C: </span><input
                                                    type="radio" value="c"
                                                    name="choiceMultiChoiceInFourFill"></label>
                                            <textarea id="choiceMultiChoiceInFourFill_3" name="choiceMultiChoiceInFourFill_3"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
                                        </li>
                                        <li><label class="form-label" style="font-size: 13px;"><span>D:</span><input
                                                    type="radio" value="d"
                                                    name="choiceMultiChoiceInFourFill"></label>
                                            <textarea id="choiceMultiChoiceInFourFill_4" name="choiceMultiChoiceInFourFill_4"
                                                class="form-control form-control-lg form-control-alt addQuestion" placeholder="Answer Content"></textarea>
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
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="sectionAddId" value="0" class="sectionAddId">
                    <input type="hidden" name="whichModel" value="question" class="whichModel">
                    <input type="hidden" name="currentModelQueId" value="0" id="currentModelQueId">
                    <input type="hidden" name="questionAddId" value="0" id="questionAddId" class="questionAddId">
                    <button type="button" class="btn btn-primary save_section">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <div class="modal fade" id="dragModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
    <script src="{{ asset('assets/js/toastr/toastr.min.js')}}"></script>
    <script>
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

        async function addNewTypes(data) {
            let key = $(data).attr('data-id');
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
                
            $(data).attr('data-id', key + 1);

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

        function removeNewTypes(data) {
            $(data).parents('.removeNewTypes').remove();
            let count = $('.plus-button').attr('data-id');
            $('.plus-button').attr('data-id', count - 1);
        }

        $(document).ready(function() { 
         
            $('input[name=tags]').tagify();

            $(`#format`).select2({
                // minimumResultsForSearch: -1,
                placeholder : "Select test type"
            });

            $(`#search-input_0`).select2({
                dropdownParent: $('#questionMultiModal'),
                tags: true,
                placeholder : "Select Question type",
                maximumSelectionLength: 1
            });

            $(`#category_type_0`).select2({
                dropdownParent: $('#questionMultiModal'),
                tags : true,
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
        })
        
        var myModal = new bootstrap.Modal(document.getElementById('dragModal'), {
            keyboard: false
        });
        var questionModal = new bootstrap.Modal(document.getElementById('dragModalQuestion'), {
            keyboard: false
        });
        var allowedContent = true;
        CKEDITOR.replace('js-ckeditor-desc', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        /*CKEDITOR.replace( 'js-ckeditor-addQuesection',{
        	extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
        	allowedContent
        });*/
        /*CKEDITOR.replace( 'js-ckeditor-passsection',{
        	extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
        	allowedContent
        });*/
        CKEDITOR.replace('js-ckeditor-addQue', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace('choiceOneInFourAnswer_1', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace('choiceOneInFourAnswer_2', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace('choiceOneInFourAnswer_3', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace('choiceOneInFourAnswer_4', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        CKEDITOR.replace('choiceOneInFiveAnswer_1', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace('choiceOneInFiveAnswer_2', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace('choiceOneInFiveAnswer_3', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace('choiceOneInFiveAnswer_4', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace('choiceOneInFiveAnswer_5', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });


        CKEDITOR.replace('choiceOneInFourPassAnswer_1', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace('choiceOneInFourPassAnswer_2', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace('choiceOneInFourPassAnswer_3', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace('choiceOneInFourPassAnswer_4', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        CKEDITOR.replace('choiceMultInFourFillAnswer_1', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace('choiceMultInFourFillAnswer_2', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace('choiceMultInFourFillAnswer_3', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace('choiceMultInFourFillAnswer_4', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });

        CKEDITOR.replace('choiceMultiChoiceInFourFill_1', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace('choiceMultiChoiceInFourFill_2', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace('choiceMultiChoiceInFourFill_3', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
        });
        CKEDITOR.replace('choiceMultiChoiceInFourFill_4', {
            extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
            allowedContent
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

        function clearModel() {
            $('input[name=tags]').val('');
            $('#passage_number').val(null).trigger("change");
            $('#category_type_0').val(null).trigger("change");
            $('#search-input_0').val(null).trigger("change");
            $(`.removeNewTypes`).remove();
            $('input[name=passagesType]').val(null).trigger("change");
        }

        $(document).on('click', '.add_question_modal_multi', function() {
            clearModel();
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
            getAnswerOption(AnuserOpts);
            getPassages(format);
            removeMoreFillOption();
            $('#questionMultiModal').modal('show');
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
        $('.save_section').click(function() {

            var whichModel = $(this).parent().find('.whichModel').val();
            $('.sectionTypesFull').show();
            var format = $('.ptype #format').val();
            var currentModelId = $('#currentModelId').val();
            var currentModelQueId = $('#currentModelQueId').val();

            var testSectionTitle = $('#testSectiontitle').val();
            var testSectionType = $('#testSectionType').val();
            var tags = $('input[name="tags"]').val();

            var fill = 'N/A';
            var fillType = 'N/A';
            var answerType = 'N/A';
            var multiChoice = '';
            var fillVals = [];

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

                $.ajax({
                    data: {
                        'format': format,
                        'testSectionTitle': testSectionTitle,
                        'testSectionType': testSectionType,
                        'get_test_id': get_test_id,
                        'order': 1,
                        '_token': $('input[name="_token"]').val()
                    },
                    url: '{{ route('addPracticeTestSection') }}',
                    method: 'post',
                    success: (res) => {
                        $('.sectionContainerList').append(
                            '<div class="sectionTypesFull" id="sectionDisplay_' + currentModelId +
                            '" ><div class="mb-2 mb-4"><div class="sectionTypesFullMutli"> </div> <div class="sectionTypesFullMutli firstRecord"><ul class="sectionListtype"><li>Type: &nbsp;<strong>' +
                            format +
                            '</strong></li><li>Section Type:&nbsp;<span class="answerOption"><strong>' +
                            capitalizeFirstLetter(sectionSelectedTxt) +
                            '</strong><input type="hidden" name="selectedSecTxt" value="' +
                            testSectionType +
                            '" class="selectedSecTxt" ></span></li><li>Order: &nbsp;<input type="number" readonly class="form-control" name="order" value="0" id="order_' +
                            res +
                            '"/><button type="button" class="input-field-text" id="basic-addon2" onclick="openOrderDialog()"><i class="fa-solid fa-check"></i></button></li></ul><ul class="sectionHeading"><li>Question</li><li>Answer</li> <li>Passage</li><li>Passage Number</li><li>Fill Answer</li><li class="' +
                            res +
                            '">Order</li></ul></div></div><div class="mb-2 mb-4 ordermain"><button type="button" data-id="' +
                            currentModelId +
                            '" class="btn w-25 btn-alt-success add_question_modal_multi"><i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Question</button><div class="opendialog"><input type="number" readonly class="form-control" name="question_order" value="0" id="order_' +
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

                    }
                });


            } else {

                var testSectionType = $('#testSectionTypeRead').val();
                var question = CKEDITOR.instances['js-ckeditor-addQue'].getData();
                var activeAnswerType = '.' + $('#selectedAnswerType').val();
                //var new_question_type = $('#new_question_type').val();
                var new_question_type_select = $('#new_question_type_select').val();

                var question_category_type_value = $('#category_type').val();
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

                // return false;
                var questionType = $('#questionMultiModal ' + activeAnswerType + ' #questionType').val();
                var pass = ''; //CKEDITOR.instances['js-ckeditor-passquestion'].getData();
                var passNumber = $('#questionMultiModal .passNumber').val();
                var passagesType = $('.passagesType').val();
                var passagesTypeTxt = $(".passagesType option:selected").text();

                if (format == '' || testSectionType == '' || question == '' || questionType == '' || passagesType ==
                    '') {
                    $('#questionMultiModal .validError').text('Below fields are required!');
                    return false;
                } else {
                    $('#questionMultiModal .validError').text('');
                }

                if (questionType == 'choiceOneInFourPass') {
                    answerType = $('#questionMultiModal ' + activeAnswerType +
                        ' input[name="choiceOneInFourPass"]:checked').val();

                } else if (questionType == 'choiceMultInFourFill') {
                    fillVals = $('#questionMultiModal ' + activeAnswerType +
                        '  input[name="choiceMultInFourFill_fill[]"]').map(function() {
                        return $(this).val();
                    }).get();

                    if (typeof fillVals !== 'undefined' && fillVals.length !== 0) {
                        fill = fillVals.join();
                    }
                    if ($('#questionMultiModal #selectedLayoutQuestion ' + activeAnswerType +
                            ' .choiceMultInFourFill_filltype').val() != '') {
                        fillType = $('#questionMultiModal #selectedLayoutQuestion ' + activeAnswerType +
                            ' .choiceMultInFourFill_filltype').val();
                    }

                    var singleChoM = $('#questionMultiModal ' + activeAnswerType +
                        ' input[name="choiceMultiChoiceInFourFill"]:checked').val();

                    if (typeof singleChoM !== 'undefined' && singleChoM != null) {
                        answerType = $('#questionMultiModal ' + activeAnswerType +
                            ' input[name="choiceMultiChoiceInFourFill"]:checked').val();

                    } else {
                        multiChoice = 'multiChoice';
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
                        '"]').val();
                }

                /*answerContent = $('#questionMultiModal '+activeAnswerType+' input[name="answerContentOption[]"]').map(function(){return $(this).val();}).get();*/

                var answerContentJson = getAnswerContent(questionType, fill);


                $('#questionMultiModal').modal('hide');
                $('#questionMultiModal').modal('hide');


                var section_id = $('.sectionAddId').val();
                $.ajax({
                    data: {
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
                        'tags': tags,
                        'section_id': section_id,
                        'new_question_type_select': new_question_type_select,
                        'get_category_type_values': get_category_type_values,
                        'get_question_type_values': get_question_type_values,
                        '_token': $('input[name="_token"]').val()
                    },
                    url: '{{ route('addPracticeQuestion') }}',
                    method: 'post',
                    success: (res) => {
                        $('#sectionDisplay_' + currentModelQueId + ' .firstRecord').append(
                            '<ul class="sectionList"><li>' + question + '</li><li>' + answerType +
                            '</li><li>' + passagesTypeTxt + '</li><li>' + passNumber + '</li><li>' +
                            fill + '</li><li class="orderRearnge_' + res.question_id + '">' + res
                            .question_order + '</li></ul>');

                        $('.addQuestion').val('');
                        $('.validError').text('');
                        $('.questionAddId').val(res.question_id);
                        $('#listWithHandleQuestion').append('<div class="list-group-item" data-id="' +
                            res.question_id + '">\n' +
                            '<span class="glyphicon glyphicon-move" aria-hidden="true">\n' +
                            '<i class="fa-solid fa-grip-vertical"></i>\n' +
                            '</span>\n' +
                            '<button class="btn btn-primary" value="' + res.question_id + '">' +
                            question + '</button>\n' +
                            '</div>');
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
                success: (res) => {
                }
            });
        });

        function getAnswerOption(answerOpt) {

            var questionAnsComb = {
                English: 'choiceOneInFourPass',
                Math: 'choiceOneInFive',
                Reading: 'choiceOneInFourPass',
                Writing: 'choiceOneInFourPass',
                Science: 'choiceOneInFour',
                Math_no_calculator: 'choiceMultInFourFill',
                Math_with_calculator: 'choiceMultInFourFill'
            };
            $.each(questionAnsComb, function(ind, val) {

                if (ind == answerOpt) {

                    if (val == 'choiceOneInFour') {
                        $('#selectedAnswerType').val('choiceOneInFour');
                        $('.choiceOneInFour').show();
                        $('.choiceOneInFive').hide();
                        $('.choiceOneInFourPass').hide();
                        $('.choiceMultInFourFill').hide();
                    } else if (val == 'choiceOneInFive') {
                        $('#selectedAnswerType').val('choiceOneInFive');
                        $('.choiceOneInFour').hide();
                        $('.choiceOneInFive').show();
                        $('.choiceOneInFourPass').hide();
                        $('.choiceMultInFourFill').hide();
                    } else if (val == 'choiceOneInFourPass') {
                        $('#selectedAnswerType').val('choiceOneInFourPass');
                        $('.choiceOneInFour').hide();
                        $('.choiceOneInFive').hide();
                        $('.choiceOneInFourPass').show();
                        $('.choiceMultInFourFill').hide();
                    } else if (val == 'choiceMultInFourFill') {
                        $('#selectedAnswerType').val('choiceMultInFourFill');
                        $('.choiceOneInFour').hide();
                        $('.choiceOneInFive').hide();
                        $('.choiceOneInFourPass').hide();
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
                $('.multi_field').show();
                $('.fill_field').hide();
                $('.multiChoice_field').hide();
            } else if (arg == 3) {
                $('.multi_field').hide();
                $('.multiChoice_field').show();
                $('.fill_field').hide();
            } else {
                $('.multi_field').hide();
                $('.multiChoice_field').hide();
                $('.fill_field').show();
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

            CKEDITOR.instances['choiceMultiChoiceInFourFill_1'].setData('');
            CKEDITOR.instances['choiceMultiChoiceInFourFill_2'].setData('');
            CKEDITOR.instances['choiceMultiChoiceInFourFill_3'].setData('');
            CKEDITOR.instances['choiceMultiChoiceInFourFill_4'].setData('');
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

        function getAnswerContent(answerOpt, fill) {
            var answerContenArr = [];
            if (answerOpt == 'choiceOneInFive') {
                for (var i = 1; i < 6; i++) {
                    var dynamicId = answerOpt + 'Answer_' + i;
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
        Sortable.create(listWithHandle, {
            handle: '.glyphicon-move',
            animation: 150,
            onEnd: function(evt) {
                /*let data = {
                    new_index: evt.newIndex+1,
                    old_index: evt.oldIndex+1,
                    item: evt.item.children[1].value,
                    currentMileId: 1
                };*/
                var section_id = $('.sectionAddId').val();
                var orderId = '#order_' + section_id;
                $(orderId).val(evt.newIndex + 1);

                $.ajax({
                    data: {
                        'section_order': evt.newIndex + 1,
                        'section_id': section_id,
                        '_token': $('input[name="_token"]').val()
                    },
                    url: '{{ route('sectionOrder') }}',
                    method: 'post',
                    success: (res) => {

                    }
                });
            }
        }, );
        // List with handle
        var test = Sortable.create(listWithHandleQuestion, {
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
                var indices = test.toArray();
                $.each(indices, function(index, value) {
                    var new_question_id = value;
                    var new_question_id_order = index + 1;
                    var orderId = '#orderRearnge_' + new_question_id;
                    $(orderId).val(new_question_id_order);
                    $('.orderRearnge_' + new_question_id).text(new_question_id_order);
                    $.ajax({
                        data: {
                            'question_order': new_question_id_order,
                            'question_id': new_question_id,
                            '_token': $('input[name="_token"]').val()
                        },
                        url: '{{ route('questionOrder') }}',
                        method: 'post',
                        success: (res) => {
                        }
                    });
                });



                // var question_id = dataSet.id; 
                // var orderId = '#orderRearnge_'+question_id;

                // $(orderId).val(evt.newIndex+1);
                // $('.orderRearnge_'+question_id).text(evt.newIndex+1);
                // $.ajax({
                //     data:{
                //         'question_order': evt.newIndex+1,
                //         'question_id': question_id,
                //         '_token': $('input[name="_token"]').val()
                //     },
                //     url: '{{ route('questionOrder') }}',
                //     method: 'post',
                //     success: (res) => {
                //     }
                // });
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

    </script>
@endsection
