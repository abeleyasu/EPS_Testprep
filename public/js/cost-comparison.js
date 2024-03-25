async function getCollegeListForCostComparison(active_accordion = null) {
    // console.log('getCollegeListForCostComparison', global)
    await $.ajax({
        url: core.costComparisonDetail,
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            state: global.currentSelectedState,
            // state_changed: global.stateChanged ? 1 : 0
            state_changed: 0
        }
    }).done(function (response) {
        $('#userSelectedCollegeList').html('')
        if (response.success) {
            const data = response.data;
            // console.log('response.data', data)
            for (let i = 0; i < data.length; i++) {
                const costComparisonData = data[i];
                const costcomparison = costComparisonData.costcomparison;
                const detail = costcomparison.costcomparisondetail;
                const otherscholership = costcomparison.costcomparisonotherscholarship
                const collegeInformation = costComparisonData.college_information;

                let html = `
          <div class="block block-rounded block-bordered overflow-hidden mb-1" data-id="${costComparisonData.id}">
            <div class="block-header block-header-tab">
              <a class="text-white fw-600 collapsed w-100 drag-handle" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${i}" data-index="${i}" aria-expanded="true">
                <i class="fa fa-2x ${isAccordionActive(costComparisonData, active_accordion) ? 'fa-angle-down' : 'fa-angle-right'}" id="toggle${i}"></i>
                <i class="fa fa-2x fa-bars"></i>
                <span id="college-name-${i}">${costComparisonData.college_name}</span>
              </a>
              <button type="button" class="btn btn-sm btn-alt-danger hide-college-from-list me-2" data-id="${costComparisonData.id}">Hide</button>
              <button type="button" class="btn btn-sm btn-alt-danger reset-cost-comparion-data me-2" data-id="${costcomparison.id}">Reset</button>
              <button type="button" class="btn btn-sm btn-alt-danger remove-user-college" data-type="cost-comparison" data-id="${costComparisonData.id}">Remove</button>
            </div>
            <div id="collapse${i}" class="collapse ${isAccordionActive(costComparisonData, active_accordion) ? 'show' : ''}" aria-labelledby="headingOne" data-index="${i}" data-bs-parent=".accordionExample1">
              <div class="college-content-wrapper college-content">
                <table class="table table-bordered table-striped table-vcenter">
                  <tbody>
                    <tr>
                      <th colspan="3">DIRECT COST/YEAR</th>
                    </tr>
                    <tr>
                      <td>Tuition & Fees ${inStateOutStateLabel(collegeInformation)}/ Year</td>
                      <td class="td-width"><input type="text" name="direct_tuition_free_year"  data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="direct_tuition_free_year-${i}" value="${getTuitionAndFeesValue(costComparisonData)}"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Room & Board / Year</td>
                      <td class="td-width">
                        <input type="text" name="direct_room_board_year" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="direct_room_board_year-${i}" value="${getRoomAndBoardValue(costComparisonData)}"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Miscellaneous</td>
                      <td class="td-width">
                        <input type="text" name="direct_miscellaneous_year" data-index="${i}" data-id="${detail.id}" class="form-control edit-value" id="direct_miscellaneous_year-${i}" value="${detail.direct_miscellaneous_year ? detail.direct_miscellaneous_year : '0'}"></td>
                      <td></td>
                    </tr>
                    <tr class="even table-success">
                      <td>DIRECT COSTS (Total Tuition, Fees, Room & Board / Year)</td>
                      <td class="td-width" id="total_direct_cost-${i}">${getDirectCostTotal(costComparisonData)}</td>
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
                      <td class="td-width" id="total_merit_aid-${i}">${getFormatMoney(costcomparison.total_merit_aid)}</td>
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
                      <td class="td-width" id="total_need_based_aid-${i}">${getFormatMoney(costcomparison.total_need_based_aid)}</td>
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
                      <td id="total_outside_scholarship-${i}">${getFormatMoney(costcomparison.total_outside_scholarship)}</td>
                      <td></td>
                    </tr>
                  </tbody>
                  <tbody>
                    <tr class="table-info">
                      <th colspan="3">COST OF ATTENDANCE / YEAR</th>
                    </tr>
                    <tr>
                      <td>Estimated Total Cost of Attendence / Year</td>
                      <td class="td-width" id="total_cost_attendance-${i}">${getFormatMoney(costcomparison.total_cost_attendance)}</td>
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
    errorPlacement: function (error, element) {
        error.addClass("invalid-feedback");
        if (element.prop("type") === "checkbox") {
            error.insertAfter(element.parent("label"));
        } else {
            error.insertAfter(element);
        }
    },
    highlight: function (element, errorClass, validClass) {
        if (errorClass) {
            $(element).closest('.form-control').addClass("is-invalid");
        } else {
            $(element).removeClass("is-valid");
        }
    },
    unhighlight: function (element, errorClass, validClass) {
        if (validClass) {
            $(element).closest('.form-control').removeClass("is-invalid");
        } else {
            $(element).removeClass("is-invalid");
        }
    }
})

$('select[name=choose_state_options]').on('change', async function () {
    Swal.fire({
        title: 'Are you sure?',
        html: "You want to change the state? <span class=\"text-danger\">It will reset the cost comparison data for all colleges to its default value.</span>",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#23BF08',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it!',
    }).then(async (result) => {
        if (result.isConfirmed) {
            const state = $(this).val();
            const stateCode = $(this).find('option:selected').data('statecode');
            global.currentSelectedState = stateCode;
            global.stateChanged = true;

            // console.log('state', state)
            // console.log('stateCode', stateCode)

            // get active accrodion from data-id of its parent div that has class .collapse.show
            const activeAccordion = $('#college-list-cost .collapse.show').parent().data('id')
            // console.log('activeAccordion', activeAccordion)
            await getCollegeListForCostComparison(activeAccordion);

            // $('#costcomparison-summary').DataTable().ajax.reload();

            // trigger on change .edit-value in tuition and fees and room and board in current collapse show
            // to update total direct cost
            if (activeAccordion) {
                // $('#college-list-cost .collapse.show').find('[name=direct_tuition_free_year], [name=direct_room_board_year], [name=direct_miscellaneous_year]').trigger('change')

                $('#college-list-cost .collapse.show').find('[name=direct_tuition_free_year]').trigger('change')
                $('#college-list-cost .collapse.show').find('[name=direct_room_board_year]').trigger('change')
                $('#college-list-cost .collapse.show').find('[name=direct_miscellaneous_year]').trigger('change')

            } else {
                // $('#college-list-cost .collapse').first().find('[name=direct_tuition_free_year], [name=direct_room_board_year], [name=direct_miscellaneous_year]').trigger('change')

                $('#college-list-cost .collapse').first().find('[name=direct_tuition_free_year]').trigger('change')
                $('#college-list-cost .collapse').first().find('[name=direct_room_board_year]').trigger('change')
                $('#college-list-cost .collapse').first().find('[name=direct_miscellaneous_year]').trigger('change')
            }
        } else {
            console.log('cancel')
            // revert back to last selected state

            // Get the select element
            const selectElement = document.querySelector('select[name=choose_state_options]');

            // Get all options with data-statecode=X
            const option = Array.from(selectElement.options).find(option => option.dataset.statecode === global.currentSelectedState);
            // console.log('option', option)

            // get value of its
            let lastSelectedState = option.value;

            // set the value of select[name=choose_state_options] to lastSelectedState
            selectElement.value = lastSelectedState;
        }
    })

})

const isAccordionActive = (collegeData, activeIndex) => {
    const costComparison = collegeData.costcomparison;
    return (collegeData.id == activeIndex) || (costComparison.id == activeIndex) ? true : false
}

const isInStateCollege = (collegeInformation) => {
    const stateCodeSelected = $('select[name=choose_state_options]').find('option:selected').data('statecode');
    // console.log('===')
    // console.log('stateCodeSelected', stateCodeSelected)
    // console.log('collegeInformation.state', collegeInformation.state)
    // console.log('===')
    return collegeInformation.state == stateCodeSelected ? true : false
}

const isPrivateCollege = (collegeInformation) => {
    return (collegeInformation.TUIT_OVERALL_FT_D && collegeInformation.TUIT_STATE_FT_D > 0) || collegeInformation.ownership != 1 ? true : false
}

const inStateOutStateLabel = (collegeInformation) => {
    // return isInStateCollege(collegeInformation) ? '(In-State)' : isPrivateCollege(collegeInformation) ? '(Private)' : '(Out-of-State)'

    if (isPrivateCollege(collegeInformation)) {
        return ''
    } else {
        return isInStateCollege(collegeInformation) ? '(In-State) ' : '(Out-of-State) '
    }
}

const getTuitionAndFeesValue = (costComparisonData) => {
    const detail = costComparisonData.costcomparison.costcomparisondetail;
    const collegeInformation = costComparisonData.college_information;

    // formulas
    // private: TUT_OVERALL_FT_D + FEES_FT_D
    // in state: TUT_STATE_FT_D + FEES_FT_D
    // out of state: TUT_NRES_FT_D + FEES_FT_D

    const tutOverrallFtD = collegeInformation.TUIT_OVERALL_FT_D ? parseFloat(collegeInformation.TUIT_OVERALL_FT_D) : 0
    const tutStateFtD = collegeInformation.TUIT_STATE_FT_D ? parseFloat(collegeInformation.TUIT_STATE_FT_D) : 0
    const tutNresFtD = collegeInformation.TUIT_NRES_FT_D ? parseFloat(collegeInformation.TUIT_NRES_FT_D) : 0
    const feesFtD = collegeInformation.FEES_FT_D ? parseFloat(collegeInformation.FEES_FT_D) : 0

    let result = 0

    if (global.stateChanged) {
        detail.direct_tuition_free_year = null
        collegeInformation.tution_and_fess = null // ???
    }

    if (costComparisonData.college_name == 'Auburn University') {
        // console.log('detail.direct_tuition_free_year', detail.direct_tuition_free_year)
        // console.log('collegeInformation.tution_and_fess', collegeInformation.tution_and_fess)
    }

    result = detail.direct_tuition_free_year ? parseFloat(detail.direct_tuition_free_year) : 0

    // if (result) {
    //     result = parseFloat(result)
    // } else {
    //     if (collegeInformation.tution_and_fess) {
    //         result = parseFloat(collegeInformation.tution_and_fess)
    //     } else if (isPrivateCollege(collegeInformation)) {
    //         result = tutOverrallFtD + feesFtD
    //     } else {
    //         if (isInStateCollege(collegeInformation)) {
    //             result = tutStateFtD + feesFtD
    //         } else {
    //             result = tutNresFtD + feesFtD
    //         }
    //     }
    // }

    // console.log('getTuitionAndFeesValue', result)

    if (!result) {
        if (isPrivateCollege(collegeInformation)) {
            result = collegeInformation.tution_and_fess ? parseFloat(collegeInformation.tution_and_fess) : 0
            if (!result) {
                result = tutOverrallFtD + feesFtD
            }
        } else {
            if (isInStateCollege(collegeInformation)) {
                result = collegeInformation.tuition_and_fee_instate ? parseFloat(collegeInformation.tuition_and_fee_instate) : 0
                if (!result) {
                    result = tutStateFtD + feesFtD
                }
            } else {
                result = collegeInformation.tuition_and_fee_outstate ? parseFloat(collegeInformation.tuition_and_fee_outstate) : 0
                if (!result) {
                    result = tutNresFtD + feesFtD
                }
            }
        }
    }

    return parseFloat(result)
}

const getRoomAndBoardValue = (costComparisonData) => {
    const detail = costComparisonData.costcomparison.costcomparisondetail;
    const collegeInformation = costComparisonData.college_information;

    let result = 0;

    if (global.stateChanged) {
        detail.direct_room_board_year = null
        collegeInformation.room_and_board = null // ???
    }

    if (costComparisonData.college_name == 'Auburn University') {
        // console.log('stateChanged', global.stateChanged)
        // console.log('college', costComparisonData.college_name)
        // console.log('detail.direct_room_board_year', detail.direct_room_board_year)
    }

    // result = detail.direct_room_board_year ?? collegeInformation.room_and_board
    result = detail.direct_room_board_year ? parseFloat(detail.direct_room_board_year) : 0

    // if (result) {
    //     result = parseFloat(result)
    // } else {
    //     if (collegeInformation.RM_BD_D) {
    //         result = parseFloat(collegeInformation.RM_BD_D)
    //     }
    // }

    if (costComparisonData.college_name == 'Auburn University') {
        // console.log('getRoomAndBoardValue', result)
    }

    if (!result) {
        result = collegeInformation.room_and_board ? parseFloat(collegeInformation.room_and_board) : 0
        if (!result) {
            result = collegeInformation.RM_BD_D ? parseFloat(collegeInformation.RM_BD_D) : 0
        }
    }

    return parseFloat(result)
}

const getDirectCostTotal = (costComparisonData) => {
    const costComparison = costComparisonData.costcomparison;
    const detail = costComparison.costcomparisondetail;

    const tuitionAndFeesValue = getTuitionAndFeesValue(costComparisonData)
    const roomBoardYear = getRoomAndBoardValue(costComparisonData)
    const miscellaneousYear = detail.direct_miscellaneous_year ? parseFloat(detail.direct_miscellaneous_year) : 0

    const total = tuitionAndFeesValue + roomBoardYear + miscellaneousYear

    // return `$${total}`
    return getFormatMoney(total)
}
