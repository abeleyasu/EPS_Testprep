@extends('layouts.user')

@section('title', 'HSR | Preview : CPS')

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
                    <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.personalInfo') }}" id="step1-tab">
                        <i class="fa-solid fa-envelope d-none"></i>
                        <i class="fa-solid fa-check fa-check-block "></i>
                        <p>Personal Info</p>
                    </a>
                </li>
                <li role="presentation">
                    <a class="nav-link " href="{{ route('admin-dashboard.highSchoolResume.educationInfo') }}" id="step2-tab">
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
                    <a class="nav-link " href="{{ route('admin-dashboard.highSchoolResume.activities') }}" id="step4-tab">
                        <i class="fa-solid fa-envelope d-none"></i>
                        <i class="fa-solid fa-check fa-check-block "></i>
                        <p>Activities</p>
                    </a>
                </li>
                <li role="presentation">
                    <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.employmentCertification') }}" id="step5-tab">
                        <i class="fa-solid fa-envelope d-none"></i>
                        <i class="fa-solid fa-check fa-check-block "></i>
                        <p>Employment & <br> Certifications</p>
                    </a>
                </li>
                <li role="presentation">
                    <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.featuresAttributes') }}" id="step6-tab">
                        <i class="fa-solid fa-envelope d-none"></i>
                        <i class="fa-solid fa-check fa-check-block "></i>
                        <p>Featured <br> Attributes</p>
                    </a>
                </li>
                <li role="presentation">
                    <a class="nav-link active " href="{{ route('admin-dashboard.highSchoolResume.preview') }}" id="step7-tab">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <i class="fa-solid fa-check "></i>
                        <p>Preview</p>
                    </a>
                </li>
            </ul>
            <form class="js-validation" action="" method="POST">
                <div class="tab-content" id="myTabContent">
                    <div class="setup-content">
                        <h3>Step 7</h3>
                        <div class="d-flex justify-content-between mt-3">
                            <div class="prev-btn">
                                <a href="{{ route('admin-dashboard.highSchoolResume.featuresAttributes') }}" class="btn btn-alt-primary next-step"> Prev
                                </a>
                            </div>
                            <div class="next-btn">
                                <a href="" class="btn btn-alt-primary next-step"> Submit
                                </a>
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