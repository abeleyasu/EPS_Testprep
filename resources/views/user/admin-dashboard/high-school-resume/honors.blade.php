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
                        <a class="nav-link active" href="{{ route('admin-dashboard.highSchoolResume.honors') }}"
                            id="step3-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Honors </p>
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
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.employmentCertification') }}"
                            id="step5-tab">
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
                <form class="js-validation" action="{{ route('admin-dashboard.highSchoolResume.honors.store') }}" method="POST">
                    @csrf
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content">
                            <div class="accordion accordionExample2">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <a class=" text-white fw-600 collapsed"> Academic Honors, Achievements & Other
                                            Awards</a>
                                    </div>
                                    <div id="collapseOne" class="collapse {{ $errors->has('position') || $errors->has('honor_achievement_award') || $errors->has('grade') || $errors->has('location') ? 'show' : '' }}" aria-labelledby="headingOne"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="position">
                                                                Position
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="number" class="form-control @error('position') is-invalid @enderror" id="position"
                                                                name="position" value="{{ old('position') }}" placeholder="Enter Position">
                                                            @error('position')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="honor_achievement_award">
                                                                Honor / Achievement / Award
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('honor_achievement_award') is-invalid @enderror" id="honor_achievement_award"
                                                                name="honor_achievement_award" value="{{ old('honor_achievement_award') }}" placeholder="Ex: National Honor Society">
                                                            @error('honor_achievement_award')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="grade">
                                                                Grade(s)
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="js-select2 select" id="grade"
                                                                name="grade" multiple="multiple">
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
                                                            @error('grade')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="location">
                                                                Location
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" id="location"
                                                                name="location" placeholder="Ex: DRHS">
                                                            @error('location')
                                                            <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="action">Action</label>
                                                        </div>
                                                    </div>
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="position-td">Mark</td>
                                                                <td class="honor-td">Mark</td>
                                                                <td class="location-td">Mark</td>
                                                                <td>Mark</td>
                                                                <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i
                                                                        class="fa-solid fa-circle-xmark"></i></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="position-td">Mark</td>
                                                                <td class="honor-td">Mark</td>
                                                                <td class="location-td">Mark</td>
                                                                <td>Mark</td>
                                                                <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i
                                                                        class="fa-solid fa-circle-xmark"></i></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="position-td">Mark</td>
                                                                <td class="honor-td">Mark</td>
                                                                <td class="location-td">Mark</td>
                                                                <td>Mark</td>
                                                                <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i
                                                                        class="fa-solid fa-circle-xmark"></i></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <div class="prev-btn">
                                    <a href="{{ route('admin-dashboard.highSchoolResume.educationInfo') }}"
                                        class="btn btn-alt-primary next-step"> Prev
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
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}">
    <style>
        .select2-container .select2-selection--multiple {
            min-width: 19vw !important;
        }
    </style>
@endsection

@section('user-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/high-school-resume.js') }}"></script>
@endsection
