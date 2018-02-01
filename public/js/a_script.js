$(document).ready(function(){

    if (window.location.hash == '#!/') {
        $(window).scroll(function(){
            if($(window).width() > 767) {
                var sticky = $('.header-navbar-content'),
                    scroll = $(window).scrollTop();
                if (scroll >= 100) {
                    sticky.addClass('fixed-header');
                    $('#headerLogo').attr('src', 'assets/images/logo2.png');

                    if($('#home-menu').hasClass('active')) {
                        $('.menu-icon').css('background-image', 'url(assets/images/close-menu-icon2.png)');
                    }
                    else {
                        $('.menu-icon').css('background-image', 'url(assets/images/menu-icon.png)');
                    }
                }
                else {
                    sticky.removeClass('fixed-header');
                }
            }
        });
    }
    else {
        $(window).scroll(function(){
            if($(window).width() > 767) {
                var sticky = $('.header-navbar-content'),
                    scroll = $(window).scrollTop();
                if (scroll >= 100) {
                    sticky.addClass('fixed-header');
                    $('#templateHeaderLogo').attr('src', 'assets/images/logo2.png');
                    $('.template-page-header .navbar-toggle .icon-bar').css('background-color', '#000');
                }
                else {
                    sticky.removeClass('fixed-header');
                    if($(window).width() > 767) {
                        $('#templateHeaderLogo').attr('src', 'assets/images/logo.png');
                        $('.template-page-header .navbar-toggle .icon-bar').css('background-color', '#fff');
                    }
                }
            }
        });
    }
});
