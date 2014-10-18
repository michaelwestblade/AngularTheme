/**
 * Created by Michael Westblade on 9/27/14.
 */
myapp.factory('UsersService', ['ajax','$q','$rootScope',function(ajax,$q,$rootScope){
    return {
        user : function(id){
            var deferred = $q.defer();

            ajax.call($rootScope.api+'users/'+id,null,'GET',function(data){
                deferred.resolve(data.data);
            });

            return deferred.promise;
        }
    }
}]);