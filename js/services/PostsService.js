/**
 * Created by Michael Westblade on 9/27/14.
 */
myapp.factory('PostsService', ['ajax','$q','$rootScope',function(ajax,$q,$rootScope){
    return {
        posts : function(posts,page){
            var deferred = $q.defer();

            ajax.call($rootScope.api+'posts?page='+page+'&filter[posts_per_page]='+posts+'&preview=true',null,'GET',function(data){
                deferred.resolve(data);
            });

            return deferred.promise;
        },
        post : function(postId){
            var deferred = $q.defer();

            ajax.call($rootScope.api+'posts/'+postId,null,'GET',function(data){
                deferred.resolve(data.data);
            });

            return deferred.promise;
        }
    }
}]);