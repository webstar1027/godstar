app.controller("templateController",function($scope,$http,$location,$window, $anchorScroll,$rootScope,$localStorage,urls){

   // $location.path('/resume');

    // if($rootScope.selectedTemplateRedirectResume && $localStorage.token){
    //     alert('s');
    //     $location.path('/resume');
    // }

    myfunc();

    function myfunc() {
        $http({
            method: 'GET',
            url: urls.BASE_API + '/user'
        }).then(function (res) {
            $rootScope.user = res.data.user;
        }).catch(function (res) {});
    }


    $('html,body').animate({ scrollTop: 0 }, 0);
    $rootScope.selectedTemplateRedirectResume = false;
    $rootScope.bodyScrollHidden = '';
    $scope.templates = [
        {
            id:1,
            image:'assets/images/template1.png',
            icon:'assets/images/info-icon.png',
            imagePhone:'assets/images/template-on-phone.png',
            name:'Bedford',
            showAlert:false,
            url: 'templates/dallas/index.html#/home'
        },
        {
            id:2,
            image:'assets/images/template2.png',
            icon:'assets/images/info-icon.png',
            imagePhone:'assets/images/template-on-phone.png',
            name:'Windsor',
            showAlert:false,
            url: 'templates/austin/index.html'
        },
        {
            id:3,
            image:'assets/images/template3.png',
            icon:'assets/images/info-icon.png',
            imagePhone:'assets/images/template-on-phone.png',
            name:'Atlantic',
            showAlert:false,
            url: 'templates/nashville/index.html'
        },
        {
            id:4,
            image:'assets/images/template4.png',
            icon:'assets/images/info-icon.png',
            imagePhone:'assets/images/template-on-phone.png',
            name:'Beacon',
            showAlert:false,
            url: 'templates/seattle/index.html'
        },
        {
            id:5,
            image:'assets/images/template5.png',
            icon:'assets/images/info-icon.png',
            imagePhone:'assets/images/template-on-phone.png',
            name:'Hawthorne',
            showAlert:false,
            url: 'templates/denver/index.html'
        },
        {
            id:6,
            image:'assets/images/template5.png',
            icon:'assets/images/info-icon.png',
            imagePhone:'assets/images/template-on-phone.png',
            name:'Fillmore',
            showAlert:false,
            url: 'templates/sanfrancisco/index.html'
        },
        {
            id:7,
            image:'assets/images/template5.png',
            icon:'assets/images/info-icon.png',
            imagePhone:'assets/images/template-on-phone.png',
            name:'Monroe',
            showAlert:false,
            url: 'templates/atlanta/index.html'
        },
        {
            id:8,
            image:'assets/images/template5.png',
            icon:'assets/images/info-icon.png',
            imagePhone:'assets/images/template-on-phone.png',
            name:'Sunset',
            showAlert:false,
            url: 'templates/chicago/index.html'
        }
    ];


    // if($location.absUrl() == urls.BASE + "/template#!/"){}

    var xxj = $location.absUrl().split('/');

    if(xxj.length == 5){

        var templateNumber = xxj[4];

        angular.forEach($scope.templates, function(value){
            if(value.id == templateNumber){
                $scope.templatecurr = {
                    'image':value.image,
                    'name':value.name,
                    'url':value.url
                }
            }

        })
    }


    var templatePath = $location.path();
    var templatePathCount = templatePath.split("/");


    if(templatePathCount.length == 3){

        var templateNumber = templatePathCount[2];

        angular.forEach($scope.templates, function(value){
            if(value.id == templateNumber){
                $scope.templatecurr = {
                    'image':value.image,
                    'name':value.name,
                    'url':value.url
                }
            }
        });
    }
    $rootScope.returnBackButton=false;
    $rootScope.templateIdPay = '';
    $rootScope.templateNamePay = '';

    $scope.selectedTemplate = function($id,$name) {
        $rootScope.templateIdPay = $id;
        $rootScope.templateNamePay = $name;

        if($localStorage.token){
            $rootScope.selectedTemplateRedirectResume = true;

            $http({
                method: 'POST',
                url: urls.BASE_API + '/templateid',
                data:{'name': $rootScope.templateNamePay,'id': $rootScope.templateIdPay}
            }).then(function myFunc(res) {
                if(res.data.error){}
            });

            $location.path('resume');

        }else{
            if($rootScope.returnBackButton){
                $location.path('template');
            }else{
                $rootScope.selectedTemplateRedirectResume = true;
                $rootScope.returnBackButton = true;
                $location.path('signup');
            }
        }
    };

    $scope.template_alert_1 = false;
    $scope.templateAlert = function(id) {
      // $rootScope.bodyScrollHidden = {'overflow-y':'hidden'};
        angular.forEach($scope.templates, function(value){
            if(value.id == id){
                $scope.alertImage = value.image;
                $scope.LLshowAlert = true;
                $scope.alertId = value.id;
                value.showAlert = true;
            }
        });

       // if($localStorage.token){
        $rootScope.selectedTemplateRedirectResume = true;
            var real_path =   urls.BASE +'template/'+ '#!' + '/' + id;
            $window.open( real_path);
       // }else{
        //    $location.path('signup');
        //}

    };
    $scope.focuse = function(id) {
        $rootScope.bodyScrollHidden = {};
        angular.forEach($scope.templates, function(value){
            if(value.id == id){
                $scope.alertImage = '';
                $scope.LLshowAlert = false;
            }
        });
    };
    $scope.pageSize=8;
    $scope.currentPage=1;
    var countItem = $scope.templates.length;
    var countPage = Math.ceil((countItem)/$scope.pageSize);
    var range = [];
    for(var i=1;i<countPage+1;i++) {
        range.push(i);
    }
    $scope.rangePage = range;
    $scope.nextPage = function(i){
        $scope.currentPage=i;
        $scope.pageSize=8;
        var nessesoryCount = i * $scope.pageSize;
        var ii = nessesoryCount - countItem;
        if(ii > $scope.pageSize){
            $scope.pageSize = ii;
        }
    };

    $scope.prevAllPage = function(){
        $scope.pageSize=8;
        $scope.currentPage=1;
    };
    $scope.prevNumberPage = function(){
        if($scope.currentPage != 1){
            $scope.pageSize = 8;
            $scope.currentPage--;
        }
    };
    $scope.nextNumberPage = function(){
        $scope.pageSize = 8;
        var lastStop = Math.ceil( countItem/$scope.pageSize);
        if($scope.currentPage != lastStop){
            $scope.pageSize = 8;
            $scope.currentPage++;
        }
    };
    $scope.nextAllPage = function(){
        $scope.pageSize=8;
        var mnac = Math.ceil( countItem/$scope.pageSize);
        var lastCount = mnac*$scope.pageSize;
        var lastCountNumber = $scope.pageSize - ( lastCount - countItem );

        if(lastCountNumber != 0 && $scope.currentPage != mnac ){
            $scope.pageSize = lastCountNumber;
            $scope.currentPage = mnac;
        }
    };
});

