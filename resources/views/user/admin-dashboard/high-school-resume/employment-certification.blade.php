@extends('layouts.user')

@section('title', 'HSR | Employment & Certification : CPS')

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
        <div class="">
            <div class="custom-tab-container ">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li role="presentation">
                        <a class="nav-link" href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/personal-info?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.personalInfo')}}"
                            id="step1-tab">
                            <p class="d-none">1</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Personal Info</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{  isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/education-info?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.educationInfo')}}"
                            id="step2-tab">
                            <p class="d-none">2</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Education </h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/honors?resume_id='.$resume_id) :route('admin-dashboard.highSchoolResume.honors')}}" id="step3-tab">
                            <p class="d-none">3</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Honors </h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/activities?resume_id='.$resume_id): route('admin-dashboard.highSchoolResume.activities') }}"
                            id="step4-tab">
                            <p class="d-none">4</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Activities</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link active"
                            href="{{isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/employment-certifications?resume_id='.$resume_id):route('admin-dashboard.highSchoolResume.employmentCertification')}}" id="step5-tab">
                            <p>5</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Employment & <br> Certifications</h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($employmentCertification) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                        <a class="nav-link" href="{{ isset($employmentCertification) && $employmentCertification != null ? ( isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/features-attributes?resume_id='.$resume_id):route('admin-dashboard.highSchoolResume.featuresAttributes')) : ''}}"
                            id="step6-tab">
                            <p>6</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Featured <br> Attributes</h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($employmentCertification) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                        <a class="nav-link" href="{{ isset($featuredAttribute) && $featuredAttribute != null  ? ( isset($resume_id) && $resume_id != null  ? url('user/admin-dashboard/high-school-resume/preview?resume_id='.$resume_id):route('admin-dashboard.highSchoolResume.preview')) : ''}}" id="step7-tab">
                            <p>7</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Preview</h6>
                        </a>
                    </li>
                </ul>
                <form class="js-validation" id="employment_form" action="{{ isset($employmentCertification) && $employmentCertification != null ? route('admin-dashboard.highSchoolResume.employmentCertification.update', $employmentCertification->id) : route('admin-dashboard.highSchoolResume.employmentCertification.store') }}" method="POST">
                    @csrf
                    @if(isset($employmentCertification) && $employmentCertification != null)
                        @method('PUT')
                    @endif
                    @if(isset($resume_id) && $resume_id != null)
                        <input type="hidden" name="resume_id" id="resume_id" value="{{ $resume_id }}">
                    @endif
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content">
                            <div class="accordion accordionExample2">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <a class="text-white fw-600 collapsed"> Employment & Certifications</a>
                                    </div>
                                    <div id="collapseOne"
                                        class="collapse show"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table employement_table">
                                                    <tbody>
                                                        <tr>
                                                            <input type="hidden" name="employmentCertification" id="employmentCertification" value="{{ isset($employmentCertification) && $employmentCertification != null ? $employmentCertification->id : ''}}">
                                                            <td>
                                                                <label class="form-label"
                                                                   for="name_of_company">
                                                                   Name Of The Company
                                                               </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="job_title">
                                                                    Job Title
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="employment_grade">
                                                                    Grade(s)
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="employment_location">
                                                                    Location
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="employment_honor_award">
                                                                    Honor / Award
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($employmentCertification->employment_data))
                                                            @foreach ($employmentCertification->employment_data as $index => $employment_data)
                                                                <tr class="employment_data_table_row {{ $loop->first ? '' : 'remove_employement_data' }}">
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="name_of_company"
                                                                            value="{{ $employment_data['name_of_company'] }}"
                                                                            name="employment_data[{{ $index }}][name_of_company]"
                                                                            placeholder="Ex: Starbucks">
                                                                    </td>
                                                                    <td>
                                                                        {{-- <input type="text"
                                                                            class="form-control" id="job_title" value="{{ $employment_data['job_title'] }}"
                                                                            name="employment_data[{{ $index }}][job_title]" placeholder="Enter Job title"> --}}
                                                                        <select class="js-select2 form-select single-select2-class" id="job_title_{{ $index }}" name="employment_data[{{ $index }}][job_title]" style="width: 100%;" data-placeholder="Select" multiple="multiple">
                                                                            <option value="">Select</option>
                                                                            @foreach($demonstrated_positions as $position)
                                                                                <option value="{{$position->position_name}}" {{ isset($employment_data['job_title']) && $employment_data['job_title'] != null ? ($employment_data['job_title']  == $position->position_name ? 'selected' : '') : '' }}> {{$position->position_name}} </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <select class="js-select2 select" id="employment_select_{{ $index }}"
                                                                            name="employment_data[{{ $index }}][grade][]" multiple="multiple">
                                                                            @foreach ($grades as $grade)
                                                                                <option {{  isset($employment_data['grade']) && $employment_data['grade'] != null ? (in_array($grade->id ,is_array($employment_data['grade']) ? $employment_data['grade'] : []) ? 'selected' : ' ') : '' }} value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="employment_location" name="employment_data[{{ $index }}][location]"
                                                                            value="{{ $employment_data['location'] }}"
                                                                            placeholder="Enter Location">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="employment_honor_award"
                                                                            name="employment_data[{{ $index }}][honor_award]"
                                                                            value="{{ $employment_data['honor_award'] }}"
                                                                            placeholder="Enter Honor / Award">
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                            <i class="fa-solid {{ $loop->first ? 'fa-plus' : 'fa-minus'}}" data-count="{{ count($employmentCertification->employment_data) != 0 ? count($employmentCertification->employment_data) - 1 : 0 }}" onclick="{{ $loop->first ? 'addEmploymentData(this)' : 'removeEmploymentData(this)' }}"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else 
                                                            <tr class="employment_data_table_row">
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="name_of_company"
                                                                        name="employment_data[0][name_of_company]"
                                                                        placeholder="Ex: Starbucks">
                                                                </td>
                                                                <td>
                                                                    {{-- <input type="text"
                                                                        class="form-control" id="job_title"
                                                                        name="employment_data[0][job_title]" placeholder="Enter Job title"> --}}
                                                                    <select class="js-select2 form-select single-select2-class" id="job_title" name="employment_data[0][job_title]" style="width: 100%;" data-placeholder="Select" multiple="multiple">
                                                                        <option value="">Select</option>
                                                                        @foreach($demonstrated_positions as $position)
                                                                            <option value="{{$position->position_name}}"> {{$position->position_name}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="js-select2 select" id="employment_select_0"
                                                                        name="employment_data[0][grade][]" multiple="multiple">
                                                                        @foreach ($grades as $grade)
                                                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="employment_location" name="employment_data[0][location]"
                                                                        placeholder="Enter Location">
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="employment_honor_award"
                                                                        name="employment_data[0][honor_award]"
                                                                        placeholder="Enter Honor / Award">
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                        <i class="fa-solid fa-plus" data-count="0" onclick="addEmploymentData(this)"></i>
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
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        <a class="text-white fw-600 collapsed">Other Significant Responsibilities Or
                                            Interests</a>
                                    </div>
                                    <div id="collapseTwo"
                                        class="collapse"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table significant_table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                 <label class="form-label"
                                                                    for="responsibility_interest">
                                                                    Responsibility Or Interest
                                                                </label>
                                                            </td>
                                                            <td>
                                                                 <label class="form-label"
                                                                    for="significant_grade">
                                                                    Grade(s)
                                                                </label>
                                                            </td>
                                                            <td>
                                                                 <label class="form-label"
                                                                    for="significant_location">
                                                                    Location
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="significant_honor_award">
                                                                    Honor / Award
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($employmentCertification->significant_data))
                                                            @foreach ($employmentCertification->significant_data as $index => $significant_data)
                                                                <tr class="significant_data_table_row {{ $loop->first ? '' : 'remove_significant_data' }}">
                                                                    <td>                                                               
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="responsibility_interest"
                                                                            value="{{ $significant_data['interest'] }}"
                                                                            name="significant_data[{{ $index }}][interest]"
                                                                            placeholder="Enter Responsibility/interest">
                                                                    </td>
                                                                    <td>                                                               
                                                                        <select class="js-select2 select"
                                                                            id="significant_select_{{ $index }}"
                                                                            name="significant_data[{{ $index }}][grade][]"
                                                                            multiple="multiple">
                                                                            @foreach ($grades as $grade)
                                                                                <option {{ isset($significant_data['grade']) && $significant_data['grade'] != null ? (in_array($grade->id ,is_array($significant_data['grade']) ? $significant_data['grade'] : []) ? 'selected' : ' ') : '' }} value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td>                                                               
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="significant_location"
                                                                            value="{{ $significant_data['location'] }}"
                                                                            name="significant_data[{{ $index }}][location]"
                                                                            placeholder="Enter Location">
                                                                    </td>
                                                                    <td>                                                                
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="significant_honor_award"
                                                                            value="{{ $significant_data['honor_award'] }}"
                                                                            name="significant_data[{{ $index }}][honor_award]"
                                                                            placeholder="Enter Honor / Award">
                                                                    </td>
                                                                    <td>                                                                
                                                                        <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                            <i class="fa-solid {{ $loop->first ? 'fa-plus' : 'fa-minus' }}" data-count="{{ count($employmentCertification->significant_data) != 0 ? count($employmentCertification->significant_data) - 1 : 0 }}" onclick="{{ $loop->first ? 'addSignificantData(this)' : 'removeSignificantData(this)' }}"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr class="significant_data_table_row">
                                                                <td>                                                               
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="responsibility_interest"
                                                                        name="significant_data[0][interest]"
                                                                        placeholder="Enter Responsibility/interest">
                                                                </td>
                                                                <td>                                                               
                                                                    <select class="js-select2 select"
                                                                        id="significant_select_0"
                                                                        name="significant_data[0][grade][]"
                                                                        multiple="multiple">
                                                                        @foreach ($grades as $grade)
                                                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>                                                               
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="significant_location"
                                                                        name="significant_data[0][location]"
                                                                        placeholder="Enter Location">
                                                                </td>
                                                                <td>                                                                
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="significant_honor_award"
                                                                        name="significant_data[0][honor_award]"
                                                                        placeholder="Enter Honor / Award">
                                                                </td>
                                                                <td>                                                                
                                                                    <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                        <i class="fa-solid fa-plus" data-count="0" onclick="addSignificantData(this)"></i>
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
                            <div class="d-flex justify-content-between mt-3">
                                <div class="prev-btn next-btn">
                                    <a href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/activities?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.activities') }}"
                                        class="btn btn-alt-success prev-step"> Previous Step
                                    </a>
                                </div>
                                <div class="next-btn d-flex">
                                    @if (!isset($resume_id))
                                        <div>
                                            @include('components.reset-all-drafts-button')
                                        </div>
                                    @endif
                                    <input type="submit" class="btn  btn-alt-success next-step" value="Next Step">
                                </div>
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
    <link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
    <script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <style>
        .select2-container .select2-selection--multiple {
            min-width: 13vw !important;
        }
        .swal2-styled.swal2-default-outline:focus {
            box-shadow: none;
        }
        .swal2-icon.swal2-warning {
            border-color: #f27474;
            color: #f27474;
        }
    </style>
