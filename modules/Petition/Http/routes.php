<?php



//
// You can also make additions to the menu again
//
Route::group(['prefix' => 'signature', 'namespace' => 'Modules\Petition\Http\Controllers'], function()
{
	Route::get('/{id}/confirm', 'LinkController@confirmSignature');
	Route::get('/{id}/remove', 'LinkController@removeSignature');
	Route::get('/{id}/find', 'LinkController@formRemoveSignature');
	Route::post('/sendlink', 'LinkController@emailRemoveSignature');
	
	Route::group(['middleware' => 'auth'], function() 
	{
		Route::get('/{id}/edit', 'SignatureController@edit');
		Route::delete('/{id}', 'SignatureController@destroy');
	});
	
	//signature controller unlogged
	Route::resource('', 'SignatureController', ['only' => ['show','store']] );
});

Route::group(['prefix' => 'peticao', 'namespace' => 'Modules\Petition\Http\Controllers'], function()
{
	//Route::get('/{id}/{any}', 'PetitionController@show');
});

Route::group(['prefix' => 'petitions', 'namespace' => 'Modules\Petition\Http\Controllers'], function()
{
	Route::get('{id}', 'PetitionController@show');
	Route::get('{id}/{any}', 'PetitionController@show');
	Route::get('{id}/report', 'LinkController@reportPetition');
});

Route::group(['prefix' => 'petition', 'namespace' => 'Modules\Petition\Http\Controllers'], function()
{
	//Route::get('/', 'PetitionController@index');
	Route::get('getPetitionsByCat/{id}', 'PetitionController@petitionByCategory');
	// link controllers
	
	// timeline view unlogged
	Route::post('timeline', 'TimelineController@store');
	Route::get('timeline/{id}/', 'TimelineController@show');
	Route::get('timeline/{id}/{any}', 'TimelineController@show');
	
	// logged acitons
	Route::group(['middleware' => 'auth'], function() 
	{	
		Route::get('/create', 'PetitionController@create');
		Route::get('/{id}', 'PetitionController@show');
		Route::get('/{id}/edit', 'PetitionController@edit');
		Route::patch('/{id}', 'PetitionController@update')->where(['id'=>'[0-9]+']);
		Route::resource('/', 'PetitionController' );
	});

});

