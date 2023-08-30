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

$("#payment-form").validate({
  rules: {
    name: {
      required: true,
    },
    address_line_1: {
      required: true,
    },
    city: {
      required: true,
    },
    state: {
      required: true,
    },
    zip_code: {
      required: true,
      maxlength: 5,
      digits: true
    },
  },
  messages: {
    name: {
      required: "Name is required",
    },
    address_line_1: {
      required: "Address line 1 is required",
    },
    city: {
      required: "City is required",
    },
    state: {
      required: "State is required",
    },
    zip_code: {
      required: "Postal Code is required",
      maxlength: "Postal Code should be 5 digits",
      digits: "Postal Code should be digits",
    },
  },
  ...common_error_function
});

$('#referral-code-form').validate({
  rules: {
    referral_code: {
      required: true,
    },
  },
  messages: {
    referral_code: {
      required: "Referral code is required",
    },
  },
  ...common_error_function
});
