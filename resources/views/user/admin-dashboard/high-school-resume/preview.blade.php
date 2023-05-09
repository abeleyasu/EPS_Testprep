@extends('layouts.user')

@section('title', 'HSR | Preview : CPS')

@section('user-content')
    <main id="main-container">
        <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
            <div class="bg-black-10">
                <div class="content content-full text-center">
                    <br>
                    <h1 class="h2 text-white mb-0">High School Resume Tool</h1>
                    <br>
                </div>
            </div>
        </div>
        <div class="">
            <div class="custom-tab-container ">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li role="presentation">
                        <a class="nav-link"
                            href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/personal-info?resume_id=' . $resume_id) : route('admin-dashboard.highSchoolResume.personalInfo') }}"
                            id="step1-tab">
                            <p class="d-none">1</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Personal Info</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link "
                            href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/education-info?resume_id=' . $resume_id) : route('admin-dashboard.highSchoolResume.educationInfo') }}"
                            id="step2-tab">
                            <p class="d-none">2</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Education </h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link "
                            href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/honors?resume_id=' . $resume_id) : route('admin-dashboard.highSchoolResume.honors') }}"
                            id="step3-tab">
                            <p class="d-none">3</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Honors </h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link "
                            href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/activities?resume_id=' . $resume_id) : route('admin-dashboard.highSchoolResume.activities') }}"
                            id="step4-tab">
                            <p class="d-none">4</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Activities</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link"
                            href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/employment-certifications?resume_id=' . $resume_id) : route('admin-dashboard.highSchoolResume.employmentCertification') }}"
                            id="step5-tab">
                            <p class="d-none">5</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Employment & <br> Certifications</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link"
                            href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/features-attributes?resume_id=' . $resume_id) : route('admin-dashboard.highSchoolResume.featuresAttributes') }}"
                            id="step6-tab">
                            <p class="d-none">6</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Featured <br> Attributes</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link active"
                            href="{{ isset($featuredAttribute) && $featuredAttribute != null ? (isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/preview?resume_id=' . $resume_id) : route('admin-dashboard.highSchoolResume.preview')) : '' }}"
                            id="step7-tab">
                            <p>7</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Preview</h6>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="setup-content">
                        <div class="header-area">
                            <h2>High School Resume</h2>
                            <p><a href="#">Home</a> > High School Resume</p>
                        </div>
                        <div class="mb-5">
                            <a href="{{ 'chrome-extension://oemmndcbldboiebfnladdacbdfmadadm/' . isset($resume_id) && $resume_id != null ? route('admin-dashboard.highSchoolResume.resume.download', ['id' => $resume_id, 'type' => 'preview']) : route('admin-dashboard.highSchoolResume.pdf.preview') }}"
                                target="_blank" class="btn btn-alt-primary">SAVE RESUME AS FILE</a>
                        </div>
                        @if (isset($resume_id) && $resume_id != null)
                            <input type="hidden" name="resume_id" id="resume_id" value="{{ $resume_id }}">
                        @endif
                        <div class="printableArea">
                            <div class="text-border text-border-no-bg">
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
											{{ isset($personal_info->street_address_one) ? $personal_info->street_address_one . ',' : '' }}
											{{ isset($personal_info->street_address_two) ? $personal_info->street_address_two . ',' : '' }}
											{{ $personal_info->city . ',' }}
											{{ $personal_info->state }}
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
								<hr />
                            </div>
							
							
							
							{{-- sbz Starts here --}}
                            <div class="printableArea_main">
								<div class="row">
									<div class="col">
										<div class="position-relative preview-list ps-0 pb-3 {{ !empty($featured_awards_data) || !empty($featured_languages_data) || !empty($featured_skills_data) ? '' : 'd-none' }}">
										@if (!empty($featured_skills_data) || !empty($featured_awards_data) || !empty($featured_languages_data) || !empty($dual_citizenship_data))
											<div class="mb-0 border-bottom-0">
												@if ($featuredAttribute)
													<h3 class='resume-heading'>FEATURED</h3>
												@endif
												<div class="preview-list_skill">
													<ul class="list">
													@if(!empty($featured_skills_data))
														<li class="list-type">
															<span>Skills:</span>
															@php
															$skills = implode("; ", array_column($featuredAttribute->featured_skills_data, "skill"));
																echo "$skills";
																
															@endphp
														</li>
													@endif
													@if (!empty($featured_awards_data))
														<li class="list-type">
															<span>Awards:</span>
															@php
															$awards = implode("; ", array_column($featuredAttribute->featured_awards_data, "award"));
															echo "$awards";
															@endphp
														</li>
													@endif
													@if (!empty($featured_languages_data))
														<li class="list-type">
															<span>Languages:</span>
															@php
															$languages = implode("; ", array_column($featuredAttribute->featured_languages_data, "language"));
															echo "$languages";
															@endphp
														</li>
													@endif
													</ul>
												</div>
											</div>
										@endif
									</div>
								</div>
							</div>
							
							@if (!empty($education))
							<div class="row">
								<div class="col">
									<div class="preview-list ps-0 ">
										<h3 class='resume-heading'>EDUCATION</h3>
										<ul class="list">
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
												{{-- <span class="d-block mb-2">School Name / City / State /
													District :
												</span> --}}
												{{ $education->high_school_name }} /
												{{ $education->high_school_city }} /
												{{ $education->high_school_state }} /
												<!-- {{ $education->high_school_district }} -->
												@if (isset($education->graduation_designation) && $education->graduation_designation != null)
													({{$education->graduation_designation}})
												@endif
												@if(!empty($education->cumulative_gpa_weighted) || !empty($education->cumulative_gpa_unweighted))
													<li>
														<b>GPA: </b>
														Unweighted : {{ $education->cumulative_gpa_unweighted }};
														Weighted: {{ $education->cumulative_gpa_weighted }};
														@if(!empty($education->class_rank) || !empty($education->total_no_of_student))
															<b>Class Rank:</b>
															{{ $education->class_rank }} /
															{{ $education->total_no_of_student }}
														@endif
													</li>
												@endif
											</li>
											<li>
												@if (!empty($testing_data))
													@foreach ($testing_data as $data)
														<b>{{ isset($data['name_of_test']) ? $data['name_of_test'] : '' }} </b> : {{ isset($data['results_score']) ? $data['results_score'] : ''}}{{ !$loop->last ? ';' : '' }}
													@endforeach
												@endif
											</li>
											{{-- <li>
												<span>Current Grade:
												</span>{{ implode(',', ($current_grade)) }}
											</li> --}}
											{{-- <li>
												<span> Month / Year :
												</span>
												{{ $education->month }} / {{ $education->year }}
											</li> --}}
											
										   
											{{-- @if (!empty($education->ib_courses))
												<li>
													<span><u>IB Courses:</u></span>
													{{ implode(',', $ib_courses) }}
												</li>
											@endif --}}
											@if (!empty($education->ib_courses))
												<li>
													<span><u>IB Courses:</u></span>
													@foreach ($education->ib_courses as $ib_course)
														<b>{{ isset($ib_course['name_of_ib_course']) ? $ib_course['name_of_ib_course'] : '' }} </b> : {{ isset($ib_course['score_of_test']) ? $ib_course['score_of_test'] : ''}}{{ !$loop->last ? ';' : '' }}
													@endforeach
												</li>
											@endif

											{{-- @if (!empty($education->ap_courses))
												<li>
													<span><u>AP Courses:</u></span>
													{{ implode(',', $ap_courses) }}
												</li>
											@endif --}}

											@if (!empty($education->ap_courses))
												<li>
													<span><u>AP Courses:</u></span>
													@foreach ($education->ap_courses as $ap_course)
														<b>{{ isset($ap_course['name_of_ap_course']) ? $ap_course['name_of_ap_course'] : '' }} </b> : {{ isset($ap_course['score_of_test']) ? $ap_course['score_of_test'] : ''}}{{ !$loop->last ? ';' : '' }}
													@endforeach
												</li>
											@endif

											@if (!empty($education->honor_course_data))
												<li>
													<span> <u>Honors Course :</u></span>
														@foreach ($education->honor_course_data as $honor_course_data)
															@if(isset($honor_course_data['course_data']) && !empty($honor_course_data['course_data']))
																	{{ \App\Helpers\Helper::getHonorCourseByIdArray($honor_course_data['course_data']) }}
															@endif
														@endforeach
												</li>
											@endif
											@if (!empty($course_data))
												<li>
													<span><u>Concurrent Enrollment :</u></span>
													@foreach ($college_list as $college)
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
													@endforeach
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
								</div>
							</div>
							@endif
							
							@if (!empty($honor))
							<div class="row">
								<div class="col">
									<div class="preview-list ps-0 ">
										<h3 class='resume-heading'>HONORS, ACHIEVEMENTS, AND AWARDS</h3>
										<ul class="list">
											@foreach ($honor->honors_data as $honor_data)
												<li class="list-type">
													@if(isset($honor_data['grade']) && !empty($honor_data['grade']))
														<b>{{ \App\Helpers\Helper::getGradeByIdArray($honor_data['grade']) }}: </b>
													@endif
													@if(isset($honor_data['position']) && !empty($honor_data['position']))
														{{ $honor_data['position'] }}@if(isset($honor_data['honor_achievement_award']) && !empty($honor_data['honor_achievement_award'])),@endif
													@endif
													@if(isset($honor_data['honor_achievement_award']) && !empty($honor_data['honor_achievement_award']))
														{{ $honor_data['honor_achievement_award'] }}@if(isset($honor_data['location']) && !empty($honor_data['location'])),@endif
													@endif
													@if(isset($honor_data['location']) && !empty($honor_data['location']))
														{{ $honor_data['location'] }}
													@endif
												</li>    
											@endforeach

													
										</ul>
									</div>
								</div>
							</div>
							@endif
							
							@if (!empty($activity))
							<div class="row">
								<div class="col">
									<div class="preview-list ps-0">
										<h3 class='resume-heading'>ACTIVITIES</h3>
										<ul class="list">
											@if (!empty($demonstrated_data))
												@foreach ($demonstrated_data as $data)
													<li class="list-type">
														<b>{{isset($data['grade']) && $data['grade'] != null ? (\App\Helpers\Helper::getGradeByIdArray($data['grade'])) : ''}}: </b>
														{{ $data['position'] }}@if(!empty($data['interest']) || !empty($data['location']) || !empty($data['details'])),@endif
														@if(!empty($data['interest'])) 
															{{ $data['interest'] }}@if(!empty($data['details']) || !empty($data['location'])),@endif
														@endif
														@if(!empty($data['location'])) 
															{{ $data['location'] }}@if(!empty($data['details'])),@endif
														@endif
														@if(!empty($data['details']))
															{{ $data['details'] }}
														@endif 
													</li>
												@endforeach
											@endif
											@if(!empty($leadership_data))
												@foreach($leadership_data as $data)
												<li class="list-type">
													@if(!empty($data['grade']))
														<b>{{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}: </b>
													@endif
													@if(!empty($data['status']))
														{{ $data['status'] }}@if(!empty($data['position'] || !empty($data['location']) || !empty($data['organization']))),@endif
													@endif
													@if(!empty($data['position']))
														{{ $data['position'] }}@if(!empty($data['location']) || !empty($data['organization'])),@endif
													@endif
													@if(!empty($data['location']))
														{{ $data['location'] }}@if(!empty($data['organization'])),@endif
													@endif
													@if(!empty($data['organization']))
														{{ $data['organization'] }}
													@endif
												</li>
											@endforeach
  											@endif
											@if(!empty($activities_data))
												@foreach ($activities_data as $data)
													<li class="list-type">
														@if(!empty($data['grade']))
															<b>{{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}: </b>
														@endif
														@if(!empty($data['position']))
															{{ $data['position'] }}@if(!empty($data['activity']) || !empty($data['location']) || !empty($data['honor_award'])),@endif
														@endif
														@if(!empty($data['activity']))
															{{ $data['activity'] }}@if(!empty($data['location']) || !empty($data['honor_award'])),@endif
														@endif
														@if(!empty($data['location']))
															{{ $data['location'] }}@if(!empty($data['honor_award'])),@endif
														@endif
														@if(!empty($data['honor_award']))
															{{ $data['honor_award'] }}
														@endif
													</li>
												@endforeach

											@endif
										</ul>
									</div>
								</div>
							</div>
							@endif
							
							@if(!empty($athletics_data))
							<div class="row">
								<div class="col">
									<div class="preview-list ps-0">
										<h3 class='resume-heading'>ATHLETICS</h3>
										<ul class="list">
											@foreach ($athletics_data as $key => $data)
												<li class="list-type">
													@if(!empty($data['grade']))
														<b>{{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}:</b>
													@endif
													@if(isset($data['position']) && !empty($data['position']))
														{{ $data['position'] }}@if(!empty($data['activity']) || !empty($data['location']) || !empty($data['honor'])),@endif
													@endif
													@if(isset($data['activity']) && !empty($data['activity']))
														{{ $data['activity'] }}@if(!empty($data['location']) || !empty($data['honor'])),@endif
													@endif
													@if(isset($data['location']) && !empty($data['location']))
														{{ $data['location'] }}@if(!empty($data['honor'])),@endif
													@endif
													@if(isset($data['honor']) && !empty($data['honor']))
														{{ $data['honor'] }}
													@endif
												</li>
											@endforeach
										</ul>
									</div>
								</div>
							</div>
							@endif
							
							@if(!empty($community_service_data)) 
							<div class="row">
								<div class="col">
									<div class="preview-list ps-0">
										<h3 class='resume-heading'>COMMUNITY SERVICE</h3>
										<ul class="list">
											@php
												$community_service_array = [            'level' => [],
													'service' => [],
													'grade' => [],
													'location' => []
												];
											@endphp

											@foreach ($community_service_data as $data)
												@php
													if (isset($data['level'])) {
														$community_service_array['level'][] = $data['level'];
													}
													if (isset($data['service'])) {
														$community_service_array['service'][] = $data['service'];
													}
													if (isset($data['grade'])) {
														$community_service_array['grade'][] = $data['grade'];
													}
													if (isset($data['location'])) {
														$community_service_array['location'][] = $data['location'];
													}
												@endphp
											@endforeach

											<li class="list-type">
												@if (isset($community_service_array['grade']) && !empty($community_service_array['grade']))
													<b>{{ \App\Helpers\Helper::getGradeAllByIdArray($community_service_array['grade']) }}: </b>
												@endif
												@if (isset($community_service_array['level']) && !empty($community_service_array['level']))
													{{ implode(',', $community_service_array['level']) }}@if ((isset($community_service_array['service']) && !empty($community_service_array['service'])) || (isset($community_service_array['location']) && !empty($community_service_array['location']))),@endif
												@endif
												@if (isset($community_service_array['service']) && !empty($community_service_array['service']))
													{{ implode(',', $community_service_array['service']) }}@if (isset($community_service_array['location']) && !empty($community_service_array['location'])),@endif
												@endif
												@if (isset($community_service_array['location']) && !empty($community_service_array['location']))
													{{ implode(',', $community_service_array['location']) }}
												@endif
											</li>
										</ul>
									</div>
								</div>
							</div>
							@endif
							
							@if (!empty($employment_data)) 
							<div class="row">
								<div class="col">
									<div class="preview-list ps-0">
										<h3 class='resume-heading'>EMPLOYMENT</h3>
										<ul class="list">
											@foreach ($employment_data as $data)
											<li class="list-type">
												@if(isset($data['grade']) && !empty($data['grade']))
													<b>{{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}: </b>
												@endif
												@if(!is_null($data['job_title']))
													{{ $data['job_title'] }}@if(!is_null($data['name_of_company']) || !is_null($data['location']) || !is_null($data['honor_award'])),@endif
												@endif
												@if(!is_null($data['name_of_company']))
													{{ $data['name_of_company'] }}@if(!is_null($data['location']) || !is_null($data['honor_award'])),@endif
												@endif
												@if(!is_null($data['location']))
													{{ $data['location'] }}@if(!is_null($data['honor_award'])),@endif
												@endif
												@if(!is_null($data['honor_award']))
													{{ $data['honor_award'] }}
												@endif
											</li>    
										@endforeach
										</ul>
									</div>
								</div>
							</div>
							@endif
							
							 @if (!empty($significant_data)) 
							<div class="row">
								<div class="col">
									<div class="preview-list ps-0">
										<h3 class='resume-heading'>RESPONSIBILITIES OR INTERESTS</h3>
										<ul class="list">
											@foreach ($significant_data as $data)
												<li class="list_items">
													@if(isset($data['grade']) && !empty($data['grade']))
														<b>{{ \App\Helpers\Helper::getGradeByIdArray($data['grade']) }}: </b>
													@endif
													@if (isset($data['interest']) && !empty($data['interest']))
														{{ $data['interest'] }}@if (isset($data['location']) && !empty($data['location']) || isset($data['honor_award']) && !empty($data['honor_award'])),@endif
														
													@endif
													@if (isset($data['location']) && !empty($data['location']))
														{{ $data['location'] }}@if (isset($data['honor_award']) && !empty($data['honor_award'])),@endif
													@endif
													@if (isset($data['honor_award']) && !empty($data['honor_award']))
														{{ $data['honor_award'] }}
													@endif
												</li>
											@endforeach
										</ul>
									</div>
								</div>
							</div>
							@endif
							
							{{-- sbz ends here --}}
							
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <div class="prev-btn next-btn">
                        <a href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/features-attributes?resume_id=' . $resume_id) : route('admin-dashboard.highSchoolResume.featuresAttributes') }}"
                            class="btn btn-alt-success prev-step"> Previous
                        </a>
                    </div>
                    <div class="next-btn">
                        <a href="{{ isset($resume_id) && $resume_id != null ? route('admin-dashboard.highSchoolResume.list') : route('admin-dashboard.highSchoolResume.resume.complete') }}"
                            class="btn btn-alt-success submit_btn">{{ isset($resume_id) && $resume_id != null ? 'Update' : 'Submit' }}</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}">
@endsection

@section('user-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/high-school-resume.js') }}"></script>
@endsection