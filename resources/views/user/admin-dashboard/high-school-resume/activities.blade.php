@extends('layouts.user')

@section('title', 'HSR | Activity : CPS')

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
        <div class="container activity-container">
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
                        <a class="nav-link " href="{{ route('admin-dashboard.highSchoolResume.honors') }}" id="step3-tab">
                            <i class="fa-solid fa-envelope d-none"></i>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <p>Honors </p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link active" href="{{ route('admin-dashboard.highSchoolResume.activities') }}"
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
                <form class="js-validation" action="{{ route('admin-dashboard.highSchoolResume.activities.store') }}" method="post">
                    @csrf
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content">
                            <div class="accordion accordionExample2">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <a class="text-white fw-600 collapsed"> Demonstrated interest in the area of your
                                            major</a>
                                    </div>
                                    <div id="collapseOne" class="collapse {{ $errors->has('position') || $errors->has('interest') || $errors->has('grade') || $errors->has('location') || $errors->has('details') ? 'show' : '' }}" aria-labelledby="headingOne"
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
                                                            <input type="text" class="form-control @error('position') is-invalid @enderror" value="{{ old('position') }}" id="position"
                                                                name="position" placeholder="Enter Position">
                                                            @error('position')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="interest">
                                                                Interest
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('interest') is-invalid @enderror" id="interest"
                                                                name="interest" value="{{ old('interest') }}" placeholder="Enter Interest">
                                                            @error('interest')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="grade">
                                                                Grade(s)
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="js-select2 select" id="grade" name="grade"
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
                                                            @error('grade')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="location">
                                                                Locations
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location"
                                                                name="location" value="{{ old('location') }}" placeholder="Enter Location">
                                                            @error('location')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="details">
                                                                Details
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <textarea class="form-control @error('details') is-invalid @enderror" id="details" name="details" rows="1" placeholder="Enter Details">{{ old('details') }}</textarea>
                                                            @error('details')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="action">Action</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="position-td">Mark</td>
                                                            <td class="honor-td">Mark</td>
                                                            <td class="location-td">Mark</td>
                                                            <td class="grade-td">Mark</td>
                                                            <td class="detail-td">Mark</td>
                                                            <td><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="position-td">Mark</td>
                                                            <td class="honor-td">Mark</td>
                                                            <td class="location-td">Mark</td>
                                                            <td class="grade-td">Mark</td>
                                                            <td class="detail-td">Mark</td>
                                                            <td><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="position-td">Mark</td>
                                                            <td class="honor-td">Mark</td>
                                                            <td class="location-td">Mark</td>
                                                            <td class="grade-td">Mark</td>
                                                            <td class="detail-td">Mark</td>
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
                                        <a class=" text-white fw-600 collapsed">Leadership</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse {{ $errors->has('status') || $errors->has('leadership_position') || $errors->has('organization') || $errors->has('leadership_location') || $errors->has('leadership_grade') ? 'show' : '' }}" aria-labelledby="headingOne"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="status">
                                                                Status
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('status') is-invalid @enderror" id="status"
                                                                name="status" value="{{ old('status') }}" placeholder="Enter Status">
                                                            @error('status')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="leadership_position">
                                                                Position
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('leadership_position') is-invalid @enderror" id="leadership_position"
                                                                name="leadership_position" placeholder="Enter Position">
                                                            @error('leadership_position')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="organization">
                                                                Organization
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('organization') is-invalid @enderror" id="organization"
                                                                name="organization" value="{{ old('organization') }}" placeholder="Enter Organization">
                                                            @error('organization')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="leadership_location">
                                                                Locations
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('leadership_location') is-invalid @enderror" id="leadership_location"
                                                                name="leadership_location" value="{{ old('leadership_location') }}" placeholder="Ex: DRHS">
                                                            @error('leadership_location')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="leadership_grade">
                                                                Grade(s)
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="js-select2 select select2min" id="leadership_grade"
                                                                name="leadership_grade" multiple="multiple">
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
                                                            @error('leadership_grade')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <div>
                                                            <label class="form-label" for="action">Action</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td>Mark</td>
                                                            <td class="text-end">Mark</td>
                                                            <td class="text-end"><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td class="text-end">Mark</td>
                                                            <td class="text-end"><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td>Mark</td>
                                                            <td class="text-end">Mark</td>
                                                            <td class="text-end"><i class="fa-solid fa-pen me-2"></i> <i
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
                                        <a class=" text-white fw-600 collapsed">Activities & Clubs</a>
                                    </div>
                                    <div id="collapseThree" class="collapse {{ $errors->has('activity_position') || $errors->has('activity') || $errors->has('activity_grade') || $errors->has('activity_location') || $errors->has('honor_award') ? 'show' : '' }}" aria-labelledby="collapseThree"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="activity_position">
                                                                Positions
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('activity_position') is-invalid @enderror" value="{{ old('activity_position') }}" id="activity_position"
                                                                name="activity_position" placeholder="Enter Position">
                                                            @error('activity_position')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="activity">
                                                                Activity
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('activity') is-invalid @enderror" id="activity"
                                                                name="activity" value="{{ old('activity') }}" placeholder="Enter Activity">
                                                            @error('activity')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="activity_grade">
                                                                Grade(s)
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="js-select2 select" id="activity_grade"
                                                                name="activity_grade" multiple="multiple">
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
                                                            @error('activity_grade')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="activity_location">
                                                                Locations
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('activity_location') is-invalid @enderror" id="activity_location"
                                                                name="activity_location" value="{{ old('activity_location') }}" placeholder="Ex: DRHS">
                                                            @error('activity_location')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="honor_award">
                                                                Honor/Award
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('honor_award') is-invalid @enderror" id="honor_award"
                                                                name="honor_award" value="{{ old('honor_award') }}" placeholder="Honor/Award">
                                                            @error('honor_award')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <div>
                                                            <label class="form-label" for="action">Action</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td class="text-end">Mark</td>
                                                            <td class="text-end">Mark</td>
                                                            <td class="text-end"><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td class="text-end">Mark</td>
                                                            <td class="text-end">Mark</td>
                                                            <td class="text-end"><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td class="text-end">Mark</td>
                                                            <td class="text-end">Mark</td>
                                                            <td class="text-end"><i class="fa-solid fa-pen me-2"></i> <i
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
                                        data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                        <a class=" text-white fw-600 collapsed">Athletics</a>
                                    </div>
                                    <div id="collapseFour" class="collapse {{ $errors->has('athletics_positions') || $errors->has('athletics_activity') || $errors->has('athletics_grade') || $errors->has('athletics_location') || $errors->has('athletics_honor') ? 'show' : '' }}" aria-labelledby="collapseFour"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="athletics_positions">
                                                                Positions
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('athletics_positions') is-invalid @enderror" id="athletics_positions"
                                                                name="athletics_positions" value="{{ old('athletics_positions') }}" placeholder="Enter Position">
                                                            @error('athletics_positions')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="athletics_activity">
                                                                Athletic Activity
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('athletics_activity') is-invalid @enderror" id="athletics_activity"
                                                                name="athletics_activity" value="{{ old('athletics_activity') }}" placeholder="Enter Activity">
                                                            @error('athletics_activity')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="athletics_grade">
                                                                Grade(s)
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="js-select2 select" id="athletics_grade"
                                                                name="athletics_grade" multiple="multiple">
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
                                                            @error('athletics_grade')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="athletics_location">
                                                                Locations
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('athletics_location') is-invalid @enderror" value="{{ old('athletics_location') }}" id="athletics_location"
                                                                name="athletics_location" placeholder="Ex: DRHS">
                                                            @error('athletics_location')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="athletics_honor">
                                                                Honor
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('athletics_honor') is-invalid @enderror" id="athletics_honor"
                                                                name="athletics_honor" value="{{ old('athletics_honor') }}" placeholder="Enter Honor">
                                                            @error('athletics_honor')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <div>
                                                            <label class="form-label" for="action">Action</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td class="text-end" >Mark</td>
                                                            <td class="text-end">Mark</td>
                                                            <td class="text-end"><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td class="text-end">Mark</td>
                                                            <td class="text-end">Mark</td>
                                                            <td class="text-end"><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td class="text-end">Mark</td>
                                                            <td class="text-end">Mark</td>
                                                            <td class="text-end"><i class="fa-solid fa-pen me-2"></i> <i
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
                                        data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                        <a class=" text-white fw-600 collapsed">Community service / Volunteerism</a>
                                    </div>
                                    <div id="collapseFive" class="collapse {{ $errors->has('participation_level') || $errors->has('community_service') || $errors->has('community_grade') || $errors->has('community_location') ? 'show' : '' }}" aria-labelledby="collapseFive"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="participation_level">
                                                                Participation level
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('participation_level') is-invalid @enderror" value="{{ old('participation_level') }}"
                                                                id="participation_level" name="participation_level"
                                                                placeholder="Enter Participation level">
                                                            @error('participation_level')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="community_service">
                                                                Service
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('community_service') is-invalid @enderror" id="community_service"
                                                                name="community_service" value="{{ old('community_service') }}" placeholder="Enter Service">
                                                            @error('community_service')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="community_grade">
                                                                Grade(s)
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="js-select2 select" id="community_grade"
                                                                name="community_grade" multiple="multiple">
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
                                                            @error('community_grade')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="community_location">
                                                                Locations
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('community_location') is-invalid @enderror" id="community_location"
                                                                name="community_location" placeholder="Enter Location">
                                                            @error('community_location')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <div>
                                                            <label class="form-label" for="action">Action</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="position-td">Mark</td>
                                                            <td class="honor-td">Mark</td>
                                                            <td class="location-td">Mark</td>
                                                            <td class="grade-td">Mark</td>
                                                            <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="position-td">Mark</td>
                                                            <td class="honor-td">Mark</td>
                                                            <td class="location-td">Mark</td>
                                                            <td class="grade-td">Mark</td>
                                                            <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="position-td">Mark</td>
                                                            <td class="honor-td">Mark</td>
                                                            <td class="location-td">Mark</td>
                                                            <td class="grade-td">Mark</td>
                                                            <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <div class="prev-btn">
                            <a href="{{ route('admin-dashboard.highSchoolResume.honors') }}"
                                class="btn btn-alt-primary next-step"> Prev
                            </a>
                        </div>
                        <div class="next-btn">
                            <div class="next-btn">
                                <input type="submit" class="btn btn-alt-primary next-step" value="Next">
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
