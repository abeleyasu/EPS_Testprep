let editScoreDetails = null;
let otherScoreDetails = null;
jQuery.validator.addMethod("minvalueforscore", function(value, element, options) {
    console.log('options -->', options)
    if ($('#' + options).val() == 'ACT') {
        return this.optional(element) || (value >= 1);
    } else {
        return this.optional(element) || (value >= 200);
    }
}, "please enter a valid number");

jQuery.validator.addMethod("maxvalueforscore", function(value, element, options) {
    if ($('#' + options).val() == 'ACT') {
        return this.optional(element) || (value <= 36);
    } else {
        return this.optional(element) || (value <= 800);
    }
}, "please enter a valid number");


function actSatRules(elementid, isRequired = true) {
    return {
        required: isRequired,
        minvalueforscore: elementid,
        maxvalueforscore: elementid,
    }
}

function otherScoreRules(isRequired = true) {
    return {
        required: isRequired,
        min: 1,
        max: 36
    }
}

const common_error_message = {
    test_type: {
        required: 'Please select test type'
    },
    test_date: {
        required: 'Please select test date'
    },
    english_score: {
        required: 'Please enter english score',
        min: 'Please enter valid english score',
        max: 'Please enter valid english score'
    },
    math_score: {
        required: 'Please enter math score',
    },
    science_score: {
        required: 'Please enter science score',
        min: 'Please enter valid science score',
        max: 'Please enter valid science score'
    },
    reading_score: {
        required: 'Please enter reading score',
    },
    composite_score: {
        required: 'Please enter composite score',
    },
    unweighted_gpa: {
        required: 'Please enter unweighted gpa',
        min: 'Please enter valid unweighted gpa',
        max: 'Please enter valid unweighted gpa'
    },
    weighted_gpa: {
        required: 'Please enter weighted gpa',
        min: 'Please enter valid weighted gpa',
        max: 'Please enter valid weighted gpa'
    }
}

const rules = {
    test_type: {
        required: true,
    },
    test_date: {
        required: true,
    },
    english_score: otherScoreRules(),
    math_score: actSatRules('test_type'),
    science_score: otherScoreRules(),
    reading_score: actSatRules('test_type'),
    composite_score: {
        required: true
    }
}

const high_school_score_rules = {
    // high_school_english_score: otherScoreRules(false),
    // high_school_reading_score: actSatRules('high_school_test_type', false),
    // high_school_math_score: actSatRules('high_school_test_type', false),
    // high_school_science_score: otherScoreRules(false),
    unweighted_gpa: {
        min: 0,
        max: 4
    },
    weighted_gpa: {
        min: 0,
        max: 8
    }
}

const goal_score_rules = {
    goal_english_score: otherScoreRules(false),
    goal_reading_score: actSatRules('goal_test_type', false),
    goal_math_score: actSatRules('goal_test_type', false),
    goal_science_score: otherScoreRules(false),
}

const final_score_rules = {
    final_english_score: otherScoreRules(false),
    final_reading_score: actSatRules('final_test_type', false),
    final_math_score: actSatRules('final_test_type', false),
    final_science_score: otherScoreRules(false),
}

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

$(document).ready(function () {
    $('#add-past-current-score-form').validate({
        rules: rules,
        messages: {
            test_type: common_error_message.test_type,
            test_date: common_error_message.test_date,
            english_score: common_error_message.english_score,
            math_score: common_error_message.math_score,
            science_score: common_error_message.science_score,
            reading_score: common_error_message.reading_score,
            composite_score: common_error_message.composite_score
        },
        ...common_error_function,
    })

    $('#high-school-form').validate({
        rules: high_school_score_rules,
        messages: {
            // high_school_english_score: common_error_message.english_score,
            // high_school_reading_score: common_error_message.reading_score,
            // high_school_math_score: common_error_message.math_score,
            // high_school_science_score: common_error_message.science_score,
            unweighted_gpa: common_error_function.unweighted_gpa,
            weighted_gpa: common_error_function.weighted_gpa
        },
        ...common_error_function,
    })

    $('#goal-school-form').validate({
        rules: goal_score_rules,
        messages: {
            goal_english_score: common_error_message.english_score,
            goal_reading_score: common_error_message.reading_score,
            goal_math_score: common_error_message.math_score,
            goal_science_score: common_error_message.science_score,
        },
        ...common_error_function,
    })

    $('#final-school-form').validate({
        rules: final_score_rules,
        messages: {
            final_english_score: common_error_message.english_score,
            final_reading_score: common_error_message.reading_score,
            final_math_score: common_error_message.math_score,
            final_science_score: common_error_message.science_score,
        },
        ...common_error_function,
    })
})

