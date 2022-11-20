@extends('layouts.user')

@section('title', 'practice-test : CPS')

@section('user-content')
<meta name="_token" content="{{csrf_token()}}" />
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
    <input type="hidden" id="section_id" value="{{$id}}">
    <input type="hidden" id="get_offset" value="{{$set_offset}}">
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
    <!-- END Page Content -->
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
                    <button type="button" class="btn btn-sm btn-outline-danger fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-flag me-1" style="color:red"></i>Flag</button>
                    <button type="button" class="btn btn-sm btn-outline-info fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-forward me-1"></i>Skip</button>
                    <button type="button" class="btn btn-sm btn-outline-warning fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-circle-question me-1"></i>Guess</button>
                    <button type="button" class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-calculator me-1" style="color:black"></i>Calculator</button>
                </div>
                <div class="col-xl-4">
                    <button type="button" class="btn btn-sm btn-outline-success fs-xs fw-semibold me-1 mb-3"><i class="fa fa-fw fa-circle-check me-1"></i>Submit Section</button>
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
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
</script>
<script>
         jQuery(document).ready(function(){
            console.log($('meta[name="_token"]').attr('content'));
            var get_offset = jQuery('#get_offset').val();

            
            jQuery(".prev").click(function(){
                console.log(jQuery(this).val());
                var get_offset = jQuery(this).val();
                var getSelectedAnswer = $("input[name='example-radios-default']:checked").val();
                console.log(getSelectedAnswer);
                get_first_question(get_offset);
            });
            jQuery(".next").click(function(){
                console.log(jQuery(this).val());
                var get_offset = jQuery(this).val();

                var getSelectedAnswer = $("input[name='example-radios-default']:checked").val();
                console.log(getSelectedAnswer);
                get_first_question(get_offset);
            });
            
            get_first_question(get_offset);
            function get_first_question(get_offset)
            {
                console.log();
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
                        get_offset: get_offset,
                    },
                    success: function(result){
                        
                        var passage_type = 'PASSAGE TYPE: '+ result.questions[0].type;
                        var passage_title =  result.questions[0].title;
                        var passage_description =  result.questions[0].description;
                        passage_description = passage_description.replace(/(<([^>]+)>)/gi, "");
                        var set_passage_type = '<strong>'+passage_type+'</strong><br />'+passage_title+'';

                        var get_question_title = result.questions[0].question_title;
                        get_question_title = result.questions[0].question_title.replace(/(<([^>]+)>)/gi, "");

                        var get_question_no = parseInt(result.get_offset) + 1;

                        var set_questions_options = '<div class="mb-4">';
                        set_questions_options += '<label class="form-label">Question '+get_question_no+' '+get_question_title+'</label>';

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

                           set_questions_options += '<div class="space-y-2"><div class="form-check">';
                           set_questions_options += '<div class="form-check"><input class="form-check-input" type="radio" id="'+get_option_number+'" name="example-radios-default" value="'+get_option_number+'" checked><label class="form-check-label" for="'+get_option_number+'">'+get_option_number.toUpperCase()+'. '+val+'</label></div></div>'
                        });

                        

                        set_questions_options += '</div>';

                        jQuery('#set_question_data').html(set_questions_options);
                        jQuery('#passage_type').text(passage_type);
                        jQuery('#passage_title').text(passage_title);
                        jQuery('#passage_description').text(passage_description);
                        jQuery('#get_offset').val(result.get_offset);

                        if(result.set_prev_offset < 0 )
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
                            jQuery('.next').prop('disabled', true);
                        }
                        else
                        {
                            jQuery('#get_next_question_btn').prop('disabled', false);
                            jQuery('.next').prop('disabled', false);
                        }
                        
                        jQuery('#get_next_question_btn').val(result.set_next_offset);
                        jQuery('.next').val(result.set_next_offset);

                        jQuery('#get_previous_question_btn').val(result.set_prev_offset);
                        jQuery('.prev').val(result.set_prev_offset);

                }});

                
            }

           
        });
</script>
@endsection