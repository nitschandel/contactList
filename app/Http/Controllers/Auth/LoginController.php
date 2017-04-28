<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Validator;
use Socialite;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var stringSocialite
     */
    protected $redirectTo = '/contacts';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login()
    {
        if (session()->has('error')) {
            return view('welcome')->with('error', session()->get('error'));
        }
        return view('welcome');
    }

    public function redirectToProviderFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallbackFacebook()
    {
         $facebookUser = Socialite::driver('facebook')->user();
        try {
            $user = User::where('email', $facebookUser->email)
                      ->where('uuid', $facebookUser->id)
                      ->first();
            if (!$user) {
                $user = $this->createOAuthUsers($facebookUser, 'facebook');
            }
            Auth::login($user);

            return redirect('/contacts');
        } catch (\Exception $e) {
            Log::info($e);
            return redirect('/')->with('error', 'Error occured during facebook login. Plaese try again.');
        }
    }
    public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallbackGoogle()
    {
         $googleUser = Socialite::driver('google')->user();
        try {
            $user = User::where('email', $googleUser->email)
                      ->where('uuid', $googleUser->id)
                      ->first();
            if (!$user) {
                $user = $this->createOAuthUsers($googleUser, 'google');
            }
            Auth::login($user);

            return redirect('/contacts');
        } catch (\Exception $e) {
            Log::info($e);
            return redirect('/')->with('error', 'Error occured during Google login. Plaese try again.');
        }
    }

    public function signin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember');

        $validator = Validator::make(
            array(
                'email' => $email,
                'password' => $password,
            ),
            array(
                'email' => 'required',
                'password' => 'required',
            )
        );
        if ($validator->fails()) {
            $error_messages = $validator->messages()->all();
            return redirect('/')->with('error', 'Please fill all fields');
        } else {
            if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
                return redirect('/contacts');
            } else {
                return redirect('/')->with('error', 'Please enter correct credentials');
            }
        }
    }

    public function createOAuthUsers($newUser, $loginType)
    {
        $user = new User;
        $user->name = $newUser->name;
        $user->email = $newUser->email;
        $user->password = Hash::make('123456');
        $user->uuid = $newUser->id;
        $user->loginType = $loginType;
        $user->save();

        return $user;
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
