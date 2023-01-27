@extends('layouts.user')

@section('title', 'practice-test : CPS')

@section('user-content')
<meta name="_token" content="{{csrf_token()}}" />
<style>
.checkbox-button {
  appearance: none;
  background-color: #fff;
  border: 1px solid #000;
  border-radius: 4px;
  box-sizing: border-box;
  display: inline-block;
  font-size: 16px;
  padding: 3px 8px;
  position: relative;
  vertical-align: middle;
  border:  solid #ea580c;
}

.checkbox-button input[type="checkbox"] {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  opacity: 0;
  cursor: pointer;
  
}

.checkbox-button.main_guess_section:hover {
    background-color: #ea580c;
}

.checkbox-button:hover {
  cursor: pointer;
}

.scroll_target{
    height: 110px;
     overflow: auto;
}


</style>

<!-- Main Container -->
<main id="main-container">
    <div class="bg-body-light">
        <div class="content content-boxed py-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx text-dark" href="be_pages_elearning_courses.html">Practice Tests</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">College Prep System SAT Practice Test #1</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="bg-body-extra-light">
        <div class="content content-boxed py-3">
            <div class="row">
                <div class="col-xl-4">
                    <button type="button" class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3 prev"><i class="fa fa-fw fa-arrow-left me-1"></i>Previous</button>
                    <button type="button" class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3 next">Next<i class="fa fa-fw fa-arrow-right me-1"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-info fs-xs fw-semibold me-1 mb-3 review"><i class="fa fa-fw fa-list-check me-1"></i>Review</button>
                    <button type="button" class="btn btn-sm btn-dark fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-clock me-1"></i> 35:12</button>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="section_id" value="{{$section_id}}">
    <input type="hidden" id="get_offset" value="{{$set_offset}}">
    <input type="hidden" id="get_question_type" value="{{$question_type}}">
    <!-- Page Content -->
    <div class="content content-boxed">
        <div class="row">
            <div class="col-xl-6">
                <!-- Lessons -->
                <div class="block block-rounded">
                    <div class="block-content fs-sm">

                        <h5 class="h5 mb-4">
                            PASSAGE I
                        </h5>
                        <h5 class="h5 mb-4" >
                            <strong id="passage_type">PASSAGE TYPE: NATURAL SCIENCE</strong><br /><span id="passage_title">This is adapted from author Blah.</span>
                        </h5>
                        <div class="mb-4">
                            <div id="passage_description" class="form-control scroll_target"></div>
                            {{-- <textarea  class="form-control scroll_target"  name="example-textarea-input" id="passage_description_content"  placeholder="Textarea content..">The first prehistoric avian bird of its kind was discovered in Antarctica in December of the year 2032. Its unique features, which include an obvious membranous extension to its fin and a fold in its flight-bends, put its scientific discovery into the same realms as that of Darwin's fin-flap animal. This incredible bird is a truly remarkable feat. It was discovered in deep waters in the Beaufort Gyre, an area of the southern ocean that is one of the most important underwater ecosystems for biological discovery, in a collection of fossils that span the entire 400 million year history of the animal.
                      Notably, this remarkable feat is the result of a scientific exploration by veteran experts in Antarctic science who are passionate about the advancement of paleoceanography. 
                      Astronaut Dr. Stephen Wright joins Bryan Johnson to detail the remarkable life and legacy of Dr. Frank White, a scientist who spent 32 days in space, leaving behind much scientific knowledge. It is estimated that at least 500 additional species of plant and animal have now been discovered. This volume documents that entire collection of scientific specimens from Dr. White, who is considered the father of modern scientific exploration.</textarea> --}}
                        </div>
                        <div class="output">

                        </div>
                    </div>
                </div>
                <!-- END Lessons -->
            </div>
            <div class="col-xl-6" id="set_question_data">

                <!-- Question -->
                
                <!-- END Subscribe -->


            </div>
        </div>
    </div>
    <!-- END Page Conten    t -->
    <!-- Navigation -->
    <div class="bg-body-extra-light">
        <div class="content content-boxed py-3">
            <div class="row">
                <div class="col-xl-4">
                    <button type="button" id="get_previous_question_btn" value="" class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3 prev"><i class="fa fa-fw fa-arrow-left me-1"></i>Previous</button>
                    <button type="button" id="get_next_question_btn" value="" class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3 next">Next<i class="fa fa-fw fa-arrow-right me-1"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-info fs-xs fw-semibold me-1 mb-3 review"><i class="fa fa-fw fa-list-check me-1"></i>Review</button>
                    <button type="button" class="btn btn-sm btn-dark fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-clock me-1"></i> 35:12</button>
                </div>
                <div class="col-xl-4">
                    <!-- <button type="button" class="btn btn-sm btn-outline-danger fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-flag me-1" style="color:red"></i>Flag</button> -->
                    
                    <!-- <button type="button" id= "btn_guess" class="btn btn-sm btn-outline-warning fs-xs fw-semibold me-1 mb-3 guess"><i class="fa fa-fw fa-circle-question me-1"></i>Guess</button> -->
                    <label class="btn btn-sm btn-outline-danger fs-xs fw-semibold me-1 mb-3 checkbox-button main_flag_section">
                        <input type="checkbox" class="flag" />
                        <span><i class="fa fa-fw fa-flag me-1" style="color:red"></i>Flag</span>
                    </label>

                    <button type="button" id="get_skip_question_btn" class="btn btn-sm btn-outline-info fs-xs fw-semibold me-1 mb-3 skip"><i class="fa fa-fw fa-forward me-1"></i>Skip</button>

                    <label class="btn btn-sm btn-outline-warning fs-xs fw-semibold me-1 mb-3 checkbox-button main_guess_section">
                        <input type="checkbox" class="guess" />
                        <span><i class="fa fa-fw fa-circle-question me-1"></i>Guess</span>
                    </label>

                    <button type="button" class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-calculator me-1" style="color:black"></i>Calculator</button>
                </div>
                <div class="col-xl-4">
                    <button type="button" disabled class="btn btn-sm btn-outline-success fs-xs fw-semibold me-1 mb-3 submit_section_btn"><i class="fa fa-fw fa-circle-check me-1"></i>Submit Section</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Navigation -->
