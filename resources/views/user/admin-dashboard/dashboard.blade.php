@extends('layouts.user')

@section('title', 'Admission Dashboard : CPS')

@section('user-content')
    @can('Access Admission Dashboard')
        <main id="main-container">
            <div class="bg-image" style="background-image: url('{{ asset('static-image/admissionsimage.jpg') }}');">
                <div class="bg-black-15">
                    <div class="content content-full text-center">
                        <br />
                        <span class="text-white-75"></span>
                        <br />

                        <h1 class="h2 text-white mb-0">Admissions Dashboard</h1>
                        <br />
                        <span class="text-white-75"></span>
                        <br />
                    </div>
                </div>
            </div>
            <div class="bg-body-extra-light">
                <div class="content content-boxed">
                    @include('components.admission.dashboard-college-list', [
                        'college_list_deadline' => $college_list_deadline,
                    ])
                </div>
            </div>
            <div class="content content-boxed">
                <div class="row">
                    <div class="col-md-6 col-xl-6">
                        <div class="block block-rounded">
                            <div class="block-header block-header-tab text-white">
                                <h3 class="block-title">
                                    <i class="fa fa-screwdriver-wrench text-white me-1"></i> Admissions Tools
                                </h3>
                            </div>
                            <div class="block-content">
                                <div id="section-1" class="mb-5" role="tablist" aria-multiselectable="true">
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" role="tab" id="faq12_h1">
                                            <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#section-1"
                                                href="#college-application-resume" aria-expanded="true"
                                                aria-controls="college-application-resume">
                                                <i class="nav-main-link-icon fa fa-file"></i>
                                                High School Resume
                                            </a>
                                        </div>
                                        <div id="college-application-resume" class="collapse" role="tabpanel"
                                            aria-labelledby="faq12_h1" data-bs-parent="#section-1">
                                            <div class="block-content">
                                                <div>Your College Application Resume is an important step in crafting your
                                                    profile for college admissions committees. Get started by clicking the link
                                                    below.</div>
                                                <div>Click to begin or edit your College Application Resume</div>
                                                <a href="{{ route('admin-dashboard.highSchoolResume.personalInfo') }}"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray"></i>High
                                                    School Resume</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" role="tab" id="faq5_h2">
                                            <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#section-1"
                                                href="#initial-college-list" aria-expanded="true"
                                                aria-controls="initial-college-list">
                                                <i class="nav-main-link-icon fa fa-list-check"></i>
                                                Initial College List
                                            </a>
                                        </div>
                                        <div id="initial-college-list" class="collapse" role="tabpanel"
                                            aria-labelledby="faq5_h2" data-bs-parent="#section-1">
                                            <div class="block-content">
                                                <div>Start a list of colleges that you're interested in attending. Fill out your
                                                    high school statistics (GPA & test scores) and compare them with the
                                                    college's typical accepted statistics. Rank the colleges based on your
                                                    research and preferences. Apply Smart, Match, or Reach labels to each of
                                                    them to make sure you have a good mix of schools.</div>
                                                <div>Click to begin or edit your list</div>
                                                <a href="{{ route('admin-dashboard.initialCollegeList.step1') }}"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray"></i>Initial
                                                    College List</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" role="tab" id="faq3_h2">
                                            <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#section-1"
                                                href="#college-application-deadline-organizer" aria-expanded="true"
                                                aria-controls="college-application-deadline-organizer">
                                                <i class="nav-main-link-icon fa fa-timeline"></i>
                                                College Application Deadline Organizer
                                            </a>
                                        </div>
                                        <div id="college-application-deadline-organizer" class="collapse" role="tabpanel"
                                            aria-labelledby="faq3_h2" data-bs-parent="#section-1">
                                            <div class="block-content">
                                                <div>Input deadlines for the colleges you're interested in attending. Set
                                                    reminders for these deadlines to stay on track with your applications.</div>
                                                <div>Click to start inputting application deadlines</div>
                                                <a href="{{ route('admin-dashboard.collegeApplicationDeadline') }}"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray"></i>College
                                                    Application Deadline Organizer</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" role="tab" id="faq4_h2">
                                            <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#section-1"
                                                href="#college-cost-comparison" aria-expanded="true"
                                                aria-controls="college-cost-comparison">
                                                <i class="nav-main-link-icon fa fa-comments-dollar"></i>
                                                College Cost Comparison
                                            </a>
                                        </div>
                                        <div id="college-cost-comparison" class="collapse" role="tabpanel"
                                            aria-labelledby="faq4_h2" data-bs-parent="#section-1">
                                            <div class="block-content">
                                                <div>Input various costs of each college you're considering to compare the
                                                    difference in final cost. This tool provides a more realistic look at the
                                                    costs because you can input tuition, fees, scholarships, and more that are
                                                    unique to each college.</div>
                                                <div>Click to start comparing college costs</div>
                                                <a href="{{ route('admin-dashboard.cost_comparison') }}"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray"></i>College
                                                    Cost Comparison</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" role="tab" id="faq4_h2">
                                            <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#section-1"
                                                href="#career-exploration" aria-expanded="true"
                                                aria-controls="career-exploration">
                                                <i class="nav-main-link-icon fa fa-file"></i>
                                                Career Exploration
                                            </a>
                                        </div>
                                        <div id="career-exploration" class="collapse" role="tabpanel"
                                            aria-labelledby="faq4_h2" data-bs-parent="#section-1">
                                            <div class="block-content">
                                                <div>Your High School Resume is an important step in crafting your profile for
                                                    college admissions committees. Get started by clicking the link below.</div>
                                                <div>Click to begin your career search</div>
                                                <a href="{{ route('admin-dashboard.careerExploration') }}"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray"></i>Career
                                                    Exploration</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" role="tab" id="faq4_h2">
                                            <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#section-1"
                                                href="#college-search" aria-expanded="true" aria-controls="college-search">
                                                <i class="nav-main-link-icon fa fa-file"></i>
                                                College Search
                                            </a>
                                        </div>
                                        <div id="college-search" class="collapse" role="tabpanel" aria-labelledby="faq4_h2"
                                            data-bs-parent="#section-1">
                                            <div class="block-content">
                                                <div>Your College Application Resume is an important step in crafting your
                                                    profile for college admissions committees. Get started by clicking the link
                                                    below.</div>
                                                <div>Click to begin your College Search</div>
                                                <a href="{{ route('admin-dashboard.initialCollegeList.step1') }}"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray"></i>College
                                                    Search</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block block-rounded">
                            <div class="block-header block-header-tab text-white">
                                <h3 class="block-title">
                                    <i class="fa fa-screwdriver-wrench text-white me-1"></i> ADMISSIONS WORKSHEETS
                                </h3>
                            </div>
                            <div class="block-content">
                                <div id="section-2" class="mb-5" role="tablist" aria-multiselectable="true">
                                    @if (count($worksheet_data) > 0)
                                        @foreach ($worksheet_data as $key => $worksheet)
                                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                <div class="block-header block-header-tab" role="tab" id="faq12_h1">
                                                    <a class="text-white" data-bs-toggle="collapse"
                                                        data-bs-parent="#section-2" href="#item-{{ $key }}"
                                                        aria-expanded="true" aria-controls="item-{{ $key }}">
                                                        <i class="nav-main-link-icon fa fa-file"></i>
                                                        {{ $worksheet->name }}
                                                    </a>
                                                </div>
                                                <div id="item-{{ $key }}" class="collapse" role="tabpanel"
                                                    aria-labelledby="faq12_h1" data-bs-parent="#section-2">
                                                    <div class="block-content">
                                                        <div>{{ $worksheet->description }}</div>
                                                        <div>Click the below to download the worksheet</div>
                                                        <a href="{{ asset('uploads/worksheet/' . $worksheet->sheet_name) }}"
                                                            target="_black"
                                                            class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray download-worksheet"></i>Download
                                                            Worksheet</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="no-data mb-4">
                                            No worksheet found
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6">
                        <div class="block block-rounded">
                            <div class="block-header block-header-tab text-white">
                                <h3 class="block-title">
                                    <i class="fa fa-book text-white me-1"></i> Admissions Lessons
                                </h3>
                            </div>
                            <div class="block-content">
                                @include('components.admission.milestone-lession', [
                                    'milestones' => $milestones,
                                ])
                                <div class="text-center push">
                                    <button type="button" class="btn btn-sm btn-alt-secondary">Visit the Test Prep Lesson
                                        Homepage for
                                        more..</button><!-- sends student to the Test Prep Milestone 4 page with all the Test Prep Modules on it -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
    @endcan

    @cannot('Access Admission Dashboard')
        @include('components.subscription-warning')
    @endcan
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/js/owal-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/college-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr/toastr.min.css') }}">
@endsection

