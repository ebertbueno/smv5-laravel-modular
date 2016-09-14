<?php namespace Modules\Vehicles\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Fipe extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $url = 'http://fipeapi.appspot.com/api/1/';
	protected $action;
	protected $obj;
	
	private function do_request()
	{
		$this->obj = json_decode(file_get_contents($this->url.$this->action));
		return $this->obj;
	}
	
	public function obj_dropdown( $key, $value )
	{
		$out=array();
		if( isset($this->obj) )
		{
			foreach( $this->obj as $vlr )
			{
				$out[ $vlr->$key ] = $vlr->$value;
			}
			return $out;
		}
		return false;
	}

	public function get_makers($type='carros')
	{
		$this->action = $type.'/marcas.json';
		return $this->do_request();
	}
	
	public function get_vehicles($type, $maker_id)
	{
		$this->action = $type.'/veiculos/'.$maker_id.'.json';
		return $this->do_request();
	}
	
	public function get_models($type, $maker_id, $model_id)
	{
		$this->action = $type.'/veiculo/'.$maker_id.'/'.$model_id.'.json';
		return $this->do_request();
	}
	
	public function get_prices($type, $maker_id, $model_id, $price_id )
	{
		$this->action = $type.'/veiculo/'.$maker_id.'/'.$model_id.'/'.$price_id.'.json';
		return $this->do_request();
	}
}
