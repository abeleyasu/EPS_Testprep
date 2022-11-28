@extends('layouts.user')

@section('title', 'HSR | Features Attribute : CPS')

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
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.employmentCertification') }}"
                            id="step5-tab">
                            <i class="fa-solid fa-envelope d-none"></i>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <p>Employment & <br> Certifications</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link active" href="{{ route('admin-dashboard.highSchoolResume.featuresAttributes') }}"
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
                <form class="js-validation" action="" method="POST">
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content">
                            <div class="accordion accordionExample2">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <a class="text-white fw-600 collapsed"> Featured skills</a>
                                    </div>
                                    <div id="collapseOne"
                                        class="collapse {{ $errors->has('position') || $errors->has('interest') || $errors->has('grade') || $errors->has('location') || $errors->has('details') ? 'show' : '' }}"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td><label class="form-label" for="featured_skill">
                                                                    Featured skill
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('featured_skill') is-invalid @enderror"
                                                                    value="{{ old('featured_skill') }}" id="featured_skill1"
                                                                    name="job_title" placeholder="Enter Featured Skill">
                                                                @error('featured_skill')
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
                                                            <td><i class="fa-solid fa-pen me-2" data-bs-toggle="modal"
                                                                    data-bs-target="#features_skill_main"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mark</td>
                                                            <td><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
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
                                        <a class="text-white fw-600 collapsed"> Featured Award </a>
                                    </div>
                                    <div id="collapseTwo"
                                        class="collapse {{ $errors->has('position') || $errors->has('interest') || $errors->has('grade') || $errors->has('location') || $errors->has('details') ? 'show' : '' }}"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td><label class="form-label" for="featured_award">
                                                                    Featured Award
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('featured_award') is-invalid @enderror"
                                                                    value="{{ old('featured_award') }}"
                                                                    id="featured_award" name="featured_award"
                                                                    placeholder="Enter Featured Award">
                                                                @error('featured_skill')
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
                                                            <td><i class="fa-solid fa-pen me-2" data-bs-toggle="modal"
                                                                    data-bs-target="#featured_award_main"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mark</td>
                                                            <td><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
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
                                        data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        <a class="text-white fw-600 collapsed"> Featured Languages </a>
                                    </div>
                                    <div id="collapseThree"
                                        class="collapse {{ $errors->has('position') || $errors->has('interest') || $errors->has('grade') || $errors->has('location') || $errors->has('details') ? 'show' : '' }}"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td><label class="form-label" for="featured_language">
                                                                    Language
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('featured_language') is-invalid @enderror"
                                                                    value="{{ old('featured_language') }}"
                                                                    id="featured_language" name="featured_language"
                                                                    placeholder="Enter Language">
                                                                @error('featured_language')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td><label class="form-label" for="languages_level">
                                                                    Languages level
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('languages_level') is-invalid @enderror"
                                                                    value="{{ old('languages_level') }}"
                                                                    id="languages_level" name="languages_level"
                                                                    placeholder="Fluent">
                                                                @error('languages_level')
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
                                                            <td><i class="fa-solid fa-pen me-2" data-bs-toggle="modal"
                                                                    data-bs-target="#languages_level_main"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
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
                                    <a href="{{ route('admin-dashboard.highSchoolResume.employmentCertification') }}"
                                        class="btn btn-alt-primary next-step"> Prev
                                    </a>
                                </div>
                                <div class="next-btn">
                                    <a href="{{ route('admin-dashboard.highSchoolResume.preview') }}"
                                        class="btn btn-alt-primary next-step"> Next
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>


    <!-- Featured skills Modal -->
    <div class="modal" id="features_skill_main" tabindex="-1" role="dialog"
        aria-labelledby="modal-block-extra-large" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Featured skills</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <form>
                            <label class="form-label" for="featured_skill_modal">
                                Featured skill
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('featured_skill_modal') is-invalid @enderror"
                                value="{{ old('featured_skill_modal') }}" id="featured_skill_modal" name="job_title"
                                placeholder="Enter Featured Skill">
                            @error('featured_skill_modal')
                                <span class="invalid">{{ $message }}</span>
                            @enderror
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
    <!-- Featured skills Modal -->

    <!-- Featured Award Modal -->
    <div class="modal" id="featured_award_main" tabindex="-1" role="dialog"
        aria-labelledby="modal-block-extra-large" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Featured Award</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <form>
                            <label class="form-label" for="featured_award_modal">
                                Featured Award
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('featured_award_modal') is-invalid @enderror"
                                value="{{ old('featured_award_modal') }}" id="featured_award_modal"
                                name="featured_award_modal" placeholder="Enter Featured Award">
                            @error('featured_award_modal')
                                <span class="invalid">{{ $message }}</span>
                            @enderror
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
    <!-- Featured Award Modal -->

    <!-- Featured Languages Modal -->
    <div class="modal" id="languages_level_main" tabindex="-1" role="dialog"
        aria-labelledby="modal-block-extra-large" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Featured Languages</h3>
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
                                    <label class="form-label" for="featured_language_modal">
                                        Language
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control @error('featured_language_modal') is-invalid @enderror"
                                        value="{{ old('featured_language_modal') }}" id="featured_language_modal"
                                        name="featured_language_modal" placeholder="Enter Language">
                                    @error('featured_language_modal')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="languages_level_modal">
                                        Languages level
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control @error('languages_level_modal') is-invalid @enderror"
                                        value="{{ old('languages_level_modal') }}" id="languages_level_modal"
                                        name="languages_level_modal" placeholder="Fluent">
                                    @error('languages_level_modal')
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
    <!-- Featured Languages Modal -->
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
