/**
 * Created by Michael Westblade on 9/27/14.
 */
// add a controller
myapp.controller('PostController', ['$scope','post','PostsService','$state',function($scope,post,PostsService,$state){
    $scope.contentLoaded = false;
    $scope.disqus_shortcode = ( BlogInfo['disqus_shortcode'] != "" ? BlogInfo['disqus_shortcode'] : null );
    $scope.post = post;
    $scope.postId = "post_"+post.ID;
    $scope.postUrl = window.location.href;

    PostsService.getPostMeta(post.ID)
        .then(function(data){
            $scope.postMeta = data;
            $scope.layout = (data['featured_image_position'] && data['featured_image_position'][0] ? data['featured_image_position'][0] : 'center');
            $scope.contentLoaded = true;
        },function(errors){
            console.log(errors);
            $scope.contentLoaded = true;
    });
}]);