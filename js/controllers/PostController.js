/**
 * Created by Michael Westblade on 9/27/14.
 */
// add a controller
myapp.controller('PostController', ['$scope','post','CommentsService',function($scope,post,CommentsService){
    $scope.post = post;
    $scope.jsComment = {
        'user_id':($scope.user.data ? $scope.user.data.ID : null),
        'author':($scope.user.data ? $scope.user.data['display_name'] : null),
        'author_email':($scope.user.data ? $scope.user.data['user_email'] : null),
        'content':''
    };
    $scope.showCommentForm = false;
    $scope.forms = {};

    $scope.toggleCommentForm = function(){
        $scope.showCommentForm = !$scope.showCommentForm;
    }

    CommentsService.getComments($scope.post.ID)
        .then(function(data){
            $scope.comments = data;
        },function(result){
            console.log(result);
        }
    );

    $scope.addComment = function(form,comment){
        form.submitted = true;
        if(form.$valid){
            CommentsService.addComment($scope.post.ID,comment)
                .then(function(data){
                    $scope.comments.push(data);
                    $scope.jsComment.content = "";
                    $scope.showCommentForm = false;
                },function(result){
                    console.log(result);
                }
            );
        }else{
            console.log('error');
        }
    }
}]);