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
                    <button type="button" class="btn btn-sm btn-outline-info fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-list-check me-1"></i>Review</button>
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
                            <textarea class="form-control" id="passage_description" name="example-textarea-input" rows="4" placeholder="Textarea content..">The first prehistoric avian bird of its kind was discovered in Antarctica in December of the year 2032. Its unique features, which include an obvious membranous extension to its fin and a fold in its flight-bends, put its scientific discovery into the same realms as that of Darwin's fin-flap animal. This incredible bird is a truly remarkable feat. It was discovered in deep waters in the Beaufort Gyre, an area of the southern ocean that is one of the most important underwater ecosystems for biological discovery, in a collection of fossils that span the entire 400 million year history of the animal.
                      Notably, this remarkable feat is the result of a scientific exploration by veteran experts in Antarctic science who are passionate about the advancement of paleoceanography. 
                      Astronaut Dr. Stephen Wright joins Bryan Johnson to detail the remarkable life and legacy of Dr. Frank White, a scientist who spent 32 days in space, leaving behind much scientific knowledge. It is estimated that at least 500 additional species of plant and animal have now been discovered. This volume documents that entire collection of scientific specimens from Dr. White, who is considered the father of modern scientific exploration.</textarea>
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
                    <button type="button" class="btn btn-sm btn-outline-info fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-list-check me-1"></i>Review</button>
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
<style>
    .content {
        width: 90%;
    }
