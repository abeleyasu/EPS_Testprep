@extends('layouts.user')

@section('title', 'Test Break : CPS')

@section('page-script')
    <script>
        let time = 600;

        const timer = '10:00';
        const updateTime = document.getElementById("timer_{{ $test_id }}");

        function updateTimer() {
            let getTime = localStorage.getItem("startTime_{{ $test_id }}");

            if (!getTime) {
                localStorage.setItem("startTime_{{ $test_id }}", time);
            } else {
                let updatedTime = localStorage.getItem("startTime_{{ $test_id }}");
                time = updatedTime;
            }

            const minutes = Math.floor(time / 60);
            const seconds = time % 60;

            if (time < 0) {
                time = 600;
                clearInterval(timerInterval);

                localStorage.removeItem("startTime_{{ $test_id }}");
                $(".time-div").html('<b>Break Time is over.</b>');

                const link = document.getElementById('my-link');
                if (link) {
                    // Get the URL of the link
                    const linkUrl = link.getAttribute('href');

                    if (linkUrl) {
                        // Open the URL in the same window/tab
                        window.location.href = linkUrl;
                    } else {
                        // If the link doesn't have an 'href' attribute, you can perform a click event
                        link.click();
                    }
                }

            } else {
                updateTime.textContent = `${minutes}:${seconds < 10 ? "0" + seconds : seconds}`;
                time--;
                localStorage.setItem("startTime_{{ $test_id }}", time);
            }
        }

        function resumeTest() {
            time = 600;
            localStorage.removeItem("startTime_{{ $test_id }}");
            const link = document.getElementById('my-link');
            if (link) {
                // Get the URL of the link
                const linkUrl = link.getAttribute('href');

                if (linkUrl) {
                    // Open the URL in the same window/tab
                    window.location.href = linkUrl;
                } else {
                    // If the link doesn't have an 'href' attribute, you can perform a click event
                    link.click();
                }
            }
        }

        const timerInterval = setInterval(updateTimer, 1000);
    </script>
@endsection

@section('user-content')
    <meta name="_token" content="{{ csrf_token() }}" />
    <!-- Main Container -->
    <main id="main-container">
        <div class="bg-body-light">
            <div class="content content-boxed">
                <nav aria-label="breadcrumb">

                </nav>
            </div>
        </div>
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-boxed">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                    <div class="flex-grow-1">
                        <h1 class="h3 fw-bold mb-2">
                            <span class='text-primary'>Practice Test Break</span>
                        </h1>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="w-75">
                                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Content -->
        <div class="content content-boxed">
            <!-- Timeline -->
            <h6 class="fs-6 mb-3 test-description text-muted mt-2">
            </h6>
            <div class="container px-4 text-center border bg-white mb-5">
                <div class="row gx-5">
                    <div class="col d-flex flex-column justify-content-center align-items-center">
                        <div class="p-3 border bg-white mb-3 w-75">
                            <strong>Remaining Break Time:</strong>
                            <div class="time-div">
                                <b id="timer_{{ $test_id }}" style="font-size:50px"></b> <b>Minutes</b>
                            </div>

                        </div>
                        <div>
                            <a href="/user/practice-test/{{ $section_id }}?test_id={{ $test_id }}&time=regular"
                                style='display:none' id="my-link"></a>
                            <a href="#" style='padding: 5px 20px fs-5' class="btn btn-alt-success text-success 5"
                                onclick="resumeTest()">
                                <i class="fa-solid fa-circle-check" style='margin-right:5px'></i>
                                Resume Test
                            </a>
                        </div>
                    </div>
                    <div class="col text-start">
                        <div class="py-5">
                            <h3>Practice Break</h3>
                            <p>You can resume this practice test as soon as you're ready to move on. On test day, you'll
                                wait until the clock counts down. Read below to see how breaks work on test day.
                                <br>
                                <hr>
                                <br>
                            <h3>Take a Break: Do Not Close Your Device</h3>
                            <p> You may leave the room, but do not disturb students who are still testing.</p>
                            <p>Testing won't resume until you return.</p>
                            <strong class="mb-3">Follow these rules during the break:</strong>
                            <ol class="text-start mt-3">
                                <li class="mb-3">Do not access your phone, smartwatch, textbooks, notes,or the internet.
                                </li>
                                <li class="mb-3">Do not eat or drink in the test room</li>
                                <li class="mb-3">Do not speak in the test room; outside the test room, do not discuss the
                                    exam with anyone.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <ul class="timeline timeline-alt" style='padding: 0'>
                <li class="timeline-event">

                    <div class="timeline-event-block block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Remaining Break Time</h3>
                        </div>
                        <div class="block-content pb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="time-div">
                                    <b id="timer_{{ $test_id }}"></b> <b>Minutes</b>
                                </div>
                            </div>
                            <br>
                            <div>
                                <a href="/user/practice-test/{{ $section_id }}?test_id={{ $test_id }}"
                                    style='display:none' id="my-link"></a>
                                <a href="#" style='padding: 5px 20px fs-5' class="btn btn-alt-success text-success 5"
                                    onclick="resumeTest()">
                                    <i class="fa-solid fa-circle-check" style='margin-right:5px'></i>
                                    Resume Test
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul> --}}
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

        .content p {
            margin-bottom: 1em;
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
