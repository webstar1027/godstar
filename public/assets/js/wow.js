/*
 $(window).scroll(function() {
 var hT = $('.animated').offset().top,
 hH = $('.animated').outerHeight(),
 wH = $(window).height(),
 wS = $(this).scrollTop();
 if (wS > (hT+hH-wH)){
 console.log('H1 on the view!');

 $('.animated').addClass('slideInRight');
 }
 else {
 $('.animated').removeClass('slideInRight');

 }
 });*/


$(document).ready(function() {
    var $window = $(window);
    function check_if_in_view() {

        var window_height = $window.height();
        var window_top_position = $window.scrollTop();
        var window_bottom_position = (window_top_position + window_height);

        $('.animated-slideInRight').each(function() {
            if($(window).width() > 767) {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + 50);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position) &&
                    (element_top_position <= window_bottom_position)) {

                    $element.addClass('animated');
                    $element.addClass('slideInRight');
                }
            }
        });
        $('.animated-slideInLeft').each(function() {
            if($(window).width() > 767) {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + 50);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position) &&
                    (element_top_position <= window_bottom_position)) {

                    $element.addClass('slideInLeft');
                    $element.addClass('animated');
                }
            }
        });
        $('.animated-fadeInUp').each(function() {
            if($(window).width() > 767) {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + 50);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position) &&
                    (element_top_position <= window_bottom_position)) {

                    $element.addClass('fadeInUp');
                    $element.addClass('animated');
                }
            }
        });
        $('.animated-fadeInDown').each(function() {
            if($(window).width() > 767) {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + 50);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position) &&
                    (element_top_position <= window_bottom_position)) {

                    $element.addClass('fadeInDown');
                    $element.addClass('animated');
                }
            }
        });
        $('.animated-slideInDown').each(function() {
            if($(window).width() > 767) {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + 50);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position) &&
                    (element_top_position <= window_bottom_position)) {

                    $element.addClass('animated');
                    $element.addClass('slideInDown');
                }
            }
        });
        $('.animated-slideInLefttwo').each(function() {
            if($(window).width() > 767) {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + 50);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position) &&
                    (element_top_position <= window_bottom_position)) {

                    $element.addClass('animated');
                    $element.addClass('slideInLefttwo');
                }
            }
        });
        $('.animated-slideInLeftthree').each(function() {
            if($(window).width() > 767) {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + 50);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position) &&
                    (element_top_position <= window_bottom_position)) {

                    $element.addClass('animated');
                    $element.addClass('slideInLeftthree');
                }
            }
        });
        $('.animated-slideInLeftfour').each(function() {
            if($(window).width() > 767) {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + 50);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position) &&
                    (element_top_position <= window_bottom_position)) {

                    $element.addClass('animated');
                    $element.addClass('slideInLeftfour');
                }
            }
        });
        $('.animated-fadeInUpttwo').each(function() {
            if($(window).width() > 767) {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + 50);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position) &&
                    (element_top_position <= window_bottom_position)) {

                    $element.addClass('animated');
                    $element.addClass('fadeInUpttwo');
                }
            }
        });
        $('.animated-fadeInUpthree').each(function() {
            if($(window).width() > 767) {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + 50);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position) &&
                    (element_top_position <= window_bottom_position)) {

                    $element.addClass('animated');
                    $element.addClass('fadeInUpthree');
                }
            }
        });
        $('.animated-fadeInUpfour').each(function() {
            if($(window).width() > 767) {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + 50);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position) &&
                    (element_top_position <= window_bottom_position)) {

                    $element.addClass('animated');
                    $element.addClass('fadeInUpfour');
                }
            }
        });
    }

    var iScrollPos = 0;

    $(window).scroll(function () {

        var iCurScrollPos = $(this).scrollTop();

        if (iCurScrollPos > iScrollPos) {
            check_if_in_view();
        }
        iScrollPos = iCurScrollPos;
    });
});

