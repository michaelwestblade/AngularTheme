/**
 * Created by Michael Westblade on 9/27/14.
 */
// initialize the app
var myapp = angular.module('myapp',['ngRoute','ngSanitize','ui.router','ui.bootstrap','angular-inview','angularUtils.directives.dirDisqus','angulartics', 'angulartics.google.analytics','720kb.socialshare']);

myapp.controller('NavmenuCtrl', function ($scope) {
    $scope.isCollapsed = true;
});

myapp.run(['$rootScope', '$state', '$stateParams','InstagramService',function($rootScope, $state, $stateParams,InstagramService){
    // the following data is fetched from the JavaScript variables created by wp_localize_script(), and stored in the Angular rootScope
    $rootScope.dir = BlogInfo.url;
    $rootScope.site = BlogInfo.site;
    $rootScope.api = AppAPI.url;
    $rootScope.nonce = WP_API_Settings.nonce;
    $rootScope.siteTitle = BlogInfo.name;
    $rootScope.user = BlogInfo.user;
    $rootScope.adminAjax = BlogInfo.adminAjax;
    $rootScope.instagram = [];
    $rootScope.pageLoading = 'loaded';

    $rootScope.$state = $state;
    $rootScope.$stateParams = $stateParams;

    $rootScope.$on('$stateChangeStart',function(event, toState, toParams, fromState, fromParams){
        $rootScope.pageLoading = 'loading';
    });

    // set current level context on state change
    $rootScope.$on('$stateChangeSuccess',function(event, toState, toParams, fromState, fromParams) {
        $rootScope.pageLoading = 'loaded';

        if(toState && toState.name=='page'){
            $rootScope.pageId = toParams.pageId;
        }else{
            $rootScope.pageId = null;
        }
    });
}]).
config(['$stateProvider','$urlRouterProvider','$locationProvider','$analyticsProvider',function($stateProvider,$urlRouterProvider,$locationProvider,$analyticsProvider){
    $urlRouterProvider
        .when('','/posts')
        .otherwise('/');
        if(BlogInfo.DEV){
            $locationProvider.hashPrefix('!');
        }else{
            $locationProvider.html5Mode({
                enabled: true,
                requireBase: false
            });
        }
    $analyticsProvider.firstPageview(true); /* Records pages that don't use $state or $route */
    $analyticsProvider.withAutoBase(true);  /* Records full path */

    $stateProvider.
    state("home",{
        url:"/home",
        templateUrl:BlogInfo.url+'partials/page.html',
        controller:'PageController',
        resolve : {
            page : function($stateParams,PostsService){
                return PostsService.page(PageInfo.home);
            }
        }
    }).
    state("posts",{
        url:"/posts",
        templateUrl:BlogInfo.url+'partials/posts.html',
        controller:'PostsController'
    }).
    state("post",{
       url:"/post/{postId}",
       templateUrl:BlogInfo.url+'partials/post.html',
       controller:'PostController',
       resolve : {
           post : function($stateParams,PostsService){
               return PostsService.post($stateParams.postId);
           }
       }
    }).
    state("page",{
        url:"/pages/page/{pageId}",
        templateUrl:BlogInfo.url+'partials/page.html',
        controller:'PageController',
        resolve : {
            page : function($stateParams,PostsService){
                return PostsService.page($stateParams.pageId);
            }
        }
    });
}]);