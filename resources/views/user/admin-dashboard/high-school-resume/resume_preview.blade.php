<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HSR | Resume Preview : CPS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0 !important;
            padding: 0 !important;
        }

        .preview-left {
            width: 320px;
            border-right: 2px solid #a8a8a8;
            vertical-align: top;
            display: inline-block !important;

        }
      

        .preview-list_skill h2 {
            font-size: 12px;
            color: #45464b;
            font-weight: 700;
            margin-bottom: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;

        }
        
        @page {
            margin: 10px 0;
            padding: 0;
        }

        .preview-right {
            width: 350px;
            vertical-align: top;
            display: inline-block !important;
        }


        .preview-list h3 {
            font-size: 12px;
            color: #45464b;
            font-weight: 700;
            margin-bottom: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .span_text {
            margin-right: 0;
            display: block;
            text-align: left;
            color: #45464b;
            cursor: unset;
            position: relative;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .list-type {
            display: block;
            position: relative;
            padding-left: 30px;
            font-size: 12px;
            color: #45464b;
            width: 250px; 
            word-break:break-all;
            word-wrap:break-word;
            padding-right: 20px
        }

        .list-type:before {
            content: "";
            width: 6px;
            height: 6px;
            background-color: #777777;
            border-radius: 50%;
            position: absolute;
            top: 5px;
            left: 15px;
        }

        .border-bottom {
            border-bottom: 2px solid #a8a8a8;
        }

        .contact-list-after{
            position: relative;
        }
        .contact-list-after:after {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #fff;
            z-index: 999;
            right: -11px;
            top: 150px;
            position: absolute;
            content: "";
            border: 2px solid #a8a8a8;
        }

        .features-list-after{
            position: relative;
        }
        .features-list-after:after {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #fff;
            z-index: 999;
            right: -11px;
            top: 185px;
            position: absolute;
            content: "";
            border: 2px solid #a8a8a8;
        }
        .honor-list-after{
            position: relative;
        }
        .honor-list-after:after {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #fff;
            z-index: 999;
            right: -11px;
            top: -23px;
            position: absolute;
            content: "";
            border: 2px solid #a8a8a8;
        } 

        .activity-list-after{
            position: relative;
        }
        .activity-list-after:after {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #fff;
            z-index: 999;
            left: -15px;
            top: -23px;
            position: absolute;
            content: "";
            border: 2px solid #a8a8a8;
        } 

        .span_list {
            width: 20px;
            height: 20px;
            background-color: #ebeef2;
            text-align: center;
            border-radius: 50%;
            color: #45464b;
            border: unset;
            margin-right: 5px;
            position: relative;
            display: inline-block;
            margin-top: -10px;
            position: relative;
            top: 10px;
            margin-bottom: 5px
        }

        .list img {
            width: 8px;
            height: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

        }

        .d-block {
            display: block;
        }

        .d-inline-block {
            display: inline-block !important;
            font-size: 12px
        }

        .span_call {
            position: relative;
            top: 12px;
        }

        .span_mail {
            position: relative;
            top: -20px;
        }

        .span_location {
            position: relative;
            top: -30px;
        }

        .span_link {
            position: relative;
            top: -10px;
        }

        .span_location2 {
            position: relative;
            top: -15px;

        }

        .span-text span {
            font-weight: normal
        }

        .position-relative {
            position: relative;
        }

        .d-block {
            display: block !important;
        }

        .span_bold {
            font-weight: bold;
        }

        .span_h2 {
            font-size: 12px;
            margin-bottom: 5px;
            color: #45464b;
            font-weight: bold;
        }

        table {
            page-break-before: avoid;
        }

        .ps-0 {
            padding-left: 0 !important;
        }

        .clear-both {
            padding: 0 50px;
            /* page-break-inside: avoi  d; */
        }

        .pb-3 {
            padding-bottom: 10px;
        }

        .preview-list {
            padding-left: 20px
        }
    </style>
</head>

<body>
    <div style="margin-bottom: 0">
        <p
            style="font-weight:400; padding:10px 50px 10px;background-color: #f4f4f4; text-align:left;color: #43464c;font-size:2.25rem;margin-top: 0">
            <b>{{ $personal_info->first_name }}<b>  {{ $personal_info->middle_name }} {{ $personal_info->last_name }} {{ isset($personal_info->nick_name) && $personal_info->nick_name != null ? "(" .$personal_info->nick_name. ")" : ''}}
                </b>
        </p>
    </div>
    <div class="clear-both" style="margin-top: -20px">
        <div class="preview-left col-lg-6">
            <div class="preview-list border-bottom d-block ps-0 contact-list-after">
                <h3>Contact</h3>
                <span class="list">
                    @if(isset($personal_info->email))
                        <span class="span_text">
                            <span class="span_list">
                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/email.svg'))) }}">
                            </span>
                            {{ $personal_info->email }}
                        </span>
                    @endif
                    @if(isset($personal_info->cell_phone))
                        <span class="span_text">
                            <span class="span_list span_call">
                                <img
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/phone-solid.svg'))) }}">
                            </span>
                            {{ $personal_info->cell_phone }}
                        </span>
                    @endif
                    @if(isset($personal_info->street_address_one) || isset($personal_info->street_address_two) || isset($personal_info->zip_code))
                        <span class=" d-inline-block span_text">
                            <span class="span_list span_location2">
                                <img
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/location.svg'))) }} ">
                            </span>
                            <span style="width: 200px;margin-top: 10px;" class="d-inline-block">
                                <span class="d-block span_bold">Address1 / Address2 / Zip Code :</span>
                                {{ $personal_info->street_address_one }}
                                @if(isset($personal_info->street_address_one)) <br /> @endif
                                {{ $personal_info->street_address_two }}
                                @if(isset($personal_info->street_address_two)) <br /> @endif
                                {{ $personal_info->zip_code }}
                            </span>
                        </span>
                    @endif
                    @if(isset($personal_info->city) || isset($personal_info->state))
                        <span class="d-inline-block">
                            <span class="span_list span_location">
                                <img
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/location.svg'))) }} ">
                            </span>
                            <span class="d-inline-block span_text" style="width: 180px;margin-top: 0;">
                                <span class="d-block span_bold">City / State: </span>
                                <span class="span_text">
                                    {{ $personal_info->city . ' / ' . $personal_info->state }} </span>
                            </span>
                        </span>
                    @endif
                    @if ($social_links != null)
                        <span class="d-inline-block">
                            <span class="span_list span_link">
                                <img
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/link.svg'))) }} ">
                            </span>
                            <span class="d-inline-block span_text" style="width: 180px;margin-top: 0px">

                                <span class="d-block span_bold">Social Links :</span>
                                @foreach ($social_links as $link)
                                    <span class="list-type">
                                        {{ $link }}
                                    </span>
                                @endforeach
                            </span>
                        </span>
                    @endif
                </span>
              
            </div>
            @if (!empty($featured_skills_data) || !empty($featured_awards_data) || !empty($featured_languages_data) || !empty($dual_citizenship_data))
                <div class="border-bottom d-block " >
                    @if (!empty($featured_skills_data))
                        <div class="pb-3 border-bottom-0 preview-list ps-0 features-list-after ">
                            @if ($featuredAttribute)
                                <h3>Features</h3>
                            @endif
                            <div class="preview-list_skill ">
                                @if ($featuredAttribute->featured_skills_data[0]['skill'] != null)
                                    <span class="span_h2">Featured Skills</span>
                                    @foreach ($featuredAttribute->featured_skills_data as $featured_skills)
                                        <span class="list-type">
                                            {{ $featured_skills['skill'] }}
                                        </span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endif
                    @if (!empty($featured_awards_data))
                        <div class="preview-list pb-3  ps-0 border-bottom-0">
                            <div class="preview-list_skill">
                                @if ($featuredAttribute->featured_awards_data[0]['award'] != null)
                                    <span class="span_h2">Featured awards</span>
                                    @foreach ($featuredAttribute->featured_awards_data as $featured_awards)
                                        <span class="list-type">
                                            {{ $featured_awards['award'] }}
                                        </span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endif
                    @if (!empty($featured_languages_data))
                        <span class="preview-list">
                            <span class="preview-list_skill">
                                <span class="span_h2">Featured languages</span>
                                @foreach ($featuredAttribute->featured_languages_data as $featured_languages)
                                    <span class="list-type">
                                        {{ $featured_languages['language'] }}
                                    </span>

                                @endforeach
                            </span>
                        </span>
                    @endif
                    @if (!empty($dual_citizenship_data))
                        <span class="preview-list"
                            style="margin-top: 10px;display: inline-block;padding-left: 0;margin-bottom: 10px;">
                            <span class="preview-list_skill ">
                                <span class="span_h2">Dual Citizen</span>
                                @foreach ($featuredAttribute->dual_citizenship_data as $dual_citizenship)
                                    <span class="list-type">
                                        {{ $dual_citizenship['country'] }}
                                    </span>
                                @endforeach
                            </span>
                        </span>
                    @endif
                </div>
            @endif

            @if (!empty($employment_data) | !empty($significant_data))
                <div class="border-bottom d-block">
                    @if (!empty($employment_data)) 
                        <span class="preview-list">
                            <h3>Employment & Certifications</h3>
                            <span class="span_h2"> Name Of The Company:</span>
                            <span style="margin-bottom: 5px;display: block">
                                @foreach ($employment_data as $data)
                                @if(!is_null($data['name_of_company']))
                                    <span class="list-type">
                                            {{ $data['name_of_company'] }}
                                        </span>
                                    @endif
                                @endforeach
                            </span>
                            <span class="span_h2"> Job Title</span>
                            <span style="margin-bottom: 5px;display: block">
                                @foreach ($employment_data as $data)
                                    @if(!is_null($data['job_title']))
                                        <span class="list-type">
                                            {{ $data['job_title'] }}
                                        </span>
                                    @endif
                                @endforeach
                            </span>
                            <span class="span_h2">Grade(s)</span>
                            <span style="display: block;margin-bottom: 5px">
                                @foreach ($employment_data as $data)
                                    @if(isset($data['grade']) && !empty($data['grade']))
                                        <span class="list-type">
                                            {{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}
                                        </span>
                                    @endif
                                @endforeach
                            </span>
                        </span>
                    @endif
                    @if (!empty($significant_data)) 
                        <span class="preview-list">
                            <h3>RESPONSIBILITIES OR INTERESTS</h3>
                            <span class="span_h2"> Responsibility Or Interest:</span>
                            <span style="margin-bottom: 5px; display: block">
                                @foreach ($significant_data as $data)
                                    @if(isset($data['interest']) && !empty($data['interest']))
                                        <span class="list-type">
                                            {{ $data['interest'] }}
                                        </span>
                                    @endif
                                @endforeach
                            </span>
                            <span class="span_h2">Grade(s)</span>
                            <span style="margin-bottom: 10px;display: block">
                                @foreach ($significant_data as $data)
                                    @if(isset($data['grade']) && !empty($data['grade']))
                                        <span class="list-type">
                                            {{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}
                                        </span>
                                    @endif
                                @endforeach
                            </span>
                        </span>
                    @endif
                </div>
            @endif

            @if (!empty($honor))
                <div class="preview-list honor-list-after">
                    <h3>HONORS</h3>
                    <span style="margin-bottom: 5px;display: block">
                        <span class="span_h2">Position</span>
                        @foreach ($honor->honors_data as $honor_data)
                            <span class="list-type">
                                {{ $honor_data['position'] }}
                            </span>
                        @endforeach
                    </span>
                    <span style="margin-bottom: 5px;display: block">
                        <span class="span_h2">Achivement</span>
                        @foreach ($honor->honors_data as $honor_data)
                            <span class="list-type">
                                {{ $honor_data['honor_achievement_award'] }}
                            </span>
                        @endforeach
                    </span>
                    <span style="margin-bottom: 5px;display: block">
                        <span class="span_h2">Grade(s)</span>
                        @foreach ($honor->honors_data as $honor_data)
                            <span class="list-type">
                                @if(isset($honor_data['grade']) && !empty($honor_data['grade']))
                                    {{ \App\Helpers\Helper::getGradeByIdArray($honor_data['grade']) }}
                                @endif
                            </span>
                        @endforeach
                    </span>
                    <span style="margin-bottom: 5px;display: block">
                        <span class="span_h2">Location</span>
                        @foreach ($honor->honors_data as $honor_data)
                            <span class="list-type">
                                {{ $honor_data['location'] }}
                            </span>
                        @endforeach
                    </span>
                </div>
            @endif
        </div>
        <div class="preview-right">
            @if (!empty($education))
                <span class="preview-list d-block {{ (!empty($activity)) ? 'border-bottom' : '' }}">
                    <h3>Education</h3>
                    <span>
                        <span class="span_text">
                            <span class="span_bold">
                                Graduated in high school :
                            </span>
                            {{ $education->is_graduate == 1 ? 'Yes' : 'No' }}
                        </span>
                        @if ($education->grade_level && $education->college_name != null)
                            <span class="span_text">
                                <span class="span_bold">
                                    {{ $education->grade_level != '' ? 'Grade Level' : '' }} /
                                    {{ $education->college_name != '' ? 'College name' : '' }} :
                                </span>
                                {{ $education->grade_level != '' ? $education->grade_level : '' }} /
                                {{ $education->grade_level != '' ? $education->college_name : '' }}
                            </span>
                        @endif
                        @if ($education->college_city && $education->college_state != '')
                            <span class="span_text">
                                <span class="span_bold">
                                    {{ $education->college_city != '' ? 'College City ' : '' }} /
                                    {{ $education->college_state != '' ? 'College State' : '' }} :
                                </span>
                                {{ $education->college_city != '' ? $education->college_city : '' }} /
                                {{ $education->college_state != '' ? $education->college_state : '' }}
                            </span>
                        @endif
                        <span class="span_text">
                            <span class="d-block mb-2 span_bold">School Name / City / State /
                                District :
                            </span>
                            {{ $education->high_school_name }} /
                            {{ $education->high_school_city }} /
                            {{ $education->high_school_state }} /
                            {{ $education->high_school_district }}
                        </span>
                        <span class="span_text">
                            <span class="span_bold">Current Grade :
                            </span>{{ implode(',', $current_grade) }}
                        </span>
                        <span class="span_text">
                            <span class="span_bold">Month / Year :
                            </span>
                            {{ $education->month }} / {{ $education->year }}
                        </span>
                        @if (!empty($education->cumulative_gpa_weighted) || !empty($education->cumulative_gpa_unweighted))
                            <li class="span_text">
                                <span class="span_bold"> Weighted GPA / Unweighted GPA :</span>
                                {{ $education->cumulative_gpa_weighted }} /
                                {{ $education->cumulative_gpa_unweighted }}
                            </li>
                        @endif
                        @if (!empty($education->class_rank) || !empty($education->total_no_of_student))
                            <li class="span_text">
                                <span class="span_bold">Class Rank / Number of Student : </span>
                                {{ $education->class_rank }} /
                                {{ $education->total_no_of_student }}
                            </li>
                        @endif
                        @if (!empty($education->ib_courses))
                            <span class="span_text">
                                <span class="span_bold">IB Courses:</span>
                                <span class="list-type">
                                    {{ implode(',', $ib_courses) }}
                                </span>
                            </span>
                        @endif
                        @if (!empty($education->ap_courses))
                            <span class="span_text">
                                <span class="span_bold">AP Courses:</span>
                                <span class="list-type">
                                    {{ implode(',', $ap_courses) }}
                                </span>
                            </span>
                        @endif
                        @if (!empty($education->honor_course_data))
                            <span class="span_text">
                                <span class="span_bold">Honors Course :</span>

                                @foreach ($education->honor_course_data as $honor_course_data)
                                    @foreach ($education->honor_course_data as $honor_course_data)
                                        @if(isset($honor_course_data['course_data']) && !empty($honor_course_data['course_data']))
                                            <span class="list-type" >
                                                {{ \App\Helpers\Helper::getHonorCourseByIdArray($honor_course_data['course_data']) }}
                                            </span>
                                        @endif
                                    @endforeach
                                @endforeach
                            </span>
                        @endif
                        @if (!empty($course_data))
                            <span class="span_text">
                                <span class="span_bold">Course and College name: </span>
                                @foreach ($college_list as $college)
                                    <div>
                                        - {{\App\Helpers\Helper::getCollegeNameByIdArray($college)}} 
                                        @foreach ($education->course_data as $course_data)
                                            @if(isset($course_data['search_college_name']))
                                                @if (in_array($college, $course_data['search_college_name']))
                                                    @if (isset($course_data['course_name']))      
                                                        <li class="list-type">
                                                            {{$course_data['course_name']}}
                                                        </li>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </span>
                        @endif
                        @if (!empty($testing_data))
                            <span class="span_text">
                                <span class="d-block span_bold mb-2">Name and Date of Test:</span>

                                @foreach ($testing_data as $data)
                                    <span class="list-type">
                                        {{ isset($data['name_of_test']) ? $data['name_of_test'] : '' }}
                                        {{ isset($data['name_of_test']) && isset($data['date']) ? '/' : '' }}
                                        {{ isset($data['date']) ? $data['date'] : '' }}
                                    </span>
                                @endforeach

                            </span>
                        @endif
                        <span>
                            @if (!empty($intended_major))
                                <span class="span_text">
                                    <span class="span_bold">Intended College Major(s):</span>
                                    <span class="list-type">
                                        {{ implode(',', $intended_major) }}
                                    </span>
                                </span>
                            @endif
                            @if (!empty($intended_major))
                                <span class="span_text">
                                    <span class="span_bold">Intended College Minor(s):</span>
                                    <span class="list-type">
                                        {{ implode(',', $intended_minor) }}
                                    </span>
                                </span>
                            @endif
                        </span>
                    </span>
                </span>
            @endif
            @if (!empty($activity))
                <div class="preview-list d-block activity-list-after">
                    <h3>Activities</h3>
                    @if (!empty($demonstrated_data))
                            <span class="d-block mb-3 span_h2">
                                Demostrated Interests Major
                            </span>
                            <span class="span_h2" >Position:</span>
                                @foreach ($demonstrated_data as $data)
                                    <span class="list-type">
                                        {{ $data['position'] }}
                                    </span>
                                @endforeach
                            <span class="span_h2">Interest:</span>
                                @foreach ($demonstrated_data as $data)
                                    <span class="list-type">
                                        {{ $data['interest'] }}
                                    </span>
                                @endforeach
                            <span class="span_h2">Grade(s):</span>
                                @foreach ($demonstrated_data as $data)
                                    <span class="list-type">
                                        {{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}
                                    </span>
                                @endforeach
                            <span class="span_h2">Details:</span>
                                @foreach ($demonstrated_data as $data)
                                    <span class="list-type">
                                        {{ $data['details'] }}
                                    </span>
                                @endforeach
                    @endif
                            
                    @if(!empty($leadership_data))   
                        <span style="margin-bottom: 5px;display: block">
                            <span class="span_h2">Leadership</span>
                            @php
                                $leadership_array = [];
                            @endphp
                            @foreach($leadership_data as $data)
                                @php
                                    if(isset($data['status'])){
                                        $leadership_array['status'][] = $data['status'];
                                    }
                                    if(isset($data['position'])){
                                        $leadership_array['position'][] = $data['position'];
                                    }
                                    if(isset($data['organization'])){
                                        $leadership_array['organization'][] = $data['organization'];
                                    }
                                    if(isset($data['grade'])){
                                        $leadership_array['grade'][] = $data['grade'];
                                    }
                                @endphp
                            @endforeach
                            @if(!empty($leadership_array['status']))
                                <span class="list-type">
                                    <span class="span_h2">Status:</span>
                                    {{ implode(",", $leadership_array['status']) }}
                                </span>
                            @endif
                            @if(!empty($leadership_array['position']))
                                <span class="list-type">
                                    <span class="span_h2">Position:</span>
                                    {{ implode(",", $leadership_array['position']) }}
                                </span>
                            @endif
                            @if(!empty($leadership_array['organization']))
                                <span class="list-type">
                                    <span class="span_h2">Organization:</span>
                                    {{ implode(",", $leadership_array['organization']) }}
                                </span>
                            @endif
                            @if(!empty($leadership_array['grade']))
                                <span class="list-type">
                                    <span class="span_h2">Grade(s):</span>
                                    {{ \App\Helpers\Helper::getGradeAllByIdArray($leadership_array['grade']) }}
                                </span>
                            @endif
                        </span>
                    @endif
                    @if(!empty($activities_data))    
                        <span style="margin-bottom: 5px;display: block">
                            <span class="span_h2">Activities & Clubs</span>
                            @php
                                $activities_array = [];
                            @endphp
                            @foreach ($activities_data as $data)
                                @php
                                    if(isset($data['position'])){
                                        $activities_array['position'][] = $data['position'];
                                    }
                                    if(isset($data['activity'])){
                                        $activities_array['activity'][] = $data['activity'];
                                    }
                                    if(isset($data['honor_award'])){
                                        $activities_array['honor_award'][] = $data['honor_award'];
                                    }
                                    if(isset($data['grade'])){
                                        $activities_array['grade'][] = $data['grade'];
                                    }
                                @endphp
                            @endforeach
                            @if(!empty($data['position']))
                                <span class="list-type">
                                    <span class="span_h2">Position:</span>
                                    {{ implode(",", $activities_array['position']) }}
                                </span>
                            @endif
                            @if(!empty($data['activity']))
                                <span class="list-type">
                                    <span class="span_h2">Activity:</span>
                                    {{ implode(",", $activities_array['activity']) }}
                                </span>
                            @endif
                            @if(!empty($data['honor_award']))
                                <span class="list-type">
                                    <span class="span_h2">Honor/Award:</span>
                                    {{ implode(",", $activities_array['honor_award']) }}
                                </span>
                            @endif
                            @if(!empty($data['grade']))
                                <span class="list-type">
                                    <span class="span_h2">Grade(s):</span>
                                    {{ \App\Helpers\Helper::getGradeAllByIdArray($activities_array['grade']) }}
                                </span>
                            @endif
                        </span>
                    @endif
                    @if(!empty($athletics_data))  
                        <span style="margin-bottom: 5px;display: block">
                            <span class="span_h2">Athletics</span>
                            @php
                                $athletics_array = [];
                            @endphp
                            @foreach ($athletics_data as $data)
                                @php
                                    if(isset($data['position'])){
                                        $athletics_array['position'][] = $data['position'];
                                    }
                                    if(isset($data['activity'])){
                                        $athletics_array['activity'][] = $data['activity'];
                                    }
                                    if(isset($data['grade'])){
                                        $athletics_array['grade'][] = $data['grade'];
                                    }
                                    if(isset($data['honor'])){
                                        $athletics_array['honor'][] = $data['honor'];
                                    }
                                @endphp
                            @endforeach
                            @if(isset($data['position']))
                                <span class="list-type">
                                    <span class="span_h2">Position:</span>
                                    {{ implode(",", $athletics_array['position']) }}
                                </span>
                            @endif
                            @if(isset($data['activity']))
                                <span class="list-type">
                                    <span class="span_h2">Activity:</span>
                                    {{ implode(",", $athletics_array['activity']) }}
                                </span>
                            @endif
                            @if(!empty($data['grade']))
                                <span class="list-type">
                                    <span class="span_h2">Grade(s):</span>
                                    {{ \App\Helpers\Helper::getGradeAllByIdArray($athletics_array['grade']) }}
                                </span>
                            @endif
                            @if(isset($data['honor']))
                                <span class="list-type">
                                    <span class="span_h2">Honor:</span>
                                    {{ implode(",", $athletics_array['honor']) }}
                                </span>
                            @endif
                        </span>
                    @endif
                    @if(!empty($community_service_data))    
                        <span style="margin-bottom: 5px;display: block">
                            <span class="span_h2">Community Service / Volunteerism</span>
                            @php
                                $community_service_array = [];
                            @endphp
                            @foreach ($community_service_data as $data)
                                @php
                                    if(isset($data['level'])){
                                        $community_service_array['level'][] = $data['level'];
                                    }
                                    if(isset($data['service'])){
                                        $community_service_array['service'][] = $data['service'];
                                    }
                                    if(isset($data['grade'])){
                                        $community_service_array['grade'][] = $data['grade'];
                                    }
                                @endphp
                            @endforeach
                            @if(isset($data['level']))
                                <span class="list-type">
                                    <span class="span_h2">Participation Level:</span>
                                    {{ implode(",", $community_service_array['level']) }}
                                </span>
                            @endif
                            @if(isset($data['service']))
                                <span class="list-type">
                                    <span class="span_h2">Service:</span>
                                    {{ implode(",", $community_service_array['service']) }}
                                </span>
                            @endif
                            @if(isset($data['grade']) && !empty($data['grade']))
                                <span class="list-type">
                                    <span class="span_h2">Grade(s):</span>
                                    {{ \App\Helpers\Helper::getGradeAllByIdArray($community_service_array['grade']) }}
                                </span>
                            @endif
                        </span>
                    @endif
                </div>
            @endif
        </div>
    </div>

</body>

</html>
