@extends('layouts.user')

@section('title', 'HSR | Honors : CPS')

@section('user-content')
    <main id="main-container">
        <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
            <div class="bg-black-10">
                <div class="content content-full text-center">
                    <br>
                    <h1 class="h2 text-white mb-0">High School Resume Tool</h1>
                    <br>
                </div>
            </div>
        </div>
        <div class="container honors-container">
            <div class="custom-tab-container">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li role="presentation">
                        <a class="nav-link"
                            href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/personal-info?resume_id=' . $resume_id) : route('admin-dashboard.highSchoolResume.personalInfo') }}"
                            id="step1-tab">
                            <p class="d-none">1</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Personal Info</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link "
                            href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/education-info?resume_id=' . $resume_id) : route('admin-dashboard.highSchoolResume.educationInfo') }}"
                            id="step2-tab">
                            <p class="d-none">2</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Education </h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link active"
                            href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/employment-certifications?resume_id=' . $resume_id) : route('admin-dashboard.highSchoolResume.honors') }}"
                            id="step3-tab">
                            <p>3</p>
                            <i class="fa-solid fa-check"></i>
                            <h6>Honors </h6>
                        </a>
                    </li>
                    <li role="presentation"
                        onclick="{{ !isset($honor) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                        <a class="nav-link"
                            href="{{ isset($honor) && $honor != null ? (isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/activities?resume_id=' . $resume_id) : route('admin-dashboard.highSchoolResume.activities')) : '' }}"
                            id="step4-tab">
                            <p>4</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Activities</h6>
                        </a>
                    </li>
                    <li role="presentation"
                        onclick="{{ !isset($honor) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                        <a class="nav-link"
                            href="{{ isset($activity) && $activity != null ? (isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/employment-certifications?resume_id=' . $resume_id) : route('admin-dashboard.highSchoolResume.employmentCertification')) : '' }}"
                            id="step5-tab">
                            <p>5</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Employment & <br> Certifications</h6>
                        </a>
                    </li>
                    <li role="presentation"
                        onclick="{{ !isset($honor) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                        <a class="nav-link"
                            href="{{ isset($employmentCertification) && $employmentCertification != null ? (isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/features-attributes?resume_id=' . $resume_id) : route('admin-dashboard.highSchoolResume.featuresAttributes')) : '' }}"
                            id="step6-tab">
                            <p>6</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Featured <br> Attributes</h6>
                        </a>
                    </li>
                    <li role="presentation"
                        onclick="{{ !isset($honor) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                        <a class="nav-link"
                            href="{{ isset($featuredAttribute) && $featuredAttribute != null ? (isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/preview?resume_id=' . $resume_id) : route('admin-dashboard.highSchoolResume.preview')) : '' }}"
                            id="step7-tab">
                            <p>7</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Preview</h6>
                        </a>
                    </li>
                </ul>
                <form class="js-validation" id="honors_form"
                    action="{{ isset($honor) && $honor != null ? route('admin-dashboard.highSchoolResume.honors.update', $honor->id) : route('admin-dashboard.highSchoolResume.honors.store') }}"
                    method="POST" onSubmit="event.preventDefault();">
                    @csrf
                    @if (isset($honor) && $honor != null)
                        @method('PUT')
                    @endif
                    @if (isset($resume_id) && $resume_id != null)
                        <input type="hidden" name="resume_id" id="resume_id" value="{{ $resume_id }}">
                    @endif
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content">
                            <div class="accordion accordionExample2">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <a class=" text-white fw-600 collapsed"> Academic Honors, Achievements & Other
                                            Awards</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <input type="hidden" name="honor" id="honor"
                                                    value="{{ isset($honor) && $honor != null ? $honor->id : '' }}">
                                                <table class="table table_honors_data">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <label class="form-label" for="position">
                                                                    Position
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="honor_achievement_award">
                                                                    Honor/Achievement/Award
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="grade">
                                                                    Grade(s)
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="location">
                                                                    Location
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                            </td>
                                                        </tr>
                                                        @if (!empty($honor->honors_data))
                                                            @foreach ($honor->honors_data as $index => $honors_data)
                                                                <tr
                                                                    class="honors_data_table_row {{ $loop->first ? '' : 'remove_honors_data' }}">
                                                                    <td>
                                                                        <input type="text" class="form-control"
                                                                            id="position"
                                                                            name="honors_data[{{ $index }}][position]"
                                                                            value="{{ $honors_data['position'] }}"
                                                                            placeholder="Vice President"
                                                                            autocomplete="off">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control"
                                                                            id="honor_achievement_award"
                                                                            name="honors_data[{{ $index }}][honor_achievement_award]"
                                                                            value="{{ $honors_data['honor_achievement_award'] }}"
                                                                            placeholder="Ex: National Honor Society">
                                                                    </td>
                                                                    <td class="select2-container_main">
                                                                        <select class="required js-select2"
                                                                            data-placeholder="Select Grade"
                                                                            id="honor_select_{{ $index }}"
                                                                            name="honors_data[{{ $index }}][grade][]"
                                                                            multiple="multiple">
                                                                            @foreach ($grades as $grade)
                                                                                <option {{ in_array($grade->id, is_array($honors_data['grade']) ? $honors_data['grade'] : []) ? 'selected' : '' }} value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $honors_data['location'] }}"
                                                                            id="location"
                                                                            name="honors_data[{{ $index }}][location]"
                                                                            placeholder="Ex: DRHS">
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:void(0)"
                                                                            class="add-btn d-flex plus-icon">
                                                                            <i data-count="{{ count($honor->honors_data) != 0 ? count($honor->honors_data) - 1 : 0 }}"
                                                                                class="fa-solid {{ $loop->first ? 'fa-plus' : 'fa-minus' }}"
                                                                                onclick="{{ $loop->first ? 'addHonorsData(this)' : 'removeHonorsData(this)' }}"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr class="honors_data_table_row">
                                                                <td>
                                                                    <input type="text" class="form-control"
                                                                        id="position" name="honors_data[0][position]"
                                                                        placeholder="Vice President" autocomplete="off">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control"
                                                                        id="honor_achievement_award"
                                                                        name="honors_data[0][honor_achievement_award]"
                                                                        placeholder="Ex: National Honor Society">
                                                                </td>
                                                                <td class="select2-container_main">
                                                                    <select class="required js-select2"
                                                                        data-placeholder="Select Grade"
                                                                        id="honor_select_0" name="honors_data[0][grade][]"
                                                                        multiple="multiple">
                                                                        @foreach ($grades as $grade)
                                                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control"
                                                                        id="location" name="honors_data[0][location]"
                                                                        placeholder="Ex: DRHS">
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)"
                                                                        class="add-btn d-flex plus-icon">
                                                                        <i class="fa-solid fa-plus" data-count="0"
                                                                            onclick="addHonorsData(this)"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <div class="prev-btn next-btn">
                                <a href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/education-info?resume_id=' . $resume_id) : route('admin-dashboard.highSchoolResume.educationInfo') }}"
                                    class="btn btn-alt-success prev-step "> Previous Step
                                </a>
                            </div>
                            <div class="next-btn d-flex">
                                @if (!isset($resume_id))
                                    <div>
                                        @include('components.reset-all-drafts-button')
                                    </div>
                                @endif
                                <input type="submit" class="btn btn-alt-success next-step" value="Next Step">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr/toastr.min.css') }}">
    <style>
        .select2-container .select2-selection--multiple {
            min-width: 14vw !important;
        }

        .swal2-styled.swal2-default-outline:focus {
            box-shadow: none;
        }

        .swal2-icon.swal2-warning {
            border-color: #f27474;
            color: #f27474;
        }

        .select2-container_main .error {
            position: absolute;
            top: 51px;
        }

        .table tbody tr:nth-child(0) td {
            padding: 0 !important;
        }

        .select2-container_main {
            display: inline-block;
        }
    </style>
