@extends('layouts.user')

@section('title', 'calendar : CPS')

@section('user-content')
<!-- Main Container -->
<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Calendar
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        A solid foundation to build your calendar based web application. Powered by Full Calendar.
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">Components</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Calendar
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    <!-- Page Content -->
    <div class="content">
        <!-- Calendar -->
        <div class="block block-rounded">
            <div class="block-content">
                <div class="row items-push">
                    <div class="col-md-8 col-lg-7 col-xl-9">
                        <!-- Calendar Container -->
                        <div id="js-calendar"></div>
                    </div>
                    <div class="col-md-4 col-lg-5 col-xl-3">
                        <!-- Add Event Form -->
                        <form class="js-form-add-event push">
                            <div class="input-group">
                                <input type="text" name="title" id="event-title" class="js-add-event form-control" placeholder="Add Event..">
                                <span class="input-group-text" style="cursor: pointer" onclick="addTitle()">
                                    <i class="fa fa-fw fa-plus-circle"></i>
                                </span>
                            </div>
                        </form>
                        <!-- END Add Event Form -->

                        <!-- Event List -->
                        @if(!empty($events))
                        <ul id="js-events" class="list list-events">
                            @foreach($events as $event)
                            <li class="event-list-{{ $event->id }}">
                                <div class="js-event p-2 fs-sm fw-medium rounded bg-{{$event->color}}-light text-{{$event->color}}" data-url="{{ route('calendar.assignEvent') }}" data-id="{{ $event->id }}">{{ $event->title }}<span class="main-event-trash" onclick="mainEventTrash({{$event->id}})"><i class="fa-solid fa-trash"></i></span></div>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                        <div class="text-center">
                            <p class="fs-sm text-muted">
                                <i class="fa fa-arrows-alt"></i> Drag and drop events on the calendar
                            </p>
                        </div>
                        <!-- END Event List -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Calendar -->
    </div>
    <!-- END Page Content -->
    <div class="modal" id="event-click-model" tabindex="-1" role="dialog" aria-labelledby="modal-block-small" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Edit Event Details</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <form id="EditEventModel">
                            <div class="mb-3">
                                <label for="exampleInputEventTitle" class="form-label">Event Title</label>
                                <input type="text" class="form-control" placeholder="Enter Event Title" name="title" id="exampleInputEventTitle" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEventColor" class="form-label">Event Color</label>
                                <select class="form-select form-select-lg mb-3" id="exampleInputEventColor" name="color" aria-label=".form-select-lg example">
                                    <option value="">Select Color</option>
                                    <option value="success">Success</option>
                                    <option value="warning">Warning</option>
                                    <option value="info">Info</option>
                                    <option value="danger">Danger</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-info" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-main-id btn-sm btn-primary" id="editEvent">Update Event</button>
                        <button type="button" class="btn btn-main-id btn-sm btn-secondary me-1" id="deleteEvent"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="event-select-model" tabindex="-1" role="dialog" aria-labelledby="modal-block-small" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Add Event Details</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <form id="AddEventModel">
                            <div class="mb-3">
                                <label for="AddInputEventTitle" class="form-label">Event Title</label>
                                <input type="text" class="form-control" placeholder="Enter Event Title" name="title" id="AddInputEventTitle" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="AddInputEventColor" class="form-label">Event Color</label>
                                <select class="form-select form-select-lg mb-3" id="AddInputEventColor" name="color" aria-label=".form-select-lg example">
                                    <option value="">Select Color</option>
                                    <option value="success">Success</option>
                                    <option value="warning">Warning</option>
                                    <option value="info">Info</option>
                                    <option value="danger">Danger</option>
                                </select>
                            </div>
                            <input type="hidden" name="start_date" id="AddInputStartDate">
                            <input type="hidden" name="end_date" id="AddInputEndDate">
                        </form>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-info" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm btn-primary" id="addEvent">Add Event</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- END Main Container -->
@endsection

@section('page-style')
<!-- open ui plugins -->
<link rel="stylesheet" href="{{asset('assets/js/plugins/fullcalendar/main.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
<style>
    .content {
        width: 90%;
    }
    .main-event-trash {
        position: absolute;
        right: 12px;
        cursor: pointer;
    }

    .fc-button-primary {
        color: #334155 !important;
        background-color: #dde2e9 !important;
        border-color: #dde2e9 !important;
    }

    .fc-today-button {
        background-color: #334155 !important;
        color:   #dde2e9!important;
    }
    
    .fc-button-active{
        color: #334155 !important;
        background-color: #f6f7f9 !important;
        border-color: #f6f7f9 !important;
    }
</style>
@endsection

@section('user-script')
<script src="{{asset('assets/js/plugins/fullcalendar/main.min.js')}}"></script>
<script src="{{asset('assets/js/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/_js/pages/be_comp_calendar.js')}}"></script>
<script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
<script>
    let eventObj = @json($final_arr);

    pageCompCalendar.init(eventObj);

    function addTitle(title) {
        title = $('#event-title').val();

        if (title == "") {
            toastr.error("Please Enter Event!");
            return false;
        } else {
            $.ajax({
                url: "{{ route('calendar.addEvent') }}",
                type: "POST",
                dataType: "JSON",
                data: {
                    "_token": "{{  csrf_token() }}",
                    "title": title
                },
                success: function(resp) {
                    let html = ``;
                    if (resp.success) {
                        html += `<li class="event-list-${resp.data.id}">`;
                        html += `<div class="js-event p-2 fs-sm fw-medium rounded bg-${resp.data.color}-light text-${resp.data.color}" data-url="{{ route('calendar.assignEvent') }}" data-id="${resp.data.id}">${resp.data.title}<span class="main-event-trash" onclick="mainEventTrash(${resp.data.id})"><i class="fa-solid fa-trash"></i></div>`;
                        html += `</li>`;

                        $('.list-events').append(html);
                        $('#event-title').val("");
                        toastr.success(resp.message);
                    }
                },
                error: function(err) {
                    console.log("err =>>>", err);
                }
            });
        }
    }

    function mainEventTrash(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to delete this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `{{ url('user/calendar/trash-event/${id}') }}`,
                    type: "DELETE",
                    dataType: "JSON",
                    data: {
                        "_token": "{{  csrf_token() }}",
                    },
                    success: function(resp) {
                        if (resp.success) {
                            $(`.event-list-${resp.data}`).remove();
                            toastr.success(resp.message);
                        }
                    },
                    error: function(err) {
                        console.log("err =>>>", err);
                    }
                });
            }
        })
    }

    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
@endsection