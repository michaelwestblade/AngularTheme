/**
 * Created by Michael Westblade on 9/27/14.
 */
myapp.factory('PostsService', ['ajax','$q',function(ajax,$q){
    return {
        posts : function(posts,page){
            var deferred = $q.defer();

            ajax.call('posts?page='+page+'&filter[posts_per_page]='+posts,null,'GET',function(data){
                deferred.resolve(data);
            });

            return deferred.promise;
        },
        post : function(postId){
            var deferred = $q.defer();

            ajax.call('posts/'+postId,null,'GET',function(data){
                deferred.resolve(data.data);
            });

            return deferred.promise;
        }
    }
}]);