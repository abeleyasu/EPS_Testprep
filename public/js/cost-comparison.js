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
        const detail = costcomparison.costcomparisondetail;
        const otherscholership = costcomparison.costcomparisonotherscholarship
        const html = `
          <div class="block block-rounded block-bordered overflow-hidden mb-1">
            <div class="block-header block-header-tab" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${i}" data-index="${i}" aria-expanded="true">
              <a class="text-white fw-600 collapsed">
                <i class="fa fa-2x fa-angle-right" id="toggle${i}"></i>
                <i class="fa fa-2x fa-bars"></i>
                <span>${costComparisonData.college_name}</span>
              </a> 
            </div>
            <div id="collapse${i}" class="collapse" aria-labelledby="headingOne" data-index="${i}" data-bs-parent=".accordionExample1">
              <div class="college-content-wrapper college-content">
                <div class="text-end mb-3">
                  <button class="btn btn-success add-cost" data-id="${detail.id}" data-costcomparisonid="${detail.cost_comparison_id}">+ Add cost</button>
                </div>
                <table class="table table-bordered table-striped table-vcenter">
                  <tbody>
                    <tr>
                      <th colspan="2">DIRECT COST/YEAR</th>
                    </tr>
                    <tr>
                      <td>Tuition & Fees / Year</td>
                      <td>${detail.direct_tuition_free_year ? '$' + detail.direct_tuition_free_year : '-'}</td>
                    </tr>
                    <tr>
                      <td>Room & Board / Year</td>
                      <td>${detail.direct_room_board_year ? '$' + detail.direct_room_board_year : '-'}</td>
                    </tr>
                    <tr class="even table-success">
                      <td>DIRECT COSTS (Total Tuition, Fees, Room & Board / Year)</td>
                      <td>${costcomparison.total_cost_attendance ? '$' + costcomparison.total_cost_attendance : '-'}</td>
                    </tr>
                  </tbody>
                  <tbody>
                    <tr class="table-info">
                      <th colspan="2">INSTITUTIONAL SCHOLARSHIP AID / YEAR</th>
                    </tr>
                    <tr>
                      <td>Academic Merit Aid</td>
                      <td>${detail.institutional_academic_merit_aid ?'$'+ detail.institutional_academic_merit_aid : '-'}</td>
                    </tr>
                    <tr>
                      <td>Tuition Exchange Program Scholarship (i.e. WUE/Midwest Exchange)</td>
                      <td>${detail.institutional_exchange_program_scho ?'$'+ detail.institutional_exchange_program_scho : '-'}</td>
                    </tr>
                    <tr>
                      <td>Honors College Program Scholarship</td>
                      <td>${detail.institutional_honors_col_program ?'$'+ detail.institutional_honors_col_program : '-'}</td>
                    </tr>
                    <tr>
                      <td>Academic Departmental Scholarship</td>
                      <td>${detail.institutional_academic_department_scho ?'$'+ detail.institutional_academic_department_scho : '-'}</td>
                    </tr>
                    <tr>
                      <td>Athletic Scholarship</td>
                      <td>${detail.institutional_atheletic_scho ?'$'+ detail.institutional_atheletic_scho : '-'}</td>
                    </tr>
                    <tr>
                      <td>Other Talent Scholarship</td>
                      <td>${detail.institutional_other_talent_scho ?'$'+ detail.institutional_other_talent_scho : '-'}</td>
                    </tr>
                    <tr>
                      <td>Diversity Scholarship</td>
                      <td>${detail.institutional_diversity_scho ?'$'+ detail.institutional_diversity_scho : '-'}</td>
                    </tr>
                    <tr>
                      <td>Legacy Scholarship</td>
                      <td>${detail.institutional_legacy_scho ?'$'+ detail.institutional_legacy_scho : '-'}</td>
                    </tr>
                    <tr>
                      <td>Other Scholarships (Volunteer, Leadership, etc.)</td>
                      <td>${detail.institutional_other_scho ?'$'+ detail.institutional_other_scho : '-'}</td>
                    </tr>
                    <tr class="even table-success">
                      <td>Total Institutional Scholarship Aid / Year</td>
                      <td>${costcomparison.total_merit_aid ?'$'+ costcomparison.total_merit_aid : '-'}</td>
                    </tr>
                  </tbody>
                  <tbody>
                    <tr class="table-info">
                      <th colspan="2">NEED-BASED AID / YEAR (FEDERAL, STATE, & INSTITUTIONAL)</th>
                    </tr>
                    <tr>
                      <td>Federal Grants (i.e. Pell Grant, Military, etc.)</td>
                      <td>${detail.need_base_federal_grants ?'$'+ detail.need_base_federal_grants : '-'}</td>
                    </tr>
                    <tr>
                      <td>Institutional Grants</td>
                      <td>${detail.need_base_institutional_grants ?'$'+ detail.need_base_institutional_grants : '-'}</td>
                    </tr>
                    <tr>
                      <td>State Grants</td>
                      <td>${detail.need_base_state_grants ?'$'+ detail.need_base_state_grants : '-'}</td>
                    </tr>
                    <tr>
                      <td>Work Study</td>
                      <td>${detail.need_base_work_study_grants ?'$'+ detail.need_base_work_study_grants : '-'}</td>
                    </tr>
                    <tr>
                      <td>Student Loans</td>
                      <td>${detail.need_base_student_loans_grants ?'$'+ detail.need_base_student_loans_grants : '-'}</td>
                    </tr>
                    <tr>
                      <td>Parent Plus Loan</td>
                      <td>${detail.need_base_parent_plus_grants ?'$'+ detail.need_base_parent_plus_grants : '-'}</td>
                    </tr>
                    <tr>
                      <td>Other Grants</td>
                      <td>${detail.need_base_other_grants ?'$'+ detail.need_base_other_grants : '-'}</td>
                    </tr>
                    <tr class="even table-success">
                      <td>Total Need-Based Aid / Year (Federal, State, & Institutional)</td>
                      <td>${costcomparison.total_need_based_aid ?'$'+ costcomparison.total_need_based_aid : '-'}</td>
                    </tr>
                  </tbody>
                  <tbody>
                    <tr class="table-info">
                      <th colspan="2">OUTSIDE SCHOLARSHIP AID / YEAR</th>
                    </tr>
                    ${otherscholership.length > 0 ? 
                      `${otherscholership.map((item) => {
                        return `
                          <tr>
                            <td>${item.scholarship_name}</td>
                            <td>${item.scholarship_amount ?'$'+ item.scholarship_amount : '-'}</td>
                          </tr>
                        `
                      })}` 
                    : '<tr><td colspan="2">No data found</td></tr>'}
                    <tr class="even table-success">
                      <td>Total Outside Scholarship Aid / Year</td>
                      <td>${costcomparison.total_outside_scholarship ?'$'+ costcomparison.total_outside_scholarship : '-'}</td>
                    </tr>
                  </tbody>
                  <tbody>
                    <tr class="table-info">
                      <th colspan="2">COST OF ATTENDANCE / YEAR</th>
                    </tr>
                    <tr>
                      <td>Estimated Total Cost of Attendence / Year</td>
                      <td>${costcomparison.total_cost_attendance ?'$'+ costcomparison.total_cost_attendance : '-'}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        `
        $('#college-details-cost-comparison').append(html)
      }
    } else {
      $('#college-details-cost-comparison').html('<div class="no-data">No data found</div>')
    }
  })
}

