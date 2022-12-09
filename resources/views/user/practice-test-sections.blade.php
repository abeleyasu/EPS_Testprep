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
<!-- Main Container -->
<main id="main-container">
        <div class="bg-body-light">
        <div class="content content-boxed">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx text-dark" href="be_pages_elearning_courses.html">Practice Tests</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">College Prep System SAT Practice Test #1</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Sections</a>
                    </li>
                </ol>
            </nav>
        </div>
        </div>
        <!-- Hero -->
        @if(!$testSectionName == 0)
        <div class="bg-body-light">
          <div class="content content-boxed">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
              <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                <span class='text-primary'>{{$testSectionName}}</span> sections
                </h1>
                <div class="d-flex justify-content-between align-items-center">
                  <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                
                  This test has {{$get_total_sections}} sections and {{$get_total_questions}} questions
                
                </h2>
                <a  href="{{route('all_section', ['id' => $selected_test_id])}}" style="" class="btn btn-alt-primary fs-8">
                  <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Start All Sections
                </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        @elseif($testSections == 0)
        <div class="bg-body-light">
          <div class="content content-boxed">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
              <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                  Undefined section
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                 
                </h2>
              </div>
            </div>
          </div>
        </div>
        @endif
        <!-- END Hero -->


        <!-- Page Content -->
        <div class="content content-boxed">
          <!-- Timeline -->
          <!--
              Available classes for timeline list:

              'timeline'                                      A normal timeline with icons to the left in all screens
              'timeline timeline-centered timeline-alt'       A centered timeline with odd events to the left and even events to the right (screen width > 1200px)
              'timeline timeline-centered'                    A centered timeline with all events to the left. You can add the class 'timeline-event-alt'
                                                              to 'timeline-event' elements to position them to the right (screen width > 1200px) (useful, if you
                                                              would like to have multiple events to the left or to the right section)
          -->

          
          @if(!$testSections == 0)
          <ul class="timeline timeline-alt" style='padding: 0'>
          <?php  $count = 0; ?>
          @foreach($testSectionsDetails as $singletestSections)
            <!-- START SECTION -->
            <li class="timeline-event">
              <div class="timeline-event-icon bg-success">
                <i class="fa-solid fa-{{++$count}}"></i>
              </div>
              <div class="timeline-event-block block">
                <div class="block-header block-header-default">
                  <h3 class="block-title">{{str_replace(['_'],[' '],$singletestSections['Sections'][0]['practice_test_type'])}} Section</h3>
                  <div class="block-options">
                  
                  @if(isset($singletestSections['Sections_question']))
                    <div class="timeline-event-time block-options-item fs-sm fw-semibold">
                        {{count($singletestSections['Sections_question'])}} Questions 
                    </div>
                    @elseif(!isset($singletestSections['Sections_question']))
                    <div class="timeline-event-time block-options-item fs-sm fw-semibold">
                        0 Questions 
                    </div>
                    @endif
                  </div>
                </div>
                <div class="block-content pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        Start {{str_replace(['_'],[' '],$singletestSections['Sections'][0]['practice_test_type'])}} Section Questions
                        
                      </div>
                      <?php
                        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] 
                        === 'on' ? "https" : "http") . 
                        "://" . $_SERVER['HTTP_HOST'] . 
                        $_SERVER['REQUEST_URI'];
                        $link_array = explode('/',$url); 
                        $current_section_id = end($link_array);
                      ?>
                      @if(isset($singletestSections['Sections_question']))
                     
                        @if(isset($singletestSections['check_if_section_completed']) && $singletestSections['check_if_section_completed'][0] == 'yes')
                       

                        <a href="{{route('single_review', ['test' => $singletestSections['Sections'][0]['title'] , 'id' => $singletestSections['Sections'][0]['id']]) . '?test_id=' . $current_section_id }}" 
                          style='padding: 5px 20px fs-5'
                           class="btn btn-alt-success text-success">
                          <i class="fa-solid fa-circle-check" style='margin-right:5px'></i>
                          Review Section
                          {{-- Review {{str_replace(['_'],[' '],$singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                        </a>
                        

                        @else
                        <a href="{{route('single_section', ['id' => $singletestSections['Sections'][0]['id']]) . '?test_id=' . $current_section_id}}" 
                          style="padding: 5px 20px fs-5" class="btn btn-alt-secondary text-primary">
                          {{-- Start {{str_replace(['_'],[' '], $singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                          <i class="fa-solid fa-circle-check" style='margin-right:5px'></i> Start Section
                        </a>

                        @endif
                      @elseif(!isset($singletestSections['Sections_question']))
                     
                      <a href="#" style="" class="btn btn-alt-secondary">
                          {{-- <i class="fa fa-fw  me-1 opacity-50"></i> Start {{ str_replace(['_'],[' '],$singletestSections['Sections'][0]['practice_test_type']) }} Section --}}
                          <i class="fa-solid fa-timer" style='margin-right:5px'></i> Start Section
                        </a>
                      @endif
                      
                    </div>
                </div>
              </div>
            </li>
            <!-- END SECTION -->

            @endforeach

          </ul>
          @elseif($testSections == 0)
          <div class="timeline-event-time block-options-item fs-sm fw-semibold">
               No Sections Added yet!
          </div>
          @endif
          {{-- <div class="d-flex justify-content-end">
            <a  href="{{route('all_section', ['id' => $selected_test_id])}}" style="" class="btn w-25 btn-alt-danger">
              <i class="fa fa-fw  me-1 opacity-50"></i> Start All Sections
            </a>
          </div> --}}
          <!-- END Timeline -->
        </div>
        <!-- END Page Content -->
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