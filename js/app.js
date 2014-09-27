/**
 * Created by Michael Westblade on 9/27/14.
 */
// initialize the app
var myapp = angular.module('myapp',[]);

myapp.run(['$rootScope',function($rootScope){
    // the following data is fetched from the JavaScript variables created by wp_localize_script(), and stored in the Angular rootScope
    $rootScope.dir = BlogInfo.url;
    $rootScope.site = BlogInfo.site;
    $rootScope.api = AppAPI.url;
}]);

// add a controller
myapp.controller('mycontroller', ['$scope','$http',function($scope,$http){
    // load posts from the wordpress api
    $http({
       method: 'GET',
       url: $scope.api+'posts',
       params: {
           json: 'get_posts'
       }
    }).success(function(data,status,headers,config){
            $scope.postdata = data;
        }).error(function(data,status,headers,config){

        });
}]);