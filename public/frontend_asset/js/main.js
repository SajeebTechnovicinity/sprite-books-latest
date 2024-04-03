$(document).ready(function () {
    let cartCarouselItems = $('.cards-carousel .card');

    if(cartCarouselItems.length > 2){
        $(".cards-carousel").slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 1023,
                    settings: {
                        slidesToShow: 3,
                    },
                },
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 1,
                    },
                },
            ],
        });
    } else {
        $(".cards-carousel").css({
            "display": 'flex',
            "gap" : '20px'
        });
        $(".cards-carousel .card").css({
            "max-width": '31%',
        });
    }

    // Product Count
    $(".quantity-field").on("keyup", function () {
        let intVal = parseInt($(this).val());
        if (isNaN(intVal)) {
            $(this).val(1);
        } else {
            $(this).val(intVal);
        }
    });
    $(".quantity-form span").on("click", function () {
        let target = $(this).siblings(".quantity-field");
        if ($(this).attr("class") === "decrement") {
            if (isNaN(target.val())) {
                target.val(1);
            } else if (target.val() > 1) {
                target.val(parseInt(target.val()) - 1);
            }
        } else {
            if (isNaN(target.val())) {
                target.val(1);
            } else {
                target.val(parseInt(target.val()) + 1);
            }
        }
    });

    // Tabs
    $(".tab-btn").on("click", function (e) {
        e.preventDefault();
        $(".tab-btn").removeClass("btn-active");
        $(this).addClass("btn-active");
        $(".tab-body__inner").addClass("d-none");
        $($(this).attr("href")).removeClass("d-none");

        // if ($(this).attr("href") !== "#books") {
        //   $(".follow-btn, .author-summary .video").addClass("d-none");
        //   $(".edit-profile").removeClass("d-none");
        // } else {
        //   $(".follow-btn, .author-summary .video").removeClass("d-none");
        //   $(".edit-profile").addClass("d-none");
        // }
    });

    // Image Carousel
    $(".main-figure-group").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        asNavFor: ".figure-guoup",
    });
    $(".figure-guoup").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        focusOnSelect: true,
        asNavFor: ".main-figure-group",
    });

    // Community Cards Carousel
    $(".community-cards-carousel").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        variableWidth: true,
        arrows: true,
        responsive: [
            {
                breakpoint: 575,
                settings: {
                    variableWidth: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });

    // Dropdown or popup
    $(".btn-trigger").on("click", function (e) {
        e.preventDefault();
        let target = $(this).data("target");
        $(target).toggleClass("d-none");
    });

    $("body").on("click", function (event) {
        let parentEl = $(event.target).parents('.user-profile');
        if(parentEl.length === 0){
            $(".profile-dropdown").addClass("d-none");
        }
    });

    $("body").on(
        "click",
        ".modal__close, .modal .btn-group .btn-lite",
        function (e) {
            e.preventDefault();
            $(this).parents(".modal").addClass("d-none");
        }
    );

    //accordion
    $(".accordion_header").click(function () {
        $(this).parent().find(".arrow").toggleClass("arrow-animate");
        $(this).parent().find(".accordion_content").slideToggle(280);
    });

    $('#add-book input[type="file"]').change(function (e) {
        var file = e.target.files[0].name;
        $(this).parent().find("p").remove();
        $(this).parent().append(`<p>${file}</p>`);
    });

    // disable mousewheel on a input number field when in focus
    // (to prevent Chromium browsers change the value when scrolling)
    $("form").on("focus", "input[type=number]", function (e) {
        $(this).on("wheel.disableScroll", function (e) {
            e.preventDefault();
        });
    });
    $("form").on("blur", "input[type=number]", function (e) {
        $(this).off("wheel.disableScroll");
    });
    $('#attach-file-media').on('change',function(){
        $(this).parent().find('.media-file-name').remove();
         var filename = $(this).val().replace(/.*(\/|\\)/, '');
         $(this).parent().append(`<p style="margin-top: 10px;" class="media-file-name">${filename}</p>`);
     });

  // FAQ
  $(".faq-trigger").on("click", function () {
    $(this).parents(".faq__item").toggleClass("active-item");
    $(this).next(".faq__item-body").slideToggle();
  });
});
