@extends('layouts.user')

@section('title', 'High School Resume : CPS')

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
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.employementCertified') }}"
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
                <form class="js-validation" action="" method="POST">
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content">
                            <div class="accordion accordionExample2">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <a class=" text-white fw-600 collapsed"> Demonstrated interest in the area of your
                                            major</a>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="position1">Position</label>
                                                            <input type="text" class="form-control" id="position1"
                                                                name="position1" placeholder="position" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="Interest">Interest</label>
                                                            <input type="text" class="form-control" id="Interest"
                                                                name="Interest" placeholder="Interest" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="Grade(s)">Grade(s)</label>
                                                            <select class="js-select2 select" id="Grade(s)" name="Grade(s)"
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
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="Details">Locations</label>
                                                            <textarea class="form-control" id="Details" name="Details" rows="1" placeholder="Details"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="Location">Action</label>

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
                                                            <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="position-td">Mark</td>
                                                            <td class="honor-td">Mark</td>
                                                            <td class="location-td">Mark</td>
                                                            <td class="grade-td">Mark</td>
                                                            <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="position-td">Mark</td>
                                                            <td class="honor-td">Mark</td>
                                                            <td class="location-td">Mark</td>
                                                            <td class="grade-td">Mark</td>
                                                            <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i
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
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingOne"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="Status">Status</label>
                                                            <input type="text" class="form-control" id="Status"
                                                                name="Status" placeholder="Status" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="Position">Position</label>
                                                            <input type="text" class="form-control" id="Position"
                                                                name="Interest" placeholder="Position" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label"
                                                                for="Organization">Organization</label>
                                                            <input type="text" class="form-control" id="Organization"
                                                                name="Organization" placeholder="Organization" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="Grade(s)1">Grade(s)</label>
                                                            <select class="js-select2 select select2min" id="Grade(s)1"
                                                                name="Grade(s)1" multiple="multiple">
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
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="Location22">Locations</label>
                                                            <input type="text" class="form-control" id="Location22"
                                                                name="Location22" placeholder="Ex: DRHS" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-1">
                                                        <div>
                                                            <label class="form-label" for="Location">Action</label>
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
                                    <div id="collapseThree" class="collapse" aria-labelledby="collapseThree"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="position3">Positions</label>
                                                            <input type="text" class="form-control" id="position3"
                                                                name="position3" placeholder="position" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="Activity">Activity</label>
                                                            <input type="text" class="form-control" id="Activity"
                                                                name="Activity" placeholder="Activity" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="Grade(s)77">Grade(s)</label>
                                                            <select class="js-select2 select" id="Grade(s)77"
                                                                name="Grade(s)77" multiple="multiple">
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
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="Location88">Locations</label>
                                                            <input type="text" class="form-control" id="Location88"
                                                                name="Location88" placeholder="Ex: DRHS" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label"
                                                                for="Honor/Award">Honor/Award</label>
                                                            <input type="text" class="form-control" id="Honor/Award"
                                                                name="Honor/Award" placeholder="Ex: DRHS" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <div>
                                                            <label class="form-label" for="Location">Action</label>

                                                        </div>
                                                    </div>
                                                </div>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td class="text-end" >Mark</td>
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
                                    <div id="collapseFour" class="collapse" aria-labelledby="collapseFour"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="position2">Positions</label>
                                                            <input type="text" class="form-control" id="position2"
                                                                name="position2" placeholder="position" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="Activity1">Athletic
                                                                Activity</label>
                                                            <input type="text" class="form-control" id="Activity1"
                                                                name="Activity1" placeholder="Activity" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="Grade(s)4">Grade(s)</label>
                                                            <select class="js-select2 select" id="Grade(s)4"
                                                                name="Grade(s)4" multiple="multiple">
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
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="Location77">Locations</label>
                                                            <input type="text" class="form-control" id="Location77"
                                                                name="Location77" placeholder="Ex: DRHS" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="Award">Honor</label>
                                                            <input type="text" class="form-control" id="Award"
                                                                name="Award" placeholder="Honor" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <div>
                                                            <label class="form-label" for="Location">Action</label>

                                                        </div>
                                                    </div>
                                                </div>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td class="text-end" >Mark</td>
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
                                        data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                        <a class=" text-white fw-600 collapsed">Community service / Volunteerism</a>
                                    </div>
                                    <div id="collapseFive" class="collapse" aria-labelledby="collapseFive"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label"
                                                                for="Participation-level">Participation level</label>
                                                            <input type="text" class="form-control"
                                                                id="Participation-level" name="Participation-level"
                                                                placeholder="Participation level"required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div>
                                                            <label class="form-label" for="Service">Service</label>
                                                            <input type="text" class="form-control" id="Service"
                                                                name="Service" placeholder="Service" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="Grade(s)88">Grade(s)</label>
                                                            <select class="js-select2 select" id="Grade(s)88"
                                                                name="Grade(s)88" multiple="multiple">
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
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div>
                                                            <label class="form-label" for="Location75">Locations</label>
                                                            <input type="text" class="form-control" id="Location75"
                                                                name="Location75" placeholder="location" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <div>
                                                            <label class="form-label" for="Location">Action</label>

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
                            <a href="{{ route('admin-dashboard.highSchoolResume.employementCertified') }}"
                                class="btn btn-alt-primary next-step"> Next
                            </a>
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
            min-width: 18vw !important;
        }
    </style>
@endsection

@section('user-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/high-school-resume.js') }}"></script>
@endsection
