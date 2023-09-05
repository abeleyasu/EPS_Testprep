<div class="modal fade" id="event-click-model" tabindex="-1" role="dialog" aria-labelledby="modal-block-small" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Edit Event Details</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="EditEventModel">
                        <div class="mb-3">
                            <label for="exampleInputEventTitle" class="form-label">Event Title</label>
                            <input type="text" class="form-control" placeholder="Enter Event Title"
                                name="title" id="exampleInputEventTitle" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEventColor" class="form-label">Event Color</label>
                            <select class="form-select form-select-lg mb-3" id="exampleInputEventColor"
                                name="color" aria-label=".form-select-lg example">
                                <option value="">Select Color</option>
                                <option value="success">Success</option>
                                <option value="warning">Warning</option>
                                <option value="info">Info</option>
                                <option value="danger">Danger</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEventTime" class="form-label">Event Time</label>
                            {{-- <input type="time" class="form-control" name="time" id="exampleInputEventTime"> --}}
                            <input type="text" class="js-flatpickr form-control" id="exampleInputEventTime" name="time" data-enable-time="true" data-no-calendar="true" data-date-format="H:i">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEventDescription" class="form-label">Event Description</label>
                            <textarea class="form-control" name="description" id="exampleInputEventDescription"></textarea>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-info" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-main-id btn-sm btn-primary" id="editEvent">Update
                        Event</button>
                    <button type="button" class="btn btn-main-id btn-sm btn-secondary me-1" id="deleteEvent"><i
                            class="fa-solid fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="event-select-model" tabindex="-1" role="dialog" aria-labelledby="modal-block-small"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Event Details</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="AddEventModel">
                        <div class="mb-3">
                            <label for="AddInputEventTitle" class="form-label">Event Title</label>
                            <input type="text" class="form-control" placeholder="Enter Event Title"
                                name="title" id="AddInputEventTitle" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="AddInputEventColor" class="form-label">Event Color</label>
                            <select class="form-select form-select-lg mb-3" id="AddInputEventColor"
                                name="color" aria-label=".form-select-lg example">
                                <option value="">Select Color</option>
                                <option value="success">Success</option>
                                <option value="warning">Warning</option>
                                <option value="info">Info</option>
                                <option value="danger">Danger</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="AddInputEventTime" class="form-label">Event Time</label>
                            {{-- <input type="time" class="form-control" data-plugin="timepicker" name="time" id="AddInputEventTime"> --}}
                            <input type="text" class="js-flatpickr form-control" id="AddInputEventTime" name="time" data-enable-time="true" data-no-calendar="true" data-date-format="H:i">
                        </div>
                        <div class="mb-3">
                            <label for="AddInputEventDescription" class="form-label">Event Description</label>
                            <textarea class="form-control" name="description" id="AddInputEventDescription"></textarea>
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