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
      $(element).closest('.form-control').addClass("is-invalid");
    } else {
      $(element).removeClass("is-valid");
    }
  },
  unhighlight: function(element, errorClass, validClass) {
    if (validClass) {
      $(element).closest('.form-control').removeClass("is-invalid");
    } else {
      $(element).removeClass("is-invalid");
    }
  }
}

function hideshowlist(id) {
  return $.ajax({
    type: "PATCH",
    url: core.hidecollegeurl.replace(':id', id),
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
  }).done((response) => {
    if (response.success) {
      window.localStorage.setItem('APP-REFRESHED', Date.now());
      toastr.success(response.message)
      return true
    } else {
      toastr.error(response.message)
      return false
    }
  })
}

function getHideCollegeList(showModal) {
  $.ajax({
    type: "get",
    url: core.gethideCollegeUrl,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
  }).done((response) => {
    if (response.success) {
      $('#hide-college-modal-body').html('')
      if (response.data.length > 0) {
        response.data.forEach((data, index) => {
          const element = `
            <div class="block block-rounded block-bordered overflow-hidden mb-1" data-id="${data.id}">
              <div class="block-header block-header-tab">
                <div class="d-flex align-items-center w-100 gap-3 text-white fw-600" role="tab" data-bs-toggle="collapse" data-bs-parent="#userSelectedCollegeList" href="#accodion-${index}" aria-expanded="false" aria-controls="accodion-${index}">
                  <span>${index + 1}</span>
                  <span>${data.college_name}</span>
                </div>
                <div>
                  <button type="button" class="btn btn-sm btn-alt-success show-college-from-list" data-id="${data.id}">Show</button>
                </div>
              </div>
            </div>
          `
          $('#hide-college-modal-body').append(element)
        })
      } else {
        $('#hide-college-modal-body').html('<h5 class="no-data">No College Found</h5>')
      }
      $('#' + showModal).modal('show')
    } else {
      toastr.error(response.message)
    }
  })
}

$('.js-data-example-ajax').select2({
  dropdownParent: $('#add_new_college'),
  allowClear: true,
  ajax: {
    delay: 500,
    url: core.collegelustUrl,
    dataType: 'json',
    data: function (params) {
      var query = {
        search: params.term,
        page: params.page || 1
      }
      return query;
    },
    processResults: function (data, params) {
      params.page = params.page || 1;
      const result = data.data.map((item) => { return { id: item.college_id, text: item.name } });
      return {
        results: result,
        pagination: {
          more: (params.page * 30) < data.total
        }
      };
    }
  }
});

function refreshResults(type) {
  if (type === 'search-list') {
    getCollegeList();
  } else if (type === 'cost-comparison') {
    getCollegeListForCostComparison();
    $('#costcomparison-summary').DataTable().ajax.reload();
  } else if (type === 'college-application-deadline') {
    getApplicationDeadlineOrganizerData();
  } else if (type === 'search-step-1') {
    getStep1CollegeList();
  }
}

Sortable.create(userSelectedCollegeList, {
  animation: 150,
  ghostClass: 'blue-background-class',
  onEnd: function (evt) {
    const payload = []
    for (let  i = 0; i < evt.from.children.length; i++) {
      const data = evt.from.children[i];
      payload.push({
        id: +data.dataset.id,
        order_index: i + 1,
        college_id: +evt.to.dataset.collegeid
      })
    }
    if (!evt.to.dataset.collegeid) return;
    $.ajax({
      url: core.updateCollegeOrder.replace(':id', +evt.to.dataset.collegeid),
      method: 'patch',
      data: {
        data: payload
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          refreshResults(evt.to.dataset.type);
        }
      }
    })
  }
});

$('#remove-all-college').on('click', function (e) {
  e.preventDefault();
  Swal.fire({
    title: 'Are you sure?',
    text: "You want to remove all college from list",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#23BF08',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, remove it!'
  }).then((result) => {
    if (result.isConfirmed) {
      console.log('confirm')
      $.ajax({
        url: core.removeAllCollege,
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }).done((response) => {
        if (response.success) {
          toastr.success(response.message)
          refreshResults(e.to.dataset.type);
        } else {
          toastr.error(response.message)
        }
      })
    }
  })
})