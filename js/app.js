var app = angular.module('app', ['ngSanitize','ui.router','ngFileUpload','angular-loading-bar','angularFileUpload']);

app.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })
app.config(function($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise('/home');
    $stateProvider
      
///////////////////// home ////////////////////////////
 .state('home', {
            url: '/home',
            templateUrl: '../views/home.html'  
        })
        .state('home.log', {
              url: '/log',
              template: '<div ui-view class="formulaire"></div>',
              title: 'sign in'
            })
         .state('home.log.log', {
              url: '/log',
              templateUrl: '../views/signin.html',
              title: 'sign in'
            })
         .state('home.signupUser', {
            url: '/signupUser',
            templateUrl: '../views/signup_user.html'  
        }).state('home.signupCompany', {
            url: '/signupCompany',
            templateUrl: '../views/signup_company.html'  
        })
///////////////////////////////////////////////////////////////        
           /* .state('userProfile', {
                url: '/userProfile',
                params : { id: null , type: null },
                templateUrl: '../views/userProfile.html',
                controller: 'userProfileController'
            })*/

        .state('companyProfile', {
            url: '/companyProfile',
            templateUrl: '../views/companyProfile.html'
        })            
        .state('companyProfile.create', {
              url: '/create',
              params : { identifier: null },
              template: '<div ui-view class="fade-in-up"></div>',
              title: 'create catalog'
            })
        .state('companyProfile.create.new', {
              url: '/new',
              params : { identifier: null },
              templateUrl: '../views/createCatalog.html'  
                  })
        .state('companyProfile.catalogs', {
              url: '/catalogs',
              template: '<div ui-view class="fade-in-up"></div>',
              title: 'my Catalogs List'
            })
        .state('companyProfile.catalogs.show', {
              url: '/show',
              templateUrl: '../views/myCatalogs.html' 
                  })
        .state('companyProfile.catalogs.all', {
              url: '/showAll',
              templateUrl: '../views/allCatalogs.html'
                  })
        .state('companyProfile.articles', {
              url: '/articles',
              template: '<div ui-view class="fade-in-up"></div>'
              })
        .state('companyProfile.articles.new', {
              url: '/new',
              params : { catalogId: null ,catalogName: null , catalogCategory:null },
              templateUrl: '../views/articlesUpload.html'
             
          })    
        /*.state('companyProfile.articles.new', {
              url: '/new',
              params : { catalogName: null , catalogCategory:null },
              templateUrl: '../views/createArticle.html'
              //controller : 'createArticleCtrl'
              })*/

        
        .state('logout', {
            url: '/logout',
            controller:'logoutCtrl'
           
        })
   
}); 
app.controller('logoutCtrl',function($scope,$state,$http,$stateParams,$location,cfpLoadingBar){
  var result = $http.post('../web/app_dev.php/api/logout')
      result.success(function(data, status, headers, config) {
        $state.go("home.log.log");
      });
      result.error(function(data, status, headers, config) {
        $state.go("home.log.log");
              
      }); 
});


