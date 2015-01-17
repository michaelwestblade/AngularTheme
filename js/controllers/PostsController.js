/**
 * Created by Michael Westblade on 9/27/14.
 */
// add a controller
myapp.controller('PostsController', ['$scope','PostsService',function($scope,PostsService){
    $scope.posts = [];
    $scope.endOfPOsts = false;
    $scope.BlogInfo = BlogInfo;

    // load posts from the wordpress api
    $scope.loadingPosts = true;
    PostsService.posts(5,1)
        .then(function(posts){
            var last = 5;
            var first = 1;

            // push first page, set counts
            $scope.posts = $scope.posts.concat(posts.data);
            $scope.totalPages = posts.headers('X-WP-TotalPages');
            $scope.postCount = posts.headers('X-WP-Total');
            $scope.currentPage = 1;
            $scope.loadingPosts = false;
        },function(result){
            console.log(result);
            $scope.loadingPosts = false;
        }
    );

    // function to get more posts or pull from cache
    $scope.getPosts = function(page){
        if( page <= $scope.totalPages ){
            $scope.loadingPosts = true;
            PostsService.posts(5,page)
                .then(function(posts){
                    $scope.currentPage++;
                    $scope.posts = $scope.posts.concat(posts.data);
                    $scope.totalPages = posts.headers('X-WP-TotalPages');
                    $scope.postCount = posts.headers('X-WP-Total');
                    $scope.loadingPosts = false;
                },function(result){
                    console.log(result);
                    $scope.loadingPosts = false;
                }
            );
        }else{
            $scope.endOfPosts = true;
        }
    }
}]);