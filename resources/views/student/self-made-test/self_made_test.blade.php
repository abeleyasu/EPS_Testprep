@extends('layouts.user')

@section('title', 'Self Made Test: CPS')

@section('user-content')
    <main id="main-container">
        <div class="bg-image"
            style="background-image: url('assets/cpsmedia/BlackboardImage.jpg'); position: sticky;
        top: 46px;
        z-index: 99;
        background: #ebeef2;">
            <div class="bg-black-10">
                <div class="content content-full text-center">
                    <br>

                    <h1 class="h2 text-white mb-0">Self Made Test</h1>
                    <br>
                    <span class="text-white-75">ACT/SAT/PSAT</span>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="card p-3  col-lg-10 mx-lg-auto ">
                <div class="p-3 m-3 mb-0 sticky-tab">
                    <h5 class="font-weight-light">Choose a Test</h5>
                    <div class="d-flex align-items-center p-3 py-0">
                        <button style="padding: 5px 20px fs-5" class=" btn btn-alt-success text-success me-3 test_type"
                            data-value="PSAT">PSAT</button>
                        <button style="padding: 5px 20px fs-5" class="btn btn-alt-success text-success me-3 test_type"
                            data-value="SAT">SAT</button>
                        <button style="padding: 5px 20px fs-5" class="btn btn-alt-success text-success test_type"
                            data-value="ACT">ACT</button>
                        {{-- <div class="d-flex justify-content-end "> --}}
                        <button onclick="getData()" class="btn btn-gray bg-dark text-gray ms-auto"
                            style="position: fixed; right: 11%;">Generate Quiz</button>
                        {{-- </div> --}}
                    </div>
                </div>

                <div class="tab-content p-3 " id="nav-tabContent">
                    {{-- tab 1 --}}
                    <div class="tab-pane fade  active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        {{-- accordion-collapse 1 --}}
                        <div>
                            <div class="accordion" id="accordionExample">
                                {{-- collaps 1 --}}
                                <div class="accordion-item">
                                    <div class="border mb-3 ">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button border-0 fw-bold" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#tabOne" aria-expanded="true"
                                                aria-controls="tabOne"><span class="me-2"><i
                                                        class="nav-main-link-icon fa fa-circle-check"></i></span>
                                                Choose Section
                                            </button>
                                        </h2>
                                        <div id="tabOne" class="accordion-collapse collapse "
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="ms-4 section_type">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- collaps 2 --}}
                                </div>
                                <div class="accordion-item">
                                    <div class="border mb-3">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed border-0 fw-bold" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree"><span class="me-2"><i
                                                        class="nav-main-link-icon fa fa-circle-check"></i></span>
                                                Practice Specific Concepts
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <h6>Which Concepts Do You Want To Practice / Master Today?</h6>
                                                <div class="col-12 d-flex flex-wrap justify-content-between">
                                                    <div class="col-sm-6 test-category">

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <div class="border">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed border-0 fw-bold" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo"><span class="me-2"><i
                                                        class="nav-main-link-icon fa fa-circle-check"></i></span>
                                                Choose Difficulty
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class=" col-6 accordion-collapse collapse"
                                            aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <?php $helper = new Helper();
                                                $ratings = $helper->getAllDifficultyRating();
                                                ?>
                                                <div>
                                                    <div class="ms-4 diff_rating">
                                                        @if (isset($ratings))
                                                            <div class="mb-5">
                                                                @foreach ($ratings['ratings'] as $rating)
                                                                    <div class="mb-2">
                                                                        <input type="checkbox" name="item"
                                                                            id="item-{{ $loop->iteration }}"
                                                                            value="{{ $rating['id'] }}"
                                                                            class="selected-item">
                                                                        <label for="item-{{ $loop->iteration }}"
                                                                            class="ms-2">{{ $rating['title'] }}</label><span
                                                                            class="ms-2 diff_{{ $rating['id'] }}"></span>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="mb-2">
                                                                <input type="radio" name="questions_type"
                                                                    id="all_unanswered" value="all_unanswered"
                                                                    class="questions_type">
                                                                <label for="all_unanswered" class="ms-2">All
                                                                    Unanswered <span class="ms-2 diff_5"></label>
                                                            </div>
                                                            <div class="mb-2">
                                                                <input type="radio" name="questions_type"
                                                                    id="all_questions" value="all_questions"
                                                                    class="questions_type" checked>
                                                                <label for="all_questions" class="ms-2">All
                                                                    Questions <span class="ms-2 diff_6"></label>
                                                                <input type="number" name="no_of_questions"
                                                                    id="no_of_questions"
                                                                    placeholder="Enter number of questions"
                                                                    class="no_of_questions" checked>
                                                            </div>
                                                        @endif
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
            </div>
        </div>
    </main>

@endsection

@section('page-script')
    <script src="{{ asset('assets/js/toastr/toastr.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        var check_temp = [];
        var count_data = {};
        $(document).on('click', '.test_type', function() {
            let value = $(this).attr('data-value');
            $(".test_type").removeClass("active-tab");
            $(this).addClass("active-tab");
            // new for the section type
            let sat_sections = ['Reading', 'Writing', 'Math_no_calculator', 'Math_with_calculator'];
            let act_sections = ['English', 'Math', 'Reading', 'Science'];
            if (value == 'SAT' || value == 'PSAT') {
                $('.section_type').html('');
                html = ``;
                $.each(sat_sections, function(i, v) {
                    html += `<div class="mb-2">`;
                    html += `<input type="radio" name="section" id="${v}" value="${v}">`;
                    html += `<label for="${v}" class="ms-2">${v}</label>`;
                    html += `</div>`;
                });
            } else if (value == 'ACT') {
                $('.section_type').html('');
                html = ``;
                $.each(act_sections, function(i, v) {
                    html += `<div class="mb-2">`;
                    html += `<input type="radio" name="section" id="${v}" value="${v}">`;
                    html += `<label for="${v}" class="ms-2">${v}</label>`;
                    html += `</div>`;
                });
            }
            $('.section_type').append(html);
        });

        function getTypeFunctionality(callback) {
            let value = $('.section_type').find('input[type="radio"]:checked').val();
            let test_type = $(".test_type.active-tab").attr('data-value');
            let checkValue1 = [];
            $('.test-category .super_category').each(function() {
                if ($(this).prop('checked')) {
                    checkValue1.push($(this).val());
                }
            });

            let checkValue2 = [];
            $('.test-category .question_category').each(function() {
                if ($(this).prop('checked')) {
                    checkValue2.push($(this).val());
                }
            });

            let checkValue3 = [];
            $('.test-category .question_type').each(function() {
                if ($(this).prop('checked')) {
                    checkValue3.push($(this).val());
                }
            });

            let diff_rating = [];
            $('.selected-item').each(function() {
                if ($(this).prop('checked')) {
                    diff_rating.push($(this).val());
                }
            });

            $.ajax({
                type: 'post',
                url: '{{ route('gettypes') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    test_type: test_type,
                    section_type: value,
                    super_category: checkValue1,
                    question_category: checkValue2,
                    question_type: checkValue3,
                    diff_rating: diff_rating,
                },
                success: function(res) {
                    callback(res);
                }
            });
        };

        $(".selected-item").change(function() {
            getTypeFunctionality((res) => {
                count_data = res.count;
            });
        })
        $(document).on('change', '.section_type', function() {
            if ($(this).find('input[type="radio"]:checked').length > 0) {
                getTypeFunctionality((res) => {
                    count_data = res.count;
                    $.each(res.count, function(i, v) {
                        $(`.diff_${i}`).html(`(${v.count})`);
                    });
                    $('.test-category').html('');
                    let super_category = ``;
                    $.each(res.super_category, function(i, v) {
                        const super_category_id = v['id'];
                        super_category += `<div class="mb-2 criteria">`;
                        super_category +=
                            `<input type="checkbox" id="${v['title']}" value="${v['id']}" class="super_category">`;
                        super_category +=
                            `<label for="${v['title']}" class="fw-bold ms-2">${v['title']}</label>`;
                        // check_temp[super_category_id] = [];
                        let temp = {};
                        temp['super_category_id'] = v['id'];
                        $.each(res.category[v['id']], function(i, v) {
                            temp['category_id'] = v['id'];

                            super_category +=
                                `<div class="ms-4 mt-2 question_category_div">`;
                            super_category +=
                                `<input type="checkbox" id="${v['category_type_title']}" value="${v['id']}" class="question_category">`;
                            super_category +=
                                `<label for="${v['category_type_title']}" class="fw-bold ms-2">${v['category_type_title']}</label>`;
                            $.each(res.questionType[v['id']], function(i, v) {
                                temp['question_type_id'] = v['id'];
                                super_category += `<div class="ms-5 mt-2">`;
                                super_category +=
                                    `<input type="checkbox" id="${v['question_type_title']}" value="${v['id']}" class="question_type">`;
                                super_category +=
                                    `<label for="${v['question_type_title']}" class="fw-bold ms-2">${v['question_type_title']}</label>`;
                                super_category += `</div>`;
                            });
                            super_category += `</div>`;
                        });
                        check_temp.push(temp);
                        super_category += `</div>`;
                    });

                    $('.test-category').append(super_category);
                });
            }
        });

        $('.test_type').on('click', function() {
            $('.criteria').html('');
        });
        const getCountData = () => {
            getTypeFunctionality((res) => {
                count_data = res.count;
                $.each(res.count, function(i, v) {
                    $(`.diff_${i}`).html(`(${v.count})`);
                });
            });
        };

        $(document).on('change', '.super_category', function() {
            if ($(this).is(':checked')) {
                $(this).closest('.mb-2').find('.question_category, .question_type').prop('checked', true);
            } else {
                $(this).closest('.mb-2').find('.question_category, .question_type').prop('checked', false);
            }
            getCountData();
        });

        $(document).on('change', '.question_category', function() {
            if ($(this).is(':checked')) {
                $(this).closest('.mb-2').find('.super_category').prop('checked', true);
            } else {
                $(this).closest('.mb-2').find('.super_category').prop('checked', false);
            }
            getCountData();
        });

        $(document).on('change', '.question_type', function() {
            if ($(this).is(':checked')) {
                $(this).closest('.mb-2').find('.super_category').prop('checked', true);
                $(this).closest('.question_category_div').find('.question_category').prop("checked", true);
            } else {
                if ($(this).parent().siblings().find('.question_type').prop('checked')) {
                    $(this).closest('.mb-2').find('.super_category .question_category').prop('checked', true);
                } else {
                    $(this).closest('.mb-2').find('.super_category').prop('checked', false);
                    $(this).closest('.question_category_div').find('.question_category').prop("checked", false);
                }
            }
            getCountData();
        });


        function getData() {
            let checkValue1 = [];

            let question_ids = [];

            let no_of_questions = $("#no_of_questions").val();

            $('.test-category .super_category').each(function() {
                if ($(this).prop('checked')) {
                    checkValue1.push($(this).val());
                }
            });

            let checkValue2 = [];
            $('.test-category .question_category').each(function() {
                if ($(this).prop('checked')) {
                    checkValue2.push($(this).val());
                }
            });

            let checkValue3 = [];
            $('.test-category .question_type').each(function() {
                if ($(this).prop('checked')) {
                    checkValue3.push($(this).val());
                }
            });

            let checkValue4 = [];
            let i = 1;
            $('.diff_rating :checkbox:checked').each(function() {
                if ($(this).prop('checked')) {
                    checkValue4.push($(this).val());
                    question_ids = question_ids.concat(count_data[i]?.questions);
                }
                i++;
            });

            if ($("#all_questions").is(":checked")) {
                question_ids = count_data[5]?.questions;
            } else {
                no_of_questions = '';
            }

            let checkValue5 = [];
            $('.section_type :radio:checked').each(function() {
                if ($(this).prop('checked')) {
                    checkValue5.push($(this).val());
                }
            });

            toastr.options = {
                "progressBar": true,
                "closeButton": true,
                "timeOut": 4000,
            };
            if (checkValue4.length == 0) {
                toastr.error("Please choose the difficulty rating!");
                return false;
            }
            let questions_type = $(".questions_type").val();
            let val = $('.test_type.active-tab').attr('data-value');
            $.ajax({
                type: 'post',
                url: '{{ route('getSelfMadeTestQuestion') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    super_category: checkValue1,
                    category: checkValue2,
                    question_type: checkValue3,
                    diff_rating: checkValue4,
                    section_type: checkValue5,
                    test_type: val,
                    questions_type,
                    question_ids,
                    no_of_questions
                },
                success: function(res) {
                    if (res.status) {
                        let url = $('#site_url').val();
                        window.location.href = `${url}/user/practice-test-sections/${res.test_id}`;
                    } else {
                        toastr.options = {
                            "progressBar": true,
                            "closeButton": true,
                            "timeOut": 4000,
                        };
                        toastr.error("No questions for this difficulty rating!");
                        return false;
                    }
                }
            });
        }
    </script>
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/toastr/toastr.min.css') }}">
    <style>
        .accordion-item {
            background-color: #ffffff;
            border: none;
        }

        .accordion-button:not(.collapsed) {
            background: #fff;
            color: #334155;
            box-shadow: none;
        }

        .accordion-button {
            background-color: #fff
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .accordion-button::after {
            display: none
        }

        .test_type.active-tab {
            background-color: #567c21;
            color: #c4da9f !important;
        }

        .sticky-tab {
            position: sticky;
            top: 24.30%;
            background: #fff;
            display: inline-block;
            z-index: 999;
            border: 1px solid rgba(0, 0, 0, .125);
        }
    </style>
@endsection
