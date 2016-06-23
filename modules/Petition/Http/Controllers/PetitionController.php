<?php

namespace Modules\Petition\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Petition\Entities\Petition;
use Modules\Petition\Entities\Category;
use Modules\Petition\Entities\Signature;
use Input,Validator,Auth,Mail,View;
use Yajra\Datatables\Datatables;

class PetitionController extends Controller
{
    protected $petition;
    public function __construct(Petition $petition)
    {
        $this->petition = $petition;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $petitions = $this->petition->where( 'user_id', Auth::user()->id )->orderBy('id', 'desc')->get();
      
        $sign_petitions = Signature::where( 'user_id', Auth::user()->id )->with('petition')->get(); 

        return View('petition::petition.manage', compact('petitions', 'sign_petitions') );
    }

    public function grid()
    {
            //$users = Petition::join('users', 'petition_petition.user_id', '=', 'users.id')
            //            ->select(['petition_petition.id','users.name','petition_petition.title','petition_petition.declaration']);
            $users = $this->petition->with('user')->select('petition_petition.*')->get();
            DD($users);
             return Datatables::of( $users )
                ->addColumn('action', function ($user) {
                    return '<a href="'.url('petition/'.$user->id.'/edit').'" data-toggle="modal" data-target="#myModal">Edit </a>
                            <a href="petition/'.$user->id.'" data-toggle="modal" data-target="#deleteModal"  >Delete </a>';
                })
                ->make(true);
    }
	
    public function petitionByCategory($id)
    {
        // novas petições
        $petitions = Petition::where('category_id', $id)->orderBy('id', 'desc')->take(10)->get();
        //
        
        return View('site.petition_slider', compact('petitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $petition = new Petition;
        $categories = Category::lists('name','id');
        return View('petition::petition.form', compact('petition', 'categories') );
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
        $input['user_id'] = Auth::user()->id;
        $input['slug'] = Petition::url_amigavel( $input['title'] );
        $validation = Validator::make($input, Petition::$rules);
      
        if( $validation->passes() )
        {
            $ptt = Petition::create($input);
            if( $request->hasFile('image') )
            {
              $fileName = date('Y-m-d_H-i-s').'-user_'.Auth::user()->id.'.'.$request->file('image')->getClientOriginalExtension(); 
              $request->file('image')->move( public_path().'/uploads/', $fileName );

              $ptt->image = $fileName;
              $ptt->save();
            } 
          
            $user = Auth::user();
            Mail::send('emails.newpetition', array(
              'petition'=>$ptt,
              'user'=>$user,
              'title_lang' => trans('email.newpetition.title'),
              'message_lang' => trans('email.newpetition.message'),
            ), 
            function($message) use ($user)
            {
                $message->to( $user->email, $user->name)->subject( trans('email.newpetition.title') );
            });
          
            return redirect('petitions/'.$ptt->id)->with('message', trans('layout.alert_success') );  
        }

        return back()->withInput()->withErrors($validation);
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
           
            return View('petition::petition.show', compact('petition', 'signatures', 'timeline'));
         }
      
         //$petitions = Petition::all();
         //return View('errors/petition404', compact('petitions'));
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
         return View('petition::petition.form', compact('petition','categories') );
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
