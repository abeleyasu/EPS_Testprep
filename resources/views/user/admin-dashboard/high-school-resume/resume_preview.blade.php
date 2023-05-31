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
		
		.resume-heading {
			color: DodgerBlue !important;
			letter-spacing: normal !important;
			margin-bottom: 10px !important;
			margin-top: 20px !important;
		}
    </style>
</head>

<body>
    <div style="margin-bottom: 0">
        <div
            style="font-weight:400; padding:10px 50px 10px; text-align:left;color: #43464c;font-size:2.25rem;margin-top: 0; margin-bottom:0">
            <b>{{ $personal_info->first_name }}<b> {{ $personal_info->middle_name }} {{ $personal_info->last_name }} {{ isset($personal_info->nick_name) && $personal_info->nick_name != null ? "(" .$personal_info->nick_name. ")" : ''}}
                </b>
            <span style="display: block; font-size: 12px; margin-top: 10px; margin-bottom: 10px; font-weight: 400;" >
                @if(isset($personal_info->street_address_one) || isset($personal_info->street_address_two) || isset($personal_info->zip_code))
                    <li style="display: flex">
                        <span class="span_list">
                            <img
                                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Image/location.svg'))) }} " style="width: 8px; margin-top: 2px">
                        </span>
                        <span>
                            {{ isset($personal_info->street_address_one) ? $personal_info->street_address_one . ',' : '' }}
                            {{ isset($personal_info->street_address_two) ? $personal_info->street_address_two . ',' : '' }}
                            {{ $personal_info->city . ',' }}
                            {{ $personal_info->state }}
                            {{ isset($personal_info->zip_code) ? $personal_info->zip_code : '' }}
                        </span>
                    </li>
                @endif  
            </span>
            <p style="display: inline-block !important; font-size: 12px; margin-top: 5px; font-weight: 400;margin-top:0 ;margin-bottom:0">
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
				<hr style = "margin-top:0; margin-bottom:0"/>
            </p>
        </div>
    </div>
    <div class="clear-both" style="margin-top: 0">  
		
		{{-- sbz Starts here --}}
		@if (!empty($featured_skills_data) || !empty($featured_awards_data) || !empty($featured_languages_data) || !empty($dual_citizenship_data))
		<div class="row">
			<div class="col">
				@if (!empty($featured_skills_data))
					<div class="preview-list">
						@if ($featuredAttribute)
							<h3 class='resume-heading'>FEATURED</h3>
						@endif
						<span class="span_text">
							<span class="span_bold">Skills:</span>
								@php
								$skills = implode("; ", array_column($featuredAttribute->featured_skills_data, "skill"));
									echo "$skills";
								@endphp
						</span>
					</div>
				@endif
				@if (!empty($featured_awards_data))
					<div class="preview-list">
						@if ($featuredAttribute->featured_awards_data[0]['award'] != null)
							<span class="span_text">
								<span class="span_bold">Awards:</span>
								@php
								$awards = implode("; ", array_column($featuredAttribute->featured_awards_data, "award"));
								echo "$awards";
								@endphp
							</span>
						@endif
					</div>
				@endif
				@if (!empty($featured_languages_data))
					<div class="preview-list">
						<span class="span_text">
							<span class="span_bold">Languages:</span>
							@php
							$languages = implode("; ", array_column($featuredAttribute->featured_languages_data, "language"));
							echo "$languages";
							@endphp
						</span>
					</div>
				@endif
				@if (!empty($dual_citizenship_data))
					<div class="preview-list">
						<span class="span_text">
							<span class="span_bold">Dual Citizen:</span>
							@php
							$countries = implode(", ", array_column($featuredAttribute->dual_citizenship_data, "country"));
							echo "$countries";
							@endphp
						</span>
					</div>
				@endif
			</div>
		</div>
		@endif
		
		@if (!empty($education)) 
		<div class="row">
			<div class="col">
				<div class="preview-list">
					<h3 class='resume-heading'>EDUCATION</h3>
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
                                @if ($education->graduation_designation === 'Other')
                                    @if (isset($education->other_graduation_designation) && $education->other_graduation_designation != null)
                                        ({{$education->other_graduation_designation}})	
                                    @endif
                                @else
                                    ({{$education->graduation_designation}})
                                @endif
                            @endif
						</span>
						<span class="span_text">
                            <b>GPA: </b>
                            Unweighted: {{ $education->cumulative_gpa_unweighted }};Weighted: {{ $education->cumulative_gpa_weighted }};@if(!empty($education->class_rank) || !empty($education->total_no_of_student))<b>Class Rank:</b>
                                {{ $education->class_rank }} /
                                {{ $education->total_no_of_student }}
                            @endif
                        </span>
                        @if (!empty($testing_data))
                            <span class="span_text">
                                @php
                                    $count = count($testing_data);
                                    foreach ($testing_data as $key => $data) {
                                        if(isset($data['name_of_test'])) {
                                            echo "<b>".$data['name_of_test']."</b>: ";
                                            if(isset($data['results_score'])) {
                                                echo $data['results_score'];
                                                if ($key !== $count - 1)
                                                    echo ";";
                                            }
                                        }
                                            
                                    }
                                @endphp
							</span>
                        @endif

                        <span class="span_text">
                            <span class="span_bold">Current Grade:</span>{{ implode(',', $current_grade) }}
                        </span>

                        {{-- <span class="span_text">
                            <span class="span_bold">Month / Year :
                            </span>
                            {{ $education->month }} / {{ $education->year }}
                        </span> --}}
                        @if (!empty($education->ib_courses))
                            <span class="span_text">
                                <span class="span_bold">IB Courses</span>:
                                    {{-- {{ implode(',', $ib_courses) }} --}}
                                    @foreach ($education->ib_courses as $ib_course)<b>{{ isset($ib_course['name_of_ib_course']) ? $ib_course['name_of_ib_course'] : '' }}</b>: {{ isset($ib_course['score_of_test']) ? $ib_course['score_of_test'] : ''}}{{ !$loop->last ? ';' : '' }}@endforeach
                            </span>
                        @endif
                        @if (!empty($education->ap_courses))
                            <span class="span_text">
                                <span class="span_bold">AP Courses</span>:
                                    {{-- {{ implode(',', $ap_courses) }} --}}
                                    @foreach ($education->ap_courses as $ap_course)<b>{{ isset($ap_course['name_of_ap_course']) ? $ap_course['name_of_ap_course'] : '' }}</b>: {{ isset($ap_course['score_of_test']) ? $ap_course['score_of_test'] : ''}}{{ !$loop->last ? ';' : '' }}@endforeach
                            </span>
                        @endif
                        @if (!empty($education->honor_course_data))
                            <span class="span_text">
                                <span class="span_bold">Honors Course</span>:
                                    @php
                                        $count = count($education->honor_course_data);
                                        foreach ($education->honor_course_data as $index =>$honor_course_data) {
                                            if(isset($honor_course_data['course_data']) && !empty($honor_course_data['course_data']))
                                            {
                                                echo \App\Helpers\Helper::getHonorCourseByIdArray($honor_course_data['course_data']);
                                                if ($index !== $count - 1)
                                                    echo ";";
                                            }
                                        }
                                    @endphp
                            </span>
                        @endif
                        @if (!empty($course_data))
                            <span class="span_text">
                                <span class="span_bold">Concurrent Enrollment</span>:
                                @php
                                    foreach ($college_list as $college) {
                                        echo \App\Helpers\Helper::getCollegeNameByIdArray($college);
                                        $count = count($education->course_data);
                                        foreach ($education->course_data as $key => $course_data) {
                                            if (isset($course_data['search_college_name'])) {
                                                if (in_array($college, $course_data['search_college_name'])) {
                                                    College:
                                                    if (isset($course_data['course_name'])) {
                                                        echo $course_data['course_name'];
                                                        if ($key !== $count - 1)
                                                            echo ";";
                                                    }
                                                }
                                            }
                                        }
                                    }
                                @endphp
                            </span>
                        @endif
                        <span>
                            @if (!empty($intended_major))
                                <span class="span_text">
                                    <span class="span_bold">Intended College Major(s):</span>
                                        {{ implode(', ', $intended_major) }}
                                </span>
                            @endif
                            @if (!empty($intended_major))
                                <span class="span_text">
                                    <span class="span_bold">Intended College Minor(s):</span>
                                        {{ implode(', ', $intended_minor) }}
                                </span>
                            @endif
                        </span>
                    </span>
                </div>
			</div>
		</div>
		@endif
		
		@if (!empty($honor))
		<div class="row">
			<div class="col">
				<div class="preview-list">
					<h3 class='resume-heading'>HONORS, ACHIEVEMENTS & AWARDS</h3>
					@foreach ($honor->honors_data as $honor_data)
						<span class="span_text">
							@if(isset($honor_data['grade']) && !empty($honor_data['grade']))
								<b>{{ \App\Helpers\Helper::getGradeByIdArray($honor_data['grade']) }}: </b>
							@endif
							{{ $honor_data['position'] }},
							{{ $honor_data['honor_achievement_award'] }},
							{{ $honor_data['location'] }}
						</span>
					@endforeach
				</div>
			</div>
		</div>
		@endif
		
		@if (!empty($activity))
		<div class="row">
			<div class="col">
				<div class="preview-list">
					<h3 class='resume-heading'>ACTIVITIES</h3>
					@if (!empty($demonstrated_data))
						@foreach ($demonstrated_data as $data)
							<span class="span_text">
								<b>{{isset($data['grade']) && $data['grade'] != null ? (\App\Helpers\Helper::getGradeByIdArray($data['grade'])) : ''}}: </b>
                                @if(isset($data['position']) && !empty($data['position'])) 
                                    {{ $data['position'] }}@if((isset($data['interest']) && !empty($data['interest'])) || (isset($data['location']) && !empty($data['location'])) || (isset($data['details']) && !empty($data['details']))),@endif
                                @endif
                                @if(isset($data['interest']) && !empty($data['interest'])) 
                                    {{ $data['interest'] }}@if((isset($data['details']) && !empty($data['details'])) || (isset($data['location']) && !empty($data['location']))),@endif
                                @endif
                                @if(isset($data['location']) && !empty($data['location'])) 
                                    {{ $data['location'] }}@if(isset($data['details']) && !empty($data['details'])),@endif
                                @endif
                                @if(isset($data['details']) && !empty($data['details']))
                                    {{ $data['details'] }}
                                @endif 
							</span>
						@endforeach
					@endif
					@if(!empty($leadership_data))
						@foreach($leadership_data as $data)
                            <span class="span_text">
                                @if(isset($data['grade']) && !empty($data['grade']))
                                    <b>{{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}: </b>
                                @endif
                                @if(isset($data['status']) && !empty($data['status']))
                                    {{ $data['status'] }}@if((isset($data['position']) && !empty($data['position']) || (isset($data['location']) && !empty($data['location'])) || (isset($data['organization']) && !empty($data['organization'])))),@endif
                                @endif
                                @if(isset($data['position']) && !empty($data['position']))
                                    {{ $data['position'] }}@if((isset($data['location']) && !empty($data['location'])) || (isset($data['organization']) && !empty($data['organization']))),@endif
                                @endif
                                @if(isset($data['location']) && !empty($data['location']))
                                    {{ $data['location'] }}@if(isset($data['organization']) && !empty($data['organization'])),@endif
                                @endif
                                @if(isset($data['organization']) && !empty($data['organization']))
                                    {{ $data['organization'] }}
                                @endif
                            </span>
                        @endforeach  
					@endif
					@if(!empty($activities_data))
						@foreach ($activities_data as $data)
							<span class="span_text">
								@if(isset($data['grade']) && !empty($data['grade']))
                                    <b>{{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}: </b>
                                @endif
                                @if(isset($data['position']) && !empty($data['position']))
                                    {{ $data['position'] }}@if((isset($data['activity']) && !empty($data['activity'])) || (isset($data['location']) && !empty($data['location'])) || (isset($data['honor_award']) && !empty($data['honor_award']))),@endif
                                @endif
                                @if(isset($data['activity']) && !empty($data['activity']))
                                    {{ $data['activity'] }}@if((isset($data['location']) && !empty($data['location'])) || (isset($data['honor_award']) && !empty($data['honor_award']))),@endif
                                @endif
                                @if(isset($data['location']) && !empty($data['location']))
                                    {{ $data['location'] }}@if(isset($data['honor_award']) && !empty($data['honor_award'])),@endif
                                @endif
                                @if(isset($data['honor_award']) && !empty($data['honor_award']))
                                    {{ $data['honor_award'] }}
                                @endif
							</span>  
						@endforeach  
					@endif
				</div>
			</div>
		</div>
		@endif
		
		@if(!empty($athletics_data))  
		<div class="row">
			<div class="col">
				<div class="preview-list">
					<h3 class='resume-heading'>ATHLETICS</h3>
					@foreach ($athletics_data as $data)
						<span class="span_text">
							@if(isset($data['grade']) && !empty($data['grade']))
                                <b>{{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}:</b>
                            @endif
                            @if(isset($data['position']) && !empty($data['position']))
                                {{ $data['position'] }}@if((isset($data['activity']) && !empty($data['activity'])) || (isset($data['location']) && !empty($data['location'])) || (isset($data['honor']) && !empty($data['honor']))),@endif
                            @endif
                            @if(isset($data['activity']) && !empty($data['activity']))
                                {{ $data['activity'] }}@if((isset($data['location']) && !empty($data['location'])) || (isset($data['honor']) &&  !empty($data['honor']))),@endif
                            @endif
                            @if(isset($data['location']) && !empty($data['location']))
                                {{ $data['location'] }}@if(isset($data['honor']) && !empty($data['honor'])),@endif
                            @endif
                            @if(isset($data['honor']) && !empty($data['honor']))
                                {{ $data['honor'] }}
                            @endif
						</span>
					@endforeach    
				</div>
			</div>
		</div>
		@endif
		
		@if(!empty($community_service_data))
		<div class="row">
			<div class="col">
				<div class="preview-list">
					<h3 class='resume-heading'>COMMUNITY SERVICE</h3>
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
					<span class="span_text">
						@if(isset($data['grade']) && !empty($data['grade']))
							<b>{{ \App\Helpers\Helper::getGradeAllByIdArray($community_service_array['grade']) }}: </b>
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
				</div>
			</div>
		</div>
		@endif
		
		@if (!empty($employment_data)) 
		<div class="row">
			<div class="col">
				<div class="preview-list">
					<h3 class='resume-heading'>EMPLOYMENT</h3>
					@foreach ($employment_data as $data)
						<span class="span_text">
							@if(isset($data['grade']) && !empty($data['grade']))
                                <b>{{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}: </b>
                            @endif
                            @if(isset($data['job_title']) && !is_null($data['job_title']))
                                {{ $data['job_title'] }}@if((isset($data['name_of_company']) && (isset($data['name_of_company']) && !is_null($data['name_of_company']))) || (isset($data['location']) && !is_null($data['location'])) || (isset($data['honor_award']) && !is_null($data['honor_award']))),@endif
                            @endif
                            @if(isset($data['name_of_company']) && !is_null($data['name_of_company']))
                                {{ $data['name_of_company'] }}@if((isset($data['location']) && !is_null($data['location'])) || (isset($data['honor_award']) && !is_null($data['honor_award']))),@endif
                            @endif
                            @if(isset($data['location']) && !is_null($data['location']))
                                {{ $data['location'] }}@if(isset($data['honor_award']) && !is_null($data['honor_award'])),@endif
                            @endif
                            @if(isset($data['honor_award']) && !is_null($data['honor_award']))
                                {{ $data['honor_award'] }}
                            @endif
						</span>
					@endforeach
				</div>
			</div>
		</div>
		@endif
		
		@if (!empty($significant_data)) 
		<div class="row">
			<div class="col">
				<div class="preview-list">
					<h3 class='resume-heading'>RESPONSIBILITIES OR INTERESTS</h3>
					@foreach ($significant_data as $data)
						<span class="span_text">
							@if(isset($data['grade']) && !empty($data['grade']))
								<b>{{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}: </b>
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
					@endforeach
				</div>
			</div>
		</div>
		@endif
		
		{{-- sbz ends here --}}
		
</body>

</html>