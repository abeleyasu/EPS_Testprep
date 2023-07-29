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
  $(document).on('click','.start_section',function(){
    let section_id = $(this).attr('data-section_id');
    let test_id = $(this).attr('data-test_id');
    let option = $('#timingOption').val();
    let url = $('#site_url').val();
    $('.start_section').attr('href',`${url}/user/practice-test/${section_id}?test_id=${test_id}&time=${option}`);
  });

  $(document).on('click','.start_all_section',function(){
    let sectionArrayJson = $('#sectionArrayJsonId').val();
    var sectionArray = JSON.parse(sectionArrayJson);
    
    if (sectionArray.length > 0) {
      var section_id = sectionArray[0];
      var next_section_id = (sectionArray.length > 1) ? sectionArray[1] : '';
      
      // Remove the first value
      sectionArray.shift();
      let remainingSectionArrayJson = JSON.stringify(sectionArray);

      let test_id = $(this).attr('data-test_id');
      let option = $('#timingOption').val();
      let url = $('#site_url').val();
      // $('.start_all_section').attr('href',`${url}/user/practice-test/all/${test_id}?time=${option}`);
      $('.start_all_section').attr('href',`${url}/user/practice-test/${section_id}?test_id=${test_id}&time=${option}&section=all&sections=${remainingSectionArrayJson}`);
      // $('.start_all_section').attr('href',`${url}/user/practice-test/all/${section_id}?time=${option}`);
    }
    
  });
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
                        <a class="link-fx text-dark" href="{{ url('user/test-prep-dashboard') }}">Practice Tests</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">College Prep System {{ isset($testSection[0]->format) ? $testSection[0]->format : '' }} {{ isset($testSection[0]->title) ? $testSection[0]->title : '' }} {{ isset($testSection[0]->id) ? '#'. $testSection[0]->id : '' }}</a>
                    </li>
                    {{-- <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Sections</a>
                    </li> --}}
                </ol>
            </nav>
        </div>
        </div>
        <!-- Hero -->
        @if(isset($testSectionName) && !$testSectionName == 0)
        <div class="bg-body-light">
          <div class="content content-boxed">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
              <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                <span class='text-primary'>{{$testSectionName}}</span> sections
                </h1>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="w-75">
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                      This test has {{$get_total_sections}} sections and {{isset($total_all_section_question) ? $total_all_section_question : ''}} questions
                    
                    </h2>
                    {{-- <h6 class="fs-6 mb-0 test-description text-muted mt-2">
                      {!! isset($testSection[0]->description) ? $testSection[0]->description : '' !!}
                    </h6> --}}
                  </div>
                  @if ($testSection[0]->test_source == '2')
                    <select id="timingOption" class="select-menu">
                      <option value="untimed">Untimed</option>
                    </select>
                  @else
                    <select id="timingOption" class="select-menu">
                      <option value="regular">Regular Time</option>
                      <option value="50per">50% Extended Time</option>
                      <option value="100per">100% Extended Time</option>
                      <option value="untimed">Untimed</option>
                    </select>
                  @endif 
                @if($check_test_completed == 'yes')
                  @if (isset($testSections[0]) && !empty($testSections[0]))
                    <a  href="{{route('single_review', ['test' => $testSections[0]->title , 'id' => $testSections[0]->testid ]) . '?test_id=' . $testSections[0]->testid.'&type=all' }}" style="margin-right: 10px;white-space: nowrap" class="btn btn-alt-primary fs-8 ms-2">
                      <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Review All Sections
                    </a>
                    <a  href="{{route('reset_test', ['id' => $testSections[0]->id ]) . '?test_id=' . $testSections[0]->testid.'&type=all' }}" style="white-space: nowrap" class="btn btn-alt-primary fs-8 ">
                      <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Reset Test
                    </a>
                  @endif
                @elseif($check_test_completed == 'Yes')
                  <a  href="#" style="white-space: nowrap" data-test_id="{{ $selected_test_id }}" class="btn btn-alt-primary fs-8  ms-2 start_all_section" >
                    <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Start All Sections
                  </a>
                  <a  href="{{route('reset_test', ['id' => $testSections[0]->id ]) . '?test_id=' . $testSections[0]->testid.'&type=all' }}" style="white-space: nowrap" class="btn btn-alt-primary fs-8 mx-2">
                    <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Reset Test
                  </a>
                @else
                  <a  href="{{route('all_section', ['id' => $selected_test_id])}}" style="" class="btn btn-alt-primary fs-8">
                    <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Start All Sections
                  </a> 
                @endif
                
                </div>
              </div>
            </div>
          </div>
        </div>
        @elseif(isset($testSections) && $testSections == 0)
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

        <?php
          $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] 
          === 'on' ? "https" : "http") . 
          "://" . $_SERVER['HTTP_HOST'] . 
          $_SERVER['REQUEST_URI'];
          $link_array = explode('/',$url); 
          $current_section_id = end($link_array);
          

        ?>
        <!-- Page Content -->
        <div class="content content-boxed">
          <!-- Timeline -->

        {{-- start Description  --}}
          <h6 class="fs-6 mb-3 p-2 test-description text-muted mt-2">
              {!! isset($testSection[0]->description) ? $testSection[0]->description : '' !!}
          </h6>
        {{-- end Description --}}

          @if(isset($testSections) && !$testSections == 0)
          <ul class="timeline timeline-alt" style='padding: 0'>
          <?php  $count = 0; ?>
          
            @php
                $sectionArray = [];
            @endphp
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
                      
                      @if(isset($singletestSections['Sections_question']))
                     
                        @if(isset($singletestSections['check_if_section_completed']) && $singletestSections['check_if_section_completed'][0] == 'yes')
                       
                        <div>
                          <a href="#"  
                              style='padding: 5px 20px fs-5'
                              class="btn btn-alt-success text-success">
                              {{$score[$singletestSections['Sections'][0]['id']]}}
                            </a>
                          <a href="{{route('single_review', ['test' => $singletestSections['Sections'][0]['title'] , 'id' => $singletestSections['Sections'][0]['id']]) . '?test_id=' . $current_section_id .'&type=single' }}"  
                            style='padding: 5px 20px fs-5'
                             class="btn btn-alt-success text-success">
                            <i class="fa-solid fa-circle-check" style='margin-right:5px'></i>
                            Review Section
                            {{-- Review {{str_replace(['_'],[' '],$singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                          </a>
  
                          {{-- new  --}}
                          <a href="{{route('reset_section', ['testId' => $singletestSections['Sections'][0]['testid'] , 'id' => $singletestSections['Sections'][0]['id']]) }}"  
                            style='padding: 5px 20px fs-5'
                             class="btn btn-alt-success text-success">
                            <i class="fa-solid fa-circle-check" style='margin-right:5px'></i>
                            Reset
                            {{-- Review {{str_replace(['_'],[' '],$singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                          </a>
                        </div>
                        

                        @else
                        <a href="{{route('single_section', ['id' => $singletestSections['Sections'][0]['id']]) . '?test_id=' . $current_section_id}}" 
                          style="padding: 5px 20px fs-5" class="btn btn-alt-secondary text-primary start_section" data-section_id="{{$singletestSections['Sections'][0]['id']}}" data-test_id="{{$current_section_id}}">
                          {{-- Start {{str_replace(['_'],[' '], $singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                          <i class="fa-solid fa-circle-check" style='margin-right:5px'></i> Start Section
                        </a>
                        @php
                            array_push($sectionArray, (int)$singletestSections['Sections'][0]['id']);
                        @endphp

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

            <input type="hidden" name="sectionArrayJson" id="sectionArrayJsonId" value="<?php echo htmlspecialchars(json_encode($sectionArray), JSON_NUMERIC_CHECK);?>">

            <li class="timeline-event">
              {{-- <div class="timeline-event-icon bg-success"> --}}
                {{-- <i class="fa-solid fa-{{++$count}}"></i> --}}
              {{-- </div> --}}
              <div class="timeline-event-block block">
                <div class="block-header block-header-default">
                  <h3 class="block-title">COMPOSITE SCORE</h3>
                </div>
                <hr class="m-0">
                <div class="block-content pb-3 d-flex justify-content-center align-items-center">
                  @if($check_test_completed == 'yes')
                    <a href="#"  
                    style='padding: 5px 20px fs-5'
                    class="btn btn-alt-success text-success">
                    {{ number_format($total_score, 0)}}
                    </a>
                  @endif
                </div>
              </div>
            </li>
          </ul>
          @elseif(isset($testSections) && $testSections == 0)
          <div class="timeline-event-time block-options-item fs-sm fw-semibold text-danger">
               No Sections Added yet!
          </div>
          @endif
          
          
          {{-- <div class="d-flex justify-content-end">
            <a  href="{{route('all_section', ['id' => $selected_test_id]).'?test_id='.$current_section_id}}" style="" class="btn w-25 btn-alt-danger">
              <i class="fa fa-fw  me-1 opacity-50"></i> Start All Sections
            </a>
          </div> --}}
        
          
         
          <!-- END Timeline -->
        </div>
        <!-- END Page Content -->
      </main>
<!-- END Main Container -->
<script>
  function resetTest(data){
    alert(data);
  }
</script>
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
  .content-boxed{
    overflow: hidden !important;
   }

  .select-menu{
    width: 240px;
    border-radius: 6px;
    padding: 7px 15px;
    background: #f6f6f6;
    font-size: 16px;
    color: #313131;
    font-weight: 500;
    border: 1px solid #bcbcbc
  }
  
</style>
@endsection