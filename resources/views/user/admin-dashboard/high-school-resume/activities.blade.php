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
                        <a class="nav-link" href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/personal-info?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.personalInfo')}}"
                            id="step1-tab">
                            <p class="d-none">1</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Personal Info</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/education-info?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.educationInfo')  }}"
                            id="step2-tab">
                            <p class="d-none">2</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Education </h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/honors?resume_id='.$resume_id) :route('admin-dashboard.highSchoolResume.honors')}}" id="step3-tab">
                            <p class="d-none">3</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Honors </h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link active" href="{{isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/activities?resume_id='.$resume_id): route('admin-dashboard.highSchoolResume.activities') }}"
                            id="step4-tab">
                            <p>4</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Activities</h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($activity) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                        <a class="nav-link" href="{{ isset($activity) && $activity != null ? (isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/employment-certifications?resume_id='.$resume_id):route('admin-dashboard.highSchoolResume.employmentCertification')) : ''}}"
                            id="step5-tab">
                            <p>5</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Employment & <br> Certifications</h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($activity) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                        <a class="nav-link" href="{{ isset($employmentCertification) && $employmentCertification != null ? (isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/features-attributes?resume_id='.$resume_id): route('admin-dashboard.highSchoolResume.featuresAttributes')) : ''}}"
                            id="step6-tab">
                            <p>6</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Featured <br> Attributes</h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($activity) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                        <a class="nav-link" href="{{ isset($featuredAttribute) && $featuredAttribute != null ? (isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/preview?resume_id='.$resume_id):route('admin-dashboard.highSchoolResume.preview')) : ''}}" id="step7-tab">
                            <p >7</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Preview</h6>
                        </a>
                    </li>
                </ul>
                <form class="js-validation" id="activities_form" action="{{ isset($activity) && $activity != null ? route('admin-dashboard.highSchoolResume.activities.update', $activity->id) : route('admin-dashboard.highSchoolResume.activities.store') }}"
                    method="post">
                    @csrf
                    @if(isset($activity) && $activity != null)
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
                                        <a class="text-white fw-600 collapsed"> Demonstrated Interest In The Area Of Your
                                            major</a>
                                    </div>
                                    <div id="collapseOne"
                                        class="collapse show"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <input type="hidden" name="activity" id="activity" value="{{ isset($activity) ? $activity->id : ''}}">
                                                <table class="table table_demonstrated_data">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <label class="form-label" for="position">
                                                                    Position
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="interest">
                                                                    Interest
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="grade">
                                                                    Grade(s)
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="location">
                                                                    Location
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="details">
                                                                    Details
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($activity->demonstrated_data))
                                                            @foreach ($activity->demonstrated_data as $index => $demonstrated_data)
                                                                <tr class="demonstrated_data_table_row {{ $loop->first ? '' : 'remove_demonstrated_data' }}">
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            value="{{ $demonstrated_data['position'] }}" id="position"
                                                                            name="demonstrated_data[{{ $index }}][position]" placeholder="Vice President" autocomplete="off">
                                                                    </td>
                                                                    <td> 
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="interest" name="demonstrated_data[{{ $index }}][interest]"
                                                                            value="{{ $demonstrated_data['interest'] }}"
                                                                            placeholder="Enter Interest">
                                                                    </td>
                                                                    <td>
                                                                        <select class="js-select2 select" id="demonstrated_select_{{ $index }}"
                                                                            name="demonstrated_data[{{ $index }}][grade][]" multiple="multiple">
                                                                            <option {{ isset($demonstrated_data['grade']) && $demonstrated_data['grade'] != null ? (in_array("9th" ,is_array($demonstrated_data['grade']) ? $demonstrated_data['grade'] : []) ? 'selected' : '') : '' }} value="9th">9th</option>
                                                                            <option {{ isset($demonstrated_data['grade']) && $demonstrated_data['grade'] != null ? (in_array("10th" ,is_array($demonstrated_data['grade']) ? $demonstrated_data['grade'] : []) ? 'selected' : '') : '' }} value="10th">10th</option>
                                                                            <option {{ isset($demonstrated_data['grade']) && $demonstrated_data['grade'] != null ? (in_array("11th" ,is_array($demonstrated_data['grade']) ? $demonstrated_data['grade'] : []) ? 'selected' : '') : '' }} value="11th">11th</option>
                                                                            <option {{ isset($demonstrated_data['grade']) && $demonstrated_data['grade'] != null ? (in_array("12th" ,is_array($demonstrated_data['grade']) ? $demonstrated_data['grade'] : []) ? 'selected' : '') : '' }} value="12th">12th</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="location" name="demonstrated_data[{{ $index }}][location]"
                                                                            value="{{ $demonstrated_data['location'] }}"
                                                                            placeholder="Enter Location">
                                                                    </td>
                                                                    <td>
                                                                        <textarea class="form-control" id="details" name="demonstrated_data[{{ $index }}][details]" rows="1"
                                                                            placeholder="Enter Details">{{ $demonstrated_data['details'] }}</textarea>
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                            <i data-count="{{ count($activity->demonstrated_data) != 0 ? count($activity->demonstrated_data) - 1 : 0 }}" class="fa-solid {{ $loop->first ? 'fa-plus' : 'fa-minus' }}" onclick="{{ $loop->first ? 'addDemonstratedData(this)' : 'removeDemonstratedData(this)' }}"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr class="demonstrated_data_table_row">
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        value="" id="position"
                                                                        name="demonstrated_data[0][position]" placeholder="Vice President" autocomplete="off">
                                                                </td>
                                                                <td> 
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="interest" name="demonstrated_data[0][interest]"
                                                                        value=""
                                                                        placeholder="Enter Interest">
                                                                </td>
                                                                <td>
                                                                    <select class="js-select2 select" id="demonstrated_select_0"
                                                                        name="demonstrated_data[0][grade][]" multiple="multiple">
                                                                        <option value="9th">9th</option>
                                                                        <option value="10th">10th</option>
                                                                        <option value="11th">11th</option>
                                                                        <option value="12th">12th</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="location" name="demonstrated_data[0][location]"
                                                                        value=""
                                                                        placeholder="Enter Location">
                                                                </td>
                                                                <td>
                                                                    <textarea class="form-control" id="details" name="demonstrated_data[0][details]" rows="1"
                                                                        placeholder="Enter Details"></textarea>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                        <i data-count="0" class="fa-solid fa-plus" onclick="addDemonstratedData(this)"></i>
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
                                        <a class=" text-white fw-600 collapsed">Leadership</a>
                                    </div>
                                    <div id="collapseTwo"
                                        class="collapse"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table table_leadership_data">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <label class="form-label" for="leadership_status">
                                                                    Status
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="leadership_position">
                                                                    Position
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="leadership_organization">
                                                                    Organization
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="leadership_location">
                                                                    Location
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="leadership_grade">
                                                                    Grade(s)
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($activity->leadership_data))
                                                            @foreach($activity->leadership_data as $index => $leadership_data)
                                                                <tr class="leadership_data_table_row {{ $loop->first ? '' : 'remove_leadership_data' }}">
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="leadership_status" name="leadership_data[{{ $index }}][status]"
                                                                            value="{{ $leadership_data['status'] }}"
                                                                            placeholder="Enter Status">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="leadership_position" name="leadership_data[{{ $index }}][position]"
                                                                            value="{{ $leadership_data['position'] }}"
                                                                            placeholder="Vice President" autocomplete="off">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="leadership_organization" name="leadership_data[{{ $index }}][organization]"
                                                                            value="{{ $leadership_data['organization'] }}"
                                                                            placeholder="Enter Organization">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="leadership_location" name="leadership_data[{{ $index }}][location]"
                                                                            value="{{ $leadership_data['location'] }}"
                                                                            placeholder="Ex: DRHS">
                                                                    </td>
                                                                    <td>
                                                                        <select class="js-select2 select" id="leadership_select_{{ $index }}"
                                                                            name="leadership_data[{{ $index }}][grade][]" multiple="multiple">
                                                                            <option {{ isset($leadership_data['grade']) && $leadership_data['grade'] != null ? (in_array("9th" ,is_array($leadership_data['grade']) ? $leadership_data['grade'] : []) ? 'selected' : ' ') : '' }} value="9th">9th</option>
                                                                            <option {{ isset($leadership_data['grade']) && $leadership_data['grade'] != null ? (in_array("10th" ,is_array($leadership_data['grade']) ? $leadership_data['grade'] : []) ? 'selected' : ' ') : '' }} value="10th">10th</option>
                                                                            <option {{ isset($leadership_data['grade']) && $leadership_data['grade'] != null ? (in_array("11th" ,is_array($leadership_data['grade']) ? $leadership_data['grade'] : []) ? 'selected' : ' ') : '' }} value="11th">11th</option>
                                                                            <option {{ isset($leadership_data['grade']) && $leadership_data['grade'] != null ? (in_array("12th" ,is_array($leadership_data['grade']) ? $leadership_data['grade'] : []) ? 'selected' : ' ') : '' }} value="12th">12th</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                            <i data-count="{{ count($activity->leadership_data) != 0 ? count($activity->leadership_data) - 1 : 0 }}" class="fa-solid {{ $loop->first ? 'fa-plus' : 'fa-minus' }}" onclick="{{ $loop->first ? 'addLeadershipData(this)' : 'removeLeadershipData(this)' }}"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach 
                                                        @else   
                                                            <tr class="leadership_data_table_row">
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="leadership_status" name="leadership_data[0][status]"
                                                                        placeholder="Enter Status">
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="leadership_position" name="leadership_data[0][position]"
                                                                        placeholder="Vice President" autocomplete="off">
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="leadership_organization" name="leadership_data[0][organization]"
                                                                        placeholder="Enter Organization">
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="leadership_location" name="leadership_data[0][location]"
                                                                        placeholder="Ex: DRHS">
                                                                </td>
                                                                <td>
                                                                    <select class="js-select2 select" id="leadership_select_0"
                                                                        name="leadership_data[0][grade][]" multiple="multiple">
                                                                        <option value="9th">9th</option>
                                                                        <option value="10th">10th</option>
                                                                        <option value="11th">11th</option>
                                                                        <option value="12th">12th</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                        <i data-count="0" class="fa-solid fa-plus" onclick="addLeadershipData(this)"></i>
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
                                        data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        <a class=" text-white fw-600 collapsed">Activities & Clubs</a>
                                    </div>
                                    <div id="collapseThree"
                                        class="collapse"
                                        aria-labelledby="collapseThree" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table table_activities_data">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <label class="form-label" for="activity_position">
                                                                    Position
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="activity">
                                                                    Activity
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="activity_grade">
                                                                    Grade(s)
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="activity_location">
                                                                    Location
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="activity_honor_award">
                                                                    Honor/Award
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($activity->activities_data))
                                                            @foreach($activity->activities_data as $index => $activities_data)
                                                                <tr class="activity_data_table_row {{ $loop->first ? '' : 'remove_activity_data' }}">
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="activity_position" name="activities_data[{{ $index }}][position]"
                                                                            value="{{ $activities_data['position'] }}"
                                                                            placeholder="Vice President" autocomplete="off">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            value="{{ $activities_data['activity'] }}"
                                                                            id="activity" name="activities_data[{{ $index }}][activity]"
                                                                            placeholder="Enter Activity">
                                                                    </td>
                                                                    <td> 
                                                                        <select class="js-select2 select" id="activity_select_{{ $index }}"
                                                                            name="activities_data[{{ $index }}][grade][]" multiple="multiple">
                                                                            <option {{ isset($activities_data['grade']) && $activities_data['grade'] != null ? (in_array("9th" ,is_array($activities_data['grade']) ? $activities_data['grade'] : []) ? 'selected' : '') : '' }} value="9th">9th</option>
                                                                            <option {{ isset($activities_data['grade']) && $activities_data['grade'] != null ? (in_array("10th" ,is_array($activities_data['grade']) ? $activities_data['grade'] : []) ? 'selected' : '') : '' }} value="10th">10th</option>
                                                                            <option {{ isset($activities_data['grade']) && $activities_data['grade'] != null ? (in_array("11th" ,is_array($activities_data['grade']) ? $activities_data['grade'] : []) ? 'selected' : '') : '' }} value="11th">11th</option>
                                                                            <option {{ isset($activities_data['grade']) && $activities_data['grade'] != null ? (in_array("12th" ,is_array($activities_data['grade']) ? $activities_data['grade'] : []) ? 'selected' : '') : '' }} value="12th">12th</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            value="{{ $activities_data['location'] }}"
                                                                            id="activity_location" name="activities_data[{{ $index }}][location]"
                                                                            placeholder="Ex: DRHS">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            value="{{ $activities_data['honor_award'] }}"
                                                                            id="activity_honor_award" name="activities_data[{{ $index }}][honor_award]"
                                                                            placeholder="Enter Honor/Award">
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                            <i data-count="{{ count($activity->activities_data) != 0 ? count($activity->activities_data) - 1 : 0 }}" class="fa-solid {{ $loop->first ? 'fa-plus' : 'fa-minus' }}" onclick="{{ $loop->first ? 'addActivityData(this)' : 'removeActivityData(this)' }}"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr class="activity_data_table_row">
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="activity_position" name="activities_data[0][position]"
                                                                        placeholder="Vice President" autocomplete="off">
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="activity" name="activities_data[0][activity]"
                                                                        placeholder="Enter Activity">
                                                                </td>
                                                                <td> 
                                                                    <select class="js-select2 select" id="activity_select_0"
                                                                        name="activities_data[0][grade][]" multiple="multiple">
                                                                        <option value="9th">9th</option>
                                                                        <option value="10th">10th</option>
                                                                        <option value="11th">11th</option>
                                                                        <option value="12th">12th</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="activity_location" name="activities_data[0][location]"
                                                                        placeholder="Ex: DRHS">
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="activity_honor_award" name="activities_data[0][honor_award]"
                                                                        placeholder="Enter Honor/Award">
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                        <i data-count="0" class="fa-solid fa-plus" onclick="addActivityData(this)"></i>
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
                                        data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                        <a class=" text-white fw-600 collapsed">Athletics</a>
                                    </div>
                                    <div id="collapseFour"
                                        class="collapse"
                                        aria-labelledby="collapseFour" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table athletics_table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                 <label class="form-label" for="athletics_position">
                                                                    Position
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="athletics_activity">
                                                                     Activity
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="athletics_grade">
                                                                    Grade(s)
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="athletics_location">
                                                                    Location
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="athletics_honor">
                                                                    Honor
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($activity->athletics_data))
                                                            @foreach ($activity->athletics_data as $index => $athletics_data)
                                                                <tr class="athletics_data_table_row {{ $loop->first ? '' : 'remove_athletics_data' }}">
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="athletics_positions" name="athletics_data[{{ $index }}][position]"
                                                                            value="{{ $athletics_data['position'] }}"
                                                                            placeholder="Vice President" autocomplete="off">
                                                                        </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="athletics_activity" name="athletics_data[{{ $index }}][activity]"
                                                                            value="{{ $athletics_data['activity'] }}"
                                                                            placeholder="Enter Activity">
                                                                    </td>
                                                                    <td>
                                                                        <select class="js-select2 select" id="athletics_select_{{ $index }}"
                                                                            name="athletics_data[{{ $index }}][grade][]" multiple="multiple">
                                                                            <option {{ isset($athletics_data['grade']) && $athletics_data['grade'] != null ? (in_array("9th" ,is_array($athletics_data['grade']) ? $athletics_data['grade'] : []) ? 'selected' : '') : '' }} value="9th">9th</option>
                                                                            <option {{ isset($athletics_data['grade']) && $athletics_data['grade'] != null ? (in_array("10th" ,is_array($athletics_data['grade']) ? $athletics_data['grade'] : []) ? 'selected' : '') : '' }} value="10th">10th</option>
                                                                            <option {{ isset($athletics_data['grade']) && $athletics_data['grade'] != null ? (in_array("11th" ,is_array($athletics_data['grade']) ? $athletics_data['grade'] : []) ? 'selected' : '') : '' }} value="11th">11th</option>
                                                                            <option {{ isset($athletics_data['grade']) && $athletics_data['grade'] != null ? (in_array("12th" ,is_array($athletics_data['grade']) ? $athletics_data['grade'] : []) ? 'selected' : '') : '' }} value="12th">12th</option>
                                                                        </select>
                                                                    </td>
                                                                    <td> 
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            value="{{ $athletics_data['location'] }}"
                                                                            id="athletics_location" name="athletics_data[{{ $index }}][location]"
                                                                            placeholder="Ex: DRHS">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="athletics_honor" name="athletics_data[{{ $index }}][honor]"
                                                                            value="{{ $athletics_data['honor'] }}"
                                                                            placeholder="Enter Honor">
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                            <i class="fa-solid {{ $loop->first ? 'fa-plus' : 'fa-minus'}}" data-count="{{ count($activity->athletics_data) != 0 ? count($activity->athletics_data) - 1 : 0 }}" onclick=" {{ $loop->first ? 'addAthleticsData(this)' : 'removeAthleticsData(this)' }} "></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr class="athletics_data_table_row">
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="athletics_positions" name="athletics_data[0][position]"
                                                                        value=""
                                                                        placeholder="Vice President" autocomplete="off">
                                                                    </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="athletics_activity" name="athletics_data[0][activity]"
                                                                        value=""
                                                                        placeholder="Enter Activity">
                                                                </td>
                                                                <td>
                                                                    <select class="js-select2 select" id="athletics_select_0"
                                                                        name="athletics_data[0][grade][]" multiple="multiple">
                                                                        <option value="9th">9th</option>
                                                                        <option value="10th">10th</option>
                                                                        <option value="11th">11th</option>
                                                                        <option value="12th">12th</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        value=""
                                                                        id="athletics_location" name="athletics_data[0][location]"
                                                                        placeholder="Ex: DRHS">
                                                                </td>
                                                                <td>
                                                                    
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="athletics_honor" name="athletics_data[0][honor]"
                                                                        value=""
                                                                        placeholder="Enter Honor">
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                        <i class="fa-solid fa-plus" data-count="0" onclick="addAthleticsData(this)"></i>
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
                                        data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                        <a class=" text-white fw-600 collapsed">Community Service / Volunteerism</a>
                                    </div>
                                    <div id="collapseFive"
                                        class="collapse"
                                        aria-labelledby="collapseFive" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table comunity_table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                 <label class="form-label" for="participation_level">
                                                                    Participation Level
                                                                </label>
                                                            </td>
                                                            <td>
                                                                 <label class="form-label" for="community_service">
                                                                    Service
                                                                </label>
                                                            </td>
                                                            <td>
                                                                 <label class="form-label" for="community_grade">
                                                                    Grade(s)
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="community_location">
                                                                    Location
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($activity->community_service_data))
                                                            @foreach ($activity->community_service_data as $index => $community_service_data)
                                                                <tr class="community_data_table_row {{ $loop->first ? '' : 'remove_comunity_data' }}">
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="participation_level" name="community_service_data[{{ $index }}][level]"
                                                                            value = "{{ $community_service_data['level'] }}"
                                                                            placeholder="Enter Participation level">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="community_service" name="community_service_data[{{ $index }}][service]"
                                                                            value = "{{ $community_service_data['service'] }}"
                                                                            placeholder="Enter Service">
                                                                    </td>
                                                                    <td>
                                                                        <select class="js-select2 select" id="community_select_{{ $index }}"
                                                                            name="community_service_data[{{ $index }}][grade][]" multiple="multiple">
                                                                            <option {{ isset($community_service_data['grade']) && $community_service_data['grade'] != null ? (in_array("9th" ,is_array($community_service_data['grade']) ? $community_service_data['grade'] : []) ? 'selected' : '') : '' }} value="9th">9th</option>
                                                                            <option {{ isset($community_service_data['grade']) && $community_service_data['grade'] != null ? (in_array("10th" ,is_array($community_service_data['grade']) ? $community_service_data['grade'] : []) ? 'selected' : '') : '' }} value="10th">10th</option>
                                                                            <option {{ isset($community_service_data['grade']) && $community_service_data['grade'] != null ? (in_array("11th" ,is_array($community_service_data['grade']) ? $community_service_data['grade'] : []) ? 'selected' : '') : '' }} value="11th">11th</option>
                                                                            <option {{ isset($community_service_data['grade']) && $community_service_data['grade'] != null ? (in_array("12th" ,is_array($community_service_data['grade']) ? $community_service_data['grade'] : []) ? 'selected' : '') : '' }} value="12th">12th</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="community_location" name="community_service_data[{{ $index }}][location]"
                                                                            value = "{{ $community_service_data['location'] }}"
                                                                            placeholder="Enter Location">
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                            <i class="fa-solid {{ $loop->first ? 'fa-plus' : 'fa-minus'}}" onclick="{{ $loop->first ? 'addCommunityData(this)' :'removeCommunityData(this)' }}" data-count="{{ count($activity->community_service_data) != 0 ? count($activity->community_service_data) - 1 : 0 }}"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr class="community_data_table_row">
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="participation_level" name="community_service_data[0][level]"
                                                                        placeholder="Enter Participation level">
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="community_service" name="community_service_data[0][service]"
                                                                        placeholder="Enter Service">
                                                                </td>
                                                                <td>                                                               
                                                                    <select class="js-select2 select" id="community_select_0"
                                                                        name="community_service_data[0][grade][]" multiple="multiple">
                                                                        <option value="9th">9th</option>
                                                                        <option value="10th">10th</option>
                                                                        <option value="11th">11th</option>
                                                                        <option value="12th">12th</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="community_location" name="community_service_data[0][location]"
                                                                        placeholder="Enter Location">
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                        <i class="fa-solid fa-plus" onclick="addCommunityData(this)" data-count="0"></i>
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
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <div class="prev-btn next-btn">
                            <a href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/honors?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.honors') }}"
                                class="btn btn-alt-success prev-step">
                                Previous Step
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
    <script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>

        let total_demonstrated_count = "{{ isset($activity->demonstrated_data) && $activity->demonstrated_data != null ? count($activity->demonstrated_data) : 0 }}";
        let total_leadership_count = "{{ isset($activity->leadership_data) && $activity->leadership_data != null ? count($activity->leadership_data) : 0 }}";
        let total_activity_count = "{{ isset($activity->activities_data) && $activity->activities_data != null ? count($activity->activities_data) : 0 }}";
        let total_athletics_count = "{{ isset($activity->athletics_data) && $activity->athletics_data != null ? count($activity->athletics_data) : 0 }}";
        let total_community_count = "{{ isset($activity->community_service_data) && $activity->community_service_data != null ? count($activity->community_service_data) : 0 }}";

        $(document).ready(() => {
            if(total_demonstrated_count > 0) {
                for (let index = 0; index < total_demonstrated_count; index++) {
                    $(`#demonstrated_select_${index}`).select2({
                        tags: true,
                    });
                }
            } else {
                $("#demonstrated_select_0").select2({
                    tags: true,
                });
            }

            if(total_leadership_count > 0) {
                for (let index = 0; index < total_leadership_count; index++) {
                    $(`#leadership_select_${index}`).select2({
                        tags: true,
                    });
                }
            } else {
                $("#leadership_select_0").select2({
                    tags: true,
                });
            }

            if(total_activity_count > 0) {
                for (let index = 0; index < total_activity_count; index++) {
                    $(`#activity_select_${index}`).select2({
                        tags: true,
                    });
                }
            } else {
                $("#activity_select_0").select2({
                    tags: true,
                });
            }
            
            if (total_athletics_count > 0) {
                for (let index = 0; index < total_athletics_count; index++) {
                    $(`#athletics_select_${index}`).select2({
                        tags: true,
                    });
                }
            }else{
                $("#athletics_select_0").select2({
                    tags: true,
                });
            }

            if (total_community_count > 0) {
                for (let index = 0; index < total_community_count; index++) {
                    $(`#community_select_${index}`).select2({
                        tags: true,
                    });
                }
            }else{
                $("#community_select_0").select2({
                    tags: true,
                });
            } 

            let validations_rules = @json($validations_rules);
            let validations_messages = @json($validations_messages);
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
