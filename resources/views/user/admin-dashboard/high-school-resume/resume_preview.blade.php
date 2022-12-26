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

        .preview-list {
            padding-left: 15px;
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
            padding-left: 20px
        }

        .list-type:before {
            content: "";
            width: 6px;
            height: 6px;
            background-color: #777777;
            border-radius: 50%;
            position: absolute;
            top: 5px;
            left: 4;
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
            top: -30px;
        }

        .span_link {
            position: relative;
            top: -8px;
        }

        .span_location2 {
            position: relative;
            top: -6px
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
            padding-left: 0;
        }

        .clear-both {
            padding: 20px 50px;
            /* page-break-inside: avoid; */
        }
    </style>
</head>

<body>
    <div style="margin-bottom: 0">
        <p
            style="font-weight:400; padding:20px 50px 10px;background-color: #f4f4f4; text-align:left;color: #43464c;font-size:2.25rem">
            <b>{{ $personal_info->first_name }}<b> {{ $personal_info->middle_name }} {{ $personal_info->last_name }}
                    <span
                        style="letter-spacing: 10px;padding:10px 50px 20px 0;    background-color: #f4f4f4; display:block;color: #44464c;font-weight: 700;text-transform: uppercase;font-size:18px">
                        Web Developer</span>
        </p>
    </div>
    <div class="clear-both row align-items-center">
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
                    <span class="d-inline-block ">
                        <span class="span_list span_mail ">
                            <img
                                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/email.svg'))) }} ">
                        </span>
                        <span class="d-inline-block span_text" style="width: 180px">
                            <span class="d-block span_bold">Parent Email 1 / Parent Email 2 </span>
                            {{ $personal_info->parent_email_one }} 
                            {{ $personal_info->parent_email_two }}
                        </span>
                    </span>
                    <span class="d-inline-block">
                        <span class="span_list span_location">
                            <img
                                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/location.svg'))) }} ">
                        </span>
                        <span class="d-inline-block span_text" style="width: 180px; margin-bottom:10px">
                            <span class="d-block span_bold">City / State: </span>
                            <span class="span_text">
                                {{ $personal_info->city . ' / ' . $personal_info->state }} </span>
                        </span>
                    </span>
                    <span class="d-inline-block">
                        <span class="span_list span_link">
                            <img
                                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/link.svg'))) }} ">
                        </span>
                        <span class="d-inline-block span_text" style="width: 180px">
                            <span class="d-block span_bold">Social Links :</span>
                                @foreach ($personal_info->social_links as $social_link)
                                    <li class="list-type">
                                        {{ $social_link['link'] }}
                                    </li>
                                @endforeach
                        </span>
                    </span>
                </span>
                <span class="contact-list-after"></span>
            </span>
            <span class="border-bottom d-block">        
                @if (!empty($featuredAttribute->featured_skills_data))
                    <div class="pb-3 mb-0 border-bottom-0">
                        @if ($featuredAttribute->featured_awards_data[0]['award'] != null || $featuredAttribute->featured_languages_data[0]['language'] != null || $featuredAttribute->featured_skills_data[0]['skill'] != null)
                            <h3>Features</h3>
                        @endif
                        <div class="preview-list_skill">
                            @if($featuredAttribute->featured_skills_data[0]['skill'] != null)
                                <h2>Featured Skills</h2>
                                <ul class="list">
                                    @foreach ($featuredAttribute->featured_skills_data as $featured_skills)
                                        <div class="list_group">
                                            <ul class="list_items">
                                                <li class="list-type">
                                                    {{ $featured_skills['skill'] }}
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @endif
                @if (!empty($featuredAttribute->featured_awards_data))
                    <div
                        class="preview-list pb-3 features-list-after  ps-0 mb-0 border-bottom-0">
                        <div class="preview-list_skill">
                            @if($featuredAttribute->featured_awards_data[0]['award'] != null)
                                <h2>Featured awards</h2>
                                <ul class="list">
                                    @foreach ($featuredAttribute->featured_awards_data as $featured_awards)
                                        <div class="list_group">
                                            <ul class="list_items">
                                                <li class="list-type">
                                                    {{ $featured_awards['award'] }}
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @endif
                @if (!empty($featuredAttribute->featured_languages_data))
                    <span class="preview-list pb-3 ps-0 ">
                        <span class="preview-list_skill ">
                            <span class="span_h2">Featured languages</span>
                            <span class="span_text">
                                <div class="list_group">
                                    <ul class="list_items">
                                        @foreach ($featuredAttribute->featured_languages_data as $featured_languages)
                                        <li class="list-type">
                                            {{ $featured_languages['language'] }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </span>
                        </span>
                    </span>
                @endif
            </span>
            <span class="border-bottom d-block">
                @if (!empty($employmentCertification->significant_data))
                    <span class="preview-list">
                        <h3>Employment & Certifications</h3>
                        <ul class="list_items span_text">
                            @foreach ($employmentCertification->employment_data as $employment_data)
                                <li class="list-type">
                                    <span>Job </span>
                                    {{ $employment_data['job_title'] }}
                                    <span> with </span>
                                    {{ implode(',', $employment_data['grade']) }}
                                </li>
                            @endforeach

                            @foreach ($employmentCertification->employment_data as $employment_data)
                                <li class="list-type">
                                    <span> Honor by </span>
                                    {{ $employment_data['honor_award'] }}
                                    <span> at </span>
                                    {{ $employment_data['location'] }}
                                </li>
                            @endforeach
                        </ul>
                    </span>
                @endif
                @if (!empty($employmentCertification->employment_data))
                    <span class="preview-list">
                        <h3>Responsibilities or interests</h3>
                        <span class="list_items span_text">
                            <ul class="list_items">
                                @foreach ($employmentCertification->significant_data as $significant_data)
                                    <li class="list-type">
                                        <span>Responsibility or interest :</span>
                                        {{ $significant_data['interest'] }}
                                        <span> with </span>
                                        {{ implode(',', $significant_data['grade']) }}
                                    </li>
                                @endforeach

                                @foreach ($employmentCertification->significant_data as $significant_data)
                                    <li class="list-type">
                                        <span>Honor by</span>
                                        {{ $significant_data['honor_award'] }}
                                        <span> at </span>
                                        {{ $significant_data['location'] }}
                                    </li>
                                @endforeach
                            </ul>
                        </span>
                        <div class="honor-list-after"></div>
                    </span>
                @endif
            </span>
            @if (!empty($honor))
                <span class="preview-list">
                    <h3>Honor</h3>
                    <ul class="list">
                        <li class="span_text">
                            <span class="span_bold">Honor Position : </span>
                            <div class="list_group">
                                <ul class="list_items">
                                    @foreach ($honor->honors_data as $honor_data)
                                        <li class="list-type">
                                            {{ $honor_data['position'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li class="span_text">
                            <span class="d-block span_bold">Achivement / Grade : </span>
                            <div class="list_group">
                                <ul class="list_items">
                                    @foreach ($honor->honors_data as $honor_data)
                                        <li class="list-type">
                                            {{ $honor_data['honor_achievement_award'] }} /
                                            {{ implode(',', $honor_data['grade']) }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li class="span_text">
                            <span class="span_bold">Location : </span>
                            <div class="list_group">
                                <ul class="list_items">
                                    @foreach ($honor->honors_data as $honor_data)
                                        <li class="list-type">
                                            {{ $honor_data['location'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    </ul>
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
                            </span>{{ $education->current_grade }} /
                            {{ $education->month }} / {{ $education->year }}
                        </span>
                        <span class="span_text"> <span class="span_bold"> Weighted GPA / Unweighted GPA
                                :</span>
                            {{ $education->cumulative_gpa_weighted }} /
                            {{ $education->cumulative_gpa_unweighted }}
                        </span>
                        <span class="span_text">
                            <span class="span_bold">Class Rank / Number of Student : </span>
                            {{ $education->class_rank }} /
                            {{ $education->total_no_of_student }}
                        </span>
                        @if (!empty($education->ib_courses))
                            <li class="span_text">
                                <span class="span_bold">IB Courses:</span>
                                {{ implode(',', $ib_courses) }}
                            </li>
                        @endif
                        @if (!empty($education->ap_courses))
                            <li class="span_text">
                                <span class="span_bold">AP Courses:</span>
                                {{ implode(',', $ap_courses) }}
                            </li>
                        @endif
                        @if (!empty($education->honor_course_data))
                            <span class="span_text">
                                <span class="span_bold">Honors Course :</span>
                                <div class="list_group">
                                    <ul class="list_items">
                                        @foreach ($education->honor_course_data as $honor_course_data)
                                            <li class="list-type">
                                                {{ $honor_course_data['course_data'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </span>
                        @endif
                        @if (!empty($education->course_data))
                            <span class="span_text">
                                <span class="span_bold">Course and College name: </span>
                                <div class="list_group">
                                    <ul class="list_items">
                                        @foreach ($education->course_data as $course_data)
                                            <li class="list-type">
                                                {{ $course_data['course_name'] }} /
                                                {{ $course_data['search_college_name'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </span>
                        @endif
                        @if (!empty($education->testing_data))
                            <span class="span_text">
                                <span class="d-block span_bold mb-2">Name and Date of Test:</span>
                                <div class="list_group">
                                    <ul class="list_items">
                                        @foreach ($education->testing_data as $testing_data)
                                            <li class="list-type">
                                                {{ $testing_data['name_of_test'] }} /
                                                {{ $testing_data['date'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </span>
                        @endif
                        <span>
                            @if (isset($education->intended_college_major))
                                <span class="span_text">
                                    <span class="span_bold">Intended College Major(s):</span>
                                    <span class="list-type">
                                        {{ $education->intended_college_major }}
                                    </span>
                                </span>
                            @endif
                            @if (isset($education->intended_college_major))
                                <span class="span_text">
                                    <span class="span_bold">Intended College Minor(s):</span>
                                    <span class="list-type">
                                        {{ $education->intended_college_minor }}
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
                    @if (!empty($activity->demonstrated_data))
                        <span class="span_text">

                            <span class="d-block span_bold">Demostrated Interests and
                                Position in the Area of my College
                                Major :</span>

                            <div class="list_group">
                                <ul class="list_items">
                                    @foreach ($activity->demonstrated_data as $demonstrated_data)
                                        <li class="list-type">
                                            {{ $demonstrated_data['interest'] }} /
                                            {{ $demonstrated_data['position'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </span>

                        <span class="span_text">
                            <span class="d-block span_bold">Grade and Location with Details :
                            </span>
                            <div class="list_group">
                                <ul class="list_items">
                                    @foreach ($activity->demonstrated_data as $demonstrated_data)
                                        <li class="list-type">
                                            {{ implode(',', $demonstrated_data['grade']) }}
                                            {{ $demonstrated_data['location'] }} /
                                            {{ $demonstrated_data['details'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </span>
                    @endif
                    @if (!empty($activity->leadership_data))
                        <span class="span_text">
                            <span class="span_bold">Leadership status with Position : </span>
                            <div class="list_group">
                                <ul class="list_items">
                                    @foreach ($activity->leadership_data as $leadership_data)
                                        <li class="list-type">
                                            {{ $leadership_data['status'] }} /
                                            {{ $leadership_data['position'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </span>
                        <span class="span_text">
                            <span class="span_bold">Leadership organized By :</span>
                            <div class="list_group">
                                <ul class="list_items">
                                    @foreach ($activity->leadership_data as $leadership_data)
                                        <li class="list-type">
                                            {{ $leadership_data['organization'] }} /
                                            {{ $leadership_data['location'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </span>
                    @endif
                    @if (!empty($activity->athletics_data))
                        <span class="span_text">
                            <span class="span_bold">Athletics status with Position : </span>
                            <div class="list_group">
                                <ul class="list_items">
                                    @foreach ($activity->athletics_data as $athletics_data)
                                        <li class="list-type">
                                            {{ $athletics_data['activity'] }} /
                                            {{ $athletics_data['position'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </span>
                        <div class="page"></div>
                        <span class="span_text">
                            <span class="span_bold">Athletics honor by :</span>
                            <div class="list_group">
                                <ul class="list_items">
                                    @foreach ($activity->athletics_data as $athletics_data)
                                        <li class="list-type">
                                            {{ $athletics_data['honor'] }} /
                                            {{ $athletics_data['location'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </span>
                    @endif
                    @if (!empty($activity->activities_data))
                        <span class="span_text">
                            <span class="span_bold">Activity with Position : </span>
                            <div class="list_group">
                                <ul class="list_items">
                                    @foreach ($activity->activities_data as $activities_data)
                                        <li class="list-type">
                                            {{ $activities_data['activity'] }} /
                                            {{ $activities_data['position'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </span>
                        <span class="span_text">
                            <span class="span_bold">Activity honor by :</span>
                            <div class="list_group">
                                <ul class="list_items">
                                    @foreach ($activity->activities_data as $activities_data)
                                        <li class="list-type">
                                            {{ $activities_data['honor_award'] }} /
                                            {{ $activities_data['location'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif
                    <span class="preview-list"></span>
                    @if (!empty($activity->community_service_data))
                        <span class="span_text">
                            <span class="span_bold">Participation and service : </span>
                            <div class="list_group">
                                <ul class="list_items">
                                    @foreach ($activity->community_service_data as $community_service_data)
                                        <li class="list-type">
                                            {{ $community_service_data['level'] }} /
                                            {{ $community_service_data['service'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </span>
                        <span class="span_text">
                            <span class="span_bold">Community Located at : </span>
                            <div class="list_group">
                                <ul class="list_items">
                                    @foreach ($activity->community_service_data as $community_service_data)
                                        <li class="list-type">
                                            {{ $community_service_data['location'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </span>
                        </li>
                    @endif
                </span>
            @endif
        </div>
    </div>

</body>

</html>
