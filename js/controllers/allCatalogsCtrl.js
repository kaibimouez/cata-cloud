 app.controller('allCatalogsCtrl',function($scope,$http,$stateParams,$location,$state){
 var result = $http.post('../web/app_dev.php/api/all/catalogs.json' )
    result.success(function(data, status, headers, config) {

     $scope.logo = data;
           
    });
    result.error(function(data, status, headers, config) {
            
    }); 
});