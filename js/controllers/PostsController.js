/**
 * Created by Michael Westblade on 9/27/14.
 */
// add a controller
myapp.controller('PostsController', ['$scope','$http',function($scope,$http){
    $scope.posts = [];

    // load posts from the wordpress api
    $http({
        method: 'GET',
        url: $scope.api+'posts',
        params: {
            json: 'get_posts'
        }
    }).success(function(data,status,headers,config){
            $scope.posts = data;
        }).error(function(data,status,headers,config){

        });
}]);