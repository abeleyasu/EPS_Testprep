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
                        {{ $personal_info->last_name }} {{ isset($personal_info->nick_name) && $personal_info->nick_name != null ? "(" .$personal_info->nick_name. ")" : ''}}</h1>
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
                                        @if(isset($personal_info->email))
                                            <li>
                                                <span>
                                                    <i class="fa-solid fa-envelope-open-text"></i>
                                                </span>
                                                {{ $personal_info->email }}
                                            </li>
                                        @endif
                                        @if(isset($personal_info->cell_phone))
                                            <li>
                                                <span>
                                                    <i class="fa-solid fa-phone"></i>
                                                </span>
                                                {{ $personal_info->cell_phone }}
                                            </li>
                                        @endif
                                        @if(isset($personal_info->street_address_one) || isset($personal_info->street_address_two) || isset($personal_info->zip_code))
                                            <li class="d-flex">
                                                <span>
                                                    <i class="fa-solid fa-location-dot"></i>
                                                </span>
                                                <div class="ms-2">
                                                    <span class="d-block">Address1 / Address2 / Zip Code </span>
                                                    {{ isset($personal_info->street_address_one) ? $personal_info->street_address_one : '' }}
                                                    @if(isset($personal_info->street_address_one)) <br /> @endif
                                                    {{ isset($personal_info->street_address_two) ? $personal_info->street_address_two : '' }}
                                                    @if(isset($personal_info->street_address_two)) <br /> @endif
                                                    {{ isset($personal_info->zip_code) ? $personal_info->zip_code : '' }}
                                                </div>
                                            </li>
                                        @endif
                                        @if(isset($personal_info->city) || isset($personal_info->state))
                                            <li class="d-flex mb-2">
                                                <span>
                                                    <i class="fa-solid fa-location-dot"></i>
                                                </span>
                                                <div class="ms-2">
                                                    <span class="d-block">City / State</span>
                                                    {{ $personal_info->city . '/' . $personal_info->state }}
                                                </div>
                                            </li>
                                        @endif
                                        @if($social_links != null)
                                            <li class="d-flex "><span> <i class="fa-solid fa-link"></i> </span>
                                                <div class="ms-2">
                                                    <span class="d-block">Social Links :</span>
                                                    <div class="list_group">
                                                        <ul class="list_items">
                                                            @foreach ($social_links as $link)
                                                                <li class="list-type">
                                                                    {{ $link }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="position-relative preview-list ps-0 pb-3 {{ !empty($featured_awards_data) || !empty($featured_languages_data) || !empty($featured_skills_data) ? '' : 'd-none' }}">
                                    @if (!empty($featured_skills_data))  
                                        <div class="pb-3 mb-0 border-bottom-0">
                                            @if ($featuredAttribute)
                                                <h3>Features</h3>
                                            @endif
                                            <div class="preview-list_skill">
                                                @if(!empty($featured_skills_data))
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
                                    @if (!empty($featured_awards_data))
                                        <div
                                            class="preview-list pb-3 features-list-after  ps-0 mb-0 border-bottom-0">
                                            <div class="preview-list_skill">
                                                @if(!empty($featured_awards_data))
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
                                    @if (!empty($featured_languages_data))
                                        <div class="preview-list pb-3 features-list-after  ps-0 mb-0 border-bottom-0">
                                            <div class="preview-list_skill ">
                                                @if(!empty($featured_languages_data))
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
                                    @if (!empty($dual_citizenship_data))
                                        <div class="preview-list mb-0 ps-0 ">
                                            <div class="preview-list_skill ">
                                                @if(!empty($dual_citizenship_data))
                                                    <h2>Dual Citizen</h2>
                                                    <ul class="list">
                                                        @foreach ($featuredAttribute->dual_citizenship_data as $dual_citizenship)
                                                            <li class="mb-0">
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        <li class="list-type">
                                                                            {{ $dual_citizenship['country'] }}
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
                                <div class="preview-list list_group ps-0 pb-0 border-bottom-0">
                                    @if (!empty($employment_data)) 
                                        <h3>Employment & Certifications</h3>
                                        <ul class="list">
                                            <li>
                                                <span>Name Of The Company:</span>
                                                <div class="list_group">
                                                    <ul class="list_items">
                                                        @foreach ($employment_data as $data)
                                                            @if(!is_null($data['name_of_company']))
                                                                <li class="list-type">
                                                                    {{ $data['name_of_company'] }}
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <span>Job Title</span>
                                                <div class="list_group">
                                                    <ul class="list_items">
                                                        @foreach ($employment_data as $data)
                                                            @if(!is_null($data['job_title']))
                                                                <li class="list-type">
                                                                    {{ $data['job_title'] }}
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <span>Grade(s)</span>
                                                <div class="list_group">
                                                    <ul class="list_items">
                                                        @foreach ($employment_data as $data)
                                                            @if(isset($data['grade']) && !empty($data['grade']))
                                                                <li class="list-type">
                                                                    {{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                                <div class="preview-list position-relative list_group ps-0 honor-list-after {{ !empty($significant_data) || !empty($employment_data) ? '' : 'd-none' }}">
                                    @if (!empty($significant_data)) 
                                        <h3>Responsibilities or interests</h3>
                                        <ul class="list">
                                            <li>
                                                <span>Responsibility Or Interest</span>
                                                <div class="list_group">
                                                    <ul class="list_items">
                                                        @foreach ($significant_data as $data)
                                                            @if (isset($data['interest']) && !empty($data['interest']))                                                                            
                                                                <li class="list-type">
                                                                    {{ $data['interest'] }}
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <span>Grade(s)</span>
                                                <div class="list_group">
                                                    <ul class="list_items">
                                                        @foreach ($significant_data as $data)
                                                            @if(isset($data['grade']) && !empty($data['grade']))
                                                                <li class="list-type">
                                                                    {{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                                @if (!empty($honor))
                                    <div class="preview-list ps-0">
                                        <h3>Honors</h3>
                                        <ul class="list">
                                            <li>
                                                <span>Position</span>
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
                                                <span>Achivement</span>
                                                <div class="list_group">
                                                    <ul class="list_items">
                                                        @foreach ($honor->honors_data as $honor_data)
                                                            <li class="list-type">
                                                                {{ $honor_data['honor_achievement_award'] }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <span class="d-block">Grade(s)</span>
                                                <div class="list_group">
                                                    <ul class="list_items">
                                                        @foreach ($honor->honors_data as $honor_data)
                                                            <li class="list-type">
                                                                @if(isset($honor_data['grade']) && !empty($honor_data['grade']))
                                                                    {{ \App\Helpers\Helper::getGradeByIdArray($honor_data['grade']) }}
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <span>Location</span>
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
                                            <li>
                                                <span>Current Grade:
                                                </span>{{ implode(',', ($current_grade)) }}
                                            </li>
                                            <li>
                                                <span> Month / Year :
                                                </span>
                                                {{ $education->month }} / {{ $education->year }}
                                            </li>
                                            @if(!empty($education->cumulative_gpa_weighted) || !empty($education->cumulative_gpa_unweighted))
                                                <li>
                                                    <span> Weighted GPA / Unweighted GPA :</span>
                                                    {{ $education->cumulative_gpa_weighted }} /
                                                    {{ $education->cumulative_gpa_unweighted }}
                                                </li>
                                            @endif
                                            @if(!empty($education->class_rank) || !empty($education->total_no_of_student))
                                                <li>
                                                    <span>Class Rank / Number of Student : </span>
                                                    {{ $education->class_rank }} /
                                                    {{ $education->total_no_of_student }}
                                                </li>
                                            @endif
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
                                                                @if(isset($honor_course_data['course_data']) && !empty($honor_course_data['course_data']))
                                                                    <li class="list-type">
                                                                        {{ \App\Helpers\Helper::getHonorCourseByIdArray($honor_course_data['course_data']) }}
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endif
                                            @if (!empty($course_data))
                                                <li>
                                                    <span>Course and College name: </span>

                                                    <div class="list_group">
                                                        <ul class="list_items">
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
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endif

                                            @if (!empty($testing_data))
                                                <li>
                                                    <span class="d-block mb-2">Name and Date of Test:</span>
                                                    <div class="list_group">
                                                        <ul class="list_items">
                                                            @foreach ($testing_data as $data)
                                                                <li class="list-type">
                                                                    {{ isset($data['name_of_test']) ? $data['name_of_test'] : '' }} 
                                                                    {{ isset($data['name_of_test']) &&  isset($data['date']) ? '/' : ''}}
                                                                    {{ isset($data['date']) ? $data['date'] : '' }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endif

                                            @if (!empty($intended_major))
                                                <li>
                                                    <span>Intended College Major(s):</span>
                                                    {{ implode(',', $intended_major) }}
                                                </li>
                                            @endif
                                            @if (!empty($intended_major))
                                                <li>
                                                    <span>Intended College Minor(s):</span>
                                                        {{ implode(',', $intended_minor) }}
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                                @if (!empty($activity))
                                    <div class="preview-list activity-list-after">
                                        <h3 >Activities</h3>
                                        <ul class="list">
                                            @if (!empty($demonstrated_data))
                                                <li>
                                                    <span class="d-block mb-3">
                                                        Demostrated Interests Major
                                                    </span>
                                                    <div class="ps-3">
                                                    <span>Position:</span>
                                                    <div class="list_group">
                                                        <ul class="list_items">
                                                            @foreach ($demonstrated_data as $data)
                                                                <li>
                                                                    {{ $data['position'] }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <span>Interest:</span>
                                                    <div class="list_group">
                                                        <ul class="list_items">
                                                            @foreach ($demonstrated_data as $data)
                                                                <li>
                                                                    {{ $data['interest'] }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <span>Grade(s):</span>
                                                    <div class="list_group">
                                                        <ul class="list_items">
                                                            @foreach ($demonstrated_data as $data)
                                                                <li>
                                                                    {{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <span>Details:</span>
                                                    <div class="list_group">
                                                        <ul class="list_items">
                                                            @foreach ($demonstrated_data as $data)
                                                                <li>
                                                                    {{ $data['details'] }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    </div>
                                                </li>
                                            @endif
                                            @if(!empty($leadership_data))    
                                                <li>
                                                    <span class="d-block mb-3">Leadership</span>
                                                    <div class="list_group">
                                                        <ul class="list_items">
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
                                                                <li>
                                                                    <span>Status:</span>
                                                                    {{ implode(",", $leadership_array['status']) }}
                                                                </li>
                                                            @endif
                                                            @if(!empty($leadership_array['position']))
                                                                <li>
                                                                    <span>Position:</span>
                                                                    {{ implode(",", $leadership_array['position']) }}
                                                                </li>
                                                            @endif
                                                            @if(!empty($leadership_array['organization']))
                                                                <li>
                                                                    <span>Organization:</span>
                                                                    {{ implode(",", $leadership_array['organization']) }}
                                                                </li>
                                                            @endif
                                                            @if(!empty($leadership_array['grade']))
                                                                <li>
                                                                    <span>Grade(s):</span>
                                                                    {{ \App\Helpers\Helper::getGradeAllByIdArray($leadership_array['grade']) }}
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endif    
                                            @if(!empty($activities_data))    
                                                <li>
                                                    <span class="d-block mb-3">Activities & Clubs</span>
                                                    <div class="list_group">
                                                        <ul class="list_items">
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
                                                                <li>
                                                                    <span>Position:</span>
                                                                    {{ implode(",", $activities_array['position']) }}
                                                                </li>
                                                            @endif
                                                            @if(!empty($data['activity']))
                                                                <li>
                                                                    <span>Activity:</span>
                                                                    {{ implode(",", $activities_array['activity']) }}
                                                                </li>
                                                            @endif
                                                            @if(!empty($data['honor_award']))
                                                                <li>
                                                                    <span>Honor/Award:</span>
                                                                    {{ implode(",", $activities_array['honor_award']) }}
                                                                </li>
                                                            @endif
                                                            @if(!empty($data['grade']))
                                                                <li>
                                                                    <span>Grade(s):</span>
                                                                    {{ \App\Helpers\Helper::getGradeAllByIdArray($activities_array['grade']) }}
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endif
                                            @if(!empty($athletics_data))    
                                                <li>
                                                    <span class="d-block mb-3">Athletics</span>
                                                    <div class="list_group">
                                                        <ul class="list_items">
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
                                                                <li>
                                                                    <span>Position:</span>
                                                                    {{ implode(",", $athletics_array['position']) }}
                                                                </li>
                                                            @endif
                                                            @if(isset($data['activity']))
                                                                <li>
                                                                    <span>Activity:</span>
                                                                    {{ implode(",", $athletics_array['activity']) }}
                                                                </li>
                                                            @endif
                                                            @if(!empty($data['grade']))
                                                                <li>
                                                                    <span>Grade(s):</span>
                                                                    {{ \App\Helpers\Helper::getGradeAllByIdArray($athletics_array['grade']) }}
                                                                </li>
                                                            @endif
                                                            @if(isset($data['honor']))
                                                                <li>
                                                                    <span>Honor:</span>
                                                                    {{ implode(",", $athletics_array['honor']) }}
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endif
                                            @if(!empty($community_service_data))    
                                                <li>
                                                    <span class="d-block mb-3">
                                                        Community Service / Volunteerism
                                                    </span>
                                                    <div class="list_group">
                                                        <ul class="list_items">
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
                                                                <li>
                                                                    <span>Participation Level:</span>
                                                                    {{ implode(",", $community_service_array['level']) }}
                                                                </li>
                                                            @endif
                                                            @if(isset($data['service']))
                                                                <li>
                                                                    <span>Service:</span>
                                                                    {{ implode(",", $community_service_array['service']) }}
                                                                </li>
                                                            @endif
                                                            @if(isset($data['grade']) && !empty($data['grade']))
                                                                <li>
                                                                    <span>Grade(s):</span>
                                                                    {{ \App\Helpers\Helper::getGradeAllByIdArray($community_service_array['grade']) }}
                                                                </li>
                                                            @endif
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
</div>
