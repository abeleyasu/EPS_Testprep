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
        <div class="container">
            <div class="custom-tab-container">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li role="presentation">
                        <a class="nav-link active" href="{{ route('admin-dashboard.highSchoolResume.personalInfo') }}"
                            id="step1-tab">
                            <i class="fa-solid fa-envelope"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Personal Info</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.educationInfo') }}"
                            id="step2-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Education</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.honors') }}" id="step3-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Honors</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.activities') }}"
                            id="step4-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Activities</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.employementCertified') }}"
                            id="step5-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check"></i>
                            <p>Employment & <br> Certifications</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.featuresAttributes') }}"
                            id="step6-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check"></i>
                            <p>Featured <br> Attributes</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.preview') }}" id="step7-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check"></i>
                            <p>Preview</p>
                        </a>
                    </li>
                </ul>
                <form class="js-validation" action="{{ route('admin-dashboard.highSchoolResume.personalInfo.store') }}"
                    method="POST">
                    @csrf
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                            <div class="accordion accordionExample">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <a class=" text-white fw-600 collapsed">Personal info</a>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                        data-parent=".accordionExample">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="mb-4">
                                                    <label class="form-label" for="first_name">
                                                        First Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                        class="form-control @error('first_name') is-invalid @enderror"
                                                        value="{{ old('first_name') }}" id="first_name" name="first_name"
                                                        placeholder="Enter First Name">
                                                    @error('first_name')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="middle_name">
                                                        Middle Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                        class="form-control @error('middle_name') is-invalid @enderror"
                                                        value="{{ old('middle_name') }}" id="middle_name"
                                                        name="middle_name" placeholder="Enter Middle Name">
                                                    @error('middle_name')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="last_name">
                                                        Last Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                        class="form-control @error('last_name') is-invalid @enderror"
                                                        value="{{ old('last_name') }}" id="last_name" name="last_name"
                                                        placeholder="Enter Last Name">
                                                    @error('last_name')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
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
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingOne"
                                        data-parent=".accordionExample">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="mb-4">
                                                    <label class="form-label" for="street_address_one">
                                                        Street Address 1
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                        class="form-control @error('street_address_one') is-invalid @enderror"
                                                        value="{{ old('street_address_one') }}" id="street_address_one"
                                                        name="street_address_one" placeholder="Enter Street Address 1">
                                                    @error('street_address_one')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="street_address_two">
                                                        Street Address 2
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                        class="form-control @error('street_address_two') is-invalid @enderror"
                                                        value="{{ old('street_address_two') }}" id="street_address_two"
                                                        name="street_address_two" placeholder="Enter Street Address 2">
                                                    @error('street_address_one')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="city">
                                                        City
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                        class="form-control @error('city') is-invalid @enderror"
                                                        value="{{ old('city') }}" id="city" name="city"
                                                        placeholder="Enter city">
                                                    @error('city')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="state">
                                                        State
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                        class="form-control @error('state') is-invalid @enderror"
                                                        value="{{ old('state') }}" id="state" name="state"
                                                        placeholder="Enter State">
                                                    @error('state')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="zip_code">
                                                        Zip Code
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="number"
                                                        class="form-control @error('zip_code') is-invalid @enderror"
                                                        value="{{ old('zip_code') }}" id="zip_code" name="zip_code"
                                                        placeholder="Enter Zip Code">
                                                    @error('zip_code')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        <a class="text-white fw-600 collapsed">Contact information</a>
                                    </div>
                                    <div id="collapseThree" class="collapse" data-parent=".accordionExample">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="mb-4">
                                                    <label class="form-label" for="cell_phone">
                                                        Cell phone
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="tel"
                                                        class="form-control @error('cell_phone') is-invalid @enderror"
                                                        value="{{ old('cell_phone') }}" id="cell_phone"
                                                        name="cell_phone" placeholder="Enter cell phone no">
                                                    @error('cell_phone')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="email">
                                                        Email
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        value="{{ old('email') }}" id="email" name="email"
                                                        placeholder="Enter Email">
                                                    @error('email')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-4 position-relative">
                                                    <label class="form-label" for="social_links">
                                                        Social links
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                        class="form-control @error('social_links') is-invalid @enderror"
                                                        value="{{ old('social_links') }}" id="social_links"
                                                        name="social_links" placeholder="Enter Social links">
                                                    <div class="addbutton">
                                                        <a href="#" class="add-btn">
                                                            <i class="fa-solid fa-plus"></i>
                                                        </a>
                                                    </div>
                                                    @error('social_links')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="parent_email_one">
                                                        Parent Email 1
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="email"
                                                        class="form-control @error('parent_email_one') is-invalid @enderror"
                                                        value="{{ old('parent_email_one') }}" id="parent_email_one"
                                                        name="parent_email_one" placeholder="Enter Parent Email 1">
                                                    @error('parent_email_one')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="parent_email_two">
                                                        Parent Email 2
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="email"
                                                        class="form-control @error('parent_email_two') is-invalid @enderror"
                                                        value="{{ old('parent_email_two') }}" id="parent_email_two"
                                                        name="parent_email_two" placeholder="Enter Parent Email 2">
                                                    @error('parent_email_two')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <div class="next-btn">
                                        <input type="submit" class="btn btn-alt-primary next-step" value="Next">
                                    </div>
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
    <style>
        .main-tab-container {
            padding: 40px 30px;
        }

        ul,
        li {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .custom-tab-container {
            padding: 50px 0;
        }

        .custom-tab-container ul li:focus-visible,
        .nav-link:focus-visible {
            outline: 0 !important;
        }

        .invalid {
            width: 100%;
            margin-top: 0.375rem;
            font-size: .875rem;
            color: #dc2626;
        }

        .is-invalid {
            border-color: #dc2626
        }

        .valid {
            border: 1px solid green;
            position: relative;
        }

        .custom-drodown-course {
            width: 100%;
            border: 1px solid #dfe3ea;
            border-radius: 5px;
            display: none
        }

        .fa-pen {
            color: #1f2937;
            font-size: 16px;
            cursor: pointer;
        }

        .fa-circle-xmark {
            color: #ff3b3b;
            font-size: 16px;
            cursor: pointer;
        }

        table,
        th,
        td {
            border: none;
        }

        .custom-drodown-course ul {
            display: unset !important;
            justify-content: unset !important;
        }

        .custom-drodown-course ul li {
            margin-right: unset !important;
            text-align: unset !important;
            display: block !important;
            cursor: unset !important;
        }

        .custom-drodown-course ul li a {
            color: #1f2937;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
            width: 100%;
            display: inline-block;
            padding: 10px
        }

        .custom-drodown-course ul li a:hover {
            background: #1f2937;
            color: #fff
        }

        .nav-link {
            background: transparent !important;
        }


        .select2-container .select2-selection--multiple {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            min-height: 33px;
            user-select: none;
            -webkit-user-select: none;
            min-width: 77.8vw !important;
        }

        .custom-tab-container ul li i {
            width: 50px;
            height: 50px;
            font-size: 22px;
            background-color: #a8a8a8;
            text-align: center;
            border-radius: 50%;
            line-height: 50px;
            margin-bottom: 20px;
            color: #fff;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid #dfe3ea !important;

        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #232d3a;
            position: absolute;
            top: -2px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
            color: #1f2937 !important;
        }

        .fa-check {
            display: none;
        }

        .custom-tab-container ul li a.active i {
            background-color: #1f2937;
            color: #fff;
        }

        .custom-tab-container ul li a {
            color: #1f2937;
        }

        .custom-tab-container ul li {
            margin-right: 50px;
            text-align: center;
            display: inline-block;
            cursor: pointer;
        }

        .nav-link {
            font-size: 16px !important;
            font-weight: 600;
            text-transform: uppercase;
            margin: 0;
            color: #545454 !important;
            padding: 0 !important;
            border: unset !important;
        }

        .custom-tab-container ul {
            display: flex;
            justify-content: center;
            margin-bottom: 35px;
        }

        .nav-tabs {
            border: 0;
        }

        p {
            margin-bottom: 0;
        }

        .block-header-tab {
            background-color: #1f2937;
            text-align: center;
            justify-content: center;
            cursor: pointer;
        }

        .custom-tab-main {
            padding: 20px 0;
        }

        .add-btn i {
            width: 30px;
            height: 30px;
            background-color: #1f2937;
            color: #fff;
            text-align: center;
            border-radius: 50%;
            line-height: 31px;
            font-size: 16px;
        }

        .addbutton {
            position: absolute;
            top: 34px;
            right: 8px;
        }

        .td-width {
            width: 67%;
            margin-left: 16px;
            display: inline-block;
        }
    </style>
@endsection

@section('user-script')
    <script src="{{ asset('assets/js/boostrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(() => {
            $(".select").select2({
                tags: true
            })

            $(".form-drop").click(function() {
                $(".custom-drodown-course").toggle();
            });
        });
    </script>
@endsection
