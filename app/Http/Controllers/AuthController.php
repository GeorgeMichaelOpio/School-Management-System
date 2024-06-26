<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login ()
    {
        //dd(Hash::make(1234567890));
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
}