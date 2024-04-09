$(document).ready(function () {
  if($("#sidemenu_toggle").length) {
    $("#sidemenu_toggle").on("click", function () {
      $("body").addClass("overflow-hidden");
      $(".side-menu").addClass("side-menu-active");
      $(function () {
        setTimeout(function () {
          $("#close_side_menu").fadeIn(300);
        }, 300);
      });
    });
    $("#close_side_menu , #btn_sideNavClose , .side-nav .nav-link.pagescroll").on("click", function () {
      $("body").removeClass("overflow-hidden");
      $(".side-menu").removeClass("side-menu-active");
      $("#close_side_menu").fadeOut(200);
      $(() => {
        setTimeout(() => {
          $('.sideNavPages').removeClass('show');
          $('.fas').removeClass('rotate-180');
        }, 400);
      });
    });
    $(document).keyup(e => {
      if (e.keyCode === 27) { // escape key maps to keycode `27`
        if ($(".side-menu").hasClass("side-menu-active")) {
          $("body").removeClass("overflow-hidden");
          $(".side-menu").removeClass("side-menu-active");
          $("#close_side_menu").fadeOut(200);
          $(() => {
            setTimeout(()=> {
              $('.sideNavPages').removeClass('show');
              $('.fas').removeClass('rotate-180');
            }, 400);
          });
        }
      }
    });
  }
})

$('.app-slider-lock-btn').on('click' , function () {
  $('.app-slider-lock').fadeToggle(600);
});

$($("body")).append('<a href="#" class="back-top"><i class="fa fa-angle-up"></i></a>');
let amountScrolled = 700;
let backBtn = $("a.back-top");
$(window).on("scroll", function () {
  if ($(window).scrollTop() > amountScrolled) {
    $("a.back-top").addClass("back-top-visible");
  } else {
    $("a.back-top").removeClass("back-top-visible");
  }
});
$("a.back-top").on("click", function () {
  $("html, body").animate({
    scrollTop: 0
  }, 100);
  return false;
});

$(document).ready(function () {
  if ($(".wow").length && $(window).outerWidth() >= 567) {
    let wow = new WOW({
      boxClass: 'wow',
      animateClass: 'animated',
      offset: 0,
      mobile: false,
      live: true
    });
    wow.init();
  }

  let headerHeight = $("header").outerHeight();
  let navbar = $("nav.navbar");
  if (navbar.not('.fixed-bottom').hasClass("static-nav")) {
    $(window).scroll(function () {
      let $scroll = $(window).scrollTop();
      let $navbar = $(".static-nav");
      let nextSection = $(".section-nav-smooth");
      if ($scroll > 250) {
        $navbar.addClass("fixedmenu");
        $('.header-title').css('color', '#0099ff');
        $('.logo-default').attr('src', $('#site_url').val() + '/static-image/logo-with-transparent-bg.png');
        nextSection.css("margin-top", headerHeight);
      } else {
        $navbar.removeClass("fixedmenu");
        $('.header-title').css('color', '#fff');
        $('.logo-default').attr('src', $('#site_url').val() + '/static-image/logo-no-bg.png');
        nextSection.css("margin-top", 0);
      }
      if ($scroll > 125) {
        $('.header-with-topbar nav').addClass('mt-0');
      } else {
        $('.header-with-topbar nav').removeClass('mt-0');
      }
    });
    $(function () {
      if ($(window).scrollTop() >= $(window).height()) {
        $(".static-nav").addClass('fixedmenu');
      }
    })
  }
  if (navbar.hasClass("fixed-bottom")) {
    let navTopMargin = $(".fixed-bottom").offset().top;
    let scrollTop = $(window).scrollTop();
    $(window).scroll(function () {
      if ($(window).scrollTop() > navTopMargin) {
        $('.fixed-bottom').addClass('fixedmenu');
      } else {
        $('.fixed-bottom').removeClass('fixedmenu');
      }
      if ($(window).scrollTop() < 260) {
        $('.fixed-bottom').addClass('menu-top');
      } else {
        $('.fixed-bottom').removeClass('menu-top');
      }
    });
    $(function () {
      if (scrollTop < 230) {
        $('.fixed-bottom').addClass('menu-top');
      } else {
        $('.fixed-bottom').removeClass('menu-top');
      }
      if (scrollTop >= $(window).height()) {
        $('.fixed-bottom').addClass('fixedmenu');
      }
    })
  }

  $('.about-content').on('click', function (e) {
    e.preventDefault();
    const target = $('#about');
    $('html, body').animate({
      scrollTop: target.offset().top
    }, 100);
  });
})

