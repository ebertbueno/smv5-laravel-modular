<?php

namespace Modules\Petition\Http\Controllers;;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input,Auth,Mail;
use App\User;
use App\Models\Petition;
use App\Models\Signature;
use App\Models\Account;
use Validator;

class SignatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return View('petition::petition.form');
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
        $user = User::where('email', $input['email'])->first();
      
        if( !$user )
        {
           $validation = Validator::make($input,  [
                  'name' => 'required|max:255',
                  'email' => 'required|email|max:255|unique:users'
              ]);
            if( $validation->passes() )
            {
                $user = User::create( $input );
                $account = Account::create([
                        'user_id' => $user->id,
                        'country' => @$input['country'], 
                        'city'    => @$input['city']
                ]);
            }
            else
            {
              return response()->json( ['message'=>trans('layout.alert_error'),'error'=>$validation->getMessageBag()->toArray()], 412 );
            }
        }
        $sign = Signature::where('user_id', $user->id )->where('petition_id', $input['petition_id'])->first();
        if( !$sign )
        {
            $sign = new Signature;
            $sign->user_id = $user->id;
            $sign->petition_id = $input['petition_id'];
            $sign->email_visibility = $input['email_visibility'];
            $sign->save(); 
          
            if($sign)
            {
                $link = url('signature/'.$sign->id.'O'.date('hisdmy', strtotime($sign->created_at)).'/confirm');
                Mail::send('emails.default', array(
                  'title_lang' => trans('sign.confirm.title'),'message_lang' => trans('sign.confirm.message', ['link'=>$link] ),
                ), 
                function($message) use ($user)
                {
                    $message->to( $user->email, $user->name)->subject( trans('sign.confirm.title') );
                });
            }
          
            return response()->json(['message'=> trans('layout.alert_success') ], 200); 
        }
        else
        {
            
            return response()->json(['message'=> trans('sign.already')], 303); 
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
        if( Auth::check() )
        {
            $sign = Signature::where('user_id', Auth::user()->id )->where('petition_id', $id )->first();
            if( $sign )
            { 
                return response()->json([], 200);  
            }
            return response()->json([], 412);
        }
        else
        {
           return response()->json([], 412);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ptt_id)
    {
        //
        $petition = Petition::find($ptt_id);
        if( $petition )
        {
            $signatures = Signature::where('petition_id', $petition->id)->with('User')->with('Account')->get();
            //dd($signatures);
            return View('petition::signature.show', compact('petition','signatures'));
        }
        return redirect('petition::404/petition404');
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
        $sign = Signature::find($id);
        if( $sign )
        {
            $sign->delete();
            return back()->withMessage( trans('layout.alert_success') );
        }
        return redirect('petition::404/signature404');
    }
  
}
