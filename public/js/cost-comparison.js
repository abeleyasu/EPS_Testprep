function getCollegeListForCostComparison(active_accordion = null) {
  $.ajax({
    url: core.costComparisonDetail,
    method: 'GET',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  }).done(function (response) {
    $('#userSelectedCollegeList').html('')
    if (response.success) {
      const data = response.data;
      for (let i = 0;i < data.length;i++) { 
        const costComparisonData = data[i];
        const costcomparison = costComparisonData.costcomparison;
        const detail = costcomparison.costcomparisondetail;
        const otherscholership = costcomparison.costcomparisonotherscholarship
        let html = `
          <div class="block block-rounded block-bordered overflow-hidden mb-1" data-id="${costComparisonData.id}">
            <div class="block-header block-header-tab">
              <a class="text-white fw-600 collapsed w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${i}" data-index="${i}" aria-expanded="true">
                <i class="fa fa-2x ${active_accordion && active_accordion == costcomparison.id ? 'fa-angle-down' : 'fa-angle-right'}" id="toggle${i}"></i>
                <i class="fa fa-2x fa-bars"></i>
                <span id="college-name-${i}">${costComparisonData.college_name}</span>
              </a> 
              <button type="button" class="btn btn-sm btn-alt-danger hide-college-from-list me-2" data-id="${costComparisonData.id}">Hide</button>
              <button type="button" class="btn btn-sm btn-alt-danger reset-cost-comparion-data me-2" data-id="${costcomparison.id}">Reset</button>
              <button type="button" class="btn btn-sm btn-alt-danger remove-user-college" data-type="cost-comparison" data-id="${costComparisonData.id}">Remove</button>
            </div>
            <div id="collapse${i}" class="collapse ${active_accordion && active_accordion == costcomparison.id ? 'show' : ''}" aria-labelledby="headingOne" data-index="${i}" data-bs-parent=".accordionExample1">
              <div class="college-content-wrapper college-content">
                <table class="table table-bordered table-striped table-vcenter">
                  <tbody>
                    <tr>
                      <th colspan="3">DIRECT COST/YEAR</th>
                    </tr>
                    <tr>
                      <td>Tuition & Fees / Year</td>
                      <td class="td-width"><input type="text" name="direct_tuition_free_year"  data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="direct_tuition_free_year-${i}" value="${detail.direct_tuition_free_year ? detail.direct_tuition_free_year : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Room & Board / Year</td>
                      <td class="td-width">
                        <input type="text" name="direct_room_board_year" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="direct_room_board_year-${i}" value="${detail.direct_room_board_year ? detail.direct_room_board_year : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr class="even table-success">
                      <td>DIRECT COSTS (Total Tuition, Fees, Room & Board / Year)</td>
                      <td class="td-width" id="total_direct_cost-${i}">${costcomparison.total_direct_cost ? '$' + costcomparison.total_direct_cost : '$0'}</td>
                      <td></td>
                    </tr>
                  </tbody>
                  <tbody>
                    <tr class="table-info">
                      <th colspan="3">INSTITUTIONAL SCHOLARSHIP AID / YEAR</th>
                    </tr>
                    <tr>
                      <td>Academic Merit Aid</td>
                      <td class="td-width"><input type="text" name="institutional_academic_merit_aid" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="institutional_academic_merit_aid-${i}" value="${detail.institutional_academic_merit_aid ? detail.institutional_academic_merit_aid : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Tuition Exchange Program Scholarship (i.e. WUE/Midwest Exchange)</td>
                      <td class="td-width"><input type="text" name="institutional_exchange_program_scho" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="institutional_exchange_program_scho-${i}" value="${detail.institutional_exchange_program_scho ? detail.institutional_exchange_program_scho : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Honors College Program Scholarship</td>
                      <td class="td-width"><input type="text" name="institutional_honors_col_program" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="institutional_honors_col_program-${i}" value="${detail.institutional_honors_col_program ? detail.institutional_honors_col_program : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Academic Departmental Scholarship</td>
                      <td class="td-width"><input type="text" name="institutional_academic_department_scho" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="institutional_academic_department_scho-${i}" value="${detail.institutional_academic_department_scho ? detail.institutional_academic_department_scho : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Athletic Scholarship</td>
                      <td class="td-width"><input type="text" name="institutional_atheletic_scho" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="institutional_atheletic_scho-${i}" value="${detail.institutional_atheletic_scho ? detail.institutional_atheletic_scho : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Other Talent Scholarship</td>
                      <td class="td-width"><input type="text" name="institutional_other_talent_scho" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="institutional_other_talent_scho-${i}" value="${detail.institutional_other_talent_scho ? detail.institutional_other_talent_scho : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Diversity Scholarship</td>
                      <td class="td-width"><input type="text" name="institutional_diversity_scho" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="institutional_diversity_scho-${i}" value="${detail.institutional_diversity_scho ? detail.institutional_diversity_scho : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Legacy Scholarship</td>
                      <td class="td-width"><input type="text" name="institutional_legacy_scho" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="institutional_legacy_scho-${i}" value="${detail.institutional_legacy_scho ? detail.institutional_legacy_scho : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Other Scholarships (Volunteer, Leadership, etc.)</td>
                      <td class="td-width"><input type="text" name="institutional_other_scho" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="institutional_other_scho-${i}" value="${detail.institutional_other_scho ? detail.institutional_other_scho : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr class="even table-success">
                      <td>Total Institutional Scholarship Aid / Year</td>
                      <td class="td-width" id="total_merit_aid-${i}">${costcomparison.total_merit_aid ?'$'+ costcomparison.total_merit_aid : '$0'}</td>
                      <td></td>
                    </tr>
                  </tbody>
                  <tbody>
                    <tr class="table-info">
                      <th colspan="3">NEED-BASED AID / YEAR (FEDERAL, STATE, & INSTITUTIONAL)</th>
                    </tr>
                    <tr>
                      <td>Federal Grants (i.e. Pell Grant, Military, etc.)</td>
                      <td class="td-width"><input type="text" name="need_base_federal_grants" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="need_base_federal_grants-${i}" value="${detail.need_base_federal_grants ? detail.need_base_federal_grants : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Institutional Grants</td>
                      <td class="td-width"><input type="text" name="need_base_institutional_grants" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="need_base_institutional_grants-${i}" value="${detail.need_base_institutional_grants ? detail.need_base_institutional_grants : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>State Grants</td>
                      <td class="td-width"><input type="text" name="need_base_state_grants" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="need_base_state_grants-${i}" value="${detail.need_base_state_grants ? detail.need_base_state_grants : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Work Study</td>
                      <td class="td-width"><input type="text" name="need_base_work_study_grants" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="need_base_work_study_grants-${i}" value="${detail.need_base_work_study_grants ? detail.need_base_work_study_grants : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Student Loans</td>
                      <td class="td-width"><input type="text" name="need_base_student_loans_grants" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="need_base_student_loans_grants-${i}" value="${detail.need_base_student_loans_grants ? detail.need_base_student_loans_grants : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Parent Plus Loan</td>
                      <td class="td-width"><input type="text" name="need_base_parent_plus_grants" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="need_base_parent_plus_grants-${i}" value="${detail.need_base_parent_plus_grants ? detail.need_base_parent_plus_grants : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Other Grants</td>
                      <td class="td-width"><input type="text" name="need_base_other_grants" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="need_base_other_grants-${i}" value="${detail.need_base_other_grants ? detail.need_base_other_grants : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr class="even table-success">
                      <td>Total Need-Based Aid / Year (Federal, State, & Institutional)</td>
                      <td class="td-width" id="total_need_based_aid-${i}">${costcomparison.total_need_based_aid ?'$'+ costcomparison.total_need_based_aid : '$0'}</td>
                      <td></td>
                    </tr>
                  </tbody>
                  <tbody>
                    <tr class="table-info">
                      <th>OUTSIDE SCHOLARSHIP AID / YEAR</th>
                      <td colspan="2" class="text-end"><button class="btn btn-success add-cost" data-index="${i}" data-id="${detail.id}" data-costcomparisonid="${detail.cost_comparison_id}">+ Add Aid</button></td>
                    </tr>`

                    if (otherscholership.length > 0) {
                      $.each(otherscholership, function (index, item) {
                        html += `
                          <tr>
                            <td>${item.name}</td>
                            <td class="td-width"> 
                              <input type="text" name="amount" class="form-control edit-outside-aid" data-index="${i}" data-id="${item.id}" id="amount-${i}" value="${item.amount ? item.amount : '0'}">
                            </td>
                            <td class="delete-option">
                              <button class="btn btn-sm btn-danger delete-outside-aid" data-index="${i}" data-id="${item.id}"><i class="fa fa-fw fa-times" data-index="${i}" data-id="${item.id}"></i></button>
                            </td>
                          </tr>
                        `
                      })
                    } else {
                      html += `<tr>
                        <td colspan="3"><div class="no-data">No data found</div></td>
                      </tr>`
                    }
                    
                    html += `<tr class="even table-success">
                      <td>Total Outside Scholarship Aid / Year</td>
                      <td id="total_outside_scholarship-${i}">${costcomparison.total_outside_scholarship ?'$'+ costcomparison.total_outside_scholarship : '$0'}</td>
                      <td></td>
                    </tr>
                  </tbody>
                  <tbody>
                    <tr class="table-info">
                      <th colspan="3">COST OF ATTENDANCE / YEAR</th>
                    </tr>
                    <tr>
                      <td>Estimated Total Cost of Attendence / Year</td>
                      <td class="td-width" id="total_cost_attendance-${i}">${costcomparison.total_cost_attendance ?'$'+ costcomparison.total_cost_attendance : '$0'}</td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        `
        $('#userSelectedCollegeList').append(html)
      }
    } else {
      $('#userSelectedCollegeList').html('<div class="no-data">No data found</div>')
    }
  })
}

$('#cost-form').validate({
  rules: {
    name: {
      required: true
    },
    amount: {
      required: true,
      number: true
    }
  },
  messages: {
    name: {
      required: 'Please enter scholarship name'
    },
    amount: {
      required: 'Please enter scholarship amount',
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