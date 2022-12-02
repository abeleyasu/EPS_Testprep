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
                            <p>1</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Personal Info</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="javascript:void(0)" id="step2-tab">
                            <p>2</p>
                            <i class="fa-solid fa-check  "></i>
                            <h6>Education</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="javascript:void(0)" id="step3-tab">
                            <p>3</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Honors</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="javascript:void(0)" id="step4-tab">
                            <p>4</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Activities</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="javascript:void(0)" id="step5-tab">
                            <p>5</p>
                            <i class="fa-solid fa-check"></i>
                            <h6>Employment & <br> Certifications</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="javascript:void(0)" id="step6-tab">
                            <p>6</p>
                            <i class="fa-solid fa-check"></i>
                            <h6>Featured <br> Attributes</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="javascript:void(0)" id="step7-tab">
                            <p>7</p>
                            <i class="fa-solid fa-check"></i>
                            <h6>Preview</h6>
                        </a>
                    </li>
                </ul>
                <form class="js-validation"
                    action="{{ isset($personal_info) ? route('admin-dashboard.highSchoolResume.personalInfo.update', $personal_info->id) : route('admin-dashboard.highSchoolResume.personalInfo.store') }}"
                    method="POST">
                    @csrf
                    @if (isset($personal_info))
                        @method('PUT')
                    @endif
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                            <div class="accordion accordionExample">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <a class=" text-white fw-600 collapsed">Personal info</a>
                                    </div>
                                    <div id="collapseOne"
                                        class="collapse {{ $errors->has('first_name') || $errors->has('middle_name') || $errors->has('last_name') ? 'show' : '' }}"
                                        aria-labelledby="headingOne" data-parent=".accordionExample">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label class="form-label" for="first_name">
                                                                First Name
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text"
                                                                class="form-control @error('first_name') is-invalid @enderror"
                                                                value="{{ isset($personal_info->first_name) ? $personal_info->first_name : old('first_name') }}"
                                                                id="first_name" name="first_name"
                                                                placeholder="Enter First Name">
                                                            @error('first_name')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label class="form-label" for="middle_name">
                                                                Middle Name
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text"
                                                                class="form-control @error('middle_name') is-invalid @enderror"
                                                                value="{{ isset($personal_info->middle_name) ? $personal_info->middle_name : old('middle_name') }}"
                                                                id="middle_name" name="middle_name"
                                                                placeholder="Enter Middle Name">
                                                            @error('middle_name')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="last_name">
                                                                Last Name
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text"
                                                                class="form-control @error('last_name') is-invalid @enderror"
                                                                value="{{ isset($personal_info->last_name) ? $personal_info->last_name : old('last_name') }}"
                                                                id="last_name" name="last_name"
                                                                placeholder="Enter Last Name">
                                                            @error('last_name')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
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
                                        class="collapse {{ $errors->has('street_address_one') || $errors->has('street_address_two') || $errors->has('city') || $errors->has('state') || $errors->has('zip_code') ? 'show' : '' }}"
                                        aria-labelledby="headingOne" data-parent=".accordionExample">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="street_address_one">
                                                                Street Address 1
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <textarea class="form-control @error('street_address_one') is-invalid @enderror" id="street_address_one"
                                                                name="street_address_one" placeholder="Enter Street Address 1">{{ isset($personal_info->street_address_one) ? $personal_info->street_address_one : old('street_address_one') }}</textarea>
                                                            @error('street_address_one')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label class="form-label" for="street_address_two">
                                                            Street Address 2
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <textarea class="form-control @error('street_address_two') is-invalid @enderror" id="street_address_two"
                                                            name="street_address_two" placeholder="Enter Street Address 2">{{ isset($personal_info->street_address_two) ? $personal_info->street_address_two : old('street_address_two') }}</textarea>
                                                        @error('street_address_two')
                                                            <span class="invalid">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label class="form-label" for="city">
                                                                City
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text"
                                                                class="form-control @error('city') is-invalid @enderror"
                                                                value="{{ isset($personal_info->city) ? $personal_info->city : old('city') }}"
                                                                id="city" name="city" placeholder="Enter city">
                                                            @error('city')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label class="form-label" for="state">
                                                                State
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text"
                                                                class="form-control @error('state') is-invalid @enderror"
                                                                value="{{ isset($personal_info->state) ? $personal_info->state : old('state') }}"
                                                                id="state" name="state" placeholder="Enter State">
                                                            @error('state')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label class="form-label" for="zip_code">
                                                                Zip Code
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="number"
                                                                class="form-control @error('zip_code') is-invalid @enderror"
                                                                value="{{ isset($personal_info->zip_code) ? $personal_info->zip_code : old('zip_code') }}"
                                                                id="zip_code" name="zip_code"
                                                                placeholder="Enter Zip Code">
                                                            @error('zip_code')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
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
                                    <div id="collapseThree"
                                        class="collapse {{ $errors->has('cell_phone') || $errors->has('email') || $errors->has('social_links') || $errors->has('parent_email_one') || $errors->has('parent_email_two') ? 'show' : '' }}"
                                        data-parent=".accordionExample">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="cell_phone">
                                                                Cell phone
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="tel"
                                                                class="form-control @error('cell_phone') is-invalid @enderror"
                                                                value="{{ isset($personal_info->cell_phone) ? $personal_info->cell_phone : old('cell_phone') }}"
                                                                id="cell_phone" name="cell_phone"
                                                                placeholder="Enter cell phone no">
                                                            @error('cell_phone')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="email">
                                                                Email
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                value="{{ isset($personal_info->email) ? $personal_info->email : old('email') }}"
                                                                id="email" name="email" placeholder="Enter Email">
                                                            @error('email')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 position-relative">
                                                    <label class="form-label" for="social_links">
                                                        Social links
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="social_link_div">
                                                        @if (!empty($personal_info->social_links))
                                                            @foreach ($personal_info->social_links as $key => $link)
                                                                <div
                                                                    class="row p-0 mt-3 {{ $key == 0 ? '' : 'remove_links' }}">
                                                                    <div class="col-lg-11">
                                                                        <input type="text" class="form-control"
                                                                            name="social_links[]"
                                                                            value="{{ $link }}"
                                                                            placeholder="Enter Social links">
                                                                    </div>
                                                                    <div class="col-lg-1">
                                                                        <a href="javascript:void(0)" class="add-btn"
                                                                            onclick="{{ $key == 0 ? 'addLinks(this)' : 'removeLinks(this)' }}">
                                                                            <i
                                                                                class="fa-solid {{ $key == 0 ? 'fa-plus' : 'fa-minus' }}"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="row p-0 mt-3">
                                                                <div class="col-lg-11">
                                                                    <input type="text" class="form-control"
                                                                        name="social_links[]"
                                                                        placeholder="Enter Social links">
                                                                </div>
                                                                <div class="col-lg-1">
                                                                    <a href="javascript:void(0)" class="add-btn"
                                                                        onclick="addLinks(this)">
                                                                        <i class="fa-solid fa-plus"></i>
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
                                                                class="form-control @error('parent_email_one') is-invalid @enderror"
                                                                value="{{ isset($personal_info->parent_email_one) ? $personal_info->parent_email_one : old('parent_email_one') }}"
                                                                id="parent_email_one" name="parent_email_one"
                                                                placeholder="Enter Parent Email 1">
                                                            @error('parent_email_one')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="parent_email_two">
                                                                Parent Email 2
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="email"
                                                                class="form-control @error('parent_email_two') is-invalid @enderror"
                                                                value="{{ isset($personal_info->parent_email_two) ? $personal_info->parent_email_two : old('parent_email_two') }}"
                                                                id="parent_email_two" name="parent_email_two"
                                                                placeholder="Enter Parent Email 2">
                                                            @error('parent_email_two')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <div class="next-btn">
                                        <input type="submit" class="btn  btn-alt-success next-step" value="Next Step">
                                        <div class="eye-module">
                                            <i class="fa-solid fa-eye btn-alt-success opacity-50"></i>
                                        </div>
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
    <link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}">
@endsection

@section('user-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/high-school-resume.js') }}"></script>
@endsection
