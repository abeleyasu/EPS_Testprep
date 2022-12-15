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
            <div class="modal-padding custom-tab-container px-0  block-content fs-sm">
                    <div class="printableArea_main">
                        <div class="row">
                            <div class="col-lg-5 preview-border p-0">
                                <div class="preview-leftside ">
                                    <div class="preview-list position-relative ps-0 contact-list-after">
                                        <h3>Contact</h3>
                                        <ul class="list">
                                            <li><span><i class="fa-solid fa-envelope-open-text"></i>
                                                </span>{{ $personal_info->email }}</li>
                                            <li><span><i class="fa-solid fa-phone"></i>
                                                </span>{{ $personal_info->cell_phone }}</li>
                                            <li class="d-flex"><span><i class="fa-solid fa-location-dot"></i>
                                                </span>
                                                <div class="ms-2">
                                                    <span class="d-block">Address1 / Address2 / Zip Code :</span>
                                                    {{ $personal_info->street_address_one }} /
                                                    {{ $personal_info->street_address_two }} /
                                                    {{ $personal_info->zip_code }}
                                                </div>
                                            </li>

                                            <li class="d-flex mb-2"><span><i
                                                        class="fa-solid fa-envelope-open-text"></i>
                                                </span>
                                                <div class="ms-2">
                                                    <span class="d-block">Parent Email 1 / Parent Email 2 </span>
                                                    {{ $personal_info->parent_email_one }} /
                                                    {{ $personal_info->parent_email_two }}
                                                </div>
                                            </li>
                                            <li class="d-flex mb-2"><span><i class="fa-solid fa-location-dot"></i>
                                                </span>
                                                <div class="ms-2">
                                                    <span class="d-block">City / State </span>
                                                    {{ $personal_info->city . ', ' . $personal_info->state }}
                                                </div>
                                            </li>
                                            <li class="d-flex "><span> <i class="fa-solid fa-link"></i> </span>
                                                <div class="ms-2">
                                                    <span class="d-block">Social Links :</span>
                                                    <div class="list_group">
                                                        <ul class="list_items">
                                                            <li class="list-type">
                                                                {{ $personal_info->social_links[0] }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    @if (!empty($featuredAttribute->featured_skills_data))
                                        <div class="preview-list position-relative features-list-after ps-0 pb-3 mb-0 border-bottom-0">
                                            <h3>Features</h3>
                                            <div class="preview-list_skill">
                                                <h2>Featured Skills</h2>
                                                <ul class="list">
                                                    @foreach (json_decode($featuredAttribute->featured_skills_data) as $featured_skills)
                                                        <div class="list_group">
                                                            <ul class="list_items">
                                                                <li class="list-type">
                                                                    {{ $featured_skills->featured_skill }}</li>
                                                            </ul>
                                                        </div>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                    @if (!empty($featuredAttribute->featured_awards_data))
                                        <div class="preview-list pb-3 ps-0 mb-0 border-bottom-0">
                                            <div class="preview-list_skill">
                                                <h2>Featured awards</h2>
                                                <ul class="list">
                                                    @foreach (json_decode($featuredAttribute->featured_awards_data) as $featured_awards)
                                                        <div class="list_group">
                                                            <ul class="list_items">
                                                                <li class="list-type">
                                                                    {{ $featured_awards->featured_award }}</li>

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
                                                            {{-- <span>Languages : </span> --}}
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
                                                    $employment_data_arr = \App\Helpers\Helper::objectToArray($employment_data);
                                                @endphp
                                                <li class="list-type">
                                                    <span>Job </span>
                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($employment_data_arr, 'job_title', ', ') }}
                                                    <span> with </span>
                                                    {{ implode(',', json_decode(\App\Helpers\Helper::convertMultidimensionalToString($employment_data_arr, 'employment_grade', ', '))) }}

                                                    <span> grade </span>
                                                </li>
                                                <li class="list-type">
                                                    <span>Honor by </span>
                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($employment_data_arr, 'employment_honor_award', ', ') }}

                                                    <span> at </span>
                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($employment_data_arr, 'employment_location', ', ') }}
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                    @if (!empty($employmentCertification->employment_data))
                                        <div class="preview-list position-relative list_group ps-0 honor-list-after">
                                            <h3>Responsibilities or interests</h3>
                                            <ul class="list_items">
                                                @php
                                                    $significant_data = json_decode($employmentCertification->significant_data);
                                                    $significant_data_arr = \App\Helpers\Helper::objectToArray($significant_data);
                                                @endphp
                                                <li class="list-type">
                                                    <span>Responsibility or interest: </span>
                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($significant_data_arr, 'responsibility_interest', ', ') }},
                                                    <span> with </span>
                                                    {{ implode(',', json_decode(\App\Helpers\Helper::convertMultidimensionalToString($significant_data_arr, 'significant_grade', ', '))) }}

                                                    <span> Grades </span>
                                                </li>
                                                <li class="list-type">
                                                    <span>Honor by </span>
                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($significant_data_arr, 'significant_honor_award', ', ') }}

                                                    <span> at </span>
                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($significant_data_arr, 'significant_location', ', ') }}

                                                </li>

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
                                                            <li class="list-type"> @php
                                                                $honor_data = json_decode($honor->honors_data);
                                                                $honor_data_arr = \App\Helpers\Helper::objectToArray($honor_data);
                                                            @endphp
                                                                {{ \App\Helpers\Helper::convertMultidimensionalToString($honor_data_arr, 'position', ', ') }}
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </li>
                                                <li>
                                                    <span class="d-block">Achivement / Grade : </span>
                                                    <div class="list_group">
                                                        <ul class="list_items">
                                                            <li class="list-type">
                                                                {{ \App\Helpers\Helper::convertMultidimensionalToString($honor_data_arr, 'honor_achievement_award', ', ') }}
                                                                /
                                                                {{ implode(',', json_decode(\App\Helpers\Helper::convertMultidimensionalToString($honor_data_arr, 'grade', ', '))) }}

                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span>Location : </span>
                                                    <div class="list_group">
                                                        <ul class="list_items">
                                                            <li class="list-type">
                                                                {{ \App\Helpers\Helper::convertMultidimensionalToString($honor_data_arr, 'location', ', ') }}
                                                            </li>
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
                                                <li><span>Graduated in high school :</span> True</li>
                                                <li><span>Grade Level / College Name :
                                                    </span>
                                                    a+ /
                                                    mahavir /
                                                </li>
                                                <li><span> College City / College State :
                                                    </span>
                                                    Surat /
                                                    gujarat /
                                                </li>
                                                <li><span class="d-block mb-2">School Name / City / State /
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
                                                        <span> Honors Course :</span>
                                                        <div class="list_group">
                                                            <ul class="list_items">
                                                                <li class="list-type"> @php
                                                                    $honor_course_data = json_decode($education->honor_course_data);
                                                                    $honor_course_data_arr = \App\Helpers\Helper::objectToArray($honor_course_data);
                                                                @endphp
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($honor_course_data_arr, 'honor_course_name', ', ') }}
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </li>
                                                @endif
                                                @if (!empty($education->course_data))
                                                    <li>
                                                        <span>Course : </span>
                                                        <div class="list_group">
                                                            <ul class="list_items">
                                                                <li class="list-type">@php
                                                                    $course_data = json_decode($education->course_data);
                                                                    $course_data_arr = \App\Helpers\Helper::objectToArray($course_data);
                                                                @endphp
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($course_data_arr, 'course_name', ', ') }}
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </li>
                                                @endif
                                                @if (!empty($education->testing_data))
                                                    <li>
                                                        <span class="d-block mb-2">Name and Date of Test:</span>
                                                        <div class="list_group">
                                                            <ul class="list_items">
                                                                <li class="list-type"> @php
                                                                    $testing_data = json_decode($education->testing_data);
                                                                    $testing_data_arr = \App\Helpers\Helper::objectToArray($testing_data);
                                                                @endphp
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($testing_data_arr, 'name_of_test', ', ') }}
                                                                    /
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($testing_data_arr, 'date', ', ') }}
                                                                </li>
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
                                                        <span class="d-block">Demostrated <U>Interests</U> and
                                                            <U>Position</U> in the Area of my College
                                                            Major :</span>
                                                        <div class="list_group">
                                                            <ul class="list_items">
                                                                <li class="list-type"> @php
                                                                    $demonstrated_data = json_decode($activity->demonstrated_data);
                                                                    $demonstrated_data_arr = \App\Helpers\Helper::objectToArray($demonstrated_data);
                                                                @endphp
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($demonstrated_data_arr, 'interest', ', ') }}
                                                                    /
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($demonstrated_data_arr, 'position', ', ') }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <span class="d-block">Grade and Location with Details :
                                                        </span>
                                                        <div class="list_group">
                                                            <ul class="list_items">
                                                                <li class="list-type">
                                                                    {{ implode(',', json_decode(\App\Helpers\Helper::convertMultidimensionalToString($demonstrated_data_arr, 'grade', ', '))) }}
                                                                    /
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($demonstrated_data_arr, 'location', ', ') }}
                                                                    /
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($demonstrated_data_arr, 'details', ', ') }}
                                                                </li>
                                                            </ul>
                                                        </div>


                                                    </li>
                                                @endif
                                                @if (!empty($activity->leadership_data))
                                                    <li>
                                                        <span>Leadership status with Position : </span>
                                                        <div class="list_group">
                                                            <ul class="list_items">
                                                                <li class="list-type">
                                                                    @php
                                                                        $leadership_data = json_decode($activity->leadership_data);
                                                                        $leadership_data_arr = \App\Helpers\Helper::objectToArray($leadership_data);
                                                                    @endphp
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($leadership_data_arr, 'leadership_status', ', ') }}
                                                                    /
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($leadership_data_arr, 'leadership_position', ', ') }}
                                                                </li>
                                                            </ul>
                                                        </div>


                                                    </li>
                                                    <li>
                                                        <span>Organized By </span>
                                                        <div class="list_group">
                                                            <ul class="list_items">
                                                                <li class="list-type">
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($leadership_data_arr, 'leadership_organization', ', ') }}
                                                                    <span> in </span>
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($leadership_data_arr, 'leadership_location', ', ') }}
                                                                </li>
                                                            </ul>
                                                        </div>


                                                    </li>
                                                @endif
                                                @if (!empty($activity->athletics_data))
                                                    <li>
                                                        <span>Athletics status with Position : </span>
                                                        <div class="list_group">
                                                            <ul class="list_items">
                                                                <li class="list-type">
                                                                    @php
                                                                        $athletics_data = json_decode($activity->athletics_data);
                                                                        $athletics_data_arr = \App\Helpers\Helper::objectToArray($athletics_data);
                                                                    @endphp
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($athletics_data_arr, 'athletics_activity', ', ') }}
                                                                    /
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($athletics_data_arr, 'athletics_position', ', ') }}
                                                                </li>
                                                            </ul>
                                                        </div>


                                                    </li>
                                                    <li>
                                                        <span>Athletics honor by </span>
                                                        <div class="list_group">
                                                            <ul class="list_items">
                                                                <li class="list-type">
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($athletics_data_arr, 'athletics_honor', ', ') }}
                                                                    <span>in</span>
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($athletics_data_arr, 'athletics_location', ', ') }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                @endif

                                                @if (!empty($activity->activities_data))
                                                    <li>
                                                        <span>Activity with Position : </span>
                                                        <div class="list_group">
                                                            <ul class="list_items">
                                                                <li class="list-type">
                                                                    @php
                                                                        $activities_data = json_decode($activity->activities_data);
                                                                        $activities_data_arr = \App\Helpers\Helper::objectToArray($activities_data);
                                                                    @endphp
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($activities_data_arr, 'activity', ', ') }}
                                                                    /
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($activities_data_arr, 'activity_position', ', ') }}
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </li>
                                                    <li>
                                                        <span>Activity honor by </span>
                                                        <div class="list_group">
                                                            <ul class="list_items">
                                                                <li class="list-type">
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($activities_data_arr, 'activity_honor_award', ', ') }}
                                                                    <span>at</span>
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($activities_data_arr, 'activity_location', ', ') }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                @endif

                                                @if (!empty($activity->community_service_data))
                                                    <li>
                                                        <span>Participation and service : </span>
                                                        <div class="list_group">
                                                            <ul class="list_items">
                                                                <li class="list-type">
                                                                    @php
                                                                        $community_service_data = json_decode($activity->community_service_data);
                                                                        $community_service_data_arr = \App\Helpers\Helper::objectToArray($community_service_data);
                                                                    @endphp
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($community_service_data_arr, 'participation_level', ', ') }}
                                                                    /
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($community_service_data_arr, 'community_service', ', ') }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <span>Community Located at : </span>
                                                        <div class="list_group">
                                                            <ul class="list_items">
                                                                <li class="list-type">
                                                                    {{ \App\Helpers\Helper::convertMultidimensionalToString($community_service_data_arr, 'community_location', ', ') }}
                                                                </li>
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
</div>