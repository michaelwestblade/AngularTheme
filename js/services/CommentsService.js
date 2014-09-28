/**
 * Created by Michael Westblade on 9/27/14.
 */
myapp.factory('CommentsService', ['ajax','$q',function(ajax,$q){
    return {
        addComment : function(postId,comment){
            var deferred = $q.defer();

            ajax.call('posts/'+postId+'/comments',comment,'POST',function(data){
                deferred.resolve(data);
            });

            return deferred.promise;
        },
        getComments : function(postId){
            var deferred = $q.defer();

            ajax.call('posts/'+postId+'/comments',null,'GET',function(data){
                deferred.resolve(data);
            });

            return deferred.promise;
        }
    }
}]);