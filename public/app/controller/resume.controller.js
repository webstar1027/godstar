app.controller("resumeController",['$scope','$rootScope','$localStorage','$location','$http','LinkedinService','urls', function($scope,$rootScope,$localStorage,$location, $http,LinkedinService,urls) {
    // if($rootScope.returnBackButton){
    //     $rootScope.selectedTemplateRedirectResume = false;
    //     $location.path('template/');
    // }

    //
    // if($location.path()=='/resume'){
    //     if($rootScope.templateNamePay != ''){
    //         console.log($location.path());
    //         var path = $location.path();
    //         $location.path(path);
    //     }
    // }

    $scope.ifLinkedinUser = function(){
        // if($rootScope.user.provider == 'linkedin'){
        //     return false;
        // }
        return true;
    };

    myfunc();

    function myfunc() {
        $http({
            method: 'GET',
            url: urls.BASE_API + '/user'
        }).then(function (res) {
            $rootScope.user = res.data.user;
        }).catch(function (res) {});
    }

    $scope.responseSuccess = false;

    if($scope.responseSuccess){
        setTimeout(function(){
            $scope.responseSuccess = false;
        },1000)
    }

    if($localStorage.token){
        $scope.userLoggined=false;
        if($location.path()==='/'){
            $location.path('/');
        }
        if($location.path()=='/login'){
            $location.path('/resume');
        }
    }else{
        $scope.userLoggined=true;
        $location.path('/signup');
    }

    $scope.fromMyDivaceTwo = function(){

    };

    $scope.fromMyDivace = function () {
        var target = angular.element('#myFileField');
    };

    $scope.templatePage = function(){
        if($rootScope.selectedTemplateRedirectResume){
            $location.path('/resume');
        }
        $location.path('/template');
    };
    $rootScope.userExist = false;
    $rootScope.letBillingPage = false;
    $scope.fromMyLinkedin = function () {

        if($rootScope.user['provider'] == 'linkedin'){
            $http({
                method: 'POST',
                url: 'api/linkedin/resume/get'
            }).then(function mySuccess(response) {
                $rootScope.haveResume = true;
                $rootScope.letBillingPage = true;
                $rootScope.myStyleLinkedin={background:'#1bc873'};
                $location.path('/billing');
            }, function myError(response) {
                //console.log('error' + response);
            });
        }else{
            $rootScope.letBillingPage = true;
            $rootScope.userExist = true;
            LinkedinService.signInLinkedinFunction();
        }
    };

}]);




