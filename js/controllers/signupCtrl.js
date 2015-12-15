app.controller('signupCtrl', function($scope,$http) {
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
});