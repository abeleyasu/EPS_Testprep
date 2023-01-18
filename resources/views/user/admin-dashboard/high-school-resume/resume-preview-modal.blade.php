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
                <div>
                    <h1>
                        <span>
                            {{ $personal_info->first_name }}
                        </span> 
                        {{ $personal_info->middle_name }}
                        {{ $personal_info->last_name }}
                        {{ isset($personal_info->nick_name) && $personal_info->nick_name != null ? "(" .$personal_info->nick_name. ")" : ''}}
                    </h1>
                    <div>
                    @if(isset($personal_info->street_address_one) || isset($personal_info->street_address_two) || isset($personal_info->zip_code) || isset($personal_info->state) || isset($personal_info->city))
                            <div>
                                {{ isset($personal_info->street_address_one) ? $personal_info->street_address_one : '' }}
                                @if(isset($personal_info->street_address_one)) @endif
                                {{ isset($personal_info->street_address_two) ? $personal_info->street_address_two : '' }},
                                @if(isset($personal_info->street_address_two)) @endif
                                {{ $personal_info->city . ',' . $personal_info->state }}
                                {{ isset($personal_info->zip_code) ? $personal_info->zip_code : '' }}
                            </div>
                    @endif
                    </div>
                    @if(isset($personal_info->email))
                            <span>
                                <i class="fa-solid fa-envelope-open-text"></i>
                            </span>
                            {{ $personal_info->email }}
                    @endif
                    @if(isset($personal_info->cell_phone))
                            <span>
                                <i class="fa-solid fa-phone"></i>
                            </span>
                            {{ $personal_info->cell_phone }}
                    @endif
                    @if($social_links != null)
                        <span> <i class="fa-solid fa-link"></i> </span>
                                @foreach ($social_links as $link)
                                    {{ $link }}
                                    @if (count($social_links) > 1)
                                        @break
                                    @endif
                                @endforeach
                    @endif
                    {{-- <div>
                        @if(isset($personal_info->email))
                            {{ $personal_info->email }}
                        @endif
                        @if(isset($personal_info->cell_phone))
                                /{{ $personal_info->cell_phone }}
                        @endif
                        @if($social_links != null)
                            @foreach ($social_links as $link)
                                / {{ $link }}
                                @if (count($social_links) > 1)
                                    @break
                                @endif
                            @endforeach
                        @endif
                    </div> --}}
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
                                <div class="position-relative preview-list ps-0 pb-3 {{ !empty($featured_awards_data) || !empty($featured_languages_data) || !empty($featured_skills_data) ? '' : 'd-none' }}">
                                    @if (!empty($featured_skills_data))  
                                        <div class="pb-3 mb-0 border-bottom-0">
                                            @if ($featuredAttribute)
                                                <h3>FEATURED</h3>
                                            @endif
                                            <div class="preview-list_skill">
                                                @if(!empty($featured_skills_data))
                                                    <h2>Skills:</h2>
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
                                                    <h2>Awards:</h2>
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
                                                    <h2>Languages:</h2>
                                                    <ul class="list">
                                                        @foreach ($featuredAttribute->featured_languages_data as $featured_languages)
                                                            <li class="mb-0">
                                                                <div class="list_group">
                                                                    <ul class="list_items">
                                                                        <li class="list-type">
                                                                            Multilingual({{ $featured_languages['language'] }})
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
                                <div class="preview-list list_group ps-0 pb-3 position-relative features-list-after">
                                    @if (!empty($employment_data)) 
                                        <h3>Employment & Certifications</h3>
                                                <div class="list_group">
                                                    <ul class="list_items">
                                                        @foreach ($employment_data as $data)
                                                            <li class="list-type">
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
                                                            </li>    
                                                        @endforeach
                                                    </ul>
                                                </div>
                                    @endif
                                </div>
                                <div class="preview-list position-relative list_group ps-0 honor-list-after {{ !empty($significant_data) || !empty($employment_data) ? '' : 'd-none' }}">
                                    @if (!empty($significant_data)) 
                                        <h3>Responsibilities or interests</h3>
                                        <div class="list_group">
                                            <ul class="list_items">
                                                @foreach ($significant_data as $data)
                                                    <li class="list_items">
                                                        @if(isset($data['grade']) && !empty($data['grade']))
                                                                {{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}
                                                        @endif
                                                        @if (isset($data['interest']) && !empty($data['interest']))                                                                            
                                                                {{ $data['interest'] }},
                                                        @endif
                                                        @if (isset($data['location']) && !empty($data['location']))                                                                            
                                                                {{ $data['location'] }},
                                                        @endif
                                                        @if (isset($data['honor_award']) && !empty($data['honor_award']))                                                                            
                                                                {{ $data['honor_award'] }}
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>        
                                    @endif
                                </div>
                                @if (!empty($honor))
                                    <div class="preview-list ps-0">
                                        <h3>HONORS / ACHIEVEMENTS / AWARDS </h3>
                                        <ul class="list">
                                            <li>
                                                <div class="list_group">
                                                    <ul class="list_items">
                                                        @foreach ($honor->honors_data as $honor_data)
                                                            <li class="list-type">
                                                                @if(isset($honor_data['grade']) && !empty($honor_data['grade']))
                                                                    {{ \App\Helpers\Helper::getGradeByIdArray($honor_data['grade']) }}
                                                                @endif
                                                                @if(isset($honor_data['position']) && !empty($honor_data['position']))
                                                                    {{ $honor_data['position'] }},
                                                                @endif
                                                                @if(isset($honor_data['honor_achievement_award']) && !empty($honor_data['honor_achievement_award']))
                                                                    {{ $honor_data['honor_achievement_award'] }},
                                                                @endif
                                                                @if(isset($honor_data['location']) && !empty($honor_data['location']))
                                                                    {{ $honor_data['location'] }}
                                                                @endif
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
                                            {{-- <li>
                                                {{ $education->is_graduate == 1 ? 'Yes' : 'No' }}
                                            </li> --}}
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
                                                {{ $education->high_school_name }} /
                                                {{ $education->high_school_city }} /
                                                {{ $education->high_school_state }} /
                                                {{ $education->high_school_district }}
                                                @if (isset($education->graduation_designation) && $education->graduation_designation != null)
                                                ({{$education->graduation_designation}})
                                                @endif
                                                @if(!empty($education->cumulative_gpa_weighted) || !empty($education->cumulative_gpa_unweighted))
                                                    <li>
                                                        {{ $education->cumulative_gpa_unweighted }} UWtd .GPA,
                                                        {{ $education->cumulative_gpa_weighted }} Wtd
                                                    </li>
                                                @endif
                                            </li>
                                            <li>
                                                @if (!empty($testing_data))
                                                    @foreach ($testing_data as $data)
                                                        <li class="list-type">
                                                            {{ isset($data['name_of_test']) ? $data['name_of_test'] : '' }} 
                                                            :{{ isset($data['results_score']) ? $data['results_score'] : ''}}
                                                            @if(!empty($education->class_rank) || !empty($education->total_no_of_student))
                                                                    <span>Class Rank:</span>
                                                                    {{ $education->class_rank }} /
                                                                    {{ $education->total_no_of_student }}
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                @endif
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
                                                    {{-- <div class="list_group">
                                                        <ul class="list_items"> --}}
                                                            @foreach ($education->honor_course_data as $honor_course_data)
                                                                @if(isset($honor_course_data['course_data']) && !empty($honor_course_data['course_data']))
                                                                        {{ \App\Helpers\Helper::getHonorCourseByIdArray($honor_course_data['course_data']) }}
                                                                @endif
                                                            @endforeach
                                                        {{-- </ul>
                                                    </div> --}}
                                                </li>
                                            @endif
                                            @if (!empty($course_data))
                                                <li>
                                                    <span>Concurrent Enrollment :</span>
                                                    <div class="list_group">
                                                        <ul class="list_items">

                                                            @foreach ($college_list as $college)
                                                                <div>
                                                                    {{\App\Helpers\Helper::getCollegeNameByIdArray($college)}} 
                                                                    @foreach ($education->course_data as $course_data)
                                                                        @if(isset($course_data['search_college_name']))
                                                                            @if (in_array($college, $course_data['search_college_name']))College:
                                                                                @if (isset($course_data['course_name']))                                                                                            
                                                                                        {{$course_data['course_name']}}
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
                                                    <div class="list_group">
                                                        <ul class="list_items">
                                                            <li class="list-type">
                                                            @foreach ($demonstrated_data as $data)
                                                                    {{isset($data['grade']) && $data['grade'] != null ? (\App\Helpers\Helper::getGradeByIdArray($data['grade'])) : ''}}
                                                                    {{ $data['position'] }},
                                                                    {{ $data['interest'] }},
                                                                    {{ $data['details'] }}

                                                            @endforeach
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endif
                                            @if(!empty($leadership_data))    
                                                <li>
                                                    <div class="list_group">
                                                        <ul class="list_items">
                                                            @foreach($leadership_data as $data)
                                                            <li class="list-type">
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
                                                            </li>
                                                        @endforeach        
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endif    
                                            @if(!empty($activities_data))    
                                                <li>
                                                    <div class="list_group">
                                                        <ul class="list_items">
                                                            @foreach ($activities_data as $data)
                                                            <li class="list-type">
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
                                                            </li>  
                                                        @endforeach  
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endif
                                            @if(!empty($athletics_data))    
                                                <li>
                                                    <h3 style="margin-top: 30px">ATHLETICS </h3>
                                                    <div class="list_group">
                                                        <ul class="list_items">
                                                            @foreach ($athletics_data as $data)
                                                                <li class="list-type">
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
                                                                </li>
                                                            @endforeach    
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endif
                                            @if(!empty($community_service_data))    
                                                <li>
                                                    <h3 style="margin-top: 30px">Community Service</h3>
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
                                                                    if(isset($data['location'])){
                                                                        $community_service_array['location'][] = $data['location'];
                                                                    }
                                                                @endphp
                                                            @endforeach
                                                                <li class="list-type">
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
</div>  
