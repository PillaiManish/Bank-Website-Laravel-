<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest,App\Http\Requests\LoginRequest,App\Http\Requests\ChangePasswordRequest,App\Http\Requests\ForgotPasswordRequest,App\Http\Requests\ForgotPasswordEmailRequest;
use App\Models\User;
use App\Mail\AccountVerfiyMail,App\Mail\PasswordChangeMail,App\Mail\ForgotPasswordMail;
use Hash,Auth,Mail;



class AccountController extends Controller
{
    // Get Request on Login Page
    public function getLogin(){
        return view('account.login');
    }

    // Get Request on Logout Page
    public function getLogout(){
        Auth::logout();
        return redirect('/login')->with('success','You have been logged out');
    }
    // Get Request on Register Page
    public function getRegister(){
        return view('account.register');
    }

    // Post Request on Login Page
    public function postRegister(RegisterRequest $request){
        $user = User::create(['name'=>$request->input('name'),'email'=>$request->input('email'),'password'=>Hash::make($request->input('password'))]);
        Mail::to($user->email)->send(new AccountVerfiyMail($user));
        return redirect('/login')->with('success','Your account has been created, please verify it first');
    }

    // Post Request on Register Page
    public function postLogin(LoginRequest $request){
        if (Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])){
            
            if (auth()->user()->email_verified_at == null){
                Auth::logout();
                return redirect('/login')->with('error','Verify your account first');
            }

            return redirect('/')->with('success','You have been logged in');
            }
        return redirect('/login')->with('error','Email or Password is wrong');
    }

    // Get Request on Verify
    public function getVerify($token){
        $user = User::where('id',decrypt($token))->update(['email_verified_at'=>now()]);
        return redirect('/login')->with('success','Your account has been verified, please login');
    }

    // Get Request on Change Password
    public function getChangePassword(){
        return view('account.changepassword');
    }

    // Post Request on Change Password
    public function postChangePassword(ChangePasswordRequest $request){
        if(Hash::check($request->input('password'),Auth::user()->password)){
            Auth::user()->password = Hash::make($request->input('newpassword'));
            Auth::user()->save();
            Mail::to(Auth::user()->email)->send(new PasswordChangeMail());
            // Redirect to my account page
            return redirect('/')->with('success','Your password has been changed, Thank You');
        }
        return redirect('/changepassword')->with('error','Enter correct current password');
    }

    // Get Request on Forgot Password
    public function getForgotPassword(){
        return view('account.forgotpassword');
    }

    // Post Request on Forgot Password
    public function postForgotPassword(ForgotPasswordRequest $request){
        $user = User::where('email',$request->input('email'))->first();
        Mail::to($request->input('email'))->send(new ForgotPasswordMail($user));
        return redirect('/forgotpassword')->with('success','Please check your email for reset password link');
    }

    // Get Request on Forgot Password Redirected from mail
    public function getForgotPasswordEmail(){
        return view('account.forgotpasswordemail');
    }

    // Post Request on Forgot Password Redirected from mail
    public function postForgotPasswordEmail(ForgotPasswordEmailRequest $request,$token){
        User::where('id',decrypt($token))->update(['password'=>Hash::make('password')]);
        return redirect('/login')->with('success','Your password has been reset, try login now');
    }
}
