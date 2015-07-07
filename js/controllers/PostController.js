/**
 * Created by Michael Westblade on 9/27/14.
 */
// add a controller
myapp.controller('PostController', ['$scope','post','PostsService','$state',function($scope,post,PostsService,$state){
    $scope.contentLoaded = false;
    $scope.disqus_shortcode = ( BlogInfo['disqus_shortcode'] != "" ? BlogInfo['disqus_shortcode'] : null );
    $scope.post = post;
    $scope.postId = "post_"+post.ID;
    $scope.postUrl = $state.href("post",{postId:post.ID},{ absolute: true });

    PostsService.getPostMeta(post.ID)
        .then(function(data){
            $scope.postMeta = data;
            $scope.layout = (data['featured_image_position'] ? data['featured_image_position'] : 'center');

            if(data['hide_featured_image'] && data['hide_featured_image'] == '1'){
                $scope.layout = 'noImage';
}
$scope.contentLoaded = true;
},function(errors){
    console.log(errors);
    $scope.contentLoaded = true;
});
}]);