</style>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
</script>
<script>
         jQuery(document).ready(function(){

            var selected_answer = [];
            var selected_gusess_details = [];
            var selected_flag_details = [];
            var get_offset = jQuery('#get_offset').val();
            
            var getSelectedAnswer ;
            var check_click_type = 'onload';
            jQuery(".prev").click(function(){
                var get_offset = jQuery(this).val();
                var get_question_id = jQuery('.get_question_id').val();

                if($("input[name='example-radios-default']").is(':checked')) { 
                    var getSelectedAnswer = $("input[name='example-radios-default']:checked").val();
                    selected_answer[get_question_id] = getSelectedAnswer;
                }
                else if($("input[name='example-checkbox-default']").is(':checked')) { 
                    var store_multi = '';
                    $('input[name="example-checkbox-default"]:checked').each(function() {
                        console.log(this.value);
                        store_multi += this.value+','; 
                    });
                    store_multi = store_multi.replace(/,\s*$/, "");
                    selected_answer[get_question_id] = store_multi;
                }
                else
                {
                    selected_answer[get_question_id] = '-';
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
            });
            
            jQuery(".skip").click(function(){
                var get_offset = jQuery(this).val();
                var get_question_id = jQuery('.get_question_id').val();

                if($("input[name='example-radios-default']").is(':checked')) { 
                    var getSelectedAnswer = $("input[name='example-radios-default']:checked").val();
                    selected_answer[get_question_id] = getSelectedAnswer;
                }
                else if($("input[name='example-checkbox-default']").is(':checked')) { 
                    var store_multi = '';
                    $('input[name="example-checkbox-default"]:checked').each(function() {
                        console.log(this.value);
                        store_multi += this.value+','; 
                    });
                    store_multi = store_multi.replace(/,\s*$/, "");
                    selected_answer[get_question_id] = store_multi;
                }
                else
                {
                    selected_answer[get_question_id] = '-';
                }
                
                get_first_question(get_offset);
            });

            jQuery(".next").click(function(){
                var get_offset = jQuery(this).val();
                var get_question_id = jQuery('.get_question_id').val();

                if($("input[name='example-radios-default']").is(':checked')) { 
                    var getSelectedAnswer = $("input[name='example-radios-default']:checked").val();
                    selected_answer[get_question_id] = getSelectedAnswer;
                }
                else if($("input[name='example-checkbox-default']").is(':checked')) { 
                    var store_multi = '';
                    $('input[name="example-checkbox-default"]:checked').each(function() {
                        console.log(this.value);
                        store_multi += this.value+','; 
                    });
                    store_multi = store_multi.replace(/,\s*$/, "");
                    selected_answer[get_question_id] = store_multi;
                }
                else
                {
                    selected_answer[get_question_id] = '-';
                }

                if(!$(".guess").is(':checked'))
                {
                    selected_gusess_details[get_question_id] = 'no';
                }

                if(!$(".flag").is(':checked'))
                {
                    selected_flag_details[get_question_id] = 'no';
                }
                console.log(selected_gusess_details);
                get_first_question(get_offset);
            });

            jQuery(".guess").click(function(){
                var get_question_id = jQuery('.get_question_id').val();
                if( $(this).is(':checked') ){

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
            });
                    
            jQuery(".flag").click(function(){
                var get_question_id = jQuery('.get_question_id').val();
                if( $(this).is(':checked') ){
                    $('.main_flag_section').css("color", "white");
                    $('.main_flag_section').css("background-color", "#dc2626");
                    selected_flag_details[get_question_id] = 'yes';
                }
                else{
                    $('.main_flag_section').css("color", "#dc2626");
                    $('.main_flag_section').css("background-color", "white");
                    selected_flag_details[get_question_id] = 'no';
                }
            });
            
            
            
            jQuery(".submit_section_btn").click(function(){
                var get_question_id = jQuery('.get_question_id').val();
                var get_section_id = jQuery('#section_id').val();
                var get_question_type = jQuery('#get_question_type').val();
                var get_test_id = '';
                if (window.location.href.indexOf("all") > -1)
                {
                    console.log('if');
                    var url = window.location.href,
                    parts = url.split("/"),
                    last_part = parts[parts.length-1];
                    console.log(last_part);
                     get_test_id = last_part;
                }
                
                else
                {
                    const urlParams = new URLSearchParams(window.location.search);
                     get_test_id = urlParams.get('test_id');
                }
                
                if($("input[name='example-radios-default']").is(':checked')) { 
                    var getSelectedAnswer = $("input[name='example-radios-default']:checked").val();
                    selected_answer[get_question_id] = getSelectedAnswer;
                }
                else if($("input[name='example-checkbox-default']").is(':checked')) { 
                    var store_multi = '';
                    $('input[name="example-checkbox-default"]:checked').each(function() {
                        console.log(this.value);
                        store_multi += this.value+','; 
                    });
                    store_multi = store_multi.replace(/,\s*$/, "");
                    selected_answer[get_question_id] = store_multi;
                }
                else
                {
                    selected_answer[get_question_id] = '-';
                }

                if(!$(".guess").is(':checked'))
                {
                    selected_gusess_details[get_question_id] = 'no';
                }

                if(!$(".flag").is(':checked'))
                {
                    selected_flag_details[get_question_id] = 'no';
                }
              
                console.log(selected_answer);
                console.log(get_section_id);
                console.log(selected_gusess_details);
                console.log(selected_flag_details);
                //return false;
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
                        get_question_type:get_question_type
                    },
                    success: function(result){
                        console.log(result.success);
                        console.log(result.get_test_name);
                        console.log(result.section_id);
                        console.log(get_test_id);
                        var url = "{{url('')}}"+'/user/practice-tests/'+result.get_test_name+'/'+result.section_id+'/review-page?test_id='+get_test_id+'&type='+result.get_test_type;
                        window.location.href = url;
                        
                }});
                console.log(get_test_id);
            });
            
            
            get_first_question(get_offset);
            function get_first_question(get_offset)
            {
                console.log(selected_answer);
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
                        console.log(result);
                        
                        var check_if_flag_selected = selected_flag_details[result.questions[0].question_id];
                        var check_if_guess_selected = selected_gusess_details[result.questions[0].question_id];
                        
                        var passage_type = 'PASSAGE TYPE: '+ result.questions[0].passage_type;
                        var passage_title =  result.questions[0].passage_title;
                        var passage_description =  result.questions[0].passage_description;
                        
                        passage_description = passage_description.replace(/(<([^>]+)>)/gi, "");
                        var set_passage_type = '<strong>'+passage_type+'</strong><br />'+passage_title+'';

                        var get_question_title = result.questions[0].question_title;
                        get_question_title = result.questions[0].question_title.replace(/(<([^>]+)>)/gi, "");

                        var get_question_no = parseInt(result.get_offset) + 1;

                        var set_questions_options = '<div class="mb-4">';
                        set_questions_options += '<input type="hidden" value="'+result.questions[0].question_id+'" class="get_question_id" ><label class="form-label">Question '+get_question_no+' '+get_question_title+'</label>';

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
                    
                        jQuery('#set_question_data').html(set_questions_options);
                        jQuery('#passage_type').text(passage_type);
                        jQuery('#passage_title').text(passage_title);
                        jQuery('#passage_description').text(passage_description);
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
                            jQuery('.submit_section_btn').prop('disabled', true);
                            
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