app.controller('companyCtrl', function ($scope,$http, Upload, $state, $timeout) {
   $scope.isConnected=function(){
   var res = $http.post("../web/app_dev.php/api/connecteds/is");
   res.success(function(data, status, headers, config) {
            $state.go('companyProfile');
    });
    res.error(function(data, status, headers, config) {
             $state.go('home.log.log');
    }); 
    }; 
    $timeout($scope.isConnected,5 );

   $scope.sideBarInfo=function(){
   var res = $http.post("../web/app_dev.php/api/user.json");
   res.success(function(data, status, headers, config) {
            $scope.items = data;
    });
    res.error(function(data, status, headers, config) {
            
    }); 
    }; 
    $timeout($scope.sideBarInfo, 20);


  $scope.createCatalog = function(file,catalogName,catalogCategory) {
    var currentDate = new Date();
    var creationDate = currentDate.getDate()+'-'+(currentDate.getMonth()+1)+'-'+currentDate.getFullYear() +' '+ currentDate.getHours() + ":"  
                + currentDate.getMinutes() + ":" 
                + currentDate.getSeconds(); 
    file.upload = Upload.upload({
      url: '../web/app_dev.php/api/catalogs/create',
      data: {file: file, catalogName: catalogName, catalogCategory: catalogCategory, creationDate: creationDate},
    }); 
  }
});