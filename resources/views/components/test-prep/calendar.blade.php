<div class="mb-3">
    @if(!auth()->user()->googleAccount)
        Connect Goolge Account for Accessing Google Calendar <br>
        <a href="{{ route('google') }}" class="btn btn-alt-primary btn-sm text-center">
            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="25px" height="25px">
                <path fill="#fbc02d" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12	s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20	s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
                <path fill="#e53935" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039	l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                <path fill="#4caf50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36	c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                <path fill="#1565c0" d="M43.611,20.083L43.595,20L42,20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571	c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
            </svg>
            Connect Google Account
        </a>
    @else
        Disconnect Google Account for Accessing Google Calendar <br>
        <a href="{{ route('google.disconnect') }}" class="bnt btn-alt-danger btn-sm">
            Disconnect Google Account
        </a>
        <div class="mt-3">
            @if ($google_calendar)
                We are created a calendar for you. It will store your all events. If you remove this calendar from your calendar you will lose all events. <br>
                <span class="fw-bold">Calendar Name: {{ $google_calendar->summary }}</span>
            @else
                <span class="text-danger">
                    Oops! We are not able to find the calendar in the calendar collection of your google account. click the below button to create a calendar. <br>
                    <a href="{{ route('google.create-user-calender') }}" class="btn btn-alt-primary btn-sm text-center">Create Calender</a>
                </span>
            @endif
            <div id="user-calendar-list" class="mb-5 mt-3" role="tablist" aria-multiselectable="true">
                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                    <div class="block-header block-header-tab" role="tab" id="faq12_h1">
                    <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#user-calendar-list" href="#user-calendars" aria-expanded="true" aria-controls="user-calendars">
                        <i class="nav-main-link-icon fa fa-file"></i> 
                        Calendat List
                    </a>
                    </div>
                    <div id="user-calendars" class="collapse show" role="tabpanel" aria-labelledby="faq12_h1" data-bs-parent="#user-calendar-list">
                        <div class="block-content" id="">
                            <table id="user-caledars-list" class="table">
                                <thead>
                                    <tr>
                                        <th>Calendar Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
<div class="row items-push position-relative">
    <div class="col-md-12 col-lg-12 col-xl-12"
        style='padding: 0 !important'>
        <!-- Calendar Container -->
        <div id="js-calendar"></div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-6">
        <!-- Add Event Form -->
        <form class="js-form-add-event push">
            <div class="input-group">
                <input type="text" name="title" id="event-title"
                    class="js-add-event form-control"
                    placeholder="Add Event..">
                <span class="input-group-text" style="cursor: pointer"
                    onclick="addTitle()">
                    <i class="fa fa-fw fa-plus-circle"></i>
                </span>
            </div>
        </form>
        <!-- END Add Event Form -->

        <!-- Event List -->
        @if (!empty($events))
            <ul id="js-events" class="list list-events">
                @foreach ($events as $event)
                    <li class="event-list-{{ $event->id }}">
                        <div class="js-event p-2 fs-sm fw-medium rounded bg-{{ $event->color }}-light text-{{ $event->color }}"
                            data-url="{{ route('calendar.assignEvent') }}"
                            data-id="{{ $event->id }}">
                            {{ $event->title }}<span
                                class="main-event-trash"
                                onclick="mainEventTrash({{ $event->id }})"><i
                                    class="fa-solid fa-trash"></i></span>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
        <div class="text-center">
            <p class="fs-sm text-muted">
                <i class="fa fa-arrows-alt"></i> Drag and drop events on
                the calendar
            </p>
        </div>
        <!-- END Event List -->
    </div>
    <div id="calendar-loader" class="loading-indicator position-absolute" style="display: none;">
        <div class="loader"></div>
    </div>
</div>