/**
 * Created by Michael Westblade on 9/27/14.
 */
// add a controller
myapp.controller('PageController', ['$scope','page','PostsService','$state',function($scope,page,PostsService,$state){
    $scope.contentLoaded = false;
    $scope.page = page;
}]);