/**
 * Created by Michael Westblade on 9/27/14.
 */
myapp.factory('CommentsService', ['ajax','$q','$rootScope',function(ajax,$q,$rootScope){
    return {
        addComment : function(postId,comment){
            var deferred = $q.defer();

            ajax.call($rootScope.api+'posts/'+postId+'/comments',comment,'POST',function(data){
                deferred.resolve(data.data);
            });

            return deferred.promise;
        },
        getComments : function(postId){
            var deferred = $q.defer();

            ajax.call($rootScope.api+'posts/'+postId+'/comments',null,'GET',function(data){
                deferred.resolve(data.data);
            });

            return deferred.promise;
        }
    }
}]);