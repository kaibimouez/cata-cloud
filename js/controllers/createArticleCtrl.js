app.controller('createArticleCtrl', function ($scope,$http, Upload, $state, $timeout,$stateParams) {
	$scope.catalogName = $stateParams.catalogName;
   $scope.catalogCategory = $stateParams.catalogCategory;
   $scope.c = false;
});