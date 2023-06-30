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
        nextSection.css("margin-top", headerHeight);
      } else {
        $navbar.removeClass("fixedmenu");
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
})