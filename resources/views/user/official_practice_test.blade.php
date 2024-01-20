@extends('layouts.user')

@section('title', 'Official Practice Test : CPS')

@section('user-content')
    <meta name="_token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .fa-circle-arrow-right {
            font-size: 22px;
            color: #87ceeb;
        }

        .ques {
            border: 1px solid black;
            padding: 10px 16px;
            margin-top: -1px;
            margin-left: -1px;
            text-align: center;
        }

        .space-y-2 {
            padding: 0px 0 0 9px;
        }

        .sweet-alert {
            width: 70% !important;
            transform: translate(-50%, -50%);
            margin-top: 0px !important;
            margin-left: 0px !important;
        }

        .sweet-alert p {
            height: 156px !important;
            overflow-y: auto !important;
        }

        .checkbox-button {
            appearance: none;
            background-color: transparent;
            /* border: 1px solid #000; */
            border-radius: 4px;
            box-sizing: border-box;
            display: inline-block;
            font-size: 16px;
            /* padding: 3px 8px; */
            position: relative;
            vertical-align: middle;
            /* border: solid #ea580c; */
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

        .scroll_target {
            height: 110px;
            overflow: auto;
        }

        .content-height {
            min-height: 460px;
        }

        .block-content h5 {
            font-size: 14px;
        }

        .scroll_target {
            height: 270px
        }

        .scroll_target p {
            margin-bottom: 0px !important;
        }

        .clock-button {
            min-width: 100px;
            display: inline-flex;
            align-items: center;
            padding-left: 11px;
            pointer-events: none;
        }

        .dcg-wrapper {
            width: 100% !important;
            height: 500px !important;
        }

        .question-button {
            cursor: pointer !important;
            font-size: 17px !important;
            padding: 10px 20px !important;
            border-radius: 0 !important;
        }

        .btn-blue {
            background-color: #0d6efd !important;
        }

        .btn-yellow {
            background-color: #ffc107 !important;
        }

        .btn-orange {
            background-color: rgb(234, 88, 12) !important;
        }

        .btn-red {
            background-color: #dc3545 !important;
        }

        .btn-nocolor {
            background-color: #f6f7f9 !important;
            color: #000 !important;
            border-color: #000 !important;
            border: 1px solid #000 !important;
        }

        .blue-button {
            /* 0d6efd */
            /* 395aa6 */
            background-color: #0d6efd !important;
            /* display: inline-block; */
            /* width: 20px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  height: 20px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  background-color: blue;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  margin-right: 5px; */
        }
    </style>
    @php
        $testSections = \DB::table('practice_test_sections')
            ->where('practice_test_sections.testid', $test_id)
            ->get();
// dd($testSections);
        $test = \DB::table('practice_tests')
            ->where('id', $test_id)
            ->first();
        // dd($test);
        $getTestSection = $testSections->where('id', $section_id)->first();
        // dd($testSections);
        if ($getTestSection->practice_test_type == 'Hard_Reading_And_Writing' || $getTestSection->practice_test_type == 'Easy_Reading_And_Writing') {
            $mareSections = $testSections->whereIn('practice_test_type', ['Easy_Reading_And_Writing', 'Hard_Reading_And_Writing']);
            // dd($mareSections);
        } elseif ($getTestSection->practice_test_type == 'Math_no_calculator' || $getTestSection->practice_test_type == 'Math_with_calculator') {
            $mareSections = $testSections->whereIn('practice_test_type', ['Math_no_calculator', 'Math_with_calculator']);
            // dd($mareSections);
        } else {
        }

        //Check the boxes
        $getSection = $testSection[0];
        // dd($getSection);
        if ($getTestSection->practice_test_type == 'Easy_Reading_And_Writing') {
            $easyCheckBox = 'yes';
        } elseif ($getTestSection->practice_test_type == 'Hard_Reading_And_Writing') {
            $hardCheckBox = 'yes';
        }

        if ($getTestSection->practice_test_type == 'Math_with_calculator') {
            $easyCheckBox = 'yes';
        } elseif ($getTestSection->practice_test_type == 'Math_no_calculator') {
            $hardCheckBox = 'yes';
        }
    @endphp
    <!-- Main Container -->
    <main id="main-container">
        <div class="bg-body-light">
            <div class="content content-boxed py-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        {{-- <li class="breadcrumb-item">
                        <a class="link-fx text-dark" href="{{ url('user/practice-test-sections/'.$section_id) }}">Practice Tests</a>
                    </li> --}}
                        @php
                            $test_name = \DB::table('practice_tests')
                                ->where('id', $testSection[0]->testid)
                                ->value('title');

                            // dd($getTestSection);
                         $modifiedString = str_replace(['_'], [' '], $getTestSection->practice_test_type);
                         $modifiedStrings = str_replace(['calculator', 'Easy', 'with', 'no', 'Hard'], '', $modifiedString);
                                          
                        @endphp
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx"
                                href="{{ url('user/practice-test-sections/' . $testSection[0]->testid) }}">Official Released
                                Practice Test</a>
                            {{-- {{ isset($testSection[0]->section_title) ? $testSection[0]->section_title : '' }} {{ isset($testSection[0]->title) ? $testSection[0]->title : '' }} {{ isset($testSection[0]->id) ? '#'. $testSection[0]->id : '' }} --}}
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="javascript:void(0)">{{ $test_name }}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="javascript:void(0)">{{ $modifiedStrings }}</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <input type="hidden" id="timeisover" name="timeisover" value=0>
        <input type="hidden" id="section_id" value="{{ $section_id }}">
        <input type="hidden" id="get_offset" value="{{ $set_offset }}">
        <input type="hidden" id="get_question_type" value="{{ $question_type }}">
        <input type="hidden" id="time_selected" value="">
        @if (isset($easyCheckBox))
            <input type="hidden" id="easyCheckBox" value="{{ $easyCheckBox }}">
        @endif
        @if (isset($hardCheckBox))
            <input type="hidden" id="hardCheckBox" value="{{ $hardCheckBox }}">
        @endif
        <!-- Page Content -->
        <div class="content content-boxed content-height">
            <div class="row">
                {{-- <div class="col-xl-6 passageContainer">
                    <!-- Lessons -->
                    <div class="block block-rounded">
                        <div class="block-content fs-sm">

                            @if (isset($total_questions[0]))
                                <input type="hidden" id="onload_question_id" value="{{ $total_questions[0] }}">
                            @else
                                <input type="hidden" id="onload_question_id" value="">
                            @endif
                            <h5 class=" mb-2">
                                PASSAGE I
                            </h5>
                            <h5 class=" mb-4">
                                <strong id="passage_type">PASSAGE TYPE: NATURAL SCIENCE</strong><br /><span
                                    id="passage_title">This is adapted from author Blah.</span>
                            </h5>
                            <div class="mb-4">
                                <div id="passage_description" class="form-control scroll_target" style="resize: vertical;">
                                </div>
                                <textarea id="passage_description" class="form-control scroll_target bg-transparent"></textarea>
                            </div>
                            <div class="output">

                            </div>
                        </div>
                    </div>
                    <!-- END Lessons -->
                </div> --}}
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-1 d-flex justify-content-center align-items-center">
                            <h4>Legend:</h4>
                        </div>
                        <div class="col-md-9" style="margin-top: -2px">

                            <div class="row">
                                <div class="col-md-2">
                                    <h5>skip: <span style="color:#87ceeb;font-size:21px"><i
                                                class="fa-solid fa-circle-arrow-right"></i></span></h5>
                                </div>
                                <div class="col-md-2">
                                    <h5>guess: <span style="color:gray;font-size:21px"><i
                                                class="fa-solid fa-question"></i></span></h5>

                                </div>
                                <div class="col-md-2">
                                    <h5>flag: <span style="color:#ff0000;font-size:21px"><i
                                                class="fa-solid fa-flag"></i></span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (($test->format == 'DSAT' || $test->format == 'DPSAT') && ($getTestSection->practice_test_type == 'Hard_Reading_And_Writing' || $getTestSection->practice_test_type == 'Easy_Reading_And_Writing' || $getTestSection->practice_test_type == 'Math_no_calculator' || $getTestSection->practice_test_type == 'Math_with_calculator'))
                    <div class="col-xl-12 mb-3"
                        style="border: 1px dashed black;
                padding: 21px;
                text-align: center;">
                        <h5>Select Delimiter</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <label class="form-check-label" for="easy">
                                        @php
                                            $easyDelimiter = $mareSections->where('easy_section_determiner', '!=', null);
                                        @endphp
                                        @if ($easyDelimiter)
                                            @foreach ($easyDelimiter as $easyDe)
                                                <input class="form-check-input" type="radio" name="easy_hard"
                                                    id="easy" data-id={{ $easyDe->id }}>
                                                {{ $easyDe->easy_section_determiner }}
                                            @endforeach
                                        @endif
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-check">
                                    <label class="form-check-label" for="hard">
                                        @php
                                            $hardDelimiter = $mareSections->where('hard_section_determiner', '!=', null);
                                        @endphp
                                        @if ($hardDelimiter)
                                            @foreach ($hardDelimiter as $hardDe)
                                                <input class="form-check-input" type="radio" name="easy_hard"
                                                    id="hard" data-id={{ $hardDe->id }}>

                                                {{ $hardDe->hard_section_determiner }}
                                            @endforeach
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endif
                <div class="col-xl-12" id="set_question_data">

                    <!-- Question -->

                    <!-- END Subscribe -->


                </div>
            </div>
        </div>
        <!-- END Page Conten    t -->
        <!-- Navigation -->
        <div class="bg-body-extra-light">
            <div class="content content-boxed py-3">
                <div class="col-xl-12 d-flex gap-3 justify-content-end mb-2">
                    <div class="mb-2">
                        <input type="text" class="form-control form-control-md " id="user_actual_score"
                            name="user_actual_score" placeholder="Enter your Actual Score"
                            onkeydown="return /[a-z]/i.test(event.key)">
                    </div>
                    <div class="mb-2">
                        <input type="time" class="form-control form-control-md" id="user_actual_time"
                            name="user_actual_time" placeholder="Enter your Actual Time">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4">
                        {{-- <button type="button" id="get_previous_question_btn" value=""
                            class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3 prev" data-count="0"><i
                                class="fa fa-fw fa-arrow-left me-1"></i>Previous</button> --}}
                        <button type="button" id="get_next_question_btn" value=""
                            class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3 next d-none" disabled
                            data-count="0">Next<i class="fa fa-fw fa-arrow-right me-1"></i></button>
                        {{-- <button type="button" class="btn btn-sm btn-outline-info fs-xs fw-semibold me-1 mb-3 review"><i
                                class="fa fa-fw fa-list-check me-1"></i>Review</button> --}}
                        <button type="button" class="btn btn-sm btn-dark fs-xs fw-semibold me-1 mb-3 clock-button"><i
                                class="fa fa-fw fa-clock me-1"></i>
                            <span id="timer">
                                @php
                                    $optionValue = $_GET['time'] ?? null;
                                    $regularTime = optional($testSection[0])->regular_time ?? '00:00:00';
                                    $fiftyPerExtended = optional($testSection[0])->fifty_per_extended ?? '00:00:00';
                                    $hundredPerExtended = optional($testSection[0])->hundred_per_extended ?? '00:00:00';
                                @endphp
                                {{ $optionValue == 'regular' ? $regularTime : ($optionValue == '50per' ? $fiftyPerExtended : ($optionValue == '100per' ? $hundredPerExtended : '00:00:00')) }}
                            </span>
                        </button>
                    </div>
                    <div class="col-xl-5">
                        {{-- <label
                            class="btn btn-sm btn-outline-danger fs-xs fw-semibold me-1 mb-3 checkbox-button main_flag_section">
                            <input type="checkbox" class="flag" />
                            <span><i class="fa fa-fw fa-flag me-1" style="color:red"></i>Flag</span>
                        </label> --}}

                        {{-- <button type="button" id="get_skip_question_btn" class="btn btn-sm btn-outline-info fs-xs fw-semibold me-1 mb-3 skip" data-count="0"><i class="fa fa-fw fa-forward me-1"></i>Skip</button> --}}
                        {{-- <label
                            class="btn btn-sm btn-outline-info fs-xs fw-semibold me-1 mb-3 checkbox-button main_skip_section">
                            <input type="checkbox" class="skip" />
                            <span><i class="fa fa-fw fa-forward me-1"></i>Skip</span>
                        </label>

                        <label
                            class="btn btn-sm btn-outline-warning fs-xs fw-semibold me-1 mb-3 checkbox-button main_guess_section">
                            <input type="checkbox" class="guess" />
                            <span><i class="fa fa-fw fa-circle-question me-1"></i>Guess</span>
                        </label> --}}
                        {{--                         
                        @if ($testSection[0]->practice_test_type == 'Math')
                            <button type="button"
                                class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3 calculator"><i
                                    class="fa fa-fw fa-calculator me-1" style="color:black"></i>Calculator</button>
                        @endif
                        --}}


                        @php
                            $section = ['Math', 'Math_with_calculator'];
                        @endphp

                        @if (in_array($testSection[0]->practice_test_type, $section) || $testSection[0]->show_calculator == 1)
                            <button type="button"
                                class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3 calculator"><i
                                    class="fa fa-fw fa-calculator me-1" style="color:black"></i>Calculator</button>
                        @endif
                    </div>
                    <div class="col-xl-3">
                        <input type="hidden" id="actual_time" name="actual_time" value="00:00:00">
                        <button type="button"
                            class="btn btn-sm btn-outline-success fs-xs fw-semibold me-1 mb-3 submit_section_btn"><i
                                class="fa fa-fw fa-circle-check me-1"></i>Submit Section</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="calculator-container"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Navigation -->
    </main>
    <!-- END Main Container -->
