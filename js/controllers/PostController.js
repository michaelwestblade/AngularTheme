/**
 * Created by Michael Westblade on 9/27/14.
 */
// add a controller
myapp.controller('PostController', ['$scope','post','CommentsService',function($scope,post,CommentsService){
    $scope.post = post;

    CommentsService.addComment($scope.post.ID,{"content":"TEST"})
        .then(function(data){
            $scope.comments = data;
        },function(result){
            console.log(result);
        }
    );

    CommentsService.getComments($scope.post.ID)
        .then(function(data){
            $scope.comments = data;
        },function(result){
            console.log(result);
        }
    );

    console.log(post);
}]);