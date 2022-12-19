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
                        <a class="nav-link " href="{{ route('admin-dashboard.highSchoolResume.activities') }}"
                            id="step4-tab">
                            <p class="d-none">4</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Activities</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.employmentCertification') }}"
                            id="step5-tab">
                            <p class="d-none">5</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Employment & <br> Certifications</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.featuresAttributes') }}"
                            id="step6-tab">
                            <p class="d-none">6</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Featured <br> Attributes</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link active" href="{{ route('admin-dashboard.highSchoolResume.preview') }}"
                            id="step7-tab">
                            <p>7</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Preview</h6>
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
                            <a href="{{ 'chrome-extension://oemmndcbldboiebfnladdacbdfmadadm/' . route('admin-dashboard.highSchoolResume.pdf.preview') }}"
                                target="_blank" class="btn btn-alt-primary">SAVE RESUME AS FILE</a>
                        </div>
                        <div class="printableArea">
                            <div class="text-border">
                                <h1><span>{{ $personal_info->first_name }}</span> {{ $personal_info->middle_name }}
                                    {{ $personal_info->last_name }}</h1>
                                    <p>Web Developer</p>
                            </div>
                            <div class="printableArea_main">
                                <div class="row">
                                    <div class="col-lg-5 preview-border p-0">
                                        <div class="preview-leftside ">
                                            <div class="preview-list position-relative ps-0 contact-list-after">
                                                <h3>Contact</h3>
                                                <ul class="list">
                                                    <li>
                                                        <span><i class="fa-solid fa-envelope-open-text"></i>
                                                        </span>{{ $personal_info->email }}
                                                    </li>
                                                    <li>
                                                        <span><i class="fa-solid fa-phone"></i>
                                                        </span>{{ $personal_info->cell_phone }}
                                                    </li>
                                                    <li class="d-flex"><span><i class="fa-solid fa-location-dot"></i>
                                                        </span>
                                                        <div class="ms-2">
                                                            <span class="d-block">Address1 / Address2 / Zip Code :</span>
                                                            {{ $personal_info->street_address_one }} 
                                                            <br>
                                                            {{ $personal_info->street_address_two }} 
                                                            <br>
                                                            {{ $personal_info->zip_code }}
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-2"><span><i
                                                                class="fa-solid fa-envelope-open-text"></i>
                                                        </span>
                                                        <div class="ms-2">
                                                            <span class="d-block">Parent Email 1 / Parent Email 2 :</span>
                                                            {{ $personal_info->parent_email_one }} 
                                                            {{ $personal_info->parent_email_two }}
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-2"><span><i class="fa-solid fa-location-dot"></i>
                                                        </span>
                                                        <div class="ms-2">
                                                            <span class="d-block">City / State :</span>
                                                            {{ $personal_info->city . ', ' . $personal_info->state }}
                                                        </div>
                                                    </li>
                                                    <li class="d-flex "><span> <i class="fa-solid fa-link"></i> </span>
                                                        <div class="ms-2">
                                                            <span class="d-block">Social Links :</span>
                                                            <div class="list_group">
                                                                <ul class="list_items">
                                                                    @foreach ($personal_info->social_links as $link)
                                                                        <li class="list-type">
                                                                            {{$link}}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>   
                                            </div>
                                            @if (!empty($featuredAttribute->featured_skills_data))
                                                <div class="preview-list ps-0 pb-3 position-relative features-list-before mb-0 border-bottom-0">
                                                    <h3>Features</h3>
                                                    <div class="preview-list_skill">
                                                        <h2>Featured Skills</h2>
                                                        <ul class="list">
                                                            @foreach (json_decode($featuredAttribute->featured_skills_data) as $featured_skills)
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        <li class="list-type">
                                                                            {{ $featured_skills->featured_skill }}
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (!empty($featuredAttribute->featured_awards_data))
                                                <div class="preview-list pb-3  position-relative features-list-after  ps-0 mb-0 border-bottom-0">
                                                    <div class="preview-list_skill">
                                                        <h2>Featured awards</h2>
                                                        <ul class="list">
                                                            @foreach (json_decode($featuredAttribute->featured_awards_data) as $featured_awards)
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        <li class="list-type">
                                                                            {{ $featured_awards->featured_award }}
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (!empty($featuredAttribute->featured_languages_data))
                                                <div class="preview-list pb-3 ps-0 ">
                                                    <div class="preview-list_skill ">
                                                        <h2>Featured languages</h2>
                                                        <ul class="list">
                                                            @foreach (json_decode($featuredAttribute->featured_languages_data) as $featured_languages)
                                                                <li>
                                                                    <div class="list_group">
                                                                        <ul class="list_items">
                                                                            <li class="list-type">
                                                                                {{ $featured_languages->featured_language }}
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (!empty($employmentCertification->significant_data))
                                                <div class="preview-list list_group  ps-0   pb-0 border-bottom-0">
                                                    <h3>Employment & Certifications</h3>
                                                    <ul class="list_items">
                                                        @php
                                                            $employment_data = json_decode($employmentCertification->employment_data);
                                                        @endphp
                                                                                                                     
                                                        @foreach ($employment_data as $data)
                                                        <li class="list-type">
                                                            <span>Job </span>
                                                            {{$data->job_title}} 
                                                            <span> with </span>
                                                            {{implode(',',(json_decode($data->employment_grade)))}} 
                                                        </li>
                                                        @endforeach
        
                                                        @foreach ($employment_data as $data)
                                                        <li class="list-type">
                                                            <span> Honor by  </span>
                                                            {{$data->employment_honor_award}} 
                                                            <span> at </span>
                                                            {{$data->employment_location}} 
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            @if (!empty($employmentCertification->employment_data))
                                                <div class="preview-list position-relative list_group ps-0 honor-list-after">
                                                    <h3>Responsibilities or interests</h3>
                                                    <ul class="list_items">
                                                        @php
                                                            $significant_data = json_decode($employmentCertification->significant_data);
                                                        @endphp
                                                                       
                                                        @foreach ($significant_data as $data)
                                                        <li class="list-type">
                                                            <span>Responsibility or interest :</span>
                                                            {{$data->responsibility_interest}} 
                                                            <span> with </span>
                                                            {{implode(',',(json_decode($data->significant_grade)))}} 
                                                        </li>
                                                        @endforeach
        
                                                        @foreach ($significant_data as $data)
                                                        <li class="list-type">
                                                            <span>Honor by</span>
                                                            {{$data->significant_honor_award}} 
                                                            <span> at </span>
                                                            {{$data->significant_location}} 
        
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            @if (!empty($honor))
                                                <div class="preview-list  ps-0">
                                                    <h3>Honor</h3>
                                                    <ul class="list">
                                                        <li>
                                                            <span>Honor Position : </span>
                                                            <div class="list_group">
                                                                <ul class="list_items">
                                                                    @php
                                                                        $honor_data = json_decode($honor->honors_data);
                                                                    @endphp
        
                                                                    @foreach ($honor_data as $data)
                                                                        <li class="list-type">
                                                                            {{$data->position}}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <span class="d-block">Achivement / Grade : </span>
                                                            <div class="list_group">
                                                                <ul class="list_items">
        
                                                                    @foreach ($honor_data as $data)
                                                                        <li class="list-type">
                                                                            {{$data->honor_achievement_award}} / 
                                                                            {{implode(',',(json_decode($data->grade)))}} 
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <span>Location : </span>
                                                            <div class="list_group">
                                                                <ul class="list_items">
        
                                                                    @foreach ($honor_data as $data)
                                                                        <li class="list-type">
                                                                            {{$data->location}} 
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-7 p-0">
                                        <div class="preview-rightside">
                                            @if (!empty($education))
                                                <div class="preview-list ">
                                                    <h3>Education</h3>
                                                    <ul class="list">
                                                        <li>
                                                            <span>
                                                                Graduated in high school :
                                                            </span> 
                                                            {{ $education->is_graduate == 1 ? 'Yes' : 'No' }} 
                                                        </li>
                                                            @if ($education->grade_level && $education->college_name != null)
                                                                <li>
                                                                    <span>
                                                                        {{$education->grade_level != '' ? 'Grade Level' : ''}} /
                                                                        {{$education->college_name != '' ? 'College name' : ''}} : 
                                                                    </span>
                                                                    {{ $education->grade_level != '' ? $education->grade_level : ''}} /
                                                                    {{ $education->grade_level != '' ? $education->college_name : ''}}
                                                                </li>
                                                            @endif
                                                            @if ($education->college_city && $education->college_state != '')
                                                                <li>
                                                                    <span>
                                                                        {{$education->college_city != '' ? 'College City ' : ''}} /
                                                                        {{$education->college_state != '' ? 'College State' : ''}} :
                                                                    </span>
                                                                    {{ $education->college_city != '' ? $education->college_city : ''}} /
                                                                    {{ $education->college_state != '' ? $education->college_state : ''}}
                                                                </li>
                                                            @endif
                                                        <li>
                                                            <span class="d-block mb-2">School Name / City / State /
                                                                District :
                                                            </span>
                                                            {{ $education->high_school_name }} /
                                                            {{ $education->high_school_city }} /
                                                            {{ $education->high_school_state }} /
                                                            {{ $education->high_school_district }}
                                                        </li>
                                                        <li><span>Current Grade / Month / Year :
                                                            </span>{{ $education->current_grade }} /
                                                            {{ $education->month }} / {{ $education->year }}
                                                        </li>
        
                                                        <li> <span> Weighted GPA / Unweighted GPA :</span>
                                                            {{ $education->cumulative_gpa_weighted }} /
                                                            {{ $education->cumulative_gpa_unweighted }}
                                                        </li>
                                                        <li>
                                                            <span>Class Rank / Number of Student : </span>
                                                            {{ $education->class_rank }} /
                                                            {{ $education->total_no_of_student }}
                                                        </li>
                                                        @if (!empty($education->ib_courses))
                                                            <li>
                                                                <span>IB Courses:</span>
                                                                @foreach ($ib_courses as $course)
                                                                    {{$course->name}},
                                                                @endforeach
        
                                                            </li>
                                                        @endif
                                                        @if (!empty($education->ap_courses))
                                                            <li>
                                                                <span>AP Courses:</span>
                                                                @foreach ($ap_courses as $course)
                                                                    {{$course->name}},                                                              
                                                                @endforeach
                                                            </li>
                                                        @endif
                                                        @if (!empty($education->honor_course_data))
                                                            <li>
                                                                <span> Honors Course :</span>
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        @php
                                                                            $honor_course_data = json_decode($education->honor_course_data);
                                                                        @endphp
                                                                        @foreach ($honor_course_data as $data)
                                                                            <li class="list-type">
                                                                                {{$data->honor_course_name}}
                                                                            </li>
                                                                        @endforeach
                                                                        {{-- <li class="list-type"> 
                                                                        @php
                                                                            $honor_course_data = json_decode($education->honor_course_data);
                                                                            $honor_course_data_arr = \App\Helpers\Helper::objectToArray($honor_course_data);
                                                                        @endphp
                                                                            {{ \App\Helpers\Helper::convertMultidimensionalToString($honor_course_data_arr, 'honor_course_name', ', ') }}
                                                                        </li> --}}
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        @endif
                                                        @if (!empty($education->course_data))
                                                        <li>
                                                            <span>Course and College name: </span>
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        @php
                                                                            $course_data = json_decode($education->course_data);
                                                                        @endphp
                                                                        @foreach ($course_data as $data)
                                                                            <li class="list-type">
                                                                                {{$data->course_name}} /
                                                                                {{$data->search_college_name}}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        @endif
                                                        @if (!empty($education->testing_data))
                                                            <li>
                                                                <span class="d-block mb-2">Name and Date of Test:</span>
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        @php
                                                                            $testing_data = json_decode($education->testing_data);
                                                                        @endphp
                                                                        @foreach ($testing_data as $data)
                                                                            <li class="list-type">
                                                                                {{$data->name_of_test}} /
                                                                                {{$data->date}}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        @endif
                                                        <li>
                                                            @if (isset($education->intended_college_major))
                                                            <li>
                                                                <span>Intended College Major(s):</span>
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        <li class="list-type">
                                                                            {{ $education->intended_college_major }}
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        @endif
                                                        @if (isset($education->intended_college_major))
                                                            <li>
                                                                <span>Intended College Minor(s):</span>
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        <li class="list-type">
                                                                            {{ $education->intended_college_minor }}
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                            
                                            @if (!empty($activity))
                                                <div class="preview-list ">
                                                    <h3>Activities</h3>
                                                    <ul class="list">
                                                        @if (!empty($activity->demonstrated_data))
                                                            <li>
                                                                <span class="d-block">Demostrated Interests and
                                                                    Position in the Area of my College
                                                                    Major :</span>
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        @php
                                                                            $demonstrated_data = json_decode($activity->demonstrated_data);
                                                                        @endphp
                                                                        @foreach ($demonstrated_data as $data)
                                                                            <li class="list-type">
                                                                                {{$data->interest}} /
                                                                                {{$data->position}}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <span class="d-block">Grade and Location with Details :
                                                                </span>
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        @foreach ($demonstrated_data as $data)
                                                                            <li class="list-type">
        
                                                                                {{implode(',',(json_decode($data->grade)))}} 
                                                                                {{$data->location}} /
                                                                                {{$data->details}}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        @endif
                                                        @if (!empty($activity->leadership_data))
                                                            <li>
                                                                <span>Leadership status with Position : </span>
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        @php
                                                                            $leadership_data = json_decode($activity->leadership_data);
                                                                        @endphp
                                                                        @foreach ($leadership_data as $data)
                                                                            <li class="list-type">
                                                                                {{$data->leadership_status}} /
                                                                                {{$data->leadership_position}}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                               </div>
                                                            </li>
                                                            <li>
                                                                <span>Leadership organized By :</span>
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        @foreach ($leadership_data as $data)
                                                                            <li class="list-type">
                                                                                {{$data->leadership_organization}} /
                                                                                {{$data->leadership_location}}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        @endif
                                                        @if (!empty($activity->athletics_data))
                                                            <li>
                                                                <span>Athletics status with Position : </span>
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        @php
                                                                            $athletics_data = json_decode($activity->athletics_data);
                                                                        @endphp
                                                                        @foreach ($athletics_data as $data)
                                                                            <li class="list-type">
                                                                                {{$data->athletics_activity}} /
                                                                                {{$data->athletics_position}}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <span>Athletics honor by :</span>
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        @foreach ($athletics_data as $data)
                                                                            <li class="list-type">
                                                                                {{$data->athletics_honor}} /
                                                                                {{$data->athletics_location}}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        @endif
        
                                                        @if (!empty($activity->activities_data))
                                                            <li>
                                                                <span>Activity with Position : </span>
                                                                <div class="list_group">
                                                                    <ul class="list_items">
        
                                                                        @php
                                                                            $activities_data = json_decode($activity->activities_data);
                                                                        @endphp
                                                                        @foreach ($activities_data as $data)
                                                                            <li class="list-type">
                                                                                {{$data->activity}} /
                                                                                {{$data->activity_position}}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <span>Activity honor by :</span>
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        @foreach ($activities_data as $data)
                                                                            <li class="list-type">
                                                                                {{$data->activity_honor_award}} /
                                                                                {{$data->activity_location}}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        @endif
        
                                                        @if (!empty($activity->community_service_data))
                                                            <li>
                                                                <span>Participation and service : </span>
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        @php
                                                                            $community_service_data = json_decode($activity->community_service_data);
                                                                        @endphp
                                                                        @foreach ($community_service_data as $data)
                                                                            <li class="list-type">
                                                                                {{$data->participation_level}} /
                                                                                {{$data->community_service}}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <span>Community Located at : </span>
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        @foreach ($community_service_data as $data)
                                                                            <li class="list-type">
                                                                                {{$data->community_location}}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <div class="prev-btn next-btn">
                        <a href="{{ route('admin-dashboard.highSchoolResume.featuresAttributes') }}"
                            class="btn btn-alt-success prev-step"> Previous
                        </a>

                    </div>
                    <div class="next-btn">
                        <a href="{{ route('admin-dashboard.highSchoolResume.resume.complete') }}"
                            class="btn btn-alt-success submit_btn">Submit</a>

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
