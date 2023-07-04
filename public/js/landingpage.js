function showByCategoryId(id) {
    $(`.hide-all`).hide();
    $(`#cate-${id}`).show();
    $(`.inactive-all`).removeClass("active");
    $(`#cate-title-${id}`).addClass("active");
}
$("#app-slider").owlCarousel({
    items: 1,
    loop: true,
    dots: false,
    nav: false,
    animateOut: "fadeOut",
    animateIn: "fadeIn",
    autoplay: false,
    autoplayTimeout: 5000,
    // mouseDrag:false,
    responsive: {
        1280: {
            items: 1,
        },
        600: {
            items: 1,
        },
        320: {
            items: 1,
        },
    },
});

$("#partners-slider").owlCarousel({
    items: 5,
    autoplay: 1500,
    smartSpeed: 1500,
    autoplayHoverPause: true,
    slideBy: 1,
    loop: true,
    margin: 30,
    dots: false,
    nav: false,
    responsive: {
        1200: {
            items: 5,
        },
        991: {
            items: 4,
        },
        767: {
            items: 3,
        },
        480: {
            items: 2,
        },
        0: {
            items: 1,
        },
    },
});

$("#testimonial-slider").owlCarousel({
    items: 1,
    autoplay: false,
    autoplayHoverPause: true,
    mouseDrag: false,
    loop: true,
    margin: 30,
    animateIn: "fadeIn",
    animateOut: "fadeOut",
    dots: false,
    nav: true,
    navText: [
        "<i class='fas fa-angle-left'></i>",
        "<i class='fas fa-angle-right'></i>",
    ],
    responsive: {
        980: {
            items: 1,
        },
        600: {
            items: 1,
        },
        320: {
            items: 1,
        },
    },
});

$('[data-fancybox]').fancybox({
    'transitionIn': 'elastic',
    'transitionOut': 'elastic',
    'speedIn': 600,
    'speedOut': 200,
    buttons: [
        'slideShow',
        'fullScreen',
        'thumbs',
        'share',
        // 'download',
        'zoom',
        'close'
    ],
});
