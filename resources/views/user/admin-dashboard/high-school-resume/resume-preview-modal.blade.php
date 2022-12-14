<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content ">
        <div class="block block-rounded block-transparent mb-0">
            <div class="block-header block-header-preview text-border rounded-0">
                <div class="">
                    <h1><span>{{ $personal_info->first_name }}</span> {{ $personal_info->middle_name }} {{ $personal_info->last_name }}</h1>
                </div>
                <div class="block-options">
                    <button type="button" class="btn-block-option close" onclick="$('.showResumePreviewModal').modal('hide');" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="modal-padding custom-tab-container block-content fs-sm">
                <div class="row">
                    <div class="col-lg-4 preview-border">
                        <div class="preview-leftside">
                            <div class="preview-list mb-3">
                                <h3>Contact</h3>
                                <ul class="list">
                                    <li><span   >Email : </span>{{ $personal_info->email }}</li>
                                    <li><span>Cell Phone : </span>{{ $personal_info->cell_phone }}</li>
                                    <li><span>Address 1 : </span>{{ $personal_info->street_address_one }}</li>
                                    <li><span>Address 2 : </span>{{ $personal_info->street_address_two }}</li>
                                    <li><span>Zip Code : </span>{{ $personal_info->zip_code }}</li>
                                    <li><span>City / State : </span>{{ $personal_info->city . ', ' . $personal_info->state }}</li>
                                    <li><span>Parent Email 1  : </span>{{ $personal_info->parent_email_one }}</li>
                                    <li><span>Parent Email 2  : </span>{{ $personal_info->parent_email_two }}</li>
                                    <li><span>Social Link  : </span>{{ $personal_info->social_links[0] }}</li>

                                </ul>
                            </div>
                            @if (!empty($featuredAttribute->featured_skills_data))
                            <div class="preview-list mb-3">
                                <h3>Featured Skills</h3>
                                <ul class="list">
                                    @foreach (json_decode($featuredAttribute->featured_skills_data) as $featured_skills)
                                    <li>{{ $featured_skills->featured_skill }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if (!empty($featuredAttribute->featured_awards_data))
                            <div class="preview-list mb-3">
                                <h3>featured awards</h3>
                                <ul class="list">
                                    @foreach (json_decode($featuredAttribute->featured_awards_data) as $featured_awards)
                                    <li>{{ $featured_awards->featured_award }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if (!empty($featuredAttribute->featured_languages_data))
                            <div class="preview-list mb-3">
                                <h3>featured languages</h3>
                                <ul class="list">
                                    <span>Languages : </span>
                                    @foreach (json_decode($featuredAttribute->featured_languages_data) as $featured_languages)
                                    <li>{{ $featured_languages->featured_language }}</li> , 
                                    @endforeach
                                    
                                </ul>
                            </div>
                            @endif

                            @if (!empty($employmentCertification->significant_data))
                            <div class="preview-list mb-3">
                                <h3>Employment</h3>
                                <ul class="list">
                                    @php
                                    $significant_data = json_decode($employmentCertification->significant_data);
                                    $significant_data_arr = \App\Helpers\Helper::objectToArray($significant_data);
                                    @endphp
                                    <li>
                                        <span>Responsibility or interest </span>
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($significant_data_arr, 'responsibility_interest', ', ') }}
                                        <span> with </span>
                                        {{ implode(',',json_decode(\App\Helpers\Helper::convertMultidimensionalToString($significant_data_arr, 'significant_grade', ', '))) }}

                                        <span> Grades </span>
                                    </li>
                                    <li>
                                        <span>Honor by </span>
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($significant_data_arr, 'significant_honor_award', ', ') }}

                                        <span> at </span>
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($significant_data_arr, 'significant_location', ', ') }}

                                    </li>
                                </ul>
                            </div>
                            @endif
                            @if (!empty($employmentCertification->employment_data))
                            <div class="preview-list mb-3">
                                <h3>Certifications</h3>
                                <ul class="list">
                                    @php
                                    $employment_data = json_decode($employmentCertification->employment_data);
                                    $employment_data_arr = \App\Helpers\Helper::objectToArray($employment_data);
                                    @endphp
                                    <li>
                                        <span>Job </span>
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($employment_data_arr, 'job_title', ', ') }}
                                        <span> with </span>
                                        {{ implode(',',json_decode(\App\Helpers\Helper::convertMultidimensionalToString($employment_data_arr, 'employment_grade', ', '))) }}

                                        <span> grade </span>
                                    </li>
                                    <li>
                                        <span>Honor by </span>
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($employment_data_arr, 'employment_honor_award', ', ') }}

                                        <span> at </span>
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($employment_data_arr, 'employment_location', ', ') }}
                                    </li>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="preview-rightside">
                            @if (!empty($education))
                            <div class="preview-list mb-3">
                                <h3>Education</h3>
                                <ul class="list">
                                    <li><span class="d-block">School Name / City / State  /  District   : </span>
                                        {{ $education->high_school_name }} /
                                        {{ $education->high_school_city }} /
                                        {{ $education->high_school_state }} /
                                        {{ $education->high_school_district }} 

                                    </li>
                                    <li><span>Current Grade : </span>{{ $education->current_grade }} </li>
                                    <li><span>Month : </span>{{ $education->month }} <span>Year : </span>{{ $education->year }}</li>

                                    <li> <span class="d-block"> Weighted GPA / Unweighted GPA :</span>
                                        {{  $education->cumulative_gpa_weighted  }} 
                                        {{  $education->cumulative_gpa_unweighted  }} 
                                    </li>
                                    <li>
                                        <span>Class Rank : </span> 
                                        {{  $education->class_rank  }}
                                    </li>
                                    <li>
                                        <span>Number Of Student : </span>
                                        {{ $education->total_no_of_student}}
                                    </li>
                                    @if (!empty($education->testing_data))
                                    <li>
                                        <span class="d-block">Name and Date of Test:</span>
                                        @php
                                        $testing_data = json_decode($education->testing_data);
                                        $testing_data_arr = \App\Helpers\Helper::objectToArray($testing_data);
                                        @endphp
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($testing_data_arr, 'name_of_test', ', ') }} / 
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($testing_data_arr, 'date', ', ') }}

                                    </li>
                                    @endif
                                    @if (!empty($education->ib_courses))
                                    <li>
                                        <span>IB Courses:</span>
                                        {{ implode(', ', json_decode($education->ib_courses)) }}
                                    </li>
                                    @endif
                                    @if (!empty($education->ap_courses))
                                    <li>
                                        <span>AP Courses:</span>
                                        {{ implode(', ', json_decode($education->ap_courses)) }}
                                    </li>
                                    @endif
                                    @if (!empty($education->honor_course_data))
                                    <li>
                                        <span>Courses:</span>
                                        @php
                                        $honor_course_data = json_decode($education->honor_course_data);
                                        $honor_course_data_arr = \App\Helpers\Helper::objectToArray($honor_course_data);
                                        @endphp
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($honor_course_data_arr, 'honor_course_name', ', ') }}
                                    </li>
                                    @endif
                                    @if (!empty($education->course_data))
                                    <li>
                                        <span>Concurrent Courses:</span>
                                        @php
                                        $course_data = json_decode($education->course_data);
                                        $course_data_arr = \App\Helpers\Helper::objectToArray($course_data);
                                        @endphp
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($course_data_arr, 'course_name', ', ') }}
                                    </li>
                                    @endif
                                   </ul>
                            </div>
                            @endif
                            @if (!empty($honor))
                            <div class="preview-list mb-3">
                                <h3>Honor</h3>
                                <ul class="list">
                                    <li>
                                        <span>Honor Position : </span>
                                        @php
                                        $honor_data = json_decode($honor->honors_data);
                                        $honor_data_arr = \App\Helpers\Helper::objectToArray($honor_data);
                                        @endphp
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($honor_data_arr, 'position', ', ') }}
                                    </li>
                                    <li>
                                        <span class="d-block">Achivement / Grade : </span>
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($honor_data_arr, 'honor_achievement_award', ', ') }} /
                                        {{ implode(',',json_decode(\App\Helpers\Helper::convertMultidimensionalToString($honor_data_arr, 'grade', ', '))) }} 

                                    </li>
                                    <li>
                                        <span>Location : </span>
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($honor_data_arr, 'location', ', ') }}

                                    </li>
                                    @if (isset($education->intended_college_major))
                                    <li>
                                        <span>Intended College Major(s):</span>
                                        {{ $education->intended_college_major }}
                                    </li>
                                    @endif
                                    @if (isset($education->intended_college_major))
                                    <li>
                                        <span>Intended College Minor(s):</span>
                                        {{ $education->intended_college_minor }}
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            @endif
                            @if (!empty($activity))
                            <div class="preview-list mb-3">
                                <h3>Activities</h3>
                                <ul class="list">
                                   
                                    @if (!empty($activity->demonstrated_data))
                                    <li>
                                        <span class="d-block">Demostrated <U>Interests</U> and <U>Position</U> in the Area of my College
                                            Major :</span>
                                        @php
                                        $demonstrated_data = json_decode($activity->demonstrated_data);
                                        $demonstrated_data_arr = \App\Helpers\Helper::objectToArray($demonstrated_data);
                                        @endphp
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($demonstrated_data_arr, 'interest', ', ') }} / 
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($demonstrated_data_arr, 'position', ', ') }}
                                    </li>
                                    <li>
                                        <span class="d-block">Grade and Location with Details : </span>
                                        {{ implode(',',json_decode(\App\Helpers\Helper::convertMultidimensionalToString($demonstrated_data_arr, 'grade', ', '))) }} / 
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($demonstrated_data_arr, 'location', ', ') }} / 
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($demonstrated_data_arr, 'details', ', ') }}

                                    </li>
                                    @endif
                                    @if (!empty($activity->leadership_data))
                                    <li>
                                        <span>Leadership status with Position : </span>
                                        @php
                                        $leadership_data = json_decode($activity->leadership_data);
                                        $leadership_data_arr = \App\Helpers\Helper::objectToArray($leadership_data);
                                        @endphp
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($leadership_data_arr, 'leadership_status', ', ') }} / 
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($leadership_data_arr, 'leadership_position', ', ') }} 

                                    </li>
                                    <li>
                                        <span>Organized By </span>
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($leadership_data_arr, 'leadership_organization', ', ') }}
                                        <span> in </span>
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($leadership_data_arr, 'leadership_location', ', ') }}

                                    </li>
                                    @endif
                                    @if (!empty($activity->athletics_data))
                                    <li>
                                        <span>Athletics status with Position : </span>
                                        @php
                                        $athletics_data = json_decode($activity->athletics_data);
                                        $athletics_data_arr = \App\Helpers\Helper::objectToArray($athletics_data);
                                        @endphp
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($athletics_data_arr, 'athletics_activity', ', ') }} /   
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($athletics_data_arr, 'athletics_position', ', ') }}

                                    </li>
                                    <li>
                                        <span>Athletics honor by </span>
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($athletics_data_arr, 'athletics_honor', ', ') }}  
                                        <span>in</span>
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($athletics_data_arr, 'athletics_location', ', ') }}  
                                    </li>
                                    @endif
                                    
                                    @if (!empty($activity->activities_data))
                                    <li>
                                        <span>Activity with Position : </span>
                                        @php
                                        $activities_data = json_decode($activity->activities_data);
                                        $activities_data_arr = \App\Helpers\Helper::objectToArray($activities_data);
                                        @endphp
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($activities_data_arr, 'activity', ', ') }} /   
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($activities_data_arr, 'activity_position', ', ') }}
                                    </li>
                                    <li>
                                        <span>Activity honor by </span>
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($activities_data_arr, 'activity_honor_award', ', ') }} 
                                        <span>at</span>
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($activities_data_arr, 'activity_location', ', ') }} 


                                    </li>
                                    @endif

                                    @if (!empty($activity->community_service_data))
                                    <li>
                                        <span>Participation and service : </span>
                                        @php
                                        $community_service_data = json_decode($activity->community_service_data);
                                        $community_service_data_arr = \App\Helpers\Helper::objectToArray($community_service_data);
                                        @endphp
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($community_service_data_arr, 'participation_level', ', ') }} /   
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($community_service_data_arr, 'community_service', ', ') }}
                                    </li>
                                    <li>
                                        <span>Community Located at : </span>
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($community_service_data_arr, 'community_location', ', ') }}

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