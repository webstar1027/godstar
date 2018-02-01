var protocol = location.protocol;
var slashes = protocol.concat("//");
var host = slashes.concat(window.location.hostname + '/');

var app = angular.module('hipRezApp', ['ngRoute','ngStorage','slickCarousel']);

app.constant('urls', {
    BASE: host,
    BASE_API: host+'api'
}).config(['$routeProvider','$httpProvider','$qProvider','$locationProvider',function($routeProvider,$httpProvider,$qProvider,$locationProvider) {
    $qProvider.errorOnUnhandledRejections(false);
    $routeProvider
        .when("/", {
            templateUrl : "app/views/index.html",
            controller:'welcomeController'
        }).when("/login", {
        templateUrl : "app/views/login.html",
        controller:'loginController'
    })
        .when("/resume", {
            templateUrl : "app/views/resume.html",
            controller : 'resumeController'
        }).when("/user", {
        templateUrl : "app/views/user.html",
        controller: 'userController'
    }).when("/template/", {
        templateUrl : "app/views/template.html",
        controller: 'templateController'
    }).when("/billing/", {
        templateUrl : "app/views/billing.html",
        controller : 'billingController'
    }).when("/domain-name/", {
        templateUrl : "app/views/domain_name.html",
        controller : 'billingController'
    }).when("/select-hosting/", {
        templateUrl : "app/views/select_hosting.html"
    }).when("/timelimite",{
        templateUrl : "app/views/thanks.html"
    }).when("/signup",{
        templateUrl : "app/views/signup.html",
        controller:'loginController'
    }).when('/template/:id',{
        templateUrl : "app/views/template_curr.html",
        controller: 'templateController'
    }).when('/about',{
        templateUrl : "app/views/about.html"
    }).when('/privacy-policy',{
        templateUrl : "app/views/privacy.html"
    }).when('/terms-of-use',{
        templateUrl : "app/views/terms.html"
    }).when('/contact-us',{
        templateUrl : "app/views/contact.html"
    }).when('/faq',{
        templateUrl : "app/views/faq.html"
    });
    // $locationProvider.hashPrefix('');
    //$locationProvider.html5Mode(true);
    // $locationProvider.html5Mode({
    //     enabled: true,
    //     requireBase: false
    // });
    $httpProvider.interceptors.push(['$q', '$location', '$localStorage', function ($q, $location, $localStorage) {
        return {
            'request': function (config) {
                config.headers = config.headers || {};
                if ($localStorage.token) {
                    config.headers.Authorization = 'Bearer ' + $localStorage.token;
                }
                return config;
            },
            'responseError': function (response) {
                if (response.status === 401 || response.status === 403) {
                    console.log('response');
                    console.log(response);
                    delete $localStorage.token;
                    var currentPath = $location.path();
                    $location.path(currentPath);
                }
                return $q.reject(response);
            }
        };
    }]);
}]).run(['$rootScope', 'AuthService','$window','GPlusAuthService','LinkedinService', function ($rootScope, AuthService,$window,GPlusAuthService,LinkedinService) {
    GPlusAuthService.signIn();
    AuthService.getUser();
    AuthService.isLoggedIn();
    $rootScope.logout = function () {
        AuthService.logout();
    };
    //LinkedinService.signInLinkedinFunction();
    $window.fbAsyncInit = function() {
        FB.init({
            appId: '136310053646066',
            status: true,
            cookie: true,
            xfbml: true,
            version: 'v2.4'
        });
    };
    $window.scrollTo(0, 0);
}]);
