<?php

namespace App\Libraries;

class Api{
	
	public function __construct() 
	{

       
    }


    public function setWidget($name, $target, $view)
    {
    	view()->composer( $target, function ($view)
        {
        	$view->widgets[] = view($view);
        	$view->with( $name, $view->widgets );
        });
    }
}