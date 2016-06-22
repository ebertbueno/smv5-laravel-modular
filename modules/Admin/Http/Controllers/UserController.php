<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Admin\Entities\Account;
use Modules\Admin\Entities\User;
use Auth, Validator, Input, Hash;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax())
        {
            $users = $this->user->select(['id','name','email','level','language','status']);

             return Datatables::of( $users )
                ->addColumn('action', function ($user) {
                    return '<a href="'.url('admin/users/'.$user->id.'/edit').'" data-toggle="modal" data-target="#myModal">Edit </a>
                            <a href="admin/users/'.$user->id.'" data-toggle="modal" data-target="#deleteModal"  >Delete </a>';
                })
                ->make();
        }
        return View('admin::user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View('admin::user.form', ['user'=> $this->user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $all = $request->all();

        $valid = Validator::make( $all, $this->user->rules );

        if( $valid->passes() )
        {
            $this->user->create($all);

            return response()->json(['message' => 'success'], 200);
        }

        if ($request->ajax())
            return response()->json( ['message'=>'error','error'=>$valid->getMessageBag()->toArray()], 412 );

        return redirect()->route('admin.users.index')->withMessage('Error')->withErrors($valid);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
		$user = $this->user->find($id);
			
        return View('admin::user.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $user = $this->user->find( $id );
		 return view('admin::user.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
		$input = $request->except(['_method', '_token']);
		
			
		$validation = Validator::make($input,  [
            'name' => 'required',
            'password' => 'confirmed'
    	]);

		if( $validation->passes() )
		{
                unset( $input['password_confirmation'] );

                if( empty($input['password']) ) 
                    unset($input['password']);
                else
                    $input['password'] = Hash::make($input['password']);

				$this->user->where('id', $id)->update( $input );
				
                if ($request->ajax())
                    return response()->json( ['message'=>'Success']);

				return redirect('admin/user/'.$id);  
		}

        if ($request->ajax())
                return response()->json( ['message'=>'Error','error'=>$validation->getMessageBag()->toArray()], 412 );

		return redirect()->route('admin.user.show', $id)
				->withInput()
				->withErrors($validation);
				
    }

		
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user->destroy($id);

        if (Request::ajax())
            return response()->json( ['message'=>'Success']);

        return response()->json(['message'=>trans('layout.alert_success'), 'avatar'=>asset('uploads/'.$fileName) ], 200); 
                    
    }
	
		
}
