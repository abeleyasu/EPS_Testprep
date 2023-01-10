@extends('layouts.user')

@section('title', 'Question & Concept Review : CPS')

@section('user-content')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <main id="main-container">
        <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
            {{-- Test review title  --}}
            <div class="bg-body-light">
                <div class="content content-full">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                        <div class="flex-grow-1">
                            <h1 class="h3 fw-bold mb-2">
                                Test Review
                                <br />
                                ACT Math
                            </h1>
                            <h2 class="fs-base lh-base fw-medium mb-0">
                                Official ACT Form 1576C (Z04) - April 2021
                            </h2>
                        </div>
                    </div>
                    <div class="content content-full">
                        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-alt">
                                <li class="breadcrumb-item">
                                    <a class="link-fx" href="javascript:void(0)">Official ACT Form 1576C / Z04 - April 2021 Review Summary</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    ACT Math Review (Form 1576C / Z04)
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            {{-- END Test review title --}}

            <div class="content">
                {{-- Pick a Review Option --}}
                <h2 class="content-heading">Pick a Review Option</h2>
                <div class="row">
                    <div class="col-md-4 col-xl-4">
                        <a class="block block-rounded bg-primary-dark" href="{{ route('test-review.question-concept-review') }}">
                            <div class="block-content block-content-full d-flex justify-content-between">
                                <div class="me-3">
                                    <p class="fw-semibold text-white mb-0">Question & Concept Review MOBILE</p>
                                    <p class="fs-sm text-white-75 mb-0">
                                    Practice Test 1576C
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-xl-4">
                        <a class="block block-rounded bg-primary-dark" href="{{ route('test-review.category-question-type') }}">
                            <div class="block-content block-content-full d-flex justify-content-between">
                                <div class="me-3">
                                    <p class="fw-semibold text-white mb-0">Category & Question Type Summary</p>
                                    <p class="fs-sm text-white-75 mb-0">
                                    from your missed questions.
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-xl-4">
                        <a class="block block-rounded bg-primary-dark" href="{{ route('test-review.answer-type') }}">
                            <div class="block-content block-content-full d-flex justify-content-between">
                                <div class="me-3">
                                    <p class="fw-semibold text-white mb-0">Answer Type Summary</p>
                                    <p class="fs-sm text-white-75 mb-0">
                                    from your missed questions.
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                {{-- END Pick a Review Option --}}

                {{-- score summary - act 1576c --}}
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Score Summary - ACT 1576C</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" value="" id="mega-settings-status" name="mega-settings-status">
                            <label class="form-check-label fs-sm" for="mega-settings-status">Show All Sections</label>
                        </div>
                        <table class="js-table-sections table table-hover table-vcenter">
                            <thead>
                                <tr>
                                    <th style="width: 35%;">Section</th>
                                    <th style="width: 15%;"># Correct</th>
                                    <th style="width: 14%;">Scaled Score (1-36)</th> 
                                    <th style="width: 35%;">Date Taken</th> 
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Math</td>
                                    <td>45/60</td>
                                    <td>28</td>
                                    <td>1/2/2023</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- END score summary - act 1576c --}}

                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Question & Concept Review</h3>
                    </div>
                    <div class="block-content">
                        <h3>ACT Math - Official Form 1576C</h3>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" value="" id="mega-settings-status" name="mega-settings-status">
                            <label class="form-check-label fs-sm" for="mega-settings-status">Show Incorrect Questions Only</label>
                        </div>
                        {{-- header --}}
                        <table class="js-table-sections table table-hover table-vcenter">
                            <thead>
                                <tr>
                                    <th style="width: 30px;"></th>
                                    <th style="width: 5%;">Q#</th>
                                    <th style="width: 10%;">Your Answer</th> 
                                    <th style="width: 10%;">Correct Answer</th> 
                                    <th style="width: 10%;">Flags</th> 
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
    
                        {{-- END header --}}
                        <script>
                            jQuery(document).ready(function(){
                                function removeTags(str) {
                                    if ((str===null) || (str===''))
                                        return false;
                                    else
                                        str = str.toString();
                                    return str.replace( /(<([^>]+)>)/ig, '');
                                }
                                jQuery(".text-info").click(function () {
                                    jQuery('.nav-link').removeClass('active');
                                    jQuery('.tab-pane').removeClass('active');
                                    jQuery(".tab-pane:first").addClass('active');
                                
                                    var get_question_title = removeTags(jQuery(this).data('question-title'));
                                    jQuery(".text-info").addClass(get_question_title);
                                    var get_passage_title = removeTags(jQuery(this).data('passage-title'));
                                    var serial_no = jQuery(this).data('serial-no');
                                    var get_correct_answer = jQuery(this).data('correct-answer');
                                    var get_user_answer = jQuery(this).data('user-answer');
                                    var get_answers_exp = jQuery(this).data('answers-exp');
                                
                                    jQuery(".set_serial_no").text(serial_no);
                                    jQuery(".set_question_title").text(get_question_title);
                                    jQuery(".set_passage_title").text(get_passage_title);

                                    var array_correct = get_correct_answer.split(',');
                                    console.log(array_correct);
                                    array_correct = $.map(array_correct, function(value){
                                        return value.replace(/ /g, '');
                                        });
                                    var array_user_answer = get_user_answer.split(',');
                                    console.log(array_user_answer);
                                    array_user_answer = $.map(array_user_answer, function(value){
                                        return value.replace(/ /g, '');
                                        });

                                    jQuery(".text-info").parent().find('.nav-tabs-alt .nav-item').find('.text-gray').each(function( index ) {
                                        console.log(get_answers_exp);
                                        $.each(get_answers_exp, function( index, value ) {
                                            var new_txt = removeTags(value);
                                            $("div").find('[data-option='+index+']').html( $( "<p>"+value+"</p>" ) );
                                        });
                                        $(this ).addClass('nyni');
                                        console.log(this);
                                        if($(this ).data('option-value') == 'a')
                                        {
                                            $(this).addClass('active');
                                        }
                                        
                                        var option_value = $(this ).data('option-value');
                                        console.log(option_value);
                                        if(jQuery.inArray(option_value, array_correct) != -1)
                                        {
                                            console.log('if');
                                            $(this).removeClass('bg-city-dark');
                                            $(this).removeClass('bg-success');
                                            $(this).removeClass('bg-danger');
                                            $(this).addClass('bg-success');
                                        }
                                        else if(jQuery.inArray(option_value, array_user_answer) != -1)
                                        {
                                            console.log('else if');
                                            $(this).addClass('bg-danger');
                                            $(this).addClass('text-gray');
                                            $(this).removeClass('bg-success');
                                            $(this).removeClass('bg-city-dark');
                                        }
                                        else 
                                        {
                                            console.log('else');
                                            $(this).removeClass('bg-success');
                                            $(this).addClass('text-gray');
                                            $(this).addClass('bg-city-dark');
                                        }
                                    });
                                });
                            });
                        </script>
                        <div class="tab-content" id="myTabContent">
                            <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                                <div class="accordion accordionExample">
                                    <?php
                                        $count = 1;
                                    ?>
                                    
                                    {{-- accordian tab 1 --}}
                                    @foreach($user_selected_answers as $key => $single_user_selected_answers)
                                    
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab justify-content-start" type="button" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                    
                                            <table>
                                                <tr >
                                                    <td class="text-center">
                                                        <i class="fa fa-angle-right text-white me-2 accordian-icon"></i>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger fs-xs fw-semibold me-1" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Category Type">{{$count++}}</button>
                                                        <?php $correct =  str_replace(' ', '', $single_user_selected_answers['get_question_details'][0]->question_answer); ?>
                                                        @if($single_user_selected_answers['user_selected_answer'] == $correct)
                                                        <button type="button" class="btn btn-success fs-xs fw-semibold me-1" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Category Type"><i class="fa fa-lg fa-circle-check me-1" style="color:white"></i> {{$single_user_selected_answers['user_selected_answer']}}</button>
                                                        @else
                                                        <button type="button" class="btn btn-danger fs-xs fw-semibold me-1" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Category Type"><i class="fa fa-lg fa-circle-xmark me-1" style="color:white"></i> {{$single_user_selected_answers['user_selected_answer']}}</button>       
                                                        @endif

                                                        <button type="button" class="btn btn-success fs-xs fw-semibold me-1" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Category Type"><i class="fa fa-lg fa-circle-check me-1" style="color:white"></i> {{$single_user_selected_answers['get_question_details'][0]->question_answer}}</button>

                                                        @if($single_user_selected_answers['user_selected_flag'] == 'yes' )
                                                        <i class="fa fa-fw fa-flag me-1" style="color:rgb(255, 255, 255)" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Flagged Question"></i>
                                                        @endif
                                                        
                                                        @if($single_user_selected_answers['user_selected_guess'] == 'yes' )
                                                        <i class="fa fa-fw fa-circle-question me-1" style="color:rgb(255, 255, 255)" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Guessed On Question"></i>
                                                        @endif

                                                        @if($single_user_selected_answers['user_selected_answer'] == '-' )
                                                        <i style="color:rgb(255, 255, 255)" class="fa fa-fw fa-forward me-1" data-bs-trigger="click" data-bs-placement="top" title="Skipped Question"></i>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".accordionExample">
                                            <div class="odd">    
                                                <div class="fw-semibold fs-sm p-4 ">
                
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q1r" data-question-title="{{$single_user_selected_answers['get_question_details'][0]->question_title}}" data-passage-title="{{$single_user_selected_answers['get_question_details'][0]->title}}" data-correct-answer = "{{$single_user_selected_answers['get_question_details'][0]->question_answer}}"
                                                    data-user-answer = "{{$single_user_selected_answers['user_selected_answer']}}" data-answers-exp="{{($single_user_selected_answers['get_question_details'][0]->question_answer_options)}}" data-serial-no = "{{$key + 1}}" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info text-white text-info"><i class="fa fa-lg fa-pencil me-1"></i>REVIEW</button>
                
                                                    <div class="modal" id="modal-block-large-q1r" tabindex="-1" aria-labelledby="modal-block-large-q1r" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="block block-rounded">
                                                                    <div class="block-header block-header-default">
                                                                        <h3 class="block-title">Question <span class="set_serial_no">{{$key + 1}}</span> Review</h3>
                                                                    </div>
                                                                    <div class="block-content">
                                                                        <div class="row items-push">
                                                                            <div id="my-block" class="block block-rounded block-bordered">
                                                                                <div class="block-content">
                                                                                    <p>N/A</p>
                                                                                </div>
                                                                            </div>
                
                                                                            <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                <div class="block-header block-header-default">
                                                                                    <h3 class="block-title">Question <span class="set_serial_no">{{$key + 1}}</span></h3>
                                                                                    <div class="block-options">
                                                                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="block-content">
                                                                                <p class="set_question_title">{{strip_tags($single_user_selected_answers['get_question_details'][0]->question_title)}}</p>
                                                                                </div>
                                                                            </div>
                
                                                                            <div class="block block-rounded">
                                                                                <ul class="nav nav-tabs nav-tabs-alt" role="tablist">
                                                                                    <li class="nav-item">
                                                                                        <button class="nav-link active bg-danger 
                                                                                        text-gray
                                                                                        text-white" id="btabs-alt-static-home-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q1a" role="tab" aria-controls="btabs-alt-static-home" data-option-value='a' aria-selected="true">Answer A</button>
                                                                                    </li>
                                                                                    <li class="nav-item">
                                                                                        <button class="nav-link bg-city-dark text-gray" id="btabs-alt-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q1b" role="tab" aria-controls="btabs-alt-static-profile"
                                                                                        data-option-value='b' aria-selected="false">Answer B</button>
                                                                                    </li>
                                                                                    <li class="nav-item">
                                                                                        <button class="nav-link bg-city-dark text-gray" id="btabs-alt-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q1c" role="tab" aria-controls="btabs-alt-static-profile" data-option-value='c' aria-selected="false">Answer C</button>
                                                                                    </li>
                                                                                    <li class="nav-item">
                                                                                        <button class="nav-link bg-city-dark text-gray" id="btabs-alt-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q1d" role="tab" aria-controls="btabs-alt-static-profile" data-option-value='d'  aria-selected="false">Answer D</button>
                                                                                    </li>
                                                                                </ul>
                
                                                                                <div class="block-content tab-content">
                                                                                    <div class="tab-pane active" id="btabs-alt-static-q1a" data-option="0" role="tabpanel" aria-labelledby="btabs-alt-static-home-tab">
                                                                                        <p>NO CHANGE: 1/9</p>
                                                                                        <p><b>Explanation: </b>Reasons...</p>
                                                                                    </div>
                                                                                    <div class="tab-pane" id="btabs-alt-static-q1b" data-option="1" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                                                                        <p>1/15</p>
                                                                                        <p><b>Explanation: </b>Reasons...</p>
                                                                                    </div>
                                                                                    <div class="tab-pane" id="btabs-alt-static-q1c" data-option="2" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                                                                        <p>6/15</p>
                                                                                        <p><b>Explanation: </b>Reasons...</p>
                                                                                    </div>
                                                                                    <div class="tab-pane" id="btabs-alt-static-q1d" data-option="3" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                                                                        <p>7/15</p>
                                                                                        <p><b>Explanation: </b>Reasons...</p>
                                                                                    </div>
                                                                                    <div class="tab-pane" id="btabs-alt-static-q1e" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                                                                        <p>8/15</p>
                                                                                        <p><b>Explanation: </b>Reasons...</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="block-content block-content-full text-end bg-body">
                                                                        <button type="button" class="btn btn-sm block-header-default  text-white  " data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                
                                                    <br />
                
                                                    <div class="col-md-6 mb-2">
                                                        <select class="form-select" id="example-select" name="example-select">
                                                        <option selected>Mistake Type (Select One)</option>
                                                        <option value="1">Content Misunderstanding</option>
                                                        <option value="2">Random Error</option>
                                                        <option value="3">Timing Issue</option>
                                                        </select>
                                                    </div>
                
                                                    <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 30%;" class="sorting" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Category</th>
                                                                <th style="width: 70%;" class="sorting" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Question Type</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="odd">
                                                                <td>
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q1ct1" class="btn btn-danger fs-xs fw-semibold me-1 bg-danger text-white">
                                                                        <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                                                        Probability
                                                                    </button>
                                            
                                                                    <div class="modal" id="modal-block-large-q1ct1" tabindex="-1" aria-labelledby="modal-block-large-q1ct1" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                
                                                                                <div class="block block-rounded">
                                                                                    <div class="block-header block-header-default">
                                                                                        <h3 class="block-title">Category: Probability</h3>
                                                                                    </div>
                                                                                    <div class="block-content">
                                                                                        <div id="q1ct1" class="mb-5" role="tablist" aria-multiselectable="true">
                                                                                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                <div class="block-header block-header-default" role="tab" id="category-probability-description">
                                                                                                    <a class="text-white collapsed" data-bs-toggle="collapse" data-bs-parent="#faq_q1" href="#category-probability-des" aria-expanded="false" aria-controls="category-probability-des">Description</a>
                                                                                                </div>
                                                                                                <div id="category-probability-des" class="collapse" role="tabpanel" aria-labelledby="category-probability-description" data-bs-parent="#faq_q1" style="">
                                                                                                    <div class="block-content">
                                                                                                        <p>Simple Probability questions have you calculate the probability of events that can be expressed as a single fraction: the number of successful outcomes divided by the number of potential outcomes.</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="block-content block-content-full text-end bg-body">
                                                                                            <button type="button" class="btn btn-sm block-header-default  text-white  " data-bs-dismiss="modal">Close</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                        
                                                                </td>
                                                                
                                                                <td style="">
                                            
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q1qt1" class="btn btn-danger fs-xs fw-semibold me-1 bg-danger text-white">
                                                                        <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                                                        Simple Probability
                                                                    </button>
                                            
                                                                    <div class="modal" id="modal-block-large-q1qt1" tabindex="-1" aria-labelledby="modal-block-large-q1qt1" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="block block-rounded">
                                                                                    <div class="block-header block-header-default">
                                                                                        <h3 class="block-title">Question Type: Punctuation Between Multiple Adjectives</h3>
                                                                                    </div>
                                                                                    <div class="block-content">
                                                                                        <div id="faq_q1" class="mb-5" role="tablist" aria-multiselectable="true">
                                                                                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                <div class="block-header block-header-default" role="tab" id="faq_q1_qt1_description_aria-label">
                                                                                                    <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q1" href="#faq_q1_qt1_description" aria-expanded="true" aria-controls="faq_q1_qt1_description">Description</a>
                                                                                                </div>
                                                                                                <div id="faq_q1_qt1_description" class="collapse show" role="tabpanel" aria-labelledby="faq_q1_qt1_description_aria-label" data-bs-parent="#faq_q1">
                                                                                                    <div class="block-content">
                                                                                                        <p>Simple Probability questions have you calculate the probability of events that can be expressed as a single fraction: the number of successful outcomes divided by the number of potential outcomes.</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                <div class="block-header block-header-default" role="tab" id="faq_q1_qt1_lesson_aria-label">
                                                                                                    <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q1" href="#faq_q1_qt1_lesson" aria-expanded="true" aria-controls="faq_q1_qt1_lesson">Lesson</a>
                                                                                                </div>
                                                                                                <div id="faq_q1_qt1_lesson" class="collapse" role="tabpanel" aria-labelledby="faq_q1_qt1_lesson_aria-label" data-bs-parent="#faq_q1">
                                                                                                    <div class="block-content">
                                                                                                        <p>The simple probability of an event is the number of favorable outcomes divided by the number of potential outcomes.
                                                                                                        <br/>
                                                                                                        <br/>
                                                                                                        Probability = # of favorable outcomes / total # of potential outcomes
                                                                                                        <br/>
                                                                                                        <br/>
                                                                                                        Another way to think about probability = Part / Whole OR Part / Total 
                                                                                                        <br/>
                                                                                                        <br/>
                                                                                                        <b>Example 1</b>
                                                                                                        <br/>
                                                                                                        <br/>
                                                                                                        What’s the probability of a flipped coin landing on heads?
                                                                                                        <br/>
                                                                                                        <br/>
                                                                                                        There are a total of 2 potential outcomes: heads or tails.
                                                                                                        <br/>
                                                                                                        <br/>
                                                                                                        There is only 1 favorable outcome: heads.
                                                                                                        <br/>
                                                                                                        <br/>
                                                                                                        probability = # of favorable outcomes / total # of potential outcomes = <b>1/2</b>
                                                                                                        
                                                                                                        <br/>
                                                                                                        <br/>
                                                                                                        So the probability of flipping a coin and landing on heads is <b>1/2</b>.
                                                                                                        <br/></p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="block block-rounded block-bordered overflow-hidden mb-1">                                                                                
                                                                                                <div class="block-header block-header-default" role="tab" id="faq_q1_qt1_strategies_aria-label">
                                                                                                    <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q4" href="#faq_q1_qt1_strategies" aria-expanded="true" aria-controls="faq_q1_qt1_strategies">Strategies</a>
                                                                                                </div>
                                                                                                <div id="faq_q1_qt1_strategies" class="collapse" role="tabpanel" aria-labelledby="faq_q1_qt1_strategies_aria-label" data-bs-parent="#faq_q1">
                                                                                                    <div class="block-content">
                                                                                                        <p>
                                                                                                            <b>Strategy 1: Identify each part of the probability formula </b>
                                                                                                        </p>
                                                                                                        <p>Identify the total # of possibilties first and write it as your denominator. Then identify how many favorable outcomes align with the situation and write it as your numerator.</p>
                                                
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                <div class="block-header block-header-default" role="tab" id="faq_q1_qt1_idmethods_aria-label">
                                                                                                    <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q4" href="#faq_q1_qt1_idmethods" aria-expanded="true" aria-controls="faq_q1_qt1_idmethods">Identification Methods</a>
                                                                                                </div>
                                                                                                <div id="faq_q1_qt1_idmethods" class="collapse" role="tabpanel" aria-labelledby="faq_q1_qt1_idmethods_aria-label" data-bs-parent="#faq_q1">
                                                                                                    <div class="block-content">
                                                                                                        <p><b>Identification Method 1</b></p>
                                                                                                        <p>The question is a word problem, using the words/phrases "probability" or "what fraction" or "what are the chances" and the answer choices are usually single fractions.</p>
                                                                                                        <p><b>Example 1</b></p>
                                                                                                        <p>Question: A bag has 20 total marbles - 3 blue, 8 red, and 9 green. Which of the following is the probability of picking a blue marble?</p>
                                                                                                        A. 3/20<br />
                                                                                                        B. 3/8<br />
                                                                                                        C. 8/8<br />
                                                                                                        D. 8/20<br />
                                                                                                        E. 9/20</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                <div class="block-header block-header-default" role="tab" id="faq_q1_qt1_idactivity_aria-label">
                                                                                                    <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q4" href="#faq_q1_qt1_idactivity" aria-expanded="true" aria-controls="faq_q1_qt1_idactivity">Identification Activity</a>
                                                                                                </div>
                                                                                                <div id="faq_q1_qt1_idactivity" class="collapse" role="tabpanel" aria-labelledby="faq_q1_qt1_idactivity_aria-label" data-bs-parent="#faq_q1">
                                                                                                    <div class="block-content">
                                                                                                        <p><b>Identification Activity 1</b></p>
                                                                                                        <p>Which of the following questions test Punctuation Between Multiple Adjectives?</p>
                                                                        
                                                                                                        <p>Question 1</p>
                                                                                                        <p>Question 2</p>
                                                                        
                                                                                                        <p>1. Part of his success is attributed to his ability to <u>plead</u> to a wide range of audiences.</p>
                                                                        
                                                                                                        <p>A. NO CHANGE</p>
                                                                                                        <p>B. appeal</p>                                                                                        <p>C. attract </p>
                                                                                                        <p>D. remark</p>
                                                                        
                                                                                                        <p>A. NO CHANGE</p>
                                                                                                        <p>B. appeal</p>
                                                                                                        <p>C. attract </p>
                                                                                                        <p>D. remark</p>
                                                                        
                                                                                                        <p>2. The Dahlia flower is famous <u>to</u> its unique pattern of petals.</p>
                                                                
                                                                                                        <p>A. NO CHANGE</p>
                                                                                                        <p>B. by</p>
                                                                                                        <p>C. for</p>
                                                                                                        <p>D. with</p>
                                                                    
                                                                                                        <p>Key: </p>
                                                                                                        <p>#1: No, this example tests Vocabulary in Context.</p>
                                                                                                        <p>#2: No, even though this question tests different word choices, it does NOT test Keyword Goal. It tests Idioms and Prepositions.</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="block-content block-content-full text-end bg-body">
                                                                                        <button type="button" class="btn btn-sm block-header-default  text-white  " data-bs-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                                                                            
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                  
            </div>
        </div>
    </main>
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('css/test-review.css') }}">
@endsection

@section('page-script')
<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
<script src="{{ asset('js/test-review.js') }}"></script>
@endsection