<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content ">
        <div class="block block-rounded block-transparent mb-0">
            <div class="block-header block-header-preview text-border rounded-0">
                <div class="">
                    <h1><span>{{ $personal_info->first_name }}</span> {{ $personal_info->last_name }}</h1>
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
                                    <li>{{ $personal_info->email }}</li>
                                    <li>{{ $personal_info->cell_phone }}</li>
                                    <li>{{ $personal_info->street_address_one }}</li>
                                    <li>{{ $personal_info->street_address_two }}</li>
                                    <li>{{ $personal_info->zip_code }}</li>
                                    <li>{{ $personal_info->city . ', ' . $personal_info->state }}</li>
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
                                    @foreach (json_decode($featuredAttribute->featured_languages_data) as $featured_languages)
                                    <li>{{ $featured_languages->featured_language }}</li>
                                    @endforeach
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
                                    <li>{{ $education->high_school_name }} /
                                        {{ $education->high_school_city }} /
                                        {{ $education->high_school_state }}
                                    </li>
                                    <li>Weighted GPA:
                                        {{ isset($education->cumulative_gpa_weighted) ? $education->cumulative_gpa_weighted : '-' }},
                                        Class Rank:
                                        {{ isset($education->class_rank) ? $education->class_rank : '-' }}
                                    </li>
                                    @if (!empty($education->testing_data))
                                    <li>
                                        <span>Name of Test:</span>
                                        @php
                                        $testing_data = json_decode($education->testing_data);
                                        $testing_data_arr = \App\Helpers\Helper::objectToArray($testing_data);
                                        @endphp
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($testing_data_arr, 'name_of_test', ', ') }}
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
                                        <span>Honors Courses:</span>
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
                            @if (!empty($activity))
                            <div class="preview-list mb-3">
                                <h3>Activities</h3>
                                <ul class="list">
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
                                    @if (!empty($activity->demonstrated_data))
                                    <li>
                                        <span>Demostrated Interests in the Area of my College
                                            Major:</span>
                                        @php
                                        $demonstrated_data = json_decode($activity->demonstrated_data);
                                        $demonstrated_data_arr = \App\Helpers\Helper::objectToArray($demonstrated_data);
                                        @endphp
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($demonstrated_data_arr, 'interest', ', ') }}
                                    </li>
                                    @endif
                                    @if (!empty($activity->leadership_data))
                                    <li>
                                        <span>Leadership:</span>
                                        @php
                                        $leadership_data = json_decode($activity->leadership_data);
                                        $leadership_data_arr = \App\Helpers\Helper::objectToArray($leadership_data);
                                        @endphp
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($leadership_data_arr, 'leadership_organization', ', ') }}
                                    </li>
                                    @endif
                                    @if (!empty($activity->athletics_data))
                                    <li>
                                        <span>Athletics:</span>
                                        @php
                                        $athletics_data = json_decode($activity->athletics_data);
                                        $athletics_data_arr = \App\Helpers\Helper::objectToArray($athletics_data);
                                        @endphp
                                        {{ \App\Helpers\Helper::convertMultidimensionalToString($athletics_data_arr, 'athletics_activity', ', ') }}
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            @endif
                            @if (!empty($employmentCertification))
                            @if (!empty($employmentCertification->significant_data))
                            <div class="preview-list mb-3">
                                <h3>Employment</h3>
                                <ul class="list">
                                    @php
                                    $significant_data = json_decode($employmentCertification->significant_data);
                                    $significant_data_arr = \App\Helpers\Helper::objectToArray($significant_data);
                                    @endphp
                                    <li>{{ \App\Helpers\Helper::convertMultidimensionalToString($significant_data_arr, 'responsibility_interest', ', ') }}
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
                                    <li>{{ \App\Helpers\Helper::convertMultidimensionalToString($employment_data_arr, 'job_title', ', ') }}
                                    </li>
                                </ul>
                            </div>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>