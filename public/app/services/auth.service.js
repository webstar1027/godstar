
app.factory('AuthService', ['$http', '$localStorage', 'urls', '$rootScope','$location', function ($http, $localStorage, urls, $rootScope,$location) {
    // function urlBase64Decode(str) {
    //     var output = str.replace('-', '+').replace('_', '/');
    //     switch (output.length % 4) {
    //         case 0:
    //             break;
    //         case 2:
    //             output += '==';
    //             break;
    //         case 3:
    //             output += '=';
    //             break;
    //         default:
    //             throw 'Illegal base64url string!';
    //     }
    //     return window.atob(output);
    // }
    //
    // function getClaimsFromToken() {
    //     var token = $localStorage.token;
    //     var user = {};
    //     if (typeof token !== 'undefined' && token != false) {
    //         var encoded = token.split('.')[1];
    //         user = JSON.parse(urlBase64Decode(encoded));
    //     }
    //     return user;
    // }
    //
    // var tokenClaims = getClaimsFromToken();

    return {
        socialGroup: function(prov, success){
            $http({
                method: 'GET',
                url: urls.BASE_API + '/login/'+prov,
                dataType: "jsonp"
            }).then(success);
        },
        login: function (loginForm, success) {
            $http({
                method: 'POST',
                url: urls.BASE_API + '/login',
                data: loginForm
            }).then(success);
        },
        signUp: function (registerForm, success) {
            $http({
                method: 'POST',
                url: urls.BASE_API + '/signup',
                data: registerForm
            }).then(success);
        },
        logout: function () {
         //   tokenClaims = {};
            $rootScope.haveResume = false;
            $rootScope.selectedTemplateRedirectResume = false
            $rootScope.myStyleLinkedin={};
            $rootScope.myStyleDivice={};
            $rootScope.myStyleUploadLeter={};
            $rootScope.myStyle={};
            delete $localStorage.token;
            delete $rootScope.user;
            $location.path('/');
        },
        getTokenClaims: function () {
           // return tokenClaims;
        },
        getUser: function () {
            $http({
                method: 'GET',
                url: urls.BASE_API + '/user'
            }).then(function (res) {
                $rootScope.user = res.data.user;
                var path = $location.path();
                if (res.data.error) {
                  //  tokenClaims = {};
                    delete $localStorage.token;
                    $location.path(path);
                    // if ($location.path() !== '/login' && $location.path() !== '/signup' && $location.path() !== '/resume' && $location.path() !== '/' && $location.path() !== '/billing/' && $location.path() !== '/domain-name/' && $location.path() !== '/select-hosting/') {
                    //     $location.path('/');
                    // }
                }

                if (!$rootScope.user.verified) {
                    /*swal('Please verify your email', 'Your verification email has been sent', 'success');*/
                }

                if ($location.path() === '/login' || $location.path() === '/signup') {
                    $location.path('/resume');
                }
            }).catch(function (res) {
                if(typeof res.data != 'undefined' ){
                    if (res.data.error) {
                      //  tokenClaims = {};
                        delete $localStorage.token;
                        if ($location.path() !== '/login' && $location.path() !== '/signup' && $location.path() !== '/resume' && $location.path() !== '/' && $location.path() !== '/billing/' && $location.path() !== '/domain-name/' && $location.path() !== '/select-hosting/'  && $location.path() !== '/terms-of-use' && $location.path() !== '/privacy-policy') {
                            $location.path('/');
                        }else {
                            var path = $location.path();
                            $location.path(path);
                            return false;
                        }
                    }
                }
            });
        },
        isLoggedIn: function () {
            var path = $location.path();
            if (typeof $localStorage.token !== 'undefined' && $localStorage.token !== false) {
                $location.path(path);
            } else if ($location.path() !== '/login' && $location.path() !== '/signup' && $location.path() !== '/' && $location.path() !== '/resume' && $location.path() !== '/template' && $location.path() !== '/template/1' && $location.path() !== '/template/2' && $location.path() !== '/template/3' && $location.path() !== '/template/4' && $location.path() !== '/template/5' && $location.path() !== '/template/6' && $location.path() !== '/template/7' && $location.path() !== '/template/8' && $location.path() !== '/template/' && $location.path() !== '/billing/' && $location.path() !== '/domain-name/' && $location.path() !== '/select-hosting/' && $location.path() !== '/terms-of-use' && $location.path() !== '/privacy-policy' && $location.path() !== '/timelimite' && $location.path() !== 'resume' && $location.path() !== '/faq' && $location.path() !== '/about') {
                $location.path('/');
            } else {
                var path = $location.path();
                $location.path(path);
                return false;
            }
        }
    };
}]);