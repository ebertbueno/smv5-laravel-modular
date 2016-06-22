<?php namespace Modules\Message\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class MessageController extends Controller {
	
	public function index()
	{
		return view('Message::index');
	}
	
}