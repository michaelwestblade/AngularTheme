/**
 * Created by Michael Westblade on 9/27/14.
 */
myapp.filter('unsafe',function($sce){
   return function(val){
       return $sce.trustAsHtml(val);
   }
});