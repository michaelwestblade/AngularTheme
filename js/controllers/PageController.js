/**
 * Created by Michael Westblade on 9/27/14.
 */
// add a controller
myapp.controller('PageController', ['$scope','page','PostsService','$state',function($scope,page,PostsService,$state){
    $scope.contentLoaded = false;
    $scope.page = page;

    PostsService.getPostMeta(page.ID)
        .then(function(data){
            $scope.pageMeta = data;
            $scope.template = (data['page_template'] ? data['page_template'] : 'page');
            $scope.contentLoaded = true;
        },function(errors){
            console.log(errors);
            $scope.contentLoaded = true;
        });
}]);