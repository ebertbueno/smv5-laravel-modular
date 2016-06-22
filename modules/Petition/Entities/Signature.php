<?php

namespace Modules\Petition\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use App\User;

class Signature extends Model
{
    //
		use SoftDeletes;
    protected $primaryKey = 'id';
    protected $table = 'petition_signature';
	  
    protected $fillable = [  	
			'user_id',
			'email_visibility',
			'comment',
		];
    
   public static $rules = array(
            [
                'email_visibility' => 'required',
            ]
	 );
     
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
	
		public function account()
    {
        return $this->belongsTo('Modules\Admin\Entities\Account', 'user_id');
    }
	
		public function petition()
    {
        return $this->belongsTo('Modules\Petition\Entities\Petition', 'petition_id');
    }

}
