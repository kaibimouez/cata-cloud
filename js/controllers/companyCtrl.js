app.controller('companyCtrl', function ($scope,$http, Upload, $state, $timeout) {
   $scope.isConnected=function(){
   var res = $http.post("../web/app_dev.php/api/connecteds/is");
   res.success(function(data, status, headers, config) {
            $state.go('companyProfile.catalogs.all');
    });
    res.error(function(data, status, headers, config) {
             $state.go('home.log.log');
    }); 
    }; 
    $timeout($scope.isConnected,1);

   $scope.sideBarInfo=function(){
   var res = $http.post("../web/app_dev.php/api/user.json");
   res.success(function(data, status, headers, config) {
            $scope.items = data;
    });
    res.error(function(data, status, headers, config) {
            
    }); 
    }; 
    $timeout($scope.sideBarInfo, 20);

});