@extends('layouts.admin')

@section('title', 'Student View Dashboard : CPS')

@section('page-script')
  <script>
    $(document).ready(function() {
      $("#categoryQuestion1").click(function() {
        $(this).toggleClass("show");
      });
    });

    $('input[type="checkbox"]').click(function(e){
	    e.stopPropagation()
    })
  </script>
@endsection

@section('admin-content')
<!-- Main Container -->
<main id="main-container">
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-2">
            Test Review
          </h1>
          <h2 class="fs-base lh-base fw-medium text-muted mb-0">
            Official ACT 74F - April 2017
          </h2>
        </div>
        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="javascript:void(0)">Official ACT 74F - April 2017 Review Summary</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
              ACT English Review (74F)
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>

  <div class="content">

    <!-- START Table 1 -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">Incorrect Category &amp; Question Type Summary</h3>
      </div>
      <div class="block-content">
        <table class="js-table-sections table table-hover table-vcenter js-table-sections-enabled">
          <thead>
            <tr>
              <th style="width: 30px;"></th>
              <th style="width: 20%;">Type</th>
              <th>Name</th>
              <th class="d-none d-sm-table-cell" style="width: 10%;">Add to Custom Quiz</th>
            </tr>
          </thead>
          <!-- CATEGORY GROUP 1: Sentence Structure & Punctuation -->
          <tbody id="categoryQuestion1" class="js-table-sections-header">
            <!-- BEGIN Question Type 1 -->
            <tr>
              <td class="text-center">
                <i class="fa fa-angle-right"></i>
              </td>
              <td>
                <button type="button" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Category Type</button>
              </td>
              <td class="fw-semibold fs-sm">
                <!-- Modal Button that initiates opening CATEGORY Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1ct1" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Sentence Structure &amp; Punctuation</button>

                <!-- Opens Modal - Has Modal Content - CATEGORY -->

                <div class="modal" id="modal-block-large-cg1ct1" tabindex="-1" aria-labelledby="modal-block-large-cg1ct1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Category: Sentence Structure &amp; Punctuation</h3>
                        </div>
                        <div class="block-content">
                          <p class="fs-sm mb-0">
                          </p>

                          <div class="row items-push">
                            <!-- CATEGORY Description BLOCK -->
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Description</h3>
                                <div class="block-options">
                                  <!--
                                          <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                          -->
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>words</p>
                              </div>
                            </div>
                            <!-- End CATEGORY Description BLOCK -->
                          </div>
                        </div>

                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                      <!-- END Blocks API -->
                    </div>
                  </div>
                </div>
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar bg-dark" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:67%">
                  </div>
                </div>

                <div class="text-center text-danger">
                  2/3 Incorrect
                </div>

                <!-- End Modal - CATEGORY -->
              </td>
              <div class="text-center input-check">
                <div class="form-check d-inline-block ">
                  <!-- ADD TO CUSTOM QUIZ CHECKMARK COLUMN -->
                  <td class="text-center">
                    <div class="form-check d-inline-block">
                      <!-- ADD TO CUSTOM QUIZ CHECKMARK COLUMN -->
                      <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                      <label class="form-check-label" for="row_1"></label>
                    </div>
                  </td>
                  <!-- <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1"> -->
                  <!-- <label class="form-check-label" for="row_1"></label> -->
                </div>
              </div>
            </tr>
          </tbody>
          <!-- END Category Types -->

          <!-- BEGIN Question Types -->
          <tbody class="fs-sm input-main">
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">

                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1qt1" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Vocabulary in Context</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->
                <div class="modal" id="modal-block-large-cg1qt1" tabindex="-1" aria-labelledby="modal-block-large-cg1qt1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Vocabulary in Context</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq1" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq1_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">Description</a>
                              </div>
                              <div id="faq1_q1" class="collapse show" role="tabpanel" aria-labelledby="faq1_h1" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>Choose the word that fits best with the intended meaning of the sentence.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q2" aria-expanded="true" aria-controls="faq1_q2">Lesson</a>
                              </div>
                              <div id="faq1_q2" class="collapse" role="tabpanel" aria-labelledby="faq1_h2" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>It's critical to focus on the context outside of the vocabulary word itself, because context can affect the meaning of any given word. Compare Example 1 and Example 2 below with the word “arm”.</p>

                                  <p>Example 1</p>
                                  <p>The snowboarder landed on her <u>arm</u>, but miraculously, she was uninjured.</p>

                                  <p>Example 2</p>
                                  <p>It's important to <u>arm</u>yourself with a solid education.</p>

                                  <p>The meaning of the word completely changes based on the context.</p>

                                  <p><b>Common Mistakes</b></p>
                                  <p>The most common mistake is to only look at the given words in the answer choices and base your answer solely on their primary definitions. However, it’s necessary to understand the context surrounding the word because the correct answer won’t always be the primary definition. </p>

                                  <p>Another common mistake is to only read the sentence that contains the vocab word. The surrounding context is not only necessary in many cases, but it makes it easier to understand which word is correct. Attempt to get the context of the entire paragraph, or at least one sentence on either side of the sentence that contains the vocabulary word. </p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q3" aria-expanded="true" aria-controls="faq1_q3">Strategies</a>
                              </div>
                              <div id="faq1_q3" class="collapse" role="tabpanel" aria-labelledby="faq1_h3" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Strategy 1: Vocabulary in Context Step by Step Strategy</b></p>
                                  <p>1. Read the entire paragraph and get the paragraph’s main idea.</p>
                                  <p>2. Focus most of your attention on the intended meaning of the given and surrounding sentences.</p>
                                  <p>3. Plug each vocab word in one at a time and read the entire sentence with every answer choice. This strategy could negatively impact ACT English section timing, but it could also improve timing by making it easier to analyze each answer choice. </p>
                                  <p>4. A word that fits the context is better than a word that matches the primary definition (even though a word with the primary definition can be correct).</p>
                                  <p>5. If all of the other answers seem unreasonable and you don’t know the meaning of the remaining word, be “brave” and pick that answer. </p>

                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q4" aria-expanded="true" aria-controls="faq1_q4">Identification Methods</a>
                              </div>
                              <div id="faq1_q4" class="collapse" role="tabpanel" aria-labelledby="faq1_h4" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Identification Method 1</b></p>
                                  <p>The question has an underlined word and answer choices with similar-meaning words.
                                  </p>
                                  <p><b>Example 1</b></p>
                                  <p>Passage Excerpt: As modern planes have improved their safety, higher <u>agility</u> has allowed them to make complex manuvers mid-flight.</p>
                                  <p>A. NO CHANGE</p>
                                  <p>B. activity</p>
                                  <p>C. ingenuity</p>
                                  <p>D. clarity</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q5" aria-expanded="true" aria-controls="faq1_q5">Identification Activity</a>
                              </div>
                              <div id="faq1_q5" class="collapse" role="tabpanel" aria-labelledby="faq1_h5" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Identification Activity 1</b></p>
                                  <p>Which of the following questions test Dangling Modifiers?</p>

                                  <p>Question 1</p>
                                  <p>Question 2</p>

                                  <p>1. Part of his success is attributed to his ability to <u>plead</u> to a wide range of audiences.</p>

                                  <p>A. NO CHANGE</p>
                                  <p>B. appeal</p>
                                  <p>C. attract </p>
                                  <p>D. remark</p>

                                  A. NO CHANGE
                                  B. appeal
                                  C. attract
                                  D. remark

                                  2. The Dahlia flower is famous <u>to</u> its unique pattern of petals.

                                  A. NO CHANGE
                                  B. by
                                  C. for
                                  D. with

                                  Key:
                                  #1: Yes, this example tests Vocabulary in Context.
                                  #2: No, even though this question tests different word choices, it does NOT test Vocabulary in Context. It tests Idioms and Prepositions.
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- END Blocks API -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NEW End Modal - QUESTION TYPE -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:100%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/1 Incorrect
                </div>
              </td>
              <!-- 
                      <td class="fw-semibold fs-sm">
                        <div class="py-1">
                          <p>2/3</p> 
                        </div>
                      </td>
                      -->
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>
            <!-- END Question Type 1 -->

            <!-- BEGIN Question Type 2 -->
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">
                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1qt2" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Keyword Goal</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->

                <div class="modal" id="modal-block-large-cg1qt2" tabindex="-1" aria-labelledby="modal-block-large-cg1qt2" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Keyword Goal</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq2" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq2_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q1" aria-expanded="true" aria-controls="faq2_q1">Description</a>
                              </div>
                              <div id="faq2_q1" class="collapse show" role="tabpanel" aria-labelledby="faq2_h1" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q2" aria-expanded="true" aria-controls="faq2_q2">Lesson</a>
                              </div>
                              <div id="faq2_q2" class="collapse" role="tabpanel" aria-labelledby="faq2_h2" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q3" aria-expanded="true" aria-controls="faq2_q3">Strategies</a>
                              </div>
                              <div id="faq2_q3" class="collapse" role="tabpanel" aria-labelledby="faq2_h3" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Strategy 1: Stuff</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q4" aria-expanded="true" aria-controls="faq2_q4">Identification Methods</a>
                              </div>
                              <div id="faq2_q4" class="collapse" role="tabpanel" aria-labelledby="faq2_h4" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q5" aria-expanded="true" aria-controls="faq2_q5">Identification Activity</a>
                              </div>
                              <div id="faq2_q5" class="collapse" role="tabpanel" aria-labelledby="faq2_h5" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- END Blocks API -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NEW End Modal - QUESTION TYPE -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:50%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/2 Incorrect
                </div>
              </td>
              <!--
                    <td class="fw-semibold fs-sm">
                        <div class="py-1">
                          <p>1/2</p>
                        </div>
                      </td>
                    -->
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>

            <!-- END Question Types -->
          </tbody>
          <!-- END CATEGORY GROUP 1: Sentence Structure & Punctuation -->

          <!-- BEGIN CATEGORY GROUP 2: Modifiers -->
          <tbody class="js-table-sections-header">
            <!-- BEGIN Question Type 1 -->
            <tr>
              <td class="text-center">
                <i class="fa fa-angle-right"></i>
              </td>
              <td>
                <button type="button" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Category Type</button>
              </td>
              <td class="fw-semibold fs-sm">
                <!-- Modal Button that initiates opening CATEGORY Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1ct1" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Modifiers</button>

                <!-- Opens Modal - Has Modal Content - CATEGORY -->

                <div class="modal" id="modal-block-large-cg1ct1" tabindex="-1" aria-labelledby="modal-block-large-cg1ct1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Category: Modifiers</h3>
                        </div>
                        <div class="block-content">
                          <p class="fs-sm mb-0">
                          </p>

                          <div class="row items-push">
                            <!-- CATEGORY Description BLOCK -->
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Description</h3>
                                <div class="block-options">
                                  <!--
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                        -->
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>words</p>
                              </div>
                            </div>
                            <!-- End CATEGORY Description BLOCK -->
                          </div>
                        </div>

                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                      <!-- END Blocks API -->
                    </div>
                  </div>
                </div>
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:50%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      1/2 Incorrect
                    </font>
                  </font>
                </div>
                <!-- End Modal - CATEGORY -->
              </td>
              <!-- 
                      <td class="fw-semibold fs-sm">
                        <div class="py-1">
                          <p>2/3</p> 
                        </div>
                      </td>
                      -->
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <!-- ADD TO CUSTOM QUIZ CHECKMARK COLUMN -->
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>
          </tbody>
          <!-- END Category Types -->

          <!-- BEGIN Question Types -->
          <tbody class="fs-sm">
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">

                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1qt1" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Vocabulary in Context</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->
                <div class="modal" id="modal-block-large-cg1qt1" tabindex="-1" aria-labelledby="modal-block-large-cg1qt1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Vocabulary in Context</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq1" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq1_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">Description</a>
                              </div>
                              <div id="faq1_q1" class="collapse show" role="tabpanel" aria-labelledby="faq1_h1" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>Choose the word that fits best with the intended meaning of the sentence.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q2" aria-expanded="true" aria-controls="faq1_q2">Lesson</a>
                              </div>
                              <div id="faq1_q2" class="collapse" role="tabpanel" aria-labelledby="faq1_h2" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>It's critical to focus on the context outside of the vocabulary word itself, because context can affect the meaning of any given word. Compare Example 1 and Example 2 below with the word “arm”.</p>

                                  <p>Example 1</p>
                                  <p>The snowboarder landed on her <u>arm</u>, but miraculously, she was uninjured.</p>

                                  <p>Example 2</p>
                                  <p>It's important to <u>arm</u>yourself with a solid education.</p>

                                  <p>The meaning of the word completely changes based on the context.</p>

                                  <p><b>Common Mistakes</b></p>
                                  <p>The most common mistake is to only look at the given words in the answer choices and base your answer solely on their primary definitions. However, it’s necessary to understand the context surrounding the word because the correct answer won’t always be the primary definition. </p>

                                  <p>Another common mistake is to only read the sentence that contains the vocab word. The surrounding context is not only necessary in many cases, but it makes it easier to understand which word is correct. Attempt to get the context of the entire paragraph, or at least one sentence on either side of the sentence that contains the vocabulary word. </p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q3" aria-expanded="true" aria-controls="faq1_q3">Strategies</a>
                              </div>
                              <div id="faq1_q3" class="collapse" role="tabpanel" aria-labelledby="faq1_h3" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Strategy 1: Vocabulary in Context Step by Step Strategy</b></p>
                                  <p>1. Read the entire paragraph and get the paragraph’s main idea.</p>
                                  <p>2. Focus most of your attention on the intended meaning of the given and surrounding sentences.</p>
                                  <p>3. Plug each vocab word in one at a time and read the entire sentence with every answer choice. This strategy could negatively impact ACT English section timing, but it could also improve timing by making it easier to analyze each answer choice. </p>
                                  <p>4. A word that fits the context is better than a word that matches the primary definition (even though a word with the primary definition can be correct).</p>
                                  <p>5. If all of the other answers seem unreasonable and you don’t know the meaning of the remaining word, be “brave” and pick that answer. </p>

                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q4" aria-expanded="true" aria-controls="faq1_q4">Identification Methods</a>
                              </div>
                              <div id="faq1_q4" class="collapse" role="tabpanel" aria-labelledby="faq1_h4" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Identification Method 1</b></p>
                                  <p>The question has an underlined word and answer choices with similar-meaning words.
                                  </p>
                                  <p><b>Example 1</b></p>
                                  <p>Passage Excerpt: As modern planes have improved their safety, higher <u>agility</u> has allowed them to make complex manuvers mid-flight.</p>
                                  <p>A. NO CHANGE</p>
                                  <p>B. activity</p>
                                  <p>C. ingenuity</p>
                                  <p>D. clarity</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q5" aria-expanded="true" aria-controls="faq1_q5">Identification Activity</a>
                              </div>
                              <div id="faq1_q5" class="collapse" role="tabpanel" aria-labelledby="faq1_h5" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Identification Activity 1</b></p>
                                  <p>Which of the following questions test Dangling Modifiers?</p>

                                  <p>Question 1</p>
                                  <p>Question 2</p>

                                  <p>1. Part of his success is attributed to his ability to <u>plead</u> to a wide range of audiences.</p>

                                  <p>A. NO CHANGE</p>
                                  <p>B. appeal</p>
                                  <p>C. attract </p>
                                  <p>D. remark</p>

                                  A. NO CHANGE
                                  B. appeal
                                  C. attract
                                  D. remark

                                  2. The Dahlia flower is famous <u>to</u> its unique pattern of petals.

                                  A. NO CHANGE
                                  B. by
                                  C. for
                                  D. with

                                  Key:
                                  #1: Yes, this example tests Vocabulary in Context.
                                  #2: No, even though this question tests different word choices, it does NOT test Vocabulary in Context. It tests Idioms and Prepositions.
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- END Blocks API -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NEW End Modal - QUESTION TYPE -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:25%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/4 Incorrect
                </div>
              </td>
              <!-- 
                      <td class="fw-semibold fs-sm">
                        <div class="py-1">
                          <p>2/3</p> 
                        </div>
                      </td>
                      -->
              <!--
                      <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                          <div class="progress-bar" role="progressbar" aria-valuenow="50"
                            aria-valuemin="0" aria-valuemax="100" style="height:8px; width:50%">
                          </div>
                        </div>
                        <div class="text-center">
                          1/3 Incorrect
                        </div>
                      -->
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>
            <!-- END Question Type 1 -->

            <!-- BEGIN Question Type 2 -->
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">
                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1qt2" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Keyword Goal</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->

                <div class="modal" id="modal-block-large-cg1qt2" tabindex="-1" aria-labelledby="modal-block-large-cg1qt2" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Keyword Goal</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq2" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq2_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q1" aria-expanded="true" aria-controls="faq2_q1">Description</a>
                              </div>
                              <div id="faq2_q1" class="collapse show" role="tabpanel" aria-labelledby="faq2_h1" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q2" aria-expanded="true" aria-controls="faq2_q2">Lesson</a>
                              </div>
                              <div id="faq2_q2" class="collapse" role="tabpanel" aria-labelledby="faq2_h2" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q3" aria-expanded="true" aria-controls="faq2_q3">Strategies</a>
                              </div>
                              <div id="faq2_q3" class="collapse" role="tabpanel" aria-labelledby="faq2_h3" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Strategy 1: Stuff</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q4" aria-expanded="true" aria-controls="faq2_q4">Identification Methods</a>
                              </div>
                              <div id="faq2_q4" class="collapse" role="tabpanel" aria-labelledby="faq2_h4" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q5" aria-expanded="true" aria-controls="faq2_q5">Identification Activity</a>
                              </div>
                              <div id="faq2_q5" class="collapse" role="tabpanel" aria-labelledby="faq2_h5" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- END Blocks API -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NEW End Modal - QUESTION TYPE -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:25%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/4 Incorrect
                </div>
              </td>
              <!-- 
                      <td class="fw-semibold fs-sm">
                        <div class="py-1">
                          <p>2/3</p> 
                        </div>
                      </td>
                      -->

              <td class="text-center">
                <div class="form-check d-inline-block">
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>

            <!-- END Question Types -->
          </tbody>
          <!-- END CATEGORY GROUP 2: Modifiers -->

          <!-- BEGIN CATEGORY GROUP 3: Verb Tense & Form -->
          <tbody class="js-table-sections-header">
            <!-- BEGIN Question Type 1 -->
            <tr>
              <td class="text-center">
                <i class="fa fa-angle-right"></i>
              </td>
              <td>
                <button type="button" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Category Type</font>
                  </font>
                </button>
              </td>
              <td class="fw-semibold fs-sm">
                <!-- Modal Button that initiates opening CATEGORY Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1ct1" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Verb Tense &amp; Form</button>

                <!-- Opens Modal - Has Modal Content - CATEGORY -->

                <div class="modal" id="modal-block-large-cg1ct1" tabindex="-1" aria-labelledby="modal-block-large-cg1ct1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Category: Verb Tense &amp; Form</h3>
                        </div>
                        <div class="block-content">
                          <p class="fs-sm mb-0">
                          </p>

                          <div class="row items-push">
                            <!-- CATEGORY Description BLOCK -->
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Description</h3>
                                <div class="block-options">
                                  <!--
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                        -->
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>words that describe the Verb Tense &amp; Form category type</p>
                              </div>
                            </div>
                            <!-- End CATEGORY Description BLOCK -->
                          </div>
                        </div>

                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                      <!-- END Blocks API -->
                    </div>
                  </div>
                </div>
                <!-- End Modal - CATEGORY -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:33%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/3 Incorrect
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <!-- ADD TO CUSTOM QUIZ CHECKMARK COLUMN -->
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>
          </tbody>
          <!-- END Category Types -->

          <!-- BEGIN Question Types -->
          <tbody class="fs-sm">
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">

                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1qt1" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Vocabulary in Context</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->
                <div class="modal" id="modal-block-large-cg1qt1" tabindex="-1" aria-labelledby="modal-block-large-cg1qt1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Vocabulary in Context</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq1" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq1_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">Description</a>
                              </div>
                              <div id="faq1_q1" class="collapse show" role="tabpanel" aria-labelledby="faq1_h1" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>Choose the word that fits best with the intended meaning of the sentence.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q2" aria-expanded="true" aria-controls="faq1_q2">Lesson</a>
                              </div>
                              <div id="faq1_q2" class="collapse" role="tabpanel" aria-labelledby="faq1_h2" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>It's critical to focus on the context outside of the vocabulary word itself, because context can affect the meaning of any given word. Compare Example 1 and Example 2 below with the word “arm”.</p>

                                  <p>Example 1</p>
                                  <p>The snowboarder landed on her <u>arm</u>, but miraculously, she was uninjured.</p>

                                  <p>Example 2</p>
                                  <p>It's important to <u>arm</u>yourself with a solid education.</p>

                                  <p>The meaning of the word completely changes based on the context.</p>

                                  <p><b>Common Mistakes</b></p>
                                  <p>The most common mistake is to only look at the given words in the answer choices and base your answer solely on their primary definitions. However, it’s necessary to understand the context surrounding the word because the correct answer won’t always be the primary definition. </p>

                                  <p>Another common mistake is to only read the sentence that contains the vocab word. The surrounding context is not only necessary in many cases, but it makes it easier to understand which word is correct. Attempt to get the context of the entire paragraph, or at least one sentence on either side of the sentence that contains the vocabulary word. </p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q3" aria-expanded="true" aria-controls="faq1_q3">Strategies</a>
                              </div>
                              <div id="faq1_q3" class="collapse" role="tabpanel" aria-labelledby="faq1_h3" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Strategy 1: Vocabulary in Context Step by Step Strategy</b></p>
                                  <p>1. Read the entire paragraph and get the paragraph’s main idea.</p>
                                  <p>2. Focus most of your attention on the intended meaning of the given and surrounding sentences.</p>
                                  <p>3. Plug each vocab word in one at a time and read the entire sentence with every answer choice. This strategy could negatively impact ACT English section timing, but it could also improve timing by making it easier to analyze each answer choice. </p>
                                  <p>4. A word that fits the context is better than a word that matches the primary definition (even though a word with the primary definition can be correct).</p>
                                  <p>5. If all of the other answers seem unreasonable and you don’t know the meaning of the remaining word, be “brave” and pick that answer. </p>

                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q4" aria-expanded="true" aria-controls="faq1_q4">Identification Methods</a>
                              </div>
                              <div id="faq1_q4" class="collapse" role="tabpanel" aria-labelledby="faq1_h4" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Identification Method 1</b></p>
                                  <p>The question has an underlined word and answer choices with similar-meaning words.
                                  </p>
                                  <p><b>Example 1</b></p>
                                  <p>Passage Excerpt: As modern planes have improved their safety, higher <u>agility</u> has allowed them to make complex manuvers mid-flight.</p>
                                  <p>A. NO CHANGE</p>
                                  <p>B. activity</p>
                                  <p>C. ingenuity</p>
                                  <p>D. clarity</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q5" aria-expanded="true" aria-controls="faq1_q5">Identification Activity</a>
                              </div>
                              <div id="faq1_q5" class="collapse" role="tabpanel" aria-labelledby="faq1_h5" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Identification Activity 1</b></p>
                                  <p>Which of the following questions test Dangling Modifiers?</p>

                                  <p>Question 1</p>
                                  <p>Question 2</p>

                                  <p>1. Part of his success is attributed to his ability to <u>plead</u> to a wide range of audiences.</p>

                                  <p>A. NO CHANGE</p>
                                  <p>B. appeal</p>
                                  <p>C. attract </p>
                                  <p>D. remark</p>

                                  A. NO CHANGE
                                  B. appeal
                                  C. attract
                                  D. remark

                                  2. The Dahlia flower is famous <u>to</u> its unique pattern of petals.

                                  A. NO CHANGE
                                  B. by
                                  C. for
                                  D. with

                                  Key:
                                  #1: Yes, this example tests Vocabulary in Context.
                                  #2: No, even though this question tests different word choices, it does NOT test Vocabulary in Context. It tests Idioms and Prepositions.
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- END Blocks API -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NEW End Modal - QUESTION TYPE -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:33%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/3 Incorrect
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>
            <!-- END Question Type 1 -->

            <!-- BEGIN Question Type 2 -->
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">
                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1qt2" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Keyword Goal</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->

                <div class="modal" id="modal-block-large-cg1qt2" tabindex="-1" aria-labelledby="modal-block-large-cg1qt2" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Keyword Goal</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq2" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq2_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q1" aria-expanded="true" aria-controls="faq2_q1">Description</a>
                              </div>
                              <div id="faq2_q1" class="collapse show" role="tabpanel" aria-labelledby="faq2_h1" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q2" aria-expanded="true" aria-controls="faq2_q2">Lesson</a>
                              </div>
                              <div id="faq2_q2" class="collapse" role="tabpanel" aria-labelledby="faq2_h2" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q3" aria-expanded="true" aria-controls="faq2_q3">Strategies</a>
                              </div>
                              <div id="faq2_q3" class="collapse" role="tabpanel" aria-labelledby="faq2_h3" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Strategy 1: Stuff</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q4" aria-expanded="true" aria-controls="faq2_q4">Identification Methods</a>
                              </div>
                              <div id="faq2_q4" class="collapse" role="tabpanel" aria-labelledby="faq2_h4" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q5" aria-expanded="true" aria-controls="faq2_q5">Identification Activity</a>
                              </div>
                              <div id="faq2_q5" class="collapse" role="tabpanel" aria-labelledby="faq2_h5" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- END Blocks API -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NEW End Modal - QUESTION TYPE -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:33%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/3 Incorrect
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>

            <!-- END Question Types -->
          </tbody>
          <!-- END CATEGORY GROUP 3: Verb Tense & Form -->

          <!-- BEGIN CATEGORY GROUP 4: Word Agreement -->
          <tbody class="js-table-sections-header">
            <!-- BEGIN Question Type 1 -->
            <tr>
              <td class="text-center">
                <i class="fa fa-angle-right"></i>
              </td>
              <td>
                <button type="button" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Category Type</font>
                  </font>
                </button>
              </td>
              <td class="fw-semibold fs-sm">
                <!-- Modal Button that initiates opening CATEGORY Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1ct1" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Word Agreement</button>

                <!-- Opens Modal - Has Modal Content - CATEGORY -->

                <div class="modal" id="modal-block-large-cg1ct1" tabindex="-1" aria-labelledby="modal-block-large-cg1ct1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Category: Word Agreement</h3>
                        </div>
                        <div class="block-content">
                          <p class="fs-sm mb-0">
                          </p>

                          <div class="row items-push">
                            <!-- CATEGORY Description BLOCK -->
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Description</h3>
                                <div class="block-options">
                                  <!--
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                        -->
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>words that describe the Verb Tense &amp; Form category type</p>
                              </div>
                            </div>
                            <!-- End CATEGORY Description BLOCK -->
                          </div>
                        </div>

                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                      <!-- END Blocks API -->
                    </div>
                  </div>
                </div>
                <!-- End Modal - CATEGORY -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:67%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  2/3 Incorrect
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <!-- ADD TO CUSTOM QUIZ CHECKMARK COLUMN -->
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>
          </tbody>
          <!-- END Category Types -->

          <!-- BEGIN Question Types -->
          <tbody class="fs-sm">
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">

                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1qt1" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Vocabulary in Context</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->
                <div class="modal" id="modal-block-large-cg1qt1" tabindex="-1" aria-labelledby="modal-block-large-cg1qt1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Vocabulary in Context</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq1" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq1_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">Description</a>
                              </div>
                              <div id="faq1_q1" class="collapse show" role="tabpanel" aria-labelledby="faq1_h1" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>Choose the word that fits best with the intended meaning of the sentence.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q2" aria-expanded="true" aria-controls="faq1_q2">Lesson</a>
                              </div>
                              <div id="faq1_q2" class="collapse" role="tabpanel" aria-labelledby="faq1_h2" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>It's critical to focus on the context outside of the vocabulary word itself, because context can affect the meaning of any given word. Compare Example 1 and Example 2 below with the word “arm”.</p>

                                  <p>Example 1</p>
                                  <p>The snowboarder landed on her <u>arm</u>, but miraculously, she was uninjured.</p>

                                  <p>Example 2</p>
                                  <p>It's important to <u>arm</u>yourself with a solid education.</p>

                                  <p>The meaning of the word completely changes based on the context.</p>

                                  <p><b>Common Mistakes</b></p>
                                  <p>The most common mistake is to only look at the given words in the answer choices and base your answer solely on their primary definitions. However, it’s necessary to understand the context surrounding the word because the correct answer won’t always be the primary definition. </p>

                                  <p>Another common mistake is to only read the sentence that contains the vocab word. The surrounding context is not only necessary in many cases, but it makes it easier to understand which word is correct. Attempt to get the context of the entire paragraph, or at least one sentence on either side of the sentence that contains the vocabulary word. </p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q3" aria-expanded="true" aria-controls="faq1_q3">Strategies</a>
                              </div>
                              <div id="faq1_q3" class="collapse" role="tabpanel" aria-labelledby="faq1_h3" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Strategy 1: Vocabulary in Context Step by Step Strategy</b></p>
                                  <p>1. Read the entire paragraph and get the paragraph’s main idea.</p>
                                  <p>2. Focus most of your attention on the intended meaning of the given and surrounding sentences.</p>
                                  <p>3. Plug each vocab word in one at a time and read the entire sentence with every answer choice. This strategy could negatively impact ACT English section timing, but it could also improve timing by making it easier to analyze each answer choice. </p>
                                  <p>4. A word that fits the context is better than a word that matches the primary definition (even though a word with the primary definition can be correct).</p>
                                  <p>5. If all of the other answers seem unreasonable and you don’t know the meaning of the remaining word, be “brave” and pick that answer. </p>

                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q4" aria-expanded="true" aria-controls="faq1_q4">Identification Methods</a>
                              </div>
                              <div id="faq1_q4" class="collapse" role="tabpanel" aria-labelledby="faq1_h4" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Identification Method 1</b></p>
                                  <p>The question has an underlined word and answer choices with similar-meaning words.
                                  </p>
                                  <p><b>Example 1</b></p>
                                  <p>Passage Excerpt: As modern planes have improved their safety, higher <u>agility</u> has allowed them to make complex manuvers mid-flight.</p>
                                  <p>A. NO CHANGE</p>
                                  <p>B. activity</p>
                                  <p>C. ingenuity</p>
                                  <p>D. clarity</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q5" aria-expanded="true" aria-controls="faq1_q5">Identification Activity</a>
                              </div>
                              <div id="faq1_q5" class="collapse" role="tabpanel" aria-labelledby="faq1_h5" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Identification Activity 1</b></p>
                                  <p>Which of the following questions test Dangling Modifiers?</p>

                                  <p>Question 1</p>
                                  <p>Question 2</p>

                                  <p>1. Part of his success is attributed to his ability to <u>plead</u> to a wide range of audiences.</p>

                                  <p>A. NO CHANGE</p>
                                  <p>B. appeal</p>
                                  <p>C. attract </p>
                                  <p>D. remark</p>

                                  A. NO CHANGE
                                  B. appeal
                                  C. attract
                                  D. remark

                                  2. The Dahlia flower is famous <u>to</u> its unique pattern of petals.

                                  A. NO CHANGE
                                  B. by
                                  C. for
                                  D. with

                                  Key:
                                  #1: Yes, this example tests Vocabulary in Context.
                                  #2: No, even though this question tests different word choices, it does NOT test Vocabulary in Context. It tests Idioms and Prepositions.
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- END Blocks API -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NEW End Modal - QUESTION TYPE -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:100%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/1 Incorrect
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>
            <!-- END Question Type 1 -->

            <!-- BEGIN Question Type 2 -->
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">
                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1qt2" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Keyword Goal</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->

                <div class="modal" id="modal-block-large-cg1qt2" tabindex="-1" aria-labelledby="modal-block-large-cg1qt2" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Keyword Goal</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq2" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq2_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q1" aria-expanded="true" aria-controls="faq2_q1">Description</a>
                              </div>
                              <div id="faq2_q1" class="collapse show" role="tabpanel" aria-labelledby="faq2_h1" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q2" aria-expanded="true" aria-controls="faq2_q2">Lesson</a>
                              </div>
                              <div id="faq2_q2" class="collapse" role="tabpanel" aria-labelledby="faq2_h2" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q3" aria-expanded="true" aria-controls="faq2_q3">Strategies</a>
                              </div>
                              <div id="faq2_q3" class="collapse" role="tabpanel" aria-labelledby="faq2_h3" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Strategy 1: Stuff</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q4" aria-expanded="true" aria-controls="faq2_q4">Identification Methods</a>
                              </div>
                              <div id="faq2_q4" class="collapse" role="tabpanel" aria-labelledby="faq2_h4" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q5" aria-expanded="true" aria-controls="faq2_q5">Identification Activity</a>
                              </div>
                              <div id="faq2_q5" class="collapse" role="tabpanel" aria-labelledby="faq2_h5" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- END Blocks API -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NEW End Modal - QUESTION TYPE -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:50%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/2 Incorrect
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>

            <!-- END Question Types -->
          </tbody>
          <!-- END CATEGORY GROUP 4: Word Agreement -->

          <!-- BEGIN CATEGORY GROUP 5: : Parallelism -->
          <tbody class="js-table-sections-header">
            <!-- BEGIN Question Type 1 -->
            <tr>
              <td class="text-center">
                <i class="fa fa-angle-right"></i>
              </td>
              <td>
                <button type="button" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Category Type</font>
                  </font>
                </button>
              </td>
              <td class="fw-semibold fs-sm">
                <!-- Modal Button that initiates opening CATEGORY Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1ct1" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Parallelism</button>

                <!-- Opens Modal - Has Modal Content - CATEGORY -->

                <div class="modal" id="modal-block-large-cg1ct1" tabindex="-1" aria-labelledby="modal-block-large-cg1ct1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Category: Parallelism</h3>
                        </div>
                        <div class="block-content">
                          <p class="fs-sm mb-0">
                          </p>

                          <div class="row items-push">
                            <!-- CATEGORY Description BLOCK -->
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Description</h3>
                                <div class="block-options">
                                  <!--
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                        -->
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>words that describe the Verb Tense &amp; Form category type</p>
                              </div>
                            </div>
                            <!-- End CATEGORY Description BLOCK -->
                          </div>
                        </div>

                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                      <!-- END Blocks API -->
                    </div>
                  </div>
                </div>
                <!-- End Modal - CATEGORY -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:40%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  2/5 Incorrect
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <!-- ADD TO CUSTOM QUIZ CHECKMARK COLUMN -->
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>
          </tbody>
          <!-- END Category Types -->

          <!-- BEGIN Question Types -->
          <tbody class="fs-sm">
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">

                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1qt1" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Vocabulary in Context</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->
                <div class="modal" id="modal-block-large-cg1qt1" tabindex="-1" aria-labelledby="modal-block-large-cg1qt1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Vocabulary in Context</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq1" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq1_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">Description</a>
                              </div>
                              <div id="faq1_q1" class="collapse show" role="tabpanel" aria-labelledby="faq1_h1" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>Choose the word that fits best with the intended meaning of the sentence.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q2" aria-expanded="true" aria-controls="faq1_q2">Lesson</a>
                              </div>
                              <div id="faq1_q2" class="collapse" role="tabpanel" aria-labelledby="faq1_h2" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>It's critical to focus on the context outside of the vocabulary word itself, because context can affect the meaning of any given word. Compare Example 1 and Example 2 below with the word “arm”.</p>

                                  <p>Example 1</p>
                                  <p>The snowboarder landed on her <u>arm</u>, but miraculously, she was uninjured.</p>

                                  <p>Example 2</p>
                                  <p>It's important to <u>arm</u>yourself with a solid education.</p>

                                  <p>The meaning of the word completely changes based on the context.</p>

                                  <p><b>Common Mistakes</b></p>
                                  <p>The most common mistake is to only look at the given words in the answer choices and base your answer solely on their primary definitions. However, it’s necessary to understand the context surrounding the word because the correct answer won’t always be the primary definition. </p>

                                  <p>Another common mistake is to only read the sentence that contains the vocab word. The surrounding context is not only necessary in many cases, but it makes it easier to understand which word is correct. Attempt to get the context of the entire paragraph, or at least one sentence on either side of the sentence that contains the vocabulary word. </p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q3" aria-expanded="true" aria-controls="faq1_q3">Strategies</a>
                              </div>
                              <div id="faq1_q3" class="collapse" role="tabpanel" aria-labelledby="faq1_h3" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Strategy 1: Vocabulary in Context Step by Step Strategy</b></p>
                                  <p>1. Read the entire paragraph and get the paragraph’s main idea.</p>
                                  <p>2. Focus most of your attention on the intended meaning of the given and surrounding sentences.</p>
                                  <p>3. Plug each vocab word in one at a time and read the entire sentence with every answer choice. This strategy could negatively impact ACT English section timing, but it could also improve timing by making it easier to analyze each answer choice. </p>
                                  <p>4. A word that fits the context is better than a word that matches the primary definition (even though a word with the primary definition can be correct).</p>
                                  <p>5. If all of the other answers seem unreasonable and you don’t know the meaning of the remaining word, be “brave” and pick that answer. </p>

                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q4" aria-expanded="true" aria-controls="faq1_q4">Identification Methods</a>
                              </div>
                              <div id="faq1_q4" class="collapse" role="tabpanel" aria-labelledby="faq1_h4" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Identification Method 1</b></p>
                                  <p>The question has an underlined word and answer choices with similar-meaning words.
                                  </p>
                                  <p><b>Example 1</b></p>
                                  <p>Passage Excerpt: As modern planes have improved their safety, higher <u>agility</u> has allowed them to make complex manuvers mid-flight.</p>
                                  <p>A. NO CHANGE</p>
                                  <p>B. activity</p>
                                  <p>C. ingenuity</p>
                                  <p>D. clarity</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q5" aria-expanded="true" aria-controls="faq1_q5">Identification Activity</a>
                              </div>
                              <div id="faq1_q5" class="collapse" role="tabpanel" aria-labelledby="faq1_h5" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Identification Activity 1</b></p>
                                  <p>Which of the following questions test Dangling Modifiers?</p>

                                  <p>Question 1</p>
                                  <p>Question 2</p>

                                  <p>1. Part of his success is attributed to his ability to <u>plead</u> to a wide range of audiences.</p>

                                  <p>A. NO CHANGE</p>
                                  <p>B. appeal</p>
                                  <p>C. attract </p>
                                  <p>D. remark</p>

                                  A. NO CHANGE
                                  B. appeal
                                  C. attract
                                  D. remark

                                  2. The Dahlia flower is famous <u>to</u> its unique pattern of petals.

                                  A. NO CHANGE
                                  B. by
                                  C. for
                                  D. with

                                  Key:
                                  #1: Yes, this example tests Vocabulary in Context.
                                  #2: No, even though this question tests different word choices, it does NOT test Vocabulary in Context. It tests Idioms and Prepositions.
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- END Blocks API -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NEW End Modal - QUESTION TYPE -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:33%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/3 Incorrect
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>
            <!-- END Question Type 1 -->

            <!-- BEGIN Question Type 2 -->
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">
                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1qt2" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Keyword Goal</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->

                <div class="modal" id="modal-block-large-cg1qt2" tabindex="-1" aria-labelledby="modal-block-large-cg1qt2" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Keyword Goal</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq2" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq2_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q1" aria-expanded="true" aria-controls="faq2_q1">Description</a>
                              </div>
                              <div id="faq2_q1" class="collapse show" role="tabpanel" aria-labelledby="faq2_h1" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q2" aria-expanded="true" aria-controls="faq2_q2">Lesson</a>
                              </div>
                              <div id="faq2_q2" class="collapse" role="tabpanel" aria-labelledby="faq2_h2" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q3" aria-expanded="true" aria-controls="faq2_q3">Strategies</a>
                              </div>
                              <div id="faq2_q3" class="collapse" role="tabpanel" aria-labelledby="faq2_h3" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Strategy 1: Stuff</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q4" aria-expanded="true" aria-controls="faq2_q4">Identification Methods</a>
                              </div>
                              <div id="faq2_q4" class="collapse" role="tabpanel" aria-labelledby="faq2_h4" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q5" aria-expanded="true" aria-controls="faq2_q5">Identification Activity</a>
                              </div>
                              <div id="faq2_q5" class="collapse" role="tabpanel" aria-labelledby="faq2_h5" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- END Blocks API -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NEW End Modal - QUESTION TYPE -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:33%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/3 Incorrect
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>

            <!-- END Question Types -->
          </tbody>
          <!-- END CATEGORY GROUP 5: Parallelism -->

          <!-- BEGIN CATEGORY GROUP 6: Diction / Word Choice -->
          <tbody class="js-table-sections-header">
            <!-- BEGIN Question Type 1 -->
            <tr>
              <td class="text-center">
                <i class="fa fa-angle-right"></i>
              </td>
              <td>
                <button type="button" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Category Type</font>
                  </font>
                </button>
              </td>
              <td class="fw-semibold fs-sm">
                <!-- Modal Button that initiates opening CATEGORY Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg6ct1" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Diction / Word Choice</button>

                <!-- Opens Modal - Has Modal Content - CATEGORY -->

                <div class="modal" id="modal-block-large-cg6ct6" tabindex="-1" aria-labelledby="modal-block-large-cg6ct6" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Category: Diction / Word Choice</h3>
                        </div>
                        <div class="block-content">
                          <p class="fs-sm mb-0">
                          </p>

                          <div class="row items-push">
                            <!-- CATEGORY Description BLOCK -->
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Description</h3>
                                <div class="block-options">
                                  <!--
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                        -->
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>Diction questions have you choose the appropriate words to use in the passage based on the context or a set of criteria. </p>
                              </div>
                            </div>
                            <!-- End CATEGORY Description BLOCK -->
                          </div>
                        </div>

                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                      <!-- END Blocks API -->
                    </div>
                  </div>
                </div>
                <!-- End Modal - CATEGORY -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:33%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      1/3 Incorrect
                    </font>
                  </font>
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <!-- ADD TO CUSTOM QUIZ CHECKMARK COLUMN -->
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>
          </tbody>
          <!-- END Category Types -->

          <!-- BEGIN Question Types -->
          <tbody class="fs-sm">
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">

                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg6qt1" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Vocabulary in Context</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->
                <div class="modal" id="modal-block-large-cg6qt1" tabindex="-1" aria-labelledby="modal-block-large-cg6qt1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Vocabulary in Context</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq1" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq1_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">Description</a>
                              </div>
                              <div id="faq1_q1" class="collapse show" role="tabpanel" aria-labelledby="faq1_h1" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>Choose the word that fits best with the intended meaning of the sentence.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q2" aria-expanded="true" aria-controls="faq1_q2">Lesson</a>
                              </div>
                              <div id="faq1_q2" class="collapse" role="tabpanel" aria-labelledby="faq1_h2" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Common Mistakes</b></p>
                                  <p>The most common mistake is to only look at the given words in the answer choices and basing your answer solely on their definitions. However, it’s necessary to understand the context surrounding the word because the correct answer won’t always be the primary definition. </p>
                                  <p>The second-most common mistake is only reading the sentence that contains the vocab word. The surrounding context is critical to understanding which word is correct at least half of the time. Attempt to get the context of the entire paragraph, or at least one sentence on either side of the question’s/tested sentence. </p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q3" aria-expanded="true" aria-controls="faq1_q3">Strategies</a>
                              </div>
                              <div id="faq1_q3" class="collapse" role="tabpanel" aria-labelledby="faq1_h3" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Strategy 1: Vocabulary in Context Step by Step Strategy</b></p>
                                  <p>1. Read the entire paragraph and get the paragraph’s main idea.</p>
                                  <p>2. Focus most of your attention on the intended meaning of the given and surrounding sentences.</p>
                                  <p>3. Plug each vocab word in one at a time and read the entire sentence with every answer choice. This strategy could negatively impact ACT English section timing, but it could also improve timing by making it easier to analyze each answer choice. </p>
                                  <p>4. A word that fits the context is better than a word that matches the primary definition (even though a word with the primary definition can be correct).</p>
                                  <p>5. If all of the other answers seem unreasonable and you don’t know the meaning of the remaining word, be “brave” and pick that answer. </p>

                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q4" aria-expanded="true" aria-controls="faq1_q4">Identification Methods</a>
                              </div>
                              <div id="faq1_q4" class="collapse" role="tabpanel" aria-labelledby="faq1_h4" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q5" aria-expanded="true" aria-controls="faq1_q5">Identification Activity</a>
                              </div>
                              <div id="faq1_q5" class="collapse" role="tabpanel" aria-labelledby="faq1_h5" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- END Blocks API -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NEW End Modal - QUESTION TYPE -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:33%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/3 Incorrect
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>
            <!-- END Question Type 1 -->

            <!-- BEGIN Question Type 2 -->
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">
                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg6qt2" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Keyword Goal</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->

                <div class="modal" id="modal-block-large-cg6qt2" tabindex="-1" aria-labelledby="modal-block-large-cg6qt2" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Keyword Goal</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq2" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq2_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q1" aria-expanded="true" aria-controls="faq2_q1">Description</a>
                              </div>
                              <div id="faq2_q1" class="collapse show" role="tabpanel" aria-labelledby="faq2_h1" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q2" aria-expanded="true" aria-controls="faq2_q2">Lesson</a>
                              </div>
                              <div id="faq2_q2" class="collapse" role="tabpanel" aria-labelledby="faq2_h2" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q3" aria-expanded="true" aria-controls="faq2_q3">Strategies</a>
                              </div>
                              <div id="faq2_q3" class="collapse" role="tabpanel" aria-labelledby="faq2_h3" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Strategy 1: Stuff</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q4" aria-expanded="true" aria-controls="faq2_q4">Identification Methods</a>
                              </div>
                              <div id="faq2_q4" class="collapse" role="tabpanel" aria-labelledby="faq2_h4" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q5" aria-expanded="true" aria-controls="faq2_q5">Identification Activity</a>
                              </div>
                              <div id="faq2_q5" class="collapse" role="tabpanel" aria-labelledby="faq2_h5" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- END Blocks API -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NEW End Modal - QUESTION TYPE -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:33%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/3 Incorrect
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>

            <!-- END Question Types -->
          </tbody>
          <!-- END CATEGORY GROUP 6: Diction / Word Choice -->

          <!-- BEGIN CATEGORY GROUP 7: Passage Development & Analysis -->
          <tbody class="js-table-sections-header">
            <!-- BEGIN Question Type 1 -->
            <tr>
              <td class="text-center">
                <i class="fa fa-angle-right"></i>
              </td>
              <td>
                <button type="button" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Category Type</font>
                  </font>
                </button>
              </td>
              <td class="fw-semibold fs-sm">
                <!-- Modal Button that initiates opening CATEGORY Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1ct1" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Passage Development &amp; Analysis</button>

                <!-- Opens Modal - Has Modal Content - CATEGORY -->

                <div class="modal" id="modal-block-large-cg1ct1" tabindex="-1" aria-labelledby="modal-block-large-cg1ct1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Category: Passage Development &amp; Analysis</h3>
                        </div>
                        <div class="block-content">
                          <p class="fs-sm mb-0">
                          </p>

                          <div class="row items-push">
                            <!-- CATEGORY Description BLOCK -->
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Description</h3>
                                <div class="block-options">
                                  <!--
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                        -->
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>words that describe the Verb Tense &amp; Form category type</p>
                              </div>
                            </div>
                            <!-- End CATEGORY Description BLOCK -->
                          </div>
                        </div>

                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                      <!-- END Blocks API -->
                    </div>
                  </div>
                </div>
                <!-- End Modal - CATEGORY -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:33%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      1/3 Incorrect
                    </font>
                  </font>
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <!-- ADD TO CUSTOM QUIZ CHECKMARK COLUMN -->
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>
          </tbody>
          <!-- END Category Types -->

          <!-- BEGIN Question Types -->
          <tbody class="fs-sm">
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">

                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1qt1" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Vocabulary in Context</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->
                <div class="modal" id="modal-block-large-cg1qt1" tabindex="-1" aria-labelledby="modal-block-large-cg1qt1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Vocabulary in Context</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq1" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq1_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">Description</a>
                              </div>
                              <div id="faq1_q1" class="collapse show" role="tabpanel" aria-labelledby="faq1_h1" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>Choose the word that fits best with the intended meaning of the sentence.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q2" aria-expanded="true" aria-controls="faq1_q2">Lesson</a>
                              </div>
                              <div id="faq1_q2" class="collapse" role="tabpanel" aria-labelledby="faq1_h2" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Common Mistakes</b></p>
                                  <p>The most common mistake is to only look at the given words in the answer choices and basing your answer solely on their definitions. However, it’s necessary to understand the context surrounding the word because the correct answer won’t always be the primary definition. </p>
                                  <p>The second-most common mistake is only reading the sentence that contains the vocab word. The surrounding context is critical to understanding which word is correct at least half of the time. Attempt to get the context of the entire paragraph, or at least one sentence on either side of the question’s/tested sentence. </p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q3" aria-expanded="true" aria-controls="faq1_q3">Strategies</a>
                              </div>
                              <div id="faq1_q3" class="collapse" role="tabpanel" aria-labelledby="faq1_h3" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Strategy 1: Vocabulary in Context Step by Step Strategy</b></p>
                                  <p>1. Read the entire paragraph and get the paragraph’s main idea.</p>
                                  <p>2. Focus most of your attention on the intended meaning of the given and surrounding sentences.</p>
                                  <p>3. Plug each vocab word in one at a time and read the entire sentence with every answer choice. This strategy could negatively impact ACT English section timing, but it could also improve timing by making it easier to analyze each answer choice. </p>
                                  <p>4. A word that fits the context is better than a word that matches the primary definition (even though a word with the primary definition can be correct).</p>
                                  <p>5. If all of the other answers seem unreasonable and you don’t know the meaning of the remaining word, be “brave” and pick that answer. </p>

                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q4" aria-expanded="true" aria-controls="faq1_q4">Identification Methods</a>
                              </div>
                              <div id="faq1_q4" class="collapse" role="tabpanel" aria-labelledby="faq1_h4" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q5" aria-expanded="true" aria-controls="faq1_q5">Identification Activity</a>
                              </div>
                              <div id="faq1_q5" class="collapse" role="tabpanel" aria-labelledby="faq1_h5" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- END Blocks API -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NEW End Modal - QUESTION TYPE -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:33%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/3 Incorrect
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>
            <!-- END Question Type 1 -->

            <!-- BEGIN Question Type 2 -->
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">
                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1qt2" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Keyword Goal</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->

                <div class="modal" id="modal-block-large-cg1qt2" tabindex="-1" aria-labelledby="modal-block-large-cg1qt2" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Keyword Goal</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq2" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq2_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q1" aria-expanded="true" aria-controls="faq2_q1">Description</a>
                              </div>
                              <div id="faq2_q1" class="collapse show" role="tabpanel" aria-labelledby="faq2_h1" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q2" aria-expanded="true" aria-controls="faq2_q2">Lesson</a>
                              </div>
                              <div id="faq2_q2" class="collapse" role="tabpanel" aria-labelledby="faq2_h2" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q3" aria-expanded="true" aria-controls="faq2_q3">Strategies</a>
                              </div>
                              <div id="faq2_q3" class="collapse" role="tabpanel" aria-labelledby="faq2_h3" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Strategy 1: Stuff</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q4" aria-expanded="true" aria-controls="faq2_q4">Identification Methods</a>
                              </div>
                              <div id="faq2_q4" class="collapse" role="tabpanel" aria-labelledby="faq2_h4" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q5" aria-expanded="true" aria-controls="faq2_q5">Identification Activity</a>
                              </div>
                              <div id="faq2_q5" class="collapse" role="tabpanel" aria-labelledby="faq2_h5" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- END Blocks API -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NEW End Modal - QUESTION TYPE -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:33%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/3 Incorrect
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>

            <!-- END Question Types -->
          </tbody>
          <!-- END CATEGORY GROUP 7: Passage Development & Analysis -->

          <!-- BEGIN CATEGORY GROUP 8: Passage Organization -->
          <tbody class="js-table-sections-header">
            <!-- BEGIN Question Type 1 -->
            <tr>
              <td class="text-center">
                <i class="fa fa-angle-right"></i>
              </td>
              <td>
                <button type="button" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Category Type</font>
                  </font>
                </button>
              </td>
              <td class="fw-semibold fs-sm">
                <!-- Modal Button that initiates opening CATEGORY Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1ct1" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Passage Organization</button>

                <!-- Opens Modal - Has Modal Content - CATEGORY -->

                <div class="modal" id="modal-block-large-cg1ct1" tabindex="-1" aria-labelledby="modal-block-large-cg1ct1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Category: Passage Organization/h3&gt;
                          </h3>
                        </div>
                        <div class="block-content">
                          <p class="fs-sm mb-0">
                          </p>

                          <div class="row items-push">
                            <!-- CATEGORY Description BLOCK -->
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Description</h3>
                                <div class="block-options">
                                  <!--
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                        -->
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>words that describe the Verb Tense &amp; Form category type</p>
                              </div>
                            </div>
                            <!-- End CATEGORY Description BLOCK -->
                          </div>
                        </div>

                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                      <!-- END Blocks API -->
                    </div>
                  </div>
                </div>
                <!-- End Modal - CATEGORY -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:33%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      1/3 Incorrect
                    </font>
                  </font>
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <!-- ADD TO CUSTOM QUIZ CHECKMARK COLUMN -->
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>
          </tbody>
          <!-- END Category Types -->

          <!-- BEGIN Question Types -->
          <tbody class="fs-sm">
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">

                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1qt1" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Vocabulary in Context</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->
                <div class="modal" id="modal-block-large-cg1qt1" tabindex="-1" aria-labelledby="modal-block-large-cg1qt1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Vocabulary in Context</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq1" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq1_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">Description</a>
                              </div>
                              <div id="faq1_q1" class="collapse show" role="tabpanel" aria-labelledby="faq1_h1" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>Choose the word that fits best with the intended meaning of the sentence.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q2" aria-expanded="true" aria-controls="faq1_q2">Lesson</a>
                              </div>
                              <div id="faq1_q2" class="collapse" role="tabpanel" aria-labelledby="faq1_h2" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Common Mistakes</b></p>
                                  <p>The most common mistake is to only look at the given words in the answer choices and basing your answer solely on their definitions. However, it’s necessary to understand the context surrounding the word because the correct answer won’t always be the primary definition. </p>
                                  <p>The second-most common mistake is only reading the sentence that contains the vocab word. The surrounding context is critical to understanding which word is correct at least half of the time. Attempt to get the context of the entire paragraph, or at least one sentence on either side of the question’s/tested sentence. </p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q3" aria-expanded="true" aria-controls="faq1_q3">Strategies</a>
                              </div>
                              <div id="faq1_q3" class="collapse" role="tabpanel" aria-labelledby="faq1_h3" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Strategy 1: Vocabulary in Context Step by Step Strategy</b></p>
                                  <p>1. Read the entire paragraph and get the paragraph’s main idea.</p>
                                  <p>2. Focus most of your attention on the intended meaning of the given and surrounding sentences.</p>
                                  <p>3. Plug each vocab word in one at a time and read the entire sentence with every answer choice. This strategy could negatively impact ACT English section timing, but it could also improve timing by making it easier to analyze each answer choice. </p>
                                  <p>4. A word that fits the context is better than a word that matches the primary definition (even though a word with the primary definition can be correct).</p>
                                  <p>5. If all of the other answers seem unreasonable and you don’t know the meaning of the remaining word, be “brave” and pick that answer. </p>

                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q4" aria-expanded="true" aria-controls="faq1_q4">Identification Methods</a>
                              </div>
                              <div id="faq1_q4" class="collapse" role="tabpanel" aria-labelledby="faq1_h4" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q5" aria-expanded="true" aria-controls="faq1_q5">Identification Activity</a>
                              </div>
                              <div id="faq1_q5" class="collapse" role="tabpanel" aria-labelledby="faq1_h5" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- END Blocks API -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NEW End Modal - QUESTION TYPE -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:33%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/3 Incorrect
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>
            <!-- END Question Type 1 -->

            <!-- BEGIN Question Type 2 -->
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">
                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1qt2" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Keyword Goal</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->

                <div class="modal" id="modal-block-large-cg1qt2" tabindex="-1" aria-labelledby="modal-block-large-cg1qt2" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Keyword Goal</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq2" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq2_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q1" aria-expanded="true" aria-controls="faq2_q1">Description</a>
                              </div>
                              <div id="faq2_q1" class="collapse show" role="tabpanel" aria-labelledby="faq2_h1" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q2" aria-expanded="true" aria-controls="faq2_q2">Lesson</a>
                              </div>
                              <div id="faq2_q2" class="collapse" role="tabpanel" aria-labelledby="faq2_h2" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q3" aria-expanded="true" aria-controls="faq2_q3">Strategies</a>
                              </div>
                              <div id="faq2_q3" class="collapse" role="tabpanel" aria-labelledby="faq2_h3" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Strategy 1: Stuff</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q4" aria-expanded="true" aria-controls="faq2_q4">Identification Methods</a>
                              </div>
                              <div id="faq2_q4" class="collapse" role="tabpanel" aria-labelledby="faq2_h4" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q5" aria-expanded="true" aria-controls="faq2_q5">Identification Activity</a>
                              </div>
                              <div id="faq2_q5" class="collapse" role="tabpanel" aria-labelledby="faq2_h5" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- END Blocks API -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NEW End Modal - QUESTION TYPE -->
                <div class="py-1">
                  <div class="progress" style="height:8px; color:success">
                    <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:50%">
                      <span class="sr-only">1/2 Correct</span>
                    </div>
                  </div>
                </div>
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:33%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/3 Incorrect
                </div>
              </td>
              <td class="text-center input-position2">
                <div class="form-check d-inline-block">
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>

            <!-- END Question Types -->
          </tbody>
          <!-- END CATEGORY GROUP 8: Passage Organization -->

          <!-- BEGIN CATEGORY GROUP 9: Miscellaneous -->
          <tbody class="js-table-sections-header">
            <!-- BEGIN Question Type 1 -->
            <tr>
              <td class="text-center">
                <i class="fa fa-angle-right"></i>
              </td>
              <td>
                <button type="button" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Category Type</font>
                  </font>
                </button>
              </td>
              <td class="fw-semibold fs-sm">
                <!-- Modal Button that initiates opening CATEGORY Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1ct1" class="btn btn-dark fs-xs fw-semibold me-1 mb-3">Miscellaneous</button>

                <!-- Opens Modal - Has Modal Content - CATEGORY -->

                <div class="modal" id="modal-block-large-cg1ct1" tabindex="-1" aria-labelledby="modal-block-large-cg1ct1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Category: Miscellaneous</h3>
                        </div>
                        <div class="block-content position-relative">
                          <p class="fs-sm mb-0">
                          </p>

                          <div class="row items-push">
                            <!-- CATEGORY Description BLOCK -->
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Description</h3>
                                <div class="block-options">
                                  <!--
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                        -->
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>words that describe the Verb Tense &amp; Form category type</p>
                              </div>
                            </div>
                            <!-- End CATEGORY Description BLOCK -->
                          </div>
                        </div>

                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                      <!-- END Blocks API -->
                    </div>
                  </div>
                </div>
                <!-- End Modal - CATEGORY -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:33%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      1/3 Incorrect
                    </font>
                  </font>
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <!-- ADD TO CUSTOM QUIZ CHECKMARK COLUMN -->
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>
          </tbody>
          <!-- END Category Types -->

          <!-- BEGIN Question Types -->
          <tbody class="fs-sm">
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">

                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1qt1" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Vocabulary in Context</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->
                <div class="modal" id="modal-block-large-cg1qt1" tabindex="-1" aria-labelledby="modal-block-large-cg1qt1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Vocabulary in Context</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq1" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq1_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">Description</a>
                              </div>
                              <div id="faq1_q1" class="collapse show" role="tabpanel" aria-labelledby="faq1_h1" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>Choose the word that fits best with the intended meaning of the sentence.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q2" aria-expanded="true" aria-controls="faq1_q2">Lesson</a>
                              </div>
                              <div id="faq1_q2" class="collapse" role="tabpanel" aria-labelledby="faq1_h2" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Common Mistakes</b></p>
                                  <p>The most common mistake is to only look at the given words in the answer choices and basing your answer solely on their definitions. However, it’s necessary to understand the context surrounding the word because the correct answer won’t always be the primary definition. </p>
                                  <p>The second-most common mistake is only reading the sentence that contains the vocab word. The surrounding context is critical to understanding which word is correct at least half of the time. Attempt to get the context of the entire paragraph, or at least one sentence on either side of the question’s/tested sentence. </p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q3" aria-expanded="true" aria-controls="faq1_q3">Strategies</a>
                              </div>
                              <div id="faq1_q3" class="collapse" role="tabpanel" aria-labelledby="faq1_h3" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p><b>Strategy 1: Vocabulary in Context Step by Step Strategy</b></p>
                                  <p>1. Read the entire paragraph and get the paragraph’s main idea.</p>
                                  <p>2. Focus most of your attention on the intended meaning of the given and surrounding sentences.</p>
                                  <p>3. Plug each vocab word in one at a time and read the entire sentence with every answer choice. This strategy could negatively impact ACT English section timing, but it could also improve timing by making it easier to analyze each answer choice. </p>
                                  <p>4. A word that fits the context is better than a word that matches the primary definition (even though a word with the primary definition can be correct).</p>
                                  <p>5. If all of the other answers seem unreasonable and you don’t know the meaning of the remaining word, be “brave” and pick that answer. </p>

                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q4" aria-expanded="true" aria-controls="faq1_q4">Identification Methods</a>
                              </div>
                              <div id="faq1_q4" class="collapse" role="tabpanel" aria-labelledby="faq1_h4" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq1_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q5" aria-expanded="true" aria-controls="faq1_q5">Identification Activity</a>
                              </div>
                              <div id="faq1_q5" class="collapse" role="tabpanel" aria-labelledby="faq1_h5" data-bs-parent="#faq1">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- END Blocks API -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NEW End Modal - QUESTION TYPE -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:33%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/3 Incorrect
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>
            <!-- END Question Type 1 -->

            <!-- BEGIN Question Type 2 -->
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">
                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-cg1qt2" class="btn btn-primary fs-xs fw-semibold me-1 mb-3">Keyword Goal</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->

                <div class="modal" id="modal-block-large-cg1qt2" tabindex="-1" aria-labelledby="modal-block-large-cg1qt2" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Keyword Goal</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq2" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq2_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q1" aria-expanded="true" aria-controls="faq2_q1">Description</a>
                              </div>
                              <div id="faq2_q1" class="collapse show" role="tabpanel" aria-labelledby="faq2_h1" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q2" aria-expanded="true" aria-controls="faq2_q2">Lesson</a>
                              </div>
                              <div id="faq2_q2" class="collapse" role="tabpanel" aria-labelledby="faq2_h2" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q3" aria-expanded="true" aria-controls="faq2_q3">Strategies</a>
                              </div>
                              <div id="faq2_q3" class="collapse" role="tabpanel" aria-labelledby="faq2_h3" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Strategy 1: Stuff</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q4" aria-expanded="true" aria-controls="faq2_q4">Identification Methods</a>
                              </div>
                              <div id="faq2_q4" class="collapse" role="tabpanel" aria-labelledby="faq2_h4" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq2_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q5" aria-expanded="true" aria-controls="faq2_q5">Identification Activity</a>
                              </div>
                              <div id="faq2_q5" class="collapse" role="tabpanel" aria-labelledby="faq2_h5" data-bs-parent="#faq2">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- END Blocks API -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NEW End Modal - QUESTION TYPE -->
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:33%">
                  </div>
                </div>
                <div class="text-center text-danger">
                  1/3 Incorrect
                </div>
              </td>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                  <label class="form-check-label" for="row_1"></label>
                </div>
              </td>
            </tr>

            <!-- END Question Types -->
          </tbody>
          <!-- END CATEGORY GROUP 9: Miscellaneous -->

        </table>

      </div>
    </div>
    <!-- END Table 1 -->

    <!-- START Table 2 -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">Incorrect Answer Type Summary</h3>
      </div>
      <div class="block-content">
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
            <!-- Answer type 1 -->
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-info fs-xs fw-semibold me-1 mb-3">Answer Type</button>
              </td>
              <td class="fw-semibold fs-sm">
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-ag1" class="btn btn-info fs-xs fw-semibold me-1 mb-3">Doesn't Meet Keyword Goal</button>

                <!-- modal design -->
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
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q1" aria-expanded="true" aria-controls="faq2_q1">Description</a>
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
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
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

            <!-- Answer type 2 -->
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-info fs-xs fw-semibold me-1 mb-3">Answer Type</button>
              </td>
              <td class="fw-semibold fs-sm">
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-ag2" class="btn btn-info fs-xs fw-semibold me-1 mb-3">Vocabulary Definition Doesn't Match Context</button>

                <!-- modal design -->
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
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q1" aria-expanded="true" aria-controls="faq2_q1">Description</a>
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
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
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

            <!-- Answer Type 3 -->
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-info fs-xs fw-semibold me-1 mb-3">Answer Type</button>
              </td>
              <td class="fw-semibold fs-sm">

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-at3" class="btn btn-info fs-xs fw-semibold me-1 mb-3">Incorrectly Used Literal Vocabulary Definition</button>

                <!-- modal design -->
                <div class="modal" id="modal-block-large-at3" tabindex="-1" aria-labelledby="modal-block-large-at3" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Answer Type: Incorrectly Used Literal Vocabulary Definition</h3>
                        </div>
                        <div class="block-content">
                          <div id="at3" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="at3_description">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#at3" href="#at3_description" aria-expanded="true" aria-controls="at3_description">Description</a>
                              </div>
                              <div id="at3_description" class="collapse show" role="tabpanel" aria-labelledby="at3_description" data-bs-parent="#at3">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
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
          </tbody>
        </table>
      </div>
    </div>
    <!-- END Table 2 -->

    <!-- START Table 3 -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">
          Question & Concept Review
        </h3>
      </div>
      <div class="block-content block-content-full">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" value="" id="mega-settings-status" name="mega-settings-status">
          <label class="form-check-label fs-sm" for="mega-settings-status">Show Incorrect Questions Only</label>
        </div>
        <table class="table table-bordered table-striped table-vcenter">
          <thead>
            <tr>
              <th class="text-center sorting sorting_asc" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label=": activate to sort column descending" aria-sort="ascending"></th>

              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Your Answer</th>

              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Correct Answer</th>

              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Result</th>

              <th class="sorting sorting_asc" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Review</th>

              <th class="sorting sorting_asc" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Categories</th>

              <th class="sorting sorting_asc" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Question Types</th>

              <th class="sorting sorting_asc" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Answer Types</th>

              <th class="sorting sorting_asc" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Mistake Classification</th>
            </tr>
          </thead>
          <tbody>
            <!-- CONCEPT REVIEW Answer 1 -->
            <tr class="odd">
              <td class="text-center fs-sm dtr-control sorting_1" tabindex="0">
                1
                <i class="fa fa-fw fa-flag me-1" style="color:red"></i>
                <i class="fa fa-fw fa-circle-question me-1" style="color:blue"></i>
                <i style="color:black" class="fa fa-fw fa-forward me-1"></i>
              </td>

              <td class="fw-semibold fs-sm">B</td>

              <td class="fw-semibold fs-sm">A</td>

              <td>
                <i class="fa fa-lg fa-circle-xmark me-1" style="color:red"></i>
              </td>

              <td>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q1r" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info-light text-info"><i class="fa fa-lg fa-pencil me-1"></i>REVIEW</button>

                <!-- review modal design -->
                <div class="modal" id="modal-block-large-q1r" tabindex="-1" aria-labelledby="modal-block-large-q1r" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question 1 Review</h3>
                        </div>
                        <div class="block-content">
                          <div class="row items-push">
                            <!-- PASSAGE I design -->
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Passage I</h3>
                                <div class="block-options">
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>Between March and November of 2011, an anonymous donor left <u>intricately</u> crafted paper sculptures at various cultural institutions in Edinburgh, Scotland.</p>
                              </div>
                            </div>

                            <!-- Question 1 design -->
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Question 1</h3>
                                <div class="block-options">
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>Which choice most effectively emphasizes the complexity of the paper sculptures?</p>
                              </div>
                            </div>

                            <!-- Answer Choices Tabs design -->
                            <div class="block block-rounded">
                              <ul class="nav nav-tabs nav-tabs-alt" role="tablist">
                                <li class="nav-item">
                                  <button class="nav-link active bg-success text-gray" id="btabs-alt-static-home-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q1a" role="tab" aria-controls="btabs-alt-static-home" aria-selected="true">Answer A</button>
                                </li>
                                <li class="nav-item">
                                  <button class="nav-link bg-danger text-gray" id="btabs-alt-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q1b" role="tab" aria-controls="btabs-alt-static-profile" aria-selected="false">Answer B</button>
                                </li>
                                <li class="nav-item">
                                  <button class="nav-link bg-city-dark text-gray" id="btabs-alt-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q1c" role="tab" aria-controls="btabs-alt-static-profile" aria-selected="false">Answer C</button>
                                </li>
                                <li class="nav-item">
                                  <button class="nav-link bg-city-dark text-gray" id="btabs-alt-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q1d" role="tab" aria-controls="btabs-alt-static-profile" aria-selected="false">Answer D</button>
                                </li>
                              </ul>
                              <div class="block-content tab-content">

                                <!-- Answer 1 tab -->
                                <div class="tab-pane active" id="btabs-alt-static-q1a" role="tabpanel" aria-labelledby="btabs-alt-static-home-tab">
                                  <p>NO CHANGE: intricately</p>
                                  <p>
                                    <b>Explanation: </b>“Intricately” means “complicated or detailed”, which emphasizes the complexity of the paper sculptures.
                                  </p>
                                </div>

                                <!-- Answer 2 tab -->
                                <div class="tab-pane" id="btabs-alt-static-q1b" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                  <p>impressively</p>
                                  <p>
                                    <b>Explanation: </b>“Impressively” means “showing skill”, which is likely describing the sculptor’s skill instead of the complexity of the paper sculptures.
                                  </p>

                                  <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                                    <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                    Vocabulary Definition Doesn't Match Context
                                  </button>

                                  <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                                    <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                    Answer Doesn't Match Keyword Goal
                                  </button>
                                </div>

                                <!-- Answer 3 tab -->
                                <div class="tab-pane" id="btabs-alt-static-q1c" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                  <p>terrifically</p>
                                  <p>
                                    <b>Explanation: </b>“Terrifically” means “done in an extraordinary way”, which is describing how awe-inspiring the paper sculptures are, but is not specific enough to describe their complexity.
                                  </p>

                                  <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                                    <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                    Vocabulary Definition Doesn't Match Context
                                  </button>

                                  <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                                    <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                    Answer Doesn't Match Keyword Goal
                                  </button>
                                </div>

                                <!-- Answer 4 tab -->
                                <div class="tab-pane" id="btabs-alt-static-q1d" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                  <p>superbly</p>
                                  <p>
                                    <b>Explanation: </b>“Superbly” means “done in an extraordinary way”, which is describing how awe-inspiring the paper sculptures are, but is not specific enough to describe their complexity.
                                  </p>

                                  <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                                    <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                    Vocabulary Definition Doesn't Match Context
                                  </button>

                                  <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                                    <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                    Answer Doesn't Match Keyword Goal
                                  </button>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>

              <td>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q1ct1" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">Word Choice (Diction)</button>

                <!-- Word Choice modal design -->
                <div class="modal" id="modal-block-large-q1ct1" tabindex="-1" aria-labelledby="modal-block-large-q1ct1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Category: Word Choice</h3>
                        </div>
                        <div class="block-content">
                          <div id="q1ct1" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description tab -->
                              <div class="block-header block-header-default" role="tab" id="q1ct1_description">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#q1ct1" href="#q1ct1_description" aria-expanded="true" aria-controls="q1ct1_description">Description</a>
                              </div>
                              <div id="q1ct1_description" class="collapse show" role="tabpanel" aria-labelledby="q1ct1_description" data-bs-parent="#q1ct1">
                                <div class="block-content">
                                  <p>Diction questions have you choose the appropriate words to use in the passage based on the context or a set of criteria.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>

              <td>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q1qt1" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-lg fa-circle-xmark me-1"></i>
                  Keyword Goal
                </button>

                <!-- Keyword Goal modal design -->
                <div class="modal" id="modal-block-large-q1qt1" tabindex="-1" aria-labelledby="modal-block-large-q1qt1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Punctuation Between Multiple Adjectives</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq_q1" class="mb-5" role="tablist" aria-multiselectable="true">
                            <!-- Description tab -->
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q1_qt1_description_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q1" href="#faq_q1_qt1_description" aria-expanded="true" aria-controls="faq_q1_qt1_description">Description</a>
                              </div>
                              <div id="faq_q1_qt1_description" class="collapse show" role="tabpanel" aria-labelledby="faq_q1_qt1_description_aria-label" data-bs-parent="#faq_q1">
                                <div class="block-content">
                                  <p>dflkajsfdl;skaj</p>
                                </div>
                              </div>
                            </div>

                            <!-- Lesson tab -->
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q1_qt1_lesson_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q1" href="#faq_q1_qt1_lesson" aria-expanded="true" aria-controls="faq_q1_qt1_lesson">Lesson</a>
                              </div>
                              <div id="faq_q1_qt1_lesson" class="collapse" role="tabpanel" aria-labelledby="faq_q1_qt1_lesson_aria-label" data-bs-parent="#faq_q1">
                                <div class="block-content">
                                  <p>Legend:
                                    <br>
                                    <u><b>Adjective</b></u>
                                    <br>
                                    <b>Noun</b>
                                  </p>
                                  <p><b>keyword lesson words..</b></p>
                                  <p>more keyword lesson words </p>
                                  <p>Example (CORRECT): ..... <u><b>happy</b></u>, <u><b>smt</b></u> <b>d</b>. </p>
                                  <p>Thce. </p>
                                </div>
                              </div>
                            </div>

                            <!-- Strategies tab -->
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q1_qt1_strategies_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4" href="#faq_q1_qt1_strategies" aria-expanded="true" aria-controls="faq_q1_qt1_strategies">Strategies</a>
                              </div>
                              <div id="faq_q1_qt1_strategies" class="collapse" role="tabpanel" aria-labelledby="faq_q1_qt1_strategies_aria-label" data-bs-parent="#faq_q1">
                                <div class="block-content">
                                  <p><b>Strategy 1: Use the following keyword goal template to help solve these questions...... </b></p>
                                  <p>Look up the template in CPS lessons.....</p>
                                </div>
                              </div>
                            </div>

                            <!-- Identification Methods tab -->
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q1_qt1_idmethods_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4" href="#faq_q1_qt1_idmethods" aria-expanded="true" aria-controls="faq_q1_qt1_idmethods">Identification Methods</a>
                              </div>
                              <div id="faq_q1_qt1_idmethods" class="collapse" role="tabpanel" aria-labelledby="faq_q1_qt1_idmethods_aria-label" data-bs-parent="#faq_q1">
                                <div class="block-content">
                                  <p><b>Identification Method 1</b></p>
                                  <p>The question posed has a goal related to one or more keywords.</p>
                                  <p><b>Example 1</b></p>
                                  <p>Passage Excerpt: As modern planes have improved their aerodynamics, the <u>smooth</u> material their wings are made of has allowed them to make longer flights by saving fuel.</p>
                                  <p>Question: Which of the following most effectively illustrates the texture of the wings of the plane?</p>
                                  A. NO CHANGE<br>
                                  B. expensive<br>
                                  C. metal<br>
                                  D. transparent<p></p>
                                  <p>Goal: "most effectively illustrates"</p>
                                  <p>Keyword: "texture"</p>
                                </div>
                              </div>
                            </div>

                            <!-- Identification Activity tab -->
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q1_qt1_idactivity_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4" href="#faq_q1_qt1_idactivity" aria-expanded="true" aria-controls="faq_q1_qt1_idactivity">Identification Activity</a>
                              </div>
                              <div id="faq_q1_qt1_idactivity" class="collapse" role="tabpanel" aria-labelledby="faq_q1_qt1_idactivity_aria-label" data-bs-parent="#faq_q1">
                                <div class="block-content">
                                  <p><b>Identification Activity 1</b></p>
                                  <p>Which of the following questions test Punctuation Between Multiple Adjectives?</p>

                                  <p>Question 1</p>
                                  <p>Question 2</p>

                                  <p>1. Part of his success is attributed to his ability to <u>plead</u> to a wide range of audiences.</p>

                                  <p>A. NO CHANGE</p>
                                  <p>B. appeal</p>
                                  <p>C. attract </p>
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
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>

              <td>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-qt1at1" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger"><i class="fa fa-lg fa-circle-xmark me-1"></i>Answer Doesn't Match Keyword Goal</button>

                <!-- Answer Doesn't Match Keyword Goal modal design -->
                <div class="modal" id="modal-block-large-qt1at1" tabindex="-1" aria-labelledby="modal-block-large-qt1at1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Answer Type: Answer Doesn't Match Keyword Goal</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq2" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="qt1at1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#qt1at1" href="#qt1at1" aria-expanded="true" aria-controls="qt1at1">Description</a>
                              </div>
                              <div id="qt1at1" class="collapse show" role="tabpanel" aria-labelledby="qt1at1" data-bs-parent="#qt1at1">
                                <div class="block-content">
                                  <p>The answer choice needs to meet <b>all</b> goals and satisfy <b>all</b> keywords in the question.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-qt1at2" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger"><i class="fa fa-lg fa-circle-xmark me-1"></i>Vocabulary Definition Doesn't Match Context</button>

                <!-- Vocabulary Definition Doesn't Match Context modal design -->
                <div class="modal" id="modal-block-large-qt1at2" tabindex="-1" aria-labelledby="modal-block-large-qt1at2" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Answer Type: Vocabulary Definition Doesn't Match Context</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq2" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="qt1at2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#qt1at2" href="#qt1at2" aria-expanded="true" aria-controls="qt1at2">Description</a>
                              </div>
                              <div id="qt1at2" class="collapse show" role="tabpanel" aria-labelledby="qt1at2" data-bs-parent="#qt1at2">
                                <div class="block-content">
                                  <p>The vocabulary used doesn't fit the context or intended meaning of the sentence.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>

              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-outline-secondary fs-xs dropdown-toggle" id="dropdown-default-outline-secondary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    SELECT
                  </button>
                  <div class="dropdown-menu fs-sm" aria-labelledby="dropdown-default-outline-secondary">
                    <a class="dropdown-item" href="javascript:void(0)">Content Misunderstanding</a>
                    <a class="dropdown-item" href="javascript:void(0)">Random Error</a>
                    <a class="dropdown-item" href="javascript:void(0)">Timing Issue</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0)">N/A</a>
                  </div>
                </div>
              </td>
            </tr>

            <!-- CONCEPT REVIEW Answer 2 -->
            <tr class="even">
              <td class="text-center fs-sm dtr-control sorting_1" tabindex="0">2 </td>

              <td class="fw-semibold fs-sm">F</td>

              <td class="fw-semibold fs-sm">G</td>

              <td>
                <i class="fa fa-lg fa-circle-xmark me-1" style="color:red"></i>
              </td>

              <td>
                <button type="button" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info-light text-info" data-bs-toggle="modal" data-bs-target="#modal-block-large-q2r"><i class="fa fa-lg fa-pencil me-1"></i>REVIEW</button>

                <!-- review modal design -->
                <div class="modal" id="modal-block-large-q2r" tabindex="-1" aria-labelledby="modal-block-large-q2r" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question 2 Review</h3>
                        </div>
                        <div class="block-content">
                          <div class="row items-push">
                            <!-- Passage I design -->
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Passage I</h3>
                                <div class="block-options">
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p><u>Delighted, each sculpture was left secretly and was later discovered by staff.</u></p>
                              </div>
                            </div>

                            <!-- Question 2 design -->
                            <div id="my-block-q2" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Question 2</h3>
                                <div class="block-options">
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>N/A</p>
                              </div>
                            </div>

                            <div class="block block-rounded">
                              <ul class="nav nav-tabs nav-tabs-alt" role="tablist">
                                <li class="nav-item">
                                  <button class="nav-link active bg-danger text-gray" id="q2f-tab" data-bs-toggle="tab" data-bs-target="#q2f" role="tab" aria-controls="q2f" aria-selected="true">Answer F</button>
                                </li>
                                <li class="nav-item">
                                  <button class="nav-link bg-success text-gray" id="q2g-tab" data-bs-toggle="tab" data-bs-target="#q2g" role="tab" aria-controls="q2g-tab" aria-selected="false">Answer G</button>
                                </li>
                                <li class="nav-item">
                                  <button class="nav-link bg-city-dark text-gray" id="q2h-tab" data-bs-toggle="tab" data-bs-target="#q2h" role="tab" aria-controls="q2h-tab" aria-selected="false">Answer H</button>
                                </li>
                                <li class="nav-item">
                                  <button class="nav-link bg-city-dark text-gray" id="q2j-tab" data-bs-toggle="tab" data-bs-target="#q2j" role="tab" aria-controls="q2j-tab" aria-selected="false">Answer J</button>
                                </li>
                              </ul>
                              <div class="block-content tab-content">
                                <!-- answer f tab design -->
                                <div class="tab-pane active" id="q2f" role="tabpanel" aria-labelledby="q2f">
                                  <p>NO CHANGE: Delighted, each sculpture was left secretly and was later discovered by staff.</p>
                                  <p><b>Explanation: </b>“Delighted” is modifying “each sculpture”, and it doesn’t make sense for a sculpture to be delighted.</p>

                                  <p>The noun after the comma must be performing the verb in the phrase before the comma. When the noun that's supposed to be modified by the verb doesn't show up after the comma, it's said to be a "dangling modifier". Incorrect answers will have the wrong noun after the comma, causing that noun to illogically be perforing the verb before the comma. </p>

                                  <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                                    <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                    Modifier Modifies the Wrong Word
                                  </button>

                                  <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                                    <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                    Dangling Modifiers
                                  </button>

                                  <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                                    <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                    Dangling Modifier Causes Illogical Sentence
                                  </button>
                                </div>

                                <!-- answer g tab design -->
                                <div class="tab-pane" id="q2g" role="tabpanel" aria-labelledby="q2g">
                                  <p>Each sculpture was left secretly and later discovered by delighted staff.</p>
                                  <p><b>Explanation: </b>“Delighted” is modifying “staff”, which makes sense since staff members can be delighted.</p>
                                </div>

                                <!-- answer h tab design -->
                                <div class="tab-pane" id="q2h" role="tabpanel" aria-labelledby="q2h">
                                  <p>Left secretly and later discovered by staff, each sculpture was delighted.</p>
                                  <p><b>Explanation: </b>“Each sculpture” is being modified by “delighted”, but it doesn’t make sense for a sculpture to be delighted.</p>

                                  <p>When in the same clause, modifiers and the word they modify need to be close to each other so that the modifier doesn't accidentally modify an unintended word. When modifiers are placed next to a word that they were not intended to modify, they're called "misplaced modifiers". </p>

                                  <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                                    <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                    Modifier Modifies the Wrong Word
                                  </button>

                                  <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                                    <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                    Misplaced Modifiers
                                  </button>

                                  <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                                    <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                    Misplaced Modifier Causes Illogical Sentence
                                  </button>
                                </div>

                                <!-- answer j tab design -->
                                <div class="tab-pane" id="q2j" role="tabpanel" aria-labelledby="q2j">
                                  <p>Secretly delighted, each sculpture was discovered by staff.</p>
                                  <p><b>Explanation: </b>“Delighted” is modifying “each sculpture”, but it doesn’t make sense for a sculpture to be delighted.</p>

                                  <p>The noun after the comma must be performing the verb in the phrase before the comma. When the noun that's supposed to be modified by the verb doesn't show up directly after the comma, it's said to be a "dangling modifier". Incorrect answers will have the wrong noun after the comma, causing that noun to illogically be perforing the verb before the comma. </p>

                                  <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                                    <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                    Modifier Modifies the Wrong Word
                                  </button>

                                  <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                                    <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                    Dangling Modifiers
                                  </button>

                                  <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                                    <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                    Dangling Modifier Causes Illogical Sentence
                                  </button>
                                </div>

                              </div>
                            </div>

                            <!-- Notes design -->
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Notes</h3>
                                <div class="block-options">
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <form action="be_pages_ecom_customer.html" onsubmit="return false;">
                                  <div class="mb-4">
                                    <!-- <label class="form-label" for="one-ecom-customer-note">Note</label> -->
                                    <textarea class="form-control" id="one-ecom-customer-note" name="one-ecom-customer-note" rows="4" placeholder="Type insights, reminders, strategies, or other info..."></textarea>
                                  </div>
                                  <div class="mb-4">
                                    <button type="submit" class="btn btn-alt-primary">Save Notes</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>

              <td>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q2ct1" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">Modifiers</button>

                <!-- Modifiers modal design -->
                <div class="modal" id="modal-block-large-q2ct1" tabindex="-1" aria-labelledby="modal-block-large-q2ct1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Category: Modifiers</h3>
                        </div>
                        <div class="block-content">
                          <div id="q1ct1" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="q2ct1_description">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#q2ct1" href="#q1ct1_description" aria-expanded="true" aria-controls="q2ct1_description">Description</a>
                              </div>
                              <div id="q1ct1_description" class="collapse show" role="tabpanel" aria-labelledby="q2ct1_description" data-bs-parent="#q2ct1">
                                <div class="block-content">
                                  <p>Two types of modifiers are tested on the ACT: Dangling Modifiers and Misplaced Modifiers. </p>
                                  <p>Modifiers are words, phrases, or clauses that limit, qualify, describe, change, or clarify the meaning of other words. </p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>

              <td>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q2qt1" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-lg fa-circle-xmark me-1"></i>
                  Misplaced &amp; Dangling Modifiers
                </button>

                <!-- Misplaced &amp; Dangling Modifiers modal design -->
                <div class="modal" id="modal-block-large-q2qt1" tabindex="-1" aria-labelledby="modal-block-large-q2qt1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Misplaced &amp; Dangling Modifiers</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq5" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq5_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq5" href="#faq5_q1" aria-expanded="true" aria-controls="faq5_q1">Description</a>
                              </div>
                              <div id="faq5_q1" class="collapse show" role="tabpanel" aria-labelledby="faq5_h1" data-bs-parent="#faq5">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq5_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq5" href="#faq5_q2" aria-expanded="true" aria-controls="faq5_q2">Lesson</a>
                              </div>
                              <div id="faq5_q2" class="collapse" role="tabpanel" aria-labelledby="faq5_h2" data-bs-parent="#faq5">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq5_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq5" href="#faq5_q3" aria-expanded="true" aria-controls="faq5_q3">Strategies</a>
                              </div>
                              <div id="faq5_q3" class="collapse" role="tabpanel" aria-labelledby="faq5_h3" data-bs-parent="#faq5">
                                <div class="block-content">
                                  <p><b>Strategy 1</b></p>
                                  <p>Make sure the noun that's underlined after a comma is logically supposed to be performing the verb in the phrase before the comma.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq5_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq5" href="#faq5_q4" aria-expanded="true" aria-controls="faq5_q4">Identification Methods</a>
                              </div>
                              <div id="faq5_q4" class="collapse" role="tabpanel" aria-labelledby="faq5_h4" data-bs-parent="#faq5">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq5_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq5" href="#faq5_q5" aria-expanded="true" aria-controls="faq5_q5">Identification Activity</a>
                              </div>
                              <div id="faq5_q5" class="collapse" role="tabpanel" aria-labelledby="faq5_h5" data-bs-parent="#faq5">
                                <div class="block-content">
                                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>

              <td>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q2ac1" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-lg fa-circle-xmark me-1"></i>
                  Modifier Modifies the Wrong Word
                </button>

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q2ac1" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-lg fa-circle-xmark me-1"></i>
                  Dangling Modifier Causes Illogical Sentence
                </button>

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q2ac1" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-lg fa-circle-xmark me-1"></i>
                  Dangling Modifiers
                </button>

                <!-- modal design -->
                <div class="modal" id="modal-block-large-q2ac1" tabindex="-1" aria-labelledby="modal-block-large-q2ac1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Answer Type</h3>
                        </div>
                        <div class="block-content">
                          <div class="row items-push">
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Description</h3>
                                <div class="block-options">
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>A misplaced modifier (usually a verb) does not logically modify the noun that it's placed next to or causes an unintended meaning of the sentence. Modifiers need to be placed </p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>

              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-outline-secondary fs-xs dropdown-toggle" id="dropdown-default-outline-secondary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SELECT</button>

                  <div class="dropdown-menu fs-sm" aria-labelledby="dropdown-default-outline-secondary">
                    <a class="dropdown-item" href="javascript:void(0)">Content Misunderstanding</a>
                    <a class="dropdown-item" href="javascript:void(0)">Random Error</a>
                    <a class="dropdown-item" href="javascript:void(0)">Timing Issue</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0)">N/A</a>
                  </div>
                </div>
              </td>
            </tr>

            <!-- CONCEPT REVIEW Answer 3 -->
            <tr class="odd">
              <td class="text-center fs-sm dtr-control sorting_1" tabindex="0">
                3
                <i class="fa fa-fw fa-circle-question me-1" style="color:blue"></i>
                <i style="color:black" class="fa fa-fw fa-circle-arrow-right me-1"></i>
              </td>

              <td class="fw-semibold fs-sm">C</td>

              <td class="fw-semibold fs-sm">A</td>

              <td>
                <i class="fa fa-lg fa-circle-xmark me-1" style="color:red"></i>
              </td>

              <td>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q3r" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info-light text-info">
                  <i class="fa fa-lg fa-pencil me-1"></i>
                  REVIEW
                </button>

                <!-- review modal design -->
                <div class="modal" id="modal-block-large-q3r" tabindex="-1" aria-labelledby="modal-block-large-q3r" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question 3 Review</h3>
                        </div>
                        <div class="block-content">
                          <div class="row items-push">
                            <!-- Passage 1 tab design -->
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Passage I</h3>
                                <div class="block-options">
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>Library staff <u>dubbed</u> it the "poetree".</p>
                              </div>
                            </div>

                            <!-- Question 3 tabs design -->
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Question 3</h3>
                                <div class="block-options">
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>N/A</p>
                              </div>
                            </div>

                            <!-- Answer Choices tabs design -->
                            <div class="block block-rounded">
                              <ul class="nav nav-tabs nav-tabs-alt" role="tablist">
                                <li class="nav-item">
                                  <button class="nav-link active bg-success text-gray" id="btabs-alt-static-home-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q3a" role="tab" aria-controls="btabs-alt-static-home" aria-selected="true">Answer A</button>
                                </li>
                                <li class="nav-item">
                                  <button class="nav-link bg-danger text-gray" id="btabs-alt-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q3b" role="tab" aria-controls="btabs-alt-static-profile" aria-selected="false">Answer B</button>
                                </li>
                                <li class="nav-item">
                                  <button class="nav-link bg-city-dark text-gray" id="btabs-alt-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q3c" role="tab" aria-controls="btabs-alt-static-profile" aria-selected="false">Answer C</button>
                                </li>
                                <li class="nav-item">
                                  <button class="nav-link bg-city-dark text-gray" id="btabs-alt-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q3d" role="tab" aria-controls="btabs-alt-static-profile" aria-selected="false">Answer D</button>
                                </li>
                              </ul>

                              <div class="block-content tab-content">
                                <!-- Answer a tab design -->
                                <div class="tab-pane active" id="btabs-alt-static-q3a" role="tabpanel" aria-labelledby="btabs-alt-static-home-tab">
                                  <p>NO CHANGE: dubbed</p>
                                  <p><b>Explanation: </b>“Dubbed” means “to give a nickname to something”, which makes sense because the library staff are nicknaming the tree the “poetree”.</p>
                                </div>

                                <!-- Answer b tab design -->
                                <div class="tab-pane" id="btabs-alt-static-q3b" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                  <p>specified</p>

                                  <p><b>Explanation: </b>“Specified” means to clearly identify or point out. The library staff are not identifying the tree as a “poetree”, because they made up that term. They are nicknaming it the “poetree”.</p>

                                  <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                                    <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                    Vocabulary Definition Doesn't Match Context
                                  </button>
                                </div>

                                <!-- Answer c tab design -->
                                <div class="tab-pane" id="btabs-alt-static-q3c" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                  <p>adorned</p>

                                  <p><b>Explanation: </b>“Adorned” means to make beautiful, embellished, enhanced, or appealing. In this context, this word does not make sense because the library staff are naming the tree, not enhancing it with a name.</p>

                                  <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                                    <i class="fa fa-lg fa-circle-xmark me-1"></i>
                                    Vocabulary Definition Doesn't Match Context
                                  </button>
                                </div>

                                <!-- Answer d tab design -->
                                <div class="tab-pane" id="btabs-alt-static-q3d" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                  <p>honored</p>

                                  <p><b>Explanation: </b>“Honored” means to give respect. The library staff are not giving the tree respect by naming it “poetree”, they are just giving it a nickname.</p>

                                  <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger"><i class="fa fa-lg fa-circle-xmark me-1"></i>Vocabulary Definition Doesn't Match Context</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>

              <td>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q3ct1" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger"><i class="fa fa-lg fa-circle-xmark me-1"></i>Word Choice (Diction)</button>

                <!-- word choice modal design -->
                <div class="modal" id="modal-block-large-q3ct1" tabindex="-1" aria-labelledby="modal-block-large-q3ct1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Category: Word Choice (Diction)</h3>
                        </div>
                        <div class="block-content">
                          <div class="row items-push">
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Description</h3>
                                <div class="block-options">
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>Diction questions have you choose the appropriate words to use in the passage based on the context or a set of criteria.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>

              <td>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q3qt1" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-lg fa-circle-xmark me-1"></i>
                  Vocabulary in Context
                </button>

                <!-- Vocabulary in Context modal design -->
                <div class="modal" id="modal-block-large-q3qt1" tabindex="-1" aria-labelledby="modal-block-large-q3qt1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Vocabulary in Context</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq6" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq6_h1">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq6" href="#faq6_q1" aria-expanded="true" aria-controls="faq6_q1">Description</a>
                              </div>
                              <div id="faq6_q1" class="collapse show" role="tabpanel" aria-labelledby="faq6_h1" data-bs-parent="#faq6">
                                <div class="block-content">
                                  <p>dflkajsfdl;skaj</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq6_h2">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq6" href="#faq6_q2" aria-expanded="true" aria-controls="faq6_q2">Lesson</a>
                              </div>
                              <div id="faq6_q2" class="collapse" role="tabpanel" aria-labelledby="faq6_h2" data-bs-parent="#faq6">
                                <div class="block-content">
                                  <p>It's critical to focus on the context outside of the vocabulary word itself, because context can affect the meaning of any given word. Compare Example 1 and Example 2 below with the word “arm”.</p>

                                  <p>Example 1</p>
                                  <p>The snowboarder landed on her <u>arm</u>, but miraculously, she was uninjured.</p>

                                  <p>Example 2</p>
                                  <p>It's important to <u>arm</u>yourself with a solid education.</p>

                                  <p>The meaning of the word completely changes based on the context.</p>

                                  <p><b>Common Mistakes</b></p>
                                  <p>The most common mistake is to only look at the given words in the answer choices and base your answer solely on their primary definitions. However, it’s necessary to understand the context surrounding the word because the correct answer won’t always be the primary definition. </p>

                                  <p>Another common mistake is to only read the sentence that contains the vocab word. The surrounding context is not only necessary in many cases, but it makes it easier to understand which word is correct. Attempt to get the context of the entire paragraph, or at least one sentence on either side of the sentence that contains the vocabulary word. </p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq6_h3">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq6" href="#faq6_q3" aria-expanded="true" aria-controls="faq6_q3">Strategies</a>
                              </div>
                              <div id="faq6_q3" class="collapse" role="tabpanel" aria-labelledby="faq6_h3" data-bs-parent="#faq6">
                                <div class="block-content">
                                  <p><b>Strategy 1: Vocabulary in Context Step by Step Strategy</b></p>
                                  <p>1. Read the entire paragraph and get the paragraph’s main idea.</p>
                                  <p>2. Focus most of your attention on the intended meaning of the given and surrounding sentences.</p>
                                  <p>3. Plug each vocab word in one at a time and read the entire sentence with every answer choice. This strategy could negatively impact ACT English section timing, but it could also improve timing by making it easier to analyze each answer choice. </p>
                                  <p>4. A word that fits the context is better than a word that matches the primary definition (even though a word with the primary definition can be correct).</p>
                                  <p>5. If all of the other answers seem unreasonable and you don’t know the meaning of the remaining word, be “brave” and pick that answer. </p>

                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq6_h4">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq6" href="#faq6_q4" aria-expanded="true" aria-controls="faq6_q4">Identification Methods</a>
                              </div>
                              <div id="faq6_q4" class="collapse" role="tabpanel" aria-labelledby="faq6_h4" data-bs-parent="#faq6">
                                <div class="block-content">
                                  <p><b>Identification Method 1</b></p>
                                  <p>The question has an underlined word and answer choices with similar-meaning words.
                                  </p>
                                  <p><b>Example 1</b></p>
                                  <p>Passage Excerpt: As modern planes have improved their safety, higher <u>agility</u> has allowed them to make complex manuvers mid-flight.</p>
                                  <p>A. NO CHANGE</p>
                                  <p>B. activity</p>
                                  <p>C. ingenuity</p>
                                  <p>D. clarity</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq6_h5">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq6" href="#faq6_q5" aria-expanded="true" aria-controls="faq6_q5">Identification Activity</a>
                              </div>
                              <div id="faq6_q5" class="collapse" role="tabpanel" aria-labelledby="faq6_h5" data-bs-parent="#faq6">
                                <div class="block-content">
                                  <p><b>Identification Activity 1</b></p>
                                  <p>Which of the following questions test Dangling Modifiers?</p>

                                  <p>Question 1</p>
                                  <p>Question 2</p>

                                  <p>1. Part of his success is attributed to his ability to <u>plead</u> to a wide range of audiences.</p>

                                  <p>A. NO CHANGE</p>
                                  <p>B. appeal</p>
                                  <p>C. attract </p>
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
                                  <p>#1: Yes, this example tests Vocabulary in Context.</p>
                                  <p>#2: No, even though this question tests different word choices, it does NOT test Vocabulary in Context. It tests Idioms and Prepositions.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>

              <td>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q3ac1" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-lg fa-circle-xmark me-1"></i>
                  Vocabulary Definition Doesn't Match Context
                </button>

                <!-- Vocabulary Definition Doesn't Match Context modal design -->
                <div class="modal" id="modal-block-large-q3ac1" tabindex="-1" aria-labelledby="modal-block-large-q3ac1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Answer Type: Vocabulary Definition Doesn't Match Context</h3>
                        </div>
                        <div class="block-content">
                          <div class="row items-push">
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Description</h3>
                                <div class="block-options">
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>The vocabulary used doesn't fit the context or intended meaning of the sentence.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>

              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-outline-secondary fs-xs dropdown-toggle" id="dropdown-default-outline-secondary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    SELECT
                  </button>
                  <div class="dropdown-menu fs-sm" aria-labelledby="dropdown-default-outline-secondary">
                    <a class="dropdown-item" href="javascript:void(0)">Content Misunderstanding</a>
                    <a class="dropdown-item" href="javascript:void(0)">Random Error</a>
                    <a class="dropdown-item" href="javascript:void(0)">Timing Issue</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0)">N/A</a>
                  </div>
                </div>
              </td>
            </tr>

            <!-- CONCEPT REVIEW Answer 4 -->
            <tr class="even">
              <td class="text-center fs-sm dtr-control sorting_1" tabindex="0">4 </td>

              <td class="fw-semibold fs-sm">J</td>

              <td class="fw-semibold fs-sm">G</td>

              <td>
                <i class="fa fa-lg fa-circle-xmark me-1" style="color:red"></i>
              </td>

              <td>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q4r" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info-light text-info"><i class="fa fa-lg fa-pencil me-1"></i>REVIEW</button>

                <!-- REVIEW  modal design -->
                <div class="modal" id="modal-block-large-q4r" tabindex="-1" aria-labelledby="modal-block-large-q4r" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question 4 Review</h3>
                        </div>
                        <div class="block-content">
                          <div class="row items-push">
                            <!-- Passage I tab design -->
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Passage I</h3>
                                <div class="block-options">
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>At Edinburgh's Filmhouse <b>#4</b> <u>Cinema, a three-dimensional sculpted scene</u> shows patrons sitting in <b>#5</b> <u>a movie theater as horse leaps</u> out of the screen</p>
                              </div>
                            </div>

                            <!-- Question 4 tab design -->
                            <div id="my-block-q4" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Question 4</h3>
                                <div class="block-options">
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>N/A</p>
                              </div>
                            </div>

                            <!-- Answers tab design -->
                            <div class="block block-rounded">
                              <ul class="nav nav-tabs nav-tabs-alt" role="tablist">
                                <li class="nav-item">
                                  <button class="nav-link active bg-success text-gray" id="q4f-tab" data-bs-toggle="tab" data-bs-target="#q4f" role="tab" aria-controls="q4f" aria-selected="true">Answer F</button>
                                </li>
                                <li class="nav-item">
                                  <button class="nav-link bg-danger text-gray" id="q4g-tab" data-bs-toggle="tab" data-bs-target="#q4g" role="tab" aria-controls="q4g-tab" aria-selected="false">Answer G</button>
                                </li>
                                <li class="nav-item">
                                  <button class="nav-link bg-city-dark text-gray" id="q4h-tab" data-bs-toggle="tab" data-bs-target="#q4h" role="tab" aria-controls="q4h-tab" aria-selected="false">Answer H</button>
                                </li>
                                <li class="nav-item">
                                  <button class="nav-link bg-city-dark text-gray" id="q4j-tab" data-bs-toggle="tab" data-bs-target="#q4j" role="tab" aria-controls="q4j-tab" aria-selected="false">Answer J</button>
                                </li>
                              </ul>

                              <div class="block-content tab-content">
                                <!-- answer f tab design -->
                                <div class="tab-pane active" id="q4f" role="tabpanel" aria-labelledby="q4f">
                                  <p>NO CHANGE: Cinema, a three-dimensional sculpted scene</p>

                                  <p><b>Explanation: </b>The comma between “Cinema” and “a” is separating the dependent clause in the first half of the sentence from the independent clause in the second half of the sentence.</p>

                                  <p>The adjectives “three-dimensional” and “sculpted” are cumulative adjectives, which can NOT be joined by “and” and whose order can NOT be reversed, so NO comma should go between them.</p>

                                  <p>No comma allowed between “sculpted” (Adjective) and “scene” (the Noun it’s describing).</p>

                                  <p>No comma allowed between noun “scene” and verb “shows”.</p>
                                </div>

                                <!-- answer g tab design -->
                                <div class="tab-pane" id="q4g" role="tabpanel" aria-labelledby="q4g">
                                  <p>Cinema, a three-dimensional sculpted, scene</p>

                                  <p><b>Explanation: </b>The comma between “Cinema” and “a” is separating the dependent clause in the first half of the sentence from the independent clause in the second half of the sentence.</p>

                                  <p>"Three-dimensional" is describing the way it was sculpted, so these are not coordinate adjectives that are equal. They are cumulative adjectives that build upon each other, so no comma is allowed.</p>

                                  <p>No comma is allowed between “sculpted” (Adjective) and “scene” (the Noun it’s describing).</p>

                                  <p>No comma allowed between noun “scene” and verb “shows”.</p>

                                </div>

                                <!-- answer h tab design -->
                                <div class="tab-pane" id="q4h" role="tabpanel" aria-labelledby="q4h">
                                  <p>Cinema a three-dimensional sculpted scene,</p>

                                  <p><b>Explanation: </b>There should be a comma between “Cinema” and “a” to separate the dependent clause in the first half of the sentence from the independent clause in the second half of the sentence.</p>

                                  <p>"Three-dimensional" is describing the way it was sculpted, so these are not coordinate adjectives that are equal. They are cumulative adjectives that build upon each other, so no comma is allowed.</p>

                                  <p>No comma is allowed between “sculpted” (Adjective) and “scene” (the Noun it’s describing).</p>

                                  <p>No comma allowed between noun “scene” and verb “shows” (punctuation between a noun and verb is only allowed if the punctuation is the start of a non-essential element.</p>
                                </div>

                                <!-- answer j tab design -->
                                <div class="tab-pane" id="q4j" role="tabpanel" aria-labelledby="q4j">
                                  <p>Cinema, a three-dimensional, sculpted, scene</p>

                                  <p><b>Explanation: </b>There should be a comma between “Cinema” and “a” to separate the dependent clause in the first half of the sentence from the independent clause in the second half of the sentence.</p>

                                  <p>"Three-dimensional" is describing the way it was sculpted, so these are not coordinate adjectives that are equal. They are cumulative adjectives that build upon each other, so no comma is allowed.</p>

                                  <p>No comma allowed between “sculpted” (Adjective) and “scene” (the Noun it’s describing).</p>

                                  <p>No comma allowed between noun “scene” and verb “shows” (punctuation between a noun and verb is only allowed if the punctuation is the start of a non-essential element.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>

              <td>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q4ct1" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger"><i class="fa fa-lg fa-circle-xmark me-1"></i>Sentence Structure &amp; Punctuation</button>

                <!-- Sentence Structure modal design -->
                <div class="modal" id="modal-block-large-q4ct1" tabindex="-1" aria-labelledby="modal-block-large-q4ct1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Category: Sentence Structure &amp; Punctuation</h3>
                        </div>
                        <div class="block-content">
                          <div class="row items-push">
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Description</h3>
                                <div class="block-options">
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>......s. </p>
                                <p>......s. </p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>

              <td>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q4qt1" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-lg fa-circle-check me-1"></i>
                  Punctuation Between Multiple Adjectives
                </button>

                <!-- Punctuation Between Multiple Adjectives modal design -->
                <div class="modal" id="modal-block-large-q4qt1" tabindex="-1" aria-labelledby="modal-block-large-q4qt1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Punctuation Between Multiple Adjectives</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq_q4" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt1_description_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4" href="#faq_q4_qt1_description" aria-expanded="true" aria-controls="faq_q4_qt1_description">Description</a>
                              </div>
                              <div id="faq_q4_qt1_description" class="collapse show" role="tabpanel" aria-labelledby="faq_q4_qt1_description_aria-label" data-bs-parent="#faq_q4">
                                <div class="block-content">
                                  <p>dflkajsfdl;skaj</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt1_lesson_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4" href="#faq_q4_qt1_lesson" aria-expanded="true" aria-controls="faq_q4_qt1_lesson">Lesson</a>
                              </div>
                              <div id="faq_q4_qt1_lesson" class="collapse" role="tabpanel" aria-labelledby="faq_q4_qt1_lesson_aria-label" data-bs-parent="#faq_q4">
                                <div class="block-content">
                                  <p>Legend:
                                    <br>
                                    <u><b>Adjective</b></u>
                                    <br>
                                    <b>Noun</b>
                                  </p>
                                  <p><b>Coordinate Adjectives (Yes Comma)</b></p>
                                  <p>DO place a comma between the adjectives when they equally describe the noun that follows them. </p>
                                  <p>Example (CORRECT): He is a <u><b>happy</b></u>, <u><b>smart</b></u> <b>dog</b>. </p>

                                  <p>The order of coordinate adjectives does not matter, so the order can be switched without changing the meaning of the sentence. </p>
                                  <p>Example (CORRECT): He is a smart, happy dog.</p>
                                  Because both of these examples make sense regardless of the order of the adjectives, then using a comma between the adjectives is correct.
                                  <p><b>Cumulative Adjectives (No Comma)</b></p>
                                  <p>DO NOT place a comma between the adjectives when they DO NOT equally describe the noun that follows them. Each cumulative adjective has an increasing level of importance as it gets closer to the noun. Each cumulative adjective building upon the previous one as it gets closer to the noun. The adjective closest to the noun is generally closely connected to the noun and therefore unequally describing it to the point that it almost seems like the adjective is part of the noun. </p>
                                  <p>Example 1: The futuristic communications satellite. </p>
                                  <p>"Futuristic" is describing how advanced the satellite is, but "communications" almost seems inseparable from "satellite" because it's no ordinary satellite, but specifically a communications satellite. So communications more strongly describes the satellite and therefore these are cumulative adjectives that CANNOT have commas between them. </p>

                                  <p>Example 2 (CORRECT): Have you been to the <u><b>new</b></u> <u><b>ice cream</b></u> shop?</p>
                                  <p>Both new and ice cream are describing the kind of shop that is asked about, but ice cream is unequally describing a more important aspect of the type of shop it is, so these are cumulative adjectives that do not need a comma between them. </p>
                                  <p><b>Caution:</b> “ice cream” is not a noun in this situation, even though it seems to be an object. However, it is an adjective describing the noun “shop”.</p>
                                  <p>The order of coordinate adjectives does matter, so if the order is switched, the meaning of the sentence is changed in an unintended way.</p>
                                  <p>Example (WRONG): Have you been to the ice cream new shop?</p>
                                  <p>Example (CORRECT): Have you been to the new ice cream shop?</p>
                                  <p>Because only the second example’s order of adjectives makes sense, then using a comma between the adjectives is wrong and NO comma should be used. This example also further illustrates how the adjective closest to the noun almost feels as if it’s part of the noun when the sentence is using cumulative adjectives (where, again, no comma should be used between the adjectives).</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt1_strategies_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4" href="#faq_q4_qt1_strategies" aria-expanded="true" aria-controls="faq_q4_qt1_strategies">Strategies</a>
                              </div>
                              <div id="faq_q4_qt1_strategies" class="collapse" role="tabpanel" aria-labelledby="faq_q4_qt1_strategies_aria-label" data-bs-parent="#faq_q4">
                                <div class="block-content">
                                  <p><b>Strategy 1: Identify the word type (noun, verb, adjective, etc.) of each word surrounding the punctuation. </b></p>
                                  <p>Finding the word type of the words surrounding the punctuation allows you to determine which concept (Question Type?) is being tested. For example, if the words surrounding the punctuation are both adjectives, then you follow the rules and strategies for the Punctuation Between Multiple Adjectives question type. See Strategy 2 below for the specific approach to the question type Punctuaiton Between Multiple Adjectives.</p>

                                  <p><b>Strategy 2: Determine if the adjectives are equally describing the noun or if each adjective is building upon the previous one to desribe the noun. </b>

                                  </p>
                                  <p><b>Coordinate Adjectives:</b> DO place a comma between the adjectives when they equally describe the noun that follows them. </p>
                                  <p><b>Cumulative Adjectives:</b> DO NOT place a comma between the adjectives when they DO NOT equally describe the noun that follows them. Each cumulative adjective building upon the previous one as it gets closer to the noun. The adjective closest to the noun is generally closely connected to the noun and therefore unequally describing it to the point that it almost seems like the adjective is part of the noun. </p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt1_idmethods_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4" href="#faq_q4_qt1_idmethods" aria-expanded="true" aria-controls="faq_q4_qt1_idmethods">Identification Methods</a>
                              </div>
                              <div id="faq_q4_qt1_idmethods" class="collapse" role="tabpanel" aria-labelledby="faq_q4_qt1_idmethods_aria-label" data-bs-parent="#faq_q4">
                                <div class="block-content">
                                  <p><b>Identification Method 1</b></p>
                                  <p>The question has an underlined word and answer choices with similar-meaning words.
                                  </p>
                                  <p><b>Example 1</b></p>
                                  <p>Passage Excerpt: As modern planes have improved their safety, higher <u>agility</u> has allowed them to make complex manuvers mid-flight.</p>
                                  <p>A. NO CHANGE</p>
                                  <p>B. activity</p>
                                  <p>C. ingenuity</p>
                                  <p>D. clarity</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt1_idactivity_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4" href="#faq_q4_qt1_idactivity" aria-expanded="true" aria-controls="faq_q4_qt1_idactivity">Identification Activity</a>
                              </div>
                              <div id="faq_q4_qt1_idactivity" class="collapse" role="tabpanel" aria-labelledby="faq_q4_qt1_idactivity_aria-label" data-bs-parent="#faq_q4">
                                <div class="block-content">
                                  <p><b>Identification Activity 1</b></p>
                                  <p>Which of the following questions test Punctuation Between Multiple Adjectives?</p>

                                  <p>Question 1</p>
                                  <p>Question 2</p>
                                  <p>1. Part of his success is attributed to his ability to <u>plead</u> to a wide range of audiences.</p>

                                  <p>A. NO CHANGE</p>
                                  <p>B. appeal</p>
                                  <p>C. attract </p>
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
                                  <p>#2: No, even though this question tests different word choices, it does NOT test Punctuation Between Multiple Adjectives. It tests Idioms and Prepositions.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q4qt2" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-lg fa-circle-check me-1"></i>
                  Punctuation Between Adjectives &amp; Nouns
                </button>

                <!-- Punctuation Between Adjectives modal design -->
                <div class="modal" id="modal-block-large-q4qt2" tabindex="-1" aria-labelledby="modal-block-large-q4qt2" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Punctuation Between Adjectives &amp; Nouns</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq_q4_qt2" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt2_description_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4_qt2" href="#faq_q4_qt2_description" aria-expanded="true" aria-controls="faq_q4_qt2_description">Description</a>
                              </div>
                              <div id="faq_q4_qt2_description" class="collapse show" role="tabpanel" aria-labelledby="faq_q4_qt2_description_aria-label" data-bs-parent="#faq_q4_qt2">
                                <div class="block-content">
                                  <p>dflkajsfdl;skaj</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt2_lesson_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4_qt2" href="#faq_q4_qt2_lesson" aria-expanded="true" aria-controls="faq_q4_qt2_lesson">Lesson</a>
                              </div>
                              <div id="faq_q4_qt2_lesson" class="collapse" role="tabpanel" aria-labelledby="faq_q4_qt2_lesson_aria-label" data-bs-parent="#faq_q4_qt2">
                                <div class="block-content">
                                  <p>Legend:
                                    <br>
                                    <u><b>Adjective</b></u>
                                    <br>
                                    <b>Noun</b>
                                  </p>
                                  <p><b>Coordinate Adjectives (Yes Comma)</b></p>
                                  <p>Never place a comma between an adjective and the noun it's describing. </p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt2_strategies_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4_qt2" href="#faq_q4_qt2_strategies" aria-expanded="true" aria-controls="faq_q4_qt2_strategies">Strategies</a>
                              </div>
                              <div id="faq_q4_qt2_strategies" class="collapse" role="tabpanel" aria-labelledby="faq_q4_qt2_strategies_aria-label" data-bs-parent="#faq_q4_qt2">
                                <div class="block-content">
                                  <p><b>Strategy 1: Always briefly identify the word type next to pieces of punctuation</b></p>
                                  <p>Word type is the same as the part of speech, such as "adjective", "noun", "verb", or "adverb". Once you identify the word type, if you identify that the comma comes between an adjective and noun, never choose that option because there should NEVER be punctuation between an adjective and a noun. </p>
                                  <p>Simply never pick an answer choice with this situation</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt2_idmethods_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4_qt2" href="#faq_q4_qt2_idmethods" aria-expanded="true" aria-controls="faq_q4_qt2_idmethods">Identification Methods</a>
                              </div>
                              <div id="faq_q4_qt2_idmethods" class="collapse" role="tabpanel" aria-labelledby="faq_q4_qt2_idmethods_aria-label" data-bs-parent="#faq_q4_qt2">
                                <div class="block-content">
                                  <p><b>Identification Method 1</b></p>
                                  <p>The answer choices have a comma that shows up between an adjective and a noun.
                                  </p>
                                  <p><b>Example 1</b></p>
                                  <p>Passage Excerpt: A..... <u>agility</u> h.......</p>
                                  <p>A. NO CHANGE</p>
                                  <p>B. .</p>
                                  <p>C. ..</p>
                                  <p>D. ..</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt2_idactivity_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4_qt2" href="#faq_q4_qt2_idactivity" aria-expanded="true" aria-controls="faq_q4_qt2_idactivity">Identification Activity</a>
                              </div>
                              <div id="faq_q4_qt2_idactivity" class="collapse" role="tabpanel" aria-labelledby="faq_q4_qt2_idactivity_aria-label" data-bs-parent="#faq_q4_qt2">
                                <div class="block-content">
                                  <p><b>Identification Activity 1</b></p>
                                  <p>Which of the following questions test Punctuation Between Multiple Adjectives?</p>

                                  <p>Question 1</p>
                                  <p>Question 2</p>

                                  <p>1. Part of his success is attributed to his ability to <u>plead</u> to a wide range of audiences.</p>

                                  <p>A. NO CHANGE</p>
                                  <p>B. appeal</p>
                                  <p>C. attract </p>
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
                                  <p>#2: No, even though this question tests different word choices, it does NOT test Punctuation Between Adjectives and Nouns. It tests Idioms and Prepositions.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q4qt3" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-lg fa-circle-xmark me-1"></i>
                  Connecting Clauses
                </button>

                <!-- Connecting Clauses modal design -->
                <div class="modal" id="modal-block-large-q4qt3" tabindex="-1" aria-labelledby="modal-block-large-q4qt3" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Connecting Clauses</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq_q4_qt2" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt3_description_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4_qt3" href="#faq_q4_qt3_description" aria-expanded="true" aria-controls="faq_q4_qt3_description">Description</a>
                              </div>
                              <div id="faq_q4_qt3_description" class="collapse show" role="tabpanel" aria-labelledby="faq_q4_qt3_description_aria-label" data-bs-parent="#faq_q4_qt3">
                                <div class="block-content">
                                  <p>The Connecting Clauses question type...</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt3_lesson_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4_qt3" href="#faq_q4_qt3_lesson" aria-expanded="true" aria-controls="faq_q4_qt3_lesson">Lesson</a>
                              </div>
                              <div id="faq_q4_qt3_lesson" class="collapse" role="tabpanel" aria-labelledby="faq_q4_qt3_lesson_aria-label" data-bs-parent="#faq_q4_qt3">
                                <div class="block-content">
                                  <p>Legend:
                                    <br>
                                    <u><b>Adjective</b></u>
                                    <br>
                                    <b>Noun</b>
                                  </p>
                                  <p><b>Coordinate Adjectives (Yes Comma)</b></p>
                                  <p>Connecting Clauses ..... </p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt2_strategies_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4_qt3" href="#faq_q4_qt3_strategies" aria-expanded="true" aria-controls="faq_q4_qt3_strategies">Strategies</a>
                              </div>
                              <div id="faq_q4_qt3_strategies" class="collapse" role="tabpanel" aria-labelledby="faq_q4_qt3_strategies_aria-label" data-bs-parent="#faq_q4_qt3">
                                <div class="block-content">
                                  <p><b>Strategy 1: Identify clause type on either side of the punctuation. </b></p>
                                  <p>Find the boundary between two clauses in the sentence (usually where the answer choices have different punctuation options). Identify the clause type to the left of the punctuation, then identify the clause type to the right of the punctuation. See which punctuation, if any, fits this combination of clauses or phrases.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt3_idmethods_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4_qt3" href="#faq_q4_qt3_idmethods" aria-expanded="true" aria-controls="faq_q4_qt3_idmethods">Identification Methods</a>
                              </div>
                              <div id="faq_q4_qt3_idmethods" class="collapse" role="tabpanel" aria-labelledby="faq_q4_qt3_idmethods_aria-label" data-bs-parent="#faq_q4_qt3">
                                <div class="block-content">
                                  <p><b>Identification Method 1</b></p>
                                  <p>The answer choices have punctuation that looks like the boundary between two clauses.
                                  </p>
                                  <p><b>Example 1</b></p>
                                  <p>Passage Excerpt: A..... <u>agility</u> h.......</p>
                                  <p>A. NO CHANGE</p>
                                  <p>B. .</p>
                                  <p>C. ..</p>
                                  <p>D. ..</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt3_idactivity_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4_qt3" href="#faq_q4_qt3_idactivity" aria-expanded="true" aria-controls="faq_q4_qt3_idactivity">Identification Activity</a>
                              </div>
                              <div id="faq_q4_qt3_idactivity" class="collapse" role="tabpanel" aria-labelledby="faq_q4_qt3_idactivity_aria-label" data-bs-parent="#faq_q4_qt3">
                                <div class="block-content">
                                  <p><b>Identification Activity 1</b></p>
                                  <p>Which of the following questions test Connecting Clauses?</p>

                                  <p>Question 1</p>
                                  <p>Question 2</p>

                                  <p>1. Part of his success is attributed to his ability to <u>plead</u> to a wide range of audiences.</p>

                                  <p>A. NO CHANGE</p>
                                  <p>B. appeal</p>
                                  <p>C. attract </p>
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
                                  <p>#2: No, even though this question tests different word choices, it does NOT test Punctuation Between Adjectives and Nouns. It tests Idioms and Prepositions.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q4qt4" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-lg fa-circle-xmark me-1"></i>
                  Punctuation Between Nouns &amp; Verbs
                </button>

                <!-- Punctuation Between Nouns modal design -->
                <div class="modal" id="modal-block-large-q4qt4" tabindex="-1" aria-labelledby="modal-block-large-q4qt4" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: Punctuation Between Nouns &amp; Verbs</h3>
                        </div>
                        <div class="block-content">
                          <div id="faq_q4_qt2" class="mb-5" role="tablist" aria-multiselectable="true">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <!-- Description Block -->
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt4_description_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4_qt4" href="#faq_q4_qt4_description" aria-expanded="true" aria-controls="faq_q4_qt4_description">Description</a>
                              </div>
                              <div id="faq_q4_qt4_description" class="collapse show" role="tabpanel" aria-labelledby="faq_q4_qt4_description_aria-label" data-bs-parent="#faq_q4_qt4">
                                <div class="block-content">
                                  <p>The Punctuation Between Nouns &amp; Verbs question type...</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt4_lesson_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4_qt4" href="#faq_q4_qt4_lesson" aria-expanded="true" aria-controls="faq_q4_qt4_lesson">Lesson</a>
                              </div>
                              <div id="faq_q4_qt4_lesson" class="collapse" role="tabpanel" aria-labelledby="faq_q4_qt4_lesson_aria-label" data-bs-parent="#faq_q4_qt4">
                                <div class="block-content">
                                  <p>Legend:
                                    <br>
                                    <u><b>Adjective</b></u>
                                    <br>
                                    <b>Noun</b>
                                  </p>
                                  <p><b>Coordinate Adjectives (Yes Comma)</b></p>
                                  <p>Punctuation Between Nouns &amp; Verbs ..... Situation 1: The punctuation between the noun and verb don't start a non-essential element and therefore the punctuation is NOT allowed.. Situation 2: The punctuation between the noun and verb don't start a non-essential element and therefore the punctuation is allowed.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt2_strategies_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4_qt4" href="#faq_q4_qt2_strategies" aria-expanded="true" aria-controls="faq_q4_qt4_strategies">Strategies</a>
                              </div>
                              <div id="faq_q4_qt4_strategies" class="collapse" role="tabpanel" aria-labelledby="faq_q4_qt4_strategies_aria-label" data-bs-parent="#faq_q4_qt4">
                                <div class="block-content">
                                  <p><b>Strategy 1: Look at the word types surrounding commas to see if the comma is surrounded by a noun and a verb. </b></p>
                                  <p>Find the boundary between two clauses in the sentence (usually where the answer choices have different punctuation options). Identify the clause type to the left of the punctuation, then identify the clause type to the right of the punctuation. See which punctuation, if any, fits this combination of clauses or phrases.</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt4_idmethods_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4_qt4" href="#faq_q4_qt4_idmethods" aria-expanded="true" aria-controls="faq_q4_qt4_idmethods">Identification Methods</a>
                              </div>
                              <div id="faq_q4_qt4_idmethods" class="collapse" role="tabpanel" aria-labelledby="faq_q4_qt4_idmethods_aria-label" data-bs-parent="#faq_q4_qt4">
                                <div class="block-content">
                                  <p><b>Identification Method 1</b></p>
                                  <p>The answer choices have punctuation that looks like the boundary between two clauses.
                                  </p>
                                  <p><b>Example 1</b></p>
                                  <p>Passage Excerpt: A..... <u>agility</u> h.......</p>
                                  <p>A. NO CHANGE</p>
                                  <p>B. .</p>
                                  <p>C. ..</p>
                                  <p>D. ..</p>
                                </div>
                              </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                              <div class="block-header block-header-default" role="tab" id="faq_q4_qt4_idactivity_aria-label">
                                <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq_q4_qt4" href="#faq_q4_qt4_idactivity" aria-expanded="true" aria-controls="faq_q4_qt4_idactivity">Identification Activity</a>
                              </div>
                              <div id="faq_q4_qt4_idactivity" class="collapse" role="tabpanel" aria-labelledby="faq_q4_qt4_idactivity_aria-label" data-bs-parent="#faq_q4_qt4">
                                <div class="block-content">
                                  <p><b>Identification Activity 1</b></p>
                                  <p>Which of the following questions test Connecting Clauses?</p>

                                  <p>Question 1</p>
                                  <p>Question 2</p>

                                  <p>1. Part of his success is attributed to his ability to <u>plead</u> to a wide range of audiences.</p>

                                  <p>A. NO CHANGE</p>
                                  <p>B. appeal</p>
                                  <p>C. attract </p>
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
                                  <p>#2: No, even though this question tests different word choices, it does NOT test Punctuation Between Adjectives and Nouns. It tests Idioms and Prepositions.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>

              <td>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q4ac1" class="btn btn-warning fs-xs fw-semibold me-1 mb-3 bg-warning-light text-warning">
                  <i class="fa fa-lg fa-circle-exclamation me-1"></i>
                  Must Use Comma After Introductory Prepositional Phrase
                </button>

                <!-- Must Use Comma After Introductory modal design -->
                <div class="modal" id="modal-block-large-q4ac1" tabindex="-1" aria-labelledby="modal-block-large-q4ac1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Answer Type: Must Use Comma After Introductory Prepositional Phrase</h3>
                        </div>
                        <div class="block-content">
                          <div class="row items-push">
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Description</h3>
                                <div class="block-options">
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p>Introductory Prepositional Phrases MUST have a comma to offset them from the rest of the sentence. Common prepositions that begin these phrases are "in", "at", and "from", as seen in the following examples:</p>
                                <p>In the morning, </p>
                                <p>At the train station, </p>
                                <p>From the beginning, </p>
                                <br>
                                <p>There are many other introductory prepositional phrases that you can see used throughout the ACT English section. Use these examples to get more familiar with the sentence structure that places a comma after an introductory prepositional phrase.
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                          <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-lg fa-circle-xmark me-1"></i>
                  Punctuation
                </button>

                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-lg fa-circle-xmark me-1"></i>
                  Commas
                </button>

                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-lg fa-circle-xmark me-1"></i>
                  If There's No Non-Essential Clause, Must NOT Use Punctuation Between Noun and Verb
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Must NOT Use Commas Between Cumulative Adjectives
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Cumulative Adjectives
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Must NOT Use Punctuation Between Adjectives and Nouns
                </button>
              </td>

              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-outline-secondary fs-xs dropdown-toggle" id="dropdown-default-outline-secondary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    SELECT
                  </button>
                  <div class="dropdown-menu fs-sm" aria-labelledby="dropdown-default-outline-secondary">
                    <a class="dropdown-item" href="javascript:void(0)">Content Misunderstanding</a>
                    <a class="dropdown-item" href="javascript:void(0)">Random Error</a>
                    <a class="dropdown-item" href="javascript:void(0)">Timing Issue</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0)">N/A</a>
                  </div>
                </div>
              </td>
            </tr>

            <!-- CONCEPT REVIEW Answer 5 -->
            <tr class="odd">
              <td class="text-center fs-sm dtr-control sorting_1" tabindex="0">5</td>

              <td class="fw-semibold fs-sm">A</td>

              <td class="fw-semibold fs-sm">C</td>

              <td>
                <i class="fa fa-lg fa-circle-xmark me-1" style="color:red"></i>
              </td>

              <td>
                <button type="button" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info-light text-info">
                  <i class="fa fa-fw fa-pencil me-1"></i>
                  REVIEW
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Sentence Structure &amp; Punctuation
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Punctuation &amp; Parts of Speech
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Connecting Clauses
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Punctuation &amp; Prepositions
                </button>

                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Essential &amp; Non-Essential Elements
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Punctuation
                </button>

                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Dashes
                </button>

                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Single Dash
                </button>

                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Commas
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-alt-secondary fs-xs fw-semibold me-1 mb-3 bg-secondary-light text-secondary">
                  <i class="si si-fw si-arrow-down me-1"></i>
                  Random Error
                </button>
              </td>
            </tr>

            <!-- CONCEPT REVIEW Answer 6 -->
            <tr class="even">
              <td class="text-center fs-sm dtr-control sorting_1" tabindex="0">6</td>

              <td class="fw-semibold fs-sm">H</td>

              <td class="fw-semibold fs-sm">F</td>

              <td>
                <i class="fa fa-lg fa-circle-xmark me-1" style="color:red"></i>
              </td>

              <td>
                <button type="button" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info-light text-info">
                  <i class="fa fa-fw fa-pencil me-1"></i>
                  REVIEW
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-alt-secondary fs-xs fw-semibold me-1 mb-3 bg-secondary-light text-secondary">
                  <i class="si si-fw si-arrow-down me-1"></i>
                  Random Error
                </button>
              </td>
            </tr>

            <!-- CONCEPT REVIEW Answer 7 -->
            <tr class="odd">
              <td class="text-center fs-sm dtr-control sorting_1" tabindex="0">7</td>

              <td class="fw-semibold fs-sm">A</td>

              <td class="fw-semibold fs-sm">C</td>

              <td>
                <i class="fa fa-lg fa-circle-xmark me-1" style="color:red"></i>
              </td>

              <td>
                <button type="button" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info-light text-info">
                  <i class="fa fa-fw fa-pencil me-1"></i>
                  REVIEW
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-alt-secondary fs-xs fw-semibold me-1 mb-3 bg-secondary-light text-secondary">
                  <i class="si si-fw si-arrow-down me-1"></i>
                  Random Error
                </button>
              </td>
            </tr>

            <!-- CONCEPT REVIEW Answer 8 -->
            <tr class="even">
              <td class="text-center fs-sm dtr-control sorting_1" tabindex="0">8</td>
              <td class="fw-semibold fs-sm">H</td>
              <td class="fw-semibold fs-sm">F</td>

              <td>
                <i class="fa fa-lg fa-circle-xmark me-1" style="color:red"></i>
              </td>

              <td>
                <button type="button" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info-light text-info">
                  <i class="fa fa-fw fa-pencil me-1"></i>
                  REVIEW
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-alt-secondary fs-xs fw-semibold me-1 mb-3 bg-secondary-light text-secondary">
                  <i class="si si-fw si-arrow-down me-1"></i>
                  Random Error
                </button>
              </td>
            </tr>

            <!-- CONCEPT REVIEW Answer 9 -->
            <tr class="odd">
              <td class="text-center fs-sm dtr-control sorting_1" tabindex="0">9</td>
              <td class="fw-semibold fs-sm">A</td>
              <td class="fw-semibold fs-sm">C</td>

              <td>
                <i class="fa fa-lg fa-circle-xmark me-1" style="color:red"></i>
              </td>

              <td>
                <button type="button" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info-light text-info">
                  <i class="fa fa-fw fa-pencil me-1"></i>
                  REVIEW
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-alt-secondary fs-xs fw-semibold me-1 mb-3 bg-secondary-light text-secondary">
                  <i class="si si-fw si-arrow-down me-1"></i>
                  Random Error
                </button>
              </td>
            </tr>

            <!-- CONCEPT REVIEW Answer 10 -->
            <tr class="even">
              <td class="text-center fs-sm dtr-control sorting_1" tabindex="0">10</td>
              <td class="fw-semibold fs-sm">H</td>
              <td class="fw-semibold fs-sm">F</td>

              <td>
                <i class="fa fa-lg fa-circle-xmark me-1" style="color:red"></i>
              </td>

              <td>
                <button type="button" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info-light text-info">
                  <i class="fa fa-fw fa-pencil me-1"></i>
                  REVIEW
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-alt-secondary fs-xs fw-semibold me-1 mb-3 bg-secondary-light text-secondary">
                  <i class="si si-fw si-arrow-down me-1"></i>
                  Random Error
                </button>
              </td>
            </tr>

            <!-- CONCEPT REVIEW Answer 11 -->
            <tr class="odd">
              <td class="text-center fs-sm dtr-control sorting_1" tabindex="0">11</td>
              <td class="fw-semibold fs-sm">A</td>
              <td class="fw-semibold fs-sm">C</td>

              <td>
                <i class="fa fa-lg fa-circle-xmark me-1" style="color:red"></i>
              </td>

              <td>
                <button type="button" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info-light text-info">
                  <i class="fa fa-fw fa-pencil me-1"></i>
                  REVIEW
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-alt-secondary fs-xs fw-semibold me-1 mb-3 bg-secondary-light text-secondary">
                  <i class="si si-fw si-arrow-down me-1"></i>
                  Random Error
                </button>
              </td>
            </tr>

            <!-- CONCEPT REVIEW Answer 12 -->
            <tr class="even">
              <td class="text-center fs-sm dtr-control sorting_1" tabindex="0">12</td>
              <td class="fw-semibold fs-sm">H</td>
              <td class="fw-semibold fs-sm">F</td>

              <td>
                <i class="fa fa-lg fa-circle-xmark me-1" style="color:red"></i>
              </td>

              <td>
                <button type="button" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info-light text-info">
                  <i class="fa fa-fw fa-pencil me-1"></i>
                  REVIEW
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-alt-secondary fs-xs fw-semibold me-1 mb-3 bg-secondary-light text-secondary">
                  <i class="si si-fw si-arrow-down me-1"></i>
                  Random Error
                </button>
              </td>
            </tr>

            <!-- CONCEPT REVIEW Answer 13 -->
            <tr class="odd">
              <td class="text-center fs-sm dtr-control sorting_1" tabindex="0">13</td>
              <td class="fw-semibold fs-sm">A</td>
              <td class="fw-semibold fs-sm">C</td>

              <td>
                <i class="fa fa-lg fa-circle-xmark me-1" style="color:red"></i>
              </td>

              <td>
                <button type="button" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info-light text-info">
                  <i class="fa fa-fw fa-pencil me-1"></i>
                  REVIEW
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-alt-secondary fs-xs fw-semibold me-1 mb-3 bg-secondary-light text-secondary">
                  <i class="si si-fw si-arrow-down me-1"></i>
                  Random Error
                </button>
              </td>
            </tr>

            <!-- CONCEPT REVIEW Answer 14 -->
            <tr class="even">
              <td class="text-center fs-sm dtr-control sorting_1" tabindex="0">14</td>
              <td class="fw-semibold fs-sm">H</td>
              <td class="fw-semibold fs-sm">F</td>

              <td>
                <i class="fa fa-lg fa-circle-xmark me-1" style="color:red"></i>
              </td>

              <td>
                <button type="button" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info-light text-info">
                  <i class="fa fa-fw fa-pencil me-1"></i>
                  REVIEW
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Dashes
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-alt-secondary fs-xs fw-semibold me-1 mb-3 bg-secondary-light text-secondary">
                  <i class="si si-fw si-arrow-down me-1"></i>
                  Random Error
                </button>
              </td>
            </tr>

            <!-- CONCEPT REVIEW Answer 15 -->
            <tr class="odd">
              <td class="text-center fs-sm dtr-control sorting_1" tabindex="0">15</td>
              <td class="fw-semibold fs-sm">A</td>
              <td class="fw-semibold fs-sm">C</td>

              <td>
                <i class="fa fa-lg fa-circle-xmark me-1" style="color:red"></i>
              </td>

              <td>
                <button type="button" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info-light text-info">
                  <i class="fa fa-fw fa-pencil me-1"></i>
                  REVIEW
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-danger fs-xs fw-semibold me-1 mb-3 bg-danger-light text-danger">
                  <i class="fa fa-fw fa-circle-xmark me-1"></i>
                  Word Choice
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-alt-secondary fs-xs fw-semibold me-1 mb-3 bg-secondary-light text-secondary">
                  <i class="si si-fw si-arrow-down me-1"></i>
                  Random Error
                </button>
              </td>
            </tr>

            <!-- CONCEPT REVIEW Answer 16 -->
            <tr class="even">
              <td class="text-center fs-sm dtr-control sorting_1" tabindex="0">16</td>
              <td class="fw-semibold fs-sm">G</td>
              <td class="fw-semibold fs-sm">G</td>

              <td>
                <i class="fa fa-lg fa-circle-check me-1" style="color:green"></i>
              </td>

              <td>
                <button type="button" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info-light text-info">
                  <i class="fa fa-fw fa-pencil me-1"></i>
                  REVIEW
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Transition Words &amp; Phrases
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Transition Words &amp; Phrases
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Word Choice
                </button>

                <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                  <i class="fa fa-fw fa-circle-check me-1"></i>
                  Transition Words &amp; Phrases
                </button>
              </td>

              <td>
                <button type="button" class="btn btn-alt-secondary fs-xs fw-semibold me-1 mb-3 bg-secondary-light text-secondary">
                  <i class="si si-fw si-arrow-down me-1"></i>
                  N/A
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- END Table 3 -->
  </div>
</main>
<!-- END Main Container -->
@endsection

@section('page-style')
<style>
  .content {
    width: 90%;
  }

  .input-check {
    position: absolute;
    top: 145px;
    right: 64px;
  }

  .block-header {
    justify-content: start;
    /* padding: 0; */
  }

  .js-table-sections-header.show>tr>td:first-child>i .js-table-checkable tbody tr,
  .js-table-sections-header>tr {
    cursor: pointer;
  }

  .js-table-sections-header>tr>td:first-child>i {

    transition: transform 0.15s ease-out;
  }

  .js-table-sections-header tbody {
    display: none;
  }

  .js-table-sections-header .show>tr>td:first-child>i {
    transform: rotate(90deg);
  }

  .js-table-sections-header .show tbody {
    display: table-row-group;
  }
</style>
@endsection