function getPastCurrentScore(collegeDetails) {
    otherScoreDetails = collegeDetails
    $.ajax({
        url: core.pastCurrentScore.replace(':id', collegeDetails.id),
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    }).done((response) => {

        if (response.success) {
            $('#list-past-current').html('');
            if (response.data.length > 0) {
                response.data.forEach(data => {
                    let element = `
                        <div class="card p-2 mb-2">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold">${data.test_type}</span>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-alt-primary edit-past-current-score" data-college_id="${collegeDetails.id}" data-id="${data.id}" data-bs-toggle="tooltip" title="Edit Score"><i class="fa fa-fw fa-pencil-alt" data-college_id="${collegeDetails.id}" data-id="${data.id}"></i></button>
                                    <button class="btn btn-sm btn-alt-danger delete-past-current-score" data-college_id="${collegeDetails.id}" data-id="${data.id}" data-bs-toggle="tooltip" title="Delete Score"><i class="fa fa-fw fa-times delete-past-current-score" data-college_id="${collegeDetails.id}" data-id="${data.id}"></i></button>
                                </div>
                            </div>
                            <div>
                                <span class="fw-bold">Test Date:</span>
                                <span>${data.test_date}</span>
                            </div>
                    `
                    if(data.test_type == 'ACT') {
                        element += `
                            <div>
                                <span class="fw-bold">English Score:</span>
                                <span>${data.english_score}</span>
                            </div>
                            <div>
                                <span class="fw-bold">Science Score:</span>
                                <span>${data.science_score}</span>
                            </div>
                        `
                    }
                    element += `
                        <div>
                            <span class="fw-bold">${data.test_type == 'ACT' ? 'Reading' : 'Reading/Writing'} Score:</span>
                            <span>${data.reading_score}</span>
                        </div>
                        <div>
                            <span class="fw-bold">Math Score:</span>
                            <span>${data.math_score}</span>
                        </div>
                        <div>
                            <span class="fw-bold">Composite Score:</span>
                            <span>${data.composite_score}</span>
                        </div>
    
                    `
                    element += '</div>'
    
                    $('#list-past-current').append(element)
                })
            } else {
                $('#list-past-current').append('<div class="no-data">No data found</div>')
            }
        }
    })
}

function resetModal() {
    $('#add-past-current-score-form').trigger('reset');
    $('#add-past-current-score-form').validate().resetForm();
    $('#test_type').val('ACT');
    $('#test_date').val('');
    $('#english_score').val('');
    $('#math_score').val('');
    $('#science_score').val('');
    $('#reading_score').val('');
    $('#composite_score').val('');
    $('.other-field-name').html('ACT');
    $('.act-fields').removeClass('d-none');
    $('#reading-title').html('Reading');
    $('#form-title').html('Add');
    $('#add-score').html('Add');
    $('#add-past-current-score-form').find('#id').remove();
    editScoreDetails = null
}

function setIncrementalScore(e, type) {
    if ($('#' + type).val() == 'SAT' || $('#' + type).val() == 'PSAT') {
        const number = e.target.value;
        if (number > 200 && number < 800) {
            const increment = Math.ceil(number / 10) * 10;
            $('#' + e.target.id).val(increment);
        }
    }
}

