
angular.module('FipeCrtl', [])

.controller('FipeController', ['$scope', '$http', 'Fipe', function($scope, $http, Fipe) 
{
    // object to hold all the data for the new comment form
    $scope.data = {};
	$scope.types = [
						{key:'carros', text:'Cars'}, 
						{key:'motos', text:'Bikes'}, 
						{key:'caminhoes', text:'Trucks'}
					];
	var search = {};
	$scope.search = search;
	
    // loading variable to show the spinning loading icon
    $scope.loading = true;
	
	$scope.updateMakers = function()
	{
		var vlr = angular.fromJson( $scope.typeVlr );
		search['type'] = vlr.key;
		Fipe.makers( vlr.key )
			.success(function(data) {
				$scope.makers = data;
				$scope.loading = false;
			});
	};
	
	$scope.updateVehicles = function()
	{
		var vlr = angular.fromJson( $scope.makerVlr );
		search['maker_id'] = vlr.id;
		Fipe.vehicles( search.type, search.maker_id )
			.success(function(data) {
				$scope.vehicles = data;
				$scope.loading = false;
			});
	};
	
	$scope.updateModels = function()
	{
		var vlr = angular.fromJson( $scope.vehiclesVlr );
		search['vehicle_id'] = vlr.id;
		Fipe.models( search.type, search.maker_id, search.vehicle_id )
			.success(function(data) {
				$scope.models = data;
				$scope.loading = false;
				
				$scope.vehicle_title = vlr.fipe_name;
			});
	};
	
    $scope.updatePrices = function()
	{
		var vlr = angular.fromJson( $scope.modelsVlr );
		search['model_id'] = vlr.id;
	}

    $scope.fill = function ( type, maker, vehicle, model, title )
	{
			$scope.search = { types:type, maker_id:maker, vehicle_id:vehicle, model_id:model };
			
			$scope.typeVlr = $scope.getRow( $scope.types, 'key', type );
			$scope.makerVlr = {id:maker, fipe_name:'Selected'};
			$scope.vehiclesVlr = {id:vehicle, fipe_name:title};
			$scope.modelsVlr = {id:model, name:'Selected'};
			
			$scope.updateMakers();
			$scope.updateVehicles();
			$scope.updateModels();
			$scope.updatePrices();
			
			$scope.vehicle_title = title;
	}
		
	$scope.getRow = function( arr, key, value )
	{
		    var arr2;
			angular.forEach( arr, function( row ) {
			  if ( row[key] == value ) arr2 = row;
			});
			return arr2;
	}
}]);