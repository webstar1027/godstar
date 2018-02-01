app.factory("GPlusAuthService",['$http', '$localStorage', 'urls', '$rootScope','$location','$q','$window', function($http, $localStorage, urls, $rootScope,$location,$q,$window) {

    var obj = {};
    obj.signIn =  function (){

        gapi.load('auth2', function(){
            auth2 = gapi.auth2.init({
                client_id: '546486351299-k762ctc95v9r026aued34bvfhc72v4b5.apps.googleusercontent.com',
                cookiepolicy: 'single_host_origin',
                scope: 'profile email'
            });
            var elem = document.getElementById('googleAlert');
            attachSignin(elem);
        });

        function attachSignin(element) {

            auth2.attachClickHandler(element, {},
                function(profile) {
                    $rootScope.returnBackButton = false;
                    var provider_id = profile.w3['Eea'];
                    var name = profile.w3['ig'];
                    var email = profile.w3['U3'];
                    $http({
                        method: 'POST',
                        url: urls.BASE_API +'/login/google/v1',
                        data:{'gid':provider_id,'name':name,'email':email}
                    }).then(function myFunc(res) {
                        if(res.data.error){
                            swal(res.data.error,null,'warning');
                        }else{
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
                    })
                }, function(error) {
                    // alert(JSON.stringify(error, undefined, 2));
                });
        }
    };

    return obj;

}]);