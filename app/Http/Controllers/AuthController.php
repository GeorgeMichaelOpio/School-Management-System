<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function login (){
        if (!empty(Auth::check())){
            if (Auth::user()->name == 'Admin'){
                return redirect('admin/dashboard');
            }
            else if (Auth::user()->name =='Student'){
                return redirect('student/dashboard');
            }
            else if (Auth::user()->name =='Teacher'){
                return redirect('teacher/dashboard');
            }
            else if (Auth::user()->name =='Parent'){
                return redirect('parent/dashboard');
    
            }
        }
        return view('auth.login');
    }

    public function Authlogin(Request $request) {

           //dd($request->all());

           $remember = !empty($request->remember) ? true : false;

           if (Auth::attempt(['email' => $request ->email, 'password' => $request ->password],$remember)) {
            if (Auth::user()->name == 'Admin'){
                return redirect('admin/dashboard');
            }
            else if (Auth::user()->name =='Student'){
                return redirect('student/dashboard');
            }
            else if (Auth::user()->name =='Teacher'){
                return redirect('teacher/dashboard');
            }
            else if (Auth::user()->name =='Parent'){
                return redirect('parent/dashboard');
    
            }
        }
        else {
            return redirect() -> back() -> with('error','Please enter correct email address and password');
        }}

    public function logout()  
    {
        Auth::logout();
        return redirect(url(''));
    }

    public function forgotpassword() {
        return view('auth.forgot');
    }

    public function PostForgotPassword(Request $request) {
        $user = User::getEmailSingle($request->email);
        if(!empty($user)){
            $user -> remember_token = Str::random(30);
            $user -> save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success', "Please check your email and Reset your Password");
        }
        else
        {
            return redirect()->back()->with('error', "Email address Not Found");
        }
    }

    public function reset($remember_token) {
        $user = User::getTokenSingle($remember_token);
        if(!empty($user)){
            $data['user'] = $user;
            return view('auth.reset', $data);
        }
        else{
            abort(404);
        }
    }

    public function PostReset($remember_token, Request $request) {
        if($request->password == $request->confirm_password){
            $user = User::getTokenSingle($remember_token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect(url(''))->with('success','Password has been changed');
        }
        else{
            return redirect()->back()->with('error', "Passwords do not match");
        }
    }
}       