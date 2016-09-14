// public/js/services/fipeService.js

angular.module('FipeService', [])

.factory('Fipe', ['$http', function($http) {

    return {
        // get all the comments
        makers : function( typeVlr ) {
            return $http.get('admin/fipe/'+typeVlr);
        }, 
		
		// get all the comments
        vehicles : function( typeVlr, makerVlr ){
            return $http.get('admin/fipe/'+typeVlr+'/'+makerVlr);
        },

		// get all the comments
        models : function( typeVlr, makerVlr, vehicleVlr ){
            return $http.get(  'admin/fipe/'+typeVlr+'/'+makerVlr+"/"+vehicleVlr );
        },

		// get all the comments
        prices : function( typeVlr, makerVlr, vehicleVlr, modelVlr ){
            return $http.get( 'admin/fipe/'+typeVlr+'/'+makerVlr+"/"+vehicleVlr+'/'+modelVlr );
        },

        // save a comment (pass in comment data)
        /*save : function(commentData) {
            return $http({
                method: 'POST',
                url: '/api/comments',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(commentData)
            });
        },

        // destroy a comment
        destroy : function(id) {
            return $http.delete('/api/comments/' + id);
        }*/
    }

}]);