$('#test_type').on('change', function (e) {
    hideShowScoreFields(e.target.value);
    $('#test_date').val(editScoreDetails && editScoreDetails.test_type == e.target.value ? editScoreDetails.test_date : '');
    $('#english_score').val(editScoreDetails && editScoreDetails.test_type == e.target.value ? editScoreDetails.english_score : '');
    $('#math_score').val(editScoreDetails && editScoreDetails.test_type == e.target.value ? editScoreDetails.math_score : '');
    $('#science_score').val(editScoreDetails && editScoreDetails.test_type == e.target.value ? editScoreDetails.science_score : '');
    $('#reading_score').val(editScoreDetails && editScoreDetails.test_type == e.target.value ? editScoreDetails.reading_score : '');
    $('#composite_score').val(editScoreDetails && editScoreDetails.test_type == e.target.value ? editScoreDetails.composite_score : '');
})

function hideShowScoreFields(value) {
    if ($('#test_type').val() == 'ACT') {
        $('.other-field-name').html('ACT');
        $('.act-fields').removeClass('d-none');
        $('#reading-title').html('Reading');
    } else {
        $('.other-field-name').html(value);
        $('.act-fields').addClass('d-none');
        $('#reading-title').html('Reading/Writing');
    }
}

$('.score').on('change', function (e) {
    let score = 0
    setIncrementalScore(e, 'test_type');
    if ($('#test_type').val() == 'ACT') { 
        score = parseInt($('#english_score').val() ? $('#english_score').val() : 0) + parseInt($('#math_score').val() ? $('#math_score').val() : 0) + parseInt($('#science_score').val() ? $('#science_score').val() : 0) + parseInt($('#science_score').val() ? $('#science_score').val() : 0)
        $('#composite_score').val(score / 4);
    } else {
        score = parseInt($('#reading_score').val() ? $('#reading_score').val() : 0) + parseInt($('#math_score').val() ? $('#math_score').val() : 0);
        $('#composite_score').val(score);
    }
})

$(document).on('click', '.delete-past-current-score', function (e) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this score?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, keep it',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: core.deletepastCurrentScore.replace(':id', $(this).data('id')),
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            }).done(async (response) => {
                if (response.success) {
                    toastr.success(response.message);
                    await getPastCurrentScore(otherScoreDetails);
                } else {
                    toastr.error(response.message);
                }
            })
        }
    })
})

$('#add-past-current-score').on('hide.bs.modal', function (e) {
    if (e.target.tagName != "INPUT") {
        resetModal();
    }
})

$(document).on('click', '.edit-past-current-score', async function (e) {
    $.ajax({
        url: core.getSinglePastCurentScore.replace(':id', $(this).data('id')),
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    }).done((response) => {
        if (response.success) {
            editScoreDetails = response.data;
            $('#form-title').html('Edit');
            $('#add-score').html('Edit');
            $('#add-past-current-score-form').append('<input type="hidden" name="id" id="id" value="'+ response.data.id +'">');
            $('#test_date').val(response.data.test_date);
            $('#english_score').val(response.data.english_score);
            $('#math_score').val(response.data.math_score);
            $('#science_score').val(response.data.science_score);
            $('#reading_score').val(response.data.reading_score);
            $('#composite_score').val(response.data.composite_score);
            $('#test_type').val(response.data.test_type);
            hideShowScoreFields(response.data.test_type);
            $('#add-past-current-score').modal('show');
        }
    })
})

// For Highschool scores

$('.gpa-value').on('change', function (e) {
    if (+e.target.value > 0) {
        $('#' + e.target.id).val((+e.target.value).toFixed(2))
    }
})

