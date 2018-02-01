<!doctype html>
<html lang="{{ app()->getLocale() }}" ng-app="hipRezAppTemplate">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HipRez</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>


    {{--<link rel="stylesheet" href="templates/sanfrancisco/styles/animate.min.css">--}}

    {{--<!-- Normalize CSS-->--}}
    {{--<link rel="stylesheet" href="templates/sanfrancisco/styles/normalize.css">--}}

    {{--<!-- Magnific Popup-->--}}
    {{--<link rel="stylesheet" href="templates/sanfrancisco/plugins/magnific-popup/magnific-popup.css">--}}

    {{--<!-- Owl carousel-->--}}
    {{--<link rel="stylesheet" href="templates/sanfrancisco/plugins/owl-carousel/owl.carousel.css">--}}

    {{--<!-- Font Awesome-->--}}
    {{--<link rel="stylesheet" href="templates/sanfrancisco/styles/font-awesome.min.css">--}}

    <!-- Google Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Roboto+Mono:400,400italic,700italic,700%7CNothing+You+Could+Do" rel="stylesheet">

    <!-- Main Stylesheet-->
    <link rel="stylesheet" href="templates/sanfrancisco/styles/main.css">




</head>
<body ng-cloak>
    <ng-view></ng-view>
</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.5/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ngStorage/0.3.11/ngStorage.js"></script>

<script src="{{ asset('bower_components/slick-carousel/slick/slick.js') }}"></script>
<script src="{{ asset('bower_components/angular-slick-carousel/dist/angular-slick.min.js') }}"></script>

<script src="{{ asset('app/template.js') }}"></script>

<script src="{{ asset('app/controller/template.controller.js') }}"></script>


{{--<script src="templates/sanfrancisco/scripts/jquery.min.js"></script>--}}

{{--<!-- Instafeed-->--}}
{{--<script src="templates/sanfrancisco/plugins/instafeed/instafeed.min.js"></script>--}}

{{--<!-- Google Maps API-->--}}
{{--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>--}}

{{--<!-- Magnific Popup-->--}}
{{--<script src="templates/sanfrancisco/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>--}}

{{--<!-- One Page Nav-->--}}
{{--<script src="templates/sanfrancisco/plugins/one-page-nav/jquery.nav.js"></script>--}}

{{--<!-- Owl Carousel-->--}}
{{--<script src="templates/sanfrancisco/plugins/owl-carousel/owl.carousel.min.js"></script>--}}

{{--<!-- Shuffle-->--}}
{{--<script src="templates/sanfrancisco/plugins/shuffle/jquery.shuffle.modernizr.min.js"></script>--}}

{{--<!-- Twitter Fetcher-->--}}
{{--<script src="templates/sanfrancisco/plugins/twitter-fetcher/twitterFetcher_min.js"></script>--}}

{{--<!-- Validate-->--}}
{{--<script src="templates/sanfrancisco/plugins/jquery-validate/jquery.validate.min.js"></script>--}}

{{--<!-- WOW-->--}}
{{--<script src="templates/sanfrancisco/plugins/wowjs/wow.min.js"></script>--}}

{{--<!-- Main Scripts-->--}}
{{--<script src="templates/sanfrancisco/scripts/main.js"></script>--}}



</html>