$(window).on("load", function () {
  $(".loader").fadeOut(100);
  $('.side-menu').removeClass('opacity-0');
});

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
      if (element.type == "checkbox") {
        $(element).closest(".form-check-input").addClass("is-invalid");
      } else {
        $(element).closest('.form-control').addClass("is-invalid");
      }
    } else {
      $(element).removeClass("is-valid");
    }
  },
  unhighlight: function(element, errorClass, validClass) {
    if (validClass) {
      if (element.type == "checkbox") {
        $(element).closest(".form-check-input").removeClass("is-invalid");
      } else {
        $(element).closest('.form-control').removeClass("is-invalid");
      }
    } else {
      $(element).removeClass("is-invalid");
    }
  }
}

$("form[class*='js-validation-signin']").validate({
  rules: {
    email: {
      required: true,
      email: true
    },
    password: {
      required: true,
      minlength: 6
    },
  },
  messages: {
    email: {
      required: "Please enter your email",
      email: "Please enter a valid email address"
    },
    password: {
      required: "Please provide a password",
      minlength: "Your password must be at least 6 characters long"
    },
  },
  ...common_error_function
})

$('#sign-in-modal').on('show.bs.modal', function () {
  $('#errors').html('')
  $('form[class*="js-validation-signin"]')[0].reset()
})

$('#sign-in-modal').on('hidden.bs.modal', function () {
  $('#errors').html('')
  $('form[class*="js-validation-signin"]')[0].reset()
})

jQuery.validator.addMethod('unique_email', function(value, element) {
  var isSuccess = false;
  $.ajax({
    url: $('#site_url').val() + '/check-email',
    type: 'POST',
    data: {email: value},
    async: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
      isSuccess = response;
    }
  });
  return isSuccess;
}),

$("form[class*='js-validation-signup']").validate({
  rules: {
    first_name: {
      required: true,
      minlength: 3
    },
    last_name: {
      required: true,
      minlength: 3
    },
    email: {
      required: true,
      email: true,
      unique_email: true
    },
    password: {
      required: true,
      minlength: 6
    },
    password_confirmation: {
      required: true,
      minlength: 6,
      equalTo: "#password"
    },
    phone: {
      required: true,
    },
    role: {
      required: true
    },
    terms: {
      required: true
    },
    is_verifed: {
      required: true
    },
    is_receive_emails_newsletters: {
      required: true
    },
  },
  messages: {
    first_name: {
      required: "Please enter your first name",
      minlength: "Your first name must be at least 3 characters long"
    },
    last_name: {
      required: "Please enter your last name",
      minlength: "Your last name must be at least 3 characters long"
    },
    email: {
      required: "Please enter your email",
      email: "Please enter a valid email address",
      unique_email: "Email is already in taken. Please try another email address"
    },
    password: {
      required: "Please provide a password",
      minlength: "Your password must be at least 6 characters long"
    },
    password_confirmation: {
      required: "Please provide a password",
      minlength: "Your password must be at least 6 characters long",
      equalTo: "Please enter the same password as above"
    },
    phone: {
      required: "Please enter your phone number",
    },
    role: {
      required: "Please select your role"
    },
    terms: {
      required: "Please accept our terms and conditions"
    },
    is_verifed: {
      required: "Please accept our terms and conditions"
    },
    is_receive_emails_newsletters: {
      required: "Please accept our terms and conditions"
    },
  },
  ...common_error_function
})

$('#signup').on('click', function(e) {
  e.preventDefault();
  const form = $("form[class*='js-validation-signup']");
  if (form.valid()) {
    $.ajax({
      url: form.attr('action'),
      type: 'POST',
      data: form.serialize(),
    }).done((response) => {
      console.log('response -->', response)
      if (response.success) {
        $('#email-verification-modal').modal('show')
        $('#sign-up-modal').modal('hide')
        $('#verfication-emaiil-alerts').html('')
        const alert = `
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          ${response.message}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`
        $('#verfication-emaiil-alerts').append(alert);
        $('#email-verification-id').val(response.data.id)
        // window.location.href = response.redirect_url
      } else {
        $('#registation-errors').html('')
        const alert = `
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          ${response.message}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`
        $('#registation-errors').append(alert);
      }
    })
  }
})

$('#sign-up-modal').on('show.bs.modal', function () {
  $('#registation-errors').html('')
  $("form[class*='js-validation-signup']")[0].reset()
})

$('#sign-up-modal').on('hidden.bs.modal', function () {
  $('#registation-errors').html('')
  $("form[class*='js-validation-signup']")[0].reset()
})