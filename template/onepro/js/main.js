jQuery(document).on('ready', function ($) {
    "use strict";

    /*--------------------------
        STICKY MAINMENU
    ---------------------------*/
    $("#mainmenu-area").sticky({
        topSpacing: 0
    });


    /*---------------------------
        SMOOTH SCROLL
    -----------------------------*/
    $('ul#nav li a[href^="#"], a.navbar-brand, a.scrolltotop').on('click', function (event) {
        var id = $(this).attr("href");
        var offset = 60;
        var target = $(id).offset().top - offset;
        $('html, body').animate({
            scrollTop: target
        }, 1500, "easeInOutExpo");
        event.preventDefault();
    });


    /*----------------------------
        MOBILE & DROPDOWN MENU
    ------------------------------*/
    jQuery('.stellarnav').stellarNav({
        theme: 'dark'
    });

    /*----------------------------
        SCROLL TO TOP
    ------------------------------*/
    $(window).scroll(function () {
        var $totalHeight = $(window).scrollTop();
        var $scrollToTop = $(".scrolltotop");
        if ($totalHeight > 300) {
            $(".scrolltotop").fadeIn();
        } else {
            $(".scrolltotop").fadeOut();
        }

        if ($totalHeight + $(window).height() === $(document).height()) {
            $scrollToTop.css("bottom", "90px");
        } else {
            $scrollToTop.css("bottom", "20px");
        }
    });


    /*--------------------------
       PARALLAX BACKGROUND
    ----------------------------*/
    $(window).stellar({
        responsive: true,
        positionProperty: 'position',
        horizontalScrolling: false
    });


    /*---------------------------
	    HOME SLIDER
	-----------------------------*/
    var $homeSlider = $('.welcome-slider-area');
    $homeSlider.owlCarousel({
        merge: true,
        smartSpeed: 1000,
        loop: true,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        autoplay: true,
        autoplayTimeout: 3000,
        margin: 0,
        /*animateIn: 'fadeIn',
        animateOut: 'fadeOut',*/
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    });

    /*---------------------------
        PROGRESS SKILL BAR
    -----------------------------*/
    jQuery('.skillbar').each(function () {
        jQuery(this).appear(function () {
            jQuery(this).find('.count-bar').animate({
                width: jQuery(this).attr('data-percent')
            }, 3000);
            var percent = jQuery(this).attr('data-percent');
            jQuery(this).find('.count').html('<span>' + percent + '</span>');
        });
    });


    /* -------------------------------------------------------
     PORTFOLIO FILTER SET ACTIVE CLASS FOR STYLE
    ----------------------------------------------------------*/
    $('.portfolio-menu li').on('click', function (event) {
        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');
        event.preventDefault();
    });


    /*----------------------------
        PORTFOLIO MASONRY ACTIVE
    -----------------------------*/
    var $CreativePortfolioMasonry = $('.portfolio-list');
    if (typeof imagesLoaded === 'function') {
        imagesLoaded($CreativePortfolioMasonry, function () {
            setTimeout(function () {
                $CreativePortfolioMasonry.isotope({
                    itemSelector: '.portfolio-item',
                    resizesContainer: false,
                    layoutMode: 'fitRows',
                    filter: '*'
                });
            }, 500);
        });
    };


    /* ------------------------------
     PORTFOLIO FILTERING
     -------------------------------- */
    $('.portfolio-menu li').on('click', function () {
        var filterValue = $(this).attr('data-filter');

        $(".portfolio-list").isotope({
            filter: filterValue,
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false,
            }
        });
        return false;
    });


    /*---------------------------
        TESTMONIAL SLIDER
    -----------------------------*/
    var $testmonialCarousel = $('.testmonial-member-list');
    $testmonialCarousel.owlCarousel({
        merge: true,
        smartSpeed: 1000,
        loop: true,
        nav: false,
        center: true,
        dots: true,
        navText: ['<i class="fa fa-long-arrow-left"></i> Prev', 'Next <i class="fa fa-long-arrow-right"></i>'],
        autoplay: true,
        autoplayTimeout: 3000,
        margin: 20,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    });


    /*---------------------------
        POST SLIDER
    -----------------------------*/
    var $postCarousel = $('.blog-list');
    $postCarousel.owlCarousel({
        merge: true,
        smartSpeed: 1000,
        loop: true,
        nav: true,
        center: true,
        navText: ['<i class="fa fa-long-arrow-left"></i> Prev', 'Next <i class="fa fa-long-arrow-right"></i>'],
        autoplay: true,
        autoplayTimeout: 3000,
        margin: 20,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    });


    /*---------------------------
        CLIENT SLIDER
    -----------------------------*/
    var $clientCarousel = $('.client-slider');
    $clientCarousel.owlCarousel({
        merge: true,
        smartSpeed: 1000,
        loop: true,
        nav: false,
        center: true,
        navText: ['<i class="fa fa-long-arrow-left"></i> Prev', 'Next <i class="fa fa-long-arrow-right"></i>'],
        autoplay: true,
        autoplayTimeout: 3000,
        margin: -2,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            },
            1200: {
                items: 5
            }
        }
    });


    /*--------------------------
        ACTIVE WOW JS
    ----------------------------*/
    new WOW().init();


}(jQuery));



jQuery(window).on('load', function () {
    "use strict";
    /*--------------------------
        PRE LOADER
    ----------------------------*/
    $(".preeloader").fadeOut(1000);


    /*---------------------------
        ISOTOPE ACTIVE ON LOAD
    -----------------------------*/
    $(".portfolio-list").isotope({
        itemSelector: '.portfolio-item'
    });

});
