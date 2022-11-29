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
        <div class="container">
            <div class="custom-tab-container ">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.personalInfo') }}"
                            id="step1-tab">
                            <i class="fa-solid fa-envelope d-none"></i>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <p>Personal Info</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{ route('admin-dashboard.highSchoolResume.educationInfo') }}"
                            id="step2-tab">
                            <i class="fa-solid fa-envelope d-none"></i>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <p>Education </p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{ route('admin-dashboard.highSchoolResume.honors') }}" id="step3-tab">
                            <i class="fa-solid fa-envelope d-none"></i>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <p>Honors </p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{ route('admin-dashboard.highSchoolResume.activities') }}"
                            id="step4-tab">
                            <i class="fa-solid fa-envelope d-none"></i>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <p>Activities</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link active"
                            href="{{ route('admin-dashboard.highSchoolResume.employmentCertification') }}" id="step5-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Employment & <br> Certifications</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.featuresAttributes') }}"
                            id="step6-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Featured <br> Attributes</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.preview') }}" id="step7-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Preview</p>
                        </a>
                    </li>
                </ul>
                <form class="js-validation" action="{{ route('admin-dashboard.highSchoolResume.employmentCertification.store') }}" method="POST">
                    @csrf
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content">
                            <div class="accordion accordionExample2">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <a class="text-white fw-600 collapsed"> Employment & Certifications</a>
                                    </div>
                                    <div id="collapseOne"
                                        class="collapse {{ $errors->has('job_title') || $errors->has('employment_grade') || $errors->has('employment_location') || $errors->has('employment_honor_award') ? 'show' : '' }}"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <label class="form-label" for="employment_job_title">
                                                                    Job title
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('employment_job_title') is-invalid @enderror"
                                                                    value="{{ old('employment_job_title') }}" id="employment_job_title"
                                                                    name="employment_job_title" placeholder="Enter Job title">
                                                                @error('employment_job_title')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="employment_grade">
                                                                    Grade(s)
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <select class="js-select2 select" id="employment_grade"
                                                                    name="employment_grade" multiple="multiple">
                                                                    <option value="1st grade">1st grade</option>
                                                                    <option value="2st grade">2st grade</option>
                                                                    <option value="3st grade">3st grade</option>
                                                                    <option value="4st grade">4st grade</option>
                                                                    <option value="5st grade">5st grade</option>
                                                                    <option value="6st grade">6st grade</option>
                                                                    <option value="7st grade">7st grade</option>
                                                                    <option value="8st grade">8st grade</option>
                                                                    <option value="9st grade">9st grade</option>
                                                                </select>
                                                                @error('employment_grade')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="employment_location">
                                                                    Location
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('employment_location') is-invalid @enderror"
                                                                    id="employment_location" name="employment_location"
                                                                    value="{{ old('employment_location') }}"
                                                                    placeholder="Enter Location">
                                                                @error('employment_location')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="employment_honor_award">
                                                                    Honor / Award
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('employment_honor_award') is-invalid @enderror"
                                                                    id="employment_honor_award"
                                                                    name="employment_honor_award"
                                                                    value="{{ old('employment_honor_award') }}"
                                                                    placeholder="Enter Honor / Award">
                                                                @error('employment_honor_award')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                                <a href="javascript:void(0)" class="add-btn plus-icon">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td><i class="fa-solid fa-pen me-2" data-bs-toggle="modal"
                                                                    data-bs-target="#employment_certificate_modal"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        <a class="text-white fw-600 collapsed">Other Significant Responsibilities or
                                            interests</a>
                                    </div>
                                    <div id="collapseTwo"
                                        class="collapse {{ $errors->has('responsibility_interest') || $errors->has('responsibility_grade') || $errors->has('responsibility_location') || $errors->has('responsibility_honor_award') ? 'show' : '' }}"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <label class="form-label"
                                                                    for="responsibility_interest">
                                                                    Responsibility or interest
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('responsibility_interest') is-invalid @enderror"
                                                                    value="{{ old('responsibility_interest') }}"
                                                                    id="responsibility_interest"
                                                                    name="responsibility_interest"
                                                                    placeholder="Enter Responsibility or interest">
                                                                @error('responsibility_interest')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <label class="form-label"
                                                                    for="responsibility_grade">
                                                                    Grade(s)
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <select class="js-select2 select"
                                                                    id="responsibility_grade"
                                                                    name="responsibility_grade"
                                                                    multiple="multiple">
                                                                    <option value="1st grade">1st grade</option>
                                                                    <option value="2st grade">2st grade</option>
                                                                    <option value="3st grade">3st grade</option>
                                                                    <option value="4st grade">4st grade</option>
                                                                    <option value="5st grade">5st grade</option>
                                                                    <option value="6st grade">6st grade</option>
                                                                    <option value="7st grade">7st grade</option>
                                                                    <option value="8st grade">8st grade</option>
                                                                    <option value="9st grade">9st grade</option>
                                                                </select>
                                                                @error('responsibility_grade')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <label class="form-label"
                                                                    for="responsibility_location">
                                                                    Location
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('responsibility_location') is-invalid @enderror"
                                                                    id="responsibility_location"
                                                                    name="responsibility_location"
                                                                    value="{{ old('responsibility_location') }}"
                                                                    placeholder="Enter Location">
                                                                @error('responsibility_location')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="responsibility_honor_award">
                                                                    Honor / Award
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('responsibility_honor_award') is-invalid @enderror"
                                                                    value="{{ old('responsibility_honor_award') }}"
                                                                    id="responsibility_honor_award"
                                                                    name="responsibility_honor_award"
                                                                    placeholder="Enter Honor / Award">
                                                                @error('responsibility_honor_award')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                                <a href="javascript:void(0)" class="add-btn plus-icon">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td><i class="fa-solid fa-pen me-2" data-bs-toggle="modal"
                                                                    data-bs-target="#responsibility_modal"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <div class="prev-btn">
                                    <a href="{{ route('admin-dashboard.highSchoolResume.activities') }}"
                                        class="btn btn-alt-primary next-step"> Previous
                                    </a>
                                </div>
                                <div class="next-btn">
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

    <!-- Employment & Certifications Modal -->
        <div class="modal" id="employment_certificate_modal" tabindex="-1" role="dialog"
            aria-labelledby="modal-block-extra-large" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-transparent mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Employment & Certifications</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content fs-sm">
                            <form>
                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <label class="form-label" for="employment_modal_job_title">
                                            Job title
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('employment_modal_job_title') is-invalid @enderror"
                                            value="{{ old('employment_modal_job_title') }}" id="employment_modal_job_title" name="employment_modal_job_title"
                                            placeholder="Enter Job title">
                                        @error('employment_modal_job_title')
                                            <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label" for="employment_modal_grade">
                                            Grade(s)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="js-select2 select" id="employment_modal_grade"
                                            name="employment_modal_grade" multiple="multiple">
                                            <option value="1st grade">1st grade</option>
                                            <option value="2st grade">2st grade</option>
                                            <option value="3st grade">3st grade</option>
                                            <option value="4st grade">4st grade</option>
                                            <option value="5st grade">5st grade</option>
                                            <option value="6st grade">6st grade</option>
                                            <option value="7st grade">7st grade</option>
                                            <option value="8st grade">8st grade</option>
                                            <option value="9st grade">9st grade</option>
                                        </select>
                                        @error('employment_modal_grade')
                                            <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <label class="form-label" for="employment_modal_location">
                                            Location
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control @error('employment_modal_location') is-invalid @enderror"
                                            id="employment_modal_location" name="employment_modal_location"
                                            value="{{ old('employment_modal_location') }}" placeholder="Enter Location">
                                        @error('employment_modal_location')
                                            <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label" for="employment_modal_honor_award">
                                            Honor / Award
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control @error('employment_modal_honor_award') is-invalid @enderror"
                                            id="employment_modal_honor_award" name="employment_modal_honor_award"
                                            value="{{ old('employment_modal_honor_award') }}" placeholder="Enter Honor / Award">
                                        @error('employment_modal_honor_award')
                                            <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="block-content block-content-full text-end">
                            <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn submit-btn" data-bs-dismiss="modal">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Employment & Certifications Modal -->

    <!-- Other Significant Responsibilities or interests Modal -->
        <div class="modal" id="responsibility_modal" tabindex="-1" role="dialog"
            aria-labelledby="modal-block-extra-large" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-transparent mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Other Significant Responsibilities or interests</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content fs-sm">
                            <form>
                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <label class="form-label" for="responsibility_interest_modal">
                                            Responsibility or interest
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control @error('responsibility_interest_modal') is-invalid @enderror"
                                            value="{{ old('responsibility_interest_modal') }}"
                                            id="responsibility_interest_modal" name="responsibility_interest_modal"
                                            placeholder="Enter Responsibility or interest">
                                        @error('responsibility_interest_modal')
                                            <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label" for="responsibility_modal_grade">
                                            Grade(s)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="js-select2 select" id="responsibility_modal_grade"
                                            name="responsibility_modal_grade" multiple="multiple">
                                            <option value="1st grade">1st grade</option>
                                            <option value="2st grade">2st grade</option>
                                            <option value="3st grade">3st grade</option>
                                            <option value="4st grade">4st grade</option>
                                            <option value="5st grade">5st grade</option>
                                            <option value="6st grade">6st grade</option>
                                            <option value="7st grade">7st grade</option>
                                            <option value="8st grade">8st grade</option>
                                            <option value="9st grade">9st grade</option>
                                        </select>
                                        @error('responsibility_modal_grade')
                                            <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <label class="form-label" for="responsibility_modal_location">
                                            Location
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control @error('responsibility_modal_location') is-invalid @enderror"
                                            id="responsibility_modal_location"
                                            name="responsibility_modal_location"
                                            value="{{ old('responsibility_modal_location') }}"
                                            placeholder="Enter Location">
                                        @error('responsibility_modal_location')
                                            <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label" for="responsibility_modal_honor_award">
                                            Honor / Award
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control @error('responsibility_modal_honor_award') is-invalid @enderror" id="responsibility_modal_honor_award" name="responsibility_modal_honor_award"
                                            value="{{ old('responsibility_modal_honor_award') }}" placeholder="Enter Additional details"></textarea>
                                        @error('responsibility_modal_honor_award')
                                            <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="block-content block-content-full text-end">
                            <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn submit-btn" data-bs-dismiss="modal">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Other Significant Responsibilities or interests Modal -->
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}">
    <style>
        .select2-container .select2-selection--multiple {
            min-width: 13vw !important;
        }
    </style>
@endsection

@section('user-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/high-school-resume.js') }}"></script>
@endsection