function getSingleCostDetails(url) {
  $.ajax({
    url: url,
    method: 'get',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  }).done(function (response) {
    if (response.success) {
      const data = response.data
      const details = data.costcomparisondetail
      const otherscores = data.costcomparisonotherscholarship
      console.log(otherscores.length)
      $('#cost-id').val(data.id);
      $('#direct_tuition_free_year').val(details.direct_tuition_free_year)
      $('#direct_room_board_year').val(details.direct_room_board_year)
      $('#institutional_academic_merit_aid').val(details.institutional_academic_merit_aid)
      $('#institutional_exchange_program_scho').val(details.institutional_exchange_program_scho)
      $('#institutional_honors_col_program').val(details.institutional_honors_col_program)
      $('#institutional_academic_department_scho').val(details.institutional_academic_department_scho)
      $('#institutional_atheletic_scho').val(details.institutional_atheletic_scho)
      $('#institutional_other_talent_scho').val(details.institutional_other_talent_scho)
      $('#institutional_diversity_scho').val(details.institutional_diversity_scho)
      $('#institutional_legacy_scho').val(details.institutional_legacy_scho)
      $('#institutional_other_scho').val(details.institutional_other_scho)
      $('#need_base_federal_grants').val(details.need_base_federal_grants)
      $('#need_base_institutional_grants').val(details.need_base_institutional_grants)
      $('#need_base_state_grants').val(details.need_base_state_grants)
      $('#need_base_work_study_grants').val(details.need_base_work_study_grants)
      $('#need_base_student_loans_grants').val(details.need_base_student_loans_grants)
      $('#need_base_parent_plus_grants').val(details.need_base_parent_plus_grants)
      $('#need_base_other_grants').val(details.need_base_other_grants)

      if (otherscores.length > 0) {
        for (let  i = 0; i < otherscores.length; i++) {
          const data = otherscores[i]
          const form = `
            <div class="mb-4">
              <div class="row mb-3">
                <div class="col-sm-12 col-lg-6">
                  <label class="from-label">Scholarship Name:</label>
                  <input type="text" class="form-control form-control-lg form-control-alt" name="scholarship[${i}][name]" placeholder="Scholarship Name" value="${data.scholarship_name}">
                </div>
                <div class="${i === 0 ? 'col-sm-12 col-lg-6' : 'col-11 col-sm-11 col-lg-5'} ">
                  <label class="from-label">Scholarship Amount:</label>
                  <input type="text" class="form-control form-control-lg form-control-alt" name="scholarship[${i}][amount]" placeholder="Scholarship Amount" value="${data.scholarship_amount}">
                </div>
                ${i !== 0 ? 
                  `<div class="col-1 col-sm-1 col-lg-1 d-flex align-items-end">
                    <button class="btn btn-alt-danger remove-outside-scholarship">-</button>
                  </div>`  
                : ''}
              </div>
            </div>
          `
          $('#outside-scholarship').append(form)
        }
        // do something
      } else {
        $('#outside-scholarship').html(`
          <div class="mb-4">
            <div class="row mb-3">
              <div class="col-sm-12 col-lg-6">
                <label class="from-label">Scholarship Name:</label>
                <input type="text" class="form-control form-control-lg form-control-alt" name="scholarship[0][name]" placeholder="Scholarship Name">
              </div>
              <div class="col-sm-12 col-lg-6">
                <label class="from-label">Scholarship Amount:</label>
                <input type="text" class="form-control form-control-lg form-control-alt" name="scholarship[0][amount]" placeholder="Scholarship Amount">
              </div>
            </div>
          </div>
        `)
      }

      $('#add-college-cost-modal').modal('show')
    } else {
      
    }
    console.log(response)
  })
}

