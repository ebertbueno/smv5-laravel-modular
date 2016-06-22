<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Input;
use App\User;
use App\Models\Account;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    protected $redirectPath = '/';

    public function __construct() 
    {   
        $this->middleware('guest', ['except' => ['getLogout','postRegister'] ]);
    }

    public function facebook()
    {
        return Socialite::driver('facebook')->fields([
                    'first_name', 'last_name', 'email', 'gender', 'birthday'
                ])->redirect();
    }

    public function pageFacebook()
    {
        $user = Socialite::driver('facebook')->user();
        //dd($user);
        if( !$user ) redirect('/')->with('message', "Erro ao acessar o facebook");
      
        if( $checkUser = User::where('email', '=', $user->email)->first() )
        {
           Auth::login($checkUser);
            
           return redirect('/')->with('message', "Authentication successful. Welcome ".$user->name);
        }
        else
        {
            $objUser =  [
                'name'      => $user->user['first_name'],
                'last_name' => $user->user['last_name'],
                'email'     => $user->email,
                'avatar'    => $user->avatar,
                'gender'    => $user->user['gender'],
            		'provider'  => 'facebook',
            		'provider_id' => $user->id
            ];
          
           $register_user = $this->store($objUser);
          
           if( !$register_user )
           {
              return redirect('/')->with('message', "Não foi possível cadastrar o usuario ".$user->email );
           }  
           else
           {
             Auth::login($register_user);
             return redirect('/')
                  ->with('message', "Registrado com sucesso. Seja bem vindo ".$user->name );
           }
        }
       
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        return Validator::make($data, 
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function registerForm()
    {
        $input = Input::all();
        $validation = Validator::make($input, User::$rules);

        if ( $validation->passes() )
        {
           $register_user = $this->store( $input );
          
           if( !$register_user )
           {
              return $register_user;
           }  
           else
           {
             Auth::login($register_user);
             return redirect('/')
                  ->with('message', "Registrado com sucesso. Seja bem vindo ".$register_user->name );
           }
        }
        else
        {
             return redirect('/')
               ->with('message', "Não foi possível cadastrar o usuario ".$input['email'] );
        }
      
    }
    
    protected function store( array $objUser )
    {
        $user_exists = User::where('email', '=', $objUser['email'])->first();
        if(!$user_exists) 
        {
            $validator = Validator::make($objUser , User::$rules );
            if ($validator->fails())
            {
                return back()->withErrors($validator)->withInput();
            }
            $user = User::create($objUser);
  
            $objUser['user_id'] = $user->id;
            $account = Account::create($objUser);
             
            return $user;
       }
       else
       {
            return false;
       }
       
    }

}
