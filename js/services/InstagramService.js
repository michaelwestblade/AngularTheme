/**
 * Created by Michael Westblade on 9/27/14.
 */
myapp.factory('InstagramService', ['$q','$http','$rootScope',function($q,$http,$rootScope){
    return {
        getMostRecent : function(){
            var deferred = $q.defer();
            var endpoint = 'https://api.instagram.com/v1/media/popular?client_id=95c1f3da8b3246e68b3532210d811f7f&callback=JSON_CALLBACK';
            $http.jsonp(endpoint).success(function(response){
                deferred.resolve(response.data);
            }).error(function(response){
                deferred.resolve(response);
            });

            return deferred.promise;
        }
    }
}]);