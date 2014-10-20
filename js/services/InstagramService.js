/**
 * Created by Michael Westblade on 9/27/14.
 */
myapp.factory('InstagramService', ['$q','ajax','$rootScope',function($q,ajax,$rootScope){
    return {
        getMostRecent : function(){
            var deferred = $q.defer();

            ajax.call($rootScope.adminAjax+'?action=getInstagramPhotos',null,'GET',function(data){
                deferred.resolve(data.data.data);
            });

            return deferred.promise;
        }
    }
}]);