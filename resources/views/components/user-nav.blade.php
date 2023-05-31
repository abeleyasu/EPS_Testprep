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
            <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
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
                    <a class="nav-main-link {{ Route::is('resume') ? 'active' : '' }}" href="{{ route('resume') }}">
                        <i class="nav-main-link-icon far fa-user"></i>
                        <span class="nav-main-link-name">Resume</span>
                    </a>
                </li>
                <!-- <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is('user-dashboard') ? 'active' : '' }}" href="{{ route('user-dashboard') }}">
                        <i class="nav-main-link-icon si si-speedometer"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>    
                </li> -->
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is(['courses.index', 'courses.detail']) ? 'active' : '' }}" href="{{ route('courses.index') }}">
                        <i class="nav-main-link-icon si si-book-open"></i>
                        <span class="nav-main-link-name">Courses</span>
                    </a>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link" href="#">
                        <i class="nav-main-link-icon si si-speedometer"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is(['test_prep_dashboard']) ? 'active' : '' }}" href="{{ route('test_prep_dashboard') }}">
                        <i class="nav-main-link-icon si si-book-open"></i>
                        <span class="nav-main-link-name">Test Prep</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is(['test_home_page']) ? 'active' : '' }}"
                        href="{{ route('test_home_page') }}">
                        <i class="nav-main-link-icon si si-book-open"></i>
                        <span class="nav-main-link-name">Test Home Page</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is(['self-made-test']) ? 'active' : '' }}"
                        href="{{ route('self-made-test') }}">
                        <i class="nav-main-link-icon si si-graduation"></i>
                        <span class="nav-main-link-name">Self Made Test</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is(['test-review.review']) ? 'active' : '' }}" href="{{ route('test-review.review') }}">
                        <i class="nav-main-link-icon si si-book-open"></i>
                        <span class="nav-main-link-name">Test Review</span>
                    </a>
                </li>
                <!-- <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is(['test_prep_dashboard']) ? 'active' : '' }}" href="{{ route('test_prep_dashboard') }}">
                        <i class="nav-main-link-icon si si-puzzle"></i>
                        <span class="nav-main-link-name">Test Prep Dashboard</span>
                    </a>
                </li> -->
                <li class="nav-main-item {{ Route::is(['admin-dashboard.*'])|| Route::is(['user.*']) ? 'open' : '' }} ? 'open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon si si-briefcase"></i>
                        <span class="nav-main-link-name">Admissions dashboard</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            {{-- <a class="nav-main-link {{ Route::is('admin-dashboard.highSchoolResume.personalInfo') ? 'active' : '' }}"
                            href="{{ route('admin-dashboard.highSchoolResume.personalInfo') }}">
                            <i class="nav-main-link-icon si si-pencil"></i>
                            <span class="nav-main-link-name">High school resume</span>
                            </a> --}}
                            <a class="nav-main-link {{ Route::is('admin-dashboard.highSchoolResume.list') || Route::is('admin-dashboard.highSchoolResume.personalInfo') || Route::is('admin-dashboard.highSchoolResume.educationInfo') || Route::is('admin-dashboard.highSchoolResume.honors') || Route::is('admin-dashboard.highSchoolResume.activities') || Route::is('admin-dashboard.highSchoolResume.employmentCertification') || Route::is('admin-dashboard.highSchoolResume.featuresAttributes') || Route::is('admin-dashboard.highSchoolResume.preview') ? 'active' : '' }}" href="{{ route('admin-dashboard.highSchoolResume.list') }}">
                                <i class="nav-main-link-icon si si-list"></i>
                                <span class="nav-main-link-name">High school resume</span>
                            </a>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::is('admin-dashboard.collegeApplicationDeadline') ? 'active' : '' }}" href="{{ route('admin-dashboard.collegeApplicationDeadline') }}">
                                <i class="nav-main-link-icon si si-book-open"></i>
                                <span class="nav-main-link-name">College Application Deadline Organizer</span>
                            </a>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::is('admin-dashboard.initialCollegeList.*') ? 'active' : '' }}" href="{{ route('admin-dashboard.initialCollegeList.step1') }}">
                                <i class="nav-main-link-icon si si-book-open"></i>
                                <span class="nav-main-link-name">Initial College List</span>
                            </a>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::is('user.cost_comparison.*') ? 'active' : '' }}" href="{{ route('user.cost_comparison') }}">
                                <i class="nav-main-link-icon si si-calculator"></i>
                                <span class="nav-main-link-name">Cost Comparison tool</span>
                            </a>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::is('admin-dashboard.careerExploration.*') ? 'active' : '' }}" href="{{ route('admin-dashboard.careerExploration') }}">
                                <i class="fa fa-graduation-cap nav-main-link-icon"></i>
                                <span class="nav-main-link-name">Career Exploration</span>
                            </a>
                        </li>

                        {{-- <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::is('admin-dashboard.highSchoolResume.list') ? 'active' : '' }}"
                        href="{{ route('admin-dashboard.highSchoolResume.list') }}">
                        <i class="nav-main-link-icon si si-list"></i>
                        <span class="nav-main-link-name">Resume listing</span>
                        </a>
                </li> --}}

                {{-- <li class="nav-main-item">
                            <a class="nav-main-link"
                                href="#">
                                <i class="nav-main-link-icon si si-list"></i>
                                <span class="nav-main-link-name">Career Exploration</span>
                            </a>
                        </li> --}}



                {{-- <li class="nav-main-item {{ Route::is('admin-dashboard.*') ? 'open' : '' }}">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-graduation"></i>
                    <span class="nav-main-link-name">Admissions dashboard</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ Route::is('admin-dashboard.highSchoolResume.personalInfo') ? 'active' : '' }}" href="{{ route('admin-dashboard.highSchoolResume.personalInfo') }}">
                            <i class="nav-main-link-icon si si-book-open"></i>
                            <span class="nav-main-link-name">High School Resume tool</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ Route::is('admin-dashboard.highSchoolResume.list') ? 'active' : '' }}" href="{{ route('admin-dashboard.highSchoolResume.list') }}">
                            <i class="fa fa-2x fa-address-card"></i>
                            <span class="nav-main-link-name">Resume listing</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ Route::is('admin-dashboard.initialCollegeList') ? 'active' : '' }}" href="{{ route('admin-dashboard.initialCollegeList') }}">
                            <i class="fa fa-2x fa-rectangle-list"></i>
                            <span class="nav-main-link-name">Initial College List tool</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ Route::is('admin-dashboard.collegeApplicationDeadline') ? 'active' : '' }}" href="{{ route('admin-dashboard.collegeApplicationDeadline') }}">
                            <i class="fa fa-2x fa-toolbox"></i>
                            <span class="nav-main-link-name">College Application Deadline Organizer
                                tool</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ Route::is('user.cost_comparison') ? 'active' : '' }}" href="{{ route('user.cost_comparison') }}">
                            <i class="far fa-2x fa-money-bill-1"></i>
                            <span class="nav-main-link-name">Cost Comparison tool</span>
                        </a>
                    </li>
                </ul>
                </li> --}}

            </ul>

            </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>
<!-- END Sidebar -->