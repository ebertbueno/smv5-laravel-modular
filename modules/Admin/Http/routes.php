<?php


Route::group(['prefix' => '/', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
	Route::get('/', 'HomeController@index');
	Route::get('search/{id}', 'HomeController@search');
	
	Route::get('contact', function(){ return View('site.contact'); });
	Route::post('contact', 'HomeController@sendContact');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
	Route::get('/', 'AdminController@index');
    Route::post('password/{id}', 'UserController@updatePass')->name('admin.user.updatePass');

    Route::post('users/{id}/password', 'UserController@updatePass')->name('admin.user.updatePass');
	Route::resource('users', 'UserController' );
	
});

