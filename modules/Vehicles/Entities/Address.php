<?php namespace Modules\Vehicles\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Address extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'vehicles_address';
	protected $primaryKey = 'id';
	protected $hidden = array();
	public $timestamps = false;
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $guarded = array('id');

	public static $rules = array(
		'zip_code' => 'required|min:5',
		'address_name' => 'required|min:7'
	);

}
