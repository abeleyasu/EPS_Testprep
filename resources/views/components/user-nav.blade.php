<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header">
        <!-- Logo -->
        <a class="fw-semibold text-dual" href="{{route('user-dashboard')}}">
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
                    <a class="nav-main-link {{Route::is('resume') ? 'active' : ''}}" href="{{route('resume')}}">
                        <i class="nav-main-link-icon far fa-user"></i>
                        <span class="nav-main-link-name">Resume</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{Route::is('user-dashboard') ? 'active' : ''}}" href="{{route('user-dashboard')}}">
                        <i class="nav-main-link-icon si si-speedometer"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{Route::is(['courses.index','courses.detail']) ? 'active' : ''}}" href="{{route('courses.index')}}">
                        <i class="nav-main-link-icon si si-book-open"></i>
                        <span class="nav-main-link-name">Courses</span>
                    </a>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link {{Route::is(['test_prep_dashboard']) ? 'active' : ''}}" href="{{route('test_prep_dashboard')}}">
                        <i class="nav-main-link-icon si si-puzzle"></i>
                        <span class="nav-main-link-name">Test Prep Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
    </nav>
    <!-- END Sidebar -->