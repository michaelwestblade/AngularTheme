/**
 * Created by Michael Westblade on 9/27/14.
 */
// add a controller
myapp.controller('PostsController', ['$scope','PostsService','$timeout',function($scope,PostsService,$timeout){
    $scope.posts = [];
    $scope.endOfPOsts = false;
    $scope.postCategories = [];
    $scope.activeCategory;
    $scope.searchTimeout;
    $scope.search = {
        posts:""
    }

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
        $scope.searchQuery = null;
        $scope.search.posts = "";
        $scope.loadingPosts = true;
        $scope.posts = [];
        PostsService.posts(5,1,null,(category ? category.cat_ID : null))
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
        // make sure we're not already loading posts
        if(!$scope.loadingPosts){
            if( page <= $scope.totalPages ){
                $scope.loadingPosts = true;
                PostsService.posts(5,page,$scope.searchQuery,($scope.activeCategory ? $scope.activeCategory.cat_ID : null ))
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
    }

    $scope.searchPosts = function(query){
        if(query && query!=""){
            // if we're waiting on another request, cancel it
            if($scope.searchTimeout){
                $timeout.cancel($scope.searchTimeout);
            }
            $scope.searchTimeout = $timeout(function(){
                $scope.activeCategory = null;
                $scope.searchQuery = query;
                $scope.loadingPosts = true;
                $scope.posts = [];
                PostsService.posts(5,1,query)
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
            },400);
        }
    }
}]);