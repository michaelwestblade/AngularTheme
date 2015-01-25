/**
 * Created by Michael Westblade on 9/27/14.
 */
// add a controller
myapp.controller('PostsController', ['$scope','PostsService',function($scope,PostsService){
    $scope.posts = [];
    $scope.endOfPOsts = false;
    $scope.BlogInfo = BlogInfo;
    $scope.postCategories = [];
    $scope.activeCategory;

    // load posts from the wordpress api
    $scope.loadingPosts = true;
    PostsService.posts(5,1)
        .then(function(posts){
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

    // load post categories
    $scope.loadingCategories = true;
    PostsService.getPostCategories()
        .then(function(categories){
            $scope.loadingCategories = false;
            $scope.postCategories = categories;
        },function(error){
            $scope.loadingCategories = false;
        }
    );

    $scope.setCategory = function(category){
        $scope.activeCategory = category;
        $scope.loadingPosts = true;
        $scope.posts = [];
        PostsService.posts(5,1,(category ? category.cat_ID : null))
            .then(function(posts){
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
    }

    // function to get more posts or pull from cache
    $scope.getPosts = function(page){
        if( page <= $scope.totalPages ){
            $scope.loadingPosts = true;
            PostsService.posts(5,page,($scope.activeCategory ? $scope.activeCategory.cat_ID : null ))
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