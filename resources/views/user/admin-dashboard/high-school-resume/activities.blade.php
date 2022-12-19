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
                            <p class="d-none">1</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Personal Info</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{ route('admin-dashboard.highSchoolResume.educationInfo') }}"
                            id="step2-tab">
                            <p class="d-none">2</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Education </h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{ route('admin-dashboard.highSchoolResume.honors') }}" id="step3-tab">
                            <p class="d-none">3</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Honors </h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link active" href="{{ route('admin-dashboard.highSchoolResume.activities') }}"
                            id="step4-tab">
                            <p>4</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Activities</h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($activity) ? "errorMsg(); return false;" : "javascript:void(0)" }}">
                        <a class="nav-link" href="{{ isset($activity) ? route('admin-dashboard.highSchoolResume.employmentCertification') : ''}}"
                            id="step5-tab">
                            <p>5</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Employment & <br> Certifications</h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($activity) ? "errorMsg(); return false;" : "javascript:void(0)" }}">
                        <a class="nav-link" href="{{ isset($featuredAttribute) ? route('admin-dashboard.highSchoolResume.featuresAttributes') : ''}}"
                            id="step6-tab">
                            <p>6</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Featured <br> Attributes</h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($activity) ? "errorMsg(); return false;" : "javascript:void(0)" }}">
                        <a class="nav-link" href="{{ isset($featuredAttribute) ? route('admin-dashboard.highSchoolResume.preview') : ''}}" id="step7-tab">
                            <p >7</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Preview</h6>
                        </a>
                    </li>
                </ul>
               
                <form class="js-validation" action="{{ isset($activity) ? route('admin-dashboard.highSchoolResume.activities.update', $activity->id) : route('admin-dashboard.highSchoolResume.activities.store') }}"
                    method="post">
                    @csrf
                    @if(isset($activity))
                        @method('PUT')
                    @endif
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content">
                            <div class="accordion accordionExample2">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <a class="text-white fw-600 collapsed"> Demonstrated interest in the area of your
                                            major</a>
                                    </div>
                                    <div id="collapseOne"
                                        class="collapse show"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table">
                                                    <tbody>
                                                        <tr class="demonstrated_data_table_row">
                                                            <input type="hidden" name="demonstrated_data" id="demonstrated_data" value="{{ !empty($activity->demonstrated_data) ? $activity->demonstrated_data : old('demonstrated_data') }}">
                                                            <td>
                                                                <label class="form-label" for="position">
                                                                    Position
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('demonstrated_data') is-invalid @enderror"
                                                                    value="{{ old('position') }}" id="position"
                                                                    name="position" placeholder="Enter Position" autocomplete="off">
                                                            </td>
                                                            <td> 
                                                                <label class="form-label" for="interest">
                                                                    Interest
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('demonstrated_data') is-invalid @enderror"
                                                                    id="interest" name="interest"
                                                                    value="{{ old('interest') }}"
                                                                    placeholder="Enter Interest">
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="grade">
                                                                    Grade(s)
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <select class="js-select2 select @error('demonstrated_data') is-invalid @enderror" id="grade"
                                                                    name="grade" multiple="multiple">
                                                                    <option {{ in_array("1st grade" ,is_array(old('demonstrated_data')) ? old('demonstrated_data') : []) ? 'selected' : '' }} value="1st grade">1st grade</option>
                                                                    <option {{ in_array("2st grade" ,is_array(old('demonstrated_data')) ? old('demonstrated_data') : []) ? 'selected' : '' }} value="2st grade">2st grade</option>
                                                                    <option {{ in_array("3st grade" ,is_array(old('demonstrated_data')) ? old('demonstrated_data') : []) ? 'selected' : '' }} value="3st grade">3st grade</option>
                                                                    <option {{ in_array("4st grade" ,is_array(old('demonstrated_data')) ? old('demonstrated_data') : []) ? 'selected' : '' }} value="4st grade">4st grade</option>
                                                                    <option {{ in_array("5st grade" ,is_array(old('demonstrated_data')) ? old('demonstrated_data') : []) ? 'selected' : '' }} value="5st grade">5st grade</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="location">
                                                                    Location
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('demonstrated_data') is-invalid @enderror"
                                                                    id="location" name="location"
                                                                    value="{{ old('location') }}"
                                                                    placeholder="Enter Location">
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="details">
                                                                    Details
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <textarea class="form-control @error('demonstrated_data') is-invalid @enderror" id="details" name="details" rows="1"
                                                                    placeholder="Enter Details">{{ old('details') }}</textarea>
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                                <a href="javascript:void(0)" onclick="addDemonstratedData(this)" class="add-btn plus-icon d-flex">
                                                                    <i class="fa-solid fa-plus @error('demonstrated_data') bg-danger @enderror"></i>
                                                                    @error('demonstrated_data')
                                                                        <span class="me-2 ms-2 invalid">Click on add icon to insert demonstrated data</span>
                                                                    @enderror
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($activity->demonstrated_data) || !empty(old('demonstrated_data')))
                                                            @php
                                                                $demonstrated_data = !empty($activity->demonstrated_data) ? $activity->demonstrated_data : old('demonstrated_data');
                                                            @endphp
                                                            @foreach(json_decode($demonstrated_data) as $demonstrated_data)
                                                                <tr id="demonstrated_{{ $demonstrated_data->id }}">
                                                                    <td class="position">{{ $demonstrated_data->position }}</td>
                                                                    <td class="interest">{{ $demonstrated_data->interest }}</td>
                                                                    <td class="grade">{{ implode(", ",json_decode($demonstrated_data->grade)) }}</td>
                                                                    <td class="location">{{ $demonstrated_data->location }}</td>
                                                                    <td class="details">{{ $demonstrated_data->details }}</td>
                                                                    <td>
                                                                        <i class="fa-solid fa-pen me-2" data-id="{{ $demonstrated_data->id }}" onclick="demonstrated_edit_model(this)"></i>
                                                                        <i class="fa-solid fa-circle-xmark" data-id="{{ $demonstrated_data->id }}" onclick="demonstrated_model_remove(this)"></i>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
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
                                        <a class=" text-white fw-600 collapsed">Leadership</a>
                                    </div>
                                    <div id="collapseTwo"
                                        class="collapse {{ $errors->first('leadership_data') ? 'show' : '' }}"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table">
                                                    <tbody>
                                                        <input type="hidden" name="leadership_data" id="leadership_data" value="{{ !empty($activity->leadership_data) ? $activity->leadership_data : old('leadership_data') }}">
                                                        <tr class="leadership_data_table_row">
                                                            <td>
                                                                <label class="form-label" for="leadership_status">
                                                                    Status
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('leadership_data') is-invalid @enderror"
                                                                    id="leadership_status" name="leadership_status"
                                                                    value="{{ old('leadership_status') }}"
                                                                    placeholder="Enter Status">
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="leadership_position">
                                                                    Position
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('leadership_data') is-invalid @enderror"
                                                                    id="leadership_position" name="leadership_position"
                                                                    placeholder="Enter Position" autocomplete="off">
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="leadership_organization">
                                                                    Organization
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('leadership_data') is-invalid @enderror"
                                                                    id="leadership_organization" name="leadership_organization"
                                                                    value="{{ old('leadership_organization') }}"
                                                                    placeholder="Enter Organization">
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="leadership_location">
                                                                    Location
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('leadership_data') is-invalid @enderror"
                                                                    id="leadership_location" name="leadership_location"
                                                                    value="{{ old('leadership_location') }}"
                                                                    placeholder="Ex: DRHS">
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="leadership_grade">
                                                                    Grade(s)
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <select class="js-select2 select @error('leadership_data') is-invalid @enderror" id="leadership_grade"
                                                                    name="leadership_grade" multiple="multiple">
                                                                    <option {{ in_array("1st grade" ,is_array(old('leadership_grade')) ? old('leadership_grade') : []) ? 'selected' : ' '}} value="1st grade">1st grade</option>
                                                                    <option {{ in_array("2st grade" ,is_array(old('leadership_grade')) ? old('leadership_grade') : []) ? 'selected' : ' '}} value="2st grade">2st grade</option>
                                                                    <option {{ in_array("3st grade" ,is_array(old('leadership_grade')) ? old('leadership_grade') : []) ? 'selected' : ' '}} value="3st grade">3st grade</option>
                                                                    <option {{ in_array("4st grade" ,is_array(old('leadership_grade')) ? old('leadership_grade') : []) ? 'selected' : ' '}} value="4st grade">4st grade</option>
                                                                    <option {{ in_array("5st grade" ,is_array(old('leadership_grade')) ? old('leadership_grade') : []) ? 'selected' : ' '}} value="5st grade">5st grade</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                                <a href="javascript:void(0)" onclick="addLeadershipData(this)" class="add-btn plus-icon d-flex">
                                                                    <i class="fa-solid fa-plus @error('leadership_data') bg-danger @enderror"></i>
                                                                    @error('leadership_data')
                                                                        <span class="me-2 ms-2 invalid">Click on add icon to insert leadership data</span>
                                                                    @enderror
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($activity->leadership_data) || !empty(old('leadership_data')))
                                                            @php
                                                                $leadership_data = !empty($activity->leadership_data) ? $activity->leadership_data : old('leadership_data');
                                                            @endphp
                                                            @foreach(json_decode($leadership_data) as $leadership_data)
                                                                <tr id="leadership_{{ $leadership_data->id }}">
                                                                    <td class="leadership_status">{{ $leadership_data->leadership_status }}</td>
                                                                    <td class="leadership_position">{{ $leadership_data->leadership_position }}</td>
                                                                    <td class="leadership_organization">{{ $leadership_data->leadership_organization }}</td>
                                                                    <td class="leadership_location">{{ $leadership_data->leadership_location }}</td>
                                                                    <td class="leadership_grade">{{ implode(', ', json_decode($leadership_data->leadership_grade)) }}</td>
                                                                    <td>
                                                                        <i class="fa-solid fa-pen me-2" data-id="{{ $leadership_data->id }}" onclick="leadership_edit_model(this)"></i>
                                                                        <i class="fa-solid fa-circle-xmark" data-id="{{ $leadership_data->id }}" onclick="leadership_model_remove(this)"></i>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
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
                                    <div id="collapseThree"
                                        class="collapse {{ $errors->first('activities_data') ? 'show' : '' }}"
                                        aria-labelledby="collapseThree" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table">
                                                    <tbody>
                                                        <tr class="activity_data_table_row">
                                                            <input type="hidden" name="activities_data" id="activities_data" value="{{ !empty($activity->activities_data) ? $activity->activities_data : old('activities_data') }}">
                                                            <td>
                                                                <label class="form-label" for="activity_position">
                                                                    Position
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('activities_data') is-invalid @enderror"
                                                                    value="{{ old('activity_position') }}"
                                                                    id="activity_position" name="activity_position"
                                                                    placeholder="Enter Position" autocomplete="off">
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="activity">
                                                                    Activity
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('activities_data') is-invalid @enderror"
                                                                    id="activity" name="activity"
                                                                    value="{{ old('activity') }}"
                                                                    placeholder="Enter Activity">
                                                            </td>
                                                            <td> 
                                                                <label class="form-label" for="activity_grade">
                                                                    Grade(s)
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <select class="js-select2 @error('activities_data') is-invalid @enderror select" id="activity_grade"
                                                                    name="activity_grade" multiple="multiple">
                                                                    <option {{ in_array("1st grade" ,is_array(old('activity_grade')) ? old('activity_grade') : []) ? 'selected' : '' }} value="1st grade">1st grade</option>
                                                                    <option {{ in_array("2st grade" ,is_array(old('activity_grade')) ? old('activity_grade') : []) ? 'selected' : '' }} value="2st grade">2st grade</option>
                                                                    <option {{ in_array("3st grade" ,is_array(old('activity_grade')) ? old('activity_grade') : []) ? 'selected' : '' }} value="3st grade">3st grade</option>
                                                                    <option {{ in_array("4st grade" ,is_array(old('activity_grade')) ? old('activity_grade') : []) ? 'selected' : '' }} value="4st grade">4st grade</option>
                                                                    <option {{ in_array("5st grade" ,is_array(old('activity_grade')) ? old('activity_grade') : []) ? 'selected' : '' }} value="5st grade">5st grade</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="activity_location">
                                                                    Location
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('activities_data') is-invalid @enderror"
                                                                    id="activity_location" name="activity_location"
                                                                    value="{{ old('activity_location') }}"
                                                                    placeholder="Ex: DRHS">
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="activity_honor_award">
                                                                    Honor/Award
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('activities_data') is-invalid @enderror"
                                                                    id="activity_honor_award" name="activity_honor_award"
                                                                    value="{{ old('activity_honor_award') }}"
                                                                    placeholder="Enter Honor/Award">
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                                <a href="javascript:void(0)" onclick="addActivityData(this)" class="add-btn plus-icon d-flex">
                                                                    <i class="fa-solid fa-plus @error('activities_data') bg-danger @enderror"></i>
                                                                    @error('activities_data')
                                                                        <span class="me-2 ms-2 invalid">Click on add icon to insert activity data</span>
                                                                    @enderror
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($activity->activities_data) || !empty(old('activities_data')))
                                                            @php
                                                                $activities_data = !empty($activity->activities_data) ? $activity->activities_data : old('activities_data');
                                                            @endphp
                                                            @foreach(json_decode($activities_data) as $activities_data)
                                                                <tr id="activity_{{ $activities_data->id }}">
                                                                    <td class="activity_position">{{ $activities_data->activity_position }}</td>
                                                                    <td class="activity">{{ $activities_data->activity }}</td>
                                                                    <td class="activity_grade">{{ implode(", ", json_decode($activities_data->activity_grade)) }}</td>
                                                                    <td class="activity_location">{{ $activities_data->activity_location }}</td>
                                                                    <td class="activity_honor_award">{{ $activities_data->activity_honor_award }}</td>
                                                                    <td>
                                                                        <i class="fa-solid fa-pen me-2" data-id="{{ $activities_data->id }}" onclick="activity_edit_model(this)"></i>
                                                                        <i class="fa-solid fa-circle-xmark" data-id="{{ $activities_data->id }}" onclick="activity_model_remove(this)"></i>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
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
                                    <div id="collapseFour"
                                        class="collapse {{ $errors->first('athletics_data') ? 'show' : '' }}"
                                        aria-labelledby="collapseFour" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table">
                                                    <tbody>
                                                        <tr class="athletics_data_table_row">
                                                            <input type="hidden" name="athletics_data" id="athletics_data" value="{{ !empty($activity->athletics_data) ? $activity->athletics_data : old('athletics_data') }}">
                                                            <td> 
                                                                <label class="form-label" for="athletics_position">
                                                                    Position
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('athletics_data') is-invalid @enderror"
                                                                    id="athletics_positions" name="athletics_position"
                                                                    value="{{ old('athletics_position') }}"
                                                                    placeholder="Enter Position" autocomplete="off">
    
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="athletics_activity">
                                                                     Activity
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('athletics_data') is-invalid @enderror"
                                                                    id="athletics_activity" name="athletics_activity"
                                                                    value="{{ old('athletics_activity') }}"
                                                                    placeholder="Enter Activity">
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="athletics_grade">
                                                                    Grade(s)
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <select class="js-select2 select @error('athletics_data') is-invalid @enderror" id="athletics_grade"
                                                                    name="athletics_grade" multiple="multiple">
                                                                    <option {{ in_array("1st grade" ,is_array(old('athletics_grade')) ? old('athletics_grade') : []) ? 'selected' : '' }} value="1st grade">1st grade</option>
                                                                    <option {{ in_array("2st grade" ,is_array(old('athletics_grade')) ? old('athletics_grade') : []) ? 'selected' : '' }} value="2st grade">2st grade</option>
                                                                    <option {{ in_array("3st grade" ,is_array(old('athletics_grade')) ? old('athletics_grade') : []) ? 'selected' : '' }} value="3st grade">3st grade</option>
                                                                    <option {{ in_array("4st grade" ,is_array(old('athletics_grade')) ? old('athletics_grade') : []) ? 'selected' : '' }} value="4st grade">4st grade</option>
                                                                    <option {{ in_array("5st grade" ,is_array(old('athletics_grade')) ? old('athletics_grade') : []) ? 'selected' : '' }} value="5st grade">5st grade</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="athletics_location">
                                                                    Location
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('athletics_data') is-invalid @enderror"
                                                                    value="{{ old('athletics_location') }}"
                                                                    id="athletics_location" name="athletics_location"
                                                                    placeholder="Ex: DRHS">
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="athletics_honor">
                                                                    Honor
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('athletics_data') is-invalid @enderror"
                                                                    id="athletics_honor" name="athletics_honor"
                                                                    value="{{ old('athletics_honor') }}"
                                                                    placeholder="Enter Honor">
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                                <a href="javascript:void(0)" onclick="addAthleticsData(this)" class="add-btn plus-icon d-flex">
                                                                    <i class="fa-solid fa-plus @error('athletics_data') bg-danger @enderror"></i>
                                                                    @error('athletics_data')
                                                                        <span class="me-2 ms-2 invalid">Click on add icon to insert athletics data</span>
                                                                    @enderror
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($activity->athletics_data) || !empty(old('athletics_data')))
                                                            @php
                                                                $athletics_data = !empty($activity->athletics_data) ? $activity->athletics_data : old('athletics_data');
                                                            @endphp
                                                            @foreach(json_decode($athletics_data) as $athletics_data)
                                                                <tr id="athletics_{{ $athletics_data->id }}">
                                                                    <td class="athletics_position">{{ $athletics_data->athletics_position }}</td>
                                                                    <td class="athletics_activity">{{ $athletics_data->athletics_activity }}</td>
                                                                    <td class="athletics_grade">{{ implode(", ", json_decode($athletics_data->athletics_grade)) }}</td>
                                                                    <td class="athletics_location">{{ $athletics_data->athletics_location }}</td>
                                                                    <td class="athletics_honor">{{ $athletics_data->athletics_honor }}</td> 
                                                                    <td>
                                                                        <i class="fa-solid fa-pen me-2" data-id="{{ $athletics_data->id }}" onclick="athletics_edit_model(this)"></i>
                                                                        <i class="fa-solid fa-circle-xmark" data-id="{{ $athletics_data->id }}" onclick="athletics_model_remove(this)"></i>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
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
                                    <div id="collapseFive"
                                        class="collapse {{ $errors->first('community_service_data') ? 'show' : '' }}"
                                        aria-labelledby="collapseFive" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table">
                                                    <tbody>
                                                        <tr class="community_data_table_row">
                                                            <input type="hidden" name="community_service_data" id="community_service_data" value="{{ !empty($activity->community_service_data) ? $activity->community_service_data : old('community_service_data') }}">
                                                            <td> 
                                                                <label class="form-label" for="participation_level">
                                                                    Participation level
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('community_service_data') is-invalid @enderror"
                                                                    value="{{ old('participation_level') }}"
                                                                    id="participation_level" name="participation_level"
                                                                    placeholder="Enter Participation level">
                                                            </td>
                                                            <td> 
                                                                <label class="form-label" for="community_service">
                                                                    Service
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('community_service_data') is-invalid @enderror"
                                                                    id="community_service" name="community_service"
                                                                    value="{{ old('community_service') }}"
                                                                    placeholder="Enter Service">
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="community_grade">
                                                                    Grade(s)
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <select class="js-select2 select @error('community_service_data') is-invalid @enderror" id="community_grade"
                                                                    name="community_grade" multiple="multiple">
                                                                    <option {{ in_array("1st grade" ,is_array(old('community_grade')) ? old('community_grade') : []) ? 'selected' : '' }} value="1st grade">1st grade</option>
                                                                    <option {{ in_array("2st grade" ,is_array(old('community_grade')) ? old('community_grade') : []) ? 'selected' : '' }} value="2st grade">2st grade</option>
                                                                    <option {{ in_array("3st grade" ,is_array(old('community_grade')) ? old('community_grade') : []) ? 'selected' : '' }} value="3st grade">3st grade</option>
                                                                    <option {{ in_array("4st grade" ,is_array(old('community_grade')) ? old('community_grade') : []) ? 'selected' : '' }} value="4st grade">4st grade</option>
                                                                    <option {{ in_array("5st grade" ,is_array(old('community_grade')) ? old('community_grade') : []) ? 'selected' : '' }} value="5st grade">5st grade</option>
                                                                </select>
                                                            </td>
                                                            <td><label class="form-label" for="community_location">
                                                                    Location
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('community_service_data') is-invalid @enderror"
                                                                    id="community_location" name="community_location"
                                                                    placeholder="Enter Location">
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                                <a href="javascript:void(0)" onclick="addCommunityData(this)" class="add-btn plus-icon d-flex">
                                                                    <i class="fa-solid fa-plus @error('community_service_data') bg-danger @enderror"></i>
                                                                    @error('community_service_data')
                                                                        <span class="me-2 ms-2 invalid">Click on add icon to insert community service data</span>
                                                                    @enderror
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($activity->community_service_data) || !empty(old('community_service_data')))
                                                            @php
                                                                $community_service_data = !empty($activity->community_service_data) ? $activity->community_service_data : old('community_service_data')
                                                            @endphp
                                                            @foreach(json_decode($community_service_data) as $community_service_data)
                                                                <tr id="community_{{ $community_service_data->id }}">
                                                                    <td class="participation_level">{{ $community_service_data->participation_level }}</td>
                                                                    <td class="community_service">{{ $community_service_data->community_service }}</td>
                                                                    <td class="community_grade">{{ implode(", ", json_decode($community_service_data->community_grade)) }}</td>
                                                                    <td class="community_location">{{ $community_service_data->community_location }}</td>
                                                                    <td>
                                                                        <i class="fa-solid fa-pen me-2" data-id="{{ $community_service_data->id }}"  onclick="community_edit_model(this)"></i>
                                                                        <i class="fa-solid fa-circle-xmark" data-id="{{ $community_service_data->id }}" onclick="community_model_remove(this)"></i>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
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
                        <div class="prev-btn next-btn">
                            <a href="{{ route('admin-dashboard.highSchoolResume.honors') }}"
                                class="btn btn-alt-success prev-step">
                                Previous Step
                            </a>
                        
                        </div>
                        <div class="next-btn d-flex">
                            <div>
                                @include('components.reset-all-drafts-button')
                            </div>
                            <input type="submit" class="btn  btn-alt-success next-step" value="Next Step">
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Demonstrated interest in the area of your major Modal -->
        <div class="modal" id="activity_demonstrated_modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-transparent mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Demonstrated interest in the area
                                of your major</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content fs-sm">
                            <div class="row mb-4">
                                <div class="col-lg-4">
                                    <label class="form-label" for="demonstrated_modal_position">
                                        Position
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control"
                                        value="{{ old('position') }}" id="demonstrated_modal_position" name="position"
                                        placeholder="Enter Position">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="demonstrated_modal_interest">
                                        Interest
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control"
                                        id="demonstrated_modal_interest" name="interest" value="{{ old('interest') }}"
                                        placeholder="Enter Interest">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="demonstrated_modal_grade">
                                        Grade(s)
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="js-select2 select" id="demonstrated_modal_grade" name="grade"
                                        multiple="multiple">
                                        <option value="1st grade">1st grade</option>
                                        <option value="2st grade">2st grade</option>
                                        <option value="3st grade">3st grade</option>
                                        <option value="4st grade">4st grade</option>
                                        <option value="5st grade">5st grade</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label class="form-label" for="demonstrated_modal_location">
                                        Location
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control"
                                        id="demonstrated_modal_location" name="location" value="{{ old('location') }}"
                                        placeholder="Enter Location">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="demonstrated_modal_details">
                                        Details
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" id="demonstrated_modal_details" name="details" rows="1"
                                        placeholder="Enter Details">{{ old('details') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-end">
                            <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn submit-btn" id="updateDemonstratedForm" onclick="updateDemonstratedForm(this)">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Demonstrated interest in the area of your major Modal -->

    <!-- Leadership Modal -->
        <div class="modal" id="leadership_modal" tabindex="-1" role="dialog"
            aria-labelledby="modal-block-extra-large" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-transparent mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Leadership</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content fs-sm">
                            <div class="row mb-4">
                                <div class="col-lg-4">
                                    <label class="form-label" for="leadership_modal_status">
                                        Status
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control"
                                        id="leadership_modal_status" name="leadership_status" value="{{ old('leadership_status') }}"
                                        placeholder="Enter Status">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="leadership_modal_position">
                                        Position
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        id="leadership_modal_position" name="leadership_position" placeholder="Enter Position" autocomplete="off">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="leadership_modal_organization">
                                        Organization
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        id="leadership_modal_organization" name="leadership_organization" value="{{ old('leadership_organization') }}"
                                        placeholder="Enter Organization">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label class="form-label" for="leadership_modal_location">
                                        Location
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        id="leadership_modal_location" name="leadership_location"
                                        value="{{ old('leadership_location') }}" placeholder="Ex: DRHS">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="leadership_modal_grade">
                                        Grade(s)
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="js-select2 select select2min" id="leadership_modal_grade"
                                        name="leadership_grade" multiple="multiple">
                                        <option value="1st grade">1st grade
                                        </option>
                                        <option value="2st grade">2st grade
                                        </option>
                                        <option value="3st grade">3st grade
                                        </option>
                                        <option value="4st grade">4st grade
                                        </option>
                                        <option value="5st grade">5st grade
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-end">
                            <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn submit-btn" id="updateLeadershipForm" onclick="updateLeadershipForm(this)">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Leadership Modal -->

    <!-- Activities & Clubs Modal -->
        <div class="modal" id="activity_model" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-transparent mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Activities & Clubs</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content fs-sm">
                            <div class="row mb-4">
                                <div class="col-lg-4">
                                    <label class="form-label" for="activity_modal_position">
                                        Position
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        value="{{ old('position') }}" id="activity_modal_position"
                                        name="position" placeholder="Enter Position" autocomplete="off">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="activity_modal_activity">
                                        Activity
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control"
                                        id="activity_modal_activity" name="activity" value="{{ old('activity') }}"
                                        placeholder="Enter Activity">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="activity_modal_grade">
                                        Grade(s)
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="js-select2 select" id="activity_modal_grade"
                                        name="grade" multiple="multiple">
                                        <option value="1st grade">1st grade
                                        </option>
                                        <option value="2st grade">2st grade
                                        </option>
                                        <option value="3st grade">3st grade
                                        </option>
                                        <option value="4st grade">4st grade
                                        </option>
                                        <option value="5st grade">5st grade
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label class="form-label" for="activity_modal_location">
                                        Location
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        id="activity_modal_location" name="location"
                                        value="{{ old('location') }}" placeholder="Ex: DRHS">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="activity_modal_honor_award">
                                        Honor/Award
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control"
                                        id="activity_modal_honor_award" name="honor_award" value="{{ old('honor_award') }}"
                                        placeholder="Enter Honor/Award">
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-end">
                            <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn submit-btn" id="updateActivityForm" onclick="updateActivityForm(this)">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Activities & Clubs Modal -->

    <!-- Athletics Modal -->
        <div class="modal" id="athletics_model" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-transparent mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Activities & Clubs</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content fs-sm">
                            <div class="row mb-4">
                                <div class="col-lg-4">
                                    <label class="form-label" for="athletics_modal_position">
                                        Position
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        id="athletics_modal_position" name="position"
                                        value="{{ old('position') }}" placeholder="Enter Position" autocomplete="off">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="athletics_modal_activity">
                                        Athletics Activity
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        id="athletics_modal_activity" name="activity"
                                        value="{{ old('activity') }}" placeholder="Enter Activity">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="athletics_modal_grade">
                                        Grade(s)
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="js-select2 select" id="athletics_modal_grade"
                                        name="grade" multiple="multiple">
                                        <option value="1st grade">1st grade
                                        </option>
                                        <option value="2st grade">2st grade
                                        </option>
                                        <option value="3st grade">3st grade
                                        </option>
                                        <option value="4st grade">4st grade
                                        </option>
                                        <option value="5st grade">5st grade
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label class="form-label" for="athletics_modal_location">
                                        Location
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        value="{{ old('location') }}" id="athletics_modal_location"
                                        name="location" placeholder="Ex: DRHS">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="athletics_modal_honor">
                                        Honor
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        id="athletics_modal_honor" name="honor" value="{{ old('honor') }}"
                                        placeholder="Enter Honor">
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-end">
                            <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn submit-btn" id="updateAthleticsForm" onclick="updateAthleticsForm(this)">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Athletics Modal -->

    <!-- Community service / Volunteerism Modal -->
        <div class="modal" id="community_service_model" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-transparent mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Community service / Volunteerism</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content fs-sm">
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label class="form-label" for="community_modal_participation_level">
                                        Participation level
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        value="{{ old('participation_level') }}" id="community_modal_participation_level"
                                        name="participation_level" placeholder="Enter Participation level">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="community_modal_service">
                                        Service
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        id="community_modal_service" name="service"
                                        value="{{ old('service') }}" placeholder="Enter Service">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label class="form-label" for="community_modal_grade">
                                        Grade(s)
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="js-select2 select" id="community_modal_grade"
                                        name="grade" multiple="multiple">
                                        <option value="1st grade">1st grade</option>
                                        <option value="2st grade">2st grade</option>
                                        <option value="3st grade">3st grade</option>
                                        <option value="4st grade">4st grade</option>
                                        <option value="5st grade">5st grade</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="community_modal_location">
                                        Location
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        id="community_modal_location" value="{{ old('location') }}" name="location" placeholder="Enter Location">
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-end">
                            <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn submit-btn" id="updateCommunityForm" onclick="updateCommunityForm(this)">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Community service / Volunteerism Modal -->
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
        var demonstratedData = [];
        var leadershipData = [];
        var activityData = [];
        var athleticsData = [];
        var communityData = [];

        // Demonstrated table start 

        function addDemonstratedData(data) {
            let position = $('input[name="position"]').val();
            let interest = $('input[name="interest"]').val();
            let grade = $('#grade').val();
            let location = $('input[name="location"]').val();
            let details = $('#details').val();
            let temp_demonstrated_id = Date.now();


            let demonstrated = $('#demonstrated_data').val();
            if(demonstrated != "") {
                demonstratedData = JSON.parse($('#demonstrated_data').val());
            }

            let html = ``;
            if (position != "" && interest != "" && location != "" && details != "" && grade != "") {
                html += `<tr id="demonstrated_${temp_demonstrated_id}">`;
                html += `<td class="position">${position}</td>`;
                html += `<td class="interest">${interest}</td>`;
                html += `<td class="grade">${grade.join(", ").toString()}</td>`;
                html += `<td class="location">${location}</td>`;
                html += `<td class="details">${details}</td>`;
                html += `<td>`;
                html += `<i class="fa-solid fa-pen me-2" data-id="${temp_demonstrated_id}" onclick="demonstrated_edit_model(this)"></i>`;
                html += `<i class="fa-solid fa-circle-xmark" data-id="${temp_demonstrated_id}" onclick="demonstrated_model_remove(this)"></i>`;
                html += `</td>`;

                demonstratedData.push({
                    "id": temp_demonstrated_id,
                    "position": position,
                    "interest": interest,
                    "grade": JSON.stringify(grade),
                    "location": location,
                    "details": details
                });
            } else {
                toastr.error('Please Enter Demonstrated Details');
            }

            $('.demonstrated_data_table_row').after(html);
            $('input[name="position"]').val('');
            $('input[name="interest"]').val('');
            $('input[name="location"]').val('');
            $('#details').val('');
            $("#grade").val(null).trigger("change");
            $('#demonstrated_data').val(JSON.stringify(demonstratedData));
        }

        function demonstrated_edit_model(data) {
            let demonstratedData = $('#demonstrated_data').val();
                demonstratedData = JSON.parse(demonstratedData);
            let id = $(data).attr('data-id');
            let demonstrated_result = demonstratedData.find(demonstrate => demonstrate.id == id);
            let grade = JSON.parse(demonstrated_result.grade);
            
            $('#demonstrated_modal_position').val(demonstrated_result.position);
            $('#demonstrated_modal_interest').val(demonstrated_result.interest);
            $("#demonstrated_modal_grade").val(grade).trigger("change");
            $('#demonstrated_modal_location').val(demonstrated_result.location);
            $('#demonstrated_modal_details').val(demonstrated_result.details);
            $('#updateDemonstratedForm').attr('data-id', id);
            $('#activity_demonstrated_modal').modal('show');
        }

        function updateDemonstratedForm(data) {
            let id = $(data).attr('data-id');
            let position = $('#demonstrated_modal_position').val();
            let interest = $('#demonstrated_modal_interest').val();
            let grade = $('#demonstrated_modal_grade').val();
            let location = $('#demonstrated_modal_location').val();
            let details = $('#demonstrated_modal_details').val();

            let demonstratedData = $('#demonstrated_data').val();
                demonstratedData = JSON.parse(demonstratedData);
            for (let i = 0; i < demonstratedData.length; i++) {
                if (demonstratedData[i].id == id) {
                    demonstratedData[i].position = position
                    demonstratedData[i].interest = interest
                    demonstratedData[i].grade = JSON.stringify(grade)
                    demonstratedData[i].location = location
                    demonstratedData[i].details = details
                }
            }
            $('#demonstrated_data').val(JSON.stringify(demonstratedData));
            $(`#demonstrated_${id} .position`).text(position);
            $(`#demonstrated_${id} .interest`).text(interest);
            $(`#demonstrated_${id} .grade`).text(grade.join(", ").toString());
            $(`#demonstrated_${id} .location`).text(location);
            $(`#demonstrated_${id} .details`).text(details);

            $('#activity_demonstrated_modal').modal('hide');
        }

        function demonstrated_model_remove(data) {
            let id = $(data).attr('data-id');
            let demonstratedData = $('#demonstrated_data').val();
                demonstratedData = JSON.parse(demonstratedData);
            const deleted_demonstrate = demonstratedData.filter(demonstrate => demonstrate.id != id)
            $('#demonstrated_data').val(JSON.stringify(deleted_demonstrate));
            $(`#demonstrated_${id}`).remove();
            if ($('#demonstrated_data').val() == '[]') {
                $('#demonstrated_data').val(null);
            }
        }

        // Demonstrated table end 

        // Leadership table start 

        function addLeadershipData(data) {
            let leadership_status = $('input[name="leadership_status"]').val();
            let leadership_position = $('input[name="leadership_position"]').val();
            let leadership_organization = $('input[name="leadership_organization"]').val();
            let leadership_location = $('input[name="leadership_location"]').val();
            let leadership_grade = $('#leadership_grade').val();
            let temp_leadership_id = Date.now();


            let leadership = $('#leadership_data').val();
            if(leadership != "") {
                leadershipData = JSON.parse($('#leadership_data').val());
            }


            let html = ``;
            if (leadership_status != "" && leadership_position != "" && leadership_organization != "" && leadership_location != "" && grade != "") {
                html += `<tr id="leadership_${temp_leadership_id}">`;
                html += `<td class="leadership_status">${leadership_status}</td>`;
                html += `<td class="leadership_position">${leadership_position}</td>`;
                html += `<td class="leadership_organization">${leadership_organization}</td>`;
                html += `<td class="leadership_location">${leadership_location}</td>`;
                html += `<td class="leadership_grade">${leadership_grade.join(", ").toString()}</td>`;
                html += `<td>`;
                html += `<i class="fa-solid fa-pen me-2" data-id="${temp_leadership_id}" onclick="leadership_edit_model(this)"></i>`;
                html += `<i class="fa-solid fa-circle-xmark" data-id="${temp_leadership_id}" onclick="leadership_model_remove(this)"></i>`;
                html += `</td>`;

                leadershipData.push({
                    "id": temp_leadership_id,
                    "leadership_status": leadership_status,
                    "leadership_position": leadership_position,
                    "leadership_organization": leadership_organization,
                    "leadership_grade": JSON.stringify(leadership_grade),
                    "leadership_location": leadership_location
                });
            } else {
                toastr.error('Please Enter Leadership Details');
            }

            $('.leadership_data_table_row').after(html);
            $('input[name="leadership_status"]').val('');
            $('input[name="leadership_position"]').val('');
            $('input[name="leadership_organization"]').val('');
            $('input[name="leadership_location"]').val('');
            $("#leadership_grade").val(null).trigger("change");
            $('#leadership_data').val(JSON.stringify(leadershipData));
        }

        function leadership_edit_model(data) {
            let leadershipData = $('#leadership_data').val();
                leadershipData = JSON.parse(leadershipData);
            let id = $(data).attr('data-id');
            let leadership_result = leadershipData.find(leadership => leadership.id == id);
            let leadership_grade = JSON.parse(leadership_result.leadership_grade);
            
            $('#leadership_modal_status').val(leadership_result.leadership_status);
            $('#leadership_modal_position').val(leadership_result.leadership_position);
            $('#leadership_modal_organization').val(leadership_result.leadership_organization);
            $("#leadership_modal_grade").val(leadership_grade).trigger("change");
            $('#leadership_modal_location').val(leadership_result.leadership_location);
            $('#updateLeadershipForm').attr('data-id', id);
            $('#leadership_modal').modal('show');
        }

        function updateLeadershipForm(data) {
            let id = $(data).attr('data-id');
            let leadership_status = $('#leadership_modal_status').val();
            let leadership_position = $('#leadership_modal_position').val();
            let leadership_organization = $('#leadership_modal_organization').val();
            let leadership_grade = $('#leadership_modal_grade').val();
            let leadership_location = $('#leadership_modal_location').val();

            let leadershipData = $('#leadership_data').val();
                leadershipData = JSON.parse(leadershipData);
            for (let i = 0; i < leadershipData.length; i++) {
                if (leadershipData[i].id == id) {
                    leadershipData[i].leadership_status = leadership_status
                    leadershipData[i].leadership_position = leadership_position
                    leadershipData[i].leadership_organization = leadership_organization                  
                    leadershipData[i].leadership_location = leadership_location
                    leadershipData[i].leadership_grade = JSON.stringify(leadership_grade)
                }
            }
            $('#leadership_data').val(JSON.stringify(leadershipData));
            $(`#leadership_${id} .leadership_status`).text(leadership_status);
            $(`#leadership_${id} .leadership_position`).text(leadership_position);
            $(`#leadership_${id} .leadership_organization`).text(leadership_organization);
            $(`#leadership_${id} .leadership_location`).text(leadership_location);
            $(`#leadership_${id} .leadership_grade`).text(leadership_grade.join(", ").toString());

            $('#leadership_modal').modal('hide');
        }

        function leadership_model_remove(data) {
            let id = $(data).attr('data-id');
            let leadershipData = $('#leadership_data').val();
                leadershipData = JSON.parse(leadershipData);
            const deleted_leadership = leadershipData.filter(leadership => leadership.id != id)
            $('#leadership_data').val(JSON.stringify(deleted_leadership));
            $(`#leadership_${id}`).remove();
            if ($('#leadership_data').val() == '[]') {
                $('#leadership_data').val(null);
            }
        }

        // Leadership table end 

        // Activity table start 

        function addActivityData(data) {
            let activity_position = $('input[name="activity_position"]').val();
            let activity = $('input[name="activity"]').val();
            let activity_grade = $('#activity_grade').val();
            let activity_location = $('input[name="activity_location"]').val();
            let activity_honor_award = $('input[name="activity_honor_award"]').val();
            let temp_activity_id = Date.now();


            let activities = $('#activities_data').val();
            if(activities != "") {
                activityData = JSON.parse($('#activities_data').val());
            }

            let html = ``;
            if (activity_position != "" && activity != "" && activity_grade != "" && activity_location != "" && activity_honor_award != "") {
                html += `<tr id="activity_${temp_activity_id}">`;
                html += `<td class="activity_position">${activity_position}</td>`;
                html += `<td class="activity">${activity}</td>`;
                html += `<td class="activity_grade">${activity_grade.join(", ").toString()}</td>`;
                html += `<td class="activity_location">${activity_location}</td>`;
                html += `<td class="activity_honor_award">${activity_honor_award}</td>`;
                html += `<td>`;
                html += `<i class="fa-solid fa-pen me-2" data-id="${temp_activity_id}" onclick="activity_edit_model(this)"></i>`;
                html += `<i class="fa-solid fa-circle-xmark" data-id="${temp_activity_id}" onclick="activity_model_remove(this)"></i>`;
                html += `</td>`;

                activityData.push({
                    "id": temp_activity_id,
                    "activity_position": activity_position,
                    "activity": activity,
                    "activity_grade": JSON.stringify(activity_grade),
                    "activity_location": activity_location,
                    "activity_honor_award": activity_honor_award
                });
            } else {
                toastr.error('Please Enter Activity Details');
            }

            $('.activity_data_table_row').after(html);
            $('input[name="activity_position"]').val('');
            $('input[name="activity"]').val('');
            $("#activity_grade").val(null).trigger("change");
            $('input[name="activity_location"]').val('');
            $('input[name="activity_honor_award"]').val('');
            $('#activities_data').val(JSON.stringify(activityData));
        }

        function activity_edit_model(data) {
            let activityData = $('#activities_data').val();
                activityData = JSON.parse(activityData);
            let id = $(data).attr('data-id');
            let activity_result = activityData.find(activity => activity.id == id);
            let activity_grade = JSON.parse(activity_result.activity_grade);
            
            $('#activity_modal_position').val(activity_result.activity_position);
            $('#activity_modal_activity').val(activity_result.activity);
            $("#activity_modal_grade").val(activity_grade).trigger("change");
            $('#activity_modal_location').val(activity_result.activity_location);
            $('#activity_modal_honor_award').val(activity_result.activity_honor_award);
            $('#updateActivityForm').attr('data-id', id);
            $('#activity_model').modal('show');
        }

        function updateActivityForm(data) {
            let id = $(data).attr('data-id');
            let activity_position = $('#activity_modal_position').val();
            let activity = $('#activity_modal_activity').val();
            let activity_grade = $('#activity_modal_grade').val();
            let activity_location = $('#activity_modal_location').val();
            let activity_honor_award = $('#activity_modal_honor_award').val();

            let activityData = $('#activities_data').val();
                activityData = JSON.parse(activityData);
            for (let i = 0; i < activityData.length; i++) {
                if (activityData[i].id == id) {
                    activityData[i].activity_position = activity_position
                    activityData[i].activity = activity
                    activityData[i].activity_grade = JSON.stringify(activity_grade)
                    activityData[i].activity_location = activity_location                  
                    activityData[i].activity_honor_award = activity_honor_award
                }
            }
            $('#activities_data').val(JSON.stringify(activityData));
            $(`#activity_${id} .activity_position`).text(activity_position);
            $(`#activity_${id} .activity`).text(activity);
            $(`#activity_${id} .activity_grade`).text(activity_grade.join(", ").toString());
            $(`#activity_${id} .activity_location`).text(activity_location);
            $(`#activity_${id} .activity_honor_award`).text(activity_honor_award);

            $('#activity_model').modal('hide');
        }

        function activity_model_remove(data) {
            let id = $(data).attr('data-id');
            let activityData = $('#activities_data').val();
                activityData = JSON.parse(activityData);
            const deleted_activity = activityData.filter(activity => activity.id != id)
            $('#activities_data').val(JSON.stringify(deleted_activity));
            $(`#activity_${id}`).remove();
            if ($('#activities_data').val() == '[]') {
                $('#activities_data').val(null);
            }
        }

        // Activity table end 

        // Athletics table start 

        function addAthleticsData(data) {
            let athletics_position = $('input[name="athletics_position"]').val();
            let athletics_activity = $('input[name="athletics_activity"]').val();
            let athletics_grade = $('#athletics_grade').val();
            let athletics_location = $('input[name="athletics_location"]').val();
            let athletics_honor = $('input[name="athletics_honor"]').val();
            let temp_athletics_id = Date.now();


            let athletics = $('#athletics_data').val();
            if(athletics != "") {
                athleticsData = JSON.parse($('#athletics_data').val());
            }


            let html = ``;
            if (athletics_position != "" && athletics_activity != "" && athletics_grade != "" && athletics_location != "" && athletics_honor != "") {
                html += `<tr id="athletics_${temp_athletics_id}">`;
                html += `<td class="athletics_position">${athletics_position}</td>`;
                html += `<td class="athletics_activity">${athletics_activity}</td>`;
                html += `<td class="athletics_grade">${athletics_grade.join(", ").toString()}</td>`;
                html += `<td class="athletics_location">${athletics_location}</td>`;
                html += `<td class="athletics_honor">${athletics_honor}</td>`;
                html += `<td>`;
                html += `<i class="fa-solid fa-pen me-2" data-id="${temp_athletics_id}" onclick="athletics_edit_model(this)"></i>`;
                html += `<i class="fa-solid fa-circle-xmark" data-id="${temp_athletics_id}" onclick="athletics_model_remove(this)"></i>`;
                html += `</td>`;

                athleticsData.push({
                    "id": temp_athletics_id,
                    "athletics_position": athletics_position,
                    "athletics_activity": athletics_activity,
                    "athletics_grade": JSON.stringify(athletics_grade),
                    "athletics_location": athletics_location,
                    "athletics_honor": athletics_honor
                });
            } else {
                toastr.error('Please Enter Athletics Details');
            }

            $('.athletics_data_table_row').after(html);
            $('input[name="athletics_position"]').val('');
            $('input[name="athletics_activity"]').val('');
            $("#athletics_grade").val(null).trigger("change");
            $('input[name="athletics_location"]').val('');
            $('input[name="athletics_honor"]').val('');
            $('#athletics_data').val(JSON.stringify(athleticsData));
        }

        function athletics_edit_model(data) {
            let athleticsData = $('#athletics_data').val();
                athleticsData = JSON.parse(athleticsData);
            let id = $(data).attr('data-id');
            let athletics_result = athleticsData.find(athletic => athletic.id == id);
            let athletics_grade = JSON.parse(athletics_result.athletics_grade);
            
            $('#athletics_modal_position').val(athletics_result.athletics_position);
            $('#athletics_modal_activity').val(athletics_result.athletics_activity);
            $("#athletics_modal_grade").val(athletics_grade).trigger("change");
            $('#athletics_modal_location').val(athletics_result.athletics_location);
            $('#athletics_modal_honor').val(athletics_result.athletics_honor);
            $('#updateAthleticsForm').attr('data-id', id);
            $('#athletics_model').modal('show');
        }

        function updateAthleticsForm(data) {
            let id = $(data).attr('data-id');
            let athletics_position = $('#athletics_modal_position').val();
            let athletics_activity = $('#athletics_modal_activity').val();
            let athletics_grade = $('#athletics_modal_grade').val();
            let athletics_location = $('#athletics_modal_location').val();
            let athletics_honor = $('#athletics_modal_honor').val();

            let athleticsData = $('#athletics_data').val();
                athleticsData = JSON.parse(athleticsData);
            for (let i = 0; i < athleticsData.length; i++) {
                if (athleticsData[i].id == id) {
                    athleticsData[i].athletics_position = athletics_position
                    athleticsData[i].athletics_activity = athletics_activity
                    athleticsData[i].athletics_grade = JSON.stringify(athletics_grade)
                    athleticsData[i].athletics_location = athletics_location                  
                    athleticsData[i].athletics_honor = athletics_honor
                }
            }
            $('#athletics_data').val(JSON.stringify(athleticsData));
            $(`#athletics_${id} .athletics_position`).text(athletics_position);
            $(`#athletics_${id} .athletics_activity`).text(athletics_activity);
            $(`#athletics_${id} .athletics_grade`).text(athletics_grade.join(", ").toString());
            $(`#athletics_${id} .athletics_location`).text(athletics_location);
            $(`#athletics_${id} .athletics_honor`).text(athletics_honor);

            $('#athletics_model').modal('hide');
        }

        function athletics_model_remove(data) {
            let id = $(data).attr('data-id');
            let athleticsData = $('#athletics_data').val();
                athleticsData = JSON.parse(athleticsData);
            const deleted_athletics = athleticsData.filter(athletic => athletic.id != id)
            $('#athletics_data').val(JSON.stringify(deleted_athletics));
            $(`#athletics_${id}`).remove();

            if ($('#athletics_data').val() == '[]') {
                $('#athletics_data').val(null);
            }
        }

        // Athletics table end 

        // community service table start 

        function addCommunityData(data) {
            let participation_level = $('input[name="participation_level"]').val();
            let community_service = $('input[name="community_service"]').val();
            let community_grade = $('#community_grade').val();
            let community_location = $('input[name="community_location"]').val();
            let temp_community_id = Date.now();


            let community = $('#community_service_data').val();
            if(community != "") {
                communityData = JSON.parse($('#community_service_data').val());
            }

            let html = ``;
            if (participation_level != "" && community_service != "" && community_grade != "" && community_location != "") {
                html += `<tr id="community_${temp_community_id}">`;
                html += `<td class="participation_level">${participation_level}</td>`;
                html += `<td class="community_service">${community_service}</td>`;
                html += `<td class="community_grade">${community_grade.join(", ").toString()}</td>`;
                html += `<td class="community_location">${community_location}</td>`;
                html += `<td>`;
                html += `<i class="fa-solid fa-pen me-2" data-id="${temp_community_id}" onclick="community_edit_model(this)"></i>`;
                html += `<i class="fa-solid fa-circle-xmark" data-id="${temp_community_id}" onclick="community_model_remove(this)"></i>`;
                html += `</td>`;

                communityData.push({
                    "id": temp_community_id,
                    "participation_level": participation_level,
                    "community_service": community_service,
                    "community_grade": JSON.stringify(community_grade),
                    "community_location": community_location
                });
            } else {
                toastr.error('Please Enter community Details');
            }

            $('.community_data_table_row').after(html);
            $('input[name="participation_level"]').val('');
            $('input[name="community_service"]').val('');
            $("#community_grade").val(null).trigger("change");
            $('input[name="community_location"]').val('');
            $('#community_service_data').val(JSON.stringify(communityData));
        }

        function community_edit_model(data) {
            let communityServiceData = $('#community_service_data').val();
                communityServiceData = JSON.parse(communityServiceData);
            let id = $(data).attr('data-id');
            let community_service_result = communityServiceData.find(community_service => community_service.id == id);
            let community_grade = JSON.parse(community_service_result.community_grade);
            
            $('#community_modal_participation_level').val(community_service_result.participation_level);
            $('#community_modal_service').val(community_service_result.community_service);
            $("#community_modal_grade").val(community_grade).trigger("change");
            $('#community_modal_location').val(community_service_result.community_location);
            $('#updateCommunityForm').attr('data-id', id);
            $('#community_service_model').modal('show');
        }

        function updateCommunityForm(data) {
            let id = $(data).attr('data-id');
            let participation_level = $('#community_modal_participation_level').val();
            let community_service = $('#community_modal_service').val();
            let community_grade = $('#community_modal_grade').val();
            let community_location = $('#community_modal_location').val();

            let communityServiceData = $('#community_service_data').val();
                communityServiceData = JSON.parse(communityServiceData);
            for (let i = 0; i < communityServiceData.length; i++) {
                if (communityServiceData[i].id == id) {
                    communityServiceData[i].participation_level = participation_level
                    communityServiceData[i].community_service = community_service
                    communityServiceData[i].community_grade = JSON.stringify(community_grade)
                    communityServiceData[i].community_location = community_location                  
                }
            }
            $('#community_service_data').val(JSON.stringify(communityServiceData));
            $(`#community_${id} .participation_level`).text(participation_level);
            $(`#community_${id} .community_service`).text(community_service);
            $(`#community_${id} .community_grade`).text(community_grade.join(", ").toString());
            $(`#community_${id} .community_location`).text(community_location);

            $('#community_service_model').modal('hide');
        }

        function community_model_remove(data) {
            let id = $(data).attr('data-id');
            let communityServiceData = $('#community_service_data').val();
                communityServiceData = JSON.parse(communityServiceData);
            const deleted_community = communityServiceData.filter(community => community.id != id)
            $('#community_service_data').val(JSON.stringify(deleted_community));
            $(`#community_${id}`).remove();

            if ($('#community_service_data').val() == '[]') {
                $('#community_service_data').val(null);
            }
        }

        // community service table end 


        function errorMsg()
        {
            Swal.fire({
                title: 'Complete Current Step',
                text: "You Have to submit current form",
                icon: 'warning',
                confirmButtonColor: '#F27474',
                confirmButtonText: 'Okay'
            }).then((result) => {
                window.location.href = "{{ route('admin-dashboard.highSchoolResume.activities') }}";
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