@endsection

@section('user-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/high-school-resume.js') }}"></script>
    <script src="{{ asset('assets/js/toastr/toastr.min.js') }}"></script>
    <script>
        let total_honors_count = "{{ isset($honor->honors_data) && $honor->honors_data != null ? count($honor->honors_data) : 0 }}";

        $(document).ready(() => {
            if (total_honors_count > 0) {
                for (let index = 0; index < total_honors_count; index++) {
                    $(`#honor_select_${index}`).select2({
                        tags: true,
                    });
                }
            } else {
                $("#honor_select_0").select2({
                    tags: true,
                });
            }
        });

        $(document).ready(function() {

            let validations_rules = @json($validations_rules);
            let validations_messages = @json($validations_messages);

            $("#honors_form").validate({
                rules: validations_rules,
                messages: validations_messages,
                ignore: false,
                submitHandler: function(form) {
                    form.submit();
                },
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                        $(element).parents("td.select2-container_main").css("margin-bottom", '0');
                    } else {
                        error.insertAfter(element);
                        element.parents().find('.collapse').addClass('show');
                        $(element).parents("td.select2-container_main").css("margin-bottom", '20px');
                    }
                    if ($(element).is('.js-select2.error')) {
                        $(element).parents('td.select2-container_main').find(
                            '.select2-selection--multiple').removeAttr('style')
                    }
                },
                success: function(label, element) {
                    label.parent().removeClass('error');
                    label.remove();
                    $(element).parents('td.select2-container_main').find('.select2-selection--multiple')
                        .attr('style', 'border: 1px solid #198754 !important');
                },
            });

            let honors_data = $('input[name^="honors_data"]');

            honors_data.filter('input[name$="[position]"]').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Position field is required"
                    }
                });
            });
            honors_data.filter('input[name$="[honor_achievement_award]"]').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Achivement awars field is required"
                    }
                });
            });
            honors_data.filter('input[name$="[grade][]"]').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Grade field is required"
                    }
                });
            });
            honors_data.filter('input[name$="[location]"]').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Location field is required"
                    }
                });
            });
        });

        function errorMsg() {
            Swal.fire({
                title: 'Complete Current Step',
                text: "You Have to submit current form",
                icon: 'warning',
                confirmButtonColor: '#F27474',
                confirmButtonText: 'Okay'
            }).then((result) => {
                window.location.href = "{{ route('admin-dashboard.highSchoolResume.honors') }}";
            });
        }

        toastr.options = {
            "closeButton": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
@endsection
