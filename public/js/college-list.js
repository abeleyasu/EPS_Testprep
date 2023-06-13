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
                <div class="block-header block-header-default">
                  <div class="d-flex align-items-center w-100 gap-3" role="tab" data-bs-toggle="collapse" data-bs-parent="#userSelectedCollegeList" href="#accodion-${index}" aria-expanded="false" aria-controls="accodion-${index}">
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