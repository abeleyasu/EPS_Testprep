<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HSR | Resume Preview : CPS</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .details .section:last-of-type {
            margin-bottom: 0px;
        }

        .details .section__title {
            font-size: 14px;
            color: #1f2937;
            margin-bottom: 10px;
            text-transform: uppercase;
            font-weight: bold;
        }


        .details .left,
        .details .right {
            vertical-align: top;
            display: inline-block;
        }

        .details .left {
            width: 30%;
            border-right: 1px solid #1f2937;
            padding-right: 50px
        }

        .details .right {
            width: 60%;
            padding-left: 15px
        }

        span {
            font-weight: 700;
        }

        div {
            margin-right: 0;
            display: block;
            text-align: left;
            color: #1f2937;
            cursor: unset;
            font-size: 14px;
            margin-bottom: 3px
        }

        .section_margin,.section_right_margin{
            margin-bottom: 20px
        }
    </style>
</head>

<body>
    <p style="border-bottom: 1px solid #1f2937; margin-bottom: 20px; text-align:left;padding-bottom:10px;color: #1f2937;font-size:2.25rem">
        <b>{{ $personal_info->first_name }}<b> {{ $personal_info->last_name }}
    </p>
    <div class="details">
        <div class="section">
            <div class="section__list">
                <div class="section__list-item">
                    <div class="left section_margin">
                        <div class="section_margin">
                            <div class="section__title">CONTACT</div>
                            <div>{{ $personal_info->email }}</div>
                            <div>{{ $personal_info->cell_phone }}</div>
                            <div>{{ $personal_info->street_address_one }}</div>
                            <div>{{ $personal_info->street_address_two }}</div>
                            <div>{{ $personal_info->zip_code }}</div>
                            <div>{{ $personal_info->city .", ". $personal_info->state }}</div>
                        </div>
                        @if(!empty($featuredAttribute->featured_skills_data))
                            <div class="section_margin">
                                <div class="section__title">FEATURED SKILLS</div>
                                @foreach(json_decode($featuredAttribute->featured_skills_data) as $featured_skills)
                                    <div>{{ $featured_skills->featured_skill }}</div>
                                @endforeach
                            </div>
                        @endif
                        @if(!empty($featuredAttribute->featured_awards_data))
                            <div class="section_margin">
                                <div class="section__title">FEATURED AWARDS</div>
                                @foreach(json_decode($featuredAttribute->featured_awards_data) as $featured_awards)
                                    <div>{{ $featured_awards->featured_award }}</div>
                                @endforeach
                            </div>
                        @endif
                        @if(!empty($featuredAttribute->featured_languages_data))
                            <div class="section_margin">
                                <div class="section__title">FEATURED LANGUAGES</div>
                                @foreach(json_decode($featuredAttribute->featured_languages_data) as $featured_languages)
                                    <div>{{ $featured_languages->featured_language }}</div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="right section_margin">
                        @if(!empty($education))
                            <div class="section_right_margin">
                                <div class="section__title">EDUCATION</div>
                                <div>{{ $education->high_school_name }} / {{ $education->high_school_city }} / {{ $education->high_school_state }}</div>
                                <div>Weighted GPA: {{ isset($education->cumulative_gpa_weighted) ? $education->cumulative_gpa_weighted : '-' }}, Class Rank: {{ isset($education->class_rank) ? $education->class_rank : '-' }}</div>
                                <div>
                                    <span>Name of Test: </span> 
                                    @php
                                        $testing_data = json_decode($education->testing_data);
                                        $testing_data_arr = \App\Helpers\Helper::objectToArray($testing_data);
                                    @endphp
                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($testing_data_arr, 'name_of_test', ', ') }}
                                </div>
                                @if(!empty($education->ib_courses))
                                    <div>
                                        <span>IB Courses: </span> 
                                        {{ implode(", ", json_decode($education->ib_courses)) }}
                                    </div>
                                @endif
                                @if(!empty($education->ap_courses))
                                    <div>
                                        <span>AP Courses: </span> 
                                        {{ implode(", ", json_decode($education->ap_courses)) }}
                                    </div>
                                @endif
                                @if(!empty($education->honor_course_data))
                                    <div>
                                        <span>Honors Courses: </span> 
                                        @php
                                            $honor_course_data = json_decode($education->honor_course_data);
                                            $honor_course_data_arr = \App\Helpers\Helper::objectToArray($honor_course_data);
                                        @endphp
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($honor_course_data_arr, 'honor_course_name', ', ') }}
                                    </div>
                                @endif
                                @if(!empty($education->course_data))
                                    <div>
                                        <span>Concurrent Courses: </span>
                                        @php
                                            $course_data = json_decode($education->course_data);
                                            $course_data_arr = \App\Helpers\Helper::objectToArray($course_data);
                                        @endphp
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($course_data_arr, 'course_name', ', ') }}
                                    </div>
                                @endif
                            </div>
                        @endif
                        @if(!empty($activity))
                            <div class="section_right_margin">
                                <div class="section__title">ACTIVITIES</div>
                                @if(isset($education->intended_college_major))
                                    <div>
                                        <span>Intended College Major(s):  </span> 
                                        {{ $education->intended_college_major }}
                                    </div>
                                @endif
                                @if(isset($education->intended_college_major))
                                    <div>
                                        <span>Intended College Minor(s): </span> 
                                        {{ $education->intended_college_minor }}
                                    </div>
                                @endif
                                @if(!empty($activity->demonstrated_data))
                                    <div>
                                        <span>Demostrated Interests in the Area of my College Major: </span> 
                                        @php
                                            $demonstrated_data = json_decode($activity->demonstrated_data);
                                            $demonstrated_data_arr = \App\Helpers\Helper::objectToArray($demonstrated_data);
                                        @endphp
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($demonstrated_data_arr, 'interest', ', ') }}
                                    </div>
                                @endif
                                @if(!empty($activity->leadership_data))
                                    <div>
                                        <span>Leadership: </span> 
                                        @php
                                            $leadership_data = json_decode($activity->leadership_data);
                                            $leadership_data_arr = \App\Helpers\Helper::objectToArray($leadership_data);
                                        @endphp
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($leadership_data_arr, 'leadership_organization', ', ') }}
                                    </div>
                                @endif
                                @if(!empty($activity->athletics_data))
                                    <div>
                                        <span>Athletics: </span> 
                                        @php
                                            $athletics_data = json_decode($activity->athletics_data);
                                            $athletics_data_arr = \App\Helpers\Helper::objectToArray($athletics_data);
                                        @endphp
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($athletics_data_arr, 'athletics_activity', ', ') }}
                                    </div>
                                @endif
                            </div>
                        @endif
                        @if(!empty($employmentCertification))
                            @if(!empty($employmentCertification->significant_data))
                                <div class="section_right_margin">
                                    <div class="section__title">EMPLOYMENT</div>
                                    @php
                                        $significant_data = json_decode($employmentCertification->significant_data);
                                        $significant_data_arr = \App\Helpers\Helper::objectToArray($significant_data);
                                    @endphp
                                    <div>{{ \App\Helpers\Helper::convertMultidimensionalToString($significant_data_arr, 'responsibility_interest', ', ') }}</div>
                                </div>
                            @endif
                            @if(!empty($employmentCertification->employment_data))
                                <div class="section_right_margin">
                                    <div class="section__title">CERTIFICATIONS</div>
                                    @php
                                        $employment_data = json_decode($employmentCertification->employment_data);
                                        $employment_data_arr = \App\Helpers\Helper::objectToArray($employment_data);
                                    @endphp
                                    <div>{{ \App\Helpers\Helper::convertMultidimensionalToString($employment_data_arr, 'job_title', ', ') }}</div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
