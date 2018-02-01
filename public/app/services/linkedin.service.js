app.factory('LinkedinService',['$http','$window', '$localStorage', 'urls', '$rootScope','$location','$q', function($http,$window, $localStorage, urls, $rootScope,$location,$q) {
    var obj = {};
    obj.signInLinkedinFunction =  function () {
        IN.User.authorize(function(){
            // onLinkedInLoad();
        });
        IN.Event.on(IN, "auth", function() {
            onLinkedInLogin();
        });

            function onLinkedInLogin() {

                if($rootScope.userExist){
                    IN.API.Profile("me")
                    // .fields(["id", "firstName", "lastName", "pictureUrl", "publicProfileUrl", "emailAddress"])
                        .fields(["firstName","lastName",'maidenName',"headline","positions",
                            "location","picture-urls::(original)","emailAddress",
                            'phone-numbers','industry',
                            'associations','interests','publications','patents','languages',
                            'skills','certifications', 'educations','courses','volunteer','following','suggestions',
                            "summary","specialties","site-standard-profile-request","public-profile-url",
                            'distance','num-connections','current-share','date-of-birth'
                        ])
                        .result(function(result) {
                            $rootScope.linkedinResumeInfo = result.values;
                            $http({
                                method: 'POST',
                                url: urls.BASE_API +'/linkedin/resume/user',
                                data: {resume:result.values,id:$rootScope.user['id']}
                            }).then(function myFunc() {
                                $rootScope.returnBackButton = false;
                                $rootScope.myStyleLinkedin={background:'#1bc873'};
                                $rootScope.haveResume = true;
                                $location.path('/billing');
                            });
                        })
                        .error(function(err) {

                        });
                }else{
                    IN.API.Profile("me")
                        .fields([ "id","firstName","lastName",'maidenName',"headline","positions",
                            "location","picture-urls::(original)","emailAddress",
                            'phoneNumbers','industry',
                            'associations','interests','publications','patents','languages',
                            'skills','certifications', 'educations','courses','volunteer','following','suggestions',
                            "summary","specialties","site-standard-profile-request","public-profile-url",
                            'distance','num-connections','current-share','date-of-birth'
                        ])
                        .result(function(result) {
                            $rootScope.linkedinResumeInfo = result.values;
                            $http({
                                method: 'POST',
                                url: urls.BASE_API +'/linkedin/resume/info',
                                data: result.values
                            });

                            var lid =result.values[0]['id'];
                            var name = result.values[0]['firstName'] + ' ' +  result.values[0]['lastName'];
                            var email = result.values[0]['emailAddress'];
                            $http({
                                method: 'POST',
                                url: urls.BASE_API +'/login/linkedin/v1',
                                data:{'lid':lid,'name':name,'email':email}
                            }).then(function myFunc(res) {
                                if(res.data.error){
                                    this.signInLinkedinFunction()
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
                            });
                        })
                        .error(function(err) {

                        });
                }
            }
    };
    return obj;
}]);
