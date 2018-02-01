$( document ).ready(function () {

    $(document).on('click', '.navbar-toggle', function() {
        $(this).toggleClass('collapsed');
    });
    $(document).on('click', '.btn-provider-premium', function() {
        if(!$(this).hasClass('selected')) {
            $('.btn-provider-premium').each(function() {
                $(this).removeClass('selected');
            });
            $(this).addClass('selected');
        }
    });
    $(document).on('click', ".navbar-toggle", function(){
        if($(this).hasClass('active')) {
            $('.menu-content').animate({ right: '-106%' }, 300, function() {
                $(this).hide();
            });
            $(this).removeClass('active');
        }
        else {
            $('.menu-content').show();
            $('.menu-content').animate({ right: '-2%' }, 300, function() {

            });
            $(this).addClass('active');
        }
    });

    $(document).on('keyup paste', ".completed-input", function(){
        if($(this).val() != "") {
            $(this).addClass('check-sign');
        }
        else {
            $(this).removeClass('check-sign');
        }
    });
});