// only number validation
$('#cost-form').validate({
  rules: {
    direct_tuition_free_year: {
      number: true
    },
    direct_room_board_year: {
      number: true
    },
    institutional_academic_merit_aid: {
      number: true
    },
    institutional_exchange_program_scho: {
      number: true
    },
    institutional_honors_col_program: {
      number: true
    },
    institutional_academic_department_scho: {
      number: true
    },
    institutional_atheletic_scho: {
      number: true
    },
    institutional_other_talent_scho: {
      number: true
    },
    institutional_diversity_scho: {
      number: true
    },
    institutional_legacy_scho: {
      number: true
    },
    institutional_other_scho: {
      number: true
    },
    need_base_federal_grants: {
      number: true
    },
    need_base_institutional_grants: {
      number: true
    },
    need_base_state_grants: {
      number: true
    },
    need_base_work_study_grants: {
      number: true
    },
    need_base_student_loans_grants: {
      number: true
    },
    need_base_parent_plus_grants: {
      number: true
    },
    need_base_other_grants: {
      number: true
    },
    'scholarship[][amount]': {
      number: true
    }
  },
  messages: {
    direct_tuition_free_year: {
      number: 'Please enter only number'
    },
    direct_room_board_year: {
      number: 'Please enter only number'
    }, 
    institutional_academic_merit_aid: {
      number: 'Please enter only number'
    },
    institutional_exchange_program_scho: {
      number: 'Please enter only number'
    },
    institutional_honors_col_program: {
      number: 'Please enter only number'
    },
    institutional_academic_department_scho: {
      number: 'Please enter only number'
    },
    institutional_atheletic_scho: {
      number: 'Please enter only number'
    },
    institutional_other_talent_scho: {
      number: 'Please enter only number'
    },
    institutional_diversity_scho: {
      number: 'Please enter only number'
    },
    institutional_legacy_scho: {
      number: 'Please enter only number'
    },
    institutional_other_scho: {
      number: 'Please enter only number'
    },
    need_base_federal_grants: {
      number: 'Please enter only number'
    },
    need_base_institutional_grants: {
      number: 'Please enter only number'
    },
    need_base_state_grants: {
      number: 'Please enter only number'
    },
    need_base_work_study_grants: {
      number: 'Please enter only number'
    },
    need_base_student_loans_grants: {
      number: 'Please enter only number'
    },
    need_base_parent_plus_grants: {
      number: 'Please enter only number'
    },
    need_base_other_grants: {
      number: 'Please enter only number'
    },
    'scholarship[][amount]': {
      number: 'Please enter only number'
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