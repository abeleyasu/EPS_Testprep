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
            width: 300px;
            border-right: 2px solid #a8a8a8;
            vertical-align: top;
            display: inline-block !important;

        }
        .preview-list_skill h3,
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
            margin: 20px 0;
            padding: 0;
        }

        .preview-right {
            width: 350px;
            vertical-align: top;
            display: inline-block !important;
            page-break-before: avoid;
        }


        .preview-list h3 {
            font-size: 12px;
            color: #45464b;
            font-weight: 700;
            margin-bottom: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
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

        /* .contact-list-after {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #fff;
            z-index: 999;
            right: -8px;
            top: 34%;
            position: absolute;
        }
        .features-list-after {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #fff;
            z-index: 999;
            right: -8px;
            top: 21%;
            position: absolute;
        }

        .honor-list-after {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #fff;
            z-index: 999;
            right: -8px;
            top: 9%;
            position: absolute;
        } */

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
            top: -15px;
        }

        .span_link {
            position: relative;
            top: -20px;
        }

        .span_location2 {
            position: relative;
            top: 0;
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
            padding: 10px 50px;
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
            style="font-weight:400; padding:20px 50px 10px;background-color: #f4f4f4; text-align:left;color: #43464c;font-size:2.25rem">
            <b>{{ $personal_info->first_name }}<b> {{ $personal_info->middle_name }} {{ $personal_info->last_name }}
                    <span
                        style="letter-spacing: 10px;padding:10px 50px 20px 0;  background-color: #f4f4f4; display:block;color: #44464c;font-weight: 700;text-transform: uppercase;font-size:18px">
                        Web Developer</span>
        </p>
    </div>
    <div class="clear-both">
        <div class="preview-left col-lg-6">
            <span class="preview-list border-bottom d-block ps-0">
                <h3>Contact</h3>
                <span class="list">
                    <span class="span_text">
                        <span class="span_list">
                            <img
                                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/email.svg'))) }}">
                        </span>
                        {{ $personal_info->email }}
                    </span>
                    <span class="span_text">
                        <span class="span_list span_call">
                            <img
                                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/phone-solid.svg'))) }}">
                        </span>
                        {{ $personal_info->cell_phone }}
                    </span>
                    <span class=" d-inline-block span_text">
                        <span class="span_list span_location2">
                            <img
                                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/location.svg'))) }} ">
                        </span>
                        <span style="width: 200px;margin-top: 10px;" class="d-inline-block">
                            <span class="d-block span_bold">Address1 / Address2 / Zip Code :</span>
                            {{ $personal_info->street_address_one }} /
                            {{ $personal_info->street_address_two }} /
                            {{ $personal_info->zip_code }}
                        </span>
                    </span>
                    <span class="d-inline-block">
                        <span class="span_list span_location">
                            <img
                                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/location.svg'))) }} ">
                        </span>
                        <span class="d-inline-block span_text" style="width: 180px;">
                            <span class="d-block span_bold">City / State: </span>
                            <span class="span_text">
                                {{ $personal_info->city . ' / ' . $personal_info->state }} </span>
                        </span>
                    </span>
                    {{-- {{dd($social_links)}} --}}
                    @if ($social_links != null)
                        <span class="d-inline-block">
                            <span class="span_list span_link">
                                <img
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/link.svg'))) }} ">
                            </span>
                            <span class="d-inline-block span_text" style="width: 180px;margin-top: 10px">

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
                <span class="contact-list-after"></span>
            </span>
            <div class="border-bottom d-block">
                @if (!empty($featured_skills_data))
                    <div class="pb-3 border-bottom-0 preview-list ps-0 ">
                        @if ($featuredAttribute)
                            <h3>Features</h3>
                        @endif
                        <div class="preview-list_skill ">
                            @if ($featuredAttribute->featured_skills_data[0]['skill'] != null)
                                <h2 class="">Featured Skills</h2>
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
                                <h2>Featured awards</h2>
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
                        <span class="preview-list_skill ">
                            <span class="span_h2">Featured languages</span>
                            @foreach ($featuredAttribute->featured_languages_data as $featured_languages)
                                <span class="list-type">
                                    {{ $featured_languages['language'] }}
                                </span>
                            @endforeach
                        </span>
                    </span>
                @endif
            </div>
            <span class="border-bottom d-block">
                <span class="preview-list">
                    @if (!empty($employment_data))
                        <h3>Employment & Certifications</h3>
                        @foreach ($employmentCertification->employment_data as $employment_data)
                            <span class="list-type">
                                <span>Job </span>
                                {{ $employment_data['job_title'] }}
                                <span> with </span>
                                @if (isset($employment_data['grade']))
                                    {{ \App\Helpers\Helper::getGradeByIdArray($employment_data['grade']) }}
                                @endif
                            </span>
                        @endforeach
                        @foreach ($employmentCertification->employment_data as $employment_data)
                            <span class="list-type">
                                <span> Honor by </span>
                                {{ $employment_data['honor_award'] }}
                                <span> at </span>
                                {{ $employment_data['location'] }}
                            </span>
                        @endforeach
                    @endif
                </span>
                <span class="preview-list" >
                    @if (!empty($significant_data))
                        <h3>Responsibilities or interests</h3>

                        @foreach ($employmentCertification->significant_data as $significant_data)
                            <span class="list-type">
                                <span>Responsibility or interest :</span>
                                {{ $significant_data['interest'] }}
                                <span> with </span>
                                @if (isset($significant_data['grade']))
                                    {{ implode(',', $significant_data['grade']) }}
                                @endif
                            </span>
                        @endforeach

                        @foreach ($employmentCertification->significant_data as $significant_data)
                            <span class="list-type">
                                <span>Honor by</span>
                                {{ $significant_data['honor_award'] }}
                                <span> at </span>
                                {{ $significant_data['location'] }}
                            </span>
                        @endforeach
                        <div class="honor-list-after"></div>
                    @endif
                </span>
            </span>
            @if (!empty($honor))
                <span class="preview-list">
                    <h3>Honor</h3>

                    <span class="span_text">
                        <span class="span_bold">Honor Position : </span>
                        @foreach ($honor->honors_data as $honor_data)
                            <span class="list-type">
                                {{ $honor_data['position'] }}
                            </span>
                        @endforeach
                    </span>
                </span>
                <span class="span_text">
                    <span class="d-block span_bold">Achivement / Grade : </span>

                    @foreach ($honor->honors_data as $honor_data)
                        <span class="list-type">
                            {{ $honor_data['honor_achievement_award'] }} /
                            {{ \App\Helpers\Helper::getGradeByIdArray($honor_data['grade']) }}

                        </span>
                    @endforeach
                </span>
                <span class="span_text">
                    <span class="span_bold">Location : </span>
                    <div class="list_group">
                        @foreach ($honor->honors_data as $honor_data)
                            <span class="list-type">
                                {{ $honor_data['location'] }}
                            </span>
                        @endforeach
                    </div>
                </span>

                </span>
            @endif
        </div>
        <div class="preview-right">
            @if (!empty($education))
                <span class="preview-list border-bottom d-block">
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
                            <span class="span_bold">Current Grade / Month / Year :
                            </span>{{ implode(',', $current_grade) }}/
                            {{ $education->month }} / {{ $education->year }}
                        </span>
                        @if(!empty($education->cumulative_gpa_weighted) || !empty($education->cumulative_gpa_unweighted))
                            <li class="span_text">
                                <span class="span_bold"> Weighted GPA / Unweighted GPA :</span>
                                {{ $education->cumulative_gpa_weighted }} /
                                {{ $education->cumulative_gpa_unweighted }}
                            </li>
                        @endif
                        @if(!empty($education->class_rank) || !empty($education->total_no_of_student))
                            <li class="span_text">
                                <span class="span_bold">Class Rank / Number of Student : </span>
                                {{ $education->class_rank }} /
                                {{ $education->total_no_of_student }}
                            </li>
                        @endif
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
                                    <span class="list-type">
                                        {{ implode(',', $honor_course_data['course_data']) }}
                                    </span>
                                @endforeach
                            </span>
                        @endif
                        @if (!empty($education->course_data))
                            <span class="span_text">
                                <span class="span_bold">Course and College name: </span>
                                @foreach ($education->course_data as $course_data)
                                    <span class="list-type">
                                        {{ $course_data['course_name'] }} /
                                        {{ \App\Helpers\Helper::getCollegeNameByIdArray($course_data['search_college_name']) }}

                                    </span>
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
                <span class="preview-list d-block">
                    <h3>Activities</h3>
                    @if (!empty($demonstrated_data))
                        <span class="span_text">
                            <span class="d-block span_bold">Demostrated Interests and
                                Position in the Area of my College
                                Major :</span>

                            @foreach ($activity->demonstrated_data as $demonstrated_data)
                                <span class="list-type">
                                    {{ $demonstrated_data['interest'] }} /
                                    {{ $demonstrated_data['position'] }}
                                </span>
                            @endforeach
                        </span>

                        <span class="span_text">
                            <span class="d-block span_bold">Grade and Location with Details :
                            </span>

                            @foreach ($activity->demonstrated_data as $demonstrated_data)
                                <span class="list-type">
                                    @if (isset($demonstrated_data['grade']))
                                        {{ \App\Helpers\Helper::getGradeByIdArray($demonstrated_data['grade']) }}
                                        /
                                    @endif
                                    {{ $demonstrated_data['location'] }} /
                                    {{ $demonstrated_data['details'] }}
                                </span>
                            @endforeach
                        </span>
                    @endif
                    @if (!empty($leadership_data))
                        <span class="span_text">
                            <span class="span_bold">Leadership status with Position : </span>

                            @foreach ($activity->leadership_data as $leadership_data)
                                <span class="list-type">
                                    {{ isset($leadership_data['status']) ? $leadership_data['status']  : ''}}
                                    {{ isset($leadership_data['status']) && isset($leadership_data['position']) ? '/' : ''}}
                                    {{ isset($leadership_data['position']) ? $leadership_data['position'] : ''}}
                                </span>
                            @endforeach
                        </span>
                        <span class="span_text">
                            <span class="span_bold">Leadership organized By :</span>

                            @foreach ($activity->leadership_data as $leadership_data)
                                <span class="list-type">
                                    
                                    {{ $leadership_data['organization'] }} 
                                    {{ isset($leadership_data['organization']) && isset($leadership_data['location']) ? '/' : ''}}
                                    {{ $leadership_data['location'] }}
                                </span>
                            @endforeach

                        </span>
                    @endif
                        @if (!empty($athletics_data))
                        <span class="span_text">
                            <span class="span_bold">Athletics status with Position : </span>

                            @foreach ($activity->athletics_data as $athletics_data)
                                <span class="list-type">
                                    {{ $athletics_data['activity'] }} 
                                    {{ !empty($athletics_data['activity']) && !empty($athletics_data['position']) ? '/' : '' }}
                                    {{ $athletics_data['position'] }}
                                </span>
                            @endforeach

                        </span>
                        <div class="page"></div>
                        <span class="span_text">
                            <span class="span_bold">Athletics honor by :</span>

                            @foreach ($activity->athletics_data as $athletics_data)
                                <span class="list-type">
                                    {{ $athletics_data['honor'] }} 
                                    {{ !empty($athletics_data['honor']) && !empty($athletics_data['location']) ? '/' : '' }}
                                    {{ $athletics_data['location'] }}
                                </span>
                            @endforeach

                        </span>
                    @endif
                    @if (!empty($activities_data))
                        <span class="span_text">
                            <span class="span_bold">Activity with Position : </span>

                            @foreach ($activity->activities_data as $activities_data)
                                <span class="list-type">
                                    {{ $activities_data['activity'] }} 
                                    {{ !empty($activities_data['activity']) && !empty($activities_data['position']) ? '/' : '' }}
                                    {{ $activities_data['position'] }}
                                </span>
                            @endforeach

                        </span>
                        <span class="span_text">
                            <span class="span_bold">Activity honor by :</span>

                            @foreach ($activity->activities_data as $activities_data)
                                <span class="list-type">
                                    {{ $activities_data['honor_award'] }} 
                                    {{ !empty($activities_data['honor_award']) && !empty($activities_data['location']) ? '/' : '' }}
                                    {{ $activities_data['location'] }}
                                </span>
                            @endforeach

                    @endif
                    <span class="preview-list"></span>
                    @if (!empty($community_service_data))
                        <span class="span_text">
                            <span class="span_bold">Participation and service : </span>

                            @foreach ($activity->community_service_data as $community_service_data)
                                <span class="list-type">
                                    {{ $community_service_data['level'] }} 
                                    {{ !empty($community_service_data['level']) && !empty($community_service_data['service']) ? '/' : '' }}
                                    {{ $community_service_data['service'] }}
                                </span>
                            @endforeach

                        </span>
                        <span class="span_text">
                            <span class="span_bold">Community Located at : </span>

                            @foreach ($activity->community_service_data as $community_service_data)
                                <span class="list-type">
                                    {{ $community_service_data['location'] }}
                                </span>
                            @endforeach

                        </span>
                </span>
            @endif
            </span>
            @endif
        </div>
    </div>

</body>

</html>