/*app.controller('registrationController', function($scope,$http) {
      var currentDate = new Date();
      var creationDate = currentDate.getDate()+'-'+(currentDate.getMonth()+1)+'-'+currentDate.getFullYear() +' @ ' + currentDate.getHours() + ":"  
                + currentDate.getMinutes() + ":" 
                + currentDate.getSeconds(); 

    $scope.userSignUp = function() {
      var data ='{"fos_user_registration_form":{ '+'"email"'+':'+'"'+$scope.user.email+'",'
                                             +'"username"'+':'+'"'+$scope.user.username+'",'
                                             +'"creationDate"'+':'+'"'+ creationDate +'",'
                                             +'"type"'+':'+'"'+'user'+'",'
                                             +'"plainPassword"'+':{'+'"first"'+':'+'"'+$scope.user.plainPasswordFirst+'",'
                                                                    +'"second"'+':'+'"'+$scope.user.plainPasswordSecond+'"'+'}}}';
         var d=JSON.parse(data);
         var result = $http.post('../web/app_dev.php/register/', d )
          result.success(function(data, status, headers, config) {
            $scope.singupStatus = data;
          });
          result.error(function(data, status, headers, config) {
            $scope.singupStatus = data;
          }); 
      }

      $scope.companySignUp = function() {
        var data ='{"fos_user_registration_form":{ '+'"email"'+':'+'"'+$scope.company.companyEmail+'",'
                                             +'"username"'+':'+'"'+$scope.company.companyName+'",'
                                             +'"type"'+':'+'"'+'company'+'",'
                                             +'"creationDate"'+':'+'"'+ creationDate +'",'
                                             +'"companyPhone"'+':'+'"'+ $scope.company.companyPhone +'",'
                                             +'"companyAdress"'+':'+'"'+ $scope.company.companyAdress +'",'
                                             +'"plainPassword"'+':{'+'"first"'+':'+'"'+$scope.company.companyPlainPasswordFirst+'",'
                                                                    +'"second"'+':'+'"'+$scope.company.companyPlainPasswordSecond+'"'+'}}}';
         var d=JSON.parse(data);
         var result = $http.post('../web/app_dev.php/register/', d )
          result.success(function(data, status, headers, config) {
            $scope.singupStatus = data;
          });
          result.error(function(data, status, headers, config) {
            $scope.singupStatus = data;
          }); 
      }

});*/
/*app.controller('createArticleCtrl',function($scope ,$stateParams,$http,$location,$state){
  $scope.identifier = $stateParams.identifier;
});*/

/*app.controller('signinController',function($scope ,$stateParams,$http,$location,$state){

  $scope.Signin = function() {
    var data ='{'+'"email"'+':'+'"'+$scope.user.email+'",'
                 +'"password"'+':'+'"'+$scope.user.password+'"'+"}";

    var d=JSON.parse(data);
    var result = $http.post('../web/app_dev.php/api/login', d )

    result.success(function(data, status, headers, config) {
          if(data.type == "user"){
            $state.transitionTo('userProfile',{
                id:data.id
            },{
                reload: true,
                notify: true
              });
          }
          else  if(data.type == "company") {
             $state.transitionTo('companyProfile',{
                id:data.id
            },{
                reload: true,
                notify: true
              });
          
          }
    });
    result.error(function(data, status, headers, config) {
      $scope.signinFailure = data.error;
    });
  }  
});*/




/*app.controller('userProfileController',function($scope,$http,$stateParams,$location,$state){

  var res = $http.post("../web/app_dev.php/api/user.json");
   res.success(function(data, status, headers, config) {
            $scope.items = data;
    });
    res.error(function(data, status, headers, config) {
            
    });

   var result = $http.post('../web/app_dev.php/api/connecteds/is' )

    result.success(function(data, status, headers, config) {
            $state.go("userProfile"); 

    });
    result.error(function(data, status, headers, config) {
             $state.go("home");
    });
  
});
app.controller('companyProfileController',function($scope,$http,$stateParams,$location,$state){

   var res = $http.post("../web/app_dev.php/api/user.json");
   res.success(function(data, status, headers, config) {
            $scope.items = data;
    });
    res.error(function(data, status, headers, config) {
            
    });  
   var result = $http.post('../web/app_dev.php/api/connecteds/is' )

    result.success(function(data, status, headers, config) {
            $state.go("companyProfile");   
    });
    result.error(function(data, status, headers, config) {
             $state.go("home");
    });
  
});
app.controller('uploadCtrl',['$scope', '$http','Upload', '$timeout', function ($scope,$http, Upload, $timeout) {
    var currentDate = new Date();
    var creationDate = currentDate.getDate()+'-'+(currentDate.getMonth()+1)+'-'+currentDate.getFullYear() +' @ ' + currentDate.getHours() + ":"  
                + currentDate.getMinutes() + ":" 
                + currentDate.getSeconds(); 
   $scope.uploadPic = function(file,catalogName,catalogCategory) {
    file.upload = Upload.upload({
      url: '../web/app_dev.php/api/upload',
      data: {file: file, catalogName: catalogName, catalogCategory: catalogCategory, creationDate: creationDate},
    });
  
}
}]);*/


