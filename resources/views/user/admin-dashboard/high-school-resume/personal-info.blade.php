@extends('layouts.user')

@section('title', 'HSR | Personal Info : CPS')

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
            <div class="custom-tab-container">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{Session::get('message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{Session::forget('success')}}
                @endif
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li role="presentation">
                        <a class="nav-link active" href="{{ isset($personal_info) && $personal_info != null ? ( isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/personal-info?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.personalInfo')) : '' }}"
                            id="step1-tab">
                            <p>1</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Personal Info</h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($personal_info) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                        {{-- <a class="nav-link" href="{{ isset($personal_info) && $personal_info != null ? ( isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/education-info?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.educationInfo')) : ''}}" id="step2-tab"> --}}
                        <a class="nav-link" href="#" id="step2-tab" onclick="redirectFunction('{{ isset($personal_info) && $personal_info != null ? ( isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/education-info?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.educationInfo')) : ''}}')">
                            <p>2</p>
                            <i class="fa-solid fa-check  "></i>
                            <h6>Education</h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($personal_info) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                        {{-- <a class="nav-link" href="{{ isset($education) && $education != null ? ( isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/honors?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.honors')) : ''}}" id="step3-tab"> --}}
                        <a class="nav-link" href="#" id="step3-tab" onclick="redirectFunction('{{ isset($education) && $education != null ? ( isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/honors?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.honors')) : route('admin-dashboard.highSchoolResume.educationInfo')}}')">
                            <p>3</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Honors</h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($personal_info) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                        {{-- <a class="nav-link" href="{{ isset($honor) && $honor != null ? ( isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/activities?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.activities')) : ''}}" id="step4-tab"> --}}
                        <a class="nav-link" href="#" id="step4-tab" onclick="redirectFunction('{{ isset($honor) && $honor != null ? ( isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/activities?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.activities')) : route('admin-dashboard.highSchoolResume.honors')}}')">
                            <p>4</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Activities</h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($personal_info) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                        {{-- <a class="nav-link" href="{{ isset($activity) && $activity != null ? ( isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/employment-certifications?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.employmentCertification')) : ''}}" id="step5-tab"> --}}
                        <a class="nav-link" href="#" id="step5-tab" onclick="redirectFunction('{{ isset($activity) && $activity != null ? ( isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/employment-certifications?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.employmentCertification')) : route('admin-dashboard.highSchoolResume.activities')}}')">
                            <p>5</p>
                            <i class="fa-solid fa-check"></i>
                            <h6>Employment & <br> Certifications</h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($personal_info) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                        {{-- <a class="nav-link" href="{{ isset($employmentCertification) && $employmentCertification != null ? ( isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/features-attributes?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.featuresAttributes')) : ''}}" id="step6-tab"> --}}
                        <a class="nav-link" href="#" id="step6-tab" onclick="redirectFunction('{{ isset($employmentCertification) && $employmentCertification != null ? ( isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/features-attributes?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.featuresAttributes')) : route('admin-dashboard.highSchoolResume.employmentCertification')}}')">
                            <p>6</p>
                            <i class="fa-solid fa-check"></i>
                            <h6>Featured <br> Attributes</h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($personal_info) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                        {{-- <a class="nav-link" href="{{ isset($featuredAttribute) && $featuredAttribute != null ? ( isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/preview?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.preview')) : ''}}" id="step7-tab"> --}}

                        <a class="nav-link" href="#" id="step7-tab" onclick="redirectFunction('{{ isset($featuredAttribute) && $featuredAttribute != null ? ( isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/preview?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.preview')) : route('admin-dashboard.highSchoolResume.featuresAttributes')}}')">
                            <p>7</p>
                            <i class="fa-solid fa-check"></i>
                            <h6>Preview</h6>
                        </a>
                    </li>
                </ul>
                <form class="js-validation" id="personal_info_form"
                    action="{{ isset($personal_info) && $personal_info != null ? route('admin-dashboard.highSchoolResume.personalInfo.update', $personal_info->id) : route('admin-dashboard.highSchoolResume.personalInfo.store') }}"
                    method="POST" onSubmit="event.preventDefault();">
                    @csrf
                    @if (isset($personal_info) && $personal_info != null)
                        @method('PUT')
                    @endif
                    @if(isset($resume_id) && $resume_id != null)
                        <input type="hidden" name="resume_id" id="resume_id" value="{{ $resume_id }}">
                    @endif
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                            <div class="accordion accordionExample">
                                <div class="d-flex justify-content-between mt-3">
                                    <div></div>
                                    @include('user.admin-dashboard.high-school-resume.components.return-homepage-btn')
                                    <div class="next-btn d-flex">
                                        @if (!isset($resume_id))
                                            <div>
                                                @include('components.reset-all-drafts-button')
                                            </div>
                                        @endif
                                        <div class="next-btn">
                                            <input type="submit" class="btn btn-alt-success next-step" value="Next Step"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <a class=" text-white fw-600 collapsed">Personal Info</a>
                                    </div>
                                    <div id="collapseOne"
                                        class="collapse show"
                                        aria-labelledby="headingOne" data-parent=".accordionExample">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="first_name">
                                                                First Name
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text"
                                                                class="form-control"
                                                                value="{{ isset($personal_info->first_name) && $personal_info->first_name != null ? $personal_info->first_name : "" }}"
                                                                id="first_name" name="first_name"
                                                                placeholder="Enter First Name" autocomplete="__away">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="middle_name">
                                                                Middle
                                                            </label>
                                                            <input type="text"
                                                                class="form-control"
                                                                value="{{ isset($personal_info->middle_name) && $personal_info->middle_name != null ? $personal_info->middle_name : "" }}"
                                                                id="middle_name" name="middle_name"
                                                                placeholder="Enter Middle Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="last_name">
                                                                Last Name
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text"
                                                                class="form-control"
                                                                value="{{ isset($personal_info->last_name) && $personal_info->last_name != null ? $personal_info->last_name : "" }}"
                                                                id="last_name" name="last_name"
                                                                placeholder="Enter Last Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="nick_name">
                                                                Nick Name
                                                            </label>
                                                            <input type="text"
                                                                class="form-control"
                                                                value="{{ isset($personal_info->nick_name) && $personal_info->nick_name != null ? $personal_info->nick_name : "" }}"
                                                                id="nick_name" name="nick_name"
                                                                placeholder="Enter Nick Name">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        <a class="text-white fw-600 collapsed">Address</a>
                                    </div>
                                    <div id="collapseTwo"
                                        class="collapse"
                                        aria-labelledby="headingOne" data-parent=".accordionExample">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-12">
                                                        <div>
                                                            <label class="form-label" for="street_address_one">
                                                                Street Address 1
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <textarea class="form-control" id="street_address_one"
                                                                name="street_address_one" placeholder="Enter Street Address 1" autocomplete="__away">{{ isset($personal_info->street_address_one) ? $personal_info->street_address_one : "" }}</textarea>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-lg-6">
                                                        <label class="form-label" for="street_address_two">
                                                            Street Address 2
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <textarea class="form-control" id="street_address_two"
                                                            name="street_address_two" placeholder="Enter Street Address 2">{{ isset($personal_info->street_address_two) ? $personal_info->street_address_two : "" }}</textarea>
                                                    </div> --}}
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="city">
                                                                Apartment No
                                                            </label>
                                                            <input type="text"
                                                                class="form-control"
                                                                value="{{ isset($personal_info->apartment_no) && $personal_info->apartment_no != null ? $personal_info->apartment_no : "" }}"
                                                                id="apartment_no" name="apartment_no" placeholder="Enter Apartment No" autocomplete="__away">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="select2-container_main">
                                                            <label class="form-label" for="state">
                                                                State
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="js-select2 form-select" name="state" id="state" style="width: 100%;" data-placeholder="Choose one..">
                                                                <option></option>
                                                                @foreach($states as $states)
                                                                    <option value="{{$states->id}}" {{ isset($personal_info->state) && $personal_info->state != null ? ($personal_info->state  == $states->state_name ? 'selected' : '') : '' }} > {{$states->state_name}} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
													<div class="col-lg-3">
                                                        <div class="select2-container_main">
                                                            <label class="form-label" for="city">
                                                                City
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="js-select2 form-select" name="city" id="city" style="width: 100%;" data-placeholder="Enter city">
                                                                <option></option>
                                                                @foreach($cities as $citys)
                                                                    <option value="{{$citys->id}}" {{ isset($personal_info->city) && $personal_info->city != null ? ($personal_info->city  == $citys->city_name  ? 'selected' : '') : '' }} > {{$citys->city_name }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="zip_code">
                                                                Zip Code
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="number"
                                                                class="form-control"
                                                                onkeydown="javascript: return event.keyCode == 69 ? false : true"
                                                                value="{{ isset($personal_info->zip_code) && $personal_info->zip_code != null ? $personal_info->zip_code : '' }}"
                                                                id="zip_code" name="zip_code"
                                                                placeholder="Enter Zip Code">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="personal_info" id="personal_info" value="{{ isset($personal_info) && $personal_info != null ? $personal_info->id : '' }}">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        <a class="text-white fw-600 collapsed">Contact Information</a>
                                    </div>
                                    <div id="collapseThree"
                                        class="collapse"
                                        data-parent=".accordionExample">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="cell_phone">
                                                                Cell Phone
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="tel"
                                                                class="form-control"
                                                                value="{{ isset($personal_info->cell_phone) && $personal_info->cell_phone != null  ? $personal_info->cell_phone : '' }}"
                                                                id="cell_phone" name="cell_phone"
                                                                placeholder="Enter cell phone">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="email">
                                                                Email
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="email"
                                                                class="form-control"
                                                                value="{{ isset($personal_info->email) && $personal_info->email != null ? $personal_info->email : '' }}"
                                                                id="email" name="email" placeholder="Enter Email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 position-relative">
                                                    <label class="form-label" for="social_links">
                                                        Social Links 
                                                    </label>
                                                    <div class="social_link_div">
                                                        @if (!empty($personal_info->social_links))
                                                            @foreach ($personal_info->social_links as $index => $social_link)
                                                                <div class="row p-0 mt-3 {{ $loop->last ? '' : 'remove_links' }}">
                                                                    <div class="col-lg-11">
                                                                        <input type="text" class="form-control social_links"
                                                                            name="social_links[{{ $index }}][link]"
                                                                            value="{{ $social_link['link'] }}"
                                                                            placeholder="Enter Social links" autocomplete="__away">
                                                                    </div>
                                                                    <div class="col-lg-1">
                                                                        <a href="javascript:void(0)" class="add-btn">
                                                                            <i onclick="{{ $loop->last ? 'addLinks(this)' : 'removeLinks(this)' }}" data-count="{{ count($personal_info->social_links) != 0 ? count($personal_info->social_links) - 1 : 0 }}" class="fa-solid {{ $loop->last ? 'fa-plus' : 'fa-minus' }}"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="row p-0 mt-3">
                                                                <div class="col-lg-11">
                                                                    <input type="text" class="form-control social_links"
                                                                        name="social_links[0][link]"
                                                                        placeholder="Enter Social links">
                                                                </div>
                                                                <div class="col-lg-1">
                                                                    <a href="javascript:void(0)" class="add-btn">
                                                                        <i onclick="addLinks(this)" data-count="0" class="fa-solid fa-plus"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="parent_email_one">
                                                                Parent Email 1
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="email"
                                                                class="form-control"
                                                                value="{{ isset($personal_info->parent_email_one) && $personal_info->parent_email_one != null ? $personal_info->parent_email_one : '' }}"
                                                                id="parent_email_one" name="parent_email_one"
                                                                placeholder="This will not show up on your Resume.">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="parent_email_two">
                                                                Parent Email 2
                                                            </label>
                                                            <input type="email" class="form-control"
                                                                value="{{ isset($personal_info->parent_email_two) && $personal_info->parent_email_two != null ? $personal_info->parent_email_two : '' }}"
                                                                id="parent_email_two" name="parent_email_two" placeholder="This will not show up on your Resume.">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <div></div>
                                    @include('user.admin-dashboard.high-school-resume.components.return-homepage-btn')
                                    <div class="next-btn d-flex">
                                        @if (!isset($resume_id))
                                            <div>
                                                @include('components.reset-all-drafts-button')
                                            </div>
                                        @endif
                                        <div class="next-btn">
                                            <input type="submit" class="btn btn-alt-success next-step" value="Next Step"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="redirect_link" name="redirect_link" value="">
                </form>
            </div>
        </div>
    </main>
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
    <style>
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
    <script>One.helpersOnLoad(['jq-select2']);</script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
    <script src="{{ asset('js/high-school-resume.js') }}"></script>
    {{-- <script src="{{ asset('js/no-browser-back.js') }}"></script> --}}
    <script>

        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].setAttribute("autocomplete", "__away");
        }
        
        function errorMsgOld()
        {
            Swal.fire({
                title: 'Complete Current Step',
                text: "You Have to submit current form",
                icon: 'warning',
                confirmButtonColor: '#F27474',
                confirmButtonText: 'Okay'
            }).then((result) => {
                // window.location.href = "{{ route('admin-dashboard.highSchoolResume.personalInfo') }}";
                var form = $('#personal_info_form');
                if (form.valid()) {
                    // form.submit();
                }
            });
        }

        function errorMsg()
        {
            var form = $('#personal_info_form');
            if (form.valid()) {
                form.submit();
            }
        }

        function redirectFunction(link)
        {
            if (link.trim() !== '') {
                var form = $('#personal_info_form');
                if (form.valid()) {
                    $('#redirect_link').val(link);
                    form.submit();
                }
            }
        }

        function submitFormAndRedirect(url) {
            alert('asd');
            document.getElementById('personal_info_form').submit();
            window.location.href = url;
        }

        const cell_phone = document.getElementById("cell_phone");

        function autoFormatPhoneNumber(phoneNumberString) {
            try {
                var cleaned = ("" + phoneNumberString).replace(/\D/g, "");
                var match = cleaned.match(/^(1|)?(\d{0,3})?(\d{0,3})?(\d{0,4})?$/);
                var intlCode = match[1] ? "+1 " : "";
                return [
                    intlCode,
                    match[2] ? "(" : "",
                    match[2],
                    match[3] ? ") " : "",
                    match[3],
                    match[4] ? "-" : "",
                    match[4],
                ].join("");
            } catch (err) {
                return phoneNumberString;
            }
        }

        cell_phone.oninput = (e) => {
            e.target.value = autoFormatPhoneNumber(e.target.value);
        };

        $(document).ready(function() {
            let validations_rules = @json($validations_rules);
            let validations_messages = @json($validations_messages);
            
            $("#personal_info_form").validate({
                rules: validations_rules,
                messages: validations_messages,
                ignore: false,
                submitHandler: function(form) {
                    form.submit();
                },
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error);
                    } else {
                        error.insertAfter(element);
                        element.parents().find('.collapse').addClass('show');
                    }
                },
                success: function(label,element) {
                    label.parent().removeClass('error');
                    label.remove(); 
                    $(element).parents('div.select2-container_main').find('.select2-selection--single').attr('style', 'border: 1px solid #198754 !important');
                }
            });

            // let social_links = $('input[name^="social_links"]');

            // social_links.filter('input[name$="[link]"]').each(function() {
            //     $(this).rules("add", {
            //         url: true,
            //         messages: {
            //             "url": "Social link must be a valid url"
            //         }
            //     });
            // });
			$('#state').on('change', function() {
			var state_id = this.value;	
			$("#city").html('');
			var personal_info_city = '';
			<?php
			// Check if $personal_info is not null
			if ($personal_info !== null) {
				echo "personal_info_city = '{$personal_info->city}';";
			}
			?>
			
			$.ajax({
				url:"/user/admin-dashboard/high-school-resume/get-cities-by-state/" + $(this).val(),
				type: "GET",
				success: (res) => {
				$.each(res.cities,function(key,value){
				var cityName = value.city_name.trim(); // Trim whitespace from the city name
				var selectedAttr = cityName === personal_info_city ? "selected" : "";
				var optionHtml = '<option value="' + value.id + '" ' + selectedAttr + '>' + cityName + '</option>';
				$("#city").append(optionHtml);
				});
					
			    }
			});
			 
			});
        });

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
            "extendedTimeOut": "10000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
@endsection