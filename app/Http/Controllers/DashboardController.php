<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{    public function dashboard()
    
    {
        if (Auth::user()->name == 'Admin'){
            return view('admin.dashboard');
        }
        else if (Auth::user()->name =='Student'){
            return view('student.dashboard');
        }
        else if (Auth::user()->name =='Teacher'){
            return view('teacher.dashboard');
        }
        else if (Auth::user()->name =='Parent'){
            return view('parent.dashboard');
        }
    }
}