<?php

Route::group(['prefix' => 'message', 'namespace' => 'Modules\Message\Http\Controllers'], function()
{
    Route::resource('', 'MessageController' );
});