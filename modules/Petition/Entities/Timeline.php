<?php

namespace Modules\Petition\Entities;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Timeline extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'petition_timeline';
	  
    protected $fillable = [  	
			'user_id',	
			'petition_id',
			'title',
			'content',
			'link',
			'approved'
		];
    
   public static $rules = array(
            [
                'petition_id' => 'required|numeric',
                'title' => 'required|min:10',
                'link' => 'url',
            ]
	 );
	
	 
}
