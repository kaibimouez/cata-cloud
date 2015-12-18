app.controller('myCatalogsCtrl',function($scope,$http,$rootScope,$stateParams,$location,$state){
    var title = $rootScope.title;
      $rootScope.title = "my catalogs ";
      $scope.$on('$destroy', function(){$rootScope.title = title});

    var result = $http.post('../web/app_dev.php/api/catalogs.json' )
    result.success(function(data, status, headers, config) {
   		$scope.logo = data;
    });
    result.error(function(data, status, headers, config) {
            
    }); 
    });   