@endsection

@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.min.css') }}">
    <style>
        .content {
            width: 90%;
        }

        .modal-dialog {
            max-width: 1000px;
        }
    </style>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://www.desmos.com/api/v1.7/calculator.js?apiKey=dcb31709b452b1cf9dc26972add0fda6"></script>
    <script>
        var storedSelectedAnswers = [];
        $(document).on('click', '.calculator', function() {
            $('#exampleModal #calculator-container').html('');
            const calculator = Desmos.GraphingCalculator(document.getElementById('calculator-container'));
            $('#exampleModal').modal('show');
        });

        $(document).ready(function() {
            let easyCheckBox = $('#easyCheckBox').val();
            let hardCheckBox = $('#hardCheckBox').val();
            if (easyCheckBox == 'yes') {
                $('#easy').prop("checked", true);
            }

            if (hardCheckBox == 'yes') {
                $('#hard').prop("checked", true);
            }

            let test_id = {{ $test_id }};
            $('#easy').on('change', function() {
                if ($(this).is(':checked')) {
                    let sectionId = $(this).data('id');

                    jQuery.ajax({
                        url: "{{ route('get_official_tests') }}",
                        method: 'get',
                        data: {
                            'sectionId': sectionId,
                            'test_id': test_id,
                        },
                        success: function(result) {
                            console.log(result);
                            window.location.href = '/user/official-practice-test/' + result.data
                                .section_id + '?test_id=' + result.data.test_id +
                                '&time=regular';

                        }
                    });

                } else {
                    alert('is unchecked');
                }
            });

            $('#hard').on('change', function() {
                if ($(this).is(':checked')) {
                    let sectionId = $(this).data('id');

                    jQuery.ajax({
                        url: "{{ route('get_official_tests') }}",
                        method: 'get',
                        data: {
                            'sectionId': sectionId,
                            'test_id': test_id,
                        },
                        success: function(result) {
                            console.log(result);
                            window.location.href = '/user/official-practice-test/' + result.data
                                .section_id + '?test_id=' + result.data.test_id +
                                '&time=regular';

                        }
                    });
                } else {
                    alert('is unchecked');
                }
            });
        });

        jQuery(document).ready(function() {




            //PROGRESS CHECK STARTS
            let sectionId = $('#section_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{ route('check_progress') }}",
                method: 'post',
                data: {
                    'sectionId': sectionId,
                },
                success: function(result) {
                    let progressFlag = result.progressFlag;
                    // progressFlag = 0;
                    if (progressFlag) {
                        //handleProgress(result.existingProgress);
                        // console.log(result.existingProgress);
                        var get_offset = result.existingProgress.progress_index;
                        var question_id_arr = JSON.parse(result.existingProgress.question_id);
                        if (question_id_arr[get_offset])
                            $('#onload_question_id').val(question_id_arr[get_offset]);
                        get_first_question(get_offset, result.existingProgress);

                        jQuery('.next').attr('data-count', get_offset);
                        jQuery('.prev').attr('data-count', get_offset);

                    } else {
                        var get_offset = jQuery('#get_offset').val();
                        get_first_question(get_offset);
                    }
                }
            });
            //PROGRESS CHECK ENDS

            var selected_answer = [];
            var selected_gusess_details = [];
            var selected_flag_details = [];
            var selected_skip_details = [];

            var question_id_arr = @json($total_questions);
            $('#onload_question_id').val(question_id_arr[0]);

            var getSelectedAnswer;
            var check_click_type = 'onload';
            get_time();

            $('.content').on('click', 'input[name=example-radios-default]:radio', function() {
                var get_question_id = jQuery('.get_question_id').val();
                // $('.skip').css("color", "#0891b2");
                // $('.skip').css("background-color", "white");
                // selected_skip_details[get_question_id] = 'no';
            });


            jQuery(".prev").click(function() {
                var get_offset = jQuery(this).val();
                var get_question_id = jQuery('.get_question_id').val();
                let data_count = jQuery(this).attr('data-count');
                data_count = parseInt(data_count);
                jQuery(this).attr('data-count', data_count - 1);
                // jQuery('.skip').attr('data-count', data_count - 1);
                jQuery('.next').attr('data-count', data_count - 1);
                var set_scroll_position = 0;

                let arr_index = jQuery('.prev').attr('data-count');
                $('#onload_question_id').val(question_id_arr[arr_index]);

                if ($("input[name='example-radios-default']").is(':checked')) {
                    var getSelectedAnswer = $("input[name='example-radios-default']:checked").val();
                    selected_answer[get_question_id] = getSelectedAnswer;
                    // selected_skip_details[get_question_id] = 'no';
                } else if ($("input[name='example-checkbox-default']").is(':checked')) {
                    var store_multi = '';
                    $('input[name="example-checkbox-default"]:checked').each(function() {
                        store_multi += this.value + ',';
                    });
                    store_multi = store_multi.replace(/,\s*$/, "");
                    selected_answer[get_question_id] = store_multi;
                    // selected_skip_details[get_question_id] = 'no';
                } else if ($("input[name='example-textbox-default']")) {
                    store_multi = $("input[name='example-textbox-default']").val();
                    selected_answer[get_question_id] = store_multi;
                    // selected_skip_details[get_question_id] = 'no';
                } else {
                    selected_answer[get_question_id] = '-';
                    // selected_skip_details[get_question_id] = 'yes';
                }

                if (!$(".guess").is(':checked')) {
                    selected_gusess_details[get_question_id] = 'no';
                }

                if (!$(".flag").is(':checked')) {
                    selected_flag_details[get_question_id] = 'no';
                }

                if (!$(".skip").is(':checked')) {
                    selected_skip_details[get_question_id] = 'no';
                }

                var check_click_type = 'prev';

                //PROGRESS CHECK Starts
                let sectionId = $('#section_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                jQuery.ajax({
                    url: "{{ route('check_progress') }}",
                    method: 'post',
                    data: {
                        'sectionId': sectionId,
                    },
                    success: function(result) {
                        let progressFlag = result.progressFlag;
                        // progressFlag = 0;
                        if (progressFlag) {
                            get_first_question(get_offset, result.existingProgress);
                        } else {
                            //var get_offset = jQuery('#get_offset').val();
                            get_first_question(get_offset);
                        }
                    }
                });
                //PROGRESS CHECK Ends

                var scroll_id = jQuery('.get_question_id').val();
                scroll_id = scroll_id - 1;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                jQuery.ajax({
                    url: "{{ url('/user/get_scroll_position/post') }}",
                    method: 'post',
                    data: {
                        get_question_id: scroll_id,
                    },
                    success: function(result) {
                        var element = document.querySelector('#passage_description');
                        set_scroll_position = result.scroll_position[0].scroll_position;
                        element.scrollTop = set_scroll_position;


                    }
                });

            });

            var count = 1;
            jQuery(".next").click(async function() {
                await storeProgress();
                var get_offset = jQuery(this).val();
                let data_count = jQuery(this).attr('data-count');
                data_count = parseInt(data_count);
                jQuery(this).attr('data-count', data_count + 1);
                // jQuery('.skip').attr('data-count', data_count + 1);
                jQuery('.prev').attr('data-count', data_count + 1);
                var get_question_id = jQuery('.get_question_id').val();

                let arr_index = jQuery('.next').attr('data-count');
                $('#onload_question_id').val(question_id_arr[arr_index]);

                if ($("input[name='example-radios-default']").is(':checked')) {
                    count++;
                    var getSelectedAnswer = $("input[name='example-radios-default']:checked").val();
                    selected_answer[get_question_id] = getSelectedAnswer;
                    // selected_skip_details[get_question_id] = 'no';
                } else if ($("input[name='example-checkbox-default']").is(':checked')) {
                    count++;
                    var store_multi = '';
                    $('input[name="example-checkbox-default"]:checked').each(function() {
                        store_multi += this.value + ',';
                    });
                    store_multi = store_multi.replace(/,\s*$/, "");
                    selected_answer[get_question_id] = store_multi;
                    // selected_skip_details[get_question_id] = 'no';
                } else if ($("input[name='example-textbox-default']")) {
                    store_multi = $("input[name='example-textbox-default']").val();
                    selected_answer[get_question_id] = store_multi;
                    // selected_skip_details[get_question_id] = 'no';
                }

                if (!$(".guess").is(':checked')) {
                    selected_gusess_details[get_question_id] = 'no';
                }

                if (!$(".flag").is(':checked')) {
                    selected_flag_details[get_question_id] = 'no';
                }

                if (!$(".skip").is(':checked')) {
                    selected_skip_details[get_question_id] = 'no';
                }

                //PROGRESS CHECK Starts
                let sectionId = $('#section_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                jQuery.ajax({
                    url: "{{ route('check_progress') }}",
                    method: 'post',
                    data: {
                        'sectionId': sectionId,
                    },
                    success: function(result) {
                        let progressFlag = result.progressFlag;
                        // progressFlag = 0;
                        if (progressFlag) {
                            get_first_question(get_offset, result.existingProgress);
                        } else {
                            get_first_question(get_offset);
                        }
                    }
                });
                //PROGRESS CHECK Ends


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
                        get_question_id: get_question_id,
                        scroll_position: scroll_position
                    },
                    success: function(result) {

                    }
                });
            });


            jQuery(".review").click(function() {
                var current_question_id = $('.next').val();
                var question_ids = @json($total_questions);

                let my_arr = []
                let totalFlag = 0;
                let totalSkip = 0;
                let totalGuess = 0;

                for (let index = 0; index < question_ids.length; index++) {
                    my_arr[question_ids[index]] = {
                        "flag": selected_flag_details[question_ids[index]],
                        "guess": selected_gusess_details[question_ids[index]],
                        "skip": selected_skip_details[question_ids[index]]
                    }
                }

                my_arr.forEach(element => {
                    if (element.flag == 'yes')
                        totalFlag++

                    if (element.skip == 'yes')
                        totalSkip++

                    if (element.guess == 'yes')
                        totalGuess++
                });

                // if(current_question_id==1 && !totalFlag && !totalGuess && !totalSkip)
                // {
                //     var alert_data={
                //         title: "You didn’t answer all questions do you want to review section now ?",
                //         // text: "You didn’t answer all questions do you want to review section now ?",
                //         type: "info",
                //         showCancelButton: true,
                //         confirmButtonColor: "#DD6B55",
                //         confirmButtonText: "Yes",
                //         cancelButtonText: "Cancel",
                //         closeOnConfirm: false,
                //         closeOnCancel: true,
                //         index:true,
                //     }
                var reviewCount = {
                    flag: totalFlag,
                    skip: totalSkip,
                    guess: totalGuess
                }
                // }
                // else
                // {
                var questionBoxes = "";
                for (let index = 0; index < question_ids.length; index++) {
                    var num = index + 1;

                    var btn_color = 'btn-nocolor';
                    if (selected_flag_details[question_ids[index]] == 'yes') {
                        btn_color = 'btn-red';
                    } else if (selected_gusess_details[question_ids[index]] == 'yes') {
                        btn_color = 'btn-orange';
                    } else if (selected_skip_details[question_ids[index]] == 'yes') {
                        btn_color = 'btn-yellow';
                    } else if (selected_answer[question_ids[index]]) {
                        btn_color = 'btn-blue';
                    }
                    questionBoxes += '<button type="button" value="' + num + '" class="question-button ' +
                        btn_color + ' btn qtbutton" data-count="' + index + '">' + num + '</button>';
                }

                var alert_data = {
                    title: "Review Details",
                    // text: "Flag :- "+totalFlag+","+"Skip :- "+totalSkip+","+"Guess :- "+totalGuess,
                    text: "<div class='d-flex flex-wrap'>" + questionBoxes + "</div>",
                    type: "success",

                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Cancel",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: true,
                    closeOnCancel: false,
                    index: false,
                };
                // }
                sweet_alert(alert_data, reviewCount, question_ids);
            });

            function sweet_alert(data, review, question_ids) {
                swal({
                    title: data.title,
                    text: data.text,
                    html: true,
                    type: data.type,
                    showCancelButton: data.showCancelButton,
                    confirmButtonColor: data.confirmButtonColor,
                    confirmButtonText: data.confirmButtonText,
                    cancelButtonText: data.cancelButtonText,
                    closeOnConfirm: data.closeOnConfirm,
                    closeOnCancel: data.closeOnCancel
                }, (resp) => {
                    if (data.index && resp) {
                        var questionBoxes = "";
                        for (let index = 0; index < question_ids.length; index++) {
                            var num = index + 1;

                            var btn_color = 'btn-nocolor';
                            if (selected_flag_details[question_ids[index]] == 'yes') {
                                btn_color = 'btn-red';
                            } else if (selected_gusess_details[question_ids[index]] == 'yes') {
                                btn_color = 'btn-orange';
                            } else if (selected_skip_details[question_ids[index]] == 'yes') {
                                btn_color = 'btn-yellow';
                            } else if (selected_answer[question_ids[index]]) {
                                btn_color = 'btn-blue';
                            }
                            questionBoxes += '<button type="button" value="' + num +
                                '" class="question-button ' + btn_color + ' btn qtbutton" data-count="' +
                                index + '">' + num + '</button>';
                        }

                        swal({
                            title: "Review Details",
                            // text: "Flag :- "+review.flag+","+"Skip :- "+review.skip+","+"Guess :- "+review.guess,
                            text: "<div class='d-flex flex-wrap'>" + questionBoxes + "</div>",
                            html: true,
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Cancel",
                            cancelButtonText: "Cancel",
                            closeOnConfirm: true,
                            closeOnCancel: false,
                            index: false,
                        })
                    }
                });
            }
            var get_quest_id = @json($total_questions);
            // console.log(get_quest_id);

            $(document).on('click', '[class^="skip-"]', function() {
                var ki = parseInt($(this).attr('class').split('-')[1]);
                handleCheckboxClick(ki, 'skip', get_quest_id);
            });

            $(document).on('click', '[class^="guess-"]', function() {
                var ki = parseInt($(this).attr('class').split('-')[1]);
                handleCheckboxClick(ki, 'guess', get_quest_id);
            });

            $(document).on('click', '[class^="flag-"]', function() {
                var ki = parseInt($(this).attr('class').split('-')[1]);
                handleCheckboxClick(ki, 'flag', get_quest_id);
            });


            function handleCheckboxClick(questionId, type, allQuestionIds) {
                var checkboxSelector = '.' + type + '-' + questionId;
                var selectedDetails, mainSectionClass, bgColor;

                switch (type) {
                    case 'skip':
                        selectedDetails = selected_skip_details;
                        mainSectionClass = 'main_skip_section-' + questionId;
                        let colorArrow = $('.arrow-' + questionId);
                        // console.log(colorArrow.css('color'))
                        if (colorArrow.css('color') === "rgb(135, 206, 235)") {
                            colorArrow.css('color', 'green');
                        } else {
                            colorArrow.css("color", "#87ceeb");
                        }
                        break;
                    case 'guess':
                        selectedDetails = selected_gusess_details;
                        mainSectionClass = 'main_guess_section-' + questionId;
                        let quesColor = $('.ques-' + questionId);
                        if (quesColor.css('color') === "rgb(128, 128, 128)") {
                            quesColor.css('color', 'green');
                        } else {
                            quesColor.css("color", "#808080");
                        }
                        break;
                    case 'flag':
                        selectedDetails = selected_flag_details;
                        mainSectionClass = 'main_flag_section-' + questionId;
                        let flagColor = $('.flagy-' + questionId);
                        console.log(flagColor.css('color'))
                        if (flagColor.css('color') === "rgb(255, 0, 0)") {
                            flagColor.css('color', 'green');
                        } else {
                            flagColor.css("color", "#ff0000");
                        }
                        break;
                        // Add more cases if needed
                }

                if ($(checkboxSelector).is(':checked')) {
                    $('.' + mainSectionClass).css("color", "white");
                    $('.' + mainSectionClass).css("background-color", bgColor);
                    selectedDetails[questionId] = 'yes';
                } else {
                    $('.' + mainSectionClass).css("color", bgColor);
                    $('.' + mainSectionClass).css("background-color", "transparent");
                    selectedDetails[questionId] = 'no';
                }

                // Handle other checkboxes based on type
                allQuestionIds.forEach(function(id) {
                    if (id !== questionId) {
                        selected_skip_details[id] = 'no';
                        selected_gusess_details[id] = 'no';
                        selected_flag_details[id] = 'no';
                    }
                });
            }
            // $('#user_actual_time').on('blur', function() {
            //     var input = $(this).val();
            //     if (!/^$|^([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$/.test(input)) {
            //         alert('Please enter a valid time in the format HH:MM:SS.');
            //         $(this).val('');
            //         return false;
            //     }
            // });



            jQuery(".submit_section_btn").click(function() {
                // await storeProgress();
                // await new Promise(resolve => setTimeout(resolve, 100));



                if (jQuery('.next').prop('disabled') == false) {
                    var timeisover = jQuery('#timeisover').val();
                    if (timeisover == 1) {
                        confirm(true);
                    } else {
                        swal({
                            title: "Warning",
                            text: "Are you sure you want to submit this test? Make sure you have answered every question using the Review button.",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes",
                            cancelButtonText: "No",
                            closeOnConfirm: true,
                            closeOnCancel: true,
                        }, function(isConfirm) {
                            if (isConfirm) {
                                confirm(false);
                            }
                        });
                    }
                } else {
                    var timeisover = jQuery('#timeisover').val();
                    if (timeisover == 1) {
                        confirm(true);
                    } else {
                        confirm(false);
                    }
                }
            });

            function confirm(flagTimeOut, submit = false) {

                let userActualScore = $('#user_actual_score').val();
                let userActualTime = $('#user_actual_time').val();

                // if (userActualScore == '' && userActualTime == '') {
                //     alert('Please enter valid values for Actual Score and Actual Time fields.');
                //     return false;
                // }


                let sectionID = '{{ $section_id }}';

                // var get_question_id = jQuery('#onload_question_id').val();

                var question_ids_array = $('.get_question_id').map(function() {
                    return $(this).val();
                }).get();

                // console.log(question_ids_array);


                var get_section_id = jQuery('#section_id').val();
                var get_question_type = jQuery('#get_question_type').val();
                var get_practice_id = jQuery(this).attr('data-practice_test_id');
                var get_test_id = '';
                let question_ids = @json($total_questions);
                // console.log(question_ids);
                var actual_time = jQuery('#actual_time').val();

                //if (window.location.href.indexOf("all") > -1)
                //{
                //    var url = window.location.href,
                //    parts = url.split("/"),
                //    last_part = parts[parts.length-1];
                //    get_test_id = last_part;
                //} else {
                const urlParams = new URLSearchParams(window.location.search);
                get_test_id = urlParams.get('test_id');
                //}

                question_ids_array.forEach(function(get_question_id) {

                    if ($(".flag-" + get_question_id).is(':checked')) {
                        selected_flag_details[get_question_id] = 'yes';
                    } else {
                        selected_flag_details[get_question_id] = 'no';
                    }

                    if ($(".skip-" + get_question_id).is(':checked')) {
                        selected_skip_details[get_question_id] = 'yes';
                    } else {
                        selected_skip_details[get_question_id] = 'no';
                    }

                    if ($(".guess-" + get_question_id).is(':checked')) {
                        selected_gusess_details[get_question_id] = 'yes';
                    } else {
                        selected_gusess_details[get_question_id] = 'no';
                    }


                    var radioSelector = 'input[name="example-radios-default-' + get_question_id +
                        '"]:checked';
                    var checkboxSelector = 'input[name="example-checkbox-default-' +
                        get_question_id +
                        '"]:checked';
                    var textboxSelector = 'input[name="example-textbox-default-' + get_question_id +
                        '"]';

                    if ($(radioSelector).length) {
                        var getSelectedAnswer = $(radioSelector).val();
                        // console.log('Question ID: ' + get_question_id + ', Selected Answer: ' +
                        //     getSelectedAnswer);
                        selected_answer[get_question_id] = getSelectedAnswer;
                    } else if ($(checkboxSelector).length) {
                        var store_multi = '';
                        $(checkboxSelector).each(function() {
                            store_multi += this.value + ',';
                        });
                        store_multi = store_multi.replace(/,\s*$/, "");
                        // console.log('Question ID: ' + get_question_id + ', Selected Answers: ' +
                        //     store_multi);
                        selected_answer[get_question_id] = store_multi;
                    } else if ($(textboxSelector).length) {
                        store_multi = $(textboxSelector).val();
                        // console.log('Question ID: ' + get_question_id + ', Textbox Value: ' + store_multi);
                        selected_answer[get_question_id] = store_multi;
                    } else {
                        // console.log('Question ID: ' + get_question_id + ', No option selected.');
                        selected_answer[get_question_id] = '-';
                    }
                });





                Array.prototype.associate = function(keys) {
                    var result = {};

                    this.forEach(function(el, i) {
                        result[keys[i]] = el;
                    });

                    return result;
                };

                let answer_details = [];
                // if (storedSelectedAnswers) {
                //     answer_details = storedSelectedAnswers;
                // } else {
                for (let index = 0; index < question_ids.length; index++) {
                    if (selected_answer.hasOwnProperty(question_ids[index])) {
                        answer_details[question_ids[index]] = selected_answer[question_ids[index]];
                    } else {
                        answer_details[question_ids[index]] = '-';
                    }
                }

                let flag_detail = [];
                // selected_flag_details = selected_flag_details.filter(function( element, key ) {
                //     return element !== "undefined";
                // });
                //start
                for (let index = 0; index < question_ids.length; index++) {
                    if (selected_flag_details.hasOwnProperty(question_ids[index])) {
                        flag_detail[question_ids[index]] = selected_flag_details[question_ids[index]];
                    } else {
                        flag_detail[question_ids[index]] = 'no';
                    }
                }
                //end
                let guess_detail = [];
                // selected_gusess_details = selected_gusess_details.filter(function( element, key ) {
                //     return element !== "undefined";
                // });
                //start
                for (let index = 0; index < question_ids.length; index++) {
                    if (selected_gusess_details.hasOwnProperty(question_ids[index])) {
                        guess_detail[question_ids[index]] = selected_gusess_details[question_ids[index]];
                    } else {
                        guess_detail[question_ids[index]] = 'no';
                    }
                }
                //end

                //skip
                let skip_detail = [];
                for (let index = 0; index < question_ids.length; index++) {
                    if (selected_skip_details.hasOwnProperty(question_ids[index])) {
                        skip_detail[question_ids[index]] = selected_skip_details[question_ids[index]];
                    } else {
                        skip_detail[question_ids[index]] = 'no';
                    }
                }
                //end

                Array.prototype.associate = function(keys) {
                    var result = {};

                    this.forEach(function(el, i) {
                        result[keys[i]] = el;
                    });

                    return result;
                };

                answer_details = answer_details.filter(function(element, key) {
                    return element !== 'undefined';
                });
                answer_details = answer_details.associate(question_ids);
                // // }
                // var new_answer_detail = [];
                // answer_details.map(function(key, index) {
                //     if (key !== 'undefined') {
                //         new_answer_detail.push({
                //             [index]: key
                //         })
                //     }

                // });

                flag_detail = flag_detail.filter(function(element, key) {
                    return element !== 'undefined';
                });
                flag_detail = flag_detail.associate(question_ids);

                guess_detail = guess_detail.filter(function(element, key) {
                    return element !== 'undefined';
                });
                guess_detail = guess_detail.associate(question_ids);

                skip_detail = skip_detail.filter(function(element, key) {
                    return element !== 'undefined';
                });
                skip_detail = skip_detail.associate(question_ids);
                if (window.location.href.indexOf("all") !== -1) {
                    var section_size = 'all';
                } else {
                    var section_size = 'single';
                }

                let flag_details = selected_flag_details.associate(question_ids);
                let gusess_details = selected_gusess_details.associate(question_ids);




                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                const postData = {
                    section_id: sectionID,
                    selected_answer: answer_details,
                    selected_gusess_details: guess_detail,
                    selected_flag_details: flag_detail,
                    selected_skip_details: skip_detail,
                    get_section_id: get_section_id,
                    get_practice_id: get_test_id,
                    get_question_type: get_question_type,
                    section_size: section_size,
                    actual_time: actual_time,
                    user_actual_time: userActualTime,
                    user_actual_score: userActualScore
                };
                jQuery.ajax({
                    url: "{{ url('/user/set_user_question_answer/post') }}",
                    method: 'post',
                    data: postData,
                    success: function(result) {
                        // console.log(result);
                        // alert('Break Time: '+result.break_time);
                        // alert('Redirect URL: '+result.redirect_url);
                        // die;

                        if (result.error == 1) {
                            alert('Please enter valid values for Actual Score and Actual Time field.');
                            return false;
                        }
                        if (count < result.total_question) {
                            window.alert(
                                "Are you sure you want to submit this test? Make sure you have answered every question using the Review button."
                            );
                        }

                        // redirect code here.
                        if (result.redirect_url != 0) {
                            // only for DSAT, DPSAT
                            var url = window.location.origin + result.redirect_url;
                            window.location.href = url;
                            return false;
                        } else {

                            if (result.break_time != 0) {
                                let next_section_id = result.next_section_id;
                                var url = window.location.origin + '/user/test-break/' +
                                    next_section_id + '?test_id=' + get_test_id;
                                window.location.href = url;
                                return false;
                            }

                            var url = window.location.origin + '/user/practice-test-sections/' +
                                get_test_id;
                            window.location.href = url;
                            return false;
                        }

                        // redirect to test break here.
                        // this code below is not working anymore.
                        var url = "{{ url('') }}" + '/user/practice-tests/' + result
                            .get_test_name + '/' + result.section_id + '/review-page?test_id=' +
                            get_test_id + '&type=' + result.get_test_type;

                        if (window.location.href.indexOf("all") > -1) {
                            var url = window.location.href,
                                parts = url.split("=");
                            var sectionArrayJson = parts[parts.length - 1];
                            var sectionArray = JSON.parse(sectionArrayJson);
                            if (sectionArray.length > 0) {
                                var next_section_id = sectionArray[0];
                                if (next_section_id != '') {
                                    sectionArray.shift();
                                    let remainingSectionArrayJson = JSON.stringify(
                                        sectionArray);

                                    let option = new URLSearchParams(window.location.search);
                                    let OptionValue = option.get('time');

                                    if (flagTimeOut) {
                                        swal({
                                            title: "Confirm",
                                            type: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#DD6B55",
                                            confirmButtonText: "Submit",
                                            cancelButtonText: "Proceed to Next section",
                                            closeOnConfirm: true,
                                            closeOnCancel: true,
                                        }, function(isConfirm) {
                                            if (isConfirm) {
                                                var url = "{{ url('') }}" +
                                                    '/user/practice-tests/' + result
                                                    .get_test_name + '/' + result
                                                    .section_id +
                                                    '/review-page?test_id=' +
                                                    get_test_id +
                                                    '&type=' + result.get_test_type;
                                                window.location.href = url;
                                            } else {
                                                var url = "{{ url('') }}" +
                                                    '/user/practice-test/' +
                                                    next_section_id +
                                                    '?test_id=' + get_test_id +
                                                    '&time=' +
                                                    OptionValue +
                                                    '&section=all&sections=' +
                                                    remainingSectionArrayJson;
                                                window.location.href = url;
                                            }
                                        });
                                        return false;
                                    } else {
                                        var url = "{{ url('') }}" +
                                            '/user/practice-test/' +
                                            next_section_id + '?test_id=' + get_test_id +
                                            '&time=' +
                                            OptionValue + '&section=all&sections=' +
                                            remainingSectionArrayJson;
                                    }
                                } else {
                                    // var url = "{{ url('') }}"+'/user/practice-test-sections/'+get_test_id;
                                    var url = "{{ url('') }}" + '/user/practice-tests/' +
                                        result
                                        .get_test_name + '/' + get_test_id +
                                        '/review-page?test_id=' +
                                        get_test_id + '&type=all';
                                }
                            } else {
                                var url = "{{ url('') }}" + '/user/practice-tests/' +
                                    result
                                    .get_test_name + '/' + get_test_id +
                                    '/review-page?test_id=' +
                                    get_test_id + '&type=all';
                            }
                        } else {
                            if (flagTimeOut) {
                                var url = "{{ url('') }}" + '/user/practice-tests/' +
                                    result
                                    .get_test_name + '/' + result.section_id +
                                    '/review-page?test_id=' +
                                    get_test_id + '&type=' + result.get_test_type;
                            } else {
                                var url = "{{ url('') }}" +
                                    '/user/practice-test-sections/' +
                                    get_test_id;
                            }
                        }
                        window.location.href = url;
                    }
                });
            }

            function get_first_question(get_offset, existingProgress = null) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('/user/get_official_section_questions/post') }}",
                    method: 'post',
                    data: {
                        section_id: jQuery('#section_id').val(),
                        question_id: $('#onload_question_id').val(),
                        question_type: jQuery('#get_question_type').val(),
                        get_offset: get_offset,
                    },
                    success: function(result) {
                        // console.log(result.questions);
                        var set_questions_options =
                            '<div class="row mb-4 d-flex flex-column" id="half-height">';
                        var totalQuestions = result.questions.length;
                        var halfwayPoint = Math.ceil(totalQuestions / 2);
                        var capturedHeight = 0;
                        jQuery.each(result.questions, function(key, value) {
                            // console.log(val)
                            let questionId = value.id;
                            // console.log(questionId)
                            $('.submit_section_btn').attr('data-practice_test_id',
                                result
                                .practice_test_id);

                            if (totalQuestions > 10) {
                                if ((key + 1) == halfwayPoint) {
                                    setTimeout(function() {
                                        let mydiv = document.getElementById(
                                            'half-height');
                                        if (mydiv) {
                                            capturedHeight += mydiv.clientHeight ||
                                                mydiv
                                                .offsetHeight;
                                        }
                                    }, 0);
                                }
                            }

                            // var get_question_title = value.question_title;
                            set_questions_options +=
                                `<div class="col-md-6 "><div class="ques"><input type="hidden" value="${value.id}" class="get_question_id"><label class="form-label ">Q${key+1} </label> `;
                            if (value.question_answer_options) {
                                var get_options = value.question_answer_options
                                    .replace(
                                        /(<([<p></p>]+)>)/gi, "");
                                // console.log(get_options);
                            } else {
                                get_options = '["a"]';
                            }
                            jQuery.each(JSON.parse(get_options), function(key, val) {
                                var get_option_number = 'A';
                                // console.log(value.practice_type);
                                if (value.practice_type ==
                                    "choiceOneInFive_Odd") {
                                    if (key == 0) {
                                        get_option_number = 'a';
                                    } else if (key == 1) {
                                        get_option_number = 'b';
                                    } else if (key == 2) {
                                        get_option_number = 'c';
                                    } else if (key == 3) {
                                        get_option_number = 'd';
                                    } else if (key == 4) {
                                        get_option_number = 'e';
                                    }
                                } else if (value.practice_type ==
                                    "choiceOneInFive_Even") {
                                    if (key == 0) {
                                        get_option_number = 'f';
                                    } else if (key == 1) {
                                        get_option_number = 'g';
                                    } else if (key == 2) {
                                        get_option_number = 'h';
                                    } else if (key == 3) {
                                        get_option_number = 'j';
                                    } else if (key == 4) {
                                        get_option_number = 'k';
                                    }

                                } else if (value.practice_type ==
                                    "choiceOneInFourPass_Odd") {
                                    if (key == 0) {
                                        get_option_number = 'a';
                                    } else if (key == 1) {
                                        get_option_number = 'b';
                                    } else if (key == 2) {
                                        get_option_number = 'c';
                                    } else if (key == 3) {
                                        get_option_number = 'd';
                                    }
                                } else if (value.practice_type ==
                                    "choiceOneInFourPass_Even") {
                                    if (key == 0) {
                                        get_option_number = 'f';
                                    } else if (key == 1) {
                                        get_option_number = 'g';
                                    } else if (key == 2) {
                                        get_option_number = 'h';
                                    } else if (key == 3) {
                                        get_option_number = 'j';
                                    }
                                } else if (value.practice_type ==
                                    "choiceOneInFour_Odd") {
                                    if (key == 0) {
                                        get_option_number = 'a';
                                    } else if (key == 1) {
                                        get_option_number = 'b';
                                    } else if (key == 2) {
                                        get_option_number = 'c';
                                    } else if (key == 3) {
                                        get_option_number = 'd';
                                    }
                                } else if (value.practice_type ==
                                    "choiceOneInFour_Even") {
                                    if (key == 0) {
                                        get_option_number = 'f';
                                    } else if (key == 1) {
                                        get_option_number = 'g';
                                    } else if (key == 2) {
                                        get_option_number = 'h';
                                    } else if (key == 3) {
                                        get_option_number = 'j';
                                    }
                                } else if (value.practice_type ==
                                    "choiceMultInFourFill" && val
                                    .is_multiple_choice == 2) {
                                    if (key == 0) {
                                        get_option_number = val
                                            .question_answer;
                                    }

                                } else {
                                    if (key == 0) {
                                        get_option_number = 'a';
                                    } else if (key == 1) {
                                        get_option_number = 'b';
                                    } else if (key == 2) {
                                        get_option_number = 'c';
                                    } else if (key == 3) {
                                        get_option_number = 'd';
                                    }
                                }

                                if (selected_answer[value.id] !==
                                    '' &&
                                    selected_answer[value.id] !==
                                    undefined
                                ) {
                                    if (jQuery.type(value
                                            .is_multiple_choice) ==
                                        'null') {
                                        if (selected_answer[value
                                                .question_id] ==
                                            get_option_number) {
                                            set_questions_options +=
                                                '<div class="space-y-2 d-inline-block">';
                                            set_questions_options +=
                                                '<div class="form-check"><input class="selected-option form-check-input" type="radio" id="' +
                                                get_option_number +
                                                '" name="example-radios-default-' +
                                                value
                                                .id + '" value="' +
                                                get_option_number +
                                                '" checked ><label class="form-check-label" for="' +
                                                get_option_number + '">' +
                                                get_option_number
                                                .toUpperCase() + '. ' + val +
                                                '</label></div></div>'
                                        } else {
                                            set_questions_options +=
                                                '<div class="space-y-2 d-inline-block">';
                                            set_questions_options +=
                                                '<div class="form-check"><input class="selected-option form-check-input" type="radio" id="' +
                                                get_option_number +
                                                '" name="example-radios-default-' +
                                                value
                                                .id + '" value="' +
                                                get_option_number +
                                                '"><label class="form-check-label" for="' +
                                                get_option_number + '">' +
                                                get_option_number
                                                .toUpperCase() + '. ' + val +
                                                '</label></div></div>'
                                        }
                                    } else {
                                        var array = selected_answer[value.id]
                                            .split(',');
                                        if (jQuery.inArray(get_option_number,
                                                array) ==
                                            -1) {
                                            if (jQuery.type(value
                                                    .is_multiple_choice) ==
                                                'null') {
                                                set_questions_options +=
                                                    '<div class="space-y-2 d-inline-block">';
                                                set_questions_options +=
                                                    '<div class="form-check"><input class="selected-option form-check-input" type="radio" id="' +
                                                    get_option_number +
                                                    '" name="example-radios-default-' +
                                                    value
                                                    .id + '"  value="' +
                                                    get_option_number +
                                                    '"><label class="form-check-label" for="' +
                                                    get_option_number + '">' +
                                                    get_option_number
                                                    .toUpperCase() + '. ' +
                                                    val +
                                                    '</label></div></div>';
                                            } else if (value
                                                .is_multiple_choice ==
                                                1) {
                                                set_questions_options +=
                                                    '<div class="space-y-2 d-inline-block">';
                                                set_questions_options +=
                                                    '<div class="form-check"><input class="selected-option form-check-input" type="checkbox" id="' +
                                                    get_option_number +
                                                    '" name="example-checkbox-default-' +
                                                    value
                                                    .id + '"  value="' +
                                                    get_option_number +
                                                    '"><label class="form-check-label" for="' +
                                                    get_option_number + '">' +
                                                    get_option_number
                                                    .toUpperCase() + '. ' +
                                                    val +
                                                    '</label></div></div>';
                                            } else if (value
                                                .is_multiple_choice ==
                                                2) {
                                                set_questions_options +=
                                                    '<div class="space-y-2 d-inline-block"><input type="text" class="selected-option" id="' +
                                                    get_option_number +
                                                    '" name="example-textbox-default-' +
                                                    value
                                                    .id + '" value="' +
                                                    array + '"></div>';
                                            } else {
                                                set_questions_options +=
                                                    '<div class="space-y-2 d-inline-block">';
                                                set_questions_options +=
                                                    '<div class="form-check"><input class="selected-option form-check-input" type="radio" id="' +
                                                    get_option_number +
                                                    '" name="example-radios-default-' +
                                                    value
                                                    .id + '" value="' +
                                                    get_option_number +
                                                    '"><label class="form-check-label" for="' +
                                                    get_option_number + '">' +
                                                    get_option_number
                                                    .toUpperCase() + '. ' +
                                                    val +
                                                    '</label></div></div>'
                                            }
                                        }

                                        $.each(array, function(index, value) {
                                            if (value ==
                                                get_option_number) {
                                                if (jQuery.type(value
                                                        .is_multiple_choice
                                                    ) ==
                                                    'null') {
                                                    set_questions_options
                                                        +=
                                                        '<div class="space-y-2 d-inline-block">';
                                                    set_questions_options
                                                        +=
                                                        '<div class="form-check"><input class="selected-option form-check-input" type="radio" id="' +
                                                        get_option_number +
                                                        '" name="selected-option example-radios-default-' +
                                                        value
                                                        .id +
                                                        '" checked value="' +
                                                        get_option_number +
                                                        '"><label class="form-check-label" for="' +
                                                        get_option_number +
                                                        '">' +
                                                        get_option_number
                                                        .toUpperCase() +
                                                        '. ' + val +
                                                        '</label></div></div>'
                                                } else if (value
                                                    .is_multiple_choice ==
                                                    1) {
                                                    set_questions_options
                                                        +=
                                                        '<div class="space-y-2 d-inline-block">';
                                                    set_questions_options
                                                        +=
                                                        '<div class="form-check"><input class="selected-option form-check-input" type="checkbox" id="' +
                                                        get_option_number +
                                                        '" name="example-checkbox-default-' +
                                                        value
                                                        .id +
                                                        '" checked value="' +
                                                        get_option_number +
                                                        '"><label class="form-check-label" for="' +
                                                        get_option_number +
                                                        '">' +
                                                        get_option_number
                                                        .toUpperCase() +
                                                        '. ' + val +
                                                        '</label></div></div>'
                                                } else if (value
                                                    .is_multiple_choice ==
                                                    2) {
                                                    set_questions_options
                                                        +=
                                                        '<div class="space-y-2 d-inline-block"><input type="text" id="' +
                                                        get_option_number +
                                                        '" name="example-textbox-default-' +
                                                        value
                                                        .id +
                                                        '" class="selected-option" value="' +
                                                        value +
                                                        '" ></div>';
                                                } else {
                                                    set_questions_options
                                                        +=
                                                        '<div class="space-y-2 d-inline-block">';
                                                    set_questions_options
                                                        +=
                                                        '<div class="form-check"><input class="selected-option form-check-input" type="radio" id="' +
                                                        get_option_number +
                                                        '" name="example-radios-default-' +
                                                        value
                                                        .id +
                                                        '" checked value="' +
                                                        get_option_number +
                                                        '"><label class="form-check-label" for="' +
                                                        get_option_number +
                                                        '">' +
                                                        get_option_number
                                                        .toUpperCase() +
                                                        '. ' + val +
                                                        '</label></div></div>'
                                                }
                                            }
                                        });
                                    }
                                } else {
                                    if (jQuery.type(value
                                            .is_multiple_choice) ==
                                        'null') {
                                        let selectStr = '';
                                        if (existingProgress) {
                                            let progress_selected_ans_Array =
                                                JSON
                                                .parse(
                                                    existingProgress
                                                    .selected_answer);
                                            if (progress_selected_ans_Array?.[
                                                    questionId
                                                ] ===
                                                get_option_number) {
                                                selectStr = ' checked=checked ';
                                            }
                                        }

                                        set_questions_options +=
                                            '<div class="space-y-2 d-inline-block">';
                                        set_questions_options +=
                                            '<div class="form-check"><input class="selected-option form-check-input" type="radio" id="' +
                                            get_option_number +
                                            '" name="example-radios-default-' +
                                            value
                                            .id + '" value="' +
                                            get_option_number + '" ' +
                                            selectStr +
                                            '><label class="form-check-label" for="' +
                                            get_option_number + '">' +
                                            get_option_number
                                            .toUpperCase() + '. ' + val +
                                            '</label></div></div>'
                                    } else if (value.is_multiple_choice ==
                                        1) {
                                        let selectStr = '';
                                        if (existingProgress) {
                                            let progress_selected_ans_Array =
                                                JSON
                                                .parse(
                                                    existingProgress
                                                    .selected_answer);
                                            if (progress_selected_ans_Array?.[
                                                    questionId
                                                ] ===
                                                get_option_number) {
                                                selectStr = ' checked=checked ';
                                            }
                                        }
                                        set_questions_options +=
                                            '<div class="space-y-2 d-inline-block">';
                                        set_questions_options +=
                                            '<div class="form-check"><input class="selected-option form-check-input" type="checkbox" id="' +
                                            get_option_number +
                                            '" name="example-checkbox-default-' +
                                            value
                                            .id + '" value="' +
                                            get_option_number + '" ' +
                                            selectStr +
                                            '><label class="form-check-label" for="' +
                                            get_option_number + '">' +
                                            get_option_number
                                            .toUpperCase() + '. ' + val +
                                            '</label></div></div>'
                                    } else if (value.is_multiple_choice ==
                                        2) {
                                        set_questions_options +=
                                            '<div class="space-y-2 d-inline-block"><input type="text" id="' +
                                            get_option_number +
                                            '" name="example-textbox-default" ></div>';
                                    } else {
                                        let selectStr = '';
                                        if (existingProgress) {
                                            let progress_selected_ans_Array =
                                                JSON
                                                .parse(
                                                    existingProgress
                                                    .selected_answer);
                                            if (progress_selected_ans_Array?.[
                                                    questionId
                                                ] ===
                                                get_option_number) {
                                                selectStr = ' checked=checked ';
                                            }
                                        }
                                        set_questions_options +=
                                            '<div class="space-y-2 d-inline-block">';
                                        set_questions_options +=
                                            '<div class="form-check"><input class="selected-option form-check-input" type="radio" id="' +
                                            get_option_number +
                                            '" name="example-radios-default-' +
                                            value
                                            .id + '" value="' +
                                            get_option_number + '" ' +
                                            selectStr +
                                            '><label class="form-check-label" for="' +
                                            get_option_number + '">' +
                                            get_option_number
                                            .toUpperCase() + '. ' + val +
                                            '</label></div></div>'
                                    }
                                }

                            });


                            set_questions_options += `   <label
                            class="fw-semibold me-1 checkbox-button main_skip_section-${value.id}">
                            <input type="checkbox" class="skip-${value.id}" />
                            <i class="fa-solid fa-circle-arrow-right arrow-${value.id}"></i>                        
                            </label>
                        <label
                            class="fw-semibold me-1 checkbox-button main_guess_section-${value.id}">
                            <input type="checkbox" class="guess-${value.id}" />
                            <i class="fa-solid fa-question ques-${value.id}" style="font-size: 22px;
    color: gray;"></i>                        </label> 
                      

                            <label
                            class="fw-semibold me-1 checkbox-button main_flag_section-${value.id}">
                            <input type="checkbox" class="flag-${value.id}" />
                            <i class="fa fa-fw fa-flag flagy-${value.id} me-1" style="font-size: 22px;
    color: #ff0000;"></i>
                        </label></div> </div>`;


                        });
                        if (totalQuestions > 10) {
                            setTimeout(function() {
                                let mydiv = document.getElementById('half-height');
                                if (mydiv) {
                                    mydiv.style.height = (capturedHeight / 2 + 30) + 'px';
                                }
                            }, 100);
                        }
                        set_questions_options += '</div>';

                        jQuery('#set_question_data').html(set_questions_options);

                    }



                });
            }

            $(document).on('click', '.question-button', function() {
                var get_question_id = jQuery('.get_question_id').val();
                let data_count = jQuery(this).attr('data-count');
                data_count = parseInt(data_count);
                var get_offset = data_count;

                jQuery('.next').attr('data-count', data_count);
                jQuery('.prev').attr('data-count', data_count);

                let arr_index = data_count;
                $('#onload_question_id').val(question_id_arr[arr_index]);


                if ($("input[name='example-radios-default']").is(':checked')) {
                    var getSelectedAnswer = $("input[name='example-radios-default']:checked").val();
                    selected_answer[get_question_id] = getSelectedAnswer;
                } else if ($("input[name='example-checkbox-default']").is(':checked')) {
                    var store_multi = '';
                    $('input[name="example-checkbox-default"]:checked').each(function() {
                        store_multi += this.value + ',';
                    });
                    store_multi = store_multi.replace(/,\s*$/, "");
                    selected_answer[get_question_id] = store_multi;
                } else if ($("input[name='example-textbox-default']")) {
                    store_multi = $("input[name='example-textbox-default']").val();
                    selected_answer[get_question_id] = store_multi;
                }

                if (!$(".guess").is(':checked')) {
                    selected_gusess_details[get_question_id] = 'no';
                }

                if (!$(".flag").is(':checked')) {
                    selected_flag_details[get_question_id] = 'no';
                }

                if (!$(".skip").is(':checked')) {
                    selected_skip_details[get_question_id] = 'no';
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
                        get_question_id: get_question_id,
                        scroll_position: scroll_position
                    },
                    success: function(result) {}
                });
                swal.close();
            });
        });

        function get_time() {
            let option = new URLSearchParams(window.location.search);
            let OptionValue = option.get('time');
            let section_id = $('#section_id').val();
            let question_type = $('#get_question_type').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{ route('get_time') }}",
                method: 'post',
                data: {
                    'time': OptionValue,
                    'section_id': section_id,
                    question_type: question_type,
                },
                success: function(result) {
                    if (result.progressFlag) {
                        $('#time_selected').val(result.time_left);
                    } else {
                        if (OptionValue == 'regular') {
                            $('#time_selected').val(result.time.regular_time);
                        } else if (OptionValue == '50per') {
                            $('#time_selected').val(result.time.fifty_per_extended);
                        } else if (OptionValue == '100per') {
                            $('#time_selected').val(result.time.hundred_per_extended);
                        } else {
                            $('#time_selected').val('00:00:00');
                        }
                    }

                    var targetTime = $('#time_selected').val();
                    var parts = targetTime.split(':');
                    var targetHours = parseInt(parts[0], 10);
                    var targetMinutes = parseInt(parts[1], 10);
                    var targetSeconds = parseInt(parts[2], 10);
                    var targetMilliseconds = ((targetHours * 60 * 60) + (targetMinutes * 60) +
                            targetSeconds) *
                        1000;

                    var hours = targetHours;
                    var minutes = targetMinutes;
                    var seconds = targetSeconds;
                    var elapsedMilliseconds = 0;

                    var actual_hours = 0;
                    var actual_minutes = 0;
                    var actual_seconds = 0;

                    //Array for progress saving Starts
                    var selected_answer = [];
                    var selected_gusess_details = [];
                    var selected_flag_details = [];
                    var selected_skip_details = [];
                    //Array for progress saving Ends
                    var get_test_id = '';
                    const urlParams = new URLSearchParams(window.location.search);
                    get_test_id = urlParams.get('test_id');

                    var timerInterval = setInterval(function() {
                        elapsedMilliseconds += 1000;

                        actual_hours = Math.floor(elapsedMilliseconds / (60 * 60 * 1000));
                        actual_minutes = Math.floor((elapsedMilliseconds % (60 * 60 * 1000)) / (
                            60 *
                            1000));
                        actual_seconds = Math.floor((elapsedMilliseconds % (60 * 1000)) / 1000);

                        if (elapsedMilliseconds < targetMilliseconds && OptionValue !=
                            'untimed') {
                            var remainingMilliseconds = targetMilliseconds -
                                elapsedMilliseconds;
                            hours = Math.floor(remainingMilliseconds / (60 * 60 * 1000));
                            minutes = Math.floor((remainingMilliseconds % (60 * 60 * 1000)) / (
                                60 *
                                1000));
                            seconds = Math.floor((remainingMilliseconds % (60 * 1000)) / 1000);
                        } else if (OptionValue == 'untimed') {
                            var remainingMilliseconds = targetMilliseconds +
                                elapsedMilliseconds;
                            hours = Math.floor(remainingMilliseconds / (60 * 60 * 1000));
                            minutes = Math.floor((remainingMilliseconds % (60 * 60 * 1000)) / (
                                60 *
                                1000));
                            seconds = Math.floor((remainingMilliseconds % (60 * 1000)) / 1000);
                        } else {
                            clearInterval(timerInterval);
                            hours = 0;
                            minutes = 0;
                            seconds = 0;
                        }

                        var formattedHours = hours.toString().padStart(2, '0');
                        var formattedMinutes = minutes.toString().padStart(2, '0');
                        var formattedSeconds = seconds.toString().padStart(2, '0');

                        var formattedActualHours = actual_hours.toString().padStart(2, '0');
                        var formattedActualMinutes = actual_minutes.toString().padStart(2, '0');
                        var formattedActualSeconds = actual_seconds.toString().padStart(2, '0');

                        $('#timer').text(formattedHours + ':' + formattedMinutes + ':' +
                            formattedSeconds);
                        $('#actual_time').val(formattedActualHours + ':' +
                            formattedActualMinutes +
                            ':' + formattedActualSeconds);

                        if (OptionValue != 'untimed') {
                            if (hours === 0 && minutes === 5 && seconds === 0) {
                                swal({
                                    icon: 'warning',
                                    title: 'Time is elapsed!',
                                    text: 'You have 5 minutes remaining.',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                });
                            }

                            if (hours === 0 && minutes === 0 && seconds === 0) {
                                clearInterval(timerInterval);
                                swal({
                                    icon: 'warning',
                                    title: 'Time is over!',
                                    text: 'Your time has expired.',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Continue'
                                }, function(isConfirm) {
                                    $('#timeisover').val(1);
                                    if (isConfirm) {
                                        $('.submit_section_btn').trigger('click');
                                    }
                                });
                            }
                        }


                        //Progress Saving Starts
                        let progress_index = jQuery('.next').attr('data-count');
                        var get_question_id = jQuery('#onload_question_id').val();

                        let selected_flag_val;
                        if ($(".flag").is(':checked')) {
                            selected_flag_val = 'yes';
                        } else {
                            selected_flag_val = 'no';
                        }

                        let selected_skip_val;
                        if ($(".skip").is(':checked')) {
                            selected_skip_val = 'yes';
                        } else {
                            selected_skip_val = 'no';
                        }

                        let selected_guess_val;
                        if ($(".guess").is(':checked')) {
                            selected_guess_val = 'yes';
                        } else {
                            selected_guess_val = 'no';
                        }

                        var get_section_id = jQuery('#section_id').val();
                        var get_question_type = jQuery('#get_question_type').val();
                        var get_practice_id = jQuery(this).attr('data-practice_test_id');

                        let question_ids = @json($total_questions);
                        var actual_time = jQuery('#actual_time').val();

                        if ($("input[name='example-radios-default']").is(':checked')) {
                            var getSelectedAnswer = $(
                                    "input[name='example-radios-default']:checked")
                                .val();
                            selected_answer[get_question_id] = getSelectedAnswer;
                        } else if ($("input[name='example-checkbox-default']").is(':checked')) {
                            var store_multi = '';
                            $('input[name="example-checkbox-default"]:checked').each(
                                function() {
                                    store_multi += this.value + ',';
                                });
                            store_multi = store_multi.replace(/,\s*$/, "");
                            selected_answer[get_question_id] = store_multi;
                        } else if ($("input[name='example-textbox-default']")) {
                            store_multi = $("input[name='example-textbox-default']").val();
                            selected_answer[get_question_id] = store_multi;
                        } else {
                            selected_answer[get_question_id] = '-';
                        }

                        Array.prototype.associate = function(keys) {
                            var result = {};

                            this.forEach(function(el, i) {
                                result[keys[i]] = el;
                            });
                            return result;
                        };

                        let answer_details = [];
                        for (let index = 0; index < question_ids.length; index++) {
                            if (selected_answer.hasOwnProperty(question_ids[index])) {
                                answer_details[question_ids[index]] = selected_answer[
                                    question_ids[
                                        index]];
                            } else {
                                answer_details[question_ids[index]] = '-';
                            }
                        }

                        answer_details = answer_details.filter(function(element, key) {
                            return element !== 'undefined';
                        });

                        answer_details = answer_details.associate(question_ids);

                        {{-- $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                        jQuery.ajax({
                            url: "{{ url('/user/test-progress/store') }}",
                            method: 'post',
                            data: {
                                selected_answer: answer_details,
                                selected_guess_val: selected_guess_val,
                                selected_flag_val: selected_flag_val,
                                selected_skip_val: selected_skip_val,
                                get_section_id: get_section_id,
                                get_practice_id: get_test_id,
                                get_question_type: get_question_type,
                                progress_index: progress_index,
                                curr_question_id: get_question_id,
                                actual_time: actual_time,
                                time_left: formattedHours + ':' + formattedMinutes + ':' +
                                    formattedSeconds
                            },
                            success: function(result) {

                                storedSelectedAnswers = result?.data?.selected_answer;
                                if (typeof result !== 'undefined' && result.message ===
                                    'delete') {
                                    clearInterval(timerInterval);
                                }
                            }
                        }); --}}
                        //Progress Saving Ends
                    }, 1000);
                }
            });
        }

        async function storeProgress() {
            console.log('start')
            let option = new URLSearchParams(window.location.search);
            let OptionValue = option.get('time');
            var targetTime = $('#time_selected').val();
            var parts = targetTime.split(':');
            var targetHours = parseInt(parts[0], 10);
            var targetMinutes = parseInt(parts[1], 10);
            var targetSeconds = parseInt(parts[2], 10);
            var targetMilliseconds = ((targetHours * 60 * 60) + (targetMinutes * 60) + targetSeconds) *
                1000;

            var hours = targetHours;
            var minutes = targetMinutes;
            var seconds = targetSeconds;
            var elapsedMilliseconds = 0;

            var actual_hours = 0;
            var actual_minutes = 0;
            var actual_seconds = 0;

            //Array for progress saving Starts
            var selected_answer = [];
            var selected_gusess_details = [];
            var selected_flag_details = [];
            var selected_skip_details = [];
            //Array for progress saving Ends
            var get_test_id = '';
            const urlParams = new URLSearchParams(window.location.search);
            get_test_id = urlParams.get('test_id');
            elapsedMilliseconds += 1000;
            actual_hours = Math.floor(elapsedMilliseconds / (60 * 60 * 1000));
            actual_minutes = Math.floor((elapsedMilliseconds % (60 * 60 * 1000)) / (60 *
                1000));
            actual_seconds = Math.floor((elapsedMilliseconds % (60 * 1000)) / 1000);

            if (elapsedMilliseconds < targetMilliseconds && OptionValue != 'untimed') {
                var remainingMilliseconds = targetMilliseconds - elapsedMilliseconds;
                hours = Math.floor(remainingMilliseconds / (60 * 60 * 1000));
                minutes = Math.floor((remainingMilliseconds % (60 * 60 * 1000)) / (60 *
                    1000));
                seconds = Math.floor((remainingMilliseconds % (60 * 1000)) / 1000);
            } else if (OptionValue == 'untimed') {
                var remainingMilliseconds = targetMilliseconds + elapsedMilliseconds;
                hours = Math.floor(remainingMilliseconds / (60 * 60 * 1000));
                minutes = Math.floor((remainingMilliseconds % (60 * 60 * 1000)) / (60 *
                    1000));
                seconds = Math.floor((remainingMilliseconds % (60 * 1000)) / 1000);
            } else {
                {{-- console.log(timerInterval)
                if(timerInterval != undefined){
                    clearInterval(timerInterval);
                } --}}
                hours = 0;
                minutes = 0;
                seconds = 0;
            }

            var formattedHours = hours.toString().padStart(2, '0');
            var formattedMinutes = minutes.toString().padStart(2, '0');
            var formattedSeconds = seconds.toString().padStart(2, '0');

            var formattedActualHours = actual_hours.toString().padStart(2, '0');
            var formattedActualMinutes = actual_minutes.toString().padStart(2, '0');
            var formattedActualSeconds = actual_seconds.toString().padStart(2, '0');
            //Progress Saving Starts
            let progress_index = jQuery('.next').attr('data-count');
            var get_question_id = jQuery('#onload_question_id').val();

            let selected_flag_val;
            if ($(".flag").is(':checked')) {
                selected_flag_val = 'yes';
            } else {
                selected_flag_val = 'no';
            }

            let selected_skip_val;
            if ($(".skip").is(':checked')) {
                selected_skip_val = 'yes';
            } else {
                selected_skip_val = 'no';
            }

            let selected_guess_val;
            if ($(".guess").is(':checked')) {
                selected_guess_val = 'yes';
            } else {
                selected_guess_val = 'no';
            }

            var get_section_id = jQuery('#section_id').val();
            var get_question_type = jQuery('#get_question_type').val();
            var get_practice_id = jQuery(this).attr('data-practice_test_id');

            let question_ids = @json($total_questions);
            var actual_time = jQuery('#actual_time').val();

            if ($("input[name='example-radios-default']").is(':checked')) {
                var getSelectedAnswer = $("input[name='example-radios-default']:checked")
                    .val();
                selected_answer[get_question_id] = getSelectedAnswer;
            } else if ($("input[name='example-checkbox-default']").is(':checked')) {
                var store_multi = '';
                $('input[name="example-checkbox-default"]:checked').each(function() {
                    store_multi += this.value + ',';
                });
                store_multi = store_multi.replace(/,\s*$/, "");
                selected_answer[get_question_id] = store_multi;
            } else if ($("input[name='example-textbox-default']")) {
                store_multi = $("input[name='example-textbox-default']").val();
                selected_answer[get_question_id] = store_multi;
            } else {
                selected_answer[get_question_id] = '-';
            }

            Array.prototype.associate = function(keys) {
                var result = {};

                this.forEach(function(el, i) {
                    result[keys[i]] = el;
                });
                return result;
            };

            let answer_details = [];
            for (let index = 0; index < question_ids.length; index++) {
                if (selected_answer.hasOwnProperty(question_ids[index])) {
                    answer_details[question_ids[index]] = selected_answer[question_ids[
                        index]];
                } else {
                    answer_details[question_ids[index]] = '-';
                }
            }

            answer_details = answer_details.filter(function(element, key) {
                return element !== 'undefined';
            });

            answer_details = answer_details.associate(question_ids);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            console.log(JSON.stringify({
                selected_answer: answer_details,
            }));
            return jQuery.ajax({
                url: "{{ url('/user/test-progress/store') }}",
                method: 'post',
                data: {
                    selected_answer: answer_details,
                    selected_guess_val: selected_guess_val,
                    selected_flag_val: selected_flag_val,
                    selected_skip_val: selected_skip_val,
                    get_section_id: get_section_id,
                    get_practice_id: get_test_id,
                    get_question_type: get_question_type,
                    progress_index: progress_index,
                    curr_question_id: get_question_id,
                    actual_time: actual_time,
                    time_left: formattedHours + ':' + formattedMinutes + ':' +
                        formattedSeconds
                },
                success: function(result) {
                    console.log('end')
                    storedSelectedAnswers = result?.data?.selected_answer;
                }
            });
            //Progress Saving Ends
        }
    </script>
@endsection
