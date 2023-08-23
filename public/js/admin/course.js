$('select[name="user_type[]"]').select2({
    multiple: true,
    placeholder: 'Select an option',
    theme: "classic",
    ajax: ajax(core.ajaxRolesList),
});


$('select[name="status"]').on('change', function (e) {
    if (e.target.value == 'paid') {
        $('.product-options').removeClass('d-none')
        $('.product-options').addClass('d-flex flex-column')
        $('#add-product-btn').removeClass('d-none')
    } else {
        $('.product-options').addClass('d-none')
        $('.product-options').removeClass('d-flex flex-column')
        $('#add-product-btn').addClass('d-none')
    }
})

$('#add-product-btn').on('click', function (e) {
    $('#new-product-modal').modal('show')
})

$('select[name="product"]').select2({
    allowClear: true,
    ajax: ajax(core.ajaxProductList),
    placeholder: 'Select an product',
})

$('select[name="products[]"]').select2({
    allowClear: true,
    ajax: ajax(core.ajaxProductList),
    placeholder: 'Select an product',
    theme: "classic",
    multiple: true,
})

$('select[name="category"]').select2({
    allowClear: true,
    dropdownParent: $('#new-product-modal'),
    ajax: ajax(core.ajaxCategoriesList),
    placeholder: 'Select an category',
})

$('#new-product-form').validate({
    rules: {
        category: {
            required: true
        },
        title: {
            required: true
        },
        description: {
            required: true
        }
    },
    messages: {
        category: {
            required: 'Please select a category'
        },
        title: {
            required: 'Please enter a title'
        },
        description: {
            required: 'Please enter a description'
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

$('#new-product-modal').on('hide.bs.modal', function (e) {
    $(this).find('form').trigger('reset')
})

$('#create-new-product').on('click', function (e) {
    e.preventDefault();
    if ($('#new-product-form').valid()) {
        $.ajax({
            url: core.ajaxProductCreate,
            type: 'POST',
            data: $('#new-product-form').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function (response) {
            if(response.success) {
                $('#new-product-modal').modal('hide')
                $('#new-product-form').trigger('reset')
                $('#add-product-btn').remove()
                toastr.success(response.message)
            } else {
                toastr.error(response.message)
            }
        })
    }
})