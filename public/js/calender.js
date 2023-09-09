let site_url = $("#site_url").val();

const common_error_function = {
    errorElement: "em",
    errorPlacement: function(error, element) {
        error.addClass("invalid-feedback");
        if (element.prop("type") === "checkbox") {
            error.insertAfter(element.parent("label"));
        } else {
            error.insertAfter(element);
        }
    },
    highlight: function(element, errorClass, validClass) {
        if (errorClass) {
            if (element.tagName === 'SELECT') {
                $(element).closest('.form-select').addClass("is-invalid");
            } else {
                $(element).closest('.form-control').addClass("is-invalid");
            }
        } else {
            $(element).removeClass("is-valid");
        }
    },
    unhighlight: function(element, errorClass, validClass) {
        if (validClass) {
            if (element.tagName === 'SELECT') {
                $(element).closest('.form-select').removeClass("is-invalid")
            } else {
                $(element).closest('.form-control').removeClass("is-invalid");
            }
        } else {
            $(element).removeClass("is-invalid");
        }
    }
}

$('#AddInputEndDate').on('change', function (e) {
    const start_date = $('#AddInputStartDate').val()
    const end_date = e.target.value;
    if (start_date > end_date) {
        $('#addEvent').prop('disabled', true)
    } else {
        $('#addEvent').prop('disabled', false)
    }
})

jQuery.validator.addMethod("checkenddatetime", function(value, element, options) {
    let start_date = $('#AddInputStartDate').val();
    let start_time = $('#AddInputStartEventTime').val();
    let end_date = $('#AddInputEndDate').val();
    if (options == 'update') {
        start_date = $('#EditInputStartDate').val();
        start_time = $('#EditInputStartEventTime').val();
        end_date = $('#EditInputEndDate').val();
    }
    const end_time = value;
    const start = new Date(`${start_date} ${start_time}`)
    const end = new Date(`${end_date} ${end_time}`)
    if (start < end) {
        return true;
    } else if (start > end) {
        return false;
    } else {
        return true;
    }
}, "End date time must be greater than start date time");

$(document).ready(function () {
    $('#AddEventModel').validate({
        rules: {
            title: {   
                required: true,
            },
            color: {
                required: true
            },
            start_date: {
                required: true
            },
            end_date: {
                required: true
            },
            description: {
                required: true,
            }
        },
        messages: {
            title: {
                required: 'Event title is required',
            },
            color: {
                required: 'Event color is required'
            },
            start_date: {
                required: 'Start date is required'
            },
            end_date: {
                required: 'End date is required'
            },
            description: {
                required: 'Event description is required',
            }
        },
        ...common_error_function
    })

    $('#is_all_day').on('change', function (e) {
        e.target.value = e.target.checked ? 1 : 0;
        if (e.target.checked) {
            $('#AddInputStartEventTime').parent().addClass('d-none')
            $('#AddInputEndEventTime').parent().addClass('d-none')
            $('#AddInputStartEventTime').rules('remove')
            $('#AddInputEndEventTime').rules('remove')
        } else {
            $('#AddInputStartEventTime').parent().removeClass('d-none')
            $('#AddInputEndEventTime').parent().removeClass('d-none')
            $('#AddInputStartEventTime').rules('add', {
                required: true,
                messages: {
                    required: 'Start time is required'
                }
            })
            $('#AddInputEndEventTime').rules('add', {
                required: true,
                checkenddatetime : 'create',
                messages: {
                    required: 'End time is required',
                    checkenddatetime: 'End date time must be greater than start time'
                }
            })
        }
    })

    $('#EditEventModel').validate({
        rules: {
            title: {   
                required: true,
            },
            color: {
                required: true
            },
            start_date: {
                required: true
            },
            end_date: {
                required: true
            },
            description: {
                required: true,
            }
        },
        messages: {
            title: {
                required: 'Event title is required',
            },
            color: {
                required: 'Event color is required'
            },
            start_date: {
                required: 'Start date is required'
            },
            end_date: {
                required: 'End date is required'
            },
            description: {
                required: 'Event description is required',
            }
        },
        ...common_error_function
    })

    $('#edit_is_all_day').on('change', function (e) {
        e.target.value = e.target.checked ? 1 : 0;
        if (e.target.checked) {
            $('#EditInputStartEventTime').parent().addClass('d-none')
            $('#EditInputEndEventTime').parent().addClass('d-none')
            $('#EditInputStartEventTime').rules('remove')
            $('#EditInputEndEventTime').rules('remove')
        } else {
            $('#EditInputStartEventTime').parent().removeClass('d-none')
            $('#EditInputEndEventTime').parent().removeClass('d-none')
            $('#EditInputStartEventTime').rules('add', {
                required: true,
                messages: {
                    required: 'Start time is required'
                }
            })
            $('#EditInputEndEventTime').rules('add', {
                required: true,
                checkenddatetime : 'update',
                messages: {
                    required: 'End time is required',
                    checkenddatetime: 'End date time must be greater than start time'
                }
            })
        }
    })
})

$('#user-caledars-list').DataTable({
    processing: true,
    serverSide: true,
    bPaginate: false, // hide pagination
    info: false, // hide table information
    bFilter: false,
    ajax: {
        url: site_url + "/google/calendars",
        type: 'GET',
    },
    columns: [
        { data: 'name', name: 'name', orderable: false, searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false },
    ],
})

$('#user-caledars-list').on('draw.dt', function () {
    $('.delete-specific-college').on('click', function (e) {
        e.preventDefault()
        const id = $(this).data('id')
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to hide this calendar? Once you hide this calendar, you can't see any event of this calendar.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: site_url + "/google/calendar",
                    type: 'DELETE',
                    data: {
                        id: id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                }).done((response) => {
                    // console.log(response);
                    if (response.success) {
                        $('#user-caledars-list').DataTable().ajax.reload()
                        pageCompCalendar.init([]);
                        toastr.success(response.message)
                    } else {
                        toastr.error(response.message)
                    }
                })
            }
        })
    })
})