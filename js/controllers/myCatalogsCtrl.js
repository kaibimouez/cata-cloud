app.controller('myCatalogsCtrl',function($scope,$http,$stateParams,$location,$state){
    var result = $http.post('../web/app_dev.php/api/catalogs.json' )
    result.success(function(data, status, headers, config) {
   		$scope.logo = data;
    });
    result.error(function(data, status, headers, config) {
            
    }); 
    });   