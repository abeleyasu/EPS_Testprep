function getCollegeListForCostComparison(url) {
  $.ajax({
    url: url,
    method: 'GET',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  }).done(function (response) {
    $('#college-details-cost-comparison').html('')
    if (response.success) {
      const data = response.data;
      for (let i = 0;i < data.length;i++) { 
        const costComparisonData = data[i];
        const costcomparison = costComparisonData.costcomparison;
        const detail = costcomparison.costcomparisondetails
        let html = `
          <div class="block block-rounded block-bordered overflow-hidden mb-1">
            <div class="block-header block-header-tab" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${i}" data-index="${i}" aria-expanded="true">
              <a class="text-white fw-600 collapsed">
                <i class="fa fa-2x fa-angle-right" id="toggle${i}"></i>
                <i class="fa fa-2x fa-bars"></i>
                <span id="college-name-${i}">${costComparisonData.college_name}</span>
              </a> 
            </div>
            <div id="collapse${i}" class="collapse" aria-labelledby="headingOne" data-index="${i}" data-bs-parent=".accordionExample1">
              <div class="college-content-wrapper college-content">
                <div class="text-end mb-3">
                  <button class="btn btn-success add-cost" data-index="${i}" data-costcomparisonid="${costcomparison.id}">+ Add cost</button>
                </div>
                <table class="table table-bordered table-striped table-vcenter">`

            $.each(detail, function (index, typeinfor) {
              html += `<tbody>
              <tr class="${typeinfor.cost_type == 'aid' ? 'table-info' : ''}">
                <th colspan="3">${typeinfor.name}</th>
              </tr>`

              if (typeinfor.data.length > 0)  {
                $.each(typeinfor.data, function (index, data) {
                  html += `
                    <tr>
                      <td>${data.name}</td>
                      <td>$${data.amount}</td>
                      <td class="w-10 text-end">
                        <button class="btn btn-sm btn-success edit-cost-aid" id="edit-${i}" data-index="${i}" data-costcomparisonid="${costcomparison.id}" data-id="${data.id}"><i class="fa fa-fw fa-pencil-alt" data-costcomparisonid="${costcomparison.id}" data-index="${i}" data-id="${data.id}"></i></button>
                        <button class="btn btn-sm btn-danger delete-cost-aid" data-index="${i}" data-costcomparisonid="${costcomparison.id}" data-id="${data.id}"><i class="fa fa-fw fa-times" data-costcomparisonid="${costcomparison.id}" data-index="${i}" data-id="${data.id}"></i></button>
                      </td>
                    </tr>
                  `
                })
              } else {
                html += `<tr> <td colspan="3"> <div class="no-data">Data Not Available</div> </td> </tr>`
              }

              html += `
                  <tr class="even table-success">
                    <td>${typeinfor.total_field_name}</td>
                    <td>$${costcomparison[typeinfor.total_field_key]}</td>
                    <td></td>
                  </tr>
                </tbody>
              `
            })

            html += `
            <tbody>
              <tr class="table-info">
                <th colspan="3">COST OF ATTENDANCE / YEAR</th>
              </tr>
              <tr>
                <td>Estimated Total Cost of Attendence / Year</td>
                <td>${costcomparison.total_cost_attendance ?'$'+ costcomparison.total_cost_attendance : '-'}</td>
                <td></td>
              </tr>
            </tbody>
            `

                  
        html += `</table>
              </div>
            </div>
          </div>
        `
        $('#college-details-cost-comparison').append(html)
      }
    } else {
      $('#college-details-cost-comparison').html('<div class="no-data">Data Not Available</div>')
    }
  })
}

$('#cost-form').validate({
  rules: {
    cost_aid: {
      required: true,
    },
    cost_aid_type: {
      required: true,
    },
    cost_aid_name: {
      required: true,
    },
    cost_aid_amount: {
      required: true,
      number: true
    }
  },
  messages: {
    cost_aid: {
      required: 'Please select cost aid',
    },
    cost_aid_type: {
      required: 'Please select cost aid type',
    },
    cost_aid_name: {
      required: 'Please enter cost aid name',
    },
    cost_aid_amount: {
      required: 'Please enter cost aid amount',
      number: 'Please enter valid number'
    }
  },
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
})

$(document).ready(function () {
  $('#edit-cost-form').validate({
    rules: {
      edit_cost_aid: {
        required: true,
      },
      edit_cost_aid_type: {
        required: true,
      },
      edit_cost_aid_name: {
        required: true,
      },
      edit_cost_aid_amount: {
        required: true,
        number: true
      }
    },
    messages: {
      edit_cost_aid: {
        required: 'Please select cost aid',
      },
      edit_cost_aid_type: {
        required: 'Please select cost aid type',
      },
      edit_cost_aid_name: {
        required: 'Please enter cost aid name',
      },
      edit_cost_aid_amount: {
        required: 'Please enter cost aid amount',
        number: 'Please enter valid number'
      }
    },
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
  })
})
