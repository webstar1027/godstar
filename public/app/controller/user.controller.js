app.controller('userController',['$scope','$localStorage','$rootScope','$location',function($scope,$localStorage,$rootScope,$location){
    if($localStorage.token){
       // $location.path('/user');
    }else{
        $location.path('/login');
    }
}]);