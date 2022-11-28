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
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.featuresAttributes') }}"
                            id="step6-tab">
                            <i class="fa-solid fa-envelope d-none"></i>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <p>Featured <br> Attributes</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link active " href="{{ route('admin-dashboard.highSchoolResume.preview') }}"
                            id="step7-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Preview</p>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="setup-content">
                        <div class="header-area">
                            <h2>High School Resume</h2>
                            <p><a href="#">Home</a> > High School Resume</p>
                        </div>
                        <div class="mb-5">
                            <a href="{{ route('admin-dashboard.highSchoolResume.pdf.preview') }}" target="_blank" class="btn">SAVE RESUME AS FILE</a>
                        </div>
                        <div class="text-border">
                            <h1><span>Jon</span> Richards</h1>
                        </div>
                        <div id="printableArea">
                            <div class="row">
                                <div class="col-lg-3 preview-border">
                                    <div class="preview-leftside">
                                        <div class="preview-list mb-3">
                                            <h3>Contact</h3>
                                            <ul class="list">
                                                <li>Blash</li>
                                                <li>apt 211</li>
                                                <li>Forest Grove, OR,</li>
                                                <li>303-20-2-1010</li>
                                                <li>jon@jon.com</li>
                                                <li>FB</li>
                                            </ul>
                                        </div>
                                        <div class="preview-list mb-3">
                                            <h3>Featured Skills</h3>
                                            <ul class="list">
                                                <li>Blash</li>
                                                <li>Gamer</li>
                                                <li>treasurer </li>
                                            </ul>
                                        </div>
                                        <div class="preview-list mb-3">
                                            <h3>featured awards</h3>
                                            <ul class="list">
                                                <li>awarded</li>
                                                <li>yep</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="preview-rightside">
                                        <div class="preview-list mb-3">
                                            <h3>Education</h3>
                                            <ul class="list">
                                                <li>Freshman / CHS / Forecast Grove </li>
                                                <li>Diploma Designation : IB Diploma</li>
                                                <li>Weighted GPA: 8.89, Class Rank: 4/50</li>
                                                <li><span>IB Courses:</span> Social and Cultural Anthropology</li>
                                                <li><span>AP Courses:</span> AP Art and Design Program, Ap Chemistry, AP
                                                    Comparative Government and Politics</li>
                                                <li><span>Honors Courses:</span> asdfas, ASDFADSFD, bio</li>
                                                <li><span>Concurrent Courses:</span> fdsgsd-,DFASDF-,HELLO-,sdf-,college
                                                    english-</li>
                                            </ul>
                                        </div>
                                        <div class="preview-list mb-3">
                                            <h3>Activities</h3>
                                            <ul class="list">
                                                <li><span>intended College Major(s):</span> Accounting Technician, Actuarial
                                                    Science</li>
                                                <li><span>intended College Major(s):</span> Accounting Technician, Actuarial
                                                    Science,Adult Development & <br> aging/gerontology, Advertising,
                                                    Aerospace
                                                    Engineering Technologies</li>
                                                <li><span>Demostrated Interests in the Area of my College Major.</span> - St
                                                    Marles-DRHS--YEP</li>
                                                <li><span>Leadership:</span> 10-Atogned,., atonga </li>
                                                <li><span>Athletics:</span> - Tennis School, Letter </li>
                                            </ul>
                                        </div>
                                        <div class="preview-list mb-3">
                                            <h3>Employement </h3>
                                            <ul class="list">
                                                <li>10, Barisha, Starbucks, Deriver, CO</li>
                                            </ul>
                                        </div>
                                        <div class="preview-list mb-3">
                                            <h3>Certifications</h3>
                                            <ul class="list">
                                                <li>10. CPA AHA, 1st cert</li>
                                                <li>10, cpr aha abd</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
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
