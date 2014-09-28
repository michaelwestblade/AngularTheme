/**
 * Created by Michael Westblade on 9/27/14.
 */
// add a controller
myapp.controller('PostController', ['$scope','post',function($scope,post){
    $scope.post = post;

    console.log(post);
}]);