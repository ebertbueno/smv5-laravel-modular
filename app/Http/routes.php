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
Route::get('/modules/{module}/{type}/{file}', [ function ($module, $type, $file) 
{
    $module = ucfirst($module);
    $path = base_path("Modules/$module/Assets/Blocks/$type/$file");
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
Route::post('auth/register',  ['as'=>'auth.register', 'uses'=>'Auth\AuthController@registerForm']);
Route::get('auth/register', 'Auth\AuthController@getRegister');
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
    $exitCode = Artisan::call('migrate:refresh', []);
    $exitCode = Artisan::call('db:seed', []);

    return 'ok';
});

//
//  CREATING THE MENUS 
//
Menu::create('frontend', function($menu)
{
    
    $menu->url('/', 'Home');
    if( !Auth::check() )
    {
      $menu->url('auth/register', trans('layout.sign_up2') );
      $menu->url('petition/create', trans('petition.create_petition') );
    }
    else
    {
        $menu->dropdown( trans('petition.petitions'), function ($sub) {
            $sub->url('petition/create', trans('petition.create_petition') );
            $sub->url('petition', trans('petition.manage_petition') );
        }); 
       $menu->dropdown( trans('profile.myprofile'), function ($sub) {
            $sub->url('admin/user/'.Auth::user()->id, trans('profile.profile') );
            $sub->url('message', trans('message.messages') );
            //$sub->url('user/config', 'Config');
        });
    }
}); 

Menu::create('backend', function($menu)
{
    $menu->url('/admin', 'Dashboard', 1);
}); 