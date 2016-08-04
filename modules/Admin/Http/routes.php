<?php


Route::group(['prefix' => '/', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
	Route::get('/', 'HomeController@index');
	Route::get('search/{id}', 'HomeController@search');
	
	Route::get('contact', function(){ return View('admin::frontend.contact'); });
	Route::post('contact', 'HomeController@sendContact');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers', 'middleware'=>'auth'], function()
{
	Route::get('/', 'AdminController@index');
 	Route::get('/test', function(){
 		$repository = app()->make('Modules\Admin\Repositories\UserRepository');
 		return $repository->all();
 	});
    Route::post('password/{id}', 'UserController@updatePass')->name('admin.user.updatePass');

    Route::get('grid', 'UserController@grid');
    Route::post('users/{id}/password', 'UserController@updatePass')->name('admin.user.updatePass');
	Route::resource('users', 'UserController' );
	
});

Route::group(['prefix'=>'api', 'namespace'=>'Modules\Admin\Http\Controllers', 'middleware'=>['oauth','cors']], function()
{
	Route::get('/user', function(){
		$id = \LucaDegasperi\OAuth2Server\Facades\Authorizer::getResourceOwnerId();
		return App\User::select(['id','name','last_name','email'])->find($id);
	});
});
