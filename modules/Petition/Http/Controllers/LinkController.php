<?php

namespace Modules\Petition\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input,Auth,Mail,Config;
use App\User;
use Modules\Petition\Entities\Signature;
use Modules\Petition\Entities\Petition;
use Modules\Petition\Entities\Report;
use Validator;

class LinkController extends Controller
{
    
    //
    //  PETITIONS 
    //
    public function reportPetition($id)
    {
        $why = Input::get('why');
        $ptt = Petition::find($id);
      
        if( $ptt && isset($why) )
        {
           $report = Report::create([
              'petition_id'=>$ptt->id,
              'why_id'=> $why,
              'why_desc'=>trans('petition.report.why'.$why)
           ]);
          
           if( Report::where('petition_id',$ptt->id)->count() > 2 )
           {
              $rtn = $this->reportPetitionToAdmin($ptt);
              return redirect('petitions/'.$ptt->id)->with('message', trans('layout.alert_success').' Admin informed '.(string)$rtn );
           }
          
           return redirect('petitions/'.$ptt->id)->with('message', trans('layout.alert_success') );
        }
      
        return redirect('404/report404');
    }
  
    public function reportPetitionToAdmin($ptt)
    {
        if( $ptt )
        {
            $mail = Mail::send('emails.default', array(
              'title_lang' => 'Petição com mais de 100 denúncias',
              'message_lang' => 'A petição '.$ptt->id.' com título '.$ptt->title.' precisa ser moderada.',
            ), 
            function($message)
            {
                $message->to( Config::get('mail.from.address'), Config::get('mail.from.name'))->subject( 'Petição com mais de 100 denúncias' );
            });
          
           return ( $mail )? true:false;
        }
      
        return false;
    }
    //
    //  SIGNATURES 
    //
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmSignature($id)
    {
        //
        $arr = explode('O', $id);
        $sign = Signature::find($arr[0]);
      
        if($sign && $arr[1] == date('hisdmy', strtotime($sign->created_at)) && $sign->confirmed == 0 )
        {
           $sign->confirmed = 1;
           $sign->save();
          
           return redirect('petitions/'.$sign->petition_id.'#signed');
        }
      
        return redirect('404/confirm404');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function formRemoveSignature($petition_id)
    {
        $petition = Petition::find($petition_id);
        if( $petition ) 
        {
            return View('signature.remove', compact('petition') );
        }
        return redirect('404/petition404');
    }
  
    public function EmailRemoveSignature()
    {
        $input = Input::all();
      
        $user = User::where('email', $input['email'])->first();
        if( !$user )  
          return back()->with( 'message', 'danger#'.trans('sign.notfound.signature') );
      
        $sign = Signature::where('user_id', $user->id )->where('petition_id', $input['petition_id'])->first();
      
        if( $sign ) 
        {
            $link = url('signature/'.$sign->id.'O'.date('hisdmy', strtotime($sign->created_at)).'/remove');
            Mail::send('emails.default', array(
              'title_lang' => trans('sign.remove.title'),'message_lang' => trans('sign.remove.message', ['link'=>$link] ),
            ), 
            function($message) use ($user)
            {
                $message->to( $user->email, $user->name)->subject( trans('sign.remove.title') );
            });
            return redirect('petitions/'.$sign->petition_id )->with('message', trans('sign.email.sent') );
        }
      
        return back()->with( 'message', trans('sign.notfound.signature') );
    }
  
    public function removeSignature($id)
    {
        $arr = explode('O', $id);
        $sign = Signature::find($arr[0]);
      
        if($sign && $arr[1] == date('hisdmy', strtotime($sign->created_at)) )
        {
           $sign->delete();
          
           return redirect('/')->with('message', trans('layout.alert_success') );
        }
      
        return redirect('404/confirm404');
    }
    
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTimeline($petition_id)
    {
        $signatures = Signature::where('petition_id', $petition_id)->where('confirmed', '1')->count();
        //if( in_array($signatures, ) )  
    }
}
