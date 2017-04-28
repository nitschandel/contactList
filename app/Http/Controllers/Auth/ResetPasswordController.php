<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Mail\ForgotPassword;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendChangePasswordLink(Request $request)
    {
        $email = $request->input('email');


        $validator = Validator::make(
            array(
                'email' => $email
            ),
            array(
                'email' => 'required',
            )
        );
        if ($validator->fails()) {
            $error_messages = $validator->messages()->all();
            return response()->json([
                                    'success' => false,
                                    'error' => 'Please fill the email.'
                                ]);
        } else {
            $user = User::where('email', $email)->first();
            if ($user) {
                $token = substr(rand().time(), 0, 12);
                $forgotPasswordLink = $request->server('HTTP_HOST').'/resetPassword?token='.$token;

                DB::table('password_resets')->insert([
                    'email' => $user->email,
                    'token' => $token
                ]);

                $user->link = $forgotPasswordLink;
                Mail::to($email)->send(new ForgotPassword($user));

                return response()->json(['success' => true]);
            } else {
                return response()->json([
                                    'success' => false,
                                    'error' => 'Please enter the correct email id'
                                ]);
            }
        }
    }

    public function resetPassword(Request $request)
    {
        $passwordToken = $request->input('token');

        $userPasswordReset = DB::select('select * from password_resets where token = ?', [$passwordToken]);

        if (count($userPasswordReset) > 0) {
            $user = User::where('email', $userPasswordReset[0]->email)->first();
            if ($user) {
                return view('auth.passwords.reset')->with('passwordToken', $passwordToken);
            }
            return redirect('/')->with('error', 'Email id not registered');
        }

        return redirect('/')->with('error', 'Link expired');
    }

    public function saveNewPassword(Request $request)
    {
        $passwordToken = $request->input('passwordToken');
        $newPassword = $request->input('newPassword');
        $newPasswordRepeat = $request->input('newPasswordRepeat');

        $validator = Validator::make(
            array(
                'passwordToken' => $passwordToken,
                'newPassword' => $newPassword,
                'newPasswordRepeat' => $newPasswordRepeat
            ),
            array(
                'passwordToken' => 'required',
                'newPassword' => 'required|min:6',
                'newPasswordRepeat' => 'required|min:6'
            )
        );
        if ($validator->fails()) {
            $error_messages = $validator->messages()->all();
            return view('auth.passwords.reset')
                        ->with('error', 'Please fill the password with minimum 6 characters')
                        ->with('passwordToken', $passwordToken);
        } else {
            if ($newPassword != $newPasswordRepeat) {
                return view('auth.passwords.reset')
                        ->with('error', 'Password do not match')
                        ->with('passwordToken', $passwordToken);
            }
            $userPasswordReset = DB::select('select * from password_resets where token = ?', [$passwordToken]);

            if (count($userPasswordReset) > 0) {
                $user = User::where('email', $userPasswordReset[0]->email)->first();
                if ($user) {
                    $user->password = Hash::make($newPassword);
                    $user->save();
                    return redirect('/')->with('error', 'Password changed. Please login');
                }
                return redirect('/')->with('error', 'Email id not registered');
            }

            return redirect('/')->with('error', 'Link expired');
        }
    }
}