$('#high_school_test_type').on('change', function (e) {
    hideShowHighSchoolScoreFields(e.target.value);
    if (otherScoreDetails && otherScoreDetails.high_school_test_type == e.target.value) {
        $('#high_school_english_score').val(otherScoreDetails.high_school_english_score);
        $('#high_school_math_score').val(otherScoreDetails.high_school_math_score);
        $('#high_school_science_score').val(otherScoreDetails.high_school_science_score);
        $('#high_school_reading_score').val(otherScoreDetails.high_school_reading_score);
        $('#high_school_composite_score').val(otherScoreDetails.high_school_composite_score);
    } else {
        $('#high_school_english_score').val('');
        $('#high_school_math_score').val('');
        $('#high_school_science_score').val('');
        $('#high_school_reading_score').val('');
        $('#high_school_composite_score').val('');
    }
})

function hideShowHighSchoolScoreFields(value) {
    if ($('#high_school_test_type').val() == 'ACT') {
        $('.high-school-other-field-name').html('ACT');
        $('.high-school-act-fields').removeClass('d-none');
        $('#high-school-reading-label').html('ACT Reading Score');
    } else {
        $('.high-school-other-field-name').html(value);
        $('.high-school-act-fields').addClass('d-none');
        $('#high-school-reading-label').html(value + ' Reading/Writing Score');
    }
}

$('.high-school-score').on('change', function (e) {
    let score = 0;
    if ($('#high_school_test_type').val() == 'ACT') {
        score = parseInt($('#high_school_english_score').val() ? $('#high_school_english_score').val() : 0) + parseInt($('#high_school_math_score').val() ? $('#high_school_math_score').val() : 0) + parseInt($('#high_school_science_score').val() ? $('#high_school_science_score').val() : 0) + parseInt($('#high_school_reading_score').val() ? $('#high_school_reading_score').val() : 0)
        $('#high_school_composite_score').val(score / 4);
    } else {
        score = parseInt($('#high_school_reading_score').val() ? $('#high_school_reading_score').val() : 0) + parseInt($('#high_school_math_score').val() ? $('#high_school_math_score').val() : 0);
        $('#high_school_composite_score').val(score);
    }
})

$('.hss-value').on('change', function (e) {
    e.preventDefault();
    if ($('#high-school-form').valid()) {
        storeScoreDetails('highschool', $('#high-school-form').serialize())
    }
})

// For Goal scores

$('#goal_test_type').on('change', function (e) {
    hideShowGoalSchoolScoreFields(e.target.value);
    if (otherScoreDetails && otherScoreDetails.goal_test_type == e.target.value) {
        $('#goal_english_score').val(otherScoreDetails.goal_english_score);
        $('#goal_math_score').val(otherScoreDetails.goal_math_score);
        $('#goal_science_score').val(otherScoreDetails.goal_science_score);
        $('#goal_reading_score').val(otherScoreDetails.goal_reading_score);
        $('#goal_composite_score').val(otherScoreDetails.goal_composite_score);
    } else {
        $('#goal_english_score').val('');
        $('#goal_math_score').val('');
        $('#goal_science_score').val('');
        $('#goal_reading_score').val('');
        $('#goal_composite_score').val('');
    }
})

function hideShowGoalSchoolScoreFields(value) {
    if ($('#goal_test_type').val() == 'ACT') {
        $('.goal-school-other-field-name').html('ACT');
        $('.goal-school-act-fields').removeClass('d-none');
        $('#goal-school-reading-label').html('ACT Reading Score');
    } else {
        $('.goal-school-other-field-name').html(value);
        $('.goal-school-act-fields').addClass('d-none');
        $('#goal-school-reading-label').html(value + ' Reading/Writing Score');
    }
}

$('.goal-school-score').on('change', function (e) {
    let score = 0;
    setIncrementalScore(e, 'goal_test_type');
    if ($('#goal_test_type').val() == 'ACT') {
        score = parseInt($('#goal_english_score').val() ? $('#goal_english_score').val() : 0) + parseInt($('#goal_math_score').val() ? $('#goal_math_score').val() : 0) + parseInt($('#goal_science_score').val() ? $('#goal_science_score').val() : 0) + parseInt($('#goal_reading_score').val() ? $('#goal_reading_score').val() : 0)
        $('#goal_composite_score').val(score / 4);
    } else {
        score = parseInt($('#goal_reading_score').val() ? $('#goal_reading_score').val() : 0) + parseInt($('#goal_math_score').val() ? $('#goal_math_score').val() : 0);
        $('#goal_composite_score').val(score);
    }
})

