/*
 *  Document   : be_comp_calendar.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Calendar Page
 */

// Full Calendar, for more examples you can check out http://fullcalendar.io/
class pageCompCalendar {
    /*
     * Add event to the events list
     *
     */
    static addEvent() {
        let eventInput = document.querySelector(".js-add-event");
        let eventInputVal = "";

        // When the add event form is submitted
        document
            .querySelector(".js-form-add-event")
            .addEventListener("submit", (e) => {
                e.preventDefault();

                // Get input value
                eventInputVal = eventInput.value;

                // Check if the user entered something
                if (eventInputVal) {
                    let eventList = document.getElementById("js-events");
                    let newEvent = document.createElement("li");
                    let newEventDiv = document.createElement("div");

                    // Prepare new event div
                    newEventDiv.classList.add("js-event");
                    newEventDiv.classList.add("p-2");
                    newEventDiv.classList.add("fs-sm");
                    newEventDiv.classList.add("fw-medium");
                    newEventDiv.classList.add("rounded");
                    newEventDiv.classList.add("bg-info-light");
                    newEventDiv.classList.add("text-info");
                    newEventDiv.textContent = eventInputVal;

                    // Prepare new event li
                    // newEvent.appendChild(newEventDiv);

                    // Add it to the events list
                    // eventList.insertBefore(newEvent, eventList.firstChild);

                    // Clear input field
                    // eventInput.value = "";
                }
            });
    }

    /*
     * Init drag and drop event functionality
     *
     */
    static initEvents() {
        new FullCalendar.Draggable(document.getElementById("js-events"), {
            itemSelector: ".js-event",
            eventData: function (eventEl) {
                return {
                    title: eventEl.textContent,
                    backgroundColor: getComputedStyle(eventEl).color,
                    borderColor: getComputedStyle(eventEl).color,
                };
            },
        });
    }

