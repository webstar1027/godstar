app.controller("loginController",function($scope,$http,$rootScope,$location,$localStorage,AuthService,facebookService,GPlusAuthService,LinkedinService,$timeout,urls){

    if($localStorage.token){
        if($location.path() == '/user' ){
            $location.path('/user');
        }
        if($location.path() == '/resume' ){
            if($rootScope.selectedTemplateRedirectResume){
                $location.path('/resume');
            }else{
                $location.path('/template');
            }
        }
        if($location.path() == '/login' ){
            if($rootScope.selectedTemplateRedirectResume){
                $location.path('/resume');
            }else{
                $location.path('/template');
            }
        }
        if($location.path() == '/signup' ){
            if($rootScope.selectedTemplateRedirectResume){
                $location.path('/resume');
            }else{
                $location.path('/template');
            }
        }
    }

    $scope.go = function ( path ) {
        $location.path( path );
    };
    $scope.errorValidationEmailLogin={};
    $scope.signUpForm = {};
    function successAuth(res) {
        if(res.data.error){
            $scope.errorValidationEmailLogin={display:'block'};
            res.preventDefault();
        }else{
            $rootScope.returnBackButton = false;
            $localStorage.token = res.data.token;
            if($rootScope.selectedTemplateRedirectResume){
                $http({
                    method: 'POST',
                    url: urls.BASE_API + '/templateid',
                    data:{'name': $rootScope.templateNamePay,'id': $rootScope.templateIdPay}
                }).then(function myFunc(res) {
                    if(res.data.error){}
                });

                $location.path('/resume');
            }else{
                $location.path('/template');
            }
        }
    }
    $scope.login = function () {
        AuthService.login({'email': $scope.email ,'password':$scope.password}, successAuth);
    };

    $scope.errorValidationPsswordConfirmMessage = {};
    $scope.errorValidationPsswordConfirmBorder = {};
    $scope.errorValidationEmailType = {};
    $scope.errorValidationEmailTypeBorder = {};
    $scope.errorValidationPsswordConfirm = {};
    $scope.errorValidationPasswordTypeBorder = {};

    $scope.signUp = function () {

        $scope.errorValidationPsswordConfirmMessage = {};
        $scope.errorValidationPsswordConfirmBorder = {};
        $scope.errorValidationEmailType = {};
        $scope.errorValidationEmailTypeBorder = {};
        $scope.errorValidationPsswordConfirm = {};
        $scope.errorValidationPasswordTypeBorder = {};

        var email = $scope.email;
        var password = $scope.password;
        var passwordAgain = $scope.passwordAgain;

        function validation(){
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test($scope.email);
        }
        if(!validation()){
            $scope.errorValidationEmailType = {display:'block'};
            $scope.errorValidationEmailTypeBorder = {border:'1px solid darkred'};
            return false;
        }

        if($scope.password.length < 5){
            $scope.errorValidationPsswordConfirmMessage = {display:'block'};
            $scope.errorValidationPasswordTypeBorder = {border:'1px solid darkred'};
            return false;
        }

        if(password == passwordAgain){
            AuthService.signUp({'email': $scope.email ,'password':$scope.password}, successAuth);
        }else{
            $scope.errorValidationPsswordConfirm = {display:'block'}
            return false;
        }
    };
    $scope.logout = function () {
        $rootScope.haveResume = false;
        $rootScope.selectedTemplateRedirectResume = false;
        $rootScope.myStyleLinkedin={};
        $rootScope.myStyleDivice={};
        $rootScope.myStyleUploadLeter={};
        $rootScope.myStyle={};
        AuthService.logout(function () {
            $location.path('/');
        });
    };
    $scope.token = $localStorage.token;
    $scope.tokenClaims = AuthService.getTokenClaims();

    $scope.social = function (prov) {
        AuthService.socialGroup(prov, successAuth);
    };
    $scope.getMyLastName = function() {
        facebookService.getMyLastName()
            .then(function(response) {
                    $scope.last_name = response.last_name;
                }
            );
    };

    $scope.signInGoogle = function() {
        var cat = localStorage.getItem("token");
        $localStorage.token = cat;
        if($rootScope.selectedTemplateRedirectResume){
            $http({
                method: 'POST',
                url: urls.BASE_API + '/templateid',
                data:{'name': $rootScope.templateNamePay,'id': $rootScope.templateIdPay}
            }).then(function myFunc(res) {
                if(res.data.error){}
            });

            $location.path('/resume');
        }else{
            $location.path('/template');
        }

        // alert('5');
        // $location.path('/resume');
        //  $rootScope.returnBackButton = false;
        //  $location.path('/resume');
        //
        // if($rootScope.selectedTemplateRedirectResume){
        //
        //     $location.path('/resume');
        // }else{
        //     $location.path('/template');
        // }
       // GPlusAuthService.signIn();
    };

    $scope.signInLinkedin = function(){
        LinkedinService.signInLinkedinFunction();
    };

    var vm = $scope;
    var url = "api/upload";
    var config = { headers: {
        "Content-Type": undefined,
    }
    };

    $rootScope.haveResume = false;

    $scope.upload = function() {
        $rootScope.letBillingPage = true;
        setTimeout(function(){
                var ww = new FormData();
                ww.append('file',$scope.files[0]);
                $http.post(url, ww, config).
                then(function(response) {
                    $scope.myStyleDivice={background:'#1bc873'};
                    $rootScope.haveResume = true;
                    $location.path('/billing');

                }).catch(function(response) {
                    vm.result = "ERROR "+response.status;
                });
        },50);
    };

    $rootScope.letBillingPage = false;
    // $scope.continueToBilling = function() {
    //
    //     if($rootScope.haveResume){
    //         var countUp = function() {
    //             $location.path('/billing');
    //         };
    //         $timeout(countUp, 1200);
    //         $rootScope.letBillingPage = true;
    //         $scope.myStyle={background:'#1bc873'};
    //     }
    // };

    $scope.UploadLeterToBilling = function(){
        $rootScope.letBillingPage = true;
        $rootScope.haveResume = true;
        $("#uplad_leter_id").removeClass("a_button_margin_bottom_unique");
        $rootScope.myStyleUploadLeter={'background':'#1bc873'};
        $location.path('/billing');
    }

});
app.directive("myFiles", function($parse) {
    return function linkFn (scope, elem, attrs) {
        elem.on("change", function (e) {
            scope.$eval(attrs.myFiles + "=$files", {$files: e.target.files});
            scope.$apply();
        });
    };
});



