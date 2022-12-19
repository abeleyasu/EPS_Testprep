<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HSR | Resume Preview : CPS</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0
        }

        .page {
            page-break-before: auto;
        }

        .preview-left {
            width: 300px;
            /* vertical-align: top;
            display: inline-block; */
            /* margin-top: -140px; */
            border-right: 1px solid #000;
        }

        .preview-right {
            width: 410px;
            vertical-align: top;
            display: inline-block;
            /* padding-left: 10px; */
            /* margin-top: -340px; */
        }

        .preview-list {
            padding-left: 15px;
        }

        .preview-list h3 {
            font-size: 12px;
            color: #1f2937;
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
            color: #1f2937;
            cursor: unset;
            position: relative;
            font-size: 12px;
            margin-bottom: 7px;
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
            background-color: #4c617c;
            border-radius: 50%;
            position: absolute;
            top: 5px;
            left: 4;
        }

        .border-bottom {
            border-bottom: 1px solid #000
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
        } */
        /* border: 1px solid #1f2937; */
        /*
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
            color: #1f2937;
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
            color: #343434;
            font-weight: bold;
        }

        table {
            page-break-before: avoid;
        }

        .ps-0 {
            padding-left: 0;
        }
    </style>
</head>

<body>
    <div class="padding:20px;">
        <p
            style="margin-bottom: 20px; padding:20PX 20px 10px;background-color: #f4f4f4; text-align:left;padding-bottom:10px;color: #43464c;font-size:2.25rem">
            <b>{{ $personal_info->first_name }}<b> {{ $personal_info->middle_name }} {{ $personal_info->last_name }}
                    <span
                        style="letter-spacing: 10px;padding:0 20px 20PX; padding-left:0; background-color: #f4f4f4; display:block;   color: #44464c;font-weight: 700;text-transform: uppercase;font-size:20px">
                        Web Developer</span>
        </p>
    </div>
    <table>
        <tbody style="vertical-align: top">
            <tr>
                <td class="preview-left">
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
                                        {{ $personal_info->city . ', ' . $personal_info->state }} </span>
                                </span>
                            </span>
                            <span class="d-inline-block">
                                <span class="span_list span_link">
                                    <img
                                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/link.svg'))) }} ">
                                </span>
                                <span class="d-inline-block" style="width: 180px">
                                    <span class="d-block span_bold">Social Links :</span>
                                    @foreach ($personal_info->social_links as $link)
                                        <span class="list-type">
                                            {{ $link }}
                                        </span>
                                    @endforeach
                                </span>
                            </span>
                        </span>
                        <span class="contact-list-after"></span>
                    </span>
                    <span class="border-bottom d-block">
                        @if (!empty($featuredAttribute->featured_skills_data))
                            <span class="preview-list">
                                <h3>Features</h3>
                                <span class="preview-list_skill">
                                    <h2 class="span_h2">Featured Skills</h2>
                                    <span class="span_text">
                                        @foreach (json_decode($featuredAttribute->featured_skills_data) as $featured_skills)
                                            <span class="list-type">
                                                {{ $featured_skills->featured_skill }}</span>
                                            {{-- <div class="breakme"></div> --}}
                                        @endforeach
                                    </span>
                                </span>
                            </span>
                        @endif
                        @if (!empty($featuredAttribute->featured_awards_data))
                            <span class="preview-list pb-3 ps-0 mb-0 ">
                                <span class="span_h2">Featured awards</span>
                                <span class="span_text">
                                    @foreach (json_decode($featuredAttribute->featured_awards_data) as $featured_awards)
                                        <span class="list-type">
                                            {{ $featured_awards->featured_award }}</span>
                                    @endforeach
                                </span>
                            </span>
                        @endif
                        @if (!empty($featuredAttribute->featured_languages_data))
                            <span class="preview-list pb-3 ps-0 ">
                                <span class="preview-list_skill ">
                                    <span class="span_h2">Featured languages</span>
                                    <span class="span_text">
                                        @foreach (json_decode($featuredAttribute->featured_languages_data) as $featured_languages)
                                            <span class="list-type">
                                                {{ $featured_languages->featured_language }}
                                            </span>
                                        @endforeach
                                    </span>
                                </span>
                            </span>
                        @endif
                    </span>
                    <span class="border-bottom d-block">
                        @if (!empty($employmentCertification->significant_data))
                            <span class="preview-list">
                                <h3>Employment & Certifications</h3>
                                @php
                                    $employment_data = json_decode($employmentCertification->employment_data);
                                @endphp
                                @foreach ($employment_data as $data)
                                    <span class="list-type span_text">
                                        <span>Job </span>
                                        {{ $data->job_title }}
                                        <span> with </span>
                                        {{ implode(',', json_decode($data->employment_grade)) }}
                                    </span>
                                @endforeach

                                @foreach ($employment_data as $data)
                                    <span class="list-type span_text">
                                        <span> Honor by </span>
                                        {{ $data->employment_honor_award }}
                                        <span> at </span>
                                        {{ $data->employment_location }}
                                    </span>
                                @endforeach
                            </span>
                        @endif
                        @if (!empty($employmentCertification->employment_data))
                            <span class="preview-list">
                                <h3>Responsibilities or interests</h3>
                                <span class="list_items ">
                                    @php
                                        $significant_data = json_decode($employmentCertification->significant_data);
                                    @endphp

                                    @foreach ($significant_data as $data)
                                        <span class="list-type span_text">
                                            <span>Responsibility or interest :</span>
                                            {{ $data->responsibility_interest }}
                                            with
                                            {{ implode(',', json_decode($data->significant_grade)) }}
                                        </span>
                                    @endforeach
                                    @foreach ($significant_data as $data)
                                        <span class="list-type span_text">
                                            Honor by
                                            {{ $data->significant_honor_award }}
                                            at
                                            {{ $data->significant_location }}
                                        </span>
                                    @endforeach
                                </span>
                                <div class="honor-list-after"></div>
                            </span>
                        @endif
                    </span>
                    @if (!empty($honor))
                        <span class="preview-list">
                            <h3>Honor</h3>
                            <span class="span_h2">Honor Position : </span>
                            @php
                                $honor_data = json_decode($honor->honors_data);
                            @endphp
                            @foreach ($honor_data as $data)
                                <span class="list-type span_text">
                                    {{ $data->position }}
                                </span>
                            @endforeach
                            <span class="d-block span_h2">Achivement / Grade : </span>
                            @foreach ($honor_data as $data)
                                <span class="list-type span_text">
                                    {{ $data->honor_achievement_award }} /
                                    {{ implode(',', json_decode($data->grade)) }}
                                </span>
                            @endforeach
                            <span class="span_h2">Location : </span>
                            @foreach ($honor_data as $data)
                                <span class="list-type span_text">
                                    {{ $data->location }}
                                </span>
                            @endforeach
                        </span>
                    @endif

                </td>
                <td class="preview-right">
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
                                    <span class="span_text">
                                        <span class="span_bold">IB Courses:</span>
                                        @foreach ($ib_courses as $course)
                                            {{ $course->name }},
                                        @endforeach
                                    </span>
                                @endif
                                @if (!empty($education->ap_courses))
                                    <span class="span_text">
                                        <span class="span_bold">AP Courses:</span>
                                        @foreach ($ap_courses as $course)
                                            {{ $course->name }},
                                        @endforeach
                                    </span>
                                @endif
                                @if (!empty($education->honor_course_data))
                                    <span class="span_text">
                                        <span class="span_bold">Honors Course :</span>
                                        @php
                                            $honor_course_data = json_decode($education->honor_course_data);
                                        @endphp
                                        @foreach ($honor_course_data as $data)
                                            <span class="list-type">
                                                {{ $data->honor_course_name }}
                                            </span>
                                        @endforeach
                                    </span>
                                @endif
                                @if (!empty($education->course_data))
                                    <span class="span_text">
                                        <span class="span_bold">Course and College name: </span>
                                        @php
                                            $course_data = json_decode($education->course_data);
                                        @endphp
                                        @foreach ($course_data as $data)
                                            <span class="list-type">
                                                {{ $data->course_name }} /
                                                {{ $data->search_college_name }}
                                            </span>
                                        @endforeach
                                    </span>
                                @endif
                                @if (!empty($education->testing_data))
                                    <span class="span_text">
                                        <span class="d-block span_bold mb-2">Name and Date of Test:</span>
                                        @php
                                            $testing_data = json_decode($education->testing_data);
                                        @endphp
                                        @foreach ($testing_data as $data)
                                            <span class="list-type">
                                                {{ $data->name_of_test }} /
                                                {{ $data->date }}
                                            </span>
                                        @endforeach
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

                                    @php
                                        $demonstrated_data = json_decode($activity->demonstrated_data);
                                    @endphp
                                    @foreach ($demonstrated_data as $data)
                                        <span class="list-type span_text">
                                            {{ $data->interest }} /
                                            {{ $data->position }}
                                        </span>
                                    @endforeach
                                </span>

                                <span class="span_text">
                                    <span class="d-block span_bold">Grade and Location with Details :
                                    </span>
                                    @foreach ($demonstrated_data as $data)
                                        <span class="list-type span_text">
                                            {{ implode(',', json_decode($data->grade)) }}
                                            {{ $data->location }} /
                                            {{ $data->details }}
                                        </span>
                                    @endforeach
                                </span>
                            @endif
                            @if (!empty($activity->leadership_data))
                                <span class="span_text">
                                    <span class="span_bold">Leadership status with Position : </span>
                                    <span class="list_group">
                                        <span class="list_items">
                                            @php
                                                $leadership_data = json_decode($activity->leadership_data);
                                            @endphp
                                            @foreach ($leadership_data as $data)
                                                <span class="list-type">
                                                    {{ $data->leadership_status }} /
                                                    {{ $data->leadership_position }}
                                                </span>
                                            @endforeach
                                        </span>
                                    </span>
                                </span>
                                <span class="span_text">
                                    <span class="span_bold">Leadership organized By :</span>

                                    @foreach ($leadership_data as $data)
                                        <span class="list-type">
                                            {{ $data->leadership_organization }} /
                                            {{ $data->leadership_location }}
                                        </span>
                                    @endforeach
                                </span>
                            @endif
                            @if (!empty($activity->athletics_data))
                                <span class="span_text">
                                    <span class="span_bold">Athletics status with Position : </span>
                                    @php
                                        $athletics_data = json_decode($activity->athletics_data);
                                    @endphp
                                    @foreach ($athletics_data as $data)
                                        <span class="list-type">
                                            {{ $data->athletics_activity }} /
                                            {{ $data->athletics_position }}
                                        </span>
                                    @endforeach
                                </span>
                                <div class="page"></div>
                                <span class="span_text">
                                    <span class="span_bold">Athletics honor by :</span>
                                    @foreach ($athletics_data as $data)
                                        <span class="list-type">
                                            {{ $data->athletics_honor }} /
                                            {{ $data->athletics_location }}
                                        </span>
                                    @endforeach
                                </span>
                            @endif
                            @if (!empty($activity->activities_data))
                                <span class="span_text">
                                    <span class="span_bold">Activity with Position : </span>
                                    @php
                                        $activities_data = json_decode($activity->activities_data);
                                    @endphp
                                    @foreach ($activities_data as $data)
                                        <span class="list-type">
                                            {{ $data->activity }} /
                                            {{ $data->activity_position }}
                                        </span>
                                    @endforeach
                                </span>
                                <span class="span_text">
                                    <span class="span_bold">Activity honor by :</span>
                                    @foreach ($activities_data as $data)
                                        <span class="list-type">
                                            {{ $data->activity_honor_award }} /
                                            {{ $data->activity_location }}
                                        </span>
                                    @endforeach
                            @endif
                            <span class="preview-list"></span>
                            @if (!empty($activity->community_service_data))
                                <span class="span_text">
                                    <span class="span_text">Participation and service : </span>
                                    @php
                                        $community_service_data = json_decode($activity->community_service_data);
                                    @endphp
                                    @foreach ($community_service_data as $data)
                                        <span class="list-type">
                                            {{ $data->participation_level }} /
                                            {{ $data->community_service }}
                                        </span>
                                    @endforeach
                                </span>
                                <span class="span_text">
                                    <span class="span_bold">Community Located at : </span>

                                    @foreach ($community_service_data as $data)
                                        <span class="list-type">
                                            {{ $data->community_location }}
                                        </span>
                                    @endforeach
                                </span>
                                </li>
                            @endif
                        </span>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    </div>
</body>

</html>
