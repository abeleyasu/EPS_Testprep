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
                    newEvent.appendChild(newEventDiv);

                    // Add it to the events list
                    eventList.insertBefore(newEvent, eventList.firstChild);

                    // Clear input field
                    eventInput.value = "";
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
        let calendar = new FullCalendar.Calendar(
            document.getElementById("js-calendar"),
            {
                themeSystem: "standard",
                firstDay: 1,
                editable: true,
                droppable: true,
                headerToolbar: {
                    left: "title",
                    right: "prev,next today dayGridMonth,timeGridWeek,timeGridDay,listWeek",
                },
                drop: function (info) {
                    let event_id = info.draggedEl.dataset.id;
                    let url = info.draggedEl.dataset.url;
                    let start_date = info.dateStr;
                    $.ajax({
                        url: url,
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                            event_id: event_id,
                            start_date: start_date,
                        },
                        success: function (resp) {
                            if (resp.success) {
                                $("#alert-message").removeClass("d-none");
                                $("#alert-message").removeClass("alert-danger");
                                $("#alert-message").addClass("alert-success");
                                $("#alert-message .alert-title").html(
                                    resp.message
                                );
                            }
                        },
                        error: function (err) {
                            console.log("err =>>>", err);
                        },
                    });
                    info.draggedEl.parentNode.remove();
                },
                eventResize: function (info) {
                    let id = info.event.id;
                    let start_date = info.event.startStr;
                    let end_date = null;
                    if (info.event.endStr != "") {
                        end_date = moment(info.event.endStr)
                            .subtract(1, "days")
                            .format("YYYY-MM-DD");
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
                        success: function (resp) {
                            if (resp.success) {
                                $("#alert-message").removeClass("d-none");
                                $("#alert-message").removeClass("alert-danger");
                                $("#alert-message").addClass("alert-success");
                                $("#alert-message .alert-title").html(
                                    resp.message
                                );
                            }
                        },
                        error: function (err) {
                            console.log("err =>>>", err);
                        },
                    });
                },
                eventDrop: function (info) {
                    let id = info.event.id;
                    let start_date = info.event.startStr;
                    let end_date = null;
                    if (info.event.endStr != "") {
                        end_date = moment(info.event.endStr)
                            .subtract(1, "days")
                            .format("YYYY-MM-DD");
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
                        success: function (resp) {
                            if (resp.success) {
                                $("#alert-message").removeClass("d-none");
                                $("#alert-message").removeClass("alert-danger");
                                $("#alert-message").addClass("alert-success");
                                $("#alert-message .alert-title").html(
                                    resp.message
                                );
                            }
                        },
                        error: function (err) {
                            console.log("err =>>>", err);
                        },
                    });
                },
                eventClick: function (info) {
                    let id = info.event.id;
                    let title = info.event.title;
                    $("#event-click-model").modal("show");
                    $("#event-click-model .main-content").html(title);
                    $("#event-click-model .btn-main-id").attr("data-id", id);
                },
                events: eventObj,
            }
        );

        $('#deleteEvent').click(function(){
          let id = $("#deleteEvent").attr('data-id');
          var event = calendar.getEventById(id);
          let site_url = $("#site_url").val();
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
                  if (resp.success) {
                      $('#event-click-model').modal('hide');
                      event.remove();
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
        });

        $('#editEvent').click(function() {
          let id = $('#editEvent').attr('data-id');
          console.log("editEvent", id);
        });

        calendar.render();
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
