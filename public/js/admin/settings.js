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
  

$('#free-subscription-permission').validate({
    rules: {
        free_access_interval_count: {
            required: true,
            digits: true,
        },
        free_access_interval: {
            required: true,
        },
    },
    messages: {
        free_access_interval_count: {
            required: 'Please enter a number',
            digits: 'Please enter a valid number',
        },
        free_access_interval: {
            required: 'Please select an interval',
        }
    },
    ...common_error_function
})

$('#free-subscription-permission').on('submit', function(e) {
    e.preventDefault()
    if ($(this).valid()) {
        $(this).submit();
    }
})