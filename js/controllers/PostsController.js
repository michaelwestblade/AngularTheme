/**
 * Created by Michael Westblade on 9/27/14.
 */
// add a controller
myapp.controller('PostsController', ['$scope','PostsService',function($scope,PostsService){
    $scope.posts = [];

    // load posts from the wordpress api
    PostsService.posts(5,1)
        .then(function(posts){
            var last = 5;
            var first = 1;

            // push first page, set counts
            $scope.posts.push({'page':1,'posts':posts.data,'first':first,'last':last});
            $scope.totalPages = posts.headers('X-WP-TotalPages');
            $scope.postCount = posts.headers('X-WP-Total');
            $scope.currentPage = 1;

            // build the rest of the pages
            for(var i=1; i<$scope.totalPages; i++)
            {
                first+=5;
                last+=5;
                $scope.posts.push({
                    "page":i+1,
                    "posts":[],
                    "first":first,
                    "last":last
                });
            }
        },function(result){
            console.log(result);
        }
    );

    // function to get more posts or pull from cache
    $scope.getPosts = function(page){
        // check cache
        if(page.posts.length!=0){
            $scope.currentPage = page.page;
        }
        // load them
        else{
            PostsService.posts(5,page.page)
                .then(function(posts){
                    $scope.currentPage = page.page;
                    page.posts = posts.data;
                    $scope.totalPages = posts.headers('X-WP-TotalPages');
                    $scope.postCount = posts.headers('X-WP-Total');
                },function(result){
                    console.log(result);
                }
            );
        }
    }
}]);