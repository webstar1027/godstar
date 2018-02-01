app.factory('facebookService',['$http', '$localStorage', 'urls', '$rootScope','$location', function($http, $localStorage, urls, $rootScope,$location,$q) {
    return {
        getMyLastName: function() {
            FB.init({
                appId: '136310053646066',
                status: true,
                cookie: true,
                xfbml: true,
                version: 'v2.4'
            });

            FB.login(function(response) {
                if (response.authResponse) {
                    FB.api('/me', function(response) {
                        FB.api("/"+response.id+"/",{fields: 'first_name,last_name,email'},function (response) {
                            var urlff = "/login/facebook/v1";
                            var body = "fb="+response.id+"";
                            $http({
                                method: 'POST',
                                url: urls.BASE_API +'/login/facebook/v1',
                                data:{'fb':response.id,'name':response.first_name +' '+ response.last_name ,'email':response.email}
                            }).then(function myFunc(res) {
                                if(res.data.error){
                                    swal(res.data.error,null,'warning');
                                }else{
                                    $localStorage.token = res.data.token;
                                    $rootScope.returnBackButton = false;
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
                            })
                        });
                    });
                } else {
                    console.log('User cancelled login or did not fully authorize.');
                }
            }, {
                scope: 'public_profile,email', //user_photos
                return_scopes: true
            });
        }
    }
}]);