$('.gss-value').on('change', function (e) {
    e.preventDefault();
    if ($('#goal-school-form').valid()) {
        storeScoreDetails('goalscore', $('#goal-school-form').serialize())
    }
})

// For Final scores

$('#final_test_type').on('change', function (e) {
    hideShowFinalSchoolScoreFields(e.target.value);
    if (otherScoreDetails && otherScoreDetails.final_test_type == e.target.value) {
        $('#final_english_score').val(otherScoreDetails.final_english_score);
        $('#final_math_score').val(otherScoreDetails.final_math_score);
        $('#final_science_score').val(otherScoreDetails.final_science_score);
        $('#final_reading_score').val(otherScoreDetails.final_reading_score);
        $('#final_composite_score').val(otherScoreDetails.final_composite_score);
    } else {
        $('#final_english_score').val('');
        $('#final_math_score').val('');
        $('#final_science_score').val('');
        $('#final_reading_score').val('');
        $('#final_composite_score').val('');
    }
})

function hideShowFinalSchoolScoreFields(value) {
    if ($('#final_test_type').val() == 'ACT') {
        $('.final-school-other-field-name').html('ACT');
        $('.final-school-act-fields').removeClass('d-none');
        $('#final-school-reading-label').html('ACT Reading Score');
    } else {
        $('.final-school-other-field-name').html(value);
        $('.final-school-act-fields').addClass('d-none');
        $('#final-school-reading-label').html(value + ' Reading/Writing Score');
    }
}

$('.final-school-score').on('change', function (e) {
    let score = 0;
    setIncrementalScore(e, 'final_test_type');
    if ($('#final_test_type').val() == 'ACT') {
        score = parseInt($('#final_english_score').val() ? $('#final_english_score').val() : 0) + parseInt($('#final_math_score').val() ? $('#final_math_score').val() : 0) + parseInt($('#final_science_score').val() ? $('#final_science_score').val() : 0) + parseInt($('#final_reading_score').val() ? $('#final_reading_score').val() : 0)
        $('#final_composite_score').val(score / 4);
    } else {
        score = parseInt($('#final_reading_score').val() ? $('#final_reading_score').val() : 0) + parseInt($('#final_math_score').val() ? $('#final_math_score').val() : 0);
        $('#final_composite_score').val(score);
    }
})

$('.fss-value').on('change', function (e) {
    e.preventDefault();
    if ($('#final-school-form').valid()) {
        storeScoreDetails('finalscore', $('#final-school-form').serialize())
    }
})

$(document).on('keypress', '.form-control', function (e) {
    if (e.target.tagName.toLocaleLowerCase() == 'input' && !e.target.className.includes('date-own')) {
        const charCode = (e.which) ? e.which : e.keyCode;
        if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
            e.preventDefault();
        } else {
            const name = e.target.name;
            if (name == 'unweighted_gpa' || name == 'weighted_gpa') {
                const value = e.target.value;
                const dot = value.indexOf('.');
                if (dot > -1 && charCode === 46) {
                    e.preventDefault();
                }
            } else if (charCode === 46) {
                e.preventDefault();
            }
            return true;
        }
    }
})

function storeScoreDetails(scoretype, data) {
    $.ajax({
        url: core.updateScoreDetails.replace(':id', otherScoreDetails.id).replace(':score', scoretype),
        type: 'PUT',
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    }).done((response) => {
        console.log('response -->', response)
        if (response.success) {
            otherScoreDetails = response.data;
        } else {
            toastr.error(response.message);
        }
    })
}