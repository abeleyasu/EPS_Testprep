const site_url = $("#site_url").val();

const calender_url_with_prefix = site_url + "/google";

$(document).ready(function() {
    // $('select[name="calender"]').select2({
    //     allowClear: true,
    //     ajax: {
    //         delay: 500,
    //         url: calender_url_with_prefix + '/calendars',
    //         dataType: 'json',
    //         data: function (params) {
    //             var query = {
    //                 search: params.term,
    //             }
    //             return query;
    //         },
    //         processResults: function (data, params) {
    //             return {
    //                 results: data
    //             };
    //         }
    //     }
    // });

    // $('select[name="calender"]').on('select2:select', function (e) {
    //     var data = e.params.data;
    //     $.ajax({
    //         url: calender_url_with_prefix + '/store/user-calender',
    //         type: 'PATCH',
    //         data: {
    //             calender: data.id
    //         },
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //     }).done((response) => {
    //         if (response.success) {
    //             toastr.success(response.message)
    //         } else {
    //             toastr.error(response.message)
    //         }
    //     })
    // })
})