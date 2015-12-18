app.controller('articlesUploadCtrl',['$scope','$stateParams', 'FileUploader', function ($scope,$stateParams,FileUploader, $http,$rootScope, $state, $timeout,cfpLoadingBar) {
  $scope.catalogId = $stateParams.catalogId;
  $scope.catalogName = $stateParams.catalogName;
  $scope.catalogCategory = $stateParams.catalogCategory;
 var uploader = $scope.uploader = new FileUploader({
            url: '../web/app_dev.php/api/uploads/article'
        });


 // FILTERS

    

}]);