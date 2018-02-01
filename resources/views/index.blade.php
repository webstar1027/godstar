<!doctype html>
<html lang="{{ app()->getLocale() }}" ng-app="hipRezApp">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="google-signin-client_id" content="546486351299-k762ctc95v9r026aued34bvfhc72v4b5.apps.googleusercontent.com">

        <title>HipRez</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="{{ asset('libs/font-awesome/css/font-awesome.min.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/a_style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/media.css') }}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.5/slick.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.7.1/slick-theme.css">

        <link rel="stylesheet" href="{{ asset('bower_components/slick-carousel/slick/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/slick-carousel/slick/slick-theme.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/style/animate.css')}}">


        <link rel="stylesheet" href="{{ asset('assets/style/stylesheet.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/style/template.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/style/billing.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/style/style.css') }}">
        {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
    </head>
    <body ng-cloak ng-style="bodyScrollHidden">
        <ng-view></ng-view>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.5/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ngStorage/0.3.11/ngStorage.js"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.5/slick.min.js"></script>--}}

    {{--<script src="{{ asset('bower_components/jquery/jquery.js') }}"></script>
    <script src="{{ asset('bower_components/angular/angular.js') }}"></script>--}}
    <script src="{{ asset('bower_components/slick-carousel/slick/slick.js') }}"></script>
    <script src="{{ asset('bower_components/angular-slick-carousel/dist/angular-slick.min.js') }}"></script>

    <script src="https://apis.google.com/js/api.js" type="text/javascript"></script>

    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/wow.js') }}"></script>

    <script src="{{ asset('app/app.js') }}"></script>
    <script src="{{ asset('app/controller/login.controller.js') }}"></script>
    <script src="{{ asset('app/controller/main.controller.js') }}"></script>
    <script src="{{ asset('app/controller/user.controller.js') }}"></script>
    <script src="{{ asset('app/controller/template.controller.js') }}"></script>
    <script src="{{ asset('app/controller/billing.controller.js') }}"></script>
    <script src="{{ asset('app/controller/resume.controller.js') }}"></script>

    <script src="{{ asset('app/services/auth.service.js') }}"></script>
    <script src="{{ asset('app/services/facebook.service.js') }}"></script>
    <script src="{{ asset('app/services/google.service.js') }}"></script>
    <script src="{{ asset('app/services/linkedin.service.js') }}"></script>
    <script src="{{ asset('js/a_script.js') }}"></script>
    <script src="http://connect.facebook.net/en_US/all.js"></script>

    <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
    {{--<script src="https://apis.google.com/js/platform.js" async defer></script>--}}
    {{--<script src="https://apis.google.com/js/platform.js" async defer></script>--}}
    <script src="https://apis.google.com/js/api:client.js"></script>
    {{--<script src="https://js.stripe.com/v3/"></script>--}}
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    {{--<script src="https://www.paypalobjects.com/api/checkout.js"></script>--}}
</html>
