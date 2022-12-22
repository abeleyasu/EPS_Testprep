@extends('layouts.user')

@section('title', 'Student View Dashboard : CPS')

@section('page-script')
<script>
  $(document).ready(function() {
    $("#categoryQuestion1").click(function() {
      $(this).toggleClass("show");
    });
  });

  $('input[type="checkbox"]').click(function(e) {
    e.stopPropagation()
  })
</script>
@endsection

@section('user-content')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- Main Container -->
<main id="main-container">
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-2">
            {{$get_test_name}}
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

    @if($test_category_type[0]->category_type != '' )
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

                <button type="button" data-bs-toggle="modal"  data-bs-target="#modal-block-large-cg1ct1" class="btn btn-dark fs-xs fw-semibold me-1 mb-3 categories-name" data-category-type="<?php echo $test_category_type[0]->category_type;  ?>">{{$test_category_type[0]->category_type}}</button>

                <!-- Opens Modal - Has Modal Content - CATEGORY -->

                <div class="modal" id="modal-block-large-cg1ct1" tabindex="-1" aria-labelledby="modal-block-large-cg1ct1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <!-- Blocks API, functionality initialized in Template._uiApiBlocks() -->
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Category:<span class="set_category_type"> {{$test_category_type[0]->category_type}}</span></h3>
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
                
                <?php
                $store_correct_answer = 0;
                $store_wrong_answer = 0;
                $total_question = 0;
                $store_test_score = 0;
                if(isset($set_get_question_category) && !empty($set_get_question_category))
                {
                  foreach($set_get_question_category as $test_question_type => $single_set_get_question_category)
                  {
                    foreach($single_set_get_question_category as $single_question_id)
                    {
                      foreach($user_selected_answers as $single_answer_user_selected)
                      {
                        if($single_question_id == $single_answer_user_selected['get_question_details'][0]->question_id)
                        {
                          if($single_answer_user_selected['user_selected_answer'] == $single_answer_user_selected['get_question_details'][0]->question_answer)
                          {
                            $store_correct_answer++;
                          }
                          else
                          {
                            $store_wrong_answer++;
                          }
                        }
                      }
                    }
                  }
                } 
                $store_test_score += $store_correct_answer;
                $total_question += $store_correct_answer + $store_wrong_answer;
                $get_test_bar_percentage = ($store_test_score/$total_question) * 100;
                $get_main_test_type_for_bar =  str_replace(' ', '', $test_category_type[0]->category_type);
                 ?>
                 <script>
                  jQuery(document).ready(function(){
                    /**
                     * progress bar for main test
                     */
                      var get_test_type = '<?php echo $get_main_test_type_for_bar; ?>';
                      var testnewWidth = jQuery("."+get_test_type+"").data('test_id_bar')+"%";
                      jQuery("."+get_test_type+"").width(testnewWidth);

                    /** END */
                    jQuery('.sentence-structure').click(function(){
                        var get_question_type = jQuery(this).data('question-type');
                        jQuery(".set_question_type").text(get_question_type);
                    });
                    jQuery('.categories-name').click(function(){
                      var get_category_type = jQuery(this).data('category-type');
                      jQuery(".set_category_type").text(get_category_type);
                      
                    });
                  });
                  
                </script>

                 <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar bg-dark <?php echo $get_main_test_type_for_bar; ?>" role="progressbar" data-test_id_bar="<?php echo $get_test_bar_percentage; ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height:8px; width:0%">
                  </div>
                </div>
                <div class="text-center text-danger">
                <?php echo $store_test_score; ?>/<?php echo $total_question; ?> Incorrect
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
          @foreach($set_get_question_category as $test_question_type => $single_set_get_question_category)
            <tr>
              <td class="text-center"></td>
              <td>
                <button type="button" class="btn btn-primary fs-xs fw-semibold me-1 mb-3" >Question Type</button>
              </td>
              <td class="fw-semibold fs-sm">

                <!-- NEW Modal Button that initiates opening QUESTION TYPE Modal -->

                <button type="button" data-bs-toggle="modal"  data-bs-target="#modal-block-large-cg1qt1" class="btn btn-primary fs-xs fw-semibold me-1 mb-3 sentence-structure" data-question-type="<?php echo $test_question_type; ?>">{{$test_question_type}}</button>

                <!-- Opens Modal - Has Modal Content - QUESTION TYPE -->
                <div class="modal" id="modal-block-large-cg1qt1" tabindex="-1" aria-labelledby="modal-block-large-cg1qt1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question Type: <span class="set_question_type">{{$test_question_type}}<span></h3>
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
                
                <?php 
                $store_correct_answer = 0;
                $store_wrong_answer = 0;
                $total_question = 0;
                
                $get_test_type_for_bar =  str_replace(' ', '', $test_question_type);
                if(isset($single_set_get_question_category) && !empty($single_set_get_question_category))
                {
                  foreach($single_set_get_question_category as $single_question_id)
                  {
                    foreach($user_selected_answers as $single_answer_user_selected)
                    {
                      if($single_question_id == $single_answer_user_selected['get_question_details'][0]->question_id)
                      {
                        if($single_answer_user_selected['user_selected_answer'] == $single_answer_user_selected['get_question_details'][0]->question_answer)
                        {
                          $store_correct_answer++;
                        }
                        else
                        {
                          $store_wrong_answer++;
                        }
                      }
                    }
                  }
                }
                $total_question = $store_correct_answer + $store_wrong_answer;
                $get_bar_percentage = ($store_correct_answer/$total_question) * 100;
                ?>
                <script>
                jQuery(document).ready(function(){
                  var get_question_type = '<?php echo $get_test_type_for_bar; ?>';
                  var newWidth = jQuery("."+get_question_type+"").data('question_id_bar')+"%";
                  console.log(newWidth);
                  console.log(get_question_type);
                  jQuery("."+get_question_type+"").width(newWidth);
                });
                </script>
                <div class="progress fw-semibold fs-sm" style="height:8px; color:success">
                  <div class="progress-bar <?php echo $get_test_type_for_bar; ?>" data-question_id_bar="<?php echo $get_bar_percentage; ?>" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="height:8px; width: 0%;">
                  </div>
                </div>
                <div class="text-center text-danger">
                <?php echo $store_correct_answer; ?>/<?php echo $total_question; ?> Incorrect
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
            @endforeach
          </tbody>
          
          <!-- END CATEGORY GROUP 1: Sentence Structure & Punctuation -->
          
          
          
        
        </table>

      </div>
    </div>
    @endif
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
                    $.each(get_answers_exp, function( index, value ) {
                      
                      var new_txt = removeTags(value);
                      $("div").find('[data-option='+index+']').html( $( "<p>"+value+"</p>" ) );
                    });
                    if($(this ).data('option-value') == 'a')
                    {
                      $(this).addClass('active');
                     
                    }
                    
                    var option_value = $(this ).data('option-value');
                    if(jQuery.inArray(option_value, array_correct) != -1)
                    {
                        $(this).removeClass('bg-city-dark');
                        $(this).removeClass('bg-success');
                        $(this).removeClass('bg-danger');
                        $(this).addClass('bg-success');
                    }
                    else if(jQuery.inArray(option_value, array_user_answer) != -1)
                    {
                      $(this).addClass('bg-danger');
                      $(this).addClass('text-gray');
                      $(this).removeClass('bg-success');
                      $(this).removeClass('bg-city-dark');
                    }
                    else 
                    {
                       $(this).removeClass('bg-success');
                        $(this).addClass('text-gray');
                        $(this).addClass('bg-city-dark');
                    }
                    
                      // if(get_correct_answer == $(this ).data('option-value') )
                      // {
                      //   $(this).removeClass('bg-city-dark');
                      //   $(this).removeClass('bg-success');
                      //   $(this).removeClass('bg-danger');
                      //   $(this).addClass('bg-success');
                      // }
                      // else if(get_user_answer == $(this ).data('option-value') )
                      // {
                         
                      //   $(this).addClass('bg-danger');
                      //   $(this).addClass('text-gray');
                      //   $(this).removeClass('bg-success');
                      //   $(this).removeClass('bg-city-dark');
                        
                      // }
                      // else
                      // {
                      //   $(this).removeClass('bg-success');
                      //   $(this).addClass('text-gray');
                      //   $(this).addClass('bg-city-dark');
                      // }
                  });
                   
                });
              });
          </script>

          <?php
             $count = 1;
             //dd($user_selected_answers);
            ?>
             
            @foreach($user_selected_answers as $key => $single_user_selected_answers)

            <?php
              // echo "<pre>";
              // print_r(json_decode($single_user_selected_answers['get_question_details'][0]->question_answer_options));
              // ech<o "</pre>";
              // echo "<pre>";
              // print_r($key);
              // print_r($single_user_selected_answers);
              // echo "</pre>";
            ?>
              
              <tr class="odd">
              <td class="text-center fs-sm dtr-control sorting_1" tabindex="0">
                {{$count++}}
                <i class="fa fa-fw fa-flag me-1" style="color:red"></i>
                <i class="fa fa-fw fa-circle-question me-1" style="color:blue"></i>
                <i style="color:black" class="fa fa-fw fa-forward me-1"></i>
              </td>

              <td class="fw-semibold fs-sm">{{$single_user_selected_answers['user_selected_answer']}}</td>

              <td class="fw-semibold fs-sm">{{$single_user_selected_answers['get_question_details'][0]->question_answer}}</td>
              
              <?php $correct =  str_replace(' ', '', $single_user_selected_answers['get_question_details'][0]->question_answer); ?>
              @if($single_user_selected_answers['user_selected_answer'] == $correct)
              <td>
                <i class="fa fa-lg fa-circle-check me-1" style="color:green"></i>
              </td>
              @else
              <td>
                <i class="fa fa-lg fa-circle-xmark me-1" style="color:red"></i>
              </td>
              @endif

              <td>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-block-large-q1r" class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info-light text-info"  data-question-title="{{$single_user_selected_answers['get_question_details'][0]->question_title}}" data-passage-title="{{$single_user_selected_answers['get_question_details'][0]->title}}" data-correct-answer = "{{$single_user_selected_answers['get_question_details'][0]->question_answer}}" data-user-answer = "{{$single_user_selected_answers['user_selected_answer']}}" data-answers-exp="{{($single_user_selected_answers['get_question_details'][0]->question_answer_options)}}" data-serial-no = "{{$key + 1}}" ><i class="fa fa-lg fa-pencil me-1"></i>REVIEW</button>

                <!-- review modal design -->
                
                <div class="modal" id="modal-block-large-q1r" tabindex="-1" aria-labelledby="modal-block-large-q1r" style="display: none;" aria-hidden="true">
                
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="block block-rounded">
                        <div class="block-header block-header-default">
                          <h3 class="block-title">Question <span class="set_serial_no">{{$key + 1}}</span> Review</h3>
                        </div>
                        <div class="block-content">
                          <div class="row items-push">
                            <!-- PASSAGE I design -->
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Passage <span class="set_serial_no">{{$key + 1}}</span> </h3>
                                <div class="block-options">
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p class="set_passage_title">{{$single_user_selected_answers['get_question_details'][0]->title}}</p>
                              </div>
                            </div>

                            <!-- Question 1 design -->
                            <div id="my-block" class="block block-rounded block-bordered">
                              <div class="block-header block-header-default">
                                <h3 class="block-title">Question <span class="set_serial_no">{{$key + 1}}</span> </h3>
                                <div class="block-options">
                                  <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                              </div>
                              <div class="block-content">
                                <p class="set_question_title">{{strip_tags($single_user_selected_answers['get_question_details'][0]->question_title)}}</p>
                              </div>
                            </div>

                            <!-- Answer Choices Tabs design -->
                            <div class="block block-rounded">
                              <ul class="nav nav-tabs nav-tabs-alt" role="tablist">
                                <li class="nav-item">
                                  <button class="nav-link active bg-success text-gray" id="btabs-alt-static-home-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q1a" role="tab" aria-controls="btabs-alt-static-home" data-option-value='a' aria-selected="true">Answer A</button>
                                </li>
                                <li class="nav-item">
                                  <button class="nav-link bg-danger text-gray" id="btabs-alt-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q1b" role="tab" aria-controls="btabs-alt-static-profile" data-option-value='b' aria-selected="false">Answer B</button>
                                </li>
                                <li class="nav-item">
                                  <button class="nav-link bg-city-dark text-gray" id="btabs-alt-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q1c" role="tab" aria-controls="btabs-alt-static-profile" data-option-value='c' aria-selected="false">Answer C</button>
                                </li>
                                <li class="nav-item">
                                  <button class="nav-link bg-city-dark text-gray" id="btabs-alt-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-alt-static-q1d" role="tab" aria-controls="btabs-alt-static-profile" data-option-value='d' aria-selected="false">Answer D</button>
                                </li>
                              </ul>
                              <div class="block-content tab-content">

                                <!-- Answer 1 tab -->
                                <div class="tab-pane active" id="btabs-alt-static-q1a" data-option="0" role="tabpanel" aria-labelledby="btabs-alt-static-home-tab">
                                  <!-- <p>NO CHANGE: intricately</p> -->
                                  <!-- <p>
                                    <b>Explanation: </b>“Intricately” means “complicated or detailed”, which emphasizes the complexity of the paper sculptures.
                                  </p> -->
                                </div>

                                <!-- Answer 2 tab -->
                                <div class="tab-pane" id="btabs-alt-static-q1b" data-option="1" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                  <!-- <p>impressively</p> -->
                                  <!-- <p>
                                    <b>Explanation: </b>“Impressively” means “showing skill”, which is likely describing the sculptor’s skill instead of the complexity of the paper sculptures.
                                  </p> -->

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
                                <div class="tab-pane" id="btabs-alt-static-q1c" data-option="2" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                  <!-- <p>terrifically</p> -->
                                  <!-- <p>
                                    <b>Explanation: </b>“Terrifically” means “done in an extraordinary way”, which is describing how awe-inspiring the paper sculptures are, but is not specific enough to describe their complexity.
                                  </p> -->

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
                                <div class="tab-pane" id="btabs-alt-static-q1d"  data-option="3" role="tabpanel" aria-labelledby="btabs-alt-static-profile-tab">
                                  <!-- <p>superbly</p> -->
                                  <!-- <p>
                                    <b>Explanation: </b>“Superbly” means “done in an extraordinary way”, which is describing how awe-inspiring the paper sculptures are, but is not specific enough to describe their complexity.
                                  </p> -->

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
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!-- END Table 3 -->
    <!-- <button type="button" style=" float: right;" disabled class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
              <a class="fw-medium" href="">Return to all sections</a>
    </button> -->
    <?php
    

    $get_test_id = $_GET['test_id'];

    ?>
    
    <div class="justify-content-end d-flex mb-4">
      <a href="{{route('single_test', ['id' => $get_test_id])}}" class="btn btn-alt-success">
      <i class="fa-solid fa-arrow-left" style='margin-right:5px'></i> Return to all sections
    </a>
    </div>

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