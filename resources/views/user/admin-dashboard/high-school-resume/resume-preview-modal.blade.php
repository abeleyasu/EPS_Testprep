<style>
    .text-border h1 {
        font-weight: 500;
        font-size: 35px;
        margin-bottom: 10px;
    }

    .text-border p {
        font-size: 18px;
    }

    .text-border {
        margin-top: 30px;
    }

    .features-list-before:after {
        top: 158px;
    }

    .block-header-preview {
        padding: 20px 40px;
    }   `   
</style>

<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content ">
        <div class="block block-rounded block-transparent mb-0">
            <div class="block-header block-header-preview text-border rounded-0">
                <div class="">
                    <h1><span>{{ $personal_info->first_name }}</span> {{ $personal_info->middle_name }}
                        {{ $personal_info->last_name }}</h1>
                    <p>Web Developer</p>
                </div>
                <div class="block-options">
                    <button type="button" class="btn-block-option close"
                        onclick="$('.showResumePreviewModal').modal('hide');" aria-label="Close">
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
                                        <li class="d-flex mb-2"><span><i class="fa-solid fa-envelope-open-text"></i>
                                            </span>
                                            <div class="ms-2">
                                                <span class="d-block">Parent Email 1 / Parent Email 2 :</span>
                                                {{ $personal_info->parent_email_one }}
                                                <br>
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
                                                        @foreach ($personal_info->social_links as $social_link)
                                                            <li class="list-type">
                                                                {{ $social_link['link'] }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="position-relative preview-list ps-0 pb-3 features-list-before">
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
                                        <div class="preview-list mb-0 ps-0 ">
                                            <div class="preview-list_skill ">
                                                @if($featuredAttribute->featured_languages_data[0]['language'] != null)
                                                    <h2>Featured languages</h2>
                                                    <ul class="list">
                                                        @foreach ($featuredAttribute->featured_languages_data as $featured_languages)
                                                            <li class="mb-0">
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        <li class="list-type">
                                                                            {{ $featured_languages['language'] }}
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                @if (!empty($employmentCertification->significant_data))
                                    <div class="preview-list list_group  ps-0 pb-0 border-bottom-0">
                                        @if (!empty($employmentCertification->employment_data[0]['job_title']) || !empty($employmentCertification->employment_data[0]['honor_awards']) ||!empty($employmentCertification->employment_data[0]['location']) ) 
                                            <h3>Employment & Certifications</h3>
                                            <ul class="list_items">
                                                @foreach ($employmentCertification->employment_data as $employment_data)
                                                    <li class="list-type">
                                                        <span>Job </span>
                                                        {{ $employment_data['job_title'] }}
                                                        <span> with </span>
                                                        {{ isset($employment_data['grade']) && $employment_data['grade'] != null ? (implode(',', $employment_data['grade'])) : ''}}
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
                                        @endif
                                    </div>
                                @endif
                                @if (!empty($employmentCertification->employment_data))
                                    <div class="preview-list position-relative list_group ps-0 honor-list-after">
                                        @if (!empty($employmentCertification->significant_data[0]['interest']) || !empty($employmentCertification->significant_data[0]['honor_award']) ||!empty($employmentCertification->significant_data[0]['location']) ) 
                                            <h3>Responsibilities or interests</h3>
                                            <ul class="list_items">
                                                @foreach ($employmentCertification->significant_data as $significant_data)
                                                    <li class="list-type">
                                                        <span>Responsibility or interest :</span>
                                                        {{ $significant_data['interest'] }}
                                                        <span> with </span>
                                                        {{ isset($significant_data['grade']) && $significant_data['grade'] != null ? (implode(',', $significant_data['grade'])) : '' }}
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
                                        @endif
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
                                                        @foreach ($honor->honors_data as $honor_data)
                                                            <li class="list-type">
                                                                {{ $honor_data['position'] }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <span class="d-block">Achivement / Grade : </span>
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
                                            <li>
                                                <span>Location : </span>
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
                                                        {{ $education->grade_level != '' ? 'Grade Level' : '' }}
                                                        /
                                                        {{ $education->college_name != '' ? 'College name' : '' }}
                                                        :
                                                    </span>
                                                    {{ $education->grade_level != '' ? $education->grade_level : '' }}
                                                    /
                                                    {{ $education->grade_level != '' ? $education->college_name : '' }}
                                                </li>
                                            @endif
                                            @if ($education->college_city && $education->college_state != '')
                                                <li>
                                                    <span>
                                                        {{ $education->college_city != '' ? 'College City ' : '' }}
                                                        /
                                                        {{ $education->college_state != '' ? 'College State' : '' }}
                                                        :
                                                    </span>
                                                    {{ $education->college_city != '' ? $education->college_city : '' }}
                                                    /
                                                    {{ $education->college_state != '' ? $education->college_state : '' }}
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
                                                    {{ implode(',', $ib_courses) }}
                                                </li>
                                            @endif
                                            @if (!empty($education->ap_courses))
                                                <li>
                                                    <span>AP Courses:</span>
                                                    {{ implode(',', $ap_courses) }}
                                                </li>
                                            @endif
                                            @if (!empty($education->honor_course_data))
                                                <li>
                                                    <span> Honors Course :</span>
                                                    <div class="list_group">
                                                        <ul class="list_items">
                                                            @foreach ($education->honor_course_data as $honor_course_data)
                                                                <li class="list-type">
                                                                    {{ $honor_course_data['course_data'] }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endif
                                            @if (!empty($education->course_data))
                                                <li>
                                                    <span>Course and College name: </span>
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
                                                </li>
                                            @endif
                                            @if (!empty($education->testing_data))
                                                <li>
                                                    <span class="d-block mb-2">Name and Date of Test:</span>
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
                                        @if (!empty($activity->demonstrated_data[0]['position']) || !empty($activity->demonstrated_data[0]['interest']) || !empty($activity->demonstrated_data[0]['location']))
                                            <li>
                                                <span class="d-block">Demostrated Interests and
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
                                            </li>
                                            <li>
                                                <span class="d-block">Grade and Location with Details :
                                                </span>
                                                <div class="list_group">
                                                    <ul class="list_items">
                                                        @foreach ($activity->demonstrated_data as $demonstrated_data)
                                                            <li class="list-type">
                                                                {{ isset($demonstrated_data['grade']) && $demonstrated_data['grade'] != null ?  (implode(',', $demonstrated_data['grade'])) : '' }}
                                                                /
                                                                {{ $demonstrated_data['location'] }} /
                                                                {{ $demonstrated_data['details'] }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                        @endif
                                        @if (!empty($activity->leadership_data[0]['status']) || !empty($activity->leadership_data[0]['position']) || !empty($activity->leadership_data[0]['organization']))
                                            <li>
                                                <span>Leadership status with Position : </span>
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
                                            </li>
                                            <li>
                                                <span>Leadership organized By :</span>
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
                                            </li>
                                        @endif
                                        @if (!empty($activity->athletics_data[0]['activity']) || !empty($activity->athletics_data[0]['position']) || !empty($activity->athletics_data[0]['location']))
                                            <li>
                                                <span>Athletics status with Position : </span>
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
                                            </li>
                                            <li>
                                                <span>Athletics honor by :</span>
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
                                            </li>
                                        @endif
                                        @if (!empty($activity->activities_data[0]['activity']) || !empty($activity->activities_data[0]['position']) || !empty($activity->activities_data[0]['honor_award']) || !empty($activity->activities_data[0]['location']))
                                            <li>
                                                <span>Activity with Position : </span>
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
                                            </li>
                                            <li>
                                                <span>Activity honor by :</span>
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
                                            </li>
                                        @endif
                                        @if (!empty($activity->community_service_data[0]['level']) || !empty($activity->community_service_data[0]['service']) || !empty($activity->community_service_data[0]['location']) )  
                                            <li>
                                                <span>Participation and service : </span>
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
                                            </li>
                                            <li>
                                                <span>Community Located at : </span>
                                                <div class="list_group">
                                                    <ul class="list_items">
                                                        @foreach ($activity->community_service_data as $community_service_data)
                                                            <li class="list-type">
                                                                {{ $community_service_data['location'] }}
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
</div>
