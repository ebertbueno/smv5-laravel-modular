<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;

class Message extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'users_message';
	  
    protected $fillable = [  	
			'owner_id',
			'receptor_id',
			'message',
		];
    
   public static $rules =  [
                'owner_id' => 'required',
                'receptor_id' => 'required',
            ];
     
    public function owner()
    {
        return $this->belongsTo('App\User', 'owner_id');
    }
	

}
