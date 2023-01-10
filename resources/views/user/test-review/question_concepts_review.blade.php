@extends('layouts.user')

@section('title', 'Question & Concept Review : CPS')

@section('user-content')
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
                {{-- END Pick a Review Option --}}

                <div class="">
                    <ul class="nav nav-tabs col-12" role="tablist">
                      <li class="nav-item me-0 col-md-4 col-xl-4 pe-3" role="presentation">
                        <button class="block block-rounded bg-primary-dark nav-link w-100 tab-padding" id="btabs-animated-fade-home-tab" data-bs-toggle="tab" data-bs-target="#btabs-animated-fade-home" role="tab" aria-controls="btabs-animated-fade-home" aria-selected="false" tabindex="-1">
                            <div class="block-content text-start p-0 block-content-full  d-flex justify-content-between">
                                <div class="me-3">
                                    <p class="fw-semibold text-white mb-0">Question & Concept Review MOBILE</p>
                                    <p class="fs-sm text-white-75 mb-0">
                                    Practice Test 1576C
                                    </p>
                                </div>
                            </div>
                        </button>
                      </li>
                      <li class="nav-item me-0 col-md-4 col-xl-4 px-2" role="presentation">
                        <button class="block block-rounded bg-primary-dark nav-link w-100 tab-padding" id="btabs-animated-fade-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-animated-fade-profile" role="tab" aria-controls="btabs-animated-fade-profile" aria-selected="true">
                            <div class="block-content text-start p-0 block-content-full  d-flex justify-content-between">
                                <div class="me-3">
                                    <p class="fw-semibold text-white mb-0">Category & Question Type Summary</p>
                                    <p class="fs-sm text-white-75 mb-0">
                                    from your missed questions.
                                    </p>
                                </div>
                            </div>
                        </button>
                      </li>
                      <li class="nav-item me-0 col-md-4 col-xl-4 ps-3" role="presentation">
                        <button class="block block-rounded bg-primary-dark nav-link w-100 tab-padding" id="btabs-animated-fade-answer-tab" data-bs-toggle="tab" data-bs-target="#btabs-animated-fade-answer" role="tab" aria-controls="btabs-animated-fade-answer" aria-selected="true">
                            <div class="block-content text-start p-0 block-content-full  d-flex justify-content-between">
                                <div class="me-3">
                                    <p class="fw-semibold text-white mb-0">Answer Type Summary</p>
                                    <p class="fs-sm text-white-75 mb-0">
                                    from your missed questions.
                                    </p>
                                </div>
                            </div>
                        </button>
                      </li>
                    </ul>
                    <div class="block-content tab-content overflow-hidden">

                        {{-- Question & Concept Review MOBILE tab --}}
                        <div class="tab-pane fade active show" id="btabs-animated-fade-home" role="tabpanel" aria-labelledby="btabs-animated-fade-home-tab" tabindex="0">
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

                                    <div class="tab-content" id="myTabContent">
                                        <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                                            <div class="accordion accordionExample">

                                                {{-- accordian tab 1 --}}
                                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                    <div class="block-header block-header-tab justify-content-start" type="button" data-toggle="collapse" data-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                
                                                        <table>
                                                            <tr >
                                                                <td class="text-center">
                                                                    <i class="fa fa-angle-right text-white me-2 accordian-icon"></i>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-danger fs-xs fw-semibold me-1" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Category Type">1</button>
                                                                    <button type="button" class="btn btn-danger fs-xs fw-semibold me-1" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Category Type"><i class="fa fa-lg fa-circle-xmark me-1" style="color:white"></i> A</button>
                                                                    <button type="button" class="btn btn-success fs-xs fw-semibold me-1" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Category Type"><i class="fa fa-lg fa-circle-check me-1" style="color:white"></i> E</button>
                                                                    <i class="fa fa-fw fa-flag me-1" style="color:rgb(255, 255, 255)" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Flagged Question"></i>
                                                                    <i class="fa fa-fw fa-circle-question me-1" style="color:rgb(255, 255, 255)" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Guessed On Question"></i>
                                                                    <i style="color:rgb(255, 255, 255)" class="fa fa-fw fa-forward me-1" data-bs-trigger="click" data-bs-placement="top" title="Skipped Question"></i>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                    </div>
                                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".accordionExample">
                                                        <div class="odd">    
                                                            <div class="fw-semibold fs-sm p-4 ">
                            
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q1r" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info text-white"><i class="fa fa-lg fa-pencil me-1"></i>REVIEW</button>
                            
                                                                <div class="modal" id="modal-block-large-q1r" tabindex="-1" aria-labelledby="modal-block-large-q1r" style="display: none;" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="block block-rounded">
                                                                                <div class="block-header block-header-default">
                                                                                    <h3 class="block-title">Question 1 Review</h3>
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
                                                                                                <h3 class="block-title">Question 1</h3>
                                                                                                <div class="block-options">
                                                                                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="block-content">
                                                                                                <p>
                                                                                                    <b>Please refer to the PDF, book, or downloaded file for this question. Test 1576C / Z04 can be found here: 
                                                                                                        <a href="https://www.act.org/content/dam/act/unsecured/documents/Preparing-for-the-ACT.pdf">
                                                                                                            <u>Test Link</u>
                                                                                                        </a>
                                                                                                    </b>
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                            
                                                                                        <div class="block block-rounded">
                                                                                            <ul class="nav nav-tabs nav-tabs-alt" role="tablist">
                                                                                                <li class="nav-item">
                                                                                                    <button class="nav-link active bg-danger text-white" id="btabs-alt-static-home-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q1a" role="tab" aria-controls="btabs-alt-static-home" aria-selected="true">Answer A</button>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <button class="nav-link bg-city-dark text-gray" id="btabs-alt-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q1b" role="tab" aria-controls="btabs-alt-static-profile" aria-selected="false">Answer B</button>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <button class="nav-link bg-city-dark text-gray" id="btabs-alt-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q1c" role="tab" aria-controls="btabs-alt-static-profile" aria-selected="false">Answer C</button>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <button class="nav-link bg-city-dark text-gray" id="btabs-alt-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q1d" role="tab" aria-controls="btabs-alt-static-profile" aria-selected="false">Answer D</button>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <button class="nav-link bg-success text-gray" id="btabs-alt-static-home-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q1e" role="tab" aria-controls="btabs-alt-static-home" aria-selected="true">Answer E</button>
                                                                                                </li>
                                                                                            </ul>
                            
                                                                                            <div class="block-content tab-content">
                                                                                                <div class="tab-pane active" id="btabs-alt-static-q1a" role="tabpanel" aria-labelledby="btabs-alt-static-home-tab">
                                                                                                    <p>NO CHANGE: 1/9</p>
                                                                                                    <p><b>Explanation: </b>Reasons...</p>
                                                                                                </div>
                                                                                                <div class="tab-pane" id="btabs-alt-static-q1b" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                    <p>1/15</p>
                                                                                                    <p><b>Explanation: </b>Reasons...</p>
                                                                                                </div>
                                                                                                <div class="tab-pane" id="btabs-alt-static-q1c" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                    <p>6/15</p>
                                                                                                    <p><b>Explanation: </b>Reasons...</p>
                                                                                                </div>
                                                                                                <div class="tab-pane" id="btabs-alt-static-q1d" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
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

                                                {{-- accordion tab 2 --}}
                                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                    <div class="block-header block-header-tab justify-content-start" type="button" data-toggle="collapse" data-target="#collapseTwo"
                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                
                                                        <table>
                                                            <tr >
                                                                <td class="text-center">
                                                                    <i class="fa fa-angle-right text-white me-2 accordian-icon"></i>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-danger fs-xs fw-semibold me-1" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Category Type">2</button>
                                                                    <button type="button" class="btn btn-danger fs-xs fw-semibold me-1" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Category Type"><i class="fa fa-lg fa-circle-xmark me-1" style="color:white"></i> H</button>
                                                                    <button type="button" class="btn btn-success fs-xs fw-semibold me-1" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Category Type"><i class="fa fa-lg fa-circle-check me-1" style="color:white"></i> J</button>
                                                                    <i class="fa fa-fw fa-flag me-1" style="color:rgb(255, 255, 255)" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Flagged Question"></i>
                                                                    <i class="fa fa-fw fa-circle-question me-1" style="color:rgb(255, 255, 255)" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Guessed On Question"></i>
                                                                    <i style="color:rgb(255, 255, 255)" class="fa fa-fw fa-forward me-1" data-bs-trigger="click" data-bs-placement="top" title="Skipped Question"></i>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                    </div>
                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent=".accordionExample">
                                                        <div class="even">
                                                            <div class="fw-semibold fs-sm p-4">
                                        
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q2r" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info text-white"><i class="fa fa-lg fa-pencil me-1"></i>REVIEW</button>
                                            
                                                                <div class="modal" id="modal-block-large-q2r" tabindex="-1" aria-labelledby="modal-block-large-q2r" style="display: none;" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="block block-rounded">
                                                                                <div class="block-header block-header-default">
                                                                                    <h3 class="block-title">Question 2 Review</h3>
                                                                                </div>
                                                                                <div class="block-content">
                                                                                    <div class="row items-push">
                            
                                                                                        <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                            <div class="block-header block-header-default">
                                                                                                <h3 class="block-title">Question 2</h3>
                                                                                                <div class="block-options">
                                                                                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="block-content">
                                                                                                <p>
                                                                                                    <b>Please refer to the PDF, book, or downloaded file for this question. Test 1576C / Z04 can be found here: <a href="https://www.act.org/content/dam/act/unsecured/documents/Preparing-for-the-ACT.pdf"><u>Test Link</u></a>
                                                                                                    </b>
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                        <div class="block block-rounded">
                                                                                            <ul class="nav nav-tabs nav-tabs-alt" role="tablist">
                                                                                                <li class="nav-item">
                                                                                                    <button class="nav-link active bg-city-dark text-gray" id="btabs-alt-static-home-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q2a" role="tab" aria-controls="btabs-alt-static-home" aria-selected="true">Answer F</button>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <button class="nav-link bg-city-dark text-gray" id="btabs-alt-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q2b" role="tab" aria-controls="btabs-alt-static-profile" aria-selected="false">Answer G</button>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <button class="nav-link bg-danger text-gray" id="btabs-alt-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q2c" role="tab" aria-controls="btabs-alt-static-profile" aria-selected="false">Answer H</button>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <button class="nav-link bg-success text-gray" id="btabs-alt-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q2d" role="tab" aria-controls="btabs-alt-static-profile" aria-selected="false">Answer J</button>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <button class="nav-link bg-city-dark text-gray" id="btabs-alt-static-home-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q2e" role="tab" aria-controls="btabs-alt-static-home" aria-selected="true">Answer K</button>
                                                                                                </li>
                                                                                            </ul>
                                                                                            
                                                                                            <div class="block-content tab-content">
                                                                                                <div class="tab-pane active" id="btabs-alt-static-q2a" role="tabpanel" aria-labelledby="btabs-alt-static-home-tab">
                                                                                                    <p>NO CHANGE: x^8</p>
                                                                                                    <p>
                                                                                                        <b>Explanation: </b>
                                                                                                        Adding exponents only works when the base variables are being multiplied. x^3 + x^3 + x^2 is NOT x^8.
                                                                                                    </p>
                                                                                                </div>
                                                                                                <div class="tab-pane" id="btabs-alt-static-q2b" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                    <p>-7x^8</p>
                                                                                                    <p><b>Explanation: </b>Adding exponents only works when the base variables are being multiplied. x^3 + x^3 + x^2 is NOT x^8. Also, x^3 and x^2 are NOT like terms, so all three of these terms cannot be added. The coefficient -7 is only possible when adding/subtracting all three of the terms' coefficients, but only the two x^3 terms are like terms and can be combined.</p>
                                                                                                </div>
                                                                                                <div class="tab-pane" id="btabs-alt-static-q2c" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                    <p>-8x^3 + 9x^2</p>
                                                                                                    <p><b>Explanation: </b>The terms -4x^2 and -12x^2 can be combined, but -4 - 12 = -16, not -8 like answer H shows.</p>
                                                                                                </div>
                                                                                                <div class="tab-pane" id="btabs-alt-static-q2d" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                    <p>-16x^3 + 9x^2</p>
                                                                                                    <p><b>Explanation: </b>This answer correctly combines the two x^3 terms and leaves the unlike x^2 term on its own. -4x^3 - 12x^3 = -16x^3, which then gets added to the lone 9x^2 term, which equals -16x^3 + 9x^2.</p>
                                                                                                </div>
                                                                                                <div class="tab-pane" id="btabs-alt-static-q2e" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                    <p>-16x^6 + 9x^2</p>
                                                                                                    <p><b>Explanation: </b>Combining like terms only adds/subtracts their <b>coefficients</b>, NOT their exponents. x^3 + x^3 is NOT x^6. x^3*x^3 is x^6, but that's not happening in this problem.</p>
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
                                                                            <th style="width: 30%;" class="sorting" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Category</th><th style="width: 70%;" class="sorting" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Question Type</th>
                                                                        </tr>
                                                                    </thead>
                            
                                                                    <tbody>
                                                                        <tr class="odd">
                                                                            <td style="">
                                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q2ct1" class="btn btn-danger fs-xs fw-semibold me-1 bg-danger text-white"><i class="fa fa-lg fa-circle-xmark me-1"></i>Expressions & Equations</button>
                                                                
                                                                                <div class="modal" id="modal-block-large-q2ct1" tabindex="-1" aria-labelledby="modal-block-large-q2ct1" style="display: none;" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="block block-rounded">
                                                                                                <div class="block-header block-header-default">
                                                                                                    <h3 class="block-title">Category: Expressions & Equations</h3>
                                                                                                </div>
                                                                                                <div class="block-content">
                                                                                                    <div id="q2ct1" class="mb-5" role="tablist" aria-multiselectable="true">
                                                                                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                            <div class="block-header block-header-default" role="tab" id="q2ct1_description-expressions">
                                                                                                                <a class="text-white collapsed" data-bs-toggle="collapse" data-bs-parent="#faq_q1" href="#q2ct1_description" aria-expanded="false" aria-controls="q2ct1_description">Description</a>
                                                                                                            </div>
                                                                                                            <div id="q2ct1_description" class="collapse" role="tabpanel" aria-labelledby="q2ct1_description-expressions" data-bs-parent="#faq_q1" style="">
                                                                                                                <div class="block-content">
                                                                                                                    <p>Questions in the Category Type "Expressions & Equations" test how to solve, simplify, rearrange, and work with expressions and equations.</p>
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
                                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q2qt1" class="btn btn-danger fs-xs fw-semibold me-1 bg-danger text-white"><i class="fa fa-lg fa-circle-xmark me-1"></i>Simplify/Evaluate/Find Equivalent Expressions</button>
                                            
                                                                                <div class="modal" id="modal-block-large-q2qt1" tabindex="-1" aria-labelledby="modal-block-large-q2qt1" style="display: none;" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="block block-rounded">
                                                                                                <div class="block-header block-header-default">
                                                                                                    <h3 class="block-title">Simplify/Evaluate/Find Equivalent Expressions</h3>
                                                                                                </div>
                                                                                                <div class="block-content">
                                                                                                    <div id="faq_q2" class="mb-5" role="tablist" aria-multiselectable="true">
                                                                                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                            <div class="block-header block-header-default" role="tab" id="faq_q2_qt1_description_aria-label">
                                                                                                                <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q2" href="#faq_q2_qt1_description" aria-expanded="true" aria-controls="faq_q2_qt1_description">Description</a>
                                                                                                            </div>
                                                                                                            <div id="faq_q2_qt1_description" class="collapse show" role="tabpanel" aria-labelledby="faq_q2_qt1_description_aria-label" data-bs-parent="#faq_q2">
                                                                                                                <div class="block-content">
                                                                                                                    <p>
                                                                                                                    This question type covers a broad range of questions with one simple idea - use different types of combining like terms, simplifying, or substitution to match the expression/equation in the original problem to one in the answer choices.
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                            <div class="block-header block-header-default" role="tab" id="faq_q2_qt1_lesson_aria-label">
                                                                                                                <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q2" href="#faq_q2_qt1_lesson" aria-expanded="true" aria-controls="faq_q2_qt1_lesson">Lesson</a>
                                                                                                            </div>
                                                                                                            <div id="faq_q2_qt1_lesson" class="collapse" role="tabpanel" aria-labelledby="faq_q2_qt1_lesson_aria-label" data-bs-parent="#faq_q2">
                                                                                                                <div class="block-content">
                                                                                                                To simplify, evaluate, or find an equivalent expression, determine which types of simplifying need to occur in the problem.
                                                                                                                    <br/>
                                                                                                                        <br/>
                                                                                    
                                                                                                                    Types of Simplifying
                                                                                                                    <br/>
                                                                                                                        <br/>
                                                                                                                    1. Combine Like Terms
                                                                                                                    <br/>
                                                                                                                    2. Substitution
                                                                                                                    <br/>
                                                                                                                    3. Distribution
                                                                                                                    <br/>
                                                                                                                    4. Factoring
                                                                                                                    <br />
                                                                                                                    <br />
                                                                                    
                                                                                                                    When any of the above types of simplifying occur in the question, that specific question type will be attached to the question and you can click the button to see the lesson for Combining Like Terms, Substitution, Distribution, or Factoring.
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                            <div class="block-header block-header-default" role="tab" id="faq_q2_qt1_strategies_aria-label">
                                                                                                                <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q2" href="#faq_q2_qt1_strategies" aria-expanded="true" aria-controls="faq_q2_qt1_strategies">Strategies</a>
                                                                                                            </div>
                                                                                                            <div id="faq_q2_qt1_strategies" class="collapse" role="tabpanel" aria-labelledby="faq_q2_qt1_strategies_aria-label" data-bs-parent="#faq_q2">
                                                                                                                <div class="block-content">
                                                                                                                    <p><b>Strategy 1: Identify which type of simplifying to perform and know the rules </b></p>
                                                                                                                    <p>Identify which type of simplifying that the question is calling for and make sure you know the rules for each type.</p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                            <div class="block-header block-header-default" role="tab" id="faq_q2_qt1_idmethods_aria-label">
                                                                                                                <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q2" href="#faq_q2_qt1_idmethods" aria-expanded="true" aria-controls="faq_q2_qt1_idmethods">Identification Methods</a>
                                                                                                            </div>
                                                                                                            <div id="faq_q2_qt1_idmethods" class="collapse" role="tabpanel" aria-labelledby="faq_q2_qt1_idmethods_aria-label" data-bs-parent="#faq_q2">
                                                                                                                <div class="block-content">
                                                                                                                    <p><b>Identification Method 1</b></p>
                                                                                                                        <p>The question asks you to "find equivalent expressions".</p>
                                                                                                                        <p><b>Example 1</b></p>
                                                                                                                        <p>Question: Find equivalent expression for (x^2 - 3)/x</p>
                                                                                                                        <b>A. x - (3/x)</b><br />
                                                                                                                        B. x^2 - (3/x)<br />
                                                                                                                        C. x - 3<br />
                                                                                                                        D. x^2 - 3x<br />
                                                                                                                        E. -2x<br />
                                                                                                                    <br />
                                                                                    
                                                                                                                    <b>Identification Method 2</b></p>
                                                                                                                        <p>The question implies or asks you to "simplify", "solve", or "combine like terms".</p>
                                                                                                                        <p><b>Example 1</b></p>
                                                                                                                        <p>Question: Simplify 3x + 4x^2 - 2x - 8</p>
                                                                                                                        A. x^4<br />
                                                                                                                        B. -3x^4<br />
                                                                                                                        C. 10x^2 - 8<br />
                                                                                                                        <b>D. 4x^2 + x - 8</b><br />
                                                                                                                        E. 5x^2 - 8<br />
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                            <div class="block-header block-header-default" role="tab" id="faq_q2_qt1_idactivity_aria-label">
                                                                                                                <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q2" href="#faq_q2_qt1_idactivity" aria-expanded="true" aria-controls="faq_q2_qt1_idactivity">Identification Activity</a>
                                                                                                            </div>
                                                                                                            <div id="faq_q2_qt1_idactivity" class="collapse" role="tabpanel" aria-labelledby="faq_q2_qt1_idactivity_aria-label" data-bs-parent="#faq_q2">
                                                                                                                <div class="block-content">
                                                                                                                    <p><b>Identification Activity 1</b></p>
                                                                                                                    <p>Which of the following questions test Simplify/Evaluate/Find Equivalent Expressions?</p>
                                                                                    
                                                                                                                    <p>Question 1</p>
                                                                                                                    <p>Question 2</p>
                                                                                
                                                                                                                    <p>1. 3x + 4x^2 - 2x - 8 = ?</p>
                                                                                
                                                                                                                    <p>2. Graph 3x - 2y = 7</p>
                                                                                
                                                                                                                    <p>Key: </p>
                                                                                                                    <p>#1: Yes, this question implies that it wants you to simplify the problem and combine like terms.</p>
                                                                                                                    <p>#2: No, this question is asking you to match the equation of a line to its graph.</p>
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
                            
                                                                        <tr class="odd">
                                                                            <td style="">
                                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q2ct1" class="btn btn-danger fs-xs fw-semibold me-1 bg-danger text-white"><i class="fa fa-lg fa-circle-xmark me-1"></i>Expressions & Equations</button>
                                            
                                                                                <div class="modal" id="modal-block-large-q2ct1" tabindex="-1" aria-labelledby="modal-block-large-q2ct1" style="display: none;" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="block block-rounded">
                                                                                                <div class="block-header block-header-default">
                                                                                                    <h3 class="block-title">Category: Expressions & Equations</h3>
                                                                                                </div>
                                                                                                <div class="block-content">
                                                                                                <div id="q2ct1" class="mb-5" role="tablist" aria-multiselectable="true">
                                                                                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                        <div class="block-header block-header-default" role="tab" id="q2ct1_description">
                                                                                                            <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#q2ct1" href="#q2ct1_description" aria-expanded="true" aria-controls="q2ct1_description">Description</a>
                                                                                                        </div>
                                                                                                        <div id="q2ct1_description" class="collapse show" role="tabpanel" aria-labelledby="q2ct1_description" data-bs-parent="#q2ct1">
                                                                                                            <div class="block-content">
                                                                                                                <p>Questions in the Category Type "Expressions & Equations" test how to solve, simplify, rearrange, and work with expressions and equations.</p>
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
                                                                
                                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q2qt2" class="btn btn-danger fs-xs fw-semibold me-1 bg-danger text-white"><i class="fa fa-lg fa-circle-xmark me-1"></i>Combine Like Terms</button>

                                                                                <div class="modal" id="modal-block-large-q2qt2" tabindex="-1" aria-labelledby="modal-block-large-q2qt2" style="display: none;" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="block block-rounded">
                                                                                                <div class="block-header block-header-default">
                                                                                                    <h3 class="block-title">Simplify/Evaluate/Find Equivalent Expressions</h3>
                                                                                                </div>
                                                                                                <div class="block-content">
                                                                                                    <div id="faq_q2" class="mb-5" role="tablist" aria-multiselectable="true">
                                                                                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                            <div class="block-header block-header-default" role="tab" id="faq_q2_qt1_description_aria-label">
                                                                                                                <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q2" href="#faq_q2_qt1_description" aria-expanded="true" aria-controls="faq_q2_qt1_description">Description</a>
                                                                                                            </div>
                                                                                                            <div id="faq_q2_qt1_description" class="collapse show" role="tabpanel" aria-labelledby="faq_q2_qt1_description_aria-label" data-bs-parent="#faq_q2">
                                                                                                                <div class="block-content">
                                                                                                                    <p>
                                                                                                                    This question type covers a broad range of questions with one simple idea - use different types of combining like terms, simplifying, or substitution to match the expression/equation in the original problem to one in the answer choices.
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                            <div class="block-header block-header-default" role="tab" id="faq_q2_qt1_lesson_aria-label">
                                                                                                                <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q2" href="#faq_q2_qt1_lesson" aria-expanded="true" aria-controls="faq_q2_qt1_lesson">Lesson</a>
                                                                                                            </div>
                                                                                                            <div id="faq_q2_qt1_lesson" class="collapse" role="tabpanel" aria-labelledby="faq_q2_qt1_lesson_aria-label" data-bs-parent="#faq_q2">
                                                                                                                <div class="block-content">
                                                                                                                To simplify, evaluate, or find an equivalent expression, determine which types of simplifying need to occur in the problem.
                                                                                                                    <br/>
                                                                                                                        <br/>
                                                                                    
                                                                                                                    Types of Simplifying
                                                                                                                    <br/>
                                                                                                                        <br/>
                                                                                                                    1. Combine Like Terms
                                                                                                                    <br/>
                                                                                                                    2. Substitution
                                                                                                                    <br/>
                                                                                                                    3. Distribution
                                                                                                                    <br/>
                                                                                                                    4. Factoring
                                                                                                                    <br />
                                                                                                                    <br />
                                                                                    
                                                                                                                    When any of the above types of simplifying occur in the question, that specific question type will be attached to the question and you can click the button to see the lesson for Combining Like Terms, Substitution, Distribution, or Factoring.
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                            <div class="block-header block-header-default" role="tab" id="faq_q2_qt1_strategies_aria-label">
                                                                                                                <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q2" href="#faq_q2_qt1_strategies" aria-expanded="true" aria-controls="faq_q2_qt1_strategies">Strategies</a>
                                                                                                            </div>
                                                                                                            <div id="faq_q2_qt1_strategies" class="collapse" role="tabpanel" aria-labelledby="faq_q2_qt1_strategies_aria-label" data-bs-parent="#faq_q2">
                                                                                                                <div class="block-content">
                                                                                                                    <p><b>Strategy 1: Identify which type of simplifying to perform and know the rules </b></p>
                                                                                                                    <p>Identify which type of simplifying that the question is calling for and make sure you know the rules for each type.</p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                            <div class="block-header block-header-default" role="tab" id="faq_q2_qt1_idmethods_aria-label">
                                                                                                                <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q2" href="#faq_q2_qt1_idmethods" aria-expanded="true" aria-controls="faq_q2_qt1_idmethods">Identification Methods</a>
                                                                                                            </div>
                                                                                                            <div id="faq_q2_qt1_idmethods" class="collapse" role="tabpanel" aria-labelledby="faq_q2_qt1_idmethods_aria-label" data-bs-parent="#faq_q2">
                                                                                                                <div class="block-content">
                                                                                                                    <p><b>Identification Method 1</b></p>
                                                                                                                        <p>The question asks you to "find equivalent expressions".</p>
                                                                                                                        <p><b>Example 1</b></p>
                                                                                                                        <p>Question: Find equivalent expression for (x^2 - 3)/x</p>
                                                                                                                        <b>A. x - (3/x)</b><br />
                                                                                                                        B. x^2 - (3/x)<br />
                                                                                                                        C. x - 3<br />
                                                                                                                        D. x^2 - 3x<br />
                                                                                                                        E. -2x<br />
                                                                                                                    <br />
                                                                                    
                                                                                                                    <b>Identification Method 2</b></p>
                                                                                                                        <p>The question implies or asks you to "simplify", "solve", or "combine like terms".</p>
                                                                                                                        <p><b>Example 1</b></p>
                                                                                                                        <p>Question: Simplify 3x + 4x^2 - 2x - 8</p>
                                                                                                                        A. x^4<br />
                                                                                                                        B. -3x^4<br />
                                                                                                                        C. 10x^2 - 8<br />
                                                                                                                        <b>D. 4x^2 + x - 8</b><br />
                                                                                                                        E. 5x^2 - 8<br />
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                            <div class="block-header block-header-default" role="tab" id="faq_q2_qt1_idactivity_aria-label">
                                                                                                                <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q2" href="#faq_q2_qt1_idactivity" aria-expanded="true" aria-controls="faq_q2_qt1_idactivity">Identification Activity</a>
                                                                                                            </div>
                                                                                                            <div id="faq_q2_qt1_idactivity" class="collapse" role="tabpanel" aria-labelledby="faq_q2_qt1_idactivity_aria-label" data-bs-parent="#faq_q2">
                                                                                                                <div class="block-content">
                                                                                                                    <p><b>Identification Activity 1</b></p>
                                                                                                                    <p>Which of the following questions test Simplify/Evaluate/Find Equivalent Expressions?</p>
                                                                                    
                                                                                                                    <p>Question 1</p>
                                                                                                                    <p>Question 2</p>
                                                                                
                                                                                                                    <p>1. 3x + 4x^2 - 2x - 8 = ?</p>
                                                                                
                                                                                                                    <p>2. Graph 3x - 2y = 7</p>
                                                                                
                                                                                                                    <p>Key: </p>
                                                                                                                    <p>#1: Yes, this question implies that it wants you to simplify the problem and combine like terms.</p>
                                                                                                                    <p>#2: No, this question is asking you to match the equation of a line to its graph.</p>
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

                                                {{-- accordion tab 3 --}}
                                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                    <div class="block-header block-header-tab justify-content-start" type="button" data-toggle="collapse" data-target="#collapseThree"
                                                        aria-expanded="false" aria-controls="collapseThree">
                                                        <table>
                                                            <tr>
                                                                <td class="text-center">
                                                                    <i class="fa fa-angle-right text-white me-2 accordian-icon"></i>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-danger fs-xs fw-semibold me-1" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Category Type">3</button>
                                                                    <button type="button" class="btn btn-danger fs-xs fw-semibold me-1" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Category Type"><i class="fa fa-lg fa-circle-xmark me-1" style="color:white"></i> A</button>
                                                                    <button type="button" class="btn btn-success fs-xs fw-semibold me-1" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Category Type"><i class="fa fa-lg fa-circle-check me-1" style="color:white"></i> B</button>
                                                                    <i class="fa fa-fw fa-flag me-1" style="color:rgb(255, 255, 255)" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Flagged Question"></i>
                                                                    <i class="fa fa-fw fa-circle-question me-1" style="color:rgb(255, 255, 255)" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="Guessed On Question"></i>
                                                                    <i style="color:rgb(255, 255, 255)" class="fa fa-fw fa-forward me-1" data-bs-trigger="click" data-bs-placement="top" title="Skipped Question"></i>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-parent=".accordionExample">
                                                        <div class="odd">
                                                            <div class="fw-semibold fs-sm p-4">
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q3r" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info text-white"><i class="fa fa-lg fa-pencil me-1"></i>REVIEW</button>

                                                                <div class="modal" id="modal-block-large-q3r" tabindex="-1" aria-labelledby="modal-block-large-q3r" style="display: none;" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="block block-rounded">
                                                                                <div class="block-header block-header-default">
                                                                                    <h3 class="block-title">Question 3 Review</h3>
                                                                                </div>
                                                                                <div class="block-content">
                                                                                    <div class="row items-push">
                                                                                        <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                            <div class="block-header block-header-default">
                                                                                                <h3 class="block-title">Question 3</h3>
                                                                                                <div class="block-options">
                                                                                                    <button type="button" class="btn-block-option" data-toggle="block-option"
                                                                                                    data-action="content_toggle"></button>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="block-content">
                                                                                                <p>
                                                                                                    <b>Please refer to the PDF, book, or downloaded file for this question. Test 1576C
                                                                                                    / Z04 can be found here: <a
                                                                                                        href="https://www.act.org/content/dam/act/unsecured/documents/Preparing-for-the-ACT.pdf"><u>Test
                                                                                                        Link</u></a>
                                                                                                    </b>
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="block block-rounded">
                                                                                            <ul class="nav nav-tabs nav-tabs-alt" role="tablist">
                                                                                                <li class="nav-item">
                                                                                                    <button class="nav-link active bg-danger text-white" id="btabs-alt-static-home-tab"
                                                                                                    data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q3a" role="tab"
                                                                                                    aria-controls="btabs-alt-static-home" aria-selected="true">Answer A</button>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <button class="nav-link bg-success text-gray" id="btabs-alt-static-profile-tab"
                                                                                                    data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q3b" role="tab"
                                                                                                    aria-controls="btabs-alt-static-profile" aria-selected="false">Answer B</button>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <button class="nav-link bg-city-dark text-gray" id="btabs-alt-static-profile-tab"
                                                                                                    data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q3c" role="tab"
                                                                                                    aria-controls="btabs-alt-static-profile" aria-selected="false">Answer C</button>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <button class="nav-link bg-city-dark text-gray" id="btabs-alt-static-profile-tab"
                                                                                                    data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q3d" role="tab"
                                                                                                    aria-controls="btabs-alt-static-profile" aria-selected="false">Answer D</button>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <button class="nav-link bg-danger text-gray" id="btabs-alt-static-home-tab"
                                                                                                    data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q3e" role="tab"
                                                                                                    aria-controls="btabs-alt-static-home" aria-selected="true">Answer E</button>
                                                                                                </li>
                                                                                            </ul>
                                                                                            <div class="block-content tab-content">
                                                                                                <div class="tab-pane active" id="btabs-alt-static-q3a" role="tabpanel"
                                                                                                    aria-labelledby="btabs-alt-static-home-tab">
                                                                                                    <p>NO CHANGE: 12</p>
                                                                                                    <p><b>Explanation: </b>Incorrect order of operations. Use PEMDAS. See Order of
                                                                                                    Operations lesson in the Question Type column.</p>

                                                                                                </div>
                                                                                                <div class="tab-pane" id="btabs-alt-static-q3b" role="tabpanel"
                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                    <p>16</p>
                                                                                                    <p><b>Explanation: </b>Correct order of operations. Use PEMDAS. </p>
                                                                                                </div>
                                                                                                <div class="tab-pane" id="btabs-alt-static-q3c" role="tabpanel"
                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                    <p>26</p>
                                                                                                    <p><b>Explanation: </b>Incorrect order of operations. Use PEMDAS. See Order of
                                                                                                    Operations lesson in the Question Type column.</p>
                                                                                                </div>
                                                                                                <div class="tab-pane" id="btabs-alt-static-q3d" role="tabpanel"
                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                    <p>34</p>
                                                                                                    <p><b>Explanation: </b>Incorrect order of operations. Use PEMDAS. See Order of
                                                                                                    Operations lesson in the Question Type column.</p>
                                                                                                </div>
                                                                                                <div class="tab-pane" id="btabs-alt-static-q3e" role="tabpanel"
                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                    <p>104</p>
                                                                                                    <p><b>Explanation: </b>Incorrect order of operations. Use PEMDAS. See Order of
                                                                                                    Operations lesson in the Question Type column.</p>
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
                                                                            <th style="width: 30%;" class="sorting" tabindex="0" aria-controls="DataTables_Table_4"
                                                                            rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Category</th>
                                                                            <th style="width: 70%;" class="sorting" tabindex="0" aria-controls="DataTables_Table_4"
                                                                            rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Question Type
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class="odd">
                                                                            <td style="">
                                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q3ct1" class="btn btn-danger fs-xs fw-semibold me-1 bg-danger text-white"><i class="fa fa-lg fa-circle-xmark me-1"></i>Arithmetic</button>

                                                                                <div class="modal" id="modal-block-large-q3ct1" tabindex="-1" aria-labelledby="modal-block-large-q3ct1" style="display: none;" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="block block-rounded">
                                                                                                <div class="block-header block-header-default">
                                                                                                    <h3 class="block-title">Arithmetic</h3>
                                                                                                </div>
                                                                                                <div class="block-content">
                                                                                                    <div id="q3ct1" class="mb-5" role="tablist" aria-multiselectable="true">
                                                                                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                            <div class="block-header block-header-default" role="tab"
                                                                                                            id="q3ct1_description">
                                                                                                                <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#q3ct1"
                                                                                                                href="#q3ct1_description-arithmetic" aria-expanded="true"
                                                                                                                aria-controls="q3ct1_description">Description</a>
                                                                                                            </div>
                                                                                                            <div id="q3ct1_description-arithmetic" class="collapse show" role="tabpanel"
                                                                                                            aria-labelledby="q3ct1_description" data-bs-parent="#q3ct1">
                                                                                                                <div class="block-content">
                                                                                                                    <p>Questions in the Category Type "Arithmetic" test how to add, subtract,
                                                                                                                    multiply, divide, use exponents, use parentheses, and perform order of
                                                                                                                    operations.</p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="block-content block-content-full text-end bg-body">
                                                                                                        <button type="button" class="btn btn-sm block-header-default  text-white  "
                                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td style="">

                                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q3qt1"
                                                                                    class="btn btn-danger fs-xs fw-semibold me-1 bg-danger text-white"><i
                                                                                    class="fa fa-lg fa-circle-xmark me-1"></i>Order of Operations</button>

                                                                                <div class="modal" id="modal-block-large-q3qt1" tabindex="-1" aria-labelledby="modal-block-large-q3qt1" style="display: none;" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="block block-rounded">
                                                                                                <div class="block-header block-header-default">
                                                                                                    <h3 class="block-title">Order of Operations</h3>
                                                                                                </div>
                                                                                                <div class="block-content">
                                                                                                    <div id="faq_q3" class="mb-5" role="tablist" aria-multiselectable="true">
                                                                                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                            <div class="block-header block-header-default" role="tab"
                                                                                                            id="faq_q3_qt1_description_aria-label">
                                                                                                                <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q3"
                                                                                                                href="#faq_q3_qt1_description" aria-expanded="true"
                                                                                                                aria-controls="faq_q3_qt1_description_aria-label">Description</a>
                                                                                                            </div>
                                                                                                            <div id="faq_q3_qt1_description" class="collapse show" role="tabpanel"
                                                                                                            aria-labelledby="faq_q3_qt1_description_aria-label" data-bs-parent="#faq_q3">
                                                                                                                <div class="block-content">
                                                                                                                    <p>
                                                                                                                    This question type covers arithmetic operations, which are types of
                                                                                                                    arithmetic including addition, subtraction, multiplication, division,
                                                                                                                    using exponents, and distributing values into parentheses.
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                            <div class="block-header block-header-default" role="tab"
                                                                                                            id="faq_q3_qt1_lesson_aria-label">
                                                                                                                <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q3_LESSON"
                                                                                                                href="#faq_q3_qt1_lesson" aria-expanded="true"
                                                                                                                aria-controls="faq_q3_qt1_lesson_aria-label">Lesson</a>
                                                                                                            </div>
                                                                                                            <div id="faq_q3_qt1_lesson" class="collapse" role="tabpanel"
                                                                                                            aria-labelledby="faq_q3_qt1_lesson_aria-label" data-bs-parent="#faq_q3_LESSON">
                                                                                                                <div class="block-content">
                                                                                                                    <img style="width: 550px;" src="assets/cpsmedia/orderofoperations.jpg"
                                                                                                                    alt="">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                            <div class="block-header block-header-default" role="tab"
                                                                                                            id="faq_q3_qt1_strategies_aria-label">
                                                                                                                <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q3"
                                                                                                                href="#faq_q3_qt1_strategies" aria-expanded="true"
                                                                                                                aria-controls="faq_q3_qt1_strategies_aria-label">Strategies</a>
                                                                                                            </div>
                                                                                                            <div id="faq_q3_qt1_strategies" class="collapse" role="tabpanel"
                                                                                                            aria-labelledby="faq_q3_qt1_strategies_aria-label" data-bs-parent="#faq_q3">
                                                                                                                <div class="block-content">
                                                                                                                    <p><b>Strategy 1: Identify which type of simplifying to perform and know the
                                                                                                                        rules </b></p>
                                                                                                                    <p>Identify which type of simplifying that the question is calling for and
                                                                                                                    make sure you know the rules for each type.</p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                            <div class="block-header block-header-default" role="tab"
                                                                                                            id="faq_q3_qt1_idmethods_aria-label">
                                                                                                                <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q3"
                                                                                                                href="#faq_q3_qt1_idmethods" aria-expanded="true"
                                                                                                                aria-controls="faq_q3_qt1_idmethods_aria-label">Identification Methods</a>
                                                                                                            </div>
                                                                                                            <div id="faq_q3_qt1_idmethods" class="collapse" role="tabpanel"
                                                                                                            aria-labelledby="faq_q3_qt1_idmethods_aria-label" data-bs-parent="#faq_q3">
                                                                                                                <div class="block-content">
                                                                                                                    <p><b>Identification Method 1</b></p>
                                                                                                                    <p>The question asks you to "find equivalent expressions".</p>
                                                                                                                    <p><b>Example 1</b></p>
                                                                                                                    <p>Question: Find equivalent expression for (x^2 - 3)/x</p>
                                                                                                                    <b>A. x - (3/x)</b><br />
                                                                                                                    B. x^2 - (3/x)<br />
                                                                                                                    C. x - 3<br />
                                                                                                                    D. x^2 - 3x<br />
                                                                                                                    E. -2x<br />
                                                                                                                    <br />

                                                                                                                    <b>Identification Method 2</b></p>
                                                                                                                    <p>The question implies or asks you to "simplify", "solve", or "combine like
                                                                                                                    terms".</p>
                                                                                                                    <p><b>Example 1</b></p>
                                                                                                                    <p>Question: Simplify 3x + 4x^2 - 2x - 8</p>
                                                                                                                    A. x^4<br />
                                                                                                                    B. -3x^4<br />
                                                                                                                    C. 10x^2 - 8<br />
                                                                                                                    <b>D. 4x^2 + x - 8</b><br />
                                                                                                                    E. 5x^2 - 8<br />
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                                            <div class="block-header block-header-default" role="tab"
                                                                                                            id="faq_q3_qt1_idactivity_aria-label">
                                                                                                                <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq_q3"
                                                                                                                href="#faq_q3_qt1_idactivity" aria-expanded="true"
                                                                                                                aria-controls="faq_q3_qt1_idactivity_aria-label">Identification Activity</a>
                                                                                                            </div>
                                                                                                            <div id="faq_q3_qt1_idactivity" class="collapse" role="tabpanel"
                                                                                                            aria-labelledby="faq_q3_qt1_idactivity_aria-label" data-bs-parent="#faq_q3">
                                                                                                                <div class="block-content">
                                                                                                                    <p><b>Identification Activity 1</b></p>
                                                                                                                    <p>Which of the following questions test Simplify/Evaluate/Find Equivalent
                                                                                                                    Expressions?</p>

                                                                                                                    <p>Question 1</p>
                                                                                                                    <p>Question 2</p>

                                                                                                                    <p>1. 3x + 4x^2 - 2x - 8 = ?</p>

                                                                                                                    <p>2. Graph 3x - 2y = 7</p>

                                                                                                                    <p>Key: </p>
                                                                                                                    <p>#1: Yes, this question implies that it wants you to simplify the problem
                                                                                                                    and combine like terms.</p>
                                                                                                                    <p>#2: No, this question is asking you to match the equation of a line to
                                                                                                                    its graph.</p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="block-content block-content-full text-end bg-body">
                                                                                                    <button type="button" class="btn btn-sm block-header-default  text-white  "
                                                                                                    data-bs-dismiss="modal">Close</button>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Category & Question Type Summary tab --}}
                        <div class="tab-pane fade" id="btabs-animated-fade-profile" role="tabpanel" aria-labelledby="btabs-animated-fade-profile-tab" tabindex="0">
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">(BEST SO FAR..) QUESTION TYPE CATEGORIZATION</h3>
                                </div>
                                <div class="block-content">
                                    <div class="block-content p-0">       
                    
                                        <div class="tab-content" id="myTabContent">
                                            <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                                                <div class="accordion accordionExample">
                    
                                                    {{-- accordian tab 1 --}}
                                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                        <div class="block-header block-header-tab justify-content-start" type="button" data-toggle="collapse" data-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                            <table>
                                                                <tr >
                                                                    <td class="text-center">
                                                                        <i class="fa fa-angle-right text-white me-2 accordian-icon"></i>
                                                                    </td>
                                                                    <td class="pl-4">
                                                                        <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="" data-bs-original-title="Category Type">CT</button>
                                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-ct1" class="btn btn-dark fs-xs fw-semibold me-1">Arithmetic</button>
            
                                                                        <!-- MODAL -->
                                                                        <div class="modal" id="modal-block-large-ct1" tabindex="-1" aria-labelledby="modal-block-large-ct1" style="display: none;" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="block block-rounded">
                                                                                        <div class="block-header block-header-default">
                                                                                            <h3 class="block-title">Arithmetic </h3>
                                                                                        </div>
                                                                                        <div class="block-content">
                                                                                            <p class="fs-sm mb-0">
                                                                                            </p>
                                                                                    
                                                                                            <div class="row items-push">
                                                                                                <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                                    <div class="block-header block-header-default">
                                                                                                        <h3 class="block-title">Description</h3>
                                                                                                        <div class="block-options">
                                                                                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="block-content">
                                                                                                        <p>other words</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                    
                                                                                        <div class="block-content block-content-full text-end bg-body">
                                                                                            <button type="button" class="btn btn-sm block-header-default text-white" data-bs-dismiss="modal">Close</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                         <!-- END MODAL -->
            
                                                                        <div class="text-white text-start mt-2 incorrect">
                                                                            2 Incorrect
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".accordionExample">
                                                            <div class="odd">    
                                                                <div class="fw-semibold fs-sm">
                                                                   <div>
                                                                        <div>
                                                                            <div class="odd p-3 ps-4">
                                                                                <div></div>
                                                        
                                                                                <div class="fw-semibold fs-sm">
                                                                                    <button type="button" class="btn btn-warning fs-xs fw-semibold me-1 mb-3 js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="" data-bs-original-title="Question Type">QT</button>
                                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1ct1" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Arithmetic Operations</button>
                                                            
                                                                                    <!-- MODAL -->
                                                                                    <div class="modal" id="modal-block-large-cg1ct1" tabindex="-1" aria-labelledby="modal-block-large-cg1ct1" style="display: none;" aria-hidden="true">
                                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                                            <div class="modal-content">
                                                                                                <div class="block block-rounded">
                                                                                                    <div class="block-header block-header-default">
                                                                                                        <h3 class="block-title">Arithmetic Operations</h3>
                                                                                                    </div>
                                                                                                    <div class="block-content">
                                                                                                        <p class="fs-sm mb-0"></p>
                                                                                            
                                                                                                        <div class="row items-push">
                                                                                                            <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                                                <div class="block-header block-header-default">
                                                                                                                    <h3 class="block-title">Description</h3>
                                                                                                                    <div class="block-options">
                                                                                                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="block-content">
                                                                                                                    <p>words</p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                    
                                                                                                    <div class="block-content block-content-full text-end bg-body">
                                                                                                        <button type="button" class="btn btn-sm block-header-default text-white" data-bs-dismiss="modal">Close</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- END MODAL -->
                                                                                    
                                                                                    <div class="text-danger">
                                                                                        1 Incorrect
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="border-top-tr p-3 ps-4">
                                                                                <div></div>
                                                                                <div class="fw-semibold fs-sm">
                                                                                    <button type="button" class="btn btn-warning fs-xs fw-semibold me-1 mb-3 js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="" data-bs-original-title="Question Type">QT</button>
                                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1ct1qt2" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Order of Operations</button>
                                                    
                                                                                    <!-- MODAL -->
                                                                                    <div class="modal" id="modal-block-large-cg1ct1qt2" tabindex="-1" aria-labelledby="modal-block-large-cg1ct1qt2" style="display: none;" aria-hidden="true">
                                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                                            <div class="modal-content">
                                                                                                <div class="block block-rounded">
                                                                                                    <div class="block-header block-header-default">
                                                                                                        <h3 class="block-title">Order of Operations</h3>
                                                                                                    </div>
                                                                                                    <div class="block-content">
                                                                                                        <p class="fs-sm mb-0"></p>
                                                                                            
                                                                                                        <div class="row items-push">
                                                                                                            <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                                                <div class="block-header block-header-default">
                                                                                                                    <h3 class="block-title">Description</h3>
                                                                                                                    <div class="block-options">
                                                                                                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="block-content">
                                                                                                                    <p>words dddd</p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                    
                                                                                                    <div class="block-content block-content-full text-end bg-body">
                                                                                                        <button type="button" class="btn btn-sm block-header-default text-white" data-bs-dismiss="modal">Close</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- END MODAL -->
                                                                                    <div class="text-danger">
                                                                                    1 Incorrect
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                   </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- END accordian tab 1 --}}
            
                                                    {{-- accordian tab 2 --}}
                                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                        <div class="block-header block-header-tab justify-content-start" type="button" data-toggle="collapse" data-target="#collapseTwo"
                                                            aria-expanded="false" aria-controls="collapseTwo">
                                                            <table>
                                                                <tr >
                                                                    <td class="text-center">
                                                                        <i class="fa fa-angle-right text-white me-2 accordian-icon"></i>
                                                                    </td>
                                                                    <td class="pl-4">
                                                                        <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="" data-bs-original-title="Category Type">CT</button>
                                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-ct1" class="btn btn-dark fs-xs fw-semibold me-1">Fractions</button>
            
                                                                        <!-- MODAL -->
                                                                        <div class="modal" id="modal-block-large-ct1" tabindex="-1" aria-labelledby="modal-block-large-ct1" style="display: none;" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="block block-rounded">
                                                                                        <div class="block-header block-header-default">
                                                                                            <h3 class="block-title">FRACTIONS </h3>
                                                                                        </div>
                                                                                        <div class="block-content">
                                                                                            <p class="fs-sm mb-0">
                                                                                            </p>
                                                                                    
                                                                                            <div class="row items-push">
                                                                                                <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                                    <div class="block-header block-header-default">
                                                                                                        <h3 class="block-title">Description</h3>
                                                                                                        <div class="block-options">
                                                                                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="block-content">
                                                                                                        <p>frac words</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                    
                                                                                        <div class="block-content block-content-full text-end bg-body">
                                                                                            <button type="button" class="btn btn-sm block-header-default text-white" data-bs-dismiss="modal">Close</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                         <!-- END MODAL -->
            
                                                                        <div class="text-white text-start mt-2 incorrect">
                                                                            4 Incorrect
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent=".accordionExample">
                                                            <div class="odd">    
                                                                <div class="fw-semibold fs-sm">
                                                                   <div>
                                                                        <div>
                                                                            <div class="odd p-3 ps-4">
                                                                                <div></div>
                                                        
                                                                                <div class="fw-semibold fs-sm">
                                                                                    <button type="button" class="btn btn-warning fs-xs fw-semibold me-1 mb-3 js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="" data-bs-original-title="Question Type">QT</button>
                                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1ct2qt1" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Converting Between Fractions, Decimals, and Percents</button>
                                                            
                                                                                    <!-- MODAL -->
                                                                                    <div class="modal" id="modal-block-large-cg1ct2qt1" tabindex="-1" aria-labelledby="modal-block-large-cg1ct2qt1" style="display: none;" aria-hidden="true">
                                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                                            <div class="modal-content">
                                                                                                <div class="block block-rounded">
                                                                                                    <div class="block-header block-header-default">
                                                                                                        <h3 class="block-title">Converting Between Fractions, Decimals, and Percents</h3>
                                                                                                    </div>
                                                                                                    <div class="block-content">
                                                                                                        <p class="fs-sm mb-0"></p>
                                                                                            
                                                                                                        <div class="row items-push">
                                                                                                            <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                                                <div class="block-header block-header-default">
                                                                                                                    <h3 class="block-title">Description</h3>
                                                                                                                    <div class="block-options">
                                                                                                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="block-content">
                                                                                                                    <p>conv frac words</p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                    
                                                                                                    <div class="block-content block-content-full text-end bg-body">
                                                                                                        <button type="button" class="btn btn-sm block-header-default text-white" data-bs-dismiss="modal">Close</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- END MODAL -->
                                                                                    
                                                                                    <div class="text-danger">
                                                                                        3 Incorrect
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="border-top-tr p-3 ps-4">
                                                                                <div></div>
                                                                                <div class="fw-semibold fs-sm">
                                                                                    <button type="button" class="btn btn-warning fs-xs fw-semibold me-1 mb-3 js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top" title="" data-bs-original-title="Question Type">QT</button>
                                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1ct2qt2" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Find New Value</button>
                                                    
                                                                                    <!-- MODAL -->
                                                                                    <div class="modal" id="modal-block-large-cg1ct2qt2" tabindex="-1" aria-labelledby="modal-block-large-cg1ct2qt2" style="display: none;" aria-hidden="true">
                                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                                            <div class="modal-content">
                                                                                                <div class="block block-rounded">
                                                                                                    <div class="block-header block-header-default">
                                                                                                        <h3 class="block-title">ORDER OF OPERATIONS</h3>
                                                                                                    </div>
                                                                                                    <div class="block-content">
                                                                                                        <p class="fs-sm mb-0"></p>
                                                                                            
                                                                                                        <div class="row items-push">
                                                                                                            <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                                                <div class="block-header block-header-default">
                                                                                                                    <h3 class="block-title">Description</h3>
                                                                                                                    <div class="block-options">
                                                                                                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="block-content">
                                                                                                                    <p>new words dddd</p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                    
                                                                                                    <div class="block-content block-content-full text-end bg-body">
                                                                                                        <button type="button" class="btn btn-sm block-header-default text-white" data-bs-dismiss="modal">Close</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- END MODAL -->
                                                                                    <div class="text-danger">
                                                                                    1 Incorrect
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                   </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- END accordian tab 2 --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Answer Type Summary tab --}}
                        <div class="tab-pane fade" id="btabs-animated-fade-answer" role="tabpanel" aria-labelledby="btabs-animated-fade-answer-tab" tabindex="0">
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">INCORRECT ANSWER TYPE SUMMARY</h3>
                                </div>
                                <div class="block-content">
                                    <div class="block-content p-0">       
                                        <table class="js-table-sections table table-hover table-vcenter js-table-sections-enabled">
                                            <thead>
                                              <tr>
                                                <th style="width: 30px;"></th>
                                                <th style="width: 20%;">Type</th>
                                                <th>Name</th>
                                                <th style="width: 20%;">FREQUENCY OF INCORRECT ANSWER TYPES</th>
                                              </tr>
                                            </thead>
                                            
                                            <tbody class="fs-sm">
                            
                                                <!-- Answer Type 1 -->
                                                <tr>
                                                    <td class="text-center"></td>
                                                    <td>
                                                        <button type="button" class="btn block-header-default text-white fs-xs fw-semibold me-1 mb-3">Answer Type</button>
                                                    </td>
                                                    <td class="fw-semibold fs-sm">                
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-ag1" class="btn block-header-default text-white fs-xs fw-semibold me-1 mb-3">Doesn't Meet Keyword Goal</button>
                                    
                                                        <div class="modal" id="modal-block-large-ag1" tabindex="-1" aria-labelledby="modal-block-large-ag1" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="block block-rounded">
                                                                        <div class="block-header block-header-default">
                                                                            <h3 class="block-title">Answer Type: Doesn't Meet Keyword Goal</h3>
                                                                        </div>
                                                                    <div class="block-content">
                                                                        <div id="faq2" class="mb-5" role="tablist" aria-multiselectable="true">
                                                                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                <div class="block-header block-header-default" role="tab" id="faq2_h1">
                                                                                    <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q1" aria-expanded="true" aria-controls="faq2_q1">Description</a>
                                                                                </div>
                                                                                <div id="faq2_q1" class="collapse show" role="tabpanel" aria-labelledby="faq2_h1" data-bs-parent="#faq2">
                                                                                    <div class="block-content">
                                                                                        <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                                                                        <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="block-content block-content-full text-end bg-body">
                                                                            <button type="button" class="btn btn-sm block-header-default text-white text-white" data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                            
                                                    <td class="fw-semibold fs-sm">
                                                        <div class="py-1">
                                                            <p>1</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- END Answer Type 1 -->
                            
                                                <!-- Answer Type 2 -->
                                                <tr>
                                                    <td class="text-center"></td>
                                                    <td>
                                                        <button type="button" class="btn block-header-default text-white fs-xs fw-semibold me-1 mb-3">Answer Type</button>
                                                    </td>
                                                    <td class="fw-semibold fs-sm">                    
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-ag2" class="btn block-header-default text-white fs-xs fw-semibold me-1 mb-3">Vocabulary Definition Doesn't Match Context</button>
                                
                                                        <div class="modal" id="modal-block-large-ag2" tabindex="-1" aria-labelledby="modal-block-large-ag2" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="block block-rounded">
                                                                        <div class="block-header block-header-default">
                                                                            <h3 class="block-title">Answer Type: Vocabulary Definition Doesn't Match Context</h3>
                                                                        </div>
                                                                        <div class="block-content">
                                                                            <div id="faq2" class="mb-5" role="tablist" aria-multiselectable="true">
                                                                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                    <div class="block-header block-header-default" role="tab" id="faq2_h1">
                                                                                        <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q1" aria-expanded="true" aria-controls="faq2_q1">Description</a>
                                                                                    </div>
                                                                                    <div id="faq2_q1" class="collapse show" role="tabpanel" aria-labelledby="faq2_h1" data-bs-parent="#faq2">
                                                                                        <div class="block-content">
                                                                                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                                                                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="block-content block-content-full text-end bg-body">
                                                                                <button type="button" class="btn btn-sm block-header-default text-white text-white" data-bs-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="fw-semibold fs-sm">
                                                        <div class="py-1">
                                                            <p>2</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- Answer Type 2 -->
                            
                                                <!-- Answer Type 3 -->
                                                <tr>
                                                    <td class="text-center"></td>
                                                    <td>
                                                        <button type="button" class="btn block-header-default text-white fs-xs fw-semibold me-1 mb-3">Answer Type</button>
                                                    </td>
                                                    <td class="fw-semibold fs-sm">                    
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-at3" class="btn block-header-default text-white fs-xs fw-semibold me-1 mb-3">Incorrectly Used Literal Vocabulary Definition</button>
                                    
                                                        <div class="modal" id="modal-block-large-at3" tabindex="-1" aria-labelledby="modal-block-large-at3" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="block block-rounded">
                                                                        <div class="block-header block-header-default">
                                                                            <h3 class="block-title">Answer Type: Incorrectly Used Literal Vocabulary Definition</h3>
                                                                        </div>
                                                                        <div class="block-content">
                                                                            <div id="at3" class="mb-5" role="tablist" aria-multiselectable="true">
                                                                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                    <div class="block-header block-header-default" role="tab" id="at3_description">
                                                                                        <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#at3" href="#at3_description-answer-type" aria-expanded="true" aria-controls="at3_description">Description</a>
                                                                                    </div>
                                                                                    <div id="at3_description-answer-type" class="collapse show" role="tabpanel" aria-labelledby="at3_description" data-bs-parent="#at3">
                                                                                        <div class="block-content">
                                                                                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                                                                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="block-content block-content-full text-end bg-body">
                                                                                <button type="button" class="btn btn-sm block-header-default text-white text-white" data-bs-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="fw-semibold fs-sm">
                                                        <div class="py-1">
                                                            <p>0</p>
                                                        </div>
                                                    </td>
                                                </tr>
                            
                                              <!-- END ANSWER Type 3 MODAL -->
                                            </tbody>
                                          </table>
                                    </div>
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
<style>
    .tab-padding{
        padding: 20px !important;
    }
    .border-top-tr{
        border-top: 1px solid #ebeef2;
    }
</style>
@endsection

@section('page-script')
<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
<script src="{{ asset('js/test-review.js') }}"></script>
@endsection