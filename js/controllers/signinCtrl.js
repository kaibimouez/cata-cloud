app.controller('signinCtrl',function($scope ,$stateParams,$http,$location,$state){
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
});

