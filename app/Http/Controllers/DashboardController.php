<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{    public function dashboard()
    
    {
        if (Auth::user()->role == 'admin'){
            return view('admin.dashboard');
        }
        else if (Auth::user()->role =='student'){
            return view('student.dashboard');
        }
        else if (Auth::user()->role =='teacher'){
            return view('teacher.dashboard');
        }
        else if (Auth::user()->role =='parent'){
            return view('parent.dashboard');
        }
    }
}