<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header">
        <!-- Logo -->
        <a class="fw-semibold text-dual" href="{{route('admin-dashboard')}}">
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
                    <a class="nav-main-link {{Route::is('admin-dashboard') ? 'active' : ''}}" href="{{route('admin-dashboard')}}">
                        <i class="nav-main-link-icon si si-speedometer"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
                <li class="nav-main-item {{(Route::is('admin-user-list') || Route::is('admin-edit-user') || Route::is('admin-create-user')) ? 'open' : ''}}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                        <i class="nav-main-link-icon si si-users"></i>
                        <span class="nav-main-link-name">User Management</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is('admin-user-list') ? 'active' : ''}}" href="{{route('admin-user-list')}}">
                                <span class="nav-main-link-name">User List</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is('admin-create-user') ? 'active' : ''}}" href="{{route('admin-create-user')}}">
                                <span class="nav-main-link-name">Add User</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item {{(Route::is(['courses.index','courses.create','courses.edit','milestones.index','milestones.create','milestones.edit',
                    'sections.index','sections.create','sections.edit','tasks.index','tasks.create','tasks.edit',
                    'modules.index','modules.create','modules.edit','tags.index','tags.create','tags.edit',
                    'content-categories.index','content-categories.create','content-categories.edit'])) ? 'open' : ''}}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                        <i class="nav-main-link-icon fa-solid fa-file"></i>
                        <span class="nav-main-link-name">Course Management</span>
                    </a>
					<ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is(['courses.index','courses.create','courses.edit']) ? 'active' : ''}}"
                               href="/admin/course-management/courses">
                                <span class="nav-main-link-name">Courses</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is(['milestones.index','milestones.create','milestones.edit']) ? 'active' : ''}}"
                               href="{{route('milestones.index')}}">
                                <span class="nav-main-link-name">Milestones</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is(['modules.index','modules.create','modules.edit']) ? 'active' : ''}}"
                               href="{{route('modules.index')}}">
                                <span class="nav-main-link-name">Modules</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is(['sections.index','sections.create','sections.edit']) ? 'active' : ''}}"
                               href="{{route('sections.index')}}">
                                <span class="nav-main-link-name">Sections</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is(['tasks.index','tasks.create','tasks.edit']) ? 'active' : ''}}"
                               href="{{route('tasks.index')}}">
                                <span class="nav-main-link-name">Task Management</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is(['tags.index','tags.create','tags.edit']) ? 'active' : ''}}"
                               href="{{route('tags.index')}}">
                                <span class="nav-main-link-name">Tags</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is(['content-categories.index','content-categories.create','content-categories.edit']) ? 'active' : ''}}"
                               href="{{route('content-categories.index')}}">
                                <span class="nav-main-link-name">Content Category</span>
                            </a>
                        </li>
                    </ul>
                </li>                   
                <li class="nav-main-item {{(Route::is(['quiztags.index','quiztags.create','quiztags.edit','passages.index','passages.create','passages.edit','categories.index','categories.create','categories.edit','diffratings.index','diffratings.create','diffratings.edit','questiontags.index','questiontags.create','questiontags.edit','supercategories.index','supercategories.create','supercategories.edit','indexCategoryType','add_category_type','edit_category_type','indexQuestionType','add_question_type','edit_question_type'])) ? 'open' : ''}}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                        <i class="nav-main-link-icon fa-solid fa-file"></i>
                        <span class="nav-main-link-name">Quiz Management</span>
                    </a>
					<ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link"
                               href="#">
                                <span class="nav-main-link-name">Quizzes</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is(['passages.index','passages.create','passages.edit']) ? 'active' : ''}}"
                               href="{{route('passages.index')}}">
                                <span class="nav-main-link-name">Passages</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is(['questions.index','questions.create','questions.edit']) ? 'active' : ''}}"
                               href="{{route('questions.index')}}">
                                <span class="nav-main-link-name">Questions</span>
                            </a>
                        </li>
                    </ul>
					<ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is(['practicetests.index','practicetests.create','practicetests.edit']) ? 'active' : ''}}"
                               href="{{route('practicetests.index')}}">
                                <span class="nav-main-link-name">Practice Tests</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is(['diffratings.index','diffratings.create','diffratings.edit']) ? 'active' : ''}}"
                               href="{{route('diffratings.index')}}">
                                <span class="nav-main-link-name">Difficulty Rating</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is(['questiontags.index','questiontags.create','questiontags.edit']) ? 'active' : ''}}"
                               href="{{route('questiontags.index')}}">
                                <span class="nav-main-link-name">Question Tags</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is(['supercategories.index','supercategories.create','supercategories.edit']) ? 'active' : ''}}"
                               href="{{route('supercategories.index')}}">
                                <span class="nav-main-link-name">Super Category</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is(['indexCategoryType','add_category_type','edit_category_type']) ? 'active' : ''}}"
                               href="{{route('indexCategoryType')}}">
                                <span class="nav-main-link-name">Category Types</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is(['indexQuestionType','add_question_type','edit_question_type']) ? 'active' : ''}}"
                               href="{{route('indexQuestionType')}}">
                                <span class="nav-main-link-name">Question Types</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item {{(Route::is(['quiztags.index','quiztags.create','quiztags.edit','categories.index','categories.create','categories.edit'])) ? 'open' : ''}}">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                                <span class="nav-main-link-name">General Settings</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link {{Route::is(['categories.index','categories.create','categories.edit']) ? 'active' : ''}}"
                                    href="{{route('categories.index')}}">
                                        <span class="nav-main-link-name">Categories</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link {{Route::is(['quiztags.index','quiztags.create','quiztags.edit']) ? 'active' : ''}}"
                                    href="{{route('quiztags.index')}}">
                                        <span class="nav-main-link-name">Tags</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link"
                                    href="#">
                                        <span class="nav-main-link-name">Types</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item {{ Route::is(['admin.highSchoolResume.*', 'admin.admission-management.*']) ? 'open' : ''}}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                        <i class="nav-main-link-icon fas fa-cogs"></i>
                        <span class="nav-main-link-name">Admission Management</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is('admin.highSchoolResume.settings') ? 'active' : ''}}" href="{{route('admin.highSchoolResume.settings')}}">
                                <span class="nav-main-link-name">High School Resume Settings</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{Route::is('admin.admission-management.college-information.index') ? 'active' : ''}}" href="{{ route('admin.admission-management.college-information.index') }}">
                                <span class="nav-main-link-name">College Information</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item {{ Route::is(['admin.category.*','admin.plan.*', 'admin.product.*']) ? 'open' : ''}}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                        <i class="nav-main-link-icon fas fa-cogs"></i>
                        <span class="nav-main-link-name">Plan Management</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item {{ Route::is(['admin.category.*']) ? 'open' : ''}}">
                            <a class="nav-main-link {{Route::is('admin.category.list') ? 'active' : ''}}" href="{{route('admin.category.list')}}">
                                <span class="nav-main-link-name">Category Management</span>
                            </a>
                        </li>
                        <li class="nav-main-item {{ Route::is(['admin.product.*']) ? 'open' : ''}}">
                            <a class="nav-main-link {{Route::is('admin.product.list') ? 'active' : ''}}" href="{{route('admin.product.list')}}">
                                <span class="nav-main-link-name">Product Management</span>
                            </a>
                        </li>
                        <li class="nav-main-item {{ Route::is(['admin.plan.*']) ? 'open' : ''}}">
                            <a class="nav-main-link {{Route::is('admin.plan.list') ? 'active' : ''}}" href="{{route('admin.plan.list')}}">
                                <span class="nav-main-link-name">Plan Management</span>
                            </a>
                        </li>
                        <li class="nav-main-item {{ Route::is(['admin.product.*']) ? 'open' : ''}}">
                            <a class="nav-main-link {{Route::is('admin.product.permission') ? 'active' : ''}}" href="{{route('admin.product.permission')}}">
                                <span class="nav-main-link-name">Product Permissions</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item {{ Route::is(['admin.worksheet-management.*']) ? 'open' : ''}}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                        <i class="nav-main-link-icon fas fa-cogs"></i>
                        <span class="nav-main-link-name">Worksheet Management</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item {{ Route::is(['admin.worksheet-management.*']) ? 'open' : ''}}">
                            <a class="nav-main-link {{Route::is('admin.worksheet-management.index') ? 'active' : ''}}" href="{{route('admin.worksheet-management.index')}}">
                                <span class="nav-main-link-name">Worksheet List</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
    </nav>
    <!-- END Sidebar -->
