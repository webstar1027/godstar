app.controller("billingController",['$scope','urls','$timeout','$rootScope','$localStorage','$location','$http', function($scope,urls,$timeout,$rootScope,$localStorage,$location, $http) {

    $scope.notValidDomainName = false;
    $scope.notValidDomainNameTrue = false;

    $rootScope.haveResume = false;
    $rootScope.selectedTemplateRedirectResume = false;
    $rootScope.myStyleLinkedin={};
    $rootScope.myStyleDivice={};
    $rootScope.myStyleUploadLeter={};
    $rootScope.myStyle={};

    // +++
    if(!$rootScope.letBillingPage){
        $location.path('/resume');
    }

    if($location.path() == '/domain-name/'){
        $http({
            method: 'GET',
            url: urls.BASE_API + '/user'
        }).then(function (res) {
            $rootScope.user = res.data.user;
        })
    }

    $scope.stripePayment = true;
    var stripe = true;
    var payPal = false;
    $scope.paymentStripe = function(){
        $scope.stripePayment = true;
        stripe = !stripe;
        if(stripe){
            payPal = false;
        }else{
            payPal = true;
        }
    };

    $scope.paymentPayPal = function () {
        $scope.stripePayment = false;
        $scope.errorMessageWhenInputClear ={};

        payPal = !payPal;
        if(payPal){
            stripe = false;
        }else{
            stripe = true;
        }

    };

    //var num=1;
    //$scope.paymentPayPal = function(){
      //  num = num + 1;
        // $scope.stripePayment = false;
        //
        // payPal = !payPal;
        // if(payPal){
        //     stripe = false;
        // }else{
        //     stripe = true;
        // }
        //
        // if(paypal.Button.render){
        //     if(num<3){
        //         paypal.Button.render({
        //             env: 'sandbox', // sandbox | production
        //
        //             style: {
        //                 label: 'checkout',
        //                 size:  'small',    // small | medium | large | responsive
        //                 shape: 'pill',     // pill | rect
        //                 color: 'blue'      // gold | blue | silver | black
        //             },
        //
        //             // PayPal Client IDs - replace with your own
        //             // Create a PayPal app: https://developer.paypal.com/developer/applications/create
        //             client: {
        //                 sandbox:    'AeE_zl2PXPj3WbUiruxbAOjhpHJ-z0C8cNWe2_JtK5UWYLdFdYfhN-og9ttDbGhxWPFVR_KyQcYRVLG1',
        //                 production: '<insert production client id>'
        //             },
        //
        //             // Show the buyer a 'Pay Now' button in the checkout flow
        //             commit: true,
        //
        //             // payment() is called when the button is clicked
        //             payment: function(data, actions) {
        //                 // Make a call to the REST api to create the payment
        //                 return actions.payment.create({
        //                     payment: {
        //                         transactions: [
        //                             {
        //                                 amount: { total: '0.01', currency: 'USD' }
        //                             }
        //                         ]
        //                     }
        //                 });
        //             },
        //
        //             // onAuthorize() is called when the buyer approves the payment
        //             onAuthorize: function(data, actions) {
        //
        //                 // Make a call to the REST api to execute the payment
        //                 return actions.payment.execute().then(function(result) {
        //                     console.log(result);
        //                     window.alert('Payment Complete!');
        //                     $http({
        //                         method: 'POST',
        //                         url: urls.BASE_API + '/paypal',
        //                         data: result
        //                     }).then(function (res) {
        //                         console.log(res);
        //                         //$location.path('/select-hosting');
        //                     });
        //                 });
        //             }
        //
        //         }, '#paypal-button');
        //     }
        //
        // }
   // };
    Stripe.setPublishableKey('pk_test_d94FGjGYcKoMxFlcpNsDANTZ');
    $scope.errorMessageWhenInputClear ={};
    $scope.selectHostingPlan = function(){
        $scope.errorMessageWhenInputClear ={};
        $scope.errorCodeValidationMessage = {};

        if(typeof ($scope.cvv) == 'undefined'){
            $scope.errorMessageWhenInputClear ={display:'block'};
            return false;
        }

            var cardNumber = angular.element($('#cardnumber')).val();
            cardNumber.split(' ').join('');

            $rootScope.cartNumberR = cardNumber;
            $rootScope.exp_monthR = $scope.expMonth;
            $rootScope.exp_yearR = $scope.expYear;
            $rootScope.cvcR = $scope.cvv;

            var fullName = $scope.fullName;
            $http({
                method: 'POST',
                url: urls.BASE_API + '/fullname',
                data: {'name': fullName}
            }).then(function (res) {});

            Stripe.card.createToken({
                number: $rootScope.cartNumberR,
                cvc: $scope.cvv,
                exp_month: $scope.expMonth,
                exp_year: $scope.expYear
            }, stripeResponseHandler);
            return false;
    };

    $scope.selectPayPalPlan = function(){
        $scope.errorCodeValidationMessage = {};
        $scope.errorMessageWhenInputClear ={};
    };

    var stripeResponseHandler = function(status, response) {
        if (response.error) {
            $scope.errorCodeValidationMessage = {display:'block'};
            if(response.error.message == 'Missing required param: card[number].'){
                $scope.errorCardMessage = 'Please enter a valid card number.';
            }else{
                $scope.errorCardMessage = response.error.message;
            }
        } else {
            $http({
                method: 'POST',
                url: urls.BASE_API + '/stripe',
                data: {'token': response.id}
            }).then(function (res) {
                $location.path('/select-hosting');
            });
        }
    };
    $scope.unclickButton = true;

    $scope.selectSubsciption = function(plan){

        if(plan == 1499 ){
            $scope.gifFirst = {display:'block'};
        }else{
            $scope.gifSecond = {display:'block'};
        }

        $rootScope.plan = plan;

        Stripe.card.createToken({
            number: $rootScope.cartNumberR,
            cvc: $rootScope.cvcR,
            exp_month: $rootScope.exp_monthR,
            exp_year: $rootScope.exp_yearR
        }, stripeResponseHandlerPlan);
        return false;


        // if($scope.stripePayment){
        //     $http({
        //         method: 'POST',
        //         url: urls.BASE_API + '/stripe/plan',
        //         data: {'plan': plan , 'cart': $rootScope.cartNumberR,'month': $rootScope.exp_monthR,'year':$rootScope.exp_yearR,'cvc': $rootScope.cvcR}
        //     }).then(function (res) {
        //         $scope.unclickButton = false;
        //         $scope.siteprogressColor = {background:'#2b87f9'};
        //         console.log("TRUE " + res)
        //         $location.path('/domain-name')
        //     });
        // }
    };
    var stripeResponseHandlerPlan = function(status, response) {
        if (response.error) {
          //  console.log(response)
        } else {
            $http({
                method: 'POST',
                url: urls.BASE_API + '/stripe/plan',
                data: {'plan': $rootScope.plan ,'token': response.id}
            }).then(function (res) {
                $scope.gifFirst = {};
                $scope.gifSecond = {};
                $scope.unclickButton = false;
                $scope.siteprogressColor = {background:'#2b87f9'};
                $location.path('/domain-name')
            });
        }
    };

    var timeInMs = 299;
    var countUp = function() {
        if(timeInMs == 0){
            timeInMs = 299;
          //  $location.path('/timelimite')
        }
        var minute = Math.floor(timeInMs/60);
        var second = timeInMs-(minute*60);
        timeInMs-=1;
        $scope.timeInMsSec= minute + ":" + second;
        if(minute == 0){
            $scope.timeInMsSec=  second;
        }
        $timeout(countUp, 1000);
    };
    $timeout(countUp, 1000);
    $scope.validationText ='';
    $scope.searchNameInput = 'SEARCH';
    $scope.domainNameIsset = '';
    $scope.domainNameCheap = function(e){
        var domainName = $scope.domainName;

        $scope.gifSearch = {display:'block'};
        $scope.searchNameInputName = $scope.searchNameInput;


        if($scope.domainNameIsset != $scope.domainName){
            $scope.backgroudColorGreen = {background:'#2b87f9'};
            domainName = $scope.domainName;
        }else{
            if($scope.searchNameInput == 'GET IT!'){
                Stripe.card.createToken({
                    number: $rootScope.cartNumberR,
                    cvc: $rootScope.cvcR,
                    exp_month: $rootScope.exp_monthR,
                    exp_year: $rootScope.exp_yearR
                }, stripeResponseHandlerDomain);
                return false;
            }
        }


        $scope.searchNameInput = '';
        $scope.backgroudColorGreen = {background:'#2b87f9'};


        $http({
            method: 'POST',
            url: urls.BASE_API + '/domain/name',
            dataType:'json',
            data: {'name': $scope.domainName}
        }).then(function (res) {
            $scope.gifSearch = {};
            $scope.notValidDomainName = false;
            $scope.notValidDomainNameTrue = false;
            $scope.backgroudColorGreen = {};
            $scope.domainInputColorGr = {};
            $scope.searchNameInput = '';
            $scope.noValidDisplayBlock = {display:'block'};

            if(res.data.error){
                $scope.searchNameInput = 'Search';
                $scope.backgroudColorGreen = {background:'#cd2f15'};
                $scope.notValidDomainName = true;
                $scope.domainNameIsset = 'Please write right domain. example: test.com :: ';
                return false;
            }

            if(res.data.text.validate == 'true'){
                $scope.backgroudColorGreen = {'background':'#1db954','font-family':'Lato_Regular','font-size':'15px'};
                $scope.searchNameInput = 'GET IT!';
                $scope.notValidDomainNameTrue = true;
                $scope.domainNameIsset = res.data.text.domainName;
            }else{
                $scope.searchNameInput = 'Search';
                $scope.backgroudColorGreen = {background:'#cd2f15'};
                $scope.notValidDomainName = true;
                $scope.domainNameIsset = res.data.text.domainName;
            }
        }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
        }).catch(function (res) {
           // console.log(res);
        });
    };

    $scope.buyDomainNow = function(){
        Stripe.card.createToken({
            number: $rootScope.cartNumberR,
            cvc: $rootScope.cvcR,
            exp_month: $rootScope.exp_monthR,
            exp_year: $rootScope.exp_yearR
        }, stripeResponseHandlerDomain);
        return false;
    };

    var stripeResponseHandlerDomain = function(status, response) {
        if (response.error) {
           // console.log(response)
        } else {
            $http({
                method: 'POST',
                url: urls.BASE_API + '/domain/pay',
                data: {'token': response.id , 'name':$scope.domainName}
            }).then(function (res) {
                $scope.gifSearch = {};
                $location.path('/timelimite')
            });
        }
    };

    $scope.submitGGfunction = function (e) {
        $scope.domainNameCheap();
        return false;
    };

    $scope.chandeDomainGGfunction = function(){
        $scope.backgroudColorGreen = {background:'#2b87f9'};
        $scope.searchNameInput = 'SEARCH';
    };

}]);

app.filter('myFormat', function() {
    return function(x) {
        var split = x.split(" ");
        var txt = split.join('');
        txt.toLowerCase();
        return txt;
    };
});

