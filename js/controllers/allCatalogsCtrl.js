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
    	var likes =JSON.parse(data);
	    var result = $http.post('../web/app_dev.php/api/nbs/likes/catalogs/set',likes )
	    result.success(function(data, status, headers, config) {
	    

	    });
	    result.error(function(data, status, headers, config) {
	      
	    }); 
  }
});