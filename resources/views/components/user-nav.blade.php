<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header">
        <!-- Logo -->
        <a class="fw-semibold text-dual" href="{{ route('user-dashboard') }}">
            <span class="smini-visible">
                <i class="fa fa-circle-notch text-primary"></i>
            </span>
            <span class="smini-hide fs-5 tracking-wider">One<span class="fw-normal">UI</span></span>
        </a>
        <!-- END Logo -->

        <!-- Extra -->
        <div>
            <!-- Close Sidebar, Visible only on mobile screens -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close"
                href="javascript:void(0)">
                <i class="fa fa-fw fa-times"></i>
            </a>
            <!-- END Close Sidebar -->
        </div>
        <!-- END Extra -->
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
        <!-- Side Navigation -->
        <div class="content-side">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link" href="#">
                        <i class="nav-main-link-icon fa-solid fa-video"></i>
                        <span class="nav-main-link-name">How to Use This Site</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is('resume') ? 'active' : '' }}" href="{{ route('resume') }}">
                        <i class="nav-main-link-icon fa-solid fa-arrow-right"></i>
                        <span class="nav-main-link-name">Resume Activity</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is('user-dashboard') ? 'active' : '' }}" href="{{ route('user-dashboard') }}">
                        <i class="nav-main-link-icon si si-speedometer"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
                <!-- <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is('user-dashboard') ? 'active' : '' }}" href="{{ route('user-dashboard') }}">
                        <i class="nav-main-link-icon si si-speedometer"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li> -->
                {{---@if (Auth::user()->isUserHasValidPermission('Access Courses'))
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ Route::is(['courses.index', 'courses.detail']) ? 'active' : '' }}"
                            href="{{ route('courses.index') }}">
                            <i class="nav-main-link-icon si si-book-open"></i>
                            <span class="nav-main-link-name">Courses</span>
                        </a>
                    </li>
                @endif--}}


                <li
                    class="nav-main-item {{ Route::is(['admin-dashboard.careerExploration.*']) || Route::is(['user.*']) ? 'open' : '' }} ? 'open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa-solid fa-book-open-reader"></i>
                        <span class="nav-main-link-name">Milestone Lessons</span>
                    </a>
                    <ul class="nav-main-submenu">

                        <li class="nav-main-item">
                            <a class="nav-main-link"
                                href="#">
                                <i class="nav-main-link-icon si si-book-open"></i>
                                <span class="nav-main-link-name">Course Home</span>
                            </a>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link"
                                href="#">
                                <i class="fa-regular fa-address-card nav-main-link-icon"></i>
                                <span class="nav-main-link-name">Profile Development</span>
                            </a>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::is('admin-dashboard.careerExploration.*') ? 'active' : '' }}"
                                href="{{ route('admin-dashboard.careerExploration') }}">
                                <i class="fa fa-graduation-cap nav-main-link-icon"></i>
                                <span class="nav-main-link-name">Career Exploration</span>
                            </a>
                        </li>

                        @if (Auth::user()->isUserHasValidPermission('Access Initial College List'))
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ Route::is('admin-dashboard.initialCollegeList.*') ? 'active' : '' }}"
                                    href="{{ route('admin-dashboard.initialCollegeList.step1') }}">
                                    <i class="nav-main-link-icon fa-solid fa-magnifying-glass"></i>
                                    <span class="nav-main-link-name">College Search</span>
                                </a>
                            </li>
                        @endif

                        <li class="nav-main-item">
                            <a class="nav-main-link"
                                href="#">
                                <i class="nav-main-link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                                        <path fill="rgba(159,174,193,.5)" d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V285.7l-86.8 86.8c-10.3 10.3-17.5 23.1-21 37.2l-18.7 74.9c-2.3 9.2-1.8 18.8 1.3 27.5H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM549.8 235.7l14.4 14.4c15.6 15.6 15.6 40.9 0 56.6l-29.4 29.4-71-71 29.4-29.4c15.6-15.6 40.9-15.6 56.6 0zM311.9 417L441.1 287.8l71 71L382.9 487.9c-4.1 4.1-9.2 7-14.9 8.4l-60.1 15c-5.5 1.4-11.2-.2-15.2-4.2s-5.6-9.7-4.2-15.2l15-60.1c1.4-5.6 4.3-10.8 8.4-14.9z"/>
                                    </svg>
                                </i>
                                <span class="nav-main-link-name">Test Prep</span>
                            </a>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link"
                                href="#">
                                <i class="far fa-file-lines nav-main-link-icon"></i>
                                <span class="nav-main-link-name">College Application</span>
                            </a>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link"
                                href="#">
                                <i class="far fa-dollar-sign nav-main-link-icon"></i>
                                <span class="nav-main-link-name">Financial Aid & Scholarships</span>
                            </a>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link"
                                href="#">
                                <i class="fa fa-graduation-cap nav-main-link-icon"></i>
                                <span class="nav-main-link-name">Final College Decision</span>
                            </a>
                        </li>
                    </ul>

                </li>

                <li
                    class="nav-main-item {{ Route::is(['admin-dashboard.*']) || Route::is(['user.*']) ? 'open' : '' }} ? 'open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa-solid fa-building-columns"></i>
                        <span class="nav-main-link-name">Admissions Tools</span>
                    </a>
                    <ul class="nav-main-submenu">

                        @if (Auth::user()->isUserHasValidPermission('Access Admission Dashboard'))
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ Route::is('admin-dashboard.dashboard') ? 'active' : '' }}"
                                    href="{{ route('admin-dashboard.dashboard') }}">
                                    <i class="nav-main-link-icon si si-speedometer"></i>
                                    <span class="nav-main-link-name">Dashboard</span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->isUserHasValidPermission('Access High School Resume'))
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ Route::is('admin-dashboard.highSchoolResume.list') || Route::is('admin-dashboard.highSchoolResume.personalInfo') || Route::is('admin-dashboard.highSchoolResume.educationInfo') || Route::is('admin-dashboard.highSchoolResume.honors') || Route::is('admin-dashboard.highSchoolResume.activities') || Route::is('admin-dashboard.highSchoolResume.employmentCertification') || Route::is('admin-dashboard.highSchoolResume.featuresAttributes') || Route::is('admin-dashboard.highSchoolResume.preview') ? 'active' : '' }}"
                                    href="{{ route('admin-dashboard.highSchoolResume.list') }}">
                                    <i class="nav-main-link-icon si si-list"></i>
                                    <span class="nav-main-link-name">High School Resume</span>
                                </a>
                            </li>
                        @endif


                        @if (Auth::user()->isUserHasValidPermission('Access Initial College List'))
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ Route::is('admin-dashboard.initialCollegeList.*') ? 'active' : '' }}"
                                    href="{{ route('admin-dashboard.initialCollegeList.step1') }}">
                                    <i class="nav-main-link-icon fa-solid fa-magnifying-glass"></i>
                                    <span class="nav-main-link-name">College Search</span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->isUserHasValidPermission('Access Cost Comparison Tool'))
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ Route::is('admin-dashboard.cost_comparison') ? 'active' : '' }}"
                                    href="{{ route('admin-dashboard.cost_comparison') }}">
                                    <i class="nav-main-link-icon si si-calculator"></i>
                                    <span class="nav-main-link-name">College Cost Comparison</span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->isUserHasValidPermission('Access College Application Deadline Organizer'))
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ Route::is('admin-dashboard.collegeApplicationDeadline') ? 'active' : '' }}"
                                    href="{{ route('admin-dashboard.collegeApplicationDeadline') }}">
                                    <i class="nav-main-link-icon si si-book-open"></i>
                                    <span class="nav-main-link-name">College Application Deadline Organizer</span>
                                </a>
                            </li>
                        @endif
                    </ul>

                </li>

                <li
                    class="nav-main-item {{ Route::is(['self-made-test.*', 'test_home_page', 'test_prep_dashboard', 'test-review.review']) ? 'open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="false" href="#">
                        <i class="nav-main-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                                <path fill="rgba(159,174,193,.5)" d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V285.7l-86.8 86.8c-10.3 10.3-17.5 23.1-21 37.2l-18.7 74.9c-2.3 9.2-1.8 18.8 1.3 27.5H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM549.8 235.7l14.4 14.4c15.6 15.6 15.6 40.9 0 56.6l-29.4 29.4-71-71 29.4-29.4c15.6-15.6 40.9-15.6 56.6 0zM311.9 417L441.1 287.8l71 71L382.9 487.9c-4.1 4.1-9.2 7-14.9 8.4l-60.1 15c-5.5 1.4-11.2-.2-15.2-4.2s-5.6-9.7-4.2-15.2l15-60.1c1.4-5.6 4.3-10.8 8.4-14.9z"/>
                            </svg>
                        </i>
                        <span class="nav-main-link-name">Test Prep Tool</span>
                    </a>
                    <ul class="nav-main-submenu">
                        @if (Auth::user()->isUserHasValidPermission('Access Test Prep Dashboard'))
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ Route::is(['test_prep_dashboard']) ? 'active' : '' }}"
                                    href="{{ route('test_prep_dashboard') }}">
                                    <i class="nav-main-link-icon si si-speedometer"></i>
                                    <span class="nav-main-link-name">Dashboard</span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->isUserHasValidPermission('Access Test Home Page'))
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ Route::is(['test_home_page']) ? 'active' : '' }}"
                                    href="{{ route('test_home_page') }}">
                                    <i class="nav-main-link-icon si si-book-open"></i>
                                    <span class="nav-main-link-name">Test Home Page</span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->isUserHasValidPermission('Access Self Made Tests'))
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ Route::is(['self-made-test.*']) ? 'active' : '' }}"
                                    href="{{ route('self-made-test.index') }}">
                                    <i class="nav-main-link-icon si si-graduation"></i>
                                    <span class="nav-main-link-name">Custom Quizzes</span>
                                </a>
                            </li>
                        @endif

                        {{-- <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::is(['test-review.review']) ? 'active' : '' }}"
                                href="{{ route('test-review.review') }}">
                                <i class="nav-main-link-icon si si-book-open"></i>
                                <span class="nav-main-link-name">Test Review</span>
                            </a>
                        </li> --}}
                    </ul>

                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link" href="#">
                        <i class="nav-main-link-icon far fa-calendar"></i>
                        <span class="nav-main-link-name">Calendar</span>
                    </a>
                </li>


                <li class="nav-main-item">
                    <a class="nav-main-link" href="#">
                        <i class="nav-main-link-icon far fa-bell"></i>
                        <span class="nav-main-link-name">Notifications</span>
                    </a>    
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is('rewards.*') ? 'active' : '' }}" href="{{ route('rewards.index') }}">
                        <i class="nav-main-link-icon far fa-dollar-sign"></i>
                        <span class="nav-main-link-name">Rewards</span>
                    </a>
                </li>

                <!-- <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is(['test_prep_dashboard']) ? 'active' : '' }}" href="{{ route('test_prep_dashboard') }}">
                        <i class="nav-main-link-icon si si-puzzle"></i>
                        <span class="nav-main-link-name">Test Prep Dashboard</span>
                    </a>
                </li> -->
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>
<!-- END Sidebar -->
