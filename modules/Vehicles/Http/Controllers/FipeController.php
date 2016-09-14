<?php   namespace Modules\Vehicles\Http\Controllers;

use Modules\Vehicles\Entities\Fipe;
use View, Redirect, Validator;
use Auth, Response;
use Pingpong\Modules\Routing\Controller;

class FipeController extends Controller {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	private $fipe;
	
	public function __construct()
	{
		$this->Fipe = New Fipe();
	}
	
	public function get_makers($type='carros')
	{
        return Response::json( $this->Fipe->get_makers($type) ); 
	}
	
	public function get_vehicles($type, $maker_id)
	{
        return Response::json( $this->Fipe->get_vehicles($type, $maker_id) ); 
	}
	
	public function get_models($type, $maker_id, $vehicle_id)
	{
        return Response::json( $this->Fipe->get_models($type, $maker_id, $vehicle_id) ); 
	}
	
	public function get_prices($type, $maker_id, $vehicle_id, $model_id)
	{
        return Response::json( $this->Fipe->get_models($type, $maker_id, $vehicle_id, $model_id) ); 
	}
}
