const addValidationRules = () => {
    $('.parent-student-email').each(function (index, element) {
        if (!element) return; 
        $(element).rules('remove');
        $(element).rules('add', {
            required: true,
            email: true,
            messages: {
                required: 'Please enter email address',
                email: 'Please enter valid email address'
            }
        })
    });

    $('.friends-emails').each(function (index, element) {
        $(element).rules('remove');
        $(element).rules('add', {
            required: true,
            email: true,
            messages: {
                required: 'Please enter email address',
                email: 'Please enter valid email address'
            },
        })
    });
}

$('form').validate({
    rules: {
        survay_type: {
            required: true
        },
        high_school_year: {
            required: true
        },
        'parent_student_emails[]': {
            required: true,
            email: true
        },
        'friends[]': {
            required: true,
            email: true
        },
        reference_path: {
            required: true
        },
        specific_path: {
            required: true
        },
        specific_path_other_detail: {
            required: true
        },
        found_other_website_link: {
            required: true
        },
    },
    messages: {
        survay_type: {
            required: 'Please select your type'
        },
        high_school_year: {
            required: 'Please select your year'
        },
        'parent_student_emails[]': {
            required: 'Please enter email address'
        },
        'friends[]': {
            required: 'Please enter email address'
        },
        reference_path: {
            required: 'Please select your reference path'
        },
        specific_path: {
            required: 'Please select your specific path'
        },
        specific_path_other_detail: {
            required: 'Please enter your specific path detail'
        },
        found_other_website_link: {
            required: 'Please enter your found other website link'
        },
    },
    errorElement: "em",
    errorPlacement: function(error, element) {
        error.addClass("invalid-feedback");
        if (element.prop("type") === "checkbox") {
            error.insertAfter(element.parent("label"));
        } else {
            if (element.prop('class').includes('parent-student-email') || element.prop('class').includes('friends-emails')) {
                $(element).parent().after(error.insertAfter(element));
            } else {
                error.insertAfter(element);
            }
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
    },
})



$(document).ready(function () {
    addValidationRules();
    $("input[name='survay_type']").on('change', function () {
        $('form').validate().resetForm();
        var value = $(this).val();
        if (value == 'student') {
            $("label[for='high_school_year']").html('Your Year in High School');
            $("label[for='parent_student_emails']").html('What’s your parent’s email address? (when they buy College Prep System, you will get a referral reward for sharing and they’ll get a discount).');
        } else {
            $("label[for='high_school_year']").html('Your Student’s Year in High School.');
            $("label[for='parent_student_emails']").html('What’s your student’s email address? (when they buy College Prep System, you will get a referral reward for sharing and they’ll get a discount).');
        }
    });

    $("select[name='specific_path']").on('change', function () {
        var value = $(this).val();
        if (value.toLowerCase() == 'other') {
            $("input[name='specific_path_other_detail']").remove();
            $(this).after('<input type="text" name="specific_path_other_detail" class="form-control" placeholder="Enter reason">');
            let isRemoveError = false;
            $(this).parent().children().each(function (index, element) {
                if ($(this).hasClass('text-danger')) {
                    isRemoveError = true;
                    $(this).remove();
                }
            })
            if (isRemoveError) {
                $(this).removeClass('is-invalid');
            }
        } else {
            $("input[name='specific_path_other_detail']").remove();
        }
    });
})

$(document).on('click', '.add-parent-student-email', function (e) {
    e.preventDefault();
    const length = $('#parent_student_emails_holder').children().length;
    let html = `
        <div class="mb-2">
            <div class="d-flex gap-2">
                <input type="text" name="parent_student_emails[${length}]" class="form-control parent-student-email" placeholder="Enter email address">
                <span class="px-3 py-2 btn btn-alt-success cursor-pointer add-parent-student-email">+</span>
            </div>
        </div>`

    $('#parent_student_emails_holder').append(html);
    addValidationRules();

    if ($('#parent_student_emails_holder').children().length > 1) {
        $('#parent_student_emails_holder').children().each(function (index, element) {
            if (index < $('#parent_student_emails_holder').children().length - 1) {
                console.log(element);
                $(element).find('.add-parent-student-email').removeClass('btn-alt-success add-parent-student-email').addClass('btn-alt-danger remove-parent-student-email').html('-');
            }
        })
    }
})

$(document).on('click', '.remove-parent-student-email', function (e) {
    e.preventDefault();
    addValidationRules();
    $(this).parent().parent().remove();
    if ($('.add-parent-student-email').length == 1) {
        $('.add-parent-student-email').removeClass('btn-alt-danger remove-parent-student-email').addClass('btn-alt-success add-parent-student-email').html('+');
    }
})

$(document).on('click', '.add-friends', function (e) {
    e.preventDefault();
    const length = $('#friends_holder').children().length;
    let html = `
        <div class="mb-2">
            <div class="d-flex gap-2">
                <input type="text" name="friends[${length}]" class="form-control friends-emails" placeholder="Enter email address">
                <span class="px-3 py-2 btn btn-alt-success cursor-pointer add-friends">+</span>
            </div>
        </div>`

    $('#friends_holder').append(html);
    addValidationRules()
    if ($('#friends_holder').children().length > 1) {
        $('#friends_holder').children().each(function (index, element) {
            if (index < $('#friends_holder').children().length - 1) {
                $(element).find('.add-friends').removeClass('btn-alt-success add-friends').addClass('btn-alt-danger remove-friends').html('-');
            }
        });
        
    }
})

$(document).on('click', '.remove-friends', function (e) {
    e.preventDefault();
    addValidationRules()
    $(this).parent().parent().remove();
    if ($('.add-friends').length == 1) {
        $('.add-friends').removeClass('btn-alt-danger remove-friends').addClass('btn-alt-success add-friends').html('+');
    }
})