/**
 * Created by Michael Westblade on 9/27/14.
 */
myapp.factory('PostsService', ['ajax','$q','$rootScope',function(ajax,$q,$rootScope){
    return {
        posts : function(posts,page,catId){
            var deferred = $q.defer();
            var params = 'page='+page+'&filter[posts_per_page]='+posts+'&preview=true';
            if(catId){
                params+="&filter[cat]="+catId;
            }
            ajax.call($rootScope.api+'posts?'+params,null,'GET',function(data){
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
        },
        getPostCategories : function(){
            var deferred = $q.defer();

            ajax.call($rootScope.adminAjax+'?action=get_post_categories',null,'GET',function(data){
                deferred.resolve(data.data);
            });

            return deferred.promise;
        }
    }
}]);