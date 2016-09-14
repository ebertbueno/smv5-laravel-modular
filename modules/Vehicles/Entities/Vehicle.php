<?php namespace Modules\Vehicles\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'vehicles_vehicle';
	protected $primaryKey = 'id';
	protected $hidden = array('type');
	const CREATED_AT = 'created_date';
	const UPDATED_AT = 'last_access';
	
	public function setUser_idAttribute($value)
	{
		$this->attributes['user_id'] = Auth::user()->id;
	}
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $guarded = array('id');

	public static $rules = array(
		'chassis' => 'required|min:5|unique:vehicle,chassis',
		'plate' => 'required|min:7'
	);

}
