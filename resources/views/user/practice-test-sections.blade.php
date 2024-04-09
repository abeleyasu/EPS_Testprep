@extends('layouts.user')

@section('title', 'Student View Dashboard : CPS')

@section('page-script')
    <script>
        $(document).ready(function() {
            $("#categoryQuestion1").click(function() {
                $(this).toggleClass("show");
            });
        });

        $(document).ready(function() {
            let easyRemove = $('.easy-remove').val();
            if (easyRemove == 1) {
                $('#easy-id').hide();
            } else {
                $('#easy-id').show();

            }

            let mathRemove = $('.math-remove').val();
            if (mathRemove == 1) {
                $('#math-id').hide();
            } else {
                $('#math-id').show();

            }
        })

        $('input[type="checkbox"]').click(function(e) {
            e.stopPropagation()
        })
        $(document).on('click', '.start_section', function() {
            let section_id = $(this).attr('data-section_id');
            let test_id = $(this).attr('data-test_id');
            let option = $('#timingOption').val();
            let url = $('#site_url').val();
            $('.start_section').attr('href',
                `${url}/user/practice-test/${section_id}?test_id=${test_id}&time=${option}`);
        });

        $(document).on('click', '.official_start_section', function() {
            let section_id = $(this).attr('data-section_id');
            let test_id = $(this).attr('data-test_id');
            let option = $('#timingOption').val();
            let url = $('#site_url').val();
            $('.official_start_section').attr('href',
                `${url}/user/official-practice-test/${section_id}?test_id=${test_id}&time=${option}`);
        });

        $(document).on('click', '.official_module_start_section', function() {
            let section_id = $(this).attr('data-section_id');
            let test_id = $(this).attr('data-test_id');
            let option = $('#timingOption').val();
            let url = $('#site_url').val();
            $('.official_module_start_section').attr('href',
                `${url}/user/official-practice-test-module-2/${id}?test_id=${test_id}&time=${option}`);
        });

        $(document).on('click', '.official_proctored_module_start_section', function() {
            let section_id = $(this).attr('data-section_id');
            let test_id = $(this).attr('data-test_id');
            // console.log(test_id);
            var updatedtestid = test_id.replace(/[?&]test_section=[^&]*&?/i, '');
            let option = $('#timingOption').val();
            let url = $('#site_url').val();
            // console.log(updatedtestid)
            $('.official_proctored_module_start_section').attr('href',
                `${url}/user/official-practice-test/${section_id}?test_id=${updatedtestid}&time=${option}`);
        });

        $(document).on('click', '.start_all_section', function() {
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
                var testSource = $(this).attr('data-test-source');
                console.log(testSource);
                // $('.start_all_section').attr('href',`${url}/user/practice-test/all/${test_id}?time=${option}`);
                if (testSource != 1) {
                    $('.start_all_section').attr('href',
                        `${url}/user/practice-test/${section_id}?test_id=${test_id}&time=${option}&section=all&sections=${remainingSectionArrayJson}`
                    );
                } else {
                    $('.start_all_section').attr('href',
                        `${url}/user/official-practice-test/${section_id}?test_id=${test_id}&time=${option}&section=all&sections=${remainingSectionArrayJson}`
                    );
                }
                // $('.start_all_section').attr('href',`${url}/user/practice-test/all/${section_id}?time=${option}`);
            }

        });
    </script>

    <script>
        $(document).ready(function() {
            $('a').each(function() {
                var href = $(this).attr('href');
                var updatedHref = href.replace(/[?&]test_section=[^&]*&?/i, '');
                $(this).attr('href', updatedHref);
            });


        });
    </script>
@endsection

