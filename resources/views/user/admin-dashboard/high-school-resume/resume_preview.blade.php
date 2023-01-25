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
            height: 100%;

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

        .list-text {
            display: block;
            position: relative;
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
            background-color: #fff !important;
            z-index: 999;
            right: -11px;
            top: 150px;
            position: absolute;
            content: "";
            border: 2px solid #a8a8a8;
            z-index: 9999;
        }

        .features-list-after{
            position: relative;
        }
        .features-list-after:after {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #fff !important;
            z-index: 999;
            right: -11px;
            top: 145px;
            position: absolute;
            content: "";
            border: 2px solid #a8a8a8;
            z-index: 9999;
        }
        .honor-list-after{
            position: relative;
        }
        .honor-list-after:after {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #fff !important;
            z-index: 999;
            right: -11px;
            top: -23px;
            position: absolute;
            content: "";
            border: 2px solid #a8a8a8;
            z-index: 9999;
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
    .responsible-list-after{
    position: relative;

    }
    .responsible-list-after:after {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #fff;
            z-index: 999;
            right: -380px;
            margin-top: -10px;
            /* top: 420px; */
            position: absolute;
            content: "";
            border: 2px solid #a8a8a8;
        }
        .employ-list-after{
            position: relative;
        }
        .employ-list-after:after {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #fff;
            z-index: 999;
            right: -10px;
            margin-top: -10px;
            /* top: 110px; */
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

        .span_list  img {
            width: 8px;
            height: auto;
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-55%, -50%);

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

        /* .preview-list {
            padding-left: 20px
        } */
    </style>
</head>

<body>
    <div style="margin-bottom: 0">
        <div
            style="font-weight:400; padding:10px 50px 10px;background-color: #f4f4f4; text-align:left;color: #43464c;font-size:2.25rem;margin-top: 0">
            <b>{{ $personal_info->first_name }}<b> {{ $personal_info->middle_name }} {{ $personal_info->last_name }} {{ isset($personal_info->nick_name) && $personal_info->nick_name != null ? "(" .$personal_info->nick_name. ")" : ''}}
                </b>
            <span style="display: block; font-size: 12px; margin-top: 10px; margin-bottom: 10px; font-weight: 400">
                @if(isset($personal_info->street_address_one) || isset($personal_info->street_address_two) || isset($personal_info->zip_code))
                    <li style="display: flex">
                        <span class="span_list">
                            <img
                                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/location.svg'))) }} " style="width: 8px; margin-top: 2px">
                        </span>
                        <span>
                            {{ isset($personal_info->street_address_one) ? $personal_info->street_address_one : '' }}
                            @if(isset($personal_info->street_address_one)),  @endif
                            {{ isset($personal_info->street_address_two) ? $personal_info->street_address_two : '' }}
                            @if(isset($personal_info->street_address_two)), @endif
                            {{ $personal_info->city . ',' . $personal_info->state }}
                            {{ isset($personal_info->zip_code) ? $personal_info->zip_code : '' }}
                        </span>
                    </li>
                @endif  
            </span>
            <p style="display: inline-block !important; font-size: 12px; margin-top: 5px; font-weight: 400">
                <span style="display: inline-block">
                    @if(isset($personal_info->email))
                        <span class="span_text">
                            <span class="span_list">
                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/email.svg'))) }}" style="width: 8px; margin-top: 2px">
                            </span>
                            {{ $personal_info->email }}
                        </span>
                    @endif
                </span>
                <span style="display: inline-block">
                    @if(isset($personal_info->cell_phone))
                        <span class="span_text">
                            <span class="span_list">
                                <img
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/phone-solid.svg'))) }}" style="width: 8px; margin-top: 2px">
                            </span>
                            {{ $personal_info->cell_phone }}
                        </span>
                    @endif
                </span>
                <span style="display: inline-block">
                    @if ($social_links != null)
                    <span class="d-inline-block">
                        <span class="span_list">
                            <img
                                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/link.svg'))) }} " style="width: 8px; margin-top: 2px">
                        </span>
                        <span class="d-inline-block span_text" style="width: 180px;position: relative;top:5px;">
                            @foreach ($social_links as $link)
                                    {{ $link }}
                                    @if (count($social_links) > 1)
                                        @break
                                    @endif
                            @endforeach
                        </span>
                    </span>
                @endif
                </span>
            </p>
        </div>
    </div>
    <div class="clear-both" style="margin-top: 0">  
        <div class="preview-left col-lg-6">
            
            @if (!empty($featured_skills_data) || !empty($featured_awards_data) || !empty($featured_languages_data) || !empty($dual_citizenship_data))
                <div class="border-bottom d-block " >
                    @if (!empty($featured_skills_data))
                        <div class="pb-3 border-bottom-0 preview-list ps-0 features-list-after ">
                            @if ($featuredAttribute)
                                <h3>FEATURED</h3>
                            @endif
                            <div class="preview-list_skill ">
                                @if ($featuredAttribute->featured_skills_data[0]['skill'] != null)
                                    <span class="span_h2">Skills:</span>
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
                                    <span class="span_h2">Awards:</span>
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
                        <div class="preview-list" style="padding-bottom: 10px;padding-left: 0">
                            <span class="preview-list_skill">
                                <span class="span_h2">Languages:</span>
                                @foreach ($featuredAttribute->featured_languages_data as $featured_languages)
                                    <span class="list-type">
                                        Multilingual({{ $featured_languages['language'] }})
                                    </span>

                                @endforeach
                            </span>
                        </div>
                    @endif
                    {{-- @if (!empty($dual_citizenship_data))
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
                    @endif --}}
                </div>
            @endif

            @if (!empty($employment_data) || !empty($significant_data))
            @if (!empty($employment_data)) 
            <div class="border-bottom d-block">
                        <div class="preview-list employ-list-after">
                            <h3>Employment & Certifications</h3>
                            @foreach ($employment_data as $data)
                                <span style="display: block;margin-bottom: 5px">
                            <span class="list-type">
                                    @if(isset($data['grade']) && !empty($data['grade']))
                                        {{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}
                                    @endif
                                    @if(!is_null($data['job_title']))
                                            {{ $data['job_title'] }},
                                    @endif
                                    @if(!is_null($data['name_of_company']))
                                            {{ $data['name_of_company'] }},
                                    @endif
                                    @if(!is_null($data['location']))
                                            {{ $data['location'] }},
                                    @endif
                                    @if(!is_null($data['honor_award']))
                                            {{ $data['honor_award'] }}
                                    @endif
                            </span>      
                                </span>
                            @endforeach
                            {{-- <span style="margin-bottom: 5px;display: block">
                                @foreach ($employment_data as $data)
                                    
                                @endforeach
                            </span> --}}
                            {{-- <span style="margin-bottom: 5px;display: block">
                                @foreach ($employment_data as $data)
                                    
                                @endforeach
                            </span> --}}
                        </div>
            </div>
                    @endif
                    @if (!empty($significant_data)) 
                    <div class="border-bottom d-block">

                        <span class="preview-list responsible-list-after">
                            <h3>RESPONSIBILITIES OR INTERESTS</h3>
                            @foreach ($significant_data as $data)
                            <span style="margin-bottom: 5px; display: block">
                            <span class="list-type">
                                    @if(isset($data['grade']) && !empty($data['grade']))
                                            {{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}
                                    @endif
                                    @if(isset($data['interest']) && !empty($data['interest']))
                                            {{ $data['interest'] }},
                                    @endif
                                    @if(isset($data['location']) && !empty($data['location']))
                                            {{ $data['location'] }},
                                    @endif
                                    @if(isset($data['honor_award']) && !empty($data['honor_award']))
                                            {{ $data['honor_award'] }}
                                    @endif
                            </span>
                                </span>
                                @endforeach
                            {{-- <span class="span_h2">Grade(s)</span>
                            <span style="margin-bottom: 10px;display: block">
                                @foreach ($significant_data as $data)
                                    
                                @endforeach
                            </span> --}}
                        </span>
                    </div>
                    @endif
            @endif

            @if (!empty($honor))
                <div class="preview-list">
                    <h3>HONORS / ACHIEVEMENTS / AWARDS</h3>
                    @foreach ($honor->honors_data as $honor_data)
                    <span style="margin-bottom: 5px;display: block">
                            <span class="list-type">
                                @if(isset($honor_data['grade']) && !empty($honor_data['grade']))
                                    {{ \App\Helpers\Helper::getGradeByIdArray($honor_data['grade']) }}
                                @endif
                                {{ $honor_data['position'] }},
                                {{ $honor_data['honor_achievement_award'] }},
                                {{ $honor_data['location'] }}
                                
                            </span>    
                        </span>
                        @endforeach
                    {{-- <span style="margin-bottom: 5px;display: block">
                        @foreach ($honor->honors_data as $honor_data)
                            
                        @endforeach
                    </span>
                    <span style="margin-bottom: 5px;display: block">
                        @foreach ($honor->honors_data as $honor_data)
                            
                        @endforeach
                    </span>
                    <span style="margin-bottom: 5px;display: block">
                        @foreach ($honor->honors_data as $honor_data)
                            
                        @endforeach
                    </span> --}}
                </div>
            @endif
        </div>
        <div class="preview-right">
            @if (!empty($education))
                <div class="preview-list d-block {{ (!empty($activity)) ? 'border-bottom' : '' }}" style="padding-left: 20px;padding-bottom: 10px">
                    <h3>Education</h3>
                    <span>
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
                            {{ $education->high_school_name }} /
                            {{ $education->high_school_city }} /
                            {{ $education->high_school_state }} /
                            {{ $education->high_school_district }}
                            @if (isset($education->graduation_designation) && $education->graduation_designation != null)
                                ({{$education->graduation_designation}})
                            @endif
                            @if (!empty($education->cumulative_gpa_weighted) || !empty($education->cumulative_gpa_unweighted))
                                {{ $education->cumulative_gpa_unweighted }} UWtd .GPA,
                                {{ $education->cumulative_gpa_weighted }} Wtd
                            @endif
                        </span>
                        @if (!empty($testing_data))
                            @foreach ($testing_data as $data)
                                <li class="list-text">
                                    {{ isset($data['name_of_test']) ? $data['name_of_test'] : '' }} 
                                    :{{ isset($data['results_score']) ? $data['results_score'] : ''}}
                                    @if(!empty($education->class_rank) || !empty($education->total_no_of_student))
                                            <span class="span_bold">Class Rank:</span>
                                            {{ $education->class_rank }} /
                                            {{ $education->total_no_of_student }}
                                    @endif
                                </li>
                            @endforeach
                        @endif

                        {{-- <span class="span_text">
                            <span class="span_bold">Current Grade :
                            </span>{{ implode(',', $current_grade) }}
                        </span> --}}

                        {{-- <span class="span_text">
                            <span class="span_bold">Month / Year :
                            </span>
                            {{ $education->month }} / {{ $education->year }}
                        </span> --}}
                        @if (!empty($education->ib_courses))
                            <span class="span_text">
                                <span class="span_bold">IB Courses:</span>
                                    {{ implode(',', $ib_courses) }}
                            </span>
                        @endif
                        @if (!empty($education->ap_courses))
                            <span class="span_text">
                                <span class="span_bold">AP Courses:</span>
                                    {{ implode(',', $ap_courses) }}
                            </span>
                        @endif
                        @if (!empty($education->honor_course_data))
                            <span class="span_text">
                                <span class="span_bold">Honors Course :</span>
                                @foreach ($education->honor_course_data as $honor_course_data)
                                    @foreach ($education->honor_course_data as $honor_course_data)
                                        @if(isset($honor_course_data['course_data']) && !empty($honor_course_data['course_data']))
                                                {{ \App\Helpers\Helper::getHonorCourseByIdArray($honor_course_data['course_data']) }}
                                        @endif
                                    @endforeach
                                @endforeach
                            </span>
                        @endif
                        @if (!empty($course_data))
                            <span class="span_text">
                                <span class="span_bold">Concurrent Enrollment:</span>
                                @foreach ($college_list as $college)
                                    <div>
                                        {{\App\Helpers\Helper::getCollegeNameByIdArray($college)}} : 
                                        @foreach ($education->course_data as $course_data)
                                            @if(isset($course_data['search_college_name']))
                                                @if (in_array($college, $course_data['search_college_name']))
                                                    @if (isset($course_data['course_name']))      
                                                            {{$course_data['course_name']}}
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </span>
                        @endif
                        <span>
                            @if (!empty($intended_major))
                                <span class="span_text">
                                    <span class="span_bold">Intended College Major(s):</span>
                                        {{ implode(',', $intended_major) }}
                                </span>
                            @endif
                            @if (!empty($intended_major))
                                <span class="span_text">
                                    <span class="span_bold">Intended College Minor(s):</span>
                                        {{ implode(',', $intended_minor) }}
                                </span>
                            @endif
                        </span>
                    </span>
                </div>
            @endif
            @if (!empty($activity))
                <div class="preview-list d-block activity-list-after" style="padding-left: 20px;">
                    <h3>Activities</h3>
                    {{-- @if (!empty($demonstrated_data))
                                @foreach ($demonstrated_data as $data)
                                        {{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}
                                @endforeach
                                @foreach ($demonstrated_data as $data)
                                        {{ $data['position'] }}
                                @endforeach
                                @foreach ($demonstrated_data as $data)
                                        {{ $data['interest'] }}
                                @endforeach
                                @foreach ($demonstrated_data as $data)
                                        {{ $data['details'] }}
                                @endforeach
                    @endif --}}
                    @if (!empty($demonstrated_data))
                          
                        <span class="list-type">
                        @foreach ($demonstrated_data as $data)
                                {{isset($data['grade']) && $data['grade'] != null ? (\App\Helpers\Helper::getGradeByIdArray($data['grade'])) : ''}}
                                {{ $data['position'] }},
                                {{ $data['interest'] }},
                                {{ $data['details'] }}
                        @endforeach
                        </span>
                    @endif
                            
                    @if(!empty($leadership_data))    
                        @foreach($leadership_data as $data)
                            <span class="list-type">
                                @if(!empty($data['grade']))
                                        {{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}
                                @endif
                                @if(!empty($data['status']))
                                        {{ $data['status'] }},
                                @endif
                                @if(!empty($data['position']))
                                        {{ $data['position'] }},
                                @endif
                                @if(!empty($data['organization']))
                                        {{ $data['organization'] }}
                                @endif
                            </span>
                        @endforeach        
                    @endif
                    @if(!empty($activities_data))    
                
                    @foreach ($activities_data as $data)
                        <span class="list-type">
                            @if(!empty($data['grade']))
                                {{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}
                            @endif
                            @if(!empty($data['position']))
                                    {{ $data['position'] }},
                            @endif
                            @if(!empty($data['activity']))
                                    {{ $data['activity'] }},
                            @endif
                            @if(!empty($data['honor_award']))
                                    {{ $data['honor_award'] }}
                            @endif
                        </span>  
                    @endforeach  
                               
                    @endif
                    @if(!empty($athletics_data))    
                        <h3>ATHLETICS</h3>
                        @foreach ($athletics_data as $data)
                            <span class="list-type">
                                @if(!empty($data['grade']))
                                        {{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}
                                @endif
                                @if(isset($data['position']))
                                        {{ $data['position'] }},
                                @endif
                                @if(isset($data['activity']))
                                        {{ $data['activity'] }},
                                @endif
                                
                                @if(isset($data['honor']))
                                        {{ $data['honor'] }}
                                @endif
                            </span>
                        @endforeach           
                    @endif
                    @if(!empty($community_service_data))    
                        <span style="margin-bottom: 5px;display: block">
                            <h3 class="span_h2">Community Service</h3>
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
                                    if(isset($data['location'])){
                                        $community_service_array['location'][] = $data['location'];
                                    }
                                @endphp
                            @endforeach
                            <span class="list-type">
                                @if(isset($data['grade']) && !empty($data['grade']))
                                        {{ \App\Helpers\Helper::getGradeAllByIdArray($community_service_array['grade']) }}
                                @endif
                                @if(isset($data['level']))
                                        {{ implode(",", $community_service_array['level']) }},
                                @endif
                                @if(isset($data['service']))
                                        {{ implode(",", $community_service_array['service']) }},
                                @endif
                                @if(isset($data['location']))
                                        {{ implode(",", $community_service_array['location']) }}
                                @endif
                        </span>
                    @endif
                </div>
            @endif
        </div>
    </div>

</body>

</html>