</main>
<!-- END Main Container -->
@endsection

@section('page-style')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<style>
    .content {
        width: 90%;
    }
</style>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
         jQuery(document).ready(function(){
            var selected_answer = [];
            var selected_gusess_details = [];
            var selected_flag_details = [];
            var selected_skip_details = [];
            var get_offset = jQuery('#get_offset').val();
            
            var getSelectedAnswer ;
            var check_click_type = 'onload';
            get_first_question(get_offset);

            $('.content').on('click', 'input[name=example-radios-default]:radio', function() {
                var get_question_id = jQuery('.get_question_id').val();
                $('.skip').css("color", "#0891b2");
                $('.skip').css("background-color", "white");
                selected_skip_details[get_question_id] = 'no';
            });
            jQuery(".prev").click(function(){
                var get_offset = jQuery(this).val();
                var get_question_id = jQuery('.get_question_id').val();
                var set_scroll_position=0;

                if($("input[name='example-radios-default']").is(':checked')) { 
                    var getSelectedAnswer = $("input[name='example-radios-default']:checked").val();
                    selected_answer[get_question_id] = getSelectedAnswer;
                    selected_skip_details[get_question_id] = 'no';
                } else if($("input[name='example-checkbox-default']").is(':checked')) { 
                    var store_multi = '';
                    $('input[name="example-checkbox-default"]:checked').each(function() {
                        console.log(this.value);
                        store_multi += this.value+','; 
                    });
                    store_multi = store_multi.replace(/,\s*$/, "");
                    selected_answer[get_question_id] = store_multi;
                    selected_skip_details[get_question_id] = 'no';
                } else {
                    selected_answer[get_question_id] = '-';
                    selected_skip_details[get_question_id] = 'yes';
                }

                if(!$(".guess").is(':checked'))
                {
                    selected_gusess_details[get_question_id] = 'no';
                }

                if(!$(".flag").is(':checked'))
                {
                    selected_flag_details[get_question_id] = 'no';
                }
                
                var check_click_type = 'prev';
                
                get_first_question(get_offset);

                var scroll_id = jQuery('.get_question_id').val();
                scroll_id = scroll_id -1;

                $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
                });

                jQuery.ajax({
                    url: "{{ url('/user/get_scroll_position/post') }}",
                    method: 'post',
                    data: {
                        get_question_id:scroll_id,
                    },
                    success: function(result){
                        var element = document.querySelector('#passage_description');
                        set_scroll_position = result.scroll_position[0].scroll_position;
                        element.scrollTop = set_scroll_position;
                      
                        
                }});

            });
            
            jQuery(".skip").click(function(){
                var get_offset = jQuery(this).val();
                var get_question_id = jQuery('.get_question_id').val();

                if ( $('input:radio[name=example-radios-default]').length ) {
                    $('input:radio[name=example-radios-default]').prop('checked', false);
                    selected_skip_details[get_question_id] = 'no';
                } else {
                    $('input[type=checkbox]').prop('checked', false);
                    selected_skip_details[get_question_id] = 'no';
                }

                $('.skip').css("color", "white");
                $('.skip').css("background-color", "#0891b2");
                if($("input[name='example-radios-default']").is(':checked')) { 
                    var getSelectedAnswer = $("input[name='example-radios-default']:checked").val();
                    selected_answer[get_question_id] = getSelectedAnswer;
                    selected_skip_details[get_question_id] = 'no';
                } else if($("input[name='example-checkbox-default']").is(':checked')) { 
                    var store_multi = '';
                    $('input[name="example-checkbox-default"]:checked').each(function() {
                        console.log(this.value);
                        store_multi += this.value+','; 
                    });
                    store_multi = store_multi.replace(/,\s*$/, "");
                    selected_answer[get_question_id] = store_multi;
                    selected_skip_details[get_question_id] = 'no';
                } else {
                    selected_answer[get_question_id] = '-';
                    selected_skip_details[get_question_id] = 'yes';
                }

                if(!$(".guess").is(':checked'))
                {
                    selected_gusess_details[get_question_id] = 'no';
                }

                if(!$(".flag").is(':checked'))
                {
                    selected_flag_details[get_question_id] = 'no';
                }
                get_first_question(get_offset);
            });
            
            var count = 1;
            jQuery(".next").click(function(){
                var get_offset = jQuery(this).val();
                var get_question_id = jQuery('.get_question_id').val();

                if($("input[name='example-radios-default']").is(':checked')) { 
                    count ++;
                    var getSelectedAnswer = $("input[name='example-radios-default']:checked").val();
                    selected_answer[get_question_id] = getSelectedAnswer;
                    selected_skip_details[get_question_id] = 'no';
                } else if($("input[name='example-checkbox-default']").is(':checked')) { 
                    count ++;
                    var store_multi = '';
                    $('input[name="example-checkbox-default"]:checked').each(function() {
                        console.log(this.value);
                        store_multi += this.value+','; 
                    });
                    store_multi = store_multi.replace(/,\s*$/, "");
                    selected_answer[get_question_id] = store_multi;
                    selected_skip_details[get_question_id] = 'no';
                }
                // else
                // {
                //     selected_answer[get_question_id] = '-';
                //     selected_skip_details[get_question_id] = 'yes';
                //     $("#set_question_data").find('.mb-4').append('<span class="custom_error" style="color:red;" >Please pick any option!</span>');
                //     setTimeout(function() { $(".custom_error").remove(); }, 5000);
                //     return false;
                // }

                if(!$(".guess").is(':checked'))
                {
                    selected_gusess_details[get_question_id] = 'no';
                }

                if(!$(".flag").is(':checked'))
                {
                    selected_flag_details[get_question_id] = 'no';
                }
                get_first_question(get_offset);

                var scroll_position = $('#passage_description').scrollTop();
    
                $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
                });

                jQuery.ajax({
                    url: "{{ url('/user/set_scroll_position/post') }}",
                    method: 'post',
                    data: {
                        get_question_id:get_question_id,
                        scroll_position:scroll_position
                    },
                    success: function(result){
                        
                }});

                
            });

            jQuery(".guess").click(function(){
                var get_question_id = jQuery('.get_question_id').val();
                if( $(this).is(':checked') ){

                    $('.skip').css("color", "#0891b2");
                    $('.skip').css("background-color", "white");
                    selected_skip_details[get_question_id] = 'no';

                    $('.main_guess_section').css("color", "white");
                    $('.main_guess_section').css("background-color", "#ea580c");
                    var randOption = Math.floor(Math.random() * 4);

                    if ( $('input:radio[name=example-radios-default]').length ) {
                        $('input:radio[name=example-radios-default]')[randOption].checked = true;
                    }
                    else{
                        $('input[type=checkbox]')[randOption].checked = true;
                    }
                    
                    var getSelectedAnswer = $("input[name='example-radios-default']:checked").val();
                    selected_gusess_details[get_question_id] = 'yes';
                }else{

                    if ( $('input:radio[name=example-radios-default]').length ) {
                        $('input:radio[name=example-radios-default]').prop('checked', false);
                    }
                    else{
                        $('input[type=checkbox]').prop('checked', false);
                    }
                    selected_gusess_details[get_question_id] = 'no';
                    $('.main_guess_section').css("color", "#ea580c");
                    $('.main_guess_section').css("background-color", "white");
                }

                if(!$(".flag").is(':checked'))
                {
                    selected_flag_details[get_question_id] = 'no';
                }

                if(!$(".skip").is(':checked'))
                {
                    selected_skip_details[get_question_id] = 'no';
                }
            });
                    
            jQuery(".flag").click(function(){
                var get_question_id = jQuery('.get_question_id').val();
                if( $(this).is(':checked') ){
                    $('.main_flag_section').css("color", "white");
                    $('.main_flag_section').css("background-color", "#dc2626");
                    selected_flag_details[get_question_id] = 'yes';
                } else{
                    $('.main_flag_section').css("color", "#dc2626");
                    $('.main_flag_section').css("background-color", "white");
                    selected_flag_details[get_question_id] = 'no';
                }

                if(!$(".guess").is(':checked'))
                {
                    selected_gusess_details[get_question_id] = 'no';
                }

                if(!$(".skip").is(':checked'))
                {
                    selected_skip_details[get_question_id] = 'no';
                }
            });

            jQuery(".review").click(function(){
                selected_flag_details = selected_flag_details.filter(function( element, key ) {
                    return element !== "undefined";
                });
                selected_gusess_details = selected_gusess_details.filter(function( element, key ) {
                    return element !== "undefined";
                });
                selected_skip_details = selected_skip_details.filter(function( element, key ) {
                    return element !== "undefined";
                });
                var current_question_id = $('.next').val();
                // console.table("selected_flag_details", selected_flag_details);
                // console.table("selected_gusess_details", selected_gusess_details);
                // console.table("selected_skip_details", selected_skip_details);
                let my_arr = []
                let totalFlag = 0;
                let totalSkip = 0;
                let totalGuess = 0;

                for (let index = 0; index < selected_flag_details.length; index++) {
                    my_arr[index] = { 
                        "flag" : selected_flag_details[index],
                        "guess" : selected_gusess_details[index],
                        "skip" : selected_skip_details[index]
                    }
                }
                my_arr.forEach(element => {
                    if(element.flag == 'yes')
                        totalFlag++

                    if(element.skip == 'yes')
                        totalSkip++

                    if(element.guess == 'yes')
                        totalGuess++
                });
                if(current_question_id==1 && !totalFlag && !totalGuess && !totalSkip)
                {
                    var alert_data={                        
                        title: "You didn’t answer all questions do you want to review section now ?",
                        // text: "You didn’t answer all questions do you want to review section now ?",
                        type: "info",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes",
                        cancelButtonText: "Cancel",
                        closeOnConfirm: false,
                        closeOnCancel: true,
                        index:true,
                    }
                    var reviewCount={
                        flag:totalFlag,
                        skip:totalSkip,
                        guess:totalGuess
                    }
                }
                else
                {
                    var alert_data={
                        title: "Review Details",
                        text: "Flag :- "+totalFlag+","+"Skip :- "+totalSkip+","+"Guess :- "+totalGuess,
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Cancel",
                        cancelButtonText: "Cancel",
                        closeOnConfirm: true,
                        closeOnCancel: false,
                        index:false,
                    };                
                }
                sweet_alert(alert_data,reviewCount);
            });
            function sweet_alert(data,review){
                swal({
                        title: data.title,
                        text: data.text,
                        type: data.type,
                        showCancelButton: data.showCancelButton,
                        confirmButtonColor:data.confirmButtonColor,
                        confirmButtonText: data.confirmButtonText,
                        cancelButtonText:data.cancelButtonText,
                        closeOnConfirm: data.closeOnConfirm,
                        closeOnCancel: data.closeOnCancel
                    },(resp) => {
                        if(data.index && resp){
                            swal({
                                title: "Review Details",
                                text: "Flag :- "+review.flag+","+"Skip :- "+review.skip+","+"Guess :- "+review.guess,
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Cancel",
                                cancelButtonText: "Cancel",
                                closeOnConfirm: true,
                                closeOnCancel: false,
                                index:false,
                            })
                        }
                    });
                    
            }
            
            jQuery(".submit_section_btn").click(function(){
                var get_question_id = jQuery('.get_question_id').val();
                var get_section_id = jQuery('#section_id').val();
                var get_question_type = jQuery('#get_question_type').val();
                var get_practice_id = jQuery(this).attr('data-practice_test_id');
                var get_test_id = '';
                if (window.location.href.indexOf("all") > -1)
                {
                    console.log('if');
                    var url = window.location.href,
                    parts = url.split("/"),
                    last_part = parts[parts.length-1];
                    console.log(last_part);
                     get_test_id = last_part;
                }else
                {
                    const urlParams = new URLSearchParams(window.location.search);
                     get_test_id = urlParams.get('test_id');
                }
                
                if($("input[name='example-radios-default']").is(':checked')) { 
                    var getSelectedAnswer = $("input[name='example-radios-default']:checked").val();
                    selected_answer[get_question_id] = getSelectedAnswer;
                    selected_skip_details[get_question_id] = 'no';
                }
                else if($("input[name='example-checkbox-default']").is(':checked')) { 
                    var store_multi = '';
                    $('input[name="example-checkbox-default"]:checked').each(function() {
                        console.log(this.value);
                        store_multi += this.value+','; 
                    });
                    store_multi = store_multi.replace(/,\s*$/, "");
                    selected_answer[get_question_id] = store_multi;
                    selected_skip_details[get_question_id] = 'no';
                }
                else
                {
                    selected_answer[get_question_id] = '-';
                    selected_skip_details[get_question_id] = 'yes';
                }

                if(!$(".guess").is(':checked'))
                {
                    selected_gusess_details[get_question_id] = 'no';
                }

                if(!$(".flag").is(':checked'))
                {
                    selected_flag_details[get_question_id] = 'no';
                }
              
                $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
                });

                jQuery.ajax({
                    url: "{{ url('/user/set_user_question_answer/post') }}",
                    method: 'post',
                    data: {
                        selected_answer:selected_answer,
                        selected_gusess_details:selected_gusess_details,
                        selected_flag_details:selected_flag_details,
                        get_section_id:get_section_id,
                        get_practice_id:get_practice_id,
                        get_question_type:get_question_type
                    },
                    success: function(result){
                        if(count < result.total_question){
                            window.alert("Are you sure you want to submit this test? Make sure you have answered every question using the Review button.");
                        }
                        console.log(result.success);
                        console.log(result.get_test_name);
                        console.log(result.section_id);
                        console.log(get_test_id);
                        var url = "{{url('')}}"+'/user/practice-tests/'+result.get_test_name+'/'+result.section_id+'/review-page?test_id='+get_test_id+'&type='+result.get_test_type;
                        window.location.href = url;
                        
                }});
                console.log(get_test_id);
            });
            function get_first_question(get_offset)
            {
                // console.log(selected_answer);
                $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
                });
                jQuery.ajax({
                    url: "{{ url('/user/get_section_questions/post') }}",
                    method: 'post',
                    data: {
                        section_id: jQuery('#section_id').val(),
                        question_type: jQuery('#get_question_type').val(),
                        get_offset: get_offset,
                    },
                    success: function(result){
                        $('.submit_section_btn').attr('data-practice_test_id', result.practice_test_id);
                        var check_if_flag_selected = selected_flag_details[result.questions[0].question_id];
                        var check_if_guess_selected = selected_gusess_details[result.questions[0].question_id];
                        var check_if_skip_selected = selected_skip_details[result.questions[0].question_id];
                        
                        var passage_type = 'PASSAGE TYPE: '+ result.questions[0].passage_type;
                        var passage_title =  result.questions[0].passage_title;
                        var passage_description =  result.questions[0].passage_description;
                        // passage_description = passage_description.replace(/(<([^>]+)>)/gi, "");
                        // passage_description = passage_description.replace(/(<([^>]+)>)/gi, "");
                        var set_passage_type = '<strong>'+passage_type+'</strong><br />'+passage_title+'';

                        var get_question_title = result.questions[0].question_title;
                        get_question_title = result.questions[0].question_title.replace(/(<([^>]+)>)/gi, "");
                        var get_question_no = parseInt(result.get_offset) + 1;

                        var set_questions_options = '<div class="mb-4">';
                        set_questions_options += '<input type="hidden" value="'+result.questions[0].question_id+'" class="get_question_id" ><label class="form-label" >Question '+get_question_no+' '+get_question_title+'</label>';

                        var get_options = result.questions[0].question_answer_options.replace(/(<([^>]+)>)/gi, "");
                        
                        jQuery.each(JSON.parse(get_options), function (key,val) {
                           var get_option_number = 'A';
                           if(key == 0)
                           {
                            get_option_number = 'a';
                           }
                           else if(key == 1)
                           {
                            get_option_number = 'b';
                           }
                           else if(key == 2)
                           {
                            get_option_number = 'c';
                           }
                           else if(key == 3)
                           {
                            get_option_number = 'd';
                           }

                           if(selected_answer[result.questions[0].question_id] !== '' && selected_answer[result.questions[0].question_id] !== undefined )
                           {
                                if(jQuery.type(result.questions[0].is_multiple_choice) == 'null')
                                {
                                    if(selected_answer[result.questions[0].question_id] == get_option_number )
                                    {
                                        set_questions_options += '<div class="space-y-2">';
                                        set_questions_options += '<div class="form-check"><input class="form-check-input" type="radio" id="'+get_option_number+'" name="example-radios-default" value="'+get_option_number+'" checked ><label class="form-check-label" for="'+get_option_number+'">'+get_option_number.toUpperCase()+'. '+val+'</label></div></div>'
                                    }
                                    else
                                    {
                                        set_questions_options += '<div class="space-y-2">';
                                        set_questions_options += '<div class="form-check"><input class="form-check-input" type="radio" id="'+get_option_number+'" name="example-radios-default" value="'+get_option_number+'"><label class="form-check-label" for="'+get_option_number+'">'+get_option_number.toUpperCase()+'. '+val+'</label></div></div>'
                                    }
                                }
                                else
                                {
                                    var array = selected_answer[result.questions[0].question_id].split(',');
                                    if(jQuery.inArray(get_option_number, array) == -1)
                                    {
                                        set_questions_options += '<div class="space-y-2">';
                                        set_questions_options += '<div class="form-check"><input class="form-check-input" type="checkbox" id="'+get_option_number+'" name="example-checkbox-default"  value="'+get_option_number+'"><label class="form-check-label" for="'+get_option_number+'">'+get_option_number.toUpperCase()+'. '+val+'</label></div></div>';
                                    }
                                    
                                    $.each(array, function( index, value ) {
                                       if(value == get_option_number)
                                       {
                                            set_questions_options += '<div class="space-y-2">';
                                            set_questions_options += '<div class="form-check"><input class="form-check-input" type="checkbox" id="'+get_option_number+'" name="example-checkbox-default" checked value="'+get_option_number+'"><label class="form-check-label" for="'+get_option_number+'">'+get_option_number.toUpperCase()+'. '+val+'</label></div></div>'
                                       }
                                    });
                                }
                           }
                           else
                           {
                                if(jQuery.type(result.questions[0].is_multiple_choice) == 'null')
                                {
                                    set_questions_options += '<div class="space-y-2">';
                                    set_questions_options += '<div class="form-check"><input class="form-check-input" type="radio" id="'+get_option_number+'" name="example-radios-default" value="'+get_option_number+'"><label class="form-check-label" for="'+get_option_number+'">'+get_option_number.toUpperCase()+'. '+val+'</label></div></div>'
                                }
                                else
                                {
                                    set_questions_options += '<div class="space-y-2">';
                                    set_questions_options += '<div class="form-check"><input class="form-check-input" type="checkbox" id="'+get_option_number+'" name="example-checkbox-default" value="'+get_option_number+'"><label class="form-check-label" for="'+get_option_number+'">'+get_option_number.toUpperCase()+'. '+val+'</label></div></div>'
                                }
                                
                           }
                            
                        });

                        set_questions_options += '</div>';

                        if(check_if_flag_selected === undefined || check_if_flag_selected == 'no' )
                        {
                            $('.flag').prop('checked', false);
                            $('.main_flag_section').css("color", "#dc2626");
                            $('.main_flag_section').css("background-color", "white");
                        }else{
                            $('.flag').prop('checked', true);
                            $('.main_flag_section').css("color", "white");
                            $('.main_flag_section').css("background-color", "#dc2626");
                        }
                    
                        if(check_if_guess_selected === undefined || check_if_guess_selected == 'no')
                        {
                            $('.guess').prop('checked', false);
                            $('.main_guess_section').css("color", "#ea580c");
                            $('.main_guess_section').css("background-color", "white");
                        }else{
                            $('.guess').prop('checked', true);
                            $('.main_guess_section').css("color", "white");
                            $('.main_guess_section').css("background-color", "#ea580c");
                        }

                        console.log('-----');
                        console.log(check_if_skip_selected);
                        if(check_if_skip_selected === undefined || check_if_skip_selected == 'no')
                        {
                            $('.skip').css("color", "#0891b2");
                            $('.skip').css("background-color", "white");
                        }else{
                            $('.skip').css("color", "white");
                            $('.skip').css("background-color", "#0891b2");
                        }

                        jQuery('#set_question_data').html(set_questions_options);
                        jQuery('#passage_type').text(passage_type);
                        jQuery('#passage_title').text(passage_title);
                        // jQuery('#passage_description').text(passage_description);                   
                        var $editor = $("#passage_description");
                            
                        $editor.html(passage_description)
                                .attr('contenteditable', true)
                                .height($editor.height());



                        jQuery('#get_offset').val(result.get_offset);

                        if(result.set_prev_offset < 0)
                        {
                            jQuery('#get_previous_question_btn').prop('disabled', true);
                            jQuery('.prev').prop('disabled', true);      
                        }
                        else
                        {
                            jQuery('#get_previous_question_btn').prop('disabled', false);
                            jQuery('.prev').prop('disabled', false);    
                        }

                        if(result.set_next_offset >= result.total_question )
                        {
                            jQuery('#get_next_question_btn').prop('disabled', true);
                            jQuery('#get_skip_question_btn').prop('disabled', true);
                            
                            jQuery('.next').prop('disabled', true);
                            jQuery('.submit_section_btn').prop('disabled', false);
                            jQuery('.skip').prop('disabled', true);
                        }
                        else
                        {
                            jQuery('#get_next_question_btn').prop('disabled', false);
                            jQuery('#get_skip_question_btn').prop('disabled', false);

                            jQuery('.next').prop('disabled', false);
                            jQuery('.submit_section_btn').prop('disabled', false);
                            jQuery('.skip').prop('disabled', false);
                        }
                        
                        jQuery('#get_next_question_btn').val(result.set_next_offset);
                        jQuery('.next').val(result.set_next_offset);
                        jQuery('.skip').val(result.set_next_offset);

                        jQuery('#get_previous_question_btn').val(result.set_prev_offset);
                        jQuery('.prev').val(result.set_prev_offset);
                }});
            }
        });
</script>
@endsection