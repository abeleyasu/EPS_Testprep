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
        <div class="alert alert-dismissible d-none" role="alert" id="alert-message">
            <p class="mb-0 alert-title">

            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
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
                            <li>
                                <div class="js-event p-2 fs-sm fw-medium rounded bg-{{$event->color}}-light text-{{$event->color}}" data-url="{{ route('calendar.assignEvent') }}" data-id="{{ $event->id }}">{{ $event->title }}</div>
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
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Event Details</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <p class="main-content"></p>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-main-id btn-sm btn-danger me-1" id="deleteEvent">Delete</button>
                        <button type="button" class="btn btn-main-id btn-sm btn-primary" id="editEvent">Edit</button>
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
<style>
    .content {
        width: 90%;
    }
</style>
@endsection

@section('user-script')
<script src="{{asset('assets/js/plugins/fullcalendar/main.min.js')}}"></script>
<script src="{{asset('assets/js/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/_js/pages/be_comp_calendar.js')}}"></script>
<script>
    let eventObj = @json($final_arr);

    pageCompCalendar.init(eventObj);

    function addTitle() {
        let title = $('#event-title').val();

        if (title == "") {
            $('#alert-message').removeClass('d-none');
            $('#alert-message').removeClass('alert-success');
            $('#alert-message').addClass('alert-danger');
            $('#alert-message .alert-title').html('Please Enter Event');
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
                        html += `<li>`;
                        html += `<div class="js-event p-2 fs-sm fw-medium rounded bg-${resp.data.color}-light text-${resp.data.color}" data-url="{{ route('calendar.assignEvent') }}" data-id="${resp.data.id}">${resp.data.title}</div>`;
                        html += `</li>`;

                        $('.list-events').append(html);
                        $('#event-title').val("");
                        $('#alert-message').removeClass('d-none');
                        $('#alert-message').removeClass('alert-danger');
                        $('#alert-message').addClass('alert-success');
                        $('#alert-message .alert-title').html(resp.message);
                    }
                },
                error: function(err) {
                    console.log("err =>>>", err);
                }
            });
        }
    }
</script>
@endsection