    /*
     * Init calendar demo functionality
     *
     */
    static initCalendar(eventObj) {
        var formattedEvents = [];
        // Loop through the eventObj array and format each object
        for (var i = 0; i < eventObj.length; i++) {
            var event = eventObj[i];

            const start_date = moment(event.start).format("YYYY-MM-DD");
            const end_date = moment(event.end).format("YYYY-MM-DD");

            var formattedEvent = {
                id: event.id,
                title: event.title,
                description: event.description,
                start: event.start,
                end: start_date == end_date ? null : event.end,
                color: event.color,
                allDay: event.allDay,
                
            };
            formattedEvents.push(formattedEvent);
        }
        let calendar = new FullCalendar.Calendar(
            document.getElementById("js-calendar"),
            {
                themeSystem: "bootstrap5",
                firstDay: 1,
                editable: true,
                selectable: true,
                droppable: true,
                headerToolbar: {
                    left: "title",
                    right: "prev,next today dayGridMonth,timeGridWeek,timeGridDay,listWeek",
                },
                // drop: function (info) {
                //     console.log('drop called');
                //     console.log(info);
                //     info.draggedEl.parentNode.remove();
                // },
                eventReceive: function (info) {
                    let event_id = info.draggedEl.dataset.id;
                    let url = info.draggedEl.dataset.url;
                    let start_date = moment(info.event.startStr).format("YYYY-MM-DD HH:mm:ss");
                    let end_date = start_date; 
                    let listEvent = calendar.getEvents();
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                            event_id: event_id,
                            start_date: start_date,
                            end_date: end_date,
                        },
                    }).done((resp) => {
                        if (resp.success) { 
                            listEvent.forEach(event => { 
                                event.remove();
                            });
                            calendar.addEventSource(resp.data);
                            toastr.success(resp.message);
                            info.draggedEl.parentNode.remove();
                        } else {
                            $('#js-events').prepend(info.draggedEl);
                            info.revert();
                            toastr.error(resp.message);
                        }
                    })
                },
                eventResize: function (info) {
                    let id = info.event.id;
                    let start_date = moment(info.event.startStr).format("YYYY-MM-DD HH:mm:ss");
                    let end_date = null;
                    if (info.event.endStr != "") {
                        end_date = moment(info.event.endStr).subtract(1, "days").format("YYYY-MM-DD HH:mm:ss");
                    } else {
                        end_date = null;
                    }
                    let site_url = $("#site_url").val();
                    $.ajax({
                        url: `${site_url}/user/calendar/resize-events`,
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                            id: id,
                            start_date: start_date,
                            end_date: end_date,
                        },
                    }).done((resp) => {
                        if (resp.success) {
                            toastr.success(resp.message);
                        } else {
                            info.revert();
                            toastr.error(resp.message);
                        }
                    })
                },
                eventDrop: function (info) {
                    let id = info.event.id;
                    let start_date = moment(info.event.startStr).format("YYYY-MM-DD HH:mm:ss");
                    let end_date = null;
                    if (info.event.endStr != "") {
                        end_date = moment(info.event.endStr).subtract(1, "days").format("YYYY-MM-DD HH:mm:ss");
                    } else {
                        end_date = null;
                    }
                    let site_url = $("#site_url").val();
                    $.ajax({
                        url: `${site_url}/user/calendar/resize-events`,
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                            id: id,
                            start_date: start_date,
                            end_date: end_date,
                        },
                    }).done((resp) => {
                        if (resp.success) {
                            toastr.success(resp.message);
                        } else {
                            info.revert();
                            toastr.error(resp.message);
                        }
                    })
                },
                eventClick: function (info) {
                    let id = info.event.id;
                    let site_url = $("#site_url").val();
                    $.ajax({
                        url: `${site_url}/user/calendar/get-event/${id}`,
                        type: "GET",
                        dataType: "JSON",
                        success: function (resp) {
                            if (resp.success) {
                                $("#event-click-model").modal("show");

                                const start_date_obj = moment(resp.data.start_date)
                                const end_date_obj = moment(resp.data.end_date)

                                const start_date = start_date_obj.format("YYYY-MM-DD");
                                const end_date = end_date_obj.format("YYYY-MM-DD");

                                const start_time = start_date_obj.format("hh:mm A");
                                const end_time = end_date_obj.format("hh:mm A");

                                $('#EditInputStartDate').val(start_date);
                                $('#EditInputEndDate').val(end_date);

                                if (start_time == '12:00 AM' && end_time == '12:00 AM') {
                                    $('#edit_is_all_day').prop('checked', true);
                                    $('#edit_is_all_day').trigger('change');
                                    $('#EditInputEndEventTime').val(null);
                                    $('#EditInputStartEventTime').val(null);
                                    $('#EditInputStartEventTime').parent().addClass('d-none')
                                    $('#EditInputEndEventTime').parent().addClass('d-none')
                                } else {
                                    $('#EditInputStartEventTime').parent().removeClass('d-none')
                                    $('#EditInputEndEventTime').parent().removeClass('d-none')
                                    $('#edit_is_all_day').prop('checked', false);
                                    $('#edit_is_all_day').trigger('change');
                                    $('#EditInputEndEventTime').val(end_time);
                                    $('#EditInputStartEventTime').val(start_time);
                                }
                                $('#exampleInputEventTitle').val(resp.data.event.title);
                                $('#exampleInputEventColor').val(resp.data.event.color.charAt(0) == '#' ? `others` : resp.data.event.color);
                                $('#exampleInputEventDescription').val(resp.data.event.description);
                                $("#event-click-model .btn-main-id").attr("data-id", resp.data.event.id);

                            }
                        },
                        error: function (err) {
                            console.log("err =>>>", err);
                        },
                    });
                },
                select: function(info) {
                    let start_date = moment(info.startStr).format("YYYY-MM-DD");
                    let end_date = null;
                    if (info.endStr != "") {
                        end_date = moment(info.endStr).subtract(1, "days").format("YYYY-MM-DD");
                    } else {
                        end_date = null;
                    }
                    $('#AddInputStartDate').val(start_date);
                    $('#AddInputEndDate').val(end_date);
                    $('#event-select-model').modal('show');
                },
                events: {
                    url: $("#site_url").val() + "/user/calendar/get-all-events",
                    method: "get",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    failure: function () {
                        toastr.error("There was an error while fetching FullCalendar!");
                    },
                },
                loading: function (isLoading) {
                    if (isLoading) {
                        $('#calendar-loader').show();
                    } else {
                        $('#calendar-loader').hide();
                    }
                },
                eventAfterAllRender: function (view) {},
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    meridiem: 'short'
                },
                // eventDidMount: function(info) {
                //     var target = info.el.getElementsByClassName('fc-event-title')[0];
                //     if (target === undefined) return;
                    
                //     var div = document.createElement('div');
                //     div.innerHTML = (!!info.event.extendedProps.description?info.event.extendedProps.description:' ');
                //     target.parentNode.insertBefore(div.firstChild, target.nextSibling);
                //     info.el.setAttribute('data-event-id',info.event.id);
                // }
                
            }
        );

        $('#deleteEvent').click(function(){
            let id = $("#deleteEvent").attr('data-id');
            let site_url = $("#site_url").val();
            let listEvent = calendar.getEvents();
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
                    showLoadingIndicator();
                    $.ajax({
                        url: `${site_url}/user/calendar/delete-event/${id}`,
                        type: "DELETE",
                        dataType: "JSON",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr(
                            "content"
                            ),
                        },
                        success: function(resp) {
                            let html = ``;
                            if (resp.success) {
                                $('#event-click-model').modal('hide');
                                $('#exampleInputEventTitle').val('');
                                $('#exampleInputEventColor').val('');
                                $('#exampleInputEventTime').val('');
                                $('#exampleInputEventDescription').val('');
                                listEvent.forEach(event => { 
                                    event.remove();
                                });
                                calendar.addEventSource(resp.data['fetchAllEvents']);
                                html += `<li class="event-list-${resp.data['event'].id}">`;
                                html += `<div class="js-event p-2 fs-sm fw-medium rounded bg-${resp.data['event'].color}-light text-${resp.data['event'].color}" data-url="${site_url}/user/calendar/assign-events" data-id="${resp.data['event'].id}">${resp.data['event'].title}<span class="main-event-trash" onclick="mainEventTrash(${resp.data['event'].id})"><i class="fa-solid fa-trash"></i></div>`;
                                html += `</li>`;
                                $('.list-events').append(html);
                                toastr.success(resp.message);
                            }
                            hideLoadingIndicator();
                        },
                        error: function(err) {
                            console.log("err =>>>", err);
                            hideLoadingIndicator();
                        }
                    });  
                }
            })
        });

        $('#editEvent').click(function() {
            const form = $('#EditEventModel');
            if (form.valid()) {
                let id = $('#editEvent').attr('data-id');
                let site_url = $("#site_url").val();
                let listEvent = calendar.getEvents();
                showLoadingIndicator();
    
                $.ajax({
                    url: `${site_url}/user/calendar/update-event/${id}`,
                    type: "PUT",
                    dataType: "JSON",
                    data: form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                }).done((resp) => {
                    if (resp.success) {
                        hideLoadingIndicator();
                        $('#event-click-model').modal('hide');
                        form.trigger("reset");
                        listEvent.forEach(event => { 
                            event.remove();
                        });
                        calendar.addEventSource(resp.data);
                        toastr.success(resp.message);
                    } else {
                        hideLoadingIndicator();
                        toastr.error(resp.message);
                    }
                })
            }
        });

        $('#addEvent').click(function() {
            const form = $('#AddEventModel')
            if (form.valid()) {
                let site_url = $("#site_url").val();
                let listEvent = calendar.getEvents();
                showLoadingIndicator();
                $.ajax({
                    url: `${site_url}/user/calendar/add-assign-event`,
                    type: "POST",
                    dataType: "JSON",
                    data: form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                }).done((resp) => {
                    if (resp.success) {
                        hideLoadingIndicator();
                        $('#event-select-model').modal('hide');
                        form.trigger("reset");
                        listEvent.forEach(event => { 
                            event.remove();
                        });
                        calendar.addEventSource(resp.data);
                        toastr.success(resp.message);
                    } else {
                        hideLoadingIndicator();
                        toastr.error(resp.message);
                    }
                })
            }
        });

        calendar.render();

        // Function to show the loading indicator
        function showLoadingIndicator() {
            $('#loadingIndicator').show();
            $('#addEvent').prop('disabled', true);
        }

        // Function to hide the loading indicator
        function hideLoadingIndicator() {
            $('#loadingIndicator').hide();
            $('#addEvent').prop('disabled', false);
        }
    }

    /*
     * Init functionality
     *
     */
    static init(eventObj) {
        this.addEvent();
        this.initEvents();
        this.initCalendar(eventObj);
    }
}