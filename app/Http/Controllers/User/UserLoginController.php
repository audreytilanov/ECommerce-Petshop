<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\UserToken;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class UserLoginController extends Controller
{
    public function create(Request $request){

        $check = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'cpassword' => 'required|min:5|same:password'
        ]);

        if($check){
            $create = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $lastId = User::latest('id')->first();

            $token = $lastId->id.hash('sha256', Str::random(120));
            $verifyUrl = route('user.verify', ['token' => $token, 'service' => 'Email_verification']);

            UserToken::create([
                'user_id' => $lastId->id,
                'token' => $token
            ]);

            $message = 'Hello <b>'. $request->name.'!</b>';
            $message = 'Thank you for registering an account! We just need to verify your email address to complete setting up your account';

            $mail_data = [
                'recipient' => $request->email,
                'fromEmail' => $request->email,
                'fromName' => $request->name,
                'subject' => 'Email Verification',
                'body' => $message, 
                'actionLink' => $verifyUrl,
            ];

            Mail::send('email-template', $mail_data, function($message) use($mail_data){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'])
                        ->subject($mail_data['subject']);
            });

            if($create){
                Alert::success('Account created!','You need to confirm your account, We have sent an activation link to your email, please check your email!');
                return redirect()->back()->with('success', 'Account created successfully');

            }else{
                toast('An Error Occured, please try again','error');
                return redirect()->back()->with('error', 'An Error Occured, please try again');
            }
        }
    }

    public function verifyEmail(Request $request){
        $token = $request->token;
        $verifyUser =  UserToken::where('token', $token)->first();

        if(!is_null($verifyUser)){
            $user = $verifyUser->user;
            $account = User::where('id', $verifyUser->user_id)->first();

            if($user->status == 0 ){
                $account->status = 1;
                $account->email_verified_at = now();
                $account->save();

                Alert::success('Account Verified!','Your email verified successfully, you can now login to your account. '.$user->email);
                return redirect()->route('user.login');
            }else{
                Alert::success('Account Verified!','Your email is already verified, you can now login to your account. '.$user->email);
            }
        }

    }

    public function check(Request $request){
        $check = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if($check){
            $credentials = $request->only('email', 'password');
            if(Auth::guard('web')->attempt($credentials)){
                $request->session()->regenerate();
                return redirect()->route('user.home');
            }else{
                toast('Incorrect Credentials','error');
                return redirect()->route('user.login');
            }
        }
    }

    public function logout(Request $request){
        // dd($request);
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('user.home');
    }
}