@endsection

@section('user-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/high-school-resume.js') }}"></script>
    <script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
    <script>
        let total_employment_count = "{{ isset($employmentCertification->employment_data) && $employmentCertification->employment_data != null ? count($employmentCertification->employment_data) : 0 }}";
        let total_significant_count = "{{ isset($employmentCertification->significant_data) && $employmentCertification->significant_data != null ? count($employmentCertification->significant_data) : 0 }}";

        $(document).ready(function() {
            $('.single-select2-class').select2({
                maximumSelectionLength: 1,
                tags: true,
                language: {
                    maximumSelected: function () {
                        return '';
                    }
                }
            }).on('select2:opening', function (event) {
                var selectedOptions = $(this).val();
                if (selectedOptions && selectedOptions.length >= 1) {
                    event.preventDefault();
                }
            });
        });

        $(document).ready(() => {
            if(total_employment_count > 0) {
                for (let index = 0; index < total_employment_count; index++) {
                    $(`#employment_select_${index}`).select2({
                        tags: true,
                        placeholder : "Select employment grade"
                    });
                }
            } else {
                $("#employment_select_0").select2({
                    tags: true,
                    placeholder : "Select employment grade"
                });
            }

            if(total_significant_count > 0) {
                for (let index = 0; index < total_significant_count; index++) {
                    $(`#significant_select_${index}`).select2({
                        tags: true,
                        placeholder : "Select significant grade"
                    });
                }
            } else {
                $("#significant_select_0").select2({
                    tags: true,
                    placeholder : "Select significant grade"
                });
            }

        });

        function errorMsg()
        {
            Swal.fire({
                title: 'Complete Current Step',
                text: "You Have to submit current form",
                icon: 'warning',
                confirmButtonColor: '#F27474',
                confirmButtonText: 'Okay'
            }).then((result) => {
                window.location.href = "{{ route('admin-dashboard.highSchoolResume.employmentCertification') }}";
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
