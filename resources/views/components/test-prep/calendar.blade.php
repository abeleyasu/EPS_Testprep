<div class="row items-push">
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
</div>