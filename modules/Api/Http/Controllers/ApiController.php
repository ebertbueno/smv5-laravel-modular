<?php namespace Modules\Api\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Api\Entities\Client;
use Illuminate\Http\Request;

class ApiController extends Controller {
	
	public function __construct()
    {
        //$this->middleware("roles:admin");
        //$this->middleware("permissions:manage-roles");
    }

     protected function redirectNotFound()
    {
        return redirect()->route('admin.manage-api.index');
    }
    /**
     * Display a listing of roles.
     *
     * @return Response
     */
    public function index()
    {
        $client = Client::all();

        return View('api::client.index', compact('client'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return Response
     */
    public function create()
    {

        return View('api::client.create');
    }

    /**
     * Store a newly created role in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Client::create($data);

        return redirect()->route('admin.manage-api.index');
    }

    /**
     * Display the specified role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
        	$client = Client::find($id);
            return View('api::api.show', compact('client'));
        } catch (ModelNotFoundException $e) {
            return redirect()->routeNotFound();
        }
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
        	$client = Client::find($id);
            return View('api::client.edit', compact('client'));
        } catch (ModelNotFoundException $e) {
            return redirect()->routeNotFound();
        }
    }

    /**
     * Update the specified role in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();

            Client::find($id)->update($data);

            return redirect()->route('admin.manage-api.index');
        } catch (ModelNotFoundException $e) {
            return redirect()->routeNotFound();
        }
    }

    /**
     * Remove the specified role from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try {
            Client::destroy($id);

            return redirect()->route('admin.manage-api.index');
        } catch (ModelNotFoundException $e) {
            return redirect()->routeNotFound();
        }
    }
}