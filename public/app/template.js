var protocol = location.protocol;
var slashes = protocol.concat("//");
var host = slashes.concat(window.location.hostname + '/');

var app = angular.module('hipRezAppTemplate', ['ngRoute','ngStorage']);

app.constant('urls', {
    BASE: host,
    BASE_API: host+'api'
}).config(['$routeProvider',function($routeProvider) {
    $routeProvider
       .when('/:id',{
            templateUrl : "app/views/templateoo.html",
            controller: 'templateController'
        });
}]);

