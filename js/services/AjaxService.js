/**
 * Created by Michael Westblade on 9/27/14.
 */

myapp.factory('ajax', ['$rootScope','$http',function($rootScope,$http){
    return {
        call: function(url,params,method,success,error,cache){
            var ajaxMethod = angular.uppercase(method);
            var getParams = null;
            var postParams = null;

            if(ajaxMethod == 'GET'){
                getParams = params;
            }
            else{
                postParams = params;
            }

            var caching = (cache ? cache : false);

            return $http({
                url:url,
                params:getParams,
                data:postParams,
                method:ajaxMethod,
                headers:{
                    'X-WP-Nonce':$rootScope.nonce
                },
                cache:caching,
                timeout:60000
            })
            .success(function(data,status,headers,config){
                  if(typeof success == 'function'){
                      success({
                          'data':data,
                          'status':status,
                          'headers':headers,
                          'config':config
                      });
                  }
            })
            .error(function(data,status,headers,config){

            });
        }
    }
}]);