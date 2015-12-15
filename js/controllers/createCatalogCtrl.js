app.controller('createCatalogCtrl', function ($scope,$http, Upload, $state, $timeout) {
	$scope.createCatalog = function(file,catalogName,catalogCategory,startDate,endDate) {
		var currentDate = new Date();
    var creationDate = currentDate.getDate()+'-'+(currentDate.getMonth()+1)+'-'+currentDate.getFullYear() +' '+ currentDate.getHours() + ":"  
                + currentDate.getMinutes() + ":" 
                + currentDate.getSeconds(); 
    var res = file.upload = Upload.upload({
      url: '../web/app_dev.php/api/catalogs/create',
      data: {file: file, catalogName: catalogName, catalogCategory: catalogCategory, creationDate: creationDate, startDate:startDate ,endDate:endDate}
	});
    res.success(function(data, status, headers, config) {
      $scope.success = data;
	  });
    res.success(function(data, status, headers, config) {
      $scope.error = data;
    });
}
});