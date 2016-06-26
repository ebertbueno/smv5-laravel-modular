<?php

Route::group(['middleware'=>'cors'], function()
{
	Route::post('oauth/access_token', function() {
	    return Response::json(Authorizer::issueAccessToken());
	});

	Route::group([
		'prefix' => 'api', 
		'namespace' => 'Modules\Api\Http\Controllers', 
		'middleware'=>'oauth', 
		'as'=> 'api.'
	], function()
	{
		Route::get('/', 'ApiController@index');
		Route::get('/teste', function(){
			return [
				'name'=>'teste',
				'qtd' =>4,
				'status'=>'ativo'
			];
		});


	});
});
