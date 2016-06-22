<?php

namespace Modules\Petition\Entities;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Category extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'petition_category';
	  
    protected $fillable = [  	
			'name',
			'slug',
		];
    
   public static $rules = array(
            [
                'name' => 'required|min:10',
            ]
	 );
}
