<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Modules\Vehicles\Http\Controllers', 'middleware'=>'auth'], function()
{
	Route::get('vehicles/tabledata', 'VehiclesController@vehicleData');
	Route::resource('vehicles', 'VehiclesController');
	Route::get('fipe/{type}', 'FipeController@get_makers' );
	Route::get('fipe/{type}/{maker_id}', 'FipeController@get_vehicles' );
	Route::get('fipe/{type}/{maker_id}/{vehicle_id}', 'FipeController@get_models' );
	Route::get('fipe/{type}/{maker_id}/{vehicle_id}/{model_id}', 'FipeController@get_prices' );

});