@section('user-content')
    <!-- Main Container -->

    @if (request()->session()->has('testType'))
        <input type="hidden" id="testType" value="{{ request()->session()->get('testType') }}" />
    @else
        <input type="hidden" id="testType" value="" />
    @endif
    <main id="main-container">
        <div class="bg-body-light">
            <div class="content content-boxed">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx text-dark" href="{{ url('user/test-prep-dashboard') }}">Practice Tests</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">College Prep System
                                {{ isset($testSection[0]->format) ? $testSection[0]->format : '' }}
                                {{ isset($testSection[0]->title) ? $testSection[0]->title : '' }}</a>
                        </li>
                        {{-- <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Sections</a>
                    </li> --}}
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Hero -->
        @if (isset($testSectionName) && !$testSectionName == 0)
            <div class="bg-body-light">
                <div class="content content-boxed">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                        <div class="flex-grow-1">
                            <h1 class="h3 fw-bold mb-2">
                                <span class='text-primary'>{{ $testSectionName }}</span> sections
                            </h1>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="w-75">
                                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">

                                        @if ($whichSection == 1)
                                            @if ($testSection[0]->format == 'DSAT' || $testSection[0]->format == 'DPSAT')
                                                @if ($testSection[0]->test_source == 1)
                                                    This test has 2 sections
                                                @endif
                                            @else
                                                This test has {{ $mainSectionsCount }} sections and
                                            @endif
                                        @else
                                            This test has {{ count($testSectionsDetails) }} sections and
                                        @endif



                                        {{-- isset($total_all_section_question) ? $total_all_section_question : '' --}}
                                        @if ($newTotal != 0)
                                            {{ $newTotal }}
                                        @elseif(isset($total_all_section_question))
                                            {{ $total_all_section_question }}
                                        @endif
                                        questions
                                    </h2>
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
                                {{-- @php
                                    dd($testSection[0]);
                                @endphp --}}
                                @if ($testSection[0]->test_source == 1 && ($testSection[0]->format == 'DSAT' || $testSection[0]->format == 'DPSAT'))
                                    <a href="{{ route('all_section', ['id' => $selected_test_id]) }}"
                                        style="white-space: nowrap" data-test_id="{{ $selected_test_id }}"
                                        class="btn btn-alt-primary fs-8  ms-2 start_all_section"
                                        data-test-source="{{ $testSection[0]->test_source }}">
                                        <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Start All Sections
                                    </a>
                                    <a href="{{ route('reset_test', ['id' => $testSection[0]->id]) . '?test_id=' . $testSection[0]->id . '&type=all' }}"
                                        style="white-space: nowrap" class="btn btn-alt-primary fs-8 mx-2">
                                        <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Reset Test
                                    </a>
                                @elseif (isset($testSections[0]->testid) && $firstSectionId != 0)
                                    @php
                                        $str =
                                            'test_id=' .
                                            $testSections[0]->testid .
                                            '&time=regular&section=all&sections=' .
                                            htmlspecialchars(json_encode($sectionIdsArray), JSON_NUMERIC_CHECK);
                                    @endphp
                                    <a href="{{ route('startAllSections', ['sec_id' => $firstSectionId, 'str' => $str, 'id' => $testSections[0]->testid]) }}"
                                        style="white-space: nowrap" data-test_id="{{ $selected_test_id }}"
                                        class="btn btn-alt-primary fs-8  ms-2">
                                        <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Start All Sections
                                    </a>
                                    <a href="{{ route('reset_test', ['id' => $testSections[0]->id]) . '?test_id=' . $testSections[0]->testid . '&type=all' }}"
                                        style="white-space: nowrap" class="btn btn-alt-primary fs-8 mx-2">
                                        <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Reset Test
                                    </a>
                                @else
                                    {{--
                                        <a href="#" style="white-space: nowrap" data-test_id="{{ $selected_test_id }}"
                                            class="btn btn-alt-primary fs-8  ms-2">
                                            <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Start All Sections
                                        </a>
                                        <a href="#"
                                            style="white-space: nowrap" class="btn btn-alt-primary fs-8 mx-2">
                                            <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Reset Test
                                        </a>
                                    --}}
                                    {{-- @php
                                        dd($testSection[0]->test_source);
                                    @endphp --}}
                                    <a href="{{ route('all_section', ['id' => $selected_test_id]) }}"
                                        style="white-space: nowrap" data-test_id="{{ $selected_test_id }}"
                                        class="btn btn-alt-primary fs-8  ms-2 start_all_section"
                                        data-test-source="{{ $testSection[0]->test_source }}">
                                        <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Start All Sections
                                    </a>
                                    <a href="{{ route('reset_test', ['id' => $testSection[0]->id]) . '?test_id=' . $testSection[0]->id . '&type=all' }}"
                                        style="white-space: nowrap" class="btn btn-alt-primary fs-8 mx-2">
                                        <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Reset Test
                                    </a>
                                @endif

                                {{--
                                @if ($check_test_completed == 'yes')
                                    @if (isset($testSections[0]) && !empty($testSections[0]))
                                        <a href="{{ route('single_review', ['test' => $testSections[0]->title, 'id' => $testSections[0]->testid]) . '?test_id=' . $testSections[0]->testid . '&type=all' }}"
                                            style="margin-right: 10px;white-space: nowrap"
                                            class="btn btn-alt-primary fs-8 ms-2">
                                            <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Review All Sections
                                        </a>
                                        <a href="{{ route('reset_test', ['id' => $testSections[0]->id]) . '?test_id=' . $testSections[0]->testid . '&type=all' }}"
                                            style="white-space: nowrap" class="btn btn-alt-primary fs-8 ">
                                            <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Reset Test
                                        </a>
                                    @endif
                                @elseif($check_test_completed == 'Yes')
                                    <a href="{{ route('all_section', ['id' => $selected_test_id]) }}" style="white-space: nowrap" data-test_id="{{ $selected_test_id }}"
                                        class="btn btn-alt-primary fs-8  ms-2 start_all_section">
                                        <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Start All Sections
                                    </a>
                                    <a href="{{ route('reset_test', ['id' => $testSections[0]->id]) . '?test_id=' . $testSections[0]->testid . '&type=all' }}"
                                        style="white-space: nowrap" class="btn btn-alt-primary fs-8 mx-2">
                                        <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Reset Test
                                    </a>
                                @else
                                    <a href="{{ route('all_section', ['id' => $selected_test_id]) }}" style=""
                                        class="btn btn-alt-primary fs-8">
                                        <i class="fa-solid fa-bolt" style='margin-right:5px'></i> Start All Sections
                                    </a>
                                @endif
                                --}}

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
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $link_array = explode('/', $url);
        $current_section_id = end($link_array);
        ?>
        <!-- Page Content -->
        <div class="content content-boxed">
            <!-- Timeline -->

            {{-- start Description  --}}
            <h6 class="fs-6 mb-3 p-2 test-description text-muted mt-2">
                {{-- isset($testSection[0]->description) ? $testSection[0]->description : '' --}}
                @if ($newTotal != 0)
                    {{ $newTotal }}
                @elseif(isset($total_all_section_question))
                    {{ $total_all_section_question }}
                @endif
                questions
            </h6>
            {{-- end Description --}}

            @if (isset($testSections) && !$testSections == 0)
                <ul class="timeline timeline-alt" style='padding: 0'>
                    @php
                        $sectionArray = [];
                        $key = 0;
                        $count = 0;

                        // dump($totalQuest);
                        // dump($totalAttempetdQuestions);
                        // dump($totalNonAttempetdQuestions);

                        // dump($newTotal);
                        // dump($mathCount);
                        // dump($rwCount);
                        // dump($testSectionsDetails);
                        // dump($score);

                    @endphp

                    @foreach ($testSectionsDetails as $singletestSections)


                        @if (in_array($singletestSections['Sections'][0]['format'], ['ACT', 'SAT', 'PSAT']))
                            @if (isset($singletestSections['Sections_question']))
                                <!-- START SECTION FOR ACT SAT PSAT as they have only one secction. -->
                                <li class="timeline-event">
                                    <div class="timeline-event-icon bg-success">
                                        <i class="fa-solid fa-{{ ++$count }}"></i>
                                    </div>
                                    <div class="timeline-event-block block">
                                        <div class="block-header block-header-default">
                                            <h3 class="block-title">
                                                {{ str_replace(['_'], [' '], $singletestSections['Sections'][0]['practice_test_type']) }}
                                                Section</h3>
                                            <div class="block-options">
                                                {{-- <div class="timeline-event-time block-options-item fs-sm fw-semibold">
                                                    {{ isset($total_all_section_question) ? $total_all_section_question : '' }}
                                                    Questions
                                                </div> --}}

                                                @if (isset($singletestSections['Sections_question']))
                                                    <div class="timeline-event-time block-options-item fs-sm fw-semibold">
                                                        {{ count($singletestSections['Sections_question']) }} Questions
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
                                                    Start
                                                    {{ str_replace(['_'], [' '], $singletestSections['Sections'][0]['practice_test_type']) }}
                                                    Section Questions
                                                </div>

                                                @if (isset($singletestSections['Sections_question']))
                                                    @if (isset($singletestSections['check_if_section_completed']) &&
                                                            $singletestSections['check_if_section_completed'][0] == 'yes')
                                                        <div>
                                                            <a href="#" style='padding: 5px 20px fs-5'
                                                                class="btn btn-alt-success text-success 4">
                                                                {{ $score[$singletestSections['Sections'][0]['id']] }}
                                                            </a>
                                                            <a href="{{ route('single_review', ['test' => $singletestSections['Sections'][0]['title'], 'id' => $singletestSections['Sections'][0]['id']]) . '?test_id=' . $current_section_id . '&&type=single' }}"
                                                                style='padding: 5px 20px fs-5'
                                                                class="btn btn-alt-success text-success 5">
                                                                <i class="fa-solid fa-circle-check"
                                                                    style='margin-right:5px'></i>
                                                                Review Section
                                                                {{-- Review {{str_replace(['_'],[' '],$singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                                                            </a>

                                                            {{-- new  --}}
                                                            <a href="{{ route('reset_section', ['testId' => $singletestSections['Sections'][0]['testid'], 'id' => $singletestSections['Sections'][0]['id']]) }}"
                                                                style='padding: 5px 20px fs-5'
                                                                class="btn btn-alt-success text-success 6">
                                                                <i class="fa-solid fa-circle-check"
                                                                    style='margin-right:5px'></i>
                                                                Reset
                                                                {{-- Review {{str_replace(['_'],[' '],$singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                                                            </a>
                                                        </div>
                                                    @else
                                                        @if ($practice_test->test_source == 1)
                                                            <a href="{{ route('official_single_section', ['id' => $singletestSections['Sections'][0]['id']]) . '?test_id=' . $current_section_id }}"
                                                                style="padding: 5px 20px fs-5"
                                                                class="btn btn-alt-secondary text-primary official_proctored_module_start_section"
                                                                data-section_id="{{ $singletestSections['Sections'][0]['id'] }}"
                                                                data-test_id="{{ $current_section_id }}">
                                                                {{-- Start {{str_replace(['_'],[' '], $singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                                                                <i class="fa-solid fa-circle-check"
                                                                    style='margin-right:5px'></i> Start Section
                                                            </a>
                                                        @else
                                                            <a href="{{ route('single_section', ['id' => $singletestSections['Sections'][0]['id']]) . '?test_id=' . $current_section_id }}"
                                                                style="padding: 5px 20px fs-5"
                                                                class="btn btn-alt-secondary text-primary start_section"
                                                                data-section_id="{{ $singletestSections['Sections'][0]['id'] }}"
                                                                data-test_id="{{ $current_section_id }}">
                                                                {{-- Start {{str_replace(['_'],[' '], $singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                                                                <i class="fa-solid fa-circle-check"
                                                                    style='margin-right:5px'></i> Start
                                                                Section
                                                            </a>
                                                        @endif
                                                        @php
                                                            array_push(
                                                                $sectionArray,
                                                                (int) $singletestSections['Sections'][0]['id'],
                                                            );
                                                        @endphp
                                                    @endif
                                                @elseif(!isset($singletestSections['Sections_question']))
                                                    <a href="#" style="" class="btn btn-alt-secondary">
                                                        {{-- <i class="fa fa-fw  me-1 opacity-50"></i> Start {{ str_replace(['_'],[' '],$singletestSections['Sections'][0]['practice_test_type']) }} Section --}}
                                                        <i class="fa-solid fa-timer" style='margin-right:5px'></i> Start
                                                        Section
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @elseif(in_array($singletestSections['Sections'][0]['format'], ['DSAT', 'DPSAT']))
                            <!-- Official Test -->
                            @if ($practice_test->test_source == 1)
                                @php
                                    if ($singletestSections['Sections'][0]['practice_test_type'] == 'Math') {
                                        $id = $singletestSections['Sections'][0]['id'];
                                    } elseif (
                                        $singletestSections['Sections'][0]['practice_test_type'] ==
                                        'Reading_And_Writing'
                                    ) {
                                        $id = $singletestSections['Sections'][0]['id'];
                                    }
                                    if (
                                        $singletestSections['Sections'][0]['practice_test_type'] ==
                                        'Easy_Reading_And_Writing'
                                    ) {
                                        $readingAndWritingId = $singletestSections['Sections'][0]['id'];
                                        $checkReading = \DB::table('user_answers')
                                            ->where('section_id', $readingAndWritingId)
                                            ->where('user_id', Auth::user()->id)
                                            ->exists();
                                        // dd($readingAndWritingId);
                                    } elseif (
                                        $singletestSections['Sections'][0]['practice_test_type'] ==
                                        'Hard_Reading_And_Writing'
                                    ) {
                                        $readingAndWritingId = $singletestSections['Sections'][0]['id'];
                                        $checkReading = \DB::table('user_answers')
                                            ->where('section_id', $readingAndWritingId)
                                            ->where('user_id', Auth::user()->id)
                                            ->exists();
                                    }
                                    if (
                                        $singletestSections['Sections'][0]['practice_test_type'] == 'Math_no_calculator'
                                    ) {
                                        $mathId = $singletestSections['Sections'][0]['id'];
                                        $checkMath = \DB::table('user_answers')
                                            ->where('section_id', $mathId)
                                            ->where('user_id', Auth::user()->id)
                                            ->exists();
                                    } elseif (
                                        $singletestSections['Sections'][0]['practice_test_type'] ==
                                        'Math_with_calculator'
                                    ) {
                                        $mathId = $singletestSections['Sections'][0]['id'];
                                        $checkMath = \DB::table('user_answers')
                                            ->where('section_id', $mathId)
                                            ->where('user_id', Auth::user()->id)
                                            ->exists();
                                    }
                                    // if (isset($checkReading)) {
                                    //     dump($checkReading);
                                    // }
                                    // if (isset($checkMath)) {
                                    //     dump($checkMath);
                                    // }
                                @endphp

                                @if (isset($checkReading))
                                    @if ($checkReading == true)
                                        <input type="hidden" class="easy-remove" value="1" />
                                    @endif
                                @endif
                                @if (isset($checkMath))
                                    @if ($checkMath == true)
                                        <input type="hidden" class="math-remove" value="1" />
                                    @endif
                                @endif
                                @if (
                                    $test_type == 'proctored' &&
                                        (in_array($singletestSections['Sections'][0]['format'], ['DSAT']) ||
                                            in_array($singletestSections['Sections'][0]['format'], ['DPSAT'])))
                                    @if (isset($singletestSections['Sections_question']))
                                        @if (isset($singletestSections['check_if_section_completed']) &&
                                                $singletestSections['check_if_section_completed'][0] == 'yes')
                                            @if (in_array($singletestSections['Sections'][0]['practice_test_type'], ['Math', 'Reading_And_Writing']))
                                                <!-- REVIEW SECTION -->
                                                <li class="timeline-event">
                                                    <div class="timeline-event-icon bg-success">
                                                        <i class="fa-solid fa-{{ ++$count }}"></i>
                                                    </div>
                                                    <div class="timeline-event-block block">
                                                        <div class="block-header block-header-default">
                                                            <h3 class="block-title">
                                                                {{ str_replace(['_'], [' '], $singletestSections['Sections'][0]['practice_test_type']) }}
                                                                Section</h3>
                                                            <div class="block-options">
                                                                <div
                                                                    class="timeline-event-time block-options-item fs-sm fw-semibold">
                                                                    {{-- isset($singletestSections['Sections'][0]['yesSectionCount']) ? $singletestSections['Sections'][0]['yesSectionCount'] : '0' --}}
                                                                    {{ isset($singletestSections['Sections'][0]['section_quest_count']) ? $singletestSections['Sections'][0]['section_quest_count'] : '0' }}

                                                                    Questions
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="block-content pb-3">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    Start
                                                                    {{ str_replace(['_'], [' '], $singletestSections['Sections'][0]['practice_test_type']) }}
                                                                    Section Questions

                                                                </div>
                                                                <div>

                                                                    <a href="#" style='padding: 5px 20px fs-5'
                                                                        class="btn btn-alt-success text-success 1">
                                                                        {{ $singletestSections['Sections'][0]['newScore'] }}
                                                                    </a>

                                                                    {{--                                                        
                                                        <a href="{{ route('single_review', ['test' => $singletestSections['Sections'][0]['title'], 'id' => $singletestSections['Sections'][0]['id']]) . '?test_id=' . $current_section_id . '&type=single' }}"
                                                            style='padding: 5px 20px fs-5'
                                                            class="btn btn-alt-success text-success 2">
                                                            <i class="fa-solid fa-circle-check" style='margin-right:5px'></i>
                                                            Review Section
                                                        </a>
                                                            --}}
                                                                    {!! $singletestSections['Sections'][0]['reviewUrls'] !!}

                                                                    {{-- new  --}}
                                                                    <a href="{{ route('reset_proc_section', ['testId' => $singletestSections['Sections'][0]['testid'], 'id' => $singletestSections['Sections'][0]['id']]) }}"
                                                                        style='padding: 5px 20px fs-5'
                                                                        class="btn btn-alt-success text-success 3">
                                                                        <i class="fa-solid fa-circle-check"
                                                                            style='margin-right:5px'></i>
                                                                        Reset
                                                                        {{-- Review {{str_replace(['_'],[' '],$singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endif
                                    @endif

                                    @if (isset($singletestSections['Sections_question']))
                                        @if (isset($singletestSections['check_if_section_completed']) &&
                                                $singletestSections['check_if_section_completed'][0] == 'no')
                                            @if (in_array($singletestSections['Sections'][0]['practice_test_type'], ['Math', 'Reading_And_Writing']))
                                                <!-- START SECTION -->
                                                <li class="timeline-event">

                                                    <div class="timeline-event-icon bg-success">
                                                        <i class="fa-solid fa-{{ ++$count }}"></i>
                                                    </div>
                                                    <div class="timeline-event-block block">
                                                        <div class="block-header block-header-default">
                                                            <h3 class="block-title">
                                                                {{ str_replace(['_'], [' '], $singletestSections['Sections'][0]['practice_test_type']) }}
                                                                Section</h3>
                                                            <div class="block-options">
                                                                <div
                                                                    class="timeline-event-time block-options-item fs-sm fw-semibold">
                                                                    {{-- isset($singletestSections['Sections'][0]['noSectionCount']) ? $singletestSections['Sections'][0]['noSectionCount'] : '0' --}}
                                                                    {{ isset($singletestSections['Sections'][0]['section_quest_count']) ? $singletestSections['Sections'][0]['section_quest_count'] : '0' }}
                                                                    Questions
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="block-content pb-3">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    Start
                                                                    {{ str_replace(['_'], [' '], $singletestSections['Sections'][0]['practice_test_type']) }}
                                                                    Section Questions

                                                                </div>
                                                                <div>
                                                                    <a href="{{ route('official_single_section', ['id' => $singletestSections['Sections'][0]['id']]) . '?test_id=' . $current_section_id }}"
                                                                        style="padding: 5px 20px fs-5"
                                                                        class="btn btn-alt-secondary text-primary official_proctored_module_start_section"
                                                                        data-section_id="{{ $singletestSections['Sections'][0]['id'] }}"
                                                                        data-test_id="{{ $current_section_id }}">
                                                                        {{-- Start {{str_replace(['_'],[' '], $singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                                                                        <i class="fa-solid fa-circle-check"
                                                                            style='margin-right:5px'></i> Start
                                                                        Section
                                                                    </a>
                                                                    @php
                                                                        array_push(
                                                                            $sectionArray,
                                                                            (int) $singletestSections['Sections'][0][
                                                                                'id'
                                                                            ],
                                                                        );
                                                                    @endphp
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endif
                                    @endif
                                @else
                               
                                    @if (isset($singletestSections['Sections_question']))
                                        @if (isset($singletestSections['check_if_section_completed']) &&
                                                $singletestSections['check_if_section_completed'][0] == 'yes')
                                            @if (in_array($singletestSections['Sections'][0]['practice_test_type'], ['Math', 'Reading_And_Writing']))
                                                <!-- REVIEW SECTION -->
                                                <li class="timeline-event">
                                                    @if ($loop->index == 0)
                                                        <div class="timeline-event-icon bg-success">
                                                            <i class="fa-solid fa-{{ ++$count }}"></i>
                                                        </div>
                                                    @else
                                                        <div class="timeline-event-icon bg-success">
                                                            <i class="fa-solid fa-3"></i>
                                                        </div>
                                                    @endif
                                                    <div class="timeline-event-block block">
                                                        <div class="block-header block-header-default">
                                                            <h3 class="block-title">
                                                                {{ str_replace(['_'], [' '], $singletestSections['Sections'][0]['practice_test_type']) }}
                                                                Module 1 Section</h3>
                                                            <div class="block-options">
                                                                <div
                                                                    class="timeline-event-time block-options-item fs-sm fw-semibold">
                                                                    {{-- isset($singletestSections['Sections'][0]['yesSectionCount']) ? $singletestSections['Sections'][0]['yesSectionCount'] : '0' --}}
                                                                    {{ isset($singletestSections['Sections_question'][0]) ? count($singletestSections['Sections_question']) : '0' }}

                                                                    Questions
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="block-content pb-3">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    Start
                                                                    {{ str_replace(['_'], [' '], $singletestSections['Sections'][0]['practice_test_type']) }}
                                                                    Module 1 Section Questions

                                                                </div>
                                                                <div>
                                                                    @php
                                                                        if (
                                                                            strpos(
                                                                                $singletestSections['Sections'][0][
                                                                                    'practice_test_type'
                                                                                ],
                                                                                'Math',
                                                                            ) !== false
                                                                        ) {
                                                                            $score =
                                                                                $singletestSections['Sections'][0][
                                                                                    'newScore'
                                                                                ];
                                                                        } elseif (
                                                                            strpos(
                                                                                $singletestSections['Sections'][0][
                                                                                    'practice_test_type'
                                                                                ],
                                                                                'Reading',
                                                                            ) !== false
                                                                        ) {
                                                                            $score =
                                                                                $singletestSections['Sections'][0][
                                                                                    'newScore'
                                                                                ];
                                                                        } else {
                                                                        }
                                                                    @endphp

                                                                    <a href="#" style='padding: 5px 20px fs-5'
                                                                        class="btn btn-alt-success text-success 1">
                                                                        {{ $singletestSections['Sections'][0]['newScore'] }}
                                                                    </a>


                                                                    <a href="{{ route('single_review', ['test' => $singletestSections['Sections'][0]['title'], 'id' => $singletestSections['Sections'][0]['id']]) . '?test_id=' . $current_section_id . '&type=single' }}"
                                                                        style='padding: 5px 20px fs-5'
                                                                        class="btn btn-alt-success text-success 2">
                                                                        <i class="fa-solid fa-circle-check"
                                                                            style='margin-right:5px'></i>
                                                                        Review Module 1 Section
                                                                    </a>

                                                                    {{-- {!! $singletestSections['Sections'][0]['reviewUrls'] !!} --}}

                                                                    {{-- new  --}}
                                                                    {{-- <a href="{{ route('reset_section', ['testId' => $singletestSections['Sections'][0]['testid'], 'id' => $singletestSections['Sections'][0]['id']]) }}"
                                                                    style='padding: 5px 20px fs-5'
                                                                    class="btn btn-alt-success text-success 3">
                                                                    <i class="fa-solid fa-circle-check"
                                                                        style='margin-right:5px'></i>
                                                                    Reset --}}
                                                                    {{-- Review {{str_replace(['_'],[' '],$singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                                                                    {{-- </a> --}}
                                                                    <a href="{{ route('reset_section', ['testId' => $singletestSections['Sections'][0]['testid'], 'id' => $singletestSections['Sections'][0]['id']]) }}"
                                                                        style='padding: 5px 20px fs-5'
                                                                        class="btn btn-alt-success text-success 6">
                                                                        <i class="fa-solid fa-circle-check"
                                                                            style='margin-right:5px'></i>
                                                                        Reset
                                                                        {{-- Review {{str_replace(['_'],[' '],$singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                            @if (in_array($singletestSections['Sections'][0]['practice_test_type'], [
                                                    'Hard_Reading_And_Writing',
                                                    'Easy_Reading_And_Writing',
                                                ]))
                                                <li class="timeline-event">
                                                    <div class="timeline-event-icon bg-success">
                                                        <i class="fa-solid fa-2"></i>
                                                    </div>
                                                    @php
                                                        $modifiedString = str_replace(
                                                            ['_'],
                                                            [' '],
                                                            $singletestSections['Sections'][0]['practice_test_type'],
                                                        );
                                                        $modifiedStrings = str_replace(
                                                            ['calculator', 'Easy', 'with', 'no', 'Hard'],
                                                            '',
                                                            $modifiedString,
                                                        );
                                                    @endphp
                                                    <div class="timeline-event-block block">
                                                        <div class="block-header block-header-default">
                                                            <h3 class="block-title">
                                                                {{ $modifiedStrings }}
                                                                Module 2 Section</h3>
                                                            <div class="block-options">
                                                                <div
                                                                    class="timeline-event-time block-options-item fs-sm fw-semibold">
                                                                    {{-- isset($singletestSections['Sections'][0]['yesSectionCount']) ? $singletestSections['Sections'][0]['yesSectionCount'] : '0' --}}
                                                                    {{ isset($singletestSections['Sections_question']) ? count($singletestSections['Sections_question']) : '0' }}

                                                                    Questions
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="block-content pb-3">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    Start
                                                                    {{ $modifiedStrings }}
                                                                    Module 2 Section Questions

                                                                </div>
                                                                <div>

                                                                    <a href="#" style='padding: 5px 20px fs-5'
                                                                        class="btn btn-alt-success text-success 1">
                                                                        {{ $score }}
                                                                    </a>


                                                                    <a href="{{ route('single_review', ['test' => $singletestSections['Sections'][0]['title'], 'id' => $singletestSections['Sections'][0]['id']]) . '?test_id=' . $current_section_id . '&type=single' }}"
                                                                        style='padding: 5px 20px fs-5'
                                                                        class="btn btn-alt-success text-success 2">
                                                                        <i class="fa-solid fa-circle-check"
                                                                            style='margin-right:5px'></i>
                                                                        Review Module 2 Section
                                                                    </a>

                                                                    {{-- {!! $singletestSections['Sections'][0]['reviewUrls'] !!} --}}

                                                                    {{-- new  --}}
                                                                    {{-- <a href="{{ route('reset_section', ['testId' => $singletestSections['Sections'][0]['testid'], 'id' => $singletestSections['Sections'][0]['id']]) }}"
                                                                    style='padding: 5px 20px fs-5'
                                                                    class="btn btn-alt-success text-success 3">
                                                                    <i class="fa-solid fa-circle-check"
                                                                        style='margin-right:5px'></i>
                                                                    Reset --}}
                                                                    {{-- Review {{str_replace(['_'],[' '],$singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                                                                    {{-- </a> --}}
                                                                    <a href="{{ route('reset_section', ['testId' => $singletestSections['Sections'][0]['testid'], 'id' => $singletestSections['Sections'][0]['id']]) }}"
                                                                        style='padding: 5px 20px fs-5'
                                                                        class="btn btn-alt-success text-success 6">
                                                                        <i class="fa-solid fa-circle-check"
                                                                            style='margin-right:5px'></i>
                                                                        Reset
                                                                        {{-- Review {{str_replace(['_'],[' '],$singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                            @if (in_array($singletestSections['Sections'][0]['practice_test_type'], ['Math_no_calculator', 'Math_with_calculator']))
                                                <li class="timeline-event">

                                                    <div class="timeline-event-icon bg-success">
                                                        <i class="fa-solid fa-4"></i>
                                                    </div>
                                                    @php
                                                        $modifiedString = str_replace(
                                                            ['_'],
                                                            [' '],
                                                            $singletestSections['Sections'][0]['practice_test_type'],
                                                        );
                                                        $modifiedStrings = str_replace(
                                                            ['calculator', 'Easy', 'with', 'no', 'Hard'],
                                                            '',
                                                            $modifiedString,
                                                        );
                                                    @endphp
                                                    <div class="timeline-event-block block">
                                                        <div class="block-header block-header-default">
                                                            <h3 class="block-title">
                                                                {{ $modifiedStrings }}
                                                                Module 2 Section</h3>
                                                            <div class="block-options">
                                                                <div
                                                                    class="timeline-event-time block-options-item fs-sm fw-semibold">
                                                                    {{-- isset($singletestSections['Sections'][0]['yesSectionCount']) ? $singletestSections['Sections'][0]['yesSectionCount'] : '0' --}}
                                                                    {{ isset($singletestSections['Sections_question']) ? count($singletestSections['Sections_question']) : '0' }}

                                                                    Questions
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="block-content pb-3">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    Start
                                                                    {{ $modifiedStrings }}
                                                                    Module 2 Section Questions

                                                                </div>
                                                                <div>

                                                                    <a href="#" style='padding: 5px 20px fs-5'
                                                                        class="btn btn-alt-success text-success 1">
                                                                        {{ $score }}
                                                                    </a>


                                                                    <a href="{{ route('single_review', ['test' => $singletestSections['Sections'][0]['title'], 'id' => $singletestSections['Sections'][0]['id']]) . '?test_id=' . $current_section_id . '&type=single' }}"
                                                                        style='padding: 5px 20px fs-5'
                                                                        class="btn btn-alt-success text-success 2">
                                                                        <i class="fa-solid fa-circle-check"
                                                                            style='margin-right:5px'></i>
                                                                        Review Module 2 Section
                                                                    </a>

                                                                    {{-- {!! $singletestSections['Sections'][0]['reviewUrls'] !!} --}}

                                                                    {{-- new  --}}
                                                                    {{-- <a href="{{ route('reset_section', ['testId' => $singletestSections['Sections'][0]['testid'], 'id' => $singletestSections['Sections'][0]['id']]) }}"
                                                                    style='padding: 5px 20px fs-5'
                                                                    class="btn btn-alt-success text-success 3">
                                                                    <i class="fa-solid fa-circle-check"
                                                                        style='margin-right:5px'></i>
                                                                    Reset --}}
                                                                    {{-- Review {{str_replace(['_'],[' '],$singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                                                                    {{-- </a> --}}
                                                                    <a href="{{ route('reset_section', ['testId' => $singletestSections['Sections'][0]['testid'], 'id' => $singletestSections['Sections'][0]['id']]) }}"
                                                                        style='padding: 5px 20px fs-5'
                                                                        class="btn btn-alt-success text-success 6">
                                                                        <i class="fa-solid fa-circle-check"
                                                                            style='margin-right:5px'></i>
                                                                        Reset
                                                                        {{-- Review {{str_replace(['_'],[' '],$singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endif
                                    @endif

                                    @if (isset($singletestSections['Sections_question']))
                                        @if (isset($singletestSections['check_if_section_completed']) &&
                                                $singletestSections['check_if_section_completed'][0] == 'no')
                                            {{-- @php
                                            dump($singletestSections);
                                        @endphp --}}
                                            @if (in_array($singletestSections['Sections'][0]['practice_test_type'], [
                                                    'Reading_And_Writing',
                                                    'Math',
                                                    // 'Easy_Reading_And_Writing',
                                                    // 'Hard_Reading_And_Writing',
                                                ]))
                                                @php
                                                    $id = $singletestSections['Sections'][0]['id'];
                                                @endphp
                                                <!-- START SECTION -->
                                                <li class="timeline-event">
                                                    <div class="timeline-event-icon bg-success">
                                                        <i class="fa-solid fa-{{ ++$count }}"></i>
                                                    </div>
                                                    <div class="timeline-event-block block">
                                                        <div class="block-header block-header-default">
                                                            <h3 class="block-title">
                                                                {{ str_replace(['_'], [' '], $singletestSections['Sections'][0]['practice_test_type']) }}
                                                                Module 1
                                                                Section
                                                            </h3>

                                                            <div class="block-options">
                                                                <div
                                                                    class="timeline-event-time block-options-item fs-sm fw-semibold">
                                                                    {{-- isset($singletestSections['Sections'][0]['noSectionCount']) ? $singletestSections['Sections'][0]['noSectionCount'] : '0' --}}
                                                                    {{ isset($singletestSections['Sections_question']) ? count($singletestSections['Sections_question']) : '0' }}
                                                                    Questions
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="block-content pb-3">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    Start
                                                                    {{ str_replace(['_'], [' '], $singletestSections['Sections'][0]['practice_test_type']) }}
                                                                    Module 1 Section Questions

                                                                </div>
                                                                <div>
                                                                    <a href="{{ route('official_single_section', ['id' => $singletestSections['Sections'][0]['id']]) . '?test_id=' . $current_section_id }}"
                                                                        style="padding: 5px 20px fs-5"
                                                                        class="btn btn-alt-secondary text-primary official_start_section"
                                                                        data-section_id="{{ $singletestSections['Sections'][0]['id'] }}"
                                                                        data-test_id="{{ $current_section_id }}">
                                                                        {{-- Start {{str_replace(['_'],[' '], $singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                                                                        <i class="fa-solid fa-circle-check"
                                                                            style='margin-right:5px'></i> Start Section
                                                                    </a>
                                                                    @php
                                                                        array_push(
                                                                            $sectionArray,
                                                                            (int) $singletestSections['Sections'][0][
                                                                                'id'
                                                                            ],
                                                                        );
                                                                    @endphp
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                            @if (in_array($singletestSections['Sections'][0]['practice_test_type'], ['Easy_Reading_And_Writing']))
                                                <li class="timeline-event" id="easy-id">
                                                    <div class="timeline-event-icon bg-success">
                                                        <i class="fa-solid fa-{{ ++$count }}"></i>
                                                    </div>
                                                    @php
                                                        $modifiedString = str_replace(
                                                            ['_'],
                                                            [' '],
                                                            $singletestSections['Sections'][0]['practice_test_type'],
                                                        );
                                                        $modifiedStrings = str_replace(
                                                            ['calculator', 'Easy', 'with', 'no', 'Hard'],
                                                            '',
                                                            $modifiedString,
                                                        );
                                                    @endphp
                                                    <div class="timeline-event-block block">
                                                        <div class="block-header block-header-default">
                                                            <h3 class="block-title">
                                                                {{ $modifiedStrings }}
                                                                Module 2
                                                                Section
                                                            </h3>

                                                            <div class="block-options">
                                                                <div
                                                                    class="timeline-event-time block-options-item fs-sm fw-semibold">
                                                                    {{-- isset($singletestSections['Sections'][0]['noSectionCount']) ? $singletestSections['Sections'][0]['noSectionCount'] : '0' --}}
                                                                    {{ isset($singletestSections['Sections_question']) ? count($singletestSections['Sections_question']) : '0' }}
                                                                    Questions
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="block-content pb-3">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    Start
                                                                    {{ $modifiedStrings }}
                                                                    Module 2
                                                                    Section Questions

                                                                </div>
                                                                <div>
                                                                    <a href="{{ route('official_module_single_section', ['id' => $id]) . '?test_id=' . $current_section_id }}"
                                                                        style="padding: 5px 20px fs-5"
                                                                        class="btn btn-alt-secondary text-primary official_module_start_section"
                                                                        data-section_id="{{ $singletestSections['Sections'][0]['id'] }}"
                                                                        data-test_id="{{ $current_section_id }}">
                                                                        {{-- Start {{str_replace(['_'],[' '], $singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                                                                        <i class="fa-solid fa-circle-check"
                                                                            style='margin-right:5px'></i> Start
                                                                        Section
                                                                    </a>
                                                                    @php
                                                                        array_push(
                                                                            $sectionArray,
                                                                            (int) $singletestSections['Sections'][0][
                                                                                'id'
                                                                            ],
                                                                        );
                                                                    @endphp
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                            @if (in_array($singletestSections['Sections'][0]['practice_test_type'], ['Math_with_calculator']))
                                                <li class="timeline-event" id="math-id">
                                                    <div class="timeline-event-icon bg-success">
                                                        {{-- <i class="fa-solid fa-{{ ++$count }}"></i> --}}
                                                        <i class="fa-solid fa-{{ $loop->index }}"></i>
                                                    </div>
                                                    @php
                                                        $modifiedString = str_replace(
                                                            ['_'],
                                                            [' '],
                                                            $singletestSections['Sections'][0]['practice_test_type'],
                                                        );
                                                        $modifiedStrings = str_replace(
                                                            ['calculator', 'Easy', 'with', 'no', 'Hard'],
                                                            '',
                                                            $modifiedString,
                                                        );
                                                    @endphp
                                                    <div class="timeline-event-block block">
                                                        <div class="block-header block-header-default">
                                                            <h3 class="block-title">
                                                                {{ $modifiedStrings }}
                                                                Module 2
                                                                Section
                                                            </h3>

                                                            <div class="block-options">
                                                                <div
                                                                    class="timeline-event-time block-options-item fs-sm fw-semibold">
                                                                    {{-- isset($singletestSections['Sections'][0]['noSectionCount']) ? $singletestSections['Sections'][0]['noSectionCount'] : '0' --}}
                                                                    {{ isset($singletestSections['Sections_question']) ? count($singletestSections['Sections_question']) : '0' }}
                                                                    Questions
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="block-content pb-3">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    Start
                                                                    {{ $modifiedStrings }}
                                                                    Module 2
                                                                    Section Questions

                                                                </div>
                                                                <div>
                                                                    <a href="{{ route('official_module_single_section', ['id' => $id]) . '?test_id=' . $current_section_id }}"
                                                                        style="padding: 5px 20px fs-5"
                                                                        class="btn btn-alt-secondary text-primary official_module_start_section"
                                                                        data-section_id="{{ $singletestSections['Sections'][0]['id'] }}"
                                                                        data-test_id="{{ $current_section_id }}">
                                                                        {{-- Start {{str_replace(['_'],[' '], $singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                                                                        <i class="fa-solid fa-circle-check"
                                                                            style='margin-right:5px'></i> Start
                                                                        Section
                                                                    </a>
                                                                    @php
                                                                        array_push(
                                                                            $sectionArray,
                                                                            (int) $singletestSections['Sections'][0][
                                                                                'id'
                                                                            ],
                                                                        );
                                                                    @endphp
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            @else
                                @if (isset($singletestSections['Sections_question']))
                                    @if (isset($singletestSections['check_if_section_completed']) &&
                                            $singletestSections['check_if_section_completed'][0] == 'yes')
                                        @if (in_array($singletestSections['Sections'][0]['practice_test_type'], ['Math', 'Reading_And_Writing']))
                                            <!-- REVIEW SECTION -->
                                            <li class="timeline-event">
                                                <div class="timeline-event-icon bg-success">
                                                    <i class="fa-solid fa-{{ ++$count }}"></i>
                                                </div>
                                                <div class="timeline-event-block block">
                                                    <div class="block-header block-header-default">
                                                        <h3 class="block-title">
                                                            {{ str_replace(['_'], [' '], $singletestSections['Sections'][0]['practice_test_type']) }}
                                                            Section</h3>
                                                        <div class="block-options">
                                                            <div
                                                                class="timeline-event-time block-options-item fs-sm fw-semibold">
                                                                {{-- isset($singletestSections['Sections'][0]['yesSectionCount']) ? $singletestSections['Sections'][0]['yesSectionCount'] : '0' --}}
                                                                {{ isset($singletestSections['Sections'][0]['section_quest_count']) ? $singletestSections['Sections'][0]['section_quest_count'] : '0' }}

                                                                Questions
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="block-content pb-3">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                Start
                                                                {{ str_replace(['_'], [' '], $singletestSections['Sections'][0]['practice_test_type']) }}
                                                                Section Questions

                                                            </div>
                                                            <div>

                                                                <a href="#" style='padding: 5px 20px fs-5'
                                                                    class="btn btn-alt-success text-success 1">
                                                                    {{ $singletestSections['Sections'][0]['newScore'] }}
                                                                </a>

                                                                {{--                                                        
                                                        <a href="{{ route('single_review', ['test' => $singletestSections['Sections'][0]['title'], 'id' => $singletestSections['Sections'][0]['id']]) . '?test_id=' . $current_section_id . '&type=single' }}"
                                                            style='padding: 5px 20px fs-5'
                                                            class="btn btn-alt-success text-success 2">
                                                            <i class="fa-solid fa-circle-check" style='margin-right:5px'></i>
                                                            Review Section
                                                        </a>
                                                            --}}
                                                                {!! $singletestSections['Sections'][0]['reviewUrls'] !!}

                                                                {{-- new  --}}
                                                                <a href="{{ route('reset_section', ['testId' => $singletestSections['Sections'][0]['testid'], 'id' => $singletestSections['Sections'][0]['id']]) }}"
                                                                    style='padding: 5px 20px fs-5'
                                                                    class="btn btn-alt-success text-success 3">
                                                                    <i class="fa-solid fa-circle-check"
                                                                        style='margin-right:5px'></i>
                                                                    Reset
                                                                    {{-- Review {{str_replace(['_'],[' '],$singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endif
                                @endif

                                @if (isset($singletestSections['Sections_question']))
                                    @if (isset($singletestSections['check_if_section_completed']) &&
                                            $singletestSections['check_if_section_completed'][0] == 'no')
                                        @if (in_array($singletestSections['Sections'][0]['practice_test_type'], ['Math', 'Reading_And_Writing']))
                                            <!-- START SECTION -->
                                            <li class="timeline-event">
                                                <div class="timeline-event-icon bg-success">
                                                    <i class="fa-solid fa-{{ ++$count }}"></i>
                                                </div>
                                                <div class="timeline-event-block block">
                                                    <div class="block-header block-header-default">
                                                        <h3 class="block-title">
                                                            {{ str_replace(['_'], [' '], $singletestSections['Sections'][0]['practice_test_type']) }}
                                                            Section</h3>
                                                        <div class="block-options">
                                                            <div
                                                                class="timeline-event-time block-options-item fs-sm fw-semibold">
                                                                {{-- isset($singletestSections['Sections'][0]['noSectionCount']) ? $singletestSections['Sections'][0]['noSectionCount'] : '0' --}}
                                                                {{ isset($singletestSections['Sections'][0]['section_quest_count']) ? $singletestSections['Sections'][0]['section_quest_count'] : '0' }}
                                                                Questions
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="block-content pb-3">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                Start
                                                                {{ str_replace(['_'], [' '], $singletestSections['Sections'][0]['practice_test_type']) }}
                                                                Section Questions

                                                            </div>
                                                            <div>
                                                                <a href="{{ route('single_section', ['id' => $singletestSections['Sections'][0]['id']]) . '?test_id=' . $current_section_id }}"
                                                                    style="padding: 5px 20px fs-5"
                                                                    class="btn btn-alt-secondary text-primary start_section"
                                                                    data-section_id="{{ $singletestSections['Sections'][0]['id'] }}"
                                                                    data-test_id="{{ $current_section_id }}">
                                                                    {{-- Start {{str_replace(['_'],[' '], $singletestSections['Sections'][0]['practice_test_type'])}} Section --}}
                                                                    <i class="fa-solid fa-circle-check"
                                                                        style='margin-right:5px'></i> Start
                                                                    Section
                                                                </a>
                                                                @php
                                                                    array_push(
                                                                        $sectionArray,
                                                                        (int) $singletestSections['Sections'][0]['id'],
                                                                    );
                                                                @endphp
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @endif
                        @php
                            $key++;
                        @endphp
                    @endforeach

                    <input type="hidden" name="sectionArrayJson" id="sectionArrayJsonId" value="<?php echo htmlspecialchars(json_encode($sectionArray), JSON_NUMERIC_CHECK); ?>">

                    <li class="timeline-event">
                        {{-- <div class="timeline-event-icon bg-success"> --}}
                        {{-- <i class="fa-solid fa-{{++$count}}"></i> --}}
                        {{-- </div> --}}
                        <div class="timeline-event-block block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">COMPOSITE SCORE</h3>
                            </div>
                            <hr class="m-0">
                            <div class="block-content pb-3 gap-1 d-flex justify-content-center align-items-center">

                                @if ($whichSection == 0)
                                    @if (($testSection[0]->format == 'DSAT' || $testSection[0]->format == 'DPSAT') && $testSection[0]->test_source == 1)
                                        <a href="#" style='padding: 5px 20px fs-5'
                                            class="btn btn-alt-success text-success">
                                            Estimated Score: {{ number_format($total_score, 0) }}
                                        </a>

                                        <a href="#" style='padding: 5px 20px fs-5'
                                            class="btn btn-alt-success text-success">
                                            {{-- Actual Score: {{ number_format($total_score, 0) }} --}}
                                            Actual Score: {{ $readingScore + $mathScore }}
                                        </a>
                                    @else
                                        <a href="#" style='padding: 5px 20px fs-5'
                                            class="btn btn-alt-success text-success">
                                            {{ number_format($total_score, 0) }}
                                        </a>
                                    @endif
                                @else
                                    @if (($testSection[0]->format == 'DSAT' || $testSection[0]->format == 'DPSAT') && $testSection[0]->test_source == 1)
                                        <a href="#" style='padding: 5px 20px fs-5'
                                            class="btn btn-alt-success text-success">
                                            Estimated Score: {{ number_format($compositeScore, 0) }}
                                        </a>
                                        <a href="#" style='padding: 5px 20px fs-5'
                                            class="btn btn-alt-success text-success">
                                            {{-- Actual Score: {{ number_format($total_score, 0) }} --}}
                                            Actual Score: {{ $readingScore + $mathScore }}
                                        </a>
                                    @else
                                        <a href="#" style='padding: 5px 20px fs-5'
                                            class="btn btn-alt-success text-success">
                                            {{ number_format($compositeScore, 0) }}
                                        </a>
                                    @endif

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
        function resetTest(data) {
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

        .content-boxed {
            overflow: hidden !important;
        }

        .select-menu {
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
