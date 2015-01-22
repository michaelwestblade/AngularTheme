/**
 * Created by Michael Westblade on 9/27/14.
 */
// add a controller
myapp.controller('PostController', ['$scope','post','$state',function($scope,post,$state){
    $scope.post = post;
    $scope.postId = "post_"+post.ID;
    $scope.postUrl = $state.href();
    $scope.contentLoaded = true;
}]);