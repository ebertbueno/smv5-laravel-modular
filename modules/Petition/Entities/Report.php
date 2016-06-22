<?php

namespace Modules\Petition\Entities;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Report extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'petition_report';
	  
    protected $fillable = [  	
			'petition_id',
			'why_id',
			'why_desc'
		];
    
   public static $rules = array(
            [
                'petition_id' => 'required|numeric',
                'why_id' => 'required|numeric',
            ]
	 );
}
