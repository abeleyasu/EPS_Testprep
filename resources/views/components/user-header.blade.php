<!-- Header -->
<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div class="d-flex align-items-center">
            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
            <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <!-- END Toggle Sidebar -->

            <!-- Toggle Mini Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
            <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                <i class="fa fa-fw fa-ellipsis-v"></i>
            </button>
            <!-- END Toggle Mini Sidebar -->
            <div class="block-title d-none d-md-flex justify-content-center">
                Welcome to College Prep System, {{ auth()->user()->first_name }}!
            </div>
        </div>

        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="d-flex align-items-center">
            <a href="{{route('plan.index')}}" class="btn btn-alt-success">Upgrade</a>
            @if(!Auth::user()->subscribed('default'))
            @endif
            <!-- User Dropdown -->
            <div class="dropdown d-inline-block ms-2">
                <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle" src="{{ auth()->user()->profile_pic ? asset('profile_images/' . auth()->user()->profile_pic) : asset('assets/media/avatars/no-user-image.png') }}" alt="Header Avatar" style="width: 21px; mix-blend-mode: multiply;">
                    <span class="d-none d-sm-inline-block ms-2">{{ auth()->user()->first_name }}</span>
                    <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block opacity-50 ms-1 mt-1"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0" aria-labelledby="page-header-user-dropdown">
                    <div class="p-3 text-center bg-body-light border-bottom rounded-top"> 
                        <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ auth()->user()->profile_pic ? asset('profile_images/' . auth()->user()->profile_pic) : asset('assets/media/avatars/no-user-image.png') }}" alt="" style="mix-blend-mode: multiply;">
                        <p class="mt-2 mb-0 fw-medium">{{ auth()->user()->name }}</p>
                        <p class="mb-0 text-muted fs-sm fw-medium">{{ auth()->user()->userrole->name }}</p>
                    </div>
                    <div class="p-2" style="display:grid">
                        @if(Auth::user()->isUserHasValidPermission('Access Reminders')) 
                        <span class="dropdown-item d-flex align-items-center justify-content-between"><a class="fs-sm fw-medium" style="color:#334155" ; href="{{route('user.reminders')}}">Reminders</a></span>
                        @endif
                        <span class="dropdown-item d-flex align-items-center justify-content-between"><a class="fs-sm fw-medium" style="color:#334155" ; href="{{route('user.edit-profile')}}">Edit Profile</a></span>
                        <span class="dropdown-item d-flex align-items-center justify-content-between"><a class="fs-sm fw-medium" style="color:#334155" ; href="{{route('user.get-billing-detail')}}">Billing Detail</a></span>
                        <span class="dropdown-item d-flex align-items-center justify-content-between"><a class="fs-sm fw-medium" style="color:#334155" ; href="{{route('user.settings')}}">Settings</a></span>
                        @if(Auth::user()->isSubscribeToSubscriptions() || count(Auth::user()->subscriptions()->active()->get()) > 0)
                            <span class="dropdown-item d-flex align-items-center justify-content-between"><a class="fs-sm fw-medium" style="color:#334155" ; href="{{route('mysubscriptions.index')}}">My Subscription</a></span>
                        @else
                            <span class="dropdown-item d-flex align-items-center justify-content-between"><a class="fs-sm fw-medium" style="color:#334155" ; href="{{route('plan.index')}}">Subscription</a></span>
                        @endif
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('signout') }}">
                            <span class="fs-sm fw-medium">Log Out</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- END User Dropdown -->
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Loader -->
    <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-body-extra-light">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-circle-notch fa-spin"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>
<!-- END Header -->