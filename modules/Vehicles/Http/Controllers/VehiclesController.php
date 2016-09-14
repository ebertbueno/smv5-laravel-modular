<?php

namespace Modules\Vehicles\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Vehicles\Entities\Vehicle;
use Modules\Vehicles\Entities\Address;
use View, Redirect, Validator;
use Auth;
use App\Http\Controllers\Controller;
use Datatables;

class VehiclesController extends Controller {

	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
	        return Datatables::of( Vehicle::select(['id', 'chassis', 'plate', 'created_date', 'last_access'])->all() )->make(true);
	  }
		//$data = Vehicle::all();

        return View('vehicles::vehicle.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$vehicle = new Vehicle();
		$addresses = Address::where('user_id', '=', Auth::user()->user_id )->get()->lists('address_name','id');
		
		return View::make('vehicles::vehicle.form', compact('vehicle', 'addresses'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $input)
	{
		//
				$input = $input->all();
        $validation = Validator::make($input, Vehicle::$rules);

        if ($validation->passes())
        {
            Vehicle::create($input);

            return Redirect::route('vehicles.index');
        }

        return Redirect::route('vehicles.create')
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$vehicle = Vehicle::find($id);
        if (is_null($vehicle))
        {
            return Redirect::route('vehicles.index');
        }
        return View::make('vehicles::vehicle.show', compact('vehicle'));
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *                                                    
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$vehicle = Vehicle::find($id);
        if (is_null($vehicle))
        {			
            return Redirect::route('vehicles.index');
        }
		$addresses = Address::where('user_id', '=', Auth::user()->user_id)->get()->lists('address_name','id');

        return View::make('vehicles::vehicle.form', compact('vehicle', 'addresses') );
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $input, $id)
	{
				$input = $input->all();
        $validation = Validator::make($input, vehicle::$rules);
        if ($validation->passes())
        {
            $vehicle = Vehicle::find($id);
            Vehicle::update($input);
            return Redirect::route('vehicles.show', $id);
        }
		return Redirect::route('vehicles.edit', $id)
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		vehicle::find($id)->delete();
        return Redirect::route('vehicles.index');
	}


}
