<?php namespace Modules\Api\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class ApiController extends Controller {
	
	public function index()
	{
		return view('Api::index');
	}
	
}