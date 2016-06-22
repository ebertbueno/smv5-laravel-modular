<?php

namespace Modules\Message\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input,Auth,DB;
use App\User;
use App\Models\Signature;
use App\Models\Message;
use Validator;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $messages = DB::table('users_message')
                    ->select('users_message.id', 'users_message.owner_id', 'users_message.receptor_id', 'O.name as oname', 'R.name as rname')
                    ->leftJoin('users as O', 'O.id', '=', 'users_message.owner_id')
                    ->leftJoin('users as R', 'R.id', '=', 'users_message.receptor_id')
                    ->where('receptor_id', Auth::user()->id)
                    ->orWhere('owner_id', Auth::user()->id)
                    ->orderBy('users_message.created_at', 'desc')
                    ->distinct()
                    ->get();
        $users = [];
        foreach( $messages as $msg)
        {
            if( $msg->owner_id != Auth::user()->id && !in_array($msg->owner_id, $users)  )
              $users[ $msg->owner_id ] = $msg->oname;
            else if( $msg->receptor_id != Auth::user()->id && !in_array($msg->receptor_id, $users) ) 
              $users[ $msg->receptor_id ] = $msg->rname;
        }
        unset($messages);
        //dd($messages);
         return View('message.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $id = $_GET['user'];
        $user = User::find($id);
      
        $messages = DB::table('users_message')
                    ->select('users_message.*', 'O.name as oname', 'R.name as rname')
                    ->leftJoin('users as O', 'O.id', '=', 'users_message.owner_id')
                    ->leftJoin('users as R', 'R.id', '=', 'users_message.receptor_id')
                    ->where('receptor_id', Auth::user()->id)
                    ->where('owner_id', $id)
                    ->orWhere(function ($query) use ($id) {
                          $query->where('owner_id', Auth::user()->id )
                                ->where('receptor_id', $id);
                    })
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get();
        $owner = $id;
        //dd($messages);
         return View('message.new', compact('messages', 'owner', 'user'));
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
        $input = Input::all();
        $input['owner_id'] = Auth::user()->id;
      
        $validation = Validator::make($input, Message::$rules);
        if( $validation->passes() )
        {
            $message = Message::create( $input );
            return response()->json(['message'=>'Sucesso'], 200); 
        }
        else
        {
          return response()->json( ['message'=>'An error occurred','error'=>$validation->getMessageBag()->toArray()], 412 );
        }
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
        $messages = DB::table('users_message')
                    ->select('users_message.*', 'O.name as oname', 'R.name as rname')
                    ->leftJoin('users as O', 'O.id', '=', 'users_message.owner_id')
                    ->leftJoin('users as R', 'R.id', '=', 'users_message.receptor_id')
                    ->where('receptor_id', Auth::user()->id)
                    ->where('owner_id', $id)
                    ->orWhere(function ($query) use ($id) {
                          $query->where('owner_id', Auth::user()->id )
                                ->where('receptor_id', $id);
                    })
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get();
        $owner = $id;
        //d($messages);
         return View('message.show', compact('messages', 'owner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
