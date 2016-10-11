<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//HOME
//
Route::get('/', function(){
    return view('welcome');
});
Route::get('/home', function(){
    return view('welcome');
});

Route::get('/modules/{module}/{type}/{file}', [ function ($module, $type, $file) 
{
    $module = ucfirst($module);
    $path = base_path("modules/$module/Assets/$type/$file");
    if (\File::exists($path)) {
        return response()->download($path, "$file");
    }
    return response()->json([ ], 404);
}]);
Route::get('/themes/{theme}/{type}/{file}', [ function ($theme, $type, $file) 
{
    $path = base_path("Resources/Themes/$theme/$type/$file");
    if (\File::exists($path)) {
        return response()->download($path, "$file");
    }
}]);

//AUTHENTICATIONS & REGISTER
Route::get('auth/facebook', 'Auth\AuthController@facebook');
Route::get('auth/facebook/page', 'Auth\AuthController@pageFacebook');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...

if( Config::get('menus.register') )
{
    Route::post('auth/register',  ['as'=>'auth.register', 'uses'=>'Auth\AuthController@registerForm']);
    Route::get('auth/register', 'Auth\AuthController@getRegister');
}
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


// error redirects
//Route::get('404/{code}', function($code){
//  return View('errors.404', ['code'=>$code] );
//});

// migration
Route::get('/migrate', function()
{
    $exitCode = Artisan::call('config:clear', []);
    $exitCode = Artisan::call('module:migrate-reset', []);
    $exitCode = Artisan::call('module:migrate', []);
    $exitCode = Artisan::call('module:seed', []);

    return 'ok';
});
Route::get('/migrate/{module}', function($module)
{
    $exitCode = Artisan::call('config:clear', []);
    $exitCode = Artisan::call('module:migrate', [$module]);
    $exitCode = Artisan::call('module:seed', [$module]);

    return 'ok';
});

//
//  CREATING THE MENUS 
//
Menu::create('menu-left', function($menu)
{
    $menu->setPresenter('App\Presenters\SmvPresenter');

    $menu->url('/', 'Home', 0, ['auth'=>false]);
}); 

Menu::create('menu-right', function($menu)
{
    $menu->setPresenter('App\Presenters\SmvPresenter');
    if( Config::get('menus.register') ) $menu->url('auth/register', trans('auth.sign_up2'), 97, ['auth'=>false] );
    if( Config::get('menus.login') ) $menu->url('auth/login', trans('auth.sign_in'), 98, ['auth'=>false] );
}); 