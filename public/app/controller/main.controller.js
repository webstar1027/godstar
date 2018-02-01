app.controller("welcomeController", function($scope,$http,$rootScope,$location,$localStorage,$window){


    //$localStorage.token = false;

    if($localStorage.token){
        $scope.userLoggined=false;
        if($location.path() == '/'){
            $location.path('/');
        }
        // if($location.path() == '/login'){
        //     $location.path('/user');
        // }
    }else{
        $scope.userLoggined=true;
    }

    $scope.headerSlickConfig = {
        infinite: true,
        slidesToShow:  1,
        slidesToScroll: 1,
        speed: 1200,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: false,
        arrows: false,
        event: {
            beforeChange: function () {
                if($('.header-slider .slick-active img').hasClass('blue-background')) {
                    $('#headerTextContent').html( "We Help You Land <br>Your Dream Job" );
                }
                else if($('.header-slider .slick-active img').hasClass('purple-background')) {
                    $('#headerTextContent').html( "Impress Your Future <br> Employer" );
                }
                else if($('.header-slider .slick-active img').hasClass('yellow-background')) {
                    $('#headerTextContent').html( "Fully Customized <br> Resume in Minutes" );
                }
                else if($('.header-slider .slick-active img').hasClass('green-background')) {
                    $('#headerTextContent').html( "Create an Amazing <br> Resume in Minutes" );
                }
            }
        },
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    dots: false,
                    draggable: false
                }
            }
        ]
    };
    $scope.howItWorksSlickConfig = {
        infinite: true,
        slidesToShow:  1,
        slidesToScroll: 1,
        speed: 300,
        dots: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 769,
                settings: {
                    centerMode: true,
                    variableWidth: true
                }
            }
        ]
    };
    $scope.commentSlickConfig = {
        infinite: true,
        slidesToShow:  2,
        slidesToScroll: 2,
        speed: 1000,
        dots: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow:  1,
                    slidesToScroll: 1
                }
            }
        ]
    };
    $scope.chooseTemplateSlick = {
        infinite: true,
        slidesToShow:  1,
        slidesToScroll: 1,
        speed: 1000,
        dots: true,
        arrows: true,
        centerMode: true,
        variableWidth: true,
        autoplay: true,
        autoplaySpeed: 1500,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows:  false
                }
            }
        ]
    };
    $scope.logosSlick = {
        infinite: true,
        slidesToShow:  7,
        slidesToScroll: 1,
        speed: 1000,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 1200,
        responsive: [
            {
                breakpoint: 1351,
                settings: {
                    slidesToShow:  5
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow:  3
                }
            }
        ]
    };

});