@can('Access Admission Dashboard')
    @section('user-script')
        <script src="{{ asset('assets/js/owal-carousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('assets/js/toastr/toastr.min.js') }}"></script>
        <script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
        <script>
            $(".owl-carousel").owlCarousel({
                margin: 20,
                loop: false,
                items: 3,
                animateIn: "fadeIn",
                animateOut: "fadeOut",
                dots: false,
                nav: true,
                responsive: {
                    980: {
                        items: 3,
                    },
                    600: {
                        items: 2,
                    },
                    320: {
                        items: 1,
                    },
                }
            });
        </script>
        <script>
            $(document).on('click', '.manage-deadline', function(e) {
                // if (e.target.dataset.deadLine === '') {
                if (!e.target.dataset.admissionOption) {
                    $('#admission_deadline_formgroup').hide();
                } else {
                    $('#admission_deadline_formgroup').show();
                }

                $("#deadline-modal").attr("data-id", e.target.dataset.deadlineId);

                $(".deadline-date").datepicker("setDate", e.target.dataset.deadLine);
                $(".update-deadline").attr("data-id", e.target.dataset.deadlineId);
                $(".update-deadline").attr("data-date", e.target.dataset.deadLine);

                $(".update-deadline").attr("data-admission-option", e.target.dataset.admissionOption);
                $(".admission-option").val(e.target.dataset.admissionOption);
            });
            $('.deadline-date').datepicker({
                format: 'mm-dd-yyyy',
                // startDate: deadline,
                autoclose: true
            })
            $(document).on('change', '.deadline-date', function(e) {
                $(".update-deadline").attr("data-date", e.target.value);
            })

            var admissionOptionNeedAlert = false
            $(document).on('change', '.admission-option', function(e) {
                const admissionOptionSelected = e.target.value

                if (!admissionOptionNeedAlert) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Admission deadline will be updated according to its default value of the selected admission option!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, update it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            setDeadlineOnAdmissionOptionChange(e)
                            admissionOptionNeedAlert = true
                        } else {
                            console.log('cancel')
                            // revert back to last selected admission option

                            // get attribute data-admission-option
                            const admissionOption = $(".update-deadline").attr("data-admission-option");
                            // console.log('admissionOption', admissionOption)

                            // set select option to the last selected admission option
                            $("#admissions_option").val(admissionOption)
                        }
                    });
                } else {
                    setDeadlineOnAdmissionOptionChange(e)
                }

                if (e.target.value === '') {
                    $('#admission_deadline_formgroup').hide();
                } else {
                    $('#admission_deadline_formgroup').show();
                }
            })

            const setDeadlineOnAdmissionOptionChange = (e) => {
                $(".update-deadline").attr("data-admission-option", e.target.value);

                // get college id
                const collegeId = $("#deadline-modal").attr("data-id");
                // console.log('collegeId', collegeId);

                // get college_data from textarea[college_data[collegeId]
                const collegeDataString = $(`textarea[name="college_data[${collegeId}]"]`).val();
                if (collegeDataString) {
                    const collegeData = JSON.parse(collegeDataString);
                    // console.log('collegeData', collegeData);

                    if (collegeData) {
                        const admissionOptionSelected = e.target.value;
                        const collegeInformation = collegeData.college_information;

                        // admission deadline:
                        // Early Action: AP_DL_EACT_DAY, AP_DL_EACT_MON
                        // Early Decision 1: AP_DL_EDEC_1_DAY, AP_DL_EDEC_1_MON
                        // Early Decision 2: AP_DL_EDEC_2_DAY, AP_DL_EDEC_2_MON
                        // Regular Decision: AP_DL_FRSH_DAY, AP_DL_FRSH_MON
                        // Rolling Admission: No

                        let deadlineDay = null
                        let deadlineMonth = null

                        if (admissionOptionSelected === 'Early Action') {
                            // console.log('Early Action')
                            deadlineDay = collegeInformation.early_action_day ?? collegeInformation.AP_DL_EACT_DAY
                            deadlineMonth = collegeInformation.early_action_month ?? collegeInformation.AP_DL_EACT_MON
                        } else if (admissionOptionSelected === 'Early Decision') {
                            // console.log('Early Decision 1')
                            deadlineDay = collegeInformation.early_decision_i_day ?? collegeInformation.AP_DL_EDEC_1_DAY
                            deadlineMonth = collegeInformation.early_decision_i_month ?? collegeInformation
                                .AP_DL_EDEC_1_MON
                        } else if (admissionOptionSelected === 'Early Decision 2') {
                            // console.log('Early Decision 2')
                            deadlineDay = collegeInformation.early_decision_ii_day ?? collegeInformation
                                .AP_DL_EDEC_2_DAY
                            deadlineMonth = collegeInformation.early_decision_ii_month ?? collegeInformation
                                .AP_DL_EDEC_2_MON
                        } else if (admissionOptionSelected === 'Regular Decision') {
                            // console.log('Regular Decision')
                            deadlineDay = collegeInformation.regular_decision_day ?? collegeInformation.AP_DL_FRSH_DAY
                            deadlineMonth = collegeInformation.regular_decision_month ?? collegeInformation
                                .AP_DL_FRSH_MON
                        } else if (admissionOptionSelected === 'Rolling Admission') {
                            // console.log('Rolling Admission')
                            deadlineDay = null
                            deadlineMonth = null
                        }

                        let deadlineDate = ''

                        // set deadlineDate to YYYY-MM-DD format, MM from deadlineMonth, DD from deadlineDay
                        // if deadlineDate has been passed, then set deadlineDate to the next year
                        if (deadlineDay && deadlineMonth) {
                            const year = new Date().getFullYear()
                            const date = new Date(year, deadlineMonth - 1, deadlineDay)
                            if (date < new Date()) {
                                deadlineDate = `${deadlineMonth}-${deadlineDay}-${year + 1}`
                            } else {
                                deadlineDate = `${deadlineMonth}-${deadlineDay}-${year}`
                            }
                        }

                        console.log('default deadlineDate', deadlineDate)
                        $('#admissions_deadline').datepicker('setDate', deadlineDate)
                        // if (deadlineDate) {
                        //     $('#admissions_deadline').datepicker('setDate', deadlineDate)
                        // }
                    }
                }
            }

            function updateDeadline(dataset) {
                const deadlineId = dataset.id;
                const deadlineDate = dataset.date;
                const admissionOption = dataset.admissionOption;
                $.ajax({
                    url: "{{ route('admin-dashboard.college_application_save') }}",
                    type: 'POST',
                    data: {
                        college_detail_id: deadlineId,
                        admissions_deadline: deadlineDate,
                        admission_option: admissionOption
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                }).done(async (response) => {
                    if (response.success) {
                        toastr.success(response.message);
                        const responseDate = response.date
                        const responseDateLabel = response.dateLabel
                        if (response.daysleft === "") {
                            $(`#${deadlineId} .manage-deadline`).attr('data-dead-line', '');

                            $(`#${deadlineId} .deadline-div`).empty();
                            let html = `<span class="text-danger d-block">Not Published</span>`;
                            $(`#${deadlineId} .deadline-div`).append(html);
                            // $(`#${deadlineId} .dead-line`).attr('class','text-danger').text('Not Published');
                        } else {
                            $(`#${deadlineId} .manage-deadline`).attr('data-dead-line', responseDate);
                            $(`#${deadlineId} .manage-deadline`).attr('data-admission-option', admissionOption);

                            $(`#${deadlineId} .deadline-div`).empty();
                            let html =
                                `<div class="fs-xs text-muted text-italic">${admissionOption}</div><span class="text-dark d-block">${responseDateLabel}</span><span class="text-dark d-block fs-xs">${response.daysleft}</span>`
                            $(`#${deadlineId} .deadline-div`).append(html);
                        }

                        $('#deadline-modal').modal('hide');
                        admissionOptionNeedAlert = false
                    } else {
                        toastr.error(response.message);
                    }
                })
            }
        </script>
    @endsection
@endcan
