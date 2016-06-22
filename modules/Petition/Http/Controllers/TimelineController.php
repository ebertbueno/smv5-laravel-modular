<?php

namespace Modules\Petition\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Petition;
use App\Models\Timeline;
use Input,Validator,Auth,Mail;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $petitions = Petition::where( 'user_id', Auth::user()->id )->orderBy('id', 'desc')->get();
      
        $sign_petitions = Signature::where( 'user_id', Auth::user()->id )->with('petition')->get();
      
        return View('petition.manage', compact('petitions', 'sign_petitions') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $petition = new Petition();
        $categories = Category::lists('name','id');
         return View('petition.form', compact('petition', 'categories') );
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
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $validation = Validator::make($input, Timeline::$rules);
      
        if( $validation->passes() )
        {
            $ptt = Timeline::create($input);
            return response()->json(['message'=> trans('petition.timeline.message') ], 200); 
        }

       return response()->json( ['message'=>trans('layout.alert_error'),'error'=>$validation->getMessageBag()->toArray()], 412 );  
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
         $petition = Petition::with('user')->find($id);
         if( $petition )
         {
            $signatures = Signature::where('petition_id', $id)->where('confirmed', '1')->count();
            $timeline = $petition->timeline()->where('approved', 1)->get();
           
            return View('petition.show', compact('petition', 'signatures', 'timeline'));
         }
      
         $petitions = Petition::all();
         return View('errors/petition404', compact('petitions'));
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
         $petition = Petition::findOrFail($id);
         $categories = Category::lists('name','id');
         return View('petition.form', compact('petition','categories') );
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
        $input = Input::all();
        $input['slug'] = Petition::url_amigavel( $input['title'] );
      
        $rules = Petition::$rules;
        $rules['title'] = 'required|min:10|unique:petition_petition,title,'.$id;  
        $rules['slug'] = 'required|min:10|unique:petition_petition,slug,'.$id;  
      
        $validation = Validator::make($input, $rules);

        if( $validation->passes() )
        {
            if( isset($input['title']) ) 
          
            unset($input['_method'],$input['_token']);
          
            if( $request->hasFile('image') )
            {
              $fileName = date('Y-m-d_H-i-s').'-user_'.Auth::user()->id.'.'.$request->file('image')->getClientOriginalExtension(); 
              $request->file('image')->move( public_path().'/uploads/', $fileName );

              $input['image'] = $fileName;
            }            
            Petition::where('id', $id)->update($input);
          
            return redirect('petitions/'.$id);  
        }

        return back()->withInput()->withErrors($validation);
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
        $input = Input::all();
        $ptt = Petition::find( $id );
        if( $ptt && $ptt->user_id == Auth::user()->id )
        {
           if( $input['comment'] )
           {
             $ptt->comment = $input['comment'];
             $ptt->save();
           }
           $ptt->delete();
           
           return redirect()->route('petition.index')->with('message', trans('layout.alert_success'));
        }
    }
  
    
}
