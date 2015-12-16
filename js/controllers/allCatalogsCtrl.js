 app.controller('allCatalogsCtrl',function($scope,$http,$stateParams,$location,$state,cfpLoadingBar){
 var result = $http.post('../web/app_dev.php/api/all/catalogs.json' )
    result.success(function(data, status, headers, config) {

     $scope.logo = data;
           
    });
    result.error(function(data, status, headers, config) {
            
    });

    $scope.catalogNbLikes = function(catalogId , companyId) {
    	var data ='{'+'"catalogId"'+':'+'"'+catalogId+'",'
                 +'"companyId"'+':'+'"'+companyId+'"'+"}";
    	var d=JSON.parse(data);
	    var result = $http.post('../web/app_dev.php/api/nbs/likes/catalogs/set',d )
	    result.success(function(data, status, headers, config) {
	      $scope.singupStatus = data;
	    });
	    result.error(function(data, status, headers, config) {
	      $scope.singupStatus = data;
	    }); 
  }
});