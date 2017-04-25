<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/contacts';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function signup(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $confirmPassword = $request->input('confirmPassword');

        $validator = Validator::make(
            array(
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'confirmPassword' => $confirmPassword
            ),
            array(
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'confirmPassword' => 'required',
            )
        );
        if ($validator->fails()) {
            $error_messages = $validator->messages()->all();
            return redirect('/signup')->with('error','Please fill all fields');
        } else {
            if($password != $confirmPassword){
                return redirect('/signup')->with('error','Password and confirm password should match');
            }
            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->uuid = '';
            $user->loginType = 'manual';
            $user->save();
            return redirect('/')->with('message','User Created Successfully! Please log in.');
        }

    }

    public function getSignup()
    {
        if(session()->has('error')){
            return view('welcome')->with('error',session()->get('error'));
        }
        return view('welcome');
    }    
}
