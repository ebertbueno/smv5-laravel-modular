<?php

namespace App\Libraries;

use DB, BootForm;

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

    public function getForm( $table, $add=[], $filter=[] )
    {
        $out = [];
        $sm = DB::connection()->getDoctrineSchemaManager();
        $fields = $sm->listTableColumns('users');
        foreach($fields as $key=>$fd)
        {
            $out[$key] = [
                'field' => BootForm::text($key, $key)
            ];
        }
        return $